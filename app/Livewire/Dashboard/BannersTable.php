<?php

namespace App\Livewire\Dashboard;

use App\Models\Banner;
use App\Utils\Livewire\DataTable;
use App\Utils\Livewire\Table\Button;
use App\Utils\Livewire\Table\Column;
use App\Utils\Livewire\Table\Dropdown;
use App\Utils\Livewire\Table\DropdownChild;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;

class BannersTable extends DataTable
{
    use WithPagination;

    protected $modelClass = Banner::class;

    public bool $modelHasMedia = true;

    public array|null $searchableColumns = [
        'name',
    ];

    public string|null $statusFilter = null;

    public function mount()
    {
        $this->authorize('viewAny', Banner::class);
    }

    /**
     * Table Query Builder
     */
    protected function builder(): Builder
    {
        $query = Banner::query();

        if ($this->statusFilter) {
            if ($this->statusFilter == 'active') {
                // Add active scope to query
                $query->active();
            } else {
                // Add inactive scope to query
                $query->inactive();
            }
        }

        return $query;
    }

    protected function columns(): Collection|null
    {
        return new Collection([

            Column::name('check')
                ->checkbox()
                ->hidden(Gate::denies('deleteAny', Banner::class)),

            Column::name('name')
                ->sortable(),

            Column::name('status', __('ui.status'))
                ->callback(function ($banner) {

                    if ($banner->isActive()) {
                        $badge = view('components.dashboard.badges.success', ['name' => __('ui.active')]);
                    } else {
                        $badge = view('components.dashboard.badges.light', ['name' => __('ui.inactive')]);
                    }

                    return $badge;
                }),

            Column::name('show', __('ui.show'))
                ->action()
                ->url(fn($banner) => route('dashboard.banners.show', ['banner' => $banner->id]))
                ->view('components.dashboard.tables.buttons.show'),

            Column::name('edit', __('ui.edit'))
                ->action()
                ->url(fn($banner) => route('dashboard.banners.edit', ['banner' => $banner->id]))
                ->view('components.dashboard.tables.buttons.edit')
                ->authorize(fn($banner) => Gate::allows('update', $banner))
                ->hidden(Gate::denies('updateAny', Banner::class)),

            Column::name('delete', __('ui.delete'))
                ->action()
                ->wireAction('delete')
                ->view('components.dashboard.tables.buttons.delete')
                ->authorize(fn($banner) => Gate::allows('delete', $banner))
                ->hidden(Gate::denies('deleteAny', Banner::class)),

        ]);
    }

    protected function buttons(): Collection|null
    {
        return new Collection([

            Button::name(__('ui.create_banner'))
                ->url(route('dashboard.banners.create'))
                ->view('components.dashboard.tables.buttons.add')
                ->hidden(Gate::denies('create', Banner::class)),

            Button::name('delete')
                ->type('delete')
                ->view('components.dashboard.tables.buttons.delete')
                ->hidden(Gate::denies('deleteAny', Banner::class)),

        ]);
    }

    protected function dropdowns(): Collection|null
    {
        $resultsDropdownTitle = $this->statusFilter
            ? __("ui.{$this->statusFilter}")
            : __('ui.status');

        return new Collection([

            Dropdown::name($resultsDropdownTitle)
                ->id('resultsStatusDropdown')
                ->children([

                    DropdownChild::name(__('ui.status'))
                        ->wireAction('setStatus()'),

                    DropdownChild::name(__('ui.active'))
                        ->wireAction('setStatus(\'active\')'),

                    DropdownChild::name(__('ui.inactive'))
                        ->wireAction('setStatus(\'inactive\')'),


                ]),

        ]);
    }

    protected function modals(): Collection|null
    {
        return new Collection([]);
    }

    public function setStatus($newStatus = null)
    {
        $this->statusFilter = $newStatus;
    }

    public function render()
    {
        return view('livewire.dashboard.general-table', [
            'results' => $this->getResults(),
            'fields' => $this->getFields(),
            'buttons' => $this->getButtons(),
            'dropdowns' => $this->getDropdowns(),
            'modals' => $this->getModals(),
        ]);
    }
}
