@extends('base')
@section('conteudo')
@section('nome', 'Controle de Estoque')

<style>
    .content-wrapper {
        background-color: #f2f2f2; /* Cinza claro */
        padding: 20px; /* Adicione algum preenchimento para separar o conteúdo da borda */
    }
</style>

<div class="content-wrapper">

<h1 style="font-family: Times New Roman, serif; font-weight: bold; margin-bottom: 20px;">Controle de Estoque</h1>


<form action="{{ route('estoque.search') }}" method="post">

    <div class="row">
        @csrf
        <div class="col-4">
            <label for="" style="font-family: Times New Roman, serif;">Informe o nome da joia: </label><br>
            <input type="text" name="joia_id" class="form-control" id="joia_id"><br>
        </div>
        <div class="col-4" style="margin-top: 22px;">
            <button type="submit" class="btn btn-outline-primary"> 
            <i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
            <a href="{{ url('estoque/create') }}" class="btn btn-outline-warning"><i class="fa-sharp fa-solid fa-circle-plus"></i> Novo</a> 
            <a href="{{ url('estoque/report') }}" class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i> Gerar PDF</a> 
        </div>
        <div class="col-4 d-flex justify-content-end" style="margin-top: 22px;">
            <a class="btn btn btn-secondary ml-auto align-self-center" href="{{ url('') }}"><i class="fa-solid fa-house"></i> Inicio</a><br>
        </div>
    </div>
</form>

<hr>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th style="font-family: Times New Roman, serif">ID</th>
            <th style="font-family: Times New Roman, serif">IMAGEM</th>
            <th style="font-family: Times New Roman, serif">JOIAS</th>
            <th style="font-family: Times New Roman, serif">QUANTIDADE</th>
            <th style="font-family: Times New Roman, serif">LOTE</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dados as $item)
            <tr>
                @php
                $nome_imagem = !empty($item->imagem) ? $item->imagem : 'sem_imagem.jpg';
                @endphp
                <td>{{ $item->id }}</td>
                <td><img src="/storage/{{ $nome_imagem }}" width="150px" alt="imagem" /></td>
                <td>{{ $item->joia->nome ?? '' }}</td>
                <td>{{ $item->quantidade}}</td>
                <td>{{ $item->lote}}</td>

                <td><a href="{{ route('estoque.edit', $item->id) }} "class="btn btn-success" title="Editar"><i 
                    class="fas fa-pencil-alt"></i></a></td><td>

                    <form action="{{ route('estoque.destroy', $item->id) }}" method="post" style="display:inline-block;">

                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Deletar"
                            onclick="return confirm('Deseja realmente deletar esse registro?')">
                            <i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

@stop