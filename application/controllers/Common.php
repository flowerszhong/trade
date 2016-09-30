<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent_model');
        $this->load->model('price_model');
        $this->load->model('manager_model');
        $this->checkPermission();
    }

    public function check_duplicate() {
        $post = $this->input->post();
        $type = $post['type'];
        $field = $post['field'];
        $value = $post['value'];
        $model_type = $type . '_model';
        $ret = $this->$model_type->checkDuplicate($field,$value);
        echo json_encode($ret);
    }

}

/* End of file Common.php */
/* Location: ./application/controllers/Common.php */
 ?>