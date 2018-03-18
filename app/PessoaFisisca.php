<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PessoaFisisca extends Model
{
    protected $table = 'pessoa_fisica';
    protected $primarykey = 'id';
    protected $fillable = ['id','cpf','data_nascimento','nome','sobrenome'];
}
