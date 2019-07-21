<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body id="page-top">

<!-- Custom fonts for this template-->

<!-- Cstom styles for this template-->

</head>
<body class="teste" id="teste">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image ">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                                </div>
                                <form class="user" id="login" method="post">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user cpfOuCnpj"
                                                   placeholder="CPF" name="cpf" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" maxlength="15"
                                                   placeholder="Senha" name="senha" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block"
                                                data-toggle="modal" data-target="#Exemplo">
                                            Login
                                        </button>
                                        <hr>
                                        <!-- Botão para acionar modal -->
                                        <button type="submit" class="btn btn-success btn-user btn-block"
                                                data-toggle="modal"
                                                data-target="#redefinirSenha">
                                            Esqueceu a Senha?
                                        </button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</body>
<form method="post" id="formModal" action="{{route('recuperarSenha')}}">
    @csrf
    <div class="modal fade" id="redefinirSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informe Seu CPF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" name="cpf" id="cpf" maxlength="">
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
<form method="post" id="formModal">
    @csrf
    <div class="modal fade" id="Exemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
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
<script src="{{asset('js/app.js')}}"></script>
<script>
    $(document).ready(function () {
        $.validator.addMethod("validarcpf", function (value) {
            return validaCPF(value);
        });
        $("#login").validate({
            rules:
                {
                    cpf: {
                        validarcpf: true
                    },
                    senha: {
                        required: true
                    },
                },
            messages:
                {
                    senha: {
                        required: "Campo Obrigatório"
                    },
                    cpf: {
                        required: "Campo Obrigatório",
                        validarcpf: "Cpf Inválido"
                    },
                },
            highlight: function (input) {
                // $(input).parents('.form-group').addClass('error');
            },
            unhighlight: function (input) {
                //$(input).parents('.form-group').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
        });
        $("#cpf").mask("000.000.000-00");
    });
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




