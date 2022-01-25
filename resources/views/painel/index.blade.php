@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')
    <div class="col-12 col-md-10 p-2">
        @include('layouts/componentes/mensagem')
    </div>
    
    <main class="d-flex justify-content-between position-relative">
        <section class="container my-5">
            <div class="mt-3">
                <h1 class="text-center fs-3">Contas cloudflare</h1>
            </div>

            <ul class="list-group col-12 col-md-8 col-lg-6 mt-5 m-auto">
                @if (empty($contas[0]))
                    <li class="list-group-item border border-cloudflare mb-3">
                        Você ainda nao possui nenhuma conta cadastrada!
                    </li>
                @else
                    @foreach ($contas as $conta)
                        <li class="list-group-item border border-cloudflare mb-3">
                            <a title="Dominos de {{ $conta->nome }}" href="/cloudflare/conta/{{ $conta->id }}" class="text-decoration-none text-cloudflare">
                                {{ $conta->nome }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>

            <div class="col-12 col-md-8 col-lg-6 mt-2 m-auto">
                <a title="Adicionar nova conta" href="/adicionar/nova-conta" class="btn btn-cloudflare w-100 px-3 py-2 text-light fw-bold">
                    Adicionar nova conta
                </a>
            </div>
        </section>
    </main>
    @include('layouts/componentes/footer')
@endsection