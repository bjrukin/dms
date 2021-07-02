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
 * Sms_templates
 *
 * Extends the Project_Controller class
 * 
 */

class Sms_templates extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Sms Templates');

		$this->load->model('sms_templates/sms_template_model');
		$this->lang->load('sms_templates/sms_template');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('sms_templates');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'sms_templates';
		$this->load->view($this->_container,$data);
	}

	public function creator()
	{
		// Display Page
		$data['header'] = lang('sms_templates');
		$data['page'] = $this->config->item('template_admin') . "creator";
		$data['module'] = 'sms_templates';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->sms_template_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->sms_template_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->sms_template_model->insert($data);
        }
        else
        {
        	$success=$this->sms_template_model->update($data['id'],$data);
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

    public function save_template() {
    	$post = $this->input->post();
    	foreach ($post['message'] as $key => $value) {
    		$skeleton[] = $value;
    		$skeleton[] = $post['variables'][$key];
    	}
    	// $message = implode('', $skeleton);
    	$data = array(
    		'id'		=>	$post['id'],
    		'message'	=>	$post['messageboard'],
    		'skeleton'	=>	json_encode($skeleton),
    		);

    	$success = $this->sms_template_model->update($data['id'], $data);

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
    	$data['type'] = $this->input->post('type');
    	$data['variables'] = $this->input->post('variables');
    	$data['message'] = $this->input->post('message');

    	return $data;
    }

    function get_variables_list($id = NULL) {

    	$rows = $this->sms_template_model->find(array('id'=> $id));
    	
    	$variables = explode(", ", $rows->variables);
    	foreach ($variables as $key => $value) {
    		$newdata[$key]['variables'] = $value;
    	}

    	echo json_encode($newdata);

    }
}