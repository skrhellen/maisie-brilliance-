@extends('base')
@section('conteudo')
@section('titulo', 'Cadastrar novo fornecedor')
@php
    if (!empty($dado->id)) {
        $route = route('marca.update', $dado->id);
    } else {
        $route = route('marca.store');
    }
@endphp

<style>
    .content-wrapper {
        background-color: #f2f2f2; /* Cinza claro */
        padding: 20px; /* Adicione algum preenchimento para separar o conteúdo da borda */
    }
</style>

<div class="content-wrapper">

<h2 style="font-family: Times New Roman, serif; font-weight: bold;">Cadastrar novo fornecedor</h2>
<form action="{{ $route }}" method="post">

    @csrf

    @if (!empty($dado->id))
        @method('put')
    @endif

    <input type="hidden" name="id"
        value="@if (!empty($dado->id)) {{ $dado->id }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Nome Marca </label><br>
    <input type="text" name="nome" class="form-control"
        value="@if (!empty($dado->nome)) {{ $dado->nome }}@elseif (!empty(old('nome'))){{ old('nome') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif;font-weight: bold;">Cotato</label><br>
    <input type="text" name="contato" class="form-control"
        value="@if (!empty($dado->contato)) {{ $dado->contato }}@elseif (!empty(old('contato'))){{ old('contato') }}@else{{ '' }} @endif"><br>

    <label for=""style="font-family: Times New Roman, serif; font-weight: bold;">Material</label><br>
    <input type="text" name="materiais" class="form-control"
        value="@if (!empty($dado->materiais)) {{ $dado->materiais }}@elseif (!empty(old('materiais'))){{ old('materiais') }}@else{{ '' }} @endif"><br>
 
    </select><br>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ url('marca') }}" class="btn btn-primary">Voltar</a>
</form>

</div>
@stop
