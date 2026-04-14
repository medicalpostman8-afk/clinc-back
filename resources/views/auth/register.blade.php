<x-layouts.guest page="register">

    <form
        x-data="{ loading: false }"
        x-on:submit="loading = true"
        action="{{ route('register') }}"
        method="POST">

        @csrf

        <div class="space-y-5">

            <!-- Name -->
            <x-dashboard.inputs.default
                name="name"
                :required="true" />

            <!-- Email -->
            <x-dashboard.inputs.default
                name="email"
                type="email"
                placeholder="email@example.com"
                :required="true" />

            <!-- Password -->
            <x-dashboard.inputs.password
                name="password"
                :required="true" />

            <!-- Password Confirmation -->
            <x-dashboard.inputs.password
                name="password_confirmation"
                :required="true" />

            <!-- Submit button -->
            <x-dashboard.buttons.primary class="w-full" :name="__('auth.register.button')" />

        </div>
    </form>

    <div class="mt-5">
        <p class="text-sm font-normal text-center text-gray-700 dark:text-gray-400 sm:text-start">
            {{ __('auth.register.already_have_account') }}
            <a href="{{ route('login') }}" class="text-brand-500 hover:text-brand-600 dark:text-brand-400">{{ __('auth.login.title') }}</a>
        </p>
    </div>

</x-layouts.guest>
