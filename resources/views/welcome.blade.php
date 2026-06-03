<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Welcome') }} - {{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }

            ::-webkit-scrollbar-track {
                background: transparent;
            }

            ::-webkit-scrollbar-thumb {
                background: #3b82f6;
                border-radius: 3px;
            }

            /* Glassmorphism effect */
            .glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .dark .glass {
                background: rgba(17, 24, 39, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Animated gradient background */
            .animated-gradient {
                background: linear-gradient(-45deg, #3b82f6, #8b5cf6, #06b6d4, #3b82f6);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }

            .dark .animated-gradient {
                background: linear-gradient(-45deg, #1e3a8a, #581c87, #164e63, #1e3a8a);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }

            @keyframes gradient {
                0% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }

                100% {
                    background-position: 0% 50%;
                }
            }

            /* Toggle switch animation */
            .toggle-checkbox:checked {
                right: 0;
                border-color: #3b82f6;
            }

            .toggle-checkbox:checked+.toggle-label {
                background-color: #3b82f6;
            }

            /* Input focus ring animation */
            .input-glow:focus {
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4);
            }
        </style>
    </head>

    <body class="animated-gradient min-h-screen transition-colors duration-500">

        <!-- Dark Mode Toggle -->
        <div class="fixed right-6 top-6 z-50">
            <button id="themeToggle"
                class="glass group rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110">
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

        <!-- Main Container -->
        <div class="flex min-h-screen flex-col items-center justify-center gap-8 p-4 lg:flex-row lg:p-8">

            <!-- Left Side - Branding & Illustration -->
            <div class="animate-fade-in w-full max-w-xl lg:w-1/2">
                <div class="glass rounded-3xl p-8 text-center shadow-2xl lg:p-12 lg:text-left">
                    <!-- Fancy SVG Logo -->
                    <div class="mb-8 flex justify-center lg:justify-start">
                        <svg width="120" height="120" viewBox="0 0 120 120" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="drop-shadow-2xl">
                            <!-- Outer glow circle -->
                            <circle cx="60" cy="60" r="58" stroke="url(#logoGradient)" stroke-width="3"
                                fill="none" class="animate-pulse-slow" />

                            <!-- Server rack background -->
                            <rect x="35" y="30" width="50" height="60" rx="4" fill="url(#logoGradient)"
                                opacity="0.2" />
                            <rect x="35" y="30" width="50" height="60" rx="4" stroke="url(#logoGradient)"
                                stroke-width="2" fill="none" />

                            <!-- Server blades -->
                            <rect x="40" y="36" width="40" height="12" rx="2" fill="url(#logoGradient)"
                                opacity="0.6" />
                            <circle cx="46" cy="42" r="2" fill="#ffffff" />
                            <circle cx="54" cy="42" r="2" fill="#10b981" />
                            <rect x="60" y="40" width="16" height="4" rx="1" fill="#ffffff"
                                opacity="0.8" />

                            <rect x="40" y="54" width="40" height="12" rx="2" fill="url(#logoGradient)"
                                opacity="0.6" />
                            <circle cx="46" cy="60" r="2" fill="#ffffff" />
                            <circle cx="54" cy="60" r="2" fill="#f59e0b" />
                            <rect x="60" y="58" width="16" height="4" rx="1" fill="#ffffff"
                                opacity="0.8" />

                            <rect x="40" y="72" width="40" height="12" rx="2" fill="url(#logoGradient)"
                                opacity="0.6" />
                            <circle cx="46" cy="78" r="2" fill="#ffffff" />
                            <circle cx="54" cy="78" r="2" fill="#3b82f6" />
                            <rect x="60" y="76" width="16" height="4" rx="1" fill="#ffffff"
                                opacity="0.8" />

                            <!-- Network connection lines -->
                            <path d="M35 52 L25 52 L25 80 L35 80" stroke="url(#logoGradient)" stroke-width="2"
                                fill="none" opacity="0.5" />
                            <circle cx="25" cy="52" r="3" fill="url(#logoGradient)" />
                            <circle cx="25" cy="80" r="3" fill="url(#logoGradient)" />

                            <!-- WiFi/Network waves -->
                            <path d="M90 45 C95 40 100 42 105 48" stroke="url(#logoGradient)" stroke-width="2"
                                fill="none" opacity="0.7" />
                            <path d="M92 50 C96 46 100 48 104 54" stroke="url(#logoGradient)" stroke-width="2"
                                fill="none" opacity="0.9" />
                            <path d="M94 55 C97 52 100 54 103 60" stroke="url(#logoGradient)" stroke-width="2"
                                fill="none" />

                            <!-- Gradients -->
                            <defs>
                                <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%"
                                    y2="100%">
                                    <stop offset="0%" stop-color="#3b82f6" />
                                    <stop offset="50%" stop-color="#8b5cf6" />
                                    <stop offset="100%" stop-color="#06b6d4" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>

                    <!-- Company Name & Tagline -->
                    <h1 class="mb-3 text-3xl font-bold tracking-tight text-white lg:text-4xl dark:text-white">
                        <span
                            class="bg-linear-to-r from-blue-300 via-purple-300 to-cyan-300 bg-clip-text text-transparent">
                            Intentario IT
                        </span>

                    </h1>
                    <p class="mb-8 text-lg text-blue-100/80 dark:text-slate-300">
                        Inventario de Hardware TI
                    </p>

                    <!-- Feature highlights -->
                    <div class="mx-auto max-w-md space-y-4 text-left lg:mx-0">
                        <div
                            class="flex items-center gap-3 rounded-xl bg-white/10 p-3 transition-colors hover:bg-white/20">
                            <div
                                class="bg-linear-to-br flex h-10 w-10 shrink-0 items-center justify-center rounded-lg from-blue-400 to-blue-600">
                                <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">Registro de Inventario</p>
                                <p class="text-sm text-blue-100/60">Mantenga su inventario al día</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-3 rounded-xl bg-white/10 p-3 transition-colors hover:bg-white/20">
                            <div
                                class="bg-linear-to-br flex h-10 w-10 shrink-0 items-center justify-center rounded-lg from-purple-400 to-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-5 w-5 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">Asignación y Liberación</p>
                                <p class="text-sm text-blue-100/60">Sepa quién tiene cada dispositivo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="animate-slide-up w-full max-w-md lg:w-1/2">
                <div
                    class="rounded-3xl bg-white p-8 shadow-2xl transition-colors duration-500 lg:p-10 dark:bg-slate-800">
                    <div class="mb-8">
                        <h2 class="mb-2 text-3xl font-bold text-slate-800 dark:text-white">Bienvenido</h2>
                        <p class="text-slate-500 dark:text-slate-400">Ingrese al sistema</p>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('login.store') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="w-full rounded-xl border-2 border-red-800 bg-red-200 p-4 text-red-700">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label
                                class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Correo-e
                            </label>
                            <input type="email" placeholder="admin@inventario.com" name="email"
                                :value="old('email')"
                                class="input-glow focus:border-primary-500 dark:focus:border-primary-400 w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-800 placeholder-slate-400 transition-all duration-300 focus:outline-none dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-500"
                                required>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label
                                    class="flex items-center gap-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Contraseña
                                </label>
                            </div>
                            <div class="relative">
                                <input id="passwordInput" type="password" name="password" placeholder="*******"
                                    class="input-glow focus:border-primary-500 dark:focus:border-primary-400 w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 pr-12 text-slate-800 placeholder-slate-400 transition-all duration-300 focus:outline-none dark:border-slate-600 dark:bg-slate-700 dark:text-white dark:placeholder-slate-500"
                                    required>
                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 transition-colors hover:text-slate-600 dark:hover:text-slate-300">
                                    <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eyeOffIcon" class="hidden h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center gap-3">
                            <input id="remember" type="checkbox" name="remember"
                                class="text-primary-600 focus:ring-primary-500 h-5 w-5 cursor-pointer rounded border-slate-300 bg-slate-50 dark:border-slate-600 dark:bg-slate-700">
                            <label for="remember"
                                class="cursor-pointer select-none text-sm text-slate-600 dark:text-slate-400">Recordarme</label>
                        </div>

                        <!-- Login Button -->
                        <button type="submit"
                            class="bg-linear-to-r group flex w-full transform cursor-pointer items-center justify-center gap-2 rounded-xl from-blue-400 to-blue-600 px-6 py-3.5 font-semibold text-white shadow-lg transition-all duration-300 hover:-translate-y-0.5 hover:from-blue-600 hover:to-blue-800 hover:shadow-xl">
                            <span>Ingresar</span>
                            <svg class="h-5 w-5 transform transition-transform group-hover:translate-x-1"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>

                    </form>
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center text-sm text-slate-400 dark:text-slate-500">
                    <p>&copy; 2026 Fernando Moreno</p>
                </div>
            </div>
        </div>

        <script>
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

            // Password visibility toggle
            function togglePassword() {
                const passwordInput = document.getElementById('passwordInput');
                const eyeIcon = document.getElementById('eyeIcon');
                const eyeOffIcon = document.getElementById('eyeOffIcon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeOffIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeOffIcon.classList.add('hidden');
                }
            }
        </script>
    </body>

</html>
