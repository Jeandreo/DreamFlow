// MASKS
Inputmask(["(99) 9999-9999", "(99) 9 9999-9999"], {
    "clearIncomplete": true,
}).mask(".input-phone");

Inputmask(["9999 9999 9999 9999"], {
    "placeholder": "",
    "clearIncomplete": true,
}).mask(".input-card");

Inputmask(["9999"], {
    "placeholder": "",
    "numericInput": true,
}).mask(".input-year");

Inputmask(["99/99"], {
}).mask(".input-month-year");

Inputmask(["999"], {
    "placeholder": "",
    "numericInput": true,
}).mask(".input-ccv");

Inputmask(["99.999.999/9999-99"], {
    "clearIncomplete": true,
}).mask(".input-cnpj");

Inputmask(["999.999.999-99"], {
    "clearIncomplete": true,
}).mask(".input-cpf");

Inputmask(["99999-999"], {
    "clearIncomplete": true,
}).mask(".input-cep");

Inputmask(["99/99/9999"], {
    "clearIncomplete": true,
}).mask(".input-date");

Inputmask(["99/99/9999 99:99:99"], {
    "clearIncomplete": true,
}).mask(".input-date-time");

Inputmask(["99:99:99"], {
    "clearIncomplete": true,
}).mask(".input-duration");

Inputmask(["99:99"], {
    "clearIncomplete": true,
}).mask(".input-time");

Inputmask(["9999.99.99"], {
    "clearIncomplete": true,
}).mask(".input-ncm");

Inputmask(["9.99", "99.99"], {
    "numericInput": true,
    "clearIncomplete": true,
}).mask(".input-comission");

Inputmask(["9.999g", "99.999g", "999.999g"], {
    "numericInput": true,
    "clearIncomplete": true,
}).mask(".input-weight");

Inputmask(["9.9cm", "99.9cm", "999.9cm"], {
    "numericInput": true,
    "clearIncomplete": true,
}).mask(".input-cm");

Inputmask(["R$ 9", "R$ 99", "R$ 9,99", "R$ 99,99", "R$ 999,99", "R$ 9.999,99", "R$ 99.999,99", "R$ 999.999,99", "R$ 9.999.999,99"], {
    "numericInput": true,
    "clearIncomplete": true,
}).mask(".input-money");

Inputmask(["$ 9", "$ 99", "$ 9.99", "$ 99.99", "$ 999.99", "$ 9,999.99", "$ 99,999.99", "$ 999,999.99", "$ 9,999,999.99"], {
    "numericInput": true,
    "clearIncomplete": true,
}).mask(".input-money-usd");


// MARK ALL TRUE
$('.select-all').click(function () {
    $('.form-check-input').prop('checked', true);
});

// MARK ALL FALSE
$('.unselect-all').click(function () {
    $('.form-check-input').prop('checked', false);
});

// SHOW AND HIDE COLUMNS FOR UPLOAD
$('.upload-type').change(function () {

    // GET VALUE SELECTED
    var value = $(this).val();

    if (value == 1) {
        // SHOW S3 
        $('.upload-s3, .upload-yes').show();
        $('.upload-vimeo, .upload-none').hide();
        $('.link-video').attr('required', false);
    } else if (value == 2) {
        // SHOW VIMEO 
        $('.upload-s3, .upload-none').hide();
        $('.upload-vimeo, .upload-yes').show();
        $('.link-video').attr('required', true);
    } else {
        // SHOW LINK 
        $('.upload-s3, .upload-vimeo, .upload-yes').hide();
        $('.upload-none, .upload-none').show();
        $('.link-video').attr('required', false);
    }

});

// GENERATE TABLES
function loadDataTable(tableSelector = '.dmk-datatables', items = 25, order = undefined) {

    // SELECT TABLE
    const table = $(tableSelector);

    // CONFIG TABLE
    const dataTableOptions = {
        pageLength: items,
        order: order,
        language: {
            search: 'Pesquisar:',
            lengthMenu: 'Mostrando _MENU_ registros por página',
            zeroRecords: 'Ops, não encontramos nenhum resultado :(',
            info: 'Mostrando _START_ até _END_ de _TOTAL_ registros',
            infoEmpty: 'Nenhum registro disponível',
            infoFiltered: '(Filtrando _MAX_ registros)',
            processing: 'Filtrando dados',
            paginate: {
                previous: 'Anterior',
                next: 'Próximo',
            },
        },
        dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            '>' +
            "<'table-responsive'tr>" +
            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            '>',
    };

    // MAKE TABLE
    table.DataTable(dataTableOptions);

}

// CREATE SIMPLE FLATPICKR
function generateFlatpickr(calendar = '.flatpickr') {
    $(calendar).flatpickr({
        altInput: true,
        altFormat: "d/m/Y",
        dateFormat: "Y-m-d H:i:S",
        locale: "pt",
    });
}

// FORCE URL
function onlyUrl(getUrl = '.get-to-url', onlyUrl = '.only-url') {
    $(`${onlyUrl}, ${getUrl}`).on('input', function () {
        // REPLACE SPACES BY HIFENS
        var texto = $(this).val().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/\s+/g, '-');

        // REMOVE SPECIAL CHARACTERS
        texto = texto.replace(/[^\w\s-]/gi, '').toLowerCase();

        // REMOVE TRAILING AND LEADING HYPHENS
        texto = texto.replace(/^-+|-+$/g, '');

        // REMOVE CONSECUTIVE HYPHENS
        texto = texto.replace(/-{2,}/g, '-');

        $(onlyUrl).val(texto);
    });
}



// OPTIONS OF CROPPER
var defaultOptionsCropper = {
    aspectRatio: 1 / 1, 
    replace: '#replace-img', 
    inputCutImage: '[name="cutImage"]', 
    onChange: '.image-to-crop',
};

// CROP IMAGE
function cropImage(optionsCropper) {

    // MESCLA OPÇÕES
    var optionsCropper = { ...defaultOptionsCropper, ...optionsCropper };

    // GET ACTUAL DIV
    var divCropper = $('#cropper_modal').html();

    // AO ALTERAR
    if(optionsCropper['onChange'] == undefined){
        optionsCropper['onChange'] = '.image-to-crop';
    }

    // AFTER INPUT FILE CHANGE
    $(optionsCropper['onChange']).change(function (file) {

        // GET FILE IN INPUT
        var file = file.target.files[0];

        // ABRE MODAL SE TIVER ARQUIVO
        if(file){
            // INSERT CROPPER IN SECTION
            $('#cropper_modal').html(divCropper);
    
            // SHOW MODAL TO CANVA
            $('#cropper_modal').modal('show');
    
            // READ FILE IN BASE64
            var reader = new FileReader();
    
            // PLACE FILE IN MODAL
            reader.onload = function (event) {
                var img = event.target.result;
                $('#crop-image').attr('src', img);
            };
    
            // EXECUTE
            reader.readAsDataURL(file);
    
            // DELAY TO FUNCTION
            setTimeout(function () {
    
                // SELECT IMAGE TO GENERATE CROP CANVA
                var image = $('#crop-image')[0];
    
                var cropper = new Cropper(image, {
                    aspectRatio: optionsCropper['aspectRatio'],
                    viewMode: 1,
                    ready() {
                        this.cropper.zoom(-0.25);
                    },
                });
    
                // CUT IMAGE
                $('#submit-cropper').click(function () {
    
                    // INICIA BOTÃO DE CARREGAMENTO
                    $('.btn-loading').attr('data-kt-indicator', 'on');
    
                    // GET IMAGE
                    cutImage = cropper.getCroppedCanvas().toDataURL('image/jpeg');
    
                    // REPLACE IMAGE
                    $(optionsCropper['replace']).attr('src', cutImage);

                    // INSERT IMAGE CUT IN INPUT FILE
                    $(optionsCropper['inputCutImage']).val(cutImage);

                    // SHOW MODAL TO CANVA
                    $('#cropper_modal').modal('hide');

                    // PARA BOTÃO DE CARREGAMENTO                    
                    $('.btn-loading').attr('data-kt-indicator', 'off');
    
    
                })
    
            }, 300);
        }

    });

}

// CUSTOM UPLOAD
class MyUploadCKE {
    constructor(loader) {
        // INSTANCE TO BE USED
        this.loader = loader;
    }

    // STARTS THE UPLOAD PROCESS
    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                this._initRequest();
                this._initListeners(resolve, reject, file);
                this._sendRequest(file);
            }));
    }

    // ABORTS THE UPLOAD PROCESS
    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    //  INITIALIZE THE OBJECT USING URL PASSED
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();
        xhr.open('POST', globalUrl + '/configuracoes/CKEupload', true);
        xhr.setRequestHeader('x-csrf-token', csrf);
        xhr.responseType = 'json';
    }

    // INIT LISTENERS
    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${file.name}.`;

        xhr.addEventListener('error', () => reject(genericErrorText));
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {

            // ERROR
            const response = xhr.response;
            if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
            }

            // SUCCESS
            resolve({
                default: response.url
            });

        });

        // UPLOAD PROGRESS
        if (xhr.upload) {
            xhr.upload.addEventListener('progress', evt => {
                if (evt.lengthComputable) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            });
        }
    }

    // PREPARE DATA AND SENDS REQUEST
    _sendRequest(file) {

        // CREATE FORMDATA
        const data = new FormData();

        // APPEND FILE
        data.append('upload', file);

        // SEND REQUEST.
        this.xhr.send(data);
    }
}

function UploadPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        // URL TO UPLOAD CKE
        return new MyUploadCKE(loader);
    };
}


// FUNCTION CKE EDITOR
function loadEditorText(selector = '.load-editor') {

    ClassicEditor.create(document.querySelector(selector), {
        extraPlugins: [UploadPlugin],
        removePlugins: ["MediaEmbedToolbar"],
    }).then(function (editor) {
        // ALOW ACCESS TO CLEAR
        textarea = editor;
    });

}

$(document).on('click', '.close-modal', function(){
    $(this).closest('.modal').modal('hide');
});

$(document).on('click', '.show-image, .show-image-div img', function(){

    // GET LINK IMAGE
    var url = $(this).attr('src');

    // REPLACE IN MODAL
    $('#preview-image-modal').attr('src', url);

    // OPEN MODAL
    $('#preview_image_modal').modal('show');

});

// PUT THE BACKGROUND IN THE TEXT COLOR
function hex2rgb($colour, $opacity) {
    
    // REMOVE # FROM STRING
    $colour = ltrim($colour, '#');

    // EXTRACT RGB FROM HEX
    $rgb = sscanf($colour, '%2x%2x%2x');
    $rgb = $opacity;

    // RETURN RGBA
    return sprintf('rgb(%d, %d, %d, %d%%)', ...$rgb);

}

// CALL FUNCTIONS
loadDataTable();
generateFlatpickr();
onlyUrl();