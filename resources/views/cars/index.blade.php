<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">Carros registrados</h2>
                <p class="text-sm text-gray-500 mt-0.5">Gestiona el inventario del concesionario</p>
            </div>
            <a href="{{ route('cars.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-5 py-2.5 rounded-lg font-medium text-sm shadow-sm hover:shadow transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar carro
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('status'))
                <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-sm font-medium">{{ session('status') }}</span>
                </div>
            @endif

            <!-- Stats rápidas -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $cars->total() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Marcas</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $marcas->count() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 col-span-2 sm:col-span-2">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Página actual</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $cars->currentPage() }} de {{ $cars->lastPage() }}</p>
                </div>
            </div>

            <!-- Filtros -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <form method="GET" class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Buscar por marca o modelo..."
                               class="w-full pl-10 pr-4 py-2.5 border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition">
                    </div>
                    <select name="marca" class="border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Todas las marcas</option>
                        @foreach($marcas as $m)
                            <option value="{{ $m }}" @selected(request('marca')==$m)>{{ $m }}</option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition">
                        Filtrar
                    </button>
                    @if(request('search') || request('marca'))
                        <a href="{{ route('cars.index') }}"
                           class="flex items-center justify-center text-gray-500 hover:text-gray-700 px-3 text-sm font-medium">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>

            <!-- Tabla -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50/80 text-gray-500 uppercase text-xs tracking-wider border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3.5 font-semibold">Imagen</th>
                                <th class="px-6 py-3.5 font-semibold">Marca</th>
                                <th class="px-6 py-3.5 font-semibold">Modelo</th>
                                <th class="px-6 py-3.5 font-semibold">Año</th>
                                <th class="px-6 py-3.5 font-semibold">Color</th>
                                <th class="px-6 py-3.5 font-semibold">Precio</th>
                                <th class="px-6 py-3.5 font-semibold">Km</th>
                                <th class="px-6 py-3.5 font-semibold text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($cars as $car)
                                <tr class="hover:bg-gray-50/60 transition-colors">
                                    <td class="px-6 py-3.5">
                                        @if($car->imagen)
                                            <img src="{{ Storage::url($car->imagen) }}" class="w-14 h-10 object-cover rounded-lg border border-gray-200">
                                        @else
                                            <div class="w-14 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-300 border border-gray-100">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7l4-4h10l4 4M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7h18"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3.5 font-semibold text-gray-900">{{ $car->marca }}</td>
                                    <td class="px-6 py-3.5 text-gray-600">{{ $car->modelo }}</td>
                                    <td class="px-6 py-3.5">
                                        <span class="inline-flex px-2 py-0.5 rounded-md bg-gray-100 text-gray-700 text-xs font-medium">
                                            {{ $car->anio }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3.5">
                                        <span class="inline-flex items-center gap-1.5 text-gray-600">
                                            <span class="w-3 h-3 rounded-full border border-gray-300 shadow-sm" style="background-color: {{ strtolower($car->color) }}"></span>
                                            {{ $car->color }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3.5 font-bold text-emerald-700">${{ number_format($car->precio, 2) }}</td>
                                    <td class="px-6 py-3.5 text-gray-500">{{ number_format($car->kilometraje) }} km</td>
                                    <td class="px-6 py-3.5">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('cars.show', $car) }}"
                                               class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Ver">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('cars.edit', $car) }}"
                                               class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Editar">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('cars.destroy', $car) }}" method="POST"
                                                  onsubmit="return confirm('¿Eliminar este carro?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Eliminar">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-20 text-center">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4M4 17h12m0 0l-4 4m4-4l-4-4"/>
                                        </svg>
                                        <p class="text-gray-400 text-sm">No hay carros registrados todavía.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($cars->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            Mostrando {{ $cars->firstItem() }} a {{ $cars->lastItem() }} de {{ $cars->total() }} resultados
                        </p>
                        {{ $cars->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>