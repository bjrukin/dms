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
* Dealer_stocks
*
* Extends the Project_Controller class
* 
*/

class Dealer_stocks extends Project_Controller
{
    public function __construct()
    {
        parent::__construct();
        control('Dealer Stocks');
        $this->load->model('dealer_stocks/dealer_stock_model');
        $this->load->model('spareparts_dealers/spareparts_dealer_model');
        $this->lang->load('dealer_stocks/dealer_stock');
        $this->load->model('spareparts/sparepart_model');    
        $this->load->model('dealers/dealer_model');
		$this->load->model('local_purchases/local_purchase_model');
		$this->load->model('local_purchase_lists/local_purchase_list_model');
    }

    public function index()
    {
        // Display Page
        $data['header'] = lang('dealer_stocks');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'dealer_stocks';
        $data['dealer_id'] = $this->dealer_id;
        $this->load->view($this->_container,$data);
    }

    public function stock_check()
    {
// Display Page
        $data['header'] = lang('dealer_stocks');
        $data['page'] = $this->config->item('template_admin') . "stock_check";
        $data['module'] = 'dealer_stocks';
        $this->load->view($this->_container,$data);
    }

    public function json()
    {
        $where = '1=1';
        if(is_sparepart_dealer() || is_accountant() || is_workshop_manager())
        {
            $where = ("dealer_id = {$this->session->userdata('employee')['dealer_id']}");
        }
        else if(is_sparepart_dealer_incharge())
        {
            $where = ("spares_incharge_id = {$this->session->userdata('id')}");
        }else if(is_aro()){
            $where = ("dealer_id = {$this->session->userdata('employee')['dealer_id']}");
            
        }

        $this->dealer_stock_model->_table = "view_spareparts_all_dealer_stock";
        search_params();

        $total=$this->dealer_stock_model->find_count($where);

        paging('name', 'ASC');

        search_params();

        $rows=$this->dealer_stock_model->findAll($where);

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {
$data=$this->_get_posted_data(); //Retrive Posted Data

if(!$this->input->post('id'))
{
    $success=$this->dealer_stock_model->insert($data);
}
else
{
    $success=$this->dealer_stock_model->update($data['id'],$data);
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
    $data['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
    $data['quantity'] = $this->input->post('quantity');
    $data['location'] = $this->input->post('location');

    return $data;
}

public function get_stock()
{
    $where['part_code'] = $this->input->post('parts');
    if($this->dealer_id){
        $where['dealer_id'] = $this->dealer_id;
    }
    $data = array();
    $this->dealer_stock_model->_table = 'view_spareparts_all_dealer_stock';
    $result = $this->dealer_stock_model->get_by($where);
    if(count((array)$result) > 0){
        $stock['id'] = $result->id;
        $stock['quantity'] = $result->quantity - 1;
        if($result->quantity < 0){
            $data['success'] = FALSE;
            $data['msg'] = "You don't have enough stock";
        }else{
// print_r($result);
            $where = array();
            $where['part_id'] = $result->sparepart_id;
            $where['bill_id'] = $this->input->post('bill_id');
            $this->dealer_stock_model->_table = 'ser_parts';
            $req = $this->dealer_stock_model->get_by($where);
            if(count((array)$req) > 0){
                if($req->issue_quantity < $req->quantity_to_bill && $req->quantity_to_bill != null){
                    $req_data['issue_quantity'] = $req->issue_quantity + 1;
                    $req_data['id'] = $req->id;
                    $data['success'] = $this->dealer_stock_model->update($req_data['id'],$req_data);
                    $data['part_name'] = $result->name;
                    $data['part_code'] = $this->input->post('parts');

                    $this->dealer_stock_model->_table = 'spareparts_dealer_stock';
                    $this->dealer_stock_model->update($stock['id'],$stock);
                }else{
                    $data['success'] = FALSE;
                    $data['msg'] = "Now you cannot add this item";
                }
            }else{
                $data['success'] = FALSE;
                $data['msg'] = "This item is not in request";
            }
            $data;
        }
    }else{
        $data['success'] = FALSE;
        $data['msg'] = "You don't have this item";
    }

    echo json_encode($data); 
}


public function check_other_dealer_stock()
{
    $part_code = $this->input->post('part_code');

    $this->dealer_stock_model->_table = "view_spareparts_all_dealer_stock";
    $this->db->group_by(array('dealer_name','phone_1'));
    $rows = $this->dealer_stock_model->findAll(array('lower(part_code)'=>strtolower($part_code)),array('dealer_name','phone_1'));

    if(!$rows)
    {
        $success = false;
        $msg = 'No dealer has this item';
    }
    else
    {
        $success = $rows;
        $msg = "success";
    }

    echo json_encode(array('success'=>$success,'msg'=>$msg));
}

public function infoPhp()
{
    phpinfo();
}

public function stock_import()
{   
    ini_set('memory_limit', '-1');
    $config['upload_path'] = './uploads/spareparts_stock_import';
    $config['allowed_types'] = 'xlsx|csv|xls';
    $config['max_size'] = 1000000000;

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

    $index = array('part_code','dealer_name','quantity');
    $raw_data = array();
    $view_data = array();
    foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
        if ($key == 0) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = "C"; //limited to 4th column
            // $highestColumn = $worksheet->getHighestColumn();
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
    // echo '<pre>'; print_r($raw_data); exit;
    
    $unavailable_qty = array();
    $imported_data = array();
    foreach ($raw_data as $key => $value) {
        $sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])),'id');
        $dealer = $this->dealer_model->find(array('name'=>strtoupper($value['dealer_name'])),'id,name');
    // echo '<pre>'; print_r($dealer); exit;

        if(!$sparepart_id)
        {
            $unavailable_qty[$key]['part_code'] = $value['part_code'];
            $unavailable_qty[$key]['dealer_name'] = $dealer->name;
            $unavailable_qty[$key]['quantity'] = $value['quantity'];
            $unavailable_qty[$key]['created_at'] = date("Y-m-d H:i:s");
            // $this->db->insert('table_unknown_parts',$unavailable_qty);
        }
        else
        {
            $imported_data[$key]['sparepart_id']    = $sparepart_id->id;
            $imported_data[$key]['created_by']      = $this->session->userdata('id');
            $imported_data[$key]['created_at']      = date("Y-m-d H:i:s");
            $imported_data[$key]['quantity']        = $value['quantity'];
            $imported_data[$key]['dealer_id']       = $dealer->id;
        }  
        
    }
    // exit;
    // echo '<pre>'; echo count($unavailable_qty); print_r($imported_data);exit;
    if(!empty($unavailable_qty)){
    	$this->duppLocalPurchase($unavailable_qty);
    }

// 
    $this->db->trans_start();
    $this->dealer_stock_model->insert_many($imported_data);
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

public function get_spareparts_combo_json(){
    $this->load->model('spareparts/sparepart_model');
    $search_name = strtoupper($this->input->get('name_startsWith'));
    $where["name LIKE '%{$search_name}%' OR part_code LIKE '%{$search_name}%'"] = NULL;
    $data = $this->sparepart_model->findAll($where, NULL, NULL, NULL, 500);
    echo json_encode($data);
}

public function duppLocalPurchase($local){
	$this->load->library('Excel');      
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->setTitle('Local Purchase');
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    
  


    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('B1', 'Part Code')
    ->setCellValue('C1', 'Dealer')
    ->setCellValue('D1', 'Quantity');

    $row = 2;
    $col = 0; 
    // $date = implode('-', explode('_', $date));
    foreach ($local as  $values) {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['part_code']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['dealer_name']);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['quantity']);
        $col++;

        $row++;
        $col = 0;
    }


    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="localpurchase.xls"'); 
    header('Cache-Control: max-age=0'); 
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    // if (ob_get_length()) ob_end_clean();
    $objWriter->save('php://output');
}


public function local_purchase_insert()
{
	

	ini_set('memory_limit', '-1');
    $config['upload_path'] = './uploads/spareparts_stock_import';
    $config['allowed_types'] = 'xlsx|csv|xls';
    $config['max_size'] = 1000000000;

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

    $index = array('partname','partcode','quantity','price');
    $raw_data = array();
    $view_data = array();
    foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
        if ($key == 0) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = "D"; //limited to 4th column
            // $highestColumn = $worksheet->getHighestColumn();
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

    $lpurchase['invoice_no'] = 'DM-5505';
	$lpurchase['dealer_id'] = 81;
	$lpurchase['party_name'] = 'Local ALL';
	$lpurchase['purchased_date'] = date('Y-m-d');
	$lpurchase['purchased_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
	$lpurchase['total_amount'] = '3081951.25';

	$this->db->trans_begin();
	$success=$this->local_purchase_model->insert($lpurchase);

	if($success)
	{
		foreach ($raw_data as $key => $value) 
		{
			$grid['part_code'] = strtoupper($value['partcode']);
			$grid['name'] = $value['partname'];
			$grid['dealer_price'] = $value['price'];
			
			$grid['price'] = $value['price'] * 1.2;
			$grid['is_local'] = 1;
			$grid['category_id'] = 7;

			$check_partcode = $this->sparepart_model->find(array('part_code'=> strtoupper($value['partcode'])));
			if($check_partcode)
			{
				$purchase[$key]['sparepart_id'] = $check_partcode->id;
			}
			else
			{
				$success1 = $this->sparepart_model->insert($grid);
				$purchase[$key]['sparepart_id'] = $success1;
			}

			$purchase[$key]['local_purchase_id'] = $success;
			$purchase[$key]['price'] = $value['price'];
			$purchase[$key]['quantity'] = $value['quantity'];

			if($check_partcode)
			{
				$dealer_stock = $this->dealer_stock_model->find(array('dealer_id'=>81,'sparepart_id'=>$check_partcode->id));
				if($dealer_stock)
				{
					$up_stock['id'] = $dealer_stock->id;
					$up_stock['quantity'] = $dealer_stock->quantity + $value['quantity'];
					$this->dealer_stock_model->update($up_stock['id'],$up_stock);
				} else {
					$stock_insert['sparepart_id'] = $check_partcode->id;
					$stock_insert['quantity'] = $value['quantity'];
					$stock_insert['dealer_id'] = 81;
					$this->dealer_stock_model->insert($stock_insert);
				}

			}
			else
			{
				$stock['sparepart_id'] = $success1;
				$stock['quantity'] = $value['quantity'];
				$stock['dealer_id'] = 81;
				$this->dealer_stock_model->insert($stock);
			}

		}

		$success = $this->local_purchase_list_model->insert_many($purchase);
	}

	if($this->db->trans_status() === FALSE)
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

	echo json_encode(array('msg'=>$msg,'success'=>$success));
	exit;
}

public function stock_reduce()
{   
    ini_set('memory_limit', '-1');
    $config['upload_path'] = './uploads/spareparts_stock_import';
    $config['allowed_types'] = 'xlsx|csv|xls';
    $config['max_size'] = 1000000000;

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

    $index = array('part_code','dealer_name','quantity','location');
    $raw_data = array();
    $view_data = array();
    foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
        if ($key == 0) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = "D"; //limited to 4th column
            // $highestColumn = $worksheet->getHighestColumn();
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
    $unavailable_qty = array();
    $imported_data = array();
    foreach ($raw_data as $key => $value) {
        $sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])),'id');
        $dealer = $this->dealer_model->find(array('name'=>strtoupper($value['dealer_name'])),'id');

        $dealer_stock = $this->dealer_stock_model->find(array('sparepart_id' => $sparepart_id->id,'dealer_id'=>81,'quantity >='=>$value['quantity']));

        if($dealer_stock){
            $data['id'] = $dealer_stock->id;
            $data['quantity'] = $dealer_stock->quantity - $value['quantity'];
            $success=$this->dealer_stock_model->update($data['id'],$data);

            unset($data);
            unset($dealer_stock);

        }

       
    }

    // echo '<pre>'; print_r($unavailable_qty); exit;

   
    redirect($_SERVER['HTTP_REFERER']);
}


public function stock_location_import()
{   
    ini_set('memory_limit', '-1');
    $config['upload_path'] = './uploads/spareparts_stock_import';
    $config['allowed_types'] = 'xlsx|csv|xls';
    $config['max_size'] = 1000000000;

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

    $index = array('part_code','location');
    $raw_data = array();
    $view_data = array();
    foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
        if ($key == 0) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = "B"; //limited to 4th column
            // $highestColumn = $worksheet->getHighestColumn();
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


                $data = [];
    foreach ($raw_data as $key => $value) {
        if($value['location']){
            $this->dealer_stock_model->_table = 'mst_spareparts';
            $parts = $this->dealer_stock_model->find(array('part_code' => $value['part_code']));
            if($parts){
                $this->db->set('location',$value['location']);
                $this->db->where('sparepart_id',$parts->id);
                $this->db->where('dealer_id',120);
                $this->db->update('spareparts_dealer_stock');
            }
            
        }
        
    }
    echo '<pre>'; print_r($data); exit;
}

public function update_location()
{
    $data['id'] = $this->input->post('id');
    $data['location'] = $this->input->post('location');
    $success=$this->dealer_stock_model->update($data['id'],$data);

    if($success){
        $success = true;
    }else{
        $success = false;
    }
    echo json_encode($success);
    exit;

}

}