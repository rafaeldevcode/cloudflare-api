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

                    <div class="d-flex flex-wrap">
                        @foreach ($resultados as $resultado)
                            <span class="d-flex p-1">
                                @for ($i = 0; $i < count($resultado['dominios']); $i++)
                                    <label class="form-check-label" for="dominio-{{ $i }}">{{ $resultado['dominios'][$i] }}</label>
                                @endfor

                                @for ($i = 0; $i < count($resultado['ids_cloudflare']); $i++)
                                    <input class="form-check-input" id="dominio-{{ $i }}" type="checkbox" name="id_cloudflare[]" value="{{ $resultado['ids_cloudflare'][$i] }}">
                                @endfor
                            </span>
                        @endforeach
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