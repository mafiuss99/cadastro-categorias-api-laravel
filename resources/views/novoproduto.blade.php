@extends('layout.app', ["current" => "produtos"])
@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="categoria_id">Categoria: </label>
                    <select name="categoria_id" id="" class="form-control" placeholder="Selecione a categoria" required>
                        @foreach($cats as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome">Nome do produto: </label>
                    <input name="nome" type="text" class="form-control" placeholder="Informe o nome do produto" required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço: </label>
                    <input name="preco" type="number" class="form-control" step="0.1" placeholder="Informe o preço do produto" required>
                </div>
                <div class="form-group">
                    <label for="estoque">Estoque: </label>
                    <input name="estoque" type="number" class="form-control" placeholder="Informe o estoque do produto" required>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem: </label>
                    <input name="imagem" type="file">
                </div>
                <button class="btn btn-primary btn-sm" type="submit">Salvar</button>
                <button class="btn btn-danger btn-sm" type="cancel">Cancelar</button>
            </form>
        </div>
    </div>
@endsection