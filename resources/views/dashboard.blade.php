<x-app-layout>
    <div
        class=" pb-2 font-semibold text-lg text-gray-700 dark:text-gray-300 mb-2 border-b-2 border-gray-700 dark:border-gray-300">
        Dashboard
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">

        <div
            class="rounded-2xl p-6
                bg-gradient-to-br from-indigo-400 to-indigo-800
                text-white shadow-xl">
            <div class="text-sm opacity-80">Total Devices</div>
            <div class="text-3xl font-bold mt-2">1,254</div>
        </div>

        <div
            class="rounded-2xl p-6
                bg-gradient-to-br from-emerald-400 to-emerald-800
                text-white shadow-xl">
            <div class="text-sm opacity-80">Assigned</div>
            <div class="text-3xl font-bold mt-2">1,032</div>
        </div>

        <div
            class="rounded-2xl p-6
                bg-gradient-to-br from-amber-400 to-orange-600
                text-white shadow-xl">
            <div class="text-sm opacity-80">In Stock</div>
            <div class="text-3xl font-bold mt-2">222</div>
        </div>

    </div>
</x-app-layout>
