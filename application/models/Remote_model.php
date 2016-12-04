<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remote_model extends CI_Model {

    private $table = 'admin_remote_area';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function get_remote($search)
    {
        $data = array();
        if(!empty($search['country'])){
            $this->db->group_start();
            $this->db->like('country',$search['country']);
            $this->db->or_like('country_cn',$search['country']);
            $this->db->group_end();
        }else{
            return null;
        }

        $city = $search['city'];
        $code = $search['code'];

        if(!empty($city) or !empty($code)){
            if(!(empty($city) or empty($code))){
                $code = $search['code'];
                $this->db->group_start();
                $this->db->like('city',$search['city']);
                $this->db->or_where("((endcode = 0 and startcode= $code) or (endcode<>0 and startcode<=$code and endcode>=$code))", NULL, FALSE);
                $this->db->group_end();
            }else{
                if(!empty($search['city'])){
                    $this->db->like('city',$search['city']);
                }else{
                    $code = $search['code'];
                    $this->db->where("((endcode = 0 and startcode= $code) or (endcode<>0 and startcode<=$code and endcode>=$code))", NULL, FALSE);
                }
            }
        }

        $query = $this->db->get($this->table);
        return $query->result_array();
    }

}

?>