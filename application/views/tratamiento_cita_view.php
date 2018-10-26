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
                      <button type="button" class="btn btn-default fa fa-search" onclick="buscarConsulta3();">Buscar</button>
                    </div>
                    <div class="col-md-2">
                      <?php if ($cita_i) { ?>
                      <button type="button" class="btn btn-primary" onclick="OpenModalReceta('<?php echo $cita_i; ?>');">Nuevo receta</button>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <section class="col-lg-12 " id="cargarDatosRecetas">
              <!-- Custom tabs (Charts with tabs)-->
              

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
  <div class="modal fade" id="modalNuevaTratamiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Nueva Receta</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_receta">
          <input type="hidden" id="txtcita_id" name="txtcita_id">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Fecha:</strong></label><br>
              <input type="text" id="txtfecha" class="form-control" name="txtfecha" value="<?php echo date('d/m/Y'); ?>">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputCity" ><strong>Hora :</strong></label><br>
              <input type="text" readonly="" class="form-control" name="texthora" id="texthora" value="<?php echo date('H:m:s'); ?>">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Medicamento :</strong></label><br>
              <select name="txtmedicamento" id="txtmedicamento" class="form-control">
                <option value="">Elegir...</option>
                <option value="Amoxicilina 500g">Amoxicilina 500g</option>
              </select>
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-6">
              <label for="inputCity" ><strong>Precentación :</strong></label><br>
              <select name="txtpresentacion" id="txtpresentacion" class="form-control">
                <option value="">Elegir...</option>
                <option value="Tableta">Tableta</option>
              </select>
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputCity" ><strong>Cantidad:</strong></label><br>
              <input type="text" id="txtcantidad" class="form-control" name="txtcantidad" value="">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputCity" ><strong>Docis:</strong></label><br>
              <input type="text" id="txtdocis" class="form-control" name="txtdocis" value="">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-4">
              <label for="inputCity" ><strong>Tiempo:</strong></label><br>
              <input type="text" id="txttiempo" class="form-control" name="txttiempo" value="">
              <span class="help-block"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="inputCity" ><strong>Descripcion :</strong></label><br>
              <input class="form-control" id="txtdescripcion" name="txtdescripcion">
              <span class="help-block"></span>
            </div>
            <div class="form-group col-md-2"><br>
              <button type="button" class="btn btn-success" id="agregar_tratamiento">Agregar</button>
            </div>
            <div class="form-group col-md-2"><br>
              <button type="button" class="btn btn-default fa fa-print">Imprimir</button>
            </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Medicamento</th>
                      <th>Presentacion</th>
                      <th>Cantidad</th>
                      <th>Docis</th>
                      <th>Tiempo</th>
                      <th>Comida</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="receta_lab">
                  </tbody>
                </table>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="complete_cart">Guardar</button>
      </div>
    </div>
  </div>
</div>
</div>