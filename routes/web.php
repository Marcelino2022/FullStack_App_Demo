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
    return view('index');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/coordenacoes', function(){
    return view('app.coordenacoes');
})->name('coordenacoes')->middleware('auth');

Route::get('/todos-os-membros', function(){
    return view('app.membros');
})->name('todos')->middleware('auth');

Route::get('/provincias', function(){
    return view('app.provincias');
})->name('todas')->middleware('auth');

Route::get('/municipios', function(){
    return view('app.municipios');
})->name('municipios')->middleware('auth');

Route::get('/localidades', function(){
    return view('app.localidades');
})->name('localidades')->middleware('auth');

Route::get('/funcoes', function(){
    return view('app.funcoes');
})->name('funcoes')->middleware('auth');
