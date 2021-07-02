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
 * City_places
 *
 * Extends the Project_Controller class
 * 
 */

class City_places extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('City Places');

        $this->load->model('city_places/city_place_model');
        $this->lang->load('city_places/city_place');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('city_places');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'city_places';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->city_place_model->_table = 'view_city_places';

		search_params();
		
		$total=$this->city_place_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->city_place_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->city_place_model->insert($data);
        }
        else
        {
            $success=$this->city_place_model->update($data['id'],$data);
        }

		if($success)
		{
			$success = TRUE;
			$msg=lang('general_success');

			$mun_vdc_id = $this->input->post('mun_vdc_id');

            $params['table'] = 'view_city_places';
            $params['fields'] = array('id','name');
            $params['where'] = array('mun_vdc_id' => $mun_vdc_id);
            $params['order'] = ' name asc';
            $params['array_unshift'] = array('id' => '0', 'name' => 'Select City');
            $params['filename'] = "city_places_{$mun_vdc_id}";

            $this->load->library('project');

            $this->project->write_cache($params);
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
		$data['name'] = $this->input->post('name');
		$data['district_id'] = $this->input->post('district_id');
		$data['mun_vdc_id'] = $this->input->post('mun_vdc_id');

        return $data;
   }
}