<?php

namespace App\Http\Controllers;

use App\Models\Permissoes;
use App\Http\Requests\StorePermissoesRequest;
use App\Http\Requests\UpdatePermissoesRequest;
use App\Repositories\PermissoesRepository;
use Illuminate\Http\Request;

class PermissoesController extends Controller
{
    /**
     * @var Permissoes
     *
     */
    public $permissoes;
    public $request;

    public function __construct(Permissoes $permissoes){
        $this->permissoes = $permissoes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
      * @
      */
    public function index(Request $request)
    {
/*         $permissoesRepository = new PermissoesRepository($this->permissoes);

        //COLETA DE DADOS DA ENTIDADE DO RELACIONAMENTO PROVÍNCIA TEM MEMBROS
        if($request->has('atributos_coordenacoes')){
            $atributos_coordenacoes = 'coordenacoes:id,'.$request->atributos_coordenacoes;
            $permissoesRepository->selectAtributosRegistosRelacionados($atributos_coordenacoes);
        } else{
            $permissoesRepository->selectAtributosRegistosRelacionados('coordenacoes');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE PROVÍNCIA
        if($request->has('filtro')){
            $permissoesRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE PROVÍNCIA
        if($request->has('atributos')){
            $atributos = $request->atributos;
            $permissoesRepository->selectAtributos($request->atributos);
        } */

        $permissoes = Permissoes::all();
        return  response()->json($permissoes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePermissoesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissoesRequest $request)
    {
        $request->validate($this->permissoes->rules(), $this->permissoes->feedback());
        $permissoes = $this->permissoes->create($request->all());
        return response()->json($permissoes, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\int  $permissoes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissoes = $this->permissoes->with('coordenacao')->find($id);
        if($permissoes === null)
            return response()->json(['msg' => 'Dado do Recurso requisitado iválido'], 404);
        else return response()->json($permissoes, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissoesRequest  $request
     * @param  \App\Models\int  $permissoes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissoesRequest $request, $id)
    {
        $permissoes = $this->permissoes->find($id);

        if($permissoes === null)
            return response()->json(['msg' => 'Impossível efetuar a atualização, verifique os dados do recurso que pretende atualizar'], 404);

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //PERCORRENDO TODAS AS REGRAS DEFINIDAS NO MODEL
            foreach($permissoes->rules() as $input => $regra){

              //COLETAR APENAS AS REGRAS APLICÁVEIS AOS PARAMÊTROS DA REQUISIÇÃO
              if(array_key_exists($input, $request->all())){
                $regrasDinamicas[$input] = $regra;
              }
            }

            $request->validate($regrasDinamicas, $permissoes->feedback());

        } else{
            $request->validate($permissoes->rules(), $permissoes->feedback());
        }

        $permissoes->update($request->all());
        return response()->json($permissoes, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\int  $permissoes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissoes = $this->permissoes->find($id);

        if($permissoes === null)
            return response()->json(['msg' => 'Impossível efetuar a operação, verifique os dados do recurso que pretende atualizar'], 404);
        else {
            $permissoes->delete();
            return response()->json(['msg' => 'A Permissão foi removida com sucesso'], 200);
        }
    }
}
