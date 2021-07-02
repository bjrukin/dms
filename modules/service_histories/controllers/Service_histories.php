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
* service_history
*
* Extends the Report_Controller class
* 
*/

class Service_histories extends Project_Controller
{
    public function __construct()
    {
        parent::__construct();

        control('Service Histories');

        $this->load->model('service_histories/service_history_model');
        $this->lang->load('service_histories/service_history');
    }

    public function index()
    {
        $data['header'] = lang('service_history');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'service_histories';
        $this->load->view($this->_container,$data);
    }

    public function json()
    {
        $where = array();

        $search = $this->input->get('search');


        // if($search['chassis_no']) {
        //     $where['lower(chassis_no)'] = strtolower($search['chassis_no']);
        // }
        // if($search['coupon_no']) {
        //     $where['lower(coupon)'] = strtolower($search['coupon_no']);
        // }
        // if($search['vehicle_no']) {
        //     $where['lower(vehicle_no)'] = strtolower($search['vehicle_no']);
        // }

        $this->service_history_model->_table = "view_report_grouped_jobcard";

        // $fields = 'jobcard_group,vehicle_name,variant_name,engine_no,chassis_no,jobcard_issue_date,full_name,service_type_name,service_count,coupon, jobcard_serial,vehicle_no,dealer_id, service_adviser_id, service_advisor_name,dealer_name';
        // $this->db->group_by($fields);

        // $total=$this->service_history_model->find_count( $where,$fields);
        
        paging('job_card_issue_date');
        
        search_params();

        // if(is_admin()){
        //     $where = array();
        // }else if( is_service_advisor() || is_accountant() ) {
        //     if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
        //         $dealer_id = $this->dealer_id;
        //         $where['dealer_id'] = $dealer_id;
        //     }
        

        // } else if(is_floor_supervisor()){
        //     $where['dealer_id'] = $this->dealer_id;
        // } else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge()  || is_service_finance()){
        //     $where = array();
    
        // }else if( is_service_dealer_incharge() ) {
        //     $this->load->model('dealers/dealer_model');
        //     $dealers_of = $this->dealer_model->findAll(array('service_incharge_id' => $this->_user_id),'id');

        //     $dealers_list = null;
        //     foreach ($dealers_of as $key => $value) {
        //         $dealers_list[] = $value->id;
        //     }           
        //     $this->db->where_in('dealer_id', $dealers_list);
        //     unset($dealers_list);

        // }else{
        //     $dealer_id = $this->dealer_id;
        //     $where['dealer_id'] = $dealer_id;
        // }   
        

        if(is_admin()){
            // $where = array();
        }else if( is_service_head() || is_national_service_manager() || is_admin() || is_ccd_incharge()  || is_service_finance()){
            // $where = array();
    
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
            $this->db->where("dealer_id", $this->dealer_id);
        }

        if($search['chassis_no']) {
            // $where['lower(chassis_no)'] = strtolower($search['chassis_no']);
            $this->db->like('lower(chassis_no)',strtolower($search['chassis_no']));
        }
        if($search['coupon_no']) {
            // $where['lower(coupon)'] = strtolower($search['coupon_no']);
            $this->db->like('lower(coupon_no)',strtolower($search['coupon_no']));

        }
        if($search['vehicle_no']) {
            $this->db->like('lower(vehicle_no)',strtolower($search['vehicle_no']));
            // $where['lower(vehicle_no)'] = strtolower($search['vehicle_no']);
        }if($search['customer_name']) {
            $this->db->like('lower(customer_name)',strtolower($search['customer_name']));
            // $where['lower(vehicle_no)'] = strtolower($search['vehicle_no']);
        }
        
        // $this->db->where('invoice_no');
         $this->db->where('invoice_no IS NOT NULL');
        // $this->db->group_by($fields);
        $rows = $this->service_history_model->findAll(  );
        // echo $this->db->last_query();exit;
        
        echo json_encode(array('total'=>count($rows),'rows'=>$rows));
        exit;
        
    }

    public function get_job_history()
    {
        $jobcard_group = $this->input->get('jobcard_group');
        $this->service_history_model->_table = "view_jobcard_billed_details";
        // $this->service_history_model->_table = "view_service_job_card";

        $total=$this->service_history_model->find_count(array('jobcard_group'=>$jobcard_group ));
        
        paging('jobcard_group');
        
        search_params();
        
        $rows=$this->service_history_model->findAll(array('jobcard_group'=>$jobcard_group ));
        
        // print_r($this->db->last_query());
        // exit;
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit; 
    }

    public function get_part_history()
    {
        $jobcard_group = $this->input->get('jobcard_group');
        // $this->service_history_model->_table = "view_material_scan";
        $this->service_history_model->_table = "view_service_billing_parts";
        
        paging('jobcard_group');
        
        search_params();
        // $this->db->where('invoice_no IS NOT NULL');
        $rows=$this->service_history_model->findAll(array('jobcard_group'=>$jobcard_group ));
         // echo $this->db->last_query();exit;
        echo json_encode(array('total'=>count($rows),'rows'=>$rows));
        exit; 
    }
}