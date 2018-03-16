<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table= "endereco";
    protected $primarykey="id";
    protected $fillable = ['id','logradouro','numero','complemento','bairro','cidade','uf','pessoa_id'];

    public function pessoafisica()
    {
        return $this->belongsTo('App\PessoaFisica',);
    }
}
