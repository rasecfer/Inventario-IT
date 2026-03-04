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
            <div class="flex items-center justify-center">
                <div>
                    <h1 class="text-2xl font-bold text-white dark:text-gray-100">
                        Sistema de Inventario IT
                    </h1>
                </div>
            </div>
            <div class="mb-4 text-sm text-gray-800 dark:text-gray-300">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <x-wireui-input label="Correo-e" type="email" name="email" required autofocus :value="old('email')"
                    placeholder="admin@correo.com" icon="envelope" />

                <div class="flex items-center justify-end mt-4">
                    <x-wireui-button type="submit" primary
                        class="w-full py-3 text-lg font-semibold
                        bg-slate-700 text-gray-200
                        hover:bg-gray-900
                        dark:bg-indigo-600 dark:text-white
                        dark:hover:bg-indigo-500
                        transition duration-300 rounded-xl shadow-lg">
                        {{ __('Email Password Reset Link') }}
                    </x-wireui-button>

                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
