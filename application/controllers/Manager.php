<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent_model');
        $this->load->model('manager_model');
        $this->page_titles = array(
            'index' => '人员管理',
            'create' => '创建新客户',
         );
    }
    public function index()
    {
        $view_data = array();
        $view_data['managers'] = $this->manager_model->select_all();
        $view_data['page_title']= $this->page_titles['index'];
        $this->load_template('manager_index',$view_data);
    }

    public function create(){
        $view_data = array();
        if(!$this->input->post()){
            $view_data['agents'] = $this->agent_model->get_all_company();
            $this->load_template('manager_create',$view_data);
            return true;
        }

        $data = $this->input->post();
        $data['regdate'] = date("Y-m-d H:i:s");
        $salt1 = rand(4,4444);
        $salt2 = rand(6,666666);
        $pwd = $data['pwd'];
        if(is_null($pwd) or empty($pwd)){
            $pwd = '123456';
        }
        $pwd = sha1($salt2. $salt2 . $pwd);

        $data['salt1'] = $salt1;
        $data['salt2'] = $salt2;
        $data['pwd'] = $pwd;

        if (!$this->manager_model->create($data)) {
            return false;
        }else{
            redirect('manager/index','refresh');
        }
    }

}

/* End of file Manager.php */
/* Location: ./application/controllers/Manager.php */

 ?>