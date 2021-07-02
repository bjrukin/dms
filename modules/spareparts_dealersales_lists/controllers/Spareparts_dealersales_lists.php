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
 * Spareparts_dealersales_lists
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts_dealersales_lists extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Spareparts Dealersales Lists');

        $this->load->model('spareparts_dealersales_lists/spareparts_dealersales_list_model');
        $this->lang->load('spareparts_dealersales_lists/spareparts_dealersales_list');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('spareparts_dealersales_lists');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'spareparts_dealersales_lists';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->spareparts_dealersales_list_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->spareparts_dealersales_list_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->spareparts_dealersales_list_model->insert($data);
        }
        else
        {
            $success=$this->spareparts_dealersales_list_model->update($data['id'],$data);
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
		$data['quantity'] = $this->input->post('quantity');
		$data['price'] = $this->input->post('price');

        return $data;
   }
}