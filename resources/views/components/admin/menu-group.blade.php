@props(['label', 'icon' => null])

<div x-data="{ open: false }">

    <button @click="open = !open"
        class="w-full flex items-center justify-between px-3 py-2 rounded-lg
               hover:bg-gray-100 dark:hover:bg-gray-700 transition dark:text-gray-200">

        <div class="flex items-center gap-3">
            @if ($icon)
                <x-wireui-icon :name="$icon" class="w-5 h-5" />
            @endif

            <span>{{ $label }}</span>
        </div>

        <x-wireui-icon name="chevron-down" class="w-4 h-4 ml-2" />
    </button>

    <div x-show="open" x-collapse class="ml-6 mt-1 space-y-1">
        {{ $slot }}
    </div>

</div>
