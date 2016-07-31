<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent_model');
        $this->page_titles = array(
            'index'=>'公司列表',
            'create'=>'新增公司'
        );
    }

    public function index()
    {
        $view_data = array();
        $agents = $this->agent_model->select_all();
        $view_data['agents'] = $agents;
        $view_data['page_title'] = $this->page_titles['index'];
        $this->load_template('agent_index',$view_data);
    }

    public function create(){
        $view_data = array();
        $view_data['page_title'] = $this->page_titles['create'];
        if(!$this->input->post()){
            $this->load_template('agent_create',$view_data);
            return true;
        }

        $this->form_validation->set_rules('name', '标题', 'trim|required|xss_clean|min_length[2]|max_length[60]');
        $this->form_validation->set_rules('description', '内容', 'trim|required|xss_clean');
        $this->form_validation->set_rules('officephone', '电话', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', '地址', 'trim|required|xss_clean');

        if($this->form_validation->run() == True){
            $data = $this->input->post();
            $data['regdate'] = date("Y-m-d H:i:s");
            $data['available'] = 1;
            if (!$this->agent_model->create($data)) {
                return false;
            }else{
                redirect('agent/index','refresh');
            }
        }

    }

    public function delete($id)
    {
        $query_result = $this->agent_model->remove_agent($id);
        if($query_result){
            redirect('agent/index','refresh');
        }
    }

}

/* End of file Agent.php */
/* Location: ./application/controllers/Agent.php */
 ?>