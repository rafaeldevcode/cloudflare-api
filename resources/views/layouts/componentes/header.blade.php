<header class="header bg-light p-3 d-flex justify-content-between align-items-center">
    <div class="image-logo">
        <a title="Painel principal" class="nav-link" href="/painel">
            <img class="w-100" src="{{ asset('images/logo.png') }}" alt="">
        </a>
    </div>

    <nav class="navbar">
        <details class="position-relative me-3 drop">
            <summary class="text-secondary">
                {{ $usuario->name }}
            </summary>

            <ul class="list-group position-absolute">
                <li class="list-group-item p-2 text-start">
                    <i class="fas fa-user text-secondary me-1"></i>
                    <a title="Perfil usuário" class="text-decoration-none text-secondary" href="/painel/perfil/{{ str_replace(' ', '-', strtolower($usuario->name)) }}">Perfil</a>
                </li>
                <li class="list-group-item py-2 px-3 text-start">
                    <i class="fas fa-sign-out-alt text-danger"></i>
                    <a title="Fazer logout" class="text-decoration-none text-danger" href="/sair">Sair</a>
                </li>
            </ul>
        </details>
    </nav>
</header>