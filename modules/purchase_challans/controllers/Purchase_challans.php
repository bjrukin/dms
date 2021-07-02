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
 * Purchase_challans
 *
 * Extends the Project_Controller class
 * 
 */

class Purchase_challans extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Purchase Challans');

		$this->load->model('purchase_challans/purchase_challan_model');
		$this->lang->load('purchase_challans/purchase_challan');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('purchase_challans');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'purchase_challans';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		search_params();
		
		$total=$this->purchase_challan_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->purchase_challan_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data = $this->_get_posted_data(); //Retrive Posted Data
        $challan_items = $data['challan_items'];
        $data = $data['data'];

        if(! isset($data['id'] ))
        {
        	$success = $this->purchase_challan_model->insert($data);

        	foreach ($challan_items as $key => $value) {
        		$challan = array(
        			'challan_id'		=> $success,
        			'part_id'			=> $value['part_id'],
        			'quantity'			=> $value['quantity'],
        			'order_pre'			=> $value['order_pre'],
        			'order_no'			=> $value['order_no'],
        			'bin_no'			=> $value['bin_no'],
        			);

        		$this->purchase_challan_model->_table = "ser_purchase_challan_items";
        		$this->purchase_challan_model->insert($challan);
        	}
        }
        else
        {
            $success = $this->purchase_challan_model->update($data['id'],$data);
            foreach ($challan_items as $key => $value) {
                $challan = array(
                    'challan_id'       => $data['id'],
                    
                    'id'               => $value['id'],
                    'part_id'          => $value['part_id'],
                    'quantity'         => $value['quantity'],
                    'order_pre'        => $value['order_pre'],
                    'order_no'         => $value['order_no'],
                    'bin_no'           => $value['bin_no'],
                    );

                $this->purchase_challan_model->_table = "ser_purchase_challan_items";
                if($value['id'] == '0')
                {
                    unset($challan['id']);
                    $this->purchase_challan_model->insert($challan);
                } else {
                    $this->purchase_challan_model->update($challan['id'], $challan);
                }
            }

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
        $data = $this->input->post();

    	/*$data['challan_date'] 			= $post['data']['challan_date'];
    	$data['challan_no'] 			= $post['data']['challan_no'];
    	$data['supplier_challan_no'] 	= $post['data']['supplier_challan_no'];
    	$data['supplier_challan_date'] 	= $post['data']['supplier_challan_date'];
    	$data['supplier_id'] 			= $post['data']['supplier_id'];
    	$data['challan_status'] 		= $post['data']['challan_status'];
    	$data['order_no'] 				= $post['data']['order_no'];
    	$data['remarks'] 				= $post['data']['remarks'];
    	$data['total_item'] 			= $post['data']['total_item'];

    	$data[]*/


    	$data['data'] = array_filter($data['data'], function($value) {
    		return ($value !== null && $value !== false && $value !== ''); 
    	});

    	return $data;
    }

    public function challan_items_json() {

    }

    public function get_challan_no() {
    	$this->db->order_by('challan_no','desc');
    	$id = $this->purchase_challan_model->find();
    	$id = ($id)?++$id->challan_no:1;
    	echo json_encode($id);
    }

    public function get_supplier_json() {
    	$this->purchase_challan_model->_table = "view_sparepart_dealers";
    	$data = $this->purchase_challan_model->findAll();

    	echo json_encode($data);
    }

    public function get_challan_items() {
        $post = $this->input->post();

        $this->purchase_challan_model->_table = "ser_purchase_challan_items";
        $rows = $this->purchase_challan_model->findAll(array('challan_id' => $post['id']));

        echo json_encode(array('rows' => $rows));
    }

}