<?php

namespace App\Utils\Livewire;

use App\Events\UserDeleted;
use App\Models\User;
use App\Utils\Livewire\Table\Dropdown;
use App\Utils\Livewire\Table\DropdownChild;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

abstract class DataTable extends Component
{
    protected $modelClass;

    public string $orderColumn = 'id';

    public string $orderType = 'desc';

    public int $resultsLimit = 10;

    public string|null $searchQuery;

    public array|null $idsToDelete;

    public bool $selectAllCheckbox;

    public bool $modelHasMedia = false;

    public bool $trashMode = false;

    public bool $tableHasTrash = false;

    public array $selected;

    public array|null $searchableColumns;

    abstract protected function columns(): Collection|null;

    abstract protected function buttons(): Collection|null;

    abstract protected function dropdowns(): Collection|null;

    abstract protected function modals(): Collection|null;

    abstract protected function builder(): Builder;

    public bool $deleteConfirmed = false;

    /**
     * Apply search query string to query builder
     */
    protected function applySearchQuery($query)
    {
        $q = trim($this->searchQuery);

        if ($q && $q !== '') {
            $query = $query->where(function (Builder $buiderQuery) use ($q) {
                foreach ($this->searchableColumns as $key => $column) {
                    $whereMethod = $key === 0 ? 'where' : 'orWhere';

                    $buiderQuery->{$whereMethod}($column, 'LIKE', "%{$q}%");
                }
            });
        } else {
            $this->searchQuery = null;
        }

        return $query;
    }

    public function toggleSelected()
    {
        $this->selected = $this->selectAllCheckbox
            ? $this->getResults()->pluck('id')->toArray()
            : [];
    }

    /**
     * Delete result
     */
    public function delete($ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $customDeleteModels = [
            User::class,
            Role::class
        ];

        // Custom delete
        if (in_array($this->modelClass, $customDeleteModels)) {
            $ids = array_filter($ids, function ($idToDelete) {
                // Remove current user id from ids array
                if ($this->modelClass == User::class) {
                    return $idToDelete != Auth::user()->id;
                }

                // Remove system roles from ids array
                if ($this->modelClass == Role::class) {
                    return !in_array($idToDelete, $this->systemRolesIds);
                }
            });
        }

        if ($this->deleteConfirmed) {

            if ($this->modelHasMedia) {
                // Delete and retrieve each model in ids array

                // Force delete any trashed results from selected
                if ($this->tableHasTrash) {
                    $results = $this->builder()
                        ->whereIn('id', $ids)
                        ->onlyTrashed()
                        ->get(['id']);

                    foreach ($results as $result) {
                        $class = new $this->modelClass;

                        $class->onlyTrashed()
                            ->find($result->id)
                            ->forceDelete();
                    }
                }

                $results = $this->builder()
                    ->whereIn('id', $ids)
                    ->get(['id']);

                foreach ($results as $result) {
                    $class = new $this->modelClass;

                    $class->find($result->id)
                        ->delete();
                }
            } else {
                // Mass delete statement

                // Force delete any trashed results from selected
                if ($this->tableHasTrash) {
                    $this->builder()
                        ->whereIn('id', $ids)
                        ->onlyTrashed()
                        ->forceDelete();
                }

                $this->builder()
                    ->whereIn('id', $ids)
                    ->delete();
            }

            $this->deleteConfirmed = false;
            $this->resetSelector();

            $this->dispatch('hideModal', ['id' => 'deleteConfirmationModal']);
        } else {
            $this->idsToDelete = $ids;

            $this->dispatch('showModal', ['id' => 'deleteConfirmationModal']);
        }
    }

    /**
     * Restore results
     */
    public function restore($ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $this->builder()
            ->onlyTrashed()
            ->whereIn('id', $ids)
            ->restore();

        $this->resetSelector();
    }

    /**
     * Confirm delete from modal
     */
    public function confirmDelete()
    {
        $this->deleteConfirmed = true;

        $this->delete($this->idsToDelete);
    }

    public function toggleTrash()
    {
        $this->trashMode = !$this->trashMode;

        $this->resetSelector();
    }

    public function resetSelector()
    {
        $this->selected = [];
        $this->selectAllCheckbox = false;
    }

    /**
     * Change results limit
     */
    public function changeLimit(int $limit)
    {
        $this->resultsLimit = $limit;
    }

    public function sortBy($column)
    {
        if ($this->orderColumn == $column) {
            $this->orderType = $this->orderType == 'desc' ? 'asc' : 'desc';
        } else {
            $this->orderColumn = $column;
        }
    }

    /**
     * Get table dropdowns
     */
    protected function getDropdowns()
    {
        $dropdowns = $this->dropdowns()->map(function ($item) {
            return $item->getData();
        });

        $resultsCountDropdown = new Collection([

            Dropdown::name(__('ui.showing_count_results', ['count' => $this->resultsLimit]))
                ->id('resultsLimitDropdown')
                ->children([

                    DropdownChild::name(__('ui.showing_count_results', ['count' => 10]))
                        ->wireAction('changeLimit(10)'),

                    DropdownChild::name(__('ui.showing_count_results', ['count' => 25]))
                        ->wireAction('changeLimit(25)'),

                    DropdownChild::name(__('ui.showing_count_results', ['count' => 50]))
                        ->wireAction('changeLimit(50)')

                ])
                ->getData(),

        ]);

        $dropdowns = $resultsCountDropdown->merge($dropdowns);

        return $dropdowns;
    }

    /**
     * Get table modals
     */
    protected function getModals()
    {
        $modals = $this->modals()->map(function ($item) {
            return $item->getData();
        });

        $modals = array_filter($modals->toArray(), function ($modal) {
            return !$modal['hidden'];
        });

        return $modals;
    }

    /**
     * Get table buttons
     */
    protected function getButtons()
    {
        $buttons = $this->buttons()->map(function ($item) {
            return $item->getData();
        });

        $buttons = array_filter($buttons->toArray(), function ($button) {
            return !$button['hidden'];
        });

        return $buttons;
    }

    /**
     * Get table fields or columns
     */
    protected function getFields()
    {
        $fields = $this->columns()->map(function ($item) {
            return $item->getData();
        });

        $fields = array_filter($fields->toArray(), function ($field) {
            return !$field['hidden'];
        });

        return $fields;
    }

    /**
     * Run table query builder
     */
    protected function getResults()
    {
        $query = $this->builder();

        if ($this->trashMode) {
            $query = $query->onlyTrashed();
        }

        if (isset($this->searchQuery)) {
            $query = $this->applySearchQuery($query);
        }

        $query = $query->orderBy($this->orderColumn, $this->orderType);

        $results = $query->paginate($this->resultsLimit);

        if ($results->currentPage() > $results->lastPage()) {
            $this->resetPage();

            $results = $query->paginate($this->resultsLimit);
        }

        return $results;
    }
}
