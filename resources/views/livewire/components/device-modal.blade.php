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
            class="max-h-2/3 relative w-2/3 overflow-auto rounded-2xl bg-white shadow-2xl dark:bg-gray-800">

            <!-- Header -->
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Seleccionar Equipo</h3>
                <button type="button" wire:click="close"
                    class="cursor-pointer text-gray-400 transition-colors hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div
                class="mt-6 grid grid-cols-1 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Search -->
                    <div>
                        {{-- <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar</label> --}}
                        <div class="relative">

                            <input type="text" wire:model.live.debounce.300ms="search"
                                placeholder="Buscar por serie..."
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center pl-7">
                                <!-- SVG Icon -->
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Table --}}
                <div class="mt-4 w-full overflow-auto rounded-lg">
                    <table class="w-full">
                        <thead
                            class="border-b border-gray-800 bg-gray-200 text-gray-600 dark:border-gray-200 dark:bg-neutral-700 dark:text-gray-300">
                            <tr>
                                <th
                                    class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        Elegir
                                    </div>
                                </th>
                                <th
                                    class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        Marca
                                    </div>
                                </th>
                                <th
                                    class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        Clasificación
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        Modelo
                                    </div>
                                </th>
                                <th
                                    class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                                    <div class="flex items-center gap-2">
                                        Num. Serie
                                    </div>
                                </th>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-500 dark:divide-gray-400">
                            @forelse($devices as $device)
                                <tr class="bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 hover:dark:bg-slate-600"
                                    wire:key="device-{{ $device->id }}">
                                    <td class="whitespace-nowrap px-6 py-4 text-center">
                                        <button type="button" wire:click="deviceSelected({{ $device }})"
                                            class="cursor-pointer text-green-600 transition hover:text-green-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-left">
                                        <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                            {{ $device->device_model->brand->name }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-left">
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
                                                encontraron registros
                                            </h3>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($devices->hasPages())
                    <div class="border-t border-gray-200 px-6 py-4">
                        {{ $devices->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
