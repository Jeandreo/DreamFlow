<div class="row">
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid get-to-url" placeholder="Nome do Projeto" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">URL:</label>
        <input type="text" class="form-control form-control-solid only-url" placeholder="URL" name="url" value="{{ $content->url ?? old('url') }}" required/>
    </div>
    <div class="row m-0 p-0">
        <div class="col-4 mb-5">
            <label class="form-label fw-bold">Cor:</label>
            <input type="color" class="form-control form-control-solid" placeholder="Selecione uma cor" name="color" value="{{ $content->color ?? '#009ef7' }}"/>
        </div>
        <div class="col-4 mb-5">
            <label class="required form-label fw-bold">Ícone:</label>
            <input type="text" class="form-control form-control-solid" placeholder="fa-solid fa-pen-to-square" name="icon" value="{{ $content->icon ?? old('icon')}}" required/>
        </div>
        <div class="col-4 mb-5">
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