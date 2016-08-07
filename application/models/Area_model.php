<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    protected $table = 'admin_area';
    protected $primaryKey = 'id';
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    function select_all(){
        $sql = "select area_id,state,trim(state_en) state_en from $this->table";
        $query = $this->db->query($sql);
        return $query->result();
    }

}

/* End of file Area_model.php */
/* Location: ./application/models/Area_model.php */


 ?>