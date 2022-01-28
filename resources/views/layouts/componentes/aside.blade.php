<aside class="h-100 bg-cloudflare p-3">
    <div class="btn-menu">
        <i class="fas fa-chevron-left"></i>
    </div>

    <nav class="navegacao">
        <ul class="list-group">
            <li class="list-group-item p-0 bg-transparent border-0">
                <a href="/cloudflare/{{ $conta->id }}/adicionar-tag" class="text-decoration-none text-light d-flex flex-row">
                    <i class="fas fa-plus-circle fs-4"></i>
                    <p hidden class="m-0 ps-2 exibir-link">Adicionar tag</p>
                </a>
            </li>

            <li class="list-group-item p-0 bg-transparent border-0 mt-3">
                <a href="/cloudflare/{{ $conta->id }}/listar-tag" class="text-decoration-none text-light d-flex flex-row">
                    <i class="fas fa-eye fs-4"></i>
                    <p hidden class="m-0 ps-2 exibir-link">Ver tags</p>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<script type="text/javascript">
    exibirMenu();
</script>