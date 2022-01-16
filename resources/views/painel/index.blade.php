@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

    <main class="d-flex justify-content-between position-relative">
        <section class="container my-5">
            <div class="mt-3">
                <h1 class="text-center fs-3">Contas cloudflare</h1>
            </div>

            <ul class="list-group col-12 col-md-6 mt-5 m-auto">
                <li class="list-group-item alert alert-danger">
                    Você ainda nao possui nenhuma conta cadastrada!
                </li>
            </ul>

            <div class="col-12 col-md-6 mt-2 m-auto">
                <a title="Adicionar nova conta" href="/adicionar/nova-conta" class="btn btn-danger w-100 px-3 py-2">
                    Adicionar nova conta
                </a>
            </div>
        </section>
    </main>
    @include('layouts/componentes/footer')
@endsection