@extends('_template.layout')

@section('css')
@endsection
@section('barraSuperior')

@endsection
@section('conteudo')

    <form  id="perfil" method="post" action="{{route('usuarios.atualizarperfilUsuarios')}}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <fieldset>
            <div class="form-row" >
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome"  value="{{auth('web')->user()->nome}}" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Endereço de Email</label>
                        <input type="email" class="form-control" name="email" value="{{auth('web')->user()->email}}" required >
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Senha</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Confirme Senha</label>
                        <input type="password" class="form-control" id="password1" name="password1">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <label></label>
                        <button  type="submit" class="btn btn-primary btn-block">Salvar</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function ()
        {
            $("#perfil").on('submit',function ()
            {
                if($("#perfil").valid())
                {
                    $("#modalLoading").modal("show");
                }
            })
        })
           </script>
@endsection