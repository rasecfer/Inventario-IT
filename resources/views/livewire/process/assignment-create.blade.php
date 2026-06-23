<div>
    {{-- Header --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Nueva Asignación</h1>
                    <p class="mt-1 text-green-100"></p>
                </div>
                <div class="flex items-center">
                    <a href="/processes/assignments"
                        class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-slate-600 px-8 py-3 font-bold text-white hover:bg-slate-800 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                        Volver
                    </a>
                    <button wire:loading.attr="disabled" wire:click="save"
                        class="ml-2 flex transform cursor-pointer items-center gap-2 rounded-lg bg-indigo-600 px-8 py-3 font-semibold text-white hover:bg-indigo-800 hover:shadow-lg">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            wire:loading.attr="hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <svg wire:loading wire:target="delete" class="h-4 w-4 animate-spin text-white" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div
        class="mt-6 grid grid-cols-1 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">
        <flux:callout icon="exclamation-circle" variant="warning">
            <flux:callout.heading>Importante!</flux:callout.heading>
            <flux:callout.text>
                Por cuestiones de trazabilidad, una vez creada la asignación NO se podrá modificar. Se deberán liberar
                los equipos asignados y realizar una nueva asignación.
            </flux:callout.text>
        </flux:callout>

        <form wire:submit="save" class="space-y-6">
            <div class="mb-4 mt-4 grid w-full grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Empleado <span
                            class="text-red-500">*</span></label>
                    <div class="flex">
                        <div class="w-full">
                            <input type="text" wire:model="employee_name" placeholder="Buscar empleado..." readonly
                                class="@error('employee_name') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                        </div>

                        <button type="button" wire:click="$dispatch('openModal')"
                            class="ml-1 flex transform cursor-pointer items-center rounded-lg bg-indigo-600 px-4 py-4 font-semibold text-white hover:bg-indigo-800 hover:shadow-lg">
                            <!-- SVG Icon -->
                            <svg class="h-5 w-5 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="username" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Usuario
                    </label>
                    <input type="text" id="username" wire:model="username" placeholder="" readonly
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                </div>
                <div class="md:col-span-2">
                    @error('employee_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-2">
                    <label for="comments" class="mb-2 block text-sm font-medium text-gray-600 dark:text-gray-300">
                        Comentarios
                    </label>
                    <textarea wire:model="comments" id="comments" rows="5" placeholder="Agregue comentarios..."
                        class="@error('comments') border-red-500 @enderror w-full resize-none rounded-lg border border-gray-300 px-4 py-3 hover:ring-purple-500 focus:border-transparent focus:ring-2 focus:ring-purple-500"></textarea>
                    @error('comments')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <flux:separator text="Partidas" />

            <div class="flex items-center justify-between">
                <div>
                    @error('devicesCol')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="button" wire:click="$dispatch('openDeviceModal')"
                    class="flex transform cursor-pointer items-center rounded-lg bg-indigo-600 px-3 py-2 text-white hover:bg-indigo-800 hover:shadow-lg">
                    <!-- SVG Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Agregar
                </button>
            </div>

            {{-- Table --}}
            <div class="mt-2 w-full overflow-hidden overflow-x-auto rounded-lg">
                <table class="w-full">
                    <thead
                        class="border-b border-gray-800 bg-gray-200 text-gray-600 dark:border-gray-200 dark:bg-neutral-700 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    Marca
                                </div>
                            </th>
                            <th class="x-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    Clasificación
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    Modelo
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    No. Serie
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                Eliminar
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-500 dark:divide-gray-400">
                        @forelse($devices as $device)
                            <tr class="bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 hover:dark:bg-slate-600"
                                wire:key="device-{{ $device->id }}">
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $device->device_model->brand->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-0 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $device->device_model->classification->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $device->device_model->description }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $device->serial_number }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <button type="button" wire:click="removeDevice({{ $device->id }})"
                                        class="cursor-pointer text-red-400 transition hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="mb-4 h-16 w-16 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                        </svg>

                                        <h3 class="mb-2 text-lg font-medium text-gray-700 dark:text-gray-300">No se
                                            han agregado Equipos
                                        </h3>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-end">

            </div>
        </form>
    </div>

    <livewire:components.employee-modal></livewire:components.employee-modal>
    <livewire:components.device-modal></livewire:components.device-modal>
</div>
