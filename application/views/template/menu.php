  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <!---<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light"><strong>San Juan</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if($this->session->userdata('foto')!=''){ ?>
          <img src="<?php  echo base_url()."upload/".$this->session->userdata('foto'); ?>" class="img-circle elevation-2"  alt="User Image">
        <?php } ?>
        </div>
        <div class="info">
          <a href="#" class="d-block" style="color: white;"><?php echo $this->session->userdata('nombre')." ".$this->session->userdata('apellido'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if ($this->session->userdata('permiso')==4) { ?>
          <li class="nav-item has-treeview">
            <a href="<?php echo base_url(); ?>dashboard" class="nav-link <?php if($this->uri->segment(1)=='dashboard') echo 'active'; ?>">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==1||$this->session->userdata('permiso')==2) { ?>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>citas/registrar" class="nav-link <?php if($this->uri->segment(1)=='citas' && $this->uri->segment(2)=='registrar') echo 'active'; ?>">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Registrar Citas
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==2) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>citas" class="nav-link <?php if($this->uri->segment(2)==''&& $this->uri->segment(1)=='citas') echo 'active'; ?>">
              <i class="nav-icon fa fa-camera"></i>
              <p>
                Citas
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==2) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>paciente" class="nav-link <?php if($this->uri->segment(1)=='paciente') echo 'active'; ?>">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Pacientes
              </p>
            </a>
          </li>
        <?php } ?>
         <!-- //////////////////////////AQUI EMPIEZA PERMISO DE MEDICO///////////////////////////--> 
         <?php if ($this->session->userdata('permiso')==3) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>citas/agendar" class="nav-link <?php if($this->uri->segment(1)=='citas' && $this->uri->segment(2)=='agendar') echo 'active'; ?>">
              <i class="nav-icon fa fa-eyedropper"></i>
              <p>
                Citas
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==3) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>citas/consulta" class="nav-link <?php if($this->uri->segment(1)=='citas' && $this->uri->segment(2)=='consulta') echo 'active'; ?>">
              <i class="nav-icon fa fa-calendar-check-o"></i>
              <p>
                Consulta
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==3) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>citas/examen" class="nav-link <?php if($this->uri->segment(2)=='examen') echo 'active'; ?>">
              <i class="nav-icon fa fa-sticky-note-o"></i>
              <p>
                Examen
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==3) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>citas/tratamiento" class="nav-link <?php if($this->uri->segment(2)=='tratamiento') echo 'active'; ?>">
              <i class="nav-icon fa fa-address-book-o"></i>
              <p>
                Tratamiento
              </p>
            </a>
          </li>
        <?php } ?>
        <!-- ///////////////////////////////// -->
        <?php if ($this->session->userdata('permiso')==4) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>medico/registrar" class="nav-link <?php if($this->uri->segment(1)=='medico' && $this->uri->segment(2)=='registrar') echo 'active'; ?>">
              <i class="nav-icon fa fa-user-md"></i>
              <p>
                Personal Medico
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==4) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>medico" class="nav-link <?php if($this->uri->segment(2)=='' && $this->uri->segment(1)=='medico') echo 'active'; ?>">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Listar Medicos
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('permiso')==4) { ?>
           <li class="nav-item">
            <a href="<?php echo base_url(); ?>estadistica" class="nav-link <?php if($this->uri->segment(1)=='estadistica') echo 'active'; ?>">
              <i class="nav-icon fa fa-pie-chart"></i>
              <p>
                Estadistica
              </p>
            </a>
          </li>
        <?php } ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>