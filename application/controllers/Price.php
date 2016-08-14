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
        );
    }

    public function index($id=null)
    {
        $view_data = array();
        $prices = $this->price_model->select_all($id);
        $view_data['prices'] = $prices;
        $view_data['page_title'] = $this->page_titles['index'];
        $this->load_template('price_index',$view_data);
    }

    public function create($company_id = null){
        $view_data = array();
        $view_data['page_title'] = $this->page_titles['create'];
        $view_data['agents'] = $this->agent_model->select_agent();

        if(!$this->input->post()){
            $this->load_template('price_create',$view_data);
            return true;
        }

        $config = array();
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'xls|xlsx|csv';

        $this->load->library('upload', $config);

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
           $data = $this->parseXLS($upload_data);
           if($data && isset($data['errors'])){
                $view_data['errors'] = $data['errors'];
                $this->load_template( 'price_create', $view_data );
                return;
           }
           $data['channel'] = $post_data['ctype'];
           $data['cname'] = $post_data['cname'];
           $company_ids = $post_data['company_id'];

           $insert_result = $this->price_model->insert_price($data,$company_ids);
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
        $query_result = $this->agent_model->remove_agent($id);
        if($query_result){
            redirect('agent/index','refresh');
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

    public function query()
    {
        $view_data = array();
        $view_data['page_title'] = $this->page_titles['query'];
        $this->load_template('price_query',$view_data);
    }

    public function ajax()
    {
        $post_data = $this->input->post();
        $ret = array(
            'ok'=>false,
        );
        if($post_data['area']){
            $price_data = $this->price_model->get_latest();
            $firstrow = $price_data['firstrow'];
            $firstcol = $price_data['firstcol'];
            $pricedata = $price_data['pricedata'];
            $weight = $post_data['weight'];
            $area = $post_data['area'];
            $state = $post_data['state'];
            // var_dump($pricedata);

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


}

/* End of file Agent.php */
/* Location: ./application/controllers/Agent.php */
 ?>