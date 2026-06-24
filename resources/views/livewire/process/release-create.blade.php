<div>
    {{-- Header --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Nueva Liberación</h1>
                    <p class="mt-1 text-green-100"></p>
                </div>
                <div class="flex items-center">
                    <a href="/processes/releases"
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
                Revisar detalladamente el estado físico y funcional del equipo.
            </flux:callout.text>
        </flux:callout>

        <form wire:submit="save" class="space-y-6">
            <div class="mb-4 mt-4 grid w-full grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Asignación <span
                            class="text-red-500">*</span></label>
                    <div class="flex">
                        <div class="w-full">
                            <input type="text" wire:model="assignment_id" placeholder="Buscar asignación..." readonly
                                class="@error('assignment_id') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                        </div>

                        <button type="button" wire:click="$dispatch('openAssignmentModal')"
                            class="ml-1 flex transform cursor-pointer items-center rounded-lg bg-indigo-600 px-4 py-4 font-semibold text-white hover:bg-indigo-800 hover:shadow-lg">
                            <!-- SVG Icon -->
                            <svg class="h-5 w-5 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="employee_name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Empleado
                    </label>
                    <input type="text" id="employee_name" wire:model="employee_name" placeholder="" readonly
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                </div>
                <div class="md:col-span-3">
                    @error('assignment_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="md:col-span-3">
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

            <div class="flex items-center">
                <div>
                    @error('detailsCol')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Table --}}
            <div class="mt-2 w-full overflow-hidden overflow-x-auto rounded-lg">
                <table class="w-full">
                    <thead
                        class="border-b border-gray-800 bg-gray-200 text-gray-600 dark:border-gray-200 dark:bg-neutral-700 dark:text-gray-300">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                Sel.
                            </th>
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
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-500 dark:divide-gray-400">
                        @forelse($assignment_details as $assignment_detail)
                            <tr class="bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 hover:dark:bg-slate-600"
                                wire:key="assignment_detail-{{ $assignment_detail->id }}">
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <div class="flex items-center justify-start">
                                        <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                            for="is_external" data-ripple-dark="true">
                                            <input type="checkbox" value="{{ $assignment_detail->id }}"
                                                wire:model.defer="detailsCol"
                                                class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow transition-all before:absolute before:left-2/4 before:top-2/4 before:block before:h-12 before:w-12 before:-translate-x-2/4 before:-translate-y-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-purple-500 checked:bg-purple-800 checked:before:bg-slate-400 hover:shadow-md hover:before:opacity-10" />
                                            <span
                                                class="pointer-events-none absolute left-2/4 top-2/4 -translate-x-2/4 -translate-y-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                    viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                    stroke-width="1">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $assignment_detail->device->device_model->brand->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-0 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $assignment_detail->device->device_model->classification->name }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $assignment_detail->device->device_model->description }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-left">
                                    <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                        {{ $assignment_detail->device->serial_number }}
                                    </div>
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
        </form>
    </div>

    <livewire:components.assignment-modal></livewire:components.assignment-modal>
</div>
