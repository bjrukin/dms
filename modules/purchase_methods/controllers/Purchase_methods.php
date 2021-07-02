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
 * Purchase_methods
 *
 * Extends the Project_Controller class
 * 
 */

class Purchase_methods extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		// control('Purchase Methods');

		$this->load->model('purchase_methods/purchase_method_model');
		$this->lang->load('purchase_methods/purchase_method');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('purchase_methods');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'purchase_methods';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->purchase_method_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->purchase_method_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		
	}


	public function singlejson()
	{
		search_params();
		
		$total=$this->purchase_method_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->purchase_method_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data
	   // echo"<pre>";
	   //  print_r($data);
	   //  exit;

		if(!$this->input->post('id'))
		{
			$success=$this->purchase_method_model->insert($data);
		}
		else
		{
			$success=$this->purchase_method_model->update($data['id'],$data);
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

	public function get_method(){
		$id=$this->input->post('id');
		
		$this->db->where('id',$id);

		$method=$this->db->get('view_service_purchase_invoice')->result_array();

		echo json_encode($method);
	}

	public function get_purchase_method(){
		$id = $this->input->post('id');		
		
		$this->purchase_method_model->_table = 'view_service_purchase_invoice';
		$this->db->where('id',$id);
		$purchase_items = $this->purchase_method_model->findAll();

		echo json_encode($purchase_items);
	}
	
	private function _get_posted_data()
	{
		$data=array();
		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}
		// $data['created_by'] = $this->input->post('created_by');
		// $data['updated_by'] = $this->input->post('updated_by');
		// $data['deleted_by'] = $this->input->post('deleted_by');
		// $data['created_at'] = $this->input->post('created_at');
		// $data['updated_at'] = $this->input->post('updated_at');
		// $data['deleted_at'] = $this->input->post('deleted_at');
		$data['type'] = $this->input->post('type');
		$data['part_no'] = $this->input->post('part_no');
		$data['description'] = $this->input->post('description');
		$data['qty'] = $this->input->post('qty');
		$data['ord_no'] = $this->input->post('ord_no');
		$data['price'] = $this->input->post('price');
		$data['disc'] = $this->input->post('disc');
		$data['amount'] = $this->input->post('amount');
		$data['bin'] = $this->input->post('bin');
		$data['vat'] = $this->input->post('vat');

		return $data;
	}



	function upload_image(){
		$config['upload_path'] = './uploads/excel_imports/purchase_method/';
		$config['allowed_types'] = 'xlsx|csv|xls';
		$config['max_size'] = 100000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$data = array('upload_data' => $this->upload->data());
		}
		$file = FCPATH . 'uploads/excel_imports/purchase_method/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];

		$this->load->library('Excel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');

		$objReader->setReadDataOnly(false);
		$objPHPExcel = $objReader->load($file); // error in this line

		
		$index = array(
			
			'type',
			'part_no',
			'description',
			'qty',
			
			'price',
			'disc',
			'amount',
			'bin',
			'vat',
			'ord_no'

			

			);
		
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
		
		echo json_encode($raw_data);
	}

	
	function export(){
		$query = $this->db->get('ser_purchase_method');


		if(!$query)
			return false;

		// Starting the PHPExcel library
		$this->load->library('excel');
	   // $this->load->library('IOFactory');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
		$objPHPExcel->setActiveSheetIndex(0);
		// Field names in the first row
		$fields = $query->list_fields();
		$col = 0;
		foreach ($fields as $field)
		{
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
			$col++;
		}
		// Fetching the table data
		$row = 2;
		foreach($query->result() as $data)
		{
			$col = 0;
			foreach ($fields as $field)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
				$col++;
			}
			$row++;
		}
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// Sending headers to force the user to download the file
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="purchase_methods.xls"');
		header('Cache-Control: max-age=0');
		$objWriter->save('php://output');
	}

	public function delete()
	{
		$id=$this->input->post('id');
		$this->purchase_method_model->delete(array('id'=>$id),$data);
		
		
		
	}    

	
}

