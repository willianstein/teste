<?php

namespace App\Http\Controllers;

use App\Teste\Pedidos\Pedidos;
use App\Teste\Pedidos\Repository\PedidosRepository;
use App\Teste\Produtos\Produtos;
use App\Teste\Produtos\Repository\ProdutosRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PedidosController extends Controller
{
    public function __construct(){

        $this->middleware('auth:web');
    }

    public function viewTodosPedidos(){

        $reporProduto = new ProdutosRepository(new Produtos);

        return view('teste.pedidos.viewFazerPedido',
            [
                'produto' =>$reporProduto ->listarProdutos(),
            ]);
    }

    public function cadastrar(Request $request){
        {
            try
            {
                $repoPedido = new PedidosRepository(new Pedidos);

                $dados=$request->all();

                $validor=Validator::make($request->all(),
                    [
                        'produtos'=>'required',
                        'total' => 'required',
                        'data' =>'required',
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
                DB::transaction(function () use ($repoPedido, $dados)
                {
                    $repoPedido->criar($dados);
                });

                //faz o retorno de uma mensagem
                return redirect()->route('produtos.viewTodosProdutos')->with
                ([
                    'resposta' => 1,
                    'mensagem' => "Pedido Efetuado com sucesso"
                ]);

            }
            catch (\Exception $e)
            {
                return redirect()->route('produtos.viewTodosProdutos')->with
                ([
                    dd($e),
                    'resposta' => -1,
                    'mensagem' => "Erro"
                ]);
            }

        }
    }



}
