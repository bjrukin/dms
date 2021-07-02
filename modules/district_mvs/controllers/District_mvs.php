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
 * District_mvs
 *
 * Extends the Project_Controller class
 * 
 */
class District_mvs extends Project_Controller
{
	public function __construct(){
		parent::__construct();

		$this->load->model('district_mvs/district_mv_model');
		$this->lang->load('district_mvs/district_mv');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('district_mvs');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'district_mvs';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->district_mv_model->_table = 'view_district_mvs';
		search_params();
		$total=$this->district_mv_model->find_count();
		paging('id');
		search_params();
		$rows=$this->district_mv_model->findAll();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->district_mv_model->insert($data);
        }
        else
        {
        	$success=$this->district_mv_model->update($data['id'],$data);
        }

        if($success)
        {
        	$success = TRUE;
        	$msg=lang('success_message');

            $parent_id = $this->input->post('parent_id');

            $params['table'] = 'view_district_mvs';
            $params['fields'] = array('id','name');
            $params['where'] = array('parent_id' => $parent_id);
            $params['order'] = ' name asc';
            $params['array_unshift'] = array('id' => '0', 'name' => 'Select MUN/VDC');
            $params['filename'] = "mun_vdc_{$parent_id}";

            $this->load->library('project');

            $this->project->write_cache($params);

        }
        else
        {
        	$success = FALSE;
        	$msg=lang('failure_message');
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }

    private function _get_posted_data()
    {
    	$data=array();
    	$data['id'] = $this->input->post('id');
    	$data['code'] = $this->input->post('code');
    	$data['name'] = $this->input->post('name');
    	$data['parent_id'] = $this->input->post('parent_id');
    	$data['type'] = $this->input->post('type');
    	$data['boundary_coordinates'] = $this->input->post('boundary_coordinates');
    	$data['created_by'] = $this->input->post('created_by');
    	$data['updated_by'] = $this->input->post('updated_by');
    	$data['deleted_by'] = $this->input->post('deleted_by');
    	$data['created_at'] = $this->input->post('created_at');
    	$data['updated_at'] = $this->input->post('updated_at');
    	$data['deleted_at'] = $this->input->post('deleted_at');

    	return $data;
    }

    /**
    *
    * This function is called from view to populate combobox of jqxCombobox
    *
    * @access  public
    * @param   null
    * @return  null
    *

    public function get_districts_combo_json()
    {
        $this->load->model('district_mvs/district_mv_model');
        $this->db->where('type', 'DISTRICT');
        $this->district_mv_model->_table = 'view_district_mvs';
        $this->district_mv_model->order_by('name asc');
        $rows=$this->district_mv_model->findAll(null, array('id','name'));
        array_unshift($rows, array('id' => '0', 'name' => 'Select District'));
        echo 'db';
        echo json_encode($rows);
    }

    /**
    *
    * This function is called from view to populate combobox of jqxCombobox
    *
    * @access  public
    * @param   null
    * @return  null
    *

    public function get_mun_vdcs_combo_json()
    {
        $this->load->model('district_mvs/district_mv_model');
        $this->db->where('parent_id', $this->input->get('parent_id'));
        $this->district_mv_model->_table = 'view_district_mvs';
        $this->district_mv_model->order_by('name asc');
        $rows=$this->district_mv_model->findAll(null, array('id','name'));
        array_unshift($rows, array('id' => '0', 'name' => 'Select MUN/VDC'));
        echo json_encode($rows);
    }
    */
}