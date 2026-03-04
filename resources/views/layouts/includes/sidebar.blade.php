<aside x-data="{ open: true }" :class="open ? 'w-64' : 'w-25'"
    class="transition-all duration-300
              bg-white/70 dark:bg-slate-800/70
              backdrop-blur-xl
              rounded-2xl
              shadow-2xl
              border border-white/30
              dark:border-slate-700
              flex flex-col p-4">

    <!-- Logo -->
    <div class="flex items-center justify-between mb-6">
        <span x-show="open" class="font-bold text-lg text-indigo-600">
            IT Inventory
        </span>

        <button @click="open = !open"
            class="p-2 rounded-lg text-gray-900 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-slate-700/50"
            :class="open ? '' : 'ml-4'">
            <x-wireui-icon name="bars-4" />
        </button>
    </div>

    <!-- Menu -->
    <nav class="flex-1 p-4 space-y-2 text-gray-900 dark:text-gray-200">

        <a href="#"
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700 transition {{ request()->is('dashboard') ? 'bg-indigo-100 dark:bg-slate-700' : '' }}">
            <x-wireui-icon name="home" class="w-5 h-5" />
            <span x-show="open">Dashboard</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
            <x-wireui-icon name="server" class="w-5 h-5" />
            <span x-show="open">Hardware Assets</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
            <x-wireui-icon name="users" class="w-5 h-5" />
            <span x-show="open">Employees</span>
        </a>

        <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
            <x-wireui-icon name="clipboard-document-list" class="w-5 h-5" />
            <span x-show="open">Reports</span>
        </a>

    </nav>

</aside>
