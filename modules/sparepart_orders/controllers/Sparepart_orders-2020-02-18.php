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
* Sparepart_orders
*
* Extends the Project_Controller class
* 
*/

class Sparepart_orders extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();


		control('Sparepart Orders');

		$this->load->model('sparepart_orders/sparepart_order_model');
		$this->load->model('dispatch_spareparts/dispatch_sparepart_model');
		$this->load->model('sparepart_stocks/sparepart_stock_model');
		$this->load->model('spareparts/sparepart_model');
		$this->lang->load('sparepart_orders/sparepart_order');
		$this->load->library('sparepart_orders/sparepart_order');    
		$this->load->model('dealer_credits/dealer_credit_model');
		$this->load->model('dealer_stocks/dealer_stock_model');
		$this->load->model('order_unavailables/order_unavailable_model');
		$this->load->model('picklists/picklist_model');
		$this->load->model('foc_documents/foc_document_model');
		$this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');
		$this->load->model('dispatch_lists/dispatch_list_model');
		$this->load->model('dealer_stocks/dealer_stock_model');
		$this->load->model('stock_yards/stock_yard_model');
		$this->load->model('spareparts_dealer_claims/spareparts_dealer_claim_model');
		$this->load->model('users/user_model');
		$this->load->model('dealers/dealer_model');
		$this->load->model('spareparts_dealer_opening_credits/spareparts_dealer_opening_credit_model');

	}

	public function index()
	{
		$this->dealer_credit_model->_table = "view_spareparts_dealer_credit";
		$data['credit_limit'] = $this->dealer_credit_model->find(array('dealer_id'=>$this->session->userdata('employee')['dealer_id']),'actual_credit,credit_policy');
		$data['opening_credit'] = $this->spareparts_dealer_opening_credit_model->find(array('dealer_id'=>$this->session->userdata('employee')['dealer_id']),'opening_credit');
		$data['header'] = lang('sparepart_orders');
		$data['page'] = $this->config->item('template_admin') . "tab_index";
		$data['module'] = 'sparepart_orders';

		$this->load->view($this->_container,$data);
	}    

	public function sparepart_incharge()
	{
		$data['header'] = lang('sparepart_orders');
		$data['page'] = $this->config->item('template_admin') . "sparepart_incharge";
		$data['module'] = 'sparepart_orders';
		$this->load->view($this->_container,$data);
	}

	public function order_list($order_no = NULL, $dealer_id = NULL, $login_type = NULL)
	{
		$data['order_no'] = $order_no;
		$data['dealer_id'] = $dealer_id;
		$data['header'] = lang('sparepart_orders');
		$data['rows']=$this->dealer_model->find(array('id'=>$dealer_id));
		$data['pi_data'] = $this->sparepart_order_model->find(array('dealer_id'=>$dealer_id, 'order_no'=>$order_no));

		if($login_type == 1)
		{
			$data['page'] = $this->config->item('template_admin') . "order_list";
		}
		if($login_type == 2)
		{
			$data['page'] = $this->config->item('template_admin') . "dealer_order_list";        
		}
		$data['module'] = 'sparepart_orders';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->sparepart_order_model->_table = 'view_spareparts_order';
		$where = array();
		// echo '<pre>'; print_r($this->session->userdata('employee')); exit;
		//$dealer_details = $this->getSparepartDealer();
		if($this->session->userdata('employee')['dealer_id']){
			$where = "(dealer_id = ".$this->session->userdata('employee')['dealer_id'].")";
			
		}

		search_params();
		$this->db->where($where);
		$total=$this->sparepart_order_model->find_count(array('pi_generated'=>0,'order_cancel<>'=>1));

		paging('id');
		
		search_params();
		$this->db->where($where);
		$rows=$this->sparepart_order_model->findAll(array('pi_generated'=>0,'order_cancel<>'=>1));
		// print_r($this->db->last_query()); exit;

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function pi_generated_json()
	{
		$dealer_id = $this->_sparepartdealer->id; 
		$this->sparepart_order_model->_table = 'view_spareparts_order';
		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$dealer_id.")";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}
		
		$this->db->where($where);
		$total=$this->sparepart_order_model->find_count(array('pi_generated'=>1,'pi_confirmed'=>0,'dealer_id'=>$dealer_id));

		paging('id');

		search_params();
		$this->db->where($where);
		$rows=$this->sparepart_order_model->findAll(array('pi_generated'=>1,'pi_confirmed'=>0,'dealer_id'=>$dealer_id));

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	/*public function back_log()
	{
		//$dealer_id = $this->_sparepartdealer->id; 
		// $dealer_id = $this->session->userdata('employee')['dealer_id']; 
		$this->sparepart_order_model->_table = 'view_dealer_total_backorder';
		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$dealer_id.")";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}
		
		search_params();

		$total=$this->sparepart_order_model->find_count(array('total_backorder <>'=>0));

		paging('dealer_name');

		search_params();

		$rows=$this->sparepart_order_model->findAll(array('total_backorder <>'=>0));

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}*/
	public function back_log()
	{
		//$dealer_id = $this->_sparepartdealer->id; 
		// $dealer_id = $this->session->userdata('employee')['dealer_id']; 
		// $this->sparepart_order_model->_table = 'view_dealer_total_backorder';
		$this->sparepart_order_model->_table = 'view_report_spareparts_backorder';
		$where =array();
		// $this->sparepart_order_model->_table = 'view_spareparts_order';
		$fields = 'dealer_name, part_code, part_name as name, backorder AS total_backorder, pi_number, order_no_concat as order_no,id';
		// $fields = 'dealer_name, part_code, part_name as name, (order_quantity - dispatched_quantity) AS total_backorder, pi_number, order_no_concat as order_no,id';
		// $fields = 'dealer_name, part_code, name, (order_quantity - dispatched_quantity) AS total_backorder, pi_number, order_no,id';


		if(is_sparepart_dealer() || is_workshop_manager())
		{
			$dealer_id = $this->session->userdata('employee')['dealer_id']; 
			$where = "(dealer_id = ".$dealer_id.")";


		}


		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}

		// if(is_aro()){
		// 	$where = "(dealer_id = ".$this->session->userdata('employee')['dealer_id'].")";
			
		// }
		
		search_params();

		// $total=$this->sparepart_order_model->find_count(array('total_backorder <>'=>0));
		$this->db->where($where);
		
		$total=$this->sparepart_order_model->find_count(array('backorder > 0'=>NULL, 'pi_number IS NOT NULL'=>NULL));
		// $total=$this->sparepart_order_model->find_count(array('dispatched_quantity < order_quantity'=>NULL, 'pi_number IS NOT NULL'=>NULL));
		// $total=$this->sparepart_order_model->find_count(array('dispatched_quantity < order_quantity'=>NULL, 'pi_generated'=>1));

		paging('dealer_name');

		search_params();

		// $rows=$this->sparepart_order_model->findAll(array('total_backorder <>'=>0));
		$this->db->where($where);
		$rows=$this->sparepart_order_model->findAll(array('backorder > 0'=>NULL, 'pi_number IS NOT NULL'=>NULL), $fields);
		// $rows=$this->sparepart_order_model->findAll(array('dispatched_quantity < order_quantity'=>NULL, 'pi_number IS NOT NULL'=>NULL), $fields);
		// $rows=$this->sparepart_order_model->findAll(array('dispatched_quantity < order_quantity'=>NULL, 'pi_generated'=>1), $fields);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	public function incharge_json()
	{
		$where = '1=1';
		$dealer_details = $this->getSparepartDealer();

		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$dealer_id.")";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}

		$group = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed,pi_generated_date_time,pi_generated";
		$fields = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed,SUM(order_quantity) as order_qty, count(DISTINCT id) as total_line_qty, SUM(order_quantity * dealer_price) as total_amount,COALESCE(SUM(dispatched_quantity),0) as total_dispatched_quantity, COALESCE(SUM(dispatched_quantity * dispatch_dealer_price),0) as total_dispatched_amount,pi_generated_date_time,pi_generated";
		$this->sparepart_order_model->_table = 'view_spareparts_order';

		search_params();
		$this->db->group_by($group);
		$this->db->where($where);
		$total=$this->sparepart_order_model->find_all(array('order_cancel'=>0),$fields);
		// echo $this->db->last_query();
		// exit;
		$total = count($total);

		paging('dealer_id');

		search_params();

		$this->db->group_by($group);
		$this->db->where($where);
		$rows=$this->sparepart_order_model->find_all(array('order_cancel'=>0),$fields);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function dealer_order_json()
	{
		$this->sparepart_order_model->_table = 'view_grouped_spareparts_order';
		$where = array();
		if(is_sparepart_dealer() || is_workshop_manager())
		{
			$where = "(dealer_id = ".$this->session->userdata('employee')['dealer_id'].")";
		}
		if(is_aro()){
			$where = "(dealer_id = ".$this->session->userdata('employee')['dealer_id'].")";

		}


		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}
		
		$group = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed,pi_number,pi_generated";
		$fields = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed,SUM(order_quantity) as order_qty,count(*) as total_line_qty, SUM(order_quantity * dealer_price) as total_amount,COALESCE(SUM(dispatched_quantity),0) as total_dispatched_quantity, COALESCE(SUM(dispatched_quantity * dispatch_dealer_price),0) as total_dispatched_amount,pi_number,pi_generated";

		$this->sparepart_order_model->_table = 'view_spareparts_order';

		search_params();
		$this->db->group_by($group);
		$this->db->where($where);
		$total=$this->sparepart_order_model->find_all(array('order_cancel'=>0),$fields);
		$total = count($total);

		paging('dealer_id');

		search_params();

		$this->db->group_by($group);
		$this->db->where($where);
		$rows=$this->sparepart_order_model->find_all(array('order_cancel'=>0),$fields);
		// print_r($this->db->last_query());

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	/*public function order_list_json($order_no = NULL,$dealer_id = NULL)
	{
		$where = '1=1';
		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$dealer_id.")";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}

		search_params();
		$this->sparepart_order_model->_table = 'view_spareparts_order';

		$this->db->where($where);
		$total=$this->sparepart_order_model->find_count(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));
		paging('order_no');

		search_params();

		$this->db->where($where);
		$rows=$this->sparepart_order_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}*/
	public function order_list_json($order_no = NULL,$dealer_id = NULL)
	{
		$where = '1=1';
		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$dealer_id.")";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}

		$fields = 'id,name,part_code,order_quantity,pi_number,order_no,dealer_price,order_amount,dealer_confirmed,pi_status';

		search_params();
		$this->sparepart_order_model->_table = 'view_spareparts_order';
		$this->db->group_by($fields);

		$this->db->where($where);
		$this->db->group_by('order_no,dealer_id,created_by');
		$total_rows=$this->sparepart_order_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id),'count(id)');
		$total = count($total_rows);
		paging('order_no');

		search_params();

		$this->db->where($where);
		$this->db->group_by($fields);
		$rows=$this->sparepart_order_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id), $fields);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	
	public function pi_indexed_json()
	{
		
		$where = '1=1';
		$dealer_details = $this->getSparepartDealer();

		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$dealer_id.")";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}

		$group = "proforma_invoice_id,dealer_name,dealer_id,order_no,order_concat,order_type,pi_number,pi_generated_date_time,remarks,dispatch_mode";
		$fields = "proforma_invoice_id,dealer_name,dealer_id,order_no,order_concat,order_type,pi_number,pi_generated_date_time,SUM(order_quantity) as order_qty,count(*) as total_line_qty, SUM(order_quantity * dealer_price) as total_amount,remarks,dispatch_mode,MAX(pick_count) as pick_count";

		$this->sparepart_order_model->_table = 'view_spareparts_order_pickcount';

		search_params();
		$this->db->group_by($group);
		$this->db->where($where);
		$total=$this->sparepart_order_model->find_all(array('pi_generated'=>1,'pi_confirmed'=>1),$fields);
		$total = count($total);

		paging('dealer_id');

		search_params();

		$this->db->group_by($group);
		$this->db->where($where);
		$rows=$this->sparepart_order_model->find_all(array('pi_generated'=>1, 'pi_confirmed'=>1),$fields);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->sparepart_order_model->insert($data);
        }
        else
        {
        	$success=$this->sparepart_order_model->update($data['id'],$data);
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
    	$data['sparepart_id'] = $this->input->post('product_id');
    	$data['order_quantity'] = $this->input->post('quantity');

    	return $data;
    }

    public function dealer_order_import()
    {
		

    	$config['upload_path'] = './uploads/dealer_order';
    	$config['allowed_types'] = 'xlsx|csv|xls';
    	$config['max_size'] = 100000;

    	$this->load->library('upload', $config);

    	if (!$this->upload->do_upload('userfile')) {
    		$error = array('error' => $this->upload->display_errors());
    		print_r($error); exit;
    		redirect($_SERVER['HTTP_REFERER']);
    	} else {
    		$data = array('upload_data' => $this->upload->data());
    	}
    	$file = FCPATH . 'uploads/dealer_order/' . $data['upload_data']['file_name']; 
    	$this->load->library('Excel');
    	$objPHPExcel = PHPExcel_IOFactory::load($file);
    	$objReader = PHPExcel_IOFactory::createReader('Excel2007');        
    	$objReader->setReadDataOnly(false);

    	$index = array('part_code','order_quantity');
    	$raw_data = array();
    	$view_data = array();
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

		// echo '<pre>'; print_r($raw_data); exit;
		// max order no selected
		$dealer_details = $this->getSparepartDealer();
		$unavailable_part_code = array();
		$this->sparepart_order_model->_table = 'view_spareparts_order';
		$this->db->where('dealer_id',$this->session->userdata('employee')['dealer_id']);
		$result = $this->sparepart_order_model->find(NULL,'max(order_no) as order_no');

		$this->sparepart_order_model->_table = 'spareparts_sparepart_order';
		if(!$result)
		{
			$order_no = 1;
		}
		else
		{
			$order_no = $result->order_no + 1;
		}

		$imported_data = array();
		foreach ($raw_data as $key => $value) {
			if($value['part_code']){
				$sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])),array('id','moq'));

				if(!$sparepart_id)
				{
					$unavailable_part_code[] = $value['part_code']; 
				}
				else
				{
					$imported_data[$key]['sparepart_id'] = $sparepart_id->id;
					$imported_data[$key]['created_by'] = $this->session->userdata('id');
					$imported_data[$key]['created_at'] = date("Y-m-d H:i:s");
					// moq calculation
					$quotient = $value['order_quantity'] / (($sparepart_id->moq)?$sparepart_id->moq:1);
					$remainder = $value['order_quantity'] % (($sparepart_id->moq)?$sparepart_id->moq:1);

					if($remainder != 0)
					{                    
						$ord_qty = ((int)$quotient * $sparepart_id->moq) + $sparepart_id->moq;
						$imported_data[$key]['order_quantity'] = $ord_qty;
					}                    
					else
					{
						$imported_data[$key]['order_quantity'] = $value['order_quantity'];
					}
					$imported_data[$key]['dealer_id']       = $this->session->userdata('employee')['dealer_id'];
					$imported_data[$key]['order_no']        = $order_no;
					$imported_data[$key]['order_type']      = $this->input->post('order_type');
					$imported_data[$key]['order_date']      = date('Y-m-d');
					$imported_data[$key]['request_date']      = date('Y-m-d');
					$imported_data[$key]['order_date_np']      = get_nepali_date(date('Y-m-d'),'nep');
					$imported_data[$key]['dispatch_mode']      = $this->input->post('dispatch_mode');
				}    
				
			}
		}	

		// echo '<pre>'; print_r($imported_data); exit;

		if($unavailable_part_code)
		{            
			$undata['unavailable_parts'] = implode(',',$unavailable_part_code);
			$undata['order_no'] = $order_no;
			$undata['dealer_id'] = $this->_sparepartdealer;
			$this->order_unavailable_model->insert($undata);
		}


		$this->db->trans_start();
		$this->sparepart_order_model->insert_many($imported_data);
		if ($this->db->trans_status() === FALSE) 
		{
			$this->db->trans_rollback();
		} 
		else 
		{
			$this->db->trans_commit();
			$email_data['subject'] = "Your order has been received.";
			$email_data['body'] = "We have received your Order No. {$order_no}. Kindly download the PI and confirm the order";
			$email_data['email'] = $this->dealer_model->find(array('id'=>$this->session->userdata('employee')['dealer_id']),'email');
			$this->sparepart_order->send_email_notification($email_data);
		} 
		$this->db->trans_complete();
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function list_item_json()
	{
		$this->sparepart_stock_model->_table = 'view_spareparts_dealer_order';

		$barcode = strtoupper($this->input->post('barcode'));       
		$proforma_invoice_id = $this->input->post('pi');
		$sparepart_stock_id = $this->input->post('sparepart_stock_id');         
		$where = array(
			'part_code'=>$barcode, 
			'proforma_invoice_id'=>$proforma_invoice_id,
			'pi_generated'          => 1,
			'pi_confirmed'          => 1,
		);
		$stocklist = $this->sparepart_stock_model->find($where);

		if($stocklist == FALSE)
		{
			echo json_encode(array('stocklist'=>$stocklist,'success'=>FALSE));
			exit;
		}

		echo json_encode(array('stocklist'=>$stocklist,'success'=>TRUE));
	}

	public function list_foc_item_json()
	{
		$this->sparepart_stock_model->_table = 'view_sparepart_real_stock';

		$barcode = strtoupper($this->input->post('barcode'));       

		$stocklist = $this->sparepart_stock_model->find(array('name'=>$barcode));

		if($stocklist == FALSE)
		{
			echo json_encode(array('stocklist'=>$stocklist,'success'=>FALSE));
			exit;
		}
		echo json_encode(array('stocklist'=>$stocklist,'success'=>TRUE));
	}


	public function generate_pi($order_no = NULL,$dealer_id=NULL,$export_type = NULL)
	{
		$dealer_details = $this->getSparepartDealer();
		$where = '1 = 1';
		
		$this->sparepart_order_model->_table = 'view_spareparts_order';
		$this->db->where($where);
		$result = $this->sparepart_order_model->find(NULL,'max(proforma_invoice_id) as proforma_invoice_id');
		$success = $this->sparepart_order->generate_proforma_invoice($order_no,$result,$export_type,$dealer_details,$dealer_id);
	}

	public function save_pi()
	{
		$order_no = $this->input->post('pi_order_no');
		$dealer_id = $this->input->post('pi_dealer_id');
		$success = $this->sparepart_order->pi_confirm($order_no,$dealer_id);
		echo json_encode(array('success'=>$success));
	}
	public function dealer_save_pi()
	{
		$order_no = $this->input->post('order_no');
		$dealer_id = $this->input->post('dealer_id');
		$success = $this->sparepart_order->dealer_pi_confirm($order_no,$dealer_id);
		if($success)
		{
			$dealer_info = $this->dealer_model->find(array('id'=>$dealer_id));
			$incharge_email = $this->user_model->find(array('id'=>$dealer_info->spares_incharge_id),'email');
			
			$email_data['subject'] = 'PI confirmation pending';
			$email_data['body'] = "Order no.{$order_no} from {$dealer_info->name} dealer is pending for your confirmation";
			if(!$incharge_email)
			{
				$receiver_email = 'sanish@pagodalabs.com';
			}
			else
			{
				$receiver_email = $incharge_email->email;
			}
			$email_data['email'] = $receiver_email;
			$this->sparepart_order->send_email_notification($email_data);
		}
		echo json_encode(array('success'=>$success));
	}

	public function get_spareparts_list()
	{

		$list = $this->sparepart_order->sparepart_list_json();
		echo json_encode($list);
	}
	public function get_dealer_list()
	{

		$dealerlist = $this->sparepart_order->dealer_list_json();
		echo json_encode($dealerlist);
	}

	/*public function dispatch_list($id = NULL)
	{
		$data['id'] = $id;

		$data['header'] = lang('sparepart_orders');
		$data['page'] = $this->config->item('template_admin') . "dispatch_list";
		$data['module'] = 'sparepart_orders';
		$this->load->view($this->_container,$data);
	}*/
	public function dispatch_list($id = NULL)
	{
		$data['id'] = $id;
		$data['header'] = lang('sparepart_orders');
		$data['page'] = $this->config->item('template_admin') . "billing_tab_index";
		$data['module'] = 'sparepart_orders';
		$this->load->view($this->_container,$data);
	}

	public function dispatch_list_json($proforma_invoice_id = NULL)
	{
		$this->dispatch_sparepart_model->_table = 'view_dispatch_spareparts';
		search_params();

		$total=$this->dispatch_sparepart_model->find_count(array('proforma_invoice_id'=>$proforma_invoice_id,'pick_count'=>0));
		paging('id');

		search_params();

		$rows=$this->dispatch_sparepart_model->findAll(array('proforma_invoice_id'=>$proforma_invoice_id,'pick_count'=>0));
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}

	public function dispatch_left_log($order_no = NULL, $dealer_id = NULL)
	{
		$data['order_no'] = $order_no;
		$data['dealer_id'] = $dealer_id;
		$this->sparepart_order_model->_table = "view_spareparts_order";
		$data['dealer_info'] = $this->sparepart_order_model->find(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));

		$data['header'] = lang('sparepart_orders');
		$data['page'] = $this->config->item('template_admin') . "leftlogs_spareparts";
		$data['module'] = 'sparepart_orders';
		$this->load->view($this->_container,$data);
	}

	public function dispatch_left_log_json($order_no = NULL, $dealer_id = NULL)
	{
		$this->dispatch_sparepart_model->_table = 'view_back_log_spareparts';
		$dealer_details = $this->getSparepartDealer();
		
		search_params();
		$total=$this->dispatch_sparepart_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id,'required_quantity<>'=>0));
		$total = count($total);

		paging('order_no');

		search_params();
		$rows=$this->dispatch_sparepart_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id,'required_quantity<>'=>0));

		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}

	public function generate_picking_list()
	{
		$pi_id = $this->input->post('picking_proforma_invoice_id');
		$dealer_id = $this->input->post('picking_dealer_id');
		$order_type = $this->input->post('picking_order_type');
		$picker_id = $this->input->post('picker_id');
		$dispatched_date = $this->input->post('dispatched_date');
		$picklist_status = $this->input->post('picklist_status');
		// $order_no = $this->input->post('order_no');
		$order_no = $this->input->post('picking_order_no');

		$this->user_model->_table = 'ser_workshop_users';
		$data['picker_name'] = $this->user_model->find(array('id'=>$picker_id),array('first_name','middle_name','last_name'));

		$user_id = $this->session->userdata('id');
		$data['dealer'] = $this->dealer_model->find(array('id'=>$dealer_id));

		$this->sparepart_order_model->_table = "view_spareparts_order";
		// $this->db->order_by('location');
		$this->db->order_by('part_code');
		$this->db->where('order_quantity > received_quantity - cancle_quantity', NULL, FALSE);
		$rows = $this->sparepart_order_model->findAll(array('pi_generated'=>1,'pi_confirmed'=>1,'proforma_invoice_id'=>$pi_id,'dealer_id'=>$dealer_id));
		// $rows = $this->sparepart_order_model->findAll(array('pi_generated'=>1,'pi_confirmed'=>1,'proforma_invoice_id'=>$pi_id,'dealer_id'=>$dealer_id, 'order_quantity > received_quantity - cancle_quantity' => NULL));
		// echo '<pre>';
		// print_r($rows);
		// print_r($this->db->last_query());exit;

		$this->db->select_max('picklist_no');
		$picklist_no = $this->db->get('spareparts_picklist')->row();

		$this->sparepart_order_model->_table = "spareparts_sparepart_order";
		foreach ($rows as $key => $value) 
		{
			$sparepart = $this->sparepart_model->find(array('id'=>$value->sparepart_id));
			$this->sparepart_stock_model->_table = "view_sparepart_real_stock";
			$this->db->order_by('stock_quantity','desc');
			// $check_stock = $this->sparepart_stock_model->find(array('part_code'=>$sparepart->part_code));
			// $check_stock = $this->sparepart_stock_model->find(array("part_code = '" . $sparepart->part_code . "' OR alternate_part_code = '" . $sparepart->part_code . "' OR latest_part_code = '" . $sparepart->part_code . "'" => NULL));
			$check_stock = $this->sparepart_stock_model->find(array("part_code = '" . $sparepart->part_code . "' OR part_code = '" . $sparepart->alternate_part_code . "' OR part_code = '" . $sparepart->latest_part_code . "'" => NULL));

			/*if(!$check_stock)
			{
				$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$sparepart->alternate_part_code,'stock_quantity >'=>0)); 
				$data['alternate_part_code'] = 1;
			}

			if(!$check_stock)
			{
				$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$sparepart->latest_part_code,'stock_quantity >'=>0)); 
				$data['latest_part_code'] = 1;
			}

			if($check_stock)
			{
				$picklist_quantity = $this->picklist_model->find(array('sparepart_id'=>$check_stock->sparepart_id));
			}*/

			/*if($check_stock)
			{*/
				$picklist[$key]['order_id'] = $value->id;
				$picklist[$key]['order_no'] = $value->order_no;
				$picklist[$key]['picker_id'] = $picker_id;
				$picklist[$key]['dealer_id'] = $value->dealer_id;
				$picklist[$key]['sparepart_id'] = ($check_stock)?$check_stock->sparepart_id:$value->sparepart_id;
				$picklist[$key]['ordered_spareparts'] = $value->sparepart_id;
				/*if($value->order_quantity <= ($left_stock = $check_stock->stock_quantity-($picklist_quantity?$picklist_quantity->dispatch_quantity:0)))
				{					
					$actual_qty = $value->order_quantity;
				} 
				else
				{
					$actual_qty =  $left_stock;
				}*/
				$actual_qty = $value->order_quantity - $value->received_quantity - $value->cancle_quantity;
				$picklist[$key]['dispatch_quantity'] =$actual_qty;
				$picklist[$key]['dispatched_date'] = date('Y-m-d');
				$picklist[$key]['dispatched_date_nep'] = get_nepali_date(date('Y-m-d'),'nep');
				$picklist[$key]['order_type'] = $order_type;

				$this->db->select_max('pick_count');
				$this->db->where('order_no',$value->order_no);
				$this->db->where('dealer_id',$dealer_id);
				$pick_count = $this->db->get('spareparts_picklist')->row();
				if(!$pick_count)
				{
					$pick_count->pick_count = 0;
				}
				$picklist[$key]['pick_count'] = (($pick_count->pick_count) + 1); 
				$picklist[$key]['picklist_no'] = ($picklist_no->picklist_no + 1); 
				$picklist[$key]['picklist_format'] = "PICKLST-".sprintf('%05d', ($picklist_no->picklist_no + 1)); 

				$print_picklist[$key]['name'] = $sparepart->name;
				$print_picklist[$key]['part_code'] = ($check_stock)?$check_stock->part_code:$sparepart->part_code;
				// $print_picklist[$key]['location'] = ($check_stock ? $check_stock->location:'Not in stock');
				$print_picklist[$key]['stock_status'] = @$check_stock->stock_quantity;
				$print_picklist[$key]['location'] =  @$check_stock->location;
				$print_picklist[$key]['quantity'] = $actual_qty;
				$print_picklist[$key]['order_quantity'] = $value->order_quantity;
				$print_picklist[$key]['stock_quantity'] = ($check_stock ? $check_stock->stock_quantity:0);

				$check_order = $this->sparepart_order_model->find(array('dealer_id'=>$value->dealer_id,'order_no'=>$value->order_no,'sparepart_id'=>$value->sparepart_id));
				if(empty($check_order))
				{
					$update_order[$key]['order_no'] = $value->order_no;
					$update_order[$key]['dealer_id'] = $value->dealer_id;
					$update_order[$key]['sparepart_id'] = $value->sparepart_id;
					$update_order[$key]['order_quantity'] = $actual_qty;
					$update_order[$key]['proforma_invoice_id'] = $value->proforma_invoice_id;
					$update_order[$key]['pi_generated'] = $value->pi_generated;
					$update_order[$key]['pi_confirmed'] = $value->pi_confirmed;
					// $update_order[$key]['picklist'] = 1;
					$update_order[$key]['confirmed_type'] = $value->confirmed_type;
					$update_order[$key]['dealer_confirmed'] = $value->dealer_confirmed;
					$update_order[$key]['pi_generated_date_time'] = $value->pi_generated_date_time;
					$update_order[$key]['order_type'] = $value->order_type;
					$update_order[$key]['dispatch_mode'] = $value->dispatch_mode;
					$update_order[$key]['order_date'] = $value->order_date;
					$update_order[$key]['order_date_np'] = $value->order_date_np;
					$update_order[$key]['pi_number'] = $value->pi_number;
					$update_order[$key]['remarks'] = $value->remarks;
					$update_order[$key]['received_quantity'] = 0;
				}
			}
			

			if(empty($picklist))
			{
				flashMsg('error', 'No items to generate.');     
				redirect($_SERVER['HTTP_REFERER']);
			}
			// if(!empty($update_order))
			// {
			// 	$this->sparepart_order_model->insert_many($update_order);
			// }
			
			// $success = $this->picklist_model->insert_many($picklist); 
			
			// foreach ($picklist as  $value) 
			// {
			// 	$update_picklist['id'] = $value['order_id'];
			// 	$update_picklist['picklist'] = 1;
			// 	$this->sparepart_order_model->update($update_picklist['id'],$update_picklist);
			// }

			$date = date('Y-m-d');
			if($picklist_status == '1')
			{
				if($dispatched_date)
				{
					if($date > $dispatched_date)
					{
						$success = $this->picklist_model->insert_many($picklist); 
						foreach ($picklist as  $value) 
						{
							$update_picklist['id'] = $value['order_id'];
							$update_picklist['picklist'] = 1;
							$this->sparepart_order_model->update($update_picklist['id'],$update_picklist);
						}
						if(!empty($update_order))
						{
							$this->sparepart_order_model->insert_many($update_order);
						}
					}
					else
					{
						$success = 1;
					}
				}
				else
				{
					$success = 1;
				}
			}
			else
			{
				$success = $this->picklist_model->insert_many($picklist); 
					foreach ($picklist as  $value) 
					{
						$update_picklist['id'] = $value['order_id'];
						$update_picklist['picklist'] = 1;
						$this->sparepart_order_model->update($update_picklist['id'],$update_picklist);
					}
					if(!empty($update_order))
					{
						$this->sparepart_order_model->insert_many($update_order);
					}
			}

			$data['order_no'] = $rows[0]->order_no;
			$data['pi_number'] = $rows[0]->pi_number;
			$data['dispatch_mode'] = $rows[0]->dispatch_mode;
			$data['order_type'] = $rows[0]->order_type;
			$data['picklist_number'] = "PICKLST-".sprintf('%05d',($picklist_no->picklist_no + 1));
			$data['rows'] = $print_picklist;
			if($success)
			{
				$this->picklist_model->_table = 'view_sparepart_picklist';

				$data['picker'] = $this->picklist_model->find(array('dealer_id'=>$dealer_id,'order_no'=>$order_no,'pick_count'=>$pick_count->pick_count),'picker_name');
				$data['order_details'] = $this->sparepart_order_model->find(array('dealer_id'=>$dealer_id,'order_no'=>$order_no));
				$this->db->order_by('part_code');
				if($picklist_status == '1')
				{
					if($dispatched_date)
					{
						if($date > $dispatched_date)
						{
							$rows = $this->picklist_model->findAll(array('dealer_id'=>$dealer_id,'order_no'=>$data['order_no'],'pick_count'=>($pick_count->pick_count) + 1));
						}
						else
						{
							$rows = $this->picklist_model->findAll(array('dealer_id'=>$dealer_id,'order_no'=>$data['order_no'],'pick_count'=>($pick_count->pick_count)));
						}
					}
					else
					{
						$rows = $this->picklist_model->findAll(array('dealer_id'=>$dealer_id,'order_no'=>$data['order_no'],'pick_count'=>($pick_count->pick_count)));
					}
				}
				else
				{
					$rows = $this->picklist_model->findAll(array('dealer_id'=>$dealer_id,'order_no'=>$data['order_no'],'pick_count'=>($pick_count->pick_count) + 1));
				}
				$this->sparepart_stock_model->_table = "view_sparepart_real_stock";			
				foreach ($rows as $key => $value) {
					$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$value->part_code));

					$rows[$key]->stock_quantity = @$check_stock->stock_quantity;
				}

				// usort($rows, function($a, $b) {
				//     return $a->location > $b->location;
				// });

				$data['rows'] = $rows;

				$data['header'] = lang('sparepart_orders');
				$data['page'] = $this->config->item('template_admin') . "picklist";
				$data['module'] = 'sparepart_orders';
				$this->load->view($this->_container,$data);
			}
		}

		public function file_upload()
		{
			$success =  $this->sparepart_order->jqxupload();
		}

		public function upload_delete(){
			$uploadPath = 'uploads/debit_receipt';
			$filename = $this->input->post('filename');
			@unlink($this->uploadPath . '/' . $filename);
			@unlink($this->uploadthumbpath . '/' . $filename);
		}

		public function save_receipt()
		{
			$data['dealer_id'] = $this->input->post('dealer_id');
			$data['amount'] = $this->input->post('debit_amount');
			$data['order_no'] = 0;
			$data['receipt_no'] = $this->input->post('receipt_no');
			$data['cr_dr'] = 'DEBIT';
			$data['date'] = $this->input->post('receipt_date');
			$data['date_nepali'] = get_nepali_date($this->input->post('receipt_date'),'nep');

			$success = $this->dealer_credit_model->insert($data);
			if($success)
			{
				echo json_encode(array('success'=>$success));
			}
		}

		public function cancel_order()
		{
			$this->sparepart_order_model->unsubscribe('after_create', 'activity_log_insert');     
			$this->sparepart_order_model->unsubscribe('before_update', 'audit_log_update');
			$data['order_no'] = $this->input->post('order_no');
			$data['dealer_id'] = $this->input->post('dealer_id');
			$data['order_cancel'] = 1;
			$this->db->where(array('order_no'=>$data['order_no'],'dealer_id'=>$this->input->post('dealer_id')));
			$success = $this->db->update('spareparts_sparepart_order',$data);

			echo json_encode(array('success'=>$success));
		}

		public function generate_unavailable_list()
		{
			$order_no = $this->input->post('order_no');
			$dealer_id = $this->input->post('dealer_id');
			$result = $this->order_unavailable_model->find(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));

			if($result)
			{
				$unavailable = explode(',', $result->unavailable_parts);
				$success = TRUE;
				echo json_encode(array('success'=>$success,'unavailable_parts'=>$unavailable));        
			}
			else
			{
				$success = FALSE;           
				echo json_encode(array('success'=>$success));        
			}
		}

		public function get_dealer_order_json() 
		{
			$dealer_id = $this->input->get('dealer_id');
			$order_type = $this->input->get('order_type');

			$this->db->distinct('order_no');

			$this->db->where('dealer_id', $dealer_id);
			$this->db->where('order_type', $order_type);

			$this->db->group_by('order_no');

			$rows=$this->sparepart_order_model->findAll(null, array('order_no'));

			array_unshift($rows, array('order_no' => 'Select Order No'));

			echo json_encode($rows);
		}  

		public function get_foc_customer_json()
		{
			$this->foc_document_model->_table = "view_foc_dropdown";
			$rows=$this->foc_document_model->findAll(array('billed'=>0), array('customer_id','full_name'));
			array_unshift($rows, array('full_name' => 'Select Order No'));
			echo json_encode($rows);
		}

		public function list_foc_spareparts()
		{
			$this->foc_document_model->_table = "view_foc_details";
			$customer_id = $this->input->post('customer_id');
			$acc_id = $this->foc_document_model->find(array('customer_id'=>$customer_id),array('customer_id','accessories_id'));
			$accessories_id = explode(',', $acc_id->accessories_id);

			foreach ($accessories_id as $value) 
			{
				$rows[] = $this->foc_accessoreis_partcode_model->find(array('id' => $value));
			}

			echo json_encode(array('success'=>TRUE,'rows'=>$rows,'customer_id'=>$acc_id->customer_id));
		}


		public function upload_picklist()
		{
			$dealer_id = $this->input->post('dealer_id');
			$order_no = $this->input->post('order_no');

			$config['upload_path'] = './uploads/dealer_order';
			$config['allowed_types'] = 'xlsx|csv|xls';
			$config['max_size'] = 100000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			} else {
				$data = array('upload_data' => $this->upload->data());
			}
			$file = FCPATH . 'uploads/dealer_order/' . $data['upload_data']['file_name']; 
			$this->load->library('Excel');
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');        
			$objReader->setReadDataOnly(false);

			$index = array('part_code','dispatch_quantity');
			$raw_data = array();
			$view_data = array();
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
		foreach ($raw_data as $key => $value) 
		{
			$sparepart_id = $this->sparepart_model->find(array('part_code'=>$value['part_code']));

			$excel_dispatch[$key]['sparepart_id'] = $sparepart_id->id;
			$excel_dispatch[$key]['dealer_id'] = $this->input->post('dealer_id_excel');
			$excel_dispatch[$key]['order_no'] = $this->input->post('order_no_excel');
			$excel_dispatch[$key]['created_by'] = $this->session->userdata('id');
			$excel_dispatch[$key]['created_at'] = date("Y-m-d H:i:s");            
			$excel_dispatch[$key]['dispatch_quantity'] = $value['dispatch_quantity'];
			$excel_dispatch[$key]['part_code'] = $value['part_code'];
		} 

		$this->db->trans_start();
		$this->dispatch_list_model->insert_many($excel_dispatch);
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

	public function list_order_spareparts()
	{
		$approved = array();
		$dealer_id = $this->input->post('dealer_id');
		$order_type = $this->input->post('order_type');
		$order_no = $this->input->post('order_no');
		$vor_percentage = $this->input->post('vor_percentage');
		$this->dispatch_list_model->_table = "view_dispatch_list_spareparts";

		$dispatch_list = $this->dispatch_list_model->findAll(array('dealer_id'=>$dealer_id,'order_type'=>$order_type,'order_no'=>$order_no,'billed'=>NULL));
		$pick_list = $this->picklist_model->findAll(array('dealer_id'=>$dealer_id,'order_no'=>$order_no,'order_type'=>$order_type));

		foreach ($pick_list as $pick) 
		{
			foreach ($dispatch_list as $dispatch)
			{
				if($pick->sparepart_id == $dispatch->sparepart_id)
				{
					$approved[] = $dispatch;
				}
			}
		}
		foreach ($approved as $key => $value) 
		{
			$approved[$key]->price = $value->price + (($value->price * $vor_percentage)/100);
		}
		echo json_encode(array('success'=>TRUE, 'rows'=>$approved,'dealer_id'=>$dealer_id,'order_no'=>$order_no,'vor_percentage'=>$vor_percentage));
	}

	public function preview($rows,$vor_percentage){

		$data['rows'] = $rows;
		$data['vor_percentage'] = $vor_percentage;

		$data['header'] = lang('sparepart_orders');

		$data['module'] = 'sparepart_orders';
		$this->load->view( $this->config->item('template_admin') . "preview",$data); 
	}

	public function recent_dispatch_json()
	{
		$dealer_id = $this->session->userdata('employee')['dealer_id'];

		$this->sparepart_order_model->_table = "view_sparepart_dispatch_by_billing";

		$where = "1=1";
		if(is_sparepart_dealer() || is_workshop_manager())
		{
			$where = "(dealer_id = ".$dealer_id." AND grn_received_date IS NULL)";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}

		if(is_aro()){
			$where = "(dealer_id = ".$this->session->userdata('employee')['dealer_id'].")";
			
		}
		$where .= " AND dispatched_date >= '2019-06-17'";

		search_params();
		$total=$this->sparepart_order_model->find_count($where);

		paging('dispatched_date');
		
		search_params();
		$rows=$this->sparepart_order_model->findAll($where);
		// echo $this->db->last_query();

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;

	}

	public function save_recent_dispatch()
	{
		$data = array();
		$dealer_id = $this->input->post('dealer_id');
		$grid_data = $this->input->post('grid_data');

		$this->db->select_max('grn_no');
		$grn_no = $this->db->get('spareparts_dispatch_spareparts')->row();
		$grn_no = ((($grn_no->grn_no)?$grn_no->grn_no:0) + 1);

				// echo '<pre>'; print_r($grid_data); exit;
		
		$defecit_quantity = array();

		foreach ($grid_data as $key => $value) 
		{
			if(isset($value['available'])){
				if(isset($value['order_no']))
				{
					$order_no = $value['order_no'];
				}
				$bill_no = $value['bill_no'];
				if(array_key_exists('received_quantity', $value) && ($value['received_quantity'] != '' || $value['received_quantity'] != null))
				{
					$total_dispatched = $value['received_quantity'];
					$defecit_quantity[] = array('quantity' => $value['total_dispatched'] - $value['received_quantity'],
						'sparepart_id' => $value['sparepart_id']);

				}
				else
				{
					$total_dispatched = $value['total_dispatched'];
				}



				$this->dispatch_sparepart_model->_table = "view_dispatch_spareparts";
				$dispatch = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no,'sparepart_id'=>$value['sparepart_id'],'grn_received_date'=>NULL),NULL,NULL,NULL,$total_dispatched);

				if($dispatch)
				{
					foreach ($dispatch as $k => $v) {
						$data[] = array(
							'id' => $v->id,
							'grn_no' => $grn_no,
							'grn_received_date' => $this->input->post('received_date'),
							'grn_received_date_np' => get_nepali_date($this->input->post('received_date'),'nep')
						);
					}
				}
				
				//update dealer stock
				$array = array();
				$this->dispatch_list_model->_table = "view_dispatch_list_spareparts";

				$dealer_stock_list = $this->dealer_stock_model->find(array('dealer_id'=>$dealer_id,'sparepart_id' => $value['sparepart_id']));
				// echo $this->db->last_query();
				// print_r($dealer_stock_list);
				// exit;
				// $dealer_stock_list = json_decode(json_encode($dealer_stock_list),True);

				// foreach ($dealer_stock_list as $k => $v) {
				// 	$array[] = $v['sparepart_id'];
				// }

				// $common_index = array_search($value['sparepart_id'], $array);

				$this->dealer_stock_model->_table ="spareparts_dealer_stock";
				$dealer_stock_exist = $this->dealer_stock_model->find(array('dealer_id'=>$dealer_id,'sparepart_id'=>$value['sparepart_id']));
				
				if(!$dealer_stock_exist)
				{

					$dealer_stock['quantity'] 	  = $total_dispatched;
					$dealer_stock['sparepart_id'] = $value['sparepart_id'];
					$dealer_stock['dealer_id']    = $dealer_id;
					$this->dealer_stock_model->insert($dealer_stock);
				}
				else
				{
					// $dealer_stock_update['id'] = $dealer_stock_list[$common_index]['id']; 
					// $dealer_stock_update['quantity'] = $total_dispatched + $dealer_stock_list[$common_index]['quantity'];
					// $this->dealer_stock_model->update($dealer_stock_update['id'],$dealer_stock_update);

					$dealer_stock_update['id'] = $dealer_stock_exist->id; 
					$dealer_stock_update['quantity'] = $total_dispatched + $dealer_stock_exist->quantity;
					$this->dealer_stock_model->update($dealer_stock_update['id'],$dealer_stock_update);
				}
			}
		}

		if($defecit_quantity)
		{
			$this->dispatch_sparepart_model->_table = "view_dispatch_spareparts";
			foreach ($defecit_quantity as $key => $val) {
				$defecit_items = $this->dispatch_sparepart_model->find(array('bill_no'=>$bill_no,'sparepart_id'=>$val['sparepart_id'],'grn_received_date'=>NULL));
				$insert_claim = array(
					'dealer_id' => $defecit_items->dealer_id,
					'sparepart_id' => $defecit_items->sparepart_id,
					'defecit_quantity' => $val['quantity'],
					'requested_by' => $this->session->userdata('id'),
					'requested_date' => date('Y-m-d'),
					'requested_date_np' => get_nepali_date(date('Y-m-d'),'nep')
				);
				$this->spareparts_dealer_claim_model->insert($insert_claim);
			}
		}

		$success = $this->db->update_batch('spareparts_dispatch_spareparts',$data,'id'); 
		
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

	// public function save_recent_dispatch()
	// {
	// 	$data = array();
	// 	$dealer_id = $this->input->post('dealer_id');
	// 	$grid_data = $this->input->post('grid_data');

	// 	$this->db->select_max('grn_no');
	// 	$grn_no = $this->db->get('spareparts_dispatch_spareparts')->row();
	// 	$grn_no = ((($grn_no->grn_no)?$grn_no->grn_no:0) + 1);

	// 	$defecit_quantity = array();

	// 	foreach ($grid_data as $key => $value) 
	// 	{
	// 		if(isset($value['available'])){
	// 			if(isset($value['order_no']))
	// 			{
	// 				$order_no = $value['order_no'];
	// 			}
	// 			$bill_no = $value['bill_no'];
	// 			if(array_key_exists('received_quantity', $value) && ($value['received_quantity'] != '' || $value['received_quantity'] != null))
	// 			{
	// 				$total_dispatched = $value['received_quantity'];
	// 				$defecit_quantity[] = array('quantity' => $value['total_dispatched'] - $value['received_quantity'],
	// 					'sparepart_id' => $value['sparepart_id']);

	// 			}
	// 			else
	// 			{
	// 				$total_dispatched = $value['total_dispatched'];
	// 			}

	// 			$this->dispatch_sparepart_model->_table = "view_dispatch_spareparts";
	// 			$dispatch = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no,'sparepart_id'=>$value['sparepart_id'],'grn_received_date'=>NULL),NULL,NULL,NULL,$total_dispatched);
	// 			if($dispatch)
	// 			{
	// 				foreach ($dispatch as $k => $v) {
	// 					$data[] = array(
	// 						'id' => $v->id,
	// 						'grn_no' => $grn_no,
	// 						'grn_received_date' => $this->input->post('received_date'),
	// 						'grn_received_date_np' => get_nepali_date($this->input->post('received_date'),'nep')
	// 					);
	// 				}
	// 			}

	// 			//update dealer stock
	// 			$array = array();
	// 			$this->dispatch_list_model->_table = "view_dispatch_list_spareparts";

	// 			$dealer_stock_list = $this->dealer_stock_model->findAll(array('dealer_id'=>$dealer_id));

	// 			// print_r($dealer_stock_list);
	// 			// exit;
	// 			$dealer_stock_list = json_decode(json_encode($dealer_stock_list),True);

	// 			foreach ($dealer_stock_list as $k => $v) {
	// 				$array[] = $v['sparepart_id'];
	// 			}

	// 			$common_index = array_search($value['sparepart_id'], $array);

	// 			$this->dealer_stock_model->_table ="spareparts_dealer_stock";

	// 			if($common_index === false)
	// 			{

	// 				$dealer_stock['quantity'] 	  = $total_dispatched;
	// 				$dealer_stock['sparepart_id'] = $value['sparepart_id'];
	// 				$dealer_stock['dealer_id']    = $dealer_id;
	// 				$this->dealer_stock_model->insert($dealer_stock);
	// 			}
	// 			else
	// 			{
	// 				$dealer_stock_update['id'] = $dealer_stock_list[$common_index]['id']; 
	// 				$dealer_stock_update['quantity'] = $total_dispatched + $dealer_stock_list[$common_index]['quantity'];
	// 				$this->dealer_stock_model->update($dealer_stock_update['id'],$dealer_stock_update);
	// 			}
	// 		}
	// 	}

	// 	if($defecit_quantity)
	// 	{
	// 		$this->dispatch_sparepart_model->_table = "view_dispatch_spareparts";
	// 		foreach ($defecit_quantity as $key => $val) {
	// 			$defecit_items = $this->dispatch_sparepart_model->find(array('bill_no'=>$bill_no,'sparepart_id'=>$val['sparepart_id'],'grn_received_date'=>NULL));
	// 			$insert_claim = array(
	// 				'dealer_id' => $defecit_items->dealer_id,
	// 				'sparepart_id' => $defecit_items->sparepart_id,
	// 				'defecit_quantity' => $val['quantity'],
	// 				'requested_by' => $this->session->userdata('id'),
	// 				'requested_date' => date('Y-m-d'),
	// 				'requested_date_np' => get_nepali_date(date('Y-m-d'),'nep')
	// 			);
	// 			$this->spareparts_dealer_claim_model->insert($insert_claim);
	// 		}
	// 	}

	// 	$success = $this->db->update_batch('spareparts_dispatch_spareparts',$data,'id'); 
		
	// 	if($success)
	// 	{
	// 		$success = TRUE;
	// 		$msg=lang('general_success');
	// 	}
	// 	else
	// 	{
	// 		$success = FALSE;
	// 		$msg=lang('general_failure');
	// 	}

	// 	echo json_encode(array('msg'=>$msg,'success'=>$success));
	// 	exit;
	// }

/*	public function get_barcode_values()
	{
		$dispatch_list = '';
		$data['part_code'] = $this->input->post('code');
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['order_no'] = $this->input->post('order_no');
		$this->sparepart_stock_model->_table = "view_sparepart_real_stock";
		$result = $this->sparepart_stock_model->find(array('latest_part_code'=>$data['part_code']));
		$data['dispatch_quantity'] = 1;
		if($result)
		{
			$data['sparepart_id'] = $result->sparepart_id;
			// check in picklist
			$this->db->where('sparepart_id',$result->sparepart_id);
			$this->db->where('dealer_id',$data['dealer_id']);
			$this->db->where('order_no',$data['order_no']);
			$this->db->where('is_billed',0);
			$picklist_check = $this->picklist_model->find();
			

			/*$this->db->where('sparepart_id',$result->sparepart_id);
			$this->db->where('dealer_id',$data['dealer_id']);
			$this->db->where('order_no',$data['order_no']);
			$this->db->where('is_billed',0);
			$dispatch_item = $this->dispatch_list_model->find_count();*/

			/*$this->db->where('sparepart_id',$result->sparepart_id);
			$this->db->where('dealer_id',$data['dealer_id']);
			$this->db->where('order_no',$data['order_no']);
			$this->db->where('is_billed',0);
			$dispatch_list_item = $this->dispatch_list_model->find();

			if($picklist_check)
			{
				if((($dispatch_list_item->dispatch_quantity)?$dispatch_list_item->dispatch_quantity:0) <= $picklist_check->dispatch_quantity)
					{
						if(!$dispatch_list_item)
						{
							$success = $this->dispatch_list_model->insert($data);
						}
						else
						{
							$update_data['id'] = $dispatch_list_item->id;
							$update_data['dispatch_quantity'] = $dispatch_list_item->dispatch_quantity+ 1;
							$success = $this->dispatch_list_model->update($update_data['id'],$update_data);
						}
						$this->dispatch_list_model->_table = "view_spareparts_dispatch_list";
						$dispatch_list = $this->dispatch_list_model->findAll(array('dealer_id'=>$data['dealer_id'],'order_no'=>$data['order_no'],'is_billed'=>0));
					}
					else
					{
						$success = FALSE;
						$message = 'Quantity Exceeds than in Picklist';
					}
				}
				else
				{
					$success = FALSE;
					$message = 'Item Not in Picklist';
				}

			}
			else
			{
				$success = FALSE;
				$message = 'Item not in picklist';
			}

			if($success)
			{
				$success = TRUE;
				$msg = 'Success';
			}
			else
			{
				$success = FALSE;
				$msg = $message;
			}

			echo json_encode(array('msg'=>$msg,'success'=>$success,'dispatch_list'=>$dispatch_list));
		}*/
		/*public function get_barcode_values()
		{
			$data['part_code'] = $this->input->post('code');
			$data['picklist_no'] = $this->input->post('picklist_no');
			$data['dispatch_quantity'] = 1;

			$this->sparepart_stock_model->_table = "view_sparepart_real_stock";
			$result = $this->sparepart_stock_model->find(array('part_code'=>$data['part_code']));

			$this->picklist_model->_table = "view_sparepart_picklist";
			$check_picklist = $this->picklist_model->find(array('part_code'=>$data['part_code'],'picklist_no'=>$data['picklist_no'],'is_billed'=>0));

			if($check_picklist)
			{
				$data['sparepart_id'] = $result->sparepart_id;
				$data['dealer_id'] = $check_picklist->dealer_id;
				$data['order_no'] = $check_picklist->order_no;
				$data['order_id'] = $check_picklist->order_id;
				$data['picklist_id'] = $check_picklist->picklist_id;

				$success = $this->dispatch_list_model->insert($data);
			}
			else
			{
				$success = FALSE;
				$message = "Item not in picklist";
			}


			if($success)
			{
				$this->dispatch_list_model->_table = "view_spareparts_dispatch_list";
				$dispatch_list = $this->dispatch_list_model->findAll(array('picklist_no'=>$data['picklist_no'],'is_billed'=>0));
				$success = TRUE;
				$msg = 'Success';
			}
			else
			{
				$dispatch_list = NULL;
				$success = FALSE;
				$msg = $message;
			}

			echo json_encode(array('msg'=>$msg,'success'=>$success,'dispatch_list'=>$dispatch_list));
		}*/

		public function get_barcode_values()
		{
			$success = false;
			$data['picklist_id'] = 0;
			$dispatch_list = '';
			$data['part_code'] = $this->input->post('code');
			$data['dealer_id'] = $this->input->post('dealer_id');
			$this->sparepart_stock_model->_table = "view_sparepart_real_stock";
			$result = $this->sparepart_stock_model->find(array('part_code'=>$data['part_code']));
			// echo $this->db->last_query();
			// echo $this->db->last_query();
			$data['dispatch_quantity'] = 1;
			
			// look after tihar
			/*if(!$result){
				// $rows=$this->sparepart_model->find(array('part_code' => $data['part_code']));

				$where = "alternate_part_code = '".$data['part_code']."'";
				$alternate_part_code = $this->sparepart_stock_model->find($where);

				$where = "latest_part_code = '".$data['part_code']."'";
				$latest_part_code = $this->sparepart_stock_model->find($where);

				if(!empty($latest_part_code) && !empty($latest_part_code)){
					if($latest_part_code->stock_quantity > $alternate_part_code){
						$result = $latest_part_code;
					}else{
						$result = $alternate_part_code;
					}
				}else if(!empty($latest_part_code)){
					$result = $latest_part_code;
				}else if(!empty($alternate_part_code)){
					$result = $alternate_part_code;
				}

				// $where = "alternate_part_code = '".$data['part_code']."' OR latest_part_code = '".$data['part_code']."'";
				// $result =  $this->sparepart_stock_model->find($where,'max(stock_quantity),*');


			}*/
			// end of look after tihar

			if($result)
			{
				$sparepart_detail = $this->sparepart_model->find(array('id'=>$result->sparepart_id));

				$this->db->order_by('id');
				$this->sparepart_order_model->_table = 'view_spareparts_dealer_order';
				$where_order = array(
					'dealer_id'=>$data['dealer_id'],
					"(sparepart_id = " . $result->sparepart_id . " OR alternate_part_code = '" . $data['part_code'] . "' OR latest_part_code = '". $data['part_code'] . "')" => NULL,
					// 'received_quantity < order_quantity' => NULL,
					'picklist' => 1,
					'(is_billed = 0 OR is_billed IS NULL)' => NULL,
				);
				$this->db->where('received_quantity < order_quantity - cancle_quantity',NULL, FALSE);

				$billed_part = $this->sparepart_order_model->find($where_order);
				// echo $this->db->last_query();exit;

				$order = NULL;
				if($billed_part){
					$where = array(
						// 'received_quantity < order_quantity' => NULL,
						'id' => $billed_part->id,
						'picklist' => 1,
					);
					$this->db->where('received_quantity < order_quantity - cancle_quantity',NULL, FALSE);
					$this->sparepart_order_model->_table = 'spareparts_sparepart_order';
					$order = $this->sparepart_order_model->find($where);
				}
				// echo '<pre>';
				// print_r($order);
				// echo $this->db->last_query();
				// exit;

				if($order)
				{
// print_r($this->db->last_query());echo ';<br>';
					$this->picklist_model->order_by('id');
					$picklist = $this->picklist_model->find(array('order_id'=>$order->id,'is_billed'=>0));
					// echo $this->db->last_query();
					// exit;

					// print_r($picklist);

					if($picklist)
					{
						$data['order_id'] = $order->id;
						$data['order_no'] = $order->order_no;
						$data['picklist_id'] = $picklist->id;
						$data['picklist_no'] = $picklist->picklist_no;
						$data['sparepart_id'] = $result->sparepart_id;
						$success = $this->dispatch_list_model->insert($data);
					}
					else
					{
						$success = FALSE;
						$message = 'No item in picklist for order no: ' . $order->order_no . '. Please generate picklist for this order.';
					}
				}
				else
				{
					$success = FALSE;
					$message = 'No item in  order';	
				}
			}
			else
			{
				$success = FALSE;
				$message = 'Item Not in Stock';
			}

			if($success)
			{
				$success = TRUE;
				$msg = 'Success';
			}
			else
			{
				$success = FALSE;
				$msg = $message;
			}

			echo json_encode(array('msg'=>$msg,'success'=>$success,'dealer_id'=>$data['dealer_id']));
		}


		public function get_recent_dispatch_list()
		{
			$bill_no = $this->input->post('bill_no');
			$strDate = substr($this->input->post('dispatched_date'),4,11);
			$dispatched_date = date('Y-m-d',strtotime($strDate));
			$this->dispatch_sparepart_model->_table = "view_spareparts_recent_dispatch_list";
			$rows = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no,'grn_received_date'=>NULL, 'dispatched_date' => $dispatched_date));

			echo json_encode(array('rows'=>$rows));
		}

		public function received_order_json()
		{
			$dealer_id = $this->session->userdata('employee')['dealer_id'];
			// $dispatched_date = $this->input->post('dispatched_date');

			$this->sparepart_order_model->_table = "view_spareparts_dispatch_grn";

			search_params();
			$total=$this->sparepart_order_model->find_count(array('dealer_id'=>$dealer_id,'grn_received_date <>'=>NULL));
			// $total=$this->sparepart_order_model->find_count(array('dealer_id'=>$dealer_id,'grn_received_date <>'=>NULL,'dispatched_date'=>$dispatched_date));

			paging('order_no');

			search_params();
			$rows=$this->sparepart_order_model->findAll(array('dealer_id'=>$dealer_id,'grn_received_date <>'=>NULL));
			// $rows=$this->sparepart_order_model->findAll(array('dealer_id'=>$dealer_id,'grn_received_date <>'=>NULL,'dispatched_date'=>$dispatched_date));

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;
		}
		public function get_received_order_list()
		{
			$bill_no = $this->input->post('bill_no');
			$this->dispatch_sparepart_model->_table = "view_spareparts_recent_dispatch_list";
			$rows = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no,'grn_received_date <>'=>NULL));

			echo json_encode(array('rows'=>$rows));
		}

		public function billing_list()
		{
			$this->sparepart_order_model->_table = 'view_spareparts_dispatch_grn';

			$fields = array('bill_concat','bill_no','dealer_name','dispatched_date','dispatched_date_nepali','dealer_id');

			search_params();
			$this->db->group_by($fields);
			// $total=$this->sparepart_order_model->find_count(Null,$fields);
			$this->db->select('COUNT (*) AS "numrows"');
			$result = $this->db->get('view_spareparts_dispatch_grn')->result_array();
			$total = count($result);

			paging('bill_no');

			search_params();
			$this->db->group_by($fields);
			$rows=$this->sparepart_order_model->findAll(Null,$fields);
			// echo $this->db->last_query();

			// $total = count($rows);

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;	
		}

		public function get_detailed_bill()
		{
			$bill_no = $this->input->get('bill_no');
			$date = $this->input->get('date');
			$date = explode(" ", $date);
			$this->sparepart_order_model->_table = 'view_dispatch_spareparts';

			$total=$this->sparepart_order_model->find_count(array('bill_no'=>$bill_no,'year_np'=>$date[3]));

			search_params();

			$rows=$this->sparepart_order_model->findAll(array('bill_no'=>$bill_no,'year_np'=>$date[3]));

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;			
		}

		public function generate_gatepass($bill_no = NULL)
		{
			$print = "print/gatepass";


			$this->db->order_by('id','desc');
			// $this->db->select_max('gatepass_no');
			// $this->db->select_max('id');
			$max_gatepass = $this->db->get('spareparts_gatepass')->row();
			$gatepass_no = ((($max_gatepass->gatepass_no)?$max_gatepass->gatepass_no:0) + 1);

			$this->db->select('gatepass_no');
			$this->db->where('bill_no',$bill_no);
			$check_gatepass = $this->db->get('spareparts_gatepass')->row();

			$data['gatepass_no'] = ($check_gatepass?$check_gatepass->gatepass_no : $gatepass_no);

			$data['bill_no'] = $bill_no;

			if(!$check_gatepass)
			{
				$this->dealer_model->_table = "spareparts_gatepass";
				$this->dealer_model->insert($data);
			}

			$fields = "dealer_id,SUM(dispatched_quantity * dealer_price) as amount,SUM(dispatched_quantity) as total_qty,dispatched_date_nepali";

			$this->db->group_by("dealer_id,dispatched_date_nepali,bill_no");
			$this->dispatch_sparepart_model->_table = "view_dispatch_spareparts";
			$data['bill_data'] = $this->dispatch_sparepart_model->find(array('bill_no'=>$bill_no),$fields);

			$data['dealer_data'] = $this->dealer_model->find(array('id'=>@$data['bill_data']->dealer_id));

			$this->load->view($this->config->item('template_admin') . $print , $data);
		}

		public function delete_order()
		{
			$data['id'] = $this->input->post('id');
			$success = $this->sparepart_order_model->delete($data['id']);
			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));        
		}

		public function save_order_item()
		{	
			if($this->input->post('dealer_id'))
			{
				$dealer_id = $this->input->post('dealer_id');
			}
			else
			{
				$dealer_id = $this->session->userdata('employee')['dealer_id'];
			}
			$order_no = $this->input->post('order_id');
			$dealer_order = $this->sparepart_order_model->find(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));

			// echo '<pre>'; print_r($dealer_id); exit;

			if($dealer_order->dealer_confirmed == 0)
			{
				$data['sparepart_id'] = $this->input->post('sparepart_id');
				$data['order_quantity'] = $this->input->post('quantity');
				$data['dealer_id'] = $dealer_order->dealer_id;
				$data['order_no'] = $dealer_order->order_no;
				$data['order_type'] = $dealer_order->order_type;
				$data['proforma_invoice_id'] = $dealer_order->proforma_invoice_id;
				$data['dispatch_mode'] = $dealer_order->dispatch_mode;
				$data['order_date'] = $dealer_order->order_date;
				$data['order_date_np'] = $dealer_order->order_date_np;

				$success = $this->sparepart_order_model->insert($data);
			}
			else
			{
				$success = False;
			}

			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));
		}

		public function save_order_item_dealer_incharge()
		{	
			$dealer_id = $this->input->post('dealer_id');
			$order_no = $this->input->post('order_id');
			$dealer_order = $this->sparepart_order_model->find(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));

			$data['sparepart_id'] = $this->input->post('sparepart_id');
			$data['order_quantity'] = $this->input->post('quantity');
			$data['dealer_id'] = $dealer_order->dealer_id;
			$data['order_no'] = $dealer_order->order_no;
			$data['order_type'] = $dealer_order->order_type;
			$data['proforma_invoice_id'] = $dealer_order->proforma_invoice_id;
			$data['dispatch_mode'] = $dealer_order->dispatch_mode;
			$data['order_date'] = $dealer_order->order_date;
			$data['pi_number'] = $dealer_order->pi_number;
			$data['order_date_np'] = $dealer_order->order_date_np;
			$data['dealer_confirmed'] = $dealer_order->dealer_confirmed;
			$data['pi_confirmed'] = $dealer_order->pi_confirmed;
			$data['confirmed_type'] = $dealer_order->confirmed_type;
			$data['pi_generated_date_time'] = $dealer_order->pi_generated_date_time;
			$data['remarks'] = $dealer_order->remarks;
			$data['pi_generated'] = $dealer_order->pi_generated;

			$success = $this->sparepart_order_model->insert($data);

			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));
		}

		public function picking_list()
		{
			$data['header'] = lang('sparepart_orders');
			$data['page'] = $this->config->item('template_admin') . "picking_list";
			$data['module'] = 'sparepart_orders';
			$this->load->view($this->_container,$data);
		}

		public function picking_list_json()
		{
			$this->picklist_model->_table = 'view_sparepart_picklist';

			$fields = "order,dealer_name,pick_count,order_no,dealer_id,picklist_no,picklist_format,billed_status,proforma_invoice_id,pi_number,picklist_group";

			search_params();
			$this->db->where('pi_number IS NOT NULL');
			$this->db->select('count(DISTINCT order_no) as total');
			$this->db->from('view_sparepart_picklist');
			$this->db->group_by('order,dealer_name,pick_count,picklist_no,billed_status');
			$result = $this->db->get()->result_array();
			$total = array_sum(array_column($result, 'total'));
			// echo '<pre>';
			// echo $this->db->last_query();
			// print_r($result);
			// print_r(array_column($result, 'total'));
			// print_r(array_sum(array_column($result, 'total')));
			// exit;
			// $query = 'SELECT SUM(total) as total FROM ( SELECT COUNT (DISTINCT order_no) AS total FROM "view_sparepart_picklist" WHERE "pi_number" IS NOT NULL GROUP BY "order","dealer_name","pick_count" ) as temp';
			// $result = $this->db->query($query)->row_array();
			// $total = $result['total'];
			
			paging('order_no');
			search_params();

			$this->db->group_by($fields);
			$this->db->where('pi_number IS NOT NULL');
			$rows=$this->picklist_model->findAll(NULL,$fields);

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;
		}

		public function picking_list_detail_json()
		{
			$picklist_no = $this->input->get('picklist_no');
			$dealer_id = $this->input->get('dealer_id');

			$this->picklist_model->_table = 'view_sparepart_picklist';

			$total=$this->picklist_model->find_count(array('picklist_no'=>$picklist_no, 'dealer_id'=>$dealer_id));
			paging('order_no');

			search_params();
			$rows=$this->picklist_model->findAll(array('picklist_no'=>$picklist_no, 'dealer_id'=>$dealer_id));

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;
		}

		public function print_pickin_list($dealer_id = NULL, $order_no = NULL, $pick_count = NULL)
		{
			$this->picklist_model->_table = 'view_sparepart_picklist';

			$data['dealer'] = $this->dealer_model->find(array('id'=>$dealer_id));
			$data['order_no'] = $order_no;
			$data['picker'] = $this->picklist_model->find(array('dealer_id'=>$dealer_id,'order_no'=>$order_no,'pick_count'=>$pick_count),'picker_name');
			$data['order_details'] = $this->sparepart_order_model->find(array('dealer_id'=>$dealer_id,'order_no'=>$order_no));
			// $this->db->order_by('location');
			$this->db->order_by('part_code');
			$rows = $this->picklist_model->findAll(array('dealer_id'=>$dealer_id,'order_no'=>$order_no,'pick_count'=>$pick_count));

			$this->sparepart_stock_model->_table = "view_sparepart_real_stock";			
			foreach ($rows as $key => $value) {
				$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$value->part_code));

				$rows[$key]->stock_quantity = @$check_stock->stock_quantity;
			}

			// usort($rows, function($a, $b) {
			//     return $a->location > $b->location;
			// });

			$data['rows'] = $rows;
			$data['header'] = lang('sparepart_orders');
			$data['page'] = $this->config->item('template_admin') . "new_picklist";
			$data['module'] = 'sparepart_orders';
			$this->load->view($this->_container,$data);
		}

		public function update_dispatch_quantity($bill = 1)
		{
			$data['id'] = $this->input->post('id');
			$order_id = $this->input->post('order_id');
			$picklist_no = $this->input->post('picklist_no');
			$data['dispatch_quantity'] = $this->input->post('dispatch_quantity');

			$dispatch_list_data = $this->dispatch_list_model->find(array('id' => $data['id']));

			$this->db->where('order_quantity > received_quantity + cancle_quantity', null, false);
			$order = $this->sparepart_order_model->findAll(array('dealer_id' => $dispatch_list_data->dealer_id, 'sparepart_id'=>$dispatch_list_data->sparepart_id, 'pi_generated' => 1, 'picklist' => 1));

			$order_qty = 0;
			$receive_qty = 0;
			$cancle_qty = 0;

			foreach ($order as $key => $value) {
				$order_qty += $value->order_quantity;
				$receive_qty += $value->received_quantity;
				$cancle_qty += $value->cancle_quantity;
			}

			/* checking alternative orders */
			$part_detail = $this->sparepart_model->find(array('id'=>$dispatch_list_data->sparepart_id));
			$alternative = array();
			if($part_detail->alternate_part_code){
				if($part_detail->alternate_part_code != $part_detail->part_code){
					$alternative[] = "alternate_part_code = '".$part_detail->part_code . "'";
				}
			}
			if($part_detail->alternate_part_code){
				if($part_detail->alternate_part_code != $part_detail->part_code){
					$alternative[] = "part_code = '".$part_detail->alternate_part_code . "'";
				}
			}
			if($part_detail->latest_part_code){
				if($part_detail->latest_part_code != $part_detail->part_code){
					$alternative[] = "latest_part_code = '".$part_detail->part_code . "'";
				}
			}
			if($part_detail->latest_part_code){
				if($part_detail->latest_part_code != $part_detail->part_code){
					$alternative[] = "part_code = '".$part_detail->latest_part_code . "'";
				}
			}
			
			if (count($alternative)) {
				$where_alternative = array(implode(' OR ', $alternative)=>NULL);
				$alternative_parts = $this->sparepart_model->findAll($where_alternative);

				$where_alternative_ids = array();
				foreach ($alternative_parts as $key => $value) {
					$where_alternative_ids[] = "sparepart_id = '". $value->id ."'";
				}

				$where_alternative_order['(' . implode(' OR ', $where_alternative_ids) . ')'] = NULL;
				$where_alternative_order['dealer_id'] = $dispatch_list_data->dealer_id;
				$where_alternative_order['received_quantity < order_quantity'] = NUll;
				$where_alternative_order['pi_generated'] = 1;
				$where_alternative_order['picklist'] = 1;
				$alternative_part_order = $this->sparepart_order_model->find_all($where_alternative_order);

				foreach ($alternative_part_order as $key => $value) {
					$order_qty += $value->order_quantity;
					$receive_qty += $value->received_quantity;
					$cancle_qty += $value->cancle_quantity;
				}
			}

			/* end checking alternative parts*/

			$remaining = $order_qty - $receive_qty - $cancle_qty;

			// echo '<pre>'; print_r($remaining); exit;
			if($remaining < $data['dispatch_quantity']){
				$msg = 'Order Quantity Exceeded by '.($data['dispatch_quantity'] - $remaining) ;
				$success = FALSE;
				echo json_encode(array('success'=>$success,'msg'=>$msg));
				exit;
			}
			
			$picklist_data = $this->picklist_model->find(array('sparepart_id'=>$dispatch_list_data->sparepart_id, 'is_billed' => 0, 'dealer_id' => $dispatch_list_data->dealer_id),'SUM(dispatch_quantity) AS total');
			// print_r($dispatch_list_data);
			// echo $this->db->last_query();
			if($bill){
				if($picklist_data->total < $data['dispatch_quantity']){
					$msg = 'Quantity is not acceptable.';
					$success = FALSE;
					echo json_encode(array('success'=>$success,'msg'=>$msg));
					exit;
				}
			}

			$success = $this->dispatch_list_model->update($data['id'],$data);

			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg)); 
		}

		public function update_order_quantity()
		{
			$data['id'] = $this->input->post('id');
			$data['order_quantity'] = $this->input->post('order_quantity');

			$success = $this->sparepart_order_model->update($data['id'],$data);

			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg)); 
		}

		public function update_pi_remarks()
		{
			$proforma_invoice_id = $this->input->post('proforma_invoice_id');
			$order = $this->sparepart_order_model->findAll(array('proforma_invoice_id'=>$proforma_invoice_id));
			foreach ($order as $key => $value) 
			{
				$data['id'] = $value->id; 
				$data['remarks'] = $this->input->post('remarks');
				$success = $this->sparepart_order_model->update($data['id'],$data);
			}


			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg)); 
		}

		public function update_pick_list_no()
		{
			$this->db->order_by('id');
			$picklist = $this->picklist_model->findAll();
			$order_no = 0;
			$dealer_id = 0;
			$picklist_no = 0;
			foreach ($picklist as $key => $value) 
			{
				$data['id'] = $value->id;
				if($value->order_no == $order_no && $value->dealer_id == $dealer_id)
				{
					$data['picklist_no'] = $picklist_no;
					$data['picklist_format'] = "PICKLST-".sprintf('%05d', $data['picklist_no']);
				}
				else
				{
					$data['picklist_no'] = $picklist_no + 1;
					$data['picklist_format'] = "PICKLST-".sprintf('%05d', $data['picklist_no']);
				}
				$success = $this->picklist_model->update($data['id'],$data);
				$order_no = $value->order_no;
				$dealer_id = $value->dealer_id;
				$picklist_no = $data['picklist_no'];
			}

			exit;
		}

		public function dispatch_spareparts_list_json()
		{
			$dealer_id = $this->input->get('dealer_id');

			$this->dispatch_list_model->_table = "view_spareparts_dispatch_list";
			$this->db->order_by('id asc');
			
			$rows = $this->dispatch_list_model->findAll(array('dealer_id'=>$dealer_id,'is_billed'=>0));
			foreach ($rows as $key => $value) {
				// print_r($value);
				$sparepart = $this->sparepart_model->find(array('id'=>$value->sparepart_id));
				$rows[$key]->dealer_price = $sparepart->dealer_price;
			}
			// echo $this->db->last_query();

			echo json_encode($rows);
		}

		public function dispatch_spareparts_json()
		{
			$where = array('is_billed' => 0);
			if($this->input->get('dealer_id')){
				$where['dealer_id'] = $this->input->get('dealer_id');
			}
			if($this->input->get('ledger_id')){
				$where['ledger_id'] = $this->input->get('ledger_id');
			}

			// $dealer_id = $this->input->get('dealer_id');

			$this->dispatch_list_model->_table = "view_spareparts_dispatch_list";
			$this->db->order_by('id asc');

			search_params();
			// $rows = $this->dispatch_list_model->findAll(array('dealer_id'=>$dealer_id,'is_billed'=>0));
			$rows = $this->dispatch_list_model->findAll($where);

			echo json_encode($rows);
		}

		public function get_picklist_list()
		{
			$this->picklist_model->_table = "view_sparepart_picklist";
			$this->db->order_by('picklist_no');
			$this->db->group_by(array('picklist_no','picklist_format','order_type'));
			$rows = $this->picklist_model->findAll(NULL,array('picklist_no','picklist_format','order_type'));
			echo json_encode($rows);
		}
		
		public function set_barcode_values()
		{
			$dispatch_list = '';
			$data['part_code'] = $this->input->post('code');
			$data['dealer_id'] = ($this->input->post('dealer_id'))?$this->input->post('dealer_id'):NULL;
			$data['ledger_id'] = ($this->input->post('ledger_id'))?$this->input->post('ledger_id'):NULL;
			$this->sparepart_stock_model->_table = "view_sparepart_real_stock";
			$result = $this->sparepart_stock_model->find(array('part_code'=>$data['part_code']));
			$data['dispatch_quantity'] = 1;

			if($result)
			{
				$data['sparepart_id'] = $result->sparepart_id;
				$success = $this->dispatch_list_model->insert($data);
			}
			else
			{
				$success = FALSE;
				$message = 'Item Not in Stock';
			}

			if($success)
			{
				$success = TRUE;
				$msg = 'Success';
			}
			else
			{
				$success = FALSE;
				$msg = $message;
			}

			echo json_encode(array('msg'=>$msg,'success'=>$success,''));
		}

		public function save_bill()
		{
			$fiscal_year = get_current_fiscal_year();
			$this->db->trans_begin();
			if($this->input->post('bill_no')){
				$bill_no = $this->input->post('bill_no');
				$result = $this->dispatch_sparepart_model->find(array('bill_no'=>$bill_no,"dispatched_date >='" . $fiscal_year[2] . "'" => NULL));
				if($result){
					$success = FALSE;
					$msg = 'Bill(' . $bill_no . ') already exist';
					echo json_encode(array('msg'=>$msg,'success'=>$success,'bill_no'=>$bill_no));
					exit;
				}
				// $dispatched_date_nepali = $result->dispatched_date_nepali;

			}else{
				$where_bill_start_date["dispatched_date >= '" .$fiscal_year['2'] . "'"] = NULL;
				$this->db->group_by('dispatched_date_nepali, bill_no');
				$this->db->order_by('bill_no','desc');
				$result = $this->dispatch_sparepart_model->find($where_bill_start_date,'bill_no,dispatched_date_nepali');
				// print_r($result);
				// exit();
				$bill_no  =($result->bill_no ? ($result->bill_no + 1) : 1);
				$dispatched_date_nepali = $result->dispatched_date_nepali;
				// $bill_no  =($result->bill_no ? ($result->bill_no + 1) : 2360);
			}

			$billed_date = $this->input->post('billed_date');
			$remarks = $this->input->post('remarks');
			$grid_data = array_map('array_filter',  $this->input->post('data'));
			$grid_data = array_filter($grid_data);

			// echo $bill_no;
			// exit;

			$post = $this->input->post();
			$total_credit = 0;
			// echo '<pre>';
			// print_r($post);
			// print_r($grid_data);
			// exit;

			foreach ($grid_data as $key => $value) 
			{
				if($value['id']){
					unset($post['data']);
					$success = $this->update_order($value,$bill_no,$post);

					// update credit
					if($this->input->post('vor_percentage'))
					{
						$price = $value['dealer_price'] + (($value['dealer_price'] * $this->input->post('vor_percentage'))/ 100 );
					}
					else
					{
						if(array_key_exists('dealer_price', $value)){
							$price = $value['dealer_price'];	
						}else{
							$price = 0;
						}
					}

					$total_credit +=  ($value['dispatch_quantity'] * $price);
					if($this->input->post('discount_percentage'))
					{
						$total_credit = $total_credit - ($total_credit * $this->input->post('discount_percentage')/100);
					}
					else
					{
						$total_credit = $total_credit;
					}

					$dealer_credit['dealer_id']	= $value['dealer_id'];;
					if(isset($value['order_no']))
					{
						$dealer_credit['order_no']	= $value['order_no'];
					}
					$dealer_credit['cr_dr'] = 'CREDIT';
					$dealer_credit['date'] = date('Y-m-d');
					$dealer_credit['bill_no'] = $bill_no;
					$dealer_credit['date_nepali'] = get_nepali_date(date('Y-m-d'),'nep');
					$dealer_credit['amount'] = ($total_credit * 1.13);
				}
			}			
			
			$success = $this->dealer_credit_model->insert($dealer_credit);

			if ($this->db->trans_status() === FALSE)
			{
			        $this->db->trans_rollback();
			        $success = FALSE;
					$msg = 'Error';
			}
			else
			{
			        $this->db->trans_commit();
			        $success = TRUE;
					$msg = 'Success';
			}
			echo json_encode(array('msg'=>$msg,'success'=>$success,'bill_no'=>$bill_no,'dispatched_date_nepali'=>$dispatched_date_nepali));
		}

		public function generate_bill($bill_no = NULL,$dispatched_date_nepali = NULL)
		{
			$dispatched_date_nepali = explode("-", $dispatched_date_nepali);
			// print_r($dispatched_date_nepali[0]);
			// exit();
			$this->dispatch_sparepart_model->_table = "view_dispatch_spareparts";
			$rows = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no,'year_np'=>$dispatched_date_nepali[0]));
			// echo $this->db->last_query();
			// print_r($rows);
			// exit;
			
			if($rows)
			{
				$this->load->library('Excel');

				$objPHPExcel = new PHPExcel(); 
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
				$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
				$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('A4:C4');
				$objPHPExcel->getActiveSheet()->getStyle('A4:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$objPHPExcel->getActiveSheet()->mergeCells('D4:F4');
				$objPHPExcel->getActiveSheet()->getStyle('D4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
				$objPHPExcel->getActiveSheet()->SetCellValue('A1','SHREE HIMAYALAN ENTERPRISES PVT.LTD.');
				$objPHPExcel->getActiveSheet()->SetCellValue('A2','SPAREPARTS LOGISTIC DIVISION');
				$objPHPExcel->getActiveSheet()->SetCellValue('A3','Satungal, Kathmandu - Nepal');
				$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer : '.$rows[0]->dealer_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('D4','Date : '.date('Y-m-d'));
				$objPHPExcel->getActiveSheet()->SetCellValue('A5','Bill No: SSB-'.$bill_no);
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

				$objPHPExcel->getActiveSheet()->SetCellValue('A6','S.N.');
				$objPHPExcel->getActiveSheet()->SetCellValue('B6','Part Code');
				$objPHPExcel->getActiveSheet()->SetCellValue('C6','Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('D6','Price (in Nrs.)');
				$objPHPExcel->getActiveSheet()->SetCellValue('E6','Quantity');
				$objPHPExcel->getActiveSheet()->SetCellValue('F6','Total Amount (in Nrs.)');

				$row = 7;
				$col = 0;        
				foreach($rows as $key => $values) 
				{           
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->part_code);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row,($values->dealer_price));
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->dispatched_quantity);
					$col++;
					// Applying vor percentage
					$amount = $values->dispatched_quantity * ($values->dealer_price + ($values->dealer_price * $values->vor_percentage/100));
					// Applyin discount if available
					// $final_amount = $amount - ($amount * $values->discount_percentage / 100);

					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $amount  );
					$col++;                                       

					$col = 0;
					$row++; 

				}
				$objPHPExcel->getActiveSheet()
				->setCellValue('E'.$row, 'Total Amount')
				->setCellValue('F'.$row, '=SUM(F7:F'.($row-1).')');
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($row+1), 'Discount ('.$discount_percentage.'%)');
				if($discount_percentage){				
					$objPHPExcel->getActiveSheet()->setCellValue('F'.($row+1), '=(SUM(F7:F'.($row-1).'))*'.$discount_percentage.'/100');
				}
				$objPHPExcel->getActiveSheet()	
				->setCellValue('E'.($row+2), 'Vat (13 %)')
				->setCellValue('F'.($row+2), '=((F'.$row.'-F'.($row+1).'))*13/100')
				->setCellValue('E'.($row+3), 'Grand Total')
				->setCellValue('F'.($row+3), '=(F'.$row.'-F'.($row+1).'+F'.($row+2).')'); 

				header("Pragma: public");
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment;filename=Bill-".date('Y-m-d')."-".$bill_no.".xls");
				header("Content-Transfer-Encoding: binary ");
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				ob_end_clean();
				$objWriter->save('php://output');
			}
		}

		public function delete_item_picklist()
		{
			$data['id'] = $this->input->post('id');
			$success = $this->dispatch_list_model->delete($data['id']);
			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));    
		}

		public function delete_backlog()
		{
			$data['id'] = $this->input->post('id');
			$order = $this->sparepart_order_model->find($data);
			$data['cancle_quantity'] = ($order->cancle_quantity)?$order->cancle_quantity + $this->input->post('qty'):$this->input->post('qty');
			$data['order_quantity'] = $order->order_quantity - $this->input->post('qty') ;
			// $this->db->set('order_quantity','order_quantity-1',false);
			$success = $this->sparepart_order_model->update($data['id'],$data);
			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));    
		}

		public function delete_picklist_item()
		{
			$picklist_detail = $this->picklist_model->find(array('id'=>$this->input->post('id')));
			$data['id'] = $this->input->post('id');
			$success = $this->picklist_model->delete($data['id']);
			if($success)
			{
				$order['id'] = $picklist_detail->order_id;
				$this->sparepart_order_model->delete($order['id']);
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));    
		}

		public function save_picklist_item()
		{
			$proforma_invoice_id = $this->input->post('proforma_invoice_id');
			$dealer_id = $this->input->post('dealer_id');
			$dealer_order = $this->sparepart_order_model->find(array('proforma_invoice_id'=>$proforma_invoice_id, 'dealer_id'=>$dealer_id));
			// echo '<pre>';print_r($dealer_order);
			// echo $this->db->last_query();
			// exit;

			$data['sparepart_id'] = $this->input->post('sparepart_id');
			$data['order_quantity'] = $this->input->post('quantity');
			$data['dealer_id'] = $dealer_order->dealer_id;
			$data['order_no'] = $dealer_order->order_no;
			$data['order_type'] = $dealer_order->order_type;
			$data['proforma_invoice_id'] = $dealer_order->proforma_invoice_id;
			$data['dispatch_mode'] = $dealer_order->dispatch_mode;
			$data['order_date'] = $dealer_order->order_date;
			$data['pi_number'] = $dealer_order->pi_number;
			$data['order_date_np'] = $dealer_order->order_date_np;
			$data['pi_confirmed'] = $dealer_order->pi_confirmed;
			$data['dealer_confirmed'] = $dealer_order->dealer_confirmed;
			$data['confirmed_type'] = $dealer_order->confirmed_type;
			$data['pi_generated_date_time'] = $dealer_order->pi_generated_date_time;
			$data['remarks'] = $dealer_order->remarks;
			$data['pi_generated'] = $dealer_order->pi_generated;
			$data['picklist'] = $dealer_order->picklist;
			// print_r($data);exit;

			$success = $this->sparepart_order_model->insert($data);

			if($success)
			{
				$picklist_no = $this->input->post('picklist_no');
				$picklist_detail = $this->picklist_model->find(array('picklist_no'=>$picklist_no));

				$picklist['order_id'] = $success;
				$picklist['dealer_id'] = $picklist_detail->dealer_id;
				$picklist['order_no'] = $picklist_detail->order_no;
				$picklist['order_type'] = $picklist_detail->order_type;
				$picklist['pick_count'] = $picklist_detail->pick_count;
				$picklist['is_billed'] = 0; // $picklist_detail->is_billed;
				$picklist['picker_id'] = $picklist_detail->picker_id;
				$picklist['picklist_format'] = $picklist_detail->picklist_format;
				$picklist['picklist_no'] = $picklist_detail->picklist_no;
				$picklist['picked_quantity'] = $picklist_detail->picked_quantity;
				$picklist['sparepart_id'] = $this->input->post('sparepart_id');
				$picklist['dispatch_quantity'] = $this->input->post('quantity');
				$picklist['dispatched_date'] = $picklist_detail->dispatched_date;
				$picklist['dispatched_date_nep'] = $picklist_detail->dispatched_date_nep;

				$this->picklist_model->insert($picklist);
			}

			if($success)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));
		}

		public function cancel_billing()
		{
			$bill_no = $this->input->post('bill_no');
			$bill_content = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no));

			// cancel bill
			foreach ($bill_content as $key => $value) 
			{
				$cancel['id'] = $value->id;
				$success = $this->dispatch_sparepart_model->delete($cancel['id']);
			}

			//update stock
			if($success)
			{
				foreach ($bill_content as $key => $value) 
				{
					$stock = $this->sparepart_stock_model->find(array('id'=>$value->stock_id));
					$update_stock['id'] = $value->stock_id;
					$update_stock['quantity'] = $value->dispatched_quantity + $stock->quantity;

					$success_upate = $this->sparepart_stock_model->update($update_stock['id'],$update_stock);
				}
			}
			if($success_upate)
			{
				$msg = 'Success';
				$success = TRUE;
			}
			else
			{
				$msg = 'Fail';           
				$success = FALSE;           
			}	
			echo json_encode(array('success'=>$success,'msg'=>$msg));

		}

		private function get_orders_fifo($value)
		{
			$this->db->order_by('id','asc');
			$this->sparepart_order_model->_table = 'spareparts_sparepart_order';

			$this->db->where('order_quantity > received_quantity + cancle_quantity',NULL,false);
			$data = $this->sparepart_order_model->find(array('dealer_id'=>$value['dealer_id'],'sparepart_id'=>$value['sparepart_id'], 'pi_generated'=>1,'picklist'=>1));
			// $data = $this->sparepart_order_model->find(array('order_quantity > received_quantity'=>NULL,'dealer_id'=>$value['dealer_id'],'sparepart_id'=>$value['sparepart_id'], 'pi_generated'=>1,'picklist'=>1));

			// print_r($data);
			// return $data;
			// exit;

			if($data == NULL){
				$part_code = $this->sparepart_model->find(array('id' => $value['sparepart_id']));
				$where_array[] = "alternate_part_code = '".$part_code->part_code ."' OR latest_part_code = '". $part_code->part_code ."'";
				if($part_code->alternate_part_code && $part_code->part_code != $part_code->alternate_part_code){
					$where_array[] = "part_code = '". $part_code->alternate_part_code."'";
				}
				if($part_code->latest_part_code && $part_code->part_code != $part_code->latest_part_code){
					$where_array[] = "part_code = '". $part_code->latest_part_code."'";
				}
				$where = array(
					"(".implode(' OR ', $where_array).")"=>NULL
				);
				$alternative_parts = $this->sparepart_model->findAll($where);
				foreach ($alternative_parts as $key => $val) {
					$this->db->where('order_quantity > received_quantity + cancle_quantity',NULL,false);
					$data = $this->sparepart_order_model->find(array('dealer_id'=>$value['dealer_id'],'sparepart_id'=>$val->id, 'pi_generated'=>1,'picklist'=>1));
					// $data = $this->sparepart_order_model->find(array('order_quantity > received_quantity'=>NULL,'dealer_id'=>$value['dealer_id'],'sparepart_id'=>$val->id, 'pi_generated'=>1,'picklist'=>1));
					if($data != NULL){
						break;
					}
				}

			}
			return $data;
		}

		public function update_order($value,$bill_no,$post)
		{
			$total_credit = 0;
			//get order
			$order = $this->get_orders_fifo($value);
			if(!$order){
				return true;
			}
// print_r($this->db->last_query());
			$data['id'] = $order->id;
			if(($order->order_quantity - $order->received_quantity) <= $value['dispatch_quantity'])
			{
				$data['received_quantity'] = $order->order_quantity;
				$dispatched = $order->order_quantity - $order->received_quantity;

			}
			else
			{
				$data['received_quantity'] = $order->received_quantity + $value['dispatch_quantity']; 
				$dispatched = $value['dispatch_quantity'];

			}

			// var_dump($order);
			// print_r($data);
			$success = $this->sparepart_order_model->update($data['id'],$data);

			// get pick count
			$this->db->where(array('dispatched_date <'=>date('Y-m-d'),'proforma_invoice_id'=>$order->proforma_invoice_id));
			// $this->db->order_by('id', 'desc');
			$pick_count = $this->dispatch_sparepart_model->find(NULL,'max(pick_count) as pick_count');
			$pickcount  =($pick_count->pick_count ? ($pick_count->pick_count + 1) : 1);

			// echo $this->db->last_query(); exit;
			if($success)
			{
				// insert spareparts dispatch
				$stock = $this->sparepart_stock_model->find(array('sparepart_id'=>$value['sparepart_id']));
				$dispatch['order_no'] = $order->order_no;
				$dispatch['proforma_invoice_id'] = $order->proforma_invoice_id;
				$dispatch['proforma_invoice_no'] = $order->proforma_invoice_id;
				$dispatch['order_id'] = $order->id;
				// $dispatch['dispatched_quantity'] = $data['received_quantity'];
				$dispatch['dispatched_quantity'] = $dispatched;
				$dispatch['dispatched_date'] = $post['billed_date'];
				$dispatch['dispatched_date_nepali'] = get_nepali_date($post['billed_date'],'nep');
				$date_exp = explode('-', $dispatch['dispatched_date_nepali']);
				$dispatch['year_np'] = $date_exp[0];
				$dispatch['month_np'] = $date_exp[1];
				$dispatch['bill_no'] = $bill_no;
				$dispatch['billed'] = 1;
				$dispatch['stock_id'] = $stock->id;
				$dispatch['pick_count'] = $pickcount;
				$dispatch['vor_percentage'] = ($post['vor_percentage']?$post['vor_percentage']:0);
				$dispatch['discount_percentage'] = ($post['discount_percentage']?$post['discount_percentage']:0);
				$dispatch['dealer_id'] = $value['dealer_id'];
				$this->dispatch_sparepart_model->insert($dispatch);

				// update dispatch list
				$dis_list['id'] = $value['id'];
				$dis_list['is_billed'] = 1;
				$dis_list['order_id'] = $order->id;
				$this->dispatch_list_model->update($dis_list['id'],$dis_list);

				//update stock
				$stock_update['id'] = $stock->id;
				$stock_update['quantity'] = $stock->quantity - $data['received_quantity'];
				$this->sparepart_stock_model->update($stock_update['id'],$stock_update);

				// update picklist
				$update_picklist = array();				
				if(isset($value['picklist_id']))
				{
					$picked_quantity = $this->picklist_model->find(array('id'=>$value['picklist_id']),'picked_quantity');

					$update_picklist['id'] = $value['picklist_id'];
					$update_picklist['picked_quantity'] = ($picked_quantity ? $picked_quantity->picked_quantity : 0) + $value['dispatch_quantity'];
					if($update_picklist['picked_quantity'] >= $order->order_quantity)
					{
						$update_picklist['is_billed'] = 1;
					}
				}
				if(!empty($update_picklist))				
				$this->picklist_model->update($update_picklist['id'],$update_picklist);
			}

			$value['dispatch_quantity'] = $value['dispatch_quantity'] - ($order->order_quantity - $order->received_quantity);

			if($value['dispatch_quantity'] >= 1)
			{
				$this->update_order($value,$bill_no,$post);
			}
			else
			{
				return false;
			}

			return true;
		}

		public function save_no_order_bill()
		{
			$this->db->trans_begin();
			$discount_percentage = 0;
			$billed_date = $this->input->post('billed_date');
			$remarks = $this->input->post('remarks');
			$grid_data = array_map('array_filter',  $this->input->post('data'));
			$grid_data = array_filter($grid_data);
			$fiscal_year = get_current_fiscal_year();

			$result = $this->dispatch_sparepart_model->find(NULL,'max(bill_no) as bill_no');
			
			// $bill_no = $this->input->post('bill_no');
			// if(!$bill_no){
			// 	$bill_no  =($result->bill_no ? ($result->bill_no + 1) : 1);
			// }

			if($this->input->post('bill_no')){
				$bill_no = $this->input->post('bill_no');
				$result = $this->dispatch_sparepart_model->find(array('bill_no'=>$bill_no,"dispatched_date >='" . $fiscal_year[2] . "'" => NULL));
				if($result){
					$success = FALSE;
					$msg = 'Bill(' . $bill_no . ') already exist';
					echo json_encode(array('msg'=>$msg,'success'=>$success,'bill_no'=>$bill_no));
					exit;
				}
			}else{
				$where_bill_start_date["dispatched_date >= '" .$fiscal_year['2'] . "'"] = NULL;
				$this->db->order_by('bill_no');
				$result = $this->dispatch_sparepart_model->find($where_bill_start_date,' bill_no');
				$bill_no  =($result->bill_no ? ($result->bill_no + 1) : 1);
				// $bill_no  =($result->bill_no ? ($result->bill_no + 1) : 2360);
			}

			$post = $this->input->post();
			$total_credit = 0;
			if($this->input->post('discount_percentage'))
			{
				$discount_percentage = $this->input->post('discount_percentage');
			}

			foreach ($grid_data as $key => $value) 
			{
				if(isset($value['ledger_id'])){
					$ledger_id = $value['ledger_id'];
				}else{
					$ledger_id = 0;
					$value['ledger_id'] = NULL;
				}
				unset($post['data']);
				$success = $this->update_no_order($value,$bill_no,$post,$discount_percentage);

				// update credit
				if(!$ledger_id){
					$total_credit +=  ($value['dispatch_quantity'] *  $value['dealer_price']);
					if($this->input->post('discount_percentage'))
					{
						$total_credit = $total_credit - ($total_credit * $this->input->post('discount_percentage')/100);
					}
					else
					{
						$total_credit = $total_credit;
					}

					$dealer_credit['dealer_id']	= $value['dealer_id'];;
					if(isset($value['order_no']))
					{
						$dealer_credit['order_no']	= $value['order_no'];
					}
					$dealer_credit['cr_dr'] = 'CREDIT';
					$dealer_credit['date'] = date('Y-m-d');
					$dealer_credit['bill_no'] = $bill_no;
					$dealer_credit['date_nepali'] = get_nepali_date(date('Y-m-d'),'nep');
					$dealer_credit['amount'] = ($total_credit * 1.13);
				}
			}			
			if(!$ledger_id){
				$success = $this->dealer_credit_model->insert($dealer_credit);
			}

			if ($this->db->trans_status() === FALSE)
			{
		        $this->db->trans_rollback();
		        $success = FALSE;
				$msg = 'Error';
			}
			else
			{
		        $this->db->trans_commit();
		        $success = TRUE;
				$msg = 'Success';
			}
			echo json_encode(array('msg'=>$msg,'success'=>$success,'bill_no'=>$bill_no));
		}

		public function update_no_order($value,$bill_no,$post,$discount_percentage)
		{
			if($value['ledger_id']){
				$order = $this->dispatch_list_model->findAll(array('ledger_id'=>$value['ledger_id'], 'is_billed'=>'0'));
			}else{
				$order = $this->dispatch_list_model->findAll(array('dealer_id'=>$value['dealer_id'], 'is_billed'=>'0'));
			}
			
			if($order)
			{
				// insert spareparts dispatch
				$stock = $this->sparepart_stock_model->find(array('sparepart_id'=>$value['sparepart_id']));
			
				$dispatch['dispatched_quantity'] = $value['dispatch_quantity'];
				$dispatch['dispatched_date'] = $post['billed_date'];
				$dispatch['dispatched_date_nepali'] = get_nepali_date($post['billed_date'],'nep');
				$date_exp = explode('-', $dispatch['dispatched_date_nepali']);
				$dispatch['year_np'] = $date_exp[0];
				$dispatch['month_np'] = $date_exp[1];
				$dispatch['bill_no'] = $bill_no;
				$dispatch['billed'] = 1;
				$dispatch['stock_id'] = $stock->id;
				// $dispatch['pick_count'] = $pickcount;
				$dispatch['discount_percentage'] = ($discount_percentage?$discount_percentage:0);
				if(isset($value['dealer_id'])){
					$dispatch['dealer_id'] = $value['dealer_id'];
				}else{
					$dispatch['ledger_id'] = $value['ledger_id'];
				}
				$this->dispatch_sparepart_model->insert($dispatch);

				// update dispatch list
				$dis_list['id'] = $value['id'];
				$dis_list['is_billed'] = 1;
				$this->dispatch_list_model->update($dis_list['id'],$dis_list);

				//update stock
				$stock_update['id'] = $stock->id;
				$stock_update['quantity'] = $stock->quantity - $value['dispatch_quantity'];
				$this->sparepart_stock_model->update($stock_update['id'],$stock_update);
			}
			return true;
		}
		
		public function pi_range_export()
		{
			$data = $this->input->post();

			$this->sparepart_order_model->_table = 'view_spareparts_order';
			$where = array();
			if (array_key_exists('pi_range_start',$data)) {
				$where['pi_generated_date_time >= '] = $data['pi_range_start'];
			}
			if(array_key_exists('pi_range_end', $data)){
				$where['pi_generated_date_time <= '] =  $data['pi_range_end'];
			}
			
			$this->db->order_by('pi_status');
			$rows = $this->sparepart_order_model->findAll($where);
			// echo '<pre>';PRINT_R($rows);exit;

	        $this->load->library('Excel');


	        $objPHPExcel = new PHPExcel(); 
	        $objPHPExcel->setActiveSheetIndex(0);
	        // $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');


	        // $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
	        // $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
	        // $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);

	        $objPHPExcel->getActiveSheet()->SetCellValue('A1','PI NO.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1','PI DATE');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1','DEALER');
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1','SUPPLY PART NO.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1','DESCRIPTION');
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1','QUANTITY');
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1','RATE');
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1','TOTAL');
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1','MODE');
	        $objPHPExcel->getActiveSheet()->SetCellValue('J1','TYPE');

	        $row = 2;
	        if($rows){
	        	$pi_number = $rows[0]->pi_status;
	        }
	        // $col = 'A';
	        foreach ($rows as $key => $value) {
	        	if($pi_number != $value->pi_status){
	        		$row++;
	        		$pi_number = $value->pi_status;
	        	}
	        	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->pi_status);
		        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->pi_generated_date_time);
		        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->dealer_name);
		        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->part_code);
		        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value->name);
		        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$value->order_quantity);
		        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$value->dealer_price);
		        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$value->total_price);
		        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$value->dispatch_mode);
		        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$value->order_type);
		        
		        $row++;
	        }
	        // $highestColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
	        // $objPHPExcel->getActiveSheet()->getStyle('D2:'.$highestColn.'2')->getAlignment()->setTextRotation(90);

	        header("Pragma: public");
	        header("Content-Type: application/force-download");
	        header("Content-Disposition: attachment;filename=PI_list".$data['pi_range_start'].'-'.$data['pi_range_end'].".xls");
	        header("Content-Transfer-Encoding: binary ");
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	        ob_end_clean();
	        $objWriter->save('php://output');

			// echo '<pre>';
			// print_r($row);
		}

		public function order_dispatch_detail()
		{
			$date = $this->input->get('dispatched_date');
			$date = substr($date, 0, strpos($date, '('));
			$bill_no = $this->input->get('bill_no');
			$where['dispatched_date'] = date('Y-m-d', strtotime($date));
			$where['bill_no'] = $bill_no;

			search_params();
			$this->sparepart_order_model->_table = 'view_dispatch_spareparts';
			$total_result = $this->sparepart_order_model->findAll($where);
			$total = count($total_result);

			search_params();
			paging('id');
			$rows = $this->sparepart_order_model->findAll($where);

			echo json_encode(array('total'=>$total, 'rows'=>$rows));

		}

		public function excel_dump($start_date, $end_date, $start_invoice, $end_invoice)
		{
			if($end_date && $start_invoice && $end_invoice)
			{
				$where['dispatched_date >='] = $start_date;
				$where['dispatched_date <='] = $end_date;
				$where['bill_no >='] = $start_invoice;
				$where['bill_no <='] = $end_invoice;
			}
			else if($end_date && $start_invoice)
			{
				$where['dispatched_date >='] = $start_date;
				$where['dispatched_date <='] = $end_date;
				$where['bill_no >='] = $start_invoice;
			}
			else if($end_date && $end_invoice)
			{
				$where['dispatched_date >='] = $start_date;
				$where['dispatched_date <='] = $end_date;
				$where['bill_no <='] = $end_invoice;
			}
			else if($start_invoice && $end_invoice)
			{
				$where['dispatched_date >='] = $start_date;
				$where['bill_no >='] = $start_invoice;
				$where['bill_no <='] = $end_invoice;
			}
			else if($end_date)
			{
				$where['dispatched_date >='] = $start_date;
				$where['dispatched_date <='] = $end_date;
			}
			else if($start_invoice)
			{
				$where['dispatched_date >='] = $start_date;
				$where['bill_no >='] = $start_invoice;
			}
			else if($end_invoice)
			{
				$where['dispatched_date >='] = $start_date;
				$where['bill_no <='] = $end_invoice;
			}
			else
			{
				$where['dispatched_date >='] = $start_date;
			}
			$this->sparepart_order_model->_table = 'view_dispatch_spareparts';
			$this->db->order_by('dispatched_date');
			$this->db->order_by('bill_no');
			$fields = 'bill_no, dispatched_date, dealer_name, part_code, name, dispatched_quantity, dealer_price, discount_percentage,  total_amount';
	        $rows = $this->sparepart_order_model->findAll($where,$fields);
	        $this->load->library('Excel');

	        $objPHPExcel = new PHPExcel(); 
	        $objPHPExcel->setActiveSheetIndex(0);

	        $style = array(
	        'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	        );

	        $objPHPExcel->getDefaultStyle()->applyFromArray($style);
	        $objPHPExcel->getActiveSheet()->getStyle("A1:AD1")->getFont()->setBold(true);

	       

	        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Challan No');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Challan Date');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Class Code');
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1','AgentShortName');
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1','CurrCode');
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1','CurrRate');
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1','Party Name');
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1','SN');
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1','Product Short Name');
	        $objPHPExcel->getActiveSheet()->SetCellValue('J1','Product Name');
	        $objPHPExcel->getActiveSheet()->SetCellValue('K1','GDNShortName');
	        $objPHPExcel->getActiveSheet()->SetCellValue('L1','BatchNo.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('M1','Expiry');
	        $objPHPExcel->getActiveSheet()->SetCellValue('N1','Sec. Quantity');
	        $objPHPExcel->getActiveSheet()->SetCellValue('O1','Quantity');
	        $objPHPExcel->getActiveSheet()->SetCellValue('P1','Sec. Free');
	        $objPHPExcel->getActiveSheet()->SetCellValue('Q1','Free');
	        $objPHPExcel->getActiveSheet()->SetCellValue('R1','Rate');
	        $objPHPExcel->getActiveSheet()->SetCellValue('S1','Prd.Disc.%');
	        $objPHPExcel->getActiveSheet()->SetCellValue('T1','Prd.Disc.Amt.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('U1','Amount');
	        $objPHPExcel->getActiveSheet()->SetCellValue('V1','Discount');
	        $objPHPExcel->getActiveSheet()->SetCellValue('W1','Amount');
	        $objPHPExcel->getActiveSheet()->SetCellValue('X1','VAT');
	        $objPHPExcel->getActiveSheet()->SetCellValue('Y1','Amount');
	        $objPHPExcel->getActiveSheet()->SetCellValue('Z1','Term3');
	        $objPHPExcel->getActiveSheet()->SetCellValue('AA1','Amount');
	        $objPHPExcel->getActiveSheet()->SetCellValue('AB1','Term4');
	        $objPHPExcel->getActiveSheet()->SetCellValue('AC1','Amount');
	        $objPHPExcel->getActiveSheet()->SetCellValue('AD1','Remarks');

	        $row = 2;
	        $col = 0;

	      
	        $old_bill = 0;
	        $sn = 1;
	        foreach($rows as $key => $values) 
	        {   
	        	if($old_bill != $values->bill_no){
	            	$sn = 1;
	            }else{
	            	$sn++;
	            }
	        	$bill_no = $values->bill_no;
	        	$zero = '';
	        	if(strlen($bill_no) < 4)
	        	{
	        		
	        		$len = strlen($bill_no);
	        		$add = 4 - $len;
	        		for($i=1; $i<=$add; $i++)
	        		{
	        			$zero .= '0';
	        		}
	        	}
	        	$final_bill_no = $zero.$bill_no;

	        	$individual_discount_amount = ($values->discount_percentage/100) * $values->dealer_price;
	        	$total_discount_amount = ($values->discount_percentage/100) * $values->total_amount;
	        	$amount_after_discount = $values->total_amount - $total_discount_amount;
	        	$vat = 0.13 * $amount_after_discount;
	        	$amount_after_vat = $amount_after_discount + $vat;

	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, ($old_bill != $values->bill_no)?"SSC-".$final_bill_no:'');
	            $col++;        
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, ($old_bill != $values->bill_no)?$values->dispatched_date:'');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, ($old_bill != $values->bill_no)?$values->dealer_name:'');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $sn);
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->part_code);
	            $col++;      
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->name);
	            $col++;      
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->dispatched_quantity);
	            $col++; 
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->dealer_price);
	            $col++; 
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->discount_percentage);
	            $col++;  
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $individual_discount_amount);
	            $col++;      
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->total_amount);
	            $col++; 
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $total_discount_amount);
	            $col++;  
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $amount_after_discount);
	            $col++;  
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $vat);
	            $col++;  
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $amount_after_vat);
	            $col++;  
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
	            $col++;
	            $col = 0;
	            $row++;    
	            if($old_bill != $values->bill_no){
	            	$old_bill = $values->bill_no;
	            }
	        }

	        header("Pragma: public");
	        header("Content-Type: application/force-download");
	        header("Content-Disposition: attachment;filename=Spareparts Dispatch.xls");
	        header("Content-Transfer-Encoding: binary ");
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	        ob_end_clean();
	        $objWriter->save('php://output');
		}

	public function get_dispatch_date()
	{
		$order_no = $this->input->post('order_no');
		$pi_number = $this->input->post('pi_number');
		$where = array(
				'order_no'=> $order_no,
				'pi_number'=>$pi_number,
				'dispatched_date is not NULL' => NULL,
				); 
		$fields = "dispatched_date,picklist";
		$this->sparepart_order_model->_table = 'view_spareparts_order_pickcount';
		$this->db->order_by('pick_count','desc');
		$this->db->where($where);
		$rows=$this->sparepart_order_model->find_all(array('pi_generated'=>1, 'pi_confirmed'=>1),$fields);
		if(!$rows){
			$rows = json_decode(json_encode(array('dispatched_date' => '','picklis' => 0)));
		}
		// echo '<pre>';
		// echo $this->db->last_query();
		// print_r($rows);
		// exit();
		echo json_encode($rows);
		exit;

	}

	public function get_pi_list()
	{
		$from = $this->input->post('start_date');
		$to = $this->input->post('end_date');
		$dealer_id = $this->input->post('dealer_id');

		$this->sparepart_order_model->_table = 'view_back_log_spareparts';
		$where = array(
			"pi_generated_date_time >= '".$from."'" => NULL,
			"pi_generated_date_time <= '".$to."'" => NULL,
			"dealer_id" => $dealer_id,
			"required_quantity > 0" => NULL, 
		);
		// $this->db->where('"received_quantity"-"cancle_quantity" < "order_quantity"',null,false);

		$this->db->order_by('proforma_invoice_id');
		$this->db->group_by('proforma_invoice_id,pi_number');
		$fields = 'proforma_invoice_id,pi_number';
		$order = $this->sparepart_order_model->findAll($where,$fields);
		// echo $this->db->last_query();
		echo json_encode($order);
	}

	public function generate_datewise_picklist()
	{
		// echo '<pre>';
		// print_r($this->input->post());
		$from = $this->input->post('start_date');
		$to = $this->input->post('end_date');
		$dealer_id = $this->input->post('dealer_id');
		$picker_id = $this->input->post('picker_id');
		$all = $this->input->post('all');
		$pi = $this->input->post('pi_no');

		$this->sparepart_order_model->_table = 'view_report_spareparts_backorder';
		if($all){
			$where = array(
				"pi_generated_date_time >= '".$from."'" => NULL,
				"pi_generated_date_time <= '".$to."'" => NULL,
				"dealer_id" => $dealer_id,
				'backorder > 0' => NULL,
				// '"received_quantity" < "cancle_quantity" + "order_quantity"' => NULL,
			);
		}else{
			$pi_list = implode(',', $pi);
			$where = array(
				"dealer_id" => $dealer_id,
				'backorder > 0' => NULL,
			);
			$this->db->where('proforma_invoice_id IN ('.$pi_list.')',NULL,FALSE);
		}
		// $this->db->where('"order_quantity" - COALESCE((received_quantity)::bigint, (0)::bigint) - COALESCE(cancle_quantity, 0) > 0',NULL,FALSE);
		$this->db->order_by('proforma_invoice_id');

		$order = $this->sparepart_order_model->findAll($where);
		// echo $this->db->last_query();
		// print_r($order);
		// exit;

		$picker = $this->get_picker_list($picker_id,0)[0];

		$picklist_group = $this->get_picklist_group();


		$picklist = array();
		$old_picklist_no = $this->get_picklist_no();
		$picklist_no = 'PICKLST-' . sprintf('%05d',(@$old_picklist_no->picklist_no + 1));

		$this->db->trans_begin();
		foreach ($order as $key => $value) {
			$sparepart = $this->sparepart_model->find(array('id'=>$value->sparepart_id));
			$stock = $this->get_max_stocks_detail($sparepart);
			$old_pick_count = $this->get_pick_count($value);
			// print_r($old_pick_count);exit;
			$picklist = array(
				'dealer_id' => $dealer_id,
				'order_no' => $value->order_no,
				'sparepart_id' => (isset($stock->sparepart_id)?$stock->sparepart_id:$sparepart->id),
				'dispatch_quantity' => $value->backorder,
				'order_id' => $value->id,
				'picker_name' => $picker->first_name,
				'generate_date' => date('Y-m-d'),
				'order_type' => $value->order_type,
				'pick_count' => @$old_pick_count->pick_count + 1,
				'is_billed' => 0,
				'picker_id' => $picker_id,
				'picklist_format' => $picklist_no,
				'picklist_no' => @$old_picklist_no->picklist_no + 1,
				'ordered_spareparts' => $value->sparepart_id,
				'picklist_group' => $picklist_group,
				'dispatched_date' => date('Y-m-d'),
				'dispatched_date_nep' => get_nepali_date(date('Y-m-d'),'nep'),
			);
			// echo '<pre>';
			// print_r($picklist);
			// exit;
			$this->picklist_model->insert($picklist);
		}

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	        echo 'error_occured';
		}
		else
		{
	        $this->db->trans_commit();
			$this->print_picklist_group($picklist_group);
		}

		// exit;

	}

	public function get_picklist_group()
	{
		$this->db->order_by('picklist_group','desc');
		$where = array('picklist_group IS NOT NULL' => NULL);
		$last_picklist_group = $this->picklist_model->find($where);

		$picklist_group = @$last_picklist_group->picklist_group + 1;

		return $picklist_group;
	}

	public function get_max_stocks_detail($sparepart)
	{
		$this->sparepart_stock_model->_table = "view_sparepart_real_stock";
		$this->db->order_by('stock_quantity','desc');

		$stock = $this->sparepart_stock_model->find(array("part_code = '" . $sparepart->part_code . "' OR part_code = '" . $sparepart->alternate_part_code . "' OR part_code = '" . $sparepart->latest_part_code . "'" => NULL));

		return $stock;
	}

	public function get_pick_count($value='')
	{
		// echo '<pre>';
		$where = array(
			'order_id' => $value->id,
		);
		$this->db->order_by('pick_count','desc');
		$pick_count = $this->picklist_model->find($where);
		// echo $this->db->last_query();
		// print_r($pick_count);exit;
		return $pick_count;
	}

	public function get_picklist_no($value='')
	{
		$this->db->select_max('picklist_no');
		$pick_list = $this->db->get('spareparts_picklist')->row();

		return $pick_list;
	}

	public function print_picklist_group($picklist_group)
	{
		// print_r($picklist_group);
		$where = array(
			'picklist_group' => $picklist_group,
		);

		$this->picklist_model->_table = 'view_sparepart_picklist';

		$data['picker'] = $this->picklist_model->find($where,'picker_name');
		$data['order_no'] = 'Group';

		$this->db->order_by('part_code');
		$group = 'sparepart_id, part_code, name, latest_part_code, dealer_id, dealer_name, location, picker_name, picklist_no, picklist_format, first_name, middle_name, last_name, ordered_part_code, ordered_location';
		$fields = $group . ',SUM (dispatch_quantity) AS dispatch_quantity';
		$this->db->group_by($group);
		$rows = $this->picklist_model->findAll($where, $fields);
		$data['dealer'] = $this->dealer_model->find(array('id'=>$rows[0]->dealer_id));

		$this->sparepart_stock_model->_table = "view_sparepart_real_stock";			
		foreach ($rows as $key => $value) {
			$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$value->part_code));

			$rows[$key]->stock_quantity = @$check_stock->stock_quantity;
		}
		$data['picklist_group'] = $picklist_group;

		// usort($rows, function($a, $b) {
		//     return $a->location > $b->location;
		// });

		$data['rows'] = $rows;
		$data['header'] = lang('sparepart_orders');
		$data['page'] = $this->config->item('template_admin') . "new_picklist";
		$data['module'] = 'sparepart_orders';
		$this->load->view($this->_container,$data);
	}

}
