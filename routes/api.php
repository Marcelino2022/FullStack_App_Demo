<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('jwt.auth')->group(function(){

    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::apiResource('coordenacao', 'App\Http\Controllers\CoordenacaoController');
    Route::apiResource('funcao', 'App\Http\Controllers\FuncaoController');
    Route::apiResource('localidade', 'App\Http\Controllers\LocalidadeController');
    Route::apiResource('membro_funcao', 'App\Http\Controllers\MembroFuncaoController');
    Route::apiResource('membro', 'App\Http\Controllers\MembroController');
    Route::apiResource('mobilizador', 'App\Http\Controllers\MobilizadorController');
    Route::apiResource('provincia', 'App\Http\Controllers\ProvinciaController');
    Route::apiResource('municipio', 'App\Http\Controllers\municipioController');
    Route::apiResource('responsavel', 'App\Http\Controllers\responsavelController');
    Route::apiResource('telefone_coordenacao', 'App\Http\Controllers\TelefoneCoordenacaoController');
    Route::apiResource('categoria', 'App\Http\Controllers\CategoriaController');
    Route::apiResource('permissoes', 'App\Http\Controllers\PermissoesController');
    Route::apiResource('funcao', 'App\Http\Controllers\FuncaoController');

    Route::get('funcoes/listar', 'App\Http\Controllers\FuncaoController@listarFuncoes');
    Route::get('localidades_de_municipios', 'App\Http\Controllers\LocalidadeController@obterLocalidadesDeMunicipios');
    Route::get('provinciasComMunicipios', 'App\Http\Controllers\ProvinciaController@provinciasComMunipios');
    Route::get('localidadePorMunicipio/{municipio_id}', 'App\Http\Controllers\LocalidadeController@obterLocalidadesPorMunicipio');
    Route::get('municipioComLocalidades/{provincia_id}', 'App\Http\Controllers\municipioController@obterMunicipiosComLocalidades');
});

Route::post('/', 'App\Http\Controllers\AuthController@login');
Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');






