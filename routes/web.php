<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('auth.login');
});

Route::get('register', function () {
    return view('auth.register');
})->name('register');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('pages.dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('dashboard', function(){
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('home', [HomeController::class , 'index'])->name('home');

    Route::get('users', [HomeController::class , 'indexUser'])->name('indexUser');

    Route::get('/details/{id}', [HomeController::class , 'showUser'])->name('showUser');

    Route::get('details/export/{id}', [HomeController::class, 'pdf'])->name('pdf');

    Route::get('sale', function(){
        return view('pages.sale');
    })->name('sale');
});
