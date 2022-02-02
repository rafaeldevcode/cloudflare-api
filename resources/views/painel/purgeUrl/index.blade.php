<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <meta name="description" content="">
    <meta name="author" content="Rafael vieira - github.com/rafaeldevcode">
    <title>API | Cloudflare</title>
</head>
<body>
    <main class="container">
        <section class="border border-cloudflare rounded p-5 mt-5">
            <div class="m-auto col-12 col-sm-5 col-md-3 d-flex justify-content-center align-items-center mb-5 p-2">
                <img class="w-100" src="{{ asset('images/logo.png') }}" alt="Logo Cloudflare">
            </div>

            @if (empty($conta))
                <h1 class="text-cloudflare text-center fs-2">{{ $mensagem }}</h1>
            @else
                @if (empty($dominio))
                    <h1 class="text-cloudflare text-center fs-2">Não foi informado nenhum dominío!</h1>
                @else
                    <h1 class="text-cloudflare text-center fs-2">{{ $mensagem }}</h1>
                @endif
            @endif
        </section>
    </main>
</body>
</html>