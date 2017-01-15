<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('remote_model');
    }

    public function index() {
        $data=array(
            'page_title'=>'运单查询',
            );
        $this->load_template('query_index',$data);
    }

    public function single()
    {
    	$post = $this->input->post();
    	$postid = $post['postid'];
        if(isset($post['type'])){
    	    $type=$post['type'];
        }else{
            $type=$this->check_com_type($postid);
        }

        if(!$type){
            echo "error";
            exit();
        }

    	// $url = "http://www.cn.dhl.com/shipmentTracking?AWB=7982591912&countryCode=cn&languageCode=zh&_=1434553475231";
    	$url = "http://www.kuaidi100.com/query?type=" . $type . "&postid=". $postid . "&id=1&valicode=&temp=0.5715253283269703";
    	$data = file_get_contents($url);
    	echo $data;
    }

    public function check_com_type($querystr)
    {
        $len = strlen($querystr);
        $ups = "1ZA2X2406743675748";
        $fedex = "643440921040";
        $dhl = "4071380110";

        if($len == strlen($ups)){
            return "ups";
        }

        if($len == strlen($fedex)){
            return "fedex";
        }
        if($len == strlen($dhl)){
            return "dhl";
        }

        return false;
    }

    public function remote()
    {
        $this->form_validation->set_message('either_or', '城市或邮编 必选其一');
        $this->form_validation->set_rules('country', '国家', 'trim|required|xss_clean');
        $this->form_validation->set_rules('code', '邮编', 'trim|callback_either_or[city]|xss_clean');
        $data = array('page_title'=>'偏远查询');
        $search = $this->input->post();
        if($this->form_validation->run() == True){
            $remotes = $this->remote_model->get_remote($search);
            $data['remotes'] = $remotes;
        }
        $this->load_template('query_remote',$data);
    }

    public function either_or($this_filed,$other_field)
    {
        return ($this_filed!= '' || $this->input->post($other_field) != '');
    }
}