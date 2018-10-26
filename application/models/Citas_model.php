<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Citas_model extends CI_Model {
 
  var $table = 'cita';
  var $column_order = array('fecha','horario','especialidad','concat(nombres,\' \',appaterno)',null); //set column field database for datatable orderable
  var $column_search = array('fecha','horario','especialidad','concat(nombres,\' \',appaterno)'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('cita_id' => 'desc'); // default order 

  public function __construct()
  {
    //parent::__construct();
  }

  private function _get_datatables_query()
  {
    $this->db->select('cita_id,ci.fecha,ci.horario,ci.estado,concat(p.nombres,\' \',p.appaterno) as nombres,me.especialidad,concat(per.nombres,\' \',per.appaterno) as nombres_paciente,per.dni,per.celular,pa.fecha_nacimiento,per.photo,TIMESTAMPDIFF(YEAR,pa.fecha_nacimiento,CURDATE()) AS edad');
    $this->db->from('cita ci');
    $this->db->join('medico me', 'ci.medico_id = me.medico_id');
    $this->db->join('persona p', 'p.persona_id = me.persona_id');
    $this->db->join('paciente pa', 'pa.paciente_id = ci.paciente_id');
    $this->db->join('persona per', 'per.persona_id = pa.persona_id');
    $this->db->where('per.deleted', 0);

    $this->db->where('ci.deleted', 0);

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
		$this->db->where('deleted', 0);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function save($data){
		$this->db->insert('cita', $data);
	}
	public function delete_by_id($cita_id){
		  $data = array('deleted' => '1' );
	  $this->db->where('cita_id', $cita_id);
	  $this->db->update('cita',$data);
	}
 	public function estado_by_id($cita_id){
 	  $data = array('estado' => '1' );
      $this->db->where('cita_id', $cita_id);
      $this->db->update('cita',$data);
 	}
 	public function get_by_id($id)
	{
		$this->db->select("c.cita_id,DATE_FORMAT(c.fecha,'%d/%m/%Y') as fecha,c.especialidad,c.paciente_id,c.medico_id,c.horario,c.estado,c.deleted,CONCAT(pm.nombres,' ',pm.appaterno) as medico,CONCAT(p.nombres,' ',p.appaterno) as paciente,TIMESTAMPDIFF(YEAR,pa.fecha_nacimiento,CURDATE()) AS edad,p.dni,grupo_sanguineo,rh,pa.fecha_nacimiento,p.photo");
		$this->db->from('cita c');
		$this->db->join('paciente pa', 'pa.paciente_id = c.paciente_id');
		$this->db->join('persona p', 'p.persona_id = pa.persona_id');
		$this->db->join('medico m', 'm.medico_id = c.medico_id');
		$this->db->join('persona pm', 'pm.persona_id = m.persona_id');
		$this->db->where('cita_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
  public function get_by_dni($dni)
  {
    $this->db->select("c.cita_id,DATE_FORMAT(c.fecha,'%d/%m/%Y') as fecha,c.especialidad,c.paciente_id,c.medico_id,c.horario,c.estado,c.deleted,CONCAT(pm.nombres,' ',pm.appaterno) as medico,CONCAT(p.nombres,' ',p.appaterno) as paciente,TIMESTAMPDIFF(YEAR,pa.fecha_nacimiento,CURDATE()) AS edad,p.dni,grupo_sanguineo,rh,pa.fecha_nacimiento,p.photo");
    $this->db->from('cita c');
    $this->db->join('paciente pa', 'pa.paciente_id = c.paciente_id');
    $this->db->join('persona p', 'p.persona_id = pa.persona_id');
    $this->db->join('medico m', 'm.medico_id = c.medico_id');
    $this->db->join('persona pm', 'pm.persona_id = m.persona_id');
    $this->db->where('p.dni',$dni);
    $query = $this->db->get();

    return $query->row();
  }
	public function update_cita($where,$data){
		$this->db->update('cita', $data, $where);
        return $this->db->affected_rows();
	}
  /////////////////////////USUARIO MEDICO///////
  public function saveConsulta($data){
    $this->db->insert('consulta', $data);
  }
  public function getAllConsultas($cita_id){
    $this->db->select("co.*,ci.especialidad,CONCAT(p.nombres,' ',p.appaterno) as medico,p.persona_id");
    $this->db->from('consulta co');
    $this->db->join('cita ci', 'ci.cita_id = co.cita_id');
    $this->db->join('medico me', 'me.medico_id = ci.medico_id');
    $this->db->join('persona p', 'p.persona_id = me.persona_id');
    $this->db->where('co.cita_id', $cita_id);
    $this->db->where('ci.deleted', '0');
    $this->db->where('co.deleted', '0');
    $result=$this->db->get();
    return $result->result();
  }
  ////////////////SAVE EXAMEN////////////
  public function saveExamen($data)
  {
    $this->db->insert('examen', $data);
  }
  public function getAllExamenes($cita_id){
    $this->db->select("co.*,CONCAT(p.nombres,' ',p.appaterno) as medico,p.persona_id");
    $this->db->from('examen co');
    $this->db->join('cita ci', 'ci.cita_id = co.cita_id');
    $this->db->join('medico me', 'co.medico_id = me.medico_id');
    $this->db->join('persona p', 'p.persona_id = me.persona_id');
    $this->db->where('co.cita_id', $cita_id);
    $this->db->where('ci.deleted', '0');
    $this->db->where('co.deleted', '0');
    $result=$this->db->get();
    return $result->result();
  }
  public function getPacienteId($cita_id){
    $this->db->select('paciente_id');
    $this->db->from('cita');
    $this->db->where('cita_id', $cita_id);
    $this->db->where('deleted', 0);
    $this->db->limit(1);
    $resutl=$this->db->get()->row()->paciente_id;
    return $resutl;
  }
  public function getCantidadCitas($paciente_id){
    $this->db->select('cita_id');
    $this->db->from('cita');
    $this->db->join('paciente', 'paciente.paciente_id = cita.paciente_id');
    $this->db->where('cita.paciente_id', $paciente_id);
    $this->db->where('deleted', 0);
    $resutl=$this->db->get()->result();
    return $resutl;
  }
  public function getCita($cita_id){
    $this->db->select('fecha,especialidad');
    $this->db->from('cita');
    $this->db->where('cita_id', $cita_id);
    $this->db->limit(1);
    $result=$this->db->get();
    return $result->result();

  }
  public function getAllRecetas($cita_id){
    $this->db->select("re.*");
    $this->db->from('recetados re');
    $this->db->where('re.cita_id', $cita_id);
    $this->db->where('re.deleted', '0');
    $result=$this->db->get();
    return $result->result();
  }
  public function insert_recetas($data)
  {
    $this->db->insert('recetados', $data);
  }
 }
 
 /* End of file Citas_model.php */
 /* Location: ./application/models/Citas_model.php */ ?>