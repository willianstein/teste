<?php

namespace App\Http\Controllers;

use App\Teste\Produtos\Produtos;
use App\Teste\Produtos\Repository\ProdutosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function viewTodosProdutos()
    {
        $repoProdutos = new ProdutosRepository (new Produtos);

        return view('teste.produtos.viewTodosProdutos',
            [
                'produtos' => $repoProdutos->listarProdutos()
            ]);
    }

    public function viewCadastrarAtualizar($id = null)
    {
        $repoProdutos = new ProdutosRepository (new Produtos);

        if ($id != null)
        {
            return view('teste.produtos.cadastrarAtualizarProduto',
                [
                    'produtos' => $repoProdutos->mostrar($id),
                    'link' => route('produtos.atualizar', $id)
                ]);
        }
        return view('teste.produtos.cadastrarAtualizarProduto',
            [
                'link' => route('produtos.cadastrar')
            ]);
    }

    public function cadastrar(Request $request)
    {
        try
        {
            $repoProdutos = new ProdutosRepository(new Produtos);

            $dados=$request->all();

            $validor=Validator::make($request->all(),
                [
                    'descricao'=> 'required',
                    'nomeproduto'=>'required',
                    'preco' => 'required',
                    'sku' => 'required',

                ]);
            if ($validor->fails())
            {
                return back()->with
                ([
                    'resposta' => -1,
                    'mensagem' => "Campos Obrigatórios",
                ]);
            }

            //trata ce der erro na hora da inseção no banco.
            DB::transaction(function () use ($repoProdutos, $dados)
            {
                $repoProdutos->criar($dados);
            });

            //faz o retorno de uma mensagem
            return redirect()->route('produtos.viewTodosProdutos')->with
            ([
                'resposta' => 1,
                'mensagem' => "Cadastrado com sucesso"
            ]);

        }
        catch (\Exception $e)
        {
            return redirect()->route('produtos.viewTodosProdutos')->with
            ([
                dd($e),
                'resposta' => -1,
                'mensagem' => "Não cadastrado, Erro"
            ]);
        }

    }

    public function atualizar(Request $request, $id)
    {
        try{

        $repoProdutos = new ProdutosRepository(new Produtos);

        $produtos = $repoProdutos->mostrar($id, false);

        if (!$produtos)
        {
            return redirect()->route('produtos.viewTodosProdutos', $id);
        }

        $validor=Validator::make($request->all(),
            [
                'descricao'=> 'required',
                'nomeproduto'=>'required',
                'preco' => 'required',
                'sku' => 'required',

            ]);
        if ($validor->fails())
        {
            return back()->with
            ([
                'resposta' => -1,
                'mensagem' => "Campos Obrigatórios",
            ]);
        }

        $repoProdutos->setModel($produtos);

        $repoProdutos->atualizar($request->all());

            //faz o retorno de uma mensagem
            return redirect()->route('produtos.viewTodosProdutos')->with
            ([
                'resposta' => 1,
                'mensagem' => "Atualizado com sucesso"
            ]);

    }catch (\Exception $e)
        {
            return redirect()->route('produtos.viewTodosProdutos')->with
            ([

                'resposta' => -1,
                'mensagem' => "Não cadastrado, Erro"
            ]);
        }
    }
}
