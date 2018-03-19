<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PessoFisicaRequest;
use App\Pessoa;
use App\PessoaFisica;
use App\PessoaJuridica;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pessoa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = Carbon::now()->format('Y-m-d');
       return view('pessoa.cadastrar',compact('date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoFisicaRequest $request)
    {
        if($request->optpessoa == 1)
        {
            try
            {
                DB::beginTransaction();
                $pessoa = new Pessoa();
                $pessoa->cpfcnpj = $request->cpf;
                if($pessoa->save())
                {
                    $pessoa_fisica = new PessoaFisica();
                    $pessoa_fisica->pessoa_id = $pessoa->id;
                    $pessoa_fisica->data_nascimento = $request->data_nascimento;
                    $pessoa_fisica->nome = $request->nome;
                    $pessoa_fisica->sobrenome = $pessoa_fisica->sobrenome;
                    if($pessoa_fisica->save())
                    {
                        $endereco = new Endereco();
                        $endereco->pessoa_id = $pessoa->id;
                        $endereco->logradouro = $request->logradouro;
                        $endereco->numero = $request->numero;
                        $endereco->complemento = $request->complemento;
                        $endereco->bairro = $request->bairro;
                        $endereco->cep = $request->cep;
                        if($endereco->save())
                        {
                            
                            \Session::flash('success',"Pessoa Fisíca cadastrado com sucesso");
                            DB::commit();
                            return redirect()->route('pessoa.inicial');
                        }
                    }
                }
                DB::rollBack();
                \Session::flash('warning',"Não foi possível cadastrar Pessoa Fisíca");
                
                return back()->withInput();
            }
            catch(\Exeception $e)
            {
                \Session::flash('error',"Não foi possível cadatrar pessoa.Erro:".$e->message()."");
                return back()->withInput();
            }

        }
        else if($request->optpessoa == 2)
        {
            
        }


        \Session::flash('warning',"Não foi possível cadastrar Pessoa");
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
