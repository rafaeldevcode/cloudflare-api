@if (!empty($mensagem))
    <span class="col-12 d-flex justify-content-end p-1">
        <i class="fas fa-times-circle fs-6 text-cloudflare" role="button" id="remover"></i>
    </span>

    <div class="alert alert-success">
        {{ $mensagem }}
    </div>

    <script type="text/javascript">
        removerMensagem();
    </script>
@endif