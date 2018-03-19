<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table= "pessoa";
    protected $primarykey = "id";
    protected $fillable = ['cpfcnpj'];

    public function pessoaFisica()
    {
        return $this->hasOne('App\PessoaFisica','pessoa_id','id');
    }
    public function pessoaJuridica()
    {
        return $this->hasOne('App\PessoaJuridica','pessoa_id','id');
    }
}
