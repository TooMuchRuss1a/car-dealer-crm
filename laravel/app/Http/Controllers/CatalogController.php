<?php

namespace App\Http\Controllers;

use App\Enums\Body;
use App\Enums\Fuel;
use App\Models\Car;
use Inertia\Inertia;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('photos', 'supply.equipment.generation.model.brand', 'supply.equipment.generation.engine')->where('status', '=', 'SELLING')->orderByDesc('id')->get();

        return Inertia::render('Catalog/Index', compact('cars'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::with('photos', 'supply.equipment.generation.model.brand', 'supply.equipment.generation.engine')->where('status', '=', 'SELLING')->findOrFail($id);
        $fuels = Fuel::array();
        $bodies = Body::array();

        return Inertia::render('Catalog/Show', compact('car', 'fuels', 'bodies'));
    }
}
