<div class="row">
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Banco:</label>
        <select class="form-select form-select-solid" name="institution_id" data-control="select2" data-placeholder="Selecione" data-allow-clear="true">
            <option value=""></option>
            @foreach ($institutions as $institution)
            <option value="{{ $institution->id }}" @if(isset($content) && $content->institution_id == $institution->id) selected @endif>{{ $institution->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid get-to-url" placeholder="Nome do Projeto" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-3 mb-5">
        <label class="required form-label fw-bold">URL:</label>
        <input type="text" class="form-control form-control-solid only-url" placeholder="URL" name="url" value="{{ $content->url ?? old('url') }}" required/>
    </div>
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Cor:</label>
        <input type="color" class="form-control form-control-solid" placeholder="Selecione uma cor" name="color" value="{{ $content->color ?? '#009ef7' }}"/>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre esta carteira?">@if(isset($content->description)){{$content->description}}@endif</textarea>
    </div>
</div>

@section('custom-footer')
<script>
    // REPLACE NAME OF INSTITUTION
    $('[name="institution_id"]').change(function(){

        // GET NAME
        var name = $(this).find('option:selected').text().trim();

        // REPLACE IN NAME
        $('[name="name"]').val(name);

    });
</script>
@endsection