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
use App\Http\Controllers\ProductsController;
use App\http\Controllers\ContactController;
use GuzzleHttp\Middleware;
// rota usada para redirecionar para a pagina inicial
Route::get('/', [EventController::class,'index']);
// rota usada para criar um evento
Route::get('/events/create', [EventController::class, 'create'])->Middleware('auth');//deixa acessar apenas se o usuario estiver logado 
// rota usada para ver os dados do evento
Route::get('/events/{id}', [EventController::class, 'show']);
// rota usada para salvar os dados do evento no banco de dados
Route::post('/events',[EventController::class,'store']);
// rota usada para excluir um evento
Route::delete('/events/{id}',[EventController::class,'destroy'])->Middleware('auth');//deixa acessar apenas se o usuario estiver logado 
// rota usada para ver os eventos
Route::get('/events/edit/{id}',[EventController::class,'edit'])->Middleware('auth');//deixa acessar apenas se o usuario estiver logado 
// rota usada para atualizar os dados do evento 
Route::put('events/update/{id}',[EventController::class,'update'])->Middleware('auth');//deixa acessar apenas se o usuario estiver logado 
//rota usada para mostrar a view de contatos
Route::get('/contact',[ContactController::class,'index']);
//rota usada para a view de produtos
Route::get('/products',[ProductsController::class,'index']);
//rota usada para redirecionar para a dashboard
Route::get('/dashboard',[EventController::class,'dashboard'])->Middleware('auth');//deixa acessar apenas se o usuario estiver logado 
// rota usada para inserir presença do usuario ao evento
Route::get('/events/join/{id}',[EventController::class,'joinEvent'])->Middleware('auth');//deixa acessar apenas se o usuario estiver logado 
// rota usada para remover a presença do usuario do evento
Route::delete('/events/leave/{id}',[EventController::class,'leaveEvent'])->Middleware('auth');//deixa acessar apenas se o usuario estiver logado 