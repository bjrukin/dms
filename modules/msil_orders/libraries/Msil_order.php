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
 * Rename the file to Msil_order.php
 * and Define Module Library Function (if any)
 */


/* End of file Msil_order.php */
/* Location: ./modules/Msil_order/libraries/Msil_order.php */
class Msil_order {

    public $CI;

    public function __construct() {
        $this->CI = & get_instance();

		$this->CI->load->model('msil_orders/msil_order_model');
        $this->CI->load->model('stock_records/stock_record_model');

        $this->CI->load->helper(array('project'));
    }


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
