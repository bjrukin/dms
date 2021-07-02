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
 * Accessories
 *
 * Extends the Project_Controller class
 * 
 */

class Accessories extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Accessories');

        $this->load->model('accessories/accessory_model');
        $this->lang->load('accessories/accessory');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('accessories');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'accessories';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->accessory_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->accessory_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->accessory_model->insert($data);
        }
        else
        {
            $success=$this->accessory_model->update($data['id'],$data);
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
		// string with single whitespace and uppercase
		$name = trim(preg_replace('!\s+!', ' ', ucwords($this->input->post('name'))), " ");

   		$data=array();
   		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}

		$data['name'] 		= $name;
		$data['rank'] 		= $this->input->post('rank');

        return $data;
   }

   // for combobox
   	public function get_accessories_combo_json(){
        
        $rows=$this->accessory_model->findAll();

        array_unshift($rows, array('id' => '0', 'name' => 'Select Accessories'));

        echo json_encode($rows);
        exit;
   	}
}