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
  $medico_id=$pacient->medico_id;

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
  $medico_id='';
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
                      <button type="button" class="btn btn-default fa fa-search" onclick="buscarConsulta2();">Buscar</button>
                    </div>
                    <div class="col-md-2">
                      <?php if ($cita_i) { ?>
                      <button type="button" class="btn btn-primary" onclick="OpenModalExamen('<?php echo $cita_i; ?>');">Nuevo examen</button>
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
                        <th>Codigo</th>
                        <th>Servicio</th>
                        <th>Examen</th>
                        <th>Fecha</th>
                        <th>Informe</th>
                        <th>Medico</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="cargarExamen">
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 ">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card" >
                <div class="card-header">
                  <h5>Imagenes</h5>
                </div>
                <div class="card-body ">
                  <div class="row" id="imagesss">

                  </div>
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
  <div class="modal fade" id="modalNuevaExamen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Nueva Consulta</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_examen">
          <input type="hidden" id="txtcita_id" name="txtcita_id">
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="inputCity" ><strong>Fecha:</strong></label><br>
              <input type="text" id="txtfecha" class="form-control" name="txtfecha" value="<?php echo date('d/m/Y'); ?>">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-7">
              <label for="inputCity" ><strong>Servicio :</strong></label><br>
              <select name="txtservicio" class="form-control">
                <option value="">Elegir...</option>
                <option value="Radiologia">Radiologia</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputCity" ><strong>Examen :</strong></label><br>
              <select name="txtexamen" class="form-control">
                <option value="">Elegir...</option>
                <option value="RX, Columna Lumbosacra(F y P)">RX, Columna Lumbosacra(F y P)</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputCity" ><strong>Medico Responsable :</strong></label><br>
              <select name="txtmedico" class="form-control">
                <option value="">Elegir...</option>
                <option value="<?php echo $medico_id; ?>"><?php echo $medico; ?></option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputCity" ><strong>Conclusion :</strong></label><br>
              <textarea class="form-control" id="txtconclusiones" name="txtconclusiones"></textarea>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputCity" id="label-photo"><strong>Subir:</strong></label><br>
                <input name="photo" type="file">
                <span class="help-block"></span>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="saveExamen()">Guardar</button>
      </div>
    </div>
  </div>
</div>
</div>