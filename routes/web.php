<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. N, '[0-9]+'ow create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/transactions', [TransactionController::class, 'index'])->name('home');
Route::get('/form', [TransactionController::class, 'create'])->name('form');
Route::post('/add', [TransactionController::class, 'store'])->name('add');
Route::get('/transactions/destroy/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
Route::get('/transactions/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
Route::post('/transactions/update/{id}', [TransactionController::class, 'update'])->name('transaction.update');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/categories/add', [CategoryController::class, 'store'])->name('addCategories');
