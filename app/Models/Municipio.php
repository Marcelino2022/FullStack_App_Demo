<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = ['Designacao_Municipio', 'Codigo_Municipio', 'provincia_id'];

    public function rules(){
        return [
            'Designacao_Municipio' => 'required|unique:municipios,Designacao_Municipio,'.$this->id.'|min:3',
            //"Codigo_Municipio" => 'required|unique:municipios',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Designacao_Municipio.min' => "O campo Designação do Município tem de ter no mínimo 3 caracteres",
            'Designacao_Municipio.unique' => 'A Província já existe.',
            //'Codigo_Municipio' => 'O código da Município Já existe.',
        ];
    }

    public function Provincia(){
        return $this->belongsTo('App\Models\Provincia');
    }

    public function localidades(){
        return $this->hasMany('App\Models\localidade');
    }
}
