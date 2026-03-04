<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center
        bg-gradient-to-br from-gray-500 via-slate-500 to-gray-200
        dark:from-gray-900 dark:via-gray-800 dark:to-gray-900
        transition duration-500">

        <!-- Glass Card -->
        <div
            class="w-full max-w-md p-8 space-y-6
            backdrop-blur-xl bg-white/20 dark:bg-gray-900/60
            border border-white/30 dark:border-gray-700
            shadow-2xl rounded-2xl">

            <!-- Header -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white dark:text-gray-100">
                        Sistema de Inventario IT
                    </h1>
                    <p class="text-sm text-gray-200 dark:text-gray-400">
                        Acceso Seguro al Portal
                    </p>
                </div>

                <!-- Alpine Dark Mode Toggle -->
                <button @click="toggle()"
                    class="relative inline-flex items-center h-8 w-14
                           rounded-full bg-white/30 dark:bg-indigo-600
                           transition-all duration-300 focus:outline-none">

                    <!-- Toggle Circle -->
                    <span
                        class="absolute left-1 top-1 h-6 w-6 rounded-full
                               bg-gray-700 shadow-md transform transition-all duration-300 dark:translate-x-6 dark:bg-gray-700">
                    </span>

                    <!-- Icons -->
                    <span class="absolute left-2 text-xs" x-show="!dark">☀️</span>
                    <span class="absolute right-2 text-xs" x-show="dark">🌙</span>
                </button>
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <x-wireui-input label="Correo-e" type="email" name="email" wire:model.defer="email" required
                    autofocus placeholder="admin@correo.com" icon="envelope" />

                <!-- Password -->
                <x-wireui-password label="Contraseña" name="password" wire:model.defer="password" required
                    autocomplete="current-password" placeholder="••••••••" icon="lock-closed" />

                <!-- Remember -->
                <div class="flex items-center justify-between">
                    <x-wireui-checkbox id="remember_me" name="remember" label="Recordarme" />

                    @if (Route::has('password.request'))
                        <a class="text-sm text-white hover:underline" href="{{ route('password.request') }}">
                            Olvidó su Contrase&ntilde;a?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <x-wireui-button type="submit" primary
                    class="w-full py-3 text-lg font-semibold
                        bg-slate-700 text-gray-200
                        hover:bg-gray-900
                        dark:bg-indigo-600 dark:text-white
                        dark:hover:bg-indigo-500
                        transition duration-300 rounded-xl shadow-lg">
                    Acceso
                </x-wireui-button>
            </form>

            <!-- Footer -->
            <div class="text-center text-xs text-gray-200 dark:text-gray-500">
                © {{ date('Y') }} Equipo IT - Sistema de Inventario
            </div>

        </div>
    </div>
</x-guest-layout>
