<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	
	public function checkLogin()
   {
        $username=$this->input->post('correo',true);
        $password=$this->input->post('password',true);
        $this->db->select('*');
        $this->db->from('paciente');
        $this->db->join('persona', 'persona.persona_id = paciente.persona_id');
        $this->db->where('correo', $username);
        $this->db->where('password', $password);
		    $this->db->limit(1);
        return $this->db->get()->row();
   }
   public function checkLogin_other()
   {
        $username=$this->input->post('correo',true);
        $password=$this->input->post('password',true);
        $this->db->select('*');
        $this->db->from('medico');
        $this->db->join('persona', 'persona.persona_id = medico.persona_id');
        $this->db->where('correo', $username);
        $this->db->where('password', $password);
		    $this->db->limit(1);
        return $this->db->get()->row();
   }
}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */
 ?>