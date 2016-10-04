<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('price_model');
        $this->load->model('agent_model');
        $this->load->model('area_model');
        $this->page_titles = array(
            'index'=>'报价列表',
            'create'=>'新增报价',
            'detail'=>'报价明细',
            'query'=>'报价查询',
            'history'=>'报价查询记录',
            'edit'=>'编辑报价',
        );
    }

    public function index23($id=null)
    {
        $view_data = array();
        $prices = $this->price_model->select_all($id);
        $view_data['prices'] = $prices;
        $view_data['page_title'] = $this->page_titles['index'];
        $this->load_template('price_index',$view_data);
    }

    public function index() {
        $this->checkPermission();
        $this->load->library('pagination');
        $config = array();
        // $this->config->load('pagination');
        $config["base_url"] = site_url('price/index');
        $config["total_rows"] = $this->price_model->record_count();
        $config["per_page"] = 15;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['agents'] = $this->agent_model->get_all_company();
        $data["prices"] = $this->price_model->
            fetch_prices($config["per_page"], $page);
        $data['page_title'] = $this->page_titles['index'];
        $this->load_template('price_index',$data);
    }

    public function company($company_id) {
        $this->load->library('pagination');
        $config = array();
        // $this->config->load('pagination');
        $config["base_url"] = site_url("price/index/$company_id");
        $config["total_rows"] = $this->price_model->record_count($company_id);
        $config["per_page"] = 15;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['agents'] = $this->agent_model->get_all_company();
        $data["prices"] = $this->price_model->
            fetch_prices_by_company($config["per_page"], $page,$company_id);
        $data['page_title'] = $this->page_titles['index'];
        $this->load_template('price_index',$data);
    }



    public function upload_config()
    {
        $config = array();
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'xls|xlsx';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
    }

    public function create($company_id = null){
        $view_data = array();
        $view_data['page_title'] = $this->page_titles['create'];
        $view_data['agents'] = $this->agent_model->get_all_company();

        if(!$this->input->post()){
            if($company_id){
                $view_data['company_id'] = $company_id;
            }
            $this->load_template('price_create',$view_data);
            return true;
        }

        $this->form_validation->set_rules('cname', '报价名称', 'trim|required|xss_clean|min_length[2]|max_length[24]');
        $this->form_validation->set_rules('company_id[]', '关联公司', 'trim|required');

        if($this->form_validation->run() == False){
            $this->load_template('price_create',$view_data);
            return true;
        }

        
        $this->upload_config();

        $post_data = $this->input->post();


        if ( ! $this->upload->do_upload('pricetable'))
        {
           $errors = $this->upload->display_errors();
           $view_data['errors'] = $errors;
           $this->load_template( 'price_create', $view_data );
        }
        else
        {
           $upload_data = $this->upload->data();
           $file_name = $upload_data['file_name'];
           $data = $this->parseXLS($upload_data);
           if($data && isset($data['errors'])){
                $view_data['errors'] = $data['errors'];
                $this->load_template( 'price_create', $view_data );
                return;
           }
           // $data['channel'] = $post_data['ctype'];
           $data['cname'] = $post_data['cname'];
           $data['filename'] = $file_name;
           $data['company_id'] = $post_data['company_id'];
           // $company_ids = $post_data['company_id'];

           $insert_result = $this->price_model->insert_price($data);
           if($insert_result){
                redirect('price/index','refresh');
                //$this->load_template('price_result',array('page_title'=>'新增报价成功','msg'=>'新增报价成功'));
           }else{
                $this->load_template('price_result',array('page_title'=>'新增报价失败','msg'=>'新增报价失败'));
           }

        }
    }


    public function edit($price_id=null)
    {
        $view_data = array();
        $view_data['page_title'] = $this->page_titles['create'];
        $this->page_title = $this->page_titles['edit'];
        if($this->manager_power<10 or is_null($price_id)){
            redirect('price/index','refresh');
        }

        if(!$this->input->post()){
            $price_data = $this->price_model->get_price_by_id($price_id);
            $price_data['page_title'] = $this->page_titles['edit'];
            $this->load_template( 'price_edit', $price_data );
            return true;
        }

        $this->form_validation->set_rules('cname', '报价名称', 'trim|required|xss_clean|min_length[2]|max_length[24]');

        if($this->form_validation->run() == False){
            $price_data = $this->price_model->get_price_by_id($price_id);
            $price_data['page_title'] = $this->page_titles['edit'];
            $this->load_template( 'price_edit', $price_data );
            return true;
        }

        $post_data = $this->input->post();
        $cname = $post_data['cname'];
        if (empty($_FILES['pricetable']['name'])) {
            $data = array();
            $data['cname'] = $cname;
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->price_model->update($price_id,$data);
        }else{
            $this->upload_config();
            if ( ! $this->upload->do_upload('pricetable'))
            {
               $errors = $this->upload->display_errors();
               $view_data['errors'] = $errors;
               $this->load_template( 'price_edit', $view_data );
            }
            else
            {
               $upload_data = $this->upload->data();
               $file_name = $upload_data['file_name'];
               $data = $this->parseXLS($upload_data);
               if($data && isset($data['errors'])){
                    $view_data['errors'] = $data['errors'];
                    $this->load_template( 'price_edit', $view_data );
                    return;
               }
               $data['cname'] = $post_data['cname'];
               $data['filename'] = $file_name;
               $data['update_date'] = date('Y-m-d H:i:s');
            }
        }

        $update_result = $this->price_model->update($price_id,$data);
        if($update_result){
             // $this->load_template('price_result',array('page_title'=>'编辑报价成功','msg'=>'编辑报价成功'));
            redirect("price/index",'refresh');
        }else{
             $this->load_template('price_result',array('page_title'=>'编辑报价失败','msg'=>'编辑报价失败'));
        }

    }

    public function update($id)
    {
        if(!$this->input->post()){
            redirect("price/edit/$id",'refresh');
        }

        $this->form_validation->set_rules('cname', '报价名称', 'trim|required|xss_clean|min_length[2]|max_length[24]');

        if($this->form_validation->run() == False){
            $view_data = $this->price_model->get_price_by_id($id);
            $this->load_template( 'price_edit', $view_data );
            return true;
        }

        
        $this->upload_config();

        $post_data = $this->input->post();

        if (empty($_FILES['pricetable']['name'])) {

        }

        if ( ! $this->upload->do_upload('pricetable'))
        {
           $errors = $this->upload->display_errors();
           $view_data['errors'] = $errors;
           $this->load_template( 'price_create', $view_data );
        }
        else
        {
           $upload_data = $this->upload->data();
           $file_name = $upload_data['file_name'];
           $data = $this->parseXLS($upload_data);
           if($data && isset($data['errors'])){
                $view_data['errors'] = $data['errors'];
                $this->load_template( 'price_create', $view_data );
                return;
           }
           // $data['channel'] = $post_data['ctype'];
           $data['cname'] = $post_data['cname'];
           $data['filename'] = $file_name;
           $data['company_id'] = $post_data['company_id'];
           // $company_ids = $post_data['company_id'];

           $insert_result = $this->price_model->insert_price($data);
           if($insert_result){
                $this->load_template('price_result',array('page_title'=>'新增报价成功','msg'=>'新增报价成功'));
           }else{
                $this->load_template('price_result',array('page_title'=>'新增报价失败','msg'=>'新增报价失败'));
           }

        }
    }

    private function uploadError()
    {

    }


    public function parseXLS($upload_data)
    {

        $file = $upload_data['full_path'];

         
        //load the excel library
        $this->load->library('excel');
        $data = array();
         
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        $sheetCount = $objPHPExcel->getSheetCount();
        if($sheetCount < 2){
            $data['errors'] = '上传的报价单至少应当包含两个sheet';
            return $data;
        }
         
        //get only the Cell Collection
        //get sheet index 1 cell collection
        $cell_collection_1 = $objPHPExcel->getSheet(0)->getCellCollection();
        $cell_collection_2 = $objPHPExcel->getSheet(1)->getCellCollection();
         
        //extract to a PHP readable array format
        $first_row = array();
        $first_column = array();
        $price_data = array();
        $area_data = array();


        foreach ($cell_collection_1 as $cell) {
            $column = $objPHPExcel->getSheet(0)->getCell($cell)->getColumn();
            $row = $objPHPExcel->getSheet(0)->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getSheet(0)->getCell($cell)->getValue();
         
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $first_row[$column] = $data_value;
            } 
            if($column == 'A'){
                $first_column[$row] = $data_value;
            }
            if($row!==1){
                $price_data[$row][$column] = $data_value;
            }
        }

        

        foreach ($cell_collection_2 as $cell) {
            $column = $objPHPExcel->getSheet(1)->getCell($cell)->getColumn();
            $row = $objPHPExcel->getSheet(1)->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getSheet(1)->getCell($cell)->getValue();
            
            if($row!==1){
                $area_data[$row][$column] = $data_value;
            }
        }

        //send the data in an array format
        $data['firstrow'] = json_encode($first_row);
        $data['firstcol'] = json_encode($first_column);
        $data['pricedata'] = json_encode($price_data);
        $data['areadata'] = json_encode($area_data);

        return $data;
    }

    public function delete($id)
    {
        $query_result = $this->price_model->remove_price($id);
        if($query_result){
            redirect('price/index','refresh');
        }
    }

    public function detail($id)
    {
        $price_data = $this->price_model->get_detail($id);
        $view_data = array();

        $view_data['price_data'] = $price_data;
        $view_data['page_title'] = $this->page_titles['detail'];
        $this->load_template('price_detail',$view_data);

    }

    public function history()
    {
        $companies = $this->get_all_company();
        $view_data = array('companies'=>$companies);
        $view_data['page_title'] = $this->page_titles['history'];
        $this->load_template( 'price_history', $view_data );
    }

    public function query()
    {
        $companies = $this->get_all_company();
        $view_data = array('companies'=>$companies);
        $view_data['page_title'] = $this->page_titles['query'];
        $this->load_template('price_query',$view_data);
    }

    public function get_all_company()
    {
        $companies = $this->agent_model->get_all_company();
        return $companies;
    }

    //query price ajax request
    public function ajax()
    {
        $post = $this->input->post();
        $weight = $post['weight'];
        $state = $post['state'];
        $state_en = $post['state_en'];
        $json_data = array(
            'ok'=>false,
            'state'=>$state,
            'state_en'=>$state_en,
            'weight'=>$weight
        );
        $data = array();

        if(!$this->isSuperAdmin()){
            $post['company_id'] = $this->company_id;
        }

        if($state && is_numeric($weight)){
            $company_id = $post['company_id'];
            $query_data = $this->price_model->query_by_company($company_id);

            foreach ($query_data as $query_result) {
                $query_result = $this->jsontoarray($query_result);
                $firstrow = $query_result['firstrow'];
                $firstcol = $query_result['firstcol'];
                $pricedata = $query_result['pricedata'];
                $areadata = $query_result['areadata'];
                
                $area = $this->get_area($areadata,$state);
                if($area){
                    $col_index = $this->get_index($firstrow,$weight);
                    $row_index = $this->get_index($firstcol,$area);
                    $row = $pricedata->$row_index;
                    $cell = $row->$col_index;
                    if($cell){
                        $ret = array();
                        $ret['price']= $cell;
                        $ret['area']= $area;
                        $ret['cname']= $query_result['cname'];
                        $data[] = $ret;
                    }
                }

               
            }

            if(!$this->isSuperAdmin()){
                $this->logging($weight,$state);
            }
        }
        if(sizeof($data)>0){
            $json_data['data']=$data;
            $json_data['ok']=true;
        }
        echo json_encode($json_data);
    }

    public function logging($weight,$state)
    {
        $company_id = $this->company_id;
        $ip = $this->getIp();
        $record = array(
            'company_id'=>$company_id,
            'state'=>$state,
            'weight'=>$weight,
            'ip'=>$ip,
            );
        $this->price_model->logging($record);
    }

    private function jsontoarray($result)
    {
        $result['firstrow'] = json_decode($result['firstrow']);
        $result['firstcol'] = json_decode($result['firstcol']);
        $result['pricedata'] = json_decode($result['pricedata']);
        $result['areadata'] = json_decode($result['areadata']);
        return $result;
    }

    public function get_area($area,$state)
    {
        foreach ($area as $row) {
            if($row->B == $state){
                return $row->A;
            }
        }
    }

    private function getIp()
    {
        $ip = null;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function historyquery()
    {
        $post = $this->input->post();
        if($post){
            $limit = 15;
            $startdate = $post['startdate'];
            $enddate = $post['enddate'];
            $company_id = $post['company_id'];
            $start_page = $post['page'];
            $counts = $this->price_model->get_history_count($startdate,$enddate,$company_id);
            $records = $this->price_model->get_history($startdate,$enddate,$company_id,$limit,$start_page);

            $ret = array('pricedata'=>$records);

            $this->load->library('pagination');
            $config = array();
            // $this->config->load('pagination');
            $config["base_url"] = site_url('price/historyquery');
            $config["total_rows"] = $counts;
            $config["per_page"] = $limit;
            $config["uri_segment"] = 3;
            $config['use_page_numbers'] = TRUE;
            $this->pagination->initialize($config);
            $ret['pagination'] = $this->pagination->create_links();
            $ret['ok'] = true;

            echo json_encode($ret);
        }



    }

    //old code
    //useless
    public function ajax2()
    {
        $post = $this->input->post();
        $ret = array(
            'ok'=>false,
        );

        if($post['company_id'] && $post['state'] && $post['state_en'] and is_numeric($post['weight'])){
            $company_id = $post['company_id'];

            $price_data = $this->price_model->query_by_company($company_id);
            $firstrow = $price_data['firstrow'];
            $firstcol = $price_data['firstcol'];
            $pricedata = $price_data['pricedata'];
            $weight = $post_data['weight'];
            $area = $post_data['area'];
            $state = $post_data['state'];

            $col_index = $this->get_index($firstrow,$weight);
            $row_index = $this->get_index($firstcol,$area);
            $row = $pricedata->$row_index;
            $cell = $row->$col_index;
            $ret['ok'] = true;
            $ret['price']= $cell;
            $ret['weight']= $weight;
            $ret['area']= $area;
            $ret['state']= $state;
        }
        echo json_encode($ret);
    }


    private function get_index($data,$match){
        $match_key = null;
        foreach ($data as $key => $value) {
            if(is_numeric($value)){
                $match_key = $key;
                if($value >= $match){
                    break;
                }
            }else{
                continue;
            }
        }

        return $match_key;
    }


    public function ajax_area()
    {
        $result = $this->area_model->select_all();
        echo json_encode($result);
    }


    public function download($id)
    {
        $this->checkPermission();
        $price = $this->price_model->get_price_by_id($id);
        $filename = $price['filename'];
        $file_url = base_url('uploads/'. $filename);
        $type = pathinfo($file_url, PATHINFO_EXTENSION);
        $name = $price['shortname'] . '-' . $price['cname'] .'-' . $price['create_time'] . '.' . $type;

        header('Content-Description: File Transfer');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"".$name."\"");
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        ob_clean();
        flush();

        readfile($file_url);

        // exit();
    }


}

/* End of file Agent.php */
/* Location: ./application/controllers/Agent.php */
 ?>