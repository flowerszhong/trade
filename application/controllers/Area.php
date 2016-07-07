<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends My_Controller {
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load_template('area_index');
    }

}

/* End of file Area.php */
/* Location: ./application/controllers/Area.php */
 ?>