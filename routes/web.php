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

Route::get('/invoice', [\App\Http\Controllers\InvoiceController::class, 'index']);
Route::get('/invoice/create', [\App\Http\Controllers\InvoiceController::class, 'create']);
Route::post('/invoice/store', [\App\Http\Controllers\InvoiceController::class, 'store']);
Route::get('/invoice/edit/{id}', [\App\Http\Controllers\InvoiceController::class, 'edit']);
Route::post('/invoice/update/{id}', [\App\Http\Controllers\InvoiceController::class, 'update']);
Route::get('/invoice/show/{id}', [\App\Http\Controllers\InvoiceController::class, 'show']);

