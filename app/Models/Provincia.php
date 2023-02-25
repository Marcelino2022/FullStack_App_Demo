<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['Designacao_Provincia', 'Codigo_Provincia'];

    public function rules(){
        return [
            'Designacao_Provincia' => 'required|unique:provincias,Designacao_Provincia,'.$this->id.'|min:3',
            "Codigo_Provincia" => 'required|unique:provincias',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Designacao_Provincia.min' => "O campo Designação da Província tem de ter no mínimo 3 caracteres",
            'Designacao_Provincia.unique' => 'A Província já existe.',
            'Codigo_Provincia.unique' => 'O código da Província Já existe.',
        ];
    }

    public function municipios(){
        return $this->hasMany('App\Models\Municipio');
    }
}
