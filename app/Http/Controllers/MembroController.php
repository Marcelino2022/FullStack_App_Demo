<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Membro;
use App\Http\Requests\StoreMembroRequest;
use App\Http\Requests\UpdateMembroRequest;
use Illuminate\Http\Request;
use App\Repositories\MembroRepository;
use Illuminate\Support\Facades\DB;

class MembroController extends Controller
{
    /**
     * @var Membro
     */
    public $membro;

    public function __construct(Membro $membro){
        $this->membro = $membro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $membroRepository = new MembroRepository($this->membro);

        //COLETA DE DADOS DA ENTIDADE DO RELACIONAMENTO COORDENAÇÃO TEM MEMBROS
        if($request->has('atributos_coordenacao')){

            $atributos_coordenacao = 'coordenacao:id,'.$request->atributos_coordenacao;
            $atributos_categoria = 'categoria:id,'.$request->atributos_categoria;

            $membroRepository->selectAtributosRegistosRelacionados($atributos_coordenacao, $atributos_categoria);
        } else{
            $membroRepository->selectAtributosRegistosRelacionados('coordenacao');
        }

        //IMPLEMENTAÇÃO DO FILTRO WHERE PARA A ENTIDADE COORDENAÇÃO
        if($request->has('filtro')){
            $membroRepository->filtro($request->filtro);
        }

        //COLETA DE DADOS DA ENTIDADE COORDENAÇÃO
        if($request->has('atributos')){
            $atributos = $request->atributos;
            $membroRepository->selectAtributos($request->atributos);
        }

        //return response()->json($this->membro->with('coordenacao')->get(), 200);
        return response()->json($membroRepository->getResultado(), 200);
    }


    public function listarMembros(Request $request){

        //$membros = Membro::select()->where('id', $request->get('id'));
        $membros = DB::select(' SELECT  Nome_Membro,
                                        Email_Membro,
                                        Telemovel_Membro,
                                        Designacao_Categoria,
                                        Designacao_Coordenacao,
                                        Designacao_Funcao
                                FROM membros m
                                JOIN coordenacoes c ON c.id = m.coordenacao_id
                                JOIN funcoes f ON f.id = m.funcao_id
                                JOIN categorias cat ON cat.id = m.categoria_id');

        return response()->json(['membros' => $membros[0]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMembroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembroRequest $request)
    {
        $request->validate($this->membro->rules(), $this->membro->feedback());

        $imagem = $request->file('Imagem_Membro');
        $imagem_URN = "";

        if($request->file('Imagem_Membro')){
            $imagem_URN = $imagem->store('imagens/perfil', 'public');
        }

        $membro = $this->membro->create([
            'Nome_Membro' =>            $request->Nome_Membro,
            'Data_Nascimento' =>        $request->Data_Nascimento,
            'Numero_Documento' =>       $request->Numero_Documento,
            'Data_Alistamento' =>       $request->Data_Alistamento,
            'Morada_Membro' =>          $request->Morada_Membro,
            'Tipo_Documento' =>         $request->Tipo_Documento,
            'Sigla_Tipo_Documento' =>   $request->Sigla_Tipo_Documento,
            'Imagem_Membro' =>          $imagem_URN,
            'Telemovel_Membro' =>       $request->Telemovel_Membro,
            'Email_Membro' =>           $request->Email_Membro,
            'mobilizador_id' =>         $request->mobilizador_id,
            'coordenacao_id' =>         $request->coordenacao_id,
            'categoria_id' =>           $request->categoria_id,
            'funcao_id' =>              $request->funcao_id,
        ]);

        //$membro = $this->membro->create($request->all());
        return response()->json($membro, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $membro = $this->membro->with('coordenacao, categoria')->find($id);
        if($membro === null)
            return response()->json(['msg' => 'Ação recusada, os dados do recurso solicitado são inválidos'], 404);
        else
            return response()->json($membro, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMembroRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembroRequest $request, $id)
    {
        $membro = $this->membro->find($id);
        if($membro === null)
            return response()->json(['msg' => 'Impossível efetuar a atualização, verifique os dados do recurso que pretende atualizar'], 404);

        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            //PERCORRENDO TODAS AS REGRAS DEFINIDAS NO MODEL
            foreach($membro->rules() as $input => $regras){

                //COLETAR APENAS AS REGRAS APLICÁVEIS AOS PARAMÊTROS DA REQUISIÇÃO
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regras;
                }
                $request->validate($regrasDinamicas, $membro->feedback());
            }

        } else {
            $request->validate($membro->rules(), $membro->feedback());
        }

        //REMOVE O ARQUIVO ANTIGO, CASO UM NOVO ARQUIVO TENHA SIDO ENVIADO NO REQUEST
        if($request->file('Imagem_Membro')){
            Storage::disk('public')->delete($membro->Imagem_Membro);
        }

        $imagem = $request->file('Imagem_Membro');
        $imagem_URN = $imagem->store('imagens/perfil', 'public');

        //PREENCHER O OBJECTO MARCA COM OS DADOS DO REQUEST
        $membro->fill($request->all());
        $membro->Imagem_Membro = $imagem_URN;

        $membro->save();
        return response()->json($membro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $membro = $this->membro->find($id);
        if($membro === null){
            return response()->json(['msg' => 'Impossível efetuar a operação, verifique os dados do recurso que pretende atualizar'], 404);
        }

        //REMOVE O ARQUIVO ANTIGO CASO EXISTA
        Storage::disk('public')->delete($membro->Imagem_Membro);

        $membro->delete();
        return response()->json(['msg' => 'o Membro foi removida com sucesso'], 200);
    }
}
