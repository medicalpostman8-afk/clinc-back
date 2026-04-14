<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Utils\Livewire\DataTable;
use App\Utils\Livewire\Table\Button;
use App\Utils\Livewire\Table\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;

class UsersTable extends DataTable
{
    use WithPagination;

    protected $modelClass = User::class;

    public bool $modelHasMedia = true;

    public bool $tableHasTrash = true;

    public array|null $searchableColumns = [
        'name',
        'email'
    ];

    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    /**
     * Table Query Builder
     */
    protected function builder(): Builder
    {
        return User::query();
    }

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        $user->is_active = !$user->is_active;
        $user->save();

        $this->dispatch('notify', __('تم تحديث حالة المستخدم بنجاح.'));
    }

    protected function columns(): Collection|null
    {
        return new Collection([

            Column::name('check')
                ->checkbox()
                ->hidden(Gate::denies('deleteAny', User::class)),

            Column::name('name')
                ->sortable(),

            Column::name('email')
                ->sortable(),

            Column::name('role', __('ui.role'))
                ->callback(function ($user) {
                    $badges = '';

                    if ($user->roles->count() > 0) {
                        foreach ($user->roles as $key => $role) {
                            $badges .= view('components.dashboard.badges.success', ['name' => $role->name]);
                        }
                    } else {
                        $badges .= view('components.dashboard.badges.light', ['name' => __('ui.user')]);
                    }

                    return $badges;
                }),

            Column::name('show', __('ui.show'))
                ->action()
                ->url(fn($user) => route('dashboard.users.show', ['user' => $user->id]))
                ->view('components.dashboard.tables.buttons.show')
                ->hidden($this->trashMode),

            Column::name('edit', __('ui.edit'))
                ->action()
                ->url(fn($user) => route('dashboard.users.edit', ['user' => $user->id]))
                ->view('components.dashboard.tables.buttons.edit')
                ->authorize(fn($user) => Gate::allows('update', $user))
                ->hidden($this->trashMode || Gate::denies('updateAny', User::class)),

            Column::name('is_active', __('ui.active'))
                ->action()
                ->wireAction('toggleActive')
                ->callback(function ($user) {
                    return view('components.dashboard.tables.buttons.active', ['row' => $user]);
                }),


            Column::name('restore', __('ui.restore'))
                ->action()
                ->wireAction('restore')
                ->view('components.dashboard.tables.buttons.restore')
                ->authorize(fn($user) => Gate::allows('restore', $user))
                ->hidden(!$this->trashMode || Gate::denies('restoreAny', User::class)),

            Column::name('delete', __('ui.delete'))
                ->action()
                ->wireAction('delete')
                ->view('components.dashboard.tables.buttons.delete')
                ->authorize(fn($user) => Gate::allows('delete', $user) || Gate::allows('forceDelete', $user))
                ->hidden(Gate::denies('deleteAny', User::class)),

        ]);
    }

    protected function buttons(): Collection|null
    {
        return new Collection([

            Button::name(__('ui.add_user'))
                ->url(route('dashboard.users.create'))
                ->view('components.dashboard.tables.buttons.add')
                ->hidden(Gate::denies('create', User::class)),

            Button::name('restore')
                ->type('restore')
                ->view('components.dashboard.tables.buttons.restore')
                ->hidden(!$this->trashMode || Gate::denies('restoreAny', User::class)),

            Button::name('delete')
                ->type('delete')
                ->view('components.dashboard.tables.buttons.delete')
                ->hidden(Gate::denies('deleteAny', User::class)),

            Button::name(__('ui.trash'))
                ->type('trash')
                ->view('components.dashboard.tables.buttons.trash')
                ->hidden(Gate::denies('restoreAny', User::class)),

        ]);
    }

    protected function dropdowns(): Collection|null
    {
        return new Collection([]);
    }

    protected function modals(): Collection|null
    {
        return new Collection([]);
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
