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
 * Discount_schemes
 *
 * Extends the Project_Controller class
 * 
 */

class Discount_schemes extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Discount Schemes');

		$this->load->model('discount_limits/discount_limit_model');
		$this->load->model('vehicle_processes/vehicle_process_model');
		$this->load->model('discount_schemes/discount_scheme_model');
		$this->lang->load('discount_schemes/discount_scheme');
        $this->load->model('customers/customer_model');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('discount_schemes');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'discount_schemes';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->discount_scheme_model->_table = 'view_sales_discount_schemes';
		$where = NULL;

		if(is_sales_executive()) {
			$where = array('created_by'=>$this->_user_id);
		}
		else if(is_dealer_incharge()) {
			$where = array('incharge_id' => $this->_user_id, 'approval' => null);
		}
		else if (is_showroom_incharge()) {
			 $where = array('dealer_id' => $this->session->userdata('employee')['dealer_id'], 'approval' => null);
		}
		else if(is_sales_head()) {
			// $where = array('dealer_incharge_id' => 1, 'approval' => 4);
			//$where = "dealer_incharge_id = 1 OR showroom_incharge_id = 1 AND approval = 4  AND management_incharge_id IS NULL";
			$where = "(dealer_incharge_id = 1 OR showroom_incharge_id = 1 AND approval = 4  AND management_incharge_id IS NULL) AND (dealer_id = 1 OR dealer_id = 2)";

		}		
		else if(is_manager()) {
			// $where = array('management_incharge_id' => 1, 'approval' => 4);
			$where = "(management_incharge_id = 1 AND approval = 4) AND (dealer_id = 1 OR dealer_id = 2)";
		}
		else{
			$where = array('admin' => 1, 'approval' => 4);
		}

		// $where['approval'] = null;

		search_params();

		$total=$this->discount_scheme_model->find_count($where);

		paging('id','desc');

		search_params();

		$rows=$this->discount_scheme_model->findAll($where);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data

		if(!$this->input->post('id'))
		{
			$success=$this->discount_scheme_model->insert($data);
		}
		else
		{
			$success=$this->discount_scheme_model->update($data['id'],$data);
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
		
		/*$data['actual_price'] = $this->input->post('actual_price');
		$data['discount_request'] = $this->input->post('discount_request');
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['variant_id'] = $this->input->post('variant_id');
		$data['color_id'] = $this->input->post('color_id');
		$data['approval'] = $this->input->post('approval');
		$data['approved_by'] = $this->input->post('approved_by');
		$data['approved_date'] = $this->input->post('approved_date');
		$data['customer_id'] = $this->input->post('customer_id');*/
		$data['remarks'] = $this->input->post('remarks');

		return $data;
	}

	public function save_discounts_request()
	{
		$data = $this->input->post();

		$this->db->trans_begin();

		if(empty($data['id']))
		{
			unset($data['id']);
			$success=$this->discount_scheme_model->insert($data);
		}
		else
		{
			$data['approved_date'] = date("Y-m-d");
			$success=$this->discount_scheme_model->update($data['id'],$data);
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$msg=lang('general_failure');
			$success = FALSE;
		}
		else
		{
			$this->db->trans_commit();
			$msg=lang('general_success');
			$success = TRUE;
		}

		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;

		// return array($msg, $success);
	}

	public function discount_operation($option = NULL, $discount_id = NULL,$customer_id = NULL)
	{
		$discount_id = ($discount_id == NULL)?$this->input->post('discount_id'):$discount_id;

		if ($discount_id == null) 
		{
		// Error
			echo "error";
			exit;
		}
		if($customer_id == NULL)
		{
			$customer_id = $this->input->post("customer_id");
		}

		// Reduced amout taken from form
		$reduced_discount = $this->input->post('reduced_discount');

		$this->db->trans_begin();
		$data['id'] = $discount_id;
		$data['approval'] = $option;
		$data['approved_by'] = $this->_user_id;
		$data['approved_date'] = date('Y-m-d');

		$discount = $this->discount_scheme_model->find(array('id'=>$discount_id));
		$discount = $discount->discount_request;
		
		$discount_vp = array(
			'id'    =>  $customer_id,
			'discount_amount'   =>  $discount
			);

		switch ($option) {
				//Approved
			case DISCOUNT_APPROVED:
			$success = $this->discount_scheme_model->update($data['id'],$data);
			$this->customer_model->update($discount_vp['id'],$discount_vp);
			break;

				//Reject
			case DISCOUNT_REJECTED:
			$success = $this->discount_scheme_model->update($data['id'],$data);
			// $this->vehicle_process_model->update($discount_vp['id'],$discount_vp);
			break;

				//Reduce
			case DISCOUNT_REDUCED:
			$data['reduced_discount'] = $reduced_discount;
			$discount_vp['discount_amount'] = $reduced_discount;
			$success = $this->discount_scheme_model->update($data['id'],$data);
			$this->customer_model->update($discount_vp['id'],$discount_vp);
			break;

				//Forward
			case DISCOUNT_FORWARD:
			if(is_dealer_incharge())
			{
				$data['dealer_incharge_id'] = 1;
			}
			if(is_showroom_incharge())
			{
				$data['showroom_incharge_id'] = 1;
			}
			if(is_sales_head())
			{
				$data['management_incharge_id'] = 1;
			}
			if(is_manager())
			{
				$data['management_incharge_id'] = 0;
				$data['admin'] = 1;
			}

			$success = $this->discount_scheme_model->update($data['id'],$data);
			break;

				//Delete
			case 5:
			$success = $this->discount_scheme_model->delete($discount_id);
			break;

		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$msg=lang('general_failure');
			$success = FALSE;
		}
		else
		{
			$this->db->trans_commit();
			$msg=lang('general_success');
			$success = TRUE;
		}


		redirect($_SERVER['HTTP_REFERER']);
	}

	public function set_discount()
	{
		$post = $this->input->post();
		$success = false;
		$approvedDiscount = 0;

		$limits = $this->discount_limit_model->find(array('vehicle_id'=>$post['vehicle_id'], 'variant_id' => $post['variant_id']));

		$this->db->or_where('approval',1);
		$this->db->or_where('approval',3);
		$this->db->where('customer_id',$post['customer_id']);
		$requestedDiscount = $this->discount_scheme_model->find();
		if($requestedDiscount)
		{
			if($requestedDiscount->approval == 1)
			{
				$approvedDiscount = $requestedDiscount->discount_request;
			}
			else if($requestedDiscount->approval == 3){
				$approvedDiscount = $requestedDiscount->reduced_discount;
			}
		}

		if(is_sales_executive())
		{
			$success = ( $post['discount'] <= $limits->staff_limit )? TRUE: FALSE;
		}
		else if(is_showroom_incharge())
		{
			$success = ( $post['discount'] <= $limits->incharge_limit )? TRUE: FALSE;
		}
		else if(is_sales_head()) {
			$success = ( $post['discount'] <= $limits->sales_head_limit )? TRUE: FALSE;
		}
		else{
			$success = TRUE;
		}

		

		$this->db->trans_begin();
		//taking id
		// $id = $this->customer_model->find(array('customer_id'=>$post['customer_id']));
		$data = array(
			'id'    =>  $post['customer_id'],
			'discount_amount'   =>  $post['discount']
			);

		if( $success || $post['discount'] <= $approvedDiscount)
		{
			$this->customer_model->update($data['id'],$data);
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$msg=lang('general_failure');
				$success = FALSE;
			}
			else
			{
				$this->db->trans_commit();
				$msg = 'Successfully Updated Discount';
				$success = TRUE;
			}
		}
		else{
				//failure
			$msg = "Amount Exceeds than approved";
			$success = FALSE;
		}

		echo json_encode(array('success'=>$success, 'msg'=>$msg));
	}

	function reset_discount($customer_id = NULL) 
	{
		$data = array(
			'id'	=>	$customer_id,
			'discount_amount' => NULL
			);
		$this->db->trans_begin();

		$this->customer_model->update($data['id'],$data);

		$this->db->or_where('approval',1);
		$this->db->or_where('approval',3);
		$discount = $this->discount_scheme_model->findAll(array('customer_id'=>$customer_id));
		

		foreach ($discount as $key => $value) {
			$data = array(
				'id' => $value->id,
				'approval'=> 2
				);
			$this->discount_scheme_model->update($data['id'],$data);
		}


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$msg=lang('general_failure');
			$success = FALSE;
		}
		else
		{
			$this->db->trans_commit();
			$msg=lang('general_success');
			$success = TRUE;
		}
		

		// echo "<pre>"; print_r($success);exit;

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function print_discount($customer_id = NULL)
	{
		$this->discount_scheme_model->_table = "view_discount_approved";
		$data['rows'] = $this->discount_scheme_model->find(array('customer_id'=>$customer_id));
		$data['page'] = $this->config->item('template_admin') . "discount_slip";
		$data['module'] = 'discount_schemes';
		$this->load->view($data['page'], $data);
	}
}