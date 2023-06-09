<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StatController;
use App\Models\Ticket;

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

    Route::get('/tickets/exportCSV/', [TicketController::class, 'exportCSV'])->name('tickets.exportCSV');
    Route::get('/tickets/exportPDF/', [TicketController::class, 'exportPDF'])->name('tickets.exportPDF');
    Route::post('/tickets/close/{ticket}', [TicketController::class, 'close'])->name('tickets.close');
    Route::post('/tickets/open/{ticket}', [TicketController::class, 'open'])->name('tickets.open');
    Route::resource('tickets', TicketController::class);

    Route::get('/users/disabled', [UserController::class, 'disabled'])->name('users.disabled');
    Route::post('/users/restore/{user}', [UserController::class, 'restore'])->withTrashed()->name('users.restore');
    Route::resource('users', UserController::class);

    Route::resource('files', FileController::class);

    Route::resource('comments', CommentController::class);

    Route::resource('stats', StatController::class);
});
