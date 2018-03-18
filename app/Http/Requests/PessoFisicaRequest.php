<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoFisicaRequest extends FormRequest
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
                "cpf.required"=> "Campo é Obrigatório CPF",
                "cpf.max"=> "Tamanho maxímo é 11 números",
                "nome.required"=> "Campo é Obrigatório",
                "nome.max"=> "Tamanho maxímo é 50 caracteres",
                "nome.min"=> "Tamanho mínimo é 2 caracteres",
                "sobrenome.required"=> "Campo é Obrigatório",
                "sobrenome.max"=> "Tamanho maxímo é 15 caracteres",
                "sobrenome.min"=> "Tamanho mínimo é 1 caracteres",
                "data_nascimento.required"=> "2018-03-17",
                "logradouro.required"=> "Campo é Obrigatório",
                "numero.required"=> "Campo é Obrigatório",
                "bairro.required"=> "Campo é Obrigatório",
                "cidade.required"=> "Campo é Obrigatório",
                "uf.required"=> "Campo é Obrigatório",
                "cep.required"=> "Campo é Obrigatório",
                
            ];
        }
        else
        {
            return [
                "cnpj.required"=> "Campo é Obrigatório CNPJ",
                "cnpj.max"=> "Tamanho maxímo é 11 números",
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
            return [
                "cpf"=> "required|max:11",
                "nome"=> "required|max:50|min:2",
                "sobrenome"=> "required|max:15|min:1",
                "data_nascimento"=> "required",
                "logradouro"=> "required",
                "numero"=> "required",
                "bairro"=> "required",
                "cidade"=> "required",
                "uf"=> "required",
                "cep"=> "required",
                
            ];
        }
        else
        {
            return [
                "cnpj"=> "required|max:11",
                "razao_social"=> "required|max:50|min:2",
                "nome_fantasia"=> "required|max:50|min:1",
                "logradouro"=> "required",
                "numero"=> "required",
                "bairro"=> "required",
                "cidade"=> "required",
                "uf"=> "required",
                "cep"=> "required",
                
            ];
        }
    }
}
