<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_model extends CI_Model {

    protected $table = 'manager';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function select_all(){
        $query = $this->db->query('select a.*,b.name as company_name from manager a inner join agent b on a.company_id = b.id;');
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