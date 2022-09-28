<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordenacao extends Model
{
    use HasFactory;
    protected $table = 'coordenacoes';
    protected $fillable = ['Designacao_Coordenacao', 'Endereco_Coordenacao', 'Bairro', 'Email', 'ID_Localidade'];

    public function rules(){
        return [
            'Designacao_Coordenacao' => 'required|unique:coordenacoes,Designacao_Coordenacao,'.$this->id.'|min:10',
            "Endereco_Coordenacao" => 'required|unique:coordenacoes',
            "Bairro" => 'required|unique:coordenacoes',
            "Email" => 'required|unique:coordenacoes',
            "ID_Localidade" => 'required|unique:coordenacoes'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Designacao_Coordenacao.min' => "O campo Designação da Coordenação tem de ter no mínimo 10 caracteres",
            'Endereco_Coordenacao.unique' => 'O endereço já está associada à uma Coordenação',
            'Designacao_Coordenacao.unique' => 'A designação da Entidade já existe',
            'Email.unique' => 'O Email :attribute já existe uma Coordenação',
            'Bairro.unique' => 'No bairo :attribute já existe uma Coordenação',
            'ID_Localidade.unique' => 'Não pode registar uma nova coordenação para a Localidade indicada, pois já existe uma Coordenação'
        ];
    }

    public function membros(){
        //UMA ENTIDADE PODE TER VÁRIOS MEMBROS
        return $this->hasMany('App\Models\Membro');
    }
}
