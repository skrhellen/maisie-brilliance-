@extends('base')
@section('conteudo')
@section('titulo', 'Cadastro de venda')
@php
    if (!empty($dado->id)) {
        $route = route('vendas.update', $dado->id);
    } else {
        $route = route('vendas.store');
    }
@endphp

<style>
    .content-wrapper {
        background-color: #f2f2f2; /* Cinza claro */
        padding: 20px; /* Adicione algum preenchimento para separar o conteúdo da borda */
    }
</style>

<div class="content-wrapper">

<h2 style="font-family: Times New Roman, serif; font-weight: bold;">Cadastro de venda</h2>
<form action="{{ $route }}" method="post" enctype="multipart/form-data">
    @csrf

    @if (!empty($dado->id))
        @method('put')
    @endif

    <input type="hidden" name="id"
        value="@if (!empty($dado->id)) {{ $dado->id }}@else{{ '' }} @endif"><br>

        @php 
            $nome_imagem = !empty($dado->imagem) ? $dado->imagem : 'sem_imagem.jpg';
            //dd($nome_imagem);
        @endphp
        <label for="">Imagem</label><br>
        <img src="/storage/{{ $nome_imagem }}" width="300px" alt="imagem" />
    <input type="file" name="imagem" class="form-control"
        value="@if (!empty($dado->imagem)) {{ $dado->imagem }}@elseif (!empty(old('imagem'))){{ old('imagem') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Nome do cliente</label><br>
    <select name="clientes_id" class="form-select">
         @foreach ($clientes as $item)
            <option value="{{ $item->id }}">{{ $item->nome }}</option>
        @endforeach
    </select><br>


    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Joia</label><br>
        <select name="joia_id" class="form-select">
               @foreach ($joias as $item)
                   <option value="{{ $item->id }}">{{ $item->nome }}</option>
               @endforeach
       </select><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">data</label><br>
    <input type="text" name="data" class="form-control"
        value="@if (!empty($dado->data)) {{ $dado->data }}@elseif (!empty(old('data'))){{ old('data') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Quantidade</label><br>
    <input type="text" name="quantidade" class="form-control"
        value="@if (!empty($dado->quantidade)) {{ $dado->quantidade }}@elseif (!empty(old('quantidade'))){{ old('quantidade') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Preço total</label><br>
    <input type="text" name="preco_tot" class="form-control"
            value="@if (!empty($dado->preco_tot)) {{ $dado->preco_tot }}@elseif (!empty(old('preco_tot'))){{ old('preco_tot') }}@else{{ '' }} @endif"><br>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ url('vendas') }}" class="btn btn-primary">Voltar</a>
</form>
</div>
@stop
