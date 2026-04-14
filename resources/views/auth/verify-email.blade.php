<x-layouts.guest page="verify_email">

    @if (session('status') == 'verification-link-sent')
        <x-dashboard.alerts.success class="mb-6" :message="__('auth.verify_email.email_sent')" />
    @endif

    <div class="space-y-5">

        <form
            x-data="{ loading: false }"
            x-on:submit="loading = true"
            action="{{ route('verification.send') }}"
            method="POST">

            @csrf

            <x-dashboard.buttons.primary class="w-full" :name="__('auth.verify_email.button')" />

        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <x-dashboard.buttons.secondary class="w-full" :name="__('auth.logout')" />

        </form>

    </div>

</x-layouts.guest>
