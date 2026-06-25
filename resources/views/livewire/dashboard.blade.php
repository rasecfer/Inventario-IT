<div>
    {{-- Header --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Tablero</h1>
                    <p class="mt-1 text-white">Bienvenido, {{ auth()->user()->name }}!</p>
                </div>
                <div class="flex items-center">

                </div>
            </div>
        </div>
    </div>

    <div
        class="mt-6 grid grid-cols-1 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">

        <!-- Stats Cards -->
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Device Card -->
            <div class="rounded-xl border-l-4 border-blue-500 bg-white p-6 shadow-md">
                <div class="mb-2 flex items-center justify-between">
                    <h3 class="text-md font-bold text-gray-600">Total Equipos</h3>
                    <div class="rounded-lg bg-blue-100 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-800">
                    {{ number_format($available_devices + $assigned_devices) }}</div>
                <div class="mt-3">
                    <div class="mb-1 flex items-center justify-between text-xs text-gray-600">
                        <span><strong>{{ number_format($assigned_devices) }}</strong> asignados</span>
                        <span><strong>{{ number_format($available_devices) }}</strong> disponibles</span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-gray-200">
                        <div class="{{ $percentage_assigned > 100 ? 'bg-red-500' : ($percentage_assigned > 80 ? 'bg-yellow-500' : 'bg-green-500') }} h-2 rounded-full"
                            style="width: {{ min($percentage_assigned, 100) }}%"></div>
                    </div>
                </div>
            </div>
            <!-- Categories Card -->
            <div class="rounded-xl border-l-4 border-green-500 bg-white p-6 shadow-md"">
                <div class="mb-2 flex items-center justify-between">
                    <h3 class="text-md font-bold text-gray-600">Top 3 Clasificaciones</h3>
                    <div class="rounded-lg bg-green-100 p-2">
                        <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-6 text-sm text-gray-600">
                    <table class="w-full">
                        <tbody>
                            @foreach ($top_3_classifications as $classification)
                                <tr wire:key="classification-{{ $classification->id }}">
                                    <td>{{ $classification->name }}</td>
                                    <td>{{ $classification->devices_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Leases Card -->
            <div class="rounded-xl border-l-4 border-purple-500 bg-white p-6 shadow-md">
                <div class="mb-2 flex items-center justify-between">
                    <h3 class="text-md font-bold text-gray-600">Arrendamientos</h3>
                    <div class="rounded-lg bg-purple-100 p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 text-purple-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v7.5m2.25-6.466a9.016 9.016 0 0 0-3.461-.203c-.536.072-.974.478-1.021 1.017a4.559 4.559 0 0 0-.018.402c0 .464.336.844.775.994l2.95 1.012c.44.15.775.53.775.994 0 .136-.006.27-.018.402-.047.539-.485.945-1.021 1.017a9.077 9.077 0 0 1-3.461-.203M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>

                    </div>
                </div>
                <div class="text-sm text-gray-600">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 font-bold">
                                <td>Nombre</td>
                                <td>Fecha Vencim.</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leases as $lease)
                                <tr wire:key="lease-{{ $lease->id }}">
                                    <td>{{ $lease->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lease->end_date)->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Charts Row -->
        <div class="mb-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            {{-- monthly trend chart --}}
            <div class="rounded-xl bg-white p-6 shadow-md">
                <h3 class="mb-4 text-lg font-semibold text-gray-600">Dispositivos por Clasificación
                </h3>
                <div style="height: 400px">
                    <canvas id="devicesPerClassification"></canvas>
                </div>
            </div>
            <div class="rounded-xl bg-white p-6 shadow-md">
                <h3 class="mb-4 text-lg font-semibold text-gray-600">Dispositivos por Arrendamientos</h3>
                <div style="height: 400px">
                    <canvas id="devicesPerLease"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        let devicesPerClassification;
        let categoriesChart;
        document.addEventListener('livewire:navigated', function() {
            // monthly Trend chart
            const trendCtx = document.getElementById('devicesPerClassification').getContext('2d');

            if (@json($classifications)) {

                devicesPerClassification = new Chart(trendCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($classifications->pluck('name')),
                        datasets: [{
                            label: 'Equipos',
                            data: @json($classifications->pluck('devices_count')),
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: 'rgb(147, 51, 234)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true
                            },
                            colors: {
                                forceOverride: true
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toFixed(0);
                                    }
                                },
                            }
                        }
                    }
                });
                // category Pie chart
                const categoryCtx = document.getElementById('devicesPerLease').getContext('2d');
                devicesPerLease = new Chart(categoryCtx, {
                    type: 'pie',
                    data: {
                        labels: @json($lease_devices->pluck('description')),
                        datasets: [{
                            label: 'Equipos',
                            data: @json($lease_devices->pluck('devices_count')),
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            colors: {
                                forceOverride: true
                            }
                        }
                    }
                });
            }
        });
    </script>
</div>
