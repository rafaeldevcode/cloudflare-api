@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

    <main class="d-flex flex-column position-relative">
        <div class="col-12 col-md-10 p-2 m-auto mensagem">
            @include('layouts/componentes/mensagens', [$mensagens])
            @include('layouts/componentes/mensagem', [$mensagem])
        </div>
        
        <section class="container my-5">
            <div class="mt-3">
                <h1 class="text-center fs-3">Tags cadastradas em <span class="text-cloudflare">{{ $conta->nome }}</span></h1>
                <p class="m-0 fw-bolder text-cloudflare text-center">Limpar cache</p>
            </div>

            <form action="/cloudflare/{{ $conta->id }}/pesquisar-tag" method="POST" class="col-12 col-md-10 col-lg-8 mx-auto mt-5">
                @csrf

                <div class="d-flex flex-row input-group">
                    <input class="form-control border-cloudflare" type="search" name="pesquisar" placeholder="Pesquisar por tag">
                    <button type="submit" title="Pesquisar" class="btn btn-cloudflare text-light">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <ul class="list-group col-12 col-md-10 col-lg-8 mt-5 m-auto">
                <li class="header-list list-group-item mb-3 rounded d-flex justify-content-between align-items-center">
                    Tag
                    <span class="d-flex align-items-center">
                        <p class="m-1">Editar tag |</p>
                        <p class="m-1">Limpar tag |</p>
                        <p class="m-1">Remover tag</p>
                    </span>
                </li>

                @if (empty($tags[0]))
                    <li class="list-group-item border border-cloudflare mb-3 rounded">
                        {{ $aviso }}
                    </li>
                @else
                    @foreach ($tags as $tag)
                        <li class="list-group-item border border-cloudflare mb-3 rounded text-cloudflare">
                            <div class="d-flex justify-content-between align-items-center">
                                {{ $tag->nome }}

                                <span class="d-flex">
                                    <a class="btn btn-cloudflare limpar-urls text-light" title="Limpar cache por urls" href="#">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action="/tag/{{  $tag->id }}/purge" method="POST" class="ms-2">
                                        @csrf
                                        <input type="hidden" name="id_dominio" value="{{ $tag->ids_dominio }}">
                                        <input type="hidden" name="id_cloudflare" value="{{ $conta->id }}">

                                        <button type="submit" class="h-100 btn btn-danger session-load btn-load" title="Limpar cache">
                                            <i class="fas fa-broom"></i>
                                        </button>
                                    </form>

                                    <button id="{{ $tag->id }}" title="Remover tag" type="button" class="btn btn-secondary ms-2 remover-tag">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

    <script type="text/javascript">
        acionarLoad();
        excluirTag();

        ///////////////// EXIBIR FORMUL'RIO PARA EXCLUSÃO DA TAG ///////////
        function excluirTag(){
            let removerTag = document.querySelectorAll('.remover-tag');

            for (let i = 0; i < removerTag.length; i++) {
                removerTag[i].addEventListener('click', ()=>{
                    let id = removerTag[i].id;

                    let buttonRemover = document.createElement('button');
                        buttonRemover.setAttribute('class', 'btn btn-danger ms-1');
                        buttonRemover.setAttribute('title', 'Remover');
                        buttonRemover.setAttribute('type', 'submit');
                        buttonRemover.innerHTML = 'Remover';

                    let buttonCancelar = document.createElement('button');
                        buttonCancelar.setAttribute('class', 'btn btn-primary me-1');
                        buttonCancelar.setAttribute('id', 'cancelar');
                        buttonCancelar.setAttribute('title', 'Cancelar');
                        buttonCancelar.setAttribute('type', 'button');
                        buttonCancelar.innerHTML = 'Cancelar';

                    let div = document.createElement('divs');
                        div.setAttribute('class', 'd-flex justify-content-center');
                        div.append(buttonCancelar);
                        div.append(buttonRemover);

                    let p = document.createElement('p');
                        p.setAttribute('class', 'text-center text-cloudflare')
                        p.innerHTML = 'Realmente deseja remover esta tag?';

                    let form = document.createElement('form');
                        form.setAttribute('class', 'p-4 rounded bg-light');
                        form.setAttribute('action', `/tag/${id}/remover`);
                        form.setAttribute('method', 'POST');
                        form.innerHTML = '@csrf';
                        form.append(p);
                        form.append(div);

                    let secttion = document.createElement('section');
                        secttion.setAttribute('class', 'sessao-remover-tag d-flex justify-content-center align-items-center');
                        secttion.append(form);

                    document.querySelector('main').append(secttion);

                    cancelarFormulario();
                })
            }
        }
    </script>
@endsection