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
 * User_ledgers
 *
 * Extends the Project_Controller class
 * 
 */

class User_ledgers extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('User Ledgers');

        $this->load->model('user_ledgers/user_ledger_model');
        $this->lang->load('user_ledgers/user_ledger');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('user_ledgers');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'user_ledgers';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->user_ledger_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->user_ledger_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->user_ledger_model->insert($data);
        }
        else
        {
            $success=$this->user_ledger_model->update($data['id'],$data);
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
		$data['title'] = $this->input->post('title');
		$data['short_name'] = $this->input->post('short_name');
		$data['full_name'] = $this->input->post('full_name');
		$data['address1'] = $this->input->post('address1');
		$data['address2'] = $this->input->post('address2');
		$data['address3'] = $this->input->post('address3');
		$data['city'] = $this->input->post('city');
		$data['area'] = $this->input->post('area');
		$data['district_id'] = $this->input->post('district_id');
		$data['zone_id'] = $this->input->post('zone_id');
		$data['pin_code'] = $this->input->post('pin_code');
		$data['std_code'] = $this->input->post('std_code');
		$data['mobile'] = $this->input->post('mobile');
		$data['phone_no'] = $this->input->post('phone_no');
		$data['email'] = $this->input->post('email');

        return $data;
   }
}