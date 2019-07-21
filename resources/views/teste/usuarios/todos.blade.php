@extends('_template.layout')

@section('css')
@endsection
@section('barraSuperior')
@endsection
@section('conteudo')
    <div>
        @if(Session::has('status'))
            @if(Session::get('status') == 1)
                <p style="color: green;">{{Session::get('mensagem')}}</p>
            @endif
            @if(Session::get('status') == -1)
                <p style="color: red;">{{Session::get('mensagem')}}</p>
            @endif
        @endif
    </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">USUÁRIOS</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div data-toggle="modal" data-target="#Exemplo">
                          <a href="{{route('gestao.usuarios.registrar')}}" class="btn btn-primary btn-block" >Cadastrar Usuários Gestores</a>﻿
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table_id" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Email</th>
                                    <th>Codigo da Empresa no Soc</th>
                                    <th>Inativar Usuario</th>
                                    <th>Atualizar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                   <tr @if($usuario->linativo )class="linativo" @endif>
                                    <td class="clickable" data-toggle="modal" data-target="#Exemplo"
                                        data-href="{{route('gestao.usuarios.editar', $usuario->id)}}">{{$usuario->nome}}</td>
                                    <td class="clickable"data-toggle="modal" data-target="#Exemplo"
                                        data-href="{{route('gestao.usuarios.editar', $usuario->id)}}">{{$usuario->cpf}}</td>
                                    <td class="clickable" data-toggle="modal" data-target="#Exemplo"
                                        data-href="{{route('gestao.usuarios.editar', $usuario->id)}}">{{$usuario->email}}</td>
                                    <td class="clickable" data-toggle="modal" data-target="#Exemplo"
                                        data-href="{{route('gestao.usuarios.editar', $usuario->id)}}">{{$usuario->codigodaempresanosoc}}</td>
                                    <td>
                                        <a  style="color:blue" href="javascript:void();" name="inativar"
                                         onclick="inativar('{{route('gestao.usuarios.inativar', $usuario->id)}}',
                                         {{$usuario->linativo }}, {{$usuario->id}})"><span class="fas fa-address-book"> </span>
                                            {{isset($usuario) && $usuario->linativo ==0 ? " Inativar" : " Ativar" }}
                                        </a>
                                    </td>
                                       <td>
                                           <a style="color:blue" href="{{route('gestao.usuarios.editar',
                                            $usuario->id)}}"><span class="fas  fa-wrench" ></span> Alterar
                                           </a>
                                       </td>
                                  </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('js')
    <script>

    </script>
@endsection