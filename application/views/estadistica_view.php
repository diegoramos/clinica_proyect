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
                    <i class="fa fa-bar-chart mr-1"></i>
                    Estadistica
                  </h3>
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
                      <input type="text" class="form-control" name="" value="<?php //echo $paciente->dni; ?>">
                    </div>
                   <div class="col-md-2">
                      <label for="">Medico:</label>
                    </div>
                    <div class="col-md-4">
                      <select name="medico" id="medico" class="form-control">
                        <option value="" selected>Elegir...</option>
                        <option value=""></option>
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-md-2">
                      <label for="">Especialidad:</label>
                    </div>
                    <div class="col-md-4">
                      <select name="especialidad" id="especialidad" class="form-control">
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
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-default fa fa-search">Buscar</button>
                    </div>
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
