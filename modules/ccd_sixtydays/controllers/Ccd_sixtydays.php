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
 * Ccd_sixtydays
 *
 * Extends the Project_Controller class
 * 
 */

class Ccd_sixtydays extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Ccd Sixtydays');

        $this->load->model('ccd_sixtydays/ccd_sixtyday_model');
        $this->lang->load('ccd_sixtydays/ccd_sixtyday');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('ccd_sixtydays');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'ccd_sixtydays';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->ccd_sixtyday_model->_table = "view_ccd_sixtydays";
		search_params();
		
		$total=$this->ccd_sixtyday_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->ccd_sixtyday_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->ccd_sixtyday_model->insert($data);
        }
        else
        {
            $success=$this->ccd_sixtyday_model->update($data['id'],$data);
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
   		$data['id'] = $this->input->post('id');
   		$this->db->select("MAX('call_count') as call_count");
    	$this->db->where('id',$data['id']);
    	$this->db->group_by('id');
    	$max_count = $this->ccd_sixtyday_model->find();
        $data['call_count'] = (($max_count->call_count)+1);
    	$data['call_status'] = $this->input->post('call_status');
    	$data['date_of_call'] = date('Y-m-d');
        $data['date_of_call_np'] = get_nepali_date($data['date_of_call'],'nep');
		$data['ownership_transfer'] = $this->input->post('ownership_transfer');
		$data['performance'] = $this->input->post('performance');
		$data['smr_effectiveness'] = $this->input->post('smr_effectiveness');
		$data['voc'] = $this->input->post('voc');

        return $data;
   }
}