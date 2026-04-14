<x-layouts.dashboard page="show_user">

    <x-dashboard.breadcrumb :page="__('ui.show_user')">
        @can('viewAny', App\Models\User::class)
            <x-dashboard.breadcrumb-back
                :url="route('dashboard.users.index')"
                :name="__('ui.view_users')" />
        @endcan
    </x-dashboard.breadcrumb>

    <div class="p-4 relative overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] flex flex-col gap-5 overflow-x-auto">

        <x-dashboard.info-label :name="__('validation.attributes.image')">
            <img class="rounded-md w-48 h-48 object-center object-cover" src="{{ $avatar }}">
        </x-dashboard.info-label>

        <div class="max-w-xl grid grid-cols-1 sm:grid-cols-2 gap-5">

            <x-dashboard.info-label
                :name="__('validation.attributes.name')"
                :value="$user->name" />

            <x-dashboard.info-label
                :name="__('validation.attributes.email')"
                :value="$user->email" />

            <x-dashboard.info-label :name="__('validation.attributes.role')" class="flex flex-wrap gap-2 items-center">

                @forelse ($userRoles as $roleName)
                    <x-dashboard.badges.success :name="$roleName" />
                    <x-dashboard.badges.success :name="$roleName" />
                @empty
                    <x-dashboard.badges.light :name="__('ui.user')" />
                @endforelse

            </x-dashboard.info-label>

            <x-dashboard.info-label
                :name="__('ui.created_at')"
                :value="$user->created_at->isoFormat(config('app.time_format'))" />

        </div>
    </div>

</x-layouts.dashboard>
