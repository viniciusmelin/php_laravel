<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = 'pessoa_fisica';
    protected $primarykey = 'pessoa_id';
    protected $fillable = ['pessoa_id','data_nascimento','nome','sobrenome'];

    public function pessoa()
    {
        return $this->hasOne('App\Pessoa',"id","pessoa_id");
    }

    public function endereco()
    {
        return $this->hasOne('App\Endereco',"pessoa_id","pessoa_id");
    }
}
