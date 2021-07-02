<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PROJECT
 *
 * PACKAGE DESCRIPTION
 *
 * @package         PROJECT
 * @author          <AUTHOR_NAME>
 * @copyright       Copyright (c) 2016
 */

// ---------------------------------------------------------------------------

/** @defgroup module_project_controller Project Controller Module
 * \brief Master Module for Project Controller
 * \details This module is used for managing data as master records for taxable and non taxable item of different project controller
 */

/**
 * @addtogroup module_project_controller 
 * @{
 */

/**
 * \class Project Controller
 * \brief Controller Class for managing master items of different project controller 
 */

/**
 *@}
 */

class Project_Controller extends Admin_Controller {

	var $_sparepartdealer;
	var $_document_count;
	var $dealer_id;
	var $fiscal_year_id;

	/**
	*
	* Constructor of Project_Contoller Controller
	*
	* @access  public
	* @param   null
	*/
	public function __construct()
	{
		$this->_sparepartdealer = $this->session->userdata('employee')['dealer_id'];
		$this->dealer_id = @$this->session->userdata()['employee']['dealer_id'];
		parent::__construct();
		$this->fiscal_year_id = get_current_fiscal_year();
	}

	/**
	*
	* Search in index page
	*
	* @access  public
	* @param   null
	* @return  null
	*/
	public function _get_search_param()
	{
		//search_params helper (project_helper);
		search_params();
	}

	public function get_groups_combo_json() 
	{
		$this->load->model('groups/group_model');

		// $this->db->where_not_in('id', array(1,2));
		$current_user_groups = $this->aauth->get_user_groups();
		if(isset($current_user_groups[1])) {
			$this->db->where('id >', $current_user_groups[1]->group_id);
		}

		$this->group_model->order_by('name asc');

		$rows=$this->group_model->findAll(null, array('id','name'));

		array_unshift($rows, array('id' => '0', 'name' => 'Select Group'));

		echo json_encode($rows);
		exit;
	}

	public function get_districts_combo_json() 
	{
		$filename = CACHE_PATH . 'districts.json';

		if (file_exists($filename)) {
			echo file_get_contents($filename);
			exit;
		}

		/*$this->load->model('district_mvs/district_mv_model');

		$this->db->where('type', 'DISTRICT');

		$this->district_mv_model->_table = 'view_district_mvs';
		$this->district_mv_model->order_by('name asc');
		
		$rows=$this->district_mv_model->findAll(null, array('id','name'));

		array_unshift($rows, array('id' => '0', 'name' => 'Select District'));

		echo json_encode($rows);*/
	}

	public function get_mun_vdcs_combo_json() 
	{
		$mun_vdc_id = $this->input->get('parent_id');

		$filename = CACHE_PATH . "mun_vdc_{$mun_vdc_id}.json";

		if (file_exists($filename)) {
			echo file_get_contents($filename);
			exit;
		}
	}

	public function get_cities_combo_json() 
	{
		$mun_vdc_id = $this->input->get('mun_vdc_id');

		$filename = CACHE_PATH . "city_places_{$mun_vdc_id}.json";

		if (file_exists($filename)) {
			echo file_get_contents($filename);
			exit;
		}
	}

	public function get_master_combo_json() 
	{
		$table_name = $this->input->get('table_name');

		$filename = CACHE_PATH . "{$table_name}.json";

		if (file_exists($filename)) {
			echo file_get_contents($filename);
			exit;
		}
	}

	public function get_dealers_combo_json() 
	{
		$this->load->model('dealers/dealer_model');

		$this->dealer_model->order_by('name asc');

		 // ACCESS LEVEL CHECK STARTS
		$is_showroom_incharge = NULL;
		$is_sales_executive = NULL;

		$dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
		
		if (empty($dealer_list)) {
			$is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
			$is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
		}
		
		if(!empty($dealer_list)) {
			$this->db->where_in('id', $dealer_list);
		} elseif ($is_showroom_incharge) {
			$this->db->where('id', $this->session->userdata('employee')['dealer_id']);
		}
		
		$rows=$this->dealer_model->findAll(null, array('id','name'));

		array_unshift($rows, array('id' => '0', 'name' => 'Select Dealer'));

		echo json_encode($rows);
	}


	public function get_sales_dealers_combo_json() 
	{
		$this->load->model('dealers/dealer_model');

		$this->dealer_model->order_by('name asc');

		 // ACCESS LEVEL CHECK STARTS
		// $is_showroom_incharge = NULL;
		// $is_sales_executive = NULL;

		// $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
		
		// if (empty($dealer_list)) {
		// 	$is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
		// 	$is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
		// }
		
		// if(!empty($dealer_list)) {
		$this->db->where('incharge_id IS NOT NULL');
		// } elseif ($is_showroom_incharge) {
		// 	$this->db->where('id', $this->session->userdata('employee')['dealer_id']);
		// }
		
		$rows=$this->dealer_model->findAll(null, array('id','name'));

		array_unshift($rows, array('id' => '0', 'name' => 'Select Dealer'));

		echo json_encode($rows);
	}
	
	
	/*public function get_spareparts_dealers_combo_json() 
	{
		$this->load->model('spareparts_dealers/dealer_model');

		$this->dealer_model->order_by('name asc');

		if(is_sparepart_dealer())
		{
			// $this->db->where('employee_type',1);
			$this->db->where('parent_id',$this->session->userdata('employee')['dealer_id']);
		}
		else
		{
			$this->db->where('parent_id',0);
		}
		
		$rows=$this->dealer_model->findAll(null, array('id','name'));
		echo json_encode($rows);
	}*/
	public function get_spareparts_dealers_combo_json($add_satungal = NULL) 
	{
		$this->load->model('dealers/dealer_model');

		$this->dealer_model->order_by('name asc');

		$is_sparepart_dealer_incharge = NULL;
		$is_sparepart_dealer = NULL;

		$dealer_list    = (is_sparepart_dealer()) ? is_sparepart_dealer_incharge() : NULL; 
		
		if (empty($dealer_list)) {
			$is_sparepart_dealer_incharge = (is_sparepart_dealer_incharge()) ? TRUE : NULL; 
			$is_sparepart_dealer = (is_sparepart_dealer()) ? TRUE : NULL; 
		}
		
		if(!empty($dealer_list)) {
			$this->db->where_in('id', $dealer_list);
		} elseif ($is_sparepart_dealer_incharge) {
			$this->db->where('id', $this->session->userdata('employee')['dealer_id']);
		}

		
		$rows=$this->dealer_model->findAll(null, array('id','name'));
		if($add_satungal){
			array_unshift($rows, array('id' => '0', 'name' => 'SATUNGAL'));
		}else{
			array_unshift($rows, array('id' => '0', 'name' => 'SELECT DEALER'));
		}
		echo json_encode($rows);
	}

	public function get_stockyard_combo_json()
	{
		$this->load->model('stock_yards/stock_yard_model');

		$this->stock_yard_model->order_by('name asc');
		$rows = $this->stock_yard_model->findAll(null,array('id','name'));
		
		echo json_encode($rows);
	}


	public function get_sales_executives_combo_json() 
	{
		$this->load->model('employees/employee_model');
		$this->employee_model->_table = "view_employee_group";
		$this->employee_model->order_by('name asc');

		if($this->input->get('dealer_id')){
			$this->db->where('dealer_id', $this->input->get('dealer_id'));
		}
		$where["(group_id = 400 OR group_id = 500 OR group_id = 600 OR group_id = 900)"] = NULL;

		$fields = array();
		$fields[] = 'id';
		$fields[] = "CASE WHEN middle_name <> '' THEN first_name || ' ' || middle_name || ' ' || last_name ELSE first_name || ' ' || last_name END as name ";
		
		$rows=$this->employee_model->findAll($where, $fields);
		array_unshift($rows, array('id' => '0', 'name' => 'Select Executive'));

		echo json_encode($rows);
	}

	public function get_executives_combo_json() 
	{
		$this->load->model('employees/employee_model');

		$this->employee_model->order_by('name asc');

		if($this->input->get('dealer_id')){
			$this->db->where('dealer_id', $this->input->get('dealer_id'));
		}

		$fields = array();
		$fields[] = 'id';
		$fields[] = "CASE WHEN middle_name <> '' THEN first_name || ' ' || middle_name || ' ' || last_name ELSE first_name || ' ' || last_name END as name ";
		
		$rows=$this->employee_model->findAll(null, $fields);

		array_unshift($rows, array('id' => '0', 'name' => 'Select Executive'));

		echo json_encode($rows);
	}

	public function get_variants_combo_json() 
	{
		$vehicle_id = $this->input->get('vehicle_id');

		$this->load->model('vehicles/vehicle_model');

		$this->vehicle_model->_table = 'view_dms_vehicles';

		$this->db->where('vehicle_id', $vehicle_id);

		$this->db->group_by('1,2,3');
		
		$rows=$this->vehicle_model->findAll(null, array('vehicle_id','variant_id', 'variant_name'));

		array_unshift($rows, array('variant_id' => '0', 'variant_name' => 'Select Variant'));

		echo json_encode($rows);
	}

	public function get_dealer_events_combo_json() 
	{
		$dealer_id = $this->input->get('dealer_id');

		$this->load->model('events/event_model');

		$this->db->where_in('dealer_id', array(0,$dealer_id));
		if($dealer_id != 75)
		{
			$this->db->or_where('dealer_id',NULL);
		}

		//$this->db->where('start_date_en >=', date('Y-m-d'));

		$rows=$this->event_model->findAll(array('active'=>'t'), array('id','name'));

		echo json_encode($rows);
	}

	public function get_colors_combo_json() 
	{
		$vehicle_id = $this->input->get('vehicle_id');
		$variant_id = $this->input->get('variant_id');

		$this->load->model('vehicles/vehicle_model');

		$this->vehicle_model->_table = 'view_dms_vehicles';

		$this->db->where('vehicle_id', $vehicle_id);
		$this->db->where('variant_id', $variant_id);

		$rows=$this->vehicle_model->findAll(null, array('color_id','color_name'));
		
		array_unshift($rows, array('color_id' => '0', 'color_name' => 'Select Color'));

		echo json_encode($rows);
	}

	public function get_dealer_incharges_combo_json() 
	{
		$this->load->model('users/user_model');

		$this->user_model->_table = 'view_user_groups';

		$this->db->where('group_id', DEALER_INCHARGE_GROUP);
		
		$rows=$this->user_model->findAll(null, array('user_id',"(fullname || ' [' || username || ']') as username"));

		array_unshift($rows, array('id' => '0', 'username' => 'Select Incharge'));

		echo json_encode($rows);
	}

	public function check_duplicate() 
	{
		list($module, $model) = explode("/", $this->input->post('model'));
		$field = $this->input->post('field');
		$value = $this->input->post('value');
		
		$this->db->where($field, $value);

		$this->load->model($this->input->post('model'));

		if ($this->input->post('id')) {
			$this->db->where('id <>', $this->input->post('id'));
		}

		$total=$this->$model->find_count();

		if ($total == 0) 
			echo json_encode(array('success' => true));
		else
			echo json_encode(array('success' => false));
	}

	/**
	*
	* Convert Nepali Date into English Date
	*
	* @access  public
	* @param   null
	* @return  null
	*/

	public function get_english_date()
	{
		$nepali_date = null;
		
		if ($this->input->post('nepali_date')) {
			$nepali_date = $this->input->post('nepali_date');
		}
		
		//HELPER FUNCTION
		get_english_date($nepali_date);
	}

	 /**
	*
	* Convert  English Date into Nepali Date
	*
	* @access  public
	* @param   null
	* @return  null
	*/

	public function get_nepali_date()
	{
		$english_date = null;
		
		if ($this->input->post('english_date')) {
			$english_date = $this->input->post('english_date');
		}
		
		//HELPER FUNCTION
		get_nepali_date($english_date);
	}

	protected function array_replace_null_by_zero(& $item, $key)
	{
		if ($item === null) {
			$item = 0;
		}
	}


	public function get_today_followup_json()
	{
		$start_date = date("Y-m-d 00:00:00",strtotime("-3 days"));
		$end_date   = date("Y-m-d 23:59:59");

		$this->load->model('customers/customer_followup_model');
		$this->customer_followup_model->_table = 'view_followup_schedule';
		
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

		//ENDS 

		// $this->db->where('followup_date_en >=', $start_date);

		$this->db->where("(status_name = 'Pending' OR status_name = 'Booked' OR status_name= 'Confirmed')", NULL, False);
		$this->db->where('followup_date_en <=', $end_date);
		$this->db->where('followup_status', 'Open');
		search_params();

		$total=$this->customer_followup_model->find_count();

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

		//ENDS 

		paging('followup_date_en');

		// $this->db->where('followup_date_en >=', $start_date);
		$this->db->where("(status_name = 'Pending' OR status_name = 'Booked' OR status_name= 'Confirmed')", NULL, False);
		$this->db->where('followup_date_en <=', $end_date);
		$this->db->where('followup_status', 'Open');
		search_params();

		$rows = $this->customer_followup_model->findAll();
		
		echo json_encode(array('success' => true, 'rows' =>$rows, 'total' => $total));     
	}

	public function getSparepartDealer($id = NULL)
	{
		if($id ==NULL){
			$id = $this->_user_id;
		}

		$this->load->model('spareparts_dealers/dealer_model');
		$sparepartdealer = $this->dealer_model->get_by(array('incharge_id'=>$id));
		return $sparepartdealer;
	}

	public function getDocumentCount()
	{
		$this->load->model('document_counts/document_count_model');
		$documentcount = $this->document_count_model->findAll(NULL,array('id','proforma_invoice','billing_invoice','msil_order_count'));
		return $documentcount;
	}

	public function get_Accessories_list()
	{
		$this->load->model('foc_accessories/foc_accessory_model');

		$this->foc_accessory_model->order_by('name asc');
		$rows = $this->foc_accessory_model->findAll(null,array('id','name'));

		array_unshift($rows, array('id' => '0', 'name' => 'Select Accessories'));
		echo json_encode($rows);
	}

	public function get_Accessories_partcode_list()
	{

		$this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');

		$vehicle_id = $this->input->get('vehicle_id');

		$this->foc_accessoreis_partcode_model->order_by('name asc');
		$rows = $this->foc_accessoreis_partcode_model->findAll(array('vehicle_id'=>$vehicle_id),array('id','name','part_code'));

		echo json_encode($rows);
	}
	
/*    public function sparepart_list_json()
	{
		$this->load->library('sparepart_orders/sparepart_order');
		$search_with = $this->input->get('part_code_startsWith');
		$this->db->like('part_code',$search_with,'after');
		$rows = $this->sparepart_model->findAll(NULL,array('id','part_code','name'),NULL,NULL,2000);
		// echo $this->db->last_query();
		array_unshift($rows, array('id' => '0', 'part_code' => 'Select Porduct'));
		echo json_encode($rows);
	}
*/
	//get detail of vehicle from msil_dispatch_records
	public function get_msil_dispatch_vehicle($index = NULL,$value = NULL){
		$where = array();

		$this->load->model('dispatch_records/dispatch_record_model');

		if($index != NULL){
			$where[$index] = $value;
		}

		$this->dispatch_record_model->_table = 'view_msil_dispatch_records';
		$row = $this->dispatch_record_model->findAll($where);
		return $row;
	}

	/*public function get_workshop_name() {
		$this->load->model('employees/employee_model');

		$this->employee_model->_table = "view_employee_to_workshop";

		$employee_id = ($this->session->userdata('employee')['employee_id']);
		$workshop = $this->employee_model->find(array('id' => $employee_id));
		if($workshop == false) {
			$workshop = $this->employee_model->find();
		}

		return $workshop;
	}*/

	public function get_mechanic_lists($dealer_id = NULL) {
		if($this->input->post('dealer_id')){
			$dealer_id = $this->input->post('dealer_id');
		}
		if($this->input->get('dealer_id')){
			$dealer_id = $this->input->get('dealer_id');
		}

		$this->load->model('employee/employee_model');
		$this->employee_model->_table = "view_ser_workshop_users";
		$where = array();

		$group = $this->input->get('group');
		$mechanic = $this->input->get('mechanic');
		$mechanicid = array();

		$mechanicid[] = PAINTER;
		$mechanicid[] = DENTER;

		if($group == 'mechanic_leader') {
			$mechanicid[] = MECHANIC_LEADER;
		}
		else if($group == 'mechanics') {
			$mechanicid[] = MECHANICS;
			$this->db->where('parent_id', $mechanic);
		}
		else{
			$mechanicid[] = MECHANIC_LEADER;
			$mechanicid[] = MECHANICS;
		}

		if( ! empty($mechanicid)) {
			$this->db->where_in('designation_id', $mechanicid);
		}
		if($dealer_id){
			$this->db->where('dealer_id', $dealer_id);
		}else if($this->dealer_id) {
			$this->db->where('dealer_id', $this->dealer_id);
		}
		$rows = $this->employee_model->findAll($where);

		array_unshift($rows, array('id' => '', 'name' => ''));

		echo json_encode($rows);
	}

	public function get_cleaners_lists() {
		$this->load->model('employee/employee_model');
		$this->employee_model->_table = "ser_workshop_users";
		$where = array();

		$group = $this->input->get('group');
		if($group == 'cleaner') {
			$where['designation_id'] = CLEANERS;
		}
		if($this->dealer_id) {
			$this->db->where('dealer_id', $this->dealer_id);
		}

		$rows = $this->employee_model->findAll($where);
		// echo $this->db->last_query();
		array_unshift($rows, array('id' => '', 'name' => ''));
		echo json_encode($rows);
	}


	function get_jobcard_number() {
		$this->db->order_by('jobcard_group','desc');
		$id = $this->job_card_model->find();
		$id = ($id)?++$id->jobcard_group:1;
		echo json_encode($id);
	}
	function get_counter_sales_number() {
		$this->job_card_model->_table = "ser_counter_sales";
		$this->db->order_by('counter_sales_id','desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$id = $this->job_card_model->find();
		$id = ($id)?++$id->counter_sales_id:1;

		if($this->uri->segment(4) == 'json') {
			echo json_encode($id);
		}
		return $id;
	}

	function get_billing_number() {
		$this->job_card_model->_table = "ser_billing_record";
		$this->db->order_by('invoice_no','desc');
		$this->db->where('dealer_id', $this->dealer_id);
		$this->db->where('fiscal_year_id', $this->fiscal_year_id[0]);
		$id = $this->job_card_model->find();
		$id = ($id)?++$id->invoice_no:1;

		if($this->uri->segment(4) == 'json') {
			echo json_encode($id);
		}

		return $id;
	}

	public function save_sms($jobno, $sms_template_id) {
		$this->load->library('parser');
		$this->load->model('job_cards/job_card_model');

		$this->job_card_model->_table = "mst_sms_template";
		$sms = $this->job_card_model->find(array('id' => $sms_template_id));

		$workshop = $this->get_workshop_name();

		$this->job_card_model->_table = "view_service_job_card";
		$jobcard = $this->job_card_model->find(array('jobcard_group' => $jobno));

		if($jobcard->mobile == 0 OR $jobcard->mobile == '') {
			return false;
		}
		
		$parserData = array(
			'COMPANY_NAME'      => $workshop->name,
			'DELIVERY_TIME'     => 'Delivery',
			'MODEL_NAME'        => $jobcard->vehicle_name,
			'REG_NO'            => $jobcard->vehicle_no,
			'WS_PHONE'          => $workshop->phone1,

			'NAME'              => 'Test NAME',
			'PLACE'             => 'Test Place',
		);

		$sms_parsed = $this->parser->parse_string($sms->message, $parserData);


		$sms_data = array(
			'message'           =>  $sms_parsed,
			'reciever_no'       =>  $jobcard->mobile,
			'sms_template_id'   =>  $sms_template_id,
			'sent'              =>  0,
		);

		$this->job_card_model->_table = "dms_sms_history";
		// $success = $this->job_card_model->insert($sms_data);

		if($success) {
			return true;
		}

		else {
			return false;
		}
	}


	public function get_sparepart_dealer_incharges_combo_json() 
	{
		$this->load->model('users/user_model');

		$this->user_model->_table = 'view_user_groups';

		$this->db->where('group_id', SPAREPART_DEALER_INCHARGE_GROUP);

		$rows=$this->user_model->findAll(null, array('user_id',"(fullname || ' [' || username || ']') as username"));

		echo json_encode($rows);
	}

	public function get_service_incharges_combo_json() {
		$this->load->model('users/user_model');

		$this->user_model->_table = 'view_user_groups';

		$this->db->where('group_id', 809);
		
		$rows=$this->user_model->findAll(null, array('user_id',"(fullname || ' [' || username || ']') as username"));

		array_unshift($rows, array('id' => '0', 'username' => 'Select Incharge'));

		echo json_encode($rows);
	}

	public function get_customer_inquiry_statuses()
	{
		$this->load->model('inquiry_statuses/inquiry_status_model');

		$rows = $this->inquiry_status_model->findAll(array('sub_status_group'=>0),array('id','name'));

		echo json_encode($rows);
	}

	public function get_customer_inquiry_sub_statuses()
	{
		$this->load->model('inquiry_statuses/inquiry_status_model');

		$group_id = $this->input->get('id');
		if($this->input->get('status_name'))
		{
			$status = $this->input->get('status_name');
			if($status == 'Booked')
			{
				$this->db->where('id <>',STATUS_CANCEL);
				$this->db->where('id <>',STATUS_LOST);
				
			}elseif($group_id == 3 ){
				$this->db->where('id <>', STATUS_BOOKING_CANCEL);
			}
		}

		$rows = $this->inquiry_status_model->findAll(array('sub_status_group'=>$group_id),array('id','name'));

		echo json_encode($rows);
	}

	public function change_current_location($vehicle_id,$location,$status){

		$this->load->model('dispatch_records/dispatch_record_model');

		$data['id'] = $vehicle_id;
		$data['current_location'] = $location;
		$data['current_status'] = $status;

		$success = $this->dispatch_record_model->update($data['id'], $data);

		return $success;
	}

	public function get_nepali_month_list()
	{
		$this->load->model('nepali_months/nepali_month_model');
		$rows = $this->nepali_month_model->findAll(NULL,array('id','name'));
		echo json_encode($rows);
	}

	public function get_Sparepart_category()
	{
		$this->load->model('spareparts_categories/spareparts_category_model');

		$this->spareparts_category_model->order_by('rank');
		$rows = $this->spareparts_category_model->findAll(null,array('id','name'));
		echo json_encode($rows);
	}

	public function correct_date_np_format()
	{
		$this->load->model('customers/customer_model');

		$explode = array();
		$new_date = array();
		$this->db->order_by('id');
		$this->db->where("inquiry_date_np LIKE '%/%'");
		$rows = $this->customer_model->findAll(NULL,array('id','inquiry_date_np'));
		foreach ($rows as $key => $value) 
		{
			$explode = explode('/', $value->inquiry_date_np);
			$new_date[] = array(
				'id' =>$value->id,
				'inquiry_date_np' => $explode[2].'-'.sprintf('%02d',$explode[0]).'-'.sprintf('%02d',$explode[1])
			);
		}
		$success = $this->db->update_batch('dms_customers',$new_date,'id');
		if($success)
		{
			echo 'success';
		}

		exit;
	}

	public function get_spareparts_dealer_stock_combo_json()
	{
		$this->load->library('sparepart_orders/sparepart_order');
		
		$search_name = strtoupper($this->input->get('name_startsWith'));
		$where["part_name LIKE '%{$search_name}%'"] = NULL;

		$this->sparepart_model->_table = "view_spareparts_all_dealer_stock";
		$this->db->where('dealer_id', $this->dealer_id);
		$data = $this->sparepart_model->findAll($where, NULL, NULL, NULL, 500);

		echo json_encode($data);
	}

	public function get_cg_spareparts_stock_json()
	{
		$this->load->library('sparepart_orders/sparepart_order');
		$this->sparepart_model->_table = "view_sparepart_real_stock";


		$search_name = strtoupper($this->input->get('part_code_startsWith'));
		$where["part_code LIKE '%{$search_name}%'"] = NULL;

		// $search_with = $this->input->get('part_code_startsWith');
		// $this->db->like('part_code',$search_with,'after');
		// $this->db->order_by('id desc');
		$rows = $this->sparepart_model->findAll($where,array('id','part_code','name','latest_part_code','stock_quantity','sparepart_id'),NULL,NULL);
		echo json_encode($rows);
	}

	public function sparepart_list_json()
	{
		$this->load->model('spareparts/sparepart_model');
		//$this->sparepart_model->_table = "view_sparepart_real_stock";


		if($this->input->get('part_code_startsWith')){
			$search_name = strtoupper($this->input->get('part_code_startsWith'));
			$where["part_code LIKE '%{$search_name}%'"] = NULL;

			// $search_with = $this->input->get('part_code_startsWith');
			// $this->db->like('part_code',$search_with,'after');
			// $this->db->order_by('id desc');
			$rows = $this->sparepart_model->findAll($where,array('id','part_code','name','latest_part_code'),NULL,NULL);
			// print_r($this->db->last_query());
			// exit;
			echo json_encode($rows);
		}
		else{
			echo json_encode(array());
		}
	}

	public function get_sparepart_list_json()
	{
		$this->load->library('sparepart_orders/sparepart_order');
		$search_with = $this->input->get('part_code_startsWith');
		$this->db->like('part_code',$search_with,'after');
		$rows = $this->sparepart_model->findAll(NULL,array('id','part_code','name'),NULL,NULL,12000);
		// echo $this->db->last_query();
		array_unshift($rows, array('id' => '0', 'part_code' => 'Select Porduct'));
		echo json_encode($rows);
	}

	public function get_picker_list($id = null,$json = 1)
	{
		$where = array();

		if($id){
			$where['id'] = $id;
		}

		$this->load->model('users/user_model');

		$this->user_model->_table = 'ser_workshop_users';

		$this->db->where('designation_id', PICKER_GROUP);
		
		$rows=$this->user_model->findAll($where, array('id',"first_name"));

		if ($json) {
			echo json_encode($rows);
		}else{
			return $rows;
		}
	}

	
	public function get_service_count_combo_json()
	{
		$vehicle_id = ($this->input->get('vehicle_id') ?$this->input->get('vehicle_id'): 0) ;
		$service_type = $this->input->get('service_type');

		$this->job_card_model->_table = "mst_vehicles";
		$policy_type = $this->job_card_model->find(array('id'=>$vehicle_id),'service_policy_id');

		$this->job_card_model->_table = "mst_service_warranty_policy";
		$rows = $this->job_card_model->findAll(array('service_policy_no'=>($policy_type ? $policy_type->service_policy_id : 0),'service_type_id'=>$service_type));

		echo json_encode($rows);
	}

	public function party_list() 
	{
		$this->load->model('spareparts/sparepart_model');
		
		$this->sparepart_model->_table = "view_user_ledger";
		$dealer_id = $this->session->userdata('employee')['dealer_id'];
		if($dealer_id)
		{
			$this->db->where('dealer_id',$dealer_id);
		}
		$search_name = strtolower($this->input->get('name_startsWith'));
		$where["lower(full_name) LIKE '%{$search_name}%'"] = NULL;
		
		$rows = $this->sparepart_model->findAll($where);
		echo json_encode($rows);
	}

	public function get_workshop_name() {
		$this->load->model('employees/employee_model');

		$this->employee_model->_table = "view_dealers";

		$workshop = $this->employee_model->find(array('id' => $this->dealer_id));
		if($workshop == false) {
			$workshop = $this->employee_model->find();
		}

		return $workshop;
	}

	public function get_all_sparepart_combo_json(){
		$this->load->model('spareparts/sparepart_model');
		$search_name = strtolower($this->input->get('name_startsWith'));
		$where["lower(part_code) LIKE '%{$search_name}%'"] = NULL;
		$data = $this->sparepart_model->findAll($where, NULL, NULL, NULL,1000);
		echo json_encode($data);
	}

	public function get_spareparts_combo_json(){
		$this->load->model('spareparts/sparepart_model');
		$search_name = strtolower($this->input->get('name_startsWith'));
		$where["lower(part_name) LIKE '%{$search_name}%'"] = NULL;

		// $this->sparepart_model->_table = "view_spareparts";
		$this->sparepart_model->_table = "view_spareparts_all_dealer_stock";
		if(!is_admin()){
			$this->db->where('dealer_id', $this->dealer_id);
		}
		$data = $this->sparepart_model->findAll($where, NULL, NULL, NULL, 300);

		echo json_encode($data);
	}

	public function get_spareparts_estimate_combo_json(){
		$this->load->model('spareparts/sparepart_model');
		$search_name = strtolower($this->input->get('name_startsWith'));
		$where["lower(part_name) LIKE '%{$search_name}%'"] = NULL;

		$this->sparepart_model->_table = "view_spareparts_all_dealer_stock";
		$data = $this->sparepart_model->findAll($where, NULL, NULL, NULL, 300);

		echo json_encode($data);
	}


public function get_spareparts_estimateDetails_combo_json(){
		$this->load->model('spareparts/sparepart_model');
		$search_name = strtolower($this->input->get('name_startsWith'));
		$where["lower(part_name) LIKE '%{$search_name}%'"] = NULL;

		$this->sparepart_model->_table = "view_spareparts";
		$data = $this->sparepart_model->findAll($where, NULL, NULL, NULL, 300);

		echo json_encode($data);
	}

	public function get_user_list_json() {
		$this->load->model('user_ledgers/user_ledger_model');
		$search_name = strtolower($this->input->get('name_startsWith'));
		$where["lower(party_name) LIKE '%{$search_name}%'"] = NULL;

		$this->user_ledger_model->_table = "view_user_ledger";
		
		$data = $this->user_ledger_model->findAll($where, NULL, NULL, NULL, 100);

		echo json_encode($data);
	}

	public function get_advice_material() {
		$this->job_card_model->_table = 'mst_spareparts';


		$search_name = strtoupper($this->input->get('name_startsWith'));
		// $where["name LIKE '%{$search_name}%'"] = NULL;
		$where["(name LIKE '%{$search_name}%' OR part_code LIKE '%{$search_name}%')"] = NULL;
		$this->db->group_by($fields = 'name,part_code,price,dealer_price')->limit(300);
		$rows = $this->job_card_model->findAll($where, $fields);
		// echo '<pre>'; print_r($rows); exit;
		if(!empty($rows)){
			foreach ($rows as $key => &$value) {
				$value->display_member = $value->name.' | '.$value->part_code;

			}
		}
		// echo json_encode(array('total' => count($rows), 'rows' => $rows));
		echo json_encode($rows);

	}

	public function get_advice_material_aro() {
		$this->job_card_model->_table = 'mst_spareparts';


		$search_name = strtoupper($this->input->get('name_startsWith'));
		// $where["name LIKE '%{$search_name}%'"] = NULL;
		$where["(name LIKE '%{$search_name}%' OR part_code LIKE '%{$search_name}%')"] = NULL;
		$this->db->group_by($fields = 'name,part_code,price,dealer_price,id')->limit(300);
		$rows = $this->job_card_model->findAll($where, $fields);
		// echo '<pre>'; print_r($rows); exit;
		if(!empty($rows)){
			foreach ($rows as $key => &$value) {
				$value->display_member = $value->name.' | '.$value->part_code;

			}
		}
		// echo json_encode(array('total' => count($rows), 'rows' => $rows));
		echo json_encode($rows);

	}

	public function insert_nepali_vehicle_delivery_date()
	{
		$this->load->model('vehicle_processes/vehicle_process_model');
		$rows = $this->vehicle_process_model->findAll();

		if($rows)
		{
			foreach ($rows as $key => $value) 
			{
				if($value->vehicle_delivery_date)
				{
					$data['id'] = $value->id;
					$data['vehicle_delivery_date_np'] = get_nepali_date($value->vehicle_delivery_date,'nep');
					$this->vehicle_process_model->update($data['id'],$data);
				}
			}
		}
	}

	public function get_dealer_lists() {
		$this->load->model('employee/employee_model');
		$this->employee_model->_table = "view_dealers";	
		$rows = $this->employee_model->findAll();
		// array_unshift($rows, array('id' => '', 'name' => ''));
		echo json_encode($rows);
		// echo '<pre>';
		// print_r($rows);
		// exit();
	}

	public function cat_list_json()
	{
		$this->load->model('spareparts_categories/spareparts_category_model');
		$rows = $this->spareparts_category_model->findAll();
		// array_unshift($rows, array('id' => '0', 'name' => 'Select'));
		echo json_encode($rows);
		
		
	}

	public function get_sparepart_stockyard($user_id = NULL)
	{
		if(!$user_id){
			$user_id = $this->session->userdata('id');
		}

		$this->load->model('stockyards/stockyard_model');

		$this->stockyard_model->_table = 'sparepart_stockyard_users';

		$where = array(
			'user_id' => $user_id,
		);
		$stockyard = $this->stockyard_model->find_ALL($where);

		return $stockyard;
	}

	public function get_abbr($string=NULL, $length = 0)
	{
		if(!$string){
			return false;
		}else{
			$abbr = '';
			$words = explode(' ', $string);
			$str_length = $length?$length:count($words);
			for ($i=0; $i < $str_length; $i++) { 
				$abbr .= substr($words[$i], 0,1);
			}

			return $abbr;
		}
	}

}