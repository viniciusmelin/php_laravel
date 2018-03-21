<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Rules\Cnpj;
use App\Rules\Cpf;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        if($this->optpessoa ==1)
        {

            return [
                "cpfcnpj.required"=> "Campo é Obrigatório CPF",
                "cpfcnpj.digits_between"=> "Tamanho deve ser 11 números",
                "cpfcnpj.unique"=> "CPF já cadastrado",
                "nome.required"=> "Campo é Obrigatório",
                "nome.max"=> "Tamanho maxímo é 50 caracteres",
                "nome.min"=> "Tamanho mínimo é 2 caracteres",
                "sobrenome.required"=> "Campo é Obrigatório",
                "sobrenome.max"=> "Tamanho maxímo é 15 caracteres",
                "sobrenome.min"=> "Tamanho mínimo é 1 caracteres",
                "data_nascimento.required"=> "Campo é Obrigatório",
                "data_nascimento.before"=> "Pessoa precisa ter no mínimo 19 anos",
                "logradouro.required"=> "Campo é Obrigatório",
                "numero.required"=> "Campo é Obrigatório",
                "bairro.required"=> "Campo é Obrigatório",
                "cidade.required"=> "Campo é Obrigatório",
                "uf.required"=> "Campo é Obrigatório",
                "cep.required"=> "Campo é Obrigatório",
                "cep.digits_between"=> "Tamanho deve ser 8 caracteres",
                "uf.min"=> "Tamanho deve ser 2 caracteres",
                "uf.max"=> "Tamanho deve ser 2 caracteres"
                
            ];
        }
        else if($this->optpessoa ==2)
        {
            return [
                "cpfcnpj.required"=> "Campo é Obrigatório CNPJ",
                "cpfcnpj.digits_between"=> "Tamanho deve ser 14 números",
                "cpfcnpj.unique"=> "CNPJ já cadastrado",
                "nome_fantasia.required"=> "Campo é Obrigatório",
                "nome_fantasia.max"=> "Tamanho maxímo é 50 caracteres",
                "nome_fantasia.min"=> "Tamanho mínimo é 2 caracteres",
                "razao_social.required"=> "Campo é Obrigatório",
                "razao_social.max"=> "Tamanho maxímo é 50 caracteres",
                "razao_social.min"=> "Tamanho mínimo é 1 caracteres",
                "logradouro.required"=> "Campo é Obrigatório",
                "numero.required"=> "Campo é Obrigatório",
                "bairro.required"=> "Campo é Obrigatório",
                "cidade.required"=> "Campo é Obrigatório",
                "uf.required"=> "Campo é Obrigatório",
                "cep.required"=> "Campo é Obrigatório",
                "cep.digits_between"=> "Tamanho deve ser 8 caracteres",
                "uf.min"=> "Tamanho deve ser 2 caracteres",
                "uf.max"=> "Tamanho deve ser 2 caracteres"
            
            ];
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->optpessoa ==1)
        {

            $dataAtual = Carbon::now();
            $data = $dataAtual->subYears(19);
           
            return [
                "cpfcnpj"=> ['required',new Cpf($this->cpf),"unique:pessoa".($this->id ? ",id,$this->id":""),"digits_between:11,11"],
                //"cpf"=> "max:11",
                "nome"=> "required|max:50|min:2",
                "sobrenome"=> "required|max:15|min:1",
                "data_nascimento"=> 'required|before:'.$data.'',
                "logradouro"=> "required",
                "numero"=> "required",
                "bairro"=> "required",
                "cidade"=> "required",
                "uf"=> "required|min:2|max:2",
                "cep"=> "required|digits_between:8,8"
                
            ];
        }
        else if($this->optpessoa ==2)
        {
            return [
                "cpfcnpj"=> ['required',new Cnpj($this->cpfcnpj),"unique:pessoa".($this->id ? ",id,$this->id":""),"digits_between:14,14"],
                "razao_social"=> "required|max:50|min:2",
                "nome_fantasia"=> "required|max:50|min:1",
                "logradouro"=> "required",
                "numero"=> "required",
                "bairro"=> "required",
                "cidade"=> "required",
                "uf"=> "required|min:2|max:2",
                "cep"=> "required|digits_between:8,8"
                
            ];
        }
    }

    public function getValidatorInstance()
    {
        $this->formartar();
        $this->formatarCEP();
        return parent::getValidatorInstance();
    }

    protected function formartar()
    {
        
        $this->merge(['cpfcnpj' => preg_replace( '/[^0-9]/', '', $this->request->get('cpfcnpj') )]);
    }
    protected function formatarCEP()
    {
        
        $this->merge(['cep' => preg_replace( '/[^0-9]/', '', $this->request->get('cep') )]);
    }
}

