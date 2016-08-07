<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_model extends CI_Model {

    public $table = 'admin_price';
    protected $primaryKey = 'id';

    public function __construct()
    {

        parent::__construct();
        //Do your magic here
    }

    public function select_all($company_id){
    	$query_string = "select * from " . $this->table;
    	// if($company_id){
    	// 	$query_string = "select a.*,b.name as company_name from price a inner join agent b where a.company_id = " . $company_id;
    	// }
        $query = $this->db->query($query_string);
        return $query->result();
    }

    public function insert_price($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id(); 
    }
    public function get_detail($id)
    {
        $sql = "select * from $this->table where $id=" . $id;
        $query = $this->db->query($sql);
        $result = $query->first_row('array');
        return $this->jsontoarray($result);
    }

    protected function jsontoarray($result)
    {
        $result['firstrow'] = json_decode($result['firstrow']);
        $result['firstcol'] = json_decode($result['firstcol']);
        $result['pricedata'] = json_decode($result['pricedata']);
        return $result;
    }

    public function get_latest()
    {
        $sql = "select * from $this->table order by id desc limit 1";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        return $this->jsontoarray($result);
    }





}

/* End of file Price_model.php */
/* Location: ./application/models/Price_model.php */


 ?>