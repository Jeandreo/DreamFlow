<div class="row">
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid get-to-url" placeholder="Nome do Projeto" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">URL:</label>
        <input type="text" class="form-control form-control-solid only-url" placeholder="URL" name="url" value="{{ $content->url ?? old('url') }}"/>
    </div>
    <div class="col-3 mb-5">
        <label class="required form-label fw-bold">Categoria:</label>
        <select class="form-select form-select-solid" name="category_id" data-control="select2" data-placeholder="Selecione" required>
            <option value=""></option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if(isset($content) && $content->category_id == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-5">
        <label class="required form-label fw-bold">Gerente:</label>
        <select class="form-select form-select-solid" name="manager_id" data-control="select2" data-placeholder="Selecione" required>
            <option value=""></option>
            @foreach ($users as $user)
            <option value="{{ $user->id }}" @if(isset($content) && $content->manager_id == $user->id) selected @endif>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-3 mb-5">
        <label class="required form-label fw-bold">Início:</label>
        <input type="text" class="form-control form-control-solid flatpickr" placeholder="Data de início" name="start_date" value="{{ $content->start_date ?? old('start_date') }}" required/>
    </div>
    <div class="col-3 mb-5">
        <label class="form-label fw-bold">Fim:</label>
        <input type="text" class="form-control form-control-solid flatpickr" placeholder="Data de fim" name="end_date" value="{{ $content->end_date ?? old('end_date') }}"/>
    </div>
    <div class="row m-0 p-0">
        <div class="col-4 mb-5">
            <label class="form-label fw-bold">Cor:</label>
            <input type="color" class="form-control form-control-solid" placeholder="Selecione uma cor" name="color" value="{{ $content->color ?? '#009ef7' }}"/>
        </div>
        <div class="col mb-5">
            <label class="required form-label fw-bold">Tipo:</label>
            <select class="form-select form-select-solid" name="type" data-control="select2" data-hide-search="true" data-placeholder="Selecione" required>
                <option value=""></option>
                <option value="1" @if(isset($content) && $content->type == 1) selected @endif>Corporativo</option>
                <option value="2" @if(isset($content) && $content->type == 2) selected @endif>Pessoal</option>
            </select>
        </div>
        <div class="col mb-5 col-team" @if(!isset($content) || $content->type == 2) style="display: none;" @endif>
            <label class="form-label fw-bold">Time:</label>
            <select class="form-select form-select-solid select-with-images" name="team[]" data-control="select2" data-hide-search="true" data-placeholder="Selecione" multiple>
                <option value=""></option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}" @if(isset($content) && in_array($user->id, $content->users->pluck('id')->toArray())) selected @endif data-kt-select2-user="{{ findImage('users/' . $user->id . '/' . 'perfil-35px.jpg') }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col mb-5">
            <label class="form-label fw-bold">Imagem:</label>
            <input class="form-control form-control-solid image-to-crop" type="file" name="image" accept="images/*">
            <input type="hidden" name="cutImage">
        </div>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea name="description" class="form-control form-control-solid" placeholder="Alguma observação sobre este projeto?">@if(isset($content->description)){{$content->description}}@endif</textarea>
    </div>
</div>


@section('custom-footer')
<script>
    $(document).ready(function(){

        // ON CHANGE TYPE
        $('[name="type"]').change(function(){

            // GET TYPE
            var type = $(this).val();

            // IF TYPE CORPORATE
            if(type == 1){
                $('.col-team').show();
            } else {
                $('.col-team').hide();
            }

        });

        // INIT SELECT2
        select2Images();

    });
</script>
@endsection