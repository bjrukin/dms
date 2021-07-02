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
* Project
*
*/
class Project {

    public $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

	public function write_cache($params)
    {
		extract($params);
        
        $db = $this->CI->db;

        //select $fields from $table
        $db = $db->select($fields)->from($table);

        $delete_filter = sprintf('(%1$s > NOW() OR %1$s IS NULL )', 'deleted_at');

        $db = $db->where($delete_filter);

        if (isset($where) && $where != null) {
            $db = $db->where($where);
        }

        if (isset($order) && $order !=null) {
            $db = $db->order_by($order);
        }

        $records = $db->get()->result_array();

        if (isset($array_unshift) && is_array($array_unshift)) 
        {
            array_unshift($records, $array_unshift);
        }

        $this->CI->load->helper('file');
    
        $cache_file = CACHE_PATH ."{$filename}.json";

        $json_data = json_encode($records);

        write_file($cache_file, $json_data);
    }
}
?>