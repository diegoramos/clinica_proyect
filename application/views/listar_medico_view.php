<?php 
if (!isset($paciente)) {

}
 ?>
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
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<br>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <form>
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3">
                    <i class="fa fa-user-md mr-1"></i>
                    Gestionar medico
                  </h3>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3">
                    <i class="fa fa-users mr-1"></i>
                    Medicos
                  </h3>
                </div>
                <div class="card-body">
                  <table class="table table-striped" id="medico_table">
                    <thead>
                      <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Especialidad</th>
                        <th>Dni</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card -->
            </section>
          </div>
        </form>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal add or Edit -->
<div class="modal fade" id="modalSavePatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Registrar medico</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form">
          <input type="hidden" value="" name="medico_id" id="medico_id" /> 
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>DNI:</strong></label>
              <input type="text" class="form-control" id="txtdni" name="txtdni" placeholder="Ejem: 0000000">
              <span class="help-block"></span>
            </div>
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
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Nombres:</strong></label>
              <input type="text" class="form-control" id="txtnombre" name="txtnombre" placeholder="Nombres" >
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
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Sexo :</strong></label>
              <select id="txtsexo" name="txtsexo" id="txtsexo" class="form-control">
                <option value="" selected>Elejir...</option>
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity"><strong>Fecha Nacimiento:</strong></label>
              <input type="text" class="form-control" id="txtnaciemiento" name="txtnaciemiento" value="<?php echo date('d/m/Y'); ?>">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Especilaidad:</strong></label>
              <select id="txtespecialidad" name="txtespecialidad"  class="form-control">
                <option value="" selected>Elejir...</option>
                <option value="Medicina General">Medicina General</option>
                <option value="Neumologia">Neumologia</option>
                <option value="Otorrinologia">Otorrinologia</option>
                <option value="Traumatologia">Traumatologia</option>
                <option value="Oftalmologia">Oftalmologia</option>
                <option value="Gineco Obstetricia">Gineco Obstetricia</option>
                <option value="Medicina Fis. y Rahab.">Medicina Fis. y Rahabili.</option>
                <option value="Cardiologia">Cardiologia</option>
                <option value="Odontologia">Odontologia</option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Celular:</strong></label>
              <input type="text" class="form-control" id="txtcelular" name="txtcelular" placeholder="Num. Celular">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Horario:</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                </div>
                <input type="text" name="txthorario" class="form-control float-right" id="reservationtime">
              </div>
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputZip"><strong>Fecha cese:</strong></label>
              <div class="input-group date" id="date_end">
                <input type="text" id="txtfecha_cese" name="txtfecha_cese" class="form-control" value="<?php echo date('d/m/Y'); ?>">
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip"><strong>Medico:</strong></label>
              <input type="radio" id="txtmedico_tec" checked value="1" name="txtmedico_tec" >
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip"><strong>Tecnico:</strong></label>
              <input type="radio" id="txtmedico_tec2" value="2" name="txtmedico_tec" >
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
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Guardar</button>
      </div>
    </div>
  </div>
</div>