@extends('base')
@section('conteudo')
@section('nome', 'Controle de Vendas')

<div class="content-wrapper">

    <h1 style="font-family: Times New Roman, serif; font-weight: bold; margin-bottom: 20px;">Joias a venda .・。.・゜✭・❤・✫・゜・。.</h1><br>


    <div class="mt-16">

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse ($dados as $item)
            <div class="container-fluid d-flex justify-content-center">
                <div class="row g-grid gap-3 d-flex align-items-center" id="recentDiv">
                        @php
                            $nome_imagem = !empty($item->imagem) ? $item->imagem : 'sem_imagem.jpg';
                            //dd($nome_imagem);
                        @endphp
                        <div class="card" style="width: 18rem;">
                            <img src="/storage/{{ $nome_imagem }}" class="card-img-top" alt="img">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nome }}</h5>
                                <p class="card-text">{{ $item->marca->nome ?? '' }}</p>
                                <a href="{{ url('joia') }}" class="btn btn-primary">Acessar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card" style="width: 18rem;">
                    <img src="/storage/{{ $nome_imagem }}" class="card-img-top" alt="img">
                    <div class="card-body">
                        <h5 class="card-title">Sem joia</h5>
                        <p class="card-text"></p>
                        <a href="#" class="btn btn-primary">Voltar</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
</div>
@stop
