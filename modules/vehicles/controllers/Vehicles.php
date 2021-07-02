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
 * Vehicles
 *
 * Extends the Project_Controller class
 * 
 */

class Vehicles extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Vehicles');

		$this->load->model('vehicles/vehicle_model');
		$this->lang->load('vehicles/vehicle');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('vehicles');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'vehicles';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->vehicle_model->_table = 'view_dms_vehicles';

		search_params();
		
		$total=$this->vehicle_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->vehicle_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;


	}

	/*public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->vehicle_model->insert($data);
        }
        else
        {
            $success=$this->vehicle_model->update($data['id'],$data);
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
		}*/
	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data
        
         if(!$this->input->post('id'))
        {
            $success=$this->vehicle_model->insert($data);
        }
        else
        {
            $success=$this->vehicle_model->update($data['id'],$data);
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
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['variant_id'] = $this->input->post('variant_id');
		$data['color_id'] 	= $this->input->post('color_id');
		$data['price'] 		= $this->input->post('price');

		return $data;
	}

   // public function check_duplicate() 
   // {
   //      if ($this->input->post('id')) {
   //          $this->db->where('id <>', $this->input->post('id'));
   //      }

   //      $this->db->where('vehicle_id', $this->input->post('vehicle_id'));
   //      $this->db->where('variant_id', $this->input->post('variant_id'));
   //      $this->db->where('color_id',   $this->input->post('color_id'));

   //      $total = $this->vehicle_model->find_count();

   //      if ($total == 0) 
   //          echo json_encode(array('success' => true));
   //       else
   //          echo json_encode(array('success' => false));
   //  }

	public function generate_excel($table = NULL)
    {

        $this->vehicle_model->_table = 'view_dms_vehicles';
        $fields = 'vehicle_id,variant_id,color_id,vehicle_name,variant_name,color_code,color_name,price';
        $rows = $this->vehicle_model->findAll(NULL,$fields);

        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Vehicle Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Variant Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Color Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','Vehicle Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1','Variant Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1','Color Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1','Price');

        $row = 2;
        $col = 0;        
        foreach($rows as $key => $values) 
        {           
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->vehicle_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->variant_name);
            $col++; 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->color_code);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->vehicle_id);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->variant_id);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->color_id);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->price);
            $col++;
            $row++;
            $col = 0; 
        }
        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Vehicles_master.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
	public function upload_vehicles()
	{
		$config['upload_path'] = './uploads/vehicles';
		$config['allowed_types'] = 'xlsx|csv|xls';
		$config['max_size'] = 100000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$data = array('upload_data' => $this->upload->data());
		}
		$file = FCPATH . 'uploads/vehicles/' . $data['upload_data']['file_name']; 
		$this->load->library('Excel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');        
		$objReader->setReadDataOnly(false);

		$index = array('vehicle_id','variant_id','color_id','price');
		$raw_data = array();
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
		foreach ($raw_data as $key => $value) 
		{
			$excel_dispatch[$key]['vehicle_id'] = $value['vehicle_id'];
			$excel_dispatch[$key]['variant_id'] = $value['variant_id'];
			$excel_dispatch[$key]['color_id'] = $value['color_id'];
			$excel_dispatch[$key]['price'] = $value['price'];
		} 

		$this->db->trans_start();
		$this->vehicle_model->insert_many($excel_dispatch);
		if ($this->db->trans_status() === FALSE) 
		{
			$this->db->trans_rollback();
		} 
		else 
		{
			$this->db->trans_commit();
		} 
		$this->db->trans_complete();
		redirect($_SERVER['HTTP_REFERER']);
	}

}