<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $car->marca }} {{ $car->modelo }} ({{ $car->anio }})
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            @if($car->imagen)
                <img src="{{ Storage::url($car->imagen) }}" class="w-full h-64 object-cover rounded mb-4">
            @endif

            <dl class="grid grid-cols-2 gap-4">
                <div><dt class="font-medium text-gray-600">Marca</dt><dd>{{ $car->marca }}</dd></div>
                <div><dt class="font-medium text-gray-600">Modelo</dt><dd>{{ $car->modelo }}</dd></div>
                <div><dt class="font-medium text-gray-600">Año</dt><dd>{{ $car->anio }}</dd></div>
                <div><dt class="font-medium text-gray-600">Color</dt><dd>{{ $car->color }}</dd></div>
                <div><dt class="font-medium text-gray-600">Precio</dt><dd>${{ number_format($car->precio, 2) }}</dd></div>
                <div><dt class="font-medium text-gray-600">Kilometraje</dt><dd>{{ number_format($car->kilometraje) }} km</dd></div>
            </dl>

            <div class="mt-6 flex gap-4">
                <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Editar</a>
                <a href="{{ route('cars.index') }}" class="text-gray-600 hover:underline self-center">Volver al listado</a>
            </div>
        </div>
    </div>
</x-app-layout>