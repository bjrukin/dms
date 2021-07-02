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
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "job_summary";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);

	}

	function get_jobSummary($group){
		$post = $this->input->post('selection');
		$post = explode(" - ", $post);

		if($group == 1) {

			$date_range = array($post[0],$post[1]);

			/*Service Types*/
			$query1 = 'SELECT * from crosstab( $$ SELECT v.vehicle_name, v.variant_name, v.service_type_name,  COUNT (v.service_type_name) FROM view_report_grouped_jobcard v where v.job_card_issue_date >= ? AND v.job_card_issue_date <= ? GROUP BY 1,2,3 $$, $$ SELECT DISTINCT name FROM mst_service_types $$ ) AS ( "vehicle_name" TEXT, "variant_name" TEXT ,  "PAID(AW)" INT , "PAID(UW)" INT , "FREE" INT , "ACCIDENTAL" INT , "AMC" INT , "Other" INT , "RUNNING REPAIR" INT)';

			$data = $this->db->query($query1,$date_range)->result();
		} else {


			$date_range = array($post[0],$post[1],$post[0],$post[1],$post[0],$post[1],$post[0],$post[1],);
			/*Recieved Delivered Pending Ready*/
			$query2 = '
			SELECT jobcard_summary.vehicle_id, jobcard_summary.variant_id, jobcard_summary.deleted_at, jobcard_summary.vehicle_name, jobcard_summary.variant_name,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 WHERE ((jobcard_summary_1.job_card_issue_date >= ?) AND (jobcard_summary_1.job_card_issue_date <= ?)) GROUP BY jobcard_summary_1.vehicle_id, jobcard_summary_1.variant_id, jobcard_summary_1.deleted_at, jobcard_summary_1.vehicle_name, jobcard_summary_1.variant_name) AS recieved,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 WHERE (((jobcard_summary_1.issue_date IS NOT NULL) AND (jobcard_summary_1.job_card_issue_date >= ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) GROUP BY jobcard_summary_1.vehicle_id, jobcard_summary_1.variant_id, jobcard_summary_1.deleted_at, jobcard_summary_1.vehicle_name, jobcard_summary_1.variant_name) AS delivered,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 WHERE ((((jobcard_summary_1.closed_status = 1) AND (jobcard_summary_1.issue_date IS NULL)) AND (jobcard_summary_1.job_card_issue_date = ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) GROUP BY jobcard_summary_1.vehicle_id, jobcard_summary_1.variant_id, jobcard_summary_1.deleted_at, jobcard_summary_1.vehicle_name, jobcard_summary_1.variant_name) AS ready,
			( SELECT count(*) AS count FROM view_report_grouped_jobcard jobcard_summary_1 WHERE (((jobcard_summary_1.closed_status = 0) AND (jobcard_summary_1.job_card_issue_date = ?)) AND (jobcard_summary_1.job_card_issue_date <= ?)) GROUP BY jobcard_summary_1.vehicle_id, jobcard_summary_1.variant_id, jobcard_summary_1.deleted_at, jobcard_summary_1.vehicle_name, jobcard_summary_1.variant_name) AS pending FROM view_report_grouped_jobcard jobcard_summary
			GROUP BY jobcard_summary.vehicle_id, jobcard_summary.variant_id, jobcard_summary.deleted_at, jobcard_summary.vehicle_name, jobcard_summary.variant_name;
			';
			$data = $this->db->query($query2, $date_range)->result();
		}

		echo json_encode($data);
	}

	function foc_reports($json = NULL) {

		if($json != NULL) {

			$post = $this->input->post('selection');
			$post = explode(" - ", $post);
			$where = array();

			$this->job_card_model->_table = "view_report_service_FOC_details";

			if($this->input->post('selection')) {
				$where['issue_date >='] = $post[0];
				$where['issue_date <='] = $post[1];
			}

			$rows = $this->job_card_model->findAll($where);

			$formatter = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
			$formatter->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");

			foreach ($rows as $key => &$value) {
				$value->service_no = ucfirst($formatter->format($value->service_count));
			}
			unset($value);
			
			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "foc_reports";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}

	function pdi_reports($json = NULL) {

		if($json != NULL) {

			$post = $this->input->post('selection');
			$post = explode(" - ", $post);
			$where = array();

			$this->job_card_model->_table = "view_report_service_pdi";

			if($this->input->post('selection')) {
				$where['job_card_issue_date >='] = $post[0];
				$where['job_card_issue_date <='] = $post[1];
			}

			$rows = $this->job_card_model->findAll($where);
			
			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "pdi_reports";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}

	function mechanic_earning($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$date_range = array($post[0],$post[1],);
			}


			$query = "SELECT e.first_name, e.middle_name, e.last_name, (((e.first_name) :: TEXT || ' ' :: TEXT ) || (e.last_name) :: TEXT ) AS mechanic_name, e.designation_id, e.designation_name, SUM (bill.total_jobs) AS jobs, SUM (bill.vat_job) AS vat_job, osw.ow_payment, osw.ow_final_amount, osw.ow_margin, ((( SUM (bill.total_jobs) + SUM (bill.vat_job)) + (osw.ow_payment) :: DOUBLE PRECISION ) + osw.ow_margin ) AS net_amount FROM ((( view_employees e JOIN view_report_grouped_jobcard j ON ((j.mechanics_id = e. ID))) JOIN ser_billing_record bill ON (( j.jobcard_group = bill.jobcard_group ))) LEFT JOIN ( SELECT ow.mechanics_id, SUM (ow.total_amount) AS ow_payment, SUM (ow.billing_final_amount) AS ow_final_amount, ( SUM (ow.billing_final_amount) - (SUM(ow.total_amount)) :: DOUBLE PRECISION ) AS ow_margin FROM ser_outside_work ow WHERE ( ow.billing_final_amount IS NOT NULL ) GROUP BY ow.mechanics_id ) osw ON ((e. ID = osw.mechanics_id))) WHERE ((e.designation_id = 4) AND (e.employee_type = 2)) AND ( bill.issue_date >= ? AND bill.issue_date <= ? ) GROUP BY e.first_name, e.middle_name, e.last_name, e.designation_id, e.designation_name, osw.ow_payment, osw.ow_final_amount, osw.ow_margin;";
			
			$rows = $this->db->query($query, $date_range)->result();


			echo json_encode(array('rows'=>$rows));
			exit;
		}

		// Display Page
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "mechanic_earning";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);
	}

	function counter_sales($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$date_range = array($post[0],$post[1],);
			}

			if( empty($date_range)){
				$this->job_card_model->_table = "view_report_service_counter_sales";
				$rows = $this->job_card_model->findAll();

			} else {
				$query = " SELECT sp.category_id, c.name AS category_name, sum(cparts.quantity) AS quantity, (sum((((cparts.price * cparts.quantity) * cparts.discount_percentage) / 100)))::double precision AS discount_amount, sum((cparts.price * cparts.quantity)) AS taxable, sum(cparts.cash_discount) AS cash_discount, sum((cparts.final_amount * (0.13)::double precision)) AS taxes, sum(COALESCE(unwar.uw_amount, (0)::real)) AS uw_amount, (((sum((cparts.price * cparts.quantity)))::double precision + sum((cparts.final_amount * (0.13)::double precision))) - sum(COALESCE(unwar.uw_amount, (0)::real))) AS net_amount, csales.deleted_at FROM (((((ser_counter_sales csales JOIN ser_parts cparts ON ((cparts.bill_id = csales.id))) JOIN ser_billing_record cbills ON ((csales.billing_record_id = cbills.id))) JOIN mst_spareparts sp ON ((cparts.part_id = sp.id))) JOIN mst_spareparts_category c ON ((sp.category_id = c.id))) LEFT JOIN ( SELECT sp_1.category_id, pa.warranty, sum(pa.final_amount) AS uw_amount FROM ((ser_parts pa JOIN mst_spareparts sp_1 ON ((pa.part_id = sp_1.id))) JOIN mst_spareparts_category cat ON ((sp_1.category_id = cat.id))) WHERE (pa.warranty IS NOT NULL) GROUP BY pa.warranty, sp_1.category_id) unwar ON ((unwar.category_id = sp.category_id))) WHERE ((((cparts.bill_id IS NOT NULL) AND (cparts.estimate_id IS NULL)) AND (cparts.warranty IS NULL)) AND (cparts.jobcard_group IS NULL) and (csales.date_time between ? and ?)) and ( 'deleted_at' IS NULL) GROUP BY sp.category_id, c.name, csales.deleted_at;";

				$rows = $this->db->query($query, $date_range)->result();
			}
			
			echo json_encode(array('rows'=>$rows));
			exit;
			
		}

		// Display Page
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "counter_sales";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}

	function sales_summary($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$date_range = array($post[0],$post[1],);
			}

			// if( empty($date_range)){
			$this->job_card_model->_table = "view_report_service_sales_summary";
			$rows = $this->job_card_model->findAll();

			/*} else {
				$query = " SELECT sp.category_id, c.name AS category_name, sum(cparts.quantity) AS quantity, (sum((((cparts.price * cparts.quantity) * cparts.discount_percentage) / 100)))::double precision AS discount_amount, sum((cparts.price * cparts.quantity)) AS taxable, sum(cparts.cash_discount) AS cash_discount, sum((cparts.final_amount * (0.13)::double precision)) AS taxes, sum(COALESCE(unwar.uw_amount, (0)::real)) AS uw_amount, (((sum((cparts.price * cparts.quantity)))::double precision + sum((cparts.final_amount * (0.13)::double precision))) - sum(COALESCE(unwar.uw_amount, (0)::real))) AS net_amount, csales.deleted_at FROM (((((ser_counter_sales csales JOIN ser_parts cparts ON ((cparts.bill_id = csales.id))) JOIN ser_billing_record cbills ON ((csales.billing_record_id = cbills.id))) JOIN mst_spareparts sp ON ((cparts.part_id = sp.id))) JOIN mst_spareparts_category c ON ((sp.category_id = c.id))) LEFT JOIN ( SELECT sp_1.category_id, pa.warranty, sum(pa.final_amount) AS uw_amount FROM ((ser_parts pa JOIN mst_spareparts sp_1 ON ((pa.part_id = sp_1.id))) JOIN mst_spareparts_category cat ON ((sp_1.category_id = cat.id))) WHERE (pa.warranty IS NOT NULL) GROUP BY pa.warranty, sp_1.category_id) unwar ON ((unwar.category_id = sp.category_id))) WHERE ((((cparts.bill_id IS NOT NULL) AND (cparts.estimate_id IS NULL)) AND (cparts.warranty IS NULL)) AND (cparts.jobcard_group IS NULL) and (csales.date_time between ? and ?)) and ( 'deleted_at' IS NULL) GROUP BY sp.category_id, c.name, csales.deleted_at;";

				$rows = $this->db->query($query, $date_range)->result();
			}*/
			
			echo json_encode(array('rows'=>$rows));
			exit;
			
		}
	}


	function dent_paint($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$date_range = array($post[0],$post[1],);
			}

			// if( empty($date_range)){
			$this->job_card_model->_table = "view_report_service_dent_paint";
			$rows = $this->job_card_model->findAll();

			/*} else {
				$query = " SELECT sp.category_id, c.name AS category_name, sum(cparts.quantity) AS quantity, (sum((((cparts.price * cparts.quantity) * cparts.discount_percentage) / 100)))::double precision AS discount_amount, sum((cparts.price * cparts.quantity)) AS taxable, sum(cparts.cash_discount) AS cash_discount, sum((cparts.final_amount * (0.13)::double precision)) AS taxes, sum(COALESCE(unwar.uw_amount, (0)::real)) AS uw_amount, (((sum((cparts.price * cparts.quantity)))::double precision + sum((cparts.final_amount * (0.13)::double precision))) - sum(COALESCE(unwar.uw_amount, (0)::real))) AS net_amount, csales.deleted_at FROM (((((ser_counter_sales csales JOIN ser_parts cparts ON ((cparts.bill_id = csales.id))) JOIN ser_billing_record cbills ON ((csales.billing_record_id = cbills.id))) JOIN mst_spareparts sp ON ((cparts.part_id = sp.id))) JOIN mst_spareparts_category c ON ((sp.category_id = c.id))) LEFT JOIN ( SELECT sp_1.category_id, pa.warranty, sum(pa.final_amount) AS uw_amount FROM ((ser_parts pa JOIN mst_spareparts sp_1 ON ((pa.part_id = sp_1.id))) JOIN mst_spareparts_category cat ON ((sp_1.category_id = cat.id))) WHERE (pa.warranty IS NOT NULL) GROUP BY pa.warranty, sp_1.category_id) unwar ON ((unwar.category_id = sp.category_id))) WHERE ((((cparts.bill_id IS NOT NULL) AND (cparts.estimate_id IS NULL)) AND (cparts.warranty IS NULL)) AND (cparts.jobcard_group IS NULL) and (csales.date_time between ? and ?)) and ( 'deleted_at' IS NULL) GROUP BY sp.category_id, c.name, csales.deleted_at;";

				$rows = $this->db->query($query, $date_range)->result();
			}*/
			
			echo json_encode(array('rows'=>$rows));
			exit;
			
		}

		// Display Page
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "dent_paint";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}

	function mechanic_consume($json = NULL) {
		if($json == 'json') {

			$post = $this->input->post('selection');
			$post = explode(" - ", $post);
			$date_range = array();

			if($this->input->post('selection')) {
				$date_range = array($post[0],$post[1],);
			}

			// if( empty($date_range)){
			$query = "SELECT * from crosstab($$ SELECT e. ID, e.mechanic_name, e.jobs, e.vat_job, e.ow_payment, e.ow_margin, e.ow_final_amount * 0.13 as ow_tax, e.category_name, e.cat_amt FROM view_report_service_mechanic_consume_helper e GROUP BY 1,2,3,4,5,6,7,8,9 $$, $$ SELECT mst_spareparts_category.name FROM mst_spareparts_category $$ ) AS (\"id\" TEXT, \"mechanic_name\" TEXT, \"taxable\" FLOAT,\"taxes\" FLOAT, \"ow_payment\" FLOAT, \"ow_margin\" FLOAT, \"ow_tax\" FLOAT , \"accessories\" FLOAT , \"spareparts\" FLOAT , \"tools\" FLOAT , \"misc\" FLOAT , \"books\" FLOAT)";

			$rows = $this->db->query($query)->result();
			/*} else {
			$this->job_card_model->_table = "view_report_service_dent_paint";
			$rows = $this->job_card_model->findAll();

			]}*/

			echo json_encode(array('rows'=>$rows));
			exit;

		}

		// Display Page
		$data['header'] = lang('service_reports');
		$data['page'] = $this->config->item('template_admin') . "mechanic_consume";
		$data['module'] = 'service_reports';
		$this->load->view($this->_container,$data);	
	}



}