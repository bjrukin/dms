<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PROJECT
 *
 * @package         PROJECT
 * @author          <AUTHOR_NAME>
 * @copyright       Copyright (c) 2016
 */
// ---------------------------------------------------------------------------

/**
 * Dispatch_records
 *
 * Extends the Project_Controller class
 * 
 */
class Dispatch_records extends Project_Controller {

    public function __construct() {
        parent::__construct();

        control('Dispatch Records');

        $this->load->model('dispatch_records/dispatch_record_model');
        $this->load->model('stock_records/Stock_record_model');
        $this->lang->load('dispatch_records/dispatch_record');
        $this->load->helper('common');
        $this->load->helper('barcode');
    }

    public function index() {
        // Display Page
        $data['header'] = lang('dispatch_records');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'dispatch_records';
        $this->load->view($this->_container, $data);
    }

    public function json() {
        $this->dispatch_record_model->_table = 'view_msil_dispatch_records';
        search_params();

        $total = $this->dispatch_record_model->find_count();

        paging('id');

        search_params();

        $rows = $this->dispatch_record_model->findAll();

        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }

    public function save() {

        $data = $this->_get_posted_data(); //Retrive Posted Data

        if (!$this->input->post('id')) {
            $success = $this->dispatch_record_model->insert($data);
        } else {
            $success = $this->dispatch_record_model->update($data['id'], $data);
        }

        if ($success) {
            $success = TRUE;
            $msg = lang('general_success');
        } else {
            $success = FALSE;
            $msg = lang('general_failure');
        }

        echo json_encode(array('msg' => $msg, 'success' => $success));
        exit;
    }

    private function _get_posted_data() {
        $data = array();
        if ($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
        }
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['variant_id'] = $this->input->post('variant_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['engine_no'] = $this->input->post('engine_no');
        $data['chass_no'] = $this->input->post('chass_no');
        $data['dispatch_date'] = $this->input->post('dispatch_date');
        $data['month'] = $this->input->post('month');
        $data['year'] = $this->input->post('year');
        $data['order_no'] = $this->input->post('order_no');
        $data['ait_reference_no'] = $this->input->post('ait_reference_no');
        $data['invoice_no'] = $this->input->post('invoice_no');
        $data['invoice_date'] = $this->input->post('invoice_date');
        $data['transit'] = $this->input->post('transit');
        $data['indian_stock_yard'] = $this->input->post('indian_stock_yard');
        $data['indian_custom'] = $this->input->post('indian_custom');
        $data['nepal_custom'] = $this->input->post('nepal_custom');
        //$data['border'] = $this->input->post('border');
        $data['barcode'] = $this->input->post('barcode');

        return $data;
    }

    function read_file() {
        $config['upload_path'] = './uploads/msil_dispatch_record';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/msil_dispatch_record/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];
//        $file = FCPATH . 'uploads/msil_dispatch_record/testvalidrecord34.xlsx'; //$_FILES['fileToUpload']['tmp_name'];
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line
        $index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year');
//        $index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','transit','indian_stock_yard','indian_custom','nepal_custom','stock_yard','reached_date');
        $raw_data = array();
        $data = array();
        $view_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
//                print_r($highestColumnIndex);
                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($cell)) {
                            $val = date($format = "Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($val));
                        }
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }
//         echo '<pre>';print_r($raw_data);
        foreach ($raw_data as $key => $value) {
            $this->db->select('id');
            $this->db->from('mst_vehicles');
            $this->db->where('name', $value['vehicle_name']);
            $vehicle = $this->db->get()->row_array();
//            echo '<pre>';
//            print_r($this->db->last_query());
//            print_r($value['chass_no']);
//            print_r($vehicle);
            $data[$key]['vehicle_id'] = $vehicle['id'];
            $color = $this->db->from('mst_colors')->where('code', $value['color'])->get()->row_array();
            $data[$key]['color_id'] = $color['id'];
            $variant = $this->db->from('mst_variants')->where('name', $value['variant'])->get()->row_array();
            $data[$key]['variant_id'] = $variant['id'];
            $data[$key]['month'] = $value['month'];
            $data[$key]['year'] = $value['year'];
            $data[$key]['created_by'] = $this->session->userdata('id');
            $data[$key]['created_at'] = date("Y-m-d H:i:s");
            $data[$key]['dispatch_date'] = $value['dispatch_date'];
            $data[$key]['order_no'] = $value['order_no'];
            $data[$key]['chass_no'] = $value['chass_no'];
            $data[$key]['engine_no'] = $value['engine_no'];
            $data[$key]['ait_reference_no'] = $value['ait_reference_no'];
            $data[$key]['invoice_no'] = $value['invoice_no'];
            $data[$key]['invoice_date'] = $value['invoice_date'];
            $data[$key]['month'] = $value['month'];
            $data[$key]['year'] = $value['year'];
            /*for data entry only*/
//            $data[$key]['transit'] = $value['transit'];
//            $data[$key]['indian_stock_yard'] = $value['indian_stock_yard'];
//            $data[$key]['indian_custom'] = $value['indian_custom'];
//            $data[$key]['nepal_custom'] = $value['nepal_custom'];
//             $this->load->model('stock_yards/stock_yard_model');
//             $this->load->model('stock_records/stock_record_model');
//            $temp['vehicle_id'] = $this->dispatch_record_model->insert($data[$key]);
            
//            $stockyard = $value['stock_yard'];
//            $this->db->where('name',$stockyard);
////            print_r($value);
//            if($stockyard != ''){
//                $stockyard_detail = $this->stock_yard_model->findAll();
//    //            print_r($stockyard_detail);
//                $temp['stock_yard_id'] = $stockyard_detail[0]->id;
//            }
//            $temp['reached_date'] = $value['reached_date'];
//            $temp['dispatched_date'] = $value['reached_date'];
//            
//            $dealer_dispatched_id = $this->stock_record_model->insert($temp);
            
            
        }
        
        $this->db->trans_start();
        $this->db->insert_batch('msil_dispatch_records', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            // echo 'here error';
        } else {
            $this->db->trans_commit();
            // echo 'success';
        }
        $this->db->trans_complete();
        $referred_from = $this->session->userdata('referred_from');
        redirect($referred_from, 'refresh');
    }

//    for track
    public function track() {
        $success = FALSE;
        $msg = lang('general_failure');
//print_r($this->input->post());exit;
        if ($this->input->post('label')) {
            $data['id'] = $this->input->post('id');
            $data['transit'] = 1;
            $data[$this->input->post('label')] = $this->input->post('date');
            if ($this->input->post('barcode')) {
                $data['barcode'] = $this->input->post('barcode');
            }
//        if($this->input->post('vehicle_id')){
//            $success = $this->dispatch_reco
//        }else{
            $success = $this->dispatch_record_model->update($data['id'], $data);
//        }
        }
        if ($this->input->post('label') == 'nepal_custom') {
            $value['vehicle_id'] = $this->input->post('id');
            $value['stock_yard_id'] = $this->input->post('stock_yard_id');
            $value['reached_date'] = date('Y-m-d H:i:s');
            $this->db->where('vehicle_id', $data['id']);
            $stock = $this->Stock_record_model->getAll();
//        print_r($stock[0]->id);exit;
            if (count($stock) == 0) {
                $this->Stock_record_model->insert($value);
            } else {
                $value['id'] = $stock[0]->id;
                $test = $this->Stock_record_model->update($value['id'], $value);
            }
        }

        if ($success) {
            $success = TRUE;
            $msg = lang('general_success');
        }
        echo json_encode(array('msg' => $msg, 'success' => $success));
        exit;
    }

    public function barcode() {
        $value['id'] = $this->input->post('dispatch_id');
        $this->db->where('id', $value['id']);
        $this->db->select('engine_no');
        $data = $this->dispatch_record_model->findAll();

//        $text_barcode = $data['0']->engine_no . '-' . $data['0']->chass_no;
        $text_barcode = $data['0']->engine_no;
        $value['barcode'] = $text_barcode;

        $this->dispatch_record_model->update($value['id'], $value);

        $barcodes = $this->_generateBarCodes($text_barcode);

        echo json_encode(array('barcode' => $barcodes));
    }

    private function _generateBarCodes($text_barcode) {
        $barcodes = '';
        $text = $text_barcode;
        $dest = "assets/barcodes/" . $text . ".jpg";
        Barcode39($text, $text, $dest, 220, 120);
        $barcodes = $text;
        return $barcodes;
    }

}
