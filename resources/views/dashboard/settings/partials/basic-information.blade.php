<form
    x-data="{ loading: false }"
    x-on:submit="loading = true"
    method="POST"
    action="{{ route('dashboard.settings.update_basic_information') }}"
    enctype="multipart/form-data"
    class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl">

    @method('PUT')
    @csrf

    <div class="col-span-full w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
        <!-- Icon -->
        <div>
            <x-dashboard.inputs.file.single-image
                class="w-32"
                preview-class="w-32 h-32"
                id="icon"
                name="icon"
                :image-url="$iconUrl"
                accept=".webp, .png, .jpg, .jpeg" />
        </div>

        <!-- Logo (Light mode) -->
        <div>
            <x-dashboard.inputs.file.single-image
                class="w-48"
                preview-class="w-48 asspect-video"
                id="logo-light-mode"
                name="light_mode_logo"
                :image-url="$lightModeLogoUrl"
                accept=".webp, .png, .jpg, .jpeg" />
        </div>

        <!-- Logo (Dark mode) -->
        <div>
            <x-dashboard.inputs.file.single-image
                class="w-48"
                preview-class="w-48 asspect-video"
                id="logo-dark-mode"
                name="dark_mode_logo"
                :image-url="$darkModeLogoUrl"
                accept=".webp, .png, .jpg, .jpeg" />
        </div>
    </div>

    <!-- Name ar -->
    <x-dashboard.inputs.default
        name="name"
        locale="ar"
        :value="old('name.ar', $settings->getTranslation('name', 'ar'))"
        id="basic-information-name-ar"
        :required="true" />

    <!-- Name en -->
    <x-dashboard.inputs.default
        name="name"
        locale="en"
        :value="old('name.en', $settings->getTranslation('name', 'en'))"
        id="basic-information-name-en"
        :required="true" />

    <!-- Description ar -->
    <x-dashboard.inputs.textarea
        name="description"
        locale="ar"
        :value="old('description.ar', $settings->getTranslation('description', 'ar'))"
        id="basic-information-description-ar"
        rows="4"
        :required="true" />

    <!-- Description en -->
    <x-dashboard.inputs.textarea
        name="description"
        locale="en"
        :value="old('description.en', $settings->getTranslation('description', 'en'))"
        id="basic-information-description-en"
        rows="4"
        :required="true" />

    <!-- Address ar -->
    <x-dashboard.inputs.default
        name="address"
        locale="ar"
        :value="old('address.ar', $settings->getTranslation('address', 'ar'))"
        id="basic-information-address-ar"
        :required="true" />

    <!-- Address en -->
    <x-dashboard.inputs.default
        name="address"
        locale="en"
        :value="old('address.en', $settings->getTranslation('address', 'en'))"
        id="basic-information-address-en"
        :required="true" />

    <!-- Email -->
    <x-dashboard.inputs.default
        name="email"
        type="email"
        :value="old('email', $settings->email)"
        id="basic-information-email"
        :required="true" />

    <!-- Phone -->
    <x-dashboard.inputs.default
        name="phone"
        :value="old('phone', $settings->phone)"
        id="basic-information-phone"
        :required="true" />

    <!-- Keywords ar -->
    <x-dashboard.inputs.default
        name="keywords"
        locale="ar"
        id="basic-information-keywords-ar"
        :value="old('keywords.ar', $settings->getTranslation('keywords', 'ar'))"
        :description="__('ui.keywords_description')"
        :required="true" />

    <!-- Keywords en -->
    <x-dashboard.inputs.default
        name="keywords"
        locale="en"
        id="basic-information-keywords-en"
        :value="old('keywords.en', $settings->getTranslation('keywords', 'en'))"
        :description="__('ui.keywords_description')"
        :required="true" />

    <!-- Submit button -->
    <div class="col-span-full">
        <x-dashboard.buttons.primary :name="__('ui.update')" />
    </div>

</form>
