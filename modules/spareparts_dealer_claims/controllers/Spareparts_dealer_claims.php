
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
 * Spareparts_dealer_claims
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts_dealer_claims extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Spareparts Dealer Claims');

        $this->load->model('spareparts_dealer_claims/spareparts_dealer_claim_model');
        $this->lang->load('spareparts_dealer_claims/spareparts_dealer_claim');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('spareparts_dealer_claims');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'spareparts_dealer_claims';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
	
		$this->spareparts_dealer_claim_model->_table = "view_spareparts_dealer_claim";
		$total=$this->spareparts_dealer_claim_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->spareparts_dealer_claim_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save_approve($status)
	{
		$data['id'] = $this->input->post('id');
		$data['status'] = $status;
        $success=$this->spareparts_dealer_claim_model->update($data['id'],$data);

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