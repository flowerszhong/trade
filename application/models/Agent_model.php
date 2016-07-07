<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model {

    protected $table = 'agent';
    protected $primaryKey = 'id';
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function select_all(){
        $query = $this->db->query('select * from agent');
        return $query->result();
    }

    public function create($data){
        $this->db->insert('agent',$data);
        return $this->db->insert_id(); 
    }

    public function insert_data($data)
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id(); 
    }

    public function select_agent(){
        $query = $this->db->query('select id,name from agent');
        return $query->result();
    }

    
    

}

/* End of file Agent_model.php */
/* Location: ./application/models/Agent_model.php */


 ?>