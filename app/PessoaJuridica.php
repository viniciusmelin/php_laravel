<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table= 'pessoa_juridica';
    protected $primarykey = 'pessoa_id';
    protected $fillable = ['pessoa_id','cnpj','razao_social','nome_fantasia'];


    public function pessoa()
    {
        return $this->hasOne('App\Pessoa',"id","pessoa_id");
    }

    public function endereco()
    {
        return $this->hasOne('App\Endereco',"pessoa_id","pessoa_id");
    }
}
