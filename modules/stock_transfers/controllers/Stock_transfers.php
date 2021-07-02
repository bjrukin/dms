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
 * Stock_transfers
 *
 * Extends the Project_Controller class
 * 
 */

class Stock_transfers extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Stock Transfers');

		$this->load->model('stock_transfers/stock_transfer_model');
		$this->lang->load('stock_transfers/stock_transfer');
        $this->load->model('dealers/dealer_model');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('stock_transfers');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'stock_transfers';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->stock_transfer_model->_table = "view_sparepart_stock_transfers";
        $fields = "id, dealer_id, sparepart_id, request_quantity, request_date, request_date_nepali, dealer_name, dealer_location, latest_part_code, part_name, part_price, total_stock_transfered, remaining_stock";
        // search_params();
        
        // $this->db->group_by($fields);
        // $total=$this->stock_transfer_model->find_count(null, $fields);
        
        paging('id');
        
        search_params();
        
        $this->db->group_by($fields);
        $rows=$this->stock_transfer_model->findAll(null, $fields);
        $total = count($rows);
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->stock_transfer_model->insert($data);
        }
        else
        {
        	$success=$this->stock_transfer_model->update($data['id'],$data);
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

    public function save_transfer_stock()
    {
    	$post = $this->input->post();
        // print_r($post);exit;
        $data = array(
          'stock_transfer_id'		=>	$post['stock_transfers_id'],
          'dealer_to'			    =>	$post['dealer_id'],
          'dealer_from'			=>	$post['dealer_list'],
          'sparepart_id'			=>	$post['sparepart_id'],
          'current_stock'			=>	$post['current_stock'],
          'transfer_quantity'		=>	$post['provide_quantity'],
          'transfer_date'			=>	date('Y-m-d H:i:s')	
          );

        if($post['request_quantity'] == $post['total_stock_transfered']) {
            $success = FALSE;
            $msg = ('Transfers already fulfilled');
            echo json_encode(array('msg'=>$msg,'success'=>$success));
            exit;
        }

        $this->stock_transfer_model->_table = "spareparts_stock_transfer_log";
        $success = $this->stock_transfer_model->insert($data);

        if($success) {
            $this->stock_transfer_model->_table = "spareparts_dealer_stock";
            $data = array(
                'id'        =>  $post['dealer_stock_id'],
                'quantity'  =>  $post['provide_quantity']
                );
            $this->db->where('id',$data['id']) ->set('quantity', "quantity - {$data['quantity']}", FALSE) ->update('spareparts_dealer_stock');

            

        }

        /*if(!$this->input->post('id'))
        {
            $success=$this->stock_transfer_model->insert($data);
        }
        else
        {
            $success=$this->stock_transfer_model->update($data['id'],$data);
        }*/

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
    	$data['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
    	$data['sparepart_id'] = $this->input->post('sparepart_id');
    	$data['request_quantity'] = $this->input->post('request_quantity');
    	$data['request_date'] = date('Y-m-d');
    	$data['request_date_nepali'] = get_nepali_date(date('Y-m-d'),'nep');
		// $data['is_accepted'] = $this->input->post('is_accepted');

    	return $data;
    }

    public function request_stock()
    {
		// Display Page
    	$data['header'] = lang('stock_transfers');
    	$data['page'] =  "request_stock";
    	$data['module'] = 'stock_transfers';
    	$this->load->view($this->_container,$data);
    }

    public function request_stock_json() {
        $this->stock_transfer_model->_table = "view_sparepart_stock_transfers";
        $fields = "id, dealer_id, sparepart_id, request_quantity, request_date, request_date_nepali, dealer_name, dealer_location, latest_part_code, part_name, part_price, total_stock_transfered, remaining_stock";
        $where = array('dealer_id' => $this->session->userdata('employee')['dealer_id']);

        // search_params();

        // $this->db->group_by($fields);
        // $total = $this->stock_transfer_model->find_count($where, $fields);
        // echo $this->db->last_query();

        paging('id');

        search_params();

        $this->db->group_by($fields);
        $rows = $this->stock_transfer_model->findAll($where, $fields);
        $total = count($rows);
        // echo $this->db->last_query();

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_stock_by_dealer() {
    	$post = $this->input->post();

    	$this->stock_transfer_model->_table = "spareparts_dealer_stock";
    	$row = $this->stock_transfer_model->find(array('dealer_id' => $post['dealer_id'], 'sparepart_id' => $post['sparepart_id']));

    	echo json_encode(array('row'=> $row));

    }

    public function get_spareparts_combo_json(){
        $this->load->model('spareparts/sparepart_model');
        $search_name = strtoupper($this->input->get('name_startsWith'));
        $where["name LIKE '%{$search_name}%'"] = NULL;
        $data = $this->sparepart_model->findAll($where, NULL, NULL, NULL, 500);
        echo json_encode($data);
    }

    public function get_spareparts_dealers_json() 
    {
        $part_id = $this->input->post('part_id');

        $this->dealer_model->_table = "view_dealer_spareparts_relation";
        $this->dealer_model->order_by('dealer_name asc');
        
        $rows=$this->dealer_model->findAll(array('sparepart_id' => $part_id), array('id','dealer_quantity', 'quantity', 'dealer_stock_id'));

        echo json_encode($rows);
    }
}