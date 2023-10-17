<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\LazyCollection;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Cache::put(key, daten, dauer);
        // $order = Order::find(10);
        //Cache::put('selected', $order, 60); // Speichert ein Objekt für 60 Sek im Cache
        // Cache::forever('selected', $order); // Speicht ein Objekt für ein unbestimmte Zeit im Cache
        
        // $orders = Order::all();
        // Cache::putMany($orders, 60); // Speichert ein Collection von Objekten für 60 Sek im Cache

        // Kein Cache
        //$vehicles = Vehicle::all();

        // Daten werden für 20 Sek im Cache festgehalten
        // Danach erfolgt ein erneuter Abruf von der DB
        $vehicles = Cache::remember('vehicles', 20, function(){
            return Vehicle::all();
        });

        return view('vehiclelist', compact('vehicles'));

        /*
        $wert = $request->request->get('wert');
        $request->request->set('wert', $wert += 100);

        $names = ['peter', 'carol', 'natasha', null, 'bruce', 'carol', 'tony', 'steve', '', 'natasha'];
        $collection = collect($names);

        $coll = $collection->filter(function($name) { // Behält Elemente bei true
            return $name != 'tony';
        })->reject(function($name) { // Enternt Elemente bei true
            return empty($name);
        })->map(function($name) { // Transformation der Elemente
            return ucfirst($name);
        });

        // return $coll->contains('Bruce'); // Prüft, ob wert in der Collection vorhanden
        // return $coll->count(); // liefert eine Anzahl
        // return $coll->countBy(); // liefert eine Anzahl des Vorkommens gleicher Werte

        $output = '';
        */

        /*
        $coll->each(function($item, $key) use (&$output) {
            $output .= $key.': '.$item.', ';
        });
        return $output;
        */

        //return $coll->random(); // liefert einen Wert nach Zufall
        //return $coll->random(2); // liefert Anzahl Werte nach Zufall

        /*
        function getNums() {
            $nums = [];
            foreach(range(1, 100000) as $num) {
                $nums[] = $num;
            }
            return $nums;
        }

        // Generator
        function getNumsLazy() {
            foreach(range(1, 100000) as $num) {
                yield $num;
            }
        }

        foreach(getNumsLazy() as $num) {
            $output.= $num.',';
        }
        return $output;
        */

        // Es wird ein Elemet geholt und verarbeiten, danach erst das nächste
        /*
        return $collection->lazy()->filter(function($name) { // Behält Elemente bei true
            return $name != 'tony';
        })->reject(function($name) { // Enternt Elemente bei true
            return empty($name);
        })->map(function($name) { // Transformation der Elemente
            return ucfirst($name);
        });
        */

        //return get_class($collection);
        //return get_class($collection->lazy());

        //Collection::
        /*
        $lazy = LazyCollection::make(function() {
            foreach(range(1, 100) as $num) {
                yield $num;
            }
        });

        return $lazy->map(function($num) {
            return $num * 2;
        });
        */

        /*
        $vehicles = Vehicle::all(); // Daten werden einmalig abgefragt
        //return get_class($vehicles);

        $regs = $vehicles->map(function($vehicle) {
            return $vehicle->registration;
        });
        return $regs;
        */

        // in der Ausgabe werden diese attribute ausgeblendet
        // only nimmt nur Objekte mit passender ID mit
        //return Order::all()->makeHidden(['created_at', 'updated_at', 'deleted_at'])->only([22,23]);

        // return Vehicle::all(); // Sendet eine Abfrage

        // wird in stücken geholt
        /*
        $erg = LazyCollection::make(function(){
            // definieren in welchen Stücken die Daten abgeholt werden
        });
        return $erg;
        */

        //return get_class(Vehicle::get()); // Elequent-Collection: Stellt eine Anfrage und holte alle Daten
        //return get_class(Vehicle::lazy()); // LazyCollection: Fragt die Daten Datensatz für Datensatz
        //return get_class(Vehicle::cursor()); // LazyCollection: Fragt die Daten Datensatz für Datensatz
        //return Vehicle::lazy()->chunk(10); // Sendet mehrere Abfragen und holt jeweis nur 10 Datensätze
        
        /*
        $coll = Vehicle::all();
        //Produziert eine neue Collection und weist sie auf $coll zu
        $coll = $coll->map(function($obj) {
            return $obj->registration;
        });

        // Hängt diese Methode an neue Collections
        Collection::macro('getRegs', function() {
            return $this->map(function($obj) {
                return $obj->registration;
            });
        });

        $coll = Vehicle::all();        

        logger()->info('Log aus dem Controller.');

        //return $coll;
        return $coll->getRegs();
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $order = Cache::get('selected'); // Fragt ein Objekt aus dem Cache ab
        // Cache::forget('selected'); // Entrent ein Objekt aus dem Cache

        // $orders = Cache::many('orders'); // Fragt eine Collection von Objekten aus dem Cache ab
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
