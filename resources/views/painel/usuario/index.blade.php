@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

        <main class="container my-5">
            <section class="conatiner">
                <div class="col-12 col-md-9 m-auto mensagem">
                    @include('layouts/componentes/mensagem')
                    @include('layouts/componentes/errors')
                </div>

                <div class="rounded border border-cloudflare position-relative col-12 col-md-9 m-auto p-3 d-flex justify-content-between align-items-start flex-wrap">
                    <div class="rounded-circle image-user position-relative col-2 m-auto">
                        <img class="img-thumbnail border-cloudflare rounded-circle" src="{{ $usuario->imagem_usuario }}" alt="{{ $usuario->name }}">
                        <div class="position-absolute rounded-circle p-2 bg-dark d-flex justify-content-center align-itens-center">
                            <i class="fas fa-pencil-alt fs-6 text-light" id="editar-imagen"></i>
                        </div>
                    </div>

                    <div class="col-10 mx-auto">
                        <h1 class="text-center">{{ $usuario->name }}</h1>
                    </div>

                    <div class="w-100 d-flex justify-content-end">
                        <a title="Deletar conta" id="deletar-conta" class="text-decoration-none text-danger" href="#">Deletar conta</a>
                    </div>

                    <div id="formulario-imagen" hidden class="position-absolute col-12 p-4 w-100 h-100 bg-secondary justify-content-center align-items-center rounded">
                        <i id="fechar-formulario-imagen" class="fas fa-times position-absolute"></i>
                        <form action="/painel/perfil/{{ $usuario->id }}/adicionar-imagen" method="POST" enctype="multipart/form-data" class="d-flex col-12">
                            @csrf
                            <input type="file" name="image_usuario" class="form-control w-75">
                            <button class="btn btn-cloudflare w-25" type="submit">Salvar</button>
                        </form>
                    </div>

                    <div id="form-deletar-conta" hidden class="position-absolute col-12 p-4 w-100 h-100 bg-secondary justify-content-center align-items-center rounded">
                        <div>
                            <p class="text-light text-center"> Certeza que deseja remover esta conta?</p>
                        </div>
                        <form action="/painel/perfil/{{ $usuario->id }}/remover" method="POST" enctype="multipart/form-data" class="d-flex col-12 justify-content-center align-items-center">
                            @csrf
                            <button id="cancelar" class="btn btn-primary w-25 me-1" type="button">Cancelar</button>
                            <button class="btn btn-cloudflare w-25 text-light ms-1" type="submit">Deletar</button>
                        </form>
                    </div>
                </div>
            </section>

            <section class="container">
                <div class="rounded border border-cloudflare col-12 col-md-9 m-auto mt-5 p-3">
                    <h2 class="d-flex justify-content-center fw-bolder text-cloudflare fs-3">
                        Editar usuário
                        <span class="ms-1 rounded-circle border border-cloudflare p-2 bg-light d-flex justify-content-center align-itens-center" role="button">
                            <i class="fas fa-pencil-alt fs-6 text-dark" id="editar-usuario"></i>
                        </span>
                    </h2>

                    <form action="/painel/perfil/{{ $usuario->id }}/editar" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div class="col-6 pe-1">
                                <label for="name" class="form-label text-secondary">Nome</label>
                                <input disabled id="name" name="name" value="{{ $usuario->name }}" type="text" class="form-control" placeholder="Nome">
                            </div>
    
                            <div class="col-6 ps-1">
                                <label for="password" class="form-label text-secondary">Nova Senha</label>
                                <input disabled id="password" name="password" type="password" class="form-control" placeholder="Nova Senha">
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <input disabled type="submit" class="btn btn-cloudflare text-light fs-5 col-12" value="Salvar">
                        </div>
                    </form>
                </div>
            </section>

            <section class="container">
                <div class="rounded border border-cloudflare col-12 col-md-9 m-auto mt-5 p-3">
                    <h2 class="text-center fw-bolder text-cloudflare fs-3">Usuários</h2>

                    <ul class="list-group">
                        @foreach ($usuarios as $usuario)
                            <li class="list-group-item border rounded border-cloudflare text-cloudflare mb-3">{{ $usuario->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </main>

        <script type="text/javascript">
            adicionarImagemUsuario();
            editarUsuario();
            deletarConta();
        </script>

    @include('layouts/componentes/footer')
@endsection