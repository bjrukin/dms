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
 * Target_records
 *
 * Extends the Project_Controller class
 * 
 */

class Target_records extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Target Records');

		$this->load->model('target_records/target_record_model');
		$this->lang->load('target_records/target_record');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('target_records');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'target_records';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$post = $this->input->post();

		$where = array(
			'dealer_id'     =>  $post['dealer_id'],
			'target_year'   =>  $post['target_year'],
			);
		$fields = 'revision';
		$this->db->select_max($fields);
		$rev = $this->db->get_where('sales_target_records',$where)->row()->revision;
		$this->session->set_userdata('editing_revision', $rev + 1);

		$this->target_record_model->_table = "view_sales_target_records";
		search_params();
		
		$total=$this->target_record_model->find_count($where);
		
		// paging('id');
		
		search_params();
		
		$where['revision'] = 0;
		$rows=$this->target_record_model->findAll($where);
		// echo $this->db->last_query();
		$rows = json_decode(json_encode($rows), true);

		$new_rows = array();
		for ($i=1; $i <= $rev; $i++) { 	
			$where['revision'] = $i;
			$update_rows= json_decode(json_encode($this->target_record_model->findAll($where)), true);

			foreach ($rows as $key => $value) {
				foreach ($update_rows as $k => $v) {
					if(
						$value['dealer_id'] == $v['dealer_id'] &&
						$value['target_year'] == $v['target_year'] &&
						$value['vehicle_id'] == $v['vehicle_id'] &&
						$value['month'] == $v['month'] 
						)
					{
						$new_rows[] = array_replace($value,$v);
						$match = true;
						break;
					}
					else{
						$match = false;
					}

				}
				if($match == false){
					$new_rows[] = $value;
				}
			}

			$rows = $new_rows;
		}
		$total = count($rows);
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data=$this->_get_posted_data(); //Retrive Posted Data

		if($this->session->userdata('enable_editing') == FALSE)
		{
			echo json_encode(array('msg'=>'','success'=>FALSE));
			exit;
		}
		$data['revision'] = $this->session->userdata('editing_revision');

		// print_r($data);exit;

		$success=$this->target_record_model->insert($data);

		// $success = $this->target_record_model->update($data['id'],$data);

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
		/*if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}*/
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['vehicle_classification'] = $this->input->post('vehicle_classification');
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['target_year'] = $this->input->post('target_year');
		$data['month'] = $this->input->post('month');
		$data['quantity'] = $this->input->post('quantity');
		// $data['revision'] = $this->input->post('revision');

		return $data;
	}

	public function get_target_year_combo_json(){
		$fields = "target_year";
		$this->db->group_by($fields);
		$rows = $this->target_record_model->findAll(null,$fields);

		echo json_encode($rows);
	}

	function editable_toggle(){
		$toggled = $this->input->post('toggled');
		if($toggled == 'true')
		{
			/*$field = 'revision';
			$this->db->select_max($field)->group_by($field);
			$rev = $this->target_record_model->find(array('target_year'=>$data['target_year'], 'dealer_id'=> $data['dealer_id']), $field)->revision + 1;*/

			$this->session->set_userdata('enable_editing',true);
		}
		else
		{
			$this->session->set_userdata('enable_editing',false);
			$this->session->unset_userdata('editing_revision');
		}

		print_r($this->session->all_userdata());

	}
}