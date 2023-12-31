<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        // Aktiviert die Middleware für alle Funktionen des Controllers
        // Ein Eintrag in die Routes ist nicht mehr nötig
        //$this->middleware('prelog:order'); 

        // Aktiviert die Middleware nur für die index-Methode
        // $this->middleware('prelog')->only('index');

        // Schaltet die Auth für alle Methoden des Controllers ein
        // Muss nicht mehr über die Routes aktiviert werden
        //$this->middleware('auth');

        // Aktiviert Auth nurch für das Speichern
        //$this->middleware('auth')->only('store', 'update');
        $this->middleware('auth');
    }

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
        //$customers = Customer::all();
        $users = User::all();
        $vehicles = Vehicle::all();
        return view('orderform', compact('users', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        /*
        $request->validate([
            'start' => 'required|date|after:now',
            'end' => 'required|date|after:now',
            'customer_id' => 'required|integer|min:1',
            'vehicle_id' => 'required|integer|min:1',
        ]);
        */

        // Validierung erfolgt im OrderRequest
        //$request->validate();

        // Abfrage des angemeldeten Users
        //dd(Auth::user()); // Über eine Fascade
        //dd(auth()->user()); // Über den Helper
        //dd($request->user()); // Über das Request

        $order = new Order;
        $order->fill($request->all());
        $order->save();

        // Order::create($request->all());

        // session(['msg' => 'Bestellung wurde gespeichert']); // Wird dauerhaft in die Session geschrieben
        // session()->put('msg', 'Bestellung wurde gespeichert');

        // session()->flash('msg', 'Bestellung wurde gespeichert'); // Nur bis zur nächten Seite verfügbar
        // $wert = session('msg'); // Wert wird abgefragt und verbleibt in der Session
        // $wert = session('msg', 'Defaultwert...'); // Wert wird abgefragt, wenn nicht vorhanden wird der Default wert verwendet - verbleibt in der Session
        // $wert = session()->pull('msg'); // Wert wird abgefragt und aus der Session gelöscht
        // session()->forget('msg'); // Wert wird gelöscht

        return redirect()
            ->route('order.index')
            ->with('msg', 'Bestellung wurde gespeichert'); // Hängt eine Session dran
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
        $order = Order::find($id);
        //$customers = Customer::all();
        $users = User::all();
        $vehicles = Vehicle::all();
        return view('orderform', compact('users', 'vehicles', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $request->validate();

        $order = Order::find($id);

        $this->authorize('update', $order);

        $order->fill($request->all());
        $order->save();

        return redirect()
            ->route('order.index')
            ->with('msg', 'Bestellung wurde upgedated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $order->delete();

        // session()->flash('msg', 'Bestellung wurde gelöscht!');

        return redirect()
            ->route('order.index')
            ->with('msg', 'Bestellung wurde gelöscht!'); // Werte werden in die Session mit flash geschrieben
    }
}
