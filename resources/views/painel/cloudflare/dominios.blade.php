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
                @if (empty($response['result'][0]))
                    <li class="list-group-item border border-cloudflare mb-3 rounded">
                        Nenhum domínio cadastrado para esta conta!
                    </li>
                @else
                    @for ($i = 0; $i < count($response['result']); $i++)
                        <li class="list-group-item border border-cloudflare mb-3 rounded text-cloudflare d-flex justify-content-between align-items-center">
                            {{ $response['result'][$i]['name'] }}

                            <span class="d-flex">
                                <a class="btn btn-primary" title="Ver domíminio" href="#">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="/cloudflare/{{  $conta->id }}/purge-all" method="POST" class="ms-2">
                                    @csrf
                                    <input type="hidden" name="id_cloudflare" value="{{ $response['result'][$i]['id'] }}">

                                    <button type="submit" class="btn btn-danger" title="Limpar cache">
                                        <i class="fas fa-broom"></i>
                                    </button>
                                </form>
                            </span>
                        </li>
                    @endfor
                @endif
            </ul>
        </section>
    </main>

    @include('layouts/componentes/footer')
@endsection