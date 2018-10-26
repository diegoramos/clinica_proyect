

var table = $('#paciente_table').DataTable({ 
        "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url":baseurl+"paciente/ajax_list/",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
 
    });


////////////////////////////777
////////////LOGIN///////////77
$("input").change(function(){
    $(this).parent().removeClass('has-error');
    $(this).next().empty();
});
$("textarea").change(function(){
    $(this).parent().removeClass('has-error');
    $(this).next().empty();
});
$("select").change(function(){
    $(this).parent().removeClass('has-error');
    $(this).next().empty();
});
function add_paciente()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modalSavePatient').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Nuevo Paciente'); // Set Title to Bootstrap modal title
    $('#photo-preview').hide(); // hide photo preview modal
    $('#label-photo').text('Subir Foto'); // label photo upload
}
function save()
{
    $('#btnSave').text('guardando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url= baseurl+"login/patient_ajax_add";
    var formData =new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modalSavePatient').modal('hide');
                window.location = baseurl+data.url;
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error guardando / actualizando dato');
            $('#btnSave').text('Guardar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
$(document).ready(function () {
        $('#login').on('submit', function (e) {
            e.preventDefault();
            var url = baseurl;
            var data = $(this).serialize();
            var formData =new FormData($(this)[0]);
            $.ajax({
                url: url+'login/check_login',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'error') {
                        $('#loader').show();
                        $(document).trigger('ajaxError');
                    }else if(response.status==='otro'){
                        $('#loader').show();
                        $(document).trigger('ajaxError');
                    }
                    else {
                        $(document).trigger('success');
                        window.location = url + response.url;
                    }
                }
            });
        });
});