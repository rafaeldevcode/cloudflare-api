<p class="text-cloudflare text-center mt-3">Selecione os dominios que deseja adicionar a essa tag</p>
<div class="d-flex flex-wrap justify-content-center tags-dominios">
    @foreach ($resultados as $indice => $resultado) 
        <span class="d-flex p-1 border rounded">
            <label class="form-check-label fs-6" for="{{ $resultado }}">{{ $indice }}</label>
            <input class="form-check-input ms-1" id="{{ $resultado }}" type="checkbox" name="ids_dominio[]" value="{{ $resultado }}">
        </span>
    @endforeach
</div>