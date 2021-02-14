@extends('layout.app', ["current" => "categorias"])

@section('body')
    
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>
            
            @if(count($cats) > 0)
                @if(Session::get('msg'))
                    <div class="alert alert-success alert-block">
                        {{Session::get('msg')}}
                    </div>
                @endif
            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome da Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cats as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->nome }}</td>
                            <td>
                                <a href="/categorias/editar/{{ $cat->id }}" class="btn btn-sm btn-primary">Editar</a>
                                <a href="/categorias/apagar/{{ $cat->id }}" class="btn btn-sm btn-danger">Apagar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>Não existem categorias cadastradas</p>
            @endif
        </div>
        <div class="card-footer">
            <a href="/categorias/novo" class="btn btn-sm btn-primary">Nova Categoria</a>
        </div>
    </div>

@endsection