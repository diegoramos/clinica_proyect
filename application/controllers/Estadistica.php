<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadistica extends CI_Controller {

	public function index()
	{
		$this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
       	$this->load->view('estadistica_view', FALSE);
        $this->load->view('template/footer', FALSE);
	}

}

/* End of file Reporte.php */
/* Location: ./application/controllers/Reporte.php */
 ?>