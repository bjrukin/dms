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


class Stock_record_model extends MY_Model
{

    public $_table = 'log_stock_records';

    protected $blamable = TRUE;
    
    /*public function get_count($where = NULL, $group_by = NULL){
        $this->db->from($this->_table);
        if(count($group_by) > 0){
            foreach($group_by as $group){
                $this->db->group_by($group);
            }
        }
        if(count($where) > 0){
            foreach ($where as $value) {
                $this->db->where($value);
            }
        }
        $this->db->select(array(count('id')));
        $count = $this->db->get()->result_array();
        return $count;
    }*/

    public function get_count($where = NULL, $group_by = NULL,$count_name = NULL){
        $this->db->from($this->_table);
        $select_array = array();
        $select = NULL;
        if(count($group_by) > 0){
            foreach($group_by as $key=>$group){
                $this->db->group_by($group);
                $select_array[] = $group;
            }
        }
        if($count_name == NULL){
            $count_name = count;
        }
        $select_array[] = ' count(id) AS "'. $count_name. '" ';
        $select = implode(', ', $select_array);

        if(count($where) > 0){
            foreach ($where as $key => $value) {
                $this->db->where($key,$value);
            }
        }

        $this->db->select($select);
        $count = $this->db->get()->result_array();
        return $count;
    }

}