<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request){

        $credenciais = $request->all(['email', 'password']);

        //autenticação (email, senha)
        $token = auth('api')->attempt($credenciais);
        //dd($token);

        if($token)
            return response()->json(['token' => $token]);
        else
            return response()->json(['erro' => 'Acesso negado'], 403);
        return 'login';
    }

    public function logout(){
        auth('api')->logout();
        return response()->json(['msg' => 'Logout foi realizado com sucesso!']);
    }

    public function refresh(){
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function me(){
        return response()->json(auth()->user());
    }

    public function getUserAuthenticated(Request $request){

        $user = User::select()->where('email', $request->get('email'))->get();
        return response()->json(['user' => $user]);
    }

    public function dadosCoordenacao(Request $request){
        $coordenacao = DB::select(' SELECT * FROM coordenacoes c
                                    JOIN permissoes p ON p.id = c.permissoes_id
                                    WHERE c.id=?', [$request->get('id')]);

        return response()->json(['coordenacao' => $coordenacao]);
    }

}
