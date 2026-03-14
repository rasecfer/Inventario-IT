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
            Inventario IT
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
            class="flex items-center gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700 transition {{ request()->is('dashboard') ? 'bg-indigo-100 dark:bg-slate-700' : '' }}">
            <x-wireui-icon name="home" class="w-5 h-5" />
            <span x-show="open">Dashboard</span>
        </a>

        <div x-data="{ openMnu: false }">
            <a href="#" @click="openMnu = !openMnu"
                class="flex justify-between items-center gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
                <div class="flex">
                    <x-wireui-icon name="clipboard-document-list" class="w-5 h-5" />
                    <span x-show="open" class="pl-2">Catálogos</span>
                </div>
                <x-wireui-icon x-show="!openMnu" name="chevron-down" class="w-5 h-5" />
                <x-wireui-icon x-show="openMnu" name="chevron-up" class="w-5 h-5" />
            </a>

            <!-- Collapsible Menu Content -->
            <div x-show="openMnu" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="px-4 pb-4">
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    1</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    2</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    3</a>
            </div>
        </div>

        <div x-data="{ openMnu: false }">
            <a href="#" @click="openMnu = !openMnu"
                class="flex justify-between items-center gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
                <div class="flex">
                    <x-wireui-icon name="arrow-path" class="w-5 h-5" />
                    <span x-show="open" class="pl-2">Procesos</span>
                </div>
                <x-wireui-icon x-show="!openMnu" name="chevron-down" class="w-5 h-5" />
                <x-wireui-icon x-show="openMnu" name="chevron-up" class="w-5 h-5" />
            </a>

            <!-- Collapsible Menu Content -->
            <div x-show="openMnu" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="px-4 pb-4">
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    1</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    2</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    3</a>
            </div>
        </div>

        <div x-data="{ openMnu: false }">
            <a href="#" @click="openMnu = !openMnu"
                class="flex justify-between items-center gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
                <div class="flex">
                    <x-wireui-icon name="document-chart-bar" class="w-5 h-5" />
                    <span x-show="open" class="pl-2">Reportes</span>
                </div>
                <x-wireui-icon x-show="!openMnu" name="chevron-down" class="w-5 h-5" />
                <x-wireui-icon x-show="openMnu" name="chevron-up" class="w-5 h-5" />
            </a>

            <!-- Collapsible Menu Content -->
            <div x-show="openMnu" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="px-4 pb-4">
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    1</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    2</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    3</a>
            </div>
        </div>

        <div x-data="{ openMnu: false }">
            <a href="#" @click="openMnu = !openMnu"
                class="flex justify-between items-center gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
                <div class="flex">
                    <x-wireui-icon name="lock-closed" class="w-5 h-5" />
                    <span x-show="open" class="pl-2">Seguridad</span>
                </div>
                <x-wireui-icon x-show="!openMnu" name="chevron-down" class="w-5 h-5" />
                <x-wireui-icon x-show="openMnu" name="chevron-up" class="w-5 h-5" />
            </a>

            <!-- Collapsible Menu Content -->
            <div x-show="openMnu" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="px-4 pb-4">
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    1</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    2</a>
                <a href="#" class="block gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">Item
                    3</a>
            </div>
        </div>

        <a href="#" class="flex items-center gap-2 p-2 rounded-lg hover:bg-indigo-100 dark:hover:bg-slate-700">
            <x-wireui-icon name="cog-6-tooth" class="w-5 h-5" />
            <span x-show="open">Configuración</span>
        </a>

    </nav>

</aside>
