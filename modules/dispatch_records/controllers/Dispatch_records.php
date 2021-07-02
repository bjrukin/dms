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

        control('Tracking');

        $this->load->model('dispatch_records/dispatch_record_model');
        $this->load->model('stock_records/Stock_record_model');
        // $this->load->model('stock_records/stock_record_model');
        
        $this->lang->load('dispatch_records/dispatch_record');
        $this->load->model('msil_orders/msil_order_model');
        $this->load->model('dispatch_dealers/dispatch_dealer_model');
        $this->load->model('dealer_orders/dealer_order_model');
        $this->load->model('dispatch_dealers/dispatch_dealer_model');
        $this->load->model('log_fuel_kms/log_fuel_km_model');

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
        $data = $this->_get_posted_data();
        // echo '<pre>'; print_r($data); exit;
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
        // $data['transit'] = $this->input->post('transit');
        $data['indian_stock_yard'] = $this->input->post('indian_stock_yard');
        // $data['indian_custom'] = $this->input->post('indian_custom');
        // $data['nepal_custom'] = $this->input->post('nepal_custom');
        $data['barcode'] = $this->input->post('barcode');

        return $data;
    }

    function normal_chars($string)
    {
        $string = htmlentities($string, ENT_QUOTES, 'UTF-8');
        $string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
        $string = preg_replace(array('~[^0-9a-z]~i', '~-+~'), ' ', $string);
        return trim($string);
    }

// CG working    
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
        $file = FCPATH . 'uploads/msil_dispatch_record/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','key_no','company_name','lc_number');
        $raw_data = array();
        $data = array();
        $view_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); 
                $highestColumn = $worksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
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

        // echo '<pre>'; print_r($raw_data); exit;

        foreach ($raw_data as $key => $value) {
            $this->db->select('id');
            $this->db->from('mst_vehicles');
            $this->db->where('name', trim($value['vehicle_name'], " ".chr(160).chr(194)));
            $vehicle = $this->db->get()->row_array();
            if(!$vehicle['id'])
            {
                echo 'Vehicle Invalid '.$value['vehicle_name'];
                exit;
            }
            $data[$key]['vehicle_id'] = $vehicle['id'];
            $color = $this->db->from('mst_colors')->where('code', trim($value['color'], " ".chr(160).chr(194)))->get()->row_array();
            if(!$color['id'])
            {
                echo 'Color Code Invalid '.$value['color'];
                exit;
            }
            $data[$key]['color_id'] = $color['id'];
            $company_name = $this->db->from('mst_firms')->where('prefix', trim($value['company_name'], " ".chr(160).chr(194)))->get()->row_array();
            if(!$company_name['id'])
            {
                echo 'Company Name Invalid '.$value['company_name'];
                exit;
            }
            $data[$key]['company_name'] = $company_name['id'];
            $variant = $this->db->from('mst_variants')->where('name', trim($value['variant'], " ".chr(160).chr(194)))->get()->row_array();
            if(!$variant['id'])
            {
                echo 'Variant Invalid '.$value['variant'];
                exit;
            }
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
            $data[$key]['current_location'] = 'Transit';
            $data[$key]['current_status'] = 'Transit';
            $data[$key]['key_no'] = $value['key_no'];
            $data[$key]['company_name'] = $value['company_name'];
            $data[$key]['lc_number'] = $value['lc_number'];
        }

        $this->msil_order_model->_table= 'view_msil_order_new';

        $this->db->order_by('order_id');
        $order = $this->msil_order_model->findAll(array('vehicle_received_status'=>0));
        $this->msil_order_model->_table= 'msil_orders';
        
        $car_array = array();
        foreach ($order as $key => $value) {
            $status = 0;
            $add_car = $value->received_quantity;
            foreach ($data as $k => $v) {
                if($v['vehicle_id'] == $value->vehicle_id && $v['variant_id'] == $value->variant_id && $v['color_id'] == $value->color_id && $v['company_name'] == $value->prefix) {
                    if(! in_array($k, $car_array)){
                        if($add_car < ($value->quantity - $value->cancel_quantity)) {
                            $add_car++;
                            $car_array[] = $k;
                        }
                        if(($value->quantity - $value->cancel_quantity) == $add_car) 
                        {
                            $status = 1;
                        }
                        else 
                        {
                            $status = 0;
                        }
                    }
                }
            }
            $msil['id'] = $value->id;
            $msil['received_quantity'] = $add_car;
            $msil['vehicle_received_status'] = $status;
            $this->msil_order_model->update($msil['id'],$msil);
        }

        $this->db->trans_start();
        $this->db->insert_batch('msil_dispatch_records', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        $this->db->trans_complete();
        $referred_from = $this->session->userdata('referred_from');
        redirect($referred_from, 'refresh');
    }

//CG Inventory
/*function read_file() {
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
$this->load->library('Excel');
$objPHPExcel = PHPExcel_IOFactory::load($file);
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$objReader->setReadDataOnly(false);
$objPHPExcel = $objReader->load($file); // error in this line
$index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','transit','indian_stock_yard','indian_custom','nepal_custom','stock_yard','reached_date','current_location','current_status');
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
foreach ($raw_data as $key => $value) {
$this->db->select('id');
$this->db->from('mst_vehicles');
$this->db->where('name', $value['vehicle_name']);
$vehicle = $this->db->get()->row_array();
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
$data[$key]['transit'] = $value['transit'];
$data[$key]['indian_stock_yard'] = $value['indian_stock_yard'];
$data[$key]['indian_custom'] = $value['indian_custom'];
$data[$key]['nepal_custom'] = $value['nepal_custom'];
$data[$key]['current_location'] = $value['current_location'];
$data[$key]['current_status'] = $value['current_status'];
$this->load->model('stock_yards/stock_yard_model');
$this->load->model('stock_records/stock_record_model');
$temp['vehicle_id'] = $this->dispatch_record_model->insert($data[$key]);

$stockyard = $value['stock_yard'];
$this->db->where('name',$stockyard);
$stockyard_detail = $this->stock_yard_model->findAll();
if(count($stockyard_detail) > 0){
$temp['stock_yard_id'] = $stockyard_detail[0]->id;
$temp['reached_date'] = $value['reached_date'];
// $temp['dispatched_date'] = $value['reached_date'];
}

$dealer_dispatched_id = $this->stock_record_model->insert($temp);


}

// commented for data entry only
// $this->db->trans_start();
// $this->db->insert_batch('msil_dispatch_records', $data);

// if ($this->db->trans_status() === FALSE) {
//     $this->db->trans_rollback();
//     // echo 'here error';
// } else {
//     $this->db->trans_commit();
//     // echo 'success';
// }
// $this->db->trans_complete();
$referred_from = $this->session->userdata('referred_from');
redirect($referred_from, 'refresh');
}
*/


//Dealer Stock
/* function read_file() {
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
$this->load->library('Excel');
$objPHPExcel = PHPExcel_IOFactory::load($file);
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$objReader->setReadDataOnly(false);
$objPHPExcel = $objReader->load($file); // error in this line
$index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','transit','indian_stock_yard','indian_custom','nepal_custom','stock_yard','reached_date','dispatched_date','dispatch_date_np','dealer_name','current_location','current_status');
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
// print_r($highestColumnIndex);
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

foreach ($raw_data as $key => $value) {
$this->db->select('id');
$this->db->from('mst_vehicles');
$this->db->where('name', $value['vehicle_name']);
$vehicle = $this->db->get()->row_array();
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
// for data entry only
$data[$key]['transit'] = $value['transit'];
$data[$key]['indian_stock_yard'] = $value['indian_stock_yard'];
$data[$key]['indian_custom'] = $value['indian_custom'];
$data[$key]['nepal_custom'] = $value['nepal_custom'];
$data[$key]['current_location'] = $value['current_location'];
$data[$key]['current_status'] = $value['current_status'];
$this->load->model('stock_yards/stock_yard_model');
$this->load->model('stock_records/stock_record_model');
// print_r($data[$key]);
$temp['vehicle_id'] = $this->dispatch_record_model->insert($data[$key]);

$stockyard = $value['stock_yard'];

$this->db->where('name',$stockyard);
$stockyard_detail = $this->stock_yard_model->findAll();
// echo '<pre>';print_r($stockyard_detail); exit;

if(count($stockyard_detail) > 0){
$temp['stock_yard_id'] = $stockyard_detail[0]->id;
$temp['reached_date'] = $value['reached_date'];
$temp['dispatched_date'] = $value['dispatched_date'];
$temp['dispatched_date_np'] = $value['dispatch_date_np'];
}
// print_r($temp);exit;
$dealer_dispatched_id = $this->stock_record_model->insert($temp);

$order_data['vehicle_id'] = $data[$key]['vehicle_id'];
$order_data['color_id'] = $data[$key]['color_id'];
$order_data['variant_id'] = $data[$key]['variant_id'];
$dispatch_dealer['vehicle_id'] = $order_data['vehicle_main_id'] = $temp['vehicle_id'];

$order_data['order_id'] = ($key) + 1;
$order_data['received_date'] = date('Y-m-d');
$order_data['quantity'] = 1;

$this->load->model('dealers/dealer_model');
$this->db->where('name',$value['dealer_name']);
$dealer = $this->dealer_model->find();

$order_data['dealer_id'] = @$dealer->id;

$this->load->model('dealer_orders/dealer_order_model');
$dispatch_dealer['dealer_order_id'] = $this->dealer_order_model->insert($order_data);
$dispatch_dealer['stock_yard_id'] = @$temp['stock_yard_id'];
$dispatch_dealer['dealer_id'] = @$dealer->id;
$this->load->model('dispatch_dealers/dispatch_dealer_model');
$this->dispatch_dealer_model->insert($dispatch_dealer);
// print_r($dispatch_dealer);


}

// commented for data entry only
// $this->db->trans_start();
// $this->db->insert_batch('msil_dispatch_records', $data);

// if ($this->db->trans_status() === FALSE) {
//     $this->db->trans_rollback();
//     // echo 'here error';
// } else {
//     $this->db->trans_commit();
//     // echo 'success';
// }
// $this->db->trans_complete();
$referred_from = $this->session->userdata('referred_from');
redirect($referred_from, 'refresh');
}*/


// CG Custom

/* function read_file() {
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
$this->load->library('Excel');
$objPHPExcel = PHPExcel_IOFactory::load($file);
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$objReader->setReadDataOnly(false);
$objPHPExcel = $objReader->load($file); // error in this line
$index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','transit','indian_stock_yard','indian_custom','nepal_custom','custom_name','current_location','current_status');
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
foreach ($raw_data as $key => $value) {
$this->db->select('id');
$this->db->from('mst_vehicles');
$this->db->where('name', $value['vehicle_name']);
$vehicle = $this->db->get()->row_array();
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
$data[$key]['transit'] = $value['transit'];
$data[$key]['indian_stock_yard'] = $value['indian_stock_yard'];
$data[$key]['indian_custom'] = $value['indian_custom'];
$data[$key]['nepal_custom'] = $value['nepal_custom'];
$data[$key]['custom_name'] = $value['custom_name'];
$data[$key]['current_location'] = $value['current_location'];
$data[$key]['current_status'] = $value['current_status'];
$this->load->model('stock_yards/stock_yard_model');
$this->load->model('stock_records/stock_record_model');
$temp['vehicle_id'] = $this->dispatch_record_model->insert($data[$key]);

// $stockyard = $value['stock_yard'];
// $this->db->where('name',$stockyard);
// $stockyard_detail = $this->stock_yard_model->findAll();
// if(count($stockyard_detail) > 0){
//     $temp['stock_yard_id'] = $stockyard_detail[0]->id;
//     $temp['reached_date'] = $value['reached_date'];
//     $temp['dispatched_date'] = $value['reached_date'];
// }

// $dealer_dispatched_id = $this->stock_record_model->insert($temp);


}

// commented for data entry only
// $this->db->trans_start();
// $this->db->insert_batch('msil_dispatch_records', $data);

// if ($this->db->trans_status() === FALSE) {
//     $this->db->trans_rollback();
//     // echo 'here error';
// } else {
//     $this->db->trans_commit();
//     // echo 'success';
// }
// $this->db->trans_complete();
$referred_from = $this->session->userdata('referred_from');
redirect($referred_from, 'refresh');
}*/

// bug fix
/* function read_file() {
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
$this->load->library('Excel');
$objPHPExcel = PHPExcel_IOFactory::load($file);
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$objReader->setReadDataOnly(false);
$objPHPExcel = $objReader->load($file); // error in this line
$index = array('chass_no','engdate','nep_date');
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
foreach ($raw_data as $key => $value) {
$chass_no = $value['chass_no'];
$data['dispatched_date'] = $value['engdate'];
$data['dispatched_date_np'] = $value['nep_date'];
$this->db->where('vehicle_id',$chass_no);
$this->db->update('log_dispatch_dealer',$data);
// $stockyard = $value['stock_yard'];
// $this->db->where('name',$stockyard);
// $stockyard_detail = $this->stock_yard_model->findAll();
// if(count($stockyard_detail) > 0){
//     $temp['stock_yard_id'] = $stockyard_detail[0]->id;
//     $temp['reached_date'] = $value['reached_date'];
//     $temp['dispatched_date'] = $value['reached_date'];
// }

// $dealer_dispatched_id = $this->stock_record_model->insert($temp);


}

// commented for data entry only
// $this->db->trans_start();
// $this->db->insert_batch('msil_dispatch_records', $data);

// if ($this->db->trans_status() === FALSE) {
//     $this->db->trans_rollback();
//     // echo 'here error';
// } else {
//     $this->db->trans_commit();
//     // echo 'success';
// }
// $this->db->trans_complete();
$referred_from = $this->session->userdata('referred_from');
redirect($referred_from, 'refresh');
}*/
//Update CG Stock
/*public function read_file()
{
    $this->db->select(max('order_id'));
    $order_id = $this->db->get('log_dealer_order')->result();
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
    $file = FCPATH . 'uploads/msil_dispatch_record/' . $data['upload_data']['file_name'];
    $this->load->library('Excel');
    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');

    $objReader->setReadDataOnly(false);
    $objPHPExcel = $objReader->load($file);
    $index = array('dealer_id','msil_id','stock_id');
    $raw_data = array();
    $data = array();
    $view_data = array();
    foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
        if ($key == 0) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
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
    
    foreach ($raw_data as $key => $value) {
        $data['id'] = $value['id'];
        $data['dealer_id'] = $value['dealer_id'];
        $data['vehicle_main_id'] = $value['msil_id'];
        $data['payment_status'] = 1;
        $data['vehicle_main_id'] = $value['msil_id'];
        $msil_vehicle = $this->dispatch_record_model->find(array('id'=>$data['vehicle_main_id']));
        $data['vehicle_id'] = $msil_vehicle->vehicle_id;
        $data['variant_id'] = $msil_vehicle->variant_id;
        $data['color_id'] = $msil_vehicle->color_id;
        $data['quantity'] = 1;
        $data['order_id'] = $order_id->order_id + 1;
        $this->dealer_order_model->insert($data);

        $dispatch['vehicle_id'] = $value['msil_id'];
        $dispatch['dealer_id'] = $value['dealer_id'];
        $dispatch['dispatched_date'] = date('Y-m-d');
        $dispatch['dispatched_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
        $dispatch['received_date'] = date('Y-m-d');
        $dispatch['received_date_nep'] = get_nepali_date(date('Y-m-d'),'nep');

        $dispatch_id = $this->dispatch_dealer_model->insert($dispatch);

        $stock['dispatch_id'] = $dispatch_id;
        $stock['id'] = $value['stock_id'];
        $this->stock_record->model->update()

        $this->change_current_location($value['msil_id'],$value['dealer_name'],'Bill');

        $stock_id = $this->Stock_record_model->find(array('vehicle_id'=>$value['id']),'id');
    }

    $referred_from = $this->session->userdata('referred_from');
    redirect($referred_from, 'refresh');
}
*/
//CG Inventory
/*function read_file() {
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
$this->load->library('Excel');
$objPHPExcel = PHPExcel_IOFactory::load($file);
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$objReader->setReadDataOnly(false);
$objPHPExcel = $objReader->load($file); // error in this line
$index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','transit','indian_stock_yard','indian_custom','nepal_custom','stock_yard','reached_date','current_location','current_status');
$raw_data = array();
$data = array();
$view_data = array();
foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
    if ($key == 0) {
        $worksheetTitle = $worksheet->getTitle();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn(); 
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $nrColumns = ord($highestColumn) - 64;
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
// print_r($raw_data);
// exit;
foreach ($raw_data as $key => $value) {
    $this->db->select('id');
    $this->db->from('mst_vehicles');
    $this->db->where('name', $value['vehicle_name']);
    $vehicle = $this->db->get()->row_array();
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
    $data[$key]['transit'] = $value['transit'];
    $data[$key]['indian_stock_yard'] = $value['indian_stock_yard'];
    $data[$key]['indian_custom'] = $value['indian_custom'];
    $data[$key]['nepal_custom'] = $value['nepal_custom'];
    $data[$key]['current_location'] = $value['current_location'];
    $data[$key]['current_status'] = $value['current_status'];
    $this->load->model('stock_yards/stock_yard_model');
    $this->load->model('stock_records/stock_record_model');
    $temp[$key]['vehicle_id'] = $this->dispatch_record_model->insert($data[$key]);

    $stockyard = $value['stock_yard'];
    $this->db->where('name',$stockyard);
    $stockyard_detail = $this->stock_yard_model->find();
    $temp[$key]['stock_yard_id'] = $stockyard_detail->id;
    $temp[$key]['reached_date'] = $value['reached_date'];
    
}
// echo '<pre>';
// print_r($temp);
// exit;
$dealer_dispatched_id = $this->stock_record_model->insert_many($temp);

// commented for data entry only
// $this->db->trans_start();
// $this->db->insert_batch('msil_dispatch_records', $data);

// if ($this->db->trans_status() === FALSE) {
//     $this->db->trans_rollback();
//     // echo 'here error';
// } else {
//     $this->db->trans_commit();
//     // echo 'success';
// }
// $this->db->trans_complete();
$referred_from = $this->session->userdata('referred_from');
redirect($referred_from, 'refresh');
}*/

/*public function read_file()
{
    $this->db->select('max(order_id) as order_id');
    $order_id = $this->db->get('log_dealer_order')->result();
    // echo $this->db->last_query();
    // echo '<pre>';
    // print_r($order_id[0]->order_id);
    // exit;
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
    $file = FCPATH . 'uploads/msil_dispatch_record/' . $data['upload_data']['file_name'];
    $this->load->library('Excel');
    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');

    $objReader->setReadDataOnly(false);
    $objPHPExcel = $objReader->load($file);
    $index = array('dealer_id','msil_id','stock_id','dealer_name');
    $raw_data = array();
    $data = array();
    $view_data = array();
    foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
        if ($key == 0) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
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
    
    foreach ($raw_data as $key => $value) {
        // $data['id'] = $value['id'];
        $data['dealer_id'] = $value['dealer_id'];
        $data['vehicle_main_id'] = $value['msil_id'];
        $data['payment_status'] = 1;
        $data['vehicle_main_id'] = $value['msil_id'];
        $msil_vehicle = $this->dispatch_record_model->find(array('id'=>$data['vehicle_main_id']));
        //echo '<pre>';
        // print_r($msil_vehicle);
        // exit;
        $data['vehicle_id'] = $msil_vehicle->vehicle_id;
        $data['variant_id'] = $msil_vehicle->variant_id;
        $data['color_id'] = $msil_vehicle->color_id;
        $data['quantity'] = 1;
        $data['order_id'] = $order_id[0]->order_id + 1;
        // print_r($data);
        // exit;
        $this->dealer_order_model->insert($data);

        $dispatch['vehicle_id'] = $value['msil_id'];
        $dispatch['dealer_id'] = $value['dealer_id'];
        $dispatch['dispatched_date'] = date('Y-m-d');
        $dispatch['dispatched_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
        $dispatch['received_date'] = date('Y-m-d');
        $dispatch['received_date_nep'] = get_nepali_date(date('Y-m-d'),'nep');

        $dispatch_id = $this->dispatch_dealer_model->insert($dispatch);

        $stock['dispatch_id'] = $dispatch_id;
        $stock['vehicle_id'] = $value['msil_id'];
        $stock['id'] = $value['stock_id'];
        $this->stock_record_model->update($stock['id'],$stock);

        $this->change_current_location($value['msil_id'],$value['dealer_name'],'Bill');

    }

    $referred_from = $this->session->userdata('referred_from');
    redirect($referred_from, 'refresh');
}*/
// CG Custom

/* function read_file() {
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
$this->load->library('Excel');
$objPHPExcel = PHPExcel_IOFactory::load($file);
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$objReader->setReadDataOnly(false);
$objPHPExcel = $objReader->load($file); // error in this line
$index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','transit','indian_stock_yard','indian_custom','nepal_custom','custom_name','current_location','current_status');
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
foreach ($raw_data as $key => $value) {
$this->db->select('id');
$this->db->from('mst_vehicles');
$this->db->where('name', $value['vehicle_name']);
$vehicle = $this->db->get()->row_array();
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
$data[$key]['transit'] = $value['transit'];
$data[$key]['indian_stock_yard'] = $value['indian_stock_yard'];
$data[$key]['indian_custom'] = $value['indian_custom'];
$data[$key]['nepal_custom'] = $value['nepal_custom'];
$data[$key]['custom_name'] = $value['custom_name'];
$data[$key]['current_location'] = $value['current_location'];
$data[$key]['current_status'] = $value['current_status'];
$this->load->model('stock_yards/stock_yard_model');
$this->load->model('stock_records/stock_record_model');
$temp['vehicle_id'] = $this->dispatch_record_model->insert($data[$key]);

// $stockyard = $value['stock_yard'];
// $this->db->where('name',$stockyard);
// $stockyard_detail = $this->stock_yard_model->findAll();
// if(count($stockyard_detail) > 0){
//     $temp['stock_yard_id'] = $stockyard_detail[0]->id;
//     $temp['reached_date'] = $value['reached_date'];
//     $temp['dispatched_date'] = $value['reached_date'];
// }

// $dealer_dispatched_id = $this->stock_record_model->insert($temp);


}

// commented for data entry only
// $this->db->trans_start();
// $this->db->insert_batch('msil_dispatch_records', $data);

// if ($this->db->trans_status() === FALSE) {
//     $this->db->trans_rollback();
//     // echo 'here error';
// } else {
//     $this->db->trans_commit();
//     // echo 'success';
// }
// $this->db->trans_complete();
$referred_from = $this->session->userdata('referred_from');
redirect($referred_from, 'refresh');
}
*/
//Dealer Stock
 /*function read_file() {
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
$this->load->library('Excel');
$objPHPExcel = PHPExcel_IOFactory::load($file);
$objReader = PHPExcel_IOFactory::createReader('Excel2007');

$objReader->setReadDataOnly(false);
$objPHPExcel = $objReader->load($file); // error in this line
$index = array('dispatch_date', 'order_no', 'vehicle_name', 'variant', 'color', 'chass_no', 'engine_no', 'ait_reference_no', 'invoice_no', 'invoice_date', 'month', 'year','transit','indian_stock_yard','indian_custom','nepal_custom','reached_date','dispatched_date','dispatch_date_np','dealer_name','current_location','current_status');
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
// print_r($highestColumnIndex);
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

foreach ($raw_data as $key => $value) {
$this->db->select('id');
$this->db->from('mst_vehicles');
$this->db->where('name', $value['vehicle_name']);
$vehicle = $this->db->get()->row_array();
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
// for data entry only
$data[$key]['transit'] = $value['transit'];
$data[$key]['indian_stock_yard'] = $value['indian_stock_yard'];
$data[$key]['indian_custom'] = $value['indian_custom'];
$data[$key]['nepal_custom'] = $value['nepal_custom'];
$data[$key]['current_location'] = $value['current_location'];
$data[$key]['current_status'] = $value['current_status'];
$this->load->model('stock_yards/stock_yard_model');
$this->load->model('stock_records/stock_record_model');
// print_r($data[$key]);
$temp['vehicle_id'] = $this->dispatch_record_model->insert($data[$key]);

// $stockyard = $value['stock_yard'];

// $this->db->where('name',$stockyard);
// $stockyard_detail = $this->stock_yard_model->findAll();
// // echo '<pre>';print_r($stockyard_detail); exit;

// if(count($stockyard_detail) > 0){
// $temp['stock_yard_id'] = $stockyard_detail[0]->id;
$temp['reached_date'] = $value['reached_date'];
$temp['dispatched_date'] = $value['dispatched_date'];
$temp['dispatched_date_np'] = $value['dispatch_date_np'];
// }
// print_r($temp);exit;
$dealer_dispatched_id = $this->stock_record_model->insert($temp);

$order_data['vehicle_id'] = $data[$key]['vehicle_id'];
$order_data['color_id'] = $data[$key]['color_id'];
$order_data['variant_id'] = $data[$key]['variant_id'];
$dispatch_dealer['vehicle_id'] = $order_data['vehicle_main_id'] = $temp['vehicle_id'];

$order_data['order_id'] = ($key) + 1;
$order_data['received_date'] = date('Y-m-d');
$order_data['quantity'] = 1;

$this->load->model('dealers/dealer_model');
$this->db->where('name',$value['dealer_name']);
$dealer = $this->dealer_model->find();

$order_data['dealer_id'] = @$dealer->id;

$this->load->model('dealer_orders/dealer_order_model');
$dispatch_dealer['dealer_order_id'] = $this->dealer_order_model->insert($order_data);
$dispatch_dealer['stock_yard_id'] = @$temp['stock_yard_id'];
$dispatch_dealer['dealer_id'] = @$dealer->id;
$this->load->model('dispatch_dealers/dispatch_dealer_model');
$this->dispatch_dealer_model->insert($dispatch_dealer);
// print_r($dispatch_dealer);


}

// commented for data entry only
// $this->db->trans_start();
// $this->db->insert_batch('msil_dispatch_records', $data);

// if ($this->db->trans_status() === FALSE) {
//     $this->db->trans_rollback();
//     // echo 'here error';
// } else {
//     $this->db->trans_commit();
//     // echo 'success';
// }
// $this->db->trans_complete();
$referred_from = $this->session->userdata('referred_from');
redirect($referred_from, 'refresh');
}*/
//    for track  bkp-old
/*public function track() {
    $success = FALSE;
    $msg = lang('general_failure');
    $data['id'] = $this->input->post('id');
    $data['transit'] = 1;
    $data[$this->input->post('label')] = $this->input->post('date');
    if($this->input->post('label') == 'indian_stock_yard'){
        $data['indian_stock_yard_np'] = get_nepali_date($this->input->post('date'),'true');
        $np_dates = explode('-', $data['indian_stock_yard_np']);
        $data['indian_stock_yard_np_month'] = $np_dates[1];
        $data['indian_stock_yard_np_year'] = $np_dates[0];

        $this->change_current_location($data['id'],'Indian Stock Yard','Transit');

    }else if($this->input->post('label') == 'indian_custom'){
        $data['indian_custom_np'] = get_nepali_date($this->input->post('date'),'true');
        $np_dates = explode('-', $data['indian_custom_np']);
        $data['indian_custom_np_month'] = $np_dates[1];
        $data['indian_custom_np_year'] = $np_dates[0];
        $data['custom_name'] = $this->input->post('custom_name');
        $this->change_current_location($data['id'],$data['custom_name'],'Custom');
    }
    else
    {
        $this->load->model('stock_yards/stock_yard_model');
        $where['id'] = $this->input->post('stock_yard_id');
        $stock_yard = $this->stock_yard_model->find($where); 
        $stock_insert['id'] = $data['id'];
        $stock_insert['current_location'] = $stock_yard->name;
        $stock_insert['current_status'] = 'Stock';

        $data['nepal_custom_np'] = get_nepali_date($this->input->post('date'),'true');
        $np_dates = explode('-', $data['nepal_custom_np']);
        $data['nepal_custom_np_month'] = $np_dates[1];
        $data['nepal_custom_np_year'] = $np_dates[0];
        $value['vehicle_id'] = $this->input->post('id');
        $value['stock_yard_id'] = $this->input->post('stock_yard_id');
        $value['reached_date'] = date('Y-m-d H:i:s');

        $this->db->where('vehicle_id', $data['id']);
        $stock = $this->Stock_record_model->getAll();
        if (count($stock) == 0) {
            $this->Stock_record_model->insert($value);
        } else {
            $value['id'] = $stock[0]->id;
            $test = $this->Stock_record_model->update($value['id'], $value);
            $this->dispatch_record_model->update($stock_insert['id'],$stock_insert);
        }
        $this->change_current_location($data['id'], $stock_insert['current_location'],$stock_insert['current_status']);
    }
    
    $success = $this->dispatch_record_model->update($data['id'], $data);
    if ($success) {
        $success = TRUE;
        $msg = lang('general_success');
    }
    echo json_encode(array('msg' => $msg, 'success' => $success));
    exit;
}*/
public function track()//dispatch_records/track
    {
        $success = FALSE;
        $msg = lang('general_failure');
        $data['id'] = $this->input->post('id');
        $data['transit'] = 1;
        $vehicle_id = $this->input->post('vehicle_id'); 
        $variant_id = $this->input->post('variant_id');
        $color_id = $this->input->post('color_id');
        $data[$this->input->post('label')] = $this->input->post('date');
        if($this->input->post('label') == 'indian_stock_yard'){
            $data['indian_stock_yard_np'] = get_nepali_date($this->input->post('date'),'true');
            $np_dates = explode('-', $data['indian_stock_yard_np']);
            $data['indian_stock_yard_np_month'] = $np_dates[1];
            $data['indian_stock_yard_np_year'] = $np_dates[0];

            $this->change_current_location($data['id'],$this->input->post('indian_stockyar_name'),'Transit');

        }else if($this->input->post('label') == 'indian_custom'){
            $data['indian_custom_np'] = get_nepali_date($this->input->post('date'),'true');
            $np_dates = explode('-', $data['indian_custom_np']);
            $data['indian_custom_np_month'] = $np_dates[1];
            $data['indian_custom_np_year'] = $np_dates[0];
            $data['custom_name'] = $this->input->post('custom_name');
            $this->change_current_location($data['id'],$data['custom_name'],'Custom');
        }
        else
        {
            $this->load->model('stock_yards/stock_yard_model');
            // $where['id'] = $this->input->post('stock_yard_id');
            $this->db->where('id',$this->input->post('stock_yard_id'));
            // print_r($where);
            $stock_yard = $this->stock_yard_model->find(); 
            // $stock_yard = array($stock_yard);
            $stock_insert['id'] = $data['id'];
            $stock_insert['current_location'] = $stock_yard->name;
            $stock_insert['current_status'] = 'Stock';

            $data['nepal_custom_np'] = get_nepali_date($this->input->post('date'),'true');
            $np_dates = explode('-', $data['nepal_custom_np']);
            $data['nepal_custom_np_month'] = $np_dates[1];
            $data['nepal_custom_np_year'] = $np_dates[0];
            $value['vehicle_id'] = $this->input->post('id');
            $value['stock_yard_id'] = $this->input->post('stock_yard_id');
            $value['reached_date'] = date('Y-m-d H:i:s');

            $this->db->where('vehicle_id', $data['id']);
            $stock = $this->Stock_record_model->getAll();
            if (count($stock) == 0) {
                $this->Stock_record_model->insert($value);
            } else {
                $value['id'] = $stock[0]->id;
                $test = $this->Stock_record_model->update($value['id'], $value);
                $this->dispatch_record_model->update($stock_insert['id'],$stock_insert);
                $this->db->select('id');
                $this->db->where(array(' vehicle_id'=>$vehicle_id,' variant_id'=>$variant_id,' color_id'=>$color_id,' in_stock_remarks'=>2,'credit_control_approval'=>1,'cancel_date'=>NULL));
                $dispatch = $this->dealer_order_model->find(NULL,NULL,'id asc');
                if($dispatch){
                    if($value['stock_yard_id'] == 3)
                    {
                        $set['in_stock_remarks'] = 1;
                        $set['stock_in_ktm'] = 1;
                        $set['id'] = $dispatch->id;
                    }
                    else
                    {
                       $set['in_stock_remarks'] = 1;
                       $set['id'] = $dispatch->id;   
                   }
                    // $this->db->where('id',$dispatch->id);
                   $this->dealer_order_model->update($set['id'],$set);

               }

                // echo '<pre>'; print_r($dispatch->id); exit;

           }
           $this->change_current_location($data['id'], $stock_insert['current_location'],$stock_insert['current_status']);
       }

       $success = $this->dispatch_record_model->update($data['id'], $data);
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

public function save_vehicle_register(){
    $data = $this->input->post();

    if (!$this->input->post('id')) {
        $success = FALSE;
// $success = $this->dispatch_record_model->insert($data);
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
}

public function save_pragyapan()
{
    $data['id'] = $this->input->post('vehicle_id');
    $data['pragyapan_no'] = $this->input->post('pragyapan_no');
    $data['pragyapan_date'] = $this->input->post('pragyapan_date');
    $data['pragyapan_date_np'] = get_nepali_date($this->input->post('pragyapan_date'),'nep');

    $success = $this->dispatch_record_model->update($data['id'],$data);
    if ($success) {
        $success = TRUE;
        $msg = lang('general_success');
    } else {
        $success = FALSE;
        $msg = lang('general_failure');
    }

    echo json_encode(array('msg' => $msg, 'success' => $success));
}


public function save_fuel_kms()
{

    $data['vehicle_id'] = $this->input->post('fuel_msil_id');
    $data['fuel'] = $this->input->post('fuel_quantity');
    $data['kms'] = $this->input->post('fuel_kms');
    $data['opening_kms'] = $this->input->post('fuel_opening_kms');
    $data['closing_kms'] = $this->input->post('fuel_closing_kms');
    $data['location'] = $this->input->post('fuel_location');
    $data['date'] = $this->input->post('fuel_info_added_date');
    $data['fuel_remarks'] = $this->input->post('fuel_remarks');
    $data['reported_by'] = $this->input->post('fuel_reported_by');
    $data['customer_name'] = $this->input->post('fuel_customer');
    $data['mobile_number'] = $this->input->post('fuel_customer_number');
    $data['month'] = $this->input->post('fuel_month');
    $data['executive_name'] = $this->input->post('fuel_executive');
    $data['date_np'] = get_nepali_date(date('Y-m-d'),'nep');
    $success = $this->log_fuel_km_model->insert($data);
    if ($success) {
        $success = TRUE;
        $msg = lang('general_success');
    } else {
        $success = FALSE;
        $msg = lang('general_failure');
    }

    echo json_encode(array('msg' => $msg, 'success' => $success));
}

public function check_duplicate()
{
    $vehicle_id = $this->input->post('vehicle_id');
    $location = $this->input->post('value');

    $check_duplicate = $this->log_fuel_km_model->find_count(array('location'=>$location,'vehicle_id'=>$vehicle_id));

    if ($check_duplicate) 
    {
        $success = FALSE;
        $msg = lang('general_failure');
    } else {
         $success = TRUE;
        $msg = lang('general_success');
    }

    echo json_encode(array('msg' => $msg, 'success' => $success));
}

    public function get_fuel_kms()
    {
        $vehicle_id = $this->input->post('id');
        $result = $this->log_fuel_km_model->findAll(array('vehicle_id'=>$vehicle_id));
        echo json_encode(array('data' => $result));
    }

    public function custom_movement()
    {
        $data['id'] = $this->input->post('id');
        $data['india_custom_movement_date'] = ($this->input->post('india_custom_movement_date'))?$this->input->post('india_custom_movement_date'):NULL;
        $data['nepal_custom_movement_date'] = ($this->input->post('nepal_custom_movement_date'))?$this->input->post('nepal_custom_movement_date'):NULL;
        // echo $this->input->post('india_custom_movement_date');
        // print_r($data);exit;
        if($data['india_custom_movement_date']){
            $data['india_custom_movement_date_np'] = get_nepali_date($this->input->post('india_custom_movement_date'),'nep');
        }
        if($data['nepal_custom_movement_date']){
            $data['nepal_custom_movement_date_np'] = get_nepali_date($this->input->post('nepal_custom_movement_date'),'nep');
        }

        $result = $this->dispatch_record_model->update($data['id'],$data);

        if(!$result)
        {
            $success = FALSE;
            $msg = lang('general_failure');
        } else {
             $success = TRUE;
            $msg = lang('general_success');
        }

        echo json_encode(array('msg' => $msg, 'success' => $success));

    }

    public function fuel_report()
    {
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "fuel_report";
        $data['module'] = 'dispatch_records';
        $data['default_col']            = 'Date';
        $data['default_row']            = 'Model';

        $this->load->view($this->_container, $data); 
    }

    public function generate_fuel_report()
    {
        $fields = '
            vehicle_name as Model,
            variant_name as Variant,
            color_name as Color, 
            engine_no As "Engine Number", 
            chass_no as "Chassis Number", 
            engine_no as Engine Number,
            chass_no as Chassis Number,
            fuel as Fuel,
            opening_kms as "Opening Kms",
            closing_kms as "Closing Kms",
            kms as Kms,
            date as Date,
            location as Location,
            fuel_remarks as Remarks,
            reported_by as "Reported By",
            customer_name as Customer Name,
            mobile_number as Customer Mobile,
            month as Month,
            executive_name as Executive Name,
            ';
        $where = $this->input->post();
        $this->db->select($fields);
        // if (count($where) > 0) 
        // {
        //     $this->db->where($where);
        // }
        if($this->input->post('english_start_date')){
            $this->db->where('date >= ',$this->input->post('english_start_date'));
        }
        if($this->input->post('english_end_date')){
            $this->db->where('date <= ',$this->input->post('english_end_date'));
        }
        $this->db->from('view_log_fuel_record');
        $result = $this->db->get()->result_array(); 

        $total = count($result);
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }

        echo json_encode(array('success'  => $success, 'data' => $result, 'total'=> $total));
    }
}
