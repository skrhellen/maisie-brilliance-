<!DOCTYPE html> <!-- Declara o tipo de documento HTML. -->
<html lang="en"> <!-- Define o idioma como inglês. -->

<head> <!-- cabeçalho -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- (viewport) Controla o dimensionamento e a escala da página em dispositivos móveis-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> <!-- Especifica a versão do Internet Explorer a ser usada -->
    <title>@yield('titulo') </title> <!--  O título da página é dinâmico e será substituído pelo conteúdo da seção 'titulo' em cada página específica que estenda este layout. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"  
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- 'rel' indica o tipo de relação que o link tem com o documento atual -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div>
        <div>
            @if ($errors->any()) <!-- verificação se existem erros -->
                <b>Por favor, verifique os erros abaixo:</b>
                <ul> <!-- lista não ordenada -->
                    @foreach ($errors->all() as $error) <!-- loop // 'as' atribui valor á várivel $error-->
                        <li> {{ $error }}</li> <!-- Exibe cada erro em uma lista de itens (<li>) -->
                    @endforeach <!-- fim do loop -->
                </ul>
            @endif <!--Fim da verificação de erros -->
        </div>
        @include('menu')
        <div class="container mt-4"> <!-- é responsável por criar uma caixa centralizada com margens para o conteúdo. -->
            <div class="row"> 
                @yield('conteudo')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
