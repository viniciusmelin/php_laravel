<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table= "endereco";
    protected $primarykey="pessoa_id";
    protected $fillable = ['pessoa_id','logradouro','numero','complemento','bairro','cidade','uf','cep'];

    public function pessoafisica()
    {
        return $this->hasOne('App\PessoaFisica',"pessoa_id","pessoa_id");
    }
    public function pessoajuridica()
    {
        return $this->hasOne('App\PessoaJuridica',"pessoa_id","pessoa_id");
    }
}
