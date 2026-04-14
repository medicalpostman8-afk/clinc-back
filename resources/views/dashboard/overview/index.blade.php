<x-layouts.dashboard page="overview">

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

        <x-dashboard.cards.overview :title="__('ui.users')" :count="$usersCount">
            <!-- mage:users -->
            <!-- Icon from Mage Icons by MageIcons - https://github.com/Mage-Icons/mage-icons/blob/main/License.txt -->
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.928 19.634h2.138a1.165 1.165 0 0 0 1.116-1.555a6.85 6.85 0 0 0-6.117-3.95m0-2.759a3.664 3.664 0 0 0 3.665-3.664a3.664 3.664 0 0 0-3.665-3.674m-1.04 16.795a1.908 1.908 0 0 0 1.537-3.035a8.03 8.03 0 0 0-6.222-3.196a8.03 8.03 0 0 0-6.222 3.197a1.909 1.909 0 0 0 1.536 3.034zM9.34 11.485a4.16 4.16 0 0 0 4.15-4.161a4.151 4.151 0 0 0-8.302 0a4.16 4.16 0 0 0 4.151 4.16" />
        </x-dashboard.cards.overview>

        <x-dashboard.cards.overview :title="__('ui.contact_requests')" :count="$contactRequestCount" viewBox="0 0 16 16">
            <!-- bi:envelope -->
            <!-- Icon from Bootstrap Icons by The Bootstrap Authors - https://github.com/twbs/icons/blob/main/LICENSE.md -->
            <path fill="currentColor" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2l7-4.2V4a1 1 0 0 0-1-1zm13 2.383l-4.708 2.825L15 11.105zm-.034 6.876l-5.64-3.471L8 9.583l-1.326-.795l-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
        </x-dashboard.cards.overview>

    </div>

</x-layouts.dashboard>
