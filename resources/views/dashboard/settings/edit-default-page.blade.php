<x-layouts.dashboard :page="$page->tag">

    <x-dashboard.breadcrumb :page="__('ui.' . $page->tag)" />

    @session('status')
        <div class="mb-5">
            <x-dashboard.alerts.success :title="$value" />
        </div>
    @endsession

    <div class="relative overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] overflow-x-auto">
        <form
            x-data="{ loading: false }"
            x-on:submit="loading = true"
            method="POST"
            action="{{ route('dashboard.settings.update_default_page', ['page' => $page->id]) }}"
            class="p-4 grid grid-cols-1 md:grid-cols-2 gap-5">

            @method('PUT')
            @csrf

            <!-- Name ar -->
            <x-dashboard.inputs.default
                name="name"
                locale="ar"
                :value="old('name.ar', $page->getTranslation('name', 'ar'))"
                id="page-name-ar"
                :required="true" />

            <!-- Name en -->
            <x-dashboard.inputs.default
                name="name"
                locale="en"
                :value="old('name.en', $page->getTranslation('name', 'en'))"
                id="page-name-en"
                :required="true" />

            <!-- Body ar -->
            <div>
                <x-dashboard.label name="body" locale="ar" :required="true" />
                <textarea name="body[ar]" class="ck-editor">{!! $page->getTranslation('body', 'ar') !!}</textarea>
                @error('body.ar')
                    <x-dashboard.inputs.error :message="$message" />
                @enderror
            </div>

            <!-- Body en -->
            <div>
                <x-dashboard.label name="body" locale="en" :required="true" />
                <textarea name="body[en]" class="ck-editor" locale="en">{!! $page->getTranslation('body', 'en') !!}</textarea>
                @error('body.en')
                    <x-dashboard.inputs.error :message="$message" />
                @enderror
            </div>

            <!-- Submit button -->
            <x-dashboard.buttons.primary :name="__('ui.update')" />

        </form>
    </div>

    @vite(['resources/css/ckeditor.css', 'resources/js/ckeditor.js'])

</x-layouts.dashboard>
