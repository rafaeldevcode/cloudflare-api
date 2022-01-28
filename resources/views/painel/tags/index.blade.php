@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

    <main class="d-flex flex-column position-relative">
        <div class="col-12 col-md-10 p-2 m-auto mensagem">
            @include('layouts/componentes/mensagem', [$mensagem])
        </div>
        
        <section class="container my-5">
            <div class="mt-3">
                <h1 class="text-center fs-3">Tags cadastradas em <span class="text-cloudflare">{{ $conta->nome }}</span></h1>
                <p class="m-0 fw-bolder text-cloudflare text-center">Limpar cache</p>
            </div>

            <ul class="list-group col-12 col-md-10 col-lg-8 mt-5 m-auto">
                <li class="header-list list-group-item mb-3 rounded d-flex justify-content-between align-items-center">
                    Tag
                    <span class="d-flex align-items-center">
                        <p class="m-1">Limpar tag</p>
                    </span>
                </li>

                @if (empty($tags[0]))
                    <li class="list-group-item border border-cloudflare mb-3 rounded">
                        Nenhum domínio cadastrado para esta conta!
                    </li>
                @else
                    @foreach ($tags as $tag)
                        <li class="list-group-item border border-cloudflare mb-3 rounded text-cloudflare">
                            <div class="d-flex justify-content-between align-items-center">
                                {{ $tag->nome }}

                                <span class="d-flex">
                                    <form action="/tag/{{  $tag->id }}/purge" method="POST" class="ms-2">
                                        @csrf
                                        <input type="hidden" name="id_dominio" value="{{ $tag->ids_dominio }}">
                                        <input type="hidden" name="id_cloudflare" value="{{ $conta->id }}">

                                        <button type="submit" class="btn btn-danger" title="Limpar cache">
                                            <i class="fas fa-broom"></i>
                                        </button>
                                    </form>
                                </span>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </section>
        @include('layouts/componentes/aside')
    </main>

    @include('layouts/componentes/footer')
@endsection