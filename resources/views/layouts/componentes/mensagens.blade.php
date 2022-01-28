@if (!empty($mensagens))
    <span class="col-12 d-flex justify-content-end p-1">
        <i class="fas fa-times-circle fs-6 text-cloudflare" role="button" id="remover"></i>
    </span>

    @foreach ($mensagens as $mensagem)
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endforeach

    <script type="text/javascript">
        removerMensagem();
    </script>
@endif