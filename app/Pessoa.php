<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table= "pessoa";
    protected $primarykey = "id";
    protected $fillable = ['id','cpfcnpj'];

    protected $hidden = ['created_at','updated_at'];
    public function endereco()
    {
        return $this->hasOne('App\Endereco','pessoa_id','id');
    }
    public function pessoaFisica()
    {
        return $this->hasOne('App\PessoaFisica','pessoa_id','id');
    }
    public function pessoaJuridica()
    {
        return $this->hasOne('App\PessoaJuridica','pessoa_id','id');
    }

    public function formartarCPF()
    {
        $string = $this->cpfcnpj;
        $string =preg_replace("[^0-9]", "", $string);
        $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) . 
        '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
        return $string;
    }

    public function formartarCNPJ()
    {
        $string = $this->cpfcnpj;
        $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
        '.' . substr($string, 5, 3) . '/' . 
        substr($string, 8, 4) . '-' . substr($string, 12, 2);
        return $string;
    }
    
    public function updatePessoa(PessoaFisica $pessoa)
    {
        return $this->PessoaFisica()->save($pessoa);
    }
}
