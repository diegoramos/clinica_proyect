<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if($this->session->userdata('user_id')>0)
        {
            redirect('dashboard', 'refresh');
        }
		$this->load->model('Paciente_model');
        $this->load->model('Login_model');

	}

	// List all your items
	public function index( $offset = 0 )
	{
		$this->load->view('login', FALSE);
	}
    public function check_login()
    {
        $response=array();
        if($this->form_validation->run('login')!==false){
            $result=$this->Login_model->checkLogin();
            if($result){
                $sdata['persona_id']=$result->persona_id;
                $sdata['permiso']=$result->permiso;
                $sdata['nombre']=$result->nombres;
                $sdata['apellido']=$result->appaterno." ".$result->apmaterno;
                $sdata['login']=true;
                $sdata['foto']=$result->photo;
                $this->session->set_userdata($sdata);
                $response['status']='success';
                $response['url']='citas/registrar';
            }
            else{
                $result2=$this->Login_model->checkLogin_other();
                if($result2){
                    $sdata['persona_id']=$result2->persona_id;
                    $sdata['permiso']=$result2->permiso;
                    $sdata['nombre']=$result2->nombres;
                    $sdata['apellido']=$result2->appaterno." ".$result2->apmaterno;
                    $sdata['login']=true;
                    $sdata['foto']=$result2->photo;
                    $this->session->set_userdata($sdata);
                    $response['status']='success';
                    $response['url']='medico/registrar';
                }else{
                    $response['status']='error';
                    $response['message']='Ops! Invalid username Or password'; 
                }/**/
            }
        }
        else{
            $response['status']='error';
            $response['message']=validation_errors();
        }
        echo json_encode($response);        
    }
	public function patient_ajax_add()
    {
        $this->_validate();
        $data_person = array(
                'dni' => $this->input->post('txtdni'),
                'appaterno' => $this->input->post('txtappaterno'),
                'apmaterno' => $this->input->post('txtapmaterno'),
                'nombres' => $this->input->post('txtnombre'),
                'sexo' => $this->input->post('txtsexo'),
                'celular' => $this->input->post('txtcelular'),
                'direccion' => $this->input->post('txtdireccion'),
                'create_at' => date('Y-m-d H:m:s'),
                'permiso' => '1',
            );

        if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
            $data_person['photo'] = $upload;
        }
        $insert_id = $this->Paciente_model->save($data_person);
        $data = array(
                'fecha_nacimiento' => $this->input->post('txtnaciemiento'),
                'estado_civil' => $this->input->post('txtestado_civil'),
                'ocupacion' => $this->input->post('txtocupacion'),
                'nacionalidad' => $this->input->post('txtnacionalidad'),
                'grupo_sanguineo' => $this->input->post('txtgrupo_sanguineo'),
                'rh' => $this->input->post('txtrh'),
                'correo' => $this->input->post('txtcorreo'),
                'password' => md5($this->input->post('txtpassword')),
                'persona_id'=>$insert_id
            );
        $this->Paciente_model->savePatient($data);
        $sdata['persona_id']=$insert_id;
        $sdata['permiso']=1;
        $sdata['nombre']=$this->input->post('txtnombre');
        $sdata['apellido']=$this->input->post('txtappaterno')." ".$this->input->post('txtapmaterno');
        $sdata['login']=true;
        $sdata['foto']=$data_person['photo'];
        $this->session->set_userdata($sdata);

        echo json_encode(array("status" => TRUE,"url"=>"citas/registrar"));
    }
    public function logout(){
        $this->session->sess_destroy(); 
        redirect('login','refresh');
    }


    private function _do_upload()
    {
        $config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
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
         if($this->input->post('txtocupacion') == '')
        {
            $data['inputerror'][] = 'txtocupacion';
            $data['error_string'][] = 'La ocupacion es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtnacionalidad') == '')
        {
            $data['inputerror'][] = 'txtnacionalidad';
            $data['error_string'][] = 'La nacionalidad es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtcelular') == '')
        {
            $data['inputerror'][] = 'txtcelular';
            $data['error_string'][] = 'El numero de celular es obligatorio';
            $data['status'] = FALSE;
        }
         if($this->input->post('txtdireccion') == '')
        {
            $data['inputerror'][] = 'txtdireccion';
            $data['error_string'][] = 'La dirección es obligatorio';
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

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
