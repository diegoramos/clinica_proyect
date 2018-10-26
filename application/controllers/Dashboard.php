<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		if ($this->session->userdata('permiso')==1) {
            redirect(base_url().'citas/registrar');
        }
	}

	// List all your items
	public function index( $offset = 0 )
	{
		$this->load->view('template/header', FALSE);
		$this->load->view('template/menu', FALSE);
		$this->load->view('dashboard', FALSE);
		$this->load->view('template/footer', FALSE);
	}

	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
