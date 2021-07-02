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
 * Damages
 *
 * Extends the Project_Controller class
 * 
 */

class Damages extends Project_Controller
{
	protected $uploadPath = 'uploads/damage';
	protected $uploadthumbpath= 'uploads/damage/thumb/';
	public function __construct()
	{

		parent::__construct();

		control('Damages');

		$this->load->model('damages/damage_model');
		$this->lang->load('damages/damage');
		$this->load->model('dispatch_records/dispatch_record_model');
		$this->load->model('repairs/repair_model');
		$this->lang->load('damages/damage');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('damages');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'damages';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->damage_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->damage_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data
        array_filter($data);
        if(!$this->input->post('id'))
        {
        	$success=$this->damage_model->insert($data);
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

    	$data['part'] = $this->input->post('part');
        $data['category'] = $this->input->post('category');
    	$data['dispatch_id'] = $this->input->post('dispatch_id');
    	$data['chass_no'] = $this->input->post('chass_no');
    	$data['description'] = $this->input->post('description');
    	$data['vehicle_id'] = $this->input->post('vehicle_id');
    	$data['image'] = $this->input->post('damage_image_name');
    	$data['service_center'] = $this->input->post('service_center');
    	$data['amount'] = $this->input->post('amount');
    	$data['estimated_date_of_repair'] = $this->input->post('estimated_date_of_repair');
    	return $data;
    }


    public function get_vehicle_details()
    {

    	$vehicle_id = $this->input->post('vehicle_id');
    	$this->damage_model->_table='view_damage_details';
    	$this->db->where('vehicle_id',$vehicle_id);
    	$rows=$this->damage_model->findAll();
    	echo json_encode($rows);
    }


    public function get_dispatch()
    {
    	$this->dispatch_record_model->_table='msil_dispatch_records';
    	echo json_encode($records);
    }

    function upload_image(){

		//Image Upload Config
    	$config['upload_path'] = $this->uploadPath;
    	$config['allowed_types'] = 'gif|png|jpg';
    	$config['max_size']	= '10240';
    	$config['remove_spaces']  = true;
		//load upload library
    	$this->load->library('upload', $config);
    	if(!$this->upload->do_upload())
    	{
    		$data['error'] = $this->upload->display_errors('','');
    		echo json_encode($data);
    	}
    	else
    	{
    		$data = $this->upload->data();
    		$config['image_library'] = 'gd2';
    		$config['source_image'] = $data['full_path'];
    		$config['new_image']    = $this->uploadthumbpath;
		  //$config['create_thumb'] = TRUE;
    		$config['maintain_ratio'] = TRUE;
    		$config['height'] =100;
    		$config['width'] = 100;

    		$this->load->library('image_lib', $config);
    		$this->image_lib->resize();
    		echo json_encode($data);
    	}
    }
    public function Repair_save()
    {
        $data=$this->_get_repair_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->repair_model->insert($data);
        }
        else
        {
        	$success=$this->repair_model->update($data['id'],$data);
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

    private function _get_repair_posted_data()
    {
    	$data=array();
    	if($this->input->post('id')) {
    		$data['id'] = $this->input->post('id');
    	}
    	$data['vehicle_name'] = $this->input->post('vehicle_name');
    	$data['vehicle_id'] = $this->input->post('vehicle_id');
    	$data['color_name'] = $this->input->post('color_name');
    	$data['variant_name'] = $this->input->post('variant_name');
    	$data['description'] = $this->input->post('description');
    	$data['image'] = $this->input->post('image');
    	// $data['chass_no'] = $this->input->post('chass_no');
    	$data['engine_no'] = $this->input->post('engine_no');

    	return $data;
    }

}
