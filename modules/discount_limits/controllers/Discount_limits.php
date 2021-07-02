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
 * Discount_limits
 *
 * Extends the Project_Controller class
 * 
 */

class Discount_limits extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Discount Limits');

        $this->load->model('discount_limits/discount_limit_model');
        $this->lang->load('discount_limits/discount_limit');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('discount_limits');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'discount_limits';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->discount_limit_model->_table = 'view_sales_discount_limit';

		search_params();
		
		$total=$this->discount_limit_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->discount_limit_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function downloadExcel()
	{
		$this->discount_limit_model->_table = 'view_sales_discount_limit';
		$rows=$this->discount_limit_model->findAll();
		// echo '<pre>'; print_r($rows); exit;
 		$this->load->library('Excel');		
		$objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('All Persional Details');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        
      


        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Vehicle')
        ->setCellValue('B1', 'Variant')
        ->setCellValue('C1', 'Sales Executive')
        ->setCellValue('D1', 'Showroom Incharge')
        ->setCellValue('E1', 'Sales Head');

        $row = 2;
        $col = 0; 


        foreach ($rows as  $values) {
        	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->vehicle_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->variant_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->staff_limit);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->incharge_limit);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->sales_head_limit);
            $col++;

         	$row++;
            $col = 0;
        }


        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="discountlimit.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // if (ob_get_length()) ob_end_clean();
        $objWriter->save('php://output');
	}

	public function uploadExcel()
	{
		$config['upload_path'] = './uploads/discount_limits';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/discount_limits/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
        $objReader->setReadDataOnly(false);

        $index = array('vehicle','variant','staff_limit','incharge_limit','sales_head_limit');
        $raw_data = array();
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

        $imported_data = array();
        $unknown = [];
        foreach ($raw_data as $key => $value) {
			$this->db->where('name', $value['vehicle']);
          	$this->db->from('mst_vehicles');
			$vehicle = $this->db->get()->row_array();
			$variant = $this->db->from('mst_variants')->where('name', $value['variant'])->get()->row_array();

			if(empty($vehicle)  || empty($variant)){
				$unknown[] = $value;
			}else{
				$imported_data[$key]['vehicle_id'] = $vehicle['id'];
				$imported_data[$key]['variant_id'] = $variant['id'];
				$imported_data[$key]['staff_limit'] = $value['staff_limit'];
				$imported_data[$key]['incharge_limit'] = $value['incharge_limit'];
				$imported_data[$key]['sales_head_limit'] = $value['sales_head_limit'];
			}
        }


        // echo '<pre>'; print_r($unknown); exit;

        if(empty($unknown)){

	        $oldData = $this->discount_limit_model->findAll();

	        $this->db->insert_batch('dms_discount_old_schemes', $oldData);
	        $this->db->empty_table('sales_discount_limit');


	        $this->discount_limit_model->insert_many($imported_data);
        }


        redirect($_SERVER['HTTP_REFERER']);

	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->discount_limit_model->insert($data);
        }
        else
        {
            $success=$this->discount_limit_model->update($data['id'],$data);
        }

		if($success)
		{
			$success = TRUE;
			$msg=lang('general_success');
		}
		else
		{
			$success = FALSE;
			$msg=lang('general_failure');
		}

		 echo json_encode(array('msg'=>$msg,'success'=>$success));
		 exit;
	}

   private function _get_posted_data()
   {
   		$data=array();
   		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}
		$data['created_by'] = $this->input->post('created_by');
		$data['updated_by'] = $this->input->post('updated_by');
		$data['deleted_by'] = $this->input->post('deleted_by');
		$data['created_at'] = $this->input->post('created_at');
		$data['updated_at'] = $this->input->post('updated_at');
		$data['deleted_at'] = $this->input->post('deleted_at');
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['variant_id'] = $this->input->post('variant_id');
		$data['staff_limit'] = $this->input->post('staff_limit');
		$data['incharge_limit'] = $this->input->post('incharge_limit');
		// $data['manager_limit'] = $this->input->post('manager_limit');
		$data['sales_head_limit'] = $this->input->post('sales_head_limit');

        return $data;
   }

}