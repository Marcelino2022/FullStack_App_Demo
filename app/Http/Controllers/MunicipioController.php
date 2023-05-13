<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Http\Requests\StoreMunicipioRequest;
use App\Http\Requests\UpdateMunicipioRequest;
use Illuminate\Http\Request;
use App\Repositories\MunicipioRepository;

class MunicipioController extends Controller
{
    /**
     * @var Municipio
     */
    public $municipio;

    public function __construct(Municipio $municipio){
        $this->municipio = $municipio;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $municipioRepository = new MunicipioRepository($this->municipio);

        //COLETA DE DADOS DA ENTIDADE DO RELACIONAMENTO MUNICÍPIO TEM LOALIDADES
        if($request->has('atributos_localidades')){
            $atributos_localidades = 'localidades:id,'.$request->atributos_localidades;
            $municipioRepository->selectAtributosRegistosRelacionados($atributos_localidades);
        } else{
            $municipioRepository->selectAtributosRegistosRelacionados('localidades');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE MUNICÍPIO
        if($request->has('filtro')){
            $municipioRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE MUNICÍPIO
        if($request->has('atributos')){
            $atributos = $request->atributos;
            $municipioRepository->selectAtributos($request->atributos);
        }

        return  response()->json($municipioRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMunicipioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMunicipioRequest $request)
    {
        $request->validate($this->municipio->rules(), $this->municipio->feedback());
        $municipio = $this->municipio->create($request->all());
        return response()->json($municipio, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\int  $municipio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $municipio = $this->municipio->with('localidades')->find($id);
        if($municipio === null)
            return response()->json(['msg' => 'Dado do Recurso requisitado iválido'], 404);
        else return response()->json($municipio, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMunicipioRequest  $request
     * @param  \App\Models\int  $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMunicipioRequest $request, $id)
    {
        $municipio = $this->municipio->find($id);

        if($municipio === null)
            return response()->json(['msg' => 'Impossível efetuar a atualização, verifique os dados do recurso que pretende atualizar'], 404);

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //PERCORRENDO TODAS AS REGRAS DEFINIDAS NO MODEL
            foreach($municipio->rules() as $input => $regra){

              //COLETAR APENAS AS REGRAS APLICÁVEIS AOS PARAMÊTROS DA REQUISIÇÃO
              if(array_key_exists($input, $request->all())){
                $regrasDinamicas[$input] = $regra;
              }
            }

            $request->validate($regrasDinamicas, $municipio->feedback());

        } else{
            $request->validate($municipio->rules(), $municipio->feedback());
        }

        $municipio->update($request->all());
        return response()->json($municipio, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\int  $municipio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $municipio = $this->municipio->find($id);

        if($municipio === null)
            return response()->json(['msg' => 'Impossível efetuar a operação, verifique os dados do recurso que pretende atualizar'], 404);
        else {
            $municipio->delete();
            return response()->json(['msg' => 'A coordenação foi removida com sucesso'], 200);
        }
    }
}
