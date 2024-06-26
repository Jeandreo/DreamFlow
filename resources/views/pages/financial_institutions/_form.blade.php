<div class="row">
    <div class="col-12 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome da categoria" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-12 mb-5">
        <label class="form-label fw-bold">Logo:</label>
        <input class="form-control form-control-solid image-to-crop" type="file" name="image" accept="images/*">
        <input type="hidden" name="cutImage">
    </div>
</div>

@section('custom-footer')
<script>
    // CROPPER CONFIG
    var optionsCropper = {
        aspectRatio: 1 / 1,
    };

    // CALL CROPPER
    cropImage(optionsCropper);
</script>
@endsection