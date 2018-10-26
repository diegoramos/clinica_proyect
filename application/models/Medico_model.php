
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico_model extends CI_Model {

  var $table = 'medico';
  var $column_order = array('medico_id','concat(nombres,\' \',appaterno)','especialidad','dni',null); //set column field database for datatable orderable
  var $column_search = array('medico_id','concat(nombres,\' \',appaterno)','especialidad','dni'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('medico_id' => 'desc'); // default order 

  public function __construct()
  {
    //parent::__construct();
  }

  private function _get_datatables_query()
  {
    
    $this->db->select('medico_id,concat(nombres,\' \',appaterno) as nombres,dni,me.especialidad');
    $this->db->from('persona per');
    $this->db->join('medico me', 'me.persona_id = per.persona_id');
    $this->db->where('per.deleted', 0);

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
  $this->db->where('deleted', 0);
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
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }
  public function save($data){
    $this->db->insert('persona', $data);
    return $this->db->insert_id();
  }
  public function saveMedico($data){
    $this->db->insert('medico', $data);
  }
  public function get_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('persona per');
    $this->db->join('medico med', 'med.persona_id = per.persona_id');
    $this->db->where('med.medico_id',$id);
    $query = $this->db->get();
    return $query->row();
  }
  public function getInfo($persona_id){
    $this->db->from('persona');
    $this->db->limit(1);
    $result=$this->db->get();
    return $result->row();
  }
  public function getAllMedicos(){
    $this->db->select("medico_id,CONCAT(nombres,' ',appaterno) as nombres");
    $this->db->from('persona');
    $this->db->join('medico', 'medico.persona_id = persona.persona_id');
    $result=$this->db->get();
    return $result->result();
  }
  public function update($where, $data)
  {
    $this->db->update('persona', $data, $where);
    return $this->db->affected_rows();
  }

  public function update_medico($where, $data)
  {
    $this->db->update('medico', $data, $where);
    return $this->db->affected_rows();
  }
  public function delete_persona_by_id($id)
  {
        $data = array('deleted' => '1' );
        $this->db->where('persona_id', $id);
        $this->db->update('persona',$data);
  }
  public function getInfoMedico($especialidad){
    $this->db->select("medico_id,CONCAT(nombres,' ',appaterno) as nombres");
    $this->db->where('especialidad', $especialidad);
    $this->db->from('medico');
    $this->db->join('persona', 'medico.persona_id = persona.persona_id');
    $result=$this->db->get();
    return $result->result();
  }
}

/* End of file Medico_model.php */
/* Location: ./application/models/Medico_model.php */
 ?>