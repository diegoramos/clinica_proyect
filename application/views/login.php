<!DOCTYPE html>
<html lang="es">
<head>
<base href="./">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
<meta name="author" content="Łukasz Holeczek">
<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
<title>Clinica Iniciar Sessión</title>

<link href="<?php echo base_url(); ?>assets/dist/css/coreui-icons.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/dist/css/flag-icon.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/dist/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/dist/css/simple-line-icons.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/dist/css/pace.min.css" rel="stylesheet">
<style type="text/css" media="screen">
  .has-error .help-block{
    color: #a94442;
  }
  .has-error input{
    border-color: #a94442;
  }
  .has-error textarea{
    border-color: #a94442;
  }
  .has-error select {
    border-color: #a94442;
  }
</style>
<script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o), m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-118965717-1', 'auto');
    ga('send', 'pageview');
  </script>
</head>
<body class="app flex-row align-items-center">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
        <form  id="login" method="post">
          <div class="card-body">
            <h1>Login</h1>
            <p class="text-muted">Iniciar sesión en su cuenta</p>
            <p id="loader" style="display: none"><button id='flash' class='btn btn-danger btn-block'><i class='fa fa-thumbs-up'></i>Error al Iniciar session</button></p>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="icon-user"></i>
                </span>
              </div>
              <input class="form-control" type="email" name="correo" placeholder="Email">
            </div>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text">
                <i class="icon-lock"></i>
                </span>
              </div>
              <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="row">
              <div class="col-6">
              <button class="btn btn-primary px-4" type="submit">Iniciar sesión</button>
              </div>
              <div class="col-6 text-right">
              <button class="btn btn-link px-0" type="button">¿Olvidaste tu cuenta?</button>
              </div>
            </div>
          </div>
        </form>
        </div>
        <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
        <div class="card-body text-center">
        <div>
        <h2>Regístrate</h2>
        <p>En caso de no tener una cuenta resgistrese para reservar una nueva cita</p>
        <button class="btn btn-primary active mt-3" type="button" onclick="add_paciente()">¡Regístrate ahora!</button>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSavePatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Registrar paciente</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity"><strong>DNI:</strong></label>
              <input type="text" class="form-control" id="txtdni" maxlength="8" size="8" name="txtdni" placeholder="Ejem: 0000000">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Ap. Paterno:</strong></label>
              <input type="text" class="form-control" id="txtappaterno" name="txtappaterno" placeholder="Apellido Paterno">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Ap. Materno:</strong></label>
              <input type="text" class="form-control" id="txtapmaterno" name="txtapmaterno" placeholder="Apellido Materno">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Nombres:</strong></label>
              <input type="text" class="form-control" id="txtnombre" name="txtnombre" placeholder="Nombres" >
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Fecha Nacimiento:</strong></label>
              <input type="text" class="form-control" id="txtnaciemiento" name="txtnaciemiento" value="<?php echo date('Y-m-d'); ?>">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Sexo :</strong></label>
              <select id="txtsexo" name="txtsexo" id="txtsexo" class="form-control">
                <option value="" selected>Elejir...</option>
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Estado Civil:</strong></label>
              <select id="txtestado_civil" name="txtestado_civil"  class="form-control">
                <option value="" selected>Elejir...</option>
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Ocupación:</strong></label>
              <input type="text" class="form-control" id="txtocupacion" name="txtocupacion" placeholder="Ocupacion">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Nacionalidad:</strong></label>
              <input type="text" class="form-control" id="txtnacionalidad" name="txtnacionalidad" placeholder="Ejem: Peruano(a)">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Celular:</strong></label>
              <input type="text" class="form-control" id="txtcelular" name="txtcelular" placeholder="Num. Celular">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4"><strong>Direción</strong></label>
              <input type="text" class="form-control" id="txtdireccion" name="txtdireccion" placeholder="Direccion">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputState"><strong>Grupo Sanguineo: </strong></label>
              <select id="txtgrupo_sanguineo" name="txtgrupo_sanguineo" class="form-control">
                <option value="" selected>Elejir...</option>
                <option value="A">A</option>
                <option value="O">O</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip"><strong>RH: </strong></label>
              <select id="txtrh" name="txtrh" class="form-control">
                <option value="" selected>Elejir...</option>
                <option value="+">+</option>
                <option value="-">-</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity"><strong>Correo: </strong></label>
              <input type="email" class="form-control" id="txtcorreo" name="txtcorreo" placeholder="Correo">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4"><strong>Password:</strong></label>
              <input type="password" class="form-control" id="txtpassword" name="txtpassword" placeholder="Password">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group" id="photo-preview">
              <label class=" col-md-3">Photo</label>
              <div class="col-md-9">
                  (No photo)
                  <span class="help-block"></span>
              </div>
          </div>
          <div class="form-group">
              <label class=" col-md-3" id="label-photo">Subir Photo </label>
              <div class="col-md-9">
                  <input name="photo" type="file">
                  <span class="help-block"></span>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/pace.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/coreui.min.js"></script>
<script>
    $('#ui-view').ajaxLoad();
    $(document).ajaxComplete(function() {
      Pace.restart()
    });
</script>
<script>
  var baseurl = "<?php echo base_url(); ?>";
</script>

<?php if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='login') { ?>
  <script src="<?php echo base_url(); ?>js/paciente.js"></script>
<?php } ?>
</body>
</html>