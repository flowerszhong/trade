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

        if($this->input->get('query')){
            $get = $this->input->get();
            if($this->manager_power<100){
                $get['company'] = $this->company_id;
            }

            $base_url = site_url('waybill/index');
            $config = $this->config_pagination($base_url,$get);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $query_data = $this->waybill_model->get_waybills($get,$config['per_page'],$page);
            $data['query_data'] = $query_data;
        }
        $data['companies'] = $companies;
        $this->load_template('waybill_index',$data);
    }

    public function manage()
    {
        $this->load->library('pagination');
        $data = array('page_title'=>'运单管理');
        $this->upload_config();

        $companies = $this->agent_model->get_companies_name();
        $data['companies'] = $companies;

        if($this->input->post('uploaded')){
            $upload_data = $this->do_upload();
            if(is_array($upload_data)){
                //为上传数据添加业务数据
                //关联公司id
                $upload_data = $this->associate_company($upload_data,$companies);
                $data['xls'] = $upload_data;
            }else{
                $data['upload_error'] = $upload_data;
            }
        }

        if($this->input->get('export')){
            $this->export($this->input->get());
        }

        if($this->input->get('query')){
            $get = $this->input->get();
            $base_url = site_url('waybill/manage');
            $config = $this->config_pagination($base_url,$get);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $query_data = $this->waybill_model->get_waybills($get,$config['per_page'],$page);
            $data['query_data'] = $query_data;
        }
        
        $this->load_template('waybill_manage',$data);
    }


    public function config_pagination($base_url,$get)
    {
        $this->load->library('pagination');
        $config = array();
        // $this->config->load('pagination');
        $config["base_url"] = $base_url;
        if (count($get) > 0) {
            $config['suffix'] = '?' . http_build_query($get, '', "&");
        }
        $config['first_url'] = $base_url . '?' . http_build_query($get, '', "&query=true");
        $config["total_rows"] = $this->waybill_model->record_count($get);
        $config["per_page"] = 15;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        return $config;
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

    public function associate_company($upload_data,$companies)
    {
        $ret = array();
        foreach ($upload_data as $index => $row) {
            $ret[] = array(
                'starttime'       => $row['A'],
                'customer_com'    => $row['B'],
                'manager'         => $row['C'],
                'num'             => $row['D'],
                'transport_num'   => $row['E'],
                'destination'     => $row['F'],
                'com'             => $row['G'],
                'amount'          => $row['H'],
                'weight'          => $row['I'],
                'price'           => $row['J'],
                'fee'             => $row['K'],
                'agent_com'       => $row['L'],
                'cost'            => $row['M'],
                'profit'          => $row['N'],
                'remarks'         => $row['O'],
                'state'           => $row['P'],
                'customer_com_id' => $this->get_com_id($row['B'],$companies),
            );
        }

        // $keys = array(
        //     'A' => 'starttime',
        //     'B' => 'customer_com',
        //     'C' => 'manager',
        //     'D' => 'num',
        //     'E' => 'transport_num',
        //     'F' => 'destination',
        //     'G' => 'com',
        //     'H' => 'amount',
        //     'I' => 'weight',
        //     'J' => 'price',
        //     'K' => 'fee',
        //     'L' => 'agent_com',
        //     'M' => 'cost',
        //     'N' => 'profit',
        //     'O' => 'remarks',
        //     'P' => 'state',
        // );

        return $ret;

    }

    function get_com_id($com,$coms)
    {
        if(empty($com) || empty($coms)){
            return null;
        }

        foreach ($coms as $key => $com_data) {
            if($com_data['shortname'] == $com || $com_data['name'] == $com || $com_data['code'] == $com){
                return $com_data['id'];
            }
        }

        return null;

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

        for ($i=2; $i <= $max_row ; $i++) { 
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

    public function query_ajax_handle()
    {
        
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