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

// importar o controller

use App\Http\Controllers\EventController;

Route::get('/', [EventController::class,'index']);
Route::get('/events/create', [EventController::class, 'create']);


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/produtos', function () {
    return view('products');
});


Route::get('/produtos/{id}', function ($id) {
    return view('produ',
    [
        'id' => $id
    ]);
});