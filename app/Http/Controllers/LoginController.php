<?php

namespace App\Http\Controllers;

use App\Teste\Helpers\Facades\UtilsFacade;
use App\Mail\RecuperarSenha;
use App\Teste\Helpers\Utils;
use App\Teste\Usuarios\Repository\UsuarioRepository;
use App\Teste\Usuarios\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:web')->except(['getSair']);
    }

    function viewLogin(Request $request)
    {
        return view('teste.usuarios.login');
    }

    function login(Request $request)
    {
        //esse input pega somente os numeros para fazer a verificacao no banco
        Input::merge(['cpf' => Utils::soNumero($request->cpf)]);

        $validor = Validator::make($request->all(),
        [
            'cpf' => 'required',
            'senha' => 'required'
        ]);

        if ($validor->fails())
        {
            return redirect()->back()
             ->withErrors($validor->errors())
             ->withInput();
        }

        //faz autenticação do usuarios e a senha
        if(!Auth::guard('web')->attempt(['cpf' => $request->cpf,'password' => $request->senha]))
        {
            return redirect()->back()
            ->withInput($request->only('cpf'))
            ->with
            ([
                'resposta' => -1,
                'mensagem' => 'cpf ou senha incorreto!!'
            ]);
        }

        return redirect()->route('produtos.viewTodosProdutos');
    }


    public function getSair()
    {
        Auth::guard('web')->logout();
        return Redirect::to('login');
    }


    public function recuperarSenha(Request $request)
    {
        input::merge(['cpf' => Utils::soNumero($request->cpf)]);

        $validator = Validator::make($request->all(),
        [
            'cpf' => 'required'
        ]);

        if($validator->fails())
        {
            return back()->with
            ([
                'resposta' => -1,
                'mensagem' => "Entre com um CPF!"
            ]);
        }

        $repoUsuario = new UsuarioRepository(new Usuarios);

        $usuario = $repoUsuario->buscarPeloCpf($request->cpf);

        if(!$usuario)
        {
            return back()->with([
                'resposta' => -1,
                'mensagem' => "CPF não encontrado!"
            ]);
        }

        $repoUsuario->setModel($usuario);

        DB::transaction(function() use ($repoUsuario,$usuario, $request)
        {
            $repoUsuario->atualizar
            ([
                'token_troca_senha' => md5($usuario->cpf)
            ]);
        });

        $usuario->refresh();

        Mail::to($usuario->email)->send(new RecuperarSenha($usuario));

        return back()->with
        ([
            'resposta' => 1,
            'mensagem' => "Email enviado"
        ]);
    }

    function viewTrocarSenha($token)
    {

        return view('gestao.usuarios.trocarSenha',
        [
            'token' => $token
        ]);

    }
    function trocarSenha(Request $request)
    {
      $repoUsuario = new UsuarioRepository (new Usuarios);

        $usuario = $repoUsuario->buscarToken($request->token);

        if(!$usuario)
        {
            return back()->with([
                'resposta' => -1,
                'mensagem' => "Token não encontrado!"
            ]);
        }
        $repoUsuario->setModel($usuario);



        DB::transaction(function() use ($repoUsuario,$usuario, $request )
        {
            $repoUsuario->atualizar
            ([
                'password' => Hash::make($request->password),
                'token_troca_senha' => null
            ]);
        });
        return redirect('login')->with
        ([
            'resposta' => 1,
            'mensagem' => "Recuperado Com Sucesso"
        ]);


    }
}
