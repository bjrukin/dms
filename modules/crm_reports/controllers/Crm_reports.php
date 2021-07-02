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
 * Crm_reports
 *
 * Extends the Report_Controller class
 * 
 */

class Crm_reports extends Report_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('CRM Reports');

        $this->lang->load('crm_reports/crm_report');
        $this->load->model('partial_payments/partial_payment_model');
        $this->load->model('stock_records/stock_record_model');


    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('crm_reports');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'crm_reports';
		$this->load->view($this->_container,$data);
	}

    public function dashboard($type=null)
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }
        // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "dashboard";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = $this->report_criteria[$type]['col'];
        $data['default_row']            = null;

        $this->load->view($data['page'], $data);
    }

    public function generate_test_drive($type = null){
        $data['header'] = lang('crm_reports');
        $data['page'] = $this->config->item('template_admin') . "test_drive_report";
        $data['module'] = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        // $data['default_col']            = $this->report_criteria[$type]['col'];
        $data['default_row']            = null;
        $this->load->view($this->_container,$data);
    }

    public function generate($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }

        // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "generate-test";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = $this->report_criteria[$type]['col'];
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }

    public function get_test_drive_report_json()
    {
        
        // echo '<pre>'; print_r($this->input->post()); exit;
        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(td_date_en >= '".$date_range[0]."' AND td_date_en <= '".$date_range[1]."')"; 
            }
        }
        $fields[] = 'td_date_en AS "Test Drive Date"';
        $fields[] = 'td_date_np AS "Test Drive Date(NP)"';
        $fields[] = 'duration AS "Duration"';
        $fields[] = 'td_location AS "Location"';
        $fields[] = 'vehicle_name AS "Vehicle Name"';
        $fields[] = 'variant_name AS "Variant Name"';
        $fields[] = 'chassis_no_test AS "Chassis Number"';
        $fields[] = 'executive_name AS "Executive"';
        $fields[] = 'dealer_name AS "Dealer"';
        $fields[] = 'sorce_name AS "Source"';
        $fields[] = 'status_name AS "Status"';
        $fields[] = 'year_np AS "Year"';
        $fields[] = 'month_np AS "Month"';
        $fields[] = 'kms AS "Kms"';
        $fields[] = 'opening_kms AS "Opening Kms"';
        $fields[] = 'closing_kms AS "Closing Kms"';
        $fields[] = 'fuel AS "Fuel"';
        $fields[] = 'reported_by AS "Reported By"';
        // $fields[] = 'fuel_location AS "Fuel location"';
        $whereCondition[] = " ( deleted_at IS NULL )";

        $this->db->select($fields);

        $this->db->from('view_test_drive_report');
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();

        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function generate_taxi_sales($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }

        // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "taxi_sales";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = null;
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }
    public function inquiry_edit($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }

        // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "inquiry_edit";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = "Inquiry Edit";  
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }
    public function generate_bank_loan_summary($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }

        // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "bank_loan_summary";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = 'Month (BS)';
        $data['default_row']            = 'Bank Name';

        $this->load->view($this->_container,$data);
    }
    
    public function inquiry_vehicle_edit($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }

        // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "inquiry_vehicle_edit";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = "Inquiry Vehicle Edit";  
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }

    public function generate_payment_details($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }

        // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "payment_details";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = null;
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }

    public function get_report_dashboard_json() 
    {
        $report_criteria_index = $this->input->post('report_criteria'); 

        $report_criteria = $this->report_criteria[$report_criteria_index];

        extract($report_criteria);

        $whereCondition = array();

        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $CI->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $CI->session->userdata('employee')['employee_id'] . ")";
        }
            $whereCondition[] = " ( deleted_at IS NULL )";
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
        // $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY-MM\') AS "Month (AD)"';
        // $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY\') AS "Year (AD)"';
        // $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
        // $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)"';
        // $fields[] = 'status_name  AS "Inquiry Status"';
        // $fields[] = 'executive_name AS "Executive"';
        // $fields[] = 'dealer_name AS "Dealer"';
        // $fields[] = 'vehicle_name AS "Model"';
        // $fields[] = 'source_name AS "Inquiry Source"';
        // $fields[] = 'inquiry_kind AS "Inquiry Kind"';
        // $fields[] = 'inquiry_type AS "Inquiry Type"';
        // $fields[] = 'payment_mode_name AS "Payment Mode"';
        // $fields[] = 'customer_type_name AS "Customer Type"';

        if ($report_criteria_index == 'inquiry_status')
        {
            $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
            $fields[] = 'status_name  AS "Inquiry Status"';
            $fields[] = 'vehicle_name AS "Model"';
        }
        else if ($report_criteria_index == 'inquiry_conversion') 
        {   
            // $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY-MM\') AS "Month (AD)"';
            // $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY\') AS "Year (AD)"';
            $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
            // $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)"';
            // $fields[] = 'status_name  AS "Inquiry Status"';
            // $fields[] = 'executive_name AS "Executive"';
            // $fields[] = 'dealer_name AS "Dealer"';
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'source_name AS "Inquiry Source"';
            // $fields[] = 'inquiry_kind AS "Inquiry Kind"';
            // $fields[] = 'inquiry_type AS "Inquiry Type"';
            // $fields[] = 'payment_mode_name AS "Payment Mode"';
            // $fields[] = 'customer_type_name AS "Customer Type"';
            $fields[] = 'CASE WHEN status_id = 15 THEN \'Retail\' ELSE \'Pending\' END AS "Inquiry Conversion"';
        } 
        else if ($report_criteria_index == 'inquiry_test_drive_conversion') 
        {
            $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY-MM\') AS "Month (AD)"';
            // $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY\') AS "Year (AD)"';
            $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
            // $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)"';
            // $fields[] = 'status_name  AS "Inquiry Status"';
            // $fields[] = 'executive_name AS "Executive"';
            // $fields[] = 'dealer_name AS "Dealer"';
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'source_name AS "Inquiry Source"';
            // $fields[] = 'inquiry_kind AS "Inquiry Kind"';
            // $fields[] = 'inquiry_type AS "Inquiry Type"';
            // $fields[] = 'payment_mode_name AS "Payment Mode"';
            // $fields[] = 'customer_type_name AS "Customer Type"';
            $fields[] = 'CASE WHEN status_id = 15 and test_drive = \'TAKEN\' THEN \'Converted\' WHEN status_id <> 15 and test_drive = \'TAKEN\' THEN \'Not Converted\' ELSE \'Test Drive Not Taken\' END AS "Test Drive Conversion"';
        }  
        else if ($report_criteria_index == 'inquiry_type') 
        {
            $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
            $fields[] = 'inquiry_type AS "Inquiry Type"';
            $fields[] = 'vehicle_name AS "Model"';
        } 

        $this->db->select($fields);

        $this->db->from($report_criteria['dbview']);
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();


        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function info()
    {
        phpinfo();
    }
    public function get_report_json() 
    {
// echo 'here';exit;
        ini_set('memory_limit', '-1');
        $report_criteria_index = $this->input->post('report_criteria'); 

        $report_criteria = $this->report_criteria[$report_criteria_index];

        extract($report_criteria);

        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')"; 
            }
        }

        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }

        // echo '<pre>'; print_r($whereCondition); exit;
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
        if($report_criteria_index == 'inquiry_source'){
        	$fields[] = 'inquiry_ageing AS "Inquiry Age"';
            $fields[] = 'retail_year AS "Retail Nepali Year"';
            $fields[] = 'nepali_month AS "Retail Nepali Month"';
            $fields[] = 'sale_booked_date_np AS "Booking Date Nepali"';
            $fields[] = 'sale_booked_date_np_month AS "Booking Nepali Month"';
            $fields[] = 'sale_booked_date_year AS "Booking Nepali Year"';
            $fields[] = 'notes AS "Cancel Note"';
            $fields[] = 'booking_cancel_reason AS "Cancel Reason"';
            $fields[] = 'test_drive AS "Test Drive"';
            $fields[] = 'test_drive_status AS "Test Drive Status"';
            $fields[] = 'occupation_name AS "Occupation"';
            $fields[] = 'dispatched_date_np AS "Dispatch Date"';
        	// $fields[] = 'inquiry_age AS "Inquiry Age"';

        }
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY-MM\') AS "Month (AD)"';
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY\') AS "Year (AD)"';
        $fields[] = 'inquiry_date_en AS "Inquiry Date EN"';
        $fields[] = 'inquiry_date_np AS "Inquiry Date NP"';
        $fields[] = 'booked_date AS "Booked Date"';
        $fields[] = 'booking_ageing AS "Booking Age"';
        $fields[] = 'TO_CHAR(DATE(vehicle_delivery_date), \'YYYY-MM\') AS "Retail Month (AD)"';
        $fields[] = 'vehicle_delivery_date AS "Retail Date EN"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)"';
        $fields[] = 'status_name  AS "Inquiry Status"';
        $fields[] = 'sub_status_name  AS "Inquiry Sub Status"';
        $fields[] = 'status_date  AS "Status Date"';
        $fields[] = 'executive_name AS "Executive"';
        $fields[] = 'dealer_name AS "Dealer"';
        $fields[] = 'vehicle_name AS "Model"';
        $fields[] = 'variant_name AS "Variant"';
        $fields[] = 'color_name AS "Color"';
        $fields[] = 'source_name AS "Inquiry Source"';
        $fields[] = 'inquiry_kind AS "Inquiry Kind"';
        $fields[] = 'inquiry_type AS "Inquiry Type"';
        $fields[] = 'payment_mode_name AS "Payment Mode"';
        $fields[] = 'customer_type_name AS "Customer Type"';
        $fields[] = 'CASE WHEN bank_name IS NULL THEN \'No Data\' ELSE bank_name END AS "Bank Name"';
        $fields[] = 'CASE WHEN bank_branch IS NULL THEN \'No Data\' ELSE bank_branch END AS "Branch Name"';
        $fields[] = 'CASE WHEN bank_staff IS NULL THEN \'No Data\' ELSE bank_staff END AS "Bank Staff"';
        $fields[] = 'full_name AS "Customer Name"';
        $fields[] = 'mobile_1 AS "Mobile No"';
        $fields[] = 'address_1 AS "Address_1"';
        $fields[] = 'CASE WHEN event_name IS NULL OR event_name = \'N/A\' THEN \' No Event \'  ELSE event_name END AS "Event"';

        if ($report_criteria_index == 'inquiry_conversion') 
        {
             $fields[] = 'CASE WHEN status_id = 15 THEN \'Retail\' ELSE \'Pending\' END AS "Inquiry Conversion"';
        } 
        else if ($report_criteria_index == 'inquiry_test_drive_conversion') 
        {
            $fields[] = 'CASE WHEN status_id = 15 and test_drive = \'TAKEN\' THEN \'Converted\' WHEN status_id <> 15 and test_drive = \'TAKEN\' THEN \'Not Converted\' ELSE \'Test Drive Not Taken\' END AS "Test Drive Conversion"';
        }  
        else if ($report_criteria_index == 'inquiry_demographic_information') 
        {
            $fields[] = 'age_group AS "Age Group"';
            $fields[] = 'gender AS "Gender"';
            $fields[] = 'zone_name AS "Zone"';
            $fields[] = 'district_name AS "District"';
            $fields[] = 'occupation_name AS "Occupation"';
            $fields[] = 'marital_status AS "Marital Status"';
            $fields[] = 'family_size AS "Family Size"';
        } 
        else if ($report_criteria_index == 'inquiry_institution') 
        {
            $fields[] = 'institution_name AS "Institution"';
        } 
        else if ($report_criteria_index == 'inquiry_reason_purchase' || $report_criteria_index == 'inquiry_reason_non_purchase' || $report_criteria_index == 'inquiry_lost_case') 
        {
            $fields[] = 'reason_name AS "Reason"';
        } 
        else if ($report_criteria_index == 'inquiry_demographic_information') 
        {
        }

        // remove deleted data
        $whereCondition[] = " ( deleted_at IS NULL )";

        $this->db->select($fields);

        $this->db->from($report_criteria['dbview']);
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();
        // echo $this->db->last_query();
        
        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
        
    }

     public function get_taxi_sales_report_json() 
    {
        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')";
            }
        }

        // ACCESS LEVEL CHECK STARTS
        // $is_showroom_incharge = NULL;
        // $is_sales_executive = NULL;
    
        // $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        // if (empty($dealer_list)) {
        //     $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
        //     $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        // }
        
        // if(!empty($dealer_list)) {
        //     $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        // } elseif ($is_showroom_incharge) {
        //     $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        // } elseif ($is_sales_executive) {
        //     $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        // }
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY-MM\') AS "Month (AD)"';
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY\') AS "Year (AD)"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)"';
        $fields[] = 'status_name  AS "Inquiry Status"';
        $fields[] = 'sub_status_name  AS "Inquiry Sub Status"';
        $fields[] = 'executive_name AS "Executive"';
        $fields[] = 'dealer_name AS "Dealer"';
        $fields[] = 'vehicle_name AS "Model"';
        $fields[] = 'variant_name AS "Variant"';
        $fields[] = 'color_name AS "Color"';
        $fields[] = 'source_name AS "Inquiry Source"';
        $fields[] = 'inquiry_kind AS "Inquiry Kind"';
        $fields[] = 'inquiry_type AS "Inquiry Type"';
        $fields[] = 'payment_mode_name AS "Payment Mode"';
        $fields[] = 'customer_type_name AS "Customer Type"';
        $fields[] = 'contact_1_name AS "Broker Name"';
        $fields[] = 'inquiry_no AS "Inquiry No"';
        $fields[] = 'CASE WHEN bank_name IS NULL THEN \'No Data\' ELSE bank_name END AS "Bank Name"';
        $fields[] = 'CASE WHEN bank_branch IS NULL THEN \'No Data\' ELSE bank_branch END AS "Branch Name"';
        $fields[] = 'CASE WHEN bank_staff IS NULL THEN \'No Data\' ELSE bank_staff END AS "Bank Staff"';
        $whereCondition[] = " ( dealer_id = 75)";

        
        $this->db->select($fields);

        $this->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();
        
        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function get_name_edit() 
    {
        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(created_at >= '".$date_range[0]."' AND created_at <= '".$date_range[1]."')";
            }
        }
        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
        $fields[] = 'TO_CHAR(DATE(created_at), \'YYYY-MM\') AS "Month (AD)"';
        $fields[] = 'new_name  AS "New Name"';
        $fields[] = 'old_name  AS "Old Name"';
        $fields[] = 'inquiry_no AS "Inquiry No"';
        $fields[] = 'dealer_name AS "Dealer"';


        
        $this->db->select($fields);

        $this->db->from('view_customer_name_edit');
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();
         // echo $this->db->last_query();
        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }
    
    public function get_vehicle_edit() 
    {
        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(created_at >= '".$date_range[0]."' AND created_at <= '".$date_range[1]."')";
            }
        }
        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
        $fields[] = 'TO_CHAR(DATE(date), \'YYYY-MM\') AS "Month (AD)"';
        $fields[] = 'inquiry_no AS "Inquiry No"';
        $fields[] = 'dealer_name AS "Dealer"';
        $fields[] = 'full_name  AS "Customer Name"';
        $fields[] = 'new_vehicle_name  AS "New vehicle"';
        $fields[] = 'new_variant_name  AS "New variant"';
        $fields[] = 'new_color_name  AS "New color"';
        $fields[] = 'prev_vehicle_name  AS "Previous vehicle"';
        $fields[] = 'prev_variant_name  AS "Previous variant"';
        $fields[] = 'prev_color_name  AS "Previous color"';
        $fields[] = 'name  AS "Status Name"';
        
        $this->db->select($fields);

        $this->db->from('view_vehicle_edit');
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();
         // echo $this->db->last_query();
        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }
    
    public function get_bank_loan_summary()
    {
        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')";
            }
        }

        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY-MM\') AS "Month (AD)"';
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY\') AS "Year (AD)"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)"';
        $fields[] = 'status_name  AS "Inquiry Status"';
        $fields[] = 'executive_name AS "Executive"';
        $fields[] = 'dealer_name AS "Dealer"';
        $fields[] = 'vehicle_name AS "Model"';
        $fields[] = 'variant_name AS "Variant"';
        $fields[] = 'color_name AS "Color"';
        $fields[] = 'source_name AS "Inquiry Source"';
        $fields[] = 'inquiry_kind AS "Inquiry Kind"';
        $fields[] = 'inquiry_type AS "Inquiry Type"';
        $fields[] = 'payment_mode_name AS "Payment Mode"';
        $fields[] = 'customer_type_name AS "Customer Type"';
        $fields[] = 'CASE WHEN bank_name IS NULL THEN \'No Data\' ELSE bank_name END AS "Bank Name"';
        $fields[] = 'CASE WHEN bank_branch IS NULL THEN \'No Data\' ELSE bank_branch END AS "Branch Name"';
        $fields[] = 'CASE WHEN bank_staff IS NULL THEN \'No Data\' ELSE bank_staff END AS "Bank Staff"';


        $this->db->select($fields);

        $this->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();
        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function get_payment_details_report()
    {
        $this->partial_payment_model->_table = "view_customer_payment_details";

        $whereCondition = array();
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }
        
        search_params();
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        $total=$this->partial_payment_model->find_count();
        
        // paging('id');
        
        search_params();
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        $rows=$this->partial_payment_model->findAll();

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_partial_payment()
    {
         $sales_vehicle_id = $this->input->post('svp_id');
        $rows = $this->partial_payment_model->findAll(array('vehicle_process_id'=>$sales_vehicle_id));
        echo json_encode($rows);
    }

    public function inquiry_trend()
    {
        $data['date_1'] = date("F d, Y", strtotime("-1 months")); 
        $data['date_2'] = date("F d, Y"); 

        $type = 'inquiry_trend';
        $data['type']        = $type;  
        $data['report_type'] = humanize(ucfirst($type));  

        // Display Page
        $data['header'] = lang('inquiry_trend');
        $data['page'] = $this->config->item('template_admin') . "inquiry_trend";
        $data['module'] = 'crm_reports';
        $this->load->view($this->_container,$data);
    }

    public function get_datafield_sources() 
    {
        $start_date     = $this->input->get('start_date');
        $end_date       = $this->input->get('end_date');
        $table_view     = $this->input->get('table_view');
        $column_name    = $this->input->get('column_name');
        $group_criteria   = ($this->input->get('group_criteria')) ? $this->input->get('group_criteria') : 'dealer_name';

        if ($group_criteria == 'month') {
            $sourceArray = array();
            $sourceArray[] = array('name' => 'Duration', 'type' =>'string');
            $sourceArray[] = array('name' => 'inquiries', 'type' =>'number');

            $seriesArray = array();
            $seriesArray[] = array('dataField' => 'inquiries', 'displayText'=> 'Inquiries', 'lineWidth'=> 2 );

            echo json_encode(array('source' => $sourceArray, 'series' => $seriesArray));
            exit;
        }

        $conditions     = array();
        $start_date     = date('Y-m-d', strtotime($start_date));
        $end_date       = date('Y-m-d', strtotime($end_date));
        
        $conditions[]   = " ({$column_name} BETWEEN '{$start_date}' AND '{$end_date}') ";
        $where_query    = implode(' AND ', $conditions);
        
        $q = "SELECT DISTINCT COALESCE( NULLIF(regexp_replace(lower({$group_criteria}), '[^a-zA-Z]', '', 'g'),'') , 'NA' ) AS group_criteria_formatted, {$group_criteria} AS {$group_criteria} FROM {$table_view} WHERE {$where_query} ORDER BY 1";

        $records = $this->db->query($q)->result_array();

        //source
        $sourceArray = array();
        $seriesArray = array();
        if($records) {
            $sourceArray[] = array('name' => 'Duration', 'type' =>'string');
            foreach ($records as $record) {
                $sourceArray[] = array('name' => $record['group_criteria_formatted'], 'type' => 'number');
                $seriesArray[] = array('dataField' => $record['group_criteria_formatted'], 'displayText'=> ($record[$group_criteria] != NULL) ? $record[$group_criteria] : 'N/A', 'lineWidth'=> 2 );
            }
        }
        echo json_encode(array('source' => $sourceArray, 'series' => $seriesArray));
    }

    public function inquiry_trend_json()
    {
        $date1 = date("Y-m-d", strtotime("-1 months")); 
        $date2 = date('Y-m-d');     
        $format = 'YYYY-Mon-DD';
        $trunc = 'day';

        if ($this->input->get('date_range')) {
            $date_range = $this->input->get('date_range');
            $date1 = date('Y-m-d', strtotime($date_range['from']));
            $date2 = date('Y-m-d', strtotime($date_range['to']));
        }

        if ($this->input->get('graph_format')) {
            $format = $this->input->get('graph_format');
            switch($format){
                case 'Day':
                    $format = 'YYYY-Mon-DD';
                    $trunc = 'day';
                    break;
                case 'Month':
                    $format = 'YYYY-Mon';
                    $trunc = 'month';
                    break;
                case 'Year':
                    $format = 'YYYY';
                    $trunc = 'year';
                    break;
            }
        }

        $table_view     = $this->input->get('table_view');
        $column_name    = $this->input->get('column_name');
        $group_criteria   = ($this->input->get('group_criteria')) ? $this->input->get('group_criteria') : 'dealer_name';

        $conditions = array();
        $conditions[] = " ({$column_name} between '{$date1}' AND '{$date2}') ";

        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $conditions[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $conditions[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $conditions[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }
        // ACCESS LEVEL CHECK ENDS
        
        $where_query = implode(' AND ', $conditions);

        if ($group_criteria != 'month') {

            $sql = <<<EOF
SELECT
    generate_crosstab_sql_plain (
        $$ SELECT DATE_TRUNC('{$trunc}', {$column_name}), TO_CHAR({$column_name},'{$format}') AS month, REGEXP_REPLACE(LOWER({$group_criteria}), '[^a-zA-Z]', '', 'g') AS {$group_criteria}, "count"(*) FROM {$table_view} WHERE {$where_query} GROUP BY 1,2,3 ORDER BY 1,2,3 $$,
        $$ SELECT DISTINCT REGEXP_REPLACE(lower({$group_criteria}), '[^a-zA-Z]', '', 'g') AS {$group_criteria} FROM {$table_view} WHERE {$where_query} ORDER BY {$group_criteria} $$,
        'int',
        '"Date" text,  "Duration" text') AS sqlstring
    
EOF;
            $res = $this->db->query($sql)->row_array();
            $data = $this->db->query($res['sqlstring'])->result_array();
        } else {
            $sql = <<<EOF
SELECT DATE_TRUNC('{$trunc}', inquiry_date_en) AS "Date", TO_CHAR(inquiry_date_en,'{$format}') AS "Duration", COUNT(*) AS inquiries FROM {$table_view} WHERE {$where_query} GROUP BY 1,2 ORDER BY 1,2;
EOF;
            $data = $this->db->query($sql)->result_array();
        }

        array_walk_recursive($data, array($this,'array_replace_null_by_zero'));

        echo json_encode($data);
    }

    public function retail_finance()
    {
        $data['date_1'] = date("F d, Y", strtotime("-1 months")); 
        $data['date_2'] = date("F d, Y"); 

        $type = 'retail_finance';
        $data['type']        = $type;  
        $data['report_type'] = humanize(ucfirst($type));  

        // Display Page
        $data['header'] = lang('retail_finance');
        $data['page'] = $this->config->item('template_admin') . "retail_finance";
        $data['module'] = 'crm_reports';
        $this->load->view($this->_container,$data);
    }

    public function retail_finance_json()
    {
        // $report_criteria_index = $this->input->post('report_criteria'); 

        // $report_criteria = $this->report_criteria[$report_criteria_index];

        // extract($report_criteria);

        // $group_name = $group = $this->input->post('group_criteria');

        // $column_name = trim(ucwords(str_replace('name', '', str_replace("_", " ", $column))));

        // $group_name_label = trim(ucwords(str_replace('name', '', str_replace("_", " ", $group_name))));

        $whereCondition = array();

        $where1 = null;

        // $whereCondition[] = ' payment_mode_id = 2 '; 

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
               $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')";

            }
        }

        $dealer_ids = $this->input->post('dealer_id');
        if ($dealer_ids != '' && $dealer_ids != 0) {
            $whereCondition[] = " dealer_id in ($dealer_ids) ";            
        }

        // ACCESS LEVEL CHECK STARTS
        // $is_dealer_only = NULL;
    
        // $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        // if (empty($dealer_list)) {
        //     $is_dealer_only = (is_dealer_only()) ? TRUE : NULL; 
        // }
        
        // if(!empty($dealer_list)) {
        //     $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        // } elseif ($is_dealer_only) {
        //     $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        // }
        // ACCESS LEVEL CHECK ENDS
        
        if (!empty($whereCondition)) {
            $where1 = " WHERE " . implode(" AND " , $whereCondition);
        }

        //
        $table = array();
        
        //ROW 1
        $sql = "SELECT COUNT(*) AS total FROM view_inquiry_retail {$where1}";
        $result = $this->db->query($sql)->result_array();
        $total  = $result[0]['total'];
        
        $where = ($where1 != null) ? $where1 . ' AND payment_mode_id = 2': ' WHERE  payment_mode_id = 2';
        $sql = "SELECT COUNT(*) as total FROM view_inquiry_retail {$where}";
        $result = $this->db->query($sql)->result_array();
        $financeTotal  = $result[0]['total'];
        
        $financeTotal = ($financeTotal > 0) ? $financeTotal : 0;
        $total = ($total > 0) ? $total : 0;

        $percent = 0;
        if ($total > 0) {
            $percent = number_format( (($financeTotal/$total) * 100),2);
        }

        $table[] = array(
                        'SN'                    => '1', 
                        'Performance Measure'   => 'Overall finance % across dealership(Funding Banks on Retail)', 
                        'UOM'                   => '%', 
                        'Target'                => '80',
                        'Actual'                => $percent, 
                        'Variance'              => abs(80 - $percent)
                    );

        // ROW 2
        // $status_id = STATUS_DOCUMENT_COMPLETE;
        $where = ($where1 != null) ? $where1 . ' AND bank_id <> 99999': ' WHERE bank_id <> 99999';
        $sql = "SELECT AVG(ir.status_6::date - ir.status_4::date) AS avg_time FROM view_retail_finance ir {$where}";
        $result = $this->db->query($sql)->result_array();
        $avg_time = number_format($result[0]['avg_time'],02);

        $table[] = array(
                        'SN'                    => '2', 
                        'Performance Measure'   => 'Document Completion Date from booking date <10 days(Funding Banks)', 
                        'UOM'                   => 'Day', 
                        'Target'                => '10',
                        'Actual'                => $avg_time, 
                        'Variance'              => abs(10 - $avg_time)
                    );


        // ROW 3
        // $status_id = STATUS_DO_APPROVAL;
        $where = ($where1 != null) ? $where1 . ' AND bank_id <> 99999': ' WHERE bank_id <> 99999';
        $sql = "SELECT AVG(ir.status_8::date - ir.status_6::date) AS avg_time FROM view_retail_finance ir {$where}";
        $result = $this->db->query($sql)->result_array();
        $avg_time = number_format($result[0]['avg_time'],2);
        
        $table[] = array(
                        'SN'                    => '3', 
                        'Performance Measure'   => 'DO collection date from Document submission confirmation <5 days', 
                        'UOM'                   => 'Day', 
                        'Target'                => '5',
                        'Actual'                => $avg_time, 
                        'Variance'              => abs(5 - $avg_time)
                    );

         // ROW 3a, 3b, 3c
        $status_id = STATUS_DO_APPROVAL;
        $where = ($where1 != null) ? $where1 . ' AND bank_id <> 99999': ' WHERE bank_id <> 99999';
        $sql = "SELECT bank_name, AVG(ir.status_8::date - ir.status_6::date) AS avg_time FROM view_retail_finance ir {$where} GROUP BY 1";
        $results = $this->db->query($sql)->result_array();

        foreach ($results as $key=>$row) {
            $avg_time = number_format($row['avg_time'],2);

            $table[] = array(
                        'SN'                    => '', 
                        'Performance Measure'   =>  chr(65+$key) .') ' . $row['bank_name'], 
                        'UOM'                   => 'Day', 
                        'Target'                => '5',
                        'Actual'                => $avg_time, 
                        'Variance'              => abs(5 - $avg_time)
                    );

        }

        // ROW 4
        // $status_id = STATUS_PAYMENT_RECEIVED;
        $where = ($where1 != null) ? $where1 . ' AND bank_id <> 99999': ' WHERE bank_id <> 99999';
        $sql = "SELECT AVG(ir.status_14::date - ir.status_12::date) AS avg_time FROM view_retail_finance ir {$where}";
        $result = $this->db->query($sql)->result_array();
        $avg_time = number_format($result[0]['avg_time'],2);
        
        $table[] = array(
                        'SN'                    => '4', 
                        'Performance Measure'   => 'Payment collection from security transfer completion date <5 days', 
                        'UOM'                   => 'Day', 
                        'Target'                => '5',
                        'Actual'                => $avg_time, 
                        'Variance'              => abs(5 - $avg_time)
                    );

        // ROW 4a, 4b, 4c
        // $status_id = STATUS_PAYMENT_RECEIVED;
        $where = ($where1 != null) ? $where1 . ' AND bank_id <> 99999': ' WHERE bank_id <> 99999';
        $sql = "SELECT bank_name, AVG(ir.status_14::date - ir.status_12::date) AS avg_time FROM view_retail_finance ir {$where} GROUP BY 1";
        $results = $this->db->query($sql)->result_array();

        foreach ($results as $key=>$row) {
            $avg_time = number_format($row['avg_time'],2);

            $table[] = array(
                        'SN'                    => '', 
                        'Performance Measure'   =>  chr(65+$key) .') ' . $row['bank_name'], 
                        'UOM'                   => 'Day', 
                        'Target'                => '5',
                        'Actual'                => $avg_time, 
                        'Variance'              => abs(5 - $avg_time)
                    );

        }

        //ROW 5
        // $where = ($dateCondition != null) ? " WHERE {$dateCondition} " : '';
        // $sql = "SELECT COUNT(*) AS total FROM view_customers_all_status {$where}";
        // $result = $this->db->query($sql)->result_array();
        // $allTotal  = $result[0]['total'];

        // $where = ($where1 != null) ? $where1 . ' AND (status_5 IS NOT NULL OR status_7 IS NOT NULL)': ' WHERE (status_5 IS NOT NULL OR status_7 IS NOT NULL)';
        // $sql = "SELECT COUNT(*) AS total FROM view_customers_all_status {$where}";
        // $results = $this->db->query($sql)->result_array();

        // $percent = 0;
        // if ($allTotal > 0) {
        //     $percent = number_format(($results[0]['total']/$allTotal) * 100, 2);
        // }

        $table[] = array(
                        'SN'                    => '5', 
                        'Performance Measure'   => 'Rejection rate <5% of total documents submitted', 
                        'UOM'                   => '%', 
                        'Target'                => '5',
                        'Actual'                => '<b>@TODO</b>', 
                        'Variance'              => '<b>@TODO</b>'
                    );



        //ROW 6
        $where = ($where1 != null) ? $where1 . ' AND status_9 IS NOT NULL': ' WHERE status_9 IS NOT NULL';
        $sql = "SELECT COUNT(*) AS total FROM view_retail_finance {$where}";
        $results = $this->db->query($sql)->result_array();

        $percent = 0;
        if ($financeTotal > 0) {
            $percent = number_format(($results[0]['total']/$total) * 100, 2);
        }

        $table[] = array(
                        'SN'                    => '6', 
                        'Performance Measure'   => 'Delivery with DO ', 
                        'UOM'                   => '%', 
                        'Target'                => '100',
                        'Actual'                => $percent, 
                        'Variance'              => abs(100-$percent)
                    );


        // ROW 7
        $where = ($where1 != null) ? $where1 . ' AND bank_id <> 99999': ' WHERE bank_id <> 99999 ';
        $sql = "SELECT COUNT(*) AS total FROM view_retail_finance {$where}";
        $results = $this->db->query($sql)->result_array();

        $totalMemberBank = $results[0]['total'];
        
        $percent = 0;
        if ($financeTotal > 0) {
            $percent = number_format(($results[0]['total']/$financeTotal) * 100, 2);
        }

        $table[] = array(
                        'SN'                    => '7', 
                        'Performance Measure'   =>  'Equal Lead distribution to all tied up Banks (No of Leads forwarded)' ,
                        'UOM'                   => '%', 
                        'Target'                => '99',
                        'Actual'                => $percent,
                        'Variance'              => abs(99 - $percent)
                    );


        // ROW 7a, 7b, 7c
        $where = ($where1 != null) ? $where1 . ' AND bank_id <> 99999 ': ' WHERE bank_id <> 99999';
        $sql = "SELECT bank_id, bank_name, COUNT(*) AS total FROM view_retail_finance {$where} GROUP BY 1,2 ORDER BY 1,2";
        $results = $this->db->query($sql)->result_array();

        foreach ($results as $key=>$row) {
            $percent = 0;
            if ($totalMemberBank > 0) {
                $percent = number_format(($row['total']/$totalMemberBank)*100, 2);
            }

            $table[] = array(
                        'SN'                    => '', 
                        'Performance Measure'   =>  chr(65+$key) .') ' . $row['bank_name'], 
                        'UOM'                   => '%', 
                        'Target'                => '33',
                        'Actual'                => $percent,
                        'Variance'              => abs(33 - $percent)
                    );
        }


        echo json_encode(array('success' => TRUE, 'data'=> $table));

    }

//      public function modelwise_status()
//     {
//         $sql = <<<EOF
//     SELECT
//         generate_crosstab_sql_plain (
//         $$ select vehicle_name,source_name,count(vehicle_name)from view_customers GROUP BY vehicle_name,source_name ORDER BY vehicle_name $$,
//         $$ SELECT name FROM mst_sources $$,
//         'INT',
//         '"Model" TEXT') AS sqlstring
    
// EOF;
//         $res = $this->db->query($sql)->row_array();
//         $data = $this->db->query($res['sqlstring'])->result_array();

//          $sql_percentage = <<<EOF
//      SELECT
//         generate_crosstab_sql_plain (
//         $$ select vehicle_name,source_name,ROUND(100.0 * SUM(CASE WHEN status_id = 15 THEN 1 ELSE 0 END)/COUNT(1),2) AS total from view_customers GROUP BY vehicle_name,source_name ORDER BY vehicle_name $$,
//         $$ SELECT name FROM mst_sources $$,
//         'FLOAT',
//         '"Model" TEXT') AS sqlstring
    
// EOF;
//         $res_percent = $this->db->query($sql_percentage)->row_array();
//         $data_percent = $this->db->query($res_percent['sqlstring'])->result_array();

//         foreach ($data as $key => $value) 
//         {
//             $count[$key]['model'] = $value['Model'];
//             $count[$key]['referral'] = $value['Referral'];
//             $count[$key]['walk_in'] = $value['Walk-In'];
//             $count[$key]['generated'] = $value['Generated'];
//         }
        
//         foreach ($data_percent as $key => $value) 
//         {
//             $converted[$key]['model'] = $value['Model'];
//             $converted[$key]['referral_conv'] = $value['Referral'];
//             $converted[$key]['walk_in_conv'] = $value['Walk-In'];
//             $converted[$key]['generated_conv'] = $value['Generated'];
//         }

//         $i=0;
//         $merged_array = array();
//         foreach($count as $value) {
//             $merged_array[] = array_merge($value,$converted[$i]);
//             $i++;
//         }

//        echo json_encode($merged_array);
//     }

    public function modelwise_status($active_fiscal_year = false)
    {
        if($active_fiscal_year){
            $dates = explode('%20-%20', str_replace('_', '-', $active_fiscal_year));
            $fiscal_year_data = $this->fiscal_year_model->find(array('nepali_start_date'=>$dates[0],'nepali_end_date'=>$dates[1]));
            // $piece[0] = explode('-', $dates[0])[0];
            // $piece[1] = substr(explode('-', $dates[1])[0], 2,2);
            // $year = implode('-',$piece );
            $fiscal_year_id = $fiscal_year_data->id;
            // print_r($dates); exit;
        }else{
            list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
            
        }
        $sql = <<<EOF
    SELECT
        generate_crosstab_sql_plain (
        $$ select vehicle_name,source_name,count(vehicle_name)from view_customers where fiscal_year_id = '{$fiscal_year_id}' GROUP BY vehicle_name,source_name ORDER BY vehicle_name $$,
        $$ SELECT name FROM mst_sources $$,
        'INT',
        '"Model" TEXT') AS sqlstring
    
EOF;
        $res = $this->db->query($sql)->row_array();
        $data = $this->db->query($res['sqlstring'])->result_array();

         $sql_percentage = <<<EOF
     SELECT
        generate_crosstab_sql_plain (
        $$ select vehicle_name,source_name,ROUND(100.0 * SUM(CASE WHEN status_id = 15 THEN 1 ELSE 0 END)/COUNT(1),2) AS total from view_customers where fiscal_year_id = '{$fiscal_year_id}' GROUP BY vehicle_name,source_name ORDER BY vehicle_name $$,
        $$ SELECT name FROM mst_sources $$,
        'FLOAT',
        '"Model" TEXT') AS sqlstring
    
EOF;
        $res_percent = $this->db->query($sql_percentage)->row_array();
        $data_percent = $this->db->query($res_percent['sqlstring'])->result_array();

        foreach ($data as $key => $value) 
        {
            $count[$key]['model'] = $value['Model'];
            $count[$key]['referral'] = $value['Referral'];
            $count[$key]['walk_in'] = $value['Walk-In'];
            $count[$key]['generated'] = $value['Generated'];
        }
        
        foreach ($data_percent as $key => $value) 
        {
            $converted[$key]['model'] = $value['Model'];
            $converted[$key]['referral_conv'] = $value['Referral'];
            $converted[$key]['walk_in_conv'] = $value['Walk-In'];
            $converted[$key]['generated_conv'] = $value['Generated'];
        }

        $i=0;
        $merged_array = array();
        foreach($count as $value) {
            $merged_array[] = array_merge($value,$converted[$i]);
            $i++;
        }

       echo json_encode($merged_array);
    }


//     public function dealerwise_status()
//     {
//         $sql = <<<EOF
//     SELECT
//         generate_crosstab_sql_plain (
//         $$ select dealer_name,source_name,count(dealer_name)from view_customers GROUP BY dealer_name,source_name ORDER BY dealer_name $$,
//         $$ SELECT name FROM mst_sources $$,
//         'INT',
//         '"dealer" TEXT') AS sqlstring
    
// EOF;
//         $res = $this->db->query($sql)->row_array();
//         $data = $this->db->query($res['sqlstring'])->result_array();

//          $sql_percentage = <<<EOF
//      SELECT
//         generate_crosstab_sql_plain (
//         $$ select dealer_name,source_name,ROUND(100.0 * SUM(CASE WHEN status_id = 15 THEN 1 ELSE 0 END)/COUNT(1),2) AS total from view_customers GROUP BY dealer_name,source_name ORDER BY dealer_name $$,
//         $$ SELECT name FROM mst_sources $$,
//         'FLOAT',
//         '"dealer" TEXT') AS sqlstring
    
// EOF;
//         $res_percent = $this->db->query($sql_percentage)->row_array();
//         $data_percent = $this->db->query($res_percent['sqlstring'])->result_array();

//         foreach ($data as $key => $value) 
//         {
//             $count[$key]['dealer'] = $value['dealer'];
//             $count[$key]['referral'] = ($value['Referral'] ? $value['Referral']:0);
//             $count[$key]['walk_in'] = ($value['Walk-In'] ? $value['Walk-In']:0);
//             $count[$key]['generated'] = ($value['Generated'] ? $value['Generated']:0);
//         }
        
//         foreach ($data_percent as $key => $value) 
//         {
//             $converted[$key]['dealer'] = $value['dealer'];
//             $converted[$key]['referral_conv'] = ($value['Referral'] ? $value['Referral']:0);
//             $converted[$key]['walk_in_conv'] = ($value['Walk-In'] ? $value['Walk-In']:0);
//             $converted[$key]['generated_conv'] = ($value['Generated'] ? $value['Generated']:0);
//         }

//         $i=0;
//         $merged_array = array();
//         foreach($count as $value) {
//             $merged_array[] = array_merge($value,$converted[$i]);
//             $i++;
//         }

//        echo json_encode($merged_array);
//     }

    public function dealerwise_status($active_fiscal_year = false)
    {

        if($active_fiscal_year){
            $dates = explode('%20-%20', str_replace('_', '-', $active_fiscal_year));
            $fiscal_year_data = $this->fiscal_year_model->find(array('nepali_start_date'=>$dates[0],'nepali_end_date'=>$dates[1]));
            // $piece[0] = explode('-', $dates[0])[0];
            // $piece[1] = substr(explode('-', $dates[1])[0], 2,2);
            // $year = implode('-',$piece );
            $fiscal_year_id = $fiscal_year_data->id;
            // print_r($dates); exit;
        }else{
            list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
            
        }
        $sql = <<<EOF
    SELECT
        generate_crosstab_sql_plain (
        $$ select dealer_name,source_name,count(dealer_name)from view_customers where fiscal_year_id = '{$fiscal_year_id}' GROUP BY dealer_name,source_name ORDER BY dealer_name $$,
        $$ SELECT name FROM mst_sources $$,
        'INT',
        '"dealer" TEXT') AS sqlstring
    
EOF;
        $res = $this->db->query($sql)->row_array();
        $data = $this->db->query($res['sqlstring'])->result_array();

         $sql_percentage = <<<EOF
     SELECT
        generate_crosstab_sql_plain (
        $$ select dealer_name,source_name,ROUND(100.0 * SUM(CASE WHEN status_id = 15 THEN 1 ELSE 0 END)/COUNT(1),2) AS total from view_customers where fiscal_year_id = '{$fiscal_year_id}' GROUP BY dealer_name,source_name ORDER BY dealer_name $$,
        $$ SELECT name FROM mst_sources $$,
        'FLOAT',
        '"dealer" TEXT') AS sqlstring
    
EOF;
        $res_percent = $this->db->query($sql_percentage)->row_array();
        $data_percent = $this->db->query($res_percent['sqlstring'])->result_array();

        foreach ($data as $key => $value) 
        {
            $count[$key]['dealer'] = $value['dealer'];
            $count[$key]['referral'] = ($value['Referral'] ? $value['Referral']:0);
            $count[$key]['walk_in'] = ($value['Walk-In'] ? $value['Walk-In']:0);
            $count[$key]['generated'] = ($value['Generated'] ? $value['Generated']:0);
        }
        
        foreach ($data_percent as $key => $value) 
        {
            $converted[$key]['dealer'] = $value['dealer'];
            $converted[$key]['referral_conv'] = ($value['Referral'] ? $value['Referral']:0);
            $converted[$key]['walk_in_conv'] = ($value['Walk-In'] ? $value['Walk-In']:0);
            $converted[$key]['generated_conv'] = ($value['Generated'] ? $value['Generated']:0);
        }

        $i=0;
        $merged_array = array();
        foreach($count as $value) {
            $merged_array[] = array_merge($value,$converted[$i]);
            $i++;
        }

       echo json_encode($merged_array);
    }
    public function get_walkin_source_data()
    {
        $rows = $this->db->query('select walkin_source_name,count(id) from view_walkin_source_dashboard GROUP BY walkin_source_id,walkin_source_name')->result_array();
        return $rows;
    }

    public function infophp()
    {
        phpinfo();
    }

    public function inquiry_source()
    {
        // Display Page
        $type = 'inquiry_source';
        $data['header'] = lang('crm_reports');
        $data['page'] = $this->config->item('template_admin') . "generate_inquiry_source";
        $data['module'] = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));
        $this->load->view($this->_container,$data);
    }
    public function generate_inquiry_source()
    {
        ini_set('memory_limit', '-1');
        $report_criteria_index = $this->input->post('report_criteria');
        $report_criteria = $this->report_criteria[$report_criteria_index];
        extract($report_criteria);

        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')";
            }
        }

        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 

        // echo '<pre>'; print_r($dealer_list); exit;
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }

        // dd($report_criteria);
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
        $fields[] = 'inquiry_ageing AS "Inquiry Age"';
        $fields[] = 'retail_year AS "Retail Nepali Year"';
        $fields[] = 'vehicle_make_year AS  "Make Year"';
        $fields[] = 'nepali_month AS "Retail Nepali Month"';
        $fields[] = 'sale_booked_date_np AS "Booking Date Nepali"';
        $fields[] = 'sale_booked_date_np_month AS "Booking Nepali Month"';
        $fields[] = 'sale_booked_date_year AS "Booking Nepali Year"';
        $fields[] = 'notes AS "Cancel Note"';
        $fields[] = 'booking_cancel_reason AS "Cancel Reason"';
        $fields[] = 'test_drive AS "Test Drive"';
        $fields[] = 'test_drive_status AS "Test Drive Status"';
        $fields[] = 'occupation_name AS "Occupation"';
        $fields[] = 'dispatched_date_np AS "Dispatch Date"';
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY-MM\') AS "Month (AD)"';
        $fields[] = 'TO_CHAR(DATE(inquiry_date_en), \'YYYY\') AS "Year (AD)"';
        $fields[] = 'inquiry_date_en AS "Inquiry Date EN"';
        $fields[] = 'inquiry_date_np AS "Inquiry Date NP"';
        $fields[] = 'booked_date AS "Booked Date"';
        $fields[] = 'booking_ageing AS "Booking Age"';
        $fields[] = 'TO_CHAR(DATE(vehicle_delivery_date), \'YYYY-MM\') AS "Retail Month (AD)"';
        $fields[] = 'vehicle_delivery_date AS "Retail Date EN"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 7) AS "Month (BS)"';
        $fields[] = 'SUBSTRING(inquiry_date_np FROM 1 FOR 4) AS "Year (BS)"';
        $fields[] = 'status_name  AS "Inquiry Status"';
        $fields[] = 'sub_status_name  AS "Inquiry Sub Status"';
        $fields[] = 'status_date  AS "Status Date"';
        $fields[] = 'executive_name AS "Executive"';
        $fields[] = 'dealer_name AS "Dealer"';
        $fields[] = 'vehicle_name AS "Model"';
        $fields[] = 'variant_name AS "Variant"';
        $fields[] = 'color_name AS "Color"';
        $fields[] = 'source_name AS "Inquiry Source"';
        $fields[] = 'inquiry_kind AS "Inquiry Kind"';
        $fields[] = 'inquiry_type AS "Inquiry Type"';
        $fields[] = 'payment_mode_name AS "Payment Mode"';
        $fields[] = 'customer_type_name AS "Customer Type"';
        $fields[] = 'exchange_car_model AS "Exchange Car Model"';
        $fields[] = 'exchange_car_value AS "Exchange Car Price"';
        $fields[] = 'exchange_car_make AS "Exchange Car Brand"';
        $fields[] = 'exchange_car_year AS "Exchange Car Year"';
        $fields[] = 'exchange_car_variant AS "Exchange Car Variant"';
        $fields[] = 'CASE WHEN bank_name IS NULL THEN \'No Data\' ELSE bank_name END AS "Bank Name"';
        $fields[] = 'CASE WHEN bank_branch IS NULL THEN \'No Data\' ELSE bank_branch END AS "Branch Name"';
        $fields[] = 'CASE WHEN bank_staff IS NULL THEN \'No Data\' ELSE bank_staff END AS "Bank Staff"';
        $fields[] = 'full_name AS "Customer Name"';
        $fields[] = 'mobile_1 AS "Mobile No"';
        $fields[] = 'address_1 AS "Address_1"';
        $fields[] = 'CASE WHEN event_name IS NULL OR event_name = \'N/A\' THEN \' No Event \'  ELSE event_name END AS "Event"';

        $whereCondition[] = " ( deleted_at IS NULL )";

        if(!empty($dealer_list)) {
            $this->db->select('id');
            $this->db->from($report_criteria['dbview']);
            if (count($whereCondition) > 0) {
                $where = implode(" AND " , $whereCondition);
            }
            // echo "<pre>"; print_r($fields); exit;
            $query = $this->db->query('select '.implode(',',$fields).' from '.$report_criteria['dbview'].' as cus JOIN (
                select id FROM '.$report_criteria['dbview'].' where '.$where.') AS temp ON temp.id = cus.id');
            $result = $query->result();
        }elseif ($is_showroom_incharge) {
            $this->db->select('id');
            $this->db->from($report_criteria['dbview']);
            if (count($whereCondition) > 0) {
                $where = implode(" AND " , $whereCondition);
            }
            // echo "<pre>"; print_r($fields); exit;
            $query = $this->db->query('select '.implode(',',$fields).' from '.$report_criteria['dbview'].' as cus JOIN (
                select id FROM '.$report_criteria['dbview'].' where '.$where.') AS temp ON temp.id = cus.id');
            $result = $query->result();
        } elseif ($is_sales_executive) {
            $this->db->select('id');
            $this->db->from($report_criteria['dbview']);
            if (count($whereCondition) > 0) {
                $where = implode(" AND " , $whereCondition);
            }
            // echo "<pre>"; print_r($fields); exit;
            $query = $this->db->query('select '.implode(',',$fields).' from '.$report_criteria['dbview'].' as cus JOIN (
                select id FROM '.$report_criteria['dbview'].' where '.$where.') AS temp ON temp.id = cus.id');
            $result = $query->result();
        }
        else{
            $this->db->select($fields);
            $this->db->from($report_criteria['dbview']);
            if (count($whereCondition) > 0) {
                $this->db->where(implode(" AND " , $whereCondition));
            }
            $result = $this->db->get()->result_array();
            
        }
        // echo '<pre>'; print_r($result); exit;
        // echo $this->db->last_query(); exit;
        $total = count($result);
        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        $data['result'] =  $result;
        $data['total'] =  $total;
        $type = 'inquiry_source';
        $data['header'] = lang('crm_reports');
        $data['page'] = $this->config->item('template_admin') . "generate_inquiry_source";
        $data['module'] = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));
        $this->load->view($this->_container,$data);
        // dd($result);
    }

    public function booking_dashboard()
    {
        $data['header'] = lang('crm_reports');
        $data['page'] = $this->config->item('template_admin') . "booking_dashboard";
        // $data['reports'] = $vehicle;
        $data['module'] = 'crm_reports';
        $this->load->view($this->_container,$data);
    }


    public function booking_dashboard_data(){
        $date_year = $this->input->post('year');
        $date_month = $this->input->post('month');

        $monthdetails = get_nepali_month_detail_from_nepali_date($date_year.'-'.$date_month);
        $dealer = ($this->input->post('dealer_id'))?$this->input->post('dealer_id'):'';
        $status_date_from = get_english_date($date_year.'-'.$date_month.'-01',1); 
        $status_date_to = get_english_date($date_year.'-'.$date_month.'-'.$monthdetails,1); 
        // $dealer = '75';
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
        $where_dealer = "";

        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }

        
        if(!empty($dealer_list)) {
            // $this->db->where_in('dealer_id', $dealer_list);
            $dealer_where_array = array();
            foreach ($dealer_list as $key => $value) {
                $dealer_where_array[] = "(".$value.")";
            }
            $where_dealer = implode(',', $dealer_where_array);
            $this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $this->session->userdata('employee')['dealer_id']);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $this->session->userdata('employee')['employee_id']);
        }
        $this->db->where('booked_date >=',$status_date_from);
        $this->db->where('booked_date <=',$status_date_to);
        ($dealer)?$this->db->where('dealer_id',$dealer):'';
        $this->db->select('vehicle_name,variant_name,color_name,count(id) as total_this_month_booking');
        $this->db->group_by('1,2,3');
        $this->db->from('view_customer_refined');
        $current_month_booking = $this->db->get()->result_array(); 


        $this->db->where('booked_date <',$status_date_from);
        // $this->db->where('dealer_id',$dealer);
        ($dealer)?$this->db->where('dealer_id',$dealer):'';
        $this->db->where("(status_name = 'Booked' OR (status_name = 'Retail' AND status_date > '".$status_date_from."') OR (sub_status_name = 'Booking Cancel' AND status_date > '".$status_date_from."')  OR (sub_status_name = 'Lost' AND status_date > '".$status_date_from."' AND booked_date IS NOT NULL) )");
        $this->db->select('vehicle_name,variant_name,color_name,count(id) as opening_booking');
        $this->db->group_by('1,2,3');
        $this->db->from('view_customer_refined');
        $opening_booking = $this->db->get()->result_array();
        // echo $this->db->last_query(); exit;
        $this->db->where('booked_date',date('Y-m-d'));
        // $this->db->where('dealer_id',$dealer);
        ($dealer)?$this->db->where('dealer_id',$dealer):'';
        $this->db->select('vehicle_name,variant_name,color_name,count(id) as today_booking');
        $this->db->group_by('1,2,3');
        $this->db->from('view_customer_refined');
        $today_booking = $this->db->get()->result_array();


        $this->db->where('status_date >=',$status_date_from);
        $this->db->where('status_date <=',$status_date_to);
        // $this->db->where('dealer_id',$dealer);
        ($dealer)?$this->db->where('dealer_id',$dealer):'';
        $this->db->where('status_name','Retail');
        $this->db->select('vehicle_name,variant_name,color_name,count(id) as retailed');
        $this->db->group_by('1,2,3');
        $this->db->from('view_customer_refined');
        $retailed = $this->db->get()->result_array();


        $this->db->where('status_date >=',$status_date_from);
        $this->db->where('status_date <=',$status_date_to);
        // $this->db->where('dealer_id',$dealer);
        ($dealer)?$this->db->where('dealer_id',$dealer):'';
        $this->db->where('sub_status_name','Booking Cancel');
        $this->db->select('vehicle_name,variant_name,color_name,count(id) as booking_cancel');
        $this->db->group_by('1,2,3');
        $this->db->from('view_customer_refined');
        $booking_cancel = $this->db->get()->result_array();

        $this->db->where('deleted_at',NULL);
        $this->db->select('vehicle_name,variant_name,color_name');
        $this->db->from('view_dms_vehicles');
        $vehicle = $this->db->get()->result_array();

        $vehicle = $this->merge_array_vehicle($vehicle,$opening_booking,'opening_booking','opening_booking');
        $vehicle = $this->merge_array_vehicle($vehicle,$current_month_booking,'total_this_month_booking','total_this_month_booking');
        $vehicle = $this->merge_array_vehicle($vehicle,$today_booking,'today_booking','today_booking');
        $vehicle = $this->merge_array_vehicle($vehicle,$retailed,'retailed','retailed');
        $vehicle = $this->merge_array_vehicle($vehicle,$booking_cancel,'booking_cancel','booking_cancel');
        
        $vehicle = $this->merge_array_vehicle_ttl($vehicle);
        $vehicle = $this->merge_array_vehicle_pending($vehicle);


        $data['header'] = lang('crm_reports');
        $data['page'] = $this->config->item('template_admin') . "booking_dashboard";
        $data['reports'] = $vehicle;
        $data['module'] = 'crm_reports';
        $data['year'] = $date_year;
        $data['month'] = $date_month;
        $data['dealer_name'] = 'ALL';
        if($dealer){
            $this->db->where('id',$dealer);
            $row = $this->db->get('dms_dealers')->row_array();
            $data['dealer_name'] = $row['name'];
        }
        // echo '<pre>'; print_r($data); exit;
        $this->load->view($this->_container,$data);
        

    }

    public function merge_array_vehicle_ttl($array)
    {
        foreach ($array as $key => $value) {
            $array[$key]['ttl'] = $value['total_this_month_booking'] + $value['opening_booking'];
        }
        return $array;
    }

    public function merge_array_vehicle_pending($array)
    {
        foreach ($array as $key => $value) {
            $array[$key]['pending'] = $value['ttl'] - $value['retailed'] - $value['booking_cancel'];
        }
        return $array;
    }

    public function merge_array_vehicle($array1,$array2,$new_index,$index){
        foreach($array1 as $key => $temp_array){
            // print_r($temp_array);
            if(!empty($array2)){
                foreach($array2 as $temp_array2){
                    if($temp_array2['vehicle_name'] == $temp_array['vehicle_name'] && $temp_array2['variant_name'] == $temp_array['variant_name'] && $temp_array2['color_name'] == $temp_array['color_name']){
                        $array1[$key][$new_index] = $temp_array2[$index];
                        // echo '<pre>';
                        // print_r($temp_array);
                        // print_r($temp_array2);
                        // echo '-------------';
                        break;

                    }else{
                        $array1[$key][$new_index] = 0;
                    }
                }
                
            }else{
                $array1[$key][$new_index] = 0;

            }
            
        }
        
        return $array1;
    }

    public function monthJson()
    {
        $this->db->order_by('rank');
        $rows = $this->db->get('mst_nepali_month')->result();
        array_unshift($rows, array('id' => '0', 'name' => 'Select Month'));

        echo json_encode($rows);
    }


    public function booking_report($type = null)
    {
         if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }


         // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "booking_report";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = "Booking Report";  
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }

    public function get_booking_report()
    {

        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(booked_date >= '".$date_range[0]."' AND booked_date<= '".$date_range[1]."')";
            }
        }

         $fields = array();
        
        $fields[] = 'booked_date AS "Booked Date"';
        $fields[] = 'status_name AS "Status"';
        $fields[] = 'exchange_car_make AS "Exchange Car Make "';
        $fields[] = 'exchange_car_model AS "Exchange Car Model"';
        $fields[] = 'exchange_car_year AS "Exchange Car Year "';
        $fields[] = 'exchange_car_kms AS "Exchange Car Kms "';
        $fields[] = 'exchange_car_value AS "Exchange Car Value "';
        $fields[] = 'exchange_car_bonus AS "Exchange Car Bonus "';
        $fields[] = 'exchange_total_offer AS "Exchange Total Offer "';
        $fields[] = 'source_name AS "Inquiry Source "';        
        $fields[] = 'inquiry_date_np AS "Inquiry Date"';
        $fields[] = 'dealer_name AS "Dealer"';
        $fields[] = 'executive_name AS "Executive"';
        $fields[] = 'full_name  AS "Customer Name"';
        $fields[] = 'source_name  AS "Inquiry Source"';
        $fields[] = 'booking_canceled  AS "Cancellation"';
        $fields[] = 'customer_type_name  AS "Customer Type"';
        $fields[] = 'vehicle_make_year  AS "Year"';
        $fields[] = 'vehicle_name  AS "Model"';
        $fields[] = 'variant_name  AS "Variant"';
        $fields[] = 'status_date  AS "On Date"';
       
        
        

        
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
        $where_dealer = "";

        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }

        
        if(!empty($dealer_list)) {
            // $this->db->where_in('dealer_id', $dealer_list);
            $dealer_where_array = array();
            foreach ($dealer_list as $key => $value) {
                $dealer_where_array[] = "(".$value.")";
            }
            $where_dealer = implode(',', $dealer_where_array);
            $this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $this->session->userdata('employee')['dealer_id']);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $this->session->userdata('employee')['employee_id']);
        }

        $this->db->from('view_customers');
        $this->db->select($fields);
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        $result = $this->db->get()->result_array();
        // echo $this->db->last_query();
        $total = count($result);

        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));

    }

    public function booking_report_json_data()
    {
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
        $where_dealer = "";

        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }

        
        if(!empty($dealer_list)) {
            // $this->db->where_in('dealer_id', $dealer_list);
            $dealer_where_array = array();
            foreach ($dealer_list as $key => $value) {
                $dealer_where_array[] = "(".$value.")";
            }
            $where_dealer = implode(',', $dealer_where_array);
            $this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $this->session->userdata('employee')['dealer_id']);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $this->session->userdata('employee')['employee_id']);
        }
        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
          if ($date_range[0] != null && $date_range[1] != null) {
                 $status_date_from = $date_range[0];
                 $status_date_to = $date_range[1];

                $this->db->where('booked_date <',$status_date_from);
                $this->db->where("(status_name = 'Booked' OR (status_name = 'Retail' AND status_date > '".$status_date_from."') OR (sub_status_name = 'Booking Cancel' AND status_date > '".$status_date_from."')  OR (sub_status_name = 'Lost' AND status_date > '".$status_date_from."' AND booked_date IS NOT NULL) )");
              }
        }

       
        $this->db->select('dealer_name,vehicle_name,variant_name,color_name,vehicle_make_year as Year,status_name AS "Status"');
        // $this->db->group_by('1,2,3');
        
        $this->db->from('view_customers');
        $opening_booking = $this->db->get()->result_array();
       
        $total = count($opening_booking);

        
        if (count($opening_booking) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $opening_booking, 'total'=> $total));
    }

    public function followup_report()
    {
        // Display Page
        $type = 'inquiry_source';
        $data['header'] = lang('crm_reports');
        $data['page'] = $this->config->item('template_admin') . "followup";
        $data['module'] = 'crm_reports';
       
        $this->load->view($this->_container,$data);
    }

    public function get_followup_combo_json(){


        // $this->partial_payment_model->_table = 'view_dealers';
        // $dealers = $this->partial_payment_model->findAll();
        
        $this->partial_payment_model->_table = 'view_customer_report_view';

        search_params();
        $total=$this->partial_payment_model->find_count();


        paging('dealer_id','asc');
        search_params();
        $customer = $this->partial_payment_model->findAll();
        // echo $this->db->last_query(); exit;

        // $this->partial_payment_model->_table = 'view_customer_report_view';


        $fields = [];
        $fields[] = 'vehicle_id';
        // $fields[] = 'variant_id';
        // $fields[] = 'color_id';
        $fields[] = 'dealer_id';
        $this->partial_payment_model->_table = 'view_follow_up_report_view';
        $this->db->group_by($fields);
        $fields[] = 'count(customer_id) as follow_count';
        $followups = $this->partial_payment_model->findAll(NULL,$fields);
        

        $fields = [];
        $fields[] = 'vehicle_id';
        // $fields[] = 'variant_id';
        // $fields[] = 'color_id';
        $fields[] = 'dealer_id';
        $this->partial_payment_model->_table = 'view_follow_up_report_view';
        $this->db->group_by($fields);
        $fields[] = 'count(customer_id) as pending_follow_count';
        $pendingfollowups = $this->partial_payment_model->findAll(array('followup_status'=>'pending'),$fields);
        // $vehicle = $this->merge_array_vehicle($vehicle,$opening_booking,'inquiry_count','inquiry_count');

        $customer = $this->merge_array_vehicle_follow_up($customer,$followups,'follow_count','follow_count');
        $customer = $this->merge_array_vehicle_follow_up($customer,$pendingfollowups,'pending_follow_count','pending_follow_count');

        // $dealers = $this->merge_array_vehicle_dealer($dealers, $customer);

        // $total = count($customer);
        // echo '<pre>'; print_r($dealers); exit;

        echo json_encode(array('total'=>$total,'rows'=>$customer));
        exit;


    }

    public function merge_array_vehicle_dealer($dealers , $customer)
    {
        // echo '<pre>'; print_r($dealers); exit;
        foreach ($customer as $key => &$value) {
            foreach ($dealers as $k => $v) {
                if($v->id == $value->dealer_id){
                    $value->name = $v->name;
                    // $value->follow_count = $v->follow_count;
                    // $value->pending_follow_count = $v->pending_follow_count;
                    // $value->vehicle_name = $v->vehicle_name;
                    // $value->variant_name = $v->variant_name;
                    // $value->color_name = $v->color_name;
                }
            }
        }

        return $customer;

    }

    public function merge_array_vehicle_follow_up($array1,$array2,$new_index,$index){
        foreach($array1 as $key => $temp_array){
            // print_r($temp_array);
            if(!empty($array2)){
                foreach($array2 as $temp_array2){
                    if($temp_array2->vehicle_id == $temp_array->vehicle_id && $temp_array2->dealer_id == $temp_array->dealer_id){
                        $array1[$key]->$new_index = $temp_array2->$index;
                        // echo '<pre>';
                        // print_r($temp_array);
                        // print_r($temp_array2);
                        // echo '-------------';
                        break;

                    }else{
                        $array1[$key]->$new_index = 0;
                    }
                }
                
            }else{
                $array1[$key]->$new_index = 0;

            }
            
        }
        
        return $array1;
    }


    public function follow_up_report($type = null)
    {
         if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/crm-reports');  
        }


         // Display Page
        $data['header']                 = lang('crm_reports');
        $data['page']                   = $this->config->item('template_admin') . "follow_up_report";
        $data['module']                 = 'crm_reports';
        $data['type']                   = $type;  
        $data['report_type']            = "Follow Up Report";  
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }

    public function get_follow_up_report()
    {
         $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en<= '".$date_range[1]."')";
            }
        }

         $fields = array();
        
        $fields[] = 'variant_name AS "Variant"';
        $fields[] = 'color_name AS "Color"';
        $fields[] = 'followup_status AS "Status"';
        $fields[] = 'status AS "Followup Status"';
        $fields[] = 'followup_date_en AS "Follow Up Date"';
        $fields[] = 'dealer_name AS "Dealer"';
         $fields[] = 'vehicle_name AS "Vehicle"';
       
        $this->db->select($fields);
        $this->db->from('view_follow_up_report_view');
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result_array();
       
        $total = count($result);

        
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

     public function billing_target_report($json = null)
    {
        $this->load->model('fiscal_years/fiscal_year_model');

        if($json){
            $where = '';
            if($this->input->post('fiscal_year')){
                $fields = array();
                $fields[] = 'id';
                $fields[] = "(substr(nepali_start_date, 0, 5) || '-' || substr(nepali_end_date, 3, 2)) as fiscal_year";
                $record = $this->fiscal_year_model->find(array('id'=>$this->input->post('fiscal_year')), $fields);
                $where[] = "(target_year = '".$record->fiscal_year."')";
            }

            if($this->input->post('dealer')){
                $where[] = "(dealer_id = '".$this->input->post('dealer')."')";
            }

            if($this->input->post('month')){
                $where[] = "(month = '".$this->input->post('dealer')."')";
            }

            if (count($where) > 0) {
                $this->db->where(implode(" AND " , $where));
            }

            $this->stock_record_model->_table = "view_dashboard_target_actual_dealerwise";
            $this->db->order_by('dealer_id,rank asc');
            $rows = $this->stock_record_model->findAll();

            echo json_encode(array('total'=>count($rows),'rows'=>$rows));
            exit;
            // echo $this->db->last_query();
            // echo '<pre>'; print_r($rows); exit;
        }
        $this->load->model('fiscal_years/fiscal_year_model'); 
        $data['header'] = 'Billing Target Report';
        $data['fiscal_years']=$this->fiscal_year_model->findAll();
        $data['page'] = $this->config->item('template_admin') . "target_report";
        $data['module'] = 'crm_reports';
        $this->load->view($this->_container,$data);
    }


    public function retail_target_report($json = null)
    {
        $this->load->model('fiscal_years/fiscal_year_model');

        if($json){
            $where = '';
            if($this->input->post('fiscal_year')){
                $fields = array();
                $fields[] = 'id';
                $fields[] = "(substr(nepali_start_date, 0, 5) || '-' || substr(nepali_end_date, 3, 2)) as fiscal_year";
                $record = $this->fiscal_year_model->find(array('id'=>$this->input->post('fiscal_year')), $fields);
                $where[] = "(target_year = '".$record->fiscal_year."')";
            }

            if($this->input->post('dealer')){
                $where[] = "(dealer_id = '".$this->input->post('dealer')."')";
            }

            if($this->input->post('month')){
                $where[] = "(month = '".$this->input->post('dealer')."')";
            }

            if (count($where) > 0) {
                $this->db->where(implode(" AND " , $where));
            }

            $this->stock_record_model->_table = "view_dashboard_tar_act_retail_dealerwise";
            $this->db->order_by('dealer_id,rank asc');
            $rows = $this->stock_record_model->findAll();

            echo json_encode(array('total'=>count($rows),'rows'=>$rows));
            exit;
            // echo $this->db->last_query();
            // echo '<pre>'; print_r($rows); exit;
        }
        $this->load->model('fiscal_years/fiscal_year_model'); 
        $data['header'] = 'Retail Target Report';
        $data['fiscal_years']=$this->fiscal_year_model->findAll();
        $data['page'] = $this->config->item('template_admin') . "retail_target_report";
        $data['module'] = 'crm_reports';
        $this->load->view($this->_container,$data);
    }

    public function inquiry_target_report($json = null)
    {
        $this->load->model('fiscal_years/fiscal_year_model');

        if($json){
            $where = '';
            if($this->input->post('fiscal_year')){
                $fields = array();
                $fields[] = 'id';
                $fields[] = "(substr(nepali_start_date, 0, 5) || '-' || substr(nepali_end_date, 3, 2)) as fiscal_year";
                $record = $this->fiscal_year_model->find(array('id'=>$this->input->post('fiscal_year')), $fields);
                $where[] = "(target_year = '".$record->fiscal_year."')";
            }

            if($this->input->post('dealer')){
                $where[] = "(dealer_id = '".$this->input->post('dealer')."')";
            }

            if($this->input->post('month')){
                $where[] = "(month = '".$this->input->post('dealer')."')";
            }

            if (count($where) > 0) {
                $this->db->where(implode(" AND " , $where));
            }

            $this->stock_record_model->_table = "view_dashboard_act_tar_inquiry_dealerwise";
            $this->db->order_by('dealer_id,rank asc');
            $rows = $this->stock_record_model->findAll();

            echo json_encode(array('total'=>count($rows),'rows'=>$rows));
            exit;
            // echo $this->db->last_query();
            // echo '<pre>'; print_r($rows); exit;
        }
        $this->load->model('fiscal_years/fiscal_year_model'); 
        $data['header'] = 'Retail Target Report';
        $data['fiscal_years']=$this->fiscal_year_model->findAll();
        $data['page'] = $this->config->item('template_admin') . "inquiry_target_report";
        $data['module'] = 'crm_reports';
        $this->load->view($this->_container,$data);
    }

    public function get_report_json_service_level_summary() 
    {
        $report_criteria_index = $this->input->post('report_criteria'); 

        $report_criteria = $this->report_criteria[$report_criteria_index];
       

        extract($report_criteria);

        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(request_date >= '".$date_range[0]."' AND request_date <= '".$date_range[1]."')"; 
            }
        }
        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
    
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }
        // ACCESS LEVEL CHECK ENDS

        $fields = array();
       
        // if($report_criteria_index == 'service_level_summary'){

        //     $fields[] = 'name AS "Name"';
        //     $fields[] = 'address_1 AS "Address 1"';
        //     $fields[] = 'req_price AS "Request Price"';
        //     $fields[] = 'dispatch_price AS "Dispatch Price"';
        //     $fields[] = 'pending_amount AS "Pending Amount"';
        //     $fields[] = 'req_quantity AS "Request Quantity"';
        //     $fields[] = 'dispatch_qty AS "Dispatch Quantity"';
        //     $fields[] = 'pending_qty AS "Pending Quantity"';
        //     $fields[] = 'service AS "Quantity Service Level"';
        //     $fields[] = 'count_request AS "Count Request"';
        //     $fields[] = 'count_dispatched AS "Count Dispatched"';
        //     $fields[] = 'count_service_level AS "Count Service Level"';

        // }

        // remove deleted data
        // $whereCondition[] = " ( deleted_at IS NULL )";

        $this->db->select($fields);

        $this->db->from($report_criteria['dbview']);
        
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $this->db->get()->result();
       
       if($result)
        {
            $this->load->library('Excel');
            $style = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            );
            $objPHPExcel = new PHPExcel(); 
            $objPHPExcel->setActiveSheetIndex(0);
            // if(is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){

            // }else{
            //     $this->db->where('id',$this->dealer_id);
            //     $dealer = $this->db->get('dms_dealers')->row_array();
            //     $objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
            //     $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

            // }
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Service Level Summary Report')->getStyle("A1:N1")->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
            $objPHPExcel->getActiveSheet()->SetCellValue('A2','S.N.');
            $objPHPExcel->getActiveSheet()->SetCellValue('B2','Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('C2','Address 1');
            $objPHPExcel->getActiveSheet()->SetCellValue('D2','Req Price');
            $objPHPExcel->getActiveSheet()->SetCellValue('E2','Dispatch Price');
            $objPHPExcel->getActiveSheet()->SetCellValue('F2','Pending Amount');
            $objPHPExcel->getActiveSheet()->SetCellValue('G2','Req quantity');
            $objPHPExcel->getActiveSheet()->SetCellValue('H2','Dispatch qty');
            $objPHPExcel->getActiveSheet()->SetCellValue('I2','Pending qty');
            $objPHPExcel->getActiveSheet()->SetCellValue('J2','Quantity Service Level');
            $objPHPExcel->getActiveSheet()->SetCellValue('K2','Count Request');
            $objPHPExcel->getActiveSheet()->SetCellValue('L2','Count Dispatched');
            $objPHPExcel->getActiveSheet()->SetCellValue('M2','Count Service Level');

            $row = 3;
            $col = 0;        
            foreach($result as $key => $values) 
            {           
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->name);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->address_1);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->req_price);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dispatch_price);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->pending_amount);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->req_quantity);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dispatch_qty);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->pending_qty);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->service);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->count_request);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->count_dispatched);
                $col++;
                
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->count_service_level);
                $col++;
                $col = 0;
                $row++;        
            }

            header("Pragma: public");
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment;filename=service_level_summary_reports.xls");
            header("Content-Transfer-Encoding: binary ");
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            ob_end_clean();
            $objWriter->save('php://output');

            
        }
        redirect('spareparts_report/generate_dealer_service_level/service_level_summary');
        
    }

    public function excel_export_service_level_summary()
    {
        $this->get_report_json_service_level_summary();
    }

    public function excel_export_partwise_sales()
    {
        $this->get_report_json_partwise_sales();
    }

    public function get_report_json_partwise_sales() 
    {
        // echo '<pre>'; print_r($this->input->post()); exit;
        $report_criteria_index = $this->input->post('report_criteria'); 
        $report_criteria = $this->report_criteria[$report_criteria_index];
        extract($report_criteria);
        $whereCondition = array();
        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(dispatched_date >= '".$date_range[0]."' AND dispatched_date <= '".$date_range[1]."')"; 
            }
        }
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
        $dealer_list    = (is_dealer_incharge()) ? get_dealer_list() : NULL; 
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge()) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive()) ? TRUE : NULL; 
        }
        if(!empty($dealer_list)) {
            $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
        } elseif ($is_showroom_incharge) {
            $whereCondition[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        } elseif ($is_sales_executive) {
            $whereCondition[] = " ( executive_id = " . $this->session->userdata('employee')['employee_id'] . ")";
        }
        $fields = array();

        $fields[] = 'part_code';
        $fields[] = 'part_name';
        $fields[] = 'sum(dispatched_quantity) as total_sales_quantity';
        $fields[] = 'dealer_price';
        $fields[] = '(sum(dispatched_quantity) * dealer_price) as total_value';
        $whereCondition[] = " ( deleted_at IS NULL )";
        $this->db->select($fields);
        $this->db->from($report_criteria['dbview']);
        if (count($whereCondition) > 0) {
            $this->db->where(implode(" AND " , $whereCondition));
        }
        $this->db->group_by('1,2,4');
        $result = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
       
       if($result)
        {
            $this->load->library('Excel');
            $style = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            );
            $objPHPExcel = new PHPExcel(); 
            $objPHPExcel->setActiveSheetIndex(0);
            // if(is_service_head() || is_national_service_manager() || is_admin() ||  is_ccd_incharge() || is_service_dealer_incharge()){

            // }else{
            //     $this->db->where('id',$this->dealer_id);
            //     $dealer = $this->db->get('dms_dealers')->row_array();
            //     $objPHPExcel->getActiveSheet()->setCellValue('A1', $dealer['name'])->getStyle("A1:I1")->applyFromArray($style);
            //     $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');

            // }
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Partwise Sales Report')->getStyle("A1:N1")->applyFromArray($style);
            $objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
            $objPHPExcel->getActiveSheet()->SetCellValue('A2','S.N.');
            $objPHPExcel->getActiveSheet()->SetCellValue('B2','Part Code');
            $objPHPExcel->getActiveSheet()->SetCellValue('C2','Part Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('D2','Dispatched Quantity');
            $objPHPExcel->getActiveSheet()->SetCellValue('E2','Price');
            $objPHPExcel->getActiveSheet()->SetCellValue('F2','Total Amount');

            $row = 3;
            $col = 0;        
            foreach($result as $key => $values) 
            {           
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_code);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_sales_quantity);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_price);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->total_value);
                $col++;
                $col = 0;
                $row++;        
            }

            header("Pragma: public");
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment;filename=parwise_sales_reports.xls");
            header("Content-Transfer-Encoding: binary ");
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            ob_end_clean();
            $objWriter->save('php://output');

            
        }
        redirect('spareparts_report/generate/partwise_sales');
        
    }
}

/**
1   Overall finance % across dealership(Funding Banks on Retail)    %   80%
2   Document Completion Date from booking date <10 days(Funding Banks)  Days    10
3   DO collection date from Document submission confirmation <5 days    Days    5
    a) Standard Chartered Bank Limited  Days    5
    b) NIC ASIA Bank Limited    Days    5
    c) NMB Bank Limited Days    5
4   Payment collection from security transfer completion date <5 days   Days    5
    a) Standard Chartered Bank Limited  Days    5
    b) NIC ASIA Bank Limited    Days    5
    c) NMB Bank Limited Days    5
5   Rejection rate <5% of total documents submitted %   5%
6   Delivery with DO    %   100%
7   Equal Lead distribution to all tied up Banks (No of Leads forwarded)    %   99%
    a) Standard Chartered Bank Limited  %   33%
    b) NIC ASIA Bank Limited    %   33%
    c) NMB Bank Limited %   33%

**/