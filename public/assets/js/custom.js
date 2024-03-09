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
function loadTables(tableSelector = '#datatables', items = 25, order = undefined) {

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

// DATATABLE SERVER SIDE
function loadTablesServer(processing, options = { selector: '#datatables-clients', items: 25, order: undefined }) {

    // SELECT TABLE
    const table = $(options['selector']);

    // CONFIG TABLE
    const dataTableOptions = {
        serverSide: true,
        ajax: {
            url: processing['url'],
            data: function (data) {
                data.searchBy = data.search.value;
                data.order_by = data.columns[data.order[0].column].data;
                data.per_page = data.length
            }
        },
        buttons: false,
        searching: true,
        order: options['order'],
        pageLength: options['items'],
        columns: processing['columns'],
        "language": {
            "search": "Pesquisar:",
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Ops, não encontramos nenhum resultado :(",
            "info": "Mostrando _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(Filtrando _MAX_ registros)",
            "processing": "Filtrando dados",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo",
            }
        },
        "dom":
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    };

    // MAKE TABLE
    table.DataTable(dataTableOptions);

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
        xhr.open('POST', globalUrl + '/core/configuracoes/CKEupload', true);
        xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
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
function CKEditor(textarea = 'textarea', externalLinks = true) {

    // INIT VARIABLE
    var textareaElements = [];

    // FIND TEXTAREAS
    $(textarea).each(function () {
        var textareaId = $(this).attr('id');
        textareaElements.push(textareaId);
    });

    // LOOP CREATE CKE
    textareaElements.forEach(function (id) {

        // VERIFY IF THE TEXTAREAS ARE CORRECT
        if (id != undefined) {
            ClassicEditor.create(document.querySelector('#' + id), {
                extraPlugins: [UploadPlugin],
                removePlugins: ["MediaEmbedToolbar"],
                link: { 
                    addTargetToExternalLinks: true 
                },
            }).then(function (editor) {
                // ALOW ACCESS TO CLEAR
                textArea = editor;
            });
        }

    });

}

// OPÇÕES DO CROPPER
var defaultOptionsCropper = {
    aspectRatio: 1 / 1, 
    replace: '#replace-img', 
    inputCutImage: '[name="cutImage"]', 
    onChange: '.image-to-crop', 
    sizes: ['small', 'medium', 'big']
};

// CROP IMAGE
function cropImage(optionsCropper, ajax = null, table = null) {

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
    
                    // IF YOU WANT TO RETURN TO THE FORM
                    if (ajax === null) {
    
                        // REPLACE IMAGE
                        $(optionsCropper['replace']).attr('src', cutImage);
    
                        // INSERT IMAGE CUT IN INPUT FILE
                        $(optionsCropper['inputCutImage']).val(cutImage);
    
                        // SHOW MODAL TO CANVA
                        $('#cropper_modal').modal('hide');
    
                        // PARA BOTÃO DE CARREGAMENTO                    
                        $('.btn-loading').attr('data-kt-indicator', 'off');
    
                    } else {
    
                        // MAKE A OBJECT FORMDATA
                        var formData = new FormData();
    
                        // ADD FILE TO FORMDATA
                        formData.append('id', ajax['id']);
                        formData.append('path', ajax['path']);
                        formData.append('image', cutImage);
                        formData.append('nameFile', ajax['nameFile']);
                        formData.append('sizes', optionsCropper['sizes']);
    
                        // ATUALIZA O BANCO
                        if(table != null){
                            formData.append('tableId', table['id']);
                            formData.append('tableName', table['name']);
                            formData.append('tableColumn', table['column']);
                            formData.append('tableValue', table['value']);
                        }
    
                        // AJAX
                        $.ajax({
                            url: globalUrl + '/configuracoes/cropper',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                window.location.reload();
                            },
                        });
    
                    }
    
                })
    
            }, 300);
        }

    });

}

// FUNCTION GENERATE META TAGS
function generateTags(btn = '.generate-data, .generate-tags', get = '.get-tag', replace = '.replace-tag') {

    // GENERATE INFOS FOR META
    $(btn).click(function () {

        // GET VALUE
        var content = $(get).val();

        // REPLACE IN INPUTS
        $(replace).val(content);

    });

}

// SELECT PRINTER
$('.related-brands').change(function () {

    var id = $(this).val();
    var url = globalUrl + '/core/modelos-impressoras/modelos/' + id;

    $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
            $('#models').html(data);
        }
    });

});

// FUNCTION GENERATE META TAGS
function generateUrl(btnUrl = '.generate-data, .generate-url', get = '.get-url', replace = '.replace-url') {

    $(btnUrl).click(function () {

        // GET VALUE
        var url = $(get).val();

        // REMOVE SPECIAL CHARACTERS
        var contentClear = clearUrl(url);

        // REPLACE INPUT URL
        $(replace).val(contentClear);

    });

    // FORCE URL
    $(replace).on("keyup", function () {

        // GET VALUE
        var value = $(this).val();

        // CLEAR DATA
        var contentClear = clearUrl(value);

        // VAR REPLACE DATA
        $(this).val(contentClear);

    });

    function clearUrl(string) {

        var clearUrl = string
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')  // Remove acentos
            .replace(/\//g, '-')  // Substitui barras por hífen
            .replace(/[_\s]/g, '-')  // Substitui espaços e underscores por hífen
            .replace(/\|/g, '')  // Remove barras verticais
            .replace(/[!@#$%^&*()?,.ˆ˜`;":;'''><{}+=[\]\\]/g, '')  // Remove caracteres especiais
            .replace(/[-]+/g, '-')  // Substitui múltiplos hífens por um único hífen
            .replace(/\./g, '-')  // Substitui pontos por hífen
            .replace(/-{2,}/g, '-')  // Garante no máximo um hífen consecutivo
            .toLowerCase();
    
        // Remove hífens do início e do final
        clearUrl = clearUrl.replace(/^-+|-+$/g, '');

        // RETURN NEW URL
        return clearUrl;

    }

}

function clearUrls(replace = '.replace-url') {
    // FORCE URL
    $(replace).on("keyup", function () {

        // GET VALUE
        var value = $(this).val();

        // CLEAR DATA
        var contentClear = clearUrl(value);

        // VAR REPLACE DATA
        $(this).val(contentClear);

    });

    function clearUrl(string) {

        var clearUrl = string
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')  // Remove acentos
            .replace(/\//g, '-')  // Substitui barras por hífen
            .replace(/[_\s]/g, '-')  // Substitui espaços e underscores por hífen
            .replace(/\|/g, '')  // Remove barras verticais
            .replace(/[!@#$%^&*()?,.ˆ˜`;":;'''><{}+=[\]\\]/g, '')  // Remove caracteres especiais
            .replace(/[-]+/g, '-')  // Substitui múltiplos hífens por um único hífen
            .replace(/\./g, '-')  // Substitui pontos por hífen
            .replace(/-{2,}/g, '-')  // Garante no máximo um hífen consecutivo
            .toLowerCase();
    
        // Remove hífens do início e do final
        clearUrl = clearUrl.replace(/^-+|-+$/g, '');

        // RETURN NEW URL
        return clearUrl;

    }
}

// SHOW AND HIDE
function showAndHide(change, classToShow, classToHide) {

    // CHANGE TYPE DATA
    $(document).on('change', change, function () {

        // GET OPTION SELECTED
        var option = $(this).val();

        // GET VALUE OF SELECTED
        if (option == 1) {
            $(classToShow).hide();
            $(classToHide).show();
        } else {
            $(classToShow).show();
            $(classToHide).hide();
        }

    });

}

// SELECT2 WITH AJAX CLIENTS
function selectClients(select2 = '.select-ajax-clients') {
    $(select2).select2({
        placeholder: 'Selecione um item',
        minimumInputLength: 2,
        ajax: {
            url: globalUrl + '/core/buscar-clientes',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
}

// TEXT-AREA AUTO
function textAreaAutoHeight() {
    
    // Ajustar a altura de textareas específicos ao carregar a página
    adjustSpecificTextareaHeights();
        
    // Ajustar a altura do textarea conforme o usuário digita ou ao carregar o conteúdo
    $(document).on('input', '.text-area-auto', function () {
        adjustTextareaHeight(this);
    });

    function adjustSpecificTextareaHeights() {
        $('.text-area-auto').each(function() {
            adjustTextareaHeight(this);
        });
    }

    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }

}

// TEXT-AREA COUNT
function countTextArea(classTextArea, resultCountCharacters) {
    
    // PEGA O SELETOR E CONTA QUANTOS CARACTERES TEM DIGITADOS NESSA CLASSE DO TEXTAREA
    var countCharacters = $(classTextArea).val().length;

    // RETORNA O RESULTADO DA CONTAGEM
    $(resultCountCharacters).html(countCharacters);

}

// COPIAR PARA A ÁREA DE TRANSFERÊNCIA
function copyTooClipBoard(clickToCopy = '.click-to-copy', elementToCopy = '.copy-this') {

    $(document).on('click', clickToCopy, function () {

        // PEGA O ELEMENTO HTML PARA COPIAR
        var element = $(elementToCopy).text().trim();

        // SE NÃO HTML PEGA O VALOR
        if (element.length == 0) {
            element = $(elementToCopy).val().trim();
        }

        navigator.clipboard.writeText(element);

    });

}


function clipBoardDiv(findInside = true) {

    // DEFINE THE SPACE THAT WILL RECEIVE THE MESSAGE
    clipboardDiv = document.createElement('div');
    clipboardDiv.style.fontSize = '12pt';
    clipboardDiv.style.background = 'white';
    clipboardDiv.style.position = 'fixed';
    clipboardDiv.setAttribute('readonly', '');
    clipboardDiv.style.opacity = 0;
    clipboardDiv.style.pointerEvents = 'none';
    clipboardDiv.style.zIndex = -1;
    clipboardDiv.setAttribute('tabindex', '0');
    clipboardDiv.innerHTML = '';
    document.body.appendChild(clipboardDiv);

    // FUNCTION TO COPY TO CLIPBOARD
    function copyHtmlToClipboard(html) {
        clipboardDiv.innerHTML = html;
        var focused = document.activeElement;
        clipboardDiv.focus();
        window.getSelection().removeAllRanges();
        var range = document.createRange();
        range.setStartBefore(clipboardDiv.firstChild);
        range.setEndAfter(clipboardDiv.lastChild);
        window.getSelection().addRange(range);
        var ok = false;
        document.execCommand('copy')
        focused.focus();
    }



    // EXECUTE FUNCTION ON CLICK
    $(document).on('click', '.copy-text', function () {

        // GET TEXT
        if (findInside == true) {
            var text = $(this).find('.message').html();
        } else {
            var text = $('.message').html();
        }

        // COPY TO CLIPBOARD
        copyHtmlToClipboard(text);

        // SHOW MESSAGE
        $('.alert-copy').fadeIn('fast', function () {
            setTimeout(function () {
                $('.alert-copy').fadeOut('fast');
            }, 1200);
        });
    });
}


function copyThis(clickToCopy = '.click-copy', elementToCopy = '.copy-this') {

    $(document).on('click', clickToCopy, function(){

        // PEGA O ELEMENTO HTML PARA COPIAR
        var element = $(this).find(elementToCopy).text();

        // SE NÃO HTML PEGA O VALOR
        if (element.length == 0) {
            element = $(elementToCopy).val();
        }

        navigator.clipboard.writeText(element);

    });

}


function tinyTextArea(selector = '.tinymce', max = 3000) {

    // TEXT AREA
    tinymce.init({
        selector: selector,
        content_style: 'body { background-color: #F9F9F9; };',
        forced_root_block: false,
        toolbar: '',
        plugins: 'wordcount',
        deprecation_warnings: false,
        setup: function (editor) {
            editor.on('init', function (e) {
                var count = tinymce.activeEditor.plugins.wordcount.body.getCharacterCount();
                $('.tox-statusbar__branding').html(count + '/' + max);
            });
        },
        init_instance_callback: function (editor) {
            editor.on('keyup', function (e) {
                
                var count = tinymce.activeEditor.plugins.wordcount.body.getCharacterCount();

                $('.tox-statusbar__branding').html(count + ' / ' + max);
                if (count > max) {
                    $('textarea').html(count + ' / ' + max);
                    $('#submit-input').hide();
                    $('#max-input').show();
                } else {
                    $('#submit-input').show();
                    $('#max-input').hide();
                }
            });
        },
    });

}

// UPLOAD VÍDEO IN S3
function uploadS3(path, name, fileSelector = '.file-aws', formSelector = null, url = null) {

    // GET FILE
    var file = $(fileSelector)[0].files[0];

    // IF SELECT FILE
    if (file) {

        // CONFIG AWS
        AWS.config.update({
            accessKeyId: AWSaccessKeyId,
            secretAccessKey: AWSsecretAccessKey,
            region: AWSregion,
            httpOptions: {
                timeout: 45 * 60 * 1000
            }
        });

        // KEY AWS
        var s3Key = path + name;

        // INITIAL AWS
        var s3 = new AWS.S3();

        // PARAMETERS
        var params = {
            Bucket: AWSBucket,
            Key: s3Key,
            ContentType: file.type,
            ACL: 'public-read',
            Body: file,
        };

        // CONFIG UPLOAD
        var upload = new AWS.S3.ManagedUpload({
            params: params
        });

        // WHILE UPLOAD
        upload.on('httpUploadProgress', function (progress) {
            var percentUploaded = (progress.loaded / progress.total) * 100;
            $('#progress-aws-bar').fadeIn('slow');
            $('#progress-aws').css('width', percentUploaded.toFixed(2) + '%');
            $('#progress-aws').html(percentUploaded.toFixed(2) + '%');
        });

        // DONE
        var promise = upload.promise();

        // STOP PREVENT DEFAULT
        sendForm = true;

        // DONE UPLOAD
        promise.then(
            function (data) {
                
                // IF REDIRECT
                if (url) {
                    // RELOAD URL
                    window.location.replace(url);
                } else {
                    // DISABLE SUBMIT FORM
                    $(formSelector).submit();
                }

                // FADE OUT
                $('#progress-aws-bar').fadeOut('slow', function(){
                    $('#progress-aws').css('width', '0%');
                    $('#progress-aws').html('0%');
                });

                // HABILITA O BOTÃO ENVIAR NOVAMENTE
                $('.btn-loading').prop('disabled', false);
                $('.btn-loading').attr('data-kt-indicator', 'off');
                return true;
            },
        );
    } else {
        // REDIRECT OR SUBMIT
        if (url) {
            // RELOAD URL
            window.location.replace(url);
        } else {
            // DISABLE SUBMIT FORM
            sendForm = true;
            $(formSelector).submit();
        }
    }

}

// UPLOAD S3 WITH FORM
var sendForm = false;
function uploadS3Form(path, name, fileSelector, formSelector) {
    $(formSelector).submit(function (e) {
        // IF NOT SEND YET
        if (sendForm == false) {
            e.preventDefault();
            uploadS3(path, name, fileSelector, formSelector);
        }
    });
}

// REPLACE TEXT IN PREVIEWS
function replaceTexts(get, replace, defaultText = null) {
    $(get).keyup(function () {

        var text = $(this).val();

        if (text != '') {
            // REPLACE IN
            $(replace).html($(this).val());
        } else {
            $(replace).html(defaultText);
        }

    });
}

// CREATE SIMPLE FLATPICKR
function generateFlatpickr(calendar = '.flatpickr') {

    $(calendar).flatpickr({
        altInput: true,
        altFormat: "d/m/Y",
        dateFormat: "Y-m-d",
        "locale": "pt",
    });

}

// SELECT2 WITH IMAGES
function selectWithImages(search = true, select = '.select-images') {

    // OPTIONS SELECT
    var optionFormat = function (item) {
        if (!item.id) {
            return item.text;
        }

        var span = document.createElement('span');
        var imgOrColor = item.element.getAttribute('data-select2-image');
        var template = '';

        // IF URL GET IMAGE ELSE COLOR
        if (!imgOrColor.includes('#')) {
            template += '<img src="' + imgOrColor + '" class="rounded-circle h-20px w-20px object-fit-cover me-2" alt="image"/>';
        } else {
            template += '<div class="color-select" style="background:' + imgOrColor + '"></div>';
        }

        template += item.text;

        span.innerHTML = template;

        return $(span);
    }

    var searchResults = search == true ? true : -1;

    // INIT SELECT2
    $('.select-images').select2({
        templateSelection: optionFormat,
        templateResult: optionFormat,
        minimumResultsForSearch: searchResults
    });

}

// DESTROY CACHE
$('#copyright-store').click(function () {
    localStorage.clear();
    location.reload();
});

// ROTATE ICON
$('.menu-link').click(function () {
    $(this).find('.icon-rotate').toggleClass('rotate');
});

$('.icon-search-header').click(function(){
    $('.search-header').submit();
});

// SEARCH IN SULINKPLUS
$('.search-header').submit(function (e) {
    
    // PREVENT DEFAULT
    e.preventDefault();

    // GET VALUE
    var text = $(this).find('input').val();

    // URL TO SEARCH
    var url = globalUrl + '/buscar/' + text;

    // SEARCH
    window.location.href = url;

});

// COMPARTILHAR WHATSAPP
function openWhatsApp() {
    var whatsappUrl = 'https://api.whatsapp.com/send?text=' + encodeURIComponent('Hey, veja esse curso que acabei de encontrar: ' + window.location.href);
    window.open(whatsappUrl, '_blank');
}

// MODAL OPEN IMAGEM
$(document).on('click', '.open-modal-image, .image img', function(e){

    e.preventDefault();

    // GET IMAGE
    var url = $(this).attr('src');

    console.log(url);
    
    if(url == undefined){
        url = $(this).attr('href');
    } 

    console.log(url);

    // REPLACE IMAGE
    $('#replace-img-modal').attr('src', url);

    // OPEN MODAL
    $('#modalOpenImage').modal('show');

});

// MODAL OPEN VIDEO
$(document).on('click', '.open-modal-video', function(e){

    e.preventDefault();

    // GET IMAGE
    var url = $(this).attr('src');
    if(url == undefined){
        url = $(this).attr('href');
    } 

    // REPLACE VIDEO
    $('#replace-video').attr('src', url);

    // OPEN MODAL
    $('#modalOpenVideo').modal('show');

});

// GERADOR DE SENHA
function generatePassword() {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWXYZ@*#";
    var passwordLength = 12;
    var password = "";

    for (var i = 0; i < passwordLength; i++) {
        var randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber + 1);
    }

    $('[name="password"]').val(password);
}

// Chama o gerador de senha quando clica no botão de gerar senha manualmente
$(document).on('click', '.generate-pass', function(){
    // Chama a função de geração de senha quando o botão é clicado
    generatePassword();
});


$('.btn-verify-loggin').click(function(e){

    // NÃO ESTÁ LOGADO
    if(logged == false){

        // PARA O ACESSO
        e.preventDefault();

        // DEFINE SESSÃO
        var url = $(this).attr('href');
        sessionStorage.setItem('redirectToBuy', url);
        
        // ABRE O MODAL
        $('#modal_login').modal('show');

    }       
         
});

// REDIRECIONA APÓS LOGIN COM GOOGLE

// URL ATUAL
var googleUrl = $('.btn-login-google').attr('href');

// ASSIM QUE CLICAR
$(document).on('click', '.replace-in-login', function(){

    // COLETA URL ATUAL
    var url = $(this).attr('href');
    
    // SE NÃO EXISTIR NO BOTÃO URL
    if(url == undefined){
        var url = window.location.href;
    }

    // DEFINE URL COM PARAMETRO
    var newUrl = googleUrl + '/?url=' + url;

    // ATUALIZA A URL DO BOTÃO GOOGLE
    $('.btn-login-google').attr('href', newUrl);

});

// SE EXISTIR REDIRECIONAMENTO
if (sessionStorage.getItem('redirectToBuy') != null && logged == true) {

    // PEGA URL
    var url = sessionStorage.getItem('redirectToBuy');

    // DESTROI VARIÁVEL
    sessionStorage.removeItem('redirectToBuy');

    // REDIRECIONA
    window.location.href = url;

} else {
    // DESTROI VARIÁVEL
    sessionStorage.removeItem('redirectToBuy');
}


//FUNÇÃO PARA O BOTÃO DE COMPARTILHAR A URL - LINK PARA A ÁREA DE TRANSFERÊNCIA

$(".shareLinkUrl").click(function() {
    // Obtém o URL da página atual
    var currentUrl = window.location.href;

    // Cria um elemento de input para inserir o URL
    var input = document.createElement('input');
    input.value = currentUrl;
    document.body.appendChild(input);

    // Seleciona e copia o texto do campo de entrada
    input.select();
    document.execCommand('copy');

    // Remove o campo de entrada
    document.body.removeChild(input);

    // Feedback para o usuário
    alert("O link da página foi copiado para a área de transferência, agora cole onde deseja enviar para compartilhar :)");
});


// VERIFICA SE JÁ EXISTEM ITENS COM OS MESMOS CAMPOS
function verifyBeforeSave(model, itemId = 'null', inputs = 'default'){

    // CAMPOS PADRÕES
    if(inputs == 'default'){
        var inputs = '[name="name"], [name="title"], [name="meta_title"], [name="meta_description"], [name="meta_keywords"], [name="url"]';
    }

    // AO ALTERAR ALGUM DELES
    $(document).on('change', inputs, function(){

        // GET INPUTS
        var name = $(this).attr('name');
        var value = $(this).val();

        // RECORD
        $.ajax({
            type:'POST',
            url: globalUrl + '/core/configuracoes/existe',
            data: {
                _token: '{{ csrf_token() }}',
                idItem: itemId,
                name: name,
                value: value,
                model: model,
            },
            success:function(exists) {

                // OBTEM INPUT
                var input = $('[name="' + name + '"]');
                var button = input.closest('form').find('[type="submit"]');

                // SE EXISTIR
                if(exists == true){
                    // INPUT
                    input.addClass('border-danger');
                    input.after('<span class="text-danger fs-7">Desculpe, mas um item com este valor já existe.</span>');
                    
                    // BOTÃO FORMULÁRIO
                    button.attr('disabled', true);
                    button.addClass('btn-danger');
                    button.removeClass('btn-primary');
                } else {
                    // INPUT
                    input.removeClass('border-danger');
                    input.next().remove();

                    // BOTÃO FORMULÁRIO
                    button.attr('disabled', false);
                    button.addClass('btn-primary');
                    button.removeClass('btn-danger');
                }
            }
        });

    });

}