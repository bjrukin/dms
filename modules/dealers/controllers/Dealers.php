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
 * Dealers
 *
 * Extends the Project_Controller class
 * 
 */

class Dealers extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Dealers');

		$this->load->model('dealers/dealer_model');
		$this->load->library('dealers/dealers_lib');
		$this->lang->load('dealers/dealer');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('dealers');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'dealers';

		$data['maps'] = internet_connection();

		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->dealer_model->_table = 'view_dealers';

		search_params();
		
		$total=$this->dealer_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->dealer_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->dealer_model->insert($data);
        }
        else
        {
        	$success=$this->dealer_model->update($data['id'],$data);
        }

        if($success)
        {
        	$success = TRUE;
        	$msg=lang('general_success');

        	$params['table'] = 'dms_dealers';
        	$params['fields'] = array('id','name');
        	$params['order'] = ' name asc';
        	$params['array_unshift'] = array('id' => '0', 'name' => 'Select Dealer');
        	$params['filename'] = "dealers";

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
    	$data['name'] 			= strtoupper($this->input->post('name'));
    	$data['incharge_id'] 	= $this->input->post('incharge_id');
    	$data['district_id'] 	= $this->input->post('district_id');
    	$data['mun_vdc_id'] 	= $this->input->post('mun_vdc_id');
    	$data['city_place_id'] 	= $this->input->post('city_place_id');
    	$data['address_1'] 		= $this->input->post('address_1');
    	$data['address_2'] 		= $this->input->post('address_2');
    	$data['phone_1'] 		= $this->input->post('phone_1');
    	$data['phone_2'] 		= $this->input->post('phone_2');
    	$data['email'] 			= $this->input->post('email');
    	$data['fax'] 			= $this->input->post('fax');
    	$data['latitude']		= $this->input->post('latitude');
    	$data['longitude'] 		= $this->input->post('longitude');
        $data['remarks']        = $this->input->post('remarks');
    	$data['rank'] 		    = $this->input->post('rank');
        $data['spares_incharge_id']        = $this->input->post('sparepart_incharge');
        $data['service_incharge_id']        = $this->input->post('service_incharge');

        $data = array_filter($data, function($value) {
            return ($value !== null && $value !== false && $value !== ''); 
        });

    	return $data;
    }

    public function excel_export()
    {
    	$this->dealers_lib->excel_export_dealers();
    }
}