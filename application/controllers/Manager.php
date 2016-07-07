<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends My_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent_model');
        $this->load->model('manager_model');
    }
    public function index()
    {
        $view_data = array();
        $view_data['managers'] = $this->manager_model->select_all();
        $this->load_template('manager_index',$view_data);
    }

    public function create(){
        $view_data = array();
        if(!$this->input->post()){
            $view_data['agents'] = $this->agent_model->select_agent();
            $this->load_template('manager_create',$view_data);
            return true;
        }

        $data = $this->input->post();
        $data['regdate'] = date("Y-m-d H:i:s");

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