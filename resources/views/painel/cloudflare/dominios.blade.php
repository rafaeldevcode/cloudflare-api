@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')
    <div class="col-12 col-md-10 p-2 m-auto">
        @include('layouts/componentes/mensagem', [$mensagem])
    </div>

    <main class="d-flex justify-content-between position-relative">
        <section class="container my-5">
            <div class="mt-3">
                <h1 class="text-center fs-3">Dominios cadastrado em <span class="text-cloudflare">{{ $conta->nome }}</span></h1>
            </div>

            <ul class="list-group col-12 col-md-8 col-lg-6 mt-5 m-auto">
                <li class="header-list list-group-item mb-3 rounded d-flex justify-content-between align-items-center">
                    Domínio
                    <span class="d-flex">
                        <p class="m-1">Limpar chache por urls | </p>

                        <p class="m-1">Limpar cache do domínio</p>
                    </span>
                </li>
                
                @if (empty($response['result'][0]))
                    <li class="list-group-item border border-cloudflare mb-3 rounded">
                        Nenhum domínio cadastrado para esta conta!
                    </li>
                @else
                    @for ($i = 0; $i < count($response['result']); $i++)
                        <li class="list-group-item border border-cloudflare mb-3 rounded text-cloudflare">
                            <div class="d-flex justify-content-between align-items-center">
                                {{ $response['result'][$i]['name'] }}

                                <span class="d-flex">
                                    <a class="btn btn-cloudflare" title="Limpar cache por urls" href="#">
                                        <i class="fas fa-sort-down"></i>
                                    </a>
    
                                    <form action="/cloudflare/{{  $conta->id }}/purge-all" method="POST" class="ms-2">
                                        @csrf
                                        <input type="hidden" name="id_cloudflare" value="{{ $response['result'][$i]['id'] }}">
    
                                        <button type="submit" class="btn btn-danger" title="Limpar cache">
                                            <i class="fas fa-broom"></i>
                                        </button>
                                    </form>
                                </span>
                            </div>

                            <form action="?" method="POST">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="form-floating col-10">
                                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Comments</label>
                                    </div>

                                    <div class="col-2">
                                        <button class="btn btn-danger" title="Limpar" type="submit">
                                            Limpar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    @endfor
                @endif
            </ul>

            <div>
                <p class="text-center text-cloudflare m-0">
                    {{ $response['result_info']['page'] }} de {{ $response['result_info']['total_pages'] }} paginas
                </p>

                <div class="d-flex justify-content-center align-items-center">
                    <form action="/cloudflare/{{ $conta->id }}/" method="GET">
                        <input type="hidden" name="page" value="{{ $response['result_info']['page']-1 }}">

                        <button {{ $response['result_info']['page'] == 1 ? 'disabled' : '' }} title="Anterior" type="submit" class="btn btn-success m-1">
                            <i class="fas fa-step-backward"></i>
                            Anterior
                        </button>
                    </form>

                    <form action="/cloudflare/{{ $conta->id }}/" method="GET">
                        <input type="hidden" name="page" value="{{ $response['result_info']['page']+1 }}">

                        <button {{ $response['result_info']['page'] == $response['result_info']['total_pages'] ? 'disabled' : '' }} title="Próximo" type="submit" class="btn btn-success m-1">
                            Próximo
                            <i class="fas fa-step-forward"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        @include('layouts/componentes/aside')
    </main>

    @include('layouts/componentes/footer')
@endsection