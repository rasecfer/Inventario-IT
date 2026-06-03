@props([
    'sidebar' => false,
])

@if ($sidebar)
    <flux:sidebar.brand name="{{ env('APP_NAME') }}">
        <x-slot name="logo"
            class="flex aspect-square size-12 items-center justify-center rounded-md bg-blue-200 text-blue-400">
            <x-app-logo-icon class="size-10 fill-current text-white dark:text-black" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="{{ env('APP_NAME') }}">
        <x-slot name="logo"
            class="flex aspect-square size-10 items-center justify-center rounded-md bg-blue-200 text-blue-400">
            <x-app-logo-icon class="size-8 fill-current text-white dark:text-black" />
        </x-slot>
    </flux:brand>
@endif
