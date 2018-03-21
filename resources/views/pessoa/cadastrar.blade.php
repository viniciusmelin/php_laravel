@extends('default.app') @section('content')
<div class="col-lg-12">
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
        <div class="panel-heading"><h3>Cadastrar Pessoa</h2></div>
  
        <div class="panel-body">
          <form id="formcadastro" method="POST" action="{{route('pessoa.salvar')}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="pessoa_fisica" class="radio-inline">
                <input type="radio" name="optpessoa" value="1" id="pessoa_fisica">Pessoa Física</label>
              <label for="pessoa_juridica" class="radio-inline">
                <input type="radio" name="optpessoa" value="2" id="pessoa_juridica">Pessoa Jurídica</label>
            </div>
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group has-feedback {{$errors->has('cpfcnpj') ? 'has-error':''}}">
                    <label id="labeldescricao" for="cpfcnpj">CPF</label>
                    <input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" value="{{old('cpfcnpj','')}}"> @if($errors->has('cpfcnpj'))
                    <span class="help-block">
                      <strong>{{$errors->first('cpfcnpj')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
            </div>
            <div id="divpessoajuridica">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('razao_social') ? 'has-error':''}}">
                    <label for="razao_social">Razão Social</label>
                    <input type="text" class="form-control" name="razao_social" id="razao_social" aria-describedby="razao_social" placeholder="Informe uma Razão Social"
                      size="50" value="{{old('razao_social','')}}"> @if($errors->has('razao_social'))
                    <span class="help-block">
                      <strong>{{$errors->first('razao_social')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('nome_fantasia') ? 'has-error':''}}">
                    <label for="nome_fantasia">Nome Fantasia</label>
                    <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" aria-describedby="nome_fantasia" size="15"
                      placeholder="Informe um Nome Fantasia" value="{{old('nome_fantasia','')}}"> @if($errors->has('nome_fantasia'))
                    <span class="help-block">
                      <strong>{{$errors->first('nome_fantasia')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div id="divpessoaFisica">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('nome') ? 'has-error':''}}">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Informe um nome" size="50"
                      value="{{old('nome')}}"> @if($errors->has('nome'))
                    <span class="help-block">
                      <strong>{{$errors->first('nome')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('sobrenome') ? 'has-error':''}}">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" aria-describedby="sobrenome" size="15" placeholder="Informe um sobrenome"
                      value="{{old('sobrenome')}}"> @if($errors->has('sobrenome'))
                    <span class="help-block">
                      <strong>{{$errors->first('sobrenome')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group has-feedback {{$errors->has('data_nascimento') ? 'has-error':''}}">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{old('data_nascimento',$date)}}"> @if($errors->has('data_nascimento'))
                    <span class="help-block">
                      <strong>{{$errors->first('data_nascimento')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group has-feedback {{$errors->has('cep') ? 'has-error':''}}">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" data-inputmask="'mask':'99999-999'" value="{{old('cep','')}}"> @if($errors->has('cep'))
                    <span class="help-block">
                      <strong>{{$errors->first('cep')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('logradouro') ? 'has-error':''}}">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{old('logradouro','')}}"> @if($errors->has('logradouro'))
                    <span class="help-block">
                      <strong>{{$errors->first('logradouro')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group has-feedback {{$errors->has('numero') ? 'has-error':''}}">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{old('numero','')}}"> @if($errors->has('numero'))
                    <span class="help-block">
                      <strong>{{$errors->first('numero')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('bairro') ? 'has-error':''}}">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{old('bairro','')}}"> @if($errors->has('bairro'))
                    <span class="help-block">
                      <strong>{{$errors->first('bairro')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('complemento') ? 'has-error':''}}">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="{{old('complemento','')}}"> @if($errors->has('complemento'))
                    <span class="help-block">
                      <strong>{{$errors->first('complemento')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('cidade') ? 'has-error':''}}">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{old('cidade','')}}"> @if($errors->has('cidade'))
                    <span class="help-block">
                      <strong>{{$errors->first('cidade')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group has-feedback {{$errors->has('uf') ? 'has-error':''}}">
                    <label for="uf">UF</label>
                    <input type="text" class="form-control" id="uf" size="2" name="uf" value="{{old('uf','')}}"> @if($errors->has('uf'))
                    <span class="help-block">
                      <strong>{{$errors->first('uf')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <a href="{{route('pessoa.inicial')}}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
          </form>
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
    var optpessoa = `{{old('optpessoa')}}`
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
      $('#formcadastro .has-error').removeClass().addClass("form-group");
      $(this).find('.help-block').hide();

      $('#formcadastro span').remove();
      $(this).closest('form').find("input[type=text], textarea").val("");
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