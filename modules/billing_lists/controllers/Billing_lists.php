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
 * Billing_lists
 *
 * Extends the Project_Controller class
 * 
 */

class Billing_lists extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Billing Lists');

        $this->load->model('billing_lists/billing_list_model');
        $this->lang->load('billing_lists/billing_list');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('billing_lists');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'billing_lists';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->billing_list_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->billing_list_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function get_list_json()
	{
		$this->billing_list_model->_table = 'view_d2d_billing_list';
		$where['bill_id'] = $this->input->post('id');
		$rows=$this->billing_list_model->findAll($where);
		
		echo json_encode(array('rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->billing_list_model->insert($data);
        }
        else
        {
            $success=$this->billing_list_model->update($data['id'],$data);
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
		$data['bill_id'] = $this->input->post('bill_id');
		$data['sparepart_id'] = $this->input->post('sparepart_id');
		$data['price'] = $this->input->post('price');
		$data['quantity'] = $this->input->post('quantity');
		$data['total_price'] = $this->input->post('total_price');

        return $data;
   	}

   	public function get_internal_billing_dealers_combo_json() 
	{
		$rows = array(
			array('id'=>0, 'name'=>'SATUNGAL'),
			array('id'=>2, 'name'=>'AIT DHOBIGHAT'),
			array('id'=>81, 'name'=>'AIT PVT. LTD. DHOBIGHAT'),
		);
		echo json_encode($rows);
	}

	public function delete()
	{
		$where['id'] = $this->input->post('id');
		$success = $this->billing_list_model->delete($where['id']);

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
}