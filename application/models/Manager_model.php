<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_model extends CI_Model {

    protected $table = 'admin_manager';
    protected $agent_table = 'admin_agent';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function select_all(){
        $sql = "select a.*,b.name as company_name from $this->table a inner join $this->agent_table b on a.company_id = b.id order by a.id desc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function create($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id(); 
    }

}

/* End of file Manager_model.php */
/* Location: ./application/models/Manager_model.php */


 ?>