@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

    <main class="d-flex flex-column position-relative">
        <div class="col-12 col-md-10 p-2 m-auto mensagem">
            @include('layouts/componentes/mensagem', [$mensagem])
            @include('layouts/componentes/errors')
        </div>

        <section class="container my-5">
            <div class="col-12 col-md-6 m-auto">
                <div>
                    <h1 class="m-0 fw-bolder text-cloudflare text-center">Adicionar tag</h1>
                </div>
                <form action="/cloudflare/{{ $conta->id }}/adicionar-tag" method="POST" class="form-control border border-cloudflare py-5">
                    @csrf
                    <div class="p-2">
                        <label for="nome" class="fs-6 text-secondary">Nome da tag</label>
                        <input type="text" class="form-control" name="nome" placeholder="Adicione um nome para essa tag">
                    </div>

                    @include('layouts/componentes/tags')

                    <div class="mt-3 col-12">
                        <button title="Salvar" class="btn btn-cloudflare fw-bold text-light w-100 px-3 py-2">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </section>
        @include('layouts/componentes/aside')
    </main>
    @include('layouts/componentes/footer')
@endsection