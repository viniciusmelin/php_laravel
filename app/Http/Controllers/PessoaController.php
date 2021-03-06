<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\PessoaRequest;
use App\Pessoa;
use App\PessoaFisica;
use App\PessoaJuridica;
use App\Endereco;
use Carbon\Carbon;
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
        $pessoa_juridica = PessoaJuridica::with('pessoa')->get();
        return view('pessoa.index',compact('pessoa_fisica','pessoa_juridica'));
    }

    public function json()
    {
       
        $pessoa_fisica = PessoaFisica::with('pessoa','endereco')->get();
        $pessoa_juridica = PessoaJuridica::with('pessoa','endereco')->get();
        return response()->json([$pessoa_fisica,$pessoa_juridica]);
        
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
    public function store(PessoaRequest $request)
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
                            
                            \Session::flash('success',"Pessoa Física cadastrado com sucesso");
                            DB::commit();
                            return redirect()->route('pessoa.inicial');
                        }
                    }
                }
                DB::rollBack();
                \Session::flash('warning',"Não foi possível cadastrar Pessoa Física");
                
                return back()->withInput();
            }
            catch(\Exeception $e)
            {
                DB::rollBack();
                \Session::flash('danger',"Não foi possível cadastrar pessoa.Erro:".$e->message()."");
                return back()->withInput();
            }

        }
        else if($request->optpessoa == 2)
        {
            try
            {
                DB::beginTransaction();
                $pessoa = new Pessoa();
                $pessoa->cpfcnpj = $request->cpfcnpj;
                if($pessoa->save())
                {
                    $pessoa_juridica = new PessoaJuridica();
                    $pessoa_juridica->pessoa_id = $pessoa->id;
                    $pessoa_juridica->razao_social = $request->razao_social;
                    $pessoa_juridica->nome_fantasia = $request->nome_fantasia;
                    if($pessoa_juridica->save())
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
                            
                            \Session::flash('success',"Pessoa Jurídica cadastrado com sucesso");
                            DB::commit();
                            return redirect()->route('pessoa.inicial');
                        }
                    }
                }
                DB::rollBack();
                \Session::flash('warning',"Não foi possível cadastrar Pessoa Jurídica");
                
                return back()->withInput();
            }
            catch(\Exeception $e)
            {
                DB::rollBack();
                \Session::flash('danger',"Não foi possível cadatrar pessoa.Erro:".$e->message()."");
                return back()->withInput();
            }
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
        $optpessoa =0;
        if(PessoaFisica::where('pessoa_id',$id)->first() != null)
        {

            $pessoa = Pessoa::with(['pessoaFisica','endereco'])->where('id',$id)->first();
            $pessoa->pessoajuridica = new PessoaJuridica();
            $optpessoa= 1;
            $pessoa_id = $pessoa->id;
            return view('pessoa.visualizar',compact('pessoa','optpessoa','pessoa_id'));
        }
        else if(Pessoa::has('pessoajuridica')->where('id',$id))
        {
            $optpessoa= 2;
            $pessoa = Pessoa::with(['pessoajuridica','endereco'])->where('id',$id)->first();
            $pessoa->pessoaFisica = new PessoaFisica();
            $pessoa_id = $pessoa->id;
            return view('pessoa.visualizar',compact('pessoa','optpessoa','pessoa_id'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(PessoaFisica::where('pessoa_id',$id)->first() != null)
        {

           $pessoafisica = Pessoa::with(['pessoaFisica','endereco'])->where('id',$id)->first();
           return view('pessoa.editarPessoaFisica',compact('pessoafisica'));
        }
        else if(Pessoa::has('pessoajuridica')->where('id',$id))
        {
            $pessoajuridica = Pessoa::with(['pessoajuridica','endereco'])->where('id',$id)->first();
            return view('pessoa.editarPessoaJuridica',compact('pessoajuridica'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaRequest $request)
    {
        //return $request;
        if($request->optpessoa==1)
        {
            try
            {
                DB::beginTransaction();
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
                DB::commit();
                \Session::flash('success',"Pessoa Física atualizada com sucesso");
                return redirect()->route('pessoa.inicial');

            }
            catch(\Exception $e)
            {
                DB::rollBack();
                \Session::flash('danger',"Não foi possível atualizar pessoa.Erro:".$e->message()."");
                return back()->withInput();
            }

            \Session::flash('warning',"Perfil não encontrado de pessoa.Erro:".$e->message()."");
            return back()->withInput();
        }
        else if($request->optpessoa==2)
        {
            try
            {
                DB::beginTransaction();
                $pessoa =  Pessoa::with(['pessoajuridica','endereco'])->where('id',$request->id)->first();
                $pessoa->cpfcnpj = $request->cpfcnpj;
                $pessoa->save();
                $pessoa->pessoajuridica::where('pessoa_id',$pessoa->id)
                ->update([
                    "razao_social"=> $request->razao_social,
                    "nome_fantasia" => $request->nome_fantasia
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
                DB::commit();
                \Session::flash('success',"Pessoa Jurídica atualizada com sucesso");
                return redirect()->route('pessoa.inicial');

            }
            catch(\Exception $e)
            {
                DB::rollBack();
                \Session::flash('danger',"Não foi possível atualizar pessoa.Erro:".$e->message()."");
                return back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Pessoa::where('id',$request->id)->delete())
        {
            \Session::flash('success',"Pessoa exclúida com sucesso");
            return redirect()->route('pessoa.inicial');
        }
        return back()->withInput();;
       
    }
}
