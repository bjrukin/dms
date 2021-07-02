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
 * Spareparts_goods_returns
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts_goods_returns extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Spareparts Goods Returns');

		$this->load->model('spareparts_goods_returns/spareparts_goods_return_model');
		$this->load->model('dealer_stocks/dealer_stock_model');
		$this->load->model('sparepart_stocks/sparepart_stock_model');
        $this->load->model('dealer_stocks/dealer_stock_model');
        $this->load->model('spareparts_damage_stocks/spareparts_damage_stock_model');

        $this->lang->load('spareparts_goods_returns/spareparts_goods_return');
    }

    public function index()
    {
		// Display Page
      $data['header'] = lang('spareparts_goods_returns');
      $data['page'] = $this->config->item('template_admin') . "index";
      $data['module'] = 'spareparts_goods_returns';
      $this->load->view($this->_container,$data);
  }

  public function json()
  {
      $dealer_id = $this->session->userdata('employee')['dealer_id'];
      search_params();
      //$this->spareparts_goods_return_model->_table = "view_spareparts_goods_return";

      $total=$this->spareparts_goods_return_model->find_count(array('accepted_date'=>NULL));

      paging('id');

      search_params();

      $rows=$this->spareparts_goods_return_model->findAll(array('accepted_date'=>NULL));

      echo json_encode(array('total'=>$total,'rows'=>$rows));

      exit;
  }

  public function save()
  {
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->spareparts_goods_return_model->insert($data);
        }
        else
        {
        	$success=$this->spareparts_goods_return_model->update($data['id'],$data);
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
    	$data['sparepart_id'] = $this->input->post('sparepart_id');
    	$data['dealer_id'] = $this->dealer_id;
    	$data['quantity'] = $this->input->post('quantity');
    	$data['reason'] = $this->input->post('reason');
    	$data['requeted_by'] = $this->session->userdata('id');
    	$data['request_date'] = date('Y-m-d');
    	$data['request_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
    	if($this->input->post('damage') == 'true')
    	{
    		$data['is_damage'] = 1;
    	}
    	else
    	{
    		$data['is_damage'] = 0;
    	}

    	return $data;
    }

    public function check_stock()
    {
    	$sparepart_id  = $this->input->post('sparepart_id');
    	$rows  = $this->dealer_stock_model->find(array('dealer_id'=>$this->dealer_id,'sparepart_id'=>$sparepart_id),'quantity');

    	echo json_encode($rows);
    }

    public function save_return_approve()
    {
    	$data['id'] = $this->input->post('id');
    	$data['accepted_by'] = $this->session->userdata('id');
    	$data['accepted_date'] = date('Y-m-d');
    	$data['accepted_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
    	$success = $this->spareparts_goods_return_model->update($data['id'],$data);

    	if($success)		
    	{
    		$rows = $this->spareparts_goods_return_model->find(array('id'=>$data['id']));
    		$stock_cg = $this->sparepart_stock_model->find(array('sparepart_id'=>$rows->sparepart_id));
    		$update_cg = array(
    			'id'=>$stock_cg->id,
    			'quantity'=> $stock_cg->quantity + $rows->quantity
    		);

    		$cg_update = $this->sparepart_stock_model->update($update_cg['id'],$update_cg);

            if($rows->is_damage == 1)
            {
                $update_damage_stock = array(
                    'sparepart_id' => $rows->sparepart_id,
                    'quantity' => $rows->quantity,
                    'damage_date' => date('Y-m-d'),
                    'damage_date_np' => get_nepali_date(date('Y-m-d'),'nep')
                );
                $this->spareparts_damage_stock_model->insert($update_damage_stock);
            }

            $stock_dealer = $this->dealer_stock_model->find(array('sparepart_id'=>$rows->sparepart_id,'dealer_id'=>$rows->dealer_id)); 
            $update_dealer = array(
             'id'=>$stock_dealer->id,
             'quantity'=> $stock_dealer->quantity - $rows->quantity
         );

            $dealer_update = $this->dealer_stock_model->update($update_dealer['id'],$update_dealer);
        }


        if($dealer_update)
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
}