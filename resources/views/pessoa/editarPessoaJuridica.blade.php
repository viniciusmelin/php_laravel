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
        <div class="panel-heading">Atualizar Pessoa</div>
  
        <div class="panel-body">
          <form method="POST" action="{{route('pessoa.atualizar')}}">
            {{ csrf_field() }}
            <input type="hidden" name="optpessoa" value="2" id="pessoajuridica">
            <input type="hidden" name="id" value="{{$pessoajuridica->id}}">
            <div class="row">
                <div class="form-group has-feedback {{$errors->has('cpfcnpj') ? 'has-error':''}} col-md-4">
                    <label id="labeldescricao" for="cpfcnpj">CNPJ</label>
                    <input type="text" class="form-control" name="cpfcnpj" data-inputmask="'mask':'99.999.999/9999-99'"  id="cpfcnpj" value="{{old('cpfcnpj',$pessoajuridica->cpfcnpj)}}">
                    <small id="cnpjinformacao" class="form-text text-muted">"Informe um CNPJ válido".</small>
                    @if($errors->has('cpfcnpj'))
                    <span class="help-block">
                      <strong>{{$errors->first('cpfcnpj')}}</strong>
                    </span>
                    @endif
                  </div>
            </div>
            <div id="divpessoajuridica">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('razao_social') ? 'has-error':''}}">
                    <label for="razao_social">Razão Social</label>
                    <input type="text" class="form-control" name="razao_social" id="razao_social" aria-describedby="razao_social" placeholder="Informe uma Razão Social"
                      size="50" value="{{old('razao_social',$pessoajuridica->pessoajuridica->razao_social)}}"> @if($errors->has('razao_social'))
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
                      placeholder="Informe um Nome Fantasia" value="{{old('nome_fantasia',$pessoajuridica->pessoajuridica->nome_fantasia)}}"> @if($errors->has('nome_fantasia'))
                    <span class="help-block">
                      <strong>{{$errors->first('nome_fantasia')}}</strong>
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
                    <input type="text" class="form-control" id="cep" name="cep" data-inputmask="'mask':'99999-999'" value="{{old('cep',$pessoajuridica->pessoajuridica->endereco->cep)}}"> @if($errors->has('cep'))
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
                    <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{old('logradouro',$pessoajuridica->pessoajuridica->endereco->logradouro)}}"> @if($errors->has('logradouro'))
                    <span class="help-block">
                      <strong>{{$errors->first('logradouro',$pessoajuridica->logradouro)}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group has-feedback {{$errors->has('numero') ? 'has-error':''}}">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{old('numero',$pessoajuridica->pessoajuridica->endereco->numero)}}"> @if($errors->has('numero'))
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
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{old('bairro',$pessoajuridica->pessoajuridica->endereco->bairro)}}"> @if($errors->has('bairro'))
                    <span class="help-block">
                      <strong>{{$errors->first('bairro')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group has-feedback {{$errors->has('complemento') ? 'has-error':''}}">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="{{old('complemento',$pessoajuridica->pessoajuridica->endereco->complento)}}"> @if($errors->has('complemento'))
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
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{old('cidade',$pessoajuridica->pessoajuridica->endereco->cidade)}}"> @if($errors->has('cidade'))
                    <span class="help-block">
                      <strong>{{$errors->first('cidade')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group has-feedback {{$errors->has('uf') ? 'has-error':''}}">
                    <label for="uf">UF</label>
                    <input type="text" class="form-control" id="uf" size="2" name="uf" value="{{old('uf',$pessoajuridica->pessoajuridica->endereco->uf)}}"> @if($errors->has('uf'))
                    <span class="help-block">
                      <strong>{{$errors->first('uf')}}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
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
    $('#cpfcnpj').val({{$pessoajuridica->cpfcnpj}});
    $('#cep').val({{$pessoajuridica->endereco->cep}});
  });
</script> @endsection