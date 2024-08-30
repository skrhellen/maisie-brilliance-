@extends('base')
@section('conteudo')
@section('nome', 'Atualizar Estoque')
@php
    if (!empty($dado->id)) {
        $route = route('estoque.update', $dado->id);
    } else {
        $route = route('estoque.store');
    }
@endphp

<style>
    .content-wrapper {
        background-color: #f2f2f2; /* Cinza claro */
        padding: 20px; /* Adicione algum preenchimento para separar o conteúdo da borda */
    }
</style>

<div class="content-wrapper">

<h2 style="font-family: Times New Roman, serif; font-weight: bold;">Atualizar Estoque</h2>
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

        <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Joia</label><br>
        <select name="joia_id" class="form-select">
               @foreach ($joias as $item)
                   <option value="{{ $item->id }}">{{ $item->nome }}</option>
               @endforeach
       </select><br>

       <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Quantidade</label><br>
    <input type="text" name="quantidade" class="form-control"
        value="@if (!empty($dado->quantidade)) {{ $dado->quantidade }}@elseif (!empty(old('quantidade'))){{ old('quantidade') }}@else{{ '' }} @endif"><br>

        <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Lote</label><br>
    <input type="text" name="lote" class="form-control"
        value="@if (!empty($dado->lote)) {{ $dado->lote }}@elseif (!empty(old('lote'))){{ old('lote') }}@else{{ '' }} @endif"><br>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ url('estoque') }}" class="btn btn-primary">Voltar</a>
</form>
</div>
@stop
