<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table= 'pessoa_juridica';
    protected $primarykey = 'id';
    protected $fillable = ['cnpj','razao_social','nome_fantasia'];
}
