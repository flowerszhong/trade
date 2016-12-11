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
            $post = $this->input->post();
            if($this->manager_power<100){
                $company = $this->company_id;
            }else{
                $company = $post['company'];
            }
            if(!empty($company)){
                $company_string = $this->get_company_titles($company);
                $post['company']= $company_string;
            }
            $query_data = $this->waybill_model->get_waybills($post);
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
            $post = $this->input->post();
            $company = $post['company'];
            if(!empty($company)){
                $company_string = $this->get_company_titles($company);
                $post['company']= $company_string;
            }
            $query_data = $this->waybill_model->get_waybills($post);
            $data['query_data'] = $query_data;
        }

        $companies = $this->agent_model->get_all_company();
        $data['companies'] = $companies;
        $this->load_template('waybill_manage',$data);
    }

    public function get_company_titles($company)
    {
        $company_string = $this->agent_model->get_company_titles($company);
        return $company_string;
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
        error_reporting(0);
        $this->load->library('excel');
        $this->load->library('IOfactory');
 
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

        $states = array(
            '1'=>'已提货',
            '3'=>'暂扣',
            '5'=>'已上网',
            '7'=>'已提取',
            '9'=>'在途中',
            '11'=>'派送中',
            '13'=>'已签收'
        );
            
        foreach($query_data as $data)
        {
            $col = 0;
            foreach ($fields as $key => $field)
            {
                $_data = $data[$key];
                if($key == 'state'){
                    $_data = $states[$_data];
                }

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

    public function parseXLS($upload_data)
    {
        $file = $upload_data['full_path'];
        //load the excel library
        $this->load->library('excel');
        $data = array();
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $current_sheet = $objPHPExcel->getSheet(0);

        //get only the Cell Collection
        // $cell_collection = $objPHPExcel->getSheet(0)->getCellCollection();
         
        //extract to a PHP readable array format
        $xls_data = array();
        $maxCell = $objPHPExcel->getSheet(0)->getHighestRowAndColumn();
        $max_col = 16;
        $max_row = $maxCell['row'];

        for ($i=2; $i < $max_row ; $i++) { 
            for ($j=0; $j < $max_col; $j++) { 
                $cell = $current_sheet->getCellByColumnAndRow($j,$i);
                $column = $cell->getColumn();
                $data_value = $cell->getValue();
                if($column == 'A'){
                    $data_value = PHPExcel_Style_NumberFormat::toFormattedString($data_value,'YYYY-MM-DD' );
                }
                $xls_data[$i][$column] = $data_value;
            }
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