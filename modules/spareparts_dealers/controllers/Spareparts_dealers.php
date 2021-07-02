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
 * Spareparts_dealers
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts_dealers extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Spareparts Dealers');

		$this->load->model('spareparts_dealers/spareparts_dealer_model');
		$this->lang->load('spareparts_dealers/spareparts_dealer');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('spareparts_dealers');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'spareparts_dealers';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->spareparts_dealer_model->_table = 'view_sparepart_dealers';
		search_params();
		
		$total=$this->spareparts_dealer_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->spareparts_dealer_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->spareparts_dealer_model->insert($data);
        }
        else
        {
        	$success=$this->spareparts_dealer_model->update($data['id'],$data);
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
    	$data['name'] = $this->input->post('name');
    	$data['incharge_id'] = $this->input->post('incharge_id');
    	$data['district_id'] = $this->input->post('district_id');
    	$data['mun_vdc_id'] = $this->input->post('mun_vdc_id');
    	$data['city_place_id'] = $this->input->post('city_place_id');
    	$data['address_1'] = $this->input->post('address_1');
    	$data['address_2'] = $this->input->post('address_2');
    	$data['phone_1'] = $this->input->post('phone_1');
    	$data['phone_2'] = $this->input->post('phone_2');
    	$data['email'] = $this->input->post('email');
    	$data['fax'] = $this->input->post('fax');
    	$data['latitude'] = $this->input->post('latitude');
    	$data['longitude'] = $this->input->post('longitude');
    	$data['remarks'] = $this->input->post('remarks');
    	$data['credit_policy'] = $this->input->post('credit_policy');
    	$data['prefix'] = $this->input->post('prefix');

    	return $data;
    }
}