<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissoes extends Model
{

    protected $fillable = ['Designacao_Permissao'];

    public function rules(){
        return [
            'Designacao_Permissao' => 'required|unique:permissoes,Designacao_Permissao,'.$this->id.'|min:3'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Designacao_Permissao.min' => "O campo Designação da Permissão tem de ter no mínimo 13 caracteres",
        ];
    }

    use HasFactory;
        public function coordenacao(){
        return $this->hasMany('App\Models\Coordenacao');
    }
}
