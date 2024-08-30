@extends('base')
@section('conteudo')
@section('nome', 'Cadastrar Clientes')
@php
    if (!empty($dado->id)) {
        $route = route('clientes.update', $dado->id);
    } else {
        $route = route('clientes.store');
    }
@endphp

<style>
    .content-wrapper {
        background-color: #f2f2f2; /* Cinza claro */
        padding: 20px; /* Adicione algum preenchimento para separar o conteúdo da borda */
    }
</style>

<div class="content-wrapper">

<h2 style="font-family: Times New Roman, serif; font-weight: bold;">Cadastrar Clientes</h2>
<form action="{{ $route }}" method="post" enctype="multipart/form-data"> <!--- permitir upload de img --->

    @csrf

    @if (!empty($dado->id))
        @method('put')
    @endif

    <input type="hidden" name="id"
        value="@if (!empty($dado->id)) {{ $dado->id }}@else{{ '' }} @endif"><br>
        
        <!--- formulário de img --->
        @php 
            $nome_imagem = !empty($dado->imagem) ? $dado->imagem : 'sem_imagem.jpg';
            //dd($nome_imagem);
        @endphp
        <label for="">Imagem</label><br>
        <img src="/storage/{{ $nome_imagem }}" width="300px" alt="imagem" />
    <input type="file" name="imagem" class="form-control"
        value="@if (!empty($dado->imagem)) {{ $dado->imagem }}@elseif (!empty(old('imagem'))){{ old('imagem') }}@else{{ '' }} @endif"><br>


    <label for="" style="font-family: Times New Roman, serif; font-weight: bold;">Nome do cliente</label><br>
    <input type="text" name="nome" class="form-control"
        value="@if (!empty($dado->nome)) {{ $dado->nome }}@elseif (!empty(old('nome'))){{ old('nome') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Email</label><br>
    <input type="text" name="email" class="form-control"
        value="@if (!empty($dado->email)) {{ $dado->email }}@elseif (!empty(old('email'))){{ old('email') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Contato</label><br>
    <input type="text" name="contato" class="form-control"
        value="@if (!empty($dado->contato)) {{ $dado->contato }}@elseif (!empty(old('contato'))){{ old('contato') }}@else{{ '' }} @endif"><br>
  
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ url('clientes') }}" class="btn btn-primary">Voltar</a>
</form>
</div>
@stop
