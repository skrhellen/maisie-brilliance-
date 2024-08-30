<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <h3>{{ $titulo }}</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">IMAGEM</th>
                <th scope="col">NOME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">CONTATO</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $clientes)
            @php
            $imagem = !empty($clientes->imagem) ? $clientes->imagem : 'sem_imagem.jpg';
            $srcImagem = public_path()."/storage/".$imagem;
            @endphp
                <tr>
                    <th scope="row">{{ $clientes->id }}</th>
                    <td><img src="{{ $srcImagem }}" alt="img" style="width: 100px"></td>
                    <td>{{ $clientes->nome }}</td>
                    <td>{{ $clientes->email }}</td>
                    <td>{{ $clientes->contato}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Sem registro</td>
                </tr>
            @endforelse
        </tbody>
    </table>


</body>

</html>