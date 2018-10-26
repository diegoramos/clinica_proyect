<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        /*if($this->session->userdata('user_id')>0)
        {
            redirect('dashboard', 'refresh');
        }*/
        $this->load->model('Paciente_model');

	}
	public function index()
	{
		$this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('paciente_view', FALSE);
        $this->load->view('template/footer', FALSE);
	}
	 public function ajax_list()
    {
        $list = $this->Paciente_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $paciente) {
            $no++;
            $row = array();
            if ($paciente->photo) { $ima='<a  href="'.base_url('upload/'.$paciente->photo).'" target="_blank"><img alt="image" class="" width="100" height="100" src="'.base_url('upload/'.$paciente->photo).'"  /></a>'; } else { $ima='(No photo)'; }

            $row[] = '<div class="row"><div class="col-md-6">'.$ima.'</div><div class="col-md-6"><h6 style="font-weight: bold;">'.$paciente->nombres.'</h6><h6 style="font-size:12px;">DNI: '.$paciente->dni.'</h6></div></div>';

            $row[] = '<span><p style="font-size:12px;">Celular: '.$paciente->celular.'</p></span><span><p style="font-size:12px;">Email: '.$paciente->correo.'</p></span>'; 
            $row[] = $paciente->edad." años";
            $row[] = $paciente->estado_civil;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Hapus" onclick="openModalpaciente('.$paciente->paciente_id.')"><i class="glyphicon glyphicon-trash"></i>Historia</a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Paciente_model->count_all(),
                        "recordsFiltered" => $this->Paciente_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}

/* End of file Paciente.php */
/* Location: ./application/controllers/Paciente.php */
 ?>