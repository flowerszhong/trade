<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent_model');
        $this->page_titles = array(
            'index'=>'公司列表',
            'create'=>'新增公司',
            'edit'=>'编辑公司信息'
        );
        $this->checkPermission();
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        // $this->config->load('pagination');
        $config["base_url"] = site_url('agent/index');
        $config["total_rows"] = $this->agent_model->record_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["agents"] = $this->agent_model->
            fetch_agents($config["per_page"], $page);
        $data['page_title'] = $this->page_titles['index'];
        $data["links"] = $this->pagination->create_links();
        $this->load_template('agent_index',$data);
    }

    public function create(){
        $view_data = array();
        $view_data['page_title'] = $this->page_titles['create'];
        if(!$this->input->post()){
            $this->load_template('agent_create',$view_data);
            return true;
        }
        $this->validate_agent();
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

        $this->load_template('agent_create',$view_data);
        return true;

    }

    public function validate_agent()
    {
        $this->form_validation->set_rules('name', '公司名称', 'trim|required|xss_clean|min_length[2]|max_length[60]');
        $this->form_validation->set_rules('shortname', '公司简称', 'trim|required|max_length[20]|xss_clean');
        $this->form_validation->set_rules('code', '公司代码', 'trim|required|xss_clean|alpha_dash');
        $this->form_validation->set_rules('officephone', '电话', 'trim|required|xss_clean|alpha_dash');
        $this->form_validation->set_rules('address', '地址', 'trim|required|xss_clean|max_length[80]');
        $this->form_validation->set_rules('description', '描述', 'trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('comments', '描述', 'trim|max_length[100]|xss_clean');
    }

    public function edit($id)
    {
        $view_data = $this->agent_model->get_agent_by_id($id);
        $view_data['page_title'] = $this->page_titles['edit'];
        if(!$this->input->post()){
            $this->load_template('agent_edit',$view_data);
            return true;
        }
        $this->validate_agent();
        if($this->form_validation->run() == True){
            $data = $this->input->post();
            if (!$this->agent_model->update($data,$id)) {
                return false;
            }else{
                $data['page_title'] = $this->page_titles['edit'];
                $data['edit_result'] = "编辑成功";
                $data['id']=$id;
                $this->load_template('agent_edit',$data);
                return true;
            }
        }

        $this->load_template('agent_edit',$view_data);
        return true;
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