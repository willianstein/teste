@extends('_template.layout')

@section('css')

@endsection

@section('conteudo')

    <form id="pedido" method="post" action="{{route('pedidos.cadastrar')}}">
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
        <a href="{{ URL::previous() }}">
            <div  data-toggle="modal" data-target="#Exemplo">
                <span class="fas fa-arrow-left"> </span> Voltar
            </div>
        </a>
        <hr>
        <fieldset>
            <div class="col-md-4" >
                <div class="form-group">
                    <label>Nome do Produto</label>
                    <div>
                        <select name="produtos"  class="form-control">
                            @foreach($produto as $pro)
                                <option> {{$pro->nomeproduto }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Data</label>
                    <input type="text" autocomplete="off"  class="form-control" id="data" name="data" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Quantidade</label>
                    <input type="number" class="form-control" name="total" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label> </label>
                    <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
@section('js')
    <script>
        $(function() {
            $( "#data" ).datepicker({
                language: 'pt-BR'}
            );
        });
    </script>
@endsection
