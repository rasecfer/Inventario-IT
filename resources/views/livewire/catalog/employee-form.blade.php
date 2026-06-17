<div>
    {{-- Header --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $isEditing ? 'Editar ' : 'Nuevo ' }}Empleado</h1>
                    <p class="mt-1 text-green-100"></p>
                </div>
                <div>
                    <a href="/catalogs/employees"
                        class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-slate-600 px-8 py-3 font-bold text-white hover:bg-slate-800 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div
        class="mt-6 grid grid-cols-1 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">

        {{-- Body --}}
        <form wire:submit="save" class="space-y-2">
            <div class="flex items-center justify-end">
                <div class="mr-4 flex items-center justify-end">
                    <label class="relative flex cursor-pointer items-center rounded-full p-3" for="is_active"
                        data-ripple-dark="true">
                        <input id="is_active" type="checkbox" name="is_active" wire:model="is_active"
                            class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all before:absolute before:left-2/4 before:top-2/4 before:block before:h-12 before:w-12 before:-translate-x-2/4 before:-translate-y-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-purple-500 checked:bg-purple-800 checked:before:bg-slate-400 hover:shadow-md hover:before:opacity-10" />
                        <span
                            class="pointer-events-none absolute left-2/4 top-2/4 -translate-x-2/4 -translate-y-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                fill="currentColor" stroke="currentColor" stroke-width="1">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </label>
                    <label class="cursor-pointer text-sm font-medium text-gray-700 dark:text-gray-300" for="is_active">
                        Activo
                    </label>
                </div>
                <div class="flex items-center justify-end">
                    <label class="relative flex cursor-pointer items-center rounded-full p-3" for="is_external"
                        data-ripple-dark="true">
                        <input id="is_external" type="checkbox" name="is_external" wire:model.live="is_external"
                            class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all before:absolute before:left-2/4 before:top-2/4 before:block before:h-12 before:w-12 before:-translate-x-2/4 before:-translate-y-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-purple-500 checked:bg-purple-800 checked:before:bg-slate-400 hover:shadow-md hover:before:opacity-10" />
                        <span
                            class="pointer-events-none absolute left-2/4 top-2/4 -translate-x-2/4 -translate-y-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                fill="currentColor" stroke="currentColor" stroke-width="1">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </label>
                    <label class="cursor-pointer text-sm font-medium text-gray-700 dark:text-gray-300"
                        for="is_external">
                        Externo
                    </label>
                </div>
            </div>
            <div class="mb-6 grid grid-cols-1 gap-10 md:grid-cols-2">
                <div>
                    <label for="first_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nombre(s) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="first_name" wire:model="first_name" placeholder=""
                        class="@error('first_name') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Apellidos <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="last_name" wire:model="last_name" placeholder=""
                        class="@error('last_name') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-6 grid grid-cols-1 gap-10 md:grid-cols-2">
                <div>
                    <label for="department_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Departamento <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="department_id" id="department_id"
                        class="@error('department_id') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                        <option value="">Seleccione Departamento</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="payroll_number" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Número de Nómina
                    </label>
                    <input type="text" id="payroll_number" wire:model="payroll_number" placeholder=""
                        @if ($is_external) disabled @endif
                        class="@error('payroll_number') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                    @error('payroll_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-6 grid grid-cols-1 gap-10 md:grid-cols-2">
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Correo-e <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" wire:model="email" placeholder=""
                        class="@error('email') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Usuario <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="username" wire:model="username" placeholder=""
                        class="@error('username') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                    @error('username')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex items-center justify-end">
                <button type="submit"
                    class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-indigo-600 px-8 py-3 font-semibold text-white hover:bg-indigo-800 hover:shadow-lg">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Guardar
                </button>
            </div>
        </form>
    </div>

</div>

<style>
    /* CHECKBOX TOGGLE SWITCH */
    /* @apply rules for documentation, these do not work as inline style */
    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        border-color: #68D391;
    }

    .toggle-checkbox:checked+.toggle-label {
        @apply: bg-green-400;
        background-color: #68D391;
    }
</style>
