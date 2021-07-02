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
* Rename the file to Customer.php
* and Define Module Library Function (if any)
*/

class Customer {

	public $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('customers/customer_model');
		$this->CI->load->model('customers/customer_status_model');
		$this->CI->load->model('customers/customer_followup_model');
		$this->CI->load->model('customers/customer_test_drive_model');
		$this->CI->load->model('customers/quotation_model');
		$this->CI->load->model('stock_records/stock_record_model');
		$this->CI->load->model('vehicle_processes/Vehicle_process_model');
		$this->CI->load->model('discount_schemes/discount_scheme_model');
		$this->CI->load->model('booking_cancels/booking_cancel_model');
		$this->CI->load->model('partial_payments/partial_payment_model');
		$this->CI->load->model('ccd_inquiries/ccd_inquiry_model');
		
		$this->CI->load->helper(array('project'));
	}

	// get customers list
	public function get_customers($view_name = 'view_customers', $fields = '*') 
	{
		$this->CI->customer_model->_table = $view_name;
		return $this->CI->customer_model->findAll(null, $fields);
	}

	// get customers count
	public function get_customers_count($view_name = 'view_customers') 
	{
		$this->CI->customer_model->_table = $view_name;
		return $this->CI->customer_model->find_count();
	}

	// get customer by id
	public function get_customer($customer_id) 
	{
		$this->CI->customer_model->_table = 'view_customers';
		return $this->CI->customer_model->get_by(array('id'=>$customer_id));
	}

	// save customer
	public function save_customer($data = array()) 
	{
		
		$this->CI->db->trans_begin();

		$primary_key = null;
		if(!array_key_exists('id', $data))
		{
			$data['status_id'] = 1;
			$success=$this->CI->customer_model->insert($data);
			$primary_key = $success;

			$followupData = array();

			$followupData['customer_id'] = $primary_key;
			$followupData['executive_id'] = $data['executive_id'];
			$followupData['followup_date_en']= date('Y-m-d', strtotime($data['inquiry_date_en']. ' + 3 days'));
			$followupData['followup_date_np']=  get_nepali_date($followupData['followup_date_en'], 'value' );
			$followupData['followup_status']= "Open";

			$this->CI->customer_followup_model->insert($followupData);
		}
		else
		{
			$success=$this->CI->customer_model->update($data['id'],$data);
			$primary_key = $data['id'];
		}

		if ($data['inquiry_no'] == '' || $data['inquiry_no'] == NULL){
			// update inquiry_no: PK-FY
			list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();

			$inquiry_no = sprintf("INQ-%06d/%s", intval($primary_key), $fiscal_year);

			$this->CI->customer_model->update($primary_key, array('id' => $primary_key, 'fiscal_year_id' => $fiscal_year_id,'inquiry_no' => $inquiry_no));
		}

		$old_status_id = $this->CI->input->post('old_status_id');

		// if status is changed, then update status
		if ($old_status_id != $data['status_id']) {

			$customerStatusData = array();

			$customerStatusData['customer_id'] = $primary_key; 
			$customerStatusData['status_id'] = $data['status_id']; 
			$customerStatusData['sub_status_id'] = 20; 
			$customerStatusData['duration'] = 0;

			// calculate duration between status change
			$this->CI->db->where('customer_id', $primary_key);
			if ($old_status_id != ''){
				$this->CI->db->where('status_id', $old_status_id);
			}
			$this->CI->db->order_by('created_at','desc');
			$oldStatusResult = $this->CI->customer_status_model->findAll();
			if ($oldStatusResult) {
				$date1 = date_create($oldStatusResult[0]->created_at);
				$date2 = date_create(date('Y-m-d H:i:s'));

				$diff = date_diff($date1, $date2);
				$customerStatusData['duration'] = $diff->format("%a");
			}

			$this->CI->customer_status_model->insert($customerStatusData);
		}

		if(!array_key_exists('id',$data))
		{
			$ccd['customer_id'] = $primary_key;
			$this->CI->ccd_inquiry_model->insert($ccd);
		}

		if ($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->db->trans_rollback();
			$msg=lang('general_failure');
			$success = FALSE;
		}
		else
		{
			$this->CI->db->trans_commit();
			$msg=lang('general_success');
			$success = TRUE;
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
		// exit;

		// return array($msg, $success);
	}

	public function get_customer_statuses($customer_id) 
	{
		$this->CI->customer_status_model->_table = 'view_customer_statuses';

		search_params();
		$this->CI->db->where('customer_id', $customer_id);        
		$total=$this->CI->customer_status_model->find_count();

		paging('id');

		search_params();
		$this->CI->db->where('customer_id', $customer_id);
		$rows=$this->CI->customer_status_model->findAll();

		return array($total, $rows);
	}

	public function get_customer_test_drives($customer_id) 
	{
		$this->CI->customer_test_drive_model->_table = 'view_customer_test_drives';

		search_params();
		$this->CI->db->where('customer_id', $customer_id); 

		$total=$this->CI->customer_test_drive_model->find_count();

		paging('id');

		search_params();
		$this->CI->db->where('customer_id', $customer_id);
		$rows=$this->CI->customer_test_drive_model->findAll();

		return array($total, $rows);
	}

	public function get_customer_followups($customer_id) 
	{
		$this->CI->customer_followup_model->_table = 'view_customer_followups';

		search_params();
		$this->CI->db->where('customer_id', $customer_id);        
		$total=$this->CI->customer_followup_model->find_count();

		paging('id');

		search_params();
		$this->CI->db->where('customer_id', $customer_id);
		$rows=$this->CI->customer_followup_model->findAll();

		return array($total, $rows);
	}

	public function save_customer_followup($data = array())
	{
		$this->CI->db->trans_begin();

		$reason_id = (isset($data['reason_id']) && $data['reason_id'] != '') ? $data['reason_id'] : NULL;
		unset($data['reason_id']);
		unset($data['old_status_id']);

		$data['next_followup'] = ($this->CI->input->post('next_followup')) ? TRUE : FALSE;
		if ($data['next_followup'] == FALSE) {
			$data['next_followup_date_en']= null;
			$data['next_followup_date_np']= null;
		}

		if(empty($data['id']))
		{
			unset($data['id']);
			$this->CI->customer_followup_model->insert($data);
		}
		else
		{
			$this->CI->customer_followup_model->update($data['id'],$data);
		}

		if ($data['followup_status'] == FOLLOWUP_STATUS_COMPLETED) 
		{
			$insertNextFollowup = FALSE;
			$statusArray = array();

			$this->CI->db->where('customer_id', $data['customer_id']);
			$this->CI->db->order_by('created_at','desc');
			$this->CI->db->limit(1);

			$currentStatusResult = $this->CI->customer_status_model->findAll();

			if ($currentStatusResult) {
				$currentStatus = $currentStatusResult[0]->status_id;
				if ($currentStatus < STATUS_RETAIL)
					$insertNextFollowup = TRUE;
			}  

			$new_followup = array();
			$new_followup['customer_id']            = $data['customer_id'];
			$new_followup['executive_id']           = $data['executive_id'];
			$new_followup['followup_status']        = FOLLOWUP_STATUS_OPEN;

			if ($data['next_followup'] == TRUE) { 
				$insertNextFollowup = TRUE;
				$new_followup['followup_date_en']   = $data['next_followup_date_en'];
				$new_followup['followup_date_np']   = $data['next_followup_date_np'];
			} else {
				$new_followup['followup_date_en']   = date('Y-m-d', strtotime($data['followup_date_en']. ' + 3 days'));
				$new_followup['followup_date_np']   = get_nepali_date($new_followup['followup_date_en'], 'value' );
			}

			$new_followup['followup_notes']         = null;
			$new_followup['next_followup']          = $data['next_followup'];
			$new_followup['next_followup_date_en']  = $new_followup['followup_date_en'];
			$new_followup['next_followup_date_np']  = $new_followup['followup_date_np'];

			if ($insertNextFollowup) {
				$this->CI->customer_followup_model->insert($new_followup);
			}
		}

		if ($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->db->trans_rollback();
			$success = FALSE;
		}
		else
		{
			$this->CI->db->trans_commit();
			$success = TRUE;
		}

		return $success;
	}

	public function save_customer_test_drive($data = array())
	{
		$this->CI->db->trans_begin();

		if(empty($data['id']))
		{
			unset($data['id']);
			$data['td_date_en'] = date('Y-m-d');
			$data['td_date_np'] = get_nepali_date($data['td_date_en'],1);
			$success=$this->CI->customer_test_drive_model->insert($data);
		}
		else
		{
			$success=$this->CI->customer_test_drive_model->update($data['id'],$data);
		}

		if ($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->db->trans_rollback();
			$msg=lang('general_failure');
			$success = FALSE;
		}
		else
		{
			$this->CI->db->trans_commit();
			$msg=lang('general_success');
			$success = TRUE;
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;

		return array($msg, $success);
	}

	public function save_customer_status($data = array())
	{
		$this->CI->db->trans_begin();

		// INSERT INTO STATUS TABLE
		$customerStatusData = array();

		$customerStatusData['customer_id']  	= $data['customer_id']; 
		$customerStatusData['status_id']   		= $data['status_id']; 
		$customerStatusData['sub_status_id']   	= $data['sub_status_id']; 
		$customerStatusData['reason_id']   		= ( isset($data['reason_id'])  && $data['reason_id'] !='' ) ? $data['reason_id'] : null; 
		$customerStatusData['duration']    		= 0;
		$customerStatusData['notes']       		= ( isset($data['notes'])  && $data['notes'] !='' ) ? $data['notes'] : null; 

		// calculate duration between status change
		$this->CI->db->where('customer_id', $data['customer_id']);
		$this->CI->db->order_by('created_at','desc');

		$oldStatusResult = $this->CI->customer_status_model->findAll();

		if ($oldStatusResult) {
			$date1 = date_create($oldStatusResult[0]->created_at);
			$date2 = date_create(date('Y-m-d H:i:s'));

			$diff = date_diff($date1, $date2);
			$customerStatusData['duration'] = $diff->format("%a");
		}

		$this->CI->customer_status_model->insert($customerStatusData);

		// IF FUNDING BANK THEN UPDATE CUSTOMER TABLE
		if (isset($data['funding_bank']) && $data['funding_bank']== 1) {
			$updateCustomerData = array();
			$updateCustomerData['id']           = $data['customer_id'];
			$updateCustomerData['bank_id']      = $data['bank_id'];
			$updateCustomerData['bank_branch']  = $data['bank_branch'];
			$updateCustomerData['bank_staff']   = $data['bank_staff'];
			$updateCustomerData['bank_contact'] = $data['bank_contact'];
			$updateCustomerData['status_id']    = $data['status_id'];

			$success=$this->CI->customer_model->update($updateCustomerData['id'],$updateCustomerData);
		}

		// IF QUOTATION ISSUED THEN SAVE QUOTATION
		if (isset($data['quote_price']) && $data['quote_price'] >0) {
			$quotationData = array();
			$quotationData['customer_id']       = $data['customer_id'];
			$quotationData['quotation_date_en'] = date('Y-m-d');
			$quotationData['quotation_date_np'] = get_nepali_date(date('Y-m-d'), 'value' );
			$quotationData['quote_mrp']         = $data['quote_mrp'];
			$quotationData['quote_discount']    = 0;
			$quotationData['quote_price']       = $data['quote_price'];
			$quotationData['quote_unit']        = $data['quote_unit'];

			$this->CI->quotation_model->insert($quotationData);
		}

		if (isset($data['cancel_amount']) && $data['cancel_amount'] >0)
		{
			$bookingCancel = array();
			$bookingCancel['customer_id'] = $data['customer_id'];
			$bookingCancel['cancel_amount'] = ( isset($data['cancel_amount'])  && $data['cancel_amount'] !='' ) ? $data['cancel_amount'] : null; 
			$bookingCancel['notes'] = ( isset($data['reason'])  && $data['reason'] !='' ) ? $data['reason'] : null; 
			$bookingCancel['cancel_reason'] = ( isset($data['booking_cancel_reason'])  && $data['booking_cancel_reason'] !='' ) ? $data['booking_cancel_reason'] : null; 

			$this->CI->booking_cancel_model->insert($bookingCancel);
		}

		if($customerStatusData['status_id'] == 3)
		{
			$booking = array();
			$booking['customer_id'] = $data['customer_id'];
			$booking['booked_date'] = date('Y-m-d');
			$np_date = get_nepali_date($booking['booked_date'],'true');
			$np_dates = explode('-', $np_date);
			$booking['booked_date_np'] = $np_date;
			$booking['booked_date_np_month'] = $np_dates['1'];
			$booking['booked_date_np_year'] = $np_dates['0'];
			$check_customer = $this->CI->Vehicle_process_model->findAll(array('customer_id'=>$data['customer_id']));
			if(empty($check_customer) || $check_customer == '')
			{
				$this->CI->Vehicle_process_model->insert($booking);
			}else if($oldStatusResult[0]->status_id == STATUS_CLOSED && $oldStatusResult[0]->sub_status_id == STATUS_BOOKING_CANCEL){
				$booking['id'] = $check_customer[0]->id;
				$this->CI->Vehicle_process_model->update($booking['id'],$booking);

			}else{
				
			}
		}

		if ($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->db->trans_rollback();
			$msg=lang('general_failure');
			$success = FALSE;
		}
		else
		{
			$this->CI->db->trans_commit();
			$msg=lang('general_success');
			$success = TRUE;
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;

		return array($msg, $success);
	}

	public function get_quotations($customer_id) 
	{
		$this->CI->quotation_model->_table = 'view_quotations';

		search_params();
		$this->CI->db->where('customer_id', $customer_id); 

		$total=$this->CI->quotation_model->find_count();

		paging('id');

		search_params();
		$this->CI->db->where('customer_id', $customer_id);
		$rows=$this->CI->quotation_model->findAll();

		return array($total, $rows);
	}

	public function get_quotation($quotation_id) 
	{
		$this->CI->quotation_model->_table = 'view_quotations';

		$this->CI->db->where('id', $quotation_id);

		$this->CI->quotation_model->as_array();

		$row = $this->CI->quotation_model->findAll();

		return $row[0];
	}
	public function get_customer_vehicle_process($customer_id) 
	{
		$this->CI->customer_model->_table = 'view_vehicle_process';
		return $this->CI->customer_model->get_by(array('id'=>$customer_id));
	}

	public function get_stock_records($dealer_id,$vehicle_id,$variant_id,$color_id) 
	{
		$this->CI->stock_record_model->_table = 'view_stock_details';
		$where = array(
			'dealer_id'=>$dealer_id,
			'vehicle_id'=>$vehicle_id,
			'variant_id'=>$variant_id,
			'dispatch_to_customers'=>NULL,
			'current_status <>'=>"damage",
			'received_date <>'=>NULL
		);
		if($color_id){
			$where['color_id']=$color_id;
		}
		return $this->CI->stock_record_model->findAll($where);
		
	}

	public function jqxupload($customer_id)
	{        
		$target_dir = "uploads/customer/".$customer_id.'/';  
		// oldmask = @umask(0);    
		// @mkdir($target_dir,0777,true);
		// @umask($oldmask);   

		$oldmask = @umask(0);    
		@mkdir($target_dir,0777,true);
		@umask($oldmask);
		// @mkdir($target_dir,777,true);
		$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
	public function save_receipt($data , $receipt_type)
	{
		if($receipt_type == 2){
			$success = $this->CI->partial_payment_model->insert($data);
		}
		else
		{
			if($receipt_type ==1)
			{
				$cus['id'] = $data['customer_id']; 
				$cus['special_discount_amount'] = $data['customer_discount']; 
				$s = $this->CI->customer_model->update($cus['id'],$cus);
				unset($data['customer_id']);
				unset($data['customer_discount']);
			}
			$success = $this->CI->Vehicle_process_model->update($data['id'],$data);
		}
		echo json_encode(array('success'=>$success));
		exit;
		return $success;
	}
	public function save_document($data)
	{
		$success = $this->CI->Vehicle_process_model->update($data['id'],$data);
		echo json_encode(array('success'=>$success));
		exit;
		return $success;
	}

	public function get_discounts($customer_id) 
	{
		$this->CI->discount_scheme_model->_table = 'view_sales_discount_schemes';

		search_params();
		$this->CI->db->where('customer_id', $customer_id); 

		$total=$this->CI->discount_scheme_model->find_count();

		paging('id');

		search_params();
		$this->CI->db->where('customer_id', $customer_id);
		$rows=$this->CI->discount_scheme_model->findAll();

		return array($total, $rows);
	}

	public function save_foc_details($data)
	{   

		$approval_type = 0;

		$this->CI->load->model('foc_documents/foc_document_model');
		$this->CI->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');
		$this->CI->load->model('foc_requests/foc_request_model');

		if($this->CI->input->post('customer_id'))
			$foc['customer_id'] = $data['customer_id'];

		if($this->CI->input->post('fuel')){
			$foc['fuel'] = $data['fuel'];
	
		}

		if($this->CI->input->post('free_servicing_coupon'))
			$foc['free_servicing'] = $data['free_servicing_coupon'];

		$array_explode = explode(',', $data['accessories_list']);
		foreach ($array_explode as $key => $value) 
		{
			$partcode[] = $this->CI->foc_accessoreis_partcode_model->find(array('id'=>$value));
		}

		foreach ($partcode as $key => $approval) 
		{
			if($approval->approval != 0 )
			{
				$app_required[] = $approval->id;
				if($approval_type < $approval->approval){
					$approval_type = $approval->approval;
				}
			}		
		}

		$checker = $this->CI->foc_document_model->find(array('customer_id'=>$foc['customer_id']));
		$this->CI->db->trans_begin();
		if(!empty($checker))
		{
			$foc['id'] = $checker->id;
			$this->CI->foc_document_model->update($foc['id'],$foc);
			$success1 = $checker->id;
		}
		else
		{
			$success1 = $this->CI->foc_document_model->insert($foc);
		}
		
		if ($this->CI->db->trans_status() === FALSE)
		{
			$this->CI->db->trans_rollback();
			$msg=lang('general_failure');
			$success = FALSE;
		}
		else
		{
			$this->CI->db->trans_commit();
			$msg=lang('general_success');
			$success = TRUE;
		}

		if(empty($app_required))
		{
			$req['foc_id'] = $success1;
			$req['customer_id'] = $data['customer_id'];
			$req['foc_approved_part'] = $data['accessories_list'];
			$req['approved_date'] = date('Y-m-d'); 
			$req['approved_date_nep'] = get_nepali_date(date('Y-m-d'),'nep'); 
			$this->CI->foc_request_model->insert($req);	
		}
		else
		{
			$success = 'approve';		
		}

		return array('msg'=>$msg,'success'=>$success,'required'=>$data['accessories_list'],'approval_type' => $approval_type);
	}

}

/* End of file Customer.php */
/* Location: ./modules/Customer/libraries/Customer.php */

