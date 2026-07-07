<div>
    {{-- Header --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Historial de Equipo</h1>
                    <p class="mt-1 text-white"></p>
                </div>
                <div class="flex items-center">
                </div>
            </div>
        </div>
    </div>

    <div
        class="max-h-3/4 mt-6 grid grid-cols-1 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-4 mt-4 grid w-full grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Equipo (No. Serie) <span
                        class="text-red-500">*</span></label>
                <div class="flex">
                    <div class="w-full">
                        <input type="text" wire:model="serial_number" placeholder="Buscar equipo..." readonly
                            class="@error('serial_number') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                    </div>

                    <button type="button" wire:click="openModal"
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
                <label for="details" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Marca/Clasificación/Modelo
                </label>
                <input type="text" id="details" wire:model="details" placeholder="" readonly
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        {{-- Timeline --}}
        <div class="mx-auto mt-8 w-full md:w-2/3">
            <div
                class="before:bg-linear-to-b relative space-y-8 before:absolute before:inset-0 before:ml-5 before:h-full before:w-0.5 before:-translate-x-px before:from-transparent before:via-slate-300 before:to-transparent md:before:mx-auto md:before:translate-x-0 dark:before:via-slate-600">
                @foreach ($timeline as $item)
                    <div
                        class="group relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse">
                        @if ($item['type'] == 'Baja')
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-white bg-red-500 text-white shadow md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 dark:border-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                            </div>
                        @else
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-white bg-emerald-500 text-white shadow md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 dark:border-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                </svg>
                            </div>
                        @endif
                        <div
                            class="w-[calc(100%-4rem)] rounded-xl border border-slate-200 bg-white p-4 shadow-sm ring-2 ring-emerald-100 md:w-[calc(50%-2.5rem)] dark:border-slate-700 dark:bg-gray-800 dark:ring-emerald-900">
                            <div class="mb-1 flex items-center justify-between space-x-2">
                                <div class="font-bold text-slate-900 dark:text-slate-100">{{ $item['type'] }} - Folio:
                                    {{ $item['id'] }}</div>
                                <time class="font-caveat text-sm font-medium text-emerald-500">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="mr-1 size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($item['date'])->format('d/m/Y') }}
                                    </div>
                                </time>
                            </div>
                            <div class="text-sm text-slate-500 dark:text-slate-400">{{ $item['comments'] }}</div>
                            @if ($item['employee'])
                                <div class="text-sm text-slate-500 dark:text-slate-400">
                                    Emp: <strong>{{ $item['employee'] }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Modal --}}
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
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
                                            <button type="button" wire:click="deviceSelected({{ $device->id }})"
                                                class="cursor-pointer rounded-full bg-green-600 p-1 text-gray-200 transition hover:bg-green-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
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
                                                <svg class="mb-4 h-16 w-16 text-gray-300"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                                </svg>

                                                <h3 class="mb-2 text-lg font-medium text-gray-700 dark:text-gray-300">
                                                    No se
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
