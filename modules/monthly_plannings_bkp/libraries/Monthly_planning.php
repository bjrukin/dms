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

/*
 * Rename the file to Monthly_planning.php
 * and Define Module Library Function (if any)
 */


/* End of file Monthly_planning.php */
/* Location: ./modules/Monthly_planning/libraries/Monthly_planning.php */

class Monthly_planning {

    public $CI;

    public function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->model('monthly_plannings/monthly_planning_model');
        $this->CI->load->model('stock_records/stock_record_model');

        $this->CI->load->helper(array('project'));
    }

    /**
     * 
     * @param type $date
     * @return type mixed
     */
    public function get_monthly_stocks($date = NULL) {
        if ($date == NULL) {
            $date = date('Y-m-d');
        }

        $this->CI->stock_record_model->_table = 'view_log_stock_records';
        $this->CI->db->group_by(array('stock_yard_id', 'mst_vehicle_id', 'vehicle_name', 'mst_variant_id', 'variant_name', 'mst_color_id', 'color_name', 'stock_yard'));
        $fields = 'COUNT(id) AS vehicle_count,stock_yard_id,mst_vehicle_id,vehicle_name,mst_variant_id,variant_name,mst_color_id,color_name,stock_yard';
//        return $date;
        $datas = $this->CI->stock_record_model->findAll(array("(dispatched_date > '" . $date . "' OR dispatched_date IS NULL) " => NULL), $fields);
        $rows = array();
        foreach ($datas as $data) {
//        print_r($data);
            $rows[$data->stock_yard_id][$data->mst_vehicle_id][$data->mst_variant_id][$data->mst_color_id]['count'] = $data->vehicle_count;
        }
        return $rows;
    }

    /**
     * 
     * @param type $date
     * @return type array
     */
    public function get_monthly_transit_stocks($date = NULL) {
        if ($date == NULL) {
            $date = date('Y-m-d');
        }

        $data = array();
        $this->CI->stock_record_model->_table = 'view_msil_dispatch_records';
        $fields = 'COUNT(id) AS vehicle_count,vehicle_id,vehicle_name,variant_id,variant_name,color_id,color_name';
        
        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $transits = $this->CI->stock_record_model->findAll(array("transit" => 0), $fields);
        if (count($transits) > 0) {
            foreach ($transits as $transit) {
//        echo '<pre>';print_r($transit);echo '</pre>';
                $data['transits'][$transit->vehicle_id][$transit->variant_id][$transit->color_id]['count'] = $transit->vehicle_count;
            }
        }
//        echo '<pre>';print_r($data);
//        exit;
        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $indian_stock_yards = $this->CI->stock_record_model->findAll(array("(indian_stock_yard IS NOT NULL)" => NULL, "indian_custom" => NULL, "nepal_custom" => NULL), $fields);
        if (count($indian_stock_yards) > 0) {
            foreach ($indian_stock_yards as $indian_stock_yard) {
//        echo '<pre>';print_r($transit);echo '</pre>';
                $data['indian_stock_yards'][$indian_stock_yard->vehicle_id][$indian_stock_yard->variant_id][$indian_stock_yard->color_id]['count'] = $indian_stock_yard->vehicle_count;
            }
        }
        
        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $indian_customs = $this->CI->stock_record_model->findAll(array("(indian_custom IS NOT NULL)" => NULL, "nepal_custom" => NULL), $fields);
        if (count($indian_customs) > 0) {
            foreach ($indian_customs as $indian_custom) {
//        echo '<pre>';print_r($transit);echo '</pre>';
                $data['indian_customs'][$indian_custom->vehicle_id][$indian_custom->variant_id][$indian_custom->color_id]['count'] = $indian_custom->vehicle_count;
            }
        }
        
        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $nepal_customs = $this->CI->stock_record_model->findAll(array("(nepal_custom IS NOT NULL)" => NULL, 'stock_yard_reached_date' => NULL), $fields);
        if (count($nepal_customs) > 0) {
            foreach ($nepal_customs as $nepal_custom) {
//        echo '<pre>';print_r($transit);echo '</pre>';
                $data['nepal_customs'][$nepal_custom->vehicle_id][$nepal_custom->variant_id][$nepal_custom->color_id]['count'] = $nepal_custom->vehicle_count;
            }
        }
        
        return $data;
    }
//    get order of given month
    public function get_order() {

        if($this->CI->input->get('year')){
            $search['year'] = $this->input->get('year');
        }else{
            $search['year'] = date('Y');
        }
        if($this->CI->input->get('month')){
            $search['month'] = $this->input->get('month');
        }else{
            $search['month'] = date('m');
        }
        
        $this->CI->monthly_planning_model->_table = 'view_msil_monthly_orders';
        //search_params();
        $this->CI->db->where($search);
        $total = $this->CI->monthly_planning_model->find_count();

//        paging('id');

        //search_params();
        $this->CI->db->where($search);
        $rows = $this->CI->monthly_planning_model->findAll();


        /*monthly planning of 3months back*/
        if($this->CI->input->get('year')){
            $search1['year'] = $this->input->get('year');
        }else{
            $search1['year'] = date('Y');
        }
        if($this->CI->input->get('month')){
            $search1['month'] = ($this->input->get('month')-3);

        }else{
            $month = date('m');
            $search1['month'] = date('m', strtotime("-3 months"));
            if(date('m') < $search1['month']){
                $search1['year']--;
            }
//            $search1['month'] = strtotime($month . ' - 3 month');
        }

        $this->CI->db->where($search1);
        $data_before_threemonths = $this->CI->monthly_planning_model->findAll();

        if($this->CI->input->get('year')){
            $search2['year'] = $this->CI->input->get('year');
        }else{
            $search2['year'] = date('Y');
        }
        if($this->CI->input->get('month')){
            $search2['month'] = ($this->CI->input->get('month')-1);
        }else{
            $search2['month'] = date('m');
        }
        $total_dispatched = $this->CI->monthly_planning_model->get_Count($search2);
        // echo $this->db->last_query();d

        //subracting total plan with dispatched vehicles
        foreach ($data_before_threemonths as  $key => &$value) {
            foreach ($total_dispatched as  $values) {
                if($value->vehicle_id == $values->CI->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total - $values->total_dispatched;                    
                }
            }
        }

        foreach ($rows as  $key => &$value) {
            foreach ($data_before_threemonths as  $values) {
                if($value->vehicle_id == $values->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total + $values->total;                    
                }
            }
        }
        return($rows);
    }
}
