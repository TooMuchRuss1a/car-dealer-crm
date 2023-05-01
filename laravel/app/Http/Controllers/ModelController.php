<?php

namespace App\Http\Controllers;

use App\Enums\Body;
use App\Enums\Fuel;
use App\Enums\Type;
use App\Http\Requests\ModelRequest;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Model;
use Inertia\Inertia;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Model::with('brand', 'country')->orderByDesc('id')->get();
        $types = Type::array();
        $bodies = Body::array();
        $fuels = Fuel::array();

        return Inertia::render('CRM/Models/Index', compact('models', 'types', 'bodies', 'fuels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $types = Type::array();
        $bodies = Body::array();
        $fuels = Fuel::array();

        return Inertia::render('CRM/Models/Create', compact('countries', 'brands', 'types', 'bodies', 'fuels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModelRequest $request)
    {
        $model = Model::create($request->validated());

        return redirect()->route('crm.models.show', ['id' => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Model::with('brand', 'country')->findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $types = Type::array();
        $bodies = Body::array();
        $fuels = Fuel::array();

        return Inertia::render('CRM/Models/Show', compact('model', 'countries', 'brands', 'types', 'bodies', 'fuels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country, string $id)
    {
        $model = Model::with('brand', 'country')->findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $types = Type::array();
        $bodies = Body::array();
        $fuels = Fuel::array();

        return Inertia::render('CRM/Models/Edit', compact('model', 'countries', 'brands', 'types', 'bodies', 'fuels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModelRequest $request, string $id)
    {
        $model = Model::findOrFail($id);
        $model->update($request->validated());

        return redirect()->route('crm.models.show', ['id' => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Model::findOrFail($id);
        $model->delete();

        return redirect()->route('crm.models.index');
    }
}
