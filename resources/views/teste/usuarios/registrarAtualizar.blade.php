@extends('_template.layout')

@section('css')

@endsection

@section('conteudo')

    <form id="usuarios" method="post" action="{{$link}}">
        @csrf
        <nav class="navbar navbar-expand-lg ">
           <div class="col-md-12">
              <div class="row">
                    <div class="col-md-10">
                        @if(isset($usuario->id))
                            <a class="navbar-brand" href="#" style="cursor: default">USUÁRIOS</a>
                        @else
                            <a class="navbar-brand" href="#" style="cursor: default">Cadastrando Novo Usuário</a>
                        @endif
                    </div>
              </div>
            </div>
        </nav>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <br>
        <div class="col-md-12">
            <div class="row">
              <div class="form-check-inline col-md-12">
                  <div class="form-check-inline col-md-10">
                    <div class="col-md-3">
                      <label class="checkbox-inline"><input type="checkbox" name="lmaxipas" value="1"
                                     @if(isset($usuario) && $usuario->lmaxipas==1) checked @endif >Maxipas</label>
                    </div>
                    <div class="col-md-3">
                            <label class="checkbox-inline"><input type="checkbox" name="lnassar" value="1"
                                     @if(isset($usuario) && $usuario->lnassar==1) checked @endif >Nassar</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                      <button
                              type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#Exemplo">
                          SALVAR
                      </button>
                  </div>
              </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome"
                                   value="{{isset($usuario) ? $usuario->nome: ""}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf"
                                   value="{{isset($usuario) ? $usuario->cpf: ""}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Endereço de Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="{{isset($usuario) ? $usuario->email: ""}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Código da Empresa no SOC</label>
                            <input type="text" class="form-control" name="codigodaempresanosoc"
                                   value="{{isset($usuario) ? $usuario->codigodaempresanosoc: ""}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Codigo Maxipas</label>
                            <input type="text" class="form-control" name="codigomaxipas" id="codigomaxipas"
                                   value="{{isset($usuario) ? $usuario->codigomaxipas: ""}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Confirme Senha</label>
                            <input type="password" class="form-control" id="password1" name="password1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Observação</label>
                            <textarea type="text" class="form-control" name="observacao">{{isset($usuario) ? $usuario->observacao: ""}}
                 </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function ()
        {
            $("#usuarios").on('submit',function ()
            {
                if($("#usuarios").valid())
                {
                    $("#modalLoading").modal("show");
                }
            })
        })
    </script>

@endsection
