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
 * Transfer
 *
 * Extends the Project_Controller class
 * 
 */

class Transfer extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		//control('Sparepart Stocks');

		$this->load->model('sparepart_stocks/sparepart_stock_model');
		$this->load->model('stockyards/stockyard_model');
		$this->load->model('spareparts/sparepart_model');
        $this->load->library('sparepart_stocks/sparepart_stock');
        
		$this->lang->load('sparepart_stocks/sparepart_stock');
	}

	public function index()
	{
        // echo 'here';
        // exit;
		// Display Page
		$data['header'] = lang('sparepart_stocks');
		$data['page'] = $this->config->item('template_admin') . "transfer/index";
		$data['module'] = 'sparepart_stocks';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		// $id = $this->session->userdata('id');
		/*$stockyard = $this->stock_yard_model->find(array('incharge_id'=>$id));
		if(is_sparepart_incharge())
		{
			$where = array('stockyard_id'=>$stockyard->id);
		}
		if(is_sparepart_dealer())
		{
			$this->sparepart_stock_model->_table = 'view_sparepart_stock_dealer';
			$where = array('incharge_id'=>$this->session->userdata('id'));			
		}*/

		$this->sparepart_stock_model->_table = 'view_sparepart_real_stock';			
		search_params();
		$total=$this->sparepart_stock_model->find_count();
		
		search_params();
        paging('id');
        $rows=$this->sparepart_stock_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

    public function dispatch_json()
    {
        // $id = $this->session->userdata('id');
        /*$stockyard = $this->stock_yard_model->find(array('incharge_id'=>$id));
        if(is_sparepart_incharge())
        {
            $where = array('stockyard_id'=>$stockyard->id);
        }
        if(is_sparepart_dealer())
        {
            $this->sparepart_stock_model->_table = 'view_sparepart_stock_dealer';
            $where = array('incharge_id'=>$this->session->userdata('id'));          
        }*/

        $this->sparepart_stock_model->_table = 'view_stockyard_stock_transfer';         
        search_params();
        $total=$this->sparepart_stock_model->find_count();
        
        search_params();
        paging('id');
        $rows=$this->sparepart_stock_model->findAll();
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function recive_json()
    {
        // $id = $this->session->userdata('id');
        /*$stockyard = $this->stock_yard_model->find(array('incharge_id'=>$id));
        if(is_sparepart_incharge())
        {
            $where = array('stockyard_id'=>$stockyard->id);
        }
        if(is_sparepart_dealer())
        {
            $this->sparepart_stock_model->_table = 'view_sparepart_stock_dealer';
            $where = array('incharge_id'=>$this->session->userdata('id'));          
        }*/

        $this->sparepart_stock_model->_table = 'view_stockyard_stock_transfer';         
        search_params();
        $total=$this->sparepart_stock_model->find_count();
        
        search_params();
        paging('id');
        $rows=$this->sparepart_stock_model->findAll();
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

	public function save()
    {
        $data=$this->_get_posted_data(); //Retrive Posted Data

        $old_data = $this->sparepart_stock_model->find_count(array('sparepart_id'=>$data['sparepart_id'],'stockyard_id'=>NULL));

        if($old_data > 0){
            $success = FALSE;
            $msg = 'Part code already exists';

        }else{
            if(!$this->input->post('id'))
            {
                $success=$this->sparepart_stock_model->insert($data);
            }
            else
            {
                $success=$this->sparepart_stock_model->update($data['id'],$data);
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
    	$data['sparepart_id'] = $this->input->post('sparepart_code');
    	$data['location'] = $this->input->post('location');
        $data['stockyard_id'] = $this->input->post('stockyard_id');
    	/*if(is_sparepart_incharge())
    	{
    		$id = $this->session->userdata('id');
    		//$stockyard = $this->stock_yard_model->find(array('incharge_id'=>$id));
    		//$data['stockyard_id'] = $stockyard->id;
    	}*/
    	return $data;
    }

    public function update_data()
    {
        $data['id'] = $this->input->post('id');
        $data[$this->input->post('column')] = $this->input->post('newvalue');
        $success = $this->sparepart_stock_model->update($data['id'],$data);
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


    public function transfer()
    {
        $data['header'] = lang('sparepart_stocks');
        $data['page'] = $this->config->item('template_admin') . "transfer";
        $data['module'] = 'sparepart_stocks';
        $this->load->view($this->_container,$data);
    }

    public function get_stockyard()
    {
        $where = array();
        $rows = $this->stockyard_model->findAll($where);
        array_unshift($rows, array('id' => '0', 'name' => 'Select User'));
        echo json_encode($rows);
    }

    public function get_barcode_values()
    {
        // print_r($this->input->post());
        $this->sparepart_stock_model->_table = 'view_sparepart_real_stock';
        $where['part_code'] = $this->input->post('code');
        $where['stockyard_id'] = $this->input->post('stock_from');
        $where['stock_quantity > 0'] = NULL;

        $stock = $this->sparepart_stock_model->find($where);
        // echo $this->db->last_query();
        if(!$stock){
            $success = false;
            $msg = 'out of stock';
        }else{
            $data = array(
                'stock_from' => $this->input->post('stock_from'),
                'stock_to' => $this->input->post('stock_to'),
                'status' => 'NOT SEND'
            );
            $this->sparepart_stock_model->_table = 'spareparts_stock_transfers';
            $pending_to_send = $this->sparepart_stock_model->find($data);
            if(!$pending_to_send){
                $transfer_id = $this->sparepart_stock_model->insert($data);
            }else{
                $transfer_id = $pending_to_send->id;
            }

            $data = array(
                'transfer_id' => $transfer_id,
                'sparepart_id' => $stock->sparepart_id,
                'quantity' => 1,
            );

            $this->sparepart_stock_model->_table = 'spareparts_stock_transfer_lists';
            $success = $this->sparepart_stock_model->insert($data);
            $success = true;
            $msg = '';
        }
        // var_dump($stock);

        echo json_encode(array('success'=>$success, 'msg'=>$msg));
        exit;
    }

    public function not_send_list()
    {
        $where['stock_from'] = $this->input->get('stock_from');
        $where['stock_to'] = $this->input->get('stock_to');
        $where['status'] = 'NOT SEND';
        $this->sparepart_stock_model->_table = 'spareparts_stock_transfers';
        $transfer_detail = $this->sparepart_stock_model->find($where);

        $this->sparepart_stock_model->_table = 'view_stockyard_stock_transfer_list';
        $list_where['transfer_id'] = $transfer_detail->id;
        $rows = $this->sparepart_stock_model->find_all($list_where);

        echo json_encode($rows);

    }

    public function delete_item()
    {
        $this->sparepart_stock_model->_table = 'spareparts_stock_transfer_lists';

        $id = $this->input->post('id');
        $success = $this->sparepart_stock_model->delete($id);
        if($success){
            $success = TRUE;
            $msg = '';
        }else{
            $success = FALSE;
            $msg = 'error occured please try again';
        }

        echo json_encode(array('success'=>$success, 'msg'=>$msg));
    }

    public function update_quantity()
    {
        var_dump($this->input->post());
        $data['id'] = $this->input->post('id');
        $data['quantity'] = $this->input->post('quantity');
        print_r($this->input->post());
        exit;

        $this->sparepart_stock_model->_table = 'spareparts_stock_transfer_lists';
        $success = $this->sparepart_stock_model->update($data['id'],$data);

    }

    public function save_bill()
    {
        $data['dispatch_date_en'] = $this->input->post('dispatched_date_en');
        $data['dispatch_date_np'] = get_nepali_date($this->input->post('dispatched_date_en'),FALSE);
        $data['status'] = 'DISPATCHED';
        $data['id'] = $this->input->post('data')[0]['transfer_id'];
        $this->sparepart_stock_model->_table = 'spareparts_stock_transfers';
        $success = $this->sparepart_stock_model->update($data['id'],$data);

        if($success){
            $success = TRUE;
            $msg = '';
        }else{
            $success = FALSE;
            $msg = 'error occured please try again';
        }

        echo json_encode(array('success'=>$success, 'msg'=>$msg));
    }

    public function get_recent_dispatch_list()
    {
        $where['transfer_id'] = $this->input->get('id');

        $this->sparepart_stock_model->_table = 'view_stockyard_stock_transfer_list';         
        search_params();
        $total=$this->sparepart_stock_model->find_count($where);
        
        search_params();
        // paging('id');
        $rows=$this->sparepart_stock_model->findAll($where);
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function accept_stock()
    {
        $this->sparepart_stock->_table = 'spareparts_sparepart_stock';
        // echo '<pre>';
        $this->db->trans_begin();
        // print_r($this->input->post());
        $rows = $this->input->post('rows');

        $data['id'] = $this->input->post('transfer_id');
        $data['accepted_date_en'] = date('Y-m-d');
        $data['accepted_date_np'] = get_nepali_date(date('Y-m-d'),false);
        $data['status'] = 'ACCEPTED';
        $this->sparepart_stock_model->_table = 'spareparts_stock_transfers';
        $this->sparepart_stock_model->update($data['id'],$data);
        $transfer_data = $this->sparepart_stock_model->find(array('id'=>$data['id']));
        $stock_from = $transfer_data->stock_from;
        $stock_to = $transfer_data->stock_to;

        $this->sparepart_stock_model->_table = 'spareparts_stock_transfer_lists';
        foreach ($rows as $key => $value) {
            $list_data = array();
            $list_data['id'] = $value['id'];
            $list_data['accepted_quantity'] = ($value['accepted_quantity'] > 0)?$value['accepted_quantity']:$value['quantity'];
            $list_data['return_qty'] = $value['quantity'] - $list_data['accepted_quantity'];
            $this->sparepart_stock_model->update($list_data['id'],$list_data);

            $this->add_stock($stock_to,$value['sparepart_id'],$value['quantity']);
            $this->remove_stock($stock_from,$value['sparepart_id'],$value['quantity']);
        }

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                $success = FALSE;
                $msg = 'error occured!';
        }
        else
        {
                $this->db->trans_commit();
                $success = TRUE;
                $msg = '';
        }

        echo json_encode(array('success' => $success, 'msg' => $msg));

    }

    public function add_stock($stockyard_id, $sparepart_id, $quantity)
    {
        $current_stock = $this->sparepart_stock->get_stock($stockyard_id, $sparepart_id);
        $this->sparepart_stock_model->_table='spareparts_sparepart_stock';

        if($current_stock){
            $data = array(
                'id' => $current_stock->id,
                'quantity' => $current_stock->stock_quantity + $quantity,
            );
            $this->sparepart_stock_model->update($data['id'],$data);
        }else{
            $data = array(
                'sparepart_id' => $sparepart_id,
                'quantity' => $quantity,
                'stockyard_id' => $stockyard_id,
            );
            $this->sparepart_stock_model->insert($data);
        }
    }

    public function remove_stock($stockyard_id, $sparepart_id, $quantity)
    {
        $current_stock = $this->sparepart_stock->get_stock($stockyard_id, $sparepart_id);

        $this->sparepart_stock_model->_table='spareparts_sparepart_stock';

        if($current_stock){
            $data = array(
                'id' => $current_stock->id,
                'quantity' => $current_stock->stock_quantity - $quantity,
            );
            $this->sparepart_stock_model->update($data['id'],$data);
        }
    }
}