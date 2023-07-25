<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/transactions', [TransactionController::class, 'index'])->name('home');
Route::get('/form', [TransactionController::class, 'create'])->name('form');
Route::post('/add', [TransactionController::class, 'store'])->name('add');
Route::get('/sup', [TransactionController::class, 'destroy'])->name('sup');