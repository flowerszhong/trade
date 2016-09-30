<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hscode extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data=array('page_title'=>'商品编码');
        $this->load_template('hscode_index',$data);
    }
}