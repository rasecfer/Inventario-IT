<div x-data="{
    preview: null,
    handleFile(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => this.preview = e.target.result;
            reader.readAsDataURL(file);
            $wire.logo_path = '';
        }
    }
}">
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Configuración</h1>
                    <p class="mt-1 text-green-100"></p>
                </div>
            </div>
        </div>
    </div>

    <div
        class="mt-6 grid grid-cols-1 gap-8 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">

        <form wire:submit="save" class="space-y-6">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="w-full">
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-600 dark:text-gray-300">
                        Logo Compañía <span class="text-red-500"></span>
                    </label>
                    <div class="flex w-full flex-col items-center justify-center">

                        <label for="dropzone-file"
                            class="@error('image') border-red-500 @enderror group flex h-12 w-full cursor-pointer flex-col items-center justify-center rounded-lg border border-gray-300 bg-gray-50 transition-all duration-300 ease-in-out hover:bg-gray-100 hover:shadow-lg dark:bg-gray-800 dark:hover:border-indigo-500 dark:hover:bg-gray-700">

                            <div class="flex items-center justify-between">
                                <!-- Upload Icon -->
                                <svg class="h-8 w-8 text-gray-400 transition-colors duration-300 group-hover:text-indigo-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>

                                <!-- Primary Text -->
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <span
                                        class="font-semibold text-indigo-600 group-hover:underline dark:text-indigo-400">Click
                                        para cargar</span>
                                </p>

                            </div>

                            <!-- Hidden Actual Input -->
                            <input id="dropzone-file" wire:model="image" type="file" class="hidden"
                                x-on:change="handleFile" />
                        </label>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Secondary Text -->
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            SVG, PNG, JPG or GIF (MAX. 2MB)
                        </p>

                        <!-- Selected File Name Display (Hidden by default) -->
                        <p id="file-name"
                            class="mt-1 flex hidden items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span id="file-name-text"></span>
                        </p>
                    </div>
                </div>
                <div class="flex w-full items-center justify-center">
                    @if ($isEditing && $logo_path)
                        <img src="{{ $logo_path }}" class="mt-2 h-32 w-32 object-cover">
                    @endif
                    <template x-if="preview">
                        <img :src="preview" class="mt-2 h-32 w-32 object-cover">
                    </template>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="mb-2 block text-sm font-medium text-gray-600 dark:text-gray-300">
                        Texto/Cláusula
                    </label>
                    <textarea wire:model="disclaimer" id="disclaimer" rows="5"
                        placeholder="Agregue el texto o cláusula a mostrar en la carta de Asignación..."
                        class="@error('disclaimer') border-red-500 @enderror w-full resize-none rounded-lg border border-gray-300 px-4 py-3 hover:ring-purple-500 focus:border-transparent focus:ring-2 focus:ring-purple-500"></textarea>
                    @error('disclaimer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
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
