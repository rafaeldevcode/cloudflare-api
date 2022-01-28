@if (!empty($mensagens))
    <span class="col-12 d-flex justify-content-end">
        <i class="fas fa-times-circle fs-6 text-cloudflare" id="remover"></i>
    </span>
    
    @foreach ($mensagens as $mensagem)
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endforeach
@endif

<script type="text/javascript">
    removerMensagem();
</script>