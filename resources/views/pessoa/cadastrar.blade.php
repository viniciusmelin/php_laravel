@extends('default.app') @section('content')
<div class="col-md-8">
  <div class="panel panel-default">
    <div class="panel-heading">Cadastrar Pessoa</div>

    <div class="panel-body">
      <form action="{{route('pessoa.salvar')}}" method="post"></form>
    </div>
  </div>
</div>
@endsection