<div>
    <nav x-data="{ selected: $persist('overview') }">

        <!-- Main Group -->
        <div>

            @canany(['view dashboard', 'manage settings', 'view pages', 'create pages', 'view banners'])

                <x-dashboard.nav.label name="main" />

                <ul class="mb-6 flex flex-col gap-4">

                    @can('view dashboard')
                        <!-- Overview -->
                        <x-dashboard.nav.item
                            name="overview"
                            :url="route('dashboard.overview')">
                            <!-- ic:round-space-dashboard -->
                            <!-- Icon from Google Material Icons by Material Design Authors - https://github.com/material-icons/material-icons/blob/master/LICENSE -->
                            <path fill="currentColor" d="M9 21H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h4c1.1 0 2 .9 2 2v14c0 1.1-.9 2-2 2m6 0h4c1.1 0 2-.9 2-2v-5c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v5c0 1.1.9 2 2 2m6-13V5c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v3c0 1.1.9 2 2 2h4c1.1 0 2-.9 2-2" />
                        </x-dashboard.nav.item>
                        <!-- Overview -->
                    @endcan

                    @can('manage settings')
                        <!-- Settings -->
                        <x-dashboard.nav.item-group
                            name="settings"
                            :children="[['general_settings', route('dashboard.settings.index', ['tab' => 'basic-information']), true], ['about-us', route('dashboard.settings.edit_default_page', ['page' => 'about-us']), true], ['terms-and-conditions', route('dashboard.settings.edit_default_page', ['page' => 'terms-and-conditions']), true], ['privacy-policy', route('dashboard.settings.edit_default_page', ['page' => 'privacy-policy']), true]]"
                            icon-viewBox="0 0 36 36">
                            <!-- clarity:settings-solid -->
                            <!-- Icon from Clarity by VMware - https://github.com/vmware/clarity-assets/blob/master/LICENSE -->
                            <path fill="currentColor"
                                d="m32.57 15.72l-3.35-1a11.7 11.7 0 0 0-.95-2.33l1.64-3.07a.61.61 0 0 0-.11-.72l-2.39-2.4a.61.61 0 0 0-.72-.11l-3.05 1.63a11.6 11.6 0 0 0-2.36-1l-1-3.31a.61.61 0 0 0-.59-.41h-3.38a.61.61 0 0 0-.58.43l-1 3.3a11.6 11.6 0 0 0-2.38 1l-3-1.62a.61.61 0 0 0-.72.11L6.2 8.59a.61.61 0 0 0-.11.72l1.62 3a11.6 11.6 0 0 0-1 2.37l-3.31 1a.61.61 0 0 0-.43.58v3.38a.61.61 0 0 0 .43.58l3.33 1a11.6 11.6 0 0 0 1 2.33l-1.64 3.14a.61.61 0 0 0 .11.72l2.39 2.39a.61.61 0 0 0 .72.11l3.09-1.65a11.7 11.7 0 0 0 2.3.94l1 3.37a.61.61 0 0 0 .58.43h3.38a.61.61 0 0 0 .58-.43l1-3.38a11.6 11.6 0 0 0 2.28-.94l3.11 1.66a.61.61 0 0 0 .72-.11l2.39-2.39a.61.61 0 0 0 .11-.72l-1.66-3.1a11.6 11.6 0 0 0 .95-2.29l3.37-1a.61.61 0 0 0 .43-.58v-3.41a.61.61 0 0 0-.37-.59M18 23.5a5.5 5.5 0 1 1 5.5-5.5a5.5 5.5 0 0 1-5.5 5.5"
                                class="clr-i-solid clr-i-solid-path-1" />
                            <path fill="none" d="M0 0h36v36H0z" />
                        </x-dashboard.nav.item-group>
                        <!-- Settings -->
                    @endcan

                    @canany(['viewAny', 'create'], App\Models\Page::class)
                        <!-- Pages -->
                        <x-dashboard.nav.item-group
                            name="pages"
                            :children="[['add_pages', route('dashboard.pages.create'), Gate::allows('create', App\Models\Page::class)], ['view_pages', route('dashboard.pages.index'), Gate::allows('viewAny', App\Models\Page::class)]]">
                            <!-- mingcute:document-2-fill -->
                            <!-- Icon from MingCute Icon by MingCute Design - https://github.com/Richard9394/MingCute/blob/main/LICENSE -->
                            <g fill="none" fill-rule="evenodd">
                                <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor" d="M12 2v6.5a1.5 1.5 0 0 0 1.5 1.5H20v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm3 13H9a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2m-5-4H9a1 1 0 1 0 0 2h1a1 1 0 1 0 0-2m4-8.957a2 2 0 0 1 1 .543L19.414 7a2 2 0 0 1 .543 1H14Z" />
                            </g>
                        </x-dashboard.nav.item-group>
                        <!-- Pages -->
                    @endcanany

                    @can('viewAny', App\Models\Banner::class)
                        <!-- Banners -->
                        <x-dashboard.nav.item
                            name="banners"
                            :url="route('dashboard.banners.index')">
                            <!-- bxs:image -->
                            <!-- Icon from BoxIcons Solid by Atisa - https://creativecommons.org/licenses/by/4.0/ -->
                            <path fill="currentColor" d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2m-13.5 3a1.5 1.5 0 1 1 0 3a1.5 1.5 0 0 1 0-3m5.5 10h-7l4-5l1.5 2l3-4l5.5 7z" />
                        </x-dashboard.nav.item>
                        <!-- Banners -->
                    @endcan

                </ul>

            @endcanany

            @canany(['view users', 'create users'])

                <x-dashboard.nav.label name="users_management" />

                <ul class="mb-6 flex flex-col gap-4">

                    @canany(['viewAny', 'create'], App\Models\User::class)
                        <!-- Users -->
                        <x-dashboard.nav.item-group
                            name="users"
                            :children="[['add_users', route('dashboard.users.create'), Gate::allows('create', App\Models\User::class)], ['view_users', route('dashboard.users.index'), Gate::allows('viewAny', App\Models\User::class)]]">
                            <!-- mage:users-fill -->
                            <!-- Icon from Mage Icons by MageIcons - https://github.com/Mage-Icons/mage-icons/blob/main/License.txt -->
                            <path fill="currentColor" d="M21.987 18.73a2 2 0 0 1-.34.85a1.9 1.9 0 0 1-1.56.8h-1.651a.74.74 0 0 1-.6-.31a.76.76 0 0 1-.11-.67c.37-1.18.29-2.51-3.061-4.64a.77.77 0 0 1-.32-.85a.76.76 0 0 1 .72-.54a7.61 7.61 0 0 1 6.792 4.39a2 2 0 0 1 .13.97M19.486 7.7a4.43 4.43 0 0 1-4.421 4.42a.76.76 0 0 1-.65-1.13a6.16 6.16 0 0 0 0-6.53a.75.75 0 0 1 .61-1.18a4.3 4.3 0 0 1 3.13 1.34a4.46 4.46 0 0 1 1.291 3.12z" />
                            <path fill="currentColor" d="M16.675 18.7a2.65 2.65 0 0 1-1.26 2.48c-.418.257-.9.392-1.39.39H4.652a2.63 2.63 0 0 1-1.39-.39A2.62 2.62 0 0 1 2.01 18.7a2.6 2.6 0 0 1 .5-1.35a8.8 8.8 0 0 1 6.812-3.51a8.78 8.78 0 0 1 6.842 3.5a2.7 2.7 0 0 1 .51 1.36M14.245 7.32a4.92 4.92 0 0 1-4.902 4.91a4.903 4.903 0 0 1-4.797-5.858a4.9 4.9 0 0 1 6.678-3.57a4.9 4.9 0 0 1 3.03 4.518z" />
                        </x-dashboard.nav.item-group>
                        <!-- Users -->
                    @endcanany

                </ul>

            @endcanany

            @canany(['manage roles and permissions'])

                <x-dashboard.nav.label name="roles_management" />

                <ul class="mb-6 flex flex-col gap-4">

                    @can('manage roles and permissions')
                        <!-- Roles and Permissions -->
                        <x-dashboard.nav.item
                            name="roles_and_permissions"
                            :url="route('dashboard.roles.index')">
                            <!-- mdi:shield-account-variant -->
                            <!-- Icon from Material Design Icons by Pictogrammers - https://github.com/Templarian/MaterialDesign/blob/master/LICENSE -->
                            <path fill="currentColor" d="M17 11c.3 0 .7 0 1 .1V6.3L10.5 3L3 6.3v4.9c0 4.5 3.2 8.8 7.5 9.8c.6-.1 1.1-.3 1.6-.5c-.7-1-1.1-2.2-1.1-3.5c0-3.3 2.7-6 6-6m0 2c-2.2 0-4 1.8-4 4s1.8 4 4 4s4-1.8 4-4s-1.8-4-4-4m0 1.4c.6 0 1.1.5 1.1 1.1s-.5 1.1-1.1 1.1s-1.1-.5-1.1-1.1s.5-1.1 1.1-1.1m0 5.4c-.9 0-1.7-.5-2.2-1.2c.1-.7 1.5-1.1 2.2-1.1s2.2.4 2.2 1.1c-.5.7-1.3 1.2-2.2 1.2" />
                        </x-dashboard.nav.item>
                        <!-- Roles and Permissions -->
                    @endcan

                </ul>

            @endcanany

            @canany(['manage contact requests'])

                <x-dashboard.nav.label name="contact_requests" />

                <ul class="mb-6 flex flex-col gap-4">

                    @can('manage contact requests')
                        <!-- Contact Requests -->
                        <x-dashboard.nav.item
                            name="contact_requests"
                            :url="route('dashboard.contacts.index')"
                            viewBox="0 0 56 56">
                            <!-- f7:envelope-fill -->
                            <!-- Icon from Framework7 Icons by Vladimir Kharlampidi - https://github.com/framework7io/framework7-icons/blob/master/LICENSE -->
                            <path fill="currentColor" d="M28.047 30.707c.984 0 1.875-.445 2.883-1.477L51.32 9.05c-.867-.843-2.484-1.241-4.804-1.241H8.78c-1.969 0-3.351.375-4.125 1.148l20.508 20.274c1.008 1.007 1.922 1.476 2.883 1.476M2.71 44.418l16.57-16.383L2.664 11.652c-.352.657-.54 1.782-.54 3.399v25.875c0 1.664.212 2.836.587 3.492m50.625-.023c.351-.68.54-1.829.54-3.47V15.052c0-1.57-.165-2.696-.517-3.328L36.812 28.035ZM9.484 48.19h37.734c1.97 0 3.329-.375 4.102-1.125L34.445 30.332l-1.57 1.57c-1.594 1.547-3.117 2.25-4.828 2.25s-3.235-.703-4.828-2.25l-1.57-1.57L4.796 47.043c.89.773 2.46 1.148 4.687 1.148" />
                        </x-dashboard.nav.item>
                        <!-- Contact Requests -->
                    @endcan

                </ul>

            @endcanany

        </div>

    </nav>
</div>
