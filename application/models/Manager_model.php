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

    public function checkLogin($username,$pwd)
    {
        $manager_id = $this->get_user_id($username);
        if($manager_id){
            $sql = "select a.*,b.shortname from $this->table a inner join $this->agent_table b on a.company_id = b.id where a.id=$manager_id";
            $query = $this->db->query($sql);
            $row = $query->first_row('array');
            // var_dump($row);
            if($row){
                $salt2 = $row['salt2'];
                $pwd_row = $row['pwd'];
                $pwd1 = sha1($salt2. $salt2 . $pwd);
                if($pwd_row == $pwd1){
                    return $row;
                }else{
                    return false;
                }
            }else{
                return false;
            }

            return $row;
        }else{
            return false;
        }
    }

    public function get_user_id($username)
    {
        $sql = "select id from $this->table where username='$username' limit 1";
        $query = $this->db->query($sql);
        $row = $query->row();
        if($row){
            return $row->id;
        }else{
            return false;
        }
    }

    public function get_manager_by_id($id)
    {
        $this->db->where('id',$id);
        return $this->db->get($this->table)->row_array();
    }

    public function update($data,$id)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }

}

/* End of file Manager_model.php */
/* Location: ./application/models/Manager_model.php */


 ?>