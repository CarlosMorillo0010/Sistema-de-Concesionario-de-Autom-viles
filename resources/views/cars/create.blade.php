<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agregar nuevo carro
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Marca</label>
                    <input type="text" name="marca" value="{{ old('marca') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('marca') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Modelo</label>
                    <input type="text" name="modelo" value="{{ old('modelo') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('modelo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Año</label>
                    <input type="number" name="anio" value="{{ old('anio') }}" min="1950" max="{{ date('Y') + 1 }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('anio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Color</label>
                    <input type="text" name="color" value="{{ old('color') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('color') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Precio</label>
                    <input type="number" step="0.01" min="0" name="precio" value="{{ old('precio') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('precio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Kilometraje</label>
                    <input type="number" min="0" name="kilometraje" value="{{ old('kilometraje') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @error('kilometraje') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Imagen (opcional)</label>
                    <input type="file" name="imagen" accept="image/*"
                           class="mt-1 block w-full">
                    @error('imagen') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Guardar
                    </button>
                    <a href="{{ route('cars.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>