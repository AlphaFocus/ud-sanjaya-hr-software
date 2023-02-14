<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => '$2y$10$wvZt.PqW5x3SOhWp5k1Dx.a53Lw/M0bM0Nt8gB7wu9ceffW4KanAe',
            'role' => 1,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\User::factory(100)->create();
        \App\Models\Production::factory(500)->create();
        \App\Models\Sale::factory(500)->create();

        \App\Models\Route::create([
            'route' => 'Denpasar'
        ]);
        \App\Models\Route::create([
            'route' => 'Tabanan'
        ]);
        \App\Models\Route::create([
            'route' => 'Singaraja'
        ]);
        \App\Models\Route::create([
            'route' => 'Gianyar'
        ]);
        \App\Models\Route::create([
            'route' => 'Negara'
        ]);
    }
}
