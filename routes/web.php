<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
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

Auth::routes();
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

Route::middleware('auth')->group(function () {

    
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

    
    Route::get('/', function () {
        return redirect()->route('tickets.index', Auth::user());
    });
    Route::resource('tickets', TicketController::class);

    Route::resource('users', UserController::class);
});
