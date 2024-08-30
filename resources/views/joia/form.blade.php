@extends('base')
@section('conteudo')
@section('nome', 'Cadastrar Joias')
@php
    if (!empty($dado->id)) {
        $route = route('joia.update', $dado->id);
    } else {
        $route = route('joia.store');
    }
@endphp

<style>
    .content-wrapper {
        background-color: #f2f2f2; /* Cinza claro */
        padding: 20px; /* Adicione algum preenchimento para separar o conteúdo da borda */
    }
</style>

<div class="content-wrapper">

<h2 style="font-family: Times New Roman, serif; font-weight: bold;">Cadastrar Joias</h2>
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


    <label for="" style="font-family: Times New Roman, serif; font-weight: bold;">Nome da Joia</label><br>
    <input type="text" name="nome" class="form-control"
        value="@if (!empty($dado->nome)) {{ $dado->nome }}@elseif (!empty(old('nome'))){{ old('nome') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Nome da Marca</label><br>
    <select name="marca_id" class="form-select">
            @foreach ($marca as $item)
                <option value="{{ $item->id }}">{{ $item->nome }}</option>
            @endforeach
    </select><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Valor</label><br>
    <input type="text" name="valor" class="form-control"
        value="@if (!empty($dado->valor)) {{ $dado->valor }}@elseif (!empty(old('valor'))){{ old('valor') }}@else{{ '' }} @endif"><br>
 
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ url('joia') }}" class="btn btn-primary">Voltar</a>
</form>
</div>
@stop
