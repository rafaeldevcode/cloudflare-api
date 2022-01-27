@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

    <main class="d-flex flex-column">
        <section class="container my-5">
            <div class="col-12 col-md-6 m-auto">
                <div>
                    <p class="m-0 fw-bolder text-cloudflare text-center">Adicionar tag</p>
                </div>
                <form action="" method="POST" class="form-control border border-cloudflare py-5">
                    @csrf
                    <div class="p-2">
                        <label for="nome" class="fs-6 text-secondary">Nome da tag</label>
                        <input type="text" class="form-control" name="nome" placeholder="Adicione um nome para essa tag">
                    </div>

                    <div class="mt-3 col-12">
                        <button title="Salvar" class="btn btn-cloudflare fw-bold text-light w-100 px-3 py-2">
                            Salvar
                        </button>
                    </div>
                </form>

                <section class="container-fluid">
                    @for ($i = 0; $i < 4; $i++)
                        @foreach ($response as $item)
                            @for ($i = 0; $i < 20; $i++)
                                {{ print_r($item[$i]) }}
                                <hr>
                            @endfor
                            <hr>
                        @endforeach
                    @endfor
                </section>
            </div>
        </section>
    </main>
    @include('layouts/componentes/footer')
@endsection