<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed // führt nur die Seeder aus
        // php artisan migrate --seed // führt nur die Migrations aus und danach die Seeder
        // php artisan migrate:refresh --seed // aktuallisiert die Migrations und führt danach die Seeder aus

        $this->call([
            VehicleSeeder::class, // Ruft den ModelSeeder auf
            CustomerSeeder::class 
        ]);
    }
}
