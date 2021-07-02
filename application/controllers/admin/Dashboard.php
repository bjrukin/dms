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
 * Dashboard
 *
 * Extends the Admin_Controller class
 * 
 */
class Dashboard extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('dashboard');
        $this->load->model('fiscal_years/fiscal_year_model'); 
		
	}

	public function index()
	{
		$this->lang->load('customers/customer');
		$data['header'] = lang('menu_dashboard');
		$data['stock_yards'] = $this->db->get('mst_stock_yards')->result_array();
		
		$data['page'] = $this->config->item('template_admin') . "index_dashboard";
		
		$this->load->view($this->_container, $data);
	}

	public function sales_dashboard()
	{
    	control('Dashboard Sales Report');

		// echo 'here'; exit;
		$data['header'] = 'Sales Dashboard';
		$data['page'] = $this->config->item('template_admin') . "dashboard";
		$this->load->view($this->_container, $data);
	}

	public function sales_dashboard_new()
	{
		$data['header'] = 'Sales Dashboard';
		$data['page'] = $this->config->item('template_admin') . "dashboard_news";
		$this->load->view($this->_container, $data);
	}

	public function logistic_dashboard($year = null)
	{
		control('Dashboard Logistic Report');
		if($year == null){
			$this->db->where('active',true);
			$year_data =$this->fiscal_year_model->find();
			$year = $year_data->nepali_start_date.' - '.$year_data->nepali_end_date;

		}
		$data['active_fiscal'] = urldecode($year);	
		$data['header'] = 'Logistic Dashboard';
		$data['fiscal_years']=$this->fiscal_year_model->findAll();
		$data['stock_yards'] = $this->db->get('mst_stock_yards')->result_array();
		$data['mfg_year'] = $this->db->query('SELECT distinct year FROM view_msil_dispatch_records ORDER BY year')->result_array();
		$data['page'] = $this->config->item('template_admin') . "dashboard_logistic";
		$this->load->view($this->_container, $data);
	}

	public function dashboard_dealer()
	{
		control('Dashboard Dealer Report');

		$data['header'] = 'Dealer Dashboard';
		$data['stock_yards'] = $this->db->get('mst_stock_yards')->result_array();
		$data['page'] = $this->config->item('template_admin') . "dashboard_dealer";
		$this->load->view($this->_container, $data);
	}

	public function dashboard_dealer_new()
	{
		control('Dashboard Dealer Report');

		$data['header'] = 'Dealer Dashboard';
		$data['stock_yards'] = $this->db->get('mst_stock_yards')->result_array();
		// echo '<pre>'; print_r($data['stock_yards']); exit;
		$data['page'] = $this->config->item('template_admin') . "dashboard_dealer_new";
		$this->load->view($this->_container, $data);
	}
	public function management_dashboard()
	{
		control('Dashboard Management');
		
		$data['header'] = 'Management Dashboard';
		$data['mfg_year'] = $this->db->query('SELECT distinct year FROM view_msil_dispatch_records ORDER BY year')->result_array();
		$data['page'] = $this->config->item('template_admin') . "dashboard_management";
		$this->load->view($this->_container, $data);
	}

	public function marketing_dashboard($year = null)
	{
		control('Dashboard Marketing');
		if($year == null){
			$this->db->where('active',true);
			$year_data =$this->fiscal_year_model->find();
			$year = $year_data->nepali_start_date.' - '.$year_data->nepali_end_date;

		}
		$data['active_fiscal'] = urldecode($year);	
		$data['fiscal_years']=$this->fiscal_year_model->findAll();
		$data['header'] = 'Marketing Dashboard';
		$data['page'] = $this->config->item('template_admin') . "marketing_dashboard";
		$this->load->view($this->_container, $data);
	}

	public function spareparts_dashboard()
	{
		control('Service Dashboard');
		$data['fiscal_years']=$this->fiscal_year_model->findAll();
		$data['header'] = 'Spareparts Dashboard';
		$data['page'] = $this->config->item('template_admin') . "spareparts_dashboard";
		$this->load->view($this->_container, $data);
	}
}
