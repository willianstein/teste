@extends('_template.layout')

@section('css')

@endsection

@section('conteudo')

    <form id="teste" method="post" action="{{$link}}">
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Descrição do Produto</label>
                            <input type="text" class="form-control" name="descricao"
                                   value="{{isset($produtos) ? $produtos->descricao: ""}}" required >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nome Produto</label>
                            <input type="text" class="form-control" name="nomeproduto"
                                   value="{{isset($produtos) ? $produtos->nomeproduto: ""}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Preço Produto</label>
                            <input type="text" class="form-control" name="preco" placeholder="R$"
                               onKeyPress="return(MascaraDinheiro(this,'.',',',event))"
                                   value="{{isset($produtos) ? $produtos->preco: ""}}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estoque</label>
                            <input type="number" class="form-control" name="sku"
                                   value="{{isset($produtos) ? $produtos->sku: ""}}" required>
                        </div>
                    </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label></label>
                    <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection
@section('js')
    <script>
        function MascaraDinheiro(a, e, r, t) {
            let n = ""
                , h = j = 0
                , u = tamanho2 = 0
                , l = ajd2 = ""
                , o = window.Event ? t.which : t.keyCode;
            a.value = a.value.replace('R$ ','');
            if (n = String.fromCharCode(o),
            -1 == "0123456789".indexOf(n))
                return !1;
            for (u = a.value.replace('R$ ','').length,
                     h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
                ;
            for (l = ""; h < u; h++)
                -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
            if (l += n,
            0 == (u = l.length) && (a.value = ""),
            1 == u && (a.value = "R$ 0" + r + "0" + l),
            2 == u && (a.value = "R$ 0" + r + l),
            u > 2) {
                for (ajd2 = "",
                         j = 0,
                         h = u - 3; h >= 0; h--)
                    3 == j && (ajd2 += e,
                        j = 0),
                        ajd2 += l.charAt(h),
                        j++;
                for (a.value = "R$ ",
                         tamanho2 = ajd2.length,
                         h = tamanho2 - 1; h >= 0; h--)
                    a.value += ajd2.charAt(h);
                a.value += r + l.substr(u - 2, u)
            }
            return !1
        }
    </script>
@endsection
