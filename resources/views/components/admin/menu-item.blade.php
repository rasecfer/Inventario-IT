@props(['label', 'route', 'icon' => null])

<a href="{{ route($route) }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg transition dark:text-gray-200
          {{ request()->routeIs($route) ? 'bg-primary-50 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">

    @if ($icon)
        <x-wireui-icon :name="$icon" class="w-5 h-5" />
    @endif

    <span>{{ $label }}</span>
</a>
