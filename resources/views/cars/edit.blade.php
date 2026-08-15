<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar carro: {{ $car->marca }} {{ $car->modelo }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form method="POST" action="{{ route('cars.update', $car) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Marca</label>
                    <input type="text" name="marca" value="{{ old('marca', $car->marca) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('marca') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Modelo</label>
                    <input type="text" name="modelo" value="{{ old('modelo', $car->modelo) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('modelo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Año</label>
                    <input type="number" name="anio" value="{{ old('anio', $car->anio) }}" min="1950" max="{{ date('Y') + 1 }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('anio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Color</label>
                    <input type="text" name="color" value="{{ old('color', $car->color) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('color') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Precio</label>
                    <input type="number" step="0.01" min="0" name="precio" value="{{ old('precio', $car->precio) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('precio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Kilometraje</label>
                    <input type="number" min="0" name="kilometraje" value="{{ old('kilometraje', $car->kilometraje) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('kilometraje') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Imagen actual</label>
                    @if($car->imagen)
                        <img src="{{ Storage::url($car->imagen) }}" class="w-32 h-20 object-cover rounded mb-2">
                    @else
                        <p class="text-sm text-gray-400 mb-2">Sin imagen</p>
                    @endif
                    <input type="file" name="imagen" accept="image/*" class="mt-1 block w-full">
                    @error('imagen') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Actualizar
                    </button>
                    <a href="{{ route('cars.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>