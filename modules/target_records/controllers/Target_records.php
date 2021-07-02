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
 * Target_records
 *
 * Extends the Project_Controller class
 * 
 */

class Target_records extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Target Records');

		$this->load->model('target_records/target_record_model');
		$this->lang->load('target_records/target_record');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('target_records');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'target_records';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->target_record_model->_table = "view_sales_target_records";
		search_params();
		
		$total=$this->target_record_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->target_record_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data

		$where = array(
			'dealer_id'     =>  $data['dealer_id'],
			'target_year'   =>  $data['target_year'],
		);

		$fields = 'revision';
		$this->db->select_max($fields);
		$rev = $this->db->get_where('sales_target_records',$where)->row()->revision;
		$this->session->set_userdata('editing_revision', $rev + 1);

		$data['revision'] = $this->session->userdata('editing_revision');

		$success=$this->target_record_model->insert($data);


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
		
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['vehicle_classification'] = $this->input->post('vehicle_classification');
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['target_year'] = $this->input->post('target_year');
		$data['month'] = $this->input->post('month');
		$data['quantity'] = $this->input->post('quantity');
		$data['retail_quantity'] = $this->input->post('retail_quantity');
		$data['inquiry_target'] = $this->input->post('inquiry_target');

		return $data;
	}

	public function get_target_year_combo_json(){
		$fields = "target_year";
		$this->db->group_by($fields);
		$rows = $this->target_record_model->findAll(null,$fields);

		echo json_encode($rows);
	}

	public function import_target()
	{
		list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year(); 

		$config['upload_path'] = './uploads/dealer_target';
		$config['allowed_types'] = 'xlsx|csv|xls';
		$config['max_size'] = 100000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$data = array('upload_data' => $this->upload->data());
		}
		$file = FCPATH . 'uploads/dealer_target/' . $data['upload_data']['file_name']; 

		$this->load->library('Excel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');

		$objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line
        $index = array('vehicle_name', 'month', 'billing_target','retail_target','inquiry_target','test','test1','test2','test3','test1','test2','test3','test1','test2','test3','test1','test2','test3');
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

        foreach ($raw_data as $key => $value) {
        	$month = $this->db->where('rank',$value['month'])->get('mst_nepali_month')->row_array();
        	$this->db->select('id');
        	$this->db->from('mst_vehicles');
        	$this->db->where('name', $value['vehicle_name']);
        	$vehicle = $this->db->get()->row_array();
        	if($vehicle['id']){
        		
	        	$data[$key]['created_by'] = $this->session->userdata('id');
	        	$data[$key]['created_at'] = date("Y-m-d H:i:s");    
	        	$data[$key]['vehicle_id'] = $vehicle['id'];
	        	$data[$key]['dealer_id'] = $this->input->post('dealers_import_id');
	        	$data[$key]['target_year'] = $fiscal_year;
	        	$data[$key]['month'] = $month['id'];
	        	$data[$key]['quantity'] = $value['billing_target'];
	        	$data[$key]['retail_quantity'] = $value['retail_target'];
	        	$data[$key]['inquiry_target'] = $value['inquiry_target'];
        	}
        }
        // echo '<pre>'; print_r($data); exit;
        $this->db->insert_batch('sales_target_records', $data); 

        if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        	echo 'here error';
        } else {
        	$this->db->trans_commit();
        	echo 'success';
        }
        $this->db->trans_complete();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function import_target_missing()
    {
    	list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year(); 

		$config['upload_path'] = './uploads/dealer_target';
		$config['allowed_types'] = 'xlsx|csv|xls';
		$config['max_size'] = 100000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$data = array('upload_data' => $this->upload->data());
		}
		$file = FCPATH . 'uploads/dealer_target/' . $data['upload_data']['file_name']; 

		$this->load->library('Excel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');

		$objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line
        $index = array('vehicle_name', 'month', 'billing_target','retail_target','inquiry_target','dealer_id','test1','test2','test3','test1','test2','test3','test1','test2','test3','test1','test2','test3');
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

        foreach ($raw_data as $key => $value) {
        	$this->db->select('id');
        	$this->db->from('mst_vehicles');
        	$this->db->where('name', $value['vehicle_name']);
        	$vehicle = $this->db->get()->row_array();
        	if($vehicle['id']){
	        	$data[$key]['created_by'] = $this->session->userdata('id');
	        	$data[$key]['created_at'] = date("Y-m-d H:i:s");    
	        	$data[$key]['vehicle_id'] = $vehicle['id'];
	        	$data[$key]['dealer_id'] = $value['dealer_id'];
	        	$data[$key]['target_year'] = $fiscal_year;
	        	$data[$key]['month'] = $value['month'];
	        	$data[$key]['quantity'] = $value['billing_target'];
	        	$data[$key]['retail_quantity'] = $value['retail_target'];
	        	$data[$key]['inquiry_target'] = $value['inquiry_target'];
        	}
        }

        // echo '<pre>'; print_r($data); exit;
        $this->db->insert_batch('sales_target_records', $data); 

        if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        	echo 'here error';
        } else {
        	$this->db->trans_commit();
        	echo 'success';
        }
        $this->db->trans_complete();
        redirect($_SERVER['HTTP_REFERER']);
    }
}