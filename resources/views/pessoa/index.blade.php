@extends('default.app') @section('content')
<div class="container">
    <div class="col-md-8">
        <a href="{{route('pessoa.criar')}}" class="btn btn-success btn-lg">Cadastrar Pessoa
            <i class="glyphicon glyphicon-plus-sign"></i>
        </a>
    </div>
</div>
<div class="container" style="margin-top: 10px">
    <div class="container">
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
                                        <tr>
                                            <td>1,001</td>
                                            <td>Lorem</td>
                                            <td>ipsum</td>
                                            <td>dolor</td>
                                            <td>dolor</td>
                                        </tr>
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
                                                <td>1,001</td>
                                                <td>Lorem</td>
                                                <td>ipsum</td>
                                                <td>dolor</td>
                                                <td>dolor</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection