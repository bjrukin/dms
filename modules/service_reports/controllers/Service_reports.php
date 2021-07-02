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
 * Service_reports
 *
 * Extends the Project_Controller class
 * 
 */

class Service_reports extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		// control('Service_reports');

		$this->load->model('job_cards/job_card_model');
		$this->lang->load('service_reports/service_reports');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}

	public function job_summary() {

		// Display Page
		$data['header'] = lang('job_summary');
		$data['page'] = $this->config->item('template_admin') . "job_summary";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);

	}

	function get_jobSummary($group){
		if(is_admin()){
			$where = '';
			$dealer_where = '';
			$dealer_id = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$dealer_id = $this->dealer_id;
				$where = ' AND dealer_id = '. $dealer_id;
				$dealer_where = ' WHERE dealer_id = '. $dealer_id;
			}
		} else if(is_floor_supervisor()){
			$dealer_id = $this->dealer_id;

			$where = ' AND dealer_id = '. $dealer_id;
			$dealer_where = ' WHERE dealer_id = '. $dealer_id;
			
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){

				$where = '';
				$dealer_where = '';
				$dealer_id = '';

		


		}else{
			$dealer_id = $this->dealer_id;
			$where = ' AND dealer_id = '. $dealer_id;
			$dealer_where = ' WHERE dealer_id = '. $dealer_id;
		}

		$post = $this->input->post('selection');
		$dealer = $this->input->post('name');
		$post = explode(" - ", $post);
		if($group == 1) {
			$post_date = $post[0].' 00:00:00';
			$post_date1 = $post[1].' 23:59:59';
			$date_range = array($post_date,$post_date1);

			/*Service Types*/
			if(empty($dealer))
			{
				$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.vehicle_name || '('|| v.variant_name||')', v.vehicle_name, v.variant_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE v.job_card_issue_date >= ? AND v.job_card_issue_date <= ? $where GROUP BY 1, 2, 3, 4 $$, $$ SELECT DISTINCT NAME FROM mst_service_types $$, 'INT', '\"VEHICLE\" TEXT, \"vehicle_name\" TEXT, \"variant_name\" TEXT' ) AS sqlstring";
			}
			else
			{
				$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.vehicle_name || '('|| v.variant_name||')', v.vehicle_name, v.variant_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE (v.dealer_id = $dealer AND (v.job_card_issue_date >= ? AND v.job_card_issue_date <= ?)) $where GROUP BY 1, 2, 3, 4 $$, $$ SELECT DISTINCT NAME FROM mst_service_types $$, 'INT', '\"VEHICLE\" TEXT, \"vehicle_name\" TEXT, \"variant_name\" TEXT' ) AS sqlstring";
			}
			


			$rawQuery = $this->db->query($rawQuery, $date_range)->row();

			$query1 = $rawQuery->sqlstring;
			$data['success'] = true;

			$data = $this->db->query($query1)->result();

		} else {

			$date_range = array($post[0],$post[1],$post[0],$post[1],$post[0],$post[1],$post[0],$post[1],);
			/*Recieved Delivered Pending Ready*/
			if(empty($dealer))
			{
				$query2 = '
			SELECT jobcard_summary.vehicle_id, jobcard_summary.variant_id, jobcard_summary.deleted_at, jobcard_summary.vehicle_name, jobcard_summary.variant_name,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			((jobcard_summary_1.job_card_issue_date >= ?) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND 
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id 
			'.$where.') AS recieved,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			(((jobcard_summary_1.issue_date IS NOT NULL) AND (jobcard_summary_1.job_card_issue_date >= ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND 
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id'.$where.') AS delivered,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			((((jobcard_summary_1.closed_status = 1) AND (jobcard_summary_1.issue_date IS NULL)) AND (jobcard_summary_1.job_card_issue_date = ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND 
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id'.$where.') AS ready,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			(((jobcard_summary_1.closed_status = 0) AND (jobcard_summary_1.job_card_issue_date = ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND 
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id'.$where.') AS pending 
			FROM view_report_grouped_jobcard jobcard_summary 
			'.$dealer_where.' 
			GROUP BY jobcard_summary.vehicle_id, jobcard_summary.variant_id, jobcard_summary.deleted_at, jobcard_summary.vehicle_name, jobcard_summary.variant_name;
			';	
			}
			else
			{
				// print_r($dealer);
				// exit();
				$query2 = '
			SELECT jobcard_summary.vehicle_id, jobcard_summary.variant_id, jobcard_summary.deleted_at, jobcard_summary.vehicle_name, jobcard_summary.variant_name,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			((jobcard_summary_1.job_card_issue_date >= ?) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND
			jobcard_summary_1.dealer_id = '.$dealer.' AND 
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id 
			'.$where.') AS recieved,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			(((jobcard_summary_1.issue_date IS NOT NULL) AND (jobcard_summary_1.job_card_issue_date >= ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND 
			jobcard_summary_1.dealer_id = '.$dealer.' AND
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id'.$where.') AS delivered,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			((((jobcard_summary_1.closed_status = 1) AND (jobcard_summary_1.issue_date IS NULL)) AND (jobcard_summary_1.job_card_issue_date = ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND 
			jobcard_summary_1.dealer_id = '.$dealer.' AND
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id'.$where.') AS ready,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 
			WHERE
			(((jobcard_summary_1.closed_status = 0) AND (jobcard_summary_1.job_card_issue_date = ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) AND 
			jobcard_summary_1.dealer_id = '.$dealer.' AND
			jobcard_summary.vehicle_id = jobcard_summary_1.vehicle_id AND 
			jobcard_summary.variant_id = jobcard_summary_1.variant_id'.$where.') AS pending 
			FROM view_report_grouped_jobcard jobcard_summary 
			'.$dealer_where.' 
			GROUP BY jobcard_summary.vehicle_id, jobcard_summary.variant_id, jobcard_summary.deleted_at, jobcard_summary.vehicle_name, jobcard_summary.variant_name;
			';	
			}
			
			$data = $this->db->query($query2, $date_range)->result();
		}

		echo json_encode($data);
	}



	function job_summary_report($json = NULL) {
		if($json == 'json') {
 
			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$start_date =$post[0].' 00:00:00';
					$end_date =$post[1].' 23:59:59';
					$date_range = array($start_date,$end_date);
			}
			if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}
		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		if( empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT * FROM view_job_summary_refined v";
				}
				else
				{
					$query = "SELECT * FROM view_job_summary_refined v WHERE v.dealer_id IN ($dealer)";						
				}
	

			$rows = $this->db->query($query)->result();

		} else {
			$where = ($where != '')?"AND v.".$where:'';
			if(empty($dealer))
			{
				$query = "SELECT * FROM view_job_summary_refined v WHERE v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where}";
			}
			else
			{
				$query = "SELECT * FROM view_job_summary_refined v WHERE (v.dealer_id IN ($dealer) AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
			}
			
			$rows = $this->db->query($query, $date_range)->result();
			// echo $this->db->last_query(); exit;
		}
		// foreach($rows as $key=>$row)
		// {	
		// 	if($row->name == 'Spareparts')
		// 	{
		// 		$row->partprice = $row->price;
		// 	}
		// 	else if($row->name == 'Accessories')
		// 	{
		// 		$row->accessprice = $row->price;
		// 	}
		// 	else if($row->name == 'Oil')
		// 	{
		// 		$row->oilprice = $row->price;
		// 	}
		// 	else
		// 	{
		// 		$row->other = $row->price;
		// 	}
		// }
		echo json_encode(array('rows'=>$rows));
		exit;
			
		}

		// Display Page
		$data['header'] = lang('job_summary_report');
		$data['page'] = $this->config->item('template_admin') . "job_summary_report";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}

	// function revenue_report($json = NULL) {
	
	// 	if($json == 'json') {
 
	// 		$post = $this->input->post('selection');
	// 		$dealer = $this->input->post('name');
	// 		// print_r($dealer);
	// 		// exit();
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$start_date =$post[0].' 00:00:00';
	// 			$end_date =$post[1].' 23:59:59';
	// 			$date_range = array($start_date,$end_date,);
	// 		}
	// 		if(is_admin()){
	// 		$where = '';
	// 	}else if( is_service_advisor() || is_accountant() ) {
	// 		if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}
	// 	} else if(is_floor_supervisor()){
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	} else if( is_service_head() || is_national_service_manager() || is_admin() ){
	// 		$where = '';

	// 	}else{
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	}
	// 		if( empty($date_range)){
	// 			if(empty($dealer))
	// 			{	
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE v.billing_id != NULL";
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice  FROM view_job_summary_refined v GROUP BY v.dealer_name,v.service_type_name";	
	// 			}
	// 			else
	// 			{
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL)";	
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice FROM view_job_summary_refined v WHERE v.dealer_id = $dealer  GROUP BY v.dealer_name,v.service_type_name";						
	// 			}
		

	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			$where = ($where != '')?"AND v.".$where:'';
	// 			if(empty($dealer))
	// 			{
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.billing_id != NULL AND (v.job_card_issue_date >= ? AND v.job_card_issue_date <= ?))  {$where}";
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice FROM view_job_summary_refined v WHERE  v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where} GROUP BY v.dealer_name,v.service_type_name";
	// 			}
	// 			else
	// 			{
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice FROM view_job_summary_refined v WHERE (v.dealer_id = $dealer AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where} GROUP BY  v.dealer_name,v.service_type_name";
	// 			}
				
	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}

			
			
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
			
	// 	}

	// 	// Display Page
	// 	$data['header'] = lang('revenue_report');
	// 	$data['page'] = $this->config->item('template_admin') . "revenue_report";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);	
	// }
function revenue_report($json = NULL) {
	
		if($json == 'json') {
 
			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$start_date =$post[0].' 00:00:00';
				$end_date =$post[1].' 23:59:59';
				$date_range = array($start_date,$end_date,);
			}
			if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}
		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
			if( empty($date_range)){
				if(empty($dealer))
				{	
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE v.billing_id != NULL";
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice  FROM view_job_summary_refined v GROUP BY v.dealer_name,v.service_type_name";	
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v GROUP BY v.dealer_name";
		

				}
				else
				{
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL)";	
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice FROM view_job_summary_refined v WHERE v.dealer_id IN ($dealer)  GROUP BY v.dealer_name,v.service_type_name";	
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v WHERE v.dealer_id IN ($dealer) GROUP BY v.dealer_name";
							
				}
		

				$rows = $this->db->query($query)->result();

			} else {
				$where = ($where != '')?"AND v.".$where:'';
				
				if(empty($dealer))
				{
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.billing_id != NULL AND (v.job_card_issue_date >= ? AND v.job_card_issue_date <= ?))  {$where}";
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice FROM view_job_summary_refined v WHERE  v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where} GROUP BY v.dealer_name,v.service_type_name";
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v WHERE ( v.issue_date >= ? AND v.issue_date <= ?) {$where} GROUP BY v.dealer_name";
		
				}
				else
				{
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice FROM view_job_summary_refined v WHERE (v.dealer_id  IN ($dealer) AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where} GROUP BY  v.dealer_name,v.service_type_name";
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v WHERE(v.dealer_id IN ($dealer) AND (v.issue_date >= ? AND v.issue_date <= ?)) {$where} GROUP BY v.dealer_name";
				}

				
				$rows = $this->db->query($query, $date_range)->result();

				
				$rows2 = $this->db->query($query2, $date_range)->row();
				if($rows2){
						$counter_rows = (object)array(

						'dealer_name'=>$rows2->dealer_name,
						'service_type_name'=>'Counter',
						'partprice'=>$rows2->partprice,
						'accessprice'=>$rows2->accessprice,
						'oilprice'=>$rows2->oilprice,
						'other'=>$rows2->other,
						'localprice'=>$rows2->localprice,
						'labourprice'=>0,


					);
					array_unshift($rows, $counter_rows);
				}
				
				
				
			}
			
			
			echo json_encode(array('rows'=>$rows));
			exit;
			
		}

		// Display Page
		$data['header'] = lang('revenue_report');
		$data['page'] = $this->config->item('template_admin') . "revenue_report";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}
	function vehicle_flow_report($json = NULL) {
		if($json == 'json') {
 
			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$start_date = $post[0].' 00:00:00';
				$end_date = $post[1].' 23:59:59';
				$date_range = array($start_date,$end_date,);
			}
			if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}


		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
			if( empty($date_range)){
				if(empty($dealer))
				{
					$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name,v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";
				}
				else
				{					
					$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE v.dealer_id IN ($dealer) GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";

				}
				

			$rawQuery = $this->db->query($rawQuery)->row();

			$query1 = $rawQuery->sqlstring;

			$data['success'] = true;

			$data = $this->db->query($query1)->result();

			} else {
				$where = ($where != '')?"AND v.".$where:'';
				if(empty($dealer))
				{

				$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE v.issue_date >= ? AND v.issue_date <= ? $where GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME  as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";


				}
				else
				{
						$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE (v.dealer_id IN ($dealer) AND (v.issue_date >= ? AND v.issue_date <= ?)) $where GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME  as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";
				}
		

			$rawQuery = $this->db->query($rawQuery, $date_range)->row();

			$query1 = $rawQuery->sqlstring;

			$data['success'] = true;

			$data = $this->db->query($query1)->result();
			}
			
			// print_r($this->db->last_query());
			// exit;
			echo json_encode(array('rows'=>$data));
			exit;
			
		}

		// Display Page
		$data['header'] = lang('vehicle_flow_report');
		$data['page'] = $this->config->item('template_admin') . "vehicle_flow_report";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}
	// function foc_reports($json = NULL) {

	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');
	// 		$dealerName = $this->input->post('name');
	// 		$dealer = str_replace('-', ',', $dealerName);

			
	// 		// print_r($dealer);
	// 		// exit();
	// 		$post = explode(" - ", $post);

	// 		$this->job_card_model->_table = "view_report_all";
	// 		// $this->job_card_model->_table = "view_report_service_FOC_details";

	// 		// $where = "1=1";			

	// 		if(is_admin()){
	// 			$where = array();
	// 		}else if( is_service_advisor() || is_accountant() ) {
	// 			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 				$where['dealer_id'] = $this->dealer_id;
	// 			}
				

	// 		} else if(is_floor_supervisor()){
	// 			$where['dealer_id'] = $this->dealer_id;
	// 		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
	// 			$where = array();
		
	// 		}else{
	// 			$where['dealer_id'] = $this->dealer_id;
	// 		}	


	// 		$this->db->where('service_type',4);
	// 		if($this->input->post('selection')) {
	// 			$where['issue_date >='] = $post[0].' 00:00:00';
	// 			$where['issue_date <='] = $post[1].' 23:59:59';
	// 		}

	// 		if($this->input->post('name'))
	// 		{
	// 			$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
	// 		}

	// 		// echo '<pre>';print_r($where); exit;

	// 		$rows = $this->job_card_model->findAll($where);
	// 		// echo $this->db->last_query(); exit;
	// 		// $formatter = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
	// 		// $formatter->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");

	// 		foreach ($rows as $key => &$value) {
	// 			$value->service_no = ucfirst($value->service_count);
	// 		}
	// 		unset($value);
			
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
	// 	}

	// 	// Display Page
	// 	$data['header'] = lang('foc_reports');
	// 	$data['page'] = $this->config->item('template_admin') . "foc_reports";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);
	// }

	function foc_reports($json = NULL) {

		if($json == 'json') {

			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);

			
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);

			$this->job_card_model->_table = "view_job_summary_refined";
			// $this->job_card_model->_table = "view_report_service_FOC_details";

			// $where = "1=1";			

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where['dealer_id'] = $this->dealer_id;
				}
				

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
				$where = array();
		
			}else{
				$where['dealer_id'] = $this->dealer_id;
			}	


			$this->db->where('service_type',4);
			if($this->input->post('selection')) {
				$where['issue_date >='] = $post[0].' 00:00:00';
				$where['issue_date <='] = $post[1].' 23:59:59';
			}

			if($this->input->post('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}

			// echo '<pre>';print_r($where); exit;

			$rows = $this->job_card_model->findAll($where);
			// echo $this->db->last_query(); exit;
			// $formatter = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
			// $formatter->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");

			foreach ($rows as $key => &$value) {
				$value->service_no = ucfirst($value->service_count);
			}
			unset($value);
			// echo $this->db->last_query();
			// echo '<pre>'; print_r($rows); exit;
			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = lang('foc_reports');
		$data['page'] = $this->config->item('template_admin') . "foc_reports";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}

	function pdi_reports($json = NULL) {

		if($json == 'json') {

			$post = $this->input->post('selection');
			// $post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);
			

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$dealer_id = $this->dealer_id;
					$where['dealer_id'] = $dealer_id;
				}
			

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
				$where = array();
		
			}else{
				$dealer_id = $this->dealer_id;
				$where['dealer_id'] = $dealer_id;
			}	

			$this->job_card_model->_table = "view_job_summary_refined";

			if($this->input->post('selection')) {
				$where['issue_date >='] = $post[0].' 00:00:00';
				$where['issue_date <='] = $post[1].' 23:59:59';
			}

			if($this->input->post('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}


			$this->db->where('service_type',8);
			$rows = $this->job_card_model->findAll($where);
			
			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = lang('pdi_reports');
		$data['page'] = $this->config->item('template_admin') . "pdi_reports";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}

	// function mechanic_earning($json = NULL) {
	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$date_range = array($post[0],$post[1],);
	// 		}

	// 		if(is_admin()){
	// 			$where = '1=1';
	// 		}else{
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}

	// 		if( empty($date_range)){
	// 			$this->job_card_model->_table = "view_report_service_mechanic_earning";

	// 			// $this->db->where('dealer_id', $this->dealer_id);
	// 			$rows = $this->job_card_model->findAll($where);

	// 		} else {
				
	// 			// $where = "AND j.".$where;
	// 			$where = ($where != '')?"AND j.".$where:'';


	// 			$query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT) ||(e.last_name) :: TEXT) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.vat_job) AS vat_job, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, SUM (bill.total_jobs) + SUM (bill.vat_job) + COALESCE (osw.ow_payment, 0) + COALESCE (osw.ow_margin, 0) AS net_amount, j.dealer_id FROM view_ser_workshop_users e JOIN view_report_grouped_jobcard j ON j.mechanics_id = e. ID JOIN ser_billing_record bill ON j.jobcard_group = bill.jobcard_group LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, (SUM(ow.billing_final_amount) -(SUM(ow.total_amount)) :: DOUBLE PRECISION) AS ow_margin FROM ser_outside_work ow WHERE (ow.billing_final_amount IS NOT NULL) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id)) WHERE (bill.issue_date >= ? AND bill.issue_date <= ?)  {$where} GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, j.dealer_id";
	// 			// $query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT ) || (e.last_name) :: TEXT ) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.vat_job) AS vat_job, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, ((( SUM (bill.total_jobs) + SUM (bill.vat_job)) + (osw.ow_payment) :: DOUBLE PRECISION ) + osw.ow_margin ) AS net_amount FROM ((( view_employees e JOIN view_report_grouped_jobcard j ON ((j.mechanics_id = e. ID))) JOIN ser_billing_record bill ON (( j.jobcard_group = bill.jobcard_group ))) LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, ( SUM (ow.billing_final_amount) - (SUM(ow.total_amount)) :: DOUBLE PRECISION ) AS ow_margin FROM ser_outside_work ow WHERE ( ow.billing_final_amount IS NOT NULL ) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id))) WHERE ((e.designation_id = 4) AND (e.employee_type = 2)) AND ( bill.issue_date >= ? AND bill.issue_date <= ? ) AND e.$where GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin;";


	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}

	// 		// echo $this->db->last_query();
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
	// 	}

	// 	// Display Page
	// 	$data['header'] = lang('mechanic_earning');
	// 	$data['page'] = $this->config->item('template_admin') . "mechanic_earning";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);
	// }


	// function mechanic_earning($json = NULL) {
	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');	
	// 		$dealer = $this->input->post('name');	
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$date_range = array($post[0],$post[1]);
	// 		}
	// 		if(is_admin()){
	// 			$where = '';
	// 		}else if( is_service_advisor() || is_accountant() ) {
	// 			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 				$where = "dealer_id = {$this->dealer_id}";
	// 			}
			

	// 		} else if(is_floor_supervisor()){
	// 			$where['dealer_id'] = $this->dealer_id;
	// 		} else if( is_service_head() || is_national_service_manager() || is_admin() ){
	// 			$where = '';
		
	// 		}else{
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}	

	// 		if(empty($date_range)){
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_in) AS labout_amount,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 							) AS tmp
	// 						GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			else
	// 			{
	// 				$query = "SELECT
	// 						tmp.mechanics_id,
	// 						tmp.first_name,
	// 						tmp.last_name,
	// 						tmp.dealer_id,
	// 						tmp.dealer_name,
	// 						tmp.middle_name,
	// 						SUM (tmp.total_in) AS labout_amount,
	// 						SUM (tmp.total_out) AS ow_payment,
	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.dealer_id = ".$dealer."
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
			
				
	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			$where = ($where != '')?"AND j.".$where:'';
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 						tmp.mechanics_id,
	// 						tmp.first_name,
	// 						tmp.last_name,
	// 						tmp.dealer_id,
	// 						tmp.dealer_name,
	// 						tmp.middle_name,
	// 						SUM (tmp.total_in) AS labout_amount,
	// 						SUM (tmp.total_out) AS ow_payment,
	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.job_card_issue_date >= ?
	// 								AND jc.job_card_issue_date <= ?
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			else
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_in) AS labout_amount,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.job_card_issue_date >= ?
	// 								AND jc.job_card_issue_date <= ?
	// 								AND jc.dealer_id = ".$dealer."
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
	// 		// print_r($rows);
	// 		// exit();
				
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
	// 	}

	// 	// Display Page
	// 	$data['header'] = lang('mechanic_earning');
	// 	$data['page'] = $this->config->item('template_admin') . "mechanic_earning";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);
	// }

	// function mechanic_earning($json = NULL) {
	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');	
	// 		// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
	// 		if($this->input->post('name')){
	// 			$dealerName = $this->input->post('name');
	// 			$dealer = str_replace('-', ',', $dealerName);
	// 		}else{
	// 			// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
	// 			 $dealer = $this->dealer_id;	
	// 		}

	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$post_date = $post[0].' 00:00:00';
	// 			$post_date1 = $post[1].' 23:59:59';
	// 			$date_range = array($post_date,$post_date1);
	// 		}

			
	// 		if(is_admin()){
	// 			$where = '';
	// 		}else if( is_service_advisor() || is_accountant() ) {
	// 			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 				$where = "dealer_id = {$this->dealer_id}";
	// 			}
			

	// 		} else if(is_floor_supervisor()){
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
	// 			$where = '';
		
	// 		}else{
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}	

	// 		if(empty($date_range)){
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_in) AS labout_amount,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 							) AS tmp
	// 						GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			else
	// 			{
	// 				$query = "SELECT
	// 						tmp.mechanics_id,
	// 						tmp.first_name,
	// 						tmp.last_name,
	// 						tmp.dealer_id,
	// 						tmp.dealer_name,
	// 						tmp.middle_name,
	// 						SUM (tmp.total_in) AS labout_amount,
	// 						SUM (tmp.total_out) AS ow_payment,
	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID 
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
			
				
	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			$where = ($where != '')?"AND j.".$where:'';
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 						tmp.mechanics_id,
	// 						tmp.first_name,
	// 						tmp.last_name,
	// 						tmp.dealer_id,
	// 						tmp.dealer_name,
	// 						tmp.middle_name,
	// 						SUM (tmp.total_in) AS labout_amount,
	// 						SUM (tmp.total_out) AS ow_payment,
	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			else
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_in) AS labout_amount,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 								AND jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
	// 		// echo $this->db->last_query(); exit;
	// 		//  print_r($this->db->last_query());
	// 		// exit();
				
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
	// 	}

	// 	// Display Page
	// 	$data['header'] = lang('mechanic_earning');
	// 	$data['page'] = $this->config->item('template_admin') . "mechanic_earning";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);
	// }

	function mechanic_earning($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');	
			// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
			if($this->input->post('name')){
				$dealerName = $this->input->post('name');
				$dealer = str_replace('-', ',', $dealerName);
			}else{
				// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
				 $dealer = $this->dealer_id;	
			}

			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$post_date = $post[0].' 00:00:00';
				$post_date1 = $post[1].' 23:59:59';
				$date_range = array($post_date,$post_date1);
			}

			
			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = '';
		
			}else{
				$where = "dealer_id = {$this->dealer_id}";
			}	

			if(empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_in) AS labout_amount,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.localprice) as local,
								SUM(tmp.other) as other,
								SUM(tmp.total_parts) as total_part,
								SUM(tmp.vat_parts) as vat_parts,
								SUM(tmp.net_total) as net_total
								
							FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice,b.total_parts,	b.vat_parts,b.net_total			
										FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id
								) AS tmp
							GROUP BY
								1,2,3,4,5,6";
				}
				else
				{
					$query = "SELECT
							tmp.mechanics_id,
							tmp.first_name,
							tmp.last_name,
							tmp.dealer_id,
							tmp.dealer_name,
							tmp.middle_name,
							SUM (tmp.total_in) AS labout_amount,
							SUM (tmp.total_out) AS ow_payment,
							SUM(tmp.ow_margin) AS ow_margin,

							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							SUM(tmp.partprice) as part_price,
							SUM(tmp.accessprice) as accessories,
							SUM(tmp.oilprice) as lube,
							SUM(tmp.localprice) as local,

							SUM(tmp.other) as other,
							SUM(tmp.total_parts) as total_part,
							SUM(tmp.vat_parts) as vat_parts,
							SUM(tmp.net_total) as net_total
							
							FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID 
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.localprice,pb.oilprice,pb.other,b.total_parts,	b.vat_parts,b.net_total	
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id
									WHERE
										jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";
				}
			
				
				$rows = $this->db->query($query)->result();

			} else {
				$where = ($where != '')?"AND j.".$where:'';
				if(empty($dealer))
				{
					$query = "SELECT
							tmp.mechanics_id,
							tmp.first_name,
							tmp.last_name,
							tmp.dealer_id,
							tmp.dealer_name,
							tmp.middle_name,
							SUM (tmp.total_in) AS labout_amount,
							SUM (tmp.total_out) AS ow_payment,
							SUM(tmp.ow_margin) AS ow_margin,
							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount,
							SUM(tmp.partprice) as part_price,
							SUM(tmp.accessprice) as accessories,
							SUM(tmp.oilprice) as lube,
							SUM(tmp.other) as other,
							SUM(tmp.localprice) as local,
							SUM(tmp.total_parts) as total_part,
							SUM(tmp.vat_parts) as vat_parts,
							SUM(tmp.net_total) as net_total
							
							FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice,b.total_parts,	b.vat_parts,b.net_total	
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
										jc.issue_date >= ?
									AND jc.issue_date <= ?
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";
				}
				else
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_in) AS labout_amount,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local,
								SUM(tmp.total_parts) as total_part,
								SUM(tmp.vat_parts) as vat_parts,
								SUM(tmp.net_total) as net_total
								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice,b.total_parts,	b.vat_parts,b.net_total	
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
										jc.issue_date >= ?
									AND jc.issue_date <= ?
									AND jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";
				}
				$rows = $this->db->query($query, $date_range)->result();
			}
			// echo $this->db->last_query(); exit;
			//  print_r($this->db->last_query());
			// exit();
				
			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = lang('mechanic_earning');
		$data['page'] = $this->config->item('template_admin') . "mechanic_earning";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}


	// function counter_sales($json = NULL) {
	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$date_range = array($post[0],$post[1],);
	// 		}

	// 		if(is_admin()){
	// 			$where = '';
	// 		}else{
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}

	// 		if( empty($date_range)){
	// 			$this->job_card_model->_table = "view_report_service_counter_sales";

	// 			// $this->db->where('dealer_id', $this->dealer_id);
	// 			$rows = $this->job_card_model->findAll($where);

	// 		} else {
	// 			$where =($where != '')?"AND csales.".$where:'';

	// 			$query = " SELECT pcat. ID, pcat. NAME AS category_name, COUNT (cparts.quantity) AS category_count, SUM (cparts.quantity) AS category_quantity, ((SUM(cparts.price)) :: DOUBLE PRECISION - SUM(cparts.final_amount)) AS discount_amount, ow.warranty_price, SUM (cbills.vat_parts) AS vat_amount, SUM (cparts.price) AS parts_price, ((SUM(cbills.net_total) - SUM(cbills.vat_parts)) - (ow.warranty_price) :: DOUBLE PRECISION ) AS total, SUM (cbills.cash_discount_amt) AS cash_discount, csales.dealer_id, csales.deleted_at FROM (((((ser_counter_sales csales LEFT JOIN ser_parts cparts ON((cparts.bill_id = csales. ID))) LEFT JOIN mst_spareparts sp ON ((sp. ID = cparts.part_id))) LEFT JOIN mst_spareparts_category pcat ON ((sp.category_id = pcat. ID))) LEFT JOIN ser_billing_record cbills ON ((cbills. ID = csales.billing_record_id))) LEFT JOIN ( SELECT sp_1.category_id, SUM (pa.price) AS warranty_price FROM ((ser_parts pa LEFT JOIN mst_spareparts sp_1 ON((pa.part_id = sp_1. ID))) LEFT JOIN mst_spareparts_category scat ON ((sp_1.category_id = scat. ID))) WHERE ((pa.warranty IS NOT NULL) AND(pa.bill_id IS NOT NULL)) GROUP BY sp_1.category_id ) ow ON ((ow.category_id = pcat. ID))) WHERE csales.date_time BETWEEN ? AND ? {$where} GROUP BY pcat. ID, pcat. NAME, ow.warranty_price, csales.dealer_id, csales.deleted_at;";

	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
			
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
			
	// 	}

	// 	// Display Page
	// 	$data['header'] = lang('counter_sales');
	// 	$data['page'] = $this->config->item('template_admin') . "counter_sales";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);	
	// }

	function counter_sales($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$post_date = $post[0].' 00:00:00';
				$post_date1 = $post[1].' 23:59:59';
				$date_range = array($post_date,$post_date1);
			}

			

			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = '';
		
			}else{
				$where = "dealer_id = {$this->dealer_id}";
			}	

			if( empty($date_range))
			{
				if(empty($dealer))
				{
					$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.final_amount as price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.payment_type,r.cash_discount_amt,r.vehicle_no,r.full_name FROM view_report_service_counter_sales r WHERE r.bill_type = 'counter'";
				}
				else
				{
					$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.final_amount as price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.payment_type,r.cash_discount_amt,r.vehicle_no,r.full_name FROM view_report_service_counter_sales r WHERE ((r.dealer_id IN ($dealer)) AND (r.bill_type = 'counter'))";
				}
				
				$rows = $this->db->query($query)->result();

			} 
			else
			{
				$where = ($where != '')?"AND r.".$where:'';
				if(empty($dealer))
				{
					$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.final_amount as price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.payment_type,r.cash_discount_amt,r.vehicle_no,r.full_name FROM view_report_service_counter_sales r 
				WHERE ((r.bill_type = 'counter') AND 
				(
					r.billing_issue_date >= ?
					AND r.billing_issue_date <= ?
				)) {$where}";
				}
				else
				{
					$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.final_amount as price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.payment_type,r.cash_discount_amt,r.vehicle_no,r.full_name FROM view_report_service_counter_sales r 
				WHERE 
				((r.bill_type = 'counter') AND (r.dealer_id IN ($dealer)) AND 
				(
					r.billing_issue_date >= ?
					AND r.billing_issue_date <= ?
				)) {$where}";
				}

				
				
				$rows = $this->db->query($query, $date_range)->result();
				// print_r($this->db->last_query());
				// exit;
			}
			
			echo json_encode(array('rows'=>$rows));
			exit;
			
		}

		// Display Page
		$data['header'] = lang('counter_sales');
		$data['page'] = $this->config->item('template_admin') . "counter_sales";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}

	// public function dent_paint_excel_dump($start = 0 , $end = 0, $name = NULL){
	// 	$start = str_replace("_","-",$start);	
	// 	$date_range = array();
	// 	if($name){
	// 			$dealerName = $name;
	// 			$dealer = str_replace('-', ',', $dealerName);
	// 		}else{
	// 			// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
	// 			 $dealer = $this->dealer_id;	
	// 		}

	// 	if($start != 0 && $end != 0){
	// 		$start_date =$start.' 00:00:00';
	// 		$end_date =$end.' 23:59:59';
	// 		$date_range = array($start_date,$end_date);
	// 	}
	// 	if(is_admin()){
	// 		$where = '';
	// 	}else if( is_service_advisor() || is_accountant() ) {
	// 		if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}


	// 	} else if(is_floor_supervisor()){
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
	// 		$where = '';

	// 	}else{
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	}
	// 	if( empty($date_range)){
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 								jc.service_type = 1
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
	// 			else
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 								 jc.service_type = 1
	// 								AND jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
				
	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			$where = ($where != '')?"AND j.".$where:'';
	// 			if(empty($dealer))
	// 			{
	// 					$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 								jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 								AND jc.service_type = 1
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
	// 			else
	// 			{
	// 					$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 								AND jc.service_type = 1
	// 								AND jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
			
	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
	// 	// echo '<pre>'; print_r($rows); exit;
	// 	if($rows)
	// 	{
	// 		$this->load->library('Excel');
	// 		$style = array(
	// 	        'alignment' => array(
	// 	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	// 	        )
	// 	    );
	// 		$objPHPExcel = new PHPExcel(); 
	// 		$objPHPExcel->setActiveSheetIndex(0);
	// 		if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

	// 		}else{
	// 			$this->db->where('id',$this->dealer_id);
	// 			$dealer = $this->db->get('dms_dealers')->row_array();
	// 			$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:H1")->applyFromArray($style);
	// 			$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');

	// 		}
	// 		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Dent Paint Report From '.$start.' to '.$end)->getStyle("A2:H2")->applyFromArray($style);
	// 		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
	// 		// $objPHPExcel->setActiveSheetIndex(0);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic Name');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('B4','Service Advisor Name');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('C4','Labor Amount');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('D4','Consumption Amount');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('E4','OW Payment');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('F4','OW Margin');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('G4','VAT');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('H4','Net Amount');
	// 		// $objPHPExcel->getActiveSheet()->SetCellValue('G4','VAT Labor');
	// 		// $objPHPExcel->getActiveSheet()->SetCellValue('H4','VAT Consumption');
	// 		// $objPHPExcel->getActiveSheet()->SetCellValue('I4','Net Amount');
			

	// 		$row = 5;
	// 		$col = 0; 	

	// 		$jobs = 0;       
	// 		$parts = 0;       
	// 		$ow_payment = 0;       
	// 		$ow_margin = 0;       
	// 		$vat_job = 0;  
	// 		$vat_parts = 0;  
	// 		$net_amount = 0;  
	// 		$vat = 0;
			     
	// 		foreach($rows as $key => $values) 
	// 		{        
	// 			$jobs += $values->jobs;
	// 			$parts += $values->parts;
	// 			$ow_payment += $values->ow_payment;
	// 			$ow_margin += $values->ow_margin;
	// 			$vat_job += $values->vat_job;
	// 			$vat_parts += $values->vat_parts;
	// 			$vat += $values->vat;
	// 			$net_amount += $values->net_amount;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobs);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->parts);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_payment);
	// 			$col++;

	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_margin);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat);
	// 			$col++;
	// 			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_job);
	// 			// $col++;
	// 			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_parts);
	// 			// $col++;				
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_amount);
	// 			$col++;
				

	// 			$col = 0;
	// 			$row++;        
	// 		}

	// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':B'.$row)->applyFromArray($style);
	// 		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.$row);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$jobs);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$parts);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$ow_payment);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$ow_margin);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$vat);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$net_amount);
	// 		/*$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$vat_job);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$vat_parts);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$net_amount);*/


	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

	// 		header("Pragma: public");
	// 		header("Content-Type: application/force-download");
	// 		header("Content-Disposition: attachment;filename=dent_paint.xls");
	// 		header("Content-Transfer-Encoding: binary ");
	// 		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	// 		ob_end_clean();
	// 		$objWriter->save('php://output');

			
	// 	}
	// 	redirect($_SERVER['HTTP_REFERER']);
	// }
	
	public function dent_paint_excel_dump($start = 0 , $end = 0, $name = NULL){
		$start = str_replace("_","-",$start);	
		$date_range = array();
		if($name){
				$dealerName = $name;
				$dealer = str_replace('-', ',', $dealerName);
			}else{
				// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
				 $dealer = $this->dealer_id;	
			}

		if($start != 0 && $end != 0){
			$start_date =$start.' 00:00:00';
			$end_date =$end.' 23:59:59';
			$date_range = array($start_date,$end_date);
		}
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}


		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		// if( empty($date_range)){
		// 		if(empty($dealer))
		// 		{
		// 			$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_parts) AS parts,
		// 						SUM (tmp.vat_parts) AS vat_parts,
		// 						SUM (tmp.vat_job) AS vat_job,
		// 						SUM (tmp.total_in) AS jobs,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
		// 						(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
		// 						FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 							jc.service_type = 1
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";

		// 		}
		// 		else
		// 		{
		// 			$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_parts) AS parts,
		// 						SUM (tmp.vat_parts) AS vat_parts,
		// 						SUM (tmp.vat_job) AS vat_job,
		// 						SUM (tmp.total_in) AS jobs,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
		// 						(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
		// 						FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 							 jc.service_type = 1
		// 							AND jc.dealer_id IN (".$dealer.")
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";

		// 		}
				
		// 		$rows = $this->db->query($query)->result();

		// 	} else {
		// 		$where = ($where != '')?"AND j.".$where:'';
		// 		if(empty($dealer))
		// 		{
		// 				$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_parts) AS parts,
		// 						SUM (tmp.vat_parts) AS vat_parts,
		// 						SUM (tmp.vat_job) AS vat_job,
		// 						SUM (tmp.total_in) AS jobs,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
		// 						(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
		// 						FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 							jc.issue_date >= ?
		// 							AND jc.issue_date <= ?
		// 							AND jc.service_type = 1
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";

		// 		}
		// 		else
		// 		{
		// 				$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_parts) AS parts,
		// 						SUM (tmp.vat_parts) AS vat_parts,
		// 						SUM (tmp.vat_job) AS vat_job,
		// 						SUM (tmp.total_in) AS jobs,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
		// 						(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
		// 						FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 								jc.issue_date >= ?
		// 							AND jc.issue_date <= ?
		// 							AND jc.service_type = 1
		// 							AND jc.dealer_id IN (".$dealer.")
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";

		// 		}
			
		// 		$rows = $this->db->query($query, $date_range)->result();
		// 	}

		if( empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local
								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id
									WHERE
									jc.service_type = 1
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
				else
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local
								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
									 jc.service_type = 1
									AND jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
				
				$rows = $this->db->query($query)->result();

			} else {
				$where = ($where != '')?"AND j.".$where:'';
				if(empty($dealer))
				{
						$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local

								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
									jc.issue_date >= ?
									AND jc.issue_date <= ?
									AND jc.service_type = 1
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
				else
				{
						$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local
								
								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
										jc.issue_date >= ?
									AND jc.issue_date <= ?
									AND jc.service_type = 1
									AND jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
			
				$rows = $this->db->query($query, $date_range)->result();
			}
		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:H1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Dent Paint Report From '.$start.' to '.$end)->getStyle("A2:H2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Mechanic Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Service Advisor Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Labor Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','OW Payment');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','OW Margin');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Part');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Lube');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Accessories');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','Local');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','Other');
			// $objPHPExcel->getActiveSheet()->SetCellValue('H4','Consumption Amount');
			// $objPHPExcel->getActiveSheet()->SetCellValue('K4','VAT Labor');
			$objPHPExcel->getActiveSheet()->SetCellValue('L4','VAT');
			$objPHPExcel->getActiveSheet()->SetCellValue('M4','Net Amount');
			

			$row = 5;
			$col = 0; 	

			$jobs = 0;       
			$parts = 0;       
			$ow_payment = 0;       
			$ow_margin = 0;       
			$vat_job = 0;  
			$vat_parts = 0;  
			$net_amount = 0;  
			$total_part = 0;  
			$total_lube = 0;  
			$total_acc = 0;  
			$total_other = 0;  
			$local = 0;  
			     
			foreach($rows as $key => $values) 
			{        
				$jobs += $values->jobs;
				$parts += $values->parts;
				$ow_payment += $values->ow_payment;
				$ow_margin += $values->ow_margin;
				$vat_job += ($values->vat_job + $values->vat_parts);
				$vat_parts += $values->vat_parts;
				$net_amount += $values->net_amount;
				$total_part += $values->part_price;  
				$total_lube += $values->lube;  
				$total_acc += $values->accessories;  
				$total_other += $values->other;  
				$local += $values->local;  
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobs);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_payment);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_margin);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_price);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->lube);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessories);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->local);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				$col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->parts);
				// $col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_job);
				// $col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_parts);
				$col++;				
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, (@$values->net_amount + @$values->vat_job));
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, (@$values->net_amount));
				$col++;
				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':C'.$row)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':C'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$jobs);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$ow_payment);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$ow_margin);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$total_part);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$total_lube);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$total_acc);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$local);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$total_other);
			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$parts);
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$vat_job);
			// $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$vat_parts);
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$net_amount);


			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=dent_paint.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function vehicle_flow_report_excel_dump($start = 0 , $end = 0, $name = NULL){
		$start = str_replace("_","-",$start);		
		$date_range = array();

		if($start != 0 && $end != 0){
			$start_date = $start.' 00:00:00';
				$end_date = $end.' 23:59:59';
			$date_range = array($start_date,$end_date);
		}
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}


		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		if($name){
			$dealer = str_replace('-', ',', $name);

		}
		if( empty($date_range)){
			if(empty($dealer))
			{
				$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";
			}
			else
			{
				$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE v.dealer_id IN($dealer) GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";

			}
			
			$rawQuery = $this->db->query($rawQuery)->row();

			$query1 = $rawQuery->sqlstring;

			
			$rows = $this->db->query($query1)->result();

		} else {
			$where = ($where != '')?"AND v.".$where:'';
			if(empty($dealer))
			{
					$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE v.issue_date >= ? AND v.issue_date <= ? $where GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME  as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";

			}
			else
			{
					$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT v.dealer_name, v.service_type_name, COUNT (v.service_type_name) FROM view_report_grouped_jobcard v WHERE (v.dealer_id IN($dealer)AND (v.issue_date >= ? AND v.issue_date <= ?)) $where GROUP BY 1, 2 ORDER BY dealer_name $$, $$ SELECT DISTINCT NAME  as service_type_name FROM mst_service_types $$, 'INT', '\"dealer_name\" TEXT' ) AS sqlstring";
			}

		
			$rawQuery = $this->db->query($rawQuery, $date_range)->row();

			$query1 = $rawQuery->sqlstring;


			$rows = $this->db->query($query1)->result();
		}

		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:J1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Vehicle Flow Report From '.$start.' to '.$end)->getStyle("A2:J2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','AMC');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Free');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Paid(AW)');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Paid(UW)');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Running Repair');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Accidental');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Other');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','PDI');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','Total');
			

			$row = 5;
			$col = 0; 	

			$AMC = 0;       
			$FREE = 0;       
			$PAIDaw = 0;       
			$PAIDuw = 0;       
			$running = 0;  
			$ACCIDENTAL = 0;  
			$Other = 0;  
			$PDI = 0;  
			$final_total = 0;  
			     
			foreach($rows as $key => $values) 
			{        
				$value = (array)$values; 

				$total = $value['AMC'] + $value['FREE'] + $value['PAID(AW)'] + $value['PAID(UW)'] + $value['RUNNING REPAIR'] + $value['ACCIDENTAL'] + $value['Other'] + $value['PDI'];
				$AMC += $value['AMC'];
				$FREE += $value['FREE'];
				$PAIDaw += $value['PAID(AW)'];
				$PAIDuw += $value['PAID(UW)'];
				$running += $value['RUNNING REPAIR'];
				$ACCIDENTAL += $value['ACCIDENTAL'];
				$Other += $value['Other'];
				$PDI += $value['PDI'];
				$final_total += $total;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['dealer_name']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['AMC']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['FREE']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['PAID(AW)']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['PAID(UW)']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['RUNNING REPAIR']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['ACCIDENTAL']);
				$col++;				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['Other']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$value['PDI']);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$total);
				$col++;

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row)->applyFromArray($style);
			// $objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':D'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$AMC);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$FREE);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$PAIDaw);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$PAIDuw);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$running);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$ACCIDENTAL);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$Other);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$PDI);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$final_total);


			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=vehicle_flow.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	// public function revenue_report_excel_dump($start = 0 , $end = 0, $name = NULL){
	// 	$start = str_replace("_","-",$start);	
	// 	$date_range = array();
	// 	if($start != 0 && $end != 0){
	// 		$start_date =$start.' 00:00:00';
	// 			$end_date =$end.' 23:59:59';
	// 			$date_range = array($start_date,$end_date);
	// 	}
	// 	if(is_admin()){
	// 		$where = '';
	// 	}else if( is_service_advisor() || is_accountant() ) {
	// 		if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}
	// 	} else if(is_floor_supervisor()){
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	} else if( is_service_head() || is_national_service_manager() || is_admin() ){
	// 		$where = '';

	// 	}else{
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	}
	// 	// if( empty($date_range)){
	// 	// 	if(empty($name))
	// 	// 	{
	// 	// 		// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE v.billing_id != NULL";
	// 	// 				$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v";
					
	// 	// 	}
	// 	// 	else
	// 	// 	{
	// 	// 		// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL)";	
	// 	// 				$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v WHERE v.dealer_id = $name";

	// 	// 	}
	// 	// 	$rows = $this->db->query($query)->result();

	// 	// } else {
	// 	// 	$where = ($where != '')?"AND v.".$where:'';
	// 	// 	if(empty($name))
	// 	// 	{
	// 	// 			// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.billing_id != NULL AND (v.job_card_issue_date >= ? AND v.job_card_issue_date <= ?))  {$where}";
	// 	// 			$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v WHERE v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where}";

	// 	// 	}
	// 	// 	else
	// 	// 	{
	// 	// 			// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
	// 	// 			$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v WHERE (v.dealer_id = $name AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
	// 	// 	}
	// 	// 	$rows = $this->db->query($query, $date_range)->result();
	// 	// }
	// 	if( empty($date_range)){
	// 			if(empty($dealer))
	// 			{	
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE v.billing_id != NULL";
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice  FROM view_job_summary_refined v GROUP BY v.dealer_name,v.service_type_name";	
	// 			}
	// 			else
	// 			{
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL)";	
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice FROM view_job_summary_refined v WHERE v.dealer_id = $dealer  GROUP BY v.dealer_name,v.service_type_name";						
	// 			}
		

	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			$where = ($where != '')?"AND v.".$where:'';
	// 			if(empty($dealer))
	// 			{
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.billing_id != NULL AND (v.job_card_issue_date >= ? AND v.job_card_issue_date <= ?))  {$where}";
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice FROM view_job_summary_refined v WHERE  v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where} GROUP BY v.dealer_name,v.service_type_name";
	// 			}
	// 			else
	// 			{
	// 				// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
	// 				$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice FROM view_job_summary_refined v WHERE (v.dealer_id = $dealer AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where} GROUP BY  v.dealer_name,v.service_type_name";
	// 			}
				
	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
	// 	// foreach($rows as $key=>$row)
	// 	// 	{	
	// 	// 		if($row->name == 'Spareparts')
	// 	// 		{
	// 	// 			$row->partprice = $row->price;
	// 	// 			$row->accessprice = 0;
	// 	// 			$row->oilprice = 0;
	// 	// 			$row->other = 0;
	// 	// 		}
	// 	// 		else if($row->name == 'Accessories')
	// 	// 		{
	// 	// 			$row->accessprice = $row->price;
	// 	// 			$row->partprice = 0;
	// 	// 			$row->oilprice = 0;
	// 	// 			$row->other = 0;
	// 	// 		}
	// 	// 		else if($row->name == 'Oil')
	// 	// 		{
	// 	// 			$row->oilprice = $row->price;
	// 	// 			$row->accessprice = 0;
	// 	// 			$row->partprice = 0;
	// 	// 			$row->other = 0;
	// 	// 		}
	// 	// 		else
	// 	// 		{
	// 	// 			$row->other = $row->price;
	// 	// 			$row->partprice = 0;
	// 	// 			$row->accessprice = 0;
	// 	// 			$row->oilprice = 0;
	// 	// 		}
	// 	// 	}
	// 	// echo '<pre>'; print_r($rows); exit;
	// 	if($rows)
	// 	{
	// 		$this->load->library('Excel');
	// 		$style = array(
	// 	        'alignment' => array(
	// 	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	// 	        )
	// 	    );
	// 		$objPHPExcel = new PHPExcel(); 
	// 		$objPHPExcel->setActiveSheetIndex(0);
	// 		if(is_service_head() || is_national_service_manager() || is_admin()){

	// 		}else{
	// 			$this->db->where('id',$this->dealer_id);
	// 			$dealer = $this->db->get('dms_dealers')->row_array();
	// 			$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:G1")->applyFromArray($style);
	// 			$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

	// 		}
	// 		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Revenue Report From '.$start.' to '.$end)->getStyle("A2:G2")->applyFromArray($style);
	// 		$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
	// 		// $objPHPExcel->setActiveSheetIndex(0);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer Name');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('B4','Service Type');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('C4','Parts');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('D4','Lube');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('E4','Labour');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('F4','Accessories');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('G4','Other');
			

	// 		$row = 5;
	// 		$col = 0; 	

	// 		$partprice = 0;       
	// 		$oilprice = 0;       
	// 		$labourprice = 0;       
	// 		$accessprice = 0;       
	// 		$other = 0;  
			     
	// 		foreach($rows as $key => $values) 
	// 		{   
	// 			$partprice += $values->partprice;
	// 			$oilprice += $values->oilprice;
	// 			$labourprice += $values->labourprice;
	// 			$accessprice += $values->accessprice;
	// 			$other += $values->other;
				
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->partprice);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->oilprice);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labourprice);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessprice);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
	// 			$col++;				
				

	// 			$col = 0;
	// 			$row++;        
	// 		}

	// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':B'.$row)->applyFromArray($style);
	// 		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.$row);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$partprice);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$oilprice);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$labourprice);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$accessprice);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$other);


	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

	// 		header("Pragma: public");
	// 		header("Content-Type: application/force-download");
	// 		header("Content-Disposition: attachment;filename=revenue.xls");
	// 		header("Content-Transfer-Encoding: binary ");
	// 		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	// 		ob_end_clean();
	// 		$objWriter->save('php://output');

			
	// 	}
	// 	redirect($_SERVER['HTTP_REFERER']);
	// }

public function revenue_report_excel_dump($start = 0 , $end = 0, $name = NULL){
		$start = str_replace("_","-",$start);	
		$date_range = array();
		if($start != 0 && $end != 0){
			$start_date =$start.' 00:00:00';
				$end_date =$end.' 23:59:59';
				$date_range = array($start_date,$end_date);
		}
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}
		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		if($name){
			$dealer = str_replace('-', ',', $name);

		}
		// if( empty($date_range)){
		// 	if(empty($name))
		// 	{
		// 		// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE v.billing_id != NULL";
		// 				$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v";
					
		// 	}
		// 	else
		// 	{
		// 		// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL)";	
		// 				$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v WHERE v.dealer_id = $name";

		// 	}
		// 	$rows = $this->db->query($query)->result();

		// } else {
		// 	$where = ($where != '')?"AND v.".$where:'';
		// 	if(empty($name))
		// 	{
		// 			// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.billing_id != NULL AND (v.job_card_issue_date >= ? AND v.job_card_issue_date <= ?))  {$where}";
		// 			$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v WHERE v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where}";

		// 	}
		// 	else
		// 	{
		// 			// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
		// 			$query = "SELECT v.dealer_name,v.service_type_name,v.price,v.name,v.labourprice FROM view_report_revenue v WHERE (v.dealer_id = $name AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
		// 	}
		// 	$rows = $this->db->query($query, $date_range)->result();
		// }
		if( empty($date_range)){
				if(empty($dealer))
				{	
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE v.billing_id != NULL";
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice  FROM view_job_summary_refined v GROUP BY v.dealer_name,v.service_type_name";	
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v GROUP BY v.dealer_name";
		

				}
				else
				{
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL)";	
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice FROM view_job_summary_refined v WHERE v.dealer_id IN ($dealer)  GROUP BY v.dealer_name,v.service_type_name";	
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v WHERE v.dealer_id IN ($dealer) GROUP BY v.dealer_name";
							
				}
		

				$rows = $this->db->query($query)->result();

			} else {
				$where = ($where != '')?"AND v.".$where:'';
				
				if(empty($dealer))
				{
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.billing_id != NULL AND (v.job_card_issue_date >= ? AND v.job_card_issue_date <= ?))  {$where}";
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice FROM view_job_summary_refined v WHERE  v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where} GROUP BY v.dealer_name,v.service_type_name";
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v WHERE ( v.issue_date >= ? AND v.issue_date <= ?) {$where} GROUP BY v.dealer_name";
		
				}
				else
				{
					// $query = "SELECT v.dealer_name,v.service_type_name,v.price FROM view_report_revenue v WHERE (v.dealer_id = $dealer AND v.billing_id != NULL AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
					$query = "SELECT v.dealer_name,v.service_type_name,SUM(v.partprice) as partprice,SUM(v.accessprice) as accessprice ,SUM(v.oilprice) as oilprice,SUM(v.other) as other,SUM(v.labourprice) as labourprice, sum(v.localprice) as localprice FROM view_job_summary_refined v WHERE (v.dealer_id  IN ($dealer) AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where} GROUP BY  v.dealer_name,v.service_type_name";
					$query2 = " SELECT v.dealer_name,sum(v.partprice) as partprice,sum(v.accessprice) as accessprice,sum(v.oilprice) as oilprice,sum(v.other) as other, sum(v.localprice) as localprice FROM view_jobrefined_counter as v WHERE(v.dealer_id IN ($dealer) AND (v.issue_date >= ? AND v.issue_date <= ?)) {$where} GROUP BY v.dealer_name";
				}

				
				$rows = $this->db->query($query, $date_range)->result();
				$rows2 = $this->db->query($query2, $date_range)->row();
				if($rows2){
						$counter_rows = (object)array(

						'dealer_name'=>$rows2->dealer_name,
						'service_type_name'=>'Counter',
						'partprice'=>$rows2->partprice,
						'accessprice'=>$rows2->accessprice,
						'oilprice'=>$rows2->oilprice,
						'other'=>$rows2->other,
						'localprice'=>$rows2->localprice,
						'labourprice'=>0,


					);
					array_unshift($rows, $counter_rows);
				}
				
				
				
			}
			
		// foreach($rows as $key=>$row)
		// 	{	
		// 		if($row->name == 'Spareparts')
		// 		{
		// 			$row->partprice = $row->price;
		// 			$row->accessprice = 0;
		// 			$row->oilprice = 0;
		// 			$row->other = 0;
		// 		}
		// 		else if($row->name == 'Accessories')
		// 		{
		// 			$row->accessprice = $row->price;
		// 			$row->partprice = 0;
		// 			$row->oilprice = 0;
		// 			$row->other = 0;
		// 		}
		// 		else if($row->name == 'Oil')
		// 		{
		// 			$row->oilprice = $row->price;
		// 			$row->accessprice = 0;
		// 			$row->partprice = 0;
		// 			$row->other = 0;
		// 		}
		// 		else
		// 		{
		// 			$row->other = $row->price;
		// 			$row->partprice = 0;
		// 			$row->accessprice = 0;
		// 			$row->oilprice = 0;
		// 		}
		// 	}
		// 	echo $this->db->last_query();
		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:G1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Revenue Report From '.$start.' to '.$end)->getStyle("A2:G2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Service Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Lube');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Labour');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Accessories');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Local');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Other');
			

			$row = 5;
			$col = 0; 	

			$partprice = 0;       
			$oilprice = 0;       
			$labourprice = 0;       
			$accessprice = 0;       
			$other = 0;  
			$local = 0;  
			     
			foreach($rows as $key => $values) 
			{   
				$partprice += $values->partprice;
				$oilprice += $values->oilprice;
				$labourprice += $values->labourprice;
				$accessprice += $values->accessprice;
				$other += $values->other;
				$local += $values->localprice;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->partprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->oilprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labourprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->localprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				$col++;				
				

				$col = 0;
				$row++;        
			}

		

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':B'.$row)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':B'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$partprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$oilprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$labourprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$accessprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$local);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$other);

			
			


			

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=revenue.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function job_summary_report_excel_dump($start = 0 , $end = 0, $name = NULL){
		$start = str_replace("_","-",$start);	
		$date_range = array();
		if($start != 0 && $end != 0){
			$start_date =$start.' 00:00:00';
			$end_date =$end.' 23:59:59';
			$date_range = array($start_date,$end_date);
		}
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}
		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		if($name){
			$dealer = str_replace('-', ',', $name);
		}
		if( empty($date_range)){
			if(empty($dealer))
			{
				$query = "SELECT * FROM view_job_summary_refined v";
					
			}
			else
			{
				$query = "SELECT * FROM view_job_summary_refined v WHERE v.dealer_id IN ($dealer)";
			}
			$rows = $this->db->query($query)->result();

		} else {
			$where = ($where != '')?"AND v.".$where:'';
			if(empty($dealer))
			{
					$query = "SELECT * FROM view_job_summary_refined v WHERE v.billing_issue_date >= ? AND v.billing_issue_date <= ?  {$where}";

			}
			else
			{
					$query = "SELECT * FROM view_job_summary_refined v WHERE (v.dealer_id IN ($dealer) AND (v.billing_issue_date >= ? AND v.billing_issue_date <= ?))  {$where}";
			}
			$rows = $this->db->query($query, $date_range)->result();
		}

		// foreach($rows as $key=>$row)
		// 	{	
		// 		if($row->name == 'Spareparts')
		// 		{
		// 			$row->partprice = $row->price;
		// 			$row->accessprice = 0;
		// 			$row->oilprice = 0;
		// 			$row->other = 0;
		// 		}
		// 		else if($row->name == 'Accessories')
		// 		{
		// 			$row->accessprice = $row->price;
		// 			$row->partprice = 0;
		// 			$row->oilprice = 0;
		// 			$row->other = 0;
		// 		}
		// 		else if($row->name == 'Oil')
		// 		{
		// 			$row->oilprice = $row->price;
		// 			$row->accessprice = 0;
		// 			$row->partprice = 0;
		// 			$row->other = 0;
		// 		}
		// 		else
		// 		{
		// 			$row->other = $row->price;
		// 			$row->partprice = 0;
		// 			$row->accessprice = 0;
		// 			$row->oilprice = 0;
		// 		}
		// 	}
		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:G1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Job Summary Report From '.$start.' to '.$end)->getStyle("A2:M2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Vehicle No');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Job Card No');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Engine No');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Km');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Customer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Mechanic Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Service Advisor');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','Floor Supervisor Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('L4','Labour');
			$objPHPExcel->getActiveSheet()->SetCellValue('M4','Lube');
			$objPHPExcel->getActiveSheet()->SetCellValue('N4','Accessories');
			$objPHPExcel->getActiveSheet()->SetCellValue('O4','Other');
			$objPHPExcel->getActiveSheet()->SetCellValue('P4','Parts Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q4','Job Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('R4','Net Total');
		
			

			$row = 5;
			$col = 0; 	

			$partprice = 0;       
			$oilprice = 0;       
			$labourprice = 0;       
			$accessprice = 0;       
			$other = 0;  
			$final_total = 0;  
			     
			foreach($rows as $key => $values) 
			{   
				$total = $values->partprice + $values->labourprice + $values->oilprice + $values->accessprice +$values->other;
				$partprice += $values->partprice;
				$oilprice += $values->oilprice;
				$labourprice += $values->labourprice;
				$accessprice += $values->accessprice;
				$other += $values->other;
				$final_total += $total;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_group);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->engine_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->kms);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->customer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;		
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
				$col++;				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->floor_supervisor_name);
				$col++;				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->partprice);
				$col++;		
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labourprice);
				$col++;				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->oilprice);
				$col++;		
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessprice);
				$col++;	
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				$col++;	
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
				$col++;	
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_desc);
				$col++;	
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$total);
				$col++;		
				

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':H'.$row)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':I'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$partprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$labourprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$oilprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$row,$accessprice);
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$row,$other);
			$objPHPExcel->getActiveSheet()->SetCellValue('R'.$row,$final_total);


			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=job_summary_report.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

// 	public function mechanic_consume_report_excel_dump($start = 0 , $end = 0, $name = NULL){
// 		$start = str_replace("_","-",$start);	
// 		$date_range = array();
// 		if($start != 0 && $end != 0){
// 			$date_range = array($start,$end);
// 		}
// 		if(is_admin()){
// 			$where = '';
// 		}else if( is_service_advisor() || is_accountant() ) {
// 			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
// 				$where = "dealer_id = {$this->dealer_id}";
// 			}
// 		} else if(is_floor_supervisor()){
// 			$where = "dealer_id = {$this->dealer_id}";
// 		} else if( is_service_head() || is_national_service_manager() || is_admin() ){
// 			$where = '';

// 		}else{
// 			$where = "dealer_id = {$this->dealer_id}";
// 		}
// 		if( empty($date_range)){
// 			if(empty($name))
// 			{
// 					$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name, e.total_parts as taxable,e.final_amount AS ow_payment,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e GROUP BY 1, 2, 3, 4,5,6";
					
// 			}
// 			else
// 			{
// 				$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name, e.total_parts as taxable,e.final_amount AS ow_payment,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e WHERE e.dealer_id = $name GROUP BY 1, 2, 3, 4,5,6";
// 			}
// 			$rows = $this->db->query($query)->result();

// 		} else {
// 			$where = ($where != '')?"AND e.".$where:'';
// 			if(empty($name))
// 			{
// 					$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name,e.final_amount AS ow_payment, e.total_parts as taxable,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e  WHERE 
// 	(
// 		e.issue_date >= ?
// 		AND e.issue_date <= ?
// 	) {$where}
// 	GROUP BY 1, 2, 3, 4,5,6
// ";

// 			}
// 			else
// 			{
// 					$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name,e.final_amount AS ow_payment, e.total_parts as taxable,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e  WHERE (e.dealer_id = $name AND (
// 	(
// 		e.issue_date >= ?
// 		AND e.issue_date <= ?
// 	)) {$where}
// 	GROUP BY 1, 2, 3, 4,5,6
// ";
// 			}
// 			$rows = $this->db->query($query, $date_range)->result();
// 		}
// 		// echo '<pre>'; print_r($rows); exit;
// 		if($rows)
// 		{
// 			$this->load->library('Excel');
// 			$style = array(
// 		        'alignment' => array(
// 		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
// 		        )
// 		    );
// 			$objPHPExcel = new PHPExcel(); 
// 			$objPHPExcel->setActiveSheetIndex(0);
// 			if(is_service_head() || is_national_service_manager() || is_admin()){

// 			}else{
// 				$this->db->where('id',$this->dealer_id);
// 				$dealer = $this->db->get('dms_dealers')->row_array();
// 				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:G1")->applyFromArray($style);
// 				$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

// 			}
// 			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mehcanic Consume Report From '.$start.' to '.$end)->getStyle("A2:M2")->applyFromArray($style);
// 			$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
// 			// $objPHPExcel->setActiveSheetIndex(0);
// 			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic Name');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Taxable');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Taxes');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Accessories');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Spareparts');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Tools');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Books');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Misc');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Local');
			

// 			$row = 5;
// 			$col = 0; 	

// 			$taxable = 0;       
// 			$taxes = 0; 
// 			foreach($rows as $key => $values) 
// 			{   
				
// 				$taxable += $values->taxable;
// 				$taxes += $values->taxes;
				
			
				
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->taxable);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->taxes);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessories);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->spareparts);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->tools);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->books);
// 				$col++;		
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->misc);
// 				$col++;	
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->local);
// 				$col++;	
// 				$col = 0;
// 				$row++;        
// 			}

// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row)->applyFromArray($style);
// 			// $objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':I'.$row);
// 			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$taxable);
// 			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$taxes);
// 			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
// 			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
// 			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
// 			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
// 			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
// 			// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
			


// 			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
// 			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
// 			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
// 			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
// 			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

// 			header("Pragma: public");
// 			header("Content-Type: application/force-download");
// 			header("Content-Disposition: attachment;filename=mechanic_consume.xls");
// 			header("Content-Transfer-Encoding: binary ");
// 			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// 			ob_end_clean();
// 			$objWriter->save('php://output');

			
// 		}
// 		redirect($_SERVER['HTTP_REFERER']);
// 	}
	public function mechanic_consume_report_excel_dump($start = 0 , $end = 0, $name = NULL){
			$start = str_replace("_","-",$start);	
			$date_range = array();
			if($start != 0 && $end != 0){
				$start_date =$start.' 00:00:00';
				$end_date =$end.' 23:59:59';
				$date_range = array($start_date,$end_date);
			}
			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = '';

			}else{
				$where = "dealer_id = {$this->dealer_id}";
			}
			if($name){
				$dealer = str_replace('-', ',', $name);
			}
			if( empty($date_range)){
				if(empty($dealer))
				{
						$query = "SELECT * FROM view_mechanic_wise_part_consume_final";

				}
				else
				{
					// print_r($dealer);
					// exit();
						$query = "SELECT * FROM view_mechanic_wise_part_consume_final  WHERE dealer_id IN ($dealer) ";



				}
				$rows = $this->db->query($query)->result();
			}
			else
			{
				$where = ($where != '')?"AND ".$where:'';
				if(empty($dealer))
				{
					$query = "SELECT * FROM view_mechanic_wise_part_consume_final WHERE 
								(
									issue_date >= ?
									AND issue_date <= ?
								) {$where}
								
							";
				}
				else
				{
					$query = "SELECT * FROM view_mechanic_wise_part_consume_final WHERE dealer_id IN ($dealer) AND (
								(
									issue_date >= ?
									AND issue_date <= ?
								)) {$where}
								
							";	
				}
				$rows = $this->db->query($query,$date_range)->result();
			}
			// echo '<pre>'; print_r($rows); exit;
			if($rows)
			{
				$this->load->library('Excel');
				$style = array(
			        'alignment' => array(
			            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        )
			    );
				$objPHPExcel = new PHPExcel(); 
				$objPHPExcel->setActiveSheetIndex(0);
				if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

				}else{
					$this->db->where('id',$this->dealer_id);
					$dealer = $this->db->get('dms_dealers')->row_array();
					$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:G1")->applyFromArray($style);
					$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');

				}
				$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mehcanic Consume Report From '.$start.' to '.$end)->getStyle("A2:M2")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
				// $objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('B4','Dealer Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('C4','Jobcard No');
				$objPHPExcel->getActiveSheet()->SetCellValue('D4','Part Code');
				$objPHPExcel->getActiveSheet()->SetCellValue('E4','Part Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('F4','Chasis No');
				$objPHPExcel->getActiveSheet()->SetCellValue('G4','Vehicle Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('H4','Vehicle No');
				$objPHPExcel->getActiveSheet()->SetCellValue('I4','Taxable');
				$objPHPExcel->getActiveSheet()->SetCellValue('J4','Vat');
				$objPHPExcel->getActiveSheet()->SetCellValue('K4','Net Amount');
				
				

				$row = 5;
				$col = 0; 	

				$taxable = 0;       
				$taxes = 0; 
				$netamt = 0; 
				foreach($rows as $key => $values) 
				{   
					
					$taxable += $values->final_amount;
					$taxes += $values->vat;
					$netamt += $values->net_total;
					
				
					
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_code);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat);
					$col++;		
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_total);
					$col++;	
						
					$col = 0;
					$row++;        
				}

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('H'.$row)->applyFromArray($style);
				// $objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':I'.$row);
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$taxable);
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$taxes);
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$netamt);
				// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
				// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
				// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
				// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
				// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
				// $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,'');
				


				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

				header("Pragma: public");
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment;filename=mechanic_consume.xls");
				header("Content-Transfer-Encoding: binary ");
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				ob_end_clean();
				$objWriter->save('php://output');

				
			}
			redirect($_SERVER['HTTP_REFERER']);
	}

	public function couter_sale_excel_dump($start = 0 , $end = 0, $name = NULL){
		$start = str_replace("_","-",$start);	
		$date_range = array();

		if($start != 0 && $end != 0){
				$post_date = $start.' 00:00:00';
				$post_date1 = $end.' 23:59:59';
				$date_range = array($post_date,$post_date1);
		}
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}


		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		$dealer = str_replace('-', ',', $name);
		if( empty($date_range)){
			if(empty($dealer))
			{				
				$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.vehicle_no FROM view_report_service_counter_sales r WHERE r.bill_type = 'counter'";
			}
			else
			{
				$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.vehicle_no FROM view_report_service_counter_sales r WHERE ((r.dealer_id IN ($dealer)) AND (r.bill_type = 'counter'))";
			}
			
			$rows = $this->db->query($query)->result();

		} else {
			$where = ($where != '')?"AND r.".$where:'';
			if(empty($dealer))
			{
						$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.payment_type,r.vehicle_no FROM view_report_service_counter_sales r 
				WHERE ((r.bill_type = 'counter') AND 
				(
					r.billing_issue_date >= ?
					AND r.billing_issue_date <= ?
				)) {$where}";
			}
			else
			{
					$query = "SELECT r.invoice_no,r.part_name,r.part_code,r.quantity,r.price,r.net_total as final_amount,r.discount,r.vat_amount,r.dealer_name,r.payment_type,r.vehicle_no FROM view_report_service_counter_sales r 
				WHERE 
				((r.bill_type = 'counter') AND (r.dealer_id IN ($dealer)) AND 
				(
					r.billing_issue_date >= ?
					AND r.billing_issue_date <= ?
				)) {$where}";
			}

		
			$rows = $this->db->query($query, $date_range)->result();
		}

		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Counter Sales Report From '.$start.' to '.$end)->getStyle("A2:I2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Invoice No');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Vehicle No');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Part Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Part Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Payment Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Quantity');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Discount');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','Taxes');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','Net Amount');
			

			$row = 5;
			$col = 0; 	
			$price = 0;       
			$gross_amount_total = 0;       
			$osw_paid_total = 0;       
			$ow_margin_total = 0;       
			$taxes_total = 0;       
			foreach($rows as $key => $values) 
			{        
				$price += $values->price;
				$gross_amount_total += $values->final_amount;
				$taxes_total += $values->vat_amount;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->invoice_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_code);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->payment_type);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->quantity);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->price);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->discount);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_amount);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
				

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':G'.$row)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':G'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$price);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,'');
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$taxes_total);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$gross_amount_total);


			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=counter_sales.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function sale_summary_excel_dump($start = 0 , $end = 0, $name = NULL){
		$start = str_replace("_","-",$start);	
		$date_range = array();

		if($start != 0 && $end != 0){
			$start_date =$start.' 00:00:00';
			$end_date =$end.' 23:59:59';
			$date_range = array($start_date,$end_date);
		}
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}


		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()  ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		$dealer = str_replace('-', ',', $name);
		if( empty($date_range)){
			if(empty($dealer))
			{
					$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
			}
			else
			{
						$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id WHERE (jc.dealer_id IN ($dealer)) GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
			}
			
			$rows = $this->db->query($query)->result();

		} else {

			$where = ($where != '')?"AND jc.".$where:'';
			if(empty($dealer))
			{
					$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id WHERE (br.issue_date >= ? AND br.issue_date <= ?) {$where} GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
			}
			else
			{
					$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id WHERE ((jc.dealer_id IN ($dealer)) AND (br.issue_date >= ? AND br.issue_date <= ?)) {$where} GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
			}

			
			$rows = $this->db->query($query, $date_range)->result();
		}

		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
		if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Sales Summary Report From '.$start.' to '.$end)->getStyle("A2:I2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Mechanic');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Service Advisor');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Total Jobs');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Total Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Vat Job');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Vat Part');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Cash Discount');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Grand Total');			

			$row = 5;
			$col = 0;

			$total_jobs = 0; 	
			$total_parts = 0; 	
			$total_vat_jobs = 0; 	
			$total_vat_parts = 0; 	
			$cash_discount = 0; 	
			$grand_total = 0; 	
			  
			foreach($rows as $key => $values) 
			{        
				$total_jobs += $values->total_jobs;
				$total_parts += $values->total_parts;
				$total_vat_jobs += $values->total_vat_jobs;
				$total_vat_parts += $values->total_vat_parts;
				$cash_discount += $values->cash_discount;
				$grand_total += $values->grand_total;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_jobs);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_parts);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_vat_jobs);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_vat_parts);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->cash_discount);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->grand_total);
				$col++;

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':C'.$row)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':C'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$total_jobs);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$total_parts);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$total_vat_jobs);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$total_vat_parts);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$cash_discount);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$grand_total);


			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=sales_summary.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	function mechanic_earning_detail($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$mechanic = $this->input->post('name');
			$post = explode(" - ", $post);
			// $mechanic = $this->input->post('mechanic_list');
			// print_r($mechanic);
			// exit();
			$date_range = array();

			if($this->input->post('selection')) {
				$post_date = $post[0].' 00:00:00';
				$post_date1= $post[1].' 23:59:59';
				$date_range = array($post_date,$post_date1);
			}
			


			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = '';
		
			}else{
				$where = "dealer_id = {$this->dealer_id}";
			}		
			if(empty($date_range)){
				// $this->job_card_model->_table = "view_report_service_mechanic_earning";

				// $this->db->where('dealer_id', $this->dealer_id);
				// $rows = $this->job_card_model->findAll($where);
				// $query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos,d.gross_amount,d.osw_paid,d.ow_margin,d.taxes,d.net as net_amount FROM view_mechanics_earning_final d  WHERE d.mechanics_id = $mechanic GROUP BY 1,2,3,4,5,6,7,8,9";
				$query = "SELECT d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid, d.chassis_no, d.billing_issue_date  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL";
				$rows = $this->db->query($query)->result();
				// echo $this->db->last_query();
				// exit();
				

			} else {
				$where = ($where != '')?"AND d.".$where:'';

				$query = "SELECT d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid,  d.chassis_no, d.billing_issue_date  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL and (d.mechanics_id = $mechanic AND (d.billing_issue_date >= ? AND d.billing_issue_date <= ?))  {$where} ";

				// $query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos,d.gross_amount,d.osw_paid,d.ow_margin,d.taxes,d.net as net_amount FROM view_mechanic_earning_final d  WHERE (d.mechanics_id = $mechanic AND (d.job_card_issue_date >= ? AND d.job_card_issue_date <= ?))  {$where}  GROUP BY 1,2,3,4,5,6,7,8,9";
				// $query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT ) || (e.last_name) :: TEXT ) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.vat_job) AS vat_job, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, ((( SUM (bill.total_jobs) + SUM (bill.vat_job)) + (osw.ow_payment) :: DOUBLE PRECISION ) + osw.ow_margin ) AS net_amount FROM ((( view_employees e JOIN view_report_grouped_jobcard j ON ((j.mechanics_id = e JOIN ser_billing_record bill ON (( j.jobcard_group = bill.jobcard_group ))) LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, ( SUM (ow.billing_final_amount) - (SUM(ow.total_amount)) :: DOUBLE PRECISION ) AS ow_margin FROM ser_outside_work ow WHERE ( ow.billing_final_amount IS NOT NULL ) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id))) WHERE ((e.designation_id = 4) AND (e.employee_type = 2)) AND ( bill.issue_date >= ? AND bill.issue_date <= ? ) AND e.$where GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin;";


				$rows = $this->db->query($query, $date_range)->result();
			}

			// if(empty($date_range)){
			// 	// $this->job_card_model->_table = "view_report_service_mechanic_earning";

			// 	// $this->db->where('dealer_id', $this->dealer_id);
			// 	// $rows = $this->job_card_model->findAll($where);
			// 	// $query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos,d.gross_amount,d.osw_paid,d.ow_margin,d.taxes,d.net as net_amount FROM view_mechanics_earning_final d  WHERE d.mechanics_id = $mechanic GROUP BY 1,2,3,4,5,6,7,8,9";
			// 	$query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid, d.chassis_no, d.billing_issue_date, d.partprice, d.accessprice, d.oilprice, d.other, d.total_parts, d.vat_parts, d.final_amount  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL";
			// 	$rows = $this->db->query($query)->result();
			// 	// echo $this->db->last_query();
			// 	// exit();
				
			// } else {
			// 	$where = ($where != '')?"AND d.".$where:'';

			// 	$query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid,  d.chassis_no, d.billing_issue_date, d.partprice, d.accessprice, d.oilprice, d.other,d.total_parts, d.vat_parts, d.final_amount  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL and (d.mechanics_id = $mechanic AND (d.billing_issue_date >= ? AND d.billing_issue_date <= ?))  {$where} ";

			// 	// $query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos,d.gross_amount,d.osw_paid,d.ow_margin,d.taxes,d.net as net_amount FROM view_mechanic_earning_final d  WHERE (d.mechanics_id = $mechanic AND (d.job_card_issue_date >= ? AND d.job_card_issue_date <= ?))  {$where}  GROUP BY 1,2,3,4,5,6,7,8,9";
			// 	// $query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT ) || (e.last_name) :: TEXT ) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.vat_job) AS vat_job, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, ((( SUM (bill.total_jobs) + SUM (bill.vat_job)) + (osw.ow_payment) :: DOUBLE PRECISION ) + osw.ow_margin ) AS net_amount FROM ((( view_employees e JOIN view_report_grouped_jobcard j ON ((j.mechanics_id = e JOIN ser_billing_record bill ON (( j.jobcard_group = bill.jobcard_group ))) LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, ( SUM (ow.billing_final_amount) - (SUM(ow.total_amount)) :: DOUBLE PRECISION ) AS ow_margin FROM ser_outside_work ow WHERE ( ow.billing_final_amount IS NOT NULL ) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id))) WHERE ((e.designation_id = 4) AND (e.employee_type = 2)) AND ( bill.issue_date >= ? AND bill.issue_date <= ? ) AND e.$where GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin;";


			// 	$rows = $this->db->query($query, $date_range)->result();
			// }
				// echo $this->db->last_query();
				// exit();

			echo json_encode(array('rows'=>$rows));
			exit;
		
		}

		// Display Page
		$data['header'] = lang('mechanic_earning_detail');
		$data['page'] = $this->config->item('template_admin') . "mechanic_earning_detail";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}


	function dentpaintmechanic_earning_detail($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$mechanic = $this->input->post('name');
			$post = explode(" - ", $post);
			// $mechanic = $this->input->post('mechanic_list');
			// print_r($mechanic);
			// exit();
			$date_range = array();

			if($this->input->post('selection')) {
				
				
				$start_date = $post[0].' 00:00:00';
				$end_date = $post[1].' 23:59:59';
				$date_range = array($start_date,$end_date);
			}
			


			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = '';
		
			}else{
				$where = '"dealer_id = {$this->dealer_id}";';
			}		

			
			if(empty($date_range)){
				$query = "SELECT d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid, d.chassis_no, d.billing_issue_date  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL AND d.service_type = 1";
				$rows = $this->db->query($query)->result();

			} else {
				$where = ($where != '')?"AND d.".$where:'';

				$query = "SELECT d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid,  d.chassis_no, d.billing_issue_date  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL and (d.mechanics_id = $mechanic AND (d.billing_issue_date >= ? AND d.billing_issue_date <= ?))  {$where}  AND d.service_type = 1";


				$rows = $this->db->query($query, $date_range)->result();
			}
			
			// print_r($this->db->last_query());
			// exit;
			echo json_encode(array('rows'=>$rows));
			exit;
		
		}

		// Display Page
		$data['header'] = lang('mechanic_earning_detail');
		$data['page'] = $this->config->item('template_admin') . "dentpaintmechanic_earning_detail";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}

	public function dentpaintmechanic_earning_detail_excel_dump($start_date,$end_date,$mechanic)
	{
		$date_range = array();

			if($start_date != 0 && $end_date != 0) {
				$start = $start_date.' 00:00:00';
				$end = $end_date.' 23:59:59';
				$date_range = array($start,$end);
			}
		if(is_admin()){
				$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}
		

		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';
	
		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}		
		if(empty($date_range)){
			$query = "SELECT d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid , d.chassis_no FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL  AND d.service_type = 1";
			$rows = $this->db->query($query)->result();

		} else {
			$where = ($where != '')?"AND d.".$where:'';

			$query = "SELECT d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid , d.chassis_no FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL and (d.mechanics_id = $mechanic AND (d.billing_issue_date >= ? AND d.billing_issue_date <=  ?))  {$where}  AND d.service_type = 1";
			$rows = $this->db->query($query,$date_range)->result();
		}

		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Job Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Jobcard No');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Job Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Vehicle No');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Labout Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','OW Payment');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','OW Margin');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','Taxes');
			$objPHPExcel->getActiveSheet()->SetCellValue('L4','Net Amount');
			

			$row = 3;
			$col = 0; 

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Date From');
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $start_date);
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Date To');
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $end_date);
				$col++;

			$row = 5;
			$col = 0; 	
			$gross_total = 0;       
			$gross_amount_total = 0;       
			$osw_paid_total = 0;       
			$ow_margin_total = 0;       
			$taxes_total = 0;       
			foreach($rows as $key => $values) 
			{        
				$gross_total += $values->net_amount;
				$gross_amount_total += $values->gross_amount;
				$osw_paid_total += $values->osw_paid;
				$ow_margin_total += $values->ow_margin;
				$taxes_total += $values->taxes;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_code);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_description);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_nos);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->gross_amount);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->osw_paid);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_margin);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->taxes);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_amount);
				

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total');
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
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
			$col++;

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $gross_amount_total);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $osw_paid_total);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ow_margin_total);
			$col++;
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $taxes_total);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $gross_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=dent_paint_mechaniseeise_earning_detail.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}



	public function mechanic_detail_dump($start_date,$end_date,$mechanic)
	{
		$date_range = array();

			if($start_date != 0 && $end_date != 0) {
				$start =$start_date.' 00:00:00';
				$end =$end_date.' 23:59:59';
				
				$date_range = array($start,$end);
			}
		if(is_admin()){
				$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}
		

		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';
	
		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}		
		if(empty($date_range)){
			$query = "SELECT  d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid , d.chassis_no FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL";
			$rows = $this->db->query($query)->result();

		} else {
			$where = ($where != '')?"AND d.".$where:'';

			$query = "SELECT  d.dealer_name,d.mechanic_name,d.jobcard_serial,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid , d.chassis_no FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL and (d.mechanics_id = $mechanic AND (d.billing_issue_date >= ? AND d.billing_issue_date <=  ?))  {$where}";
			$rows = $this->db->query($query,$date_range)->result();
		}

		// if(empty($date_range)){
		// 	// $this->job_card_model->_table = "view_report_service_mechanic_earning";

		// 	// $this->db->where('dealer_id', $this->dealer_id);
		// 	// $rows = $this->job_card_model->findAll($where);
		// 	// $query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos,d.gross_amount,d.osw_paid,d.ow_margin,d.taxes,d.net as net_amount FROM view_mechanics_earning_final d  WHERE d.mechanics_id = $mechanic GROUP BY 1,2,3,4,5,6,7,8,9";
		// 	$query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid, d.chassis_no, d.billing_issue_date, d.partprice, d.accessprice, d.oilprice, d.other, d.total_parts, d.vat_parts, d.final_amount  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL";
		// 	$rows = $this->db->query($query)->result();
		// 	// echo $this->db->last_query();
		// 	// exit();
			
		// } else {
		// 	$where = ($where != '')?"AND d.".$where:'';

		// 	$query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos, d.taxes,d.net_total as net_amount, d.outsidework_margin as ow_margin, d.job_final_amount as gross_amount, d.ow_final_amount  as  osw_paid,  d.chassis_no, d.billing_issue_date, d.partprice, d.accessprice, d.oilprice, d.other,d.total_parts, d.vat_parts, d.final_amount  FROM view_mechanic_earning_final d  WHERE d.mechanics_id = $mechanic and d.invoice_no IS NOT NULL and (d.mechanics_id = $mechanic AND (d.billing_issue_date >= ? AND d.billing_issue_date <= ?))  {$where} ";

		// 	// $query = "SELECT d.mechanic_name,d.job_code,d.description as job_description,d.vehicle_no as vehicle_nos,d.gross_amount,d.osw_paid,d.ow_margin,d.taxes,d.net as net_amount FROM view_mechanic_earning_final d  WHERE (d.mechanics_id = $mechanic AND (d.job_card_issue_date >= ? AND d.job_card_issue_date <= ?))  {$where}  GROUP BY 1,2,3,4,5,6,7,8,9";
		// 	// $query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT ) || (e.last_name) :: TEXT ) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.vat_job) AS vat_job, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, ((( SUM (bill.total_jobs) + SUM (bill.vat_job)) + (osw.ow_payment) :: DOUBLE PRECISION ) + osw.ow_margin ) AS net_amount FROM ((( view_employees e JOIN view_report_grouped_jobcard j ON ((j.mechanics_id = e JOIN ser_billing_record bill ON (( j.jobcard_group = bill.jobcard_group ))) LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, ( SUM (ow.billing_final_amount) - (SUM(ow.total_amount)) :: DOUBLE PRECISION ) AS ow_margin FROM ser_outside_work ow WHERE ( ow.billing_final_amount IS NOT NULL ) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id))) WHERE ((e.designation_id = 4) AND (e.employee_type = 2)) AND ( bill.issue_date >= ? AND bill.issue_date <= ? ) AND e.$where GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin;";


		// 	$rows = $this->db->query($query, $date_range)->result();
		// }

		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Jobcard No');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Job Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Job Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Vehicle No');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Labout Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','OW Payment');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','OW Margin');
			// $objPHPExcel->getActiveSheet()->SetCellValue('I4','Parts');
			// $objPHPExcel->getActiveSheet()->SetCellValue('J4','Lube');
			// $objPHPExcel->getActiveSheet()->SetCellValue('K4','Accessories');
			// $objPHPExcel->getActiveSheet()->SetCellValue('L4','Others');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','VAT');
			$objPHPExcel->getActiveSheet()->SetCellValue('L4','Net Amount');
			

			$row = 3;
			$col = 0; 

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Date From');
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $start_date);
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Date To');
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $end_date);
				$col++;

			$row = 5;
			$col = 0; 	
			$gross_total = 0;       
			$gross_amount_total = 0;       
			$osw_paid_total = 0;       
			$ow_margin_total = 0;       
			$taxes_total = 0;   
			$partprice_total = 0;
			$oilprice_total = 0;
			$accessprice_total = 0;
			$other_total = 0;    
			foreach($rows as $key => $values) 
			{        
				$gross_total += $values->net_amount;
				$gross_amount_total += $values->gross_amount;
				$osw_paid_total += $values->osw_paid;
				$ow_margin_total += $values->ow_margin;
				$taxes_total += $values->taxes ;
				// $partprice_total += $values->partprice;
				// $oilprice_total += $values->oilprice;
				// $accessprice_total += $values->accessprice;
				// $other_total += $values->other;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_code);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_description);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_nos);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->gross_amount);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->osw_paid);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_margin);
				$col++;
				
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->partprice);
				// $col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->oilprice);
				// $col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessprice);
				// $col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				// $col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->taxes);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_amount);
				

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total');
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
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $gross_amount_total);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $osw_paid_total);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $ow_margin_total);
			$col++;
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $partprice_total);
			// $col++;
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $oilprice_total);
			// $col++;
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $accessprice_total);
			// $col++;
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $other_total);
			// $col++;
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $taxes_total);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $gross_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=mechanic_earning_detail.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	function labour_register($json = NULL) {
		if($json == 'json') {
			// print_r($this->input->get('selection'));
			// print_r("expression");
			// exit();
			$post = $this->input->get('selection');
			$dealerName = $this->input->get('name');
			$dealer = str_replace('-', ',', $dealerName);
			$post = explode(" - ", $post);
			$date_range = array();

			$is_admin = (is_admin())?TRUE:FALSE;
			$is_service_advisor = (is_service_advisor())?TRUE:FALSE;
			$is_accountant = (is_accountant())?TRUE:FALSE;
			$sparepart_executive = (is_group(SPAREPART_EXECUTIVE))?TRUE:FALSE;
			$is_floor_supervisor = (is_floor_supervisor())?TRUE:FALSE;
			$is_service_head = (is_service_head())?TRUE:FALSE;
			$is_national_service_manager = (is_national_service_manager())?TRUE:FALSE;
			$is_ccd_incharge = (is_ccd_incharge())?TRUE:FALSE;
			$is_admin = (is_admin())?TRUE:FALSE;


			$this->job_card_model->_table = "view_labours_register";
			// print_r(search_params()); exit;

			if($this->input->get('selection')) {
				$start_date = $post[0].' 00:00:00';
				$end_date = $post[1].' 23:59:59';
				
				$this->db->where('invoice_date >=',$start_date);
				$this->db->where('invoice_date <=',$end_date);
				// $date_range = array($post[0],$post[1],);
			}

			if($this->input->get('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}

			if($is_admin){
				$where = '';
			}else if($is_service_advisor || $is_accountant ) {
				if( !$sparepart_executive  || $is_accountant  ){
					// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				}
			} else if($is_floor_supervisor){
				// $where['dealer_id'] = $this->dealer_id;
				$this->db->where('dealer_id',$this->dealer_id);

			} else if(( $is_service_head || $is_national_service_manager) || $is_admin || $is_ccd_incharge  ){
				$where = '';
		
			}else{
				// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				
			}

			// echo $this->db->last_query(); exit;
			search_params();
			$total=$this->job_card_model->find_count();
			
			paging('invoice_date');

			if($this->input->get('selection')) {
				// print_r("expression");
				// exit();
				$this->db->where('invoice_date >=',$post[0]);
				$this->db->where('invoice_date <=',$post[1]);
				// $date_range = array($post[0],$post[1],);
			}


			if($this->input->get('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}
			if($is_admin){
				$where = '';
			}else if($is_service_advisor || $is_accountant ) {
				if( !$sparepart_executive  || $is_accountant  ){
					// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				}
			} else if($is_floor_supervisor){
				// $where['dealer_id'] = $this->dealer_id;
				$this->db->where('dealer_id',$this->dealer_id);

			} else if( ($is_service_head || $is_national_service_manager) || $is_admin ){
				$where = '';
		
			}else{
				// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				
			}
			
			search_params();
			$rows=$this->job_card_model->findAll();
			// echo $this->db->last_query(); exit;
			
			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;
			// if( empty($date_range)){
			// 	// $this->job_card_model->_table = "view_report_service_counter_sales";
			// 	$query = "SELECT concat(l.first_name,' ',l.middle_name,' ',l.last_name) as mechanic_name,l.job_description,l.invoice_date,l.invoice_no,l.job,l.gross_amount,l.ow_paid as osw_paid,l.ow_margin as osw_margin,l.taxes,l.net FROM view_labours_register l GROUP BY 1,2,3,4,5,6,7,8,9,10";

			// 	// $this->db->where('dealer_id', $this->dealer_id);
			// 	$rows = $this->db->query($query)->result();

			// } else {
			// 	$where = ($where != '')?"AND l.".$where:'';

			// 	$query = " SELECT concat(l.first_name,' ',l.middle_name,' ',l.last_name) as mechanic_name,l.job_description,l.invoice_date,l.invoice_no,l.job,l.gross_amount,l.ow_paid,l.ow_margin,l.taxes,l.net FROM view_labours_register l WHERE 
			// 	(
			// 		l.job_card_issue_date >= ?
			// 		AND l.job_card_issue_date <= ?
			// 	) {$where} GROUP BY 1,2,3,4,5,6,7,8,9,10";

			// 	$rows = $this->db->query($query, $date_range)->result();
			// }
			
			// echo json_encode(array('rows'=>$rows));
			// exit;
			
		}

		// Display Page
		$data['header'] = lang('labour_register');
		$data['page'] = $this->config->item('template_admin') . "labour_register";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}


	// function labour_register($json = NULL) {
	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$date_range = array($post[0],$post[1],);
	// 		}

			

	// 		if(is_admin()){
	// 			$where = '';
	// 		}else if( is_service_advisor() || is_accountant() ) {
	// 			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 				$where = "dealer_id = {$this->dealer_id}";
	// 			}
			

	// 		} else if(is_floor_supervisor()){
	// 			$where['dealer_id'] = $this->dealer_id;
	// 		} else if( is_service_head() || is_national_service_manager() || is_admin() ){
	// 			$where = '';
		
	// 		}else{
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}
	// 		if( empty($date_range)){
	// 			// $this->job_card_model->_table = "view_report_service_counter_sales";
	// 			$query = "SELECT concat(l.first_name,' ',l.middle_name,' ',l.last_name) as mechanic_name,l.job_description,l.invoice_date,l.invoice_no,l.job,l.gross_amount,l.ow_paid as osw_paid,l.ow_margin as osw_margin,l.taxes,l.net FROM view_labours_register l GROUP BY 1,2,3,4,5,6,7,8,9,10";

	// 			// $this->db->where('dealer_id', $this->dealer_id);
	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			$where = ($where != '')?"AND l.".$where:'';

	// 			$query = " SELECT concat(l.first_name,' ',l.middle_name,' ',l.last_name) as mechanic_name,l.job_description,l.invoice_date,l.invoice_no,l.job,l.gross_amount,l.ow_paid,l.ow_margin,l.taxes,l.net FROM view_labours_register l WHERE 
	// (
	// 	l.job_card_issue_date >= ?
	// 	AND l.job_card_issue_date <= ?
	// ) {$where} GROUP BY 1,2,3,4,5,6,7,8,9,10";

	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
			
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
			
	// 	}

	// 	// Display Page
	// 	$data['header'] = lang('labour_register');
	// 	$data['page'] = $this->config->item('template_admin') . "labour_register";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);	
	// }

	// function sales_summary($json = NULL) {
	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$date_range = array($post[0],$post[1],);
	// 		}

	// 		if(is_admin()){
	// 			$where = '';
	// 		}else{
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}

	// 		if( empty($date_range)){
	// 			$this->job_card_model->_table = "view_report_service_sales_summary";
	// 			// $this->db->where('dealer_id', $this->dealer_id);
	// 			$rows = $this->job_card_model->findAll($where);

	// 		} else {
	// 			$where = ($where != '')?"AND jcards.".$where:'';

	// 			$query = "SELECT sparepart.category_id, s_category. NAME AS category_name, SUM (jparts.quantity) AS quantity, (SUM((((jparts.price * jparts.quantity) * jparts.discount_percentage) / 100))) :: DOUBLE PRECISION AS discount_amount, SUM ((jparts.price * jparts.quantity)) AS taxable, SUM (jparts.cash_discount) AS cash_discount, SUM ((jparts.final_amount *(0.13) :: DOUBLE PRECISION)) AS vat_amount, SUM (COALESCE(unwar.uw_amount,(0) :: REAL)) AS uw_amount, (((SUM((jparts.price * jparts.quantity))) :: DOUBLE PRECISION + COALESCE (SUM((jparts.final_amount *(0.13) :: DOUBLE PRECISION)),(0) :: DOUBLE PRECISION)) - COALESCE (SUM(unwar.uw_amount),(0) :: REAL)) AS net_amount, jcards.deleted_at, jcards.dealer_id, jcards.job_card_issue_date FROM (((( view_report_grouped_jobcard jcards JOIN ser_parts jparts ON ((jparts.jobcard_group = jcards.jobcard_serial))) JOIN mst_spareparts sparepart ON ((jparts.part_id = sparepart. ID))) JOIN mst_spareparts_category s_category ON ((sparepart.category_id = s_category. ID))) LEFT JOIN ( SELECT sp.category_id, pa.warranty, SUM (pa.final_amount) AS uw_amount FROM ((ser_parts pa JOIN mst_spareparts sp ON((pa.part_id = sp. ID))) JOIN mst_spareparts_category cat ON ((sp.category_id = cat. ID))) WHERE (pa.warranty IS NOT NULL) GROUP BY pa.warranty, sp.category_id ) unwar ON ((unwar.category_id = sparepart.category_id))) WHERE (((jparts.bill_id IS NULL) AND(jparts.estimate_id IS NULL)) AND(jparts.warranty IS NULL)) AND (jcards.job_card_issue_date BETWEEN ? AND ?) {$where} GROUP BY sparepart.category_id, s_category. NAME, jcards.deleted_at, jcards.dealer_id, jcards.job_card_issue_date;";

	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
			
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
	// 	}
		
	// 	// Display Page
	// 	$data['header'] = lang('sales_summary');
	// 	$data['page'] = $this->config->item('template_admin') . "sales_summary";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);	

	// }

function sales_summary($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$start_date =$post[0].' 00:00:00';
					$end_date =$post[1].' 23:59:59';
					$date_range = array($start_date,$end_date);
			}

			

			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "jc.dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "jc.dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = '';
		
			}else{
				$where = "jc.dealer_id = {$this->dealer_id}";
			}

			if( empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
				}
				else
				{
					
					$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id WHERE (jc.dealer_id IN ($dealer)) GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
				}
				
				
				$rows = $this->db->query($query)->result();
			// 	echo $this->db->last_query();
			// exit();

			} else {

				$where = ($where != '')?"AND ".$where:'';
				if(empty($dealer))
				{
						$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id WHERE (br.issue_date >= ? AND br.issue_date <= ?) {$where} GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
				}
				else
				{
						$query = "SELECT jc.dealer_name,jc.service_advisor_name,CONCAT(swu.first_name,' ',swu.middle_name,' ',swu.last_name) as mechanic_name, SUM(br.total_parts) as total_parts, SUM(br.total_jobs) as total_jobs, SUM(br.cash_discount_amt) as cash_discount, SUM(br.vat_job) as total_vat_jobs, SUM(br.vat_parts) as total_vat_parts, SUM(br.net_total) as grand_total FROM view_report_grouped_jobcard AS jc LEFT JOIN ser_billing_record AS br ON jc.jobcard_group = br.jobcard_group LEFT JOIN view_ser_workshop_users AS swu ON jc.mechanics_id = swu.id WHERE ((jc.dealer_id IN($dealer)) AND (br.issue_date >= ? AND br.issue_date <= ?)) {$where} GROUP BY jc.dealer_name,jc.service_advisor_name,swu.first_name,swu.middle_name,swu.last_name";
				}
				
			
				$rows = $this->db->query($query, $date_range)->result();
				// $this->job_card_model->_table = "view_sales_summary";
				
				// $this->db->where("job_card_issue_date BETWEEN  '$date_range[0]' AND  '$date_range[1]'");
				// $rows = $this->job_card_model->findAll($where);
				// print_r($this->db->last_query());
				// exit;
				// $where = ($where != '')?"AND jcards.".$where:'';
				// $query = "SELECT sparepart.category_id, s_category. NAME AS category_name, SUM (jparts.quantity) AS quantity, (SUM((((jparts.price * jparts.quantity) * jparts.discount_percentage) / 100))) :: DOUBLE PRECISION AS discount_amount, SUM ((jparts.price * jparts.quantity)) AS taxable, SUM (jparts.cash_discount) AS cash_discount, SUM ((jparts.final_amount *(0.13) :: DOUBLE PRECISION)) AS vat_amount, SUM (COALESCE(unwar.uw_amount,(0) :: REAL)) AS uw_amount, (((SUM((jparts.price * jparts.quantity))) :: DOUBLE PRECISION + COALESCE (SUM((jparts.final_amount *(0.13) :: DOUBLE PRECISION)),(0) :: DOUBLE PRECISION)) - COALESCE (SUM(unwar.uw_amount),(0) :: REAL)) AS net_amount, jcards.deleted_at, jcards.dealer_id, jcards.job_card_issue_date FROM (((( view_report_grouped_jobcard jcards JOIN ser_parts jparts ON ((jparts.jobcard_group = jcards.jobcard_serial))) JOIN mst_spareparts sparepart ON ((jparts.part_id = sparepart. ID))) JOIN mst_spareparts_category s_category ON ((sparepart.category_id = s_category. ID))) LEFT JOIN ( SELECT sp.category_id, pa.warranty, SUM (pa.final_amount) AS uw_amount FROM ((ser_parts pa JOIN mst_spareparts sp ON((pa.part_id = sp. ID))) JOIN mst_spareparts_category cat ON ((sp.category_id = cat. ID))) WHERE (pa.warranty IS NOT NULL) GROUP BY pa.warranty, sp.category_id ) unwar ON ((unwar.category_id = sparepart.category_id))) WHERE (((jparts.bill_id IS NULL) AND(jparts.estimate_id IS NULL)) AND(jparts.warranty IS NULL)) AND (jcards.job_card_issue_date BETWEEN ? AND ?) {$where} GROUP BY sparepart.category_id, s_category. NAME, jcards.deleted_at, jcards.dealer_id, jcards.job_card_issue_date;";

				// $rows = $this->db->query($query, $date_range)->result();
			}

			echo json_encode(array('rows'=>$rows));
			exit;
		}
		
		// Display Page
		$data['header'] = lang('sales_summary');
		$data['page'] = $this->config->item('template_admin') . "sales_summary";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	

	}

	// function dent_paint($json = NULL) {
	// 	if($json == 'json') {

	// 		$post = $this->input->post('selection');
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$date_range = array($post[0],$post[1],);
	// 		}
	// 		if(is_admin()){
	// 			$where = array();
	// 		}else{
	// 			$dealer_id = $this->dealer_id;
	// 			$where['dealer_id'] = $dealer_id;
	// 		}

			// if( empty($date_range)){
			// $this->job_card_model->_table = "view_report_service_dent_paint";
			// $rows = $this->job_card_model->findAll();

			/*} else {
				$query = " SELECT sp.category_id, c.name AS category_name, sum(cparts.quantity) AS quantity, (sum((((cparts.price * cparts.quantity) * cparts.discount_percentage) / 100)))::double precision AS discount_amount, sum((cparts.price * cparts.quantity)) AS taxable, sum(cparts.cash_discount) AS cash_discount, sum((cparts.final_amount * (0.13)::double precision)) AS taxes, sum(COALESCE(unwar.uw_amount, (0)::real)) AS uw_amount, (((sum((cparts.price * cparts.quantity)))::double precision + sum((cparts.final_amount * (0.13)::double precision))) - sum(COALESCE(unwar.uw_amount, (0)::real))) AS net_amount, csales.deleted_at FROM (((((ser_counter_sales csales JOIN ser_parts cparts ON ((cparts.bill_id = csales.id))) JOIN ser_billing_record cbills ON ((csales.billing_record_id = cbills.id))) JOIN mst_spareparts sp ON ((cparts.part_id = sp.id))) JOIN mst_spareparts_category c ON ((sp.category_id = c.id))) LEFT JOIN ( SELECT sp_1.category_id, pa.warranty, sum(pa.final_amount) AS uw_amount FROM ((ser_parts pa JOIN mst_spareparts sp_1 ON ((pa.part_id = sp_1.id))) JOIN mst_spareparts_category cat ON ((sp_1.category_id = cat.id))) WHERE (pa.warranty IS NOT NULL) GROUP BY pa.warranty, sp_1.category_id) unwar ON ((unwar.category_id = sp.category_id))) WHERE ((((cparts.bill_id IS NOT NULL) AND (cparts.estimate_id IS NULL)) AND (cparts.warranty IS NULL)) AND (cparts.jobcard_group IS NULL) and (csales.date_time between ? and ?)) and ( 'deleted_at' IS NULL) GROUP BY sp.category_id, c.name, csales.deleted_at;";

				$rows = $this->db->query($query, $date_range)->result();
			}*/
			
		// 	echo json_encode(array('rows'=>$rows));
		// 	exit;
			
		// }

		// Display Page
	// 	$data['header'] = lang('dent_paint');
	// 	$data['page'] = $this->config->item('template_admin') . "dent_paint";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);	
	// }


// function dent_paint($json = NULL) {
// 		if($json == 'json') {
 
// 			$post = $this->input->post('selection');
// 			$dealer = $this->input->post('name');
// 			$post = explode(" - ", $post);
// 			$date_range = array();

// 			if($this->input->post('selection')) {
// 				$date_range = array($post[0],$post[1],);
// 			}
			

// 			if(is_admin()){
// 				$where = '';
// 			}else if( is_service_advisor() || is_accountant() ) {
// 				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
// 					$where = "dealer_id = {$this->dealer_id}";
// 				}
			

// 			} else if(is_floor_supervisor()){
// 				$where['dealer_id'] = $this->dealer_id;
// 			} else if( is_service_head() || is_national_service_manager() || is_admin() ){
// 				$where = '';
		
// 			}else{
// 				$where = "dealer_id = {$this->dealer_id}";
// 			}
// 			if( empty($date_range)){
// 				if(empty($dealer))
// 				{
// 					$query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT) ||(e.last_name) :: TEXT) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.total_parts) AS parts,SUM (bill.vat_job) AS vat_job,SUM (bill.vat_parts) AS vat_parts, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, SUM (COALESCE(bill.total_jobs,0)) + SUM (COALESCE(bill.vat_job,0)) + SUM (COALESCE(bill.total_parts,0)) + SUM (COALESCE(bill.vat_parts,0))+ COALESCE (osw.ow_payment, 0) + COALESCE (osw.ow_margin, 0) AS net_amount, j.dealer_id,j.service_advisor_name FROM view_ser_workshop_users e JOIN view_report_grouped_jobcard j ON j.mechanics_id = e. ID JOIN ser_billing_record bill ON j.jobcard_group = bill.jobcard_group LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, (SUM(ow.billing_final_amount) -(SUM(ow.total_amount)) :: DOUBLE PRECISION) AS ow_margin FROM ser_outside_work ow WHERE (ow.billing_final_amount IS NOT NULL)  GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id))  GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, j.dealer_id,j.service_advisor_name";

// 				}
// 				else
// 				{
// 					$query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT) ||(e.last_name) :: TEXT) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.total_parts) AS parts,SUM (bill.vat_job) AS vat_job,SUM (bill.vat_parts) AS vat_parts, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, SUM (COALESCE(bill.total_jobs,0)) + SUM (COALESCE(bill.vat_job,0)) + SUM (COALESCE(bill.total_parts,0)) + SUM (COALESCE(bill.vat_parts,0))+ COALESCE (osw.ow_payment, 0) + COALESCE (osw.ow_margin, 0) AS net_amount, j.dealer_id,j.service_advisor_name FROM view_ser_workshop_users e JOIN view_report_grouped_jobcard j ON j.mechanics_id = e. ID JOIN ser_billing_record bill ON j.jobcard_group = bill.jobcard_group LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, (SUM(ow.billing_final_amount) -(SUM(ow.total_amount)) :: DOUBLE PRECISION) AS ow_margin FROM ser_outside_work ow WHERE (ow.billing_final_amount IS NOT NULL) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id)) WHERE (j.dealer_id = $dealer) AND j.service_type = 1 GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, j.dealer_id,j.service_advisor_name";

// 				}
				
// 				$rows = $this->db->query($query)->result();

// 			} else {
// 				$where = ($where != '')?"AND j.".$where:'';
// 				if(empty($dealer))
// 				{
// 						$query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT) ||(e.last_name) :: TEXT) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs,SUM (bill.total_parts) AS parts, SUM (bill.vat_job) AS vat_job,SUM (bill.vat_parts) AS vat_parts, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, SUM (COALESCE(bill.total_jobs,0)) + SUM (COALESCE(bill.vat_job,0)) + SUM (COALESCE(bill.total_parts,0)) + SUM (COALESCE(bill.vat_parts,0))+ COALESCE (osw.ow_payment, 0) + COALESCE (osw.ow_margin, 0) AS net_amount, j.dealer_id,j.service_advisor_name FROM view_ser_workshop_users e JOIN view_report_grouped_jobcard j ON j.mechanics_id = e. ID JOIN ser_billing_record bill ON j.jobcard_group = bill.jobcard_group LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, (SUM(ow.billing_final_amount) -(SUM(ow.total_amount)) :: DOUBLE PRECISION) AS ow_margin FROM ser_outside_work ow WHERE (ow.billing_final_amount IS NOT NULL) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id)) WHERE (bill.issue_date >= ? AND bill.issue_date <= ?)  {$where} AND j.service_type = 1 GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, j.dealer_id,j.service_advisor_name";

// 				}
// 				else
// 				{
// 						$query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT) ||(e.last_name) :: TEXT) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs,SUM (bill.total_parts) AS parts, SUM (bill.vat_job) AS vat_job,SUM (bill.vat_parts) AS vat_parts, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, SUM (COALESCE(bill.total_jobs,0)) + SUM (COALESCE(bill.vat_job,0)) + SUM (COALESCE(bill.total_parts,0)) + SUM (COALESCE(bill.vat_parts,0))+ COALESCE (osw.ow_payment, 0) + COALESCE (osw.ow_margin, 0) AS net_amount, j.dealer_id,j.service_advisor_name FROM view_ser_workshop_users e JOIN view_report_grouped_jobcard j ON j.mechanics_id = e. ID JOIN ser_billing_record bill ON j.jobcard_group = bill.jobcard_group LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, (SUM(ow.billing_final_amount) -(SUM(ow.total_amount)) :: DOUBLE PRECISION) AS ow_margin FROM ser_outside_work ow WHERE (ow.billing_final_amount IS NOT NULL) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id)) WHERE ((j.dealer_id = $dealer) AND (bill.issue_date >= ? AND bill.issue_date <= ?))  {$where} AND j.service_type = 1 GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, j.dealer_id,j.service_advisor_name";

// 				}
			
// 				$rows = $this->db->query($query, $date_range)->result();
// 			}
// 			// echo $this->db->last_query();  exit;
// 			echo json_encode(array('rows'=>$rows));
// 			exit;
			
// 		}



// 		// Display Page
// 		$data['header'] = lang('dent_paint');
// 		$data['page'] = $this->config->item('template_admin') . "dent_paint";
// 		$data['module'] = 'service_reports';
// 		$this->load->view($this->_container,$data);	
// 	}




	// function dent_paint($json = NULL) {
	// 	if($json == 'json') {
 
	// 		$post = $this->input->post('selection');
	// 		if($this->input->post('name')){
	// 			$dealerName = $this->input->post('name');
	// 			$dealer = str_replace('-', ',', $dealerName);
	// 		}else{
	// 			// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
	// 			 $dealer = $this->dealer_id;	
	// 		}
	// 		$post = explode(" - ", $post);
	// 		$date_range = array();

	// 		if($this->input->post('selection')) {
	// 			$post_date =$post[0].' 00:00:00';
	// 			$post_date1 =$post[1].' 23:59:59';
	// 			$date_range = array($post_date,$post_date1,);
	// 		}
			

	// 		if(is_admin()){
	// 			$where = '';
	// 		}else if( is_service_advisor() || is_accountant() ) {
	// 			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 				$where = "dealer_id = {$this->dealer_id}";
	// 			}
			

	// 		} else if(is_floor_supervisor()){
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		} else if( is_service_head() || is_national_service_manager() || is_admin()  || is_ccd_incharge() || is_service_dealer_incharge()){
	// 			$where = '';
		
	// 		}else{
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}
	// 		if( empty($date_range)){
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 								jc.service_type = 1
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
	// 			else
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 								 jc.service_type = 1
	// 								AND jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
				
	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			$where = ($where != '')?"AND j.".$where:'';
	// 			if(empty($dealer))
	// 			{
	// 					$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 								jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 								AND jc.service_type = 1
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
	// 			else
	// 			{
	// 					$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_parts) AS parts,
	// 							SUM (tmp.vat_parts) AS vat_parts,
	// 							SUM (tmp.vat_job) AS vat_job,
	// 							SUM (tmp.vat_parts) + SUM (tmp.vat_job) AS vat,
	// 							SUM (tmp.total_in) AS jobs,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
	// 							(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 								AND jc.service_type = 1
	// 								AND jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";

	// 			}
			
	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}
	// 		// echo $this->db->last_query();  exit;
	// 		echo json_encode(array('rows'=>$rows));
	// 		exit;
			
	// 	}



	// 	// Display Page
	// 	$data['header'] = lang('dent_paint');
	// 	$data['page'] = $this->config->item('template_admin') . "dent_paint";
	// 	$data['module'] = 'service_reports';
	// 	$this->load->view($this->_container,$data);	
	// }		


	function dent_paint($json = NULL) {
		if($json == 'json') {
 
			$post = $this->input->post('selection');
			if($this->input->post('name')){
				$dealerName = $this->input->post('name');
				$dealer = str_replace('-', ',', $dealerName);
			}else{
				// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
				 $dealer = $this->dealer_id;	
			}
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$post_date =$post[0].' 00:00:00';
				$post_date1 =$post[1].' 23:59:59';
				$date_range = array($post_date,$post_date1,);
			}
			

			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin()  || is_ccd_incharge() || is_service_dealer_incharge()){
				$where = '';
		
			}else{
				$where = "dealer_id = {$this->dealer_id}";
			}
			if( empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local
								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id
									WHERE
									jc.service_type = 1
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
				else
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local
								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
									 jc.service_type = 1
									AND jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
				
				$rows = $this->db->query($query)->result();

			} else {
				$where = ($where != '')?"AND j.".$where:'';
				if(empty($dealer))
				{
						$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local

								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
									jc.issue_date >= ?
									AND jc.issue_date <= ?
									AND jc.service_type = 1
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
				else
				{
						$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_parts) AS parts,
								SUM (tmp.vat_parts) AS vat_parts,
								SUM (tmp.vat_job) AS vat_job,
								SUM (tmp.total_in) AS jobs,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								
								(COALESCE(SUM(tmp.total_parts),(0)::double precision)+ COALESCE(SUM(tmp.vat_parts),(0)::double precision)+COALESCE(SUM(tmp.vat_job),(0)::double precision)+COALESCE(SUM(tmp.total_in),(0)::double precision)+COALESCE(SUM(tmp.total_out),(0)::double precision)+COALESCE(SUM(tmp.ow_margin),(0)::double precision)) as net_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local

								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,b.total_parts,b.vat_parts,b.vat_job,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
										jc.issue_date >= ?
									AND jc.issue_date <= ?
									AND jc.service_type = 1
									AND jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";

				}
			
				$rows = $this->db->query($query, $date_range)->result();
			}
			// echo $this->db->last_query();  exit;
			echo json_encode(array('rows'=>$rows));
			exit;
			
		}



		// Display Page
		$data['header'] = lang('dent_paint');
		$data['page'] = $this->config->item('template_admin') . "dent_paint";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}



		function job_register($json = NULL) {
			if($json == 'json') {

			$post = $this->input->get('selection');
			$dealerName = $this->input->get('name');
			$dealer = str_replace('-', ',', $dealerName);
			$post = explode(" - ", $post);
			$date_range = array();

			$is_admin = (is_admin())?TRUE:FALSE;
			$is_service_advisor = (is_service_advisor())?TRUE:FALSE;
			$is_accountant = (is_accountant())?TRUE:FALSE;
			$sparepart_executive = (is_group(SPAREPART_EXECUTIVE))?TRUE:FALSE;
			$is_floor_supervisor = (is_floor_supervisor())?TRUE:FALSE;
			$is_service_head = (is_service_head())?TRUE:FALSE;
			$is_national_service_manager = (is_national_service_manager())?TRUE:FALSE;
			$is_ccd_incharge = (is_ccd_incharge())?TRUE:FALSE;
			$is_service_dealer_incharge = (is_service_dealer_incharge())?TRUE:FALSE;
			$is_admin = (is_admin())?TRUE:FALSE;


			$this->job_card_model->_table = "view_job_register";
			// print_r(search_params()); exit;

			if($this->input->get('selection')) {
				$start_date = $post[0].' 00:00:00';
				$end_date = $post[1].' 23:59:59';

				$this->db->where('issue_date >=',$start_date);
				$this->db->where('issue_date <=',$end_date);
				// $date_range = array($post[0],$post[1],);
			}

			if($this->input->get('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}

			if($is_admin){
				$where = '';
			}else if($is_service_advisor || $is_accountant ) {
				if( !$sparepart_executive  || $is_accountant  ){
					// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				}
			} else if($is_floor_supervisor){
				// $where['dealer_id'] = $this->dealer_id;
				$this->db->where('dealer_id',$this->dealer_id);

			} else if(( $is_service_head || $is_national_service_manager) || $is_admin || $is_ccd_incharge || $is_service_dealer_incharge){
				$where = '';
		
			}else{
				// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				
			}

			search_params();
			$total=$this->job_card_model->find_count();
			// echo $this->db->last_query(); exit;
			
			paging('issue_date');

			if($this->input->get('selection')) {
				$this->db->where('issue_date >=',$post[0]);
				$this->db->where('issue_date <=',$post[1]);
				// $date_range = array($post[0],$post[1],);
			}


			if($this->input->get('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}
			if($is_admin){
				$where = '';
			}else if($is_service_advisor || $is_accountant ) {
				if( !$sparepart_executive  || $is_accountant  ){
					// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				}
			} else if($is_floor_supervisor){
				// $where['dealer_id'] = $this->dealer_id;
				$this->db->where('dealer_id',$this->dealer_id);

			} else if( ($is_service_head || $is_national_service_manager) || $is_admin ){
				$where = '';
		
			}else{
				// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				
			}
			search_params();
			$rows=$this->job_card_model->findAll();
			
			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;
		}
		// Display Page
		$data['header'] = lang('job_register');
		$data['page'] = $this->config->item('template_admin') . "job_register";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}


// 	function mechanic_consume($json = NULL) {
// 		if($json == 'json') {

// 			$post = $this->input->post('selection');
// 			$post = explode(" - ", $post);
// 			$date_range = array();

// 			if($this->input->post('selection')) {
// 				$date_range = array($post[0],$post[1],);
// 			}

// 			// if( empty($date_range)){
// 			$rawQuery = "SELECT generate_crosstab_sql_plain ( $$ SELECT e. ID, e.mechanic_name, e.jobs, e.vat_job, e.ow_payment, e.ow_margin, e.ow_final_amount * 0.13 AS ow_tax, e.category_name, e.cat_amt FROM view_report_service_mechanic_consume_helper e GROUP BY 1, 2, 3, 4, 5, 6, 7, 8, 9 $$, $$ SELECT mst_spareparts_category. NAME FROM mst_spareparts_category $$, 'FLOAT', '\"id\" TEXT, \"mechanic_name\" TEXT, \"taxable\" FLOAT,\"taxes\" FLOAT, \"ow_payment\" FLOAT, \"ow_margin\" FLOAT, \"ow_tax\" FLOAT' ) AS sqlstring";

// 			$rawQuery = $this->db->query($rawQuery, $date_range)->row();

// 			$query = $rawQuery->sqlstring;

// 			$rows = $this->db->query($query)->result();
// 			/*} else {
// 			$this->job_card_model->_table = "view_report_service_dent_paint";
// 			$rows = $this->job_card_model->findAll();

// 		]}*/

// 		echo json_encode(array('rows'=>$rows));
// 		exit;

// 	}

// 		// Display Page
// 	$data['header'] = lang('mechanic_consume');
// 	$data['page'] = $this->config->item('template_admin') . "mechanic_consume";
// 	$data['module'] = 'service_reports';
// 	$this->load->view($this->_container,$data);	
// }

// 	function mechanic_consume($json = NULL) {
// 		if($json == 'json') {

// 			$post = $this->input->post('selection');
// 			$dealer = $this->input->post('name');
// 			// print_r($dealer);
// 			// exit();
// 			$post = explode(" - ", $post);
// 			$date_range = array();


// 			if($this->input->post('selection')) {
// 				$date_range = array($post[0],$post[1],);
// 			}			
				

// 			if(is_admin()){
// 			$where = '';
// 			}else if( is_service_advisor() || is_accountant() ) {
// 				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
// 					$where = "dealer_id = {$this->dealer_id}";
// 				}
			

// 			} else if(is_floor_supervisor()){
// 				$where = "dealer_id = {$this->dealer_id}";
// 			} else if( is_service_head() || is_national_service_manager() || is_admin() ){
// 				$where = '';
		
// 			}else{
// 				$where = "dealer_id = {$this->dealer_id}";
// 			}


// 			if( empty($date_range)){
// 				if(empty($dealer))
// 				{
// 						$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name, e.total_parts as taxable,e.final_amount AS ow_payment,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e GROUP BY 1, 2, 3, 4,5,6";

// 				}
// 				else
// 				{
// 					// print_r($dealer);
// 					// exit();
// 						$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name, e.total_parts as taxable,e.final_amount AS ow_payment,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e WHERE e.dealer_id = $dealer GROUP BY 1, 2, 3, 4,5,6";



// 				}
// 			$rows = $this->db->query($query)->result();
// 			}
// 			else
// 			{
// 				$where = ($where != '')?"AND e.".$where:'';
// 				if(empty($dealer))
// 				{
// 					$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name,e.final_amount AS ow_payment, e.total_parts as taxable,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e  WHERE 
// 	(
// 		e.issue_date >= ?
// 		AND e.issue_date <= ?
// 	) {$where}
// 	GROUP BY 1, 2, 3, 4,5,6
// ";
// 				}
// 				else
// 				{
// 					$query = "SELECT concat(e.first_name,' ',e.middle_name,' ',e.last_name) as mechanic_name,e.final_amount AS ow_payment, e.total_parts as taxable,e.final_amount * 0.13 AS ow_tax,e.vat_parts as taxes,e.part_code as spareparts FROM view_report_service_mechanic_consume_helper e  WHERE (e.dealer_id = $dealer AND (
// 	(
// 		e.issue_date >= ?
// 		AND e.issue_date <= ?
// 	)) {$where}
// 	GROUP BY 1, 2, 3, 4,5,6
// ";
// 				}
// 	$rows = $this->db->query($query,$date_range)->result();
// 			}

// 		echo json_encode(array('rows'=>$rows));
// 		exit;

// 	}

// 		// Display Page
// 	$data['header'] = lang('mechanic_consume');
// 	$data['page'] = $this->config->item('template_admin') . "mechanic_consume";
// 	$data['module'] = 'service_reports';
// 	$this->load->view($this->_container,$data);	
// }
	function mechanic_consume($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);
			$date_range = array();


			if($this->input->post('selection')) {
				$start_date =$post[0].' 00:00:00';
				$end_date =$post[1].' 23:59:59';
				$date_range = array($start_date,$end_date);
				
			}			
				

			if(is_admin()){
			$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
				$where = '';
		
			}else{
				$where = "dealer_id = {$this->dealer_id}";
			}


			if( empty($date_range)){
				if(empty($dealer))
				{
						$query = "SELECT * FROM view_mechanic_wise_part_consume_final";

				}
				else
				{
					// print_r($dealer);
					// exit();
						$query = "SELECT * FROM view_mechanic_wise_part_consume_final  WHERE dealer_id IN ($dealer) ";



				}
				$rows = $this->db->query($query)->result();
			}
			else
			{
				$where = ($where != '')?"AND ".$where:'';
				if(empty($dealer))
				{
					$query = "SELECT * FROM view_mechanic_wise_part_consume_final WHERE 
								(
									issue_date >= ?
									AND issue_date <= ?
								) {$where}
								
							";
				}
				else
				{
					$query = "SELECT * FROM view_mechanic_wise_part_consume_final WHERE dealer_id IN ($dealer) AND (
								(
									issue_date >= ?
									AND issue_date <= ?
								)) {$where}
								
							";	
				}
				$rows = $this->db->query($query,$date_range)->result();
			}
			// echo '<pre>'; print_r($rows); exit;
			// print_r($this->db->last_query());
			// exit;
			echo json_encode(array('rows'=>$rows));
			exit;

		}

		// Display Page
		$data['header'] = lang('mechanic_consume');
		$data['page'] = $this->config->item('template_admin') . "mechanic_consume";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}


	public function billing_summary()
	{
		// Display Page
		$data['header'] = 'Billing Summary';
		$data['page'] = $this->config->item('template_admin') . "billing_summary";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}



	public function get_billing_summary_json(){
		$where = NULL;

		if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where["dealer_id"] = $this->dealer_id;
			}
		} else if(is_floor_supervisor()){
			$where["dealer_id"] = $this->dealer_id;
			$where['floor_supervisor_id'] = $this->_user_id;
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){

		} else if( is_service_dealer_incharge() ) {
			$this->load->model('dealers/dealer_model');
			$dealers_of = $this->dealer_model->findAll(array('service_incharge_id' => $this->_user_id),'id');
			$dealers_list = null;
			foreach ($dealers_of as $key => $value) {
				$dealers_list[] = $value->id;
			}			

			$this->db->where_in('dealer_id', $dealers_list);
			unset($dealers_list);
		} else {
			$where["dealer_id"] = $this->dealer_id;
		}

		// print_r($this->input->get('date'));
		$dates = (explode(' - ', $this->input->get('date')));

		if(count($dates) > 1){
			$where["(issue_date >= '" . $dates[0] . " 00:00:00' AND issue_date <= '" . $dates[1] . " 23:59:59')"] = NULL;
		}else{
			$where["(issue_date >= '" . date('Y-m-d') . " 00:00:00' AND issue_date <= '" . date('Y-m-d') . " 23:59:59')"] = NULL;
		}
		// exit;


		// $date = ($this->input->get('date'))?$this->input->get('date'):date('Y-m-d');

		// $where['issues_date'] = $date;


		$dealerName = $this->input->get('name');
		$dealer = str_replace('-', ',', $dealerName);
		// print_r($dealerName); exit;
		$this->job_card_model->_table = 'view_service_billing_record';
		// $this->db->like('issue_date',$date);
		// paging('jobcard_group');
		search_params();
		if($this->input->get('name'))
		{
			$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
		}
		$total = $this->job_card_model->find_count($where);	


		paging('jobcard_group');
		search_params();
		if($this->input->get('name'))
		{
			$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
		}
		$rows = $this->job_card_model->findAll($where);
		// echo '<pre>'; echo $this->db->last_query(); print_r($rows); exit;
		echo json_encode(array('total'=>$total,'rows'=>$rows));

	}

	function jobcard_billing(){
		// Display Page

		
		$data['header'] = 'JobCard Billing';
		$data['page'] = $this->config->item('template_admin') . "jobbilling";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}


	function jobcard(){
				// Display Page
		$data['header'] = 'JobCard Details';
		$data['page'] = $this->config->item('template_admin') . "job";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}

	public function pdi_reports_dump($startdate=NULL,$enddate=NULL,$name=NULL){


		$startdate = str_replace("_","-",$startdate);	

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where['dealer_id'] = $this->dealer_id;
				}
			

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){
				$where = array();
		
			}else{
				$where['dealer_id'] = $this->dealer_id;
			}



			$this->db->where('service_type',8);
			if($startdate) {
				if($name)
				{
					$dealerName = str_replace('-', ',', $name);
					$this->db->where("dealer_id IN (".$dealerName.")",NULL, false);
					
				}
				$where['issue_date >='] = $startdate.' 00:00:00';
				$where['issue_date <='] = $enddate.' 23:59:59';

				$this->job_card_model->_table = "view_job_summary_refined";
				// $fields = 'job_card_issue_date,customer_name,engine_no,vehicle_name,vehicle_no,chassis_no,service_type_name,pdi_kms,year,service_advisor_name,mechanic_name,part_name,job_desc';
				
				$rows = $this->job_card_model->findAll($where);
			}else{
				if($name)
				{
					$dealerName = str_replace('-', ',', $name);
					$this->db->where("dealer_id IN (".$dealerName.")",NULL, false);
					
				}
				$this->job_card_model->_table = "view_job_summary_refined";
				// $fields = 'job_card_issue_date,customer_name,engine_no,vehicle_name,vehicle_no,chassis_no,service_type_name,pdi_kms,year,service_advisor_name,mechanic_name,part_name,job_desc';
				
				$rows = $this->job_card_model->findAll($where);
			}

		
		
		

		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin()||  is_ccd_incharge() || is_service_dealer_incharge()){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'PDI from '.$startdate.' to '.$enddate)->getStyle("A2:N2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');

			$objPHPExcel->getActiveSheet()->SetCellValue('A3','S.N.');
			$objPHPExcel->getActiveSheet()->SetCellValue('B3','Issue Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('C3','Service Advisor Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D3','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('E3','Mechanic Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('F3','Customer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('G3','Vehicle Reg. No');
			$objPHPExcel->getActiveSheet()->SetCellValue('H3','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('I3','Engine No');
			$objPHPExcel->getActiveSheet()->SetCellValue('J3','JobCard No');
			$objPHPExcel->getActiveSheet()->SetCellValue('K3','Vehicle');
			$objPHPExcel->getActiveSheet()->SetCellValue('L3','Year');
			$objPHPExcel->getActiveSheet()->SetCellValue('M3','KMS');
			$objPHPExcel->getActiveSheet()->SetCellValue('N3','Service Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('O3','Parts Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('P3','Job Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q3','Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('R3','Lube');
			$objPHPExcel->getActiveSheet()->SetCellValue('S3','Accessories');
			$objPHPExcel->getActiveSheet()->SetCellValue('T3','Local');
			$objPHPExcel->getActiveSheet()->SetCellValue('U3','Labour');
			$objPHPExcel->getActiveSheet()->SetCellValue('V3','Other');
			$objPHPExcel->getActiveSheet()->SetCellValue('W3','Discount');
			$objPHPExcel->getActiveSheet()->SetCellValue('X3','VAT');
			$objPHPExcel->getActiveSheet()->SetCellValue('Y3','Net Total');

			$row = 4;
			$col = 0;        
			foreach($rows as $key => $values) 
			{           
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->issue_date);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->customer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->engine_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->year);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->pdi_kms);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_desc);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->partprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->oilprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->localprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labourprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->cash_discount_amt);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_total);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_total);
				$col++;
				

				$col = 0;
				$row++;        
			}

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=pdi_reports.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect('service_reports/pdi_reports');
		
	}

public function foc_reports_dump($startdate=NULL,$enddate=NULL,$name=NULL){
			$startdate = str_replace("_","-",$startdate);	

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where['dealer_id'] = $this->dealer_id;
				}
			

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){
				$where = array();
		
			}else{
				$where['dealer_id'] = $this->dealer_id;
			}



			$this->db->where('service_type',4);
			if($startdate) {
				if($name)
				{
					$dealerName = str_replace('-', ',', $name);
					$this->db->where("dealer_id IN (".$dealerName.")",NULL, false);
				}
				$where['issue_date >='] = $startdate.' 00:00:00';
				$where['issue_date <='] = $enddate.' 23:59:59';

				$this->job_card_model->_table = "view_job_summary_refined";
				// $fields = 'job_card_issue_date,jobcard_serial,customer_name,engine_no,vehicle_name,vehicle_no,chassis_no,service_type_name,service_count,kms,year,dealer_name,mechanic_name,service_advisor_name,part_name,job_desc';
				
				$rows = $this->job_card_model->findAll($where,$fields);
			}else{
				if($name)
				{
					$dealerName = str_replace('-', ',', $name);
					$this->db->where("dealer_id IN (".$dealerName.")",NULL, false);
				}
				$this->job_card_model->_table = "view_job_summary_refined";
				// $fields = 'job_card_issue_date,jobcard_serial,customer_name,engine_no,vehicle_name,vehicle_no,chassis_no,service_type_name,service_count,kms,year,dealer_name,mechanic_name,service_advisor_name,part_name,job_desc';
				
				$rows = $this->job_card_model->findAll($where,$fields);
			}
			// print_r($rows);
			// exit();

		
		
		

		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'FOC from '.$startdate.' to '.$enddate)->getStyle("A2:N2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');

			$objPHPExcel->getActiveSheet()->SetCellValue('A3','S.N.');
			$objPHPExcel->getActiveSheet()->SetCellValue('B3','Dealer');
			$objPHPExcel->getActiveSheet()->SetCellValue('C3','Issue Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('D3','JobCard No');
			$objPHPExcel->getActiveSheet()->SetCellValue('E3','Service Advisor Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('F3','Mechanic Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('G3','Customer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('H3','Mobile No');
			$objPHPExcel->getActiveSheet()->SetCellValue('I3','Vehicle No');
			$objPHPExcel->getActiveSheet()->SetCellValue('J3','Engine No');
			$objPHPExcel->getActiveSheet()->SetCellValue('K3','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('L3','Year');
			$objPHPExcel->getActiveSheet()->SetCellValue('M3','Vehicle Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('N3','KMS');
			$objPHPExcel->getActiveSheet()->SetCellValue('O3','Service Type Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('P3','Service No');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q3','Parts Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('R3','Job Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('S3','Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('T3','Lube');
			$objPHPExcel->getActiveSheet()->SetCellValue('U3','Accessories');
			$objPHPExcel->getActiveSheet()->SetCellValue('V3','Local');
			$objPHPExcel->getActiveSheet()->SetCellValue('W3','Labour');
			$objPHPExcel->getActiveSheet()->SetCellValue('X3','Other');
			$objPHPExcel->getActiveSheet()->SetCellValue('Y3','Discount');
			$objPHPExcel->getActiveSheet()->SetCellValue('Z3','VAT');
			$objPHPExcel->getActiveSheet()->SetCellValue('AA3','Net Total');
			
			

			$row = 4;
			$col = 0;        
			foreach($rows as $key => $values) 
			{           
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_card_issue_date);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->customer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mobile);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->engine_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->year);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->kms);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_count);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_desc);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->partprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->oilprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->localprice);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labourprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->cash_discount_amt);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_total);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_total);
				$col++;
				

				$col = 0;
				$row++;        
			}

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=foc_reports.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect('service_reports/foc_reports');
		
}

// public function foc_reports_dump($startdate=NULL,$enddate=NULL,$name=NULL){
// 			$startdate = str_replace("_","-",$startdate);	

// 			if(is_admin()){
// 				$where = array();
// 			}else if( is_service_advisor() || is_accountant() ) {
// 				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
// 					$where['dealer_id'] = $this->dealer_id;
// 				}
			

// 			} else if(is_floor_supervisor()){
// 				$where['dealer_id'] = $this->dealer_id;
// 			} else if( is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){
// 				$where = array();
		
// 			}else{
// 				$where['dealer_id'] = $this->dealer_id;
// 			}



// 			$this->db->where('service_type',4);
// 			if($startdate) {
// 				if($name)
// 				{
// 					$dealerName = str_replace('-', ',', $name);
// 					$this->db->where("dealer_id IN (".$dealerName.")",NULL, false);
// 				}
// 				$where['issue_date >='] = $startdate.' 00:00:00';
// 				$where['issue_date <='] = $enddate.' 23:59:59';

// 				$this->job_card_model->_table = "view_report_all";
// 				$fields = 'job_card_issue_date,jobcard_serial,customer_name,engine_no,vehicle_name,vehicle_no,chassis_no,service_type_name,service_count,kms,year,dealer_name,mechanic_name,service_advisor_name,part_name,job_desc';
				
// 				$rows = $this->job_card_model->findAll($where,$fields);
// 			}else{
// 				if($name)
// 				{
// 					$dealerName = str_replace('-', ',', $name);
// 					$this->db->where("dealer_id IN (".$dealerName.")",NULL, false);
// 				}
// 				$this->job_card_model->_table = "view_report_all";
// 				$fields = 'job_card_issue_date,jobcard_serial,customer_name,engine_no,vehicle_name,vehicle_no,chassis_no,service_type_name,service_count,kms,year,dealer_name,mechanic_name,service_advisor_name,part_name,job_desc';
				
// 				$rows = $this->job_card_model->findAll($where,$fields);
// 			}
// 			// print_r($rows);
// 			// exit();

		
		
		

// 		if($rows)
// 		{
// 			$this->load->library('Excel');
// 			$style = array(
// 		        'alignment' => array(
// 		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
// 		        )
// 		    );
// 			$objPHPExcel = new PHPExcel(); 
// 			$objPHPExcel->setActiveSheetIndex(0);
// 			if(is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){

// 			}else{
// 				$this->db->where('id',$this->dealer_id);
// 				$dealer = $this->db->get('dms_dealers')->row_array();
// 				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
// 				$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

// 			}
// 			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'FOC from '.$startdate.' to '.$enddate)->getStyle("A2:N2")->applyFromArray($style);
// 			$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');

// 			$objPHPExcel->getActiveSheet()->SetCellValue('A3','S.N.');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('B3','Dealer');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('C3','Issue Date');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('D3','JobCard No');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('E3','Service Advisor Name');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('F3','Mechanic Name');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('G3','Customer Name');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('H3','Vehicle No');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('I3','Engine No');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('J3','Chassis No');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('K3','Year');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('L3','Vehicle Name');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('M3','KMS');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('N3','Service Type Name');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('O3','Service No');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('P3','Parts Name');
// 			$objPHPExcel->getActiveSheet()->SetCellValue('Q3','Job Description');
			
			

// 			$row = 4;
// 			$col = 0;        
// 			foreach($rows as $key => $values) 
// 			{           
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_card_issue_date);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_advisor_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->customer_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
// 				$col++;

// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->engine_no);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->year);
// 				$col++;
				
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->kms);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_count);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
// 				$col++;
// 				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_desc);
// 				$col++;
				

// 				$col = 0;
// 				$row++;        
// 			}

// 			header("Pragma: public");
// 			header("Content-Type: application/force-download");
// 			header("Content-Disposition: attachment;filename=foc_reports.xls");
// 			header("Content-Transfer-Encoding: binary ");
// 			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
// 			ob_end_clean();
// 			$objWriter->save('php://output');

			
// 		}
// 		redirect('service_reports/foc_reports');
		
// }

	// public function mechanic_earning_reports_dump($start=0,$end=0,$dealer=NULL){
	// 	$start = str_replace("_","-",$start);	
	// 	$date_range = array();
	// 	// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
	// 	if($this->input->post('name')){
	// 			$dealerName = $this->input->post('name');
	// 			$dealer = str_replace('-', ',', $dealerName);
	// 		}else{
	// 			// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
	// 			 $dealer = $this->dealer_id;	
	// 		}

	// 	// $dealer_id = ($dealer)?$dealer:$this->dealer_id;
		
	// 	// print_r($start_date);
	// 	// exit;
	// 	if($start != 0 && $end != 0){
	// 		$start_date =$start. ' 00:00:00';
	// 		$end_date =$end.' 23:59:59';
	// 		$date_range = array($start_date,$end_date);
	// 	}
		
	// 	if(is_admin()){
	// 		$where = '';
	// 	}else if( is_service_advisor() || is_accountant() ) {
	// 		if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
	// 			$where = "dealer_id = {$this->dealer_id}";
	// 		}


	// 	} else if(is_floor_supervisor()){
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
	// 		$where = '';

	// 	}else{
	// 		$where = "dealer_id = {$this->dealer_id}";
	// 	}

	// 	if(empty($date_range)){
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_in) AS labout_amount,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 							) AS tmp
	// 						GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			else
	// 			{
	// 				$query = "SELECT
	// 						tmp.mechanics_id,
	// 						tmp.first_name,
	// 						tmp.last_name,
	// 						tmp.dealer_id,
	// 						tmp.dealer_name,
	// 						tmp.middle_name,
	// 						SUM (tmp.total_in) AS labout_amount,
	// 						SUM (tmp.total_out) AS ow_payment,
	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID 
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
			
				
	// 			$rows = $this->db->query($query)->result();

	// 		} else {
	// 			// $where = ($where != '')?"AND .".$where:'';
	// 			if(empty($dealer))
	// 			{
	// 				$query = "SELECT
	// 						tmp.mechanics_id,
	// 						tmp.first_name,
	// 						tmp.last_name,
	// 						tmp.dealer_id,
	// 						tmp.dealer_name,
	// 						tmp.middle_name,
	// 						SUM (tmp.total_in) AS labout_amount,
	// 						SUM (tmp.total_out) AS ow_payment,
	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 						FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			else
	// 			{
					
	// 				$query = "SELECT
	// 							tmp.mechanics_id,
	// 							tmp.first_name,
	// 							tmp.last_name,
	// 							tmp.dealer_id,
	// 							tmp.dealer_name,
	// 							tmp.middle_name,
	// 							SUM (tmp.total_in) AS labout_amount,
	// 							SUM (tmp.total_out) AS ow_payment,
	// 							SUM(tmp.ow_margin) AS ow_margin,
	// 							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 							FROM
	// 							(
	// 								SELECT
	// 									jc.mechanics_id,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)
	// 										FROM
	// 											ser_billed_jobs AS jin
	// 										WHERE
	// 											jin.billing_id = b. ID 
	// 									) AS total_in,
	// 									(
	// 										SELECT
	// 											SUM (final_amount)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS total_out,
	// 									(
	// 										SELECT
	// 											SUM (outsidework_margin)					
	// 										FROM
	// 											ser_billed_outsidework AS jout
																
	// 										LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 										WHERE
	// 											jout.billing_id = b. ID
	// 									) AS ow_margin,
	// 									wu.first_name,
	// 									wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 								FROM
	// 									view_report_grouped_jobcard AS jc
	// 								LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 								LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 								WHERE
	// 									jc.issue_date >= ?
	// 								AND jc.issue_date <= ?
	// 								AND jc.dealer_id IN (".$dealer.")
	// 							) AS tmp
	// 							GROUP BY
	// 							1,2,3,4,5,6";
	// 			}
	// 			$rows = $this->db->query($query, $date_range)->result();
	// 		}	


	// 	// if(empty($date_range)){
	// 	// 		if(empty($dealer))
	// 	// 		{
	// 	// 			$query = "SELECT
	// 	// 						tmp.mechanics_id,
	// 	// 						tmp.first_name,
	// 	// 						tmp.last_name,
	// 	// 						tmp.dealer_id,
	// 	// 						tmp.dealer_name,
	// 	// 						tmp.middle_name,
	// 	// 						SUM (tmp.total_in) AS labout_amount,
	// 	// 						SUM (tmp.total_out) AS ow_payment,
	// 	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 	// 					FROM
	// 	// 						(
	// 	// 							SELECT
	// 	// 								jc.mechanics_id,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)
	// 	// 									FROM
	// 	// 										ser_billed_jobs AS jin
	// 	// 									WHERE
	// 	// 										jin.billing_id = b. ID
	// 	// 								) AS total_in,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS total_out,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (outsidework_margin)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
																
	// 	// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS ow_margin,
	// 	// 								wu.first_name,
	// 	// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 	// 							FROM
	// 	// 								view_report_grouped_jobcard AS jc
	// 	// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 	// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 	// 						) AS tmp
	// 	// 					GROUP BY
	// 	// 						1,2,3,4,5,6";
	// 	// 		}
	// 	// 		else
	// 	// 		{
	// 	// 			$query = "SELECT
	// 	// 					tmp.mechanics_id,
	// 	// 					tmp.first_name,
	// 	// 					tmp.last_name,
	// 	// 					tmp.dealer_id,
	// 	// 					tmp.dealer_name,
	// 	// 					tmp.middle_name,
	// 	// 					SUM (tmp.total_in) AS labout_amount,
	// 	// 					SUM (tmp.total_out) AS ow_payment,
	// 	// 					SUM(tmp.ow_margin) AS ow_margin,
	// 	// 					concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 	// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 	// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 	// 					FROM
	// 	// 						(
	// 	// 							SELECT
	// 	// 								jc.mechanics_id,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)
	// 	// 									FROM
	// 	// 										ser_billed_jobs AS jin
	// 	// 									WHERE
	// 	// 										jin.billing_id = b. ID
	// 	// 								) AS total_in,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS total_out,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (outsidework_margin)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
																
	// 	// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS ow_margin,
	// 	// 								wu.first_name,
	// 	// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 	// 							FROM
	// 	// 								view_report_grouped_jobcard AS jc
	// 	// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 	// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 	// 							WHERE
	// 	// 								jc.dealer_id = ".$dealer."
	// 	// 						) AS tmp
	// 	// 						GROUP BY
	// 	// 						1,2,3,4,5,6";
	// 	// 		}
			
				
	// 	// 		$rows = $this->db->query($query)->result();

	// 	// 	} else {
	// 	// 		$where = ($where != '')?"AND j.".$where:'';
	// 	// 		if(empty($dealer))
	// 	// 		{
	// 	// 			$query = "SELECT
	// 	// 					tmp.mechanics_id,
	// 	// 					tmp.first_name,
	// 	// 					tmp.last_name,
	// 	// 					tmp.dealer_id,
	// 	// 					tmp.dealer_name,
	// 	// 					tmp.middle_name,
	// 	// 					SUM (tmp.total_in) AS labout_amount,
	// 	// 					SUM (tmp.total_out) AS ow_payment,
	// 	// 					SUM(tmp.ow_margin) AS ow_margin,
	// 	// 					concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 	// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 	// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
	// 	// 					FROM
	// 	// 						(
	// 	// 							SELECT
	// 	// 								jc.mechanics_id,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)
	// 	// 									FROM
	// 	// 										ser_billed_jobs AS jin
	// 	// 									WHERE
	// 	// 										jin.billing_id = b. ID
	// 	// 								) AS total_in,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS total_out,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (outsidework_margin)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
																
	// 	// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS ow_margin,
	// 	// 								wu.first_name,
	// 	// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 	// 							FROM
	// 	// 								view_report_grouped_jobcard AS jc
	// 	// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 	// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 	// 							WHERE
	// 	// 								jc.issue_date >= ?
	// 	// 							AND jc.issue_date <= ?
	// 	// 						) AS tmp
	// 	// 						GROUP BY
	// 	// 						1,2,3,4,5,6";
	// 	// 		}
	// 	// 		else
	// 	// 		{
	// 	// 			$query = "SELECT
	// 	// 						tmp.mechanics_id,
	// 	// 						tmp.first_name,
	// 	// 						tmp.last_name,
	// 	// 						tmp.dealer_id,
	// 	// 						tmp.dealer_name,
	// 	// 						tmp.middle_name,
	// 	// 						SUM (tmp.total_in) AS labout_amount,
	// 	// 						SUM (tmp.total_out) AS ow_payment,
	// 	// 						SUM(tmp.ow_margin) AS ow_margin,
	// 	// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
	// 	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
	// 	// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
	// 	// 						FROM
	// 	// 						(
	// 	// 							SELECT
	// 	// 								jc.mechanics_id,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)
	// 	// 									FROM
	// 	// 										ser_billed_jobs AS jin
	// 	// 									WHERE
	// 	// 										jin.billing_id = b. ID
	// 	// 								) AS total_in,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (final_amount)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS total_out,
	// 	// 								(
	// 	// 									SELECT
	// 	// 										SUM (outsidework_margin)					
	// 	// 									FROM
	// 	// 										ser_billed_outsidework AS jout
																
	// 	// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
	// 	// 									WHERE
	// 	// 										jout.billing_id = b. ID
	// 	// 								) AS ow_margin,
	// 	// 								wu.first_name,
	// 	// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
	// 	// 							FROM
	// 	// 								view_report_grouped_jobcard AS jc
	// 	// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
	// 	// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
	// 	// 							WHERE
	// 	// 								jc.issue_date >= ?
	// 	// 							AND jc.issue_date <= ?
	// 	// 							AND jc.dealer_id = ".$dealer."
	// 	// 						) AS tmp
	// 	// 						GROUP BY
	// 	// 						1,2,3,4,5,6";
	// 	// 		}
	// 	// 		$rows = $this->db->query($query, $date_range)->result();
	// 	// 	}

	// 	// echo '<pre>'; print_r($rows); exit;
	// 	if($rows)
	// 	{
	// 		$this->load->library('Excel');
	// 		$style = array(
	// 	        'alignment' => array(
	// 	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	// 	        )
	// 	    );
	// 		$objPHPExcel = new PHPExcel(); 
	// 		$objPHPExcel->setActiveSheetIndex(0);
	// 		if(is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){

	// 		}else{
	// 			$this->db->where('id',$this->dealer_id);
	// 			$dealer = $this->db->get('dms_dealers')->row_array();
	// 			$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:H1")->applyFromArray($style);
	// 			$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');

	// 		}
		
	// 		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mechanic Wise Earning Report From '.$start.' to '.$end)->getStyle("A2:I2")->applyFromArray($style);
	// 		$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
	// 		// $objPHPExcel->setActiveSheetIndex(0);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic Name');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('B4','Labour Amount');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('C4','OSW Payment');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('D4','OW Margin');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('E4','VAT(Labout Amount)');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('F4','Net Amount');
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('G4','Dealer');
			

	// 		$row = 5;
	// 		$col = 0; 	
			 
	// 		$labour = 0;
	// 		$ow_payment = 0;
	// 		$ow_margin = 0;
	// 		$vat_job = 0;
	// 		$net_amount = 0;
	// 		foreach($rows as $key => $values) 
	// 		{     
	// 			$labour += $values->labout_amount;
	// 			$ow_payment += $values->ow_payment;
	// 			$ow_margin += $values->ow_margin;
	// 			$vat_job += $values->taxes;
	// 			$net_amount += $values->final_amount;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labout_amount);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_payment);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_margin);
	// 			$col++;

	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->taxes);
	// 			$col++;				
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
	// 			$col++;
	// 			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
	// 			$col++;
	// 			$col = 0;
	// 			$row++;        
	// 		}

	// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total');
	// 		// $objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':D'.$row);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$labour);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$ow_payment);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$ow_margin);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$taxes);
	// 		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$net_amount);


	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
	// 		// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

	// 		header("Pragma: public");
	// 		header("Content-Type: application/force-download");
	// 		header("Content-Disposition: attachment;filename=mechanic_wise_earning.xls");
	// 		header("Content-Transfer-Encoding: binary ");
	// 		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	// 		ob_end_clean();
	// 		$objWriter->save('php://output');

			
	// 	}
	// 	redirect($_SERVER['HTTP_REFERER']);
		
	// }


	public function mechanic_earning_reports_dump($start=0,$end=0,$dealer=NULL){
		$start = str_replace("_","-",$start);	
		$date_range = array();
		// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
		if($this->input->post('name')){
				$dealerName = $this->input->post('name');
				$dealer = str_replace('-', ',', $dealerName);
			}else{
				// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
				 $dealer = $this->dealer_id;	
			}

		// $dealer_id = ($dealer)?$dealer:$this->dealer_id;
		
		// print_r($start_date);
		// exit;
		if($start != 0 && $end != 0){
			$start_date =$start. ' 00:00:00';
			$end_date =$end.' 23:59:59';
			$date_range = array($start_date,$end_date);
		}
		
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}


		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}

		// if(empty($date_range)){
		// 		if(empty($dealer))
		// 		{
		// 			$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_in) AS labout_amount,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
		// 					FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 						) AS tmp
		// 					GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
		// 		else
		// 		{
		// 			$query = "SELECT
		// 					tmp.mechanics_id,
		// 					tmp.first_name,
		// 					tmp.last_name,
		// 					tmp.dealer_id,
		// 					tmp.dealer_name,
		// 					tmp.middle_name,
		// 					SUM (tmp.total_in) AS labout_amount,
		// 					SUM (tmp.total_out) AS ow_payment,
		// 					SUM(tmp.ow_margin) AS ow_margin,
		// 					concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
		// 					FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID 
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 								jc.dealer_id IN (".$dealer.")
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
			
				
		// 		$rows = $this->db->query($query)->result();

		// 	} else {
		// 		// $where = ($where != '')?"AND .".$where:'';
		// 		if(empty($dealer))
		// 		{
		// 			$query = "SELECT
		// 					tmp.mechanics_id,
		// 					tmp.first_name,
		// 					tmp.last_name,
		// 					tmp.dealer_id,
		// 					tmp.dealer_name,
		// 					tmp.middle_name,
		// 					SUM (tmp.total_in) AS labout_amount,
		// 					SUM (tmp.total_out) AS ow_payment,
		// 					SUM(tmp.ow_margin) AS ow_margin,
		// 					concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
		// 					FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 								jc.issue_date >= ?
		// 							AND jc.issue_date <= ?
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
		// 		else
		// 		{
					
		// 			$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_in) AS labout_amount,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
		// 						FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID 
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 								jc.issue_date >= ?
		// 							AND jc.issue_date <= ?
		// 							AND jc.dealer_id IN (".$dealer.")
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
		// 		$rows = $this->db->query($query, $date_range)->result();
		// 	}	
		if(empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_in) AS labout_amount,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.localprice) as local,
								SUM(tmp.other) as other,
								SUM(tmp.total_parts) as total_part,
								SUM(tmp.vat_parts) as vat_parts,
								SUM(tmp.net_total) as net_total
								
							FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice,b.total_parts,	b.vat_parts,b.net_total			
										FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id
								) AS tmp
							GROUP BY
								1,2,3,4,5,6";
				}
				else
				{
					$query = "SELECT
							tmp.mechanics_id,
							tmp.first_name,
							tmp.last_name,
							tmp.dealer_id,
							tmp.dealer_name,
							tmp.middle_name,
							SUM (tmp.total_in) AS labout_amount,
							SUM (tmp.total_out) AS ow_payment,
							SUM(tmp.ow_margin) AS ow_margin,

							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							SUM(tmp.partprice) as part_price,
							SUM(tmp.accessprice) as accessories,
							SUM(tmp.oilprice) as lube,
							SUM(tmp.localprice) as local,

							SUM(tmp.other) as other,
							SUM(tmp.total_parts) as total_part,
							SUM(tmp.vat_parts) as vat_parts,
							SUM(tmp.net_total) as net_total
							
							FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID 
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.localprice,pb.oilprice,pb.other,b.total_parts,	b.vat_parts,b.net_total	
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id
									WHERE
										jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";
				}
			
				
				$rows = $this->db->query($query)->result();

			} else {
				$where = ($where != '')?"AND j.".$where:'';
				if(empty($dealer))
				{
					$query = "SELECT
							tmp.mechanics_id,
							tmp.first_name,
							tmp.last_name,
							tmp.dealer_id,
							tmp.dealer_name,
							tmp.middle_name,
							SUM (tmp.total_in) AS labout_amount,
							SUM (tmp.total_out) AS ow_payment,
							SUM(tmp.ow_margin) AS ow_margin,
							concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
							((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount,
							SUM(tmp.partprice) as part_price,
							SUM(tmp.accessprice) as accessories,
							SUM(tmp.oilprice) as lube,
							SUM(tmp.other) as other,
							SUM(tmp.localprice) as local,
							SUM(tmp.total_parts) as total_part,
							SUM(tmp.vat_parts) as vat_parts,
							SUM(tmp.net_total) as net_total
							
							FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice,b.total_parts,	b.vat_parts,b.net_total	
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
										jc.issue_date >= ?
									AND jc.issue_date <= ?
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";
				}
				else
				{
					$query = "SELECT
								tmp.mechanics_id,
								tmp.first_name,
								tmp.last_name,
								tmp.dealer_id,
								tmp.dealer_name,
								tmp.middle_name,
								SUM (tmp.total_in) AS labout_amount,
								SUM (tmp.total_out) AS ow_payment,
								SUM(tmp.ow_margin) AS ow_margin,
								concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
								((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount,
								SUM(tmp.partprice) as part_price,
								SUM(tmp.accessprice) as accessories,
								SUM(tmp.oilprice) as lube,
								SUM(tmp.other) as other,
								SUM(tmp.localprice) as local,
								SUM(tmp.total_parts) as total_part,
								SUM(tmp.vat_parts) as vat_parts,
								SUM(tmp.net_total) as net_total
								FROM
								(
									SELECT
										jc.mechanics_id,
										(
											SELECT
												SUM (final_amount)
											FROM
												ser_billed_jobs AS jin
											WHERE
												jin.billing_id = b. ID 
										) AS total_in,
										(
											SELECT
												SUM (final_amount)					
											FROM
												ser_billed_outsidework AS jout
											WHERE
												jout.billing_id = b. ID
										) AS total_out,
										(
											SELECT
												SUM (outsidework_margin)					
											FROM
												ser_billed_outsidework AS jout
																
											LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
											WHERE
												jout.billing_id = b. ID
										) AS ow_margin,
										wu.first_name,
										wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name,pb.partprice,pb.accessprice,pb.oilprice,pb.other,pb.localprice,b.total_parts,	b.vat_parts,b.net_total	
									FROM
										view_report_grouped_jobcard AS jc
									LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
									LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
									LEFT JOIN view_billing_part_breakdown AS pb on pb.id = b.id

									WHERE
										jc.issue_date >= ?
									AND jc.issue_date <= ?
									AND jc.dealer_id IN (".$dealer.")
								) AS tmp
								GROUP BY
								1,2,3,4,5,6";
				}
				$rows = $this->db->query($query, $date_range)->result();
			}

		// if(empty($date_range)){
		// 		if(empty($dealer))
		// 		{
		// 			$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_in) AS labout_amount,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
		// 					FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 						) AS tmp
		// 					GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
		// 		else
		// 		{
		// 			$query = "SELECT
		// 					tmp.mechanics_id,
		// 					tmp.first_name,
		// 					tmp.last_name,
		// 					tmp.dealer_id,
		// 					tmp.dealer_name,
		// 					tmp.middle_name,
		// 					SUM (tmp.total_in) AS labout_amount,
		// 					SUM (tmp.total_out) AS ow_payment,
		// 					SUM(tmp.ow_margin) AS ow_margin,
		// 					concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
		// 					FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 								jc.dealer_id = ".$dealer."
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
			
				
		// 		$rows = $this->db->query($query)->result();

		// 	} else {
		// 		$where = ($where != '')?"AND j.".$where:'';
		// 		if(empty($dealer))
		// 		{
		// 			$query = "SELECT
		// 					tmp.mechanics_id,
		// 					tmp.first_name,
		// 					tmp.last_name,
		// 					tmp.dealer_id,
		// 					tmp.dealer_name,
		// 					tmp.middle_name,
		// 					SUM (tmp.total_in) AS labout_amount,
		// 					SUM (tmp.total_out) AS ow_payment,
		// 					SUM(tmp.ow_margin) AS ow_margin,
		// 					concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 					((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
							
		// 					FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 								jc.issue_date >= ?
		// 							AND jc.issue_date <= ?
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
		// 		else
		// 		{
		// 			$query = "SELECT
		// 						tmp.mechanics_id,
		// 						tmp.first_name,
		// 						tmp.last_name,
		// 						tmp.dealer_id,
		// 						tmp.dealer_name,
		// 						tmp.middle_name,
		// 						SUM (tmp.total_in) AS labout_amount,
		// 						SUM (tmp.total_out) AS ow_payment,
		// 						SUM(tmp.ow_margin) AS ow_margin,
		// 						concat(tmp.first_name, ' ', tmp.middle_name, ' ', tmp.last_name) AS mechanic_name,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) AS taxes,
		// 						((COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) * (0.13)::double precision) + (COALESCE(SUM (tmp.total_in), (0)::double precision) + COALESCE(SUM (tmp.total_out), (0)::real)) as final_amount
								
		// 						FROM
		// 						(
		// 							SELECT
		// 								jc.mechanics_id,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)
		// 									FROM
		// 										ser_billed_jobs AS jin
		// 									WHERE
		// 										jin.billing_id = b. ID
		// 								) AS total_in,
		// 								(
		// 									SELECT
		// 										SUM (final_amount)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS total_out,
		// 								(
		// 									SELECT
		// 										SUM (outsidework_margin)					
		// 									FROM
		// 										ser_billed_outsidework AS jout
																
		// 									LEFT JOIN mst_service_jobs as msj on msj.id = jout.job_id
												
		// 									WHERE
		// 										jout.billing_id = b. ID
		// 								) AS ow_margin,
		// 								wu.first_name,
		// 								wu.last_name,jc.dealer_id,jc.dealer_name,wu.middle_name
		// 							FROM
		// 								view_report_grouped_jobcard AS jc
		// 							LEFT JOIN ser_workshop_users AS wu ON jc.mechanics_id = wu.id
		// 							LEFT JOIN ser_billing_record AS b ON jc.jobcard_group = b.jobcard_group
		// 							WHERE
		// 								jc.issue_date >= ?
		// 							AND jc.issue_date <= ?
		// 							AND jc.dealer_id = ".$dealer."
		// 						) AS tmp
		// 						GROUP BY
		// 						1,2,3,4,5,6";
		// 		}
		// 		$rows = $this->db->query($query, $date_range)->result();
		// 	}

		// echo '<pre>'; print_r($rows); exit;
		// if($rows)
		// {
		// 	$this->load->library('Excel');
		// 	$style = array(
		//         'alignment' => array(
		//             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		//         )
		//     );
		// 	$objPHPExcel = new PHPExcel(); 
		// 	$objPHPExcel->setActiveSheetIndex(0);
		// 	if(is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){

		// 	}else{
		// 		$this->db->where('id',$this->dealer_id);
		// 		$dealer = $this->db->get('dms_dealers')->row_array();
		// 		$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:H1")->applyFromArray($style);
		// 		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');

		// 	}
		
		// 	$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mechanic Wise Earning Report From '.$start.' to '.$end)->getStyle("A2:I2")->applyFromArray($style);
		// 	$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
		// 	// $objPHPExcel->setActiveSheetIndex(0);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic Name');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('B4','Labour Amount');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('C4','OSW Payment');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('D4','OW Margin');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('E4','VAT(Labout Amount)');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('F4','Total Labour');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('G4','Parts');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('H4','Lube');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('I4','Accessories');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('J4','Other');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('K4','VAT(Parts)');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('L4','Total Parts');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('M4','Net Amount');
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('N4','Dealer');
			

		// 	$row = 5;
		// 	$col = 0; 	
			 
		// 	$labour = 0;
		// 	$ow_payment = 0;
		// 	$ow_margin = 0;
		// 	$vat_job = 0;
		// 	$labout_total = 0;
		// 	$parts = 0;
		// 	$lube = 0;
		// 	$accessories = 0;
		// 	$other = 0;
		// 	$part_vat = 0;
		// 	$total_part = 0;
		// 	$net_total = 0;
		// 	foreach($rows as $key => $values) 
		// 	{     
		// 		$labour += $values->labout_amount;
		// 		$ow_payment += $values->ow_payment;
		// 		$ow_margin += $values->ow_margin;
		// 		$vat_job += $values->taxes;
		// 		$labout_total += $values->final_amount;
		// 		$parts += $values->part_price;
		// 		$lube += $values->lube;
		// 		$accessories += $values->accessories;
		// 		$other += $values->other;
		// 		$part_vat += $values->vat_parts;
		// 		$total_part += $values->total_part;
		// 		$net_total += $values->net_total;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labout_amount);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_payment);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_margin);
		// 		$col++;

		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->taxes);
		// 		$col++;				
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_price);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->lube);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessories);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_parts);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_part);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_total);
		// 		$col++;
		// 		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
		// 		$col++;
		// 		$col = 0;
		// 		$row++;        
		// 	}

		// 	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total');
		// 	// $objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':D'.$row);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$labour);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$ow_payment);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$ow_margin);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$taxes);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$labout_total);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$parts);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$lube);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$accessories);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$other);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$part_vat);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$total_part);
		// 	$objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$net_total);


		// 	// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
		// 	// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
		// 	// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
		// 	// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
		// 	// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

		// 	header("Pragma: public");
		// 	header("Content-Type: application/force-download");
		// 	header("Content-Disposition: attachment;filename=mechanic_wise_earning.xls");
		// 	header("Content-Transfer-Encoding: binary ");
		// 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		// 	ob_end_clean();
		// 	$objWriter->save('php://output');

			
		// }
			if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			if(is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:H1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');

			}
		
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mechanic Wise Earning Report From '.$start.' to '.$end)->getStyle("A2:I2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Mechanic Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Labour Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','OSW Payment');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','OW Margin');
			// $objPHPExcel->getActiveSheet()->SetCellValue('E4','VAT(Labout Amount)');
			// $objPHPExcel->getActiveSheet()->SetCellValue('F4','Total Labour');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Lube');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Accessories');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Local');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Other');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','VAT');
			// $objPHPExcel->getActiveSheet()->SetCellValue('L4','Total Parts');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','Net Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('L4','Dealer Name');
			

			$row = 5;
			$col = 0; 	
			 
			$labour = 0;
			$ow_payment = 0;
			$ow_margin = 0;
			$vat_job = 0;
			$labout_total = 0;
			$parts = 0;
			$lube = 0;
			$accessories = 0;
			$other = 0;
			$vat = 0;
			$total_part = 0;
			$net_total = 0;
			$local = 0;
			foreach($rows as $key => $values) 
			{     
				$labour += $values->labout_amount;
				$ow_payment += $values->ow_payment;
				$ow_margin += $values->ow_margin;
				$vat_job += $values->taxes;
				$labout_total += $values->final_amount;
				$parts += $values->part_price;
				$lube += $values->lube;
				$accessories += $values->accessories;
				$other += $values->other;
				$vat += ($values->vat_parts + $values->taxes);
				$total_part += $values->total_part;
				$net_total += $values->net_total;
				$local += $values->local;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labout_amount);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_payment);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->ow_margin);
				$col++;

				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->taxes);
				// $col++;				
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
				// $col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_price);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->lube);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessories);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->local);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, (@$values->vat_parts + @$values->taxes));
				$col++;
				// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_part);
				// $col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_total);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total');
			// $objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':D'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$labour);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$ow_payment);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$ow_margin);
			// $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$taxes);
			// $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$labout_total);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$parts);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$lube);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$accessories);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$local);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$other);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$vat);
			// $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$total_part);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$net_total);


			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=mechanic_wise_earning.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
		
	}


	public function job_summary_detail($json = NULL)
	{
		if($json)
		{

			$post = $this->input->post('selection');	
			$dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$date_range = array($post[0],$post[1]);
			}
			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){
				$where = '';
		
			}else{
				$where = "dealer_id = {$this->dealer_id}";
			}	

			if(empty($date_range)){
				if(empty($dealer))
				{
					$query1 = "SELECT sum(total_jobs) as labour_cash,sum(total_parts) as taxable_cash, sum(vat_job) as vat_labour_cash, sum(vat_parts) as vat_parts_cash, SUM(cash_discount_amt) as cash_discount_cash, sum(net_total) as net_cash  from ser_billing_record where payment_type = 'cash'";

					$query2 = "SELECT sum(total_jobs) as labour_credit,sum(total_parts) as taxable_credit, sum(vat_job) as Vat_labour_credit, sum(vat_parts) as Vat_parts_credit, SUM(cash_discount_amt) as cash_discount_credit, sum(net_total) as net_credit  from ser_billing_record where payment_type = 'credit'";
				}
				else
				{
					$query1 = "SELECT sum(total_jobs) as labour_cash,sum(total_parts) as taxable_cash, sum(vat_job) as vat_labour_cash, sum(vat_parts) as vat_parts_cash, SUM(cash_discount_amt) as cash_discount_cash, sum(net_total) as net_cash  from ser_billing_record where payment_type = 'cash' AND dealer_id = '".$dealer."'";

					$query2 = "SELECT sum(total_jobs) as labour_credit,sum(total_parts) as taxable_credit, sum(vat_job) as Vat_labour_credit, sum(vat_parts) as Vat_parts_credit, SUM(cash_discount_amt) as cash_discount_credit, sum(net_total) as net_credit  from ser_billing_record where payment_type = 'credit' AND dealer_id = '".$dealer."'";

				}	

				$cash = $this->db->query($query1)->row();
				$credit = $this->db->query($query2)->row();
			}
			else{
				if(empty($dealer))
				{
					$query1 = "SELECT sum(total_jobs) as labour_cash,sum(total_parts) as taxable_cash, sum(vat_job) as vat_labour_cash, sum(vat_parts) as vat_parts_cash, SUM(cash_discount_amt) as cash_discount_cash, sum(net_total) as net_cash  from ser_billing_record where payment_type = 'cash' AND (issue_date >= ? AND issue_date <= ?)";

					$query2 = "SELECT sum(total_jobs) as labour_credit,sum(total_parts) as taxable_credit, sum(vat_job) as Vat_labour_credit, sum(vat_parts) as Vat_parts_credit, SUM(cash_discount_amt) as cash_discount_credit, sum(net_total) as net_credit  from ser_billing_record where payment_type = 'credit' AND (issue_date >= ? AND issue_date <= ?)";
				}
				else
				{
					$query1 = "SELECT sum(total_jobs) as labour_cash,sum(total_parts) as taxable_cash, sum(vat_job) as vat_labour_cash, sum(vat_parts) as vat_parts_cash, SUM(cash_discount_amt) as cash_discount_cash, sum(net_total) as net_cash  from ser_billing_record where payment_type = 'cash'   AND (issue_date >= ? AND  issue_date <= ?) AND dealer_id = '".$dealer."'";

					$query2 = "SELECT sum(total_jobs) as labour_credit,sum(total_parts) as taxable_credit, sum(vat_job) as Vat_labour_credit, sum(vat_parts) as Vat_parts_credit, SUM(cash_discount_amt) as cash_discount_credit, sum(net_total) as net_credit  from ser_billing_record where payment_type = 'credit'   AND  (issue_date >= ? AND issue_date <= ?) AND dealer_id = '".$dealer."'";
				}
				$cash = $this->db->query($query1, $date_range)->row();
				$credit = $this->db->query($query2, $date_range)->row();

			}

			// echo '<pre>'; print_r($cash);  print_r($credit); exit;


			$row = [];
			$row[0]['description'] = 'Taxable Sales';
			$row[0]['cash'] = $cash->taxable_cash;
			$row[0]['credit'] = $credit->taxable_credit;
			$row[0]['net'] = $credit->taxable_credit + $cash->taxable_cash;

			$row[1]['description'] = 'Labours';
			$row[1]['cash'] = $cash->labour_cash;
			$row[1]['credit'] = $credit->labour_credit;
			$row[1]['net'] = $credit->labour_credit + $cash->labour_cash;


			$row[2]['description'] = 'Discounts';
			$row[2]['cash'] = $cash->cash_discount_cash;
			$row[2]['credit'] = $credit->cash_discount_credit;
			$row[2]['net'] = $credit->cash_discount_credit + $cash->cash_discount_cash;


			$row[3]['description'] = 'VAT';
			$row[3]['cash'] = $cash->vat_parts_cash + $cash->vat_labour_cash;
			$row[3]['credit'] = $credit->vat_labour_credit + $credit->vat_parts_credit;
			$row[3]['net'] = $cash->vat_parts_cash + $cash->vat_labour_cash + $credit->vat_labour_credit + $credit->vat_parts_credit;


			$row[4]['description'] = 'Gross Total';
			$row[4]['cash'] = $cash->net_cash;
			$row[4]['credit'] = $credit->net_credit;
			$row[4]['net'] = $cash->net_cash + $credit->net_credit;

			// echo json_encode(value)
			echo json_encode(array('rows'=>$row));
			exit;

			// // echo $this->db->last_query();
			// echo '<pre>'; print_r($row); exit;
		}
		// Display Page
		$data['header'] = 'Job Summary Details';
		$data['page'] = $this->config->item('template_admin') . "job_summary_detail";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}



public function spareparts_register($json = NULL) {
		if($json == 'json') {
			
					$post = $this->input->get('selection');
			$dealer = $this->input->get('name');
			$post = explode(" - ", $post);
			$date_range = array();

			$is_admin = (is_admin())?TRUE:FALSE;
			$is_service_advisor = (is_service_advisor())?TRUE:FALSE;
			$is_accountant = (is_accountant())?TRUE:FALSE;
			$sparepart_executive = (is_group(SPAREPART_EXECUTIVE))?TRUE:FALSE;
			$is_floor_supervisor = (is_floor_supervisor())?TRUE:FALSE;
			$is_service_head = (is_service_head())?TRUE:FALSE;
			$is_national_service_manager = (is_national_service_manager())?TRUE:FALSE;
			$is_ccd_incharge = (is_ccd_incharge())?TRUE:FALSE;
			$is_service_dealer_incharge = (is_service_dealer_incharge())?TRUE:FALSE;
			$is_admin = (is_admin())?TRUE:FALSE;


			$this->job_card_model->_table = "view_spareparts_register";
			// print_r(search_params()); exit;

			if($this->input->get('selection')) {
				$start_date = $post[0].' 00:00:00';
				$end_date = $post[1].' 23:59:59';
				
				$this->db->where('issue_date >=',$start_date);
				$this->db->where('issue_date <=',$end_date);
				// $date_range = array($post[0],$post[1],);
			}

			if($this->input->get('name'))
			{
				$this->db->where('dealer_id',$dealer);
			}

			if($is_admin){
				$where = '';
			}else if($is_service_advisor || $is_accountant ) {
				if( !$sparepart_executive  || $is_accountant  ){
					// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				}
			} else if($is_floor_supervisor){
				// $where['dealer_id'] = $this->dealer_id;
				$this->db->where('dealer_id',$this->dealer_id);

			} else if(( $is_service_head || $is_national_service_manager) || $is_admin || $is_ccd_incharge || $is_service_dealer_incharge ){
				$where = '';
		
			}else{
				// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				
			}

			// echo $this->db->last_query(); exit;
			search_params();
			$total=$this->job_card_model->find_count();
			
			paging('issue_date');

			if($this->input->get('selection')) {
				// print_r("expression");
				// exit();
				$this->db->where('issue_date >=',$post[0]);
				$this->db->where('issue_date <=',$post[1]);
				// $date_range = array($post[0],$post[1],);
			}


			if($this->input->get('name'))
			{
				$this->db->where('dealer_id',$dealer);
			}
			if($is_admin){
				$where = '';
			}else if($is_service_advisor || $is_accountant ) {
				if( !$sparepart_executive  || $is_accountant  ){
					// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				}
			} else if($is_floor_supervisor){
				// $where['dealer_id'] = $this->dealer_id;
				$this->db->where('dealer_id',$this->dealer_id);

			} else if( ($is_service_head || $is_national_service_manager) || $is_admin ){
				$where = '';
		
			}else{
				// $where = "dealer_id = {$this->dealer_id}";
					$this->db->where('dealer_id',$this->dealer_id);
				
			}
			
			search_params();
			$rows=$this->job_card_model->findAll();
			// echo $this->db->last_query(); exit;
			
			echo json_encode(array('total'=>$total,'rows'=>$rows));
			exit;
			
			}

		// Display Page
		$data['header'] = 'Spareparts Register';
		$data['page'] = $this->config->item('template_admin') . "spareparts_register";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}

	public function material_issue_report($json = FALSE)
	{

		if($json == 'json') {

			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			$post = explode(" - ", $post);
			

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$dealer_id = $this->dealer_id;
					$where['dealer_id'] = $dealer_id;
				}
			

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = array();
		
			}else{
				$dealer_id = $this->dealer_id;
				$where['dealer_id'] = $dealer_id;
			}	

			$this->job_card_model->_table = "view_material_scan";

			if($this->input->post('selection')) {
				$where['job_card_issue_date >='] = $post[0].' 00:00:00';
				$where['job_card_issue_date <='] = $post[1].' 23:59:59';
			}

			if($this->input->post('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}


			$this->db->where('quantity <>',0);
			$this->db->where('invoice_no',NULL);
			$rows = $this->job_card_model->findAll($where);

			foreach ($rows as $key => &$value) {
				$value->final_amount = $value->price * $value->quantity;
			}
			
			echo json_encode(array('rows'=>$rows));
			exit;
		}
		$data['header'] = 'Material Issue';
		$data['page'] = $this->config->item('template_admin') . "material_issue";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}

	public function material_issue_dump($start=0,$end=0,$dealer=NULL)
	{
		$start = str_replace("_","-",$start);	
		$date_range = array();
		
		// $dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealer);
		// $dealer = ($this->input->post('name'))?$this->input->post('name'):$this->dealer_id;	
		// $dealer_id = ($dealer)?$dealer:$this->dealer_id;
		
		// print_r($start_date);
		// exit;
		if($start != 0 && $end != 0){
			$start_date =$start. ' 00:00:00';
			$end_date =$end.' 23:59:59';
			$date_range = array($start_date,$end_date);
		}


		if(is_admin()){
			$where = array();
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$dealer_id = $this->dealer_id;
				$where['dealer_id'] = $dealer_id;
			}
		

		} else if(is_floor_supervisor()){
			$where['dealer_id'] = $this->dealer_id;
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
			$where = array();
	
		}else{
			$dealer_id = $this->dealer_id;
			$where['dealer_id'] = $dealer_id;
		}	

		$this->job_card_model->_table = "view_material_scan";

		// if($this->input->post('selection')) {
			$where['job_card_issue_date >='] = $start_date;
			$where['job_card_issue_date <='] = $end_date;
		// }

		if($dealer)
		{
			$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
		}


		$this->db->where('quantity <>',0);
		$this->db->where('invoice_no',NULL);
		$rows = $this->job_card_model->findAll($where);

		foreach ($rows as $key => &$value) {
			$value->final_amount = $value->price * $value->quantity;
		}

		// echo '<pre>'; print_r($this->db->last_query()); exit;

		if($rows)
		{
			$this->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Job Card Issued Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Customer');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Vehicle No');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Chassis No');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Engine No');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Vehicle Detail');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Jobcard No');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Part Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','Part Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('L4','Quantity');
			$objPHPExcel->getActiveSheet()->SetCellValue('M4','Final Amount');
			

			$row = 3;
			$col = 0; 

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Date From');
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $start_date);
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Date To');
				$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $end_date);
				$col++;

			$row = 5;
			$col = 0; 	
			$total = 0;       
			$quantity = 0;       
			$final_amount = 0;          
			foreach($rows as $key => $values) 
			{        
				$total += $values->price;
				$quantity += $values->quantity;
				$final_amount += $values->final_amount;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_card_issue_date);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->customer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->chassis_no);
				$col++;

				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->engine_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_code);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
				$col++;
				
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->price);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->quantity);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
				

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total');
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

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '');
			$col++;

			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $gross_amount_total);
			// $col++;
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $osw_paid_total);
			// $col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $total);
			$col++;
			
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $quantity);
			$col++;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $final_amount);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=material_scan.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	function sales_register($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$start_date =$post[0].' 00:00:00';
					$end_date =$post[1].' 23:59:59';
					$date_range = array($start_date,$end_date);
			}

			

			if(is_admin()){
				$where = '';
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where = "jc.dealer_id = {$this->dealer_id}";
				}
			

			} else if(is_floor_supervisor()){
				$where = "jc.dealer_id = {$this->dealer_id}";
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance() ){
				$where = '';
		
			}else{
				$where = "jc.dealer_id = {$this->dealer_id}";
			}

			if( empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile

					FROM
					view_job_summary_refined AS jc";
				}
				else
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile

					FROM
					view_job_summary_refined AS jc 
					WHERE (jc.dealer_id IN ($dealer))";
				}
				
				
				$rows = $this->db->query($query)->result();
			// 	echo $this->db->last_query();
			// exit();

			} else {

				$where = ($where != '')?"AND ".$where:'';
				if(empty($dealer))
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile

					FROM
					view_job_summary_refined AS jc
					WHERE (jc.issue_date >= ? AND jc.issue_date <= ?) {$where}";
				}
				else
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile

					FROM
					view_job_summary_refined AS jc 
					WHERE ((jc.dealer_id IN($dealer)) AND (jc.issue_date >= ? AND jc.issue_date <= ?)) {$where}";
				}
				
			
				$rows = $this->db->query($query, $date_range)->result();
			}
			
			echo json_encode(array('rows'=>$rows));
			exit;
		}
		
		// Display Page
		$data['header'] = lang('sales_register');
		$data['page'] = $this->config->item('template_admin') . "sales_register";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	

	}

	public function sale_register_excel_dump($start = 0 , $end = 0, $name = NULL){
		$start = str_replace("_","-",$start);	
		$date_range = array();

		if($start != 0 && $end != 0){
			$start_date =$start.' 00:00:00';
			$end_date =$end.' 23:59:59';
			$date_range = array($start_date,$end_date);
		}
		if(is_admin()){
			$where = '';
		}else if( is_service_advisor() || is_accountant() ) {
			if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
				$where = "dealer_id = {$this->dealer_id}";
			}


		} else if(is_floor_supervisor()){
			$where = "dealer_id = {$this->dealer_id}";
		} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()  ){
			$where = '';

		}else{
			$where = "dealer_id = {$this->dealer_id}";
		}
		$dealer = str_replace('-', ',', $name);
		if( empty($date_range)){
				if(empty($dealer))
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile

					FROM
					view_job_summary_refined AS jc";
				}
				else
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile


					FROM
					view_job_summary_refined AS jc 
					WHERE (jc.dealer_id IN ($dealer))";
				}
				
				
				$rows = $this->db->query($query)->result();
			// 	echo $this->db->last_query();
			// exit();

			} else {

				$where = ($where != '')?"AND ".$where:'';
				if(empty($dealer))
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile


					FROM
					view_job_summary_refined AS jc
					WHERE (jc.issue_date >= ? AND jc.issue_date <= ?) {$where}";
				}
				else
				{
					$query = "SELECT
						jc.issue_date,
						jc.invoice_no,
						jc.dealer_name,
						jc.jobcard_group,
						jc.jobcard_serial,
						jc.vehicle_no,
						jc.customer_name,
						jc.vehicle_name || ' ' || jc.variant_name as vehicle,
						jc.service_type_name,
						jc.service_count,
						jc.mechanic_name,
						jc.partprice,
						jc.accessprice,
						jc.labourprice,
						jc.other,
						jc.oilprice,
						jc.cash_discount_amt,
						jc.vat_total,
						jc.net_total,
						jc.job_desc,
						jc.part_name,
						jc.localprice,
						jc.mobile


					FROM
					view_job_summary_refined AS jc 
					WHERE ((jc.dealer_id IN($dealer)) AND (jc.issue_date >= ? AND jc.issue_date <= ?)) {$where}";
				}
				
			
				$rows = $this->db->query($query, $date_range)->result();
			}

		// echo '<pre>'; print_r($rows); exit;
		if($rows)
		{
			$this->load->library('Excel');
			$style = array(
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        )
		    );
			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
		if(is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge() ){

			}else{
				$this->db->where('id',$this->dealer_id);
				$dealer = $this->db->get('dms_dealers')->row_array();
				$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:Q1")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A1:Q1');

			}
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Sales Summary Report From '.$start.' to '.$end)->getStyle("A2:I2")->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:Q2');
			// $objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4','Issue Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('B4','Invoice');
			$objPHPExcel->getActiveSheet()->SetCellValue('C4','Jobcard Number');
			$objPHPExcel->getActiveSheet()->SetCellValue('D4','Vehicle No.');
			$objPHPExcel->getActiveSheet()->SetCellValue('E4','Dealer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('F4','Customer Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('G4','Mobile');
			$objPHPExcel->getActiveSheet()->SetCellValue('H4','Model');
			$objPHPExcel->getActiveSheet()->SetCellValue('I4','Service Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('J4','Service Number');
			$objPHPExcel->getActiveSheet()->SetCellValue('K4','Mechanic');			
			$objPHPExcel->getActiveSheet()->SetCellValue('L4','Job Description');			
			$objPHPExcel->getActiveSheet()->SetCellValue('M4','Parts Consumed');			
			$objPHPExcel->getActiveSheet()->SetCellValue('N4','Parts Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('O4','Oil Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('P4','Accessories Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('Q4','Local Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('R4','labour Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('S4','Other Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('T4','Cash Discount Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('U4','Vat Amt');			
			$objPHPExcel->getActiveSheet()->SetCellValue('V4','Net Amt');			

			$row = 5;
			$col = 0;

			$total_part_price = 0;
			$total_access_price = 0;
			$total_labour_price = 0;
			$total_oil_price = 0;
			$total_other_price = 0;
			$total_discount_cash_amt = 0;
			$total_vat_amt = 0;
			$toatl_net_amt = 0;
			$local = 0;
			  
			foreach($rows as $key => $values) 
			{       
				$total_part_price += $values->partprice;
				$total_oil_price += $values->oilprice;
				$total_access_price += $values->accessprice;
				$total_labour_price += $values->labourprice;
				$total_other_price += $values->other;
				$total_discount_cash_amt += $values->cash_discount_amt;
				$total_vat_amt += $values->vat_total;
				$toatl_net_amt += $values->net_total;
				$local += $values->localprice;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->issue_date);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->invoice_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->jobcard_serial);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle_no);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->customer_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mobile);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vehicle);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_type_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service_count);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mechanic_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_desc);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->partprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->oilprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->accessprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->localprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->labourprice);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->other);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->cash_discount_amt);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->vat_total);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->net_total);
				$col++;

				$col = 0;
				$row++;        
			}

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'Total')->getStyle('A'.$row.':D'.$row)->applyFromArray($style);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':M'.$row);
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$row,$total_part_price);
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$row,$total_oil_price);
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$row,$total_access_price);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row,$local);
			$objPHPExcel->getActiveSheet()->SetCellValue('R'.$row,$total_labour_price);
			$objPHPExcel->getActiveSheet()->SetCellValue('S'.$row,$total_other_price);
			$objPHPExcel->getActiveSheet()->SetCellValue('T'.$row,$total_discount_cash_amt);
			$objPHPExcel->getActiveSheet()->SetCellValue('U'.$row,$total_vat_amt);
			$objPHPExcel->getActiveSheet()->SetCellValue('V'.$row,$toatl_net_amt);


			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('E', $row, $price);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('F', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('G', $row, '');
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('H', $row, $taxes_total);
			// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow('I', $row, $gross_amount_total);

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=sales_summary.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');

			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function get_job_wise_billing_summary($json = false)
	{
		if($json == 'json') {
			// echo '<pre>'; print_r($this->input->post()); exit();
			$post = $this->input->post('selection');
			// $post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);
			

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$dealer_id = $this->dealer_id;
					$where['dealer_id'] = $dealer_id;
				}
			

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
				$where = array();
		
			}else{
				$dealer_id = $this->dealer_id;
				$where['dealer_id'] = $dealer_id;
			}	

			$this->job_card_model->_table = "view_job_wise_billing";

			if($this->input->post('selection')) {
				$where['issue_date >='] = $post[0].' 00:00:00';
				$where['issue_date <='] = $post[1].' 23:59:59';
			}

			if($this->input->post('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}
			$this->db->where('job_id',$this->input->post('job_id'));
			$rows = $this->job_card_model->findAll($where);
			
			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = 'Job Wise Billing';
		$data['page'] = $this->config->item('template_admin') . "job_wise_billing_report";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}


	public function get_job_wise_billing_summary_dump($startdate=NULL,$enddate=NULL,$job_id = null,$name=NULL)
	{
		$startdate = str_replace("_","-",$startdate);	

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where['dealer_id'] = $this->dealer_id;
				}
			

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){
				$where = array();
		
			}else{
				$where['dealer_id'] = $this->dealer_id;
			}


			$this->job_card_model->_table = "view_job_wise_billing";

			if($startdate) {
				$where['issue_date >='] = $startdate.' 00:00:00';
				$where['issue_date <='] = $enddate.' 23:59:59';
			}

			if($name)
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}
			$this->db->where('job_id',$job_id);
			$rows = $this->job_card_model->findAll($where);
			
			// echo $this->db->last_query(); exit; 
			if($rows)
			{
				$this->load->library('Excel');
				$style = array(
			        'alignment' => array(
			            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        )
			    );
				$objPHPExcel = new PHPExcel(); 
				$objPHPExcel->setActiveSheetIndex(0);
				if(is_service_head() || is_national_service_manager() || is_admin()||  is_ccd_incharge() || is_service_dealer_incharge()){

				}else{
					$this->db->where('id',$this->dealer_id);
					$dealer = $this->db->get('dms_dealers')->row_array();
					$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
					$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

				}
				$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Job Wise Billing Detail from '.$startdate.' to '.$enddate)->getStyle("A2:N2")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');

				$objPHPExcel->getActiveSheet()->SetCellValue('A3','S.N.');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3','Issue Date');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3','Dealer Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3','Invoice No');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3','Job Code');
				$objPHPExcel->getActiveSheet()->SetCellValue('F3','Job Description');
				$objPHPExcel->getActiveSheet()->SetCellValue('G3','Status');
				$objPHPExcel->getActiveSheet()->SetCellValue('H3','Price');
				$objPHPExcel->getActiveSheet()->SetCellValue('I3','Discount %');
				$objPHPExcel->getActiveSheet()->SetCellValue('J3','Discount AMT');
				$objPHPExcel->getActiveSheet()->SetCellValue('K3','Final Amount');

				$row = 4;
				$col = 0;        
				foreach($rows as $key => $values) 
				{           
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->issue_date);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->invoice_no);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->job_code);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->description);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->status);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->price);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->discount_percentage);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->discount_amount);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
					$col++;
				

					$col = 0;
					$row++;        
				}

				header("Pragma: public");
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment;filename=jobwhisebillingsummary.xls");
				header("Content-Transfer-Encoding: binary ");
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				ob_end_clean();
				$objWriter->save('php://output');

				
			}
			redirect('service_reports/get_job_wise_billing_summary');
	}

	public function get_part_wise_billing_summary($json = false)
	{
		if($json == 'json') {
			// echo '<pre>'; print_r($this->input->post()); exit();
			$post = $this->input->post('selection');
			// $post = $this->input->post('selection');
			$dealerName = $this->input->post('name');
			$dealer = str_replace('-', ',', $dealerName);
			// print_r($dealer);
			// exit();
			$post = explode(" - ", $post);
			

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$dealer_id = $this->dealer_id;
					$where['dealer_id'] = $dealer_id;
				}
			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge() || is_service_dealer_incharge()  || is_service_finance()){
				$where = array();
		
			}else{
				$dealer_id = $this->dealer_id;
				$where['dealer_id'] = $dealer_id;
			}	
			$this->job_card_model->_table = "view_partwise_billing_detail";
			if($this->input->post('selection')) {
				$where['issue_date >='] = $post[0].' 00:00:00';
				$where['issue_date <='] = $post[1].' 23:59:59';
			}

			if($this->input->post('name'))
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}
			$this->db->where('part_code',$this->input->post('job_id'));
			$rows = $this->job_card_model->findAll($where);
			// echo $this->db->last_query();
			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = 'Part Wise Billing';
		$data['page'] = $this->config->item('template_admin') . "part_wise_billing_report";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}


	public function get_part_wise_billing_summary_dump($startdate=NULL,$enddate=NULL,$part_id = null,$name=NULL)
	{
		$startdate = str_replace("_","-",$startdate);	

			if(is_admin()){
				$where = array();
			}else if( is_service_advisor() || is_accountant() ) {
				if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
					$where['dealer_id'] = $this->dealer_id;
				}
			

			} else if(is_floor_supervisor()){
				$where['dealer_id'] = $this->dealer_id;
			} else if( is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){
				$where = array();
		
			}else{
				$where['dealer_id'] = $this->dealer_id;
			}


			$this->job_card_model->_table = "view_job_wise_billing";

			if($startdate) {
				$where['issue_date >='] = $startdate.' 00:00:00';
				$where['issue_date <='] = $enddate.' 23:59:59';
			}

			if($name)
			{
				$this->db->where("dealer_id IN (".$dealer.")",NULL, false);
			}
			$this->db->where('part_code',$part_id);
			$rows = $this->job_card_model->findAll($where);
			
			// echo $this->db->last_query(); exit; 
			if($rows)
			{
				$this->load->library('Excel');
				$style = array(
			        'alignment' => array(
			            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        )
			    );
				$objPHPExcel = new PHPExcel(); 
				$objPHPExcel->setActiveSheetIndex(0);
				if(is_service_head() || is_national_service_manager() || is_admin()||  is_ccd_incharge() || is_service_dealer_incharge()){

				}else{
					$this->db->where('id',$this->dealer_id);
					$dealer = $this->db->get('dms_dealers')->row_array();
					$objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
					$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

				}
				$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Job Wise Billing Detail from '.$startdate.' to '.$enddate)->getStyle("A2:N2")->applyFromArray($style);
				$objPHPExcel->getActiveSheet()->mergeCells('A2:N2');

				$objPHPExcel->getActiveSheet()->SetCellValue('A3','S.N.');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3','Issue Date');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3','Dealer Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('D3','Invoice No');
				$objPHPExcel->getActiveSheet()->SetCellValue('E3','Part Code');
				$objPHPExcel->getActiveSheet()->SetCellValue('F3','Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('G3','Price');
				$objPHPExcel->getActiveSheet()->SetCellValue('H3','Quantity');
				$objPHPExcel->getActiveSheet()->SetCellValue('I3','Discount %');
				$objPHPExcel->getActiveSheet()->SetCellValue('J3','Final Amount');

				$row = 4;
				$col = 0;        
				foreach($rows as $key => $values) 
				{           
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->issue_date);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->invoice_no);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_code);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
					$col++;
					
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->price);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->display_quantity);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->discount_percentage);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->final_amount);
					$col++;
				

					$col = 0;
					$row++;        
				}

				header("Pragma: public");
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment;filename=partwhisebillingsummary.xls");
				header("Content-Transfer-Encoding: binary ");
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				ob_end_clean();
				$objWriter->save('php://output');

				
			}
			redirect('service_reports/get_job_wise_billing_summary');
	}

}