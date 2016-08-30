<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->model('manager_model');
        date_default_timezone_set('Asia/Chongqing');
    }

    public function index(){
    	$post = $this->input->post();
    	if(!$post){
        	$this->load->view('login_index');
        	return true;
    	}

    	$this->form_validation->set_rules('username', '账号名称', 'trim|required|xss_clean|min_length[3]|max_length[20]');
    	$this->form_validation->set_rules('password', '密码', 'trim|required|xss_clean|min_length[6]|max_length[20]');

    	if($this->form_validation->run() == True){
    		$username = $post['username'];
    		$pwd = $post['password'];
            $login_data = $this->manager_model->checkLogin($username,$pwd);
    	    if (!$login_data) {
                $view_data = array('error'=>'账号或密码不正确');
    	        $this->load->view('login_index',$view_data);
    	    }else{
                $this->session->set_userdata('manager',$login_data);
    	        redirect('price/index','refresh');
    	    }
    	}else{
    		$this->load->view('login_index');
    	}
    }

    public function logout()
    {
        $this->session->unset_userdata('manager');
        redirect('login/index','refresh');
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */

 ?>