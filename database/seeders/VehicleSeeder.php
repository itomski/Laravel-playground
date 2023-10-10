<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Vehicle::create([
            'registration' => 'HH:AB 123', 
            'brand' => 'Ford', 
            'type' => 'Ka', 
            'description' => 'In einem guten Zustand', 
            'status' => 'Ready'
        ]);
        Vehicle::create([
            'registration' => 'HB:XY 234', 
            'brand' => 'Fiat', 
            'type' => '500', 
            'description' => 'In einem guten Zustand', 
            'status' => 'Ready'
        ]);
        */
        Vehicle::factory()->count(100)->create();
        $this->command->info('Beispieldaten für Vehicles wurden erzeugt');
    }
}
