
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
 * Job_cards
 *
 * Extends the Project_Controller class
 * 
 */

class Service_report extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Job Cards');

		$this->load->model('job_cards/job_card_model');
		$this->lang->load('job_cards/job_card');
	}

	public function index($type=NULL){

		// Display Page
		$data['header']                 = 'Service Report';
		$data['page']                   = $this->config->item('template_admin') . "report";
		$data['module']                 = 'job_cards';
		$data['type']                   = $type;  
		$data['report_type']            = humanize(ucfirst($type));  
		$data['default_col']            = 'Service Type';
		$data['default_row']            = null;

		$this->load->view($this->_container,$data);

	}

	public function get_report_json(){
		// echo '<pre>'; print_r($this->input->post()); exit;
		$report_criteria_index = $this->input->post('report_criteria'); 

		$report_criteria = array(
			'dbview'    => 'view_log_stock_records',
			'col'       => '',
			'label'     => 'Dealer',
		);

		extract($report_criteria);

		$whereCondition = array();
		if(is_admin()){
			
		}else if( is_service_advisor() || is_accountant() ||  is_workshop_manager() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$this->db->where('dealer_id',$this->dealer_id);
			}


		} else if(is_floor_supervisor()){
			$this->db->where('dealer_id',$this->dealer_id);
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() || is_service_management()){
			$where = '';

		}else{
			$this->db->where('dealer_id',$this->dealer_id);
		}


		if($this->input->post('date_range')) {
			$date_range = explode(" - ", $this->input->post('date_range'));
			if ($date_range[0] != null && $date_range[1] != null) {
				$whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')";
			}
		}

		$this->job_card_model->_table = 'view_report_grouped_jobcard';

		$this->db->group_by(array('service_type_name','vehicle_name','variant_name','color_name','job_card_issue_date', 'closed_status', 'service_count', 'customer_name', 'engine_no', 'chassis_no', 'kms', 'year', 'reciever_name', 'jobcard_serial', 'vehicle_sold_on', 'dealer_name'));
		$field = 'service_type_name as Service Type, vehicle_name as Vehicle, variant_name as Varient, color_name as Color, job_card_issue_date as Issue Date, closed_status as Closed Status, service_count as Service Count, customer_name as Customer Name, engine_no as Engine No, chassis_no as Chassis No, kms as Kms, year as Make Year, reciever_name as Reciever Name, jobcard_serial as Jobcard No, vehicle_sold_on as Sold Date, dealer_name as Dealer Name';

		if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
            
        }	
		$entry = $this->job_card_model->findAll(NULL, $field);

		// print_r($this->db->last_query());
		// exit;


		$total = count($entry);
		if (count($entry) > 0) {
			$success = true;
		} else {
			$success = false;
		}
		echo json_encode(array('success' => $success, 'data' => $entry, 'total'=> $total));
	}
}