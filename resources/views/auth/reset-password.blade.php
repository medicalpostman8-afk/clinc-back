<x-layouts.guest page="reset_password">

    <form
        x-data="{ loading: false }"
        x-on:submit="loading = true"
        action="{{ route('password.store') }}"
        method="POST">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-5">

            <!-- Email -->
            <x-dashboard.inputs.default
                name="email"
                type="email"
                placeholder="email@example.com"
                :value="$request->email"
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
            <x-dashboard.buttons.primary class="w-full" :name="__('auth.reset_password.button')" />

        </div>
    </form>

</x-layouts.guest>
