<x-layouts.guest page="forgot_passwrod">

    @session('status')
        <x-dashboard.alerts.success class="mb-4" :message="$value" />
    @endsession

    <form
        x-data="{ loading: false }"
        x-on:submit="loading = true"
        action="{{ route('password.email') }}"
        method="POST">

        @csrf

        <div class="space-y-5">

            <!-- Email -->
            <x-dashboard.inputs.default
                name="email"
                type="email"
                placeholder="email@example.com"
                :required="true" />

            <!-- Submit button -->
            <x-dashboard.buttons.primary class="w-full" :name="__('auth.forgot_passwrod.button')" />

        </div>
    </form>

</x-layouts.guest>
