@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

    <main class="d-flex justify-content-between position-relative">
        <section class="container my-5">
            <div class="col-12 col-md-6 m-auto">
                <form action="?" method="POST" class="form-control border border-danger py-5">
                    <div class="p-2">
                        <label for="nome" class="fs-6 text-secondary">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome">
                    </div>

                    <div class="mt-2 p-2">
                        <label for="email" class="fs-6 text-secondary">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email de usuário utilizado para se logar no cloudflare">
                    </div>

                    <div class="mt-2 p-2">
                        <label for="chave_api" class="fs-6 text-secondary">Chave de api</label>
                        <input type="text" class="form-control" name="chave_api" placeholder="Encontrada no painel de usuário">
                    </div>

                    <div class="mt-3 col-12">
                        <button class="btn btn-danger w-100 px-3 py-2">
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