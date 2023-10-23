<?php

use App\Exceptions\VehicleException;
use App\Exceptions\VehicleNotFoundException;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Jobs\SendMailToAll;
use App\Models\Vehicle;
use App\Notifications\StatusUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ohne Middleware
Route::resource('/order', OrderController::class);

//Route::resource('/order', OrderController::class)->middleware('auth'); // Erfordert eine Anmeldung

// Aktiviert die Authentifizierung nur für die store Methode
//Route::resource('/order', [OrderController::class, 'store'])->middleware('auth');

// Middleware wird selektiv an Routes gehängt
Route::resource('/vehicle', VehicleController::class)->middleware(['postlog', 'prelog:vehicle']);
Route::get('/vehicle/block/{id}', [VehicleController::class, 'block'])->name('vehicle.block');
Route::get('/vehicle/ready/{id}', [VehicleController::class, 'ready'])->name('vehicle.ready');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
Route::get('/test1', function() {
    return 'TEST1';
})->middleware('auth');

Route::get('/test2', function() {
    return 'TEST2';
})->middleware('auth');

Route::get('/test3', function() {
    return 'TEST3';
})->middleware('auth');
*/

// Deklariert eine Gruppe von Rauts, die eine bestimme
// Middleware Konfiguration brauchen
Route::middleware('auth')->group(function() {

    Route::get('/test1', function() {
        return 'TEST1';
    });

    Route::get('/test2', function() {
        return 'TEST2';
    });
});

Route::middleware('auth.basic')->group(function() {

    Route::get('/test3', function() {
        return 'TEST3';
    });
});

Route::get('/debug-page', function(Request $request) {
    $user = $request->user();
    if($user) {
        Log::alert('Info-Info von User: '.$user->name);
        Log::error('Error-Info von User: '.$user->name);
        Log::warning('Warning-Info von User: '.$user->name);
        Log::notice('Notice-Info von User: '.$user->name);
        Log::info('Info-Info von User: '.$user->name);
        Log::debug('Debug-Info von User: '.$user->name);
        //logger()->debug('Debug-Info von User: '.$user->name); // mit dem Helper
    } else
        Log::debug('Debug-Info von Gast');
    return 'Mein Content';
});

Route::get('/profile', [ProfileController::class, 'display'])->name('profile.display');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/user', [UserController::class, 'display'])->name('user.display');

Route::get('/user/role/create', [UserController::class, 'createRoles'])->name('user.role.create');

Route::post('/user/role/attach', [UserController::class, 'attachRoles'])->name('user.role.attach');

Route::get('/user/role/select', [UserController::class, 'rolesAttachForm'])->name('user.role.select');

Route::get('/user/sendmail', function(){
    SendMailToAll::dispatch()->onQueue('mails');
    //dispatch(new SendMailToAll());
    return 'Email wurden an Queue weitergegeben';
});

Route::get('/user/wichtig', function(){
    SendMailToAll::dispatch()->onQueue('important');
    //dispatch(new SendMailToAll());
    return 'Email wurden an Queue(important) weitergegeben';
});

Route::get('/user/mehrere', function(){
    // Startet mehrere Jobs auf einen Schlag
    SendMailToAll::withChain([
        // weitere Jobs
    ])->dispatch()->onQueue('important');
    return 'Email wurden an Queue(important) weitergegeben';
});

Route::get('/user/mehrere', function(){
    //
});

Route::get('/cardata/{page}', function(int $page = 0){

    /*
    $client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://car-data.p.rapidapi.com/cars?limit=10&page='.$page, [
	'headers' => [
		'X-RapidAPI-Host' => 'car-data.p.rapidapi.com',
		'X-RapidAPI-Key' => 'f0ed8b564cmshf7a8a962c4f9bdbp1fe78djsn9820c420fa32',
	],
]);

echo $response->getBody();
    */

    $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'car-data.p.rapidapi.com',
            'X-RapidAPI-Key' => '... Hier kommt der API-Key von RapidAPI rein ...',
        ]
    )->get('https://car-data.p.rapidapi.com/cars', [
        'limit' => 10,
        'page' => $page
    ]);
    return $response;
});

Route::get('/vehicle/details/{id}', function($id){

    //try {
        try {
            $vehicle = Vehicle::findOrFail($id); // Produziert eine Exception, wenn nichts gefunden wird
            return $vehicle;
        }
        catch(Exception $e) {
            // Wenn Fahrzeug nicht gefunden wird, will ich die Exception in VehicleNotFoundException ändern
            throw new VehicleNotFoundException();
        }
    /* }
    catch(VehicleNotFoundException $e) {
        report($e);
    } */
});

/*
Route::get('/vehicle/details/{id}', function($id){

    //$vehicle = Vehicle::find($id);
    try {
        //$vehicle = Vehicle::findOrFail($id); // Produziert eine Exception, wenn nichts gefunden wird
        
        $vehicle = Vehicle::find($id);
        if(!$vehicle) {
            //throw new Exception('Daten sind nicht da');
            throw new VehicleNotFoundException();

            //$ex = new VehicleNotFoundException();
            //throw $ex;
        }
        
        return $vehicle;
    }
    catch(VehicleNotFoundException $e) {
        return 'VNFE: '.$e->getMessage();
    }
    catch(Exception $e) {
        return 'BASIC: '.$e->getMessage();
    }
});
*/

