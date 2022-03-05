<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/storeOrder', [\App\Http\Controllers\OrderController::class, 'storeOrder'])->name('store');
Route::put('/updateOrder/{order}', [\App\Http\Controllers\OrderController::class, 'update'])->name('update');

