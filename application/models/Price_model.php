<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_model extends CI_Model {

    protected $table = 'price';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function select_all($company_id){
    	$query_string = "select a.*,b.name as company_name from price a inner join agent b on a.company_id = b.id;";
    	if($company_id){
    		$query_string = "select a.*,b.name as company_name from price a inner join agent b where a.company_id = " . $company_id;
    	}
        $query = $this->db->query($query_string);
        return $query->result();
    }

    public function create($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id(); 
    }





}

/* End of file Price_model.php */
/* Location: ./application/models/Price_model.php */


 ?>