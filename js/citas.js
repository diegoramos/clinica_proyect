var table = $('#cita_table').DataTable({ 
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
            "url":baseurl+"citas/ajax_list/",
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
var table2 = $('#cita_table2').DataTable({ 
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
            "url":baseurl+"citas/ajax_list2/",
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
var table3 = $('#cita_table_agenda').DataTable({ 
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
            "url":baseurl+"citas/ajax_list3/",
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
$("#dni").keyup(function(event) {
  $("#dni").css('border-color', '');
});
/*
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })*/
$("#especialidad").change(function(event) {
  var especialidad=$(this).val();
  $.ajax({
          url : baseurl+'citas/buscarEspecialidadMedico',
          type: "POST",
          data:{especialidad:especialidad},
          dataType: "JSON",
          success: function(data)
          {
            var select='<option value="" >Elejir..</option>';
            $.each(data, function(index, val) {
               select +='<option value="'+val.medico_id+'">'+val.nombres+'</option>';
            });
            $("#medico").html(select);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error deleting data');
          }
      });
});
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table2()
{
    table2.ajax.reload(null,false); //reload datatable ajax 
}
function reload_table3()
{
    table3.ajax.reload(null,false); //reload datatable ajax 
}
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
function openModalEstado(estado)
{
    if (estado=='0') {
        $("#txtestado3").attr('checked', 'checked');
        //$('#txtestado3').iCheck('update')[0].checked;
    }else if (estado=='1') {
        $("#txtestado4").attr('checked', 'checked');
        //$('#txtestado4').iCheck('update')[0].checked;
    }else if (estado=='2') {
        $("#txtestado2").attr('checked', 'checked');
        //$('#txtestado2').iCheck('update')[0].checked;
    }else{
       $("#txtestado1").attr('checked', 'checked');
       // $('#txtestado1').iCheck('update')[0].checked;
    }
    //save_method3 = 'add';
    //$('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modalUpdateEstado').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Nuevo Paciente'); // Set Title to Bootstrap modal title
}
function openModalCita(citas_id) {
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $.ajax({
        url : baseurl+'citas/ajax_edit/' + citas_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="cita_id"]').val(data.cita_id);
            $('[name="paciente_idc"]').val(data.paciente_id)
            $('[name="dnie"]').val(data.dni);
            $('[name="nombree"]').val(data.paciente);
            $('[name="especialidad"]').val(data.especialidad);
            //$('[name="medico2"]').val(data.medico_id);
            $("#medico2").html('<option value="'+data.medico_id+'">'+data.medico+'</option>');
            $('[name="medico2"]').val(data.medico_id);
            $('[name="horario"]').val(data.horario);
            $('[name="fechae"]').val(data.fecha);
 
            $('#modalSaveCitas').modal('show'); // show bootstrap modal
            $('.modal-title').text('Editar citas'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
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
function update()
{
    $('#btnSaveRepro').text('guardando...'); //change button text
    $('#btnSaveRepro').attr('disabled',true); //set button disable 
    var url= baseurl+"citas/cita_ajax_update";
    var formData =new FormData($('#formcitas')[0]);
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
                $('#modalSaveCitas').modal('hide');

            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSaveRepro').text('Reprogramar'); //change button text
            $('#btnSaveRepro').attr('disabled',false); //set button enable 
            
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error guardando / actualizando dato');
            $('#btnSaveRepro').text('Reprogramar'); //change button text
            $('#btnSaveRepro').attr('disabled',false); //set button enable 
 
        }
    });
}
function saveCita()
{
    $('#btnSave2').text('guardando...'); //change button text
    $('#btnSave2').attr('disabled',true); //set button disable 
    var url= baseurl+"citas/save";
    var formData =new FormData($('#formcitas')[0]);
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
              $("#dni").val('');
              $("#paciente_id").val('');
              $("#nombre").val('');
              //$("#horario").val('');
                //$('#modalSavePatient').modal('hide');
                //window.location = baseurl+data.url;
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 
            
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error guardando / actualizando dato');
            $('#btnSave2').text('Guardar'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 
 
        }
    });
}
function buscarpaciente(){
    if ($("#dni").val()!='') {
      $.ajax({
          url : baseurl+'citas/buscarPaciente',
          type: "POST",
          data:{dni:$("#dni").val()},
          dataType: "JSON",
          success: function(data)
          {
            if (data!=null) {
              $("#paciente_id").val(data.paciente_id);
              $("#nombre").val(data.nombres);
            }else{
              alert("No se encontro registro crear nuevo registro");
            }
              
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error deleting data');
          }
      });
    }else{
        $("#dni").css('border-color', 'red');
    }
}

function delete_cita(cita_id)
{
    if(confirm('Estas seguro que quieres eliminar?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl+'citas/ajax_delete/'+ cita_id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                reload_table2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al eliminar');
            }
        });
    }
}
function confirmarCita(cita_id){
  if(confirm('Estas seguro que desea confirmar?'))
    {
        // ajax delete data to database
        $.ajax({
            url : baseurl+'citas/ajax_estado/'+ cita_id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                reload_table2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al cambiar estado');
            }
        });
    }
}
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
function buscarConsulta(){
    if ($("#dni").val()!='') {
        $.ajax({
            url : baseurl+'citas/buscarPorDni/'+ $("#dni").val(),
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if (data!=null) {
                    window.location = baseurl+"citas/consulta/"+data.cita_id;
                    /*$("#paciente").html(data.paciente);
                    $("#dnie").html(data.dni);
                    $("#edad").html(data.edad);
                    $("#nacimiento").html(data.fecha_nacimiento);
                    $("#grupo_sanguineo").html(data.grupo_sanguineo+" "+data.rh);
                    $("#especialidad").html(data.especialidad);
                    $("#medico").html(data.medico);
                    $("#image").attr('src', baseurl+'upload/'+data.photo);*/
                }else{
                    alert("No se encontro registro");
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al cambiar estado');
            }
        });
    }else{
        alert("Ingresar numero dni");
    }
}
function buscarConsulta2(){
    if ($("#dni").val()!='') {
        $.ajax({
            url : baseurl+'citas/buscarPorDni/'+ $("#dni").val(),
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if (data!=null) {
                    window.location = baseurl+"citas/examen/"+data.cita_id;
                    /*$("#paciente").html(data.paciente);
                    $("#dnie").html(data.dni);
                    $("#edad").html(data.edad);
                    $("#nacimiento").html(data.fecha_nacimiento);
                    $("#grupo_sanguineo").html(data.grupo_sanguineo+" "+data.rh);
                    $("#especialidad").html(data.especialidad);
                    $("#medico").html(data.medico);
                    $("#image").attr('src', baseurl+'upload/'+data.photo);*/
                }else{
                    alert("No se encontro registro");
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al cambiar estado');
            }
        });
    }else{
        alert("Ingresar numero dni");
    }
}
function buscarConsulta3(){
    if ($("#dni").val()!='') {
        $.ajax({
            url : baseurl+'citas/buscarPorDni/'+ $("#dni").val(),
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if (data!=null) {
                    window.location = baseurl+"citas/tratamiento/"+data.cita_id;
                    /*$("#paciente").html(data.paciente);
                    $("#dnie").html(data.dni);
                    $("#edad").html(data.edad);
                    $("#nacimiento").html(data.fecha_nacimiento);
                    $("#grupo_sanguineo").html(data.grupo_sanguineo+" "+data.rh);
                    $("#especialidad").html(data.especialidad);
                    $("#medico").html(data.medico);
                    $("#image").attr('src', baseurl+'upload/'+data.photo);*/
                }else{
                    alert("No se encontro registro");
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al cambiar estado');
            }
        });
    }else{
        alert("Ingresar numero dni");
    }
}
function hitoriaClinica(citas_id){
    window.location = baseurl+"citas/consulta/"+citas_id;
}
function OpenModalConsulta(cita_id){
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#txtcita_id').val(cita_id);
    $('#modalNuevaConsulta').modal('show'); // show bootstrap modal
}
function OpenModalTratamiento(cita_id){
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#txtcita_id').val(cita_id);
    $('#modalNuevaTratamiento').modal('show'); // show bootstrap modal
}
function OpenModalReceta(cita_id){
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#txtcita_id').val(cita_id);
    $('#form_receta')[0].reset();
    $('#modalNuevaTratamiento').modal('show'); // show bootstrap modal
}
cargarTablaConsulta();
cargarTablaExamen();
cargarTablaRecetario();
function cargarTablaConsulta(){
    var cita_id=$("#cita_id").val();
    if (cita_id!='') {
        $.ajax({
        url : baseurl+'citas/cargarConsulta',
        type: "POST",
        data: {cita_id:cita_id},
        dataType: "JSON",
        success: function(data)
        { 
            var html="";
            $.each(data, function(index, val) {
                 html +='<tr><td>'+val.fecha+'</td><td>'+val.especialidad+'</td><td>'+val.medico+'</td><td>'+val.motivo+'</td><td>'+val.sintomas+'</td><td>'+val.examenes+'</td><td>'+val.diagnostico+'</td><td>'+val.indicaciones+'</td><td><button type="button" class="btn btn-primary fa fa-print"></button></td></tr>';
            });
            $("#cargarConsulta").html(html);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log("Eroor");
        }
    });
    }  
}
function cargarTablaExamen(){
    var cita_id=$("#cita_id").val();
    if (cita_id!='') {
        $.ajax({
        url : baseurl+'citas/cargarExamen',
        type: "POST",
        data: {cita_id:cita_id},
        dataType: "JSON",
        success: function(data)
        { 
            var html="";
            var ima="";
            $.each(data, function(index, val) {
                 html +='<tr><td>'+val.examen_id+'</td><td>'+val.servicio+'</td><td>'+val.examen+'</td><td>'+val.fecha+'</td><td>'+val.conclucion+'</td><td>'+val.medico+'</td><td><button type="button" class="btn btn-primary fa fa-print"></button></td></tr>';
                ima +='<div class="col-md-3"><img width="250px" height="250px;" src="'+baseurl+'upload/'+val.photo+'" alt=""></div>';
            });
            $("#imagesss").html(ima);  
            $("#cargarExamen").html(html);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log("Eroor");
        }
    });
    }  
}
function saveConsulta(){
    $('#btnSave2').text('guardando...'); //change button text
    $('#btnSave2').attr('disabled',true); //set button disable 
    var url= baseurl+"citas/saveConsulta";
    var formData =new FormData($('#form_consulta')[0]);
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
                cargarTablaConsulta();
               $('#modalNuevaConsulta').modal('hiden'); // show bootstrap modal
              //$("#horario").val('');
                //$('#modalSavePatient').modal('hide');
                //window.location = baseurl+data.url;
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 
            
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error guardando / actualizando dato');
            $('#btnSave2').text('Guardar'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 
 
        }
    });
}
function saveExamen(){
    $('#btnSave').text('guardando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url= baseurl+"citas/saveExamen";
    var formData =new FormData($('#form_examen')[0]);
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
                cargarTablaExamen();
               $('#modalNuevaExamen').modal('hide'); // show bootstrap modal
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

//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
$("#agregar_tratamiento").on("click",function(e){
    e.preventDefault();
    var cita_id = $("#txtcita_id").val();
    var fecha = $("#txtfecha").val();
    var hora = $("#texthora").val();
    var medicamento=$("#txtmedicamento").val();
    var presentacion=$("#txtpresentacion").val();
    var cantidad=$("#txtcantidad").val();
    var docis=$("#txtdocis").val();
    var tiempo=$("#txttiempo").val();
    var descripcion=$("#txtdescripcion").val();

    if(cita_id!= '' && fecha!= '' && hora!= '' && medicamento!= '' && presentacion!= '' && cantidad!= '' && docis!= '' && tiempo!= '' && descripcion!= ''){
        $.ajax({
            url: baseurl + 'citas/add_receta',
            data: {
                'cita_id' : cita_id,
                'fecha' : fecha,
                'hora' : hora,
                'medicamento' :medicamento,
                'presentacion' : presentacion,
                'cantidad' : cantidad,
                'docis' : docis,
                'tiempo' :tiempo,
                'descripcion' : descripcion
            },
            type: 'POST',
            beforeSend : function(){
               // $el.faLoading();
            },
            success: function(data){
                var res = $.parseJSON(data);
                //$('#modalNuevaTratamiento').modal('hide');
                //exit();
                $(".cart-value").remove();
                var i=1;
                var display;
                $.each(res.data, function(key,value) {
                    var row_2 = "";
                    //'+ value.detalle +'
                    display += '<tr class="cart-value" id="'+ key +'">' +
                                '<td>'+ i +'</td>' +
                                '<td>'+ value.medicamento +'</td>' +
                                '<td>'+ value.presentacion +'</td>' +
                                '<td>'+ value.cantidad +'</td>' +
                                '<td>'+ value.docis +'</td>' +
                                '<td>'+ value.tiempo +'</td>' +
                                '<td>'+ value.descripcion +'</td>' +
                                '<td><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="'+ key +'">x</span></td>' +
                                '</tr>';
                    i++;
                });
                $("#receta_lab").html(display);
            },
            error: function(){
                alert('Something Error');
            }
        });
    }else{
        alert("Selecione todos los campos");
    } 
});

cargar()

function cargar(){
    $.post(baseurl+'citas/loads', function(data, textStatus, xhr) {
        var res = $.parseJSON(data);
        $(".cart-value").remove();
                var i=1;
                var display;
                $.each(res.data, function(key,value) {
                    var row_2 = "";
                    //'+ value.detalle +'
                    display += '<tr class="cart-value" id="'+ key +'">' +
                            '<td>'+ i +'</td>' +
                            '<td>'+ value.medicamento +'</td>' +
                            '<td>'+ value.presentacion +'</td>' +
                            '<td>'+ value.cantidad +'</td>' +
                            '<td>'+ value.docis +'</td>' +
                            '<td>'+ value.tiempo +'</td>' +
                            '<td>'+ value.descripcion +'</td>' +
                            '<td><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="'+ key +'">x</span></td>' +
                            '</tr>';
                            i++;
                });
        $("#receta_lab").html(display);
    });
}
$(document).on("click",".transaksi-delete-item",function(e){
        var rowid = $(this).attr("data-cart");
        ///$el.faLoading();

        $.get(baseurl + 'citas/delete_receta/'+rowid,
            function(data,status){
                if(status == 'success'  && data != 'false'){
                    $("#"+rowid).remove();
                   // $el.faLoading(false);
                }                
            }
        );
    });
///// GUARDAR PRESUPUESTO
$(document).on('click', '#complete_cart', function(){
    $.ajax({
      url:baseurl+"citas/add_process",
      method:"POST",
      data:{},
    success:function(data)
    {
        var res = $.parseJSON(data);
        if (res.status) {
            alert(res.mensaje);
            $("#modalNuevaTratamiento").modal('hide');
            cargarTablaRecetario();
            cargar();
        }else{
            alert(res.mensaje);
        }
        
    }
    });
});
$(function(){
	$('.timepicker').datetimepicker({
	        format: 'LT'
	});
	$('#date_end').datepicker({
        dateFormat: 'Y-m-d'
    });
    $("#txtfecha").datepicker({
        dateFormat: 'Y-m-d'
    });
});

  $(function () {
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'h:mm A' //MM/DD/YYYY 
    })

  })
function cargarTablaRecetario(){
    var cita_id=$("#cita_id").val();
    if (cita_id!='') {
        $.ajax({
        url : baseurl+'citas/cargarRecetas',
        type: "POST",
        data: {cita_id:cita_id},
        dataType: "JSON",
        success: function(data)
        { 
            var row='';
            $.each(data, function(index, val) {
                
                var table='<div class="card" >'+
                            '<div class="card-header">'+
                              '<h5>'+val.cita[0].fecha+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Especialidad: '+val.cita[0].especialidad+'</h5>'+
                            '</div>'+
                            '<div class="card-body ">'+
                              '<table class="table table-striped" id="">'+
                                '<thead>'+
                                  '<tr>'+
                                    '<th>Id</th>'+
                                    '<th>Medicamento</th>'+
                                    '<th>Presentacion</th>'+
                                    '<th>Cantidad</th>'+
                                    '<th>Docis</th>'+
                                    '<th>Tiempo</th>'+
                                    '<th>Descripcion</th>'+
                                  '</tr>'+
                                '</thead>'+
                                '<tbody>';
                $.each(val.receta, function(index, value) {
                    table +='<tr>'+
                                '<td>'+value.resetados_id+'</td>'+
                                '<td>'+value.medicamento+'</td>'+
                                '<td>'+value.presentacion+'</td>'+
                                '<td>'+value.cantidad+'</td>'+
                                '<td>'+value.docis+'</td>'+
                                '<td>'+value.tiempo+'</td>'+
                                '<td>'+value.descripcion+'</td>'+
                              '</tr>';
                });
                table +='</tbody>'+
                      '</table>'+
                    '</div>'+
                '</div>';
                row +=table;
            }); 
            $("#cargarDatosRecetas").html(row)
            /*
            var html="";
            var ima="";
            $.each(data, function(index, val) {
                 html +='<tr><td>'+val.examen_id+'</td><td>'+val.servicio+'</td><td>'+val.examen+'</td><td>'+val.fecha+'</td><td>'+val.conclucion+'</td><td>'+val.medico+'</td><td><button type="button" class="btn btn-primary fa fa-print"></button></td></tr>';
                ima +='<div class="col-md-3"><img width="250px" height="250px;" src="'+baseurl+'upload/'+val.photo+'" alt=""></div>';
            });
            $("#imagesss").html(ima);  
            $("#cargarExamen").html(html);*/
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log("Eroor");
        }
    });
    }  

}
/*
<div class="card" >
    <div class="card-header">
      <h5></h5>
    </div>
    <div class="card-body ">
      <table class="table table-striped" id="">
        <thead>
          <tr>
            <th>Id</th>
            <th>Medicamento</th>
            <th>Presentacion</th>
            <th>Cantidad</th>
            <th>Docis</th>
            <th>Tiempo</th>
            <th>Descripcion</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div>
</div>
*/