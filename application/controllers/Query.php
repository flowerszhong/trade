<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data=array('page_title'=>'运单查询');
        $this->load_template('query_index',$data);
    }

    public function single()
    {
    	$post = $this->input->post();
    	$postid = $post['postid'];
    	$type=$post['type'];
    	// $url = "http://www.cn.dhl.com/shipmentTracking?AWB=7982591912&countryCode=cn&languageCode=zh&_=1434553475231";
    	$url = "http://www.kuaidi100.com/query?type=" . $type . "&postid=". $postid . "&id=1&valicode=&temp=0.5715253283269703";
    	$data = file_get_contents($url);
    	echo $data;
    }
}