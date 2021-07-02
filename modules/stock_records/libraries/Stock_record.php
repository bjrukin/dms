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
 * Rename the file to Stock_record.php
 * and Define Module Library Function (if any)
 */


/* End of file Stock_record.php */
/* Location: ./modules/Stock_record/libraries/Stock_record.php */
class Stock_record {

    public $CI;

    public function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->model('stock_records/stock_record_model');
        $this->CI->load->model('dispatch_dealers/dispatch_dealer_model');

        $this->CI->load->helper(array('project'));
    }

    /**
     * 
     * @param type $date
     * @return type mixed
     */
    public function get_stocks($date = NULL) {

        $this->CI->stock_record_model->_table = 'view_log_stock_records';
        $this->CI->db->group_by(array('stock_yard_id', 'mst_vehicle_id', 'vehicle_name', 'mst_variant_id', 'variant_name', 'mst_color_id', 'color_name', 'stock_yard'));
        $fields = 'COUNT(id) AS vehicle_count,stock_yard_id,mst_vehicle_id,vehicle_name,mst_variant_id,variant_name,mst_color_id,color_name,stock_yard';
        $datas = $this->CI->stock_record_model->findAll(array("dispatched_date IS NULL " => NULL), $fields);
        $rows = array();

        foreach ($datas as $data) {
            $rows[$data->stock_yard_id][$data->mst_vehicle_id][$data->mst_variant_id][$data->mst_color_id]['count'] = $data->vehicle_count;
        }
        return $rows;
    }

    /**
     * 
     * @param type $date
     * @return type array
     */
    public function get_transit_stocks($date = NULL) {
        $data = array();
        $this->CI->stock_record_model->_table = 'view_msil_dispatch_records';
        $fields = 'COUNT(id) AS vehicle_count,vehicle_id,vehicle_name,variant_id,variant_name,color_id,color_name';
        
        $this->CI->db->group_by(array('vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $transits = $this->CI->stock_record_model->findAll(array("transit" => NULL), $fields);
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
    /**
     * 
     * @return type std_class
     */
    public function getStockCountBydealer() {

        $this->CI->stock_record_model->_table = 'view_dispatch_dealers';
        $this->CI->db->group_by(array('dealer_id', 'vehicle_id', 'vehicle_name', 'variant_id', 'variant_name', 'color_id', 'color_name'));
        $fields = 'COUNT(id) AS vehicle_count,dealer_id,vehicle_id,vehicle_name,variant_id,variant_name,color_id,color_name';
//        return $date;
        $datas = $this->CI->stock_record_model->findAll(array("dispatched_date IS NULL " => NULL, 'received_date IS NOT NULL' => NULL), $fields);
//        echo '<pre>';print_r($datas);exit;
        $rows = array();
        foreach ($datas as $data) {
//        print_r($data);
            $rows[$data->dealer_id][$data->vehicle_id][$data->variant_id][$data->color_id]['count'] = $data->vehicle_count;
        }
        return $rows;
    }


        /**
    * @for dashboard report
    * @return type array
    */
        public function get_records($table, $parameter = NULL, $where = NULL, $vehicle_param = NULL, $order_by = NULL, $fields = 'COUNT(DISTINCT engine_no) AS count'){
            $this->CI->stock_record_model->_table = $table;

            if($parameter != NULL){
                foreach ($parameter as $key => $value) {
                    $fields .= ', ' . $value;
                }

                $this->CI->db->group_by($parameter);
            }

            $raw_data = $this->CI->stock_record_model->find_all($where,$fields,$order_by);

            return ($raw_data);
        }
    }


