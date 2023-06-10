<?php

namespace App\Http\Controllers;

use App\Models\Localidade;
use App\Http\Requests\StoreLocalidadeRequest;
use App\Http\Requests\UpdateLocalidadeRequest;
use illuminate\http\Request;
use App\Repositories\LocalidadeRepository;
use Illuminate\Support\Facades\DB;

class LocalidadeController extends Controller
{

/**
 * @var Localidade
 */

 public $localidade;

 public function __construct(Localidade $localidade)
    {
        $this->localidade = $localidade;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $localidadeRepository = new LocalidadeRepository($this->localidade);

        //COLETA DE DADOS DA ENTIDADE DO RELACIONAMENTO LOCALIDADE TEM COORDENAÇÃO
        if($request->has('atributos_coordenacoes')){
            $atributos_coordenacoes = 'coordenacoes:id,'.$request->atributos_coordenacoes;
            $localidadeRepository->selectAtributosRegistosRelacionados($atributos_coordenacoes);
        } else{
            $localidadeRepository->selectAtributosRegistosRelacionados('coordenacoes');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE LOCALIDADE
        if($request->has('filtro')){
            $localidadeRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE LOCALIDADE
        if($request->has('atributos')){
       /*      $atributos = $request->atributos; */
            $localidadeRepository->selectAtributos($request->atributos);
        }

        return  response()->json($localidadeRepository->getResultado(), 200);
    }


    public function obterLocalidadesDeMunicipios(Request $request){

        $dadosLocalidade = DB::select('select l.id, Designacao_Localidade,
                                                l.municipio_id,
                                                Designacao_Municipio,
                                                m.provincia_id,
                                                Designacao_Provincia
                                        from localidades l
                                        Join municipios m ON l.municipio_id = m.id
                                        join provincias p ON m.provincia_id = p.id;'
                                     );

         return response()->json($dadosLocalidade, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocalidadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocalidadeRequest $request)
    {
        $request->validate($this->localidade->rules(), $this->localidade->feedback());
        $localidade = $this->localidade->create($request->all());
        return response()->json($localidade, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\int  $localidade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $localidade = $this->localidade->with('coordenacoes')->find($id);
        if($localidade === null)
            return response()->json(['msg' => 'Dado do Recurso requisitado iválido'], 404);
        else return response()->json($localidade, 200);
    }


    public function obterLocalidadesPorMunicipio($municipio_id){
        $dadosLocalidade = Localidade::select()->where('municipio_id', $municipio_id)->get();
         return response()->json($dadosLocalidade, 201);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocalidadeRequest  $request
     * @param  \App\Models\int  $localidade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocalidadeRequest $request, $id)
    {
        $localidade = $this->localidade->find($id);

        if($localidade === null)
            return response()->json(['msg' => 'Impossível efetuar a atualização, verifique os dados do recurso que pretende atualizar'], 404);

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //PERCORRENDO TODAS AS REGRAS DEFINIDAS NO MODEL
            foreach($localidade->rules() as $input => $regra){

              //COLETAR APENAS AS REGRAS APLICÁVEIS AOS PARAMÊTROS DA REQUISIÇÃO
              if(array_key_exists($input, $request->all())){
                $regrasDinamicas[$input] = $regra;
              }
            }

            $request->validate($regrasDinamicas, $localidade->feedback());

        } else{
            $request->validate($localidade->rules(), $localidade->feedback());
        }

        $localidade->update($request->all());
        return response()->json($localidade, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\int  $localidade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localidade = $this->localidade->find($id);

        if($localidade === null)
            return response()->json(['msg' => 'Impossível efetuar a operação, verifique os dados do recurso que pretende atualizar'], 404);
        else {
            $localidade->delete();
            return response()->json(['msg' => 'A coordenação foi removida com sucesso'], 200);
        }
    }
}
