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
 * Local_purchases
 *
 * Extends the Project_Controller class
 * 
 */

class Local_purchases extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Local Purchases');

		$this->load->model('local_purchases/local_purchase_model');
		$this->load->model('local_purchase_lists/local_purchase_list_model');
		$this->load->model('dealer_stocks/dealer_stock_model');
		$this->load->model('spareparts/sparepart_model');

		$this->lang->load('local_purchases/local_purchase');
	}

	public function index()
	{
		$this->db->group_by('part_code, name');
		$data['added_parts'] = $this->sparepart_model->findAll(array('category_id' => 7), 'part_code, name');

		// Display Page
		$data['header'] = lang('local_purchases');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'local_purchases';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$where = NULL;

		if( is_service_dealer_incharge() ) {
			$this->load->model('dealers/dealer_model');
			$dealers_of = $this->dealer_model->findAll(array('service_incharge_id' => $this->_user_id),'id');

			$dealers_list = null;
			foreach ($dealers_of as $key => $value) {
				$dealers_list[] = $value->id;
			}			
			$this->db->where_in('dealer_id', $dealers_list);
		} else if( is_service_head() || is_national_service_manager() ) {
			
		} else {
			$where['dealer_id'] = $this->dealer_id;
		}
		search_params();

		$total=$this->local_purchase_model->find_count($where);



		if( is_service_dealer_incharge() ) {
			$this->db->where_in('dealer_id', $dealers_list);
		} else if( is_service_head() || is_national_service_manager() ) {
			
		} else {
			$where['dealer_id'] = $this->dealer_id;
		}

		paging('id');
		search_params();
		$rows=$this->local_purchase_model->findAll($where);

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$formdata=$this->_get_posted_data(); //Retrive Posted Data
		$grid_data = $this->input->post('grid');


		if( ! $grid_data) {
			echo json_encode(array('msg'=>"Grid values unavailable.",'success'=>FALSE));
			exit;
		}
		
		$this->db->trans_begin();

		if(!$this->input->post('id'))
		{
			$success=$this->local_purchase_model->insert($formdata);
		}
		else
		{
			$success=$this->local_purchase_model->update($formdata['id'],$formdata);
		}

		if($success)
		{
			foreach ($grid_data as $key => $value) 
			{
				$grid['part_code'] = strtoupper($value['partcode']);
				$grid['name'] = $value['partname'];

				$check_partcode = $this->sparepart_model->find(array('part_code'=> strtoupper($value['partcode'])));
				// echo '<pre>'; print_r($check_partcode); exit;

				if($check_partcode)
				{
					$grid['id'] = $check_partcode->id;
					$grid['category_id'] = $check_partcode->category_id;
					$success1 = $this->sparepart_model->update($grid['id'],$grid);
					$purchase[$key]['sparepart_id'] = $check_partcode->id;
					unset($grid['id']);
				}
				else
				{
					// echo '<pre>'; print_r($grid); exit;
					$grid['category_id'] = 7;
					$grid['dealer_price'] = $value['price'];
					$grid['price'] = $value['selling_price'];
					$grid['is_local'] = 1;
					
					$success1 = $this->sparepart_model->insert($grid);
					$purchase[$key]['sparepart_id'] = $success1;
				}

				$purchase[$key]['local_purchase_id'] = $success;
				$purchase[$key]['price'] = $value['price'];
				$purchase[$key]['quantity'] = $value['quantity'];

				if($check_partcode)
				{

					if($check_partcode->id == ULTRA_SYNTHETIC || $check_partcode->id == SYNTHETIC || $check_partcode->id == NORMAL){
						$dealer_stock = $this->dealer_stock_model->find(array('dealer_id'=>$this->dealer_id,'sparepart_id'=>$check_partcode->id));
						if($dealer_stock)
						{	
							$up_stock['id'] = $dealer_stock->id;
							$up_stock['lube_qty'] = $dealer_stock->lube_qty + $value['quantity'];
							$this->dealer_stock_model->update($up_stock['id'],$up_stock);
						} else {
							$stock_insert['sparepart_id'] = $check_partcode->id;
							$stock_insert['lube_qty'] = $value['quantity'];
							$stock_insert['dealer_id'] = $this->dealer_id;
							$this->dealer_stock_model->insert($stock_insert);
						}
					}else{
						
						$dealer_stock = $this->dealer_stock_model->find(array('dealer_id'=>$this->dealer_id,'sparepart_id'=>$check_partcode->id));
						// if($check_partcode->id)
						if($dealer_stock)
						{	
							$up_stock['id'] = $dealer_stock->id;
							$up_stock['quantity'] = $dealer_stock->quantity + $value['quantity'];
							$this->dealer_stock_model->update($up_stock['id'],$up_stock);
						} else {
							$stock_insert['sparepart_id'] = $check_partcode->id;
							$stock_insert['quantity'] = $value['quantity'];
							$stock_insert['dealer_id'] = $this->dealer_id;
							$this->dealer_stock_model->insert($stock_insert);
						}
					}


				}
				else
				{
					$stock['sparepart_id'] = $success1;
					$stock['quantity'] = $value['quantity'];
					$stock['dealer_id'] = $this->dealer_id;
					$this->dealer_stock_model->insert($stock);
				}

			}
			// exit;

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

	private function _get_posted_data()
	{
		$formdata = $this->input->post('data');
		$data=array();
		if($this->input->post('id')) {
			$data['id'] = $formdata['id'];
		}
		$data['invoice_no'] = $formdata['invoice_no'];
		$data['challan_no'] = $formdata['challan_no'];
		$data['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
		$data['party_name'] = $formdata['party_name'];
		$data['purchased_date'] = $formdata['purchased_date'];
		$data['purchased_date_np'] = get_nepali_date($formdata['purchased_date'],'nep');
		$data['total_amount'] = $formdata['total_amount'];

		return $data;
	}

	public function get_detailed_list()
	{
		$this->local_purchase_list_model->_table = "view_spareparts_local_purchase_list";
		$purchase_id = $this->input->get('purchase_id');

		search_params();

		$total=$this->local_purchase_list_model->find_count(array('local_purchase_id'=>$purchase_id));

		paging('id');

		search_params();

		$rows = $this->local_purchase_list_model->findAll(array('local_purchase_id'=>$purchase_id));

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function testing() {

		echo "1";
		echo $this->dealer_id;
	}

	public function print_preview()
	{
		$print = 'local_purchases_print';

		$id = $this->input->get('id');

		$this->local_purchase_list_model->_table = 'view_spareparts_local_purchase_list';
		$data['rows'] = $this->local_purchase_list_model->findAll(array('local_purchase_id'=>$id));
		$data['detail'] = $this->local_purchase_model->find(array('id'=>$id));
		$data['workshop'] = $this->get_workshop_name();
		$data['header'] = 'CASH';
		// echo '<pre>';
		// print_r($data);
		// echo $this->number_to_words->convert_number(123);
		// echo '</pre>';

		$this->load->view($this->config->item('template_admin') . $print , $data);
	}

	public function find_db_Value()
	{
		$partcode = $this->input->post('part_code');
		$this->dealer_stock_model->_table = "view_spareparts_all_dealer_stock";
		$dealer_stock = $this->dealer_stock_model->find(array('upper(part_code)' => $partcode, 'dealer_id'=>$this->dealer_id));
		$success = false;
		if($dealer_stock){
			$success = true;
		}

		echo json_encode(array('success'=>$success, 'dealer_stock'=>$dealer_stock));
		// echo '<pre>'; print_r($dealer_stock); exit;

	}

	public function editInvoice()
	{
		$data['id'] = $this->input->post('id');
		$data['invoice_no'] = $this->input->post('invoice');
		// echo '<pre>'; print_r($this->input->post()); exit;
		$success=$this->local_purchase_model->update($data['id'],$data);
		if($success){
			$success = true;
		}else{
			$success = false;
		}
		echo json_encode(array('success'=>$success));
	}
}