<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

    <head>
        @include('partials.head')
    </head>

    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile"
            class="border-e border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-gray-800">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:separator />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>
                    Dashboard
                </flux:sidebar.item>
                <flux:sidebar.group expandable icon="inbox-stack" heading="Catálogos" class="grid"
                    :expanded="request()->is('catalogs/*')">
                    @can('view_department')
                        <flux:sidebar.item :href="route('departments')" :current="request()->routeIs('departments')"
                            wire:navigate>Departamentos</flux:sidebar.item>
                    @endcan
                    @can('view_employee')
                        <flux:sidebar.item :href="route('employees')" :current="request()->routeIs('employees*')"
                            wire:navigate>Empleados</flux:sidebar.item>
                    @endcan
                    @can('view_lease')
                        <flux:sidebar.item :href="route('leases')" :current="request()->routeIs('leases')" wire:navigate>
                            Arrendamientos</flux:sidebar.item>
                    @endcan
                    @can('view_brand')
                        <flux:sidebar.item :href="route('brands')" :current="request()->routeIs('brands')" wire:navigate>
                            Marcas</flux:sidebar.item>
                    @endcan
                    @can('view_model')
                        <flux:sidebar.item :href="route('models')" :current="request()->routeIs('models')" wire:navigate>
                            Modelos</flux:sidebar.item>
                    @endcan
                    @can('view_classification')
                        <flux:sidebar.item :href="route('classifications')"
                            :current="request()->routeIs('classifications')" wire:navigate>Clasificaciones
                        </flux:sidebar.item>
                    @endcan
                    @can('view_device')
                        <flux:sidebar.item :href="route('devices')" :current="request()->routeIs('devices*')"
                            wire:navigate>Equipos</flux:sidebar.item>
                    @endcan
                </flux:sidebar.group>

                <flux:sidebar.group expandable icon="cog-6-tooth" heading="Procesos" class="grid"
                    :expanded="request()->is('processes/*')">
                    @can('view_assignment')
                        <flux:sidebar.item :href="route('assignments')" :current="request()->routeIs('assignments*')"
                            wire:navigate>Asignación</flux:sidebar.item>
                    @endcan
                    @can('view_release')
                        <flux:sidebar.item :href="route('releases')" :current="request()->routeIs('releases*')"
                            wire:navigate>Liberación</flux:sidebar.item>
                    @endcan
                    @can('create_disposal')
                        <flux:sidebar.item :href="route('disposals')" :current="request()->routeIs('disposals*')"
                            wire:navigate>Baja de Equipo</flux:sidebar.item>
                    @endcan
                </flux:sidebar.group>

                <flux:sidebar.group expandable icon="document-chart-bar" heading="Reportes" class="grid"
                    :expanded="request()->is('reports/*')">
                    <flux:sidebar.item :href="route('listing')" :current="request()->routeIs('listing')"
                        wire:navigate>Listado de Equipos</flux:sidebar.item>
                </flux:sidebar.group>

                @role('admin')
                    <flux:sidebar.group expandable icon="lock-closed" heading="Seguridad" class="grid"
                        :expanded="request()->is('security/*')">
                        <flux:sidebar.item :href="route('users')" :current="request()->routeIs('users')" wire:navigate>
                            Usuarios</flux:sidebar.item>
                        <flux:sidebar.item :href="route('roles')" :current="request()->routeIs('roles')" wire:navigate>
                            Roles</flux:sidebar.item>
                        <flux:sidebar.item :href="route('permissions')" :current="request()->routeIs('permissions')">
                            Permisos</flux:sidebar.item>
                    </flux:sidebar.group>
                @endrole

                @can('edit_setup')
                    <flux:sidebar.item icon="cog" :href="route('settings')" :current="request()->routeIs('settings')"
                        wire:navigate>
                        Configuración
                    </flux:sidebar.item>
                @endcan
            </flux:sidebar.nav>

            <flux:spacer />

            <div class="flex items-center justify-center">
                <button id="themeToggle"
                    class="glass group cursor-pointer rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110">
                    <!-- Sun icon (light mode) -->
                    <svg id="sunIcon" class="hidden h-6 w-6 text-yellow-400 dark:block" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                    </svg>
                    <!-- Moon icon (dark mode) -->
                    <svg id="moonIcon" class="block h-6 w-6 text-slate-700 dark:hidden" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    {{-- <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group> --}}

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer" data-test="logout-button">
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group position="top end">
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts

        <script>
            (function() {
                // Dark mode toggle
                const themeToggle = document.getElementById('themeToggle');
                const html = document.documentElement;

                // Check for saved theme preference or default to dark
                if (localStorage.getItem('theme') === 'light') {
                    html.classList.remove('dark');
                } else {
                    html.classList.add('dark');
                }

                themeToggle.addEventListener('click', () => {
                    html.classList.toggle('dark');
                    localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
                });
            })();
        </script>
    </body>

</html>
