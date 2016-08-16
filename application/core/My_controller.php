<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

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

    public function checkLogin()
    {
        if(!$this->session->userdata('manager')){
            redirect('login/index','refresh');
        }
    }

}

/* End of file My_controller.php */
/* Location: ./application/controllers/My_controller.php */

 ?>