<div class="modal-header py-3 bg-dark border-0">
    <div class="d-flex w-100">
        <h5 class="modal-title text-gray-300">{{ $content->name }}</h5>
    </div>
    <div class="btn btn-icon bg-pure-darker ms-2" data-bs-dismiss="modal" aria-label="Close">
        <span class="svg-icon svg-icon-2x fw-bolder">X</span>
    </div>
</div>
<div class="modal-body">
    {!! $content->description !!}
</div>
<div class="modal-footer py-3 bg-light">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
    <button type="button" class="btn btn-primary edit-agenda" data-bs-dismiss="modal" data-id="{{ $content->id }}">Editar</button>
</div>