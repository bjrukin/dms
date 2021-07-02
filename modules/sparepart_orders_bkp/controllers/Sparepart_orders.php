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
		
		//$dealer_details = $this->getSparepartDealer();
		$where = "(dealer_id = ".$this->session->userdata('employee')['dealer_id'].")";

		search_params();
		$this->db->where($where);
		$total=$this->sparepart_order_model->find_count(array('pi_generated'=>0,'order_cancel<>'=>1));

		paging('id');
		
		search_params();
		$this->db->where($where);
		$rows=$this->sparepart_order_model->findAll(array('pi_generated'=>0,'order_cancel<>'=>1));

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
	public function back_log()
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

		$group = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed";
		$fields = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed,SUM(order_quantity) as order_qty,count(*) as total_line_qty, SUM(order_quantity * dealer_price) as total_amount,COALESCE(SUM(dispatched_quantity),0) as total_dispatched_quantity, COALESCE(SUM(dispatched_quantity * dispatch_dealer_price),0) as total_dispatched_amount";

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

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function dealer_order_json()
	{
		$this->sparepart_order_model->_table = 'view_grouped_spareparts_order';
		
		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$this->session->userdata('employee')['dealer_id'].")";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}
		
		$group = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed,pi_number";
		$fields = "dealer_name,dealer_id,order_no,order_concat,order_type,order_cancel,spares_incharge_id,order_date,order_date_np,dispatch_mode,pi_status,pi_confirmed,dealer_confirmed,SUM(order_quantity) as order_qty,count(*) as total_line_qty, SUM(order_quantity * dealer_price) as total_amount,COALESCE(SUM(dispatched_quantity),0) as total_dispatched_quantity, COALESCE(SUM(dispatched_quantity * dispatch_dealer_price),0) as total_dispatched_amount,pi_number";

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

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

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

		$group = "proforma_invoice_id,dealer_name,dealer_id,order_no,order_concat,order_type,pi_number,pi_generated_date_time,remarks";
		$fields = "proforma_invoice_id,dealer_name,dealer_id,order_no,order_concat,order_type,pi_number,pi_generated_date_time,SUM(order_quantity) as order_qty,count(*) as total_line_qty, SUM(order_quantity * dealer_price) as total_amount,remarks";

		$this->sparepart_order_model->_table = 'view_spareparts_order';

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
				$imported_data[$key]['order_date_np']      = get_nepali_date(date('Y-m-d'),'nep');
				$imported_data[$key]['dispatch_mode']      = $this->input->post('dispatch_mode');
			}    
		}

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
		$order_no = $this->input->post('order_no');

		$this->user_model->_table = 'ser_workshop_users';
		$data['picker_name'] = $this->user_model->find(array('id'=>$picker_id),array('first_name','middle_name','last_name'));

		$user_id = $this->session->userdata('id');
		$data['dealer'] = $this->dealer_model->find(array('id'=>$dealer_id));

		$this->sparepart_order_model->_table = "view_spareparts_order";
		$this->db->order_by('part_code');
		$rows = $this->sparepart_order_model->findAll(array('pi_generated'=>1,'pi_confirmed'=>1,'proforma_invoice_id'=>$pi_id,'picklist <>'=>1,'dealer_id'=>$dealer_id));

		$this->db->select_max('picklist_no');
		$picklist_no = $this->db->get('spareparts_picklist')->row();

		foreach ($rows as $key => $value) 
		{
			$sparepart = $this->sparepart_model->find(array('id'=>$value->sparepart_id));
			$this->sparepart_stock_model->_table = "view_sparepart_real_stock";
			$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$sparepart->part_code,'stock_quantity >'=>0));
			if(!$check_stock)
			{
				$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$sparepart->alternate_part_code,'stock_quantity >'=>0));
			}

			if(!$check_stock)
			{
				$check_stock = $this->sparepart_stock_model->find(array('part_code'=>$sparepart->latest_part_code,'stock_quantity >'=>0));
			}

			if($check_stock)
			{
				$picklist_quantity = $this->picklist_model->find(array('sparepart_id'=>$check_stock->sparepart_id));
			}

			if($check_stock)
			{
				$picklist[$key]['order_id'] = $value->id;
				$picklist[$key]['order_no'] = $value->order_no;
				$picklist[$key]['picker_id'] = $picker_id;
				$picklist[$key]['dealer_id'] = $value->dealer_id;
				$picklist[$key]['sparepart_id'] = $check_stock->sparepart_id;
				if($value->order_quantity <= ($left_stock = $check_stock->stock_quantity-($picklist_quantity?$picklist_quantity->dispatch_quantity:0)))
					{					
						$actual_qty = $value->order_quantity;
					} 
					else
					{
						$actual_qty =  $left_stock;
					}
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

					$print_picklist[$key]['name'] = $check_stock->name;
					$print_picklist[$key]['part_code'] = $check_stock->part_code;
					$print_picklist[$key]['location'] = $check_stock->location;
					$print_picklist[$key]['quantity'] = $actual_qty;
				}
			}

			if(empty($picklist))
			{
				flashMsg('error', 'No items to generate.');     
				redirect($_SERVER['HTTP_REFERER']);
			}

			$success = $this->picklist_model->insert_many($picklist); 

			$this->sparepart_order_model->_table = "spareparts_sparepart_order";
			foreach ($picklist as  $value) 
			{
				$update_picklist['id'] = $value['order_id'];
				$update_picklist['picklist'] = 1;
				$this->sparepart_order_model->update($update_picklist['id'],$update_picklist);
			}

			$data['order_no'] = $rows[0]->order_no;
			$data['pi_number'] = $rows[0]->pi_number;
			$data['dispatch_mode'] = $rows[0]->dispatch_mode;
			$data['order_type'] = $rows[0]->order_type;
			$data['picklist_number'] = "PICKLST-".sprintf('%05d',($picklist_no->picklist_no + 1));
			$data['rows'] = $print_picklist;
			if($success)
			{
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
			$sparepart_id = $this->sparepart_model->find(array('latest_part_code'=>$value['part_code']));

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

		$this->sparepart_order_model->_table = "view_spareparts_dispatch_grn";

		$where = '1=1';
		if(is_sparepart_dealer())
		{
			$where = "(dealer_id = ".$dealer_id." AND grn_received_date IS NULL)";
		}

		if(is_sparepart_dealer_incharge())
		{
			$where = '(spares_incharge_id ='.$this->session->userdata('id').')';			
		}

		search_params();
		$total=$this->sparepart_order_model->find_count($where);

		paging('order_no');
		
		search_params();
		$rows=$this->sparepart_order_model->findAll($where);

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

		$defecit_quantity = array();

		foreach ($grid_data as $key => $value) 
		{
			if(isset($value['order_no']))
			{
				$order_no = $value['order_no'];
			}
			$bill_no = $value['bill_no'];
			if(array_key_exists('received_quantity', $value))
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

			$dealer_stock_list = $this->dealer_stock_model->findAll(array('dealer_id'=>$dealer_id));

			// print_r($dealer_stock_list);
			// exit;
			$dealer_stock_list = json_decode(json_encode($dealer_stock_list),True);

			foreach ($dealer_stock_list as $k => $v) {
				$array[] = $v['sparepart_id'];
			}

			$common_index = array_search($value['sparepart_id'], $array);

			$this->dealer_stock_model->_table ="spareparts_dealer_stock";

			if($common_index === false)
			{
				$dealer_stock['quantity'] 	  = $total_dispatched;
				$dealer_stock['sparepart_id'] = $value['sparepart_id'];
				$dealer_stock['dealer_id']    = $dealer_id;
				$this->dealer_stock_model->insert($dealer_stock);
			}
			else
			{
				$dealer_stock_update['id'] = $dealer_stock_list[$common_index]['id']; 
				$dealer_stock_update['quantity'] = $total_dispatched + $dealer_stock_list[$common_index]['quantity'];
				$this->dealer_stock_model->update($dealer_stock_update['id'],$dealer_stock_update);
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
		public function get_barcode_values()
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
		}


		public function get_recent_dispatch_list()
		{
			$bill_no = $this->input->post('bill_no');
			$this->dispatch_sparepart_model->_table = "view_spareparts_recent_dispatch_list";
			$rows = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no,'grn_received_date'=>NULL));

			echo json_encode(array('rows'=>$rows));
		}

		public function received_order_json()
		{
			$dealer_id = $this->session->userdata('employee')['dealer_id'];

			$this->sparepart_order_model->_table = "view_spareparts_dispatch_grn";

			search_params();
			$total=$this->sparepart_order_model->find_count(array('dealer_id'=>$dealer_id,'grn_received_date <>'=>NULL));

			paging('order_no');

			search_params();
			$rows=$this->sparepart_order_model->findAll(array('dealer_id'=>$dealer_id,'grn_received_date <>'=>NULL));

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


			search_params();
			$total=$this->sparepart_order_model->find_count();

			paging('bill_no');

			search_params();
			$rows=$this->sparepart_order_model->findAll();

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;	
		}

		public function get_detailed_bill()
		{
			$bill_no = $this->input->get('bill_no');

			$this->sparepart_order_model->_table = 'view_dispatch_spareparts';

			$total=$this->sparepart_order_model->find_count(array('bill_no'=>$bill_no));

			search_params();

			$rows=$this->sparepart_order_model->findAll(array('bill_no'=>$bill_no));

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;			
		}

		public function generate_gatepass($bill_no = NULL)
		{
			$print = "print/gatepass";


			$this->db->select_max('gatepass_no');
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

			$fields = "order,dealer_name,pick_count,order_no,dealer_id,picklist_no,picklist_format,billed_status,proforma_invoice_id";

			paging('order_no');

			search_params();

			$this->db->group_by($fields);
			$rows=$this->picklist_model->findAll(NULL,$fields);

			search_params();
			$total = count($rows);

			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;
		}

		public function picking_list_detail_json()
		{
			$picklist_no = $this->input->get('picklist_no');

			$this->picklist_model->_table = 'view_sparepart_picklist';

			$total=$this->picklist_model->find_count(array('picklist_no'=>$picklist_no));
			paging('order_no');

			search_params();
			$rows=$this->picklist_model->findAll(array('picklist_no'=>$picklist_no));

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
			$this->db->order_by('part_code');
			$data['rows'] = $this->picklist_model->findAll(array('dealer_id'=>$dealer_id,'order_no'=>$order_no,'pick_count'=>$pick_count));
			$data['header'] = lang('sparepart_orders');
			$data['page'] = $this->config->item('template_admin') . "new_picklist";
			$data['module'] = 'sparepart_orders';
			$this->load->view($this->_container,$data);
		}

		public function update_dispatch_quantity()
		{
			$data['id'] = $this->input->post('id');
			$order_id = $this->input->post('order_id');
			$picklist_no = $this->input->post('picklist_no');
			$data['dispatch_quantity'] = $this->input->post('dispatch_quantity');

			
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
					// print_r($data);
				$success = $this->picklist_model->update($data['id'],$data);
				$order_no = $value->order_no;
				$dealer_id = $value->dealer_id;
				$picklist_no = $data['picklist_no'];
			}
				//print_r($picklist);
			exit;
		}

		public function dispatch_spareparts_list_json()
		{
			$picklist_no = $this->input->get('picklist_no');

			$this->dispatch_list_model->_table = "view_spareparts_dispatch_list";
			$rows = $this->dispatch_list_model->findAll(array('picklist_no'=>$picklist_no,'is_billed'=>0));

			echo json_encode($rows);
		}

		public function dispatch_spareparts_json()
		{
			$dealer_id = $this->input->get('dealer_id');

			$this->dispatch_list_model->_table = "view_spareparts_dispatch_list";
			$rows = $this->dispatch_list_model->findAll(array('dealer_id'=>$dealer_id,'is_billed'=>0));

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
			$data['dealer_id'] = $this->input->post('dealer_id');
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
			$billed_date = $this->input->post('billed_date');

			$grid_data = array_map('array_filter',  $this->input->post('data'));
			$grid_data = array_filter($grid_data);

			/*$result = $this->dispatch_sparepart_model->find(NULL,'max(bill_no) as bill_no');
			$bill_no  =($result->bill_no ? ($result->bill_no + 1) : 1);*/
			$bill_no = 3930;

			$total_credit = 0;
			foreach ($grid_data as $key => $value) 
			{
				if($value['sparepart_id']){

					$stock  = $this->sparepart_stock_model->find(array('sparepart_id'=>$value['sparepart_id']),array('id','quantity'));

					$data[$key]['dispatched_quantity'] = $value['dispatch_quantity'];
					if(isset($value['order_id']))
					{
						$data[$key]['order_id'] = $value['order_id'];
					}
					if(isset($value['order_no']))
					{
						$data[$key]['order_no'] = $value['order_no'];
					}
					$data[$key]['stock_id'] = $stock->id;
					$data[$key]['dispatched_date'] = $billed_date;
					if($this->input->post('dealer_id'))
					{
						$data[$key]['dealer_id'] =  $this->input->post('dealer_id');
					}
					else
					{
						$data[$key]['dealer_id'] =  $value['dealer_id'];
					}
					$data[$key]['dispatched_date_nepali'] = get_nepali_date($billed_date,'nep');

					$data[$key]['bill_no'] =  $bill_no;
					$data[$key]['vor_percentage'] =  ($this->input->post('vor_percentage')?$this->input->post('vor_percentage'):0);
					$data[$key]['discount_percentage'] =  ($this->input->post('discount_percentage')?$this->input->post('discount_percentage'):0);
					
					// update picklist
					if(isset($value['picklist_id']))
					{
						$picked_quantity = $this->picklist_model->find(array('id'=>$value['picklist_id']),'picked_quantity');
						
						$update_picklist[$key]['id'] = $value['picklist_id'];
						$update_picklist[$key]['is_billed'] = 1;
						$update_picklist[$key]['picked_quantity'] = ($picked_quantity->picked_quantity?$picked_quantity->picked_quantity:0) + $value['dispatch_quantity'];
					}

					//update dispatch list
					$update_dispatch_list[$key]['id'] = $value['id'];
					$update_dispatch_list[$key]['is_billed'] = 1;

					// Update stock
					$update_stock[$key]['id'] = $stock->id;
					$update_stock[$key]['quantity'] = $stock->quantity - $value['dispatch_quantity'];

					// update credit
					if($this->input->post('vor_percentage'))
					{
						$price = $value['dealer_price'] + (($value['dealer_price'] * $this->input->post('vor_percentage'))/ 100 );
					}
					else
					{
						$price = $value['dealer_price'];	
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
					$dealer_credit['date_nepali'] = get_nepali_date(date('Y-m-d'),'nep');
					$dealer_credit['amount'] = $total_credit;
				}
			}

			if($data)
			{
				$success = $this->dispatch_sparepart_model->insert_many($data);
			}

			if($success)
			{
				$this->dealer_credit_model->insert($dealer_credit);
				if(isset($update_picklist))
				{
					$this->picklist_model->update_batch($update_picklist,'id');
				}
				$this->dispatch_list_model->update_batch($update_dispatch_list,'id');
				$this->sparepart_stock_model->update_batch($update_stock,'id');
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

			echo json_encode(array('msg'=>$msg,'success'=>$success,'bill_no'=>$bill_no));

		}

		public function generate_bill($bill_no = NULL)
		{
			$this->dispatch_sparepart_model->_table = "view_dispatch_spareparts";
			$rows = $this->dispatch_sparepart_model->findAll(array('bill_no'=>$bill_no));
			
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
					$final_amount = $amount - ($amount * $values->discount_percentage / 100);

					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $final_amount  );
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
				header("Content-Disposition: attachment;filename=Bill.xls");
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
			$dealer_order = $this->sparepart_order_model->find(array('proforma_invoice_id'=>$proforma_invoice_id));

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
				$picklist_no = $this->input->post('picklist_no');
				$picklist_detail = $this->picklist_model->find(array('picklist_no'=>$picklist_no));

				$picklist['order_id'] = $success;
				$picklist['dealer_id'] = $picklist_detail->dealer_id;
				$picklist['order_no'] = $picklist_detail->order_no;
				$picklist['order_type'] = $picklist_detail->order_type;
				$picklist['pick_count'] = $picklist_detail->pick_count;
				$picklist['is_billed'] = $picklist_detail->is_billed;
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

	}
