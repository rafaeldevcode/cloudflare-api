@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')
    @include('layouts/componentes/mensagem')

    <main class="d-flex justify-content-between position-relative">
        <section class="container my-5">
            <div class="mt-3">
                <h1 class="text-center fs-3">Dominios cadastrado em <span class="text-cloudflare">{{ $conta->nome }}</span></h1>
            </div>

            <ul class="list-group col-12 col-md-6 mt-5 m-auto">
                {{-- @if (empty($response['result'][0]))
                    <li class="list-group-item border border-cloudflare mb-3">
                        Nenhum domínio cadastrado para esta conta!
                    </li>
                @else --}}
                    @foreach ($response as $dominios)
                        <li class="list-group-item border border-cloudflare mb-3">
                            {{ $dominios['result']['name'] }}
                        </li>
                    @endforeach
                {{-- @endif --}}
            </ul>
        </section>
    </main>

    @include('layouts/componentes/footer')
@endsection