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
 * Stockyards
 *
 * Extends the Project_Controller class
 * 
 */

class Stockyards extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Spareparts Stockyard');

        $this->load->model('stockyards/stockyard_model');
        $this->lang->load('stockyards/stockyard');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('stockyards');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'stockyards';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->stockyard_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->stockyard_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->stockyard_model->insert($data);
        }
        else
        {
            $success=$this->stockyard_model->update($data['id'],$data);
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
		$data['name'] = strtoupper(trim($this->input->post('name')));
		$data['latitude'] = $this->input->post('latitude');
		$data['longitude'] = $this->input->post('longitude');
		$data['rank'] = $this->input->post('rank');
		$data['type'] = $this->input->post('type');
		$data['incharge_id'] = $this->input->post('incharge_id');
		$data['location'] = $this->input->post('location');

        return $data;
   }

   public function get_user_combo_json()
	{
		$where = array(700,703) ;
		$this->db->where('group_id',700);
		$this->db->or_where('group_id',703);
		$rows=$this->db->get('view_user_groups')->result();

        array_unshift($rows, array('user_id' => '0', 'fullname' => 'Select User'));

        echo json_encode($rows);
        exit;
	}

	public function save_user()
	{
		$this->db->trans_begin();
		// var_dump($this->input->post());
		$data['stockyard_id'] = $this->input->post('id');
		$user_ids = explode(',', $this->input->post('user_id'));
		$this->stockyard_model->_table = 'sparepart_stockyard_users';
		$old_data = $this->stockyard_model->findAll($data);
		
		foreach ($old_data as $key => $value) {
			$this->stockyard_model->delete($value->id);
		}

		if($this->input->post('user_id')){
			foreach ($user_ids as $key => $value) {
				$data['user_id'] = $value;
				$this->stockyard_model->insert($data);
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	        $success = FALSE;
	        $msg = lang('general_failure');
		}
		else
		{
	        $this->db->trans_commit();
	        $success = TRUE;
	        $msg = lang('general_success');
		}
        echo json_encode(array('success' => $success, 'msg' => $msg));

	}

	public function getUsers()
	{
		$where['stockyard_id'] = $this->input->post('id');
		$this->stockyard_model->_table = ('sparepart_stockyard_users');
		$rows = $this->stockyard_model->find_All($where);

		echo json_encode(array('rows'=>$rows));
	}
}