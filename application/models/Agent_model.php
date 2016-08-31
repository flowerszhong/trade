<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model {

    protected $table = 'admin_agent';
    protected $primaryKey = 'id';
    public function __construct()
    {
        parent::__construct();
    }

    function select_all(){
        $sql = "select * from $this->table order by id desc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function create($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id(); 
    }

    public function record_count($include_admin=False)
    {
        if(!$include_admin){
            $this->db->where('id!=',$this->company_id);
        }
        return $this->db->count_all_results($this->table);
    }

    public function fetch_agents($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->where('id!=',$this->company_id);
        $this->db->order_by('id','desc');
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

    public function insert_data($data)
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id(); 
    }

    public function remove_agent($id)
    {
        $sql = "delete from $this->table where id=$id";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_all_company($include_admin=false)
    {
        $sql = "select id,shortname from $this->table where id<>$this->company_id";
        if($include_admin){
            $sql = "select id,shortname from $this->table";
        }
        $query = $this->db->query($sql);
        return $query->result('array');
    }

}

/* End of file Agent_model.php */
/* Location: ./application/models/Agent_model.php */


 ?>