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
 * Spareparts_dealer_opening_credits
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts_dealer_opening_credits extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Spareparts Dealer Opening Credits');

        $this->load->model('spareparts_dealer_opening_credits/spareparts_dealer_opening_credit_model');
        $this->lang->load('spareparts_dealer_opening_credits/spareparts_dealer_opening_credit');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('spareparts_dealer_opening_credits');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'spareparts_dealer_opening_credits';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->spareparts_dealer_opening_credit_model->_table = 'view_spareparts_dealer_opening_credit';

		search_params();
		
		$total=$this->spareparts_dealer_opening_credit_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->spareparts_dealer_opening_credit_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->spareparts_dealer_opening_credit_model->insert($data);
        }
        else
        {
            $success=$this->spareparts_dealer_opening_credit_model->update($data['id'],$data);
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
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['opening_credit'] = $this->input->post('opening_credit');
		$data['date'] = date('Y-m-d');

        return $data;
   }
}