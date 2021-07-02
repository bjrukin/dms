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
 * Rename the file to Dealer_order.php
 * and Define Module Library Function (if any)
 */


/* End of file Dealer_order.php */
/* Location: ./modules/Dealer_order/libraries/Dealer_order.php */

class Dealer_order
{

    public $CI;

    public function __construct()
    {
        $this->CI = &get_instance();

        //$this->load->model('dealer_orders/dealer_order_model');

        $this->CI->load->helper(array('project'));
    }

    public function get_records($table,  $where = NULL, $fields = 'vehicle_id, SUM(CAST(fuel as FLOAT)) AS total_fuel_quantity'){
       $this->CI->dealer_order_model->_table = $table;

        $this->CI->db->group_by(array('vehicle_id','fuel'));

        $raw_data = $this->CI->dealer_order_model->find_all($where,$fields,'vehicle_id');
        //echo $this->CI->db->last_query();
        //die;
        return ($raw_data);
    }

}