@if ($errors->any())
    <div>
        <span class="col-12 d-flex justify-content-end p-1">
            <i class="fas fa-times-circle fs-6 text-cloudflare" role="button" id="remover"></i>
        </span>

        <ul class="p-0">
            @foreach ($errors->all() as $error)
                <li class="p-1 my-1 alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script type="text/javascript">
        removerMensagem();
    </script>
@endif