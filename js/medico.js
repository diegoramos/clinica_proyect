
var save_method; //for save method string
var table = $('#medico_table').DataTable({ 
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
            "url":baseurl+"medico/ajax_list/",
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
$(function(){
    $('.timepicker').datetimepicker({
            format: 'LT'
    });
    $('#date_end').datepicker({
        dateFormat: 'Y-m-d'
    });
    $('#txtnaciemiento').datepicker({
        dateFormat: 'Y-m-d'
    });
});

  $(function () {
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 1,
      format             : 'h:mm:ss A' //YYYY/MM/DD 
    })
  })

function add_medico()
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
function delete_medico(id)
{
    if(confirm('Estas seguro que quieres eliminar?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl+'medico/ajax_delete/'+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}
function edit_medico(id_medico)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#btnSave').text('Editar'); //change button text
    //Ajax Load data from ajax
    $.ajax({
        url : baseurl+'medico/ajax_edit/' + id_medico,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="medico_id"]').val(data.medico_id);
            $('[name="txtdni"]').val(data.dni);
            $('[name="txtappaterno"]').val(data.appaterno);
            $('[name="txtapmaterno"]').val(data.apmaterno);
            $('[name="txtnombre"]').val(data.nombres);
            //$('[name="txtnaciemiento"]').datepicker('update',data.naciemiento);
            $('[name="txtestado_civil"]').val(data.estado_civil);
            $('[name="txtsexo"]').val(data.sexo);
            $('[name="txtnaciemiento"]').val(data.fecha_nacimiento);
            $('[name="txtespecialidad"]').val(data.especialidad);
            $('[name="txtcelular"]').val(data.celular);
            $('[name="txthorario"]').val(data.horario);
            $('[name="txtfecha_cese"]').val(data.fecha_cese);
            if (data.medico_tec==1) {
                $('[id="txtmedico_tec"]').attr('checked', 'checked');
                $('[id="txtmedico_tec2"]').removeAttr('checked');
            }else if(data.medico_tec==2){
                $('[id="txtmedico_tec2"]').attr('checked', 'checked');
                $('[id="txtmedico_tec"]').removeAttr('checked');
            }
            $('[name="txtcorreo"]').val(data.correo);
            $('#modalSavePatient').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Medico'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error obteniendo datos');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
function save()
{
    $('#btnSave').text('guardando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
    if (save_method=='add') {
        url = baseurl+"medico/medico_ajax_add";
    }else{
        url = baseurl+"medico/medico_ajax_update";
    }
    
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
                reload_table();
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