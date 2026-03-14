<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeHandler()" x-init="init()"
    :class="{ 'dark': dark }" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- WireUI -->
    <wireui:scripts />

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/4519e5776d.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body
    class="bg-gradient-to-br from-gray-100 to-gray-300
             dark:from-slate-600 dark:to-slate-950
             transition-all duration-500">
    <div class="flex h-screen overflow-hidden p-4 gap-4">
        <!-- Overlay móvil -->
        {{-- <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/50 z-30 lg:hidden" @click="open = false">
        </div> --}}
        @include('layouts.includes.sidebar')
        <!-- CONTENIDO -->
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.includes.navbar')

            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>


    @livewireScripts
    <script>
        function themeHandler() {
            return {
                dark: false,

                init() {

                    if (!localStorage.dark || (localStorage.dark === 'true' &&
                            window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                        this.dark = true
                        localStorage.setItem('dark', this.dark)
                    }
                },

                toggleDark() {
                    this.dark = !this.dark
                    localStorage.setItem('dark', this.dark)
                }
            }
        }

        function openDrawer() {
            this.drawer = !this.drawer

        }
    </script>
</body>

</html>
