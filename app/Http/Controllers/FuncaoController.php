<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Funcao;
use App\Http\Requests\StoreFuncaoRequest;
use App\Http\Requests\UpdateFuncaoRequest;
use App\Repositories\FuncaoRepository;
use Illuminate\Support\Facades\DB;

class FuncaoController extends Controller
{

    public function __construct(Funcao $funcao)
    {
        $this->funcao = $funcao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $funcaoRepository = new FuncaoRepository($this->funcao);

        //COLETA DE DADOS DA ENTIDADE DO RELACIONAMENTO PROVÍNCIA TEM MEMBROS
        if($request->has('atributos_membros')){
            $atributos_membros = 'membros:id,'.$request->atributos_membros;
            $funcaoRepository->selectAtributosRegistosRelacionados($atributos_membros);
        } else{
            $funcaoRepository->selectAtributosRegistosRelacionados('membros');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE PROVÍNCIA
        if($request->has('filtro')){
            $funcaoRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE PROVÍNCIA
        if($request->has('atributos')){
            $atributos = $request->atributos;
            $funcaoRepository->selectAtributos($request->atributos);
        }

        return  response()->json($funcaoRepository->getResultado(), 200);
    }


    public function listarFuncoes(){

        $funcoes = DB::select('select * from funcoes');
        return response()->json($funcoes, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFuncaoRequest  $request
     * @return \Illuminate\Http\Response
     */

    public $funcao;

    public function store(StoreFuncaoRequest $request)
    {
        $request->validate($this->funcao->rules(), $this->funcao->feedback());
        $funcao = $this->funcao->create($request->all());
        return response()->json($funcao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function show(Funcao $funcao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuncaoRequest  $request
     * @param  \App\Models\Funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuncaoRequest $request, Funcao $funcao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcao  $funcao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcao $funcao)
    {
        //
    }
}
