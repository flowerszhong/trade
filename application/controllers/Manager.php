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
            'edit' => '编辑客户资料',
         );
        $this->checkPermission();
    }
    public function index2()
    {
        $view_data = array();
        $view_data['managers'] = $this->manager_model->select_all($this->isSuperAdmin());
        $view_data['page_title']= $this->page_titles['index'];
        $this->load_template('manager_index',$view_data);
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        // $this->config->load('pagination');
        $config["base_url"] = site_url('manager/index');
        $config["total_rows"] = $this->manager_model->record_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['agents'] = $this->agent_model->get_all_company();
        $data["managers"] = $this->manager_model->
            fetch_managers($config["per_page"], $page);
        $data['page_title'] = $this->page_titles['index'];
        $this->load_template('manager_index',$data);
    }

    public function company($company_id) {
        $this->load->library('pagination');
        $config = array();
        // $this->config->load('pagination');
        $config["base_url"] = site_url("manager/company/$company_id");
        $config["total_rows"] = $this->manager_model->record_count($company_id);
        $config["per_page"] = 15;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['agents'] = $this->agent_model->get_all_company();
        $data["managers"] = $this->manager_model->
            fetch_managers($config["per_page"], $page,$company_id);
        $data['page_title'] = $this->page_titles['index'];
        $this->load_template('manager_index',$data);
    }

    public function create(){
        $view_data = array();
        $view_data['page_title'] = $this->page_titles['create'];
        $view_data['agents'] = $this->agent_model->get_all_company();
        if(!$this->input->post()){
            $this->load_template('manager_create',$view_data);
            return true;
        }
        $this->validate_manager();
        if($this->form_validation->run() == True){
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

        $this->load_template('manager_create',$view_data);
        return true;
    }


    public function validate_manager($original_username=null)
    {
        $this->form_validation->set_rules('name', '用户名称', 'trim|required|xss_clean|min_length[2]|max_length[40]');
        $this->form_validation->set_rules('username', '登录账号', "trim|required|min_length[4]|max_length[20]|xss_clean|alpha_dash|callback_duplication_username[$original_username]");
        $this->form_validation->set_rules('pwd', '登录密码', 'trim|xss_clean|min_length[6]|max_length[16]|alpha_dash');
        $this->form_validation->set_rules('company_id', '关联公司', 'trim|xss_clean|required');
        $this->form_validation->set_rules('mobile', '手机号码', 'trim|required|xss_clean|max_length[14]|alpha_dash');
        $this->form_validation->set_rules('qq', 'QQ', 'trim|required|xss_clean|max_length[13]|numeric');
        $this->form_validation->set_rules('email', '邮箱', 'trim|xss_clean|max_length[40]|valid_email');
    }

    public function edit($id)
    {
        if(is_null($id)){
            redirect('manager/index','refresh');
        }
        $view_data = $this->manager_model->get_manager_by_id($id);
        $view_data['page_title'] = $this->page_titles['edit'];
        $view_data['agents'] = $this->agent_model->get_all_company();
        if(!$this->input->post()){
            $this->load_template('manager_edit',$view_data);
            return true;
        }
        $original_username = $view_data['username'];
        $this->validate_manager($original_username);
        if($this->form_validation->run() == True){
            $data = $this->input->post();

            $pwd = $data['pwd'];
            if(isset($pwd) and !empty($pwd)){
                $salt1 = rand(4,4444);
                $salt2 = rand(6,666666);
                $pwd = sha1($salt2. $salt2 . $pwd);
                $data['salt1'] = $salt1;
                $data['salt2'] = $salt2;
                $data['pwd'] = $pwd;
            }
            

            if (!$this->manager_model->update($data,$id)) {
                return false;
            }else{
                redirect('manager/index','refresh');
                // $data['page_title'] = $this->page_titles['edit'];
                // $data['edit_result'] = "编辑成功";
                // $data['id']=$id;
                // $this->load_template('manager_edit',$data);
                // return true;
            }
        }

        $this->load_template('manager_edit',$view_data);
        return true;
    }

    public function duplication_username($name,$original)
    {
        if($name == $original){
            return true;
        }
        $this->form_validation->set_message('duplication_username','用户账号 不能重复');
        $field = "username";
        $ret = $this->manager_model->checkDuplicate($field,$name);
        if(is_array($ret)){
            $ret = $ret[0];
        }
        if(intval($ret['count']) > 0){
            return false;
        }
    }

    public function delete($id)
    {
        $query_result = $this->manager_model->remove_manager($id);
        if($query_result){
            redirect('manager/index','refresh');
        }
    }

}

/* End of file Manager.php */
/* Location: ./application/controllers/Manager.php */

 ?>