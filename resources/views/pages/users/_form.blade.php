<div class="row">
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Nome:</label>
        <input type="text" class="form-control form-control-solid" placeholder="Nome do Projeto" name="name" value="{{ $content->name ?? old('name') }}" required/>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">E-mail:</label>
        <input type="email" class="form-control form-control-solid" placeholder="email@dreamake.com.br" name="email" value="{{ $content->email ?? old('email') }}"/>
    </div>
    <div class="col-6 mb-5">
        <label class="required form-label fw-bold">Cargo:</label>
        <select class="form-select form-select-solid" name="role_id" data-control="select2" data-placeholder="Selecione" required>
            <option value=""></option>
            <option value="1" @if(isset($content) && $content->role_id == 1) selected @endif>Administrador</option>
            <option value="2" @if(isset($content) && $content->role_id == 2) selected @endif>Gerente de Contas</option>
            <option value="3" @if(isset($content) && $content->role_id == 3) selected @endif>Gestor de Tráfego</option>
            <option value="4" @if(isset($content) && $content->role_id == 4) selected @endif>Web Designer</option>
            <option value="5" @if(isset($content) && $content->role_id == 5) selected @endif>Designer</option>
        </select>
    </div>
    <div class="col-6 mb-5">
        <label class="form-label fw-bold">Foto de Perfil:</label>
        <input class="form-control form-control-solid image-to-crop" type="file" name="image" accept="images/*">
        <input type="hidden" name="cutImage">
    </div>
    <div class="col-12 mb-5">
        <label class="required form-label fw-bold">Senha:</label>
        <input type="text" class="form-control form-control-solid" placeholder="*********" name="password" value="" @if(!isset($content)) required @endif/>
    </div>
</div>

@section('custom-footer')
<script>
    // CALL CROPPER
    cropImage();
</script>
@endsection