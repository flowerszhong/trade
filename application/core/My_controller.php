<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->checkLogin();
        date_default_timezone_set('Asia/Chongqing');
    }

    public function load_template($view_name,$view_data = null ){
        $main_content = $this->load->view($view_name, $view_data, true);
        $data=array('main_content'=>$main_content);
        $this->load->view('template',$data);
    }

    public function checkPermission()
    {
        if($this->manager_power<10){
            redirect('price/index','refresh');
        }
    }

    public function checkLogin()
    {
        if(!$this->session->userdata('manager')){
            redirect('login/index','refresh');
        }else{
            $session_data = $this->session->userdata('manager');
            $this->manager_name = $session_data['name'];
            $this->manager_power = $session_data['power'];
            $this->company_id = $session_data['company_id'];
            $this->company_name = $session_data['shortname'];
        }
    }

}

/* End of file My_controller.php */
/* Location: ./application/controllers/My_controller.php */

 ?>