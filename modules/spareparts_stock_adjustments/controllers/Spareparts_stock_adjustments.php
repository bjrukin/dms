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
 * Spareparts_stock_adjustments
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts_stock_adjustments extends Project_Controller
{
    public function __construct()
    {
        parent::__construct();

        control('Spareparts Stock Adjustments');

        $this->load->model('spareparts_stock_adjustments/spareparts_stock_adjustment_model');
        $this->load->model('sparepart_stocks/sparepart_stock_model');

        $this->lang->load('spareparts_stock_adjustments/spareparts_stock_adjustment');
    }

    public function index()
    {
        // Display Page
        $data['header'] = lang('spareparts_stock_adjustments');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'spareparts_stock_adjustments';
        $this->load->view($this->_container,$data);
    }

    public function incharge_index()
    {
        // Display Page
        $data['header'] = lang('spareparts_stock_adjustments');
        $data['page'] = $this->config->item('template_admin') . "incharge_index";
        $data['module'] = 'spareparts_stock_adjustments';
        $this->load->view($this->_container,$data);
    }

    public function json()
    {
        search_params();
        
        $this->spareparts_stock_adjustment_model->_table = "view_spareparts_stock_adjustment";

        $total=$this->spareparts_stock_adjustment_model->find_count();
        
        paging('id');
        
        search_params();
        
        $rows=$this->spareparts_stock_adjustment_model->findAll();
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->spareparts_stock_adjustment_model->insert($data);
        }
        else
        {
            $success=$this->spareparts_stock_adjustment_model->update($data['id'],$data);
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
        $data['old_stock'] = $this->input->post('old_stock');
        $data['new_stock'] = $this->input->post('new_stock');
        $data['remarks'] = $this->input->post('remarks');
        $data['requested_by'] = $this->session->userdata('id');
        $data['requested_date'] = date('Y-m-d');
        $data['requested_date_np'] = get_nepali_date(date('Y-m-d'),'nep'); 

        return $data;
    }

    public function save_stock_adjustment($status)
    {
        $data['id'] = $this->input->post('id');
        if($status == 'reject')
        {
            $success = $this->spareparts_stock_adjustment_model->delete($data['id']);
        }
        else
        {
            $data['approved_by'] = $this->session->userdata('id');
            $data['approved_date'] = date('Y-m-d');
            $data['approved_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
            $data['status'] = 'APPEOVED';
            $success = $this->spareparts_stock_adjustment_model->update($data['id'],$data); 
            if($success)
            {
                $stock['sparepart_id'] = $this->input->post('sparepart_id');
                $stock['new_stock'] = $this->input->post('new_stock');
                $success = $this->_adjust_stock($stock);
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

    private function _adjust_stock($stock)
    {
        $rows = $this->sparepart_stock_model->find(array('sparepart_id'=>$stock['sparepart_id']),'id');

        $new_stock['id'] = $rows->id;
        $new_stock['quantity'] = $stock['new_stock'];

        $success = $this->sparepart_stock_model->update($new_stock['id'],$new_stock);
        return $success;
    }
}