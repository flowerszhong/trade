<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_model extends CI_Model {

    private $table = 'admin_price';
    private $table_agent_price = 'admin_agent_price';
    private $table_agent = 'admin_agent';
    private $table_history = 'admin_history';
    protected $primaryKey = 'id';

    public function __construct()
    {

        parent::__construct();
        //Do your magic here
    }


    public function remove_price($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function select_all($company_id){
        if($this->manager_power>10){
            $sql = "SELECT a.id,a.cname,a.channel,b.create_time,c.shortname FROM $this->table a inner join $this->table_agent_price b on a.id=b.price_id inner join $this->table_agent c on b.company_id = c.id where c.id <> $this->company_id order by a.id desc";
        }else{
            $sql = "SELECT a.id,a.cname,a.channel,b.create_time,c.shortname FROM $this->table a inner join $this->table_agent_price b on a.id=b.price_id inner join $this->table_agent c on b.company_id = c.id where c.id = $this->company_id order by a.id desc";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function query_by_company($company_id)
    {   
        $sql = "select id,cname,firstrow,firstcol,pricedata,areadata from $this->table";

        if(isset($company_id) && is_numeric($company_id) && !empty($company_id)){
            $sql .= " where company_id=$company_id";
        }

        $query=$this->db->query($sql);
        return $query->result('array');
    }

    public function insert_price_old($data,$company_ids){
        $this->db->trans_start();
        $this->db->insert($this->table,$data);
        $price_id = $this->db->insert_id();
        $relation_data = array();
        foreach ($company_ids as $company_id) {
            $relation_data[] = array(
                'company_id'=>$company_id,
                'price_id'=>$price_id
            );
        }

        $this->db->insert_batch($this->table_agent_price, $relation_data); 
        $this->db->trans_complete();
        return $price_id;
    }

    public function insert_price($data){
        $this->db->insert($this->table,$data);
        $price_id = $this->db->insert_id();
        return $price_id;
    }
    public function get_detail($id)
    {
        $sql = "select * from $this->table where id=$id";
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

    public function logging($record)
    {
        if($record){
            $this->db->insert($this->table_history,$record);
        }
    }

    public function record_count($company_id=null)
    {
        $this->db->where('available',1);
        if($this->manager_power < 10){
            $this->db->where('company_id',$this->company_id);
        }else{
            if(isset($company_id)){
                $this->db->where('company_id',$company_id);
            }
        }
        return $this->db->count_all_results($this->table);
    }

    //old version
    //for agent price relation
    public function fetch_prices_old($limit, $start=0) {
        $start = $limit * $start;

        if($this->manager_power>10){
            $sql = "SELECT a.id,a.cname,a.channel,b.create_time,c.shortname FROM $this->table a inner join $this->table_agent_price b on a.id=b.price_id inner join $this->table_agent c on b.company_id = c.id where c.id <> $this->company_id order by a.id desc limit $start,$limit";
        }else{
            $sql = "SELECT a.id,a.cname,a.channel,b.create_time,c.shortname FROM $this->table a inner join $this->table_agent_price b on a.id=b.price_id inner join $this->table_agent c on b.company_id = c.id where c.id = $this->company_id order by a.id desc limit $start,$limit";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function fetch_prices($limit, $start) {
        if($start>0){
            $start = $start-1;
        }
        $start = $limit * $start;

        if($this->manager_power>10){
            $sql = "SELECT a.id,a.cname,a.channel,a.create_time,a.filename,b.shortname FROM $this->table a inner join $this->table_agent b on a.company_id=b.id where b.id <> $this->company_id and a.available=1 order by a.id desc limit $start,$limit";
        }else{
            $sql = "SELECT a.id,a.cname,a.channel,a.create_time,a.filename,b.shortname FROM $this->table a inner join $this->table_agent b on a.company_id = b.id where b.id = $this->company_id and a.available=1 order by a.id desc limit $start,$limit";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function fetch_prices_by_company($limit, $start,$company_id) {
        if($start>0){
            $start = $start-1;
        }
        $start = $limit * $start;

        if($this->manager_power>10){
            $sql = "SELECT a.id,a.cname,a.channel,a.create_time,a.filename,b.shortname FROM $this->table a inner join $this->table_agent b on a.company_id=b.id where b.id = $company_id and a.available=1 order by a.id desc limit $start,$limit";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_history($startdate,$enddate,$company_id = null,$limit,$start)
    {
        $sql = "select a.*,b.shortname from $this->table_history a inner join $this->table_agent b on a.company_id = b.id where date(a.querytime) between '$startdate' and '$enddate'";
        if($company_id && is_numeric($company_id)){
            $sql .= " and company_id= $company_id";
        }

        if($start>=1){
            $start = ($start - 1) * $limit;
        }

        $sql .= " order by querytime desc limit $start,$limit ";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_history_count($startdate,$enddate,$company_id = null)
    {
        $sql = "select count(*) as count from $this->table_history a inner join $this->table_agent b on a.company_id = b.id where date(a.querytime) between '$startdate' and '$enddate'";
        if($company_id && is_numeric($company_id)){
            $sql .= " and company_id= $company_id";
        }

        $sql .= " order by querytime desc";

        $query = $this->db->query($sql);
        $result = $query->row_array();
        if($result){
            return $result['count'];
        }else{
            return null;
        }
    }



    public function get_price_by_id($id)
    {
        $sql = "select a.id,a.cname,b.shortname from $this->table a inner join $this->table_agent b on a.company_id = b.id where a.available = 1 and a.id=$id";
        $query = $this->db->query($sql);
        return $query->first_row('array');
    }

    public function update($id,$data)
    {
        $this->db->where('id',$id);
        return $this->db->update($this->table,$data);
    }

}

/* End of file Price_model.php */
/* Location: ./application/models/Price_model.php */


 ?>