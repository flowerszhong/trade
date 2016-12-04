<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waybill extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('waybill_model');
        $this->load->model('agent_model');
    }

    public function index()
    {
        $data = array('page_title'=>'运单列表');
        $companies = $this->agent_model->get_all_company();

        if($this->input->post('query')){
            $query_data = $this->waybill_model->get_waybills($this->input->post());
            $data['query_data'] = $query_data;
        }
        $data['companies'] = $companies;
        $this->load_template('waybill_index',$data);
    }

    public function manage()
    {
        $data = array('page_title'=>'运单管理');
        $this->upload_config();
        if($this->input->post('uploaded')){
            $upload_data = $this->do_upload();
            if(is_array($upload_data)){
                $data['xls'] = $upload_data;
            }else{
                $data['upload_error'] = $upload_data;
            }
        }

        if($this->input->post('export')){
            $this->export($this->input->post());
        }


        if($this->input->post('query')){
            $query_data = $this->waybill_model->get_waybills($this->input->post());
            $data['query_data'] = $query_data;
        }

        $companies = $this->agent_model->get_all_company();
        $data['companies'] = $companies;
        $this->load_template('waybill_manage',$data);
    }

    public function do_upload()
    {
        if (!$this->upload->do_upload('waybillupload')){
            $errors = $this->upload->display_errors();
            return $errors;
        }else{
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            if($file_name){
                $xls_data = $this->parseXLS($upload_data);
                return $xls_data;
                if($xls_data && isset($xls_data['errors'])){
                    $data['errors'] = $xls_data['errors'];
                    return;
                }
            }
            
        }
    }


    public function export($post)
    {
        // Starting the PHPExcel library
        $this->load->library('excel');
        $this->load->library('IOFactory');
 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = array(
            'starttime'=>'日期',
            'customer_com'=>'客户',
            'manager'=>'业务员',
            // 'signedtime'=>'签收时间',
            'num'=>'原单号',
            'transport_num'=>'转单号',
            'destination'=>'目的地',
            // 'departure'=>'送出地',
            'com'=>'渠道',
            'amount'=>'件数',
            'weight'=>'重量',
            'price'=>'单价',
            'fee'=>'运费',
            'agent_com'=>'代理',
            'cost'=>'运费成本',
            'profit'=>'利润',
            'remarks'=>'备注',
            'state'=>'当前状态'
        );
        $col = 0;
        $row = 1;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        $query_data = $this->waybill_model->get_waybills($post);

        foreach($query_data as $data)
        {
            $col = 0;
            foreach ($fields as $key => $field)
            {
                $_data = $data[$key];
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $_data);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
 
        // Sending headers to force the user to download the file
        // confirm no output before
        header('Content-Description: File Transfer');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8");
        header('Content-Disposition: attachment;filename="Waybill_'.date('Y-m-d').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
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

        $this->form_validation->set_rules('cname', '报价名称', 'trim|required|xss_clean|min_length[2]|max_length[24]|callback_duplication_name');
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


    public function parseXLS($upload_data)
    {
        $file = $upload_data['full_path'];
        //load the excel library
        $this->load->library('excel');
        $data = array();
         
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);

        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getSheet(0)->getCellCollection();
         
        //extract to a PHP readable array format
        $xls_data = array();
        $first_column = array();

        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getSheet(0)->getCell($cell)->getColumn();
            $row = $objPHPExcel->getSheet(0)->getCell($cell)->getRow();
            if($row==1){
                continue;
            }
            $data_value = $objPHPExcel->getSheet(0)->getCell($cell)->getValue();
            if($column == 'A'){
                $data_value = PHPExcel_Style_NumberFormat::toFormattedString($data_value,'YYYY-MM-DD' );
            }
            $xls_data[$row][$column] = $data_value;
        }
        
        return $xls_data;
    }


    public function upload_ajax_handle()
    {
        $waybill_data = $this->input->post('waybill_data');
        $result = $this->waybill_model->insert_batch($waybill_data);
        echo $result;
    }

    public function delete($id)
    {
        if(empty($id)){
            echo json_encode(array('ok'=>False));
            return;
        }else{
            $this->waybill_model->delete($id);
            echo json_encode(array('ok'=>True));
        }


    }


    public function queryupdate()
    {
        $waybill_data = $this->input->post('waybill_data');
        $result = $this->waybill_model->update_batch($waybill_data);
        echo $result;
    }

}

/* End of file Waybill.php */
/* Location: ./application/controllers/Waybill.php */
 ?>