<div>
    {{-- Title --}}
    <div class="bg-linear-to-r rounded-xl from-gray-600 to-blue-400 shadow-lg">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">Empleados</h1>
                    <p class="mt-1 text-green-100"></p>
                </div>
                <div>
                    <a href="/employees/create"
                        class="flex transform cursor-pointer items-center gap-2 rounded-lg bg-slate-600 px-8 py-3 font-bold text-white hover:bg-slate-800 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Nuevo
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div
        class="mt-6 grid grid-cols-1 rounded-xl border-2 border-gray-400 bg-gray-100 p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800">
        <div class="grid w-full grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Search -->
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Buscar</label>
                <div class="relative">

                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar empleados..."
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
        {{-- Table --}}
        <div class="mt-4 w-full overflow-hidden rounded-lg">
            <table class="w-full">
                <thead
                    class="border-b border-gray-800 bg-gray-200 text-gray-600 dark:border-gray-200 dark:bg-neutral-700 dark:text-gray-300">
                    <tr>
                        <th wire:click="sortField('id')"
                            class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Id
                                @if ($sortBy === 'id')
                                    <svg class="{{ $sortDirection === 'asc' ? 'rotate-180' : '' }} h-4 w-4"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortField('last_name')"
                            class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Apellidos
                                @if ($sortBy === 'last_name')
                                    <svg class="{{ $sortDirection === 'asc' ? 'rotate-180' : '' }} h-4 w-4"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th wire:click="sortField('first_name')"
                            class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Nombre(s)
                                @if ($sortBy === 'first_name')
                                    <svg class="{{ $sortDirection === 'asc' ? 'rotate-180' : '' }} h-4 w-4"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Departamento
                            </div>
                        </th>
                        <th wire:click="sortField('payroll_number')"
                            class="cursor-pointer px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Num. Nómina
                                @if ($sortBy === 'payroll_number')
                                    <svg class="{{ $sortDirection === 'asc' ? 'rotate-180' : '' }} h-4 w-4"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                @endif
                            </div>
                        </th>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                Estado
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-500 dark:divide-gray-400">
                    @forelse($employees as $employee)
                        <tr class="bg-slate-200 dark:bg-slate-700" wire:key="employee-{{ $employee->id }}">
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $employee->id }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $employee->last_name }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $employee->first_name }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $employee->department->name }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    {{ $employee->payroll_number }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-left">
                                <div class="text-sm font-bold text-gray-600 dark:text-gray-300">
                                    @if ($employee->is_active)
                                        <span
                                            class="rounded-2xl border border-gray-600 bg-green-400 px-3 py-1 dark:border-gray-300 dark:bg-green-700"">Activo</span>
                                    @else
                                        <span
                                            class="rounded-2xl border border-gray-600 bg-red-400 px-3 py-1 dark:border-gray-300 dark:bg-red-700"">Inactivo</span>
                                    @endif

                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-center">
                                <a href="/employees/{{ $employee->id }}/edit""
                                    class="cursor-pointer text-cyan-600 transition hover:text-cyan-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
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
        @if ($employees->hasPages())
            <div class="border-t border-gray-200 px-6 py-4">
                {{ $employees->links() }}
            </div>
        @endif
    </div>
</div>
</div>
