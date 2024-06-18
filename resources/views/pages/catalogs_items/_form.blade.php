<div class="row">
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid get-to-url" placeholder="Nome" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">URL:</label>
        <input type="text" class="form-control form-control-solid only-url" placeholder="URL" name="url" value="{{ $content->url ?? old('url') }}" required/>
    </div>
    <div class="col-4 mb-5">
        <label class="form-label fw-bold">Link do Vídeo:</label>
        <input type="text" class="form-control form-control-solid" placeholder="URL" name="link_video" value="{{ $content->link_video ?? old('link_video') }}"/>
    </div>
    <div class="col-4 mb-5">
        <label class="form-label fw-bold">Link do Vídeo:</label>
        <input type="text" class="form-control form-control-solid" placeholder="URL" name="link_blog" value="{{ $content->link_blog ?? old('link_blog') }}"/>
    </div>
    <div class="col-4 mb-5">
        <label class="form-label fw-bold">Imagem:</label>
        <input class="form-control form-control-solid image-to-crop" type="file" name="image" accept="images/*">
        <input type="hidden" name="cutImage">
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Descrição:</label>
        <textarea name="content" class="form-control form-control-solid load-editor" placeholder="Conteúdo sobre o item...">@if(isset($content->content)){{$content->content}}@endif</textarea>
    </div>
</div>

@section('custom-footer')
<script>
    // CALL EDITOR
    loadEditorText();

    // CROPPER CONFIG
    var optionsCropper = {
        aspectRatio: 6 / 4,
    };

    // CALL CROPPER
    cropImage(optionsCropper);
</script>
@endsection