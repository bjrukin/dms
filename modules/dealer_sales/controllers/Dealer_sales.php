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
 * Dealer_sales
 *
 * Extends the Project_Controller class
 * 
 */

class Dealer_sales extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Dealer Sales');

        $this->load->model('dealer_sales/dealer_sale_model');
        $this->lang->load('dealer_sales/dealer_sale');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('dealer_sales');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'dealer_sales';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->dealer_sale_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->dealer_sale_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->dealer_sale_model->insert($data);
        }
        else
        {
            $success=$this->dealer_sale_model->update($data['id'],$data);
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
		$data['sparepart_id'] = $this->input->post('sparepart_id');
		$data['party_name'] = $this->input->post('party_name');
		$data['quantity'] = $this->input->post('quantity');
		$data['price'] = $this->input->post('price');
		$data['date'] = $this->input->post('date');
		$data['nep_date'] = $this->input->post('nep_date');

        return $data;
   }
}