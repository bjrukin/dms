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
		
		// echo '<pre>';
		// print_r($entry);
		// echo count($entry);


        // Display Page
        $data['header']                 = 'Service Report';
        $data['page']                   = $this->config->item('template_admin') . "report";
        $data['module']                 = 'job_cards';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = '';
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);

	}

	public function get_report_json(){
		$report_criteria_index = $this->input->post('report_criteria'); 

        $report_criteria = array(
	                                'dbview'    => 'view_log_stock_records',
	                                'col'       => '',
	                                'label'     => 'Dealer',
	                            );

        extract($report_criteria);

        $whereCondition = array();

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')";
            }
        }

//#######################################//
		$this->job_card_model->_table = 'view_service_job_card';

		$this->db->group_by(array('jobcard_group','vehicle_name','variant_name','color_name','status'));
		$field = "vehicle_name AS Model,variant_name AS Variant,color_name AS Color, status AS Status";
		$entry = $this->job_card_model->findAll(NULL,$field);

		$total = count($entry);
        if (count($entry) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $entry, 'total'=> $total));
	}
}