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
        "locale": "pt",
    });
}

// FORCE URL
function onlyUrl(getUrl = '.get-to-url', onlyUrl = '.only-url'){
    $(`${onlyUrl}, ${getUrl}`).on('input', function() {
        // REPLACE SPACES BY HIFENS
        var texto = $(this).val().replace(/\s+/g, '-');
        
        // REMOVE SPECIAL CHARACTERS
        texto = texto.replace(/[^\w\s-]/gi, '').toLowerCase();
        $(onlyUrl).val(texto);
    });
}


// CALL FUNCTIONS
loadDataTable();
generateFlatpickr();
onlyUrl();