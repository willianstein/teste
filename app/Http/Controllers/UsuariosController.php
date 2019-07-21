<?php

namespace App\Http\Controllers;

use App\Teste\Helpers\Facades\UtilsFacade;
use App\Teste\Usuarios\Repository\UsuarioRepository;
use App\Teste\Usuarios\Usuarios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class UsuariosController extends Controller
{

    protected $usuario = null;
    const GUARD_ADMIN = 'usuario';

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function viewTodos()
    {
        $repoUsuarios = new UsuarioRepository(new Usuarios);

        return view('gestao.usuarios.todos',
            [
                'usuarios' => $repoUsuarios->listarUsuarios()
            ]);
    }

    public function viewPerfilUsuarios(Request $request)
    {

        $dados = auth('web')->user()->password;

        if ($request->senhaModal != null)
        {

            if (Hash::check($request->senhaModal, $dados)) {

                return view('teste.usuarios.perfilUsuarios')->with
                ([
                    'resposta' => 1,
                    'mensagem' => "Atualizado com sucesso"
                ]);
            }
        }return back()->with
                ([
                   'resposta' => -1,
                   'mensagem' => "Senha Inválida",
                ]);
    }

    //Atualiza somente o perfil do usuario sem mexer em demais campos
    public function atualizarperfilUsuarios(Request $request)
    {
        try
        {
            $repoUsuario = new UsuarioRepository(auth('web')->user());

            $dados = $request->except(['password', 'password1']);

            if ($request->password != null) {

                $dados['password'] = Hash::make($request->password);
            }

            DB::transaction(function () use ($repoUsuario, $dados) {

                $repoUsuario->atualizar($dados);
            });

            return redirect()->route('produtos.viewTodosProdutos')->with
            ([
                'resposta' => 1,
                'mensagem' => "Atualizado com sucesso"
            ]);
        } catch (\Exception $e) {
            return redirect()->route('produtos.viewTodosProdutos')->with
            ([

                'resposta' => -1,
                'mensagem' => "Não Cadastrado, Erro"
            ]);
        }
    }

    public function registrar(Request $request)
    {
        try
        {
            Input::merge
            ([
                'cpf' => UtilsFacade::soNumero($request->cpf),
            ]);

            $repoUsuario = new UsuarioRepository(new Usuarios);

            $dados = $request->all();

            //Hash é o que criptografa,ae vc cria uma variável.
            $dados['password'] = Hash::make($dados['password']);

            //pega o id de quem criou
            $dados['criado_Por'] = Auth()->user()->id;

            $validor=Validator::make($request->all(),
            [
                'nome'=> 'required',
                'password'=>'required',
                'cpf' => 'required',

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
            DB::transaction(function () use ($repoUsuario, $dados)
            {
                $repoUsuario->criar($dados);
            });

            //faz o retorno de uma mensagem
            return redirect()->route('usuarios.todos')->with
            ([
                'resposta' => 1,
                'mensagem' => "Cadastrado com sucesso"
            ]);

        } catch (\Exception $e) {
            return redirect()->route('usuarios.todos')->with
            ([dd($e),
                'resposta' => -1,
                'mensagem' => "Não Cadastrado, Erro"
            ]);
        }

    }


}
