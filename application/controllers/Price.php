<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('price_model');
        $this->load->model('agent_model');
        $this->page_titles = array(
            'index'=>'报价列表',
            'create'=>'新增渠道'
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

        var_dump($this->input->post());
        $config = array();
        $config['upload_path']      = './uploads/';
        $config['allowed_types']    = 'xls|xlsx|csv';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('pricetable'))
        {
           $error = array('error' => $this->upload->display_errors());
           var_dump($error);

           // $this->load->view('upload_form', $error);
        }
        else
        {
           $upload_data = $this->upload->data();
           $this->parseXLS($upload_data);

           // $this->load->view('upload_success', $data);
        }

        // $this->form_validation->set_rules('name', '标题', 'trim|required|xss_clean|min_length[2]|max_length[60]');
        // $this->form_validation->set_rules('description', '内容', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('officephone', '电话', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('address', '地址', 'trim|required|xss_clean');

        // if($this->form_validation->run() == True){
        //     $data = $this->input->post();
        //     $data['regdate'] = date("Y-m-d H:i:s");
        //     $data['available'] = 1;
        //     if (!$this->agent_model->create($data)) {
        //         return false;
        //     }else{
        //         redirect('price/index','refresh');
        //     }
        // }

    }


    public function parseXLS($upload_data)
    {

        $file = './files/test.xlsx';
        $file = $upload_data['full_path'];

         
        //load the excel library
        $this->load->library('excel');
         
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
         
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
         
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
         
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
         
        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;
        var_dump($data);
    }

    public function delete($id)
    {
        $query_result = $this->agent_model->remove_agent($id);
        if($query_result){
            redirect('agent/index','refresh');
        }
    }

}

/* End of file Agent.php */
/* Location: ./application/controllers/Agent.php */
 ?>