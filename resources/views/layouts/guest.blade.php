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

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    @livewireScripts
    <script>
        function themeHandler() {
            return {
                dark: false,

                init() {
                    if (
                        localStorage.theme === 'dark' ||
                        (!localStorage.theme &&
                            window.matchMedia('(prefers-color-scheme: dark)').matches)
                    ) {
                        this.dark = true
                    }
                },

                toggle() {
                    this.dark = !this.dark
                    localStorage.theme = this.dark ? 'dark' : 'light'
                }
            }
        }
    </script>

</body>

</html>
