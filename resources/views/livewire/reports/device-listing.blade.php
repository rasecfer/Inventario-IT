<div>
    {{-- Header --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Listado de Equipos</h1>
                    <p class="mt-1 text-white"></p>
                </div>
                <div class="flex items-center">
                </div>
            </div>
        </div>
    </div>

    <div
        class="max-h-3/4 mt-6 grid grid-cols-1 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
            <div class="w-full">
                <!-- Search -->
                <div>
                    <div class="relative">

                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Buscar equipos por empleado o modelo..."
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center pl-7">
                            <!-- SVG Icon -->
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-full items-center justify-end">
                <button type="button" wire:click="openFilters"
                    class="mr-4 flex cursor-pointer items-center justify-between rounded-lg bg-slate-500 px-4 py-2 font-bold text-gray-200 transition hover:bg-slate-600 hover:shadow-lg">
                    Filtros...
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                </button>
                <button type="button" wire:click="exportExcel"
                    class="flex cursor-pointer items-center justify-between rounded-lg bg-blue-700 px-4 py-2 font-bold text-gray-200 transition hover:bg-blue-800">
                    Exportar...
                    <img src="{{ asset('excel_export.png') }}" alt="Exportar a Excel" width="24" height="24">
                </button>
            </div>
        </div>

        {{-- Table --}}
        <div class="mt-4 w-full overflow-auto rounded-lg">
            <table class="w-full">
                <thead
                    class="border-b border-gray-800 bg-gray-200 text-gray-600 dark:border-gray-200 dark:bg-neutral-700 dark:text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Marca
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
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
                                Serie
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Empleado
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Estado
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">

                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-500 dark:divide-gray-400">
                    @forelse($devices as $device)
                        <tr class="bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 hover:dark:bg-slate-600"
                            wire:key="device-{{ $device->Id }}">
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $device->Brand }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-0 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $device->Classification }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $device->Model }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $device->Serial }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $device->Empleado }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    @switch($device->Status)
                                        @case('AV')
                                            <span
                                                class="rounded-2xl border border-gray-600 bg-green-400 px-3 py-1 dark:border-gray-300 dark:bg-green-700">{{ App\Enums\DeviceStatus::Available->label() }}</span>
                                        @break

                                        @case('AS')
                                            <span
                                                class="rounded-2xl border border-gray-600 bg-orange-400 px-3 py-1 dark:border-gray-300 dark:bg-orange-700"">{{ App\Enums\DeviceStatus::Assigned->label() }}</span>
                                        @break

                                        @default
                                            <span
                                                class="rounded-2xl border border-gray-600 bg-red-400 px-3 py-1 dark:border-gray-300 dark:bg-red-700"">{{ App\Enums\DeviceStatus::tryFrom($device->Status)->label() }}</span>
                                    @endswitch
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">

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

        {{-- Filters Modal --}}
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
                            Seleccionar Filtros</h3>
                        <button type="button" wire:click="closeFilters"
                            class="cursor-pointer text-gray-400 transition-colors hover:text-gray-600 dark:hover:text-gray-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="grid w-full grid-cols-2 gap-8 p-8">
                        <div>
                            <h3 class="text-md font-semibold text-gray-800 dark:text-gray-300">Estados</h3>
                            @foreach (App\Enums\DeviceStatus::cases() as $status)
                                <div class="flex items-center justify-start">
                                    <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                        for="status" data-ripple-dark="true">
                                        <input type="checkbox" value="{{ $status->value }}" wire:model.defer="statusCol"
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
                                        for="status">
                                        {{ $status->label() }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            <h3 class="text-md font-semibold text-gray-800 dark:text-gray-300">Clasificaciones</h3>
                            @foreach ($classifications as $classification)
                                <div class="flex items-center justify-start">
                                    <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                        for="classification" data-ripple-dark="true">
                                        <input type="checkbox" value="{{ $classification->id }}"
                                            wire:model.defer="classificationCol"
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
                                        for="classification">
                                        {{ $classification->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Footer -->
                    <div
                        class="flex justify-end gap-3 border-t border-gray-300 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900/50">
                        <button wire:click="closeFilters" type="button"
                            class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-gray-600 px-8 py-3 font-semibold text-white hover:bg-gray-800 hover:shadow-lg">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </button>
                        <button type="button" wire:click="applyFilters"
                            class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-indigo-600 px-8 py-3 font-semibold text-white hover:bg-indigo-800 hover:shadow-lg">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Aplicar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
