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
* Stock_records
*
* Extends the Project_Controller class
* 
*/
class Stock_records extends Project_Controller {

    public function __construct() {
        parent::__construct();

        // control('Logistic Stock');

        $this->load->model('stock_records/stock_record_model');
        $this->load->model('stock_yards/stock_yard_model');
        $this->lang->load('stock_records/stock_record');
        $this->load->model('driver_details/driver_detail_model');
        $this->load->model('dispatch_records/dispatch_record_model');
        $this->load->model('dealer_orders/dealer_order_model');
        $this->load->model('vehicle_returns/vehicle_return_model');
        $this->load->model('vehicle_processes/vehicle_process_model');
        $this->load->model('fiscal_years/fiscal_year_model');
        $this->load->model('stock_damage_records/stock_damage_record_model');
           
        $this->load->model('dispatch_spareparts/dispatch_sparepart_model');
        $this->load->model('sparepart_orders/sparepart_order_model');

        
        $this->load->library('stock_records/stock_record');
    }

    public function index() {
// Display Page
        control('Logistic Stock');
        $data['stock_yards'] = $this->stock_yard_model->findAll();
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'stock_records';
        $this->load->view($this->_container, $data);
    }

    public function pdi_index() {
        //control('PDI');
        $data['stock_yards'] = $this->stock_yard_model->findAll();
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "pdi_index";
        $data['module'] = 'stock_records';
        $this->load->view($this->_container, $data);
    }

    public function myownfunction()
    {
        $this->stock_record_model->_table = 'log_stock_records';
        $this->db->where('damage_date <>',null);
        $all = $this->stock_record_model->findAll();
        foreach ($all as $key => $value) {
            $data['stock_record_id']        = $value->id;
            $data['damage_date']            = $value->damage_date;
            $data['damage_date_nep']        = $value->damage_date_nep;
            $data['repair_commitment_date'] = $value->repair_commitment_date;
            $data['repair_date']            = $value->repair_date;
            $data['repair_date_nep']        = $value->repair_date_nep;
            $data['remarks']                = $value->remarks;
            $data['current_location']       = $value->current_location;
            $this->stock_damage_record_model->insert($data);

        }

    }

    public function json() {
        if (is_group(DEALER_INCHARGE_GROUP) || is_group(ASSISTANT_DEALER_INCHARGE)){
            $where  = "(current_status = 'Stock' OR current_status = 'Display' OR current_status = 'damage' OR current_status = 'repaired_stock')";
        }else{
            $where  = "current_status <> 'retail' AND current_status <> 'Transit' AND current_status <> 'Custom' AND current_status <> 'Bill'";
        }
        $this->stock_record_model->_table = 'view_log_stock_record_working';
        search_params();
        $this->db->where($where);
        $total = $this->stock_record_model->find_count();

        paging('id');

        search_params();
        $this->db->where($where);
        $rows = $this->stock_record_model->findAll();
        // echo $this->db->last_query();die();

        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }

    public function stock_json() {
        $id = $this->input->post('id');
        $this->stock_record_model->_table = 'view_log_stock_records';

        search_params();

        $this->db->where('stock_yard_id', $id);
        $total = $this->stock_record_model->find_count();

        paging('id');

        search_params();
        $this->db->where('stock_yard_id', $id);
        $rows = $this->stock_record_model->findAll();

        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }


    // public function save() {
    //     $data = $this->_get_posted_data(); //Retrive Posted Data
    //     if (!$this->input->post('id')) {
    //         $success = $this->stock_record_model->insert($data);
    //     } else {
    //         $success = $this->stock_record_model->update($data['id'], $data);
    //     }

    //     if ($success) {
    //         $success = TRUE;
    //         $msg = lang('general_success');
    //         $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));
    //         $this->change_current_location($vehicle_detail->vehicle_id, $data['current_location'], 'damage');
    //     } else {
    //         $success = FALSE;
    //         $msg = lang('general_failure');
    //     }

    //     echo json_encode(array('msg' => $msg, 'success' => $success));
    //     exit;
    // }

    public function save() {
        $data = $this->_get_posted_data(); //Retrive Posted Data
        if (!$this->input->post('id')) {
            $success = $this->stock_record_model->insert($data);
        } else {
            $success = $this->stock_record_model->update($data['id'], $data);
        }

        if ($success) {
            $success = TRUE;
            $msg = lang('general_success');
            $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));
            $this->change_current_location($vehicle_detail->vehicle_id, $data['current_location'], 'damage');
            $data['stock_record_id'] = $data['id'];
            unset( $data['is_damage'],$data['is_dispatched'],$data['id'] );
            $success=$this->stock_damage_record_model->insert($data);            
        } else {
            $success = FALSE;
            $msg = lang('general_failure');
        }

        echo json_encode(array('msg' => $msg, 'success' => $success));
        exit;
    }

    public function saveChallanStatus()
    {
        $data['id'] = $this->input->post('id');
        $data['challan_status'] = $this->input->post('challan_status');
        // $data['hold_remark'] = $this->input->post('hold_remark');
        $data['challan_confirmation_date'] = $this->input->post('challan_confirmation_date');
        if($data['challan_status'] != 'On Hold'){
            $data['location'] = $this->input->post('location');
        }else{
            $data['location'] = NULL;
        }

        $success = $this->stock_record_model->update($data['id'], $data);

        if ($success) {
            $success = TRUE;
            $msg = lang('general_success');
        } else {
            $success = FALSE;
            $msg = lang('general_failure');
        }

        echo json_encode(array('msg' => $msg, 'success' => $success));
        exit;
    }

      public function saveHoldRemark()
    {


        $data['id'] = $this->input->post('id');
       
        $data['hold_remark'] = $this->input->post('hold_remark');
       
        $success = $this->stock_record_model->update($data['id'], $data);

        if ($success) {
            $success = TRUE;
            $msg = lang('general_success');
        } else {
            $success = FALSE;
            $msg = lang('general_failure');
        }

        echo json_encode(array('msg' => $msg, 'success' => $success));
        exit;
    }

    public function get_damage_log_detail_json()
    {
        $stock_id = $this->input->post('id');
        $this->db->where('stock_record_id',$stock_id);
        $rows=$this->stock_damage_record_model->findAll();

        echo json_encode(array('rows' => $rows ));

    }

    private function _get_posted_data() {
        $data = array();
        if ($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
        }
        $data['damage_date'] = $this->input->post('damage_date');     
        $data['damage_date_nep'] = get_nepali_date($this->input->post('damage_date'),'nep');
        $data['repair_commitment_date'] = $this->input->post('repair_commit_date');
        $data['current_location'] = $this->input->post('current_location');
        $data['is_damage'] = 1;  
        $data['accident_type'] = ($this->input->post('accident_type') != 'Select option'?$this->input->post('accident_type'):NULL);
        if($this->input->post('dispatch_date'))
        {
            $data['is_dispatched'] = 1;
        }
        else
        {
            $data['is_dispatched'] = 0;
        }
        return $data;
    }

/*    public function save_repair()
    {        
        $data['id'] = $this->input->post('id');
        $data['repair_date'] = $this->input->post('repair_date');
        $data['repair_date_nep'] = get_nepali_date($this->input->post('repair_date'),'nep');
        $data['remarks'] = $this->input->post('remarks');
        $data['is_damage'] = 2;  
        if($data['id'])
        {
            $success = $this->stock_record_model->update($data['id'],$data);
        }  

        if ($success) {
            $success = TRUE;
            $msg = lang('general_success');

            $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));
            if($this->input->post('location_type') == 'stockyard')
            {
                $this->stock_record_model->_table = 'mst_stock_yards';
                $data['return_stockyard_id'] = $this->input->post('return_location_id');
            }
            else
            {
                $this->stock_record_model->_table = "dms_dealers";
                $data['return_stockyard_id'] = $this->input->post('return_location_id');
            }
            
            $location = $this->stock_record_model->find(array('id'=>$data['return_stockyard_id']));
            $this->change_current_location($vehicle_detail->vehicle_id, $location->name, 'repaired stock');

        } else {
            $success = FALSE;
            $msg = lang('general_failure');
        }

        echo json_encode(array('success'=>$success,'msg' => $msg));
    }
*/
    public function save_repair()
    {       
        $data['id'] = $this->input->post('id');
        $data['repair_date'] = $this->input->post('repair_date');
        $data['repair_date_nep'] = get_nepali_date($this->input->post('repair_date'),'nep');
        $data['remarks'] = $this->input->post('remarks');
        $vehicle_id = $this->input->post('vehicle_id'); 
        $variant_id = $this->input->post('variant_id');
        $color_id = $this->input->post('color_id');
        $data['is_damage'] = 2;  
        if($data['id'])
        {
            $success = $this->stock_record_model->update($data['id'],$data);
        }  

        if($success){
            $success = TRUE;
            $msg = lang('general_success');

            $this->db->select('id');
            $this->db->where(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'credit_control_approval <>'=>2,'in_stock_remarks'=> 0 ));
            $dispatch = $this->dealer_order_model->find(NULL,NULL,'id asc');
            if($dispatch){
                $set['in_stock_remarks'] = 1;
                $set['id'] = $dispatch->id;
                $this->dealer_order_model->update($set['id'],$set);
                
            }

            $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));

            if($this->input->post('location_type') == 'stockyard')
            {
                $this->stock_record_model->_table = 'mst_stock_yards';
                $data['return_stockyard_id'] = $this->input->post('return_location_id');
            }
            else
            {
                $this->stock_record_model->_table = "dms_dealers";
                $data['return_stockyard_id'] = $this->input->post('return_location_id');
            }
            $location = $this->stock_record_model->find(array('id'=>$data['return_stockyard_id']));

            $this->change_current_location($vehicle_detail->vehicle_id, $location->name, 'repaired stock');

        } else {
            $success = FALSE;
            $msg = lang('general_failure');
        }

        echo json_encode(array('success'=>$success,'msg' => $msg));
    }

    public function dealer() {
// Display Page
        $data['stock_yards'] = $this->stock_yard_model->findAll();
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "dealer";
        $data['module'] = 'stock_records';
        $this->load->view($this->_container, $data);
    }

    public function dealer_json() {
        $this->stock_record_model->_table = 'view_dealer_stock';
        search_params();

        $total = $this->stock_record_model->find_count();

        paging('id');

        search_params();

        $rows = $this->stock_record_model->findAll();

        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }

    public function stock_yard() {
        control('Stock Yard Records');
        $data['stock_yards'] = $this->stock_yard_model->findAll();
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "stock_yard";
        $data['module'] = 'stock_records';
        $this->load->view($this->_container, $data);
    }

    public function stock_yard_json() {
        $date = date('Y-m-d');
        $this->stock_record_model->_table = 'view_stock_yard_stocks';
        search_params();
        $group_by = (array('stockyard_name', 'vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name', 'stockyard_name', 'color_code'));
        $total_record = $this->stock_record_model->get_count(NULL, $group_by);
        $total = count($total_record);

        search_params();
        $this->db->where('stock_yard_dispatched_date', NULL);
        $this->db->group_by(array('stockyard_name', 'vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name', 'stockyard_name', 'color_code'));
        $fields = 'COUNT(id) AS vehicle_count,stockyard_name,vehicle_id,vehicle_name,variant_id,variant_name,color_id,color_name,stockyard_name, color_code';
        $data['transit'] = $this->stock_record_model->findAll(NULL, $fields);
        $rows = $data['transit'];
        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }

    public function dealer_stock() {
        control('Dealer Stock Records');

        $data['stock_yards'] = $this->stock_yard_model->findAll();
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "dealer_stock";
        $data['module'] = 'stock_records';
        $this->load->view($this->_container, $data);
    }

    public function dealer_stock_json() {
        $this->load->model('dealers/dealer_model');

        // $where = '1 = 1';

        $emp_details = $this->session->all_userdata();
        $this->stock_record_model->_table = 'view_dealer_stock';

        $user_id = $this->_user_id;
        if(is_showroom_incharge())
        {
            $dealer_id =  $dealer_id = $emp_details['employee']['dealer_id'];
            $where = "(dealer_id = {$dealer_id} AND (current_status = 'Bill' OR current_status='Domestic Transit'))";
        }
        else if(is_dealer_incharge())
        {
            $where = "(incharge_id = {$user_id} AND (current_status = 'Bill' OR current_status='Domestic Transit'))";
        }
        else if(is_assistant_dealer_incharge())
        {
            $where = "(assistant_incharge_id = {$user_id} AND (current_status = 'Bill' OR current_status='Domestic Transit'))";
        }
        else
        {
            $where = "((current_status = 'Bill' OR current_status='Domestic Transit'))";   
        }

        search_params();

        $this->db->where($where);
        $total = $this->stock_record_model->find_count();

        paging('id');

        search_params();
        $this->db->where($where);
        $rows = $this->stock_record_model->findAll();

        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }

    public function dealer_retail() {
        control('Dealer Stock Records');

        $data['stock_yards'] = $this->stock_yard_model->findAll();
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "dealer_retail";
        $data['module'] = 'stock_records';
        $this->load->view($this->_container, $data);
    }

    public function dealer_retail_json() {
        $input = $this->input->get();
        
        $pagenum  = (isset($input['pagenum'])) ? $input['pagenum'] : 0;
        
        $pagesize  = (isset($input['pagesize'])) ? $input['pagesize'] : 100;
        
        $offset = $pagenum * $pagesize;

        $this->stock_record_model->_table = 'view_dealer_retail_refined';
        // $this->stock_record_model->_table = 'view_dealer_retail';
        $user_id = $this->_user_id;

        $where = '1 = 1';
        
        $this->load->model('dealers/dealer_model');
        $emp_details = $this->session->all_userdata();

        if(is_showroom_incharge())
        {
            $dealer_id =  $dealer_id = $emp_details['employee']['dealer_id'];
            $where = "(dealer_id = {$dealer_id})";
            // $where = "(d_ids = {$dealer_id})";
        }
        if(is_dealer_incharge())
        {
            $where = "(incharge_id = {$user_id})";
        }
        if(is_assistant_dealer_incharge())
        {
            $where = "(assistant_incharge_id = {$user_id})";
        }
        // echo $where; exit;

        search_params();

        $this->db->where($where);
        $this->db->where('retail_date IS NOT', NULL);
        // $total = $this->stock_record_model->find_count();
        $this->db->select('count(DISTINCT(id)) AS total');
        $count_result = $this->db->get($this->stock_record_model->_table)->row();
        $total = $count_result->total;
        // print_r($total);exit;

        // $count_result = $this->stock_record_model->find(NULL,"count(DISTINCT(id)) AS total");
        // $total = $count_result->total;
        // echo $this->db->last_query();exit;

        // paging('id');

        // $this->db->limit($pagesize, $offset);

        //sorting
        if (isset($input['sortdatafield'])) {
            $sortdatafield = $input['sortdatafield'];
            $sortorder = (isset($input['sortorder'])) ? $input['sortorder'] :'asc';
            $this->db->order_by($sortdatafield, $sortorder); 
        } else {
            $this->db->order_by('id', 'DESC');
        }

        search_params();
        $this->db->where($where);
        $this->db->where('retail_date IS NOT', NULL);
        $this->db->get($this->stock_record_model->_table);

        $query = $this->db->last_query();
        $query .= " OFFSET $offset";
        $rows = $this->db->query($query)->result();

        // $rows = $this->stock_record_model->findAll();
        // print_r($this->db->last_query());exit;

        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }


    //    for stock record
    public function generate_report() {
        $this->load->model('vehicles/vehicle_model');
        $data['search'] = $this->input->post();
        $data['header'] = 'Dealer Stock Report';
        $data['page'] = $this->config->item('template_admin') . "dealer_stock_report";
        $data['module'] = 'stock_records';

        $this->vehicle_model->_table = 'view_dms_vehicles';
        search_params();
        $total = $this->vehicle_model->find_count();
//        paging('id');
        search_params();
        $this->db->order_by('vehicle_name');
        $data['rows'] = $this->vehicle_model->findAll();

        $data['records'] = array();
        $data['records'] = $this->get_stock_records();
//        for dealer stock
        $this->load->model('dealers/dealer_model');
        $data['dealers'] = $this->dealer_model->findAll();
        $data['dealer_stocks'] = $this->stock_record->getStockCountBydealer();


        $this->load->view($this->_container, $data);
    }

    public function get_stock_records($date = NULL) {
        if ($date == NUll) {
            $date = date('Y-m-d');
        }
//        for stock according to stockyard according to month

        $data['stock'] = $this->stock_record->get_stocks();
        $data['transit'] = $this->stock_record->get_transit_stocks();
        return $data;
    }
// list report types
    public function report_list()
    {
// Display Page
        $data['header'] = 'Logistic Reports';
        $data['page'] = $this->config->item('template_admin') . "report_list";
        $data['module'] = 'stock_records';
        $this->load->view($this->_container,$data);
    }
// function for report generation
    public function generate($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/stock_records/report_list');  
        }

// Display Page
        $data['header']                 = 'Logistic Report';
        $data['page']                   = $this->config->item('template_admin') . "generate-test";
        $data['module']                 = 'stock_records';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = '';
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }

    public function get_report_json() 
    {
        $report_criteria_index = $this->input->post('report_criteria');

        $whereCondition = array();
        if($report_criteria_index == 'logistic_daily_report')
        {
            $report_criteria = array(
                'dbview'    => 'view_log_stock_report', 
                'col'       => '', 
                'label'     => 'Dealer', 
            );

            extract($report_criteria);
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(inquiry_date_en >= '".$this->input->post('english_start_date')."' AND inquiry_date_en <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(inquiry_date_en >= '".$english_start_date."' AND inquiry_date_en <= '".$english_end_date."')";
            }
            // if($this->input->post('date_range')) 
            // {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $whereCondition[] = "(inquiry_date_en >= '".$date_range[0]."' AND inquiry_date_en <= '".$date_range[1]."')";
            //     }
            // }

            $fields = array();
            $fields[] = 'stockyaard_dealer AS Stock/Dealer';
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';

            $this->db->select($fields);

            $this->db->from($report_criteria['dbview']);

            $this->db->order_by(
                "CASE stockyaard_dealer
                WHEN 'Kathmandu' THEN 1
                WHEN 'Bhairawa' THEN 2
                WHEN 'Birgunj' THEN 3
                WHEN 'Transit' THEN 4
                ELSE 5
                END"
            );
        }

        if ($report_criteria_index == 'dealer_stock') 
        {
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(dispatched_date >= '".$this->input->post('english_start_date')."' AND dispatched_date <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(dispatched_date <= '".$english_end_date."')";
            }            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $whereCondition[] = "(dispatched_date >= '".$date_range[0]."' AND dispatched_date <= '".$date_range[1]."')";
            //     }
            // }

            $report_criteria = array(
                'dbview'    => 'view_dealer_stock',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'color_code AS "Color Code"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'dispatched_date AS "Date(A.D.)"';
            $fields[] = 'chass_no AS "Chassis No"';
            $fields[] = 'engine_no AS "Engine No"';
            $fields[] = 'year AS "Mfg Year"';
            $fields[] = 'firm_name AS "Company"';
            $fields[] = 'current_status AS "Status"';
            $fields[] = 'vehicle_register_no AS "Vehicle Register No"';
            
            // $fields[] = 'month AS "Month"';
            // $fields[] = 'region_name AS "Region"';
            $where = "((current_status = 'Bill' OR current_status='Domestic Transit'))";

            extract($report_criteria);

            $this->db->select($fields);

            $this->db->from($report_criteria['dbview']);

            if (count($whereCondition) > 0) 
            {
                $this->db->where(implode(" AND " , $whereCondition));
            }
        }

        if ($report_criteria_index == 'dispatch') 
        {
            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $whereCondition[] = "(dispatch_date >= '".$date_range[0]."' AND dispatch_date <= '".$date_range[1]."')";
            //     }
            // }
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(dispatch_date >= '".$this->input->post('english_start_date')."' AND dispatch_date <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(dispatch_date >= '".$english_start_date."' AND dispatch_date <= '".$english_end_date."')";
            }
            $report_criteria = array(
                'dbview'    => 'view_report_msil_dispatch',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';      
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"';      
            $fields[] = 'invoice_no AS "Invoice No"';      
            //$fields[] = 'dispatch_date AS "Date(A.D.)"';
            $fields[] = 'indian_custom AS "Custom Clr Date"';
            $fields[] = 'year AS "Mfg Date"';
            $fields[] = 'nepal_custom AS "Border CR Date"';
            $fields[] = 'current_location AS "Location"';

            extract($report_criteria);

            $this->db->select($fields);

            $this->db->from($report_criteria['dbview']);

            if (count($whereCondition) > 0) 
            {
                $this->db->where(implode(" AND " , $whereCondition));
            }
        }

        


        // if($report_criteria_index == 'retail_transfer')
        // {
        //     if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
        //         $whereCondition[] = "(vehicle_delivery_date >= '".$this->input->post('english_start_date')."' AND vehicle_delivery_date <= '".$this->input->post('english_end_date')."')";
                
        //     }else{
        //         list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
        //         $whereCondition[] = "(vehicle_delivery_date >= '".$english_start_date."' AND vehicle_delivery_date <= '".$english_end_date."')";
        //     }
        //     $report_criteria = array(
        //         'dbview'    => 'view_retail_report',
        //         'col'       => '',
        //         'label'     => 'Dealer',
        //     );
        //     $fields = array();
        //     $fields[] = 'vehicle_name AS "Model"';
        //     $fields[] = 'variant_name AS "Variant"';
        //     $fields[] = 'color_code AS "Color Code"';   
        //     $fields[] = 'color_name AS "Color"';      
        //     $fields[] = 'engine_no AS "Engine No"';      
        //     $fields[] = 'chass_no AS "Chassis No"';      
        //     $fields[] = 'vehicle_register_no AS "Register No"';      
        //     $fields[] = 'full_name AS "Customer"';
        //     // $fields[] = 'edit_month AS "changed Retail Np Month"';
        //     $fields[] = 'CASE WHEN nepali_month is NULL THEN \'N/A\' WHEN nepali_edited_month_retail IS NOT NULL THEN nepali_edited_month_retail  ELSE nepali_month END AS "changed Retail Np Month"';
        //     $fields[] = 'retail_month_id AS "Previous Retail Np Month"';
        //     $fields[] = 'executive_name AS "Executive  Name"';
            
         
        //     $fields[] = 'retail_date AS "Changed Retail En Date"';
        //     $fields[] = 'retail_date_np AS "Changed Retail Np Date"';
        //     $fields[] = 'log_retail_date AS "Previous En Retail Date"';
        //     $fields[] = 'log_retail_date_np AS "Previous Np Retail Date"';
        //     $fields[] = 'mobile AS "Customer Number"';
        //     $fields[] = 'dealer_name AS "Dealer Name"';
        //     $fields[] = 'inquiry_no AS "Inquiry No"';
        //     $fields[] = 'booked_date AS "Booked Date"';
        //     $fields[] = 'invoice_no AS "Invoice No"';
        
          
            

        //     extract($report_criteria);

        //     $this->db->select($fields);

        //     $this->db->from($report_criteria['dbview']);

        //     if (count($whereCondition) > 0) 
        //     {
        //         $this->db->where(implode(" AND " , $whereCondition));
        //     }
        //     $this->db->where('nepali_edited_month_retail IS NOT',NULL);
        // }


        if($report_criteria_index == 'retail_transfer')
        {
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(vehicle_delivery_date >= '".$this->input->post('english_start_date')."' AND vehicle_delivery_date <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(vehicle_delivery_date >= '".$english_start_date."' AND vehicle_delivery_date <= '".$english_end_date."')";
            }
            $report_criteria = array(
                'dbview'    => 'view_retail_report',
                'col'       => '',
                'label'     => 'Dealer',
            );
            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_code AS "Color Code"';   
            $fields[] = 'color_name AS "Color"';      
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"';      
            $fields[] = 'vehicle_register_no AS "Register No"';      
            $fields[] = 'full_name AS "Customer"';
            // $fields[] = 'edit_month AS "changed Retail Np Month"';
            $fields[] = 'CASE WHEN nepali_month is NULL THEN \'N/A\' WHEN nepali_edited_month_retail IS NOT NULL THEN nepali_edited_month_retail  ELSE nepali_month END AS "changed Retail Np Month"';
            $fields[] = 'retail_month_id AS "Previous Retail Np Month"';
            $fields[] = 'executive_name AS "Executive  Name"';
            
         
            $fields[] = 'retail_date AS "Changed Retail En Date"';
            $fields[] = 'retail_date_np AS "Changed Retail Np Date"';
            $fields[] = 'log_retail_date AS "Previous En Retail Date"';
          
            $d = "log_retail_date + INTERVAL '56 YEAR' + INTERVAL '8 MONTH'+INTERVAL '14 DAY'";
            $date = "to_date(to_char(".$d.", 'YYYY/MM/DD'), 'YYYY/MM/DD')" ;
            $fields[] =$date.'AS "Previous Np Retail Date"';
            $fields[] = 'mobile AS "Customer Number"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'inquiry_no AS "Inquiry No"';
            $fields[] = 'booked_date AS "Booked Date"';
            $fields[] = 'invoice_no AS "Invoice No"';
        
          
            

            extract($report_criteria);

            $this->db->select($fields);

            $this->db->from($report_criteria['dbview']);

            if (count($whereCondition) > 0) 
            {
                $this->db->where(implode(" AND " , $whereCondition));
            }
            $this->db->where('nepali_edited_month_retail IS NOT',NULL);
        }

// foreach ($result as $key => $value) 
// {
//     $result[$key]['Date(B.S.)'] = get_nepali_date($value['Date(A.D.)'],'nepali');
// }
        if(isset($where))
        {
            $this->db->where($where);
        }
        $this->db->where('deleted_at IS NULL');

        $result = $this->db->get()->result_array();
   
        $total = count($result);
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

//for retail detail
    
    public function get_dealer_stock()
    {
        $report_criteria_index = $this->input->post('report_criteria');

        $whereCondition = array();

        if ($report_criteria_index == 'primary_sales') 
        {
            if($this->input->post('date_range')) {
                $date_range = explode(" - ", $this->input->post('date_range'));
                if ($date_range[0] != null && $date_range[1] != null) {
                    $whereCondition[] = "(dealer_dispatch_date >= '".$date_range[0]."' AND dealer_dispatch_date <= '".$date_range[1]."')";
                }
            }

            $report_criteria = array(
                'dbview'    => 'view_primary_sales_report',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'name AS "Variant"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'dealer_dispatch_date AS "Date(A.D.)"';
            $fields[] = 'parent_name AS "Zone"';
            $fields[] = 'month AS "Month"';
            $fields[] = 'region_name AS "Region"';
        }

        if($report_criteria_index == 'retail_transfer')
        {
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(vehicle_delivery_date >= '".$this->input->post('english_start_date')."' AND vehicle_delivery_date <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(vehicle_delivery_date >= '".$english_start_date."' AND vehicle_delivery_date <= '".$english_end_date."')";
            }
            $report_criteria = array(
                'dbview'    => 'view_dealer_retail_refined',
                'col'       => '',
                'label'     => 'Dealer',
            );
            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';      
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"';      
            $fields[] = 'full_name AS "Customer"';
            $fields[] = 'edit_month AS "changed Retail Np Month"';
           
            $fields[] = 'retail_date_np_month AS "Previous Retail Np Month"';
            $fields[] = 'executive_name AS "Executive  Name"';
            
            $fields[] = 'actual_status_name AS "Status Name"';
            $fields[] = 'retail_date AS "Changed Retail En Date"';
            $fields[] = 'retail_date_np AS "Changed Retail Np Date"';
            $fields[] = 'log_retail_date AS "Previous En Retail Date"';
            $fields[] = 'log_retail_date_np AS "Previous Np Retail Date"';
            $fields[] = 'mobile_1 AS "Customer Number"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'inquiry_no AS "Inquiry No"';
            $fields[] = 'booked_date AS "Booked Date"';
            $fields[] = 'booking_receipt_no AS "Receipt No"';
            $fields[] = 'customer_type_name AS "Customer Type"';
            $fields[] = 'source_name AS "Source Name"';
            

            extract($report_criteria);

            $this->db->select($fields);

            $this->db->from($report_criteria['dbview']);

            if (count($whereCondition) > 0) 
            {
                $this->db->where(implode(" AND " , $whereCondition));
            }
        }


        extract($report_criteria);

        $this->db->select($fields);

        $this->db->from($report_criteria['dbview']);

        if (count($whereCondition) > 0) 
        {
            $this->db->where(implode(" AND " , $whereCondition));
        }

        $result = $this->db->get()->result_array();

        foreach ($result as $key => $value) 
        {
            $result[$key]['Date(B.S.)'] = get_nepali_date($value['Date(A.D.)'],'nepali');
        }

        $total = count($result);
        if (count($result) > 0) 
        {
            $success = true;
        } 
        else 
        {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function billing_stock($type = NULL)
    {
// $type = 'billing_stock';
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "billing_stock";
        $data['module'] = 'stock_records';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = 'Mfg Year';
        $data['default_row']            = null;

        $this->load->view($this->_container, $data);   
    }

    public function generate_billing_stock()
    {
        $where = array();

        $report_criteria_index = $this->input->post('report_criteria');

        if ($report_criteria_index == 'cg_stock') 
        {
            $report_criteria = array(
                'dbview'    => 'view_msil_cg_stock',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';      
            $fields[] = 'color_code AS "Color Code"';      
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"';      
            $fields[] = 'year AS "Mfg Year"';      
            $fields[] = 'firm_name AS "Company"';      
            $fields[] = 'current_status AS "Current Status"';      
            $fields[] = "current_location AS Location";    
            $fields[] = "invoice_no AS Invoice";    
            $fields[] = "invoice_date AS Invoice Date";    
            // $fields[] = "CASE WHEN current_status = 'Transit' THEN 'Transit' ELSE current_location END AS Location";      
            $fields[] = 'year AS "Mfg Year"';
            $fields[] = 'invoice_no AS "Invoice No"';
            $fields[] = 'key_no AS "Key No"';
            $fields[] = 'pragyapan_no AS "Pragyapan No"';
            //$fields[] = 'dealer_dispatch_date AS "Date(A.D.)"';      
            $fields[] = 'nepal_custom AS "Nepal Custom Date"';
            $fields[] = 'indian_custom AS "India Custom Date"';
            $fields[] = 'age AS "Age"';
            $fields[] = 'challan_status AS "Challan Status"';
            $fields[] = 'location AS "Challan Location"';
            $fields[] = 'driver_name AS "Driver Name"';
            $fields[] = 'driver_number AS "Driver Number"';
            $fields[] = 'dispatch_date AS "Msil Dispatch Date"';
            $fields[] = 'nepal_custom_movement_date AS "Nepal Custom Movement Date"';
            $fields[] = 'nepal_custom_movement_date_np AS "Nepal Custom Movement Date(nep)"';
            $fields[] = 'india_custom_movement_date AS "India Custom Movement Date"';
            $fields[] = 'india_custom_movement_date_np AS "India Custom Movement Date(nep)"';
            $fields[] = 'vehicle_register_no AS "Vehicle Register No"';
            // $where[] = "(current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage')";
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $where[] = "(dispatch_date <= '".$this->input->post('english_end_date')."' AND (received_date > '".$this->input->post('english_end_date')."'  OR (received_date IS NULL AND current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage' ) ))";
                
            }else{                
                $where[] = "(current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage')";
            }
        }
        if ($report_criteria_index == 'cg_stock_position') 
        {
            $report_criteria = array(
                'dbview'    => 'view_msil_cg_stock',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';      
            $fields[] = 'color_code AS "Color Code"';      
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"';      
            $fields[] = 'year AS "Mfg Year"';      
            $fields[] = 'firm_name AS "Company"';      
            $fields[] = 'current_status AS "Current Status"';      
            $fields[] = "current_location AS Location";    
            // $fields[] = "CASE WHEN current_status = 'Transit' THEN 'Transit' ELSE current_location END AS Location";      
            $fields[] = 'year AS "Mfg Year"';
            $fields[] = 'invoice_no AS "Invoice No"';
            $fields[] = 'key_no AS "Key No"';
            $fields[] = 'pragyapan_no AS "Pragyapan No"';
            //$fields[] = 'dealer_dispatch_date AS "Date(A.D.)"';      
            $fields[] = 'nepal_custom AS "Nepal Custom Date"';
            $fields[] = 'indian_custom AS "India Custom Date"';
            $fields[] = 'age AS "Age"';
            $fields[] = 'challan_status AS "Challan Status"';
            $fields[] = 'location AS "Challan Location"';
            $fields[] = 'driver_name AS "Driver Name"';
            $fields[] = 'driver_number AS "Driver Number"';
            $fields[] = 'dispatch_date AS "Msil Dispatch Date"';
            if($this->input->post('date')){
                // $where[] = "((dispatch_date > '".$this->input->post('date')."' AND received_date <= '".$this->input->post('date')."')  OR (received_date IS NULL AND (current_status <> 'Bill') AND current_status <> 'retail' AND current_status <> 'Domestic Transit' AND current_status <> 'customer') )";
                $where[]  = "((dispatch_date <= '".$this->input->post('date')."' AND (retailed_date > '".$this->input->post('date')."' OR retailed_date IS NULL) AND (billing_date > '".$this->input->post('date')."' OR billing_date IS NULL)) OR current_status='Display')   AND year > 2016";
            }else{                
                $where[] = "(current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage') AND year > 2016";
            }

        }
        if ($report_criteria_index == 'damage_stock') 
        {
            $report_criteria = array(
                'dbview'    => 'view_log_stock_record_working',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';      
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"';      
            $fields[] = 'damage_date AS "Date(A.D.)"';
            $where[] = "(current_status = 'damage')";

            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $where[] = "(damage_date >= '".$this->input->post('english_start_date')."' AND damage_date <= '".$this->input->post('english_end_date')."')";
                
            }
                // else{
            //     list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
            //     $where[] = "(damage_date >= '".$english_start_date."' AND damage_date <= '".$english_end_date."')";
            // }
            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $where[] = "(damage_date >= '".$date_range[0]."' AND damage_date <= '".$date_range[1]."')";
            //     }
            // }

        }
        if ($report_criteria_index == 'repaired_stock') 
        {
            $report_criteria = array(
                'dbview'    => 'view_log_stock_record_working',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';    
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"';  
            $fields[] = 'repair_date AS "Date(A.D.)"';      
            // $fields[] = 'vehicle_location AS "Location"';      
            // $fields[] = 'repair_date AS "Repair Date(A.D.)"';      
            // $fields[] = 'month_name AS "Month"';    

            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $where[] = "(repair_date >= '".$this->input->post('english_start_date')."' AND repair_date <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $where[] = "(repair_date >= '".$english_start_date."' AND repair_date <= '".$english_end_date."')";
            }

            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $where[] = "(repair_date >= '".$date_range[0]."' AND repair_date <= '".$date_range[1]."')";
            //     }
            // }

            $where[] = "(current_status = 'repaired stock')";

        }

        if ($report_criteria_index == 'dealer_wise_monthly') 
        {

            $report_criteria = array(
                'dbview'    => 'view_report_dealer_dispatch',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_code AS "Color Code"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'year AS "Mfg Year"';
            $fields[] = 'firm_name AS "Company Name"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'dispatched_date AS "Date(A.D.)"';
            $fields[] = 'engine_no AS "Engine No"';      
            $fields[] = 'chass_no AS "Chassis No"'; 
            $fields[] = 'month_name AS "Month"';
            $fields[] = 'dispatched_date_np_year AS "Year"';
            $fields[] = 'nepal_custom AS "Nepal Custom Date"';
            $fields[] = 'zone_name AS "Zone Name"';
            $fields[] = 'region_name AS "Region Name"';
            $fields[] = 'challan_status AS Challan Status';
            $fields[] = 'location AS Challan Location';
            $fields[] = 'driver_name AS Driver Name';
            $fields[] = 'driver_contact AS Driver Number';
            $fields[] = 'vehicle_register_no AS Vehicle Register No';
            $fields[] = "invoice_no AS Invoice";    
            $fields[] = "invoice_date AS Invoice Date"; 
            $fields[] = "on_hold_remarks AS Remarks"; 
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $where[] = "(dispatched_date >= '".$this->input->post('english_start_date')."' AND dispatched_date <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $where[] = "(dispatched_date >= '".$english_start_date."' AND dispatched_date <= '".$english_end_date."')";
            }
            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $where[] = "(dispatched_date >= '".$date_range[0]."' AND dispatched_date <= '".$date_range[1]."')";
            //     }
            // }
            //$date = get_nepali_date(date('Y-m-d'),'true');
            //$dates = explode('-', $date);
            
            //$where[] = "(dispatched_date_np > '" . ($dates[0] - 1) . "-04-00' AND dispatched_date_np < '" . ($dates[0]) . "-03-35')"; 
            $where[] = "(vehicle_return_date IS NULL)";

        }

        if( $report_criteria_index == 'dealer_retail' )
        {
            $report_criteria = array(
                'dbview'    => 'view_retail_report',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'color_code AS "Color Code"';
            $fields[] = 'engine_no AS "Engine"';
            $fields[] = 'chass_no AS "Chassis"';
            $fields[] = 'year AS "Mfg Year"';
            $fields[] = 'firm_name AS "Compay Name"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'executive_name AS "Executive"';
            $fields[] = 'full_name AS "Customer"';
            $fields[] = 'booked_date AS "Booking Date"';
            $fields[] = 'billing_date AS "Dispatched Date"';
            $fields[] = 'CASE WHEN vehicle_delivery_date IS NULL THEN \'2017-06-01\' ELSE vehicle_delivery_date END AS "Date"';
            // $fields[] = 'CASE WHEN nepali_month is NULL THEN \'N/A\' ELSE nepali_month END AS "Month"';
            $fields[] = 'CASE WHEN nepali_month is NULL THEN \'N/A\' WHEN nepali_edited_month_retail IS NOT NULL THEN nepali_edited_month_retail  ELSE nepali_month END AS "Month"';
            
            $fields[] = 'CASE WHEN retail_year is NULL THEN \'N/A\' ELSE retail_year  END AS "Year"';
            $fields[] = 'zone_name AS "Zone Name"';
            $fields[] = 'region_name AS "Region Name"';
            $fields[] = 'name AS "Payment Mode"';
            $fields[] = 'mobile AS "Mobile"';
            $fields[] = 'vehicle_register_no AS "Vehicle Register No"';
            // $fields[] = 'nepali_edited_month_retail AS "Edit Nepali"';
            $fields[] = "invoice_no AS Invoice";    
            $fields[] = "invoice_date AS Invoice Date"; 
            $fields[] = "hold_remark AS Remark";   
            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $where[] = "(vehicle_delivery_date >= '".$this->input->post('english_start_date')."' AND vehicle_delivery_date <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $where[] = "(vehicle_delivery_date >= '".$english_start_date."' AND vehicle_delivery_date <= '".$english_end_date."')";
            }
            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $where[] = "(vehicle_delivery_date >= '".$date_range[0]."' AND vehicle_delivery_date <= '".$date_range[1]."')";
            //     }
            // }
            if (is_showroom_incharge()) 
            {
                $where[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
            }
            $where[] = "( nepali_month IS NOT NULL)";
            // echo '<pre>'; print_r($where); exit;
            // $where[] = "( actual_status_rank = 15)";
        } 
        if( $report_criteria_index == 'monthly_dispatch' )
        {        
            $report_criteria = array(
                'dbview'    => 'view_report_monthwise_dispatch',
                'col'       => '',
                'label'     => 'Dealer',
            );

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'dispatched_date AS "Date(A.D.)"';
            $fields[] = 'month_name AS "Month"';
            $fields[] = 'year AS "Year"';     

            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $where[] = "(dispatched_date > '".$this->input->post('english_start_date')."' AND dispatched_date < '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $where[] = "(dispatched_date >= '".$english_start_date."' AND dispatched_date <= '".$english_end_date."')";
            }
            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $where[] = "(dispatched_date >= '".$date_range[0]."' AND dispatched_date <= '".$date_range[1]."')";
            //     }
            // }
            $where[] = "(vehicle_return_date IS NULL)";

        }
        extract($report_criteria);

        $this->db->select($fields);
        if (count($where) > 0) 
        {
            $this->db->where(implode(" AND " , $where));
        }
        $this->db->from($report_criteria['dbview']);
        $result = $this->db->get()->result_array(); 

        // if($report_criteria_index == 'dealer_retail'){
        //     echo '<pre>'; print_r($result); exit;
        // }
         // echo $this->db->last_query();
         // exit;

        $total = count($result);
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        
            // print_r(($this->db->last_query()));
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function opening_stock($type = null) 
    {

        // Display Page
        $data['header']                 = 'Opening Stock';
        $data['page']                   = $this->config->item('template_admin') . "opening_stock";
        $data['module']                 = 'stock_records';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = '';
        $data['default_row']            = null;

        $this->load->view($this->_container,$data);
    }

    /*
    function for dashboard report of logistic
    stock position
    */
    public function stock_position(){
        $data = array();

        $date = $this->input->get('date');
        if($date == NULL){
            $date = date('Y-m-d');
        }        
        $date_np = get_nepali_date(date('Y-m-d'),'true');
        $dates = explode('-', $date_np);

        $param = array('vehicle_id', 'variant_id', 'vehicle_name','variant_name','current_location');
        $where = "(current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display')";
        $vehicle_param = array('vehicle_name','variant_name');
        $order_by = 'vehicle_name';

        $stock_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);
        // echo $this->db->last_query();
        // echo '<pre>'; print_r($stock_record); exit();


        $param = array('vehicle_id', 'variant_id', 'vehicle_name','variant_name');

        //today retails
        $where = array();
        $where['vehicle_status'] = 'retail';
        $where['retail_date'] = $date;
        $retail_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);
        //monthly retail
        $where = array();
        $where['vehicle_status'] = 'retail';
        $where['date_of_retail_np_month'] = $dates[1];
        $where['date_of_retail_np_year'] = $dates[0];
        $retail_monthly_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        // damage
        $where = array();
        $where['current_status'] = 'damage';
        $damage_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);
        // echo $this->db->last_query(); exit;
        // Display
        $where = array();
        $where['current_status'] = 'Display';
        $display_count = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        //today bill
        $where = array();
        // $where['vehicle_status'] = 'bill';
        $where['billing_date'] = $date;
        $bill_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        //monthly bill
        $where = array();
        // $where['vehicle_status'] = 'bill';
        $where['billing_date_np_month'] = $dates[1];
        $where['billing_date_np_year'] = $dates[0];
        $bill_monthly_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        $where = array();
        $where['transit = 0 OR transit ='] = NULL;
        $transit_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        $this->stock_record_model->_table = 'view_dms_vehicles';
        $this->db->group_by(array('vehicle_id', 'variant_id', 'vehicle_name', 'variant_name'));
        $fields = 'vehicle_id, variant_id, vehicle_name, variant_name';
        $vehicles = $this->stock_record_model->findAll(NULL,$fields,$order_by);

        $this->stock_record_model->_table = 'view_msil_order_pending';
        $this->db->group_by(array('vehicle_id','variant_id'));
        $fields = 'vehicle_id, variant_id, SUM(pending) AS count';
        $pending_record = $this->stock_record_model->findAll(NULL,$fields);

        $vehicles = $this->merge_array($vehicles,$bill_record,'count','bill_count');
        $vehicles = $this->merge_array($vehicles,$bill_monthly_record,'count','bill_monthly_count');
        $vehicles = $this->merge_array($vehicles,$damage_record,'count','damage_count');
        $vehicles = $this->merge_array($vehicles,$display_count,'count','display_count');
        $vehicles = $this->merge_array($vehicles,$retail_monthly_record,'count','retail_monthly_count');
        $vehicles = $this->merge_array($vehicles,$transit_record,'count','transit_count');
        $vehicles = $this->merge_array($vehicles,$pending_record,'count','pending_count');
        $vehicles = $this->merge_location($vehicles,$stock_record,'count');

        // echo '<pre>'; print_r($vehicles); exit;    
        echo json_encode($vehicles);
    }

    public function dealer_display(){

        // Display
        $where = array();
        $where['current_status'] = 'Display';
        $display = $this->stock_record->get_display_records('view_report_billing_stock_ec_list', $where);

        echo json_encode($display);
    }

    /*public function stock_position(){
        $data = array();

        $date = $this->input->get('date');
        if($date == NULL){
            $date = date('Y-m-d');
        }        
        $date_np = get_nepali_date(date('Y-m-d'),'true');
        $dates = explode('-', $date_np);

        $param = array('vehicle_id', 'variant_id', 'vehicle_name','variant_name','location');
        $where['vehicle_status'] = 'stock';
        $vehicle_param = array('vehicle_name','variant_name');
        $order_by = 'vehicle_name';

        $stock_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        $param = array('vehicle_id', 'variant_id', 'vehicle_name','variant_name');

        //today retail
        $where = array();
        $where['vehicle_status'] = 'retail';
        $where['retail_date'] = $date;
        $retail_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);
        //monthly retail
        $where = array();
        $where['vehicle_status'] = 'retail';
        $where['date_of_retail_np_month'] = $dates[1];
        $where['date_of_retail_np_year'] = $dates[0];
        $retail_monthly_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        $where = array();
        $where['vehicle_status'] = 'damage';
        $damage_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        //today bill
        $where = array();
        // $where['vehicle_status'] = 'bill';
        $where['billing_date'] = $date;
        $bill_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        //monthly bill
        $where = array();
        // $where['vehicle_status'] = 'bill';
        $where['billing_date_np_month'] = $dates[1];
        $where['billing_date_np_year'] = $dates[0];
        $bill_monthly_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        $where = array();
        $where['transit = 0 OR transit ='] = NULL;
        $transit_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        $this->stock_record_model->_table = 'view_dms_vehicles';
        $this->db->group_by(array('vehicle_id', 'variant_id', 'vehicle_name', 'variant_name'));
        $fields = 'vehicle_id, variant_id, vehicle_name, variant_name';
        $vehicles = $this->stock_record_model->findAll(NULL,$fields,$order_by);

        $this->stock_record_model->_table = 'view_msil_order_pending';
        $this->db->group_by(array('vehicle_id','variant_id','month','year'));
        $fields = 'vehicle_id, variant_id, SUM(pending) AS count';
        $pending_record = $this->stock_record_model->findAll(NULL,$fields);

        $vehicles = $this->merge_array($vehicles,$bill_record,'count','bill_count');
        $vehicles = $this->merge_array($vehicles,$bill_monthly_record,'count','bill_monthly_count');
        $vehicles = $this->merge_array($vehicles,$damage_record,'count','damage_count');
        $vehicles = $this->merge_array($vehicles,$retail_monthly_record,'count','retail_monthly_count');
        $vehicles = $this->merge_array($vehicles,$transit_record,'count','transit_count');
        $vehicles = $this->merge_array($vehicles,$pending_record,'count','pending_count');
        $vehicles = $this->merge_location($vehicles,$stock_record,'count');

        echo json_encode($vehicles);
    }*/


    /**
    * array1 main array
    * array2 data with merge data
    * index mergging index
    * new_index new index in array1 for variable 'index'
    */
    function merge_array($array1,$array2,$index,$new_index){
        foreach($array1 as $key => $temp_array){
            // print_r($temp_array);
            foreach($array2 as $temp_array2){
                if($temp_array2->vehicle_id == $temp_array->vehicle_id && $temp_array2->variant_id == $temp_array->variant_id){
                    $array1[$key]->$new_index = $temp_array2->$index;

                }
            }
            
        }
        return $array1;
    }

    function merge_location($array1,$array2,$index){
        foreach($array1 as $key => $temp_array){
            foreach($array2 as $temp_array2){
                if($temp_array2->vehicle_id == $temp_array->vehicle_id && $temp_array2->variant_id == $temp_array->variant_id){
                    $location = $temp_array2->current_location;
                    if($location != NULL){
                        if($location == 'Kathmandu' || $location == 'Pulchowk' || $location == 'Dhobighat' || $location == 'Suzuki Driving School' || $location == 'Bhaisepati' || $location == 'Tripureshwor' || $location == 'KATHMANDU' || $location == 'Dhapakhel' || $location == 'Satungal' || $location == 'Dhobighat Showroom'){
                            if(!property_exists($array1[$key], 'Kathmandu')){
                                $array1[$key]->Kathmandu = 0;
                            }
                            $array1[$key]->Kathmandu += $temp_array2->$index;
                        }
                        elseif($location == 'Satungal'){
                            if(!property_exists($array1[$key], 'Kathmandu')){
                                $array1[$key]->satungal = 0;
                            }
                            $array1[$key]->satungal += $temp_array2->$index;
                        }elseif($location == 'Dhapakhel'){
                             if(!property_exists($array1[$key], 'Kathmandu')){
                                $array1[$key]->dhapakhel = 0;
                            }
                            $array1[$key]->dhapakhel += $temp_array2->$index;
                        }
                        
                        elseif($location == 'Birgunj' || $location == 'Birgunj Pipra'){
                            if(!property_exists($array1[$key], 'Kathmandu')){
                                $array1[$key]->Birgunj = 0;
                            }
                            $array1[$key]->Birgunj += $temp_array2->$index;
                        }{
                            $array1[$key]->$location = $temp_array2->$index;
                        }
                    }
                }
            }
            
        }
        return $array1;
    }

    /**
    * dealer position report
    */

    function dealership_position($fiscal_year){
        $date = explode('%20-%20', str_replace('_', '-', $fiscal_year));

        $this->db->where(array('nepali_start_date'=>$date[0],'nepali_end_date' => $date[1]));
        $rows=$this->fiscal_year_model->find();
       
        $english_start_date = $rows->english_start_date;
        $english_end_date = $rows->english_end_date;
        

        list($fiscal_year_id,$fiscal_year) = get_current_fiscal_year();

        $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
        $date = date('Y-m-d');

        $date_np = get_nepali_date($date,'true');
        $dates = explode('-', $date_np);
        $month = $dates[0] . '-' . $dates[1] . '%';
        $nep_month = ltrim($dates[1],'0');



        $sql_pending_booking = 'SELECT "dealer_name", "actual_status_name", COUNT (actual_status_name) AS total FROM "view_customers" WHERE "actual_status_name" ::TEXT LIKE \''.'Booked'.'\'  AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
         $pending_booking = $this->db->query($sql_pending_booking)->result_array();
         
        $sql_today_bill = 'SELECT "dealer_name", "dispatched_date", COUNT (vehicle_id) AS bill FROM "view_report_dealer_dispatch" WHERE "dispatched_date_np" ::TEXT LIKE \''.$date_np.'\' AND "dispatched_date" >= \''.$english_start_date.'\' AND "dispatched_date" <= \''.$english_end_date.'\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $today_bill = $this->db->query($sql_today_bill)->result_array();

        // $sql_today_retail = 'SELECT "dealer_name", "retail_date", COUNT (msil_vehicle_id) AS retail FROM "view_dealer_retail" WHERE "retail_date_np" ::TEXT LIKE \''.$date_np.'\' AND "retail_date" >= \''.$english_start_date.'\' AND "retail_date" <= \''.$english_end_date.'\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $sql_today_retail = 'SELECT "dealer_name", COUNT (retail_month_id) as retail FROM "view_retail_report" WHERE vehicle_delivery_date = \'' . $date .'\' GROUP BY 1';
        $today_retail = $this->db->query($sql_today_retail)->result_array();

        $sql_month_bill = 'SELECT "dealer_name", "dispatched_date", COUNT (vehicle_id) AS bill FROM "view_report_dealer_dispatch" WHERE "edit_month_np" ::TEXT LIKE \''.$nep_month.'\' AND "dispatched_date" >= \''.$english_start_date.'\' AND "dispatched_date" <= \''.$english_end_date.'\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $monthly_bill = $this->db->query($sql_month_bill)->result_array();

        // $sql_month_retail = 'SELECT "dealer_name", "retail_date", COUNT (msil_vehicle_id) AS retail FROM "view_dealer_retail" WHERE "retail_date_np_month" ::TEXT LIKE \''.$nep_month.'\' AND "retail_date" >= \''.$english_start_date.'\' AND "retail_date" <= \''.$english_end_date.'\'   AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $sql_month_retail = "SELECT dealer_name, COUNT (retail_month_id) as retail FROM view_retail_report WHERE vehicle_delivery_date >= '".$english_start_date."'
            AND vehicle_delivery_date <= '".$english_end_date."'
            AND (
                (retail_month_id = '".$nep_month."' AND nepali_edit_month_id IS NULL)
                OR
                (nepali_edited_month_retail = '".$nep_month."')
            )
            GROUP BY 1";
        $monthly_retail = $this->db->query($sql_month_retail)->result_array();
        // echo $this->db->last_query();exit;

        $sql_bill_tilldate = 'SELECT "dealer_name", COUNT (vehicle_id) AS bill_tilldate FROM "view_report_dealer_dispatch" WHERE dispatched_date IS NOT NULL AND "dispatched_date" >= \''.$english_start_date.'\' AND "dispatched_date" <= \''.$english_end_date.'\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1';
        $bill_tilldate = $this->db->query($sql_bill_tilldate)->result_array();

        // $sql_retail_tilldate = 'SELECT "dealer_name", COUNT (msil_vehicle_id) AS retail_tilldate FROM "view_dealer_retail" WHERE "retail_date" >= \''.$english_start_date.'\' AND "retail_date" <= \''.$english_end_date.'\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1';
        // $retail_tilldate = $this->db->query($sql_retail_tilldate)->result_array();

        // $sql_retail_tilldate = 'SELECT "dealer_name", COUNT (engine_no) AS retail_tilldate FROM "view_retail_report" WHERE "vehicle_delivery_date" >= \''.$english_start_date.'\' AND "vehicle_delivery_date" <= \''.$english_end_date.'\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1';
        $sql_retail_tilldate = "SELECT dealer_name, COUNT (retail_month_id) as retail_tilldate FROM view_retail_report WHERE vehicle_delivery_date >= '".$english_start_date."'
            AND vehicle_delivery_date <= '".$english_end_date."'
            GROUP BY 1";
        $retail_tilldate = $this->db->query($sql_retail_tilldate)->result_array();
        // echo $this->db->last_query();

        $sql_stock = 'SELECT "current_location", COUNT (current_status) AS stock FROM "view_dealer_stock" WHERE ("current_status" = \'Bill\' OR "current_status" = \'Domestic Transit\') AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1';
        $stock = $this->db->query($sql_stock)->result_array();
        // echo $this->db->last_query();

        $this->stock_record_model->_table = 'view_dealers';
        $fields = 'name as location,rank, 0 AS bill, 0 AS retail, 0 AS monthly_bill, 0 AS monthly_retail, 0 AS bill_tilldate, 0 AS retail_tilldate, 0 AS stock,0 AS pending';
        // $this->db->where('name<>','BIG CAT INTERNATIONAL');
        $this->db->order_by('name');
        $data = $this->stock_record_model->findAll(NULL,$fields);
       

        foreach ($data as $key => $value) {
            foreach ($today_bill as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->bill += $val['bill'];
                }
            }
            foreach ($today_retail as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->retail += $val['retail'];
                }
            }
            foreach ($monthly_bill as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->monthly_bill += $val['bill'];
                }
            }
            foreach ($monthly_retail as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->monthly_retail += $val['retail'];
                }
            }
            foreach ($bill_tilldate as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->bill_tilldate += $val['bill_tilldate'];
                }
            }
            foreach ($retail_tilldate as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->retail_tilldate += $val['retail_tilldate'];
                }
            }
            foreach ($stock as $k => $val) {
                if($value->location == $val['current_location']){
                    $data[$key]->stock += $val['stock'];
                }
            }
            foreach ($pending_booking as $k => $val) {
               
                if($value->location == $val['dealer_name']){
                  
                    $data[$key]->pending += $val['total'];
                }
            }
        }

        $required_data = array();
        foreach ($data as $key => $value) {
            if($value->stock > 0 || $value->retail_tilldate > 0 || $value->bill_tilldate || $value->pending){
                $required_data[] = $value;
            }
        }

        echo json_encode($required_data);
        exit;
    }

    
    /*function dealership_position(){
        $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
        $date = date('Y-m-d');

        $date_np = get_nepali_date($date,'true');
        $dates = explode('-', $date_np);
        $month = $dates[0] . '-' . $dates[1] . '%';

        $sql_today_bill = 'SELECT "dealer_name", "billing_date", COUNT (current_status) AS bill FROM "view_report_billing_stock_ec_list" WHERE "billing_date_np" ::TEXT LIKE \''.$date_np.'\' AND ("current_status" = \'Bill\' OR "current_status" = \'Domestic Transit\') AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $today_bill = $this->db->query($sql_today_bill)->result_array();

        $sql_today_retail = 'SELECT "dealer_name", "retail_date", COUNT (current_status) AS retail FROM "view_report_billing_stock_ec_list" WHERE "date_of_retail_np" ::TEXT LIKE \''.$date_np.'\' AND "current_status" = \'retail\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $today_retail = $this->db->query($sql_today_retail)->result_array();

        $sql_month_bill = 'SELECT "dealer_name", "billing_date", COUNT (current_status) AS bill FROM "view_report_billing_stock_ec_list" WHERE "billing_date_np" ::TEXT LIKE \''.$month.'\' AND ("current_status" = \'Bill\' OR "current_status" = \'Domestic Transit\') AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $monthly_bill = $this->db->query($sql_month_bill)->result_array();

        $sql_today_retail = 'SELECT "dealer_name", "retail_date", COUNT (current_status) AS retail FROM "view_report_billing_stock_ec_list" WHERE "date_of_retail_np" ::TEXT LIKE \''.$month.'\' AND "current_status" = \'retail\' AND ( "deleted_at" > NOW() OR "deleted_at" IS NULL ) GROUP BY 1,2';
        $monthly_retail = $this->db->query($sql_today_retail)->result_array();

        $this->stock_record_model->_table = 'view_dealers';
        $fields = 'name as location, 0 AS bill, 0 AS retail, 0 AS monthly_bill, 0 AS monthly_retail';
        $data = $this->stock_record_model->findAll(NULL,$fields);
        
        foreach ($data as $key => $value) {
            foreach ($today_bill as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->bill += $val['bill'];
                }
            }
            foreach ($today_retail as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->retail += $val['retail'];
                }
            }
            foreach ($monthly_bill as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->monthly_bill += $val['bill'];
                }
            }
            foreach ($monthly_retail as $k => $val) {
                if($value->location == $val['dealer_name']){
                    $data[$key]->monthly_retail += $val['retail'];
                }
            }
        }
        echo json_encode($data);
    }*/

/*    function dealership_position(){
        $date = date('Y-m-d');

        $date_np = get_nepali_date($date,'true');
        $dates = explode('-', $date_np);

        $select1 = 'city_name, billing_date, retail_date, vehicle_status, count(vehicle_status)';
        $select2 = 'vehicle_status';

        $generate_sql = "SELECT
        generate_crosstab_sql_plain (
        $$ SELECT $select1 from view_report_billing_stock_ec_list 
        WHERE billing_date_np::text = '$date_np' OR date_of_retail_np::text = '$date_np' GROUP BY 1,2,3,4 $$,
        $$ SELECT $select2 from view_report_billing_stock_ec_list GROUP BY 1 $$,
        'INT',
        '\"location\" TEXT, \"bill_date\" TEXT, \"retail_date\" TEXT') AS sqlstring";

        $sql = $this->db->query($generate_sql)->row_array();
        $today_data = $this->db->query($sql['sqlstring'])->result_array();

        $month = $dates[0] . '-' . $dates[1] . '%';

        $generate_sql = "SELECT
        generate_crosstab_sql_plain (
        $$ SELECT $select1 from view_report_billing_stock_ec_list WHERE billing_date_np::text like '$month' OR date_of_retail_np::text like '$month' GROUP BY 1,2,3,4 $$,
        $$ SELECT $select2 from view_report_billing_stock_ec_list GROUP BY 1 $$,
        'INT',
        '\"location\" TEXT, \"bill_date\" TEXT, \"retail_date\" TEXT') AS sqlstring";
        $monthly_sql = $this->db->query($generate_sql)->row_array();

        $monthly_data = $this->db->query($monthly_sql['sqlstring'])->result_array();

        $this->stock_record_model->_table = 'view_city_places';
        $fields = 'name as location';
        $data = $this->stock_record_model->findAll(NULL, $fields);

        $count = count($data);
        foreach ($data as $key => $value) {
            foreach ($today_data as $i => $v) {
                $index = false;
                $index = array_search($value->location, $v);
                if($index){
                    if(key_exists('retail',$v)) {
                        $data[$key]->retail = $v['retail'];
                    } else {
                     $data[$key]->retail = 0;   
                 }
                 $data[$key]->bill = $v['bill'];
             } 
         }

         foreach ($monthly_data as $i => $v) {
            $index = false;
            $index_for_month = array_search($value->location, $v);
            if($index_for_month){
                if(key_exists('retail',$v)) {
                    $data[$key]->monthly_retail = $v['retail'];
                } else {
                    $data[$key]->monthly_retail = 0;
                }
                $data[$key]->monthly_bill = $v['bill'];
            }
        }
    }

    echo json_encode($data);
}*/

        /**
        * summary stock detail
        */
        function stock_summary(){
            $data = array();

            $date = $this->input->get('date');
            if($date == NULL){
                $date = date('YYYY-mm-dd');
            }
// Total stock, total cleared stock,total damage vehicle, total msil pending, total dealer stock, total billing, total retail, total display
            // $param = array('current_location');
            // $where["(current_status = 'Stock' OR current_status = 'Custom' OR current_status = 'repaired stock')"] = NULL;
            // $where['current_location <>'] = NULL;
            // $vehicle_param = array('current_location');
            // $order_by = 'current_location';

            // $stock_record = $this->stock_record->get_records('view_log_stock_record_working', $param, $where, $vehicle_param, $order_by);


            $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';


            $stock_record = array();

                    // for Total Stock
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["(current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage')"] = NULL;

            $count = $this->stock_record->get_records('view_log_stock_record_working', NULL, $where, $vehicle_param);
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Total Stock',
            );

            // for cleared stock
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["(current_status = 'Stock' OR current_status = 'damage' OR current_status = 'repaired stock' OR current_status = 'Display')"] = NULL;

            $count = $this->stock_record->get_records('view_log_stock_record_working', NULL, $where, $vehicle_param);
            // echo $this->db->last_query();
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Cleared Stock',
            );
            // for saleable stock
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["(current_status = 'Stock' OR current_status = 'repaired stock')"] = NULL;
            $where['for_sales'] = 1;
            $count = $this->stock_record->get_records('view_log_stock_record_working', NULL, $where, $vehicle_param);
            // print_r($count);
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Saleable Stock',
            );

            // for Damage
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["(current_status = 'damage')"] = NULL;

            $count = $this->stock_record->get_records('view_log_stock_record_working', NULL, $where, $vehicle_param);
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Damage',
            );

            // for Total display
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["(current_status = 'Display')"] = NULL;

            $count = $this->stock_record->get_records('view_log_stock_record_working', NULL, $where, $vehicle_param);
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Total display',
            );
            


            // for msil pending
            $this->stock_record_model->_table = 'view_msil_order_pending';
            $fields = 'SUM(pending) AS count';
            $count = $this->stock_record_model->findAll(NULL,$fields);
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Msil Pending',
            );
            // for Dealer Stock
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["(current_status = 'Bill' OR current_status = 'Domestic Transit')"] = NULL;

            $count = $this->stock_record->get_records('view_dealer_stock', NULL, $where, $vehicle_param);
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Dealer Stock',
            );
            // for Total Billing

            $data = array();

            $date = get_nepali_date(date('Y-m-d'),'true');
            $dates = explode('-', $date);
            
            // $where = array();
            // $vehicle_param = array('current_location');
            // $param = array('current_location');
            // $where["((dispatched_date_np  > '" . ($dates[0]) . "-04-00' AND dispatched_date_np  < '" . ($dates[0] + 1) . "-03-35') AND (deleted_at > NOW() OR deleted_at IS NULL))"] = NULL;
            // $count = $this->dispatch_dealer_model->find_count($where);

            // $stock_record[] = array(
            //     'count' => $count,
            //     'title' => 'Total Billing',
            // );
            // // for Total Retail
            // $where = array();
            // $vehicle_param = array('current_location');
            // $param = array('current_location');
            // $where["((dispatched_date_np > '" . ($dates[0]) . "-04-00' AND dispatched_date_np < '" . ($dates[0] + 1) . "-03-35') AND current_status = 'retail')"] = NULL;

            // $count = $this->stock_record->get_records('view_log_stock_record_working', NULL, $where, $vehicle_param);
            // // echo $this->db->last_query();
            // $stock_record[] = array(
            //     'count' => $count[0]->count,
            //     'title' => 'Total Retail',
            // );

            list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();

            $this->stock_record_model->_table = 'view_report_dealer_dispatch';
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["((dispatched_date >= '" .$english_start_date."' AND dispatched_date <= '" .$english_end_date."'))"] = NULL;
            $count = $this->stock_record_model->findAll($where,'COUNT (engine_no) AS COUNT');

            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Total Billing',
            );
            // for Total Retail 
            $this->stock_record_model->_table = 'view_retail_report';
            $where = array();
            $vehicle_param = array('current_location');
            $param = array('current_location');
            $where["((vehicle_delivery_date >= '" .$english_start_date."' AND vehicle_delivery_date <= '" .$english_end_date."'))"] = NULL;
            $count = $this->stock_record_model->findAll($where,'COUNT (engine_no) AS COUNT');
            $stock_record[] = array(
                'count' => $count[0]->count,
                'title' => 'Total Retail',
            );

            echo json_encode($stock_record);
        }

        /**
        * billing
        */
        // function billing_record($fiscal_year){
        //     $data = array();   

        //     $date = get_nepali_date(date('Y-m-d'),'true');
        //     $dates = explode('-', $date);

        //     if($dates[1] < 4){
        //         $generate_sql = "SELECT
        //         generate_crosstab_sql_plain (
        //         $$ SELECT vehicle_name, edit_month_np, count(edit_month_np) from view_report_dealer_dispatch WHERE dispatched_date_np > '" . ($dates[0] - 1) . "-04-01' AND dispatched_date_np < '" . ($dates[0]) . "-03-35' AND (deleted_at > NOW() OR deleted_at IS NULL) GROUP BY 1,2 order by vehicle_name $$,
        //         $$ SELECT edit_month_np from view_report_dealer_dispatch WHERE edit_month_np IS NOT NULL GROUP BY 1 ORDER BY 1 $$,
        //         'INT',
        //         '\"VEHICLE\" TEXT') AS sqlstring";
        //     }else{
        //         $generate_sql = "SELECT
        //         generate_crosstab_sql_plain (
        //         $$ SELECT vehicle_name, edit_month_np, count(edit_month_np) from view_report_dealer_dispatch WHERE dispatched_date_np > '" . ($dates[0]) . "-04-00' AND dispatched_date_np < '" . ($dates[0] + 1) . "-03-35' AND (deleted_at > NOW() OR deleted_at IS NULL) GROUP BY 1,2 order by vehicle_name $$,
        //         $$ SELECT edit_month_np from view_report_dealer_dispatch WHERE edit_month_np IS NOT NULL GROUP BY 1  ORDER BY 1 $$,
        //         'INT',
        //         '\"VEHICLE\" TEXT') AS sqlstring";

        //         // $sql = "SELECT * from crosstab(
        //         //     $$ SELECT vehicle_name, variant_name, billing_date_np_month, count(billing_date_np_month) 
        //         //     from view_report_billing_stock_ec_list 
        //         //     WHERE billing_date_np > '" . $dates[0] . "-03-35' 
        //         //     AND billing_date_np < '" . ($dates[0] + 1) . "-04-00' 
        //         //     AND (deleted_at > NOW() OR deleted_at IS NULL)
        //         //     GROUP BY 1,2,3 $$,
        //         //     $$ SELECT billing_date_np_month from view_report_billing_stock_ec_list WHERE billing_date_np_month IS NOT NULL GROUP BY 1 $$
        //         //     ) AS (\"VEHICLE\" TEXT, \"VARIANT\" TEXT , \"12\" INT)";
        //     }
        //     $this->db->order_by('vehicle_name');
        //     $sql = $this->db->query($generate_sql)->result_array();

        //     $data = $this->db->query($sql[0]['sqlstring'])->result_array();
        //     // echo $this->db->last_query();

        //     foreach ($data as $key => $value) {
        //         $data[$key]['total'] = 0;
        //         foreach ($value as $index => $val) {
        //             if($index != 'VEHICLE' && $index != 'VARIANT'){
        //                 $data[$key]['total'] += $val;
        //             }
        //         }
        //     }

        //     array_walk_recursive($data, array($this,'array_replace_null_by_zero'));
        //     echo json_encode($data);

        // }

        // /**
        // * retail
        // */
    
    

        // function retail_record(){
        //     $data = array();

        //     $date = get_nepali_date(date('Y-m-d'),'true');
        //     $dates = explode('-', $date);

        //     if($dates[1] < 4){
        //         $generate_sql = "SELECT
        //         generate_crosstab_sql_plain (
        //         $$ SELECT vehicle_name, date_of_retail_np_month, count(date_of_retail_np_month) 
        //         from view_sales_report 
        //         WHERE date_of_retail_np > '" . ($dates[0] - 1) . "-04-00' 
        //         AND date_of_retail_np < '" . ($dates[0]) . "-03-35' 
        //         AND (deleted_at > NOW() OR deleted_at IS NULL)
        //         GROUP BY 1,2 ORDER BY vehicle_name asc $$,
        //         $$ SELECT date_of_retail_np_month from view_sales_report WHERE date_of_retail_np_month IS NOT NULL GROUP BY 1 ORDER BY 1 $$,
        //         'INT',
        //         '\"VEHICLE\" TEXT') AS sqlstring";
        //     }else{
        //         $generate_sql = "SELECT
        //         generate_crosstab_sql_plain (
        //         $$ SELECT vehicle_name, date_of_retail_np_month, count(date_of_retail_np_month) 
        //         from view_sales_report 
        //         WHERE date_of_retail_np > '" . ($dates[0]) . "-04-00' 
        //         AND date_of_retail_np < '" . ($dates[0] + 1) . "-03-35' 

        //         GROUP BY 1,2 ORDER BY vehicle_name asc $$,
        //         $$ SELECT date_of_retail_np_month from view_sales_report WHERE date_of_retail_np_month IS NOT NULL GROUP BY 1 ORDER BY 1 $$,
        //         'INT',
        //         '\"VEHICLE\" TEXT') AS sqlstring";

        //     }
        //     $sql = $this->db->query($generate_sql)->result_array();
        //     // print_r($sql) ;
        //     $this->db->order_by('VEHICLE');
        //     $data = $this->db->query($sql[0]['sqlstring'])->result_array();
        //     //echo $this->db->last_query();
        //     //exit;

        //     foreach ($data as $key => $value) {
        //         $data[$key]['total'] = 0;
        //         foreach ($value as $index => $val) {
        //             if($index != 'VEHICLE'){
        //                 $data[$key]['total'] += $val;
        //             }
        //         }
        //     }

        //     array_walk_recursive($data, array($this,'array_replace_null_by_zero'));
        //     echo json_encode($data);
        // }

        function billing_record($fiscal_year){
            $data = array();
            $dates = explode('%20-%20', str_replace('_', '-', $fiscal_year));
           
            $generate_sql = "SELECT
            generate_crosstab_sql_plain (
            $$ SELECT vehicle_name, edit_month_np, count(edit_month_np) from view_report_dealer_dispatch WHERE dispatched_date_np >= '" .$dates[0]."' AND dispatched_date_np <= '" . $dates[1]."' AND (deleted_at > NOW() OR deleted_at IS NULL) GROUP BY 1,2 order by vehicle_name $$,
            $$ SELECT edit_month_np from view_report_dealer_dispatch WHERE edit_month_np IS NOT NULL GROUP BY 1 ORDER BY 1 $$,
            'INT',
            '\"VEHICLE\" TEXT') AS sqlstring";
            // }else{
            //     $generate_sql = "SELECT
            //     generate_crosstab_sql_plain (
            //     $$ SELECT vehicle_name, edit_month_np, count(edit_month_np) from view_report_dealer_dispatch WHERE dispatched_date_np > '" . ($dates[0]) . "-04-00' AND dispatched_date_np < '" . ($dates[0] + 1) . "-03-35' AND (deleted_at > NOW() OR deleted_at IS NULL) GROUP BY 1,2 order by vehicle_name $$,
            //     $$ SELECT edit_month_np from view_report_dealer_dispatch WHERE edit_month_np IS NOT NULL GROUP BY 1  ORDER BY 1 $$,
            //     'INT',
            //     '\"VEHICLE\" TEXT') AS sqlstring";

            //     // $sql = "SELECT * from crosstab(
            //     //     $$ SELECT vehicle_name, variant_name, billing_date_np_month, count(billing_date_np_month) 
            //     //     from view_report_billing_stock_ec_list 
            //     //     WHERE billing_date_np > '" . $dates[0] . "-03-35' 
            //     //     AND billing_date_np < '" . ($dates[0] + 1) . "-04-00' 
            //     //     AND (deleted_at > NOW() OR deleted_at IS NULL)
            //     //     GROUP BY 1,2,3 $$,
            //     //     $$ SELECT billing_date_np_month from view_report_billing_stock_ec_list WHERE billing_date_np_month IS NOT NULL GROUP BY 1 $$
            //     //     ) AS (\"VEHICLE\" TEXT, \"VARIANT\" TEXT , \"12\" INT)";
            // }
            $this->db->order_by('vehicle_name');
            $sql = $this->db->query($generate_sql)->result_array();

            $data = $this->db->query($sql[0]['sqlstring'])->result_array();
            // echo $this->db->last_query();

            foreach ($data as $key => $value) {
                $data[$key]['total'] = 0;
                foreach ($value as $index => $val) {
                    if($index != 'VEHICLE' && $index != 'VARIANT'){
                        $data[$key]['total'] += $val;
                    }
                }
            }

            array_walk_recursive($data, array($this,'array_replace_null_by_zero'));
            echo json_encode($data);

        }

        // public function my()
        // {
        //     $date_range[0] = '2018-07-17';
        //     $date_range[1] = '2019-07-16';
        //      $report_criteria = array(
        //         'dbview'    => 'view_retail_report',
        //         'col'       => '',
        //         'label'     => 'Dealer',
        //     );

        //     $fields = array();
        //     $fields[] = 'vehicle_name AS "Model"';
        //     $fields[] = 'variant_name AS "Variant"';
        //     $fields[] = 'color_name AS "Color"';
        //     $fields[] = 'color_code AS "Color Code"';
        //     $fields[] = 'engine_no AS "Engine"';
        //     $fields[] = 'chass_no AS "Chassis"';
        //     $fields[] = 'year AS "Mfg Year"';
        //     $fields[] = 'firm_name AS "Compay Name"';
        //     $fields[] = 'dealer_name AS "Dealer Name"';
        //     $fields[] = 'executive_name AS "Executive"';
        //     $fields[] = 'full_name AS "Customer"';
        //     $fields[] = 'booked_date AS "Booking Date"';
        //     $fields[] = 'billing_date AS "Dispatched Date"';
        //     $fields[] = 'CASE WHEN vehicle_delivery_date IS NULL THEN \'2017-06-01\' ELSE vehicle_delivery_date END AS "Date"';
        //     $fields[] = 'CASE WHEN nepali_month is NULL THEN \'N/A\' ELSE nepali_month END AS "Month"';
        //     $fields[] = 'CASE WHEN retail_year is NULL THEN \'N/A\' ELSE retail_year  END AS "Year"';
        //     $fields[] = 'zone_name AS "Zone Name"';
        //     $fields[] = 'region_name AS "Region Name"';
            
        //     $where[] = "(vehicle_delivery_date >= '".$date_range[0]."' AND vehicle_delivery_date <= '".$date_range[1]."')";
          
        //     if (is_showroom_incharge()) 
        //     {
        //         $where[] = " ( dealer_id = " . $this->session->userdata('employee')['dealer_id'] . ")";
        //     }
        //     $where[] = "( nepali_month IS NOT NULL)";
            
        //     //$where[] = "(dispatched_date_np > '" . ($dates[0] - 1) . "-04-00' AND dispatched_date_np < '" . ($dates[0]) . "-03-35')"; 

        //     extract($report_criteria);

        //     $this->db->select($fields);
        //     if (count($where) > 0) 
        //     {
        //         $this->db->where(implode(" AND " , $where));
        //     }
        //     $this->db->from($report_criteria['dbview']);
        //     $result = $this->db->get()->result_array(); 

        //     echo count($result);
        //     echo '<pre>'; print_r($result); exit;
        // }

        // public function myfunction()
        // {
        //     $data = array();
        //     // $date = get_nepali_date(date('Y-m-d'),'true');
        //     // $dates = explode('-', $date);
        //     $dates[0] = '2075-04-01';
        //     $dates[1] = '2076-03-32';
        //     $generate_sql = "SELECT
        //     generate_crosstab_sql_plain (
        //     $$ SELECT vehicle_name, edit_month_np, count(edit_month_np) from view_report_dealer_dispatch WHERE dispatched_date_np > '" .$dates[0]."' AND dispatched_date_np < '" . $dates[1]."' AND (deleted_at > NOW() OR deleted_at IS NULL) GROUP BY 1,2 order by vehicle_name $$,
        //     $$ SELECT edit_month_np from view_report_dealer_dispatch WHERE edit_month_np IS NOT NULL GROUP BY 1 ORDER BY 1 $$,
        //     'INT',
        //     '\"VEHICLE\" TEXT') AS sqlstring";
        //     // }else{
        //     //     $generate_sql = "SELECT
        //     //     generate_crosstab_sql_plain (
        //     //     $$ SELECT vehicle_name, edit_month_np, count(edit_month_np) from view_report_dealer_dispatch WHERE dispatched_date_np > '" . ($dates[0]) . "-04-00' AND dispatched_date_np < '" . ($dates[0] + 1) . "-03-35' AND (deleted_at > NOW() OR deleted_at IS NULL) GROUP BY 1,2 order by vehicle_name $$,
        //     //     $$ SELECT edit_month_np from view_report_dealer_dispatch WHERE edit_month_np IS NOT NULL GROUP BY 1  ORDER BY 1 $$,
        //     //     'INT',
        //     //     '\"VEHICLE\" TEXT') AS sqlstring";

        //     //     // $sql = "SELECT * from crosstab(
        //     //     //     $$ SELECT vehicle_name, variant_name, billing_date_np_month, count(billing_date_np_month) 
        //     //     //     from view_report_billing_stock_ec_list 
        //     //     //     WHERE billing_date_np > '" . $dates[0] . "-03-35' 
        //     //     //     AND billing_date_np < '" . ($dates[0] + 1) . "-04-00' 
        //     //     //     AND (deleted_at > NOW() OR deleted_at IS NULL)
        //     //     //     GROUP BY 1,2,3 $$,
        //     //     //     $$ SELECT billing_date_np_month from view_report_billing_stock_ec_list WHERE billing_date_np_month IS NOT NULL GROUP BY 1 $$
        //     //     //     ) AS (\"VEHICLE\" TEXT, \"VARIANT\" TEXT , \"12\" INT)";
        //     // }
        //     $this->db->order_by('vehicle_name');
        //     $sql = $this->db->query($generate_sql)->result_array();



        //     $data = $this->db->query($sql[0]['sqlstring'])->result_array();
        //     // echo $this->db->last_query();

        //     foreach ($data as $key => $value) {
        //         $data[$key]['total'] = 0;
        //         foreach ($value as $index => $val) {
        //             if($index != 'VEHICLE' && $index != 'VARIANT'){
        //                 $data[$key]['total'] += $val;
        //             }
        //         }
        //     }

        //     array_walk_recursive($data, array($this,'array_replace_null_by_zero'));
        //     $sum = 0;
        //     foreach ($data as $key => $value) {
        //         $sum += $value['total'];
        //     }
        //     echo $sum;
        //     echo '<pre>'; print_r($data); exit;
        //     echo json_encode($data);
        // }

        /**
        * retail
        */
        function retail_record($fiscal_year){
            // $data = array();
            // // $date = get_nepali_date(date('Y-m-d'),'true');
            // // $dates = explode('-', $date);
            // $dates = explode('%20-%20', str_replace('_', '-', $fiscal_year));
            // // if($dates[1] < 4){
            //     $generate_sql = "SELECT
            //     generate_crosstab_sql_plain (
            //     $$ SELECT vehicle_name, date_of_retail_np_month, count(date_of_retail_np_month) 
            //     from view_sales_report 
            //     WHERE date_of_retail_np >= '".$dates[0]."' 
            //     AND date_of_retail_np <= '".$dates[1]."' 
            //     AND (deleted_at > NOW() OR deleted_at IS NULL)
            //     GROUP BY 1,2 ORDER BY vehicle_name asc $$,
            //     $$ SELECT date_of_retail_np_month from view_sales_report WHERE date_of_retail_np_month IS NOT NULL GROUP BY 1 ORDER BY 1 $$,
            //     'INT',
            //     '\"VEHICLE\" TEXT') AS sqlstring";

            //new
            $data = array();
            // $date = get_nepali_date(date('Y-m-d'),'true');
            // $dates = explode('-', $date);
            $dates = explode('%20-%20', str_replace('_', '-', $fiscal_year));
            $english_start_date = get_english_date($dates[0],1);
            $english_end_date = get_english_date($dates[1],1);
            // if($dates[1] < 4){
                // $generate_sql = "SELECT
                // generate_crosstab_sql_plain (
                // $$ SELECT vehicle_name, retail_month_id, count(retail_month_id) 
                // from view_retail_report 
                // WHERE vehicle_delivery_date >= '".$english_start_date."' 
                // AND vehicle_delivery_date <= '".$english_end_date."' 
               
                // GROUP BY 1,2 ORDER BY vehicle_name asc $$,
                // $$ SELECT id from mst_nepali_month   ORDER BY rank $$,
                // 'INT',
                // '\"VEHICLE\" TEXT') AS sqlstring";


            $generate_sql = "SELECT
                generate_crosstab_sql_plain (
                $$ SELECT vehicle_name, 
                CASE WHEN nepali_edit_month_id IS NOT NULL THEN nepali_edit_month_id  ELSE retail_month_id::integer END AS retail_month_id,                
                count(retail_month_id) 
                from view_retail_report 
                WHERE vehicle_delivery_date >= '".$english_start_date."' 
                AND vehicle_delivery_date <= '".$english_end_date."' 
                
                GROUP BY 1,2 ORDER BY vehicle_name asc $$,
                $$ SELECT id from mst_nepali_month   ORDER BY rank $$,
                'INT',
                '\"VEHICLE\" TEXT') AS sqlstring";

            // }else{
            //     $generate_sql = "SELECT
            //     generate_crosstab_sql_plain (
            //     $$ SELECT vehicle_name, date_of_retail_np_month, count(date_of_retail_np_month) 
            //     from view_sales_report 
            //     WHERE date_of_retail_np > '" . ($dates[0]) . "-04-00' 
            //     AND date_of_retail_np < '" . ($dates[0] + 1) . "-03-35' 

            //     GROUP BY 1,2 ORDER BY vehicle_name asc $$,
            //     $$ SELECT date_of_retail_np_month from view_sales_report WHERE date_of_retail_np_month IS NOT NULL GROUP BY 1 ORDER BY 1 $$,
            //     'INT',
            //     '\"VEHICLE\" TEXT') AS sqlstring";

            // }
            $sql = $this->db->query($generate_sql)->result_array();
            // print_r($sql) ;
            $this->db->order_by('VEHICLE');
            $data = $this->db->query($sql[0]['sqlstring'])->result_array();
            // echo $this->db->last_query();
            // exit;

            foreach ($data as $key => $value) {
                $data[$key]['total'] = 0;
                foreach ($value as $index => $val) {
                    if($index != 'VEHICLE'){
                        $data[$key]['total'] += $val;
                    }
                }
            }

            array_walk_recursive($data, array($this,'array_replace_null_by_zero'));
            echo json_encode($data);
        }
        /*function retail_record($fiscal_year){
            $data = array();
            $dates = explode('%20-%20', str_replace('_', '-', $fiscal_year));
            $english_start_date = get_english_date($dates[0],1);
            $english_end_date = get_english_date($dates[1],1);
                $generate_sql = "SELECT
                generate_crosstab_sql_plain (
                $$ SELECT vehicle_name, 
                CASE WHEN nepali_month IS NULL THEN '0' WHEN nepali_edited_month_retail IS NOT NULL THEN nepali_edit_month_id :: VARCHAR ELSE retail_month_id END AS \"retail_month_id\",
                count(retail_month_id) 
                from view_retail_report 
                WHERE vehicle_delivery_date >= '".$english_start_date."' 
                AND vehicle_delivery_date <= '".$english_end_date."' 
               
                GROUP BY 1,
                nepali_month,
                nepali_edited_month_retail,
                nepali_edit_month_id,
                retail_month_id
                ORDER BY vehicle_name asc $$,
                $$ SELECT id from mst_nepali_month   ORDER BY rank $$,
                'INT',
                '\"VEHICLE\" TEXT') AS sqlstring";

            
            $sql = $this->db->query($generate_sql)->result_array();
            // print_r($sql) ;
            $this->db->order_by('VEHICLE');
            $data = $this->db->query($sql[0]['sqlstring'])->result_array();
            // echo $this->db->last_query();
            // exit;

            foreach ($data as $key => $value) {
                $data[$key]['total'] = 0;
                foreach ($value as $index => $val) {
                    if($index != 'VEHICLE'){
                        $data[$key]['total'] += $val;
                    }
                }
            }

            array_walk_recursive($data, array($this,'array_replace_null_by_zero'));
            echo json_encode($data);
        }*/

        public function dealer_reject()
        {
            $data['id'] = $this->input->post('id');
            $data['dealer_reject'] = 1;
            $success = $this->stock_record_model->update($data['id'],$data);
            
            if ($success) {
                $success = TRUE;
                $msg = lang('general_success');
            } else {
                $success = FALSE;
                $msg = lang('general_failure');
            }

            echo json_encode(array('success'=>$success,'msg' => $msg));

        }  
        
        public function dealer_accept()
        {
            $data['id'] = $this->input->post('id');
            $data['dealer_reject'] = 0;
            $success = $this->stock_record_model->update($data['id'],$data);

            if ($success) {
                $success = TRUE;
                $msg = lang('general_success');
            } else {
                $success = FALSE;
                $msg = lang('general_failure');
            }

            echo json_encode(array('success'=>$success,'msg' => $msg));

        }
        
        /*public function save_stock_return()
        {
            $data['id'] = $this->input->post('id');
            $data['vehicle_return_reason'] = $this->input->post('reason');
            $data['vehicle_return_date'] = date('Y-m-d');
            $data['vehicle_return_date_nep'] = get_nepali_date(date('Y-m-d'),'nep');
            $data['vehicle_return'] = 1;
            $data['dispatched_date'] = NULL;
            $data['dispatched_date_np'] = NULL;
            $data['received_date'] = NULL;
            $data['dealer_order_id'] = NULL;
            // $data['received_date_np'] = NULL;
            // $data['deleted_at'] = date('Y-m-d H:i:s');
            // print_r($data);
            $success1 = $this->dispatch_dealer_model->update($data['id'],$data);
            if($success1)
            {
                $value['id'] = $this->input->post('stock_id');
                $value['stock_yard_id'] = $this->input->post('stockyard');
                $value['current_location'] = NULL;
                $value['dispatch_id'] = NULL;
                // print_r($value);
                $success = $this->stock_record_model->update($value['id'],$value);

                $vehicle_detail = $this->stock_record_model->find(array('id'=>$value['id']));
                // echo $this->db->last_query();
                // print_r($vehicle_detail);
                $this->stock_record_model->_table = 'mst_stock_yards';
                $location = $this->stock_record_model->find(array('id'=>$value['stock_yard_id']));
                $this->change_current_location($vehicle_detail->vehicle_id,$location->name,'Stock');
            }

            if ($success) {
                $success = TRUE;
                $msg = lang('general_success');
            } else {
                $success = FALSE;
                $msg = lang('general_failure');
            }

            echo json_encode(array('success'=>$success,'msg' => $msg));
        }*/
        public function save_stock_return()
        {
            $dispatch_id = $this->input->post('dispatch_id');
            $vehicle = $this->stock_record_model->find(array('id'=>$this->input->post('stock_id')),'vehicle_id');
            $data['stock_id'] = $this->input->post('stock_id');
            $data['dealer_id'] = $this->input->post('dealer_id');
            $data['return_stockyard_id'] = $this->input->post('stockyard');
            $data['remarks'] = $this->input->post('reason');
            $data['vehicle_id'] = $vehicle->vehicle_id;
            $data['date'] = date('Y-m-d');
            $data['date_np'] = get_nepali_date(date('Y-m-d'),'nep');
            $success = $this->vehicle_return_model->insert($data); // Insert in vehicle return table

            if($success)
            {
              $this->db->where('id',$dispatch_id);
              $success = $this->db->delete('log_dispatch_dealer'); // Delete from dispatch_dealer Table
          }

          if($success)
          {
            $stock['id'] = $data['stock_id'];
            $stock['dispatch_id'] = NULL;
                $success = $this->stock_record_model->update($stock['id'],$stock); // Remove link from stock 
            }

            if($success)
            {
                $this->stock_record_model->_table = 'mst_stock_yards';
                $location = $this->stock_record_model->find(array('id'=>$data['return_stockyard_id']),'name');
                $success = $this->change_current_location($vehicle->vehicle_id,$location->name,'Stock');
            }
            
            if($success)
            {
                $order['id'] = $this->input->post('order_id');
                $order['vehicle_main_id'] = NULL;
                $success = $this->dealer_order_model->update($order['id'],$order);
            }

            if($success)
            {
                $success = true;
                $msg=lang('general_success');
            }
            else
            {
                $success = false;
                $msg=lang('general_failure');
            }
            echo json_encode(array('msg'=>$msg,'success'=>$success));
        }

        /*public function save_stock_transfer()
        {
            $data['id'] = $this->input->post('stock_id');
            $data['stock_yard_id'] = $this->input->post('stockyard_id');
            $success = $this->stock_record_model->update($data['id'],$data);
            if ($success) 
            {   
                $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));  
                $location = $this->stock_yard_model->find(array('id'=>$data['stock_yard_id']));    
                $this->change_current_location($vehicle_detail->vehicle_id,$location->name,'Stock');        
                $success = TRUE;
                $msg = lang('general_success');
            } 
            else 
            {
                $success = FALSE;
                $msg = lang('general_failure');
            }

            echo json_encode(array('success'=>$success,'msg' => $msg));
        }*/
        /*public function save_stock_transfer()
        {
            $driver['driver_name']=$this->input->post('driver_name');
            $driver['driver_number']=$this->input->post('driver_number');
            $driver['driver_address']=$this->input->post('driver_address');
            $driver['source']=$this->input->post('source');
            $driver['destination']=$this->input->post('destination');
            $driver['license_no']=$this->input->post('license_no');
            $driver['photo']=$this->input->post('photo');
            $driver['challan_date']=date('Y-m-d');
            

            $success=$this->driver_detail_model->insert($driver);

            $data['id'] = $this->input->post('stock_id');
            $data['driver_id'] = $success;
            $data['stock_yard_id'] = $this->input->post('stockyard_id');
            $success = $this->stock_record_model->update($data['id'],$data);
            if ($success) 
            {   
                $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));  
                $location = $this->stock_yard_model->find(array('id'=>$data['stock_yard_id']));    
                $this->change_current_location($vehicle_detail->vehicle_id,$location->name,'Stock');        
                $success = TRUE;
                $msg = lang('general_success');
            } 
            else 
            {
                $success = FALSE;
                $msg = lang('general_failure');
            }

            echo json_encode(array('success'=>$success,'driverid'=>$data['driver_id'],'msg' => $msg));
        }*/

        public function save_stock_transfer()
        {
            $driver['driver_name']=$this->input->post('driver_name');
            $driver['driver_number']=$this->input->post('driver_number');
            $driver['driver_address']=$this->input->post('driver_address');
            $driver['source']=$this->input->post('source');
            $driver['destination']=$this->input->post('destination');
            $driver['license_no']=$this->input->post('license_no');
            $driver['photo']=$this->input->post('photo');
            $driver['challan_date']=date('Y-m-d');

            $success=$this->driver_detail_model->insert($driver);

            $data['id'] = $this->input->post('stock_id');
            $data['driver_id'] = $success;
            $data['present_location'] = $this->input->post('present_location');
            $data['transfer_from'] = $this->input->post('source');
            $data['stock_transfer_date'] = date('Y-m-d');
            if($this->input->post('is_display') == 'false')
            {
                $data['stock_yard_id'] = $this->input->post('stockyard_id');
            }
            
            $success = $this->stock_record_model->update($data['id'],$data);

            if(!$this->input->post('is_display'))
            {
                $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));  
                $vehicle = $this->dispatch_record_model->find(array('id'=>$vehicle_detail->vehicle_id));

                $this->dealer_order_model->_table = "view_dealer_dispatch_request";
                $this->db->where('delivery_day <>',1);
                $this->db->order_by('delivery_date_days');
                $order = $this->dealer_order_model->find(array('vehicle_id'=>$vehicle->vehicle_id,'variant_id'=>$vehicle->variant_id,'color_id'=>$vehicle->color_id,'year'=>$vehicle->year,'credit_control_approval <>'=> 2,'cancel_date',NULL));
                if($order)
                {
                    $update_order['id'] = $order->id;
                    $update_order['in_stock_remarks'] = 1;
                    $update_order['stock_arrived_date'] = date('Y-m-d');
                    $update_order['stock_arrived_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
                    $this->dealer_order_model->_table = "log_dealer_order";
                    $this->dealer_order_model->update($update_order['id'],$update_order);
                }
            }

            if ($success) 
            {   
                $vehicle_details = $this->stock_record_model->find(array('id'=>$data['id'])); 
                if($this->input->post('is_display') == 'true')
                {
                    $location = $this->dealer_model->find(array('id'=>$this->input->post('dealer_id')));    
                    $status = 'Display';
                }
                else
                {
                    $location = $this->stock_yard_model->find(array('id'=>$this->input->post('stockyard_id')));    
                    $status = 'Stock';
                }

                $this->change_current_location($vehicle_details->vehicle_id,$location->name,$status);        
                $success = TRUE;
                $msg = lang('general_success');
            } 
            else 
            {
                $success = FALSE;
                $msg = lang('general_failure');
            }

            echo json_encode(array('success'=>$success,'driverid'=>$data['driver_id'],'msg' => $msg));
        }

        public function dealer_order_summary($type = null) 
        {
            if ($type==null) 
            {
                flashMsg('error', 'Invalid customer ID');
                redirect('admin/stock_records/report_list');  
            }

            $data['header']                 = 'Logistic Report';
            $data['page']                   = $this->config->item('template_admin') . "order_summary";
            $data['module']                 = 'stock_records';
            $data['type']                   = $type;  
            $data['report_type']            = humanize(ucfirst($type));  
            $data['default_col']            = '';
            $data['default_row']            = null;

            $this->load->view($this->_container,$data);
        }

        public function order_summary_json()
        {
            $whereCondition = array();

            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $whereCondition[] = "(date_of_order >= '".$date_range[0]."' AND date_of_order <= '".$date_range[1]."')";
            //     }
            // }

            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(date_of_order >= '".$this->input->post('english_start_date')."' AND date_of_order <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(date_of_order >= '".$english_start_date."' AND date_of_order <= '".$english_end_date."')";
            }

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'color_code AS "Color Code"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'date_of_order AS "Date(A.D.)"';
            $fields[] = 'credit_approve_date AS "Approved Date(A.D.)"';
            $fields[] = 'nepali_month AS "Month(B.S.)"';
            $fields[] = "CASE WHEN id IS NULL THEN 'Remaining Quantity' ELSE 'Dispatched Quantity' END AS Status";
            $fields[] = "CASE WHEN credit_control_approval = 1 THEN 'Approved' ELSE 'Not Approved' END AS CreditControl";
            $fields[] = "CASE 
                            WHEN id IS NULL AND credit_control_approval = 1  THEN 'Approved'
                            WHEN id IS NULL AND credit_control_approval = 0 THEN 'Not Approved'
                            WHEN credit_control_approval = 3 THEN 'On Hold' 
                            ELSE 'Dispatched' END AS \"Logistic Status\"";
            $fields[] = 'stock_status AS "Stock Availability"';
            
            $whereCondition[] = "cancel_date is NULL";
            // $fields[] = "CASE 
            //                 WHEN id IS NULL AND credit_control_approval = 1  THEN 'Approved'
            //                 WHEN id IS NULL AND credit_control_approval = 0 THEN 'Not Approved'
            //                 WHEN credit_control_approval = 3 THEN 'On Hold' 
            //                 WHEN credit_control_approval = 4 THEN 'Display' 
            //                 ELSE 'Dispatched' END AS \"Logistic Status\"";
            // $whereCondition[] = "cancel_date is NULL";
            // $whereCondition[] = "credit_control_approval <> 2";

            $this->db->select($fields);
            if (count($whereCondition) > 0) 
            {
                $this->db->where(implode(" AND " , $whereCondition));
            }
            $this->db->from('view_report_log_dealer_order_summary');

            $result = $this->db->get()->result_array(); 

            $total = count($result);

            if (count($result) > 0) {

                $success = true;

            } else {

                $success = false;

            }

            echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));

        }
        public function credit_control_delay($type = null) 
        {
            if ($type==null) 
            {
                flashMsg('error', 'Invalid customer ID');
                redirect('admin/stock_records/report_list');  
            }

        // Display Page
            $data['header']                 = 'Logistic Report';
            $data['page']                   = $this->config->item('template_admin') . "credit_control_delay";
            $data['module']                 = 'stock_records';
            $data['type']                   = $type;  
            $data['report_type']            = humanize(ucfirst($type));  
            $data['default_col']            = '';
            $data['default_row']            = null;

            $this->load->view($this->_container,$data);
        }

        public function credit_control_delay_json()
        {
            $whereCondition = array();

            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $whereCondition[] = "(date_of_order >= '".$date_range[0]."' AND date_of_order <= '".$date_range[1]."')";
            //     }
            // }

            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(date_of_order >= '".$this->input->post('english_start_date')."' AND date_of_order <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(date_of_order >= '".$english_start_date."' AND date_of_order <= '".$english_end_date."')";
            }

            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'date_of_order AS "Date(A.D.)"';
            $fields[] = 'payment_value AS "Payment Value"';
            $fields[] = 'remarks AS "Remarks"';
            $fields[] = 'credit_control_age AS "Ageing"';
            
            $this->db->select($fields);
            if (count($whereCondition) > 0) 
            {
                $this->db->where(implode(" AND " , $whereCondition));
            }
            $this->db->from('view_report_log_credit_control_delay');

            $result = $this->db->get()->result_array(); 

            $total = count($result);

            if (count($result) > 0) {

                $success = true;

            } else {

                $success = false;

            }

            echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));

        }
        public function logistic_delay($type = null) 
        {
            if ($type==null) 
            {
                flashMsg('error', 'Invalid customer ID');
                redirect('admin/stock_records/report_list');  
            }

        // Display Page
            $data['header']                 = 'Logistic Report';
            $data['page']                   = $this->config->item('template_admin') . "logistic_delay";
            $data['module']                 = 'stock_records';
            $data['type']                   = $type;  
            $data['report_type']            = humanize(ucfirst($type));  
            $data['default_col']            = '';
            $data['default_row']            = null;

            $this->load->view($this->_container,$data);
        }

        public function logistic_delay_json()
        {
            $whereCondition = array();

            // if($this->input->post('date_range')) {
            //     $date_range = explode(" - ", $this->input->post('date_range'));
            //     if ($date_range[0] != null && $date_range[1] != null) {
            //         $whereCondition[] = "(date_of_order >= '".$date_range[0]."' AND date_of_order <= '".$date_range[1]."')";
            //     }
            // }

            if($this->input->post('english_end_date') && $this->input->post('english_start_date')){
                $whereCondition[] = "(date_of_order >= '".$this->input->post('english_start_date')."' AND date_of_order <= '".$this->input->post('english_end_date')."')";
                
            }else{
                list($fiscal_year_id,$fiscal_year,$english_start_date,$english_end_date) = get_current_fiscal_year();
                $whereCondition[] = "(date_of_order >= '".$english_start_date."' AND date_of_order <= '".$english_end_date."')";
            }


            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'date_of_order AS "Date(A.D.)"';
            $fields[] = 'credit_approve_date AS "C.C Approve Date(A.D.)"';
            $fields[] = 'remarks_delay AS "Remarks"';
            $fields[] = 'logistic_delay AS "Ageing"';
            
            $this->db->select($fields);
            if (count($whereCondition) > 0) 
            {
                $this->db->where(implode(" AND " , $whereCondition));
            }
            $this->db->from('view_report_log_logistic_delay');

            $result = $this->db->get()->result_array(); 

            $total = count($result);

            if (count($result) > 0) {

                $success = true;

            } else {

                $success = false;

            }

            echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
        }

        public function dispatch_deadline($type = null) 
        {
            if ($type==null) 
            {
                flashMsg('error', 'Invalid customer ID');
                redirect('admin/stock_records/report_list');  
            }

            $data['header']                 = 'Logistic Report';
            $data['page']                   = $this->config->item('template_admin') . "dispatch_deadline";
            $data['module']                 = 'stock_records';
            $data['type']                   = $type;  
            $data['report_type']            = humanize(ucfirst($type));  
            $data['default_col']            = '';
            $data['default_row']            = null;

            $this->load->view($this->_container,$data);
        }

        public function dispatch_deadline_json()
        {
            $fields = array();
            $fields[] = 'vehicle_name AS "Model"';
            $fields[] = 'variant_name AS "Variant"';
            $fields[] = 'color_name AS "Color"';
            $fields[] = 'dealer_name AS "Dealer Name"';
            $fields[] = 'date_of_order AS "Date(A.D.)"';
            $fields[] = 'delivery_date_days AS "Delivery Day"';
            
            $this->db->select($fields);
            $this->db->where('stock_in_ktm',0);
            $this->db->from('view_dealer_dispatch_request');

            $result = $this->db->get()->result_array(); 

            $total = count($result);

            if (count($result) > 0) {

                $success = true;

            } else {

                $success = false;

            }

            echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));

        }

        public function save_repair_dealer()
        {        
            $dealer_id = $this->input->post('dealer_id');
            $data['id'] = $this->input->post('id');
            
            $data['repair_date'] = $this->input->post('repair_date');
            $data['repair_date_nep'] = get_nepali_date($this->input->post('repair_date'),'nep');
            $data['remarks'] = $this->input->post('remarks');
            $data['is_damage'] = 0;  
            if($data['id'])
            {
                $success = $this->stock_record_model->update($data['id'],$data);
            }  

            if ($success) {
                $success = TRUE;
                $msg = lang('general_success');
                
                $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));
                $this->stock_record_model->_table = 'dms_dealers';
                $location = $this->stock_record_model->find(array('id'=>$dealer_id));

                $this->change_current_location($vehicle_detail->vehicle_id, $location->name, 'Bill');

            } else {
                $success = FALSE;
                $msg = lang('general_failure');
            }

            echo json_encode(array('success'=>$success,'msg' => $msg));
        }

        public function save_Status_change()
        {
            $data['id'] = $this->input->post('vehicle_main_id');
            $data['current_status'] = 'Display';
            
            $success = $this->dispatch_record_model->update($data['id'],$data);

            if($success)
            {
                $success = TRUE;
                $msg=lang('general_success');
            }
            else
            {
                $success = FALSE;
                $msg=lang('general_failure');
            }

            echo json_encode(array('msg'=>$msg,'success'=>$success));
            exit;
        }

        
        private function get_dealer_where()
        {
            $data = array();
            $id = $this->_user_id;
            if(is_dealer_incharge()){
                $data['where']['incharge_id'] = $id;
                $data['group_by'] = 'incharge_id';
            }elseif(is_assistant_dealer_incharge())
            {
                $data['where']['assistant_incharge_id'] = $id;
                $data['group_by'] = 'assistant_incharge_id';
            }

            elseif (is_showroom_incharge()) {
            // $data['where']['dealer_id'] = $id;
                $data['where']['dealer_id'] = $this->session->userdata("employee")['dealer_id'];
                $data['group_by'] = 'dealer_id';
            }elseif (is_sales_executive()) {
                $data['where']['executive_id'] = $id;
                $data['group_by'] = 'executive_id';
            }
            return $data;
        }

        public function sales_status()
        {
            // echo '<pre>';
            $inputs = $this->input->post();
            $where = array();
            if(count($inputs) > 0){
                if(array_key_exists('items', $inputs) && count($inputs['items'] > 0)){
                    foreach ($inputs['items'] as $key => $value) {
                        $where[] = $value;
                    };
                }
            }
            $pending_inquiry = $this->getInquiry('Pending',$where);
            // echo $this->db->last_query().'<br>';
            // echo '<pre>';print_r($pending_inquiry);

            $new_inquary = $this->getInquiry('Today',$where);
            // echo $this->db->last_query().'<br>';
            $booking = $this->getInquiry('Booked',$where);
            // echo $this->db->last_query().'<br>';
            $today_retail = $this->getInquiry('Retail',$where);
            // echo $this->db->last_query().'<br>';
            $confirmed = $this->getInquiry('Confirmed',$where);
            // echo $this->db->last_query().'<br>';
            $closed = $this->getInquiry('Closed',$where);
            $order_status = $this->getorder($where);

            $hot_inquiry = $this->getInquiryStatus('Hot','inquiry_kind',$where);
            $lost = $this->getInquiryStatus('Lost','sub_status_name',$where);
            $conversion = $this->getInquiryConversion($where);

            $first_time_buyer = $this->getInquiryStatus('First Tyme Buyer', 'customer_type_name', $where);
            // echo $this->db->last_query().'<br>';

            $additional_buyer = $this->getInquiryStatus('Additional Buyer', 'customer_type_name', $where);
            $exchange = $this->getInquiryStatus('Other Brand to Suzuki Exchange', 'customer_type_name', $where);
            // print_r($exchange);
            // print_r($additional_buyer);
            // exit;
            $data = array();
            foreach ($pending_inquiry as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    echo 'here';
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['pending'] = $value['Pending'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($new_inquary as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['today'] = $value['Today'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($booking as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['booked'] = $value['Booked'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($today_retail as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['retail'] = $value['Retail'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($confirmed as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['confirmed'] = $value['Confirmed'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($closed as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['closed'] = $value['Closed'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($order_status as $key => $value) {
                if(is_numeric (array_search($value['vehicle_name'], array_column($data, 'vehicle_name')))){
                    $i = array_search($value['vehicle_name'], array_column($data, 'vehicle_name'));
                    $data[$i]['Dispatched'] = $value['Dispatched'];
                    $data[$i]['order_pending'] = $value['Pending'];
                    $data[$i]['Accepted'] = $value['Accepted'];
                    $data[$i]['Rejected'] = $value['Rejected'];
                }else{
                    $data[] = $value;
                }
            }
            $data = $this->my_array_merge($data, $hot_inquiry, 'Hot', 'Hot');
            $data = $this->my_array_merge($data, $lost, 'Lost', 'Lost');
            $data = $this->my_array_merge($data, $conversion, 'conversion', 'Conversion');
            $data = $this->my_array_merge($data, $first_time_buyer, 'First Tyme Buyer', 'First Time Buyer');
            $data = $this->my_array_merge($data, $additional_buyer, 'Additional Buyer', 'Additional Buyer');
            $data = $this->my_array_merge($data, $exchange, 'Other Brand to Suzuki Exchange', 'Exchange');
            // print_r($data);
            echo json_encode($data);
        }

        public function sales_status_new()
        {
            // echo '<pre>';
            $inputs = $this->input->post();
            $where = array();
            if(count($inputs) > 0){
                if(array_key_exists('items', $inputs) && count($inputs['items'] > 0)){
                    foreach ($inputs['items'] as $key => $value) {
                        $where[] = $value;
                    };
                }
            }
            $pending_inquiry = $this->getInquiry('Pending',$where);
            // echo '<pre>'; print_r($pending_inquiry); exit;
            // echo $this->db->last_query().'<br>';
            // echo '<pre>';print_r($pending_inquiry);

            $new_inquary = $this->getInquiry('Today',$where);
            // echo $this->db->last_query().'<br>';
            $booking = $this->getInquiry('Booked',$where);
            // echo $this->db->last_query().'<br>';
            $today_retail = $this->getInquiry('Retail',$where);
            // echo $this->db->last_query().'<br>';
            $confirmed = $this->getInquiry('Confirmed',$where);
            // echo $this->db->last_query().'<br>';
            $closed = $this->getInquiry('Closed',$where);
            $order_status = $this->getorder($where);

            $hot_inquiry = $this->getInquiryStatus('Hot','inquiry_kind',$where);
            $lost = $this->getInquiryStatus('Lost','sub_status_name',$where);
            $conversion = $this->getInquiryConversion($where);

            $first_time_buyer = $this->getInquiryStatus('First Tyme Buyer', 'customer_type_name', $where);
            // echo $this->db->last_query().'<br>';

            $additional_buyer = $this->getInquiryStatus('Additional Buyer', 'customer_type_name', $where);
            $exchange = $this->getInquiryStatus('Other Brand to Suzuki Exchange', 'customer_type_name', $where);
            // print_r($exchange);
            // print_r($additional_buyer);
            // exit;
            $data = array();
            foreach ($pending_inquiry as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    echo 'here';
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['pending'] = $value['Pending'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($new_inquary as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['today'] = $value['Today'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($booking as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['booked'] = $value['Booked'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($today_retail as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['retail'] = $value['Retail'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($confirmed as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['confirmed'] = $value['Confirmed'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($closed as $key => $value) {
                if(is_numeric (array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail')))){
                    $i = array_search($value['vehicle_detail'], array_column($data, 'vehicle_detail'));
                    $data[$i]['closed'] = $value['Closed'];
                }else{
                    $data[] = $value;
                }
            }
            foreach ($order_status as $key => $value) {
                if(is_numeric (array_search($value['vehicle_name'], array_column($data, 'vehicle_name')))){
                    $i = array_search($value['vehicle_name'], array_column($data, 'vehicle_name'));
                    $data[$i]['Dispatched'] = $value['Dispatched'];
                    $data[$i]['order_pending'] = $value['Pending'];
                    $data[$i]['Accepted'] = $value['Accepted'];
                    $data[$i]['Rejected'] = $value['Rejected'];
                }else{
                    $data[] = $value;
                }
            }
            $data = $this->my_array_merge($data, $hot_inquiry, 'Hot', 'Hot');
            $data = $this->my_array_merge($data, $lost, 'Lost', 'Lost');
            $data = $this->my_array_merge($data, $conversion, 'conversion', 'Conversion');
            $data = $this->my_array_merge($data, $first_time_buyer, 'First Tyme Buyer', 'First Time Buyer');
            $data = $this->my_array_merge($data, $additional_buyer, 'Additional Buyer', 'Additional Buyer');
            $data = $this->my_array_merge($data, $exchange, 'Other Brand to Suzuki Exchange', 'Exchange');
            // print_r($data);
            echo json_encode($data);
        }

        /*
        $array1 : main_array
        $array2 : array to be added
        $field_name : required field name in array2
        $index_name : new name to be inserted in array1
        return array1 as array
        */
        public function my_array_merge($array1,$array2,$field_name, $index_name)
        {
            foreach ($array2 as $key => $value) {
                $i = array_search($value['vehicle_name'], array_column($array1, 'vehicle_name'));
                if(is_numeric ($i)){
                    $array1[$i][$index_name] = $value[$field_name];
                }else{
                    $array1[] = $value;
                }
            }
            return $array1;
        }

        private function getInquiry($status = NULL,$where_array = array())
        {
            $where = array();
            $group_by = array('vehicle_id','vehicle_name');
            // $group_by = array('vehicle_id','variant_id','color_id','vehicle_name','variant_name','color_name');
            
            $where_data = $this->get_dealer_where();
            if(count($where_data)){
                $where = $where_data['where'];
                $group_by[] = $where_data['group_by'];
            }
            if($status == 'Today'){
                $where['inquiry_date_en'] = date('Y-m-d');
            }else if($status == 'Retail'){
                $where['actual_status_name'] = $status;
                // $where['inquiry_date_en'] = date('Y-m-d');
            }else if($status){
                $where['actual_status_name'] = $status;
            }
            $where_sql_array = array();
            foreach ($where_array as $key => $value) {
                $where_sql_array[] = 'dealer_id = '. $value;
            }
            $where_sql = '('. implode(' OR ', $where_sql_array). ')';
            if($where_sql != '()'){
                $this->db->where($where_sql, NULL);
            }
            $this->db->order_by('vehicle_name');

            $this->stock_record_model->_table = 'view_customer_dealer_report';
            $this->db->select("CONCAT(vehicle_name) AS vehicle_detail");
            // $this->db->select("CONCAT(vehicle_name, variant_name, color_name) AS vehicle_detail");

            $new_inquary = $this->stock_record_model->get_count($where,$group_by,$status);

            return $new_inquary;
        }

        // for order status
        public function getorder($where = array())
        {
            $this->stock_record_model->_table = "view_dealer_dispatch_request";

            $generate_sql = "SELECT
            generate_crosstab_sql_plain (
            $$ SELECT vehicle_name, order_status, count(order_status) 
            from view_dealer_dispatch_request 
            ";
            if(count($where) > 0){
                $generate_sql .= " WHERE ";
                $sql_where = array();
                foreach ($where as $key => $value) {
                    $sql_where[] = 'dealer_id = '.$value;
                }
                $generate_sql .= implode(' OR ', $sql_where);
            }
            $generate_sql .= "GROUP BY 1,2 $$,
            $$ SELECT order_status from view_dealer_dispatch_request WHERE order_status IS NOT NULL GROUP BY 1 $$,
            'INT',
            '\"vehicle_name\" TEXT') AS sqlstring";
            $sql = $this->db->query($generate_sql)->result_array();

            $data = $this->db->query($sql[0]['sqlstring'])->result_array();
            // echo '<pre>';print_r($data);echo '</pre>';
            return $data;
        }
        // for inquiry status

        public function getInquiryStatus($status, $field = NULL, $where_array)
        {
            // echo '<pre>';
            $where = array();
            $group_by = array();
            $where_data = $this->get_dealer_where();
            if(count($where_data)){
                $where = $where_data['where'];
                $group_by[] = $where_data['group_by'];
            }
            $this->stock_record_model->_table = "view_customer_dealer_report";

            $where_sql_array = array();
            foreach ($where_array as $key => $value) {
                $where_sql_array[] = 'dealer_id = '. $value;
            }
            $where_sql = '('. implode(' OR ', $where_sql_array). ')';
            if($where_sql != '()'){
                $this->db->where($where_sql, NULL);
            }
            
            $group_by[] = 'vehicle_id';
            $group_by[] = 'vehicle_name';
            if($field != NULL){
                $where[$field] = $status;
            }
            // print_r($group_by);
            
            $new_inquary = $this->stock_record_model->get_count($where,$group_by,$status);
            // print_r($new_inquary);
            // echo '</pre>';
            // exit;
            // echo $this->db->last_query(); exit;
            return $new_inquary;
        }
        // for conversion
        public function getInquiryConversion($where_array)
        {
            // echo '<pre>';
            $retail = $this->getInquiryStatus('Retail','actual_status_name',$where_array);
            $total_inquiry = $this->getInquiryStatus('Inquiry',NULL,$where_array);
            foreach ($total_inquiry as $key => $value) {
                // print_r($value);
                $index = array_search($value['vehicle_id'], array_column($retail, 'vehicle_id'));
                // var_dump($index);
                // print_r($retail[$index]);
                // var_dump(is_int($index));
                if(is_int($index)){
                    $total_inquiry[$key]['conversion'] = $retail[$index]['Retail']/$value['Inquiry'];
                }else{
                    $total_inquiry[$key]['conversion'] = 0;
                }
            }
            // echo $this->db->last_query();
            // print_r($total_inquiry);
            // exit;
            return $total_inquiry;
        }

        public function dashboard_stack_json()
        {
        // $where['status'] = $this->input->post('status');
            $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
            
            $date = date('Y-m-d');
            $where = array();
            $where_dealer = $this->get_bill_where();
            if(count($where_dealer)>0){
                $where = $where_dealer['where'];
            }
            $where['current_status'] = 'Domestic Transit';
            $select = "current_location AS Dealer Name, vehicle_name AS Vehicle Name, variant_name AS Variant Name, color_name AS Color Name, 'Bill Transit' AS \"Status\"";
            $bill = $this->stock_record_model->findAll($where,$select);

        // echo $this->db->last_query();
            
            $where['current_status'] = 'Bill';
            $select = "current_location AS Dealer Name, vehicle_name AS Vehicle Name, variant_name AS Variant Name, color_name AS Color Name, 'Stock' AS \"Status\"";
            $stock = $this->stock_record_model->findAll($where,$select);

            $data['data'] = array_merge($bill,$stock);
            $data['success'] = true;
            $data['total'] = count($data['data']);
        // echo $this->db->last_query();
            echo json_encode($data);
        }

        /*billing for dashboard*/
        public function dashboard_billing_json()
        {
            $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
            $select = "dealer_name AS \"Dealer Name\",
            billing_date_np_year AS \"Year\",

            \"billing_month_name\" AS \"Month\",
            vehicle_name AS Vehicle,
            variant_name AS Variant,
            color_name AS Color";
            $raw_where = $this->get_bill_where();
            if(count($raw_where)){
                $where = $raw_where['where'];
            }
            $where['billing_date IS NOT NULL'] = NULL;
            $data['data'] = $this->stock_record_model->findAll($where,$select);
            $data['success'] = true;
            $data['total'] = count($data['data']);
            echo json_encode($data);
            exit;
            // echo $this->db->last_query();exit;
            // echo '<pre>';print_r($data);
        }
        /*retail for dashboard*/
        public function dashboard_retail_json()
        {
            $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
            $select = "dealer_name AS \"Dealer Name\",
            date_of_retail_np_year AS \"Year\",

            \"retail_month_name\" AS \"Month\",
            vehicle_name AS Vehicle,
            variant_name AS Variant,
            color_name AS Color";
            $raw_where = $this->get_bill_where();
            if(count($raw_where)){
                $where = $raw_where['where'];
            }
            $where['current_status'] = 'retail';
            $data['data'] = $this->stock_record_model->findAll($where,$select);
            $data['success'] = true;
            $data['total'] = count($data['data']);
            echo json_encode($data);
            exit;
            // echo $this->db->last_query();exit;
            // echo '<pre>';print_r($data);
        }

        private function get_bill_where()
        {
            $data = array();
            $id = $this->_user_id;
            if(is_dealer_incharge()){
                $data['where']['incharge_id'] = $id;
                $data['group_by'] = 'incharge_id';
            }elseif(is_assistant_dealer_incharge())
            {
                $data['where']['assistant_incharge_id'] = $id;
                $data['group_by'] = 'assistant_incharge_id';
            }

            elseif (is_showroom_incharge()) {
            // $data['where']['dealer_id'] = $id;
                $data['where']['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
                $data['group_by'] = 'dealer_id';
            }elseif (is_sales_executive()) {
                $data['where']['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
                $data['group_by'] = 'executive_id';
            }
            return $data;
        }
        public function dashboard_clear_stock_json()
        {
            $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
            $where["current_status = 'Stock' OR current_status = 'repaired stock'"] = NULL;
            $select = "vehicle_name AS Vehicle, variant_name AS Variant, color_name AS Color, manufacture_year AS Year, manufacture_month AS Month";

            $data["data"] = $this->stock_record_model->findAll($where,$select);$data['success'] = true;
            $data['total'] = count($data['data']);
            echo json_encode($data);
            exit;
            echo '<pre>';print_r($data);
        }

        public function save_retail_date_change()
        {
            $stock['id'] = $this->input->post('stock_id');
            $stock['dispatched_date'] = $this->input->post('retail_date');
            $stock['dispatched_date_np'] = get_nepali_date($stock['dispatched_date'],'true');
            $dates_np = explode('-', $stock['dispatched_date_np']);
            if($this->input->post('nepali_month'))
            {
                $stock['dispatched_date_np_month'] = $this->input->post('nepali_month');
            }
            else
            {
                $stock['dispatched_date_np_month'] = ltrim($dates_np[1], '0');
            }
            $stock['dispatched_date_np_year'] = $dates_np[0];

            $success = $this->stock_record_model->update($stock['id'],$stock);

            if($success)
            {
                $vehicle_process['id'] = $this->input->post('vehicle_process_id');
                $vehicle_process['vehicle_delivery_date'] = $this->input->post('retail_date');
                $success = $this->vehicle_process_model->update($vehicle_process['id'],$vehicle_process);
            }
            if($success)
            {
                $success = TRUE;
                $msg=lang('general_success');
            }
            else
            {
                $success = FALSE;
                $msg=lang('general_failure');
            }

            echo json_encode(array('msg'=>$msg,'success'=>$success));
            exit;
        }

        public function mfg_year_report_dashboard($active_fiscal_year = null)
        {
            $dates = explode('%20-%20', str_replace('_', '-', $active_fiscal_year));
            $piece[0] = explode('-', $dates[0])[0];
            $piece[1] = substr(explode('-', $dates[1])[0], 2,2);
            $final_year = implode('-',$piece );
            list($id,$fiscal_year,$year1,$year2) = get_current_fiscal_year();
            $english_end_date = get_english_date($dates[1],1);
            
            if($active_fiscal_year){
                
                if($final_year == $fiscal_year){
                    $generate_sql = "SELECT
                    generate_crosstab_sql_plain (
                    $$ SELECT v.vehicle_name ||' '|| v.variant_name, v.vehicle_name, v.variant_name,v.year,count(v.year) FROM view_msil_dispatch_records v where (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage')   GROUP BY 1,2,3,4 Order by 1 $$,
                    $$ SELECT distinct year FROM view_msil_dispatch_records ORDER BY year $$,
                    'INT',
                    '\"Model\" TEXT, \"Vehicle Name\" TEXT, \"Variant Name\" TEXT') AS sqlstring";
                }else{
                    $generate_sql = "SELECT
                    generate_crosstab_sql_plain (
                    $$ SELECT v.vehicle_name ||' '|| v.variant_name, v.vehicle_name, v.variant_name,v.year,count(v.year) FROM view_msil_dispatch_records v where  dispatch_date <= '".$english_end_date."'  GROUP BY 1,2,3,4 Order by 1 $$,
                    $$ SELECT distinct year FROM view_msil_dispatch_records ORDER BY year $$,
                    'INT',
                    '\"Model\" TEXT, \"Vehicle Name\" TEXT, \"Variant Name\" TEXT') AS sqlstring";
                }
            }
            else{
                    $generate_sql = "SELECT
                    generate_crosstab_sql_plain (
                    $$ SELECT v.vehicle_name ||' '|| v.variant_name, v.vehicle_name, v.variant_name,v.year,count(v.year) FROM view_msil_dispatch_records v where (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage')   GROUP BY 1,2,3,4 Order by 1 $$,
                    $$ SELECT distinct year FROM view_msil_dispatch_records ORDER BY year $$,
                    'INT',
                    '\"Model\" TEXT, \"Vehicle Name\" TEXT, \"Variant Name\" TEXT') AS sqlstring";
                    
            }
            $sql = $this->db->query($generate_sql)->result_array();
            $rows = $this->db->query($sql[0]['sqlstring'])->result_array(); 
            // echo $this->db->last_query(); exit;
            echo json_encode($rows);
            // $generate_sql = "SELECT
            // generate_crosstab_sql_plain (
            // $$ SELECT v.vehicle_name ||' '|| v.variant_name, v.vehicle_name, v.variant_name,v.year,count(v.year) FROM view_msil_dispatch_records v where (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit' OR current_status='Display' OR current_status='damage')  GROUP BY 1,2,3,4 Order by 1 $$,
            // $$ SELECT distinct year FROM view_msil_dispatch_records ORDER BY year $$,
            // 'INT',
            // '\"Model\" TEXT, \"Vehicle Name\" TEXT, \"Variant Name\" TEXT') AS sqlstring";
            // $sql = $this->db->query($generate_sql)->result_array();

            // $rows = $this->db->query($sql[0]['sqlstring'])->result_array(); 
            // echo json_encode($rows);
        }
        public function get_retail_request_list()
        {
          $generate_sql = "select vehicle_name,variant_name,color_code,sum(quantity) as total from view_dealer_dispatch_request where (is_ktm_dealer = 1 AND order_status = 'Accepted' and cancel_date IS NULL and stock_status = 'In Stock') GROUP BY 1,2,3 order by 1";
          $rows = $this->db->query($generate_sql)->result_array();
          echo json_encode($rows);
      }

      // public function get_dispatch_request_list()
      // {
      //     $generate_sql = "select vehicle_name,variant_name,color_code,sum(quantity) as total from view_dealer_dispatch_request where (is_ktm_dealer = 0 AND order_status = 'Accepted' and cancel_date IS NULL and stock_status = 'In Stock') GROUP BY 1,2,3 order by 1";
      //     $rows = $this->db->query($generate_sql)->result_array();
      //     echo json_encode($rows);
      // }
      public function get_dispatch_request_list($fiscal_year)
      {
            $date = explode('%20-%20', str_replace('_', '-', $fiscal_year));
           
            $generate_sql = "select vehicle_name,variant_name,color_code,sum(quantity) as total from view_dealer_dispatch_request where (is_ktm_dealer = 0 AND order_status = 'Accepted' and cancel_date IS NULL and stock_status = 'In Stock') GROUP BY 1,2,3 order by 1";
             $rows = $this->db->query($generate_sql)->result_array();
            echo json_encode($rows);
      }
      
      public function save_pdi_date()
      {
         $months = array(
            '4' => 'Shrawan',
            '5' => 'Bhadhra',
            '6' => 'Ashoj',
            '7' => 'Kartik',
            '8' => 'Mangshir',
            '9' => 'Poush',
            '10' => 'Magh',
            '11' => 'Falgun',
            '12' => 'Chaitra',
            '1' => 'Baishak',
            '2' => 'Jestha',
            '3' => 'Ashad',
        );

        $data['id'] = $this->input->post('id');
        $data['pdi_date'] = $this->input->post('pdi_date');
        if($data['pdi_date'] != NULL && $data['pdi_date'] != ''){
            $data['pdi_date_np'] = get_nepali_date($this->input->post('pdi_date'),'nep');
        }
        $data['pdi_to_yard_date'] = $this->input->post('pdi_to_yard_date');
        if($data['pdi_to_yard_date'] != NULL && $data['pdi_to_yard_date'] != ''){
            $data['pdi_to_yard_date_np'] = get_nepali_date($this->input->post('pdi_to_yard_date'),'nep');
        }
        $data['yard_location'] = $this->input->post('yard_location');
        $data['pdi_status'] = $this->input->post('pdi_status');
        if($this->input->post('pdi_job_card_open_date') != NULL && $this->input->post('pdi_job_card_open_date') != ''){
            $data['pdi_job_card_open_date'] = $this->input->post('pdi_job_card_open_date');
            $data['pdi_job_card_open_date_np'] = get_nepali_date($this->input->post('pdi_job_card_open_date'),'nep');
        }
        $data['pdi_job_card_no'] = $this->input->post('pdi_job_card_no');
        if($this->input->post('pdi_bill_date') != NULL && $this->input->post('pdi_bill_date') != ''){
            $data['pdi_bill_date'] = $this->input->post('pdi_bill_date');
            $bill_month = '';
            $data['pdi_bill_date_np'] = get_nepali_date($this->input->post('pdi_bill_date'),'nep');
            $pdi_bill_date_array = ($data['pdi_bill_date_np'])?explode('-', $data['pdi_bill_date_np']):array();
            if(count($pdi_bill_date_array)){
                $bill_month = $months[(int) $pdi_bill_date_array[1]];
            }
            $data['pdi_bill_month'] = $bill_month;
        }
        $data['pdi_bill_no'] = $this->input->post('pdi_bill_no');
        if($this->input->post('stock_out_date') != NULL && $this->input->post('stock_out_date') != ''){
            $data['stock_out_date'] = $this->input->post('stock_out_date');
            $data['stock_out_date_np'] = get_nepali_date($this->input->post('stock_out_date'),'nep');
        }
        if($this->input->post('dealers_return_date') != NULL && $this->input->post('dealers_return_date') != ''){
            $data['dealers_return_date'] = $this->input->post('dealers_return_date');
            $data['dealers_return_date_np'] = get_nepali_date($this->input->post('dealers_return_date'),'nep');
        }
        if($this->input->post('allocation_date') != NULL && $this->input->post('allocation_date') != ''){
            $data['allocation_date'] = $this->input->post('allocation_date');
            $data['allocation_date_np'] = get_nepali_date($this->input->post('allocation_date'),'nep');
        }
        $data['allocation_type'] = $this->input->post('allocation_type');
        $data['received_confirmation_via_challan'] = $this->input->post('received_confirmation_via_challan');
        if($this->input->post('insurance_email_date') != NULL && $this->input->post('insurance_email_date') != ''){
            $data['insurance_email_date'] = $this->input->post('insurance_email_date');
            $data['insurance_email_date_np'] = get_nepali_date($this->input->post('insurance_email_date'),'nep');
        }
        $data['pdi_remarks'] = $this->input->post('pdi_remarks');

        // print_r($data);exit;

        $success = $this->stock_record_model->update($data['id'],$data);

        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }

    public function get_stock_dashboard()
    {
        $this->stock_record_model->_table = "view_report_logistic_stock_status";

        $rows = $this->stock_record_model->findAll();

        echo json_encode($rows);
    }

    // this report is with stock and repaired_stock
    public function get_dashboard_stock_summary()
    {
        $data = array();

        $date = $this->input->get('date');
        if($date == NULL){
            $date = date('YYYY-mm-dd');
        }

        $param = array('location');
        $where["(current_status = 'Stock' OR current_status = 'repaired stock')"] = NULL;
        $where['location <>'] = NULL;
        $vehicle_param = array('location');
        $order_by = 'location';

        $stock_record = $this->stock_record->get_records('view_report_billing_stock_ec_list', $param, $where, $vehicle_param, $order_by);

        echo json_encode($stock_record);
    }

    // this report is with stock, repaired_stock, display and damage
    public function get_dashboard_yearwise_stock()
    {
        $this->stock_record_model->_table = "view_report_stock_count_yearly";

        $this->db->order_by('year');
        $rows = $this->stock_record_model->findAll();

        echo json_encode($rows);
    }

    public function get_bill_tar_act_dealer()
    {
        $dealer_id = $this->input->get('dealer_id');
        $this->stock_record_model->_table = "view_dashboard_target_actual_dealerwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $this->db->order_by('rank');
        $rows = $this->stock_record_model->findAll(array('dealer_id'=>$dealer_id));
        
        echo json_encode($rows);
    }

    public function get_bill_tar_act_all_dealer()
    {
        $this->stock_record_model->_table = "view_dashboard_target_actual_modelwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $fields = array('target_year','month_name','sum(total_target) as total_target','sum(total_bill) as total_bill');
        $this->db->group_by(array('month_name','target_year','month_rank'));
        $this->db->order_by('month_rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        // echo $this->db->last_query();
        echo json_encode($rows);
    }

    public function get_bill_tar_act_model()
    {
        $vehicle_id = $this->input->get('vehicle_id');
        $this->stock_record_model->_table = "view_dashboard_target_actual_modelwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);

        $this->db->order_by('month_rank');
        $rows = $this->stock_record_model->findAll(array('vehicle_id'=>$vehicle_id));

        echo json_encode($rows);
    }

    public function get_bill_tar_act_all_model()
    {
        $this->stock_record_model->_table = "view_dashboard_target_actual_modelwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $fields = array('target_year','month_name','sum(total_target) as total_target','sum(total_bill) as total_bill');
        $this->db->group_by(array('target_year','month_name','month_rank'));
        $this->db->order_by('month_rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        
        echo json_encode($rows);
    }

    public function get_retail_tar_act_dealer()
    {
        $dealer_id = $this->input->get('dealer_id');
        $this->stock_record_model->_table = "view_dashboard_tar_act_retail_dealerwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);

        $this->db->order_by('rank');
        $rows = $this->stock_record_model->findAll(array('dealer_id'=>$dealer_id));

        echo json_encode($rows);
    }

    public function get_retail_tar_act_all_dealer()
    {
        // $this->stock_record_model->_table = "view_dashboard_tar_act_retail_dealerwise";
        // list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        // $this->db->where('target_year',$fiscal_year);
        // $fields = array('target_year','month_name','sum(total_retail_target) as total_target','sum(total_retail) as total_retail');
        // $this->db->group_by(array('target_year','month_name','rank'));
        // $this->db->order_by('rank');
        // $rows = $this->stock_record_model->findAll(NULL,$fields);
        
        // echo json_encode($rows);

        $this->stock_record_model->_table = "view_dashboard_tar_act_retail_modelwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $fields = array('target_year','nepali_month as "month_name"','sum(total_retail_target) as total_target','coalesce(SUM(total_retail),0)  as total_retail');
        $this->db->group_by(array('target_year','nepali_month','nepali_month_rank'));
        $this->db->order_by('nepali_month_rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        // echo $this->db->last_query();
        echo json_encode($rows);
    }

    public function get_retail_tar_act_model()
    {
        $vehicle_id = $this->input->get('vehicle_id');
        $this->stock_record_model->_table = "view_dashboard_tar_act_retail_modelwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);

        $this->db->order_by('nepali_month_rank');
        $rows = $this->stock_record_model->findAll(array('vehicle_id'=>$vehicle_id));

        echo json_encode($rows);
    }

    public function get_retail_tar_act_all_model()
    {
        $this->stock_record_model->_table = "view_dashboard_tar_act_retail_modelwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $fields = array('target_year','nepali_month','sum(total_retail_target) as total_target','sum(total_retail) as total_retail');
        $this->db->group_by(array('target_year','nepali_month','nepali_month_rank'));
        $this->db->order_by('nepali_month_rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        // echo $this->db->last_query();
        // echo '<pre>'; print_r($rows); exit;
        echo json_encode($rows);
    }

    // view_dashboard_actual_retail

    public function get_inquiry_tar_act_dealer()
    {
        $dealer_id = $this->input->get('dealer_id');
        $this->stock_record_model->_table = "view_dashboard_act_tar_inquiry_dealerwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $this->db->order_by('rank');
        $rows = $this->stock_record_model->findAll(array('dealer_id'=>$dealer_id));
        // echo $this->db->last_query();
        echo json_encode($rows);
    }

    public function get_inquiry_tar_act_all_dealer()
    {
        $this->stock_record_model->_table = "view_dashboard_act_tar_inquiry_dealerwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $fields = array('target_year','month_name','sum(total_inquiry_target) as total_inquiry_target','sum(total_inquiry) as total_inquiry');
        $this->db->group_by(array('month_name','target_year','rank'));
        $this->db->order_by('rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        
        echo json_encode($rows);
    }


    public function get_inquiry_tar_act_all_model()
    {
        $this->stock_record_model->_table = "view_dashboard_act_tar_inquiry_dealerwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $fields = array('target_year','month_name','sum(total_inquiry_target) as total_inquiry_target','sum(total_inquiry) as total_inquiry');
        $this->db->group_by(array('month_name','target_year','rank'));
        $this->db->order_by('rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        
        echo json_encode($rows);
    }

    public function get_inquiry_tar_act_model()
    {
        $vehicle_id = $this->input->get('vehicle_id');
        $this->stock_record_model->_table = "view_dashboard_act_tar_inquiry_modelwise";
        list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
        $this->db->where('target_year',$fiscal_year);
        $this->db->order_by('month_rank');
        $rows = $this->stock_record_model->findAll(array('vehicle_id'=>$vehicle_id));

        echo json_encode($rows);
    }

    // public function get_inquiry_tar_act_all_model()
    // {
    //     $this->stock_record_model->_table = "view_dashboard_act_tar_inquiry_modelwise";
    //     list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
    //     $this->db->where('target_year',$fiscal_year);
    //     $fields = array('target_year','nepali_month','sum(total_inquiry_target) as total_inquiry_target','sum(total_inquiry) as total_inquiry');
    //     $this->db->group_by(array('target_year','nepali_month','month_rank'));
    //     $this->db->order_by('month_rank');
    //     $rows = $this->stock_record_model->findAll(NULL,$fields);
        
    //     echo json_encode($rows);
    // }

    public function get_retail_segmentwise($segment_name = NULL)
    {
        $date = get_current_fiscal_year();
        $this->db->where('target_year',$date[1]);

        $this->stock_record_model->_table = "view_dashboard_tar_act_retail_modelwise";
        $fields = array('target_year','nepali_month','sum(total_retail_target) as total_target','sum(total_retail) as total_retail');
        $this->db->where('segment_name',$segment_name);
        $this->db->group_by(array('target_year','nepali_month','nepali_month_rank','segment_name'));
        $this->db->order_by('nepali_month_rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);

        echo json_encode($rows);
    }

    public function get_billing_segmentwise($segment_name = NULL)
    {
        $date = get_current_fiscal_year();
        $this->db->where('target_year',$date[1]);
        
        $this->stock_record_model->_table = "view_dashboard_target_actual_modelwise";
        $fields = array('target_year','month_name','sum(total_target) as total_target','sum(total_bill) as total_bill');
        $this->db->where('segment_name',$segment_name);
        $this->db->group_by(array('target_year','month_name','month_rank','segment_name'));
        $this->db->order_by('month_rank');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        
        echo json_encode($rows);
    }

    public function get_segmentwise_stock()
    {
        $this->stock_record_model->_table ="view_dashboard_segmentwise_stock";
        $rows = $this->stock_record_model->findAll();
        echo json_encode($rows);
    } 

    public function get_ageingwise_stock()
    {
        $this->stock_record_model->_table ="view_dashboard_ageing_stock";
        $fields = array('total_stock', "CONCAT(service_type,' ', stock_status) AS stock_status");
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        echo json_encode($rows);
    }

    // public function get_dashboard_inquiry_trend()
    // {
    //     list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
    //     $source_name = $this->input->get('source_type');

    //     $this->stock_record_model->_table = "view_dashboard_inquiry_trend";
    //     $fields = array('inquiry_month','total_inquiry','converted');
    //     $this->db->where('source_name',$source_name);
    //     $this->db->where('fiscal_year_id',$fiscal_year_id);
    //     $this->db->order_by('inquiry_month');
    //     $rows = $this->stock_record_model->findAll(NULL,$fields);
    //     echo json_encode($rows);
    // }

    public function get_dashboard_inquiry_trend($active_year = false)
    {
        if($active_year){
            $dates = explode('%20-%20', str_replace('_', '-', $active_year));
            $fiscal_year_data = $this->fiscal_year_model->find(array('nepali_start_date'=>$dates[0],'nepali_end_date'=>$dates[1]));
            // $piece[0] = explode('-', $dates[0])[0];
            // $piece[1] = substr(explode('-', $dates[1])[0], 2,2);
            // $year = implode('-',$piece );
            $fiscal_year_id = $fiscal_year_data->id;
            // print_r($dates); exit;
        }else{
            list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
            
        }
        $source_name = $this->input->get('source_type');

        $this->stock_record_model->_table = "view_dashboard_inquiry_trend";
        $fields = array('inquiry_month','total_inquiry','converted');
        $this->db->where('source_name',$source_name);
        $this->db->where('fiscal_year_id',$fiscal_year_id);
        $this->db->order_by('inquiry_month');
        $rows = $this->stock_record_model->findAll(NULL,$fields);
        echo json_encode($rows);
    }

    public function save_retail_month_change()
    {
        $data['vehicle_delivery_date'] = $this->input->post('change_retail_date');
        $data['vehicle_delivery_date_np'] = get_nepali_date($data['vehicle_delivery_date'],1);
        $data['id'] = $this->input->post('vehicle_process_id');

        $stock['id'] = $this->input->post('stock_id');
        if($this->input->post('nepali_month'))
        {
            $stock['retail_edit_month'] = $this->input->post('nepali_month');
        }
        if($this->input->post('change_retail_date')){
            $change_retail_date = $this->input->post('change_retail_date');
            $stocks = $this->stock_record_model->find(array('id'=>$stock['id']));
            $stock['dispatched_date'] = $change_retail_date;
            $stock['log_retail_date'] = $stocks->dispatched_date;
            $stock['log_retail_date_np'] = get_nepali_date($stocks->dispatched_date,1);  
        }
        $success = $this->stock_record_model->update($stock['id'],$stock);

        if($success)
        {
            $this->stock_record_model->_table = 'sales_vehicle_process';
            $this->stock_record_model->update($data['id'],$data);
            
            $success = TRUE;
            $msg=lang('general_success');
        }
        else
        {
            $success = FALSE;
            $msg=lang('general_failure');
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }

    public function sells_record($last_year = 'false', $year = NULL)
    {
        // $year = array('2'=>'2074-04-01','3'=>'2075-03-30');
        $months = array(
            '4' => 'Shrawan',
            '5' => 'Bhadhra',
            '6' => 'Ashoj',
            '7' => 'Kartik',
            '8' => 'Mangshir',
            '9' => 'Poush',
            '10' => 'Magh',
            '11' => 'Falgun',
            '12' => 'Chaitra',
            '1' => 'Baishak',
            '2' => 'Jestha',
            '3' => 'Ashad',
        );
        $where_billing = array();
        $where_retail = array();
        if(!$year){
            $fiscal_year = get_current_fiscal_year();
            if($last_year == 'true'){
                $this->load->model('fiscal_years/fiscal_year_model');
                $last_fiscal_year = $this->fiscal_year_model->find(array('id'=>$fiscal_year[0]-1));
                if($last_fiscal_year){
                    $where_billing['billing_date >'] = $where_retail['retail_date >='] = $last_fiscal_year->english_start_date;
                    $where_billing['billing_date <'] = $where_retail['retail_date <='] = $last_fiscal_year->english_end_date;
                }else{
                    $where_billing['billing_date >'] = $where_retail['retail_date >='] = '1900-01-01';
                    $where_billing['billing_date <'] = $where_retail['retail_date <='] = '1900-01-01';
                }
            }else{
                $where_billing['billing_date >'] = $where_retail['retail_date >='] = $fiscal_year[2];
                $where_billing['billing_date <'] = $where_retail['retail_date <='] = $fiscal_year[3];
            }
        }else{
            $fiscal_year = explode('%20-%20', $year);
            if($last_year == 'false'){
                $where_billing['billing_date_np >'] = $where_retail['date_of_retail_np >='] = $fiscal_year[0];
                $where_billing['billing_date_np <'] = $where_retail['date_of_retail_np <='] = $fiscal_year[1];
            }else{
                $this->load->model('fiscal_years/fiscal_year_model');
                $this->db->order_by('id','desc');
                $last_fiscal_year = $this->fiscal_year_model->find(array('nepali_start_date <'=>$fiscal_year[0]));
                if($last_fiscal_year){
                    $where_billing['billing_date >'] = $where_retail['retail_date >='] = $last_fiscal_year->english_start_date;
                    $where_billing['billing_date <'] = $where_retail['retail_date <='] = $last_fiscal_year->english_end_date;
                }else{
                    $where_billing['billing_date >'] = $where_retail['retail_date >='] = '1900-01-01';
                    $where_billing['billing_date <'] = $where_retail['retail_date <='] = '1900-01-01';
                }
            }
        }

        $where_billing['billing_date_np_month IS NOT NULL'] = NULL;
        $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
        $fields = 'billing_date_np_month as month, billing_date_np_year as year, count(engine_no) AS billing';

        $this->db->group_by('1,2');
        $billing = $this->stock_record_model->findAll($where_billing,$fields);

        $where_retail['date_of_retail_np_year IS NOT NULL'] = NULL;
        $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
        $fields = 'date_of_retail_np_month as month, date_of_retail_np_year as year, count(engine_no) AS retail';

        $this->db->group_by('1,2');
        $retail = $this->stock_record_model->findAll($where_retail,$fields);

        $data = array();
        foreach ($billing as $key => $value) {
            $month = $months[(int)$value->month];
            if(!array_key_exists($value->year,$data)){
                $data[$month]['billing'] = $value->billing;
            }
            elseif(!array_key_exists($month, $data)){
                $data[$month]['billing'] = $value->billing;
            }else{
                $data[$month]['billing'] += $value->billing;
            }
            $data[$month]['month'] = $month;
        }

        foreach ($retail as $key => $value) {
            $month = $months[(int)$value->month];
            if(!array_key_exists($value->year,$data)){
                $data[$month]['retail'] = $value->retail;
            }
            elseif(!array_key_exists($month, $data)){
                $data[$month]['retail'] = $value->retail;
            }else{
                $data[$month]['retail'] += $value->retail;
            }           
            $data[$month]['month'] = $month;
        }

        $rows = array();
        foreach ($months as $key => $value) {
            if(array_key_exists($value, $data)){
                $rows[] = $data[$value];
            }else{
                $rows[] = array(
                    'retail' => 0,
                    'billing' => 0,
                    'month' => $value,
                );
            }
        }

        // echo '<pre>';
        // print_r($rows);

        echo json_encode($rows);
    }

    // for billing

    public function billing_chart_record($last_year = 'false', $year = NULL)
    {
        // $year = array('2'=>'2074-04-01','3'=>'2075-03-30');
        $months = array(
            '4' => 'Shrawan',
            '5' => 'Bhadhra',
            '6' => 'Ashoj',
            '7' => 'Kartik',
            '8' => 'Mangshir',
            '9' => 'Poush',
            '10' => 'Magh',
            '11' => 'Falgun',
            '12' => 'Chaitra',
            '1' => 'Baishak',
            '2' => 'Jestha',
            '3' => 'Ashad',
        );
        $where_billing = array();

        // for this year
        if(!$year){
            $fiscal_year = get_current_fiscal_year();
            $where_billing['dispatched_date >='] = $fiscal_year[2];
            $where_billing['dispatched_date <='] = $fiscal_year[3];
            
        }else{
            $fiscal_year = explode('%20-%20', $year);
            $where_billing['dispatched_date_np >='] = $fiscal_year[0];
            $where_billing['dispatched_date_np <='] = $fiscal_year[1];
        }

        $where_billing['dispatched_date_np_month IS NOT NULL'] = NULL;
        $this->stock_record_model->_table = 'view_report_dealer_dispatch';
        $fields = 'edit_month_np as month, COUNT (edit_month_np) AS billing';

        $this->db->group_by('1');
        $billing = $this->stock_record_model->findAll($where_billing,$fields);

        // for last_year

        $where_billing = array();
        if(!$year){
            $this->load->model('fiscal_years/fiscal_year_model');
            $last_fiscal_year = $this->fiscal_year_model->find(array('id'=>$fiscal_year[0]-1));
            if($last_fiscal_year){
                $where_billing['dispatched_date >='] = $last_fiscal_year->english_start_date;
                $where_billing['dispatched_date <='] = $last_fiscal_year->english_end_date;
            }else{
                $where_billing['dispatched_date >='] = '1900-01-01';
                $where_billing['dispatched_date <='] = '1900-01-01';
            }
            
        }else{
            $fiscal_year = explode('%20-%20', $year);
            
            $this->load->model('fiscal_years/fiscal_year_model');
            $this->db->order_by('id','desc');
            $last_fiscal_year = $this->fiscal_year_model->find(array('nepali_start_date <'=>$fiscal_year[0]));
            if($last_fiscal_year){
                $where_billing['dispatched_date >='] = $last_fiscal_year->english_start_date;
                $where_billing['dispatched_date <='] = $last_fiscal_year->english_end_date;
            }else{
                $where_billing['dispatched_date >='] = '1900-01-01';
                $where_billing['dispatched_date <='] = '1900-01-01';
            }
        }

        $where_billing['dispatched_date_np_month IS NOT NULL'] = NULL;
        $this->stock_record_model->_table = 'view_report_dealer_dispatch';
        $fields = 'edit_month_np as month, COUNT (edit_month_np) AS billing';

        $this->db->group_by('1');
        $last_year_billing = $this->stock_record_model->findAll($where_billing,$fields);

        $data = array();
        foreach ($billing as $key => $value) {
            $month = $months[(int)$value->month];
            /*if(!array_key_exists($value->year,$data)){
                $data[$month]['billing'] = $value->billing;
            }
            else*/
            if(!array_key_exists($month, $data)){
                $data[$month]['billing'] = $value->billing;
            }else{
                $data[$month]['billing'] += $value->billing;
            }
            $data[$month]['month'] = $month;
        }

        foreach ($last_year_billing as $key => $value) {
            $month = $months[(int)$value->month];
            /*if(!array_key_exists($value->year,$data)){
                $data[$month]['last_year_billing'] = $value->billing;
            }
            else*/
            if(!array_key_exists($month, $data)){
                $data[$month]['last_year_billing'] = $value->billing;
            }else{
                if(!array_key_exists('last_year_billing', $data[$month])){
                    $data[$month]['last_year_billing'] = $value->billing; 
                }else{
                    $data[$month]['last_year_billing'] += $value->billing;
                }
            }
            $data[$month]['month'] = $month;
        }

        $rows = array();
        foreach ($months as $key => $value) {
            if(array_key_exists($value, $data)){
                $rows[$value]['billing'] = (array_key_exists('billing', $data[$value]))?$data[$value]['billing']:0;
                $rows[$value]['last_year_billing'] = (array_key_exists('last_year_billing', $data[$value]))?$data[$value]['last_year_billing']:0;
                $rows[$value]['month'] = $data[$value]['month'];
            }else{
                $rows[$value] = array(
                    'billing' => 0,
                    'last_year_billing' => 0,
                    'month' => $value,
                );
            }
        }

        echo json_encode($rows);
    }

    // for retail

    public function retail_chart_record($last_year = 'false', $year = NULL)
    {
        // $year = array('2'=>'2074-04-01','3'=>'2075-03-30');
        $months = array(
            '4' => 'Shrawan',
            '5' => 'Bhadhra',
            '6' => 'Ashoj',
            '7' => 'Kartik',
            '8' => 'Mangshir',
            '9' => 'Poush',
            '10' => 'Magh',
            '11' => 'Falgun',
            '12' => 'Chaitra',
            '1' => 'Baishak',
            '2' => 'Jestha',
            '3' => 'Ashad',
        );
        $where_retail = array();

        // for this year
        // if(!$year){
        //     $fiscal_year = get_current_fiscal_year();
        //     $where_retail['dispatched_date_np >='] = $fiscal_year[2];
        //     $where_retail['dispatched_date_np <='] = $fiscal_year[3];
            
        // }else{
        //     $fiscal_year = explode('%20-%20', $year);
        //     $where_retail['dispatched_date_np >='] = $fiscal_year[0];
        //     $where_retail['dispatched_date_np <='] = $fiscal_year[1];
        // }

        // $where_retail['dispatched_date_np_month IS NOT NULL'] = NULL;
        // $this->stock_record_model->_table = 'log_stock_records';
        // // $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
        // $fields = 'dispatched_date_np_month as month, count(dispatched_date_np_month) AS retail';

        // $this->db->group_by('1');
        // $retail = $this->stock_record_model->findAll($where_retail,$fields);

         if(!$year){
            $fiscal_year = get_current_fiscal_year();
            $where_retail['vehicle_delivery_date >='] = $fiscal_year[2];
            $where_retail['vehicle_delivery_date <='] = $fiscal_year[3];
            
        }else{
            $fiscal_year = explode('%20-%20', $year);
            $where_retail['vehicle_delivery_date >='] = get_english_date($fiscal_year[0],1);
            $where_retail['vehicle_delivery_date <='] = get_english_date($fiscal_year[1],1);
        }

        $where_retail['retail_month_id IS NOT NULL'] = NULL;
        $this->stock_record_model->_table = 'view_retail_report';
        // $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
        $fields = 'retail_month_id as month, count(retail_month_id) AS retail';
        // $fields = 'count(retail_month_id) AS retail, CASE WHEN nepali_edit_month_id::INTEGER IS NOT NULL THEN nepali_edit_month_id::integer ELSE retail_month_id::INTEGER END AS "Month"';

        /*$this->db->group_by('1');
        $retail = $this->stock_record_model->findAll($where_retail,$fields);*/

        // run raw query because of query issue
        $this->db->select('CASE WHEN nepali_edit_month_id::INTEGER IS NOT NULL THEN nepali_edit_month_id::integer ELSE retail_month_id::INTEGER END AS "month",
                COUNT (retail_month_id) AS retail',FALSE);
        $this->db->where($where_retail);
        $this->db->group_start();
        $this->db->where('deleted_at > NOW()');
        $this->db->or_where('deleted_at IS NULL');
        $this->db->group_end();
        $this->db->group_by('1');
        $retail = $this->db->get('view_retail_report')->result();

        // echo '<pre>'; print_r($retail); exit;
        $this->stock_record_model->_table = 'view_sales_report';

        // for last_year

        $where_retail = array();
        if(!$year){
            $this->load->model('fiscal_years/fiscal_year_model');
            $last_fiscal_year = $this->fiscal_year_model->find(array('id'=>$fiscal_year[0]-1));
            if($last_fiscal_year){
                $where_retail['dispatched_date_np >='] = $last_fiscal_year->nepali_start_date;
                $where_retail['dispatched_date_np <='] = $last_fiscal_year->nepali_end_date;
            }else{
                $where_retail['dispatched_date_np >='] = '1900-01-01';
                $where_retail['dispatched_date_np <='] = '1900-01-01';
            }
            
        }else{
            $fiscal_year = explode('%20-%20', $year);
            
            $this->load->model('fiscal_years/fiscal_year_model');
            $this->db->order_by('id','desc');
            $last_fiscal_year = $this->fiscal_year_model->find(array('nepali_start_date <'=>$fiscal_year[0]));
            if($last_fiscal_year){
                $where_retail['dispatched_date_np >='] = $last_fiscal_year->nepali_start_date;
                $where_retail['dispatched_date_np <='] = $last_fiscal_year->nepali_end_date;
            }else{
                $where_retail['dispatched_date_np >='] = '1900-01-01';
                $where_retail['dispatched_date_np <='] = '1900-01-01';
            }
        }

        $where_retail['dispatched_date_np_month IS NOT NULL'] = NULL;
        $this->stock_record_model->_table = 'log_stock_records';
        // $this->stock_record_model->_table = 'view_report_billing_stock_ec_list';
        $fields = 'dispatched_date_np_month as month, count(dispatched_date_np_month) AS retail';

        $this->db->group_by('1');
        $last_year_retail = $this->stock_record_model->findAll($where_retail,$fields);
        
        $this->stock_record_model->_table = 'view_sales_report';

        $data = array();
        foreach ($retail as $key => $value) {
            $month = $months[(int)$value->month];
            // if(!array_key_exists($value->year,$data)){
            //     $data[$month]['retail'] = $value->retail;
            // }
            if(!array_key_exists($month, $data)){
                $data[$month]['retail'] = $value->retail;
            }else{
                $data[$month]['retail'] += $value->retail;
            }
            $data[$month]['month'] = $month;
        }

        foreach ($last_year_retail as $key => $value) {
            $month = $months[(int)$value->month];
            // if(!array_key_exists($value->year,$data)){
            //     $data[$month]['last_year_retail'] = $value->retail;
            // }
            if(!array_key_exists($month, $data)){
                $data[$month]['last_year_retail'] = $value->retail;
            }else{
                if(!array_key_exists('last_year_retail', $data[$month])){
                    $data[$month]['last_year_retail'] = $value->retail;  
                }else{
                    $data[$month]['last_year_retail'] += $value->retail;
                }
            }
            $data[$month]['month'] = $month;
        }


        $rows = array();
        foreach ($months as $key => $value) {
            if(array_key_exists($value, $data)){
                $rows[$value]['retail'] = (array_key_exists('retail', $data[$value]))?$data[$value]['retail']:0;
                $rows[$value]['last_year_retail'] = (array_key_exists('last_year_retail', $data[$value]))?$data[$value]['last_year_retail']:0;
                $rows[$value]['month'] = $data[$value]['month'];
            }else{
                $rows[$value] = array(
                    'retail' => 0,
                    'last_year_retail' => 0,
                    'month' => $value,
                );
            }
        }

        echo json_encode($rows);
    }

    public function pdi_report()
    {
        $data['header'] = lang('stock_records');
        $data['page'] = $this->config->item('template_admin') . "pdi_report";
        $data['module'] = 'stock_records';
        $data['default_col']            = 'Mfg Year';
        $data['default_row']            = null;

        $this->load->view($this->_container, $data);   
    }

    public function generate_pdi_report()
    {
        $fields = '
            vehicle_name as Model,
            variant_name as Variant,
            color_name as Color, 
            year as year, 
            engine_no As "Engine Number", 
            chass_no as "Chassis Number", 
            current_location AS "Current Location",
            current_status AS "Current Status",
            accident_type AS Defect Type,
            msil_dispatch_date AS "MSIL Dispatch Date",
            firm_name AS "Company",
            age as "Aging",
            custom_name as "Dispatch From",
            dealer_dispatch_date AS "Dispatch Date",
            driver_name AS "Driver",
            driver_number AS "Driver Number",
            logistic_confirmation_date AS  Recived Date,
            pdi_to_yard_date AS PDI to Yard Date,
            yard_location AS Yard Location,
            pdi_status AS PDI Status,
            pdi_date AS PDI Date,
            pdi_job_card_open_date AS PDI Job Card Open Date,
            pdi_job_card_no AS PDI Card Number,
            pdi_bill_no AS "PDI Bill Number",
            pdi_bill_month AS PDI Bill Month,
            stock_out_date AS "Stock Out Date",
            dealers_return_date AS "Dealer Return Date",
            allocation_date AS Allocation Date,
            allocation_age AS Allocation Age,
            allocation_type AS Allocation Type,
            received_confirmation_via_challan AS "Received Confirmation Via Challan",
            insurance_email_date as "Insurance Email Date",
            pdi_remarks AS Remarks,
            ';
        $where = $this->input->post();
        $this->db->select($fields);
        if (count($where) > 0) 
        {
            $this->db->where($where);
        }
        $this->db->from('view_log_stock_record_working');
        $result = $this->db->get()->result_array(); 

        $total = count($result);
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }

        echo json_encode(array('success'  => $success, 'data' => $result, 'total'=> $total));
    }

    
    public function generate_test_drive()
    {
        // Display Page
        $type = 'inquiry_test_drive';
        $data['header'] = lang('crm_reports');
        $data['page'] = $this->config->item('template_admin') . "generate_test_drive";
        $data['module'] = 'stock_records';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));
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
        $fields[] = 'mobile_1 AS "Contact Number"';
        $fields[] = 'customer_name AS "Customer Name"';
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


    public function spareparts_stock_position()
    {
        $this->dispatch_sparepart_model->_table = 'view_report_fmsabc';
        
        $fields = array();
        $fields[] = "sum(quantity) as total_quantity";
        $fields[] = "sum(price) as total_price";
        $fields[] = "count(part_code) as listing_item";
        $fields[] = "fms as fms";
        $this->db->group_by('fms');
        $rows=$this->dispatch_sparepart_model->findAll(NULL,$fields);
        echo json_encode(array('rows'=>$rows));
        exit;
    }

    public function get_fast_spareparts_stock()
    {
        $this->dispatch_sparepart_model->_table = 'view_report_fmsabc';
        search_params();
        $where['fms'] = 'F';
        $total=$this->dispatch_sparepart_model->find_count($where);

        paging('total_dispatched');

        search_params();

        $rows=$this->dispatch_sparepart_model->findAll($where);

          
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_medium_spareparts_stock()
    {
        $this->dispatch_sparepart_model->_table = 'view_report_fmsabc';
        search_params();
        $where['fms'] = 'M';
        $total=$this->dispatch_sparepart_model->find_count($where);

        paging('total_dispatched');

        search_params();

        $rows=$this->dispatch_sparepart_model->findAll($where);
      
          
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_none_spareparts_stock()
    {
        $this->dispatch_sparepart_model->_table = 'view_report_fmsabc';
        search_params();
        $where['fms'] = 'N';
        $total=$this->dispatch_sparepart_model->find_count($where);

        paging('total_dispatched');

        search_params();

        $rows=$this->dispatch_sparepart_model->findAll($where);
      
          
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_slow_spareparts_stock()
    {
        $this->dispatch_sparepart_model->_table = 'view_report_fmsabc';
        search_params();
        $where['fms'] = 'S';
        $total=$this->dispatch_sparepart_model->find_count($where);

        paging('total_dispatched');

        search_params();

        $rows=$this->dispatch_sparepart_model->findAll($where);
      
          
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_daily_spareparts_sales()
    {


        $this->sparepart_order_model->_table = "view_dispatch_spareparts";

     
        $fields = array();
        $fields[] =  'sum(total_amount)as total_amount';
        $fields[] =  'sum(dispatched_quantity) as dispatched_quantity';
        $fields[] =  'id';
        $fields[] =  'name';
        $today = date('Y-m-d');
        $where['dispatched_date'] = $today;
        $where['grn_received_date <>'] = NULL;
      

        search_params();
        $total=$this->sparepart_order_model->find_count($where);

        paging('dispatched_date');
        
        search_params();
        $this->db->group_by('part_code,id,name,dispatched_date');
        $rows=$this->sparepart_order_model->findAll($where,$fields);
       

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_monthly_spareparts_sales()
    {


        $this->sparepart_order_model->_table = "view_dispatch_spareparts";

        $fields = array();
        $fields[] =  'sum(total_amount)as total_amount';
        $fields[] =  'sum(dispatched_quantity) as dispatched_quantity';
        $fields[] =  'id';
        $fields[] =  'name';
        $current_month  = date('m');
        $next_month =  date('m',strtotime('first day of +1 month'));
      
        $current_month_date = date('Y').'-'.$current_month.'-01';
        $next_month_date = date('Y').'-'.$next_month.'-01';

        $where['dispatched_date >='] = $current_month_date;
        $where['dispatched_date <'] =$next_month_date;
        $where['grn_received_date <>'] = NULL;
    

        search_params();
      
        $total=$this->sparepart_order_model->find_count($where);

        paging('dispatched_date');
        
        search_params();
        $this->db->group_by('part_code,id,name,dispatched_date');
        $rows=$this->sparepart_order_model->findAll($where,$fields);
      

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_pi_pending_sparepart()
    {
        $today = date('Y-m-d');
        $sql_less_than_30 ="SELECT sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated =0  AND ('".$today."' :: DATE - order_date :: DATE)  <= 30 GROUP BY dealer_id;";
        $less_than_30 = $this->db->query($sql_less_than_30)->result_array();
             // echo $this->db->last_query(); die();

        $sql_less_than_60 ="SELECT sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated =0  AND ('".$today."' :: DATE - order_date :: DATE)  > 30 AND  ('".$today."' :: DATE - order_date :: DATE)  <= 60 GROUP BY dealer_id;";
        $less_than_60 = $this->db->query($sql_less_than_60)->result_array();

        $sql_less_than_90 ="SELECT  sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated =0  AND ('".$today."':: DATE - order_date :: DATE)  > 60 AND  ('".$today."' :: DATE - order_date :: DATE)  <= 90 GROUP BY dealer_id;";
        $less_than_90 = $this->db->query($sql_less_than_90)->result_array();

        $sql_more_than_90 ="SELECT  sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated =0  AND ('".$today."':: DATE - order_date:: DATE)  > 90  GROUP BY dealer_id;";
        $more_than_90 = $this->db->query($sql_more_than_90)->result_array();

        $this->stock_record_model->_table = 'view_dealers';
        $fields = 'name as dealer_name,id, 0 AS less_than_30, 0 AS less_than_60, 0 AS less_than_90, 0 AS more_than_90';
        $this->db->order_by('name');
        $this->db->where('name<>','BIG CAT INTERNATIONAL');
        $data = $this->stock_record_model->findAll(NULL,$fields);


        foreach ($data as $key => $value) {
            foreach ($less_than_30 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->less_than_30 += $val['price'];
                }
            }
            foreach ($less_than_60 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->less_than_60 += $val['price'];
                }
            }
            foreach ($less_than_90 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->less_than_90 += $val['price'];
                }
            }
            foreach ($more_than_90 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->more_than_90 += $val['price'];
                }
            }
        }

        $required_data = array();
        foreach ($data as $key => $value) {
         
            if($value->less_than_30 > 0 || $value->less_than_60 > 0 || $value->less_than_90 || $value->more_than_90){
                $required_data[] = $value;
            }
        }
     
        echo json_encode($required_data);
        exit;
    }

    public function get_back_order_by_dealer()
    {
        $today = date('Y-m-d');
        $sql_less_than_15 ="SELECT sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated = 1 AND (dispatched_quantity < order_quantity)  AND ('".$today."' :: DATE - order_date :: DATE)  < 15 GROUP BY dealer_id;";
        $less_than_15 = $this->db->query($sql_less_than_15)->result_array();

        $sql_less_than_30 ="SELECT sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated = 1  AND (dispatched_quantity < order_quantity) AND ('".$today."' :: DATE - order_date :: DATE)  >= 15 AND  ('".$today."' :: DATE - order_date :: DATE)  < 30 GROUP BY dealer_id;";

        $less_than_30 = $this->db->query($sql_less_than_30)->result_array();

        $sql_less_than_45 ="SELECT sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated = 1  AND (dispatched_quantity < order_quantity) AND ('".$today."' :: DATE - order_date :: DATE)  >= 30 AND  ('".$today."' :: DATE - order_date :: DATE)  < 45 GROUP BY dealer_id;";

        $less_than_45 = $this->db->query($sql_less_than_45)->result_array();

        $sql_less_than_60 ="SELECT sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated = 1  AND (dispatched_quantity < order_quantity) AND ('".$today."' :: DATE - order_date :: DATE)  >= 45 AND  ('".$today."' :: DATE - order_date :: DATE)  < 60 GROUP BY dealer_id;";

        $less_than_60 = $this->db->query($sql_less_than_60)->result_array();

        $sql_more_than_60 ="SELECT  sum(total_price) as price,dealer_id FROM view_spareparts_order
        where pi_generated =1 AND (dispatched_quantity < order_quantity) AND ('".$today."':: DATE - order_date:: DATE)  >= 60  GROUP BY dealer_id;";
        $more_than_60 = $this->db->query($sql_more_than_60)->result_array();
        // print_r($more_than_60);
        //      echo $this->db->last_query(); die();

        $this->stock_record_model->_table = 'view_dealers';
        $fields = 'name as dealer_name,id, 0 AS less_than_15, 0 AS less_than_30, 0 AS less_than_45, 0 AS less_than_60,0 AS more_than_60';
        $this->db->order_by('name');
        $this->db->where('name<>','BIG CAT INTERNATIONAL');
        $data = $this->stock_record_model->findAll(NULL,$fields);


        foreach ($data as $key => $value) {
            foreach ($less_than_15 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->less_than_15 += $val['price'];
                }
            }
            foreach ($less_than_30 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->less_than_30 += $val['price'];
                }
            }
            foreach ($less_than_45 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->less_than_45 += $val['price'];
                }
            }

            foreach ($less_than_60 as $k => $val) {
                if($value->id == $val['dealer_id']){
                    $data[$key]->less_than_60 += $val['price'];
                }
            }

           
           

                foreach ($more_than_60 as $k => $val) {

                    if($value->id == $val['dealer_id']){
                        $data[$key]->more_than_60 += $val['price'];
                    }
                }
          
           
        }
      

        $required_data = array();
        foreach ($data as $key => $value) {
         
            if($value->less_than_15  || $value->less_than_30 || $value->less_than_45 ||$less_than_60 || $value->more_than_60){
                $required_data[] = $value;
            }
        }
        // echo "<pre>";
        // print($required_data);die();
        echo json_encode($required_data);
        exit;
    }


    public function get_picklist_by_ordertype()
    {

   
        $sql_executed_order ="SELECT sum(total_price) as price,order_type  FROM view_spareparts_order
        where picklist = 1  GROUP BY order_type;";
        $executed_order = $this->db->query($sql_executed_order)->result_array();

        $sql_pending_order ="SELECT sum(total_price) as price,order_type  FROM view_spareparts_order
        where picklist = 0  GROUP BY order_type;";
        $pending_order = $this->db->query($sql_pending_order)->result_array();


        $this->stock_record_model->_table = 'spareparts_sparepart_order';
        $fields = 'distinct(order_type) as type, 0 AS executed_order_price, 0 AS pending_order_price';
        $this->db->where('order_type IS NOT NULL');
        $this->db->order_by('order_type');
        
        $data = $this->stock_record_model->findAll(NULL,$fields);
      
        
     
         foreach ($data as $key => $value) {
            foreach ($executed_order as $k => $val) {
                if($value->type == $val['order_type']){
                    $data[$key]->executed_order_price += $val['price'];
                }
            }
            foreach ($pending_order as $k => $val) {
                if($value->type == $val['order_type']){
                    $data[$key]->pending_order_price += $val['price'];
                }
            }
        }

        echo json_encode($data);
        exit;
       
    }


    public function dispatch_chart_record()
    {
      
        $where_dispatch = array();
        $fiscal_year = get_current_fiscal_year();
        $dealer_id =  $this->input->post('dealer_id');
       
        if($dealer_id)
        {
             $where_retail['dealer_id'] = $dealer_id;
        }
        $where_retail['dispatched_date >='] = $fiscal_year[2];
        $where_retail['dispatched_date<='] = $fiscal_year[3];
        
        $where_retail['grn_received_date IS NULL'] = NULL;
        $this->stock_record_model->_table = 'view_dispatch_detail_report';
        
        $fields = "REPLACE(LTRIM(REPLACE(SUBSTRING(dispatched_date_nepali,6,2),'0',' ')),' ','0') as dispatched_month,sum(dispatched_quantity) as total,order_type";

        $this->db->group_by('1,3');
        $dispatch_list = $this->stock_record_model->findAll($where_retail,$fields);

     
        
        $this->stock_record_model->_table = 'mst_nepali_month';
        $fields = 'name as month_name, 0 AS accidental_quantity, 0 AS stock_quantity,0 AS vor_quantity,id';
        $this->db->order_by('rank','asc');
        $data = $this->stock_record_model->findAll(NULL,$fields);
        

        
        foreach ($data as $key => $value) {
            foreach ($dispatch_list as $k => $v) {
                if($value->id == $v->dispatched_month && $v->order_type == 'ACCIDENTAL')
                {
                   
                    $data[$key]->accidental_quantity = $v->total;
                }

                if($value->id == $v->dispatched_month && $v->order_type == 'STOCK')
                {
                   
                    $data[$key]->stock_quantity = $v->total;
                }

                if($value->id == $v->dispatched_month && $v->order_type == 'VOR')
                {
                   
                    $data[$key]->vor_quantity = $v->total;
                }
            
            }
        }
       //  echo "<pre>";
       // print_r($data);die();
          echo json_encode($data);
          exit();
    }

    public function get_dealer_list()
    {
        $this->dealer_model->_table = 'view_dealers';
        $fields = array();
        $fields[] = 'id';
        $fields[] = 'name';
        $dealers = $this->dealer_model->findAll(null,$fields);
        echo json_encode($dealers);
        exit;

    }
}