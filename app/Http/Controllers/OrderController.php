<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get(); // Fragt alle Objekte aus der DB aub
        return view('orderlist', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        return view('orderform', compact('customers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start' => 'required|date|after:now',
            'end' => 'required|date|after:now',
            'customer_id' => 'required|integer|min:1',
            'vehicle_id' => 'required|integer|min:1',
        ]);

        $order = new Order;
        $order->fill($request->all());
        $order->save();

        // Order::create($request->all());

        //session(['msg' => 'Bestellung wurde gespeichert']); // Wird dauerhaft in die Session geschrieben
        session()->put('msg', 'Bestellung wurde gespeichert');

        //session()->flash('msg', 'Bestellung wurde gespeichert'); // Nur bis zur nächten Seite verfügbar

        return redirect()
            ->route('order.index');
            //->with('msg', 'Bestellung wurde gespeichert'); // Hängt eine Session dran
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        return 'Order mit der id '.$order->id.' wird bearbeitet';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()
            ->route('order.index');
    }
}
