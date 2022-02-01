@extends('layouts/layout')

@section('conteudo')
    <main class="container m-auto">
        <section class="rounded shadow-sm shadow-danger mt-5 col-12 col-md-10 col-lg-6 m-auto border border-cloudflare">
            <div class="col-10 col-sm-4 m-auto p-3">
                <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>

            <div class="form-goup p-3 animacaoEntrada" id="formularios">
                <div class="col-12 p-2 m-auto mensagem">
                    @include('layouts/componentes/errors')
                </div>

                <form action="/entrar" method="POST" id="entrar">
                    @csrf

                    <div>
                        <label for="email" class="form-label text-secondary">Email</label>
                        <input type="email" name="email" placeholder="Digite seu email" class="form-control">
                    </div>
    
                    <div class="mt-4">
                        <label for="password" class="form-label text-secondary">Senha</label>
                        <input type="password" name="password" placeholder="Digite sua senha" class="form-control" >
                    </div>

                    <div class="mt-4 text-center">
                        <button title="Entrar" type="submit" class="btn btn-cloudflare fw-bold text-light w-100 py-2 mb-2">
                            Entrar
                        </button>

                        <a title="Se Registrar" href="#" id="click-registrar">Registrar-se</a>
                    </div>
                </form>

                <form hidden action="/registrar" method="POST" id="registrar">
                    @csrf

                    <div>
                        <label for="name" class="form-label text-secondary">Nome</label>
                        <input type="text" name="name" placeholder="Digite seu nome" class="form-control">
                    </div>

                    <div>
                        <label for="email" class="form-label text-secondary">Email</label>
                        <input type="email" name="email" placeholder="Digite seu email" class="form-control">
                    </div>
    
                    <div class="mt-4">
                        <label for="password" class="form-label text-secondary">Senha</label>
                        <input type="password" name="password" placeholder="Digite sua senha" class="form-control" >
                    </div>

                    <div class="mt-4 text-center">
                        <button title="Cadastrar" type="submit" class="btn btn-cloudflare fw-bold text-light w-100 py-2 mb-2">
                            Cadastrar
                        </button>

                        <a title="Fazer Login" href="#" id="click-entrar">Fazer de login</a>
                    </div>
                </form>
            </div>

            <div class="border rounded text-center fs-6 border-secondary p-3 m-3">
                <p class="text-secondary m-0">
                    Esse sistema tem o intuito de gerenciar sua conta do cloudflare. Se ainda não possui uma conta,
                    <a title="Clodflare" href="https://www.cloudflare.com/" target="_blank" rel="noopener">click aqui</a>.
                </p>
            </div>
        </section>
    </main>

    <script type="text/javascript">
        clickTrocarFormulario();
    </script>
@endsection