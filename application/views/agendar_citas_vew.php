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
            <section class="col-lg-12 ">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header d-flex p-0">
                  <h3 class="card-title p-3">
                    <i class="fa fa-calendar mr-1"></i>
                    Agendar Cita
                  </h3>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 ">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-header bg-primary d-flex p-0">
                  <h3 class="card-title p-3">
                    <i class="fa fa-calendar mr-1"></i>
                    Citas
                  </h3>
                </div>
                <div class="card-body ">
                  <table class="table table-striped" id="cita_table_agenda">
                    <thead>
                      <tr>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Edad</th>
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
        </form>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Modal -->
  <div class="modal fade" id="modalUpdateEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Cambiar Estado</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_estado">
          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputCity" ><strong>Atendio:</strong></label><br>
              <input type="radio" id="txtestado1" class="flat-red" name="txtestado">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputCity" ><strong>No asistio:</strong></label><br>
              <input type="radio" id="txtestado2" class="flat-red" name="txtestado">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputZip" ><strong>Sin confirmar:</strong></label><br>
              <input type="radio" id="txtestado3" class="flat-red" name="txtestado">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-3">
              <label for="inputZip" ><strong>En espera:</strong></label><br>
              <input type="radio" id="txtestado4" class="flat-red" name="txtestado">
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