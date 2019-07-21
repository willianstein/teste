
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>maxipas</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" >
</head>
<body id="page-top">
</head>
<body class="bg-gradient-primary">
<input type="hidden" name="token" value="{{$token}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Recuperar Senha</h1>
                                </div>
                                <form class="user" id="token" method="post" action="{{route('trocarSenha',$token)}}">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <input type="password" class="form-control form-control-user" id="password" maxlength="15" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirme Senha</label>
                                            <input type="password" class="form-control form-control-user" id="password1" maxlength="15" name="password1">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Lembrar Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </fieldset>
                                </form>
                                <hr>
                                <div class="text-center" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/funcoes.js')}}"></script>

<script>
    $(document).ready(function()
    {
        $("#token").validate
        ({
            rules: {
                password:{
                    required: false
                },
                password1: {
                    equalTo: "#password"
                },
            },
            messages: {
                password:{
                    required: "Campo Obrigatório"
                },
                password1: {
                    equalTo: "Senha não Confere"
                }
            },
            highlight: function (input) {
                // $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                // $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            },
        });
    });

    @if(Session::has('resposta'))
    $.notify({
        // options
        message: '{{Session::get('mensagem')}}'
    },{
        // settings
        type: '{{Session::get('resposta') ===  -1 ? 'danger': 'success'}}'
    });
    @endif
</script>
</body>
</html>




