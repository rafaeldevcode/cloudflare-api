@if (!empty($mensagens))
    @foreach ($mensagens as $mensagem)
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endforeach
@endif