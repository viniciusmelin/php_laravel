@extends('default.app') @section('content')
<div class="container">
    <div class="col-md-8">
        <a href="{{route('pessoa.criar')}}" class="btn btn-success btn-lg">Cadastrar Pessoa
            <i class="glyphicon glyphicon-plus-sign"></i>
        </a>
    </div>
</div>
<div class="container" style="margin-top: 20px">
    <div class="container">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(session($msg))
                <div class="col-md-12">
                  <div id="mensagem" class="alert alert-{{$msg}} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Informação: </strong> {{session($msg)}}.
                  </div>
                </div>
            @endif
            @endforeach
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="sub-header">Pessoa Física</h1>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Cód.</th>
                                            <th>Nome</th>
                                            <th>Sobrenome</th>
                                            <th>CPF</th>
                                            <th>Ação</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pessoa_fisica as $pf)
                                        <tr>
                                            <td>{{$pf->pessoa_id}}</td>
                                            <td>{{$pf->nome}}</td>
                                            <td>{{$pf->sobrenome}}</td>
                                            <td>{{$pf->pessoa->formartarCPF()}}</td>
                                            <td>
                                                <a class="btn btn-warning btn-xs" href="{{route('pessoa.editar',$pf->pessoa_id)}}" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="glyphicon glyphicon-edit"></i></a>
                                                <a class="btn btn-info btn-xs" href="{{route('pessoa.visualizar',$pf->pessoa_id)}}" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <button class="btn btn-danger btn-xs excluir" data-toggle="modal" data-target="#modalexcluir" id="btnexcluir" data-id="{{$pf->pessoa_id}}" data-url="{{ action('PessoaController@destroy')}}"><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Excluir"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="sub-header">Pessoa Jurídica</h1>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Cód.</th>
                                                <th>Razão Social</th>
                                                <th>Nome Fantasia</th>
                                                <th>CNPJ</th>
                                                <th>Ação</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                    @foreach ($pessoa_juridica as $pj)
                                                    <tr>
                                                        <td>{{$pj->pessoa_id}}</td>
                                                        <td>{{$pj->razao_social}}</td>
                                                        <td>{{$pj->nome_fantasia}}</td>
                                                        <td>{{$pj->pessoa->formartarCNPJ()}}</td>
                                                        <td>
                                                            <a class="btn btn-warning btn-xs" href="{{route('pessoa.editar',$pj->pessoa_id)}}" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="glyphicon glyphicon-edit"></i></a>
                                                            <a class="btn btn-info btn-xs" href="{{route('pessoa.visualizar',$pj->pessoa_id)}}" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                            <button class="btn btn-danger btn-xs excluir" data-toggle="modal" data-target="#modalexcluir" id="btnexcluir" data-id="{{$pj->pessoa_id}}" data-url="{{ action('PessoaController@destroy')}}"><i class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="top" title="Excluir"></i></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
                <a href="{{route('pessoa.json')}}" target="_blank" class="btn btn-info btn-md pull-right">JSON
                        <i class="glyphicon glyphicon-list-alt"></i>
                </a>
        </div>
        <div id="modalexcluir" class="modal fade" role="dialog">
            <div class="modal-dialog">
        
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <i class="glyphicon glyphicon-remove" style="color: red !important"></i> Remover Registro</h4>
                    </div>
                    <form id="formexcluir" action="" method="POST">
                            {{ csrf_field() }}
                        <input type="hidden" name="id" id="pessoa_id">
                        <div class="modal-body">
                            <p>Deseja realmente excluir o registro?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                            <button type="submit"  class="btn btn-success">Sim</button>
                        </div>
                    </form>
                </div>
        
            </div>
        </div>
    @endsection
    @section('js')
    <script type="">
        $(document).ready(function(){
           $('.excluir').click(function(){
            $('#pessoa_id').attr('value',$(this).data("id"));
            $('#formexcluir').attr('action',$(this).data("url"));
            $('#mensagem').fadeOut(500);
           });
        });
    </script>
    @endsection