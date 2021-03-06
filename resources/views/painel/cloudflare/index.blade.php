@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')
    
    <main class="d-flex flex-column position-relative">
        <div class="col-12 col-md-10 p-2 m-auto mensagem">
            @include('layouts/componentes/mensagem', [$mensagem])
            @include('layouts/componentes/errors')
        </div>
        
        <section class="container my-5">
            <div class="mt-3">
                <h1 class="text-center fs-3">Dominios cadastrado em <span class="text-cloudflare">{{ $conta->nome }}</span></h1>
                <p class="m-0 fw-bolder text-cloudflare text-center">Limpar cache</p>
            </div>

            <form action="/cloudflare/{{ $conta->id }}/pesquisar-dominios" method="POST" class="col-12 col-md-10 col-lg-8 mx-auto mt-5">
                @csrf

                <div class="d-flex flex-row input-group">
                    <input class="form-control border-cloudflare" type="search" name="pesquisar" placeholder="EX: meudominio.com.br">
                    <button type="submit" title="Pesquisar" class="btn btn-cloudflare text-light">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <ul class="list-group col-12 col-md-10 col-lg-8 mt-5 m-auto">
                <li class="header-list list-group-item mb-3 rounded d-flex justify-content-between align-items-center">
                    Domínio
                    <span class="d-flex align-items-center">
                        <p class="m-1">Limpar por urls | </p>

                        <p class="m-1">Limpar domínio</p>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                        </div>

                        <div hidden class="form-check m-auto abilitar">
                            <input class="form-check-input ms-1" type="checkbox" value="" id="flexCheckChecked">
                        </div>
                    </span>
                </li>
                
                @if (empty($response['result'][0]))
                    <li class="list-group-item border border-cloudflare mb-3 rounded">
                        {{ $aviso }}
                    </li>
                @else
                    @for ($i = 0; $i < count($response['result']); $i++)
                        <li class="list-group-item border border-cloudflare mb-3 rounded text-cloudflare">
                            <div class="d-flex justify-content-between align-items-center">
                                {{ $response['result'][$i]['name'] }}

                                <span class="d-flex">
                                    <a class="btn btn-cloudflare limpar-urls text-light" title="Limpar cache por urls" href="#">
                                        <i class="fas fa-sort-down arrow"></i>
                                    </a>
    
                                    <form action="/cloudflare/{{  $conta->id }}/purge-all" method="POST" class="ms-2">
                                        @csrf
                                        <input type="hidden" name="id_dominio" value="{{ $response['result'][$i]['id'] }}">
    
                                        <button type="submit" class="h-100 btn btn-danger session-load btn-load" title="Limpar cache">
                                            <i class="fas fa-broom"></i>
                                        </button>
                                    </form>

                                    <div hidden class="form-check m-auto abilitar">
                                        <input class="form-check-input ms-1" type="checkbox" value="{{ $response['result'][$i]['id'] }}">
                                    </div>
                                </span>
                            </div>

                            <form hidden class="form-limpar-urls mt-2" action="/cloudflare/{{ $conta->id }}/purge" method="POST">
                                <div class="d-flex justify-content-between align-items-start">
                                    @csrf
                                    <input type="hidden" name="id_dominio" value="{{ $response['result'][$i]['id'] }}">

                                    <div class="form-floating col-9">
                                        <textarea class="form-control" name="urls" placeholder="Uma URL por linha" id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Digite uma url por linha</label>
                                    </div>

                                    <div class="col-2 session-load">
                                        <button class="btn btn-danger w-100 btn-load" title="Limpar" type="submit">
                                            Limpar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    @endfor
                @endif
            </ul>

            <div class="col-12 col-md-10 col-lg-8 m-auto d-flex justify-content-end btn-limpar-urls-selecionadas">
                @csrf
                <input type="hidden" id="id" value="{{ $conta->id }}">

                <button hidden title="Limpar URLs" type="button" class="btn btn-danger abilitar session-load btn-load" id="limpar-urls-selecionadas">
                    Limpar URLs
                </button>
            </div>

            <div>
                <p class="text-center text-cloudflare m-0">
                    {{ $response['result_info']['page'] }} de {{ $response['result_info']['total_pages'] }} páginas
                </p>

                <div class="d-flex justify-content-center align-items-center">
                    <form action="/cloudflare/{{ $conta->id }}/" method="GET">
                        <input type="hidden" name="page" value="{{ $response['result_info']['page']-1 }}">

                        <button {{ $response['result_info']['page'] == 1 ? 'disabled' : '' }} title="Anterior" type="submit" class="btn btn-success m-1 session-load btn-load">
                            <i class="fas fa-step-backward"></i>
                            Anterior
                        </button>
                    </form>

                    <form action="/cloudflare/{{ $conta->id }}/" method="GET">
                        <input type="hidden" name="page" value="{{ $response['result_info']['page']+1 }}">

                        <button {{ $response['result_info']['page'] == $response['result_info']['total_pages'] ? 'disabled' : '' }} title="Próximo" type="submit" class="btn btn-success m-1 session-load btn-load">
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

    <script type="text/javascript">
        abilitarFormulario();
        abilitarLimpezaPorUrl();
        limparUrlsSelecionadas();
        acionarLoad();
    </script>
@endsection