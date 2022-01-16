@if ($errors->any())
    <div>
        <ul class="p-0">
            @foreach ($errors->all() as $error)
                <li class="p-1 my-1 alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif