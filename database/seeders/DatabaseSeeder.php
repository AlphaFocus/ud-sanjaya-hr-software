<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(100)->create();
        \App\Models\Production::factory(500)->create();
        \App\Models\Sale::factory(500)->create();

        \App\Models\Route::create([
            'route' => 'Denpasar']);
        \App\Models\Route::create([
            'route' => 'Tabanan']);
        \App\Models\Route::create([
            'route' => 'Singaraja']);
        \App\Models\Route::create([
            'route' => 'Gianyar']);
        \App\Models\Route::create([
            'route' => 'Negara']);
    }
}
