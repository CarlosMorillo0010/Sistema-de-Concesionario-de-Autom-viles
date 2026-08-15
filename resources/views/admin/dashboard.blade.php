<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de administración
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white p-6 shadow rounded-lg text-center">
                <p class="text-sm text-gray-500">Total de carros</p>
                <p class="text-3xl font-bold text-blue-600">{{ $total }}</p>
            </div>
            <div class="bg-white p-6 shadow rounded-lg text-center">
                <p class="text-sm text-gray-500">Precio promedio</p>
                <p class="text-3xl font-bold text-green-600">
                    ${{ number_format($promedioPrecio ?? 0, 2) }}
                </p>
            </div>
        </div>

        <div class="bg-white p-6 shadow rounded-lg">
            <h3 class="font-semibold text-lg mb-4">Carros por marca</h3>
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Marca</th>
                        <th class="py-2">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($porMarca as $item)
                        <tr class="border-b">
                            <td class="py-2">{{ $item->marca }}</td>
                            <td class="py-2">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('cars.index') }}" class="text-blue-600 hover:underline">← Volver al listado de carros</a>
    </div>
</x-app-layout>