<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configure extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('manager_model');
        $this->page_titles = array(
            'profile'=>'个人资料',
            'changepwd'=>'修改密码'
        );
    }

    public function changepwd()
    {
    	$view_data = array();
    	$view_data['page_title'] = $this->page_titles['changepwd'];
    	$this->validate_pwd();
        if($this->form_validation->run() == True){
    		$post_data = $this->input->post();
    		$pwd = $post_data['pwd'];
    		$update_result = $this->manager_model->updatepwd($pwd);
    		if($update_result){
    			$view_data['msg'] ='修改密码成功';
    		}else{
    			$view_data['msg'] ='修改密码失败';
    		}
        }
    	$this->load_template( 'config_changepwd', $view_data );
    }

    public function validate_pwd()
    {
    	$rules = 'trim|required|xss_clean|min_length[6]|max_length[16]|alpha_dash';
    	$rules_old = $rules . '|callback_oldpassword_check';
    	$rules_pwd1 = 'required|matches[pwd]';
        $this->form_validation->set_rules('oldpwd', '旧密码', $rules_old);
        $this->form_validation->set_rules('pwd', '新密码', $rules);
        $this->form_validation->set_rules('pwd1', '再次输入请密码',$rules_pwd1);
    }

    public function oldpassword_check($oldpwd)
    {
    	$checkold = $this->manager_model->checkoldpwd($oldpwd);
    	if($checkold){
    		return True;
    	}else{
    		$this->form_validation->set_message('oldpassword_check', '{field} 错误');
    		return false;
    	}
    }

    public function profile()
    {
        $view_data = $this->manager_model->get_manager_by_id($this->manager_id);
        $view_data['page_title'] = $this->page_titles['profile'];
        $this->validate_profile();
        if($this->form_validation->run() == True){
            $data = $this->input->post();
            if ($this->manager_model->update($data,$this->manager_id)) {
            	$view_data = array_merge($view_data,$data);
            	$view_data['msg'] = "修改个人资料失败";
            }else{
            	$view_data['msg'] = "修改个人资料失败";
            }
        }

        $this->load_template('config_profile',$view_data);
        return true;
    }


    public function validate_profile()
    {
        $this->form_validation->set_rules('name', '用户名称', 'trim|required|xss_clean|min_length[2]|max_length[40]');
        $this->form_validation->set_rules('mobile', '手机号码', 'trim|required|xss_clean|max_length[14]|alpha_dash');
        $this->form_validation->set_rules('qq', 'QQ', 'trim|required|xss_clean|max_length[13]|numeric');
        $this->form_validation->set_rules('email', '邮箱', 'trim|xss_clean|max_length[40]|valid_email');
    }
}

 ?>