@extends('default.app') @section('content')
<div class="col-md-12">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(session($msg))
    <div class="row">
      <div class="col-md-8">
        <div class="alert alert-{{$msg}} alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Informação: </strong> {{session($msg)}}.
        </div>
      </div>
    </div>
  @endif
  @endforeach
  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">Visualizar Pessoa</div>
  
        <div class="panel-body">
          <form>
            {{ csrf_field() }}
            <div class="form-group" style="display: none">
              <label for="pessoa_fisica" class="radio-inline">
                <input type="radio" name="optpessoa" value="1" id="pessoa_fisica">Pessoa Física</label>
              <label for="pessoa_juridica" class="radio-inline">
                <input type="radio" name="optpessoa" value="2" id="pessoa_juridica">Pessoa Jurídica</label>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4">
                            <label id="labeldescricao" for="cpfcnpj">CPF</label>
                            <input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="{{$pessoa->cpfcnpj}}" disabled>
                    </div>
                </div>
            </div>
            <div id="divpessoajuridica">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="razao_social">Razão Social</label>
                    <input type="text" class="form-control" name="razao_social" id="razao_social" aria-describedby="razao_social" placeholder="Informe uma Razão Social"
                      size="50" value="{{$pessoa->pessoajuridica->razao_social}}" disabled>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nome_fantasia">Nome Fantasia</label>
                    <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" aria-describedby="nome_fantasia" size="15"
                      placeholder="Informe um Nome Fantasia" value="{{$pessoa->pessoajuridica->nome_fantasia}}" disabled> 
                  </div>
                </div>
              </div>
            </div>
            <div id="divpessoaFisica">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Informe um nome" size="50"
                      value="{{$pessoa->pessoaFisica->nome}}" disabled> 
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" aria-describedby="sobrenome" size="15" placeholder="Informe um sobrenome"
                      value="{{$pessoa->pessoaFisica->sobrenome}}" disabled> 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{$pessoa->pessoaFisica->data_nascimento}}" disabled> 
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" data-inputmask="'mask':'99999-999'" value="{{$pessoa->endereco->cep}}" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{$pessoa->endereco->logradouro}}" disabled> 
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group ">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{$pessoa->endereco->numero}}" disabled> 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{$pessoa->endereco->bairro}}" disabled>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="{{$pessoa->endereco->complemento}}"disabled> 
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{$pessoa->endereco->cidade}}" disabled> 
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="uf">UF</label>
                    <input type="text" class="form-control" id="uf" size="2" name="uf" value="{{$pessoa->endereco->uf}}" disabled>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <a class="btn btn-danger btn-lg" href="{{route('pessoa.inicial')}}">Voltar <i class="glyphicon glyphicon-arrow-left"></i></a>
          <a class="btn btn-warning btn-lg" href="{{route('pessoa.editar',$pessoa_id)}}">Alterar <i class="glyphicon glyphicon-edit"></i></a>
         
        </div>
        
      </div>
    </div>
  </div>
  
</div>

@endsection @section('js')
<script>
  $(document).ready(function () {
    // data-inputmask="'mask':'99.999.999/9999-99'" 
    $("#cpfcnpj,#cep").inputmask({ "clearIncomplete": true }, { 'automask': true }, { 'removeMaskOnSubmit': true });
    var optpessoa = `{{$optpessoa}}`
    if (optpessoa == 2) {
      $('#pessoa_juridica').attr('checked', true);
      $('#divpessoaFisica').hide();
    }
    else {
      $('#cpfcnpj').inputmask('999.999.999-99');
      $('#divpessoajuridica').hide();
      $('#pessoa_fisica').attr('checked', true);
    }
    $('input[type=radio][name=optpessoa]').click(function () {
      if (this.value == 1) {
        $('#labeldescricao').text('CPF');
        $('#cpfcnpj').inputmask('999.999.999-99');
        $('#divpessoajuridica input[type="text"]').val('');
        $('#divpessoajuridica').hide();
        $('#divpessoaFisica').show();
        $('#pessoa_fisica').attr('checked', true);
      }
      else if (this.value == 2) {
        $('#labeldescricao').text('CNPJ');
        $('#cpfcnpj').inputmask('99.999.999/9999-99');
        $('.form-group has-feedback').prop('has-error');
        $('#divpessoajuridica').show();
        $('#divpessoaFisica').hide();
        $('#divpessoaFisica input[type="text"]').val('');
      }
    });
  })
</script> @endsection