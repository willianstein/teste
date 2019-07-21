<!doctype html>
<html lang="pt-BR">
<head>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    @yield('css')
</head>
<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('produtos.viewTodosProdutos')}}">
            <div class="sidebar-brand-text mx-3">Teste</div>
        </a>
        <hr class="sidebar-divider my-0">
            <li class="nav-item active" data-toggle="modal" data-target="#Exemplo">
                <a class="nav-link" href="{{route('produtos.viewTodosProdutos')}}">
                    <i class="fas fa-fw fa-tachometer-alt"> </i>
                    <span>Produtos</span></a>
            </li>
        <li class="nav-item active" data-toggle="modal" data-target="#Exemplo">
            <a class="nav-link" href="{{route('pedidos.viewTodosPedidos')}}">
                <i class="fas fa-fw fa-table"> </i>
                <span>Fazer Pedido</span></a>
        </li>
        <li class="nav-item active" data-toggle="modal" data-target="#Exemplo">
            <a class="nav-link" href="{{ route('getSair') }}">
                <i class="fas fa-sign-in-alt"> </i>
                <span>Sair</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"> </button>
        </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            @yield('topo')
            <!-- End of Topbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="{{route('usuarios.viewPerfilUsuarios')}}"
                           id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="col-md-2">
                                <span class=" btn btn-link h4 text-gray-600 mt-3"> Usuário:
                                    {{explode(' ', auth('web')->user()->nome)[0]}}
                                </span>
                            </div>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="btn" href="javascript:void();" data-toggle="modal" data-target="#modalExemplo">
                                <!-- Botão para acionar modal -->
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400">
                                </i>
                                Meu Usuario
                            </a>
                            <div class="dropdown-divider"></div>
                            <div data-toggle="modal" data-target="#Exemplo">
                            </div>
                            <div>
                                <a class="btn" href="{{ route('getSair') }}">
                                    @csrf
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"> </i>
                                    Sair
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Tpbar -->
            <!-- Begi Page Content -->
            <div class="container-fluid">
                @yield('conteudo')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">

        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- Modal -->
<form method="post" id="formModal" action="{{route('usuarios.viewPerfilUsuarios')}}">
    @csrf
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirme Sua Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Senha Atual</label>
                            <input type="password" name="senhaModal" size="30" maxlength="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-success">Prosseguir</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form method="post">
    @csrf
    <div class="modal fade" id="modalLoading" tabindex="-1" data-backdrop="static" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                 aria-valuenow="100 " aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Exemplo" tabindex="-1" data-backdrop="static" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                 aria-valuenow="100 " aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"> </i>
</a>
<script src="{{asset('js/app.js')}}"></script>

@yield('js')

<script src="{{asset('js/funcoes.js')}}"></script>
<script>
    @if(Session::has('resposta'))
    $.notify({
        // options
        message: '{{Session::get('mensagem')}}'
    }, {
        // settings
        type: '{{Session::get('resposta') ===  -1 ? 'danger': 'success'}}'
    });
    @endif
</script>
</body>
</html>