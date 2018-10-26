<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        /*if($this->session->userdata('user_id')>0)
        {
            redirect('dashboard', 'refresh');
        }*/
        $this->load->model('Medico_model');

	}
	public function medico(){
		$fecha='12/02/2018';
		$res=explode('/', $fecha);
		echo "<pre>";
		print_r($res);
		echo "</pre>";
	}
	public function ajax_list()
	{
		$list = $this->Medico_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $medico) {
			$no++;
			$row = array();
			$row[] = $medico->medico_id;
			$row[] = $medico->nombres;
			$row[] = $medico->especialidad;
			$row[] = $medico->dni;
			//add html for action
			$row[] = '
			<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_medico('.$medico->medico_id.')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			
			<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_medico('.$medico->medico_id.')"><i class="glyphicon glyphicon-trash"></i> Del</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Medico_model->count_all(),
						"recordsFiltered" => $this->Medico_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function index()
	{
		$this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
       	$this->load->view('listar_medico_view', FALSE);
        $this->load->view('template/footer', FALSE);
	}
	public function registrar(){

		$this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('form_medico_view', FALSE);
        $this->load->view('template/footer', FALSE);
	}
	public function medico_ajax_add()
    {
        $this->_validate();
        $data_person = array(
                'dni' => $this->input->post('txtdni'),
                'appaterno' => $this->input->post('txtappaterno'),
                'apmaterno' => $this->input->post('txtapmaterno'),
                'nombres' => $this->input->post('txtnombre'),
                'sexo' => $this->input->post('txtsexo'),
                'celular' => $this->input->post('txtcelular'),
                'create_at' => date('Y-m-d H:m:s'),
                'permiso' => '2',
            );
        $insert_id =$this->Medico_model->save($data_person);
        $data = array(
                'fecha_nacimiento' => $this->formato_fecha($this->input->post('txtnaciemiento')),
                'estado_civil' => $this->input->post('txtestado_civil'),
                'especialidad' => $this->input->post('txtespecialidad'),
                'horario' => $this->input->post('txthorario'),
                'fecha_cese' => $this->formato_fecha($this->input->post('txtfecha_cese')),
                'medico_tec' => $this->input->post('txtmedico_tec'),
                'correo' => $this->input->post('txtcorreo'),
                'password' => md5($this->input->post('txtpassword')),
                'fecha' => date('Y-m-d'),
                'persona_id'=>$insert_id
            );
        $this->Medico_model->saveMedico($data);
        echo json_encode(array("status" => TRUE,"url"=>"medico/registrar"));
    }
    public function medico_ajax_update()
	{
		$this->_validate_up();
		$data_persona = array(
				'dni' => $this->input->post('txtdni'),
                'appaterno' => $this->input->post('txtappaterno'),
                'apmaterno' => $this->input->post('txtapmaterno'),
                'nombres' => $this->input->post('txtnombre'),
                'sexo' => $this->input->post('txtsexo'),
                'celular' => $this->input->post('txtcelular'),
                'update_at' => date('Y-m-d H:m:s'),
			);

		$data_medico = array(
				'fecha_nacimiento' => $this->formato_fecha($this->input->post('txtnaciemiento')),
                'estado_civil' => $this->input->post('txtestado_civil'),
                'especialidad' => $this->input->post('txtespecialidad'),
                'horario' => $this->input->post('txthorario'),
                'fecha_cese' => $this->formato_fecha($this->input->post('txtfecha_cese')),
                'medico_tec' => $this->input->post('txtmedico_tec'),
                'correo' => $this->input->post('txtcorreo'),
			);
		if ($this->input->post('txtpassword')!='') {
			$data_medico['password']=md5($this->input->post('txtpassword'));
		}

        $data = $this->Medico_model->get_by_id($this->input->post('medico_id'));

        $this->Medico_model->update(array('persona.persona_id' =>$data->persona_id), $data_persona);
        $this->Medico_model->update_medico(array('medico.medico_id' => $this->input->post('medico_id')), $data_medico);
		echo json_encode(array("status" => TRUE));
	}
    public function ajax_edit($id)
	{
		$data = $this->Medico_model->get_by_id($id);
		$data->fecha_cese= $this->formato_fecha_reversa($data->fecha_cese);
		$data->fecha_nacimiento= $this->formato_fecha_reversa($data->fecha_nacimiento);
		//$data->birth_date = ($data->birth_date == '0000-00-00') ? '' : $data->birth_date; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function ajax_delete($id_medico)
	{
		$person = $this->Medico_model->get_by_id($id_medico);
        $this->Medico_model->delete_persona_by_id($person->persona_id);

		echo json_encode(array("status" => TRUE));
	}
    private function formato_fecha(String $fecha): String{
    	if ($fecha!='') {
    		$parte=explode('/', $fecha);
    		$resultado=$parte[2]."-".$parte[1]."-".$parte[0];
    		return $resultado;
    	}else{
    		return null;
    	}
    }
    private function formato_fecha_reversa(String $fecha): String{
    	if ($fecha!='') {
    		$parte=explode('-', $fecha);
    		$resultado=$parte[2]."/".$parte[1]."/".$parte[0];
    		return $resultado;
    	}else{
    		return null;
    	}
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('txtdni') == '')
        {
            $data['inputerror'][] = 'txtdni';
            $data['error_string'][] = 'El dni es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtappaterno') == '')
        {
            $data['inputerror'][] = 'txtappaterno';
            $data['error_string'][] = 'El apellido paterno es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtapmaterno') == '')
        {
            $data['inputerror'][] = 'txtapmaterno';
            $data['error_string'][] = 'El apellido materno  es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtnombre') == '')
        {
            $data['inputerror'][] = 'txtnombre';
            $data['error_string'][] = 'El nombre es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtnaciemiento') == '')
        {
            $data['inputerror'][] = 'txtnaciemiento';
            $data['error_string'][] = 'La fecha nacimiento es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtsexo') == '')
        {
            $data['inputerror'][] = 'txtsexo';
            $data['error_string'][] = 'El sexo es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtestado_civil') == '')
        {
            $data['inputerror'][] = 'txtestado_civil';
            $data['error_string'][] = 'El estado civil es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtcelular') == '')
        {
            $data['inputerror'][] = 'txtcelular';
            $data['error_string'][] = 'El numero de celular es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtespecialidad') == '')
        {
            $data['inputerror'][] = 'txtespecialidad';
            $data['error_string'][] = 'La especialidad es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txthorario') == '')
        {
            $data['inputerror'][] = 'txthorario';
            $data['error_string'][] = 'El horario es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtcorreo') == '')
        {
            $data['inputerror'][] = 'txtcorreo';
            $data['error_string'][] = 'El correo es obligatorio';
            $data['status'] = FALSE;
        }
 		 if($this->input->post('txtpassword') == '')
        {
            $data['inputerror'][] = 'txtpassword';
            $data['error_string'][] = 'La contraseña es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    private function _validate_up()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('txtdni') == '')
        {
            $data['inputerror'][] = 'txtdni';
            $data['error_string'][] = 'El dni es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtappaterno') == '')
        {
            $data['inputerror'][] = 'txtappaterno';
            $data['error_string'][] = 'El apellido paterno es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtapmaterno') == '')
        {
            $data['inputerror'][] = 'txtapmaterno';
            $data['error_string'][] = 'El apellido materno  es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtnombre') == '')
        {
            $data['inputerror'][] = 'txtnombre';
            $data['error_string'][] = 'El nombre es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('txtnaciemiento') == '')
        {
            $data['inputerror'][] = 'txtnaciemiento';
            $data['error_string'][] = 'La fecha nacimiento es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtsexo') == '')
        {
            $data['inputerror'][] = 'txtsexo';
            $data['error_string'][] = 'El sexo es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtestado_civil') == '')
        {
            $data['inputerror'][] = 'txtestado_civil';
            $data['error_string'][] = 'El estado civil es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtcelular') == '')
        {
            $data['inputerror'][] = 'txtcelular';
            $data['error_string'][] = 'El numero de celular es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtespecialidad') == '')
        {
            $data['inputerror'][] = 'txtespecialidad';
            $data['error_string'][] = 'La especialidad es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txthorario') == '')
        {
            $data['inputerror'][] = 'txthorario';
            $data['error_string'][] = 'El horario es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtcorreo') == '')
        {
            $data['inputerror'][] = 'txtcorreo';
            $data['error_string'][] = 'El correo es obligatorio';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Medico.php */
/* Location: ./application/controllers/Medico.php */
 ?>