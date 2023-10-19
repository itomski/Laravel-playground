<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
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

        /*
        if(Cache::has('vehicle.index')) { // Prüft, ob der Key im Cache liegt
            return Cache::get('vehicle.index'); // Liefert die Gecachete View
        }
        else {
            */
            //$vehicles = Cache::remember('vehicles', 5, function(){
            //    return Vehicle::all();
            //});

            // $this->authorize('isAdmin'); // Gate wird geprüft

            //$vehicles = Vehicle::all();
            $vehicles = Vehicle::paginate(10);
            //$vehicles = Vehicle::simplePaginate(10);

            $viewCache = view('vehiclelist', compact('vehicles'))->render();
            //Cache::set('vehicle.index', $viewCache); // Die View wird in Cache geschrieben
            //Cache::put('vehicle.index', $viewCache, 5); // Die View wird für 60 Sek in Cache geschrieben

            return $viewCache;
        //}
        

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

        if(Cache::has('vehicle.create')) {
            return Cache::get('vehicle.create');
        }
        else {
            $viewCache = view('vehicleform')->render();
            //Cache::set('vehicle.create', $viewCache);
            return $viewCache;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request->file('file')->isValid();

        $request->validate([
            'registration' => 'required|min:6|max:12',
            'brand' => 'required|min:2',
            'type' => 'required|min:2',
            'description' => 'required|min:2',
            'file' => 'required|image|max:1024'
        ]);

        try {
            if($request->hasFile('file')) {
                
                $file = $request->file('file');
                $name = $file->getClientOriginalName();

                // File muss noch in public verschoben werden
                Storage::disk('public')->putFileAs('images', $file, $name);
                //Storage::disk('s3')->putFileAs('images', $file, $name);
                
                Vehicle::create([
                    'registration' => $request->input('registration'),
                    'brand' => $request->input('brand'),
                    'type' => $request->input('type'),
                    'description' => $request->input('description'),
                    'file' => $name
                ]);
                
                return redirect()
                    ->route('vehicle.index')
                    ->with('msg', 'Fahrzeug wurde gespeichert');
            }
        }
        catch(Exception $e) {
            return redirect()
                    ->back()
                    ->with('msg', 'Fahrzeug konnte nicht gespeichert werden');
        }
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
        $this->authorize('isAdmin'); // Gate wird geprüft

        $file = $vehicle->file;
        if($file) {
            Storage::disk('public')->delete('images/'.$file);
            //Storage::delete('images/'.$file); // Löscht auf dem standard disk
        }
        $vehicle->delete();
        
        return redirect()
                    ->route('vehicle.index')
                    ->with('msg', 'Fahrzeug wurde gelöscht');
    }

    public function block($id) {

        $this->authorize('isAdmin');

        $vehicle = Vehicle::find($id);
        $vehicle->status = 'Blocked';
        $vehicle->save();

        return redirect()
                    ->route('vehicle.index')
                    ->with('msg', 'Fahrzeug wurde geblock');

    }

    public function ready($id) {

        $this->authorize('isAdmin');

        $vehicle = Vehicle::find($id);
        $vehicle->status = 'Ready';
        $vehicle->save();

        return redirect()
                    ->route('vehicle.index')
                    ->with('msg', 'Fahrzeug wurde freigegeben');
        
    }
}
