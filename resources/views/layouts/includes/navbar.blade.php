<header
    class="h-16
               bg-white/60 dark:bg-slate-800/60
               backdrop-blur-xl
               rounded-2xl
               shadow-lg
               border border-white/30
               dark:border-slate-700
               px-6 flex items-center justify-between">

    <!-- Left -->
    <div class="font-semibold text-lg text-gray-900 dark:text-gray-200">
        - Sistema de Inventario de Hardware -
    </div>

    <!-- Right -->
    <div class="flex items-center gap-4">

        <!-- Dark Mode Toggle -->
        <button @click="toggleDark()"
            class="p-2 rounded-xl
                        text-gray-900
                        dark:text-gray-200
                       hover:bg-indigo-100
                       dark:hover:bg-slate-700/50
                       transition">
            <x-wireui-icon name="moon" x-show="!dark" />
            <x-wireui-icon name="sun" x-show="dark" />
        </button>

        <!-- Notifications -->
        <button
            class="relative p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700/50 text-gray-900 dark:text-gray-200">
            <x-wireui-icon name="bell" />
            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- Profile Dropdown (WireUI) -->
        <x-wireui-dropdown>
            <x-slot name="trigger">
                <button class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name=Admin" class="w-8 h-8 rounded-full">
                    <span class="hidden md:block text-gray-700 dark:text-gray-200">
                        Admin
                    </span>
                </button>
            </x-slot>

            <x-wireui-dropdown.item label="Profile" />
            <x-wireui-dropdown.item label="Settings" />
            <x-wireui-dropdown.item label="Logout" />
        </x-wireui-dropdown>

    </div>
</header>
