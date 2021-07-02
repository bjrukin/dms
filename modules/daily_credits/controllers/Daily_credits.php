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
 * Daily_credits
 *
 * Extends the Project_Controller class
 * 
 */

class Daily_credits extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Daily Credits');

        $this->load->model('daily_credits/daily_credit_model');
        $this->lang->load('daily_credits/daily_credit');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('daily_credits');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'daily_credits';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->daily_credit_model->_table = 'view_daily_credits';
		search_params();
		
		$total=$this->daily_credit_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->daily_credit_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->daily_credit_model->insert($data);
        }
        else
        {
            $success=$this->daily_credit_model->update($data['id'],$data);
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
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['date_en'] = $this->input->post('date_en');
		$data['date_np'] = $this->input->post('date_np');
		$data['credit_amount'] = $this->input->post('credit_amount');

        return $data;
   	}

   	private function isEmptyRow($row) {
	    foreach($row as $cell){
	        if (null !== $cell) return false;
	    }
	    return true;
	}

   	public function upload_file()
   	{
   		$config['upload_path'] = './uploads/daily_credit';
    	$config['allowed_types'] = 'xlsx|csv|xls';
    	$config['max_size'] = 100000;

    	$this->load->library('upload', $config);

    	if (!$this->upload->do_upload('userfile')) {
    		$error = array('error' => $this->upload->display_errors());
    		print_r($error); exit;
    		redirect($_SERVER['HTTP_REFERER']);
    	} else {
    		$data = array('upload_data' => $this->upload->data());
    	}
    	$file = FCPATH . 'uploads/daily_credit/' . $data['upload_data']['file_name']; 
    	$this->load->library('Excel');
    	$objPHPExcel = PHPExcel_IOFactory::load($file);
    	$objReader = PHPExcel_IOFactory::createReader('Excel2007');        
    	$objReader->setReadDataOnly(false);

    	$index = array('date_en','dealer_name','credit_amount');
    	$index_count = count($index);
    	$raw_data = array();
    	$view_data = array();
    	$error['dealer'] = array();
    	$error_status = FALSE;
    	foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
    		if ($key == 0) {
    			$worksheetTitle = $worksheet->getTitle();
				$highestRow = $worksheet->getHighestRow(); // e.g. 10
				$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				$nrColumns = ord($highestColumn) - 64;

				for ($row = 2; $row <= $highestRow; ++$row) {
					$rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
    				if($this->isEmptyRow(reset($rowData))) { continue; } // skip empty row
					for ($col = 0; $col < $index_count; ++$col) {
						$cell = $worksheet->getCellByColumnAndRow($col, $row);
						$val = $cell->getValue();
						if($index[$col] == 'dealer_name'){
							$this->daily_credit_model->_table = 'dms_dealers';
							$dealer = $this->daily_credit_model->find(array('name'=>strtoupper($val)));
							if($dealer){
								$raw_data[$row]['dealer_id'] = $dealer->id;
							}else{
								$raw_data[$row]['dealer_id'] = 0;
								$error['dealer'][] = $val;
								$error_status = TRUE;
							}
						}elseif(!in_array($index[$col], array('date_en'))){
							$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
							$raw_data[$row][$index[$col]] = $val;
						}else{
							$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
							$raw_date = ($val - 25569) * 3600 * 24;
							$raw_data[$row][$index[$col]] = gmdate('Y-m-d', $raw_date);
							$raw_data[$row]['date_np'] = get_nepali_date(date('Y-m-d'),'nep');
						}
					}
				}
			}
		}
		foreach ($raw_data as $key => $value) {
			if(!$value['date_en'] || !$value['dealer_id']){
				unset($raw_data[$key]);
			}
		}
		// echo '<pre>';
		// print_r($error);
		// print_r($raw_data);
		// echo '</pre>';
		if($error_status){
			$data['header'] = lang('daily_credits');
			$data['page'] = $this->config->item('template_admin') . "error";
			$data['module'] = 'daily_credits';
			$data['error'] = $error;
			$this->load->view($this->_container,$data);
		}else{
			$this->db->trans_begin();
			// echo '<pre>';
			// print_r($raw_data);
			$this->daily_credit_model->_table = 'spareparts_daily_credits';
			$this->daily_credit_model->insert_many($raw_data);
			if ($this->db->trans_status() === FALSE)
			{
			        $this->db->trans_rollback();
			        echo 'error';
			}
			else
			{
			        $this->db->trans_commit();
			}
			return redirect(site_url('daily_credits'));
		}

   	}

   	public function get_daily_credit_summary($date=NULL)
   	{
   		// echo '<pre>';
   		if(!$date){
   			$last_date = $this->daily_credit_model->find(NULL,'*','date_en desc');
   			if($last_date){
   				$date = $last_date->date_en;
   			}else{
   				$date = date("Y-m-d");
   			}
   		}

   		$sql = 'SELECT dealer_id, dealer_name, 
					SUM(total_quantity) as total_quantity,
					SUM(quantity) as stock_quantity,
					SUM(total_quantity * dealer_price) as total_amount,
					SUM(quantity * dealer_price) as stock_amount
				FROM
				(
				SELECT
					sparepart_id,
					dealer_id,
					dealer_name,
					total_quantity,
					dealer_price,
					CASE
				WHEN total_quantity > quantity THEN
					quantity
				ELSE
					total_quantity
				END quantity
				FROM
					(
						SELECT
							sparepart_id,
							dealer_id,
							"dealer_name",
							SUM (
								order_quantity - received_quantity - cancle_quantity
							) AS total_quantity,
							dealer_price,
							CASE
						WHEN quantity > 0 THEN
							quantity
						ELSE
							0
						END AS quantity
					FROM
						"view_spareparts_dealer_order"
					WHERE
						"pi_confirmed" = 1
					AND "order_quantity" > (
						received_quantity + cancle_quantity
					)
					AND (
						"deleted_at" > NOW()
						OR "deleted_at" IS NULL
					)
					GROUP BY
						sparepart_id,
						dealer_id,
						dealer_name,
						quantity,
						dealer_price
					ORDER BY
						"dealer_name",
						quantity
					) AS T
				) t1
				GROUP BY
				dealer_id,
				dealer_name
				ORDER BY dealer_name';

		$data = $this->db->query($sql)->result();
		// print_r($data);

		$this->daily_credit_model->_table = 'view_daily_credits';
		foreach ($data as $key => $value) {
			$where = array(
				'date_en' => $date,
				'dealer_id' => $value->dealer_id,
			);

			$credit_limit = $this->daily_credit_model->find($where);
			if($credit_limit){
				if($credit_limit->credit_amount < 0){
					$data[$key]->credit_left = 0;
				}elseif($credit_limit->credit_amount <= $value->stock_amount){
					$data[$key]->credit_left = $credit_limit->credit_amount;
				}else{
					$data[$key]->credit_left = $value->stock_amount;
				}
				$data[$key]->credit_amount = $credit_limit->credit_amount;
			}else{
				$data[$key]->credit_left = $value->stock_amount;
				$data[$key]->credit_amount = 0;
			}
		}
		echo json_encode($data);
   	}
}