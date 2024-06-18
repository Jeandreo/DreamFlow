<!--Begin::Modal-Photo-->
<div class="modal fade" tabindex="-1" id="cropper_modal">
    <div class="modal-dialog modal-dialog-centered mw-800px">
        <div class="modal-content">
            <div class="modal-header py-3 bg-dark">
                <h5 class="modal-title text-white">Recortar imagem</h5>
                <div class="btn btn-icon bg-dark ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x fw-bolder">X</span>
                </div>
            </div>
            <div class="modal-body" id="div-to-crop">
                <div style="width: 100%">
                    <img src="" id="crop-image" style="height: 400px;">
                </div>
            </div>
            <div class="modal-footer py-3 bg-light">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary btn-loading" id="submit-cropper" data-kt-indicator="off">
                    <span class="indicator-label fw-bold">
                        Enviar foto
                    </span>
                    <span class="indicator-progress fw-bold">
                        Aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-Photo-->