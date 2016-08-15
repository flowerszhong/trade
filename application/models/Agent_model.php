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

    public function insert_data($data)
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id(); 
    }

    public function select_agent(){
        $sql = "select id,name from $this->table";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function remove_agent($id)
    {
        $sql = "delete from $this->table where id=$id";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_all_company()
    {
        $sql = "select id,shortname from $this->table";
        $query = $this->db->query($sql);
        return $query->result('array');
    }

}

/* End of file Agent_model.php */
/* Location: ./application/models/Agent_model.php */


 ?>