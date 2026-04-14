{{-- resources/views/components/dashboard/tables/buttons/toggle-active.blade.php --}}
<div>
    <button wire:click.prevent="toggleActive({{ $row->id }})"
        class="w-8 h-8 flex items-center justify-center
            {{ $row->is_active ? 'text-green-400 bg-green-50 dark:bg-green-200/10 hover:bg-green-100 dark:hover:bg-green-400/10' : 'text-red-400 bg-red-50 dark:bg-red-200/10 hover:bg-red-100 dark:hover:bg-red-400/10' }}
            shadow-theme-xs gap-2 rounded-lg text-sm font-medium transition"
        type="button"
        title="{{ $row->is_active ? 'تعطيل المستخدم' : 'تفعيل المستخدم' }}">
        {{-- ic:round-remove-red-eye أو ic:round-visibility-off حسب الحالة --}}
        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
            @if ($row->is_active)
                <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5m0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3" />
            @else
                <path fill="currentColor" d="M12 6c3.31 0 6.15 2.01 7.41 5c-.52 1.24-1.34 2.33-2.41 3.13l1.43 1.43c1.4-1.07 2.53-2.52 3.26-4.21C20.27 7.61 17 4.5 12 4.5c-.85 0-1.67.1-2.46.29l1.54 1.54c.3-.06.61-.09.92-.09m0 12c-.85 0-1.67-.1-2.46-.29l1.54-1.54c.3.06.61.09.92.09c2.76 0 5-2.24 5-5c0-.31-.03-.62-.09-.92l1.54-1.54c.19.79.29 1.61.29 2.46c0 5-3.27 8.11-8.27 8.11M2.39 1.73L1.11 3l4.68 4.68C3.84 9.13 2.59 10.47 1.84 12c.73 1.69 1.86 3.14 3.26 4.21l1.43-1.43c-1.07-.8-1.89-1.89-2.41-3.13c1.26-2.99 4.1-5 7.41-5c.31 0 .62.03.92.09l1.45-1.45l3.86 3.86l-1.45 1.45l-3.86-3.86L2.39 1.73Z" />
            @endif
        </svg>
    </button>
</div>
