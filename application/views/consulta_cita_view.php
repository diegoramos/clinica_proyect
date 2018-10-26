<?php if (isset($pacient)) {
  $cita_i=$pacient->cita_id;
  $paciente=$pacient->paciente;
  $dni=$pacient->dni;
  $edad=$pacient->edad." años";
  $fecha_nacimiento=$pacient->fecha_nacimiento;
  $grupo_rh=$pacient->grupo_sanguineo." ".$pacient->rh;
  $photo=$pacient->photo;
  $especialidad=$pacient->especialidad;
  $medico=$pacient->medico;
} else {
  $paciente='';
  $dni='';
  $edad='';
  $fecha_nacimiento='';
  $grupo_rh='';
  $photo='';
  $especialidad='';
  $medico='';
  $cita_i='';
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
        <form id="formcitas">
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <img width="150px;" height="100px" id="image" src="<?php echo base_url().'upload/'.$photo; ?>" alt="">
                    </div>
                    <div class="col-md-5">
                      <input type="hidden" name="cita_id" id="cita_id" value="<?php echo $cita_i; ?>">
                      <label for="" class="col-md-12 text-justify"><span id="paciente" style="font-size: 14px;"><?php echo $paciente; ?></span></label>
                      <label for="" class="col-md-12 text-justify"><span style="font-size: 15px;color:;">DNI:</span> <span id="dnie" style="font-size: 14px;"><?php echo $dni; ?></span></label>
                      <label for="" class="col-md-12 text-justify"><span style="font-size: 15px;color:;">Edad:</span> <span id="edad" style="font-size: 14px;"><?php echo $edad; ?></span></label>
                      <label for="" class="col-md-12 text-justify"><span style="font-size: 15px;color:;">Fecha Nacimiento:</span> <span id="nacimiento" style="font-size: 14px;"><?php echo $fecha_nacimiento; ?></span></label>
                      <label for="" class="col-md-12 text-justify"><span style="font-size: 15px;color:;">Grupo Sanguineo:</span> <span id="grupo_sanguineo" style="font-size: 14px;"><?php echo $grupo_rh; ?></span></label>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                      <div class="col-md-12">
                        <br><br><br>
                      </div>
                      <label for="" class="col-md-12 text-justify"><span style="font-size: 16px;color:;">Especialidad:</span> <span  id="especialidad" style="font-size: 16px;"><?php echo $especialidad; ?> </span></label>
                      <label for="" class="col-md-12 text-justify"><span style="font-size: 14px;color:;">Medico Dr(a):</span> <span  id="medico" style="font-size: 14px;"> <?php echo $medico; ?></span></label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 ">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-1">
                      
                    </div>
                    <div class="col-md-1">
                      DNI:
                    </div>
                    <div class="col-md-2">
                      <input type="text" size="8" maxlength="8" class="form-control" name="dni" id="dni">
                    </div>
                    <div class="col-md-6">
                      <button type="button" class="btn btn-default fa fa-search" onclick="buscarConsulta();">Buscar</button>
                    </div>
                    <div class="col-md-2">
                      <?php if ($cita_i) { ?>
                      <button type="button" class="btn btn-primary" onclick="OpenModalConsulta('<?php echo $cita_i; ?>');">Nueva consulta</button>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 ">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-body ">
                  <table class="table table-striped" id="">
                    <thead>
                      <tr>
                        <th>Fecha</th>
                        <th>Especialidad</th>
                        <th>Medico</th>
                        <th>Motivo Consulta</th>
                        <th>Sintomas</th>
                        <th>Examen</th>
                        <th>Diagnostico</th>
                        <th>Tratamiento</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="cargarConsulta">
                      
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
  <!-- Modal -->
  <div class="modal fade" id="modalNuevaConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Nueva Consulta</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_consulta">
          <input type="hidden" id="txtcita_id" name="txtcita_id">
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="inputCity" ><strong>Fecha:</strong></label><br>
              <input type="text" id="txtfecha" class="form-control" name="txtfecha" value="<?php echo date('d/m/Y'); ?>">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputCity" ><strong>Hora:</strong></label><br>
              <input type="text" readonly="" id="txthora" value="<?php echo date('H:m:s A'); ?>" class="form-control" name="txthora">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputCity" ><strong>Talla:</strong></label><br>
              <input type="number" id="txttalla" class="form-control" name="txttalla">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputCity" ><strong>Peso:</strong></label><br>
              <input type="number" id="txtpeso" class="form-control" name="txtpeso">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputZip" ><strong>Preción:</strong></label><br>
              <input type="number" id="txtprecion" class="form-control" name="txtprecion">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputZip" ><strong>Temperatura:</strong></label><br>
              <input type="number" id="txttemperatura" class="form-control" name="txttemperatura">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-10">
                <label for="inputCity" ><strong>Antecedentes:</strong></label><br>
                <input type="text" id="txtantecedentes" class="form-control" name="txtantecedentes">
                <span class="help-block"></span>
              </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Motivo de Consulta:</strong></label><br>
              <input type="text" id="txtmotivo" class="form-control" name="txtmotivo">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Sintomas:</strong></label><br>
              <input type="text" id="txtsintomas" class="form-control" name="txtsintomas">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Examenes:</strong></label><br>
              <select name="txtexamenes" class="form-control">
                <option value="">Elegir...</option>
                <option value="1">Opcion 1</option>
                <option value="2">Opcion 2</option>
                <option value="3">Opcion 3</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Diagnostico:</strong></label><br>
              <select name="txtdiagnostico" class="form-control">
                <option value="">Elegir..</option>
                <option value="1">Opcion 1</option>
                <option value="2">Opcion 1</option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Indicaciones:</strong></label><br>
              <input type="text" id="txtindicaciones" class="form-control" name="txtindicaciones">
              <span class="help-block"></span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="saveConsulta()">Guardar</button>
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