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

        if(!$this->input->post('id'))
        {
        	$success=$this->target_record_model->insert($data);
        }
        else
        {
        	$success=$this->target_record_model->update($data['id'],$data);
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
    	$data['vehicle_classification'] = $this->input->post('vehicle_classification');
    	$data['dealer_id'] = $this->input->post('dealer_id');
    	$data['target_year'] = $this->input->post('target_year');
    	$data['revision'] = $this->input->post('revision');

    	return $data;
    }

    public function import_target()
    {

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
        $index = array('vehicle_name', 'month', 'quantity');
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
        	$data[$key]['created_by'] = $this->session->userdata('id');
        	$data[$key]['created_at'] = date("Y-m-d H:i:s");    
            $this->db->select('id');
            $this->db->from('mst_vehicles');
            $this->db->where('name', $value['vehicle_name']);
            $vehicle = $this->db->get()->row_array();
            $data[$key]['vehicle_id'] = $vehicle['id'];
            $data[$key]['dealer_id'] = $this->input->post('dealers_import_id');
            $data[$key]['target_year'] = $this->input->post('year');
            $data[$key]['month'] = $value['month'];
            $data[$key]['quantity'] = $value['quantity'];
            
        }

        $this->db->trans_start();
        $this->db->insert_batch('sales_target_records', $data); 

        echo $this->db->last_query();
        if ($this->db->trans_status() === FALSE) {
        	$this->db->trans_rollback();
        	echo 'here error';
        } else {
        	$this->db->trans_commit();
        	echo 'success';
        }
        $this->db->trans_complete();
    }
}