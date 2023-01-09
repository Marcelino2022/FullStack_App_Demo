<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['Designacao_Categoria'];

    public function rules(){
        return[
            'Designacao_Categoria' => 'required|unique:categorias,Designacao_Categoria,'.$this->id.'|min:3'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Designacao_Categoria.unique' => 'A designação da Categoria já existe',
        ];
    }

    public function membros(){
        //UMA ENTIDADE PODE TER VÁRIOS MEMBROS
        return $this->hasMany('App\Models\Membro');
    }
}
