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
    public function index()
    {
        $view_data = array();
        $view_data['managers'] = $this->manager_model->select_all($this->isSuperAdmin());
        $view_data['page_title']= $this->page_titles['index'];
        $this->load_template('manager_index',$view_data);
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


    public function validate_manager()
    {
        $this->form_validation->set_rules('name', '用户名称', 'trim|required|xss_clean|min_length[2]|max_length[40]');
        $this->form_validation->set_rules('username', '登录账号', 'trim|required|min_length[4]|max_length[20]|xss_clean|alpha_dash');
        $this->form_validation->set_rules('pwd', '登录密码', 'trim|xss_clean|min_length[6]|max_length[16]|alpha_dash');
        $this->form_validation->set_rules('company_id', '关联公司', 'trim|xss_clean|required');
        $this->form_validation->set_rules('mobile', '手机号码', 'trim|required|xss_clean|max_length[14]|alpha_dash');
        $this->form_validation->set_rules('qq', 'QQ', 'trim|required|xss_clean|max_length[13]|numeric');
        $this->form_validation->set_rules('email', '邮箱', 'trim|xss_clean|max_length[40]|valid_email');
    }

    public function edit($id)
    {
        $view_data = $this->manager_model->get_manager_by_id($id);
        $view_data['page_title'] = $this->page_titles['edit'];
        $view_data['agents'] = $this->agent_model->get_all_company();
        if(!$this->input->post()){
            $this->load_template('manager_edit',$view_data);
            return true;
        }
        $this->validate_manager();
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
                $data['page_title'] = $this->page_titles['edit'];
                $data['edit_result'] = "编辑成功";
                $data['id']=$id;
                $this->load_template('manager_edit',$data);
                return true;
            }
        }

        $this->load_template('manager_edit',$view_data);
        return true;
    }

}

/* End of file Manager.php */
/* Location: ./application/controllers/Manager.php */

 ?>