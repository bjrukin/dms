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

/*
 * Rename the file to Monthly_planning.php
 * and Define Module Library Function (if any)
 */


/* End of file Monthly_planning.php */
/* Location: ./modules/Monthly_planning/libraries/Monthly_planning.php */

class Monthly_planning {

    public $CI;

    public function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->model('monthly_plannings/monthly_planning_model');
        $this->CI->load->model('stock_records/stock_record_model');

        $this->CI->load->helper(array('project'));
    }

    /**
     * 
     * @param type $date
     * @return type mixed
     */
    public function get_monthly_stocks($date = NULL) {
        if ($date == NULL) {
            $date = date('Y-m-d');
        }

        $this->CI->stock_record_model->_table = 'view_log_stock_records';
        $this->CI->db->group_by(array('stock_yard_id', 'mst_vehicle_id', 'vehicle_name', 'mst_variant_id', 'variant_name', 'mst_color_id', 'color_name', 'stock_yard'));
        $fields = 'COUNT(id) AS vehicle_count,stock_yard_id,mst_vehicle_id,vehicle_name,mst_variant_id,variant_name,mst_color_id,color_name,stock_yard';
//        return $date;
        $datas = $this->CI->stock_record_model->findAll(array("(received_date > '" . $date . "' OR received_date IS NULL) " => NULL), $fields);
        $rows = array();
        foreach ($datas as $data) {
//        print_r($data);
            $rows[$data->stock_yard_id][$data->mst_vehicle_id][$data->mst_variant_id][$data->mst_color_id]['count'] = $data->vehicle_count;
        }
        return $rows;
    }

    /**
     * 
     * @param type $date
     * @return type array
     */
    public function get_monthly_transit_stocks($date = NULL) {
        if ($date == NULL) {
            $date = date('Y-m-d');
        }

        $data = array();
        $this->CI->stock_record_model->_table = 'view_msil_dispatch_records';
        $fields = 'COUNT(id) AS vehicle_count,vehicle_id,vehicle_name,variant_id,variant_name,color_id,color_name';
        
        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $transits = $this->CI->stock_record_model->findAll(array("transit" => 0), $fields);
        if (count($transits) > 0) {
            foreach ($transits as $transit) {
//        echo '<pre>';print_r($transit);echo '</pre>';
                $data['transits'][$transit->vehicle_id][$transit->variant_id][$transit->color_id]['count'] = $transit->vehicle_count;
            }
        }
//        echo '<pre>';print_r($data);
//        exit;
        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $rxl_custom = $this->CI->stock_record_model->findAll(array('custom_name'=>'RXL CUSTOMS'), $fields);
        if (count($rxl_custom) > 0) {
            foreach ($rxl_custom as $rxl_customs) {
//        echo '<pre>';print_r($transit);echo '</pre>';
                $data['rxl_custom'][$rxl_customs->vehicle_id][$rxl_customs->variant_id][$rxl_customs->color_id]['count'] = $rxl_customs->vehicle_count;
            }
        }

        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $grp_custom = $this->CI->stock_record_model->findAll(array('custom_name'=>'GRP CUSTOMS'), $fields);
        if (count($grp_custom) > 0) {
            foreach ($grp_custom as $grp_customs) {
//        echo '<pre>';print_r($transit);echo '</pre>';
                $data['grp_custom'][$grp_customs->vehicle_id][$grp_customs->variant_id][$grp_customs->color_id]['count'] = $grp_customs->vehicle_count;
            }
        }
        
//         $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
//         $indian_customs = $this->CI->stock_record_model->findAll(array("(indian_custom IS NOT NULL)" => NULL, "nepal_custom" => NULL), $fields);
//         if (count($indian_customs) > 0) {
//             foreach ($indian_customs as $indian_custom) {
// //        echo '<pre>';print_r($transit);echo '</pre>';
//                 $data['indian_customs'][$indian_custom->vehicle_id][$indian_custom->variant_id][$indian_custom->color_id]['count'] = $indian_custom->vehicle_count;
//             }
//         }
        
//         $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
//         $nepal_customs = $this->CI->stock_record_model->findAll(array("(nepal_custom IS NOT NULL)" => NULL, 'stock_yard_reached_date' => NULL), $fields);
//         if (count($nepal_customs) > 0) {
//             foreach ($nepal_customs as $nepal_custom) {
// //        echo '<pre>';print_r($transit);echo '</pre>';
//                 $data['nepal_customs'][$nepal_custom->vehicle_id][$nepal_custom->variant_id][$nepal_custom->color_id]['count'] = $nepal_custom->vehicle_count;
//             }
//         }
        
        return $data;
    }
//    get order of given month
    public function get_order() {
        if($this->CI->input->post('year')){
            $search['year'] = $this->CI->input->post('year');
        }else{
            $search['year'] = date('Y');
        }
        if($this->CI->input->post('month')){
            $search['month'] = $this->CI->input->post('month');
        }else{
            $search['month'] = date('m');
        }
        
        $this->CI->monthly_planning_model->_table = 'view_msil_monthly_orders';
        search_params();
        $this->CI->db->where($search);
        $total = $this->CI->monthly_planning_model->find_count();
//        paging('id');

        search_params();
        $this->CI->db->where($search);
        $rows = $this->CI->monthly_planning_model->findAll();

        /*monthly planning of 3months back*/
        if($this->CI->input->post('year')){
            $search1['year'] = $this->CI->input->post('year');
        }else{
            $search1['year'] = date('Y');
        }
        if($this->CI->input->post('month')){
            $search1['month'] = ($this->CI->input->post('month')-3);

        }else{
            $month = date('m');
            $search1['month'] = date('m', strtotime("-3 months"));
            if(date('m') < $search1['month']){
                $search1['year']--;
            }
//            $search1['month'] = strtotime($month . ' - 3 month');
        }
        $this->CI->db->where($search1);
        $data_before_threemonths = $this->CI->monthly_planning_model->findAll();

        if($this->CI->input->get('year')){
            $search2['year'] = $this->CI->input->get('year');
        }else{
            $search2['year'] = date('Y');
        }
        if($this->CI->input->get('month')){
            $search2['month'] = ($this->CI->input->get('month')-1);
        }else{
            $search2['month'] = date('m');
        }

        $total_dispatched = $this->CI->monthly_planning_model->get_Count($search2);
        //subracting total plan with dispatched vehicles
        foreach ($data_before_threemonths as  $key => &$value) {
            foreach ($total_dispatched as  $values) {
                if($value->vehicle_id == $values->CI->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total - $values->total_dispatched;                    
                }
            }
        }

        foreach ($rows as  $key => &$value) {
            foreach ($data_before_threemonths as  $values) {
                if($value->vehicle_id == $values->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total + $values->total;                    
                }
            }
        }
        return($rows);
    }

    //******************************** file upload ***********************************//
    function read_file($upload_path,$index) {
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->CI->load->library('upload', $config);

        if (!$this->CI->upload->do_upload('userfile')) {
            $error = array('error' => $this->CI->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->CI->upload->data());
        }
        $file = FCPATH . $config['upload_path'] . '/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];
//        $file = FCPATH . 'uploads/monthly_plannings/testvalidrecord34.xlsx'; //$_FILES['fileToUpload']['tmp_name'];
        $this->CI->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line
        $index = $index;
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
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }

        $this->CI->db->from('mst_vehicles');
        $vehicle = $this->CI->db->get()->row_array();
        return $raw_data;

    }
}
