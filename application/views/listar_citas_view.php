<?php 
if (!isset($paciente)) {
  $dni=$paciente->dni;
  $paciente_id=$paciente->paciente_id;
  $nombres=$paciente->nombres;
}else{
  $dni='';
  $paciente_id='';
  $nombres='';
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
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-10 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3">
                    <i class="fa fa-calendar mr-1"></i>
                    Registrar Cita
                  </h3>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-2 connectedSortable" align="center">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header p-0" >
                  <ul class=" ml-auto p-2">
                    <div class="image"  >
                      <img width="100px" height="80px" src="<?php echo base_url()."upload/".$this->session->userdata('foto'); ?>" class="" alt="User Image">
                    </div>
                  </ul>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-body ">
                  <div class="row form-group">
                    <div class="col-md-2">
                      <label for="">DNI:</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" class="form-control" name="dni" id="dni" maxlength="8" size="8" value="<?php echo $dni; ?>">
                      <span class="help-block"></span>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-default fa fa-search" onclick="buscarpaciente();">Buscar</button>
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-success" onclick="add_paciente()">Nuevo Paciente</button>
                    </div>
                    

                  </div>
                  <div class="row form-group">
                    <div class="col-md-2">
                      <input type="hidden" name="paciente_id" id="paciente_id" value="<?php echo $paciente_id; ?>">
                      <label for="">Paciente:</label>
                    </div>
                    <div class="col-md-4">
                      <input type="text" class="form-control" disabled="" id="nombre" name="nombre" value="<?php echo $nombres; ?>">
                      <span class="help-block"></span>
                    </div>
                    <div class="col-md-2">
                      <label for="">Especialidad:</label>
                    </div>
                    <div class="col-md-4">
                      <select name="especialidad" id="especialidad" class="form-control">
                        <option value="Medicina General" selected>Medicina General</option>
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
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2">
                      <label for="">Fecha:</label>
                    </div>
                    <div class="col-md-4">
                      <div class="input-group date" id="date_end">
                        <input type="text" id="fecha" name="fecha" class="form-control" value="<?php echo date('d/m/Y'); ?>">
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="">Medico:</label>
                    </div>
                    <div class="col-md-4">
                      <select name="medico" id="medico" class="form-control">
                        <option value="" selected>Elegir...</option>
                        <?php if(isset($medicos)){ foreach ($medicos as $key => $value) { ?>
                          <option value="<?php echo $value->medico_id; ?>"><?php echo $value->nombres; ?></option>
                        <?php }} ?>
                      </select>
                      <span class="help-block"></span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-body ">
                  <!-- <button type="button" class="btn btn-primary pull-right" onclick="openModalCita()">Registrar Cita</button> -->
                  <a href="<?php echo base_url(); ?>citas/registrar" class="btn btn-primary pull-right">Registrar Cita</a>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3">
                    <i class="fa fa-calendar mr-1"></i>
                    Citas
                  </h3>
                </div>
                <div class="card-body ">
                  <table class="table table-striped" id="cita_table2">
                    <thead>
                      <tr>
                        <th>Hora</th>
                        <th style="width: 200px;">Paciente</th>
                        <th>Especialidad</th>
                        <th>Medico</th>
                        <th>Estado</th>
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
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal -->
  <div class="modal fade" id="modalSaveCitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Reprogramar cita</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formcitas">
          <input type="hidden" name="cita_id" id="cita_id">
          <input type="hidden" class="form-control" id="paciente_idc" name="paciente_idc" >
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity"><strong>DNI:</strong></label>
              <input type="text" class="form-control" id="dnie" maxlength="8" size="8" name="dnie" placeholder="Ejem: 0000000">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputZip"><strong>Paciente:</strong></label>
              <input type="text" class="form-control" id="nombree" name="nombree" placeholder="Nombres" >
              <span class="help-block"></span>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity"><strong>Especialidad:</strong></label>
                 <select name="especialidad" id="especialidad" class="form-control">
                    <option value="Medicina General" selected>Medicina General</option>
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
          
            <div class="form-group col-md-6">
              <label for="">Medico:</label>
              <select name="medico2" id="medico2" class="form-control">
                <option value="" selected>Elegir...</option>
                <?php if(isset($medicos)){ foreach ($medicos as $key => $value) { ?>
                  <option value="<?php echo $value->medico_id; ?>"><?php echo $value->nombres; ?></option>
                <?php }} ?>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-6">
             <label for="inputZip"><strong>Seleccionar Horario:</strong></label>
              <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <input type="text" name="horario" class="form-control float-right" id="reservationtime">
                  <span class="help-block"></span>
              </div>
          </div>
          <div class="form-group col-md-6">
              <label for="inputZip"><strong>Fecha:</strong></label>
                      <div class="input-group date" id="date_end">
                        <input type="text" id="fechae" name="fechae" class="form-control" value="<?php echo date('d/m/Y'); ?>">
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSaveRepro" onclick="update()">Reprogramar</button>
      </div>
    </div>
  </div>
</div>
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