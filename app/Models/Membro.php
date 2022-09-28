<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;
    protected $fillable = ['Nome_Membro', 'Data_Nascimento', 'Numero_Documento', 'Tipo_Documento',
                            'Sigla_Tipo_Documento', 'Imagem_Membro', 'Telemovel_Membro' ,'Email_Membro',
                            'ID_Mobilizador', 'ID_Responsavel', 'coordenacao_id'];

    public function rules(){
        return [
            'coordenacao_id' => 'exists:coordenacoes,id',
            'Nome_Membro' => 'required:membros,Nome_Membro,'.$this->id.'|min:5',
            'Numero_Documento' => 'required|unique:membros',
            'Sigla_Tipo_Documento' => 'required:membros|max:5',
            'Imagem_Membro' => 'required|file|mimes:png,jpeg,jpg',
            "Telemovel_Membro" => 'required|unique:membros',
            "Email_Membro" => 'unique:membros',
            "Telemovel_Membro" => 'required|integer'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'Nome_Membro.min' => "O campo Designação da Coordenação tem de ter no mínimo 5 caracteres",
            'Numero_Documento.unique' => 'O Documento já está associada à uma Coordenação',
            'Imagem_Membro' => 'O Arquivo deve ser uma imagem do tipo PNG, jpeg ou JPG',
            'Telefone_Membro.unique' => 'O :attribute já está associado à um utilizador',
            'Email_Membro.unique' => 'O Email :attribute já existe uma Coordenação',
            'Bairro.unique' => 'No bairo :attribute já existe uma Coordenação'
        ];
    }

    public function coordenacao(){
        //MUM MEMBRO PERTENCE A UMA COORDENACAO
        return $this->belongsTo('App\Models\Coordenacao');
    }
}
