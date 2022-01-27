@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

    <main class="d-flex flex-column">
        <section class="container my-5">
            <div class="col-12 col-md-6 m-auto">
                <div>
                    <h1 class="m-0 fw-bolder text-cloudflare text-center">Adicionar tag</h1>
                </div>
                <form action="" method="POST" class="form-control border border-cloudflare py-5">
                    @csrf
                    <div class="p-2">
                        <label for="nome" class="fs-6 text-secondary">Nome da tag</label>
                        <input type="text" class="form-control" name="nome" placeholder="Adicione um nome para essa tag">
                    </div>

                    <div class="d-flex flex-wrap justify-content-center tags-dominios mt-3">
                        <p class="text-cloudflare">Selecione os dominios que deseja adicionar a essa tag</p>
                        @for ($i = 0; $i < count($resultados['dominios']); $i++)
                            <span class="d-flex p-1 border rounded">
                                <label class="form-check-label fs-6" for="dominio-{{ $i }}">{{ $resultados['dominios'][$i] }}</label>
                                <input class="form-check-input ms-1" id="dominio-{{ $i }}" type="checkbox" name="id_cloudflare[]" value="{{ $resultados['ids_cloudflare'][$i] }}">
                            </span>
                        @endfor
                    </div>

                    <div class="mt-3 col-12">
                        <button title="Salvar" class="btn btn-cloudflare fw-bold text-light w-100 px-3 py-2">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    @include('layouts/componentes/footer')
@endsection