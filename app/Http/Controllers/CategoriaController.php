<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Illuminate\Http\Request;
use App\Repositories\CategoriaRepository;

class CategoriaController extends Controller
{
    /**
     *@var categoria
     */
    public $categoria;
    
    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoriaRepository = new CategoriaRepository($this->categoria);

        //COLETA DE DADOS DA CATEGORIA DO RELACIONAMENTO MEMBRO PERTENCE A CATEGORIA
        if($request->has('atributos_membros')){
            $atributos_membros = 'membros:id,'.$request->atributos_membros;
            $categoriaRepository->selectAtributosRegistosRelacionados($atributos_membros);
        } else{
            $categoriaRepository->selectAtributosRegistosRelacionados('membros');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE PROVÍNCIA
        if($request->has('filtro')){
            $categoriaRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE PROVÍNCIA
        if($request->has('atributos')){
            $atributos = $request->atributos;
            $categoriaRepository->selectAtributos($request->atributos);
        }

        return  response()->json($categoriaRepository->getResultado(), 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaRequest $request)
    {
        $request->validate($this->categoria->rules(), $this->categoria->feedback());
        $categoria = $this->categoria->create($request->all());
        return response()->json($categoria, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\int  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = $this->categoria->with('membros')->find($id);
        if($categoria === null)
            return response()->json(['msg' => 'Dado do Recurso requisitado iválido'], 404);
        else return response()->json($categoria, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriaRequest  $request
     * @param  \App\Models\int  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaRequest $request, $id)
    {
        $categoria = $this->categoria->find($id);

        if($categoria === null)
            return response()->json(['msg' => 'Impossível efetuar a atualização, verifique os dados do recurso que pretende atualizar'], 404);

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //PERCORRENDO TODAS AS REGRAS DEFINIDAS NO MODEL
            foreach($categoria->rules() as $input => $regra){

              //COLETAR APENAS AS REGRAS APLICÁVEIS AOS PARAMÊTROS DA REQUISIÇÃO
              if(array_key_exists($input, $request->all())){
                $regrasDinamicas[$input] = $regra;
              }
            }

            $request->validate($regrasDinamicas, $categoria->feedback());

        } else{
            $request->validate($categoria->rules(), $categoria->feedback());
        }

        $categoria->update($request->all());
        return response()->json($categoria, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\int  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = $this->categoria->find($id);

        if($categoria === null)
            return response()->json(['msg' => 'Impossível efetuar a operação, verifique os dados do recurso que pretende atualizar'], 404);
        else {
            $categoria->delete();
            return response()->json(['msg' => 'A Categoria foi removida com sucesso'], 200);
        }
    }
}
