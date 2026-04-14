<form
    x-data="{ loading: false }"
    x-on:submit="loading = true"
    method="POST"
    action="{{ route('dashboard.settings.update_landing_page') }}"
    enctype="multipart/form-data"
    class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl">

    @method('PUT')
    @csrf

    <!-- Welcome message title ar -->
    <x-dashboard.inputs.default
        name="welcome_message_title"
        locale="ar"
        :value="old('welcome_message_title.ar', $settings->getTranslation('landing_page', 'ar')['welcome_message_title'] ?? '')"
        id="landing-page-welcome-message-title-ar"
        :required="true" />

    <!-- Welcome message title en -->
    <x-dashboard.inputs.default
        name="welcome_message_title"
        locale="en"
        :value="old('welcome_message_title.en', $settings->getTranslation('landing_page', 'en')['welcome_message_title'] ?? '')"
        id="landing-page-welcome-message-title-en"
        :required="true" />

    <!-- Welcome message ar -->
    <x-dashboard.inputs.default
        name="welcome_message"
        locale="ar"
        :value="old('welcome_message.ar', $settings->getTranslation('landing_page', 'ar')['welcome_message'] ?? '')"
        id="landing-page-welcome-message-ar"
        :required="true" />

    <!-- Welcome message en -->
    <x-dashboard.inputs.default
        name="welcome_message"
        locale="en"
        :value="old('welcome_message.en', $settings->getTranslation('landing_page', 'en')['welcome_message'] ?? '')"
        id="landing-page-welcome-message-en"
        :required="true" />

    <!-- Welcome message description ar -->
    <x-dashboard.inputs.textarea
        name="welcome_message_description"
        locale="ar"
        :value="old('welcome_message_description.ar', $settings->getTranslation('landing_page', 'ar')['welcome_message_description'] ?? '')"
        id="landing-page-welcome-message-description-ar"
        rows="4"
        :required="true" />

    <!-- Welcome message description en -->
    <x-dashboard.inputs.textarea
        name="welcome_message_description"
        locale="en"
        :value="old('welcome_message_description.en', $settings->getTranslation('landing_page', 'en')['welcome_message_description'] ?? '')"
        id="landing-page-welcome-message-description-en"
        rows="4"
        :required="true" />

    <!-- Submit button -->
    <div class="col-span-full">
        <x-dashboard.buttons.primary :name="__('ui.update')" />
    </div>

</form>
