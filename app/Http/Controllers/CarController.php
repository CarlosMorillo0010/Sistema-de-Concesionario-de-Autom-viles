<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        // Bonus: búsqueda y filtrado
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('marca', 'like', "%{$request->search}%")
                  ->orWhere('modelo', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('marca')) {
            $query->where('marca', $request->marca);
        }

        $cars = $query->latest()->paginate(10)->withQueryString();
        $marcas = Car::select('marca')->distinct()->pluck('marca');

        return view('cars.index', compact('cars', 'marcas'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('cars', 'public');
        }

        Car::create($data);

        return redirect()->route('cars.index')->with('status', 'Carro registrado correctamente.');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('cars', 'public');
        }

        $car->update($data);

        return redirect()->route('cars.index')->with('status', 'Carro actualizado correctamente.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('status', 'Carro eliminado.');
    }
}
