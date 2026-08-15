<x-app-layout>
    <x-slot name="header"><h2>Carros registrados</h2></x-slot>

    <div class="p-6">
        @if(session('status'))
            <div class="mb-4 text-green-600">{{ session('status') }}</div>
        @endif

        <form method="GET" class="mb-4 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar marca o modelo">
            <select name="marca">
                <option value="">Todas las marcas</option>
                @foreach($marcas as $m)
                    <option value="{{ $m }}" @selected(request('marca')==$m)>{{ $m }}</option>
                @endforeach
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <a href="{{ route('cars.create') }}">+ Agregar carro</a>

        <table class="w-full mt-4">
            <thead><tr><th>Marca</th><th>Modelo</th><th>Año</th><th>Color</th><th>Precio</th><th>Km</th><th></th></tr></thead>
            <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->marca }}</td>
                    <td>{{ $car->modelo }}</td>
                    <td>{{ $car->anio }}</td>
                    <td>{{ $car->color }}</td>
                    <td>${{ number_format($car->precio,2) }}</td>
                    <td>{{ $car->kilometraje }}</td>
                    <td>
                        <a href="{{ route('cars.edit', $car) }}">Editar</a>
                        <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $cars->links() }}
    </div>
</x-app-layout>