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
 * Customers
 *
 * Extends the Project_Controller class
 * 
 */

class Customers extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Customers');

		$this->lang->load('customers/customer');
		$this->load->library('customers/customer');

		$this->load->model('vehicle_processes/Vehicle_process_model');
		$this->load->model('booking_cancels/booking_cancel_model');
		$this->load->model('foc_documents/foc_document_model');
		$this->load->model('foc_accessories/foc_accessory_model');
		$this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');
		$this->load->model('dealers/dealer_model');
		$this->load->model('partial_payments/partial_payment_model');
		$this->load->model('foc_requests/foc_request_model');
		$this->load->model('discount_schemes/discount_scheme_model');
		$this->load->model('dispatch_dealers/dispatch_dealer_model');
		$this->load->model('dispatch_records/dispatch_record_model');
		$this->load->model('ccd_sixtydays/ccd_sixtyday_model');
		$this->load->model('ccd_thirtydays/ccd_thirtyday_model');
		$this->load->model('ccd_threedays/ccd_threeday_model');
		$this->load->model('crm_vehicle_edits/crm_vehicle_edit_model');
	}

	public function index()
	{
		//check fiscal year is set or not
		//if not set then redirect to FISCAL YEAR PAGE
		list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
		if ($fiscal_year_id == null) {
			flashMsg('warning', 'Current Fiscal Year is not recorded yet. Please save the FISCAL YEAR.');
			redirect('admin/fiscal_years');
		}

		// Display Page
		$data['header'] = lang('customers');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'customers';
		$this->load->view($this->_container,$data);
	}


	public function json()
	{
		
		// ACCESS LEVEL CHECK STARTS
		$is_showroom_incharge = NULL;
		$is_sales_executive = NULL;

		$dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
		
		if (empty($dealer_list)) {
			$is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
			$is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
		}
		
		if(!empty($dealer_list)) {
			$this->db->where_in('dealer_id', $dealer_list);
		} elseif ($is_showroom_incharge) {
			$this->db->where('dealer_id', $this->session->userdata('employee')['dealer_id']);
		} elseif ($is_sales_executive) {
			$this->db->where('executive_id', $this->session->userdata('employee')['employee_id']);
		}

		search_params();
		$total=$this->customer->get_customers_count();
		
		paging('id');

		if(!empty($dealer_list)) {
			$this->db->where_in('dealer_id', $dealer_list);
		} elseif ($is_showroom_incharge) {
			$this->db->where('dealer_id', $this->session->userdata('employee')['dealer_id']);
		} elseif ($is_sales_executive) {
			$this->db->where('executive_id', $this->session->userdata('employee')['employee_id']);
		}
		
		search_params();
		
		$rows = $this->customer->get_customers();

		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		$data = $this->_get_posted_data();
		list($msg, $success) = $result = $this->customer->save_customer($data);
		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;
	}

	private function _get_posted_data()
	{
		$data=array();
		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
			$customer_name = $this->customer_model->find(array('id'=>$data['id']),array('first_name','middle_name','last_name'));
			if($customer_name->first_name != strtoupper($this->input->post('first_name')) || $customer_name->middle_name != strtoupper($this->input->post('middle_name')) || $customer_name->last_name != strtoupper($this->input->post('last_name')))
			{
				$edit['created_by'] = $this->session->userdata('id');
				$edit['created_at'] = date('Y-m-d H:i:s');
				$edit['customer_id'] = $this->input->post('id');
				$edit['old_name'] = ($customer_name->first_name.' '.$customer_name->middle_name.' '.$customer_name->last_name);
				$edit['new_name'] = (strtoupper($this->input->post('first_name')).' '.strtoupper($this->input->post('middle_name')).' '.strtoupper($this->input->post('last_name')));

				$this->db->insert('inquiry_name_edit',$edit);
			}
			$vehicle_details = $this->customer_model->find(array('id'=>$data['id']),array('vehicle_id','variant_id','color_id'));

			if($this->input->post('vehicle_id') != $vehicle_details->vehicle_id || $this->input->post('variant_id') != $vehicle_details->variant_id || $this->input->post('color_id') != $vehicle_details->color_id)
			{
				$vehicle_edit['customer_id'] = $this->input->post('id');
				$vehicle_edit['prev_vehicle'] = $vehicle_details->vehicle_id;
				$vehicle_edit['prev_variant'] = $vehicle_details->variant_id;
				$vehicle_edit['prev_color'] = $vehicle_details->color_id;
				$vehicle_edit['new_vehicle'] = $this->input->post('vehicle_id');
				$vehicle_edit['new_variant'] = $this->input->post('variant_id');
				$vehicle_edit['new_color'] = $this->input->post('color_id');
				$vehicle_edit['date'] = date('Y-m-d');
				$vehicle_edit['date_np'] = get_nepali_date(date('Y-m-d'),'nep');
				$this->crm_vehicle_edit_model->insert($vehicle_edit);
			}
		}
		$data['inquiry_no']             = ($this->input->post('inquiry_no')) ? $this->input->post('inquiry_no'): NULL;
		$data['fiscal_year_id']         = ($this->input->post('fiscal_year_id')) ? $this->input->post('fiscal_year_id'): NULL;
		// $data['inquiry_date_en']        = ($this->input->post('inquiry_date_en')) ? $this->input->post('inquiry_date_en'): NULL;
		// $data['inquiry_date_np']        = ($this->input->post('inquiry_date_np')) ? $this->input->post('inquiry_date_np'): NULL;
		if($this->input->post('inquiry_date_en'))
		{
			$data['inquiry_date_en']        = $this->input->post('inquiry_date_en');
		}
		else
		{
			$data['inquiry_date_en']        = date('Y-m-d');
		}
		if($this->input->post('inquiry_date_np'))
		{
			$data['inquiry_date_np']        = $this->input->post('inquiry_date_np');
		}
		else
		{
			$data['inquiry_date_np']        = get_nepali_date(date('Y-m-d'),'nepali');
		}
		$data['customer_type_id']       = ($this->input->post('customer_type_id')) ? $this->input->post('customer_type_id'): NULL;
		$data['first_name']             = ($this->input->post('first_name')) ? strtoupper($this->input->post('first_name')): NULL;
		$data['middle_name']            = ($this->input->post('middle_name')) ? strtoupper($this->input->post('middle_name')): NULL;
		$data['last_name']              = ($this->input->post('last_name')) ? strtoupper($this->input->post('last_name')): NULL;
		$data['gender']                 = ($this->input->post('gender')) ? $this->input->post('gender'): 'Not Specified';
		$data['marital_status']         = ($this->input->post('marital_status')) ? $this->input->post('marital_status'): 'Not Specified';
		$data['family_size']            = ($this->input->post('family_size')) ? $this->input->post('family_size'): 'Not Specified';
		$data['dob_en']                 = ($this->input->post('dob_en')) ? $this->input->post('dob_en'): NULL;
		$data['dob_np']                 = ($this->input->post('dob_np')) ? $this->input->post('dob_np'): NULL;
		$data['anniversary_en']         = ($this->input->post('anniversary_en')) ? $this->input->post('anniversary_en'): NULL;
		$data['anniversary_np']         = ($this->input->post('anniversary_np')) ? $this->input->post('anniversary_np'): NULL;
		$data['district_id']            = ($this->input->post('district_id')) ? $this->input->post('district_id'): NULL;
		$data['mun_vdc_id']             = ($this->input->post('mun_vdc_id')) ? $this->input->post('mun_vdc_id'): NULL;
		$data['address_1']              = ($this->input->post('address_1')) ? $this->input->post('address_1'): NULL;
		$data['address_2']              = ($this->input->post('address_2')) ? $this->input->post('address_2'): NULL;
		$data['email']                  = ($this->input->post('email')) ? $this->input->post('email'): NULL;
		$data['home_1']                 = ($this->input->post('home_1')) ? $this->input->post('home_1'): NULL;
		$data['home_2']                 = ($this->input->post('home_2')) ? $this->input->post('home_2'): NULL;
		$data['work_1']                 = ($this->input->post('work_1')) ? $this->input->post('work_1'): NULL;
		$data['work_2']                 = ($this->input->post('work_2')) ? $this->input->post('work_2'): NULL;
		$data['mobile_1']               = ($this->input->post('mobile_1')) ? $this->input->post('mobile_1'): NULL;
		$data['mobile_2']               = ($this->input->post('mobile_2')) ? $this->input->post('mobile_2'): NULL;
		$data['pref_communication']     = ($this->input->post('pref_communication')) ? $this->input->post('pref_communication'): NULL;
		$data['occupation_id']          = ($this->input->post('occupation_id')) ? $this->input->post('occupation_id'): NULL;
		$data['education_id']           = ($this->input->post('education_id')) ? $this->input->post('education_id'): NULL;
		if($this->input->post('dealer_id'))
		{
			$data['dealer_id'] = $this->input->post('dealer_id');
		}
		else if(is_sales_executive())
		{
			$data['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
		}
		if($this->input->post('executive_id'))
		{
			$data['executive_id'] = $this->input->post('executive_id');
		}
		else if(is_sales_executive())
		{
			$data['executive_id'] = $this->session->userdata('employee')['employee_id'];
		}
		// $data['dealer_id']              = ($this->input->post('dealer_id')) ? $this->input->post('dealer_id'): NULL;
		// $data['executive_id']           = ($this->input->post('executive_id')) ? $this->input->post('executive_id'): NULL;
		$data['payment_mode_id']        = ($this->input->post('payment_mode_id')) ? $this->input->post('payment_mode_id'): NULL;
		$data['source_id']              = ($this->input->post('source_id')) ? $this->input->post('source_id'): NULL;
		$data['status_id']              = ($this->input->post('status_id')) ? $this->input->post('status_id'): NULL;
		$data['inquiry_kind']           = ($this->input->post('inquiry_kind')) ? $this->input->post('inquiry_kind'): NULL;
		$data['contact_1_name']         = ($this->input->post('contact_1_name')) ? $this->input->post('contact_1_name'): NULL;
		$data['contact_1_mobile']       = ($this->input->post('contact_1_mobile')) ? $this->input->post('contact_1_mobile'): NULL;
		$data['contact_1_relation_id']  = ($this->input->post('contact_1_relation_id')) ? $this->input->post('contact_1_relation_id'): NULL;
		$data['contact_2_name']         = ($this->input->post('contact_2_name')) ? $this->input->post('contact_2_name'): NULL;
		$data['contact_2_mobile']       = ($this->input->post('contact_2_mobile')) ? $this->input->post('contact_2_mobile'): NULL;
		$data['contact_2_relation_id']  = ($this->input->post('contact_2_relation_id')) ? $this->input->post('contact_2_relation_id'): NULL;
		$data['remarks']                = ($this->input->post('remarks')) ? $this->input->post('remarks'): NULL;
		$data['vehicle_id']             = ($this->input->post('vehicle_id')) ? $this->input->post('vehicle_id'): NULL;
		$data['variant_id']             = ($this->input->post('variant_id')) ? $this->input->post('variant_id'): NULL;
		$data['color_id']               = ($this->input->post('color_id')) ? $this->input->post('color_id'): NULL;
		$data['vehicle_make_year']      = ($this->input->post('vehicle_make_year')) ? $this->input->post('vehicle_make_year'): NULL;
		$data['walkin_source_id']       = ($this->input->post('walkin_source_id')) ? $this->input->post('walkin_source_id'): 0;
		$data['event_id']               = ($this->input->post('event_id')) ? $this->input->post('event_id'): 0;
		$data['institution_id']         = ($this->input->post('institution_id')) ? $this->input->post('institution_id'): NULL;
		$data['exchange_car_make']      = ($this->input->post('exchange_car_make')) ? $this->input->post('exchange_car_make'): NULL;
		$data['exchange_car_model']     = ($this->input->post('exchange_car_model')) ? $this->input->post('exchange_car_model'): NULL;
		$data['exchange_car_year']      = ($this->input->post('exchange_car_year')) ? $this->input->post('exchange_car_year'): NULL;
		$data['exchange_car_kms']       = ($this->input->post('exchange_car_kms')) ? $this->input->post('exchange_car_kms'): NULL;
		$data['exchange_car_value']     = ($this->input->post('exchange_car_value')) ? $this->input->post('exchange_car_value'): 0;
		$data['exchange_car_bonus']     = ($this->input->post('exchange_car_bonus')) ? $this->input->post('exchange_car_bonus'): 0;
		$data['exchange_total_offer']   = $data['exchange_car_value'] + $data['exchange_car_bonus'];
		
		$data['bank_id']                = ($this->input->post('bank_id')) ? $this->input->post('bank_id'): NULL;
		$data['bank_branch']            = ($this->input->post('bank_branch')) ? $this->input->post('bank_branch'): NULL;
		$data['bank_staff']             = ($this->input->post('bank_staff')) ? $this->input->post('bank_staff'): NULL;
		$data['bank_contact']           = ($this->input->post('bank_contact')) ? $this->input->post('bank_contact'): NULL;

		return $data;
	}

	// get customer detail
	public function detail($id=null)
	{
		control('Customer Detail');

		if ($id==null) 
		{
			flashMsg('error', 'Invalid customer ID');
			redirect('admin/customers');  
		}

		$customer_info = $this->customer->get_customer($id);

		if ($customer_info == null) 
		{
			flashMsg('error', 'Invalid customer ID');
			redirect('admin/customers');            
		}

		$data['customer_info'] = $customer_info;

		/*if($data['customer_info']->dealer_id == 75 && $data['customer_info']->vehicle_id == 1 && $data['customer_info']->variant_id == 10)
		{
			$data['customer_info']->price = '1499000';
		}*/

		// Display Page
		$data['header'] = lang('customers');
		$data['page'] = $this->config->item('template_admin') . "details";
		$data['module'] = 'customers';

		$this->load->view($this->_container,$data);
	}

	//customer statuses json
	public function customer_statuses_json()
	{
		if($this->input->get('customer_id'))
		{
			$customer_id = $this->input->get('customer_id');
		}

		list($total, $rows) = $this->customer->get_customer_statuses($customer_id);
		echo json_encode(array('total'=>$total,'rows'=> $rows));
		exit;
	}

	//customer followups json
	public function customer_followups_json()
	{
		if($this->input->get('customer_id'))
		{
			$customer_id = $this->input->get('customer_id');
		}

		list($total, $rows) = $this->customer->get_customer_followups($customer_id);
		echo json_encode(array('total'=>$total,'rows'=> $rows));
		exit;
	}

	//customer test drives json
	public function customer_test_drives_json()
	{
		if($this->input->get('customer_id'))
		{
			$customer_id = $this->input->get('customer_id');
		}

		list($total, $rows) = $this->customer->get_customer_test_drives($customer_id);
		echo json_encode(array('total'=>$total,'rows'=> $rows));
		exit;
	}

	//save customer followups
	public function save_customer_followup()
	{
		$result = $this->customer->save_customer_followup($this->input->post());

		if($result)
		{
			$success = TRUE;
			$msg=lang('success_message');
		} 
		else
		{
			$success = FALSE;
			$msg=lang('failure_message');
		}
		
		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;
	}

	//save customer test drive
	public function save_customer_test_drive()
	{
		list($msg, $success) = $result = $this->customer->save_customer_test_drive($this->input->post());
		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;
	}

	public function cancellation_report()
	{
		$data['header'] = lang('customers');
		$data['page'] = $this->config->item('template_admin') . "cancellation_report";
		$data['module'] = 'customers';
		$this->load->view($this->_container,$data);
	}

	public function cancellation_report_json()
	{
        $this->customer_model->_table = 'view_customer_cancellation_report';
        search_params();

        $total=$this->customer_model->find_count();

        paging('customer_name','asc');

        search_params();

        $fields = 'customer_name,username,status_date,dealer_name,notes';
        $this->db->group_by('customer_name,username,status_date,dealer_name,notes');
        $rows=$this->customer_model->findAll(null,$fields);
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;

	}

	public function save_customer_status() 
	{
		list($msg, $success) = $result = $this->customer->save_customer_status($this->input->post());
		echo json_encode(array('msg'=>$msg,'success'=>$success));
		exit;
	}

	//customer test drives json
	public function quotation_json()
	{
		if($this->input->get('customer_id'))
		{
			$customer_id = $this->input->get('customer_id');
		}

		list($total, $rows) = $this->customer->get_quotations($customer_id);
		echo json_encode(array('total'=>$total,'rows'=> $rows));
		exit;
	}

	public function quotation($quotation_id = null)
	{
		if ($quotation_id == null) 
		{
			show_404();
		}

		$this->load->library('number_to_words');

		$data = $this->customer->get_quotation($quotation_id);
		
		$data['in_words'] = $this->number_to_words->number_to_words_nepali_format($data['quote_price']);
		$data['quote_price'] = $this->number_to_words->nepali_number_format($data['quote_price']);

		if($data['customer_discount_amount'])
		{
			$data['discount'] = $data['customer_discount_amount'];
		}
		else
		{
			$data['discount'] = $data['staff_limit'];
		}
		$data['dis_inword'] = $this->number_to_words->number_to_words_nepali_format($data['discount']);

		if(is_showroom_incharge() || is_sales_executive())
		{			
			$data['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
			$this->dealer_model->_table = "view_dealers";
			$dealer = $this->dealer_model->find(array('id'=>$data['dealer_id']));
		}
		else
		{
			$dealer = NULL;
		}

		if(isset($dealer))
		{
			if($data['dealer_id'] != 1 && $data['dealer_id'] != 2 && $data['dealer_id'] != 62 && $data['dealer_id'] !=75)
			{
				$data['firm_name'] = $dealer->name;
			}

		}
		// print_r($data);
		// exit;

		$data['page'] = $this->config->item('template_admin') . "quotation";
		$data['module'] = 'customers';

		$this->load->view($data['page'], $data);
	}

	public function booking_cancel()
	{
		$data['id'] = $this->input->post('customer_id');    
		$data['is_booked'] = 2;
		$data['booking_canceled'] = 1;
		$check = $this->customer_model->update($data['id'],$data);
		if($check == true)
		{
			$value['vehicle_process_id'] = $this->input->post('vehicle_process_id');
			$value['reason'] = $this->input->post('reason');
			$success = $this->booking_cancel_model->insert($value);

		}

		echo json_encode(array('success'=>$success));
	}

	public function vehicle_process($id=null)
	{

// control('Customer Detail');
		if ($id==null) 
		{
			flashMsg('error', 'Invalid customer ID');
			redirect('admin/customers');  
		}

		$process_detail = $this->customer->get_customer_vehicle_process($id);

		if ($process_detail == null) 
		{
			flashMsg('error', 'Invalid customer ID');
			redirect('admin/customers');            
		}

		$data['process_detail'] = $process_detail;
	    // $data['foc_details'] = $this->customer->get_foc_details($id);
		$data['partial_payment'] = $this->partial_payment_model->findAll(array('customer_id'=>$id));
		
		$this->foc_document_model->_table = "view_foc_details";
		$details = $this->foc_document_model->get_by(array('customer_id'=>$id));
		$data['error_msg'] = FALSE;
		$accessories_name = array();
		if(!empty($details->foc_approved_part))
		{
			$accessories = $details->foc_approved_part;
			$accessories_array = explode(',', $accessories);
			foreach ($accessories_array as $value) 
			{
				$accessories_name[] = $this->foc_accessoreis_partcode_model->find(array('id'=>$value),'name');
			}
			$data['foc_details'] = $details;
			$data['accessories'] = $accessories_name;
		}
		else
		{
			$data['error_msg'] = "FOC Document Not Provided.";
		}    
	    // Display Page
		$data['header'] = lang('customers');
		$data['page'] = $this->config->item('template_admin') . "vehicle_process";
		$data['module'] = 'customers';

		$this->load->view($this->_container,$data);
	}

	public function get_stock_json()
	{
		$vehicle_id = $this->input->get('veh_id');
		$variant_id = $this->input->get('var_id');
		$color_id = $this->input->get('color_id');

		$dealer_id = $this->session->userdata('employee')['dealer_id'];

		$stock_records = $this->customer->get_stock_records($dealer_id,$vehicle_id,$variant_id,$color_id);
		echo json_encode($stock_records);
	}

	public function generate_deliverysheet()
	{

		$this->load->model('stock_records/stock_record_model');
		$data['id'] = $this->input->post('vehicle_process_id');
		$data['msil_dispatch_id'] = $this->input->post('msil_dispatch_id');
		$data['vehicle_delivery_date'] = date('Y-m-d');
		$data['vehicle_delivery_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
		$customer_id = $this->input->post('customer_id');
		$success = $this->Vehicle_process_model->update($data['id'],$data);
		if($success == true)
		{
			list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
			
			$value['id'] = $this->input->post('stock_id');
			$value['dispatched_date'] = date('Y-m-d');
			$value['dispatched_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
			$np_dates = explode('-', $value['dispatched_date_np']);
			//$value['dispatched_date_np_month'] = $np_dates[1];
			$value['retail_fiscal_year'] = $fiscal_year;
			$value['dispatched_date_np_month'] = ltrim($np_dates[1], '0');
			$value['dispatched_date_np_year'] = $np_dates[0];
			$success1 = $this->stock_record_model->update($value['id'],$value);

			$vehicle_detail = $this->stock_record_model->find(array('id'=>$value['id']));
			$this->change_current_location($vehicle_detail->vehicle_id,'customer','retail');

			$dispatch_id = $this->dispatch_dealer_model->find(array('vehicle_id'=>$data['msil_dispatch_id']),'id');

			$dealer_id = $this->session->userdata('employee')['dealer_id'];
			
			if($dealer_id)
			{
				if($dealer_id == '1' || $dealer_id == '2' || $dealer_id == '77' || $dealer_id == '75')
				{
					$billing['id'] = $dispatch_id->id;
					$billing['dispatched_date'] = date('Y-m-d');
					$billing['dispatched_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
					$dates_np = explode('-', $billing['dispatched_date_np']);
					$billing['dispatched_date_np_month'] = ltrim($dates_np[1], '0');
					$billing['edit_month_np'] = ltrim($dates_np[1], '0');
					$billing['dispatched_date_np_year'] = $dates_np[0];

					$this->dispatch_dealer_model->update($billing['id'],$billing);
				}
			}
		}

		if($success1== true)
		{
			$customerStatusData['customer_id']  	= $customer_id; 
			$customerStatusData['status_id']   		= 15; 
			$customerStatusData['sub_status_id']   	= 21; 
			$customerStatusData['duration']    		= 0;
			$customerStatusData['notes']       		= 'Vehicle Retailed'; 

		// calculate duration between status change
			$this->db->where('customer_id', $customer_id);
			$this->db->order_by('created_at','desc');

			$oldStatusResult = $this->customer_status_model->findAll();

			if ($oldStatusResult) {
				$date1 = date_create($oldStatusResult[0]->created_at);
				$date2 = date_create(date('Y-m-d H:i:s'));

				$diff = date_diff($date1, $date2);
				$customerStatusData['duration'] = $diff->format("%a");
			}

			$this->customer_status_model->insert($customerStatusData);

			$ccd['customer_id'] = $customer_id;
			$this->ccd_threeday_model->insert($ccd);
			$this->ccd_thirtyday_model->insert($ccd);
			$this->ccd_sixtyday_model->insert($ccd);

			$this->generate_document($customer_id,'no use',5);
		}

	}

	public function generate_credit_note()
	{
		$customer_id = $this->input->post('customer_id');
		$loan_amount = $this->input->post('loan_amount');
		$this->generate_document($customer_id,$loan_amount,2);
	}

	public function generate_document($customer_id=NULL,$loan_amount=NULL,$type_doc=NULL)
	{
		
		$this->load->library('number_to_words');

		if($this->input->get('id'))
		{
			$id = $this->input->get('id');        
		}
		else
		{
			$id = $customer_id;
		}
		$doc_type = $this->input->get('doc_type');
		$data['info'] = $this->customer->get_customer_vehicle_process($id);

		if(is_showroom_incharge() || is_sales_executive())
		{			
			$dealer_id = $this->session->userdata('employee')['dealer_id'];
			$this->dealer_model->_table = "view_dealers";
			$dealer = $this->dealer_model->find(array('id'=>$dealer_id)); 
		}
		else
		{
			$dealer = NULL;
		}

		$number = ($data['info']->customer_discount_amount)?$data['info']->customer_discount_amount:$data['info']->normal_discount;
		if(@$dealer_id == 75)
		{
			if($data['info']->vehicle_id == 1 && $data['info']->variant_id == 8)
			{
				if($data['info']->customer_discount_amount)
				{
					$data['actual_price'] = $data['info']->price - $data['info']->customer_discount_amount;
				}
				else
				{
					$data['actual_price'] = $data['info']->price;
				}
			}
			else
			{
				$data['actual_price'] = $data['info']->price;

			}
		}
		else
		{
			$data['actual_price'] = $data['info']->price - $number;
		}
		
		$price = $data['info']->price;
		$data['discount_amount'] = $this->number_to_words->number_to_words_nepali_format($number);
		$data['price_word'] = $this->number_to_words->number_to_words_nepali_format($price);
		$data['booking_word'] = $this->number_to_words->number_to_words_nepali_format($data['info']->booking_amount);
		$data['acutal_price_words'] = $this->number_to_words->number_to_words_nepali_format($data['actual_price']);
		$data['loan_amount']= $loan_amount;

		if(isset($dealer))
		{
			if($dealer->id != 1 && $dealer->id != 2 && $dealer->id != 62 && $dealer_id !=75)
			{				
				$data['info']->firm = $dealer->name;
			}
		}
		if($doc_type == 1)
		{
			$data['page'] = $this->config->item('template_admin') . "vehicle_detail";  

		}
		elseif($type_doc == 2)
		{
			$data['page'] = $this->config->item('template_admin') . "credit_note";  

		}
		elseif($doc_type == 3)
		{
			$data['page'] = $this->config->item('template_admin') . "vat_bill";  

		}
		elseif($doc_type == 4)
		{
			if(!$data['info']->booking_amount)
			{
				flashMsg('error', 'Booking Amount Missing.');     
				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$data['page'] = $this->config->item('template_admin') . "order_confirmation"; 				
			}
		}

		else
		{
			$data['page'] = $this->config->item('template_admin') . "delivery_sheet";  

		}
		$data['module'] = 'customers';
		$this->load->view($data['page'], $data);

	}

	public function fileupload()
	{
		$customer_id = $this->input->post('customer_id');
		$success = $this->customer->jqxupload($customer_id);   
	}

	public function upload_delete(){
//get filename
		$filename = $this->input->post('filename');
		@unlink($this->uploadPath . '/' . $filename);
		@unlink($this->uploadthumbpath . '/' . $filename);
	}

	public function remove_image($id = NULL,$image_index = NULL,$customer_id = NULL,$image_name = NULL)
	{	
		$data['id'] = $id;
		$data[$image_index] = NULL;
		$this->Vehicle_process_model->update($data['id'],$data);
		$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/customer/'.$customer_id.'/'.$image_name;
		$msg = unlink($path);
		flashMsg('success', 'Successfully Deleted Image.');     
		redirect($_SERVER['HTTP_REFERER']);

	}

	public function save_receipt()
	{
		$receipt_type = $this->input->post('receipt_type');

		if ($receipt_type == 1)
		{
			$data['id'] = $this->input->post('vehicle_process_id');
			$data['booking_receipt_no'] = $this->input->post('receipt_no');            
			$data['booking_amount'] = $this->input->post('amount');            
			$data['booking_receipt_image'] = $this->input->post('image_name');
		}
		elseif ($receipt_type == 2)
		{
			$data['vehicle_process_id'] = $this->input->post('vehicle_process_id');            
			$data['customer_id'] = $this->input->post('customer_id');            
			$data['receipt_no'] = $this->input->post('receipt_no');            
			$data['amount'] = $this->input->post('amount');            
			$data['receipt_image'] = $this->input->post('image_name');            
			$data['payment_date']  = date('Y-m-d');
			$data['payment_date_nep']  = get_nepali_date(date('Y-m-d'),'nepali');
		}
		else
		{
			$data['id'] = $this->input->post('vehicle_process_id');
			$data['fullpayment_receipt_no'] = $this->input->post('receipt_no');            
			$data['fullpayment_amount'] = $this->input->post('amount');            
			$data['fullpayment_receipt_image'] = $this->input->post('image_name');            
			$data['fullpayment_date']  = date('Y-m-d');		

		}

		$success = $this->customer->save_receipt($data , $receipt_type);
		echo json_encode($success);
	}

	public function save_document()
	{
		$document_type = $this->input->post('document_type');
		$data['id'] = $this->input->post('vehicle_process_id');
		if($document_type == 'do')
		{
			$data['do_image'] = $this->input->post('image_name');
			$data['do_received_date'] = date('Y-m-d');
		}
		if($document_type == 'bluebook')
		{
			$data['bluebook_image'] = $this->input->post('image_name');
			$data['bluebook_received_date'] = date('Y-m-d');
		}
		if($document_type == 'insurance')
		{
			$data['insurance_image'] = $this->input->post('image_name');
			$data['insurance_received_date'] = date('Y-m-d');
		}
		if($document_type == 'creditnote')
		{
			$data['creditnote_image'] = $this->input->post('image_name');
		}
		if($document_type == 'delivery_sheet')
		{
			$data['deliverysheet_image'] = $this->input->post('image_name');
		}
		if($document_type == 'vatbill')
		{
			$data['vat_bill_image'] = $this->input->post('image_name');
		}

		$success = $this->customer->save_document($data);
		echo json_encode($success);
	}

	public function discount_json()
	{
		if($this->input->get('customer_id'))
		{
			$customer_id = $this->input->get('customer_id');
		}

		list($total, $rows) = $this->customer->get_discounts($customer_id);
		echo json_encode(array('total'=>$total,'rows'=> $rows));
		exit;
	}

	public function save_foc_doc()
	{
		$success = $this->customer->save_foc_details($this->input->post());
		echo json_encode($success);
		exit;
	}

	public function foc_document($id = NULL)
	{

		$this->foc_document_model->_table = "view_foc_details";
		$details = $this->foc_document_model->find(array('customer_id'=>$id));

		$accessories_name = array();
		$accessories = $details->foc_approved_part;
		$accessories_array = explode(',', $accessories);
		foreach ($accessories_array as $value) 
		{
			$accessories_name[] = $this->foc_accessoreis_partcode_model->find(array('id'=>$value),'name');
		}
		if(is_showroom_incharge() || is_sales_executive())
		{			
			$dealer_id = $this->session->userdata('employee')['dealer_id'];
			$this->dealer_model->_table = "view_dealers";
			$dealer = $this->dealer_model->find(array('id'=>$dealer_id));

		}
		else
		{
			$dealer = NULL;
		}

		if(isset($dealer))
		{
			if($dealer->id != 1 && $dealer->id != 2 && $dealer->id != 62 && $dealer->id != 75)
			{				
				$details->firm_name = $dealer->name;
			}
		}

		$data['rows'] = $details;
		$data['accessories'] = $accessories_name;
		$data['page'] = $this->config->item('template_admin') . "foc_document";
		$data['module'] = 'customers';
		$this->load->view($data['page'], $data);
	}

	public function send_foc_request()
	{
		$data['foc_request_part'] = $this->input->post("part_codes");
		$data['customer_id'] = $this->input->post("customer_id");
		$data['request_date'] = date('Y-m-d');
		$data['request_date_nep'] = get_nepali_date(date('Y-m-d'),'nep'); 
		$success = $this->foc_request_model->insert($data);
		if($success)
		{
			echo json_encode(array('success'=>TRUE));
		}
	}

	public function save_name_transfer()
	{
		$foc['customer_id'] = $this->input->post('customer_id');
		if($this->input->post('name_transfer') == 'true')
		{
			$foc['name_transfer'] = 1;        
		}
		else
		{
			$foc['name_transfer'] = 0;        
		}
		if($this->input->post('road_tax_amount'))
			$foc['road_tax'] = $this->input->post('road_tax_amount');

		$checker = $this->foc_document_model->find(array('customer_id'=>$foc['customer_id']));
		if(!empty($checker))
		{
			$foc['id'] = $checker->id;
			$this->foc_document_model->update($foc['id'],$foc);
		}
		else
		{
			$this->foc_document_model->insert($foc);
		}
	}

	public function delete_deliverysheet($customer_id = NULL, $vehicle_process_id = NULL, $msil_dispatch_id = NULL)
	{
		$vehicle_process['id'] = $vehicle_process_id;
		$vehicle_process['vehicle_delivery_date'] = NULL;	
		$vehicle_process['msil_dispatch_id'] = NULL;
		$this->Vehicle_process_model->update($vehicle_process['id'],$vehicle_process);

		$vehicle_detail = $this->stock_record_model->find(array('vehicle_id'=>$msil_dispatch_id));
		$stock_records['id'] = $vehicle_detail->id;
		$stock_records['dispatched_date'] = NULL;
		$stock_records['dispatched_date_np'] = NULL;
		$stock_records['dispatched_date_np_year'] = NULL;
		$stock_records['dispatched_date_np_month'] = NULL;
		$this->stock_record_model->update($stock_records['id'],$stock_records);

		$dispatch_dealer = $this->dispatch_dealer_model->find(array('vehicle_id'=>$msil_dispatch_id));
		$dealer = $this->dealer_model->find(array('id'=>$dispatch_dealer->dealer_id));
		$msil_dispatch['id'] = $msil_dispatch_id;
		$msil_dispatch['current_status'] = "Bill";
		$msil_dispatch['current_location'] = $dealer->name;

		$success = $this->dispatch_record_model->update($msil_dispatch['id'],$msil_dispatch);
		if($success)
		{
			$customerStatusData['customer_id']  	= $customer_id; 
			$customerStatusData['status_id']   		= 3; 
			$customerStatusData['sub_status_id']   	= 4; 
			$customerStatusData['duration']    		= 0;
			$customerStatusData['notes']       		= 'Deliverysheet Canceled'; 

		// calculate duration between status change
			$this->db->where('customer_id', $customer_id);
			$this->db->order_by('created_at','desc');

			$oldStatusResult = $this->customer_status_model->findAll();

			if ($oldStatusResult) {
				$date1 = date_create($oldStatusResult[0]->created_at);
				$date2 = date_create(date('Y-m-d H:i:s'));

				$diff = date_diff($date1, $date2);
				$customerStatusData['duration'] = $diff->format("%a");
			}

			$this->customer_status_model->insert($customerStatusData);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function get_payment_detail()
	{
		$type = $this->input->post('type');
		$id = $this->input->post('customer_id');
		$p_id = $this->input->post('p_id');

		if($type == 'booking')
		{
			$field = 'booking_amount as amount,booking_receipt_no as receipt_no';
			$this->customer_model->_table = 'view_vehicle_process';
			$rows = $this->customer_model->find(array('id'=>$id),$field);
		}
		else
		{
			$field = 'receipt_no,amount';
			$this->customer_model->_table = 'sales_partial_payment';
			$rows = $this->customer_model->find(array('id'=>$p_id),$field);
		}
		echo json_encode($rows);
	}

	public function delete_payment()
	{
		$type = $this->input->post('type');
		$id  = $this->input->post('id');

		if($type == 'booking')
		{
			$data['id'] = $id;
			$data['booking_receipt_no'] = NULL;
			$data['booking_amount'] = NULL;
			$data['booking_receipt_no'] = NULL;
			$success = $this->Vehicle_process_model->update($data['id'],$data);
		}
		else
		{
			$p_data['id'] = $id;
			$success = $this->partial_payment_model->delete($p_data['id']);
		}
		if($success)
		{
			$success = TRUE;
		}
		echo json_encode($success);
	}
	
	public function inquiry_transfer()
	{		
		$data['header'] = lang('customers');
		$data['page'] = $this->config->item('template_admin') . "inquiry_transfer";
		$data['module'] = 'customers';

		$this->load->view($this->_container,$data);
	}

	public function save_dealer_inquiry_transfer()
	{
		$this->load->model('employees/employee_model');

		$this->employee_model->_table = "view_employees";
		$this->customer_model->_table = "view_customers";

		$from_dealer_id = $this->input->post('from_dealer_transfer_id');
		$to_dealer_id = $this->input->post('to_dealer_transfer_id');
		$from_executive_id = $this->input->post('from_transfer_executive_id');
		$to_executive_id = $this->input->post('to_transfer_executive_id');

		$from = $this->employee_model->find(array('id'=>$from_executive_id),'employee_name');
		$to = $this->employee_model->find(array('id'=>$to_executive_id),'employee_name');

		$this->db->where('(actual_status_rank = 15 OR actual_status_rank = 18 ) ');
		
		$info['count_inquiry'] = $this->customer_model->find_count(array('dealer_id'=>$from_dealer_id, 'executive_id'=>$from_executive_id),NULL,NULL,NULL,$this->input->post('dealer_quantity'));
		$info['from_name'] = $from->employee_name;
		$info['to_name'] = $to->employee_name;

		$this->db->where('(actual_status_rank = 15 OR actual_status_rank = 18 ) ');
		$rows = $this->customer_model->findAll(array('dealer_id'=>$from_dealer_id, 'executive_id'=>$from_executive_id),NULL,NULL,NULL,$this->input->post('dealer_quantity'));

		$end_date   = date("Y-m-d 23:59:59");

		$query = "SELECT * FROM view_followup_schedule WHERE executive_id = '".$from_executive_id."' AND (status_name = 'Pending' OR status_name = 'Booked' OR status_name= 'Confirmed') AND followup_date_en <= '".$end_date."' AND followup_status = 'Open' AND (deleted_at > NOW() OR deleted_at IS NULL) ORDER BY followup_date_en";

		$followups = $this->db->query($query)->result_array();
	
		$fromemployee = $this->db->where('id',$from_executive_id)->get('dms_employees')->row_array();
		$toemployee = $this->db->where('id',$to_executive_id)->get('dms_employees')->row_array();

		$this->discount_scheme_model->_table = 'view_sales_discount_schemes';
		$where = NULL;
		$where = array('created_by'=>$fromemployee['user_id']);
		$discounts = $this->discount_scheme_model->findAll($where);
		

		$success = false;
		if($rows){
			foreach ($rows as $key => $value) {
				$data[$key] = array(
					'id' => $value->id,
					'dealer_id' => $to_dealer_id,
					'executive_id' => $to_executive_id
				);
			}
			$success = $this->db->update_batch('dms_customers',$data,'id');
			
		}
		if($followups)
		{
			foreach ($followups as $key => $value) {
				$data[$key] = array(
					'id' => $value['id'],
					'executive_id' => $to_executive_id
				);
			}
			$this->db->update_batch('dms_customer_followups',$data,'id');

		}

		if($discounts)
		{
			foreach ($discounts as $key => $value) {
				$data[$key] = array(
					'id' => $value->id,
					'created_by' => $toemployee['user_id'],
				);
			}
			$this->db->update_batch('sales_discount_schemes',$data,'id');

		}

		

		if($success)
		{
			$success = TRUE;
		}
		else
		{
			$success = FALSE;
		}
		echo json_encode(array('success'=>$success,'data'=>$info));
	}
	
	public function save_inquiry_transfer()
	{
		$this->load->model('employees/employee_model');

		$this->employee_model->_table = "view_employees";
		$this->customer_model->_table = "view_customers";

		$from_dealer_id = $this->input->post('from_dealer_id');
		$to_dealer_id = $this->input->post('to_dealer_id');
		$from_executive_id = $this->input->post('from_executive_id');
		$to_executive_id = $this->input->post('to_executive_id');
		$from = $this->employee_model->find(array('id'=>$from_executive_id),'employee_name');
		$to = $this->employee_model->find(array('id'=>$to_executive_id),'employee_name');
		$info['from_name'] = $from->employee_name;
		$info['to_name'] = $to->employee_name;

		$this->db->where('(actual_status_rank = 1 OR actual_status_rank = 3 OR actual_status_rank = 2 ) ');
		
		$info['count_inquiry'] = $this->customer_model->find_count(array('dealer_id'=>$from_dealer_id, 'executive_id'=>$from_executive_id),NULL,NULL,NULL,$this->input->post('quantity'));
	
		$this->db->where('(actual_status_rank = 1 OR actual_status_rank = 3 OR actual_status_rank = 2) ');
		$rows = $this->customer_model->findAll(array('dealer_id'=>$from_dealer_id, 'executive_id'=>$from_executive_id),NULL,NULL,NULL,$this->input->post('quantity'));
		
		$success = false;
		if($rows){
			foreach ($rows as $key => $value) {
				$data[$key] = array(
					'id' => $value->id,
					'dealer_id' => $to_dealer_id,
					'executive_id' => $to_executive_id
				);
			}
			$success = $this->db->update_batch('dms_customers',$data,'id');
			
		}

		if($success)
		{
			$success = TRUE;
		}
		else
		{
			$success = FALSE;
		}
		echo json_encode(array('success'=>$success,'data'=>$info));
	}

	public function save_dealer_change_inquiry_transfer()
	{
		$this->load->model('employees/employee_model');

		$this->employee_model->_table = "view_employees";
		$this->customer_model->_table = "view_customers";

		$dealer_id = $this->input->post('dealer_id');
		$executive_id = $this->input->post('executive_id');
		$employee = $this->employee_model->find(array('id'=>$executive_id),'employee_name');
		$info['name'] = $employee->employee_name;

		$info['count_inquiry'] = $this->customer_model->find_count(array('executive_id'=>$executive_id));

		$rows = $this->customer_model->findAll(array('executive_id'=>$executive_id));
		
		foreach ($rows as $key => $value) {
			$data[$key] = array(
				'id' => $value->id,
				'dealer_id' => $dealer_id,
			);
		}
		$success = $this->db->update_batch('dms_customers',$data,'id');

		if($success)
		{
			$success = TRUE;
		}
		else
		{
			$success = FALSE;
		}
		echo json_encode(array('success'=>$success,'data'=>$info));
	}

	public function cancel_foc_document($foc_request_id = NULL)
	{	
		$this->db->where('id',$foc_request_id);
		$success = $this->db->delete('sales_foc_request');
		if($success)
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}