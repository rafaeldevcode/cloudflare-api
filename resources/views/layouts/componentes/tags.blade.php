<p class="text-cloudflare text-center mt-3">Selecione os dominios que deseja adicionar a essa tag</p>
<div class="d-flex flex-wrap justify-content-center tags-dominios">
    @for ($i = 0; $i < count($resultados['dominios']); $i++)
        <span class="d-flex p-1 border rounded">
            <label class="form-check-label fs-6" for="dominio-{{ $i }}">{{ $resultados['dominios'][$i] }}</label>
            <input class="form-check-input ms-1" id="dominio-{{ $i }}" type="checkbox" name="ids_dominio[]" value="{{ $resultados['ids_dominio'][$i] }}">
        </span>
    @endfor
</div>