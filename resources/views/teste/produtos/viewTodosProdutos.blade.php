@extends('_template.layout')

@section('css')
@endsection
@section('topo')
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
        <h6 class="m-0 font-weight-bold text-primary">PRODUTOS</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div data-toggle="modal" data-target="#Exemplo">
                    <a href="{{route('produtos.cadastrar')}}" class="btn btn-primary btn-block"
                    >Cadastrar Produto</a>﻿
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped" id="table_id" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Nome do produto</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $prod)
                            <tr>
                                <td class="clickable"
                                    data-href="{{route('produtos.atualizar', $prod->id)}}">{{$prod->descricao}}</td>
                                <td class="clickable"
                                    data-href="{{route('produtos.atualizar', $prod->id)}}">{{$prod->nomeproduto}}</td>
                                <td class="clickable"
                                    data-href="{{route('produtos.atualizar', $prod->id)}}">{{$prod->preco}}</td>
                                <td class="clickable"
                                    data-href="{{route('produtos.atualizar', $prod->id)}}">{{$prod->sku}}</td>
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
