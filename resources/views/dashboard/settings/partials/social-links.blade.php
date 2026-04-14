<form
    x-data="{ loading: false }"
    x-on:submit="loading = true"
    method="POST"
    action="{{ route('dashboard.settings.update_social_links') }}"
    enctype="multipart/form-data"
    class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5">

    @method('PUT')
    @csrf

    <!-- Facebook URL -->
    <x-dashboard.inputs.default
        name="facebook_url"
        :value="old('facebook_url', $settings->facebook_url)"
        type="url"
        id="social-links-facebook-url" />

    <!-- Twitter URL -->
    <x-dashboard.inputs.default
        name="twitter_url"
        :value="old('twitter_url', $settings->twitter_url)"
        type="url"
        id="social-links-twitter-url" />

    <!-- Instagram URL -->
    <x-dashboard.inputs.default
        name="instagram_url"
        :value="old('instagram_url', $settings->instagram_url)"
        type="url"
        id="social-links-istagram-url" />

    <!-- Submit button -->
    <div class="col-span-full">
        <x-dashboard.buttons.primary :name="__('ui.update')" />
    </div>

</form>
