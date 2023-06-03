<?php

namespace App\Http\Controllers;

use App\Enums\CarStatus;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cars = Car::search($request->search, [
            '' => ['state_number', 'vin', 'release_date'],
            'supply.equipment' => ['name'],
            'supply.equipment.generation' => ['number'],
            'supply.equipment.generation.model' => ['name'],
            'supply.equipment.generation.model.brand' => ['name'],
        ])
            ->with('supply.equipment.generation.model.brand')
            ->orderByDesc('id')
            ->get();
        $statuses = CarStatus::array();

        return Inertia::render('CRM/Cars/Index', compact('cars', 'statuses'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::with('supply.equipment.generation.model.brand', 'photos')->findOrFail($id);
        $statuses = CarStatus::array();

        return Inertia::render('CRM/Cars/Show', compact('car', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        $statuses = CarStatus::array();

        return Inertia::render('CRM/Cars/Edit', compact('car', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, string $id)
    {
        $car = Car::findOrFail($id);
        $car->update($request->validated());

        return redirect()->route('crm.cars.show', ['id' => $car->id]);
    }
}
