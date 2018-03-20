<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PessoFisicaRequest;
use App\Pessoa;
use App\PessoaFisica;
use App\PessoaJuridica;
use App\Endereco;

class PessoaController extends Controller
{
    private $id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoa_fisica = PessoaFisica::with('pessoa')->get();
        return view('pessoa.index',compact('pessoa_fisica'));
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
                $pessoa->cpfcnpj = $request->cpfcnpj;
                if($pessoa->save())
                {
                    $pessoa_fisica = new PessoaFisica();
                    $pessoa_fisica->pessoa_id = $pessoa->id;
                    $pessoa_fisica->data_nascimento = $request->data_nascimento;
                    $pessoa_fisica->nome = $request->nome;
                    $pessoa_fisica->sobrenome = $request->sobrenome;
                    if($pessoa_fisica->save())
                    {
                        $endereco = new Endereco();
                        $endereco->pessoa_id = $pessoa->id;
                        $endereco->logradouro = $request->logradouro;
                        $endereco->numero = $request->numero;
                        $endereco->complemento = $request->complemento;
                        $endereco->bairro = $request->bairro;
                        $endereco->cidade = $request->cidade;
                        $endereco->uf = $request->uf;
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
        
        if(Pessoa::has('pessoaFisica')->where('id',$id))
        {
           $pessoafisica = Pessoa::with(['pessoaFisica','endereco'])->where('id',$id)->first();
           //return $pessoafisica;
           return view('pessoa.editarPessoaFisica',compact('pessoafisica'));
        }
        else if(Pessoa::has('pessoajuridica')->where('id',$id))
        {
            return 'pessoa juridica';
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoFisicaRequest $request)
    {
        //return $request;
        if($request->optpessoa==1)
        {
            try
            {
                //DB::beginTransaction();
                $pessoa =  Pessoa::with(['pessoaFisica','endereco'])->where('id',$request->id)->first();
                $pessoa->cpfcnpj = $request->cpfcnpj;
                $pessoa->save();
                $pessoa->pessoaFisica::where('pessoa_id',$pessoa->id)
                ->update([
                    "nome"=> $request->nome,
                    "sobrenome" => $request->sobrenome,
                    "data_nascimento" => $request->data_nascimento
                    ]);
                

                 $pessoa->endereco::where('pessoa_id',$pessoa->id)
                ->update([
                    "logradouro" => $request->logradouro,
                    "numero" => $request->numero,
                    "complemento" => $request->complemento,
                    "bairro" => $request->bairro,
                    "cidade" => $request->cidade,
                    "uf" => $request->uf,
                    "cep" => $request->cep
                    ]);
                
                return redirect()->route('pessoa.inicial');

            }
            catch(\Exception $e)
            {
                return $e->getMessage();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesso $request)
    {
        if(Pessoa::where('id',$request->id)->delete())
        {
            return redirect()->route('pessoa.inicial');
        }
        return $request;
       
    }
}
