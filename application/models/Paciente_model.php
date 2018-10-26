<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_model extends CI_Model {
	var $table = 'paciente';
    var $table2 = 'persona';
    var $column_order = array("nombres",'correo','edad','estado_civil','celular',null); //set column field database for datatable orderable
    var $column_search = array("CONCAT(CONCAT(nombres,' ',appaterno),' ',apmaterno)",'correo','estado_civil','dni'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('persona_id' => 'desc'); // default order 
    private function _get_datatables_query()
    {
        $this->db->select("per.persona_id,paciente_id,CONCAT(CONCAT(nombres,' ',appaterno),' ',apmaterno) as nombres,celular,correo,fecha_nacimiento,estado_civil,photo,dni,TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE()) AS edad");
        $this->db->from($this->table.' pa');
        $this->db->join($this->table2.' per','pa.persona_id=per.persona_id');
        $this->db->where('per.deleted','0');
        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table.' pa');
        $this->db->join($this->table2.' per','per.persona_id=pa.persona_id');
        $this->db->where('per.deleted','0');
        return $this->db->count_all_results();
    }
    public function get_all(){
        $this->db->select('*');
        $this->db->from('paciente pa');
        $this->db->join('persona per','per.persona_id=pa.persona_id');
        $this->db->where('per.deleted','0');
        $query=$this->db->get();
        return $query->result();
    }
	public function save($data){
		$this->db->insert('persona', $data);
		return $this->db->insert_id();
	}
	public function savePatient($data){
		$this->db->insert('paciente', $data);
	}
	public function getInfo($persona_id){
		$this->db->select('persona.*,paciente.paciente_id');
		$this->db->where('paciente.persona_id', $persona_id);
		$this->db->from('persona');
		$this->db->join('paciente', 'paciente.persona_id = persona.persona_id');
		$this->db->limit(1);
		$result=$this->db->get();
		return $result->row();
	}
	public function getInfoDni($dni){
		$this->db->where('dni', $dni);
		$this->db->select("CONCAT(nombres,' ',appaterno) as nombres,paciente.paciente_id");
		$this->db->from('persona');
		$this->db->join('paciente', 'paciente.persona_id = persona.persona_id');
		$this->db->limit(1);
		$result=$this->db->get();
		return $result->row();
	}

}

/* End of file Paciente_model.php */
/* Location: ./application/models/Paciente_model.php */

 ?>