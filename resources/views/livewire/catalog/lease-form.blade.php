<div>
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Arrendamientos</h1>
                    <p class="mt-1 text-green-100"></p>
                </div>
                <div>
                    <button wire:click="newLease"
                        class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-slate-600 px-8 py-3 font-bold text-white hover:bg-slate-800 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Nuevo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div
        class="mt-6 grid grid-cols-1 gap-8 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">

        {{-- Table --}}
        <div class="w-full overflow-hidden rounded-lg">
            <table class="w-full">
                <thead
                    class="border-b border-gray-800 bg-gray-200 text-gray-600 dark:border-gray-200 dark:bg-neutral-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">
                            Id
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            Arrendamiento
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            Fecha Inicio
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            Fecha Fin
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            Estado
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-500 dark:divide-gray-400">
                    @forelse($leases as $lease)
                        <tr class="bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 hover:dark:bg-slate-600"
                            wire:key="lease-{{ $lease->id }}">
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $lease->id }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $lease->description }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($lease->start_date)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($lease->end_date)->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    @if ($lease->is_active)
                                        <span
                                            class="rounded-2xl border border-gray-600 bg-green-400 px-3 py-1 dark:border-gray-300 dark:bg-green-700"">Activo</span>
                                    @else
                                        <span
                                            class="rounded-2xl border border-gray-600 bg-red-400 px-3 py-1 dark:border-gray-300 dark:bg-red-700"">Inactivo</span>
                                    @endif

                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                <button type="button" wire:click="editLease({{ $lease }})"
                                    class="cursor-pointer text-cyan-600 transition hover:text-cyan-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="mb-4 h-16 w-16 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                    </svg>

                                    <h3 class="mb-2 text-lg font-medium text-gray-700 dark:text-gray-300">No se
                                        encontraron registros
                                    </h3>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}
    <div>
        <div wire:keep x-show="$wire.isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
            style="display: none;">

            <!-- Modal Panel -->
            <div x-show="$wire.isOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                class="relative w-1/2 overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">

                <!-- Header -->
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $isEditing ? 'Editar Arrendamiento' : 'Crear Arrendamiento' }}</h3>
                    <button wire:click="close"
                        class="cursor-pointer text-gray-400 transition-colors hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit="save" class="space-y-6">

                    <!-- Body -->
                    <div class="px-6 py-6">
                        <div class="grid grid-cols-3 items-center gap-8">
                            <div class="col-span-2">
                                <label for="description"
                                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Descripción <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="description" wire:model="description"
                                    placeholder="Ej. Arrendamiento 1"
                                    class="@error('description') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end">
                                <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                    for="is_active" data-ripple-dark="true">
                                    <input id="is_active" type="checkbox" name="is_active" wire:model="is_active"
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
                                <label class="cursor-pointer text-sm font-medium text-gray-700 dark:text-gray-300"
                                    for="is_active">
                                    Activo
                                </label>
                            </div>
                        </div>
                        <div class="mt-6 grid items-center gap-8 md:grid-cols-2">
                            <div>
                                <label for="start_date"
                                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha Inicio <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="start_date" wire:model="start_date"
                                    class="@error('start_date') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date"
                                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Fecha Fin<span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="end_date" wire:model="end_date"
                                    class="@error('end_date') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div
                        class="flex justify-end gap-3 border-t border-gray-300 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900/50">
                        <button wire:click="close" type="button"
                            class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-gray-600 px-8 py-3 font-semibold text-white hover:bg-gray-800 hover:shadow-lg">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </button>
                        <button type="submit"
                            class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-indigo-600 px-8 py-3 font-semibold text-white hover:bg-indigo-800 hover:shadow-lg">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
