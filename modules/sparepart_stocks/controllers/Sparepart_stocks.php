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
 * Sparepart_stocks
 *
 * Extends the Project_Controller class
 * 
 */

class Sparepart_stocks extends Project_Controller
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
		$data['page'] = $this->config->item('template_admin') . "index";
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
        $where = array();
        

        if(is_group(SPAREPART_INCHARGE_GROUP) || is_group(703)){
            $stockyard = $this->get_sparepart_stockyard();
            $stockyard_ids = array();
            foreach ($stockyard as $key => $value) {
                $stockyard_ids[] = $value->stockyard_id;
            }
            $where = array('stockyard_id in ('. implode(',', $stockyard_ids) .')' => NULL);
        }

		$this->sparepart_stock_model->_table = 'view_sparepart_real_stock';			
		search_params();
		$total=$this->sparepart_stock_model->find_count($where);
		
		search_params();
        paging('id');
        $rows=$this->sparepart_stock_model->findAll($where);
		
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
        // $data['stockyard_id'] = $this->input->post('stockyard_id');
    	/*if(is_sparepart_incharge())
    	{
    		$id = $this->session->userdata('id');
    		//$stockyard = $this->stock_yard_model->find(array('incharge_id'=>$id));
    		//$data['stockyard_id'] = $stockyard->id;
    	}*/
    	return $data;
    }

    public function stock_import()
    {   
        $config['upload_path'] = './uploads/spareparts_stock_import';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/spareparts_stock_import/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
        $objReader->setReadDataOnly(false);

        $index = array('part_code','quantity','location','unknown');
        $raw_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }
        
        $imported_data = array();
        // $unknown_array = array();
        foreach ($raw_data as $key => $value) {
            $sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])),'id');
            if(!$sparepart_id)
            {
            	$sparepart_id = $this->sparepart_model->find(array('latest_part_code'=>strtoupper($value['part_code'])),'id');
            }
            if(!$sparepart_id)
            {
                $unknown_array[] = array('part_code'=>strtoupper($value['part_code']));
                //echo strtoupper($value['part_code']);
                //exit;
            }
            else
            {
                $imported_data[$key]['sparepart_id']    = $sparepart_id->id;
                $imported_data[$key]['created_by']      = $this->session->userdata('id');
                $imported_data[$key]['created_at']      = date("Y-m-d H:i:s");
                $imported_data[$key]['quantity']        = $value['quantity'];
                $imported_data[$key]['location']       	= $value['location'];
            }    
        }
        //print_r($unknown_array);
        //exit;
        $this->db->trans_start();
        $this->sparepart_stock_model->insert_many($imported_data);
        if ($this->db->trans_status() === FALSE) 
        {
            $this->db->trans_rollback();
        } 
        else 
        {
            $this->db->trans_commit();            
        } 
        $this->db->trans_complete();
        redirect($_SERVER['HTTP_REFERER']);
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
   public function import_new_parts()
    {   
        $config['upload_path'] = './uploads/spareparts_newstock';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/spareparts_newstock/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
        $objReader->setReadDataOnly(false);

        $index = array('part_code','location');
        $raw_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                $cell = $worksheet->getCellByColumnAndRow(2, 2);
                $stockyard = $cell->getValue();
                $where_stockyard = array('name' => strtoupper(trim($stockyard)));
                $stockyard_detail = $this->stockyard_model->find($where_stockyard);

                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < 2; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }

        $imported_data = array();

        foreach ($raw_data as $key => $value) {
            $sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])),'id');

            if(!$sparepart_id)
            {
                $not_in_master[] = array('part_code'=>strtoupper($value['part_code']));
            }
            else
            {
                $check_stock = $this->sparepart_stock_model->find(array('sparepart_id'=>$sparepart_id->id, 'stockyard_id' => $stockyard_detail->id));
                if(!$check_stock)
                {
                    $imported_data[$key]['sparepart_id']            = $sparepart_id->id;
                    $imported_data[$key]['location']                = $value['location'];
                    $imported_data[$key]['stockyard_id']            = $stockyard_detail->id;
                }
                else
                {
                    if(!$check_stock->location)
                    {
                        $update_location['id'] = $check_stock->id;
                        $update_location['location'] = $value['location'];
                        $this->sparepart_stock_model->update($update_location['id'],$update_location);
                    }
                    else
                    {
                        $already_exists[] = array('part_code'=>strtoupper($value['part_code']));
                    }
                }
            }    
        }

        if(!empty($not_in_master))
        {
            echo 'Not In Master'.'<br/>';
            foreach ($not_in_master as $key => $value) 
            {
                echo $value['part_code'].'<br/>';
            }
            exit;   
        }

        if($imported_data)
        {

            $this->db->trans_start();

            $this->sparepart_stock_model->insert_many($imported_data);
            if ($this->db->trans_status() === FALSE) 
            {
                $this->db->trans_rollback();
            } 
            else 
            {
                $this->db->trans_commit();            
            } 
            $this->db->trans_complete();
        }

        if($already_exists)
        {
            echo 'Already In Stock'.'<br/>';
            foreach ($already_exists as $key => $value) 
            {
                echo $value['part_code'].'<br/>';
            }
            exit;
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function import_update_location()
    {   
        $config['upload_path'] = './uploads/spareparts_newstock';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/spareparts_newstock/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
        $objReader->setReadDataOnly(false);

        $index = array('part_code','location');
        // $index = array('part_code','location','stockyard');
        $raw_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                $cell = $worksheet->getCellByColumnAndRow(2, 2);
                $stockyard = $cell->getValue();
                $where_stockyard = array('name' => strtoupper(trim($stockyard)));
                $stockyard_detail = $this->stockyard_model->find($where_stockyard);

                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < 2; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }

        $imported_data = array();

        foreach ($raw_data as $key => $value) {
            $sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])),'id');

            if(!$sparepart_id)
            {
                $not_in_master[] = array('part_code'=>strtoupper($value['part_code']));
            }
            else
            {
                $check_stock = $this->sparepart_stock_model->find(array('sparepart_id'=>$sparepart_id->id));
                // $check_stock = $this->sparepart_stock_model->find(array('sparepart_id'=>$sparepart_id->id, 'stockyard_id' => $stockyard_detail->id));
                if(!$check_stock)
                {
                    $imported_data[$key]['sparepart_id']            = $sparepart_id->id;
                    $imported_data[$key]['location']                = $value['location'];
                    // $imported_data[$key]['stockyard_id']            = $stockyard_detail->id;
                }
                else
                {
                    // if(!$check_stock->location)
                    // {
                        $update_location['id'] = $check_stock->id;
                        $update_location['location'] = $value['location'];
                        $this->sparepart_stock_model->update($update_location['id'],$update_location);
                    // }
                    // else
                    // {
                        // $already_exists[] = array('part_code'=>strtoupper($value['part_code']));
                    // }
                }
            }    
        }

        if(!empty($not_in_master))
        {
            echo 'Not In Master'.'<br/>';
            foreach ($not_in_master as $key => $value) 
            {
                echo $value['part_code'].'<br/>';
            }
            exit;   
        }

        if($imported_data)
        {

            $this->db->trans_start();

            $this->sparepart_stock_model->insert_many($imported_data);
            if ($this->db->trans_status() === FALSE) 
            {
                $this->db->trans_rollback();
            } 
            else 
            {
                $this->db->trans_commit();            
            } 
            $this->db->trans_complete();
        }

        if($already_exists)
        {
            echo 'Already In Stock'.'<br/>';
            foreach ($already_exists as $key => $value) 
            {
                echo $value['part_code'].'<br/>';
            }
            exit;
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function excel_export_all()
    {
        $this->sparepart_stock->excel_export_sparepart_stock();
    }

    // public function transfer()
    // {
    //     $data['header'] = lang('sparepart_stocks');
    //     $data['page'] = $this->config->item('template_admin') . "transfer";
    //     $data['module'] = 'sparepart_stocks';
    //     $this->load->view($this->_container,$data);
    // }
}