<?php

namespace App\Http\Controllers;

use App\Models\Coordenacao;
use App\Models\User;
use App\Http\Requests\StoreCoordenacaoRequest;
use App\Http\Requests\UpdateCoordenacaoRequest;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Http\Request;
use App\Repositories\CoordenacaoRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// @ts-ignore
class CoordenacaoController extends Controller
{
    /**
     * @var Coordenacao
    */
    public $coordenacao;

    public function __construct(Coordenacao $coordenacao){
        $this->coordenacao = $coordenacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $coordenacaoRepository = new CoordenacaoRepository($this->coordenacao);

        //COLETA DE DADOS DA ENTIDADE DO RELACIONAMENTO COORDENAÇÃO TEM MEMBROS
        if($request->has('atributos_membros')){
            $atributos_membros = 'membros:id,'.$request->atributos_membros;
            $coordenacaoRepository->selectAtributosRegistosRelacionados($atributos_membros);
        } else{
            $coordenacaoRepository->selectAtributosRegistosRelacionados('membros');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE COORDENAÇÃO
        if($request->has('filtro')){
            $coordenacaoRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE COORDENAÇÃO
        if($request->has('atributos')){
            $coordenacaoRepository->selectAtributos($request->atributos);
        }

        return  response()->json($coordenacaoRepository->getResultado(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCoordenacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoordenacaoRequest $request)
    {

        $request->validate($this->coordenacao->rules(), $this->coordenacao->feedback());
        $coordenacao = $this->coordenacao->create($request->all());

        $coordenacaoData = Coordenacao::select('id')->where('Telemovel', $request->get('Telemovel'))->get();

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'password_Confirmation' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()], 400);
        }

        if($request->get('password') == $request->get('password_Confirmation')){
            User::create([
                            'name' =>  $request->get('Designacao_Coordenacao'),
                            'email' => $request->get('Email'),
                            'coordenacao_id' => $coordenacaoData[0]->id,
                            'password' =>  Hash::make($request->get('password')),
                        ]);
        } else{
            return response()->json(['msg' => 'Palavra Passe não correspode'], 404);
        }

        return response()->json($validator, 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coordenacao = $this->coordenacao->with('membros')->find($id);
        if($coordenacao === null)
            return response()->json(['msg' => 'Dado do Recurso requisitado iválido'], 404);
        else return response()->json($coordenacao, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoordenacaoRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoordenacaoRequest $request, $id)
    {
        $coordenacao = $this->coordenacao->find($id);

        if($coordenacao === null)
            return response()->json(['msg' => 'Impossível efetuar a atualização, verifique os dados do recurso que pretende atualizar'], 404);

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //PERCORRENDO TODAS AS REGRAS DEFINIDAS NO MODEL
            foreach($coordenacao->rules() as $input => $regra){

              //COLETAR APENAS AS REGRAS APLICÁVEIS AOS PARAMÊTROS DA REQUISIÇÃO
              if(array_key_exists($input, $request->all())){
                $regrasDinamicas[$input] = $regra;
              }
            }

            $request->validate($regrasDinamicas, $coordenacao->feedback());

        } else{
            $request->validate($coordenacao->rules(), $coordenacao->feedback());
        }

        $coordenacao->update($request->all());
        return response()->json($coordenacao, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $coordenacao = $this->coordenacao->find($id);

        if($coordenacao === null)
            return response()->json(['msg' => 'Impossível efetuar a operação, verifique os dados do recurso que pretende atualizar'], 404);
        else {
            $coordenacao->delete();
            return response()->json(['msg' => 'A coordenação foi removida com sucesso'], 200);
        }
    }
}
