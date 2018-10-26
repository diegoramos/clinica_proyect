<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('Paciente_model');
            $this->session->userdata('permiso');
            $this->load->model('Paciente_model');
            $this->load->model('Medico_model');
            $this->load->model('Citas_model');
            if (!$this->session->userdata('login')) {
                redirect(base_url().'login');
            }
	}
    public function buscarPaciente(){
       $dni=$this->input->post('dni');
       $result=$this->Paciente_model->getInfoDni($dni);
       echo json_encode($result);

    }
    public function ajax_list()
    {
        $list = $this->Citas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cita) {
            $no++;
            $row = array();
            $row[] = $cita->fecha;
            $row[] = $cita->horario;
            $row[] = $cita->especialidad;
            $row[] = $cita->nombres;
            //add html for action
            $row[] = '
            
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_cita('.$cita->cita_id.')"><i class="glyphicon glyphicon-trash"></i> Cancelar</a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Citas_model->count_all(),
                        "recordsFiltered" => $this->Citas_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list2()
    {
        $list = $this->Citas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cita) {
            $no++;
            $row = array();
            $row[] = $cita->fecha.' <br>'.$cita->horario;
            if ($cita->photo) { $ima='<a  href="'.base_url('upload/'.$cita->photo).'" target="_blank"><img alt="image" class="" width="100%" height="100%" src="'.base_url('upload/'.$cita->photo).'"  /></a>'; } else { $ima='(No photo)'; }

            $row[] = '<div class="row"><div class="col-md-6">'.$ima.'</div><div class="col-md-6"><h6 style="font-weight: bold;">'.$cita->nombres_paciente.'</h6><h6 style="font-weight: ;">DNI: '.$cita->dni.'</h6><p style="font-size:12px;">Celular: '.$cita->celular.'</p></div></div>';
            $row[] = $cita->especialidad;
            $row[] = $cita->nombres;
            if ($cita->estado==0) { $estado='<span class="badge bg-danger">Sin confirmar</span>'; } else { $estado='<span class="badge bg-success">Confirmado</span>';}
            
            $row[] = $estado;
            //add html for action
            $row[] = '
            <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Confirmar" onclick="confirmarCita('.$cita->cita_id.')"><i class="glyphicon glyphicon-pencil"></i> Confirmar</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_cita('.$cita->cita_id.')"><i class="glyphicon glyphicon-trash"></i> Cancelar</a>
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Hapus" onclick="openModalCita('.$cita->cita_id.')"><i class="glyphicon glyphicon-trash"></i> Editar</a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Citas_model->count_all(),
                        "recordsFiltered" => $this->Citas_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list3()
    {
        $list = $this->Citas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cita) {
            $no++;
            $row = array();
            $row[] = $cita->fecha.' <br>'.$cita->horario;
            if ($cita->photo) { $ima='<a  href="'.base_url('upload/'.$cita->photo).'" target="_blank"><img alt="image" class="" width="70px" height="60px;" src="'.base_url('upload/'.$cita->photo).'"  /></a>'; } else { $ima='(No photo)'; }

            $row[] = '<div class="row"><div class="col-md-6">'.$ima.'</div><div class="col-md-6"><h6 style="font-weight: bold;">'.$cita->nombres_paciente.'</h6><p style="font-size:14px;"><span class="badge bg-warning">DNI: '.$cita->dni.'</span></p><p style="font-size:14px;"><span class="badge bg-success fa fa-phone"> '.$cita->celular.'</span></p></div></div>';
            $row[] = $cita->edad." años";
            if ($cita->estado==0) {
                $estado='<span class="badge bg-warning">SIN CONFIRMAR</span>';
            }else if($cita->estado==1){
                $estado='<span class="badge bg-success">EN ESPERA</span>';
            }else if($cita->estado==2){
                $estado='<span class="badge bg-danger">NO ASISTIO</span>';
            } else { 
                $estado='<span class="badge bg-primary">ATENDIDO</span>';}
            
            $row[] = $estado;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Hapus" onclick="openModalEstado('.$cita->estado.')"><i class="glyphicon glyphicon-trash"></i> Modificar</a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hitoriaClinica('.$cita->cita_id.')"><i class="glyphicon glyphicon-trash"></i> Historia Clinica</a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Citas_model->count_all(),
                        "recordsFiltered" => $this->Citas_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
	// List all your items
	public function index( $offset = 0 )
	{
        if ($this->session->userdata('permiso')==1) {
            redirect(base_url().'citas/registrar');
        }else if($this->session->userdata('permiso')==3){
            redirect(base_url().'citas/agendar');
        }
        $result= new stdClass();
        if ($this->session->userdata('permiso')==1) {
            $persona_id=$this->session->userdata('persona_id');
            $result=$this->Paciente_model->getInfo($persona_id);
        }
        //$medicos=$this->Medico_model->getAllMedicos();
        $data = array('paciente' => $result,
                    //s  'medicos'=>$medicos
                  );
		$this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('listar_citas_view', $data);
        $this->load->view('template/footer', FALSE);
	}
    public function registrar( $offset = 0 )
    {
        $result= new stdClass();
        $data =array();
        if ($this->session->userdata('permiso')==1) {
            $persona_id=$this->session->userdata('persona_id');
            $result=$this->Paciente_model->getInfo($persona_id);
            $data['paciente']=$result;
        }
        //$medicos=$this->Medico_model->getAllMedicos();
        //$data = array('paciente' => $result,
                    //s  'medicos'=>$medicos
          //        );
        $this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('registrarcita_view', $data);
        $this->load->view('template/footer', FALSE);
    }
	public function save()
    {
        $this->_validate();
        $data = array(
            'paciente_id' => $this->input->post('paciente_id'),
            'especialidad' => $this->input->post('especialidad'),
            'medico_id' => $this->input->post('medico'),
            'fecha' => $this->formato_fecha($this->input->post('fecha')),
            'horario' => $this->input->post('horario'),
             );
        $this->Citas_model->save($data);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_edit($id){
        $data = $this->Citas_model->get_by_id($id);
        //$data->birth_date = ($data->birth_date == '0000-00-00') ? '' : $data->birth_date; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
    public function cita_ajax_update(){

        $data = array(
            'paciente_id' => $this->input->post('paciente_idc'),
            'especialidad' => $this->input->post('especialidad'),
            'medico_id' => $this->input->post('medico2'),
            'fecha' => $this->formato_fecha($this->input->post('fechae')),
            'horario' => $this->input->post('horario'),
             );
        $this->Citas_model->update_cita(array('cita_id' =>$this->input->post('cita_id')), $data);
        echo json_encode(array("status" => TRUE));
    }
    public function buscarEspecialidadMedico(){
        $especialidad=$this->input->post('especialidad');
        $result=$this->Medico_model->getInfoMedico($especialidad);
        echo json_encode($result);
    }
    public function ajax_delete($id)
    {
        $this->Citas_model->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }
    public function ajax_estado($id)
    {
        $this->Citas_model->estado_by_id($id);

        echo json_encode(array("status" => TRUE));
    }
    ///////////////ACCCESO PARA MEDICO//////////
    public function agendar(){
        $this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('agendar_citas_vew');
        $this->load->view('template/footer', FALSE);
    }
    public function consulta($cita_id=''){
        $data = array();
        if ($cita_id) {
           $result = $this->Citas_model->get_by_id($cita_id);
           $data['pacient']=$result;
        }
        $this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('consulta_cita_view',$data);
        $this->load->view('template/footer', FALSE);
    }
    public function buscarPorDni($dni){
        $result = $this->Citas_model->get_by_dni($dni);
        echo json_encode($result);
    }

    public function tratamiento($cita_id=''){
        $data = array();
        if ($cita_id) {
           $result = $this->Citas_model->get_by_id($cita_id);
           $data['pacient']=$result;
        }
        $this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('tratamiento_cita_view',$data);
        $this->load->view('template/footer', FALSE);
    }
    public function saveConsulta(){
        $this->_validate_consulta();
        $data = array(
            'cita_id' => $this->input->post('txtcita_id'),
            'fecha' => $this->formato_fecha($this->input->post('txtfecha')),
            'hora' => $this->input->post('txthora'),
            'talla' => $this->input->post('txttalla'),
            'peso' => $this->input->post('txtpeso'),
            'precion' => $this->input->post('txtprecion'),
            'temperatura' => $this->input->post('txttemperatura'),
            'antecedentes' => $this->input->post('txtantecedentes'),
            'motivo' => $this->input->post('txtmotivo'),
            'sintomas' => $this->input->post('txtsintomas'),
            'examenes' => $this->input->post('txtexamenes'),
            'diagnostico' => $this->input->post('txtdiagnostico'),
            'indicaciones' => $this->input->post('txtindicaciones'),
             );
        $this->Citas_model->saveConsulta($data);
        echo json_encode(array("status" => TRUE));
    }
    public function cargarConsulta(){
        $result=$this->Citas_model->getAllConsultas($this->input->post("cita_id"));
        echo json_encode($result);
    }
    /////////////////////EXAMEN //////////////////
    public function examen($cita_id=''){
        $data = array();
        if ($cita_id) {
           $result = $this->Citas_model->get_by_id($cita_id);
           $data['pacient']=$result;
        }
        $this->load->view('template/header', FALSE);
        $this->load->view('template/menu', FALSE);
        $this->load->view('examen_cita_view',$data);
        $this->load->view('template/footer', FALSE);
    }
    public function cargarExamen(){
        $result=$this->Citas_model->getAllExamenes($this->input->post("cita_id"));
        echo json_encode($result);
    }
    public function cargarRecetas(){
        $paciente_id=$this->Citas_model->getPacienteId($this->input->post("cita_id"));
        $cantidad=$this->Citas_model->getCantidadCitas($paciente_id);
        $data = array();
        foreach ($cantidad as $key => $value) {
            $dat=array(
                'cita'=>$this->Citas_model->getCita($value->cita_id),
                'receta'=>$this->Citas_model->getAllRecetas($value->cita_id)
            );
            $data[]=$dat;
        }
        echo json_encode($data);
    }
    public function saveExamen(){
        $this->_validate_examen();
        $data = array(
            'cita_id' => $this->input->post('txtcita_id'),
            'fecha' => $this->formato_fecha($this->input->post('txtfecha')),
            'servicio' => $this->input->post('txtservicio'),
            'examen' => $this->input->post('txtexamen'),
            'medico_id' => $this->input->post('txtmedico'),
            'conclucion' => $this->input->post('txtconclusiones'),
             );
        if(!empty($_FILES['photo']['name']))
        {
            $upload = $this->_do_upload();
            $data['photo'] = $upload;
        }

        $this->Citas_model->saveExamen($data);
        echo json_encode(array("status" => TRUE));
    }
    private function _do_upload()
    {
        $config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
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
    public function loads(){
        //echo "asdsa";
        echo json_encode(array('status' => 'ok',
                            'data' => $this->cart->contents() ,
                            //'total_item' => $this->cart->total_items(),
                            //'total_price' => $this->cart->total()
                        )
                );
    }
    public function delete_receta($rowid){
        if($this->cart->remove($rowid)) {
            //echo number_format($this->cart->total());
        }else{
            echo "false";
        }
    }
    public function add_process(){
        ///Aqui se debe modificar
        $total_item = $this->cart->total_items();
        if ($total_item>0) {
            $count = 0; 
            foreach($this->cart->contents() as $items)
            {
                $data=array(
                    'fecha'=>$items["fecha"],
                    'hora'=>$items["hora"],
                    'cita_id'=>$items["cita_id"],
                    'medicamento'=>$items["medicamento"],
                    'presentacion'=>$items["presentacion"],
                    'cantidad'=>$items["cantidad"],
                    'docis'=>$items["docis"],
                    'tiempo'=>$items["tiempo"],
                    'descripcion'=>$items["descripcion"]
                    );
                $this->Citas_model->insert_recetas($data);  
            }
            $this->cart->destroy(); 
            echo json_encode(array('status'=>true,'mensaje'=>'Tratamiento Guardado'));
        }else{
            echo json_encode(array('status'=>false,'mensaje'=>'Seleccionar al menos un tratamiento'));
        }
    }
    /////////////////TRATAMIENTO////////////////
    public function add_receta(){
        $cita_id = $this->input->post('cita_id');
        $fecha = $this->formato_fecha($this->input->post('fecha'));
        $hora = $this->input->post('hora');
        $medicamento = $this->input->post('medicamento');
        $presentacion = $this->input->post('presentacion');
        $cantidad = $this->input->post('cantidad');
        $docis = $this->input->post('docis');
        $tiempo = $this->input->post('tiempo');
        $descripcion = $this->input->post('descripcion');
        
        /*if(){

        }*/
        //$get_product_detail =  $this->Lab_info_m->get_by_id_lab($id_lab);
        //if($get_product_detail){
            $data = array(
                'id'    => (count($this->cart->contents())+1),
                'qty'=>1,
                'price'=>1,
                'name'=>'s',
                'fecha'   => $fecha,
                'hora'    => $hora,
                'cita_id' => $cita_id,
                'medicamento'=>$medicamento,
                'presentacion'=> $presentacion,
                'cantidad'    => $cantidad,
                'docis'       => $docis,
                'tiempo'      => $tiempo,
                'descripcion' => $descripcion
            );
            $this->cart->insert($data);
            echo json_encode(array('status' => 'ok',
                            'data' => $this->cart->contents() ,
                            //'total_item' => $this->cart->total_items(),
                            //'total_price' => $this->cart->total()
                        )
                );
    }
    ///////////////////////////////////////////
    private function formato_fecha(String $fecha): String{
        if ($fecha!='') {
            $parte=explode('/', $fecha);
            $resultado=$parte[2]."-".$parte[1]."-".$parte[0];
            return $resultado;
        }else{
            return null;
        }
    }
    private function _validate_consulta()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('txtfecha') == '')
        {
            $data['inputerror'][] = 'txtfecha';
            $data['error_string'][] = 'La fecha es obligatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('txthora') == '')
        {
            $data['inputerror'][] = 'txthora';
            $data['error_string'][] = 'La hora es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txttalla') == '')
        {
            $data['inputerror'][] = 'txttalla';
            $data['error_string'][] = 'La talla es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtpeso') == '')
        {
            $data['inputerror'][] = 'txtpeso';
            $data['error_string'][] = 'El peso es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtprecion') == '')
        {
            $data['inputerror'][] = 'txtprecion';
            $data['error_string'][] = 'La precion es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txttemperatura') == '')
        {
            $data['inputerror'][] = 'txttemperatura';
            $data['error_string'][] = 'La temperatura es obligatorio';
            $data['status'] = FALSE;
        }
        /*
        if($this->input->post('txtantecedentes') == '')
        {
            $data['inputerror'][] = 'txtantecedentes';
            $data['error_string'][] = 'El antecedente es obligatorio';
            $data['status'] = FALSE;
        }*/
        if($this->input->post('txtmotivo') == '')
        {
            $data['inputerror'][] = 'txtmotivo';
            $data['error_string'][] = 'El motivo es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtsintomas') == '')
        {
            $data['inputerror'][] = 'txtsintomas';
            $data['error_string'][] = 'El sistoma es obligatorio';
            $data['status'] = FALSE;
        }
        /*
        if($this->input->post('txtexamenes') == '')
        {
            $data['inputerror'][] = 'txtexamenes';
            $data['error_string'][] = 'El examen es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtdiagnostico') == '')
        {
            $data['inputerror'][] = 'txtdiagnostico';
            $data['error_string'][] = 'El diagnotico es obligatorio';
            $data['status'] = FALSE;
        }*/
        if($this->input->post('txtindicaciones') == '')
        {
            $data['inputerror'][] = 'txtindicaciones';
            $data['error_string'][] = 'El indicaciones es obligatorio';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    private function _validate_examen()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('txtfecha') == '')
        {
            $data['inputerror'][] = 'txtfecha';
            $data['error_string'][] = 'La fecha es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtservicio') == '')
        {
            $data['inputerror'][] = 'txtservicio';
            $data['error_string'][] = 'El servicio es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtexamen') == '')
        {
            $data['inputerror'][] = 'txtexamen';
            $data['error_string'][] = 'El examen es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtmedico') == '')
        {
            $data['inputerror'][] = 'txtmedico';
            $data['error_string'][] = 'El medico es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('txtconclusiones') == '')
        {
            $data['inputerror'][] = 'txtconclusiones';
            $data['error_string'][] = 'La conclusion es obligatorio';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('paciente_id') == '')
        {
            $data['inputerror'][] = 'dni';
            $data['error_string'][] = 'Buscar nuevo';
            $data['status'] = FALSE;
        }
        /*
        if($this->input->post('paciente_id') == '')
        {
            $data['inputerror'][] = 'nombre';
            $data['error_string'][] = 'El paciente es obligatorio';
            $data['status'] = FALSE;
        }*/
        if($this->input->post('especialidad') == '')
        {
            $data['inputerror'][] = 'especialidad';
            $data['error_string'][] = 'La especialidad es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('medico') == '')
        {
            $data['inputerror'][] = 'medico';
            $data['error_string'][] = 'El medico es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('fecha') == '')
        {
            $data['inputerror'][] = 'fecha';
            $data['error_string'][] = 'La fecha es obligatorio';
            $data['status'] = FALSE;
        }
        if($this->input->post('horario') == '')
        {
            $data['inputerror'][] = 'horario';
            $data['error_string'][] = 'El horario es obligatorio';
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
