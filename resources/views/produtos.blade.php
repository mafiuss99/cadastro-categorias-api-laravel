@extends('layout.app', ["current" => "produtos"])

@section('body')
    <div class="card card-border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>
            <table class="table table-ordered table-hover" id="tabelaProdutos">
                <thead>
                    <tr>
                        <td>Código</td>
                        <td>Imagem</td>
                        <td>Nome</td>
                        <td>Estoque</td>
                        <td>Preço</td>
                        <td>Categoria</td>
                        <td>Ações</td>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onClick="novoProduto()">Novo Produto</a>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" class="form-horizontal" id="formProduto">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo produto</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="nomeProduto" class="control-label">Nome do Produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="precoProduto" class="control-label">Preço do Produto</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="precoProduto" placeholder="Preço do Produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="qtdProduto" class="control-label">Quantidade do Produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="qtdProduto" placeholder="Quantidade do Produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="imagemProduto" class="control-label">Imagem do Produto</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="imagemProduto" placeholder="Imagem do Produto">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categoriaProduto" class="control-label">Categoria</label>
                            <div class="input-group">
                                <select id="categoriaProduto" class="form-control" placeholder="Categoria do Produto">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function novoProduto(){
        $("#id").val('');
        $("#nomeProduto").val('');
        $("#precoProduto").val('');
        $("#qtdProduto").val('');
        $("#imagemProduto").val('')
        $("#dlgProdutos").modal("show");
    }
    
    function deletar(id){
        $.ajax({
            type: "DELETE",
            url: "/api/produtos/"+id,
            context: this,
            success: function(){
                linhas = $("#tabelaProdutos>tbody>tr");
                e = linhas.filter(function(i, elemento){
                    return elemento.cells[0].textContent == id;
                });
                if(e){
                    e.remove();
                }
            },
            error: function(error){
                console.log(error)
            }
        })
    }

    function editar(id){
        $.getJSON('/api/produtos/'+id, function(data){
           console.log(data);
           $("#id").val(data.id);
           $("#nomeProduto").val(data.nome);
           $("#precoProduto").val(data.preco);
           $("#qtdProduto").val(data.estoque);
           $("#imagemProduto").val(data.imagem);
           $("#categoriaProduto").val(data.categoria_id);
           $("#dlgProdutos").modal("show");
        });
    }

    function carregarCategorias() {
        $.getJSON('/api/categorias', function(data){
            console.log(data)
            for(i=0; i<data.length;i++){
                opcao = '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
                $("#categoriaProduto").append(opcao);
            }
        })
    }

    function montarLinha(data){
        produto = '<tr>'+
                    '<td>'+data.id+'</td>'+
                    '<td><img src="'+data.imagem+'"/></td>'+
                    '<td>'+data.nome+'</td>'+
                    '<td>'+data.estoque+'</td>'+
                    '<td>'+data.preco+'</td>'+
                    '<td>'+data.categoria_id+'</td>'+
                    '<td>'+
                        '<button class="btn btn-primary btn-sm mr-1" onclick="editar('+data.id+')">Editar</button>'+
                        '<button class="btn btn-danger btn-sm" onclick="deletar('+data.id+')">Excluir</button>'+
                    '</td>'+
                '</tr>';
        return produto;
    }

    function carregarProdutos() {
        $.getJSON('/api/produtos', function(data){
            console.log(data)
            for(i = 0; i < data.length; i++){
                produto = montarLinha(data[i]);
                $("#tabelaProdutos>tbody").append(produto);
            }
        })
    }

    function criarProduto(){
        prod = {
                nome: $("#nomeProduto").val(),
                preco: $("#precoProduto").val(),
                estoque: $("#qtdProduto").val(),
                categoria_id: $("#categoriaProduto").val(),
                imagem: $("#imagemProduto").val()
        };
        $.post('/api/produtos', prod, function(data){
            produto = JSON.parse(data);
            linha = montarLinha(produto);
            $("#tabelaProdutos>tbody").append(linha);
        })
    }

    function salvarProduto(){
        prod = {
            id: $("#id").val(),
            nome: $("#nomeProduto").val(),
            preco: $("#precoProduto").val(),
            estoque: $("#qtdProduto").val(),
            imagem: $("#imagemProduto").val(),
            categoria_id: $("#categoriaProduto").val()
        };
        $.ajax({
            type: "PUT",
            url: "/api/produtos/"+prod.id,
            context: this,
            data: prod,
            success: function(data){
              prod = JSON.parse(data);
              linhas = $("#tabelaProdutos>tbody>tr");
              e = linhas.filter(function(i, e){
                return (e.cells[0].textContent == prod.id);
              });
              if(e){
                  e[0].cells[0].textContent = prod.id;
                  e[0].cells[1].innerHTML = "<img src='"+data.imagem+"'/>";
                  e[0].cells[2].textContent = prod.nome;
                  e[0].cells[3].textContent = prod.estoque;
                  e[0].cells[4].textContent = prod.preco;
                  e[0].cells[5].textContent = prod.categoria_id;
                  console.log("Salvou OK");
              }
            },
            error: function(error){
                console.log(error)
            }
        })
    }

    $("#formProduto").submit(function(event){
        event.preventDefault();
        if($("#id").val() != "")
            salvarProduto();
        else
            criarProduto();
        $("#dlgProdutos").modal("hide");
    });

    $(document).ready(function(){
        carregarCategorias();
        carregarProdutos();
    });
    
</script>
@endsection