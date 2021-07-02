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
 * Settings
 *
 * Extends the Project_Controller class
 * 
 */

class Settings extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Settings');

        $this->load->model('settings/setting_model');
        $this->lang->load('settings/setting');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('settings');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'settings';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->setting_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->setting_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->setting_model->insert($data);
        }
        else
        {
            $success=$this->setting_model->update($data['id'],$data);
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
		$data['code'] = $this->input->post('code');
		$data['key'] = $this->input->post('key');
		$data['value'] = $this->input->post('value');

        return $data;
   }

   	public function logistics_settings($value='')
   	{
   		control('Logistics Settings');

   		$where = array(
   			'code' => 'Logistics',
   		);
   		$data['rows'] = $this->setting_model->findAll($where);

   		// Display Page
		$data['header'] = lang('settings');
		$data['page'] = $this->config->item('template_admin') . "logistics_settings";
		$data['module'] = 'settings';
		$this->load->view($this->_container,$data);

   	}

   	public function custom_save()
   	{
   		$data = array(
   			'id'=>$this->input->post('id'),
   			'value'=>$this->input->post('value'),
   		);
   		$success = $this->setting_model->update($data['id'],$data);
   		if($success){
   			echo json_encode(array('success'=>$success,'msg'=>FALSE));
   		}else{
   			echo json_encode(array('success'=>$success,'msg'=>'Please try again.'));
   		}
   	}
}