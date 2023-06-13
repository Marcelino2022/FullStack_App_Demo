<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Funcao extends Model
{
    use HasFactory;
    protected $table = 'funcoes';

    protected $fillable = ['Designacao_Funcao', 'Sigla_Funcao'];

    public function rules(){
        return [
            'Designacao_Funcao' => 'required|unique:funcoes,Designacao_Funcao,'.$this->id.'|min:5',

        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Designacao_Funcao.min' => "O campo Designação da Coordenação tem de ter no mínimo 10 caracteres",
        ];
    }

    public function Membro(){
        return $this->hasMany(Membro::class);
    }
}
