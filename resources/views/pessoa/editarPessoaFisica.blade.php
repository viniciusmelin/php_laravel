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
        <div class="panel-heading">Cadastrar Pessoa Fisíca</div>
  
        <div class="panel-body">
          <form method="POST" action="{{route('pessoa.atualizar')}}" role="form">
              <input name="id" type="hidden" value=" {{$pessoafisica->id}}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="hidden" name="optpessoa" value="1" id="pessoa_fisica" readonly>
            </div>
            <div id="divpessoaFisica">
              <div class="row">
                <div class="form-group has-feedback {{$errors->has('cpfcnpj') ? 'has-error':''}} col-md-4">
                  <label for="cpfcnpj">CPF</label>
                  <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" placeholder="Informe um CPF" data-inputmask="'mask':'999.999.999-99'"
                    value="{{old('cpfcnpj',$pessoafisica->cpfcnpj)}}">
                  <small id="cpfinformacao" class="form-text text-muted">"Informe um CPF válido".</small>
                  @if($errors->has('cpfcnpj'))
                  <span class="help-block">
                    <strong>{{$errors->first('cpfcnpj')}}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('nome') ? 'has-error':''}}">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Informe um nome" size="50"
                      value="{{old('nome',$pessoafisica->pessoaFisica->nome)}}"> @if($errors->has('nome'))
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
                      value="{{old('sobrenome',$pessoafisica->pessoaFisica->sobrenome)}}"> @if($errors->has('sobrenome'))
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
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{old('data_nascimento',$pessoafisica->pessoaFisica->data_nascimento)}}"> @if($errors->has('data_nascimento'))
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
                    <input type="text" class="form-control" id="cep" name="cep" data-inputmask="'mask':'99999-999'" value="{{old('cep',$pessoafisica->endereco->cep)}}"> @if($errors->has('cep'))
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
                    <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{old('logradouro',$pessoafisica->endereco->logradouro)}}"> @if($errors->has('logradouro'))
                    <span class="help-block">
                      <strong>{{$errors->first('logradouro')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group has-feedback {{$errors->has('numero') ? 'has-error':''}}">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{old('numero',$pessoafisica->endereco->numero)}}"> @if($errors->has('numero'))
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
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{old('bairro',$pessoafisica->endereco->bairro)}}"> @if($errors->has('bairro'))
                    <span class="help-block">
                      <strong>{{$errors->first('bairro')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('complemento') ? 'has-error':''}}">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="{{old('complemento',$pessoafisica->endereco->complemento)}}"> @if($errors->has('complemento'))
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
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{old('cidade',$pessoafisica->endereco->cidade)}}"> @if($errors->has('cidade'))
                    <span class="help-block">
                      <strong>{{$errors->first('cidade')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group has-feedback {{$errors->has('uf') ? 'has-error':''}}">
                    <label for="uf">UF</label>
                    <input type="text" class="form-control" id="uf" size="2" name="uf" value="{{old('uf',$pessoafisica->endereco->uf)}}"> @if($errors->has('uf'))
                    <span class="help-block">
                      <strong>{{$errors->first('uf')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <a class="btn btn-danger">Cancelar</a>
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
    console.log({{$pessoafisica->cpfcnpj}});
    $("#cpfcnpj,#cep").inputmask({ "clearIncomplete": true }, { 'automask': true }, { 'removeMaskOnSubmit': true });
    $('#cpfcnpj').val({{$pessoafisica->cpfcnpj}});
  })
</script> @endsection