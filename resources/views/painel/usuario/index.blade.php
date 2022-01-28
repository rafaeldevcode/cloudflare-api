@extends('layouts/layout')

@section('conteudo')
    @include('layouts/componentes/header')

        <main class="container my-5">
            <section class="conatiner">
                @include('layouts/componentes/mensagem')
                <div class="rounded border border-cloudflare position-relative col-12 col-md-9 m-auto p-3 d-flex justify-content-between align-items-start">
                    <div class="rounded-circle image-user position-relative col-2">
                        <img class="img-thumbnail border-cloudflare rounded-circle" src="{{ $usuario->imagem_usuario }}" alt="{{ $usuario->name }}">
                        <div class="position-absolute rounded-circle p-2 bg-dark d-flex justify-content-center align-itens-center">
                            <i class="fas fa-pencil-alt fs-6 text-light" id="editar-imagen"></i>
                        </div>
                    </div>

                    <div class="col-10">
                        <h1 class="text-center">{{ $usuario->name }}</h1>
                    </div>

                    <div id="formulario-imagen" hidden class="position-absolute col-12 p-4 w-100 h-100 bg-secondary justify-content-center align-items-center rounded">
                        <i id="fechar-formulario-imagen" class="fas fa-times position-absolute"></i>
                        <form action="/painel/perfil/{{ $usuario->id }}/adicionar-imagen" method="POST" enctype="multipart/form-data" class="d-flex col-12">
                            @csrf
                            <input type="file" name="image_usuario" class="form-control w-75">
                            <button class="btn btn-cloudflare w-25" type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <script type="text/javascript">
            adicionarImagemUsuario();
        </script>

    @include('layouts/componentes/footer')
@endsection