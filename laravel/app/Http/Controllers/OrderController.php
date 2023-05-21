<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Car;
use App\Models\Customer;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer', 'user', 'car.supply.equipment.generation.model.brand')->orderByDesc('id')->get();

        return Inertia::render('CRM/Orders/Index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $cars = Car::with('supply.equipment.generation.model.brand')->whereIn('status', ['PRESENT', 'SELLING'])->get();

        return Inertia::render('CRM/Orders/Create', compact('customers', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated() + [
            'user_id' => $request->user()->id,
            'created_at' => now()
        ]);

        return redirect()->route('crm.orders.show', ['id' => $order->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('customer', 'user', 'car.supply.equipment.generation.model.brand')->findOrFail($id);

        return Inertia::render('CRM/Orders/Show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::with('customer', 'user', 'car.supply.equipment.generation.model.brand')->findOrFail($id);
        $customers = Customer::orderBy('name')->get();
        $cars = Car::with('supply.equipment.generation.model.brand')->whereIn('status', ['PRESENT', 'SELLING'])->get();

        return Inertia::render('CRM/Orders/Edit', compact('order', 'customers', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->validated());

        return redirect()->route('crm.orders.show', ['id' => $order->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('crm.orders.index');
    }
}
