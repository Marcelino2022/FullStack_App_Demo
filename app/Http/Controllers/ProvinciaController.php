<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Http\Requests\StoreProvinciaRequest;
use App\Http\Requests\UpdateProvinciaRequest;
use Illuminate\Http\Request;
use App\Repositories\ProvinciaRepository;

class ProvinciaController extends Controller
{
    public function __construct(Provincia $provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $provinciaRepository = new ProvinciaRepository($this->provincia);

        //COLETA DE DADOS DA ENTIDADE DO RELACIONAMENTO PROVÍNCIA TEM MEMBROS
        if($request->has('atributos_municipios')){
            $atributos_municipios = 'municipios:id,'.$request->atributos_municipios;
            $provinciaRepository->selectAtributosRegistosRelacionados($atributos_municipios);
        } else{
            $provinciaRepository->selectAtributosRegistosRelacionados('municipios');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE PROVÍNCIA
        if($request->has('filtro')){
            $provinciaRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE PROVÍNCIA
        if($request->has('atributos')){
            $atributos = $request->atributos;
            $provinciaRepository->selectAtributos($request->atributos);
        }

        return  response()->json($provinciaRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProvinciaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvinciaRequest $request)
    {
        $request->validate($this->provincia->rules(), $this->provincia->feedback());
        $provincia = $this->provincia->create($request->all());
        return response()->json($provincia, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\int  $provincia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provincia = $this->provincia->with('municipios')->find($id);
        if($provincia === null)
            return response()->json(['msg' => 'Dado do Recurso requisitado iválido'], 404);
        else return response()->json($provincia, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProvinciaRequest  $request
     * @param  \App\Models\int
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvinciaRequest $request, $id)
    {
        $provincia = $this->provincia->find($id);

        if($provincia === null)
            return response()->json(['msg' => 'Impossível efetuar a atualização, verifique os dados do recurso que pretende atualizar'], 404);

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //PERCORRENDO TODAS AS REGRAS DEFINIDAS NO MODEL
            foreach($provincia->rules() as $input => $regra){

              //COLETAR APENAS AS REGRAS APLICÁVEIS AOS PARAMÊTROS DA REQUISIÇÃO
              if(array_key_exists($input, $request->all())){
                $regrasDinamicas[$input] = $regra;
              }
            }

            $request->validate($regrasDinamicas, $provincia->feedback());

        } else{
            $request->validate($provincia->rules(), $provincia->feedback());
        }

        $provincia->update($request->all());
        return response()->json($provincia, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\int  $provincia
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $provincia = $this->provincia->find($id);

        if($provincia === null)
            return response()->json(['msg' => 'Impossível efetuar a operação, verifique os dados do recurso que pretende aceder.'], 404);
        else {
            $provincia->delete();
            return response()->json(['msg' => 'A Provínica foi removida com sucesso'], 200);
        }
    }
}
