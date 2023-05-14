<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipio;

class Localidade extends Model
{
    use HasFactory;
    protected $fillable = ['Designacao_Localidade', 'municipio_id'];

    public function rules(){
        return [
            'Designacao_Localidade' => 'required|unique:localidades,Designacao_Localidade,'.$this->id.'|min:3',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Designacao_Localidade.min' => "O campo Designação do Localidade tem de ter no mínimo 3 caracteres",
            'Designacao_Localidade.unique' => 'A Localidade já existe.',
        ];
    }

    public function Municipio(){
        return $this->belongsTo(Municipio::class);
    }

    public function coordenacoes(){
        return $this->hasOne('App\Models\Coordenacao');
    }
}
