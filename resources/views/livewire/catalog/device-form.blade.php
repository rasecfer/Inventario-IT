<div>
    {{-- Header --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $isEditing ? 'Editar ' : 'Nuevo ' }}Equipo</h1>
                    <p class="mt-1 text-green-100"></p>
                </div>
                <div>
                    <a href="/catalogs/devices"
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
            <div class="mb-6 grid grid-cols-1 gap-10 md:grid-cols-2">
                <div>
                    <label for="device_model_id"
                        class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Modelo <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="device_model_id" id="device_model_id"
                        class="@error('device_model_id') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                        <option value="">Seleccione Modelo</option>
                        @foreach ($deviceModels as $deviceModel)
                            <option value="{{ $deviceModel->id }}">{{ $deviceModel->description }}</option>
                        @endforeach
                    </select>
                    @error('device_model_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lease_id" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Arrendamiento <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="lease_id" id="lease_id"
                        class="@error('lease_id') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                        <option value="">Seleccione Arrendamiento</option>
                        @foreach ($leases as $lease)
                            <option value="{{ $lease->id }}">{{ $lease->description }}</option>
                        @endforeach
                    </select>
                    @error('lease_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-6 grid grid-cols-1 gap-10 md:grid-cols-2">
                <div>
                    <label for="serial_number" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Número de Serie <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="serial_number" wire:model="serial_number" placeholder="# Serie"
                        class="@error('serial_number') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                    @error('serial_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Estado <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="status" id="status"
                        class="@error('status') border-red-500 @enderror w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-purple-500">
                        <option value="">Seleccione Estado</option>
                        @foreach (App\Enums\DeviceStatus::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-6 grid grid-cols-1 gap-10">
                <div>
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
