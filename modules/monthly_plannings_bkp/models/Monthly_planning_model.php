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


class Monthly_planning_model extends MY_Model
{

    public $_table = 'msil_monthly_plannings';

    protected $blamable = TRUE;
    
    public function get_planing_order($where = array()){
        $select = '*, SUM(quantity) as total_quantity';
        
        (! is_null($where))?$this->db->where($where):NULL;
        
        $this->db->select($select);
        
        $from = 'SELECT v.id,
        v.created_by,
        v.updated_by,
        v.deleted_by,
        v.created_at,
        v.updated_at,
        v.deleted_at,
        v.vehicle_id,
        v.variant_id,
        v.color_id,
        v.dealer_id,
        v.quantity,
        v.year,
        v.month,
        v1.name AS vehicle_name,
        v2.name AS variant_name,
        c.name AS color_name,
        c.code AS color_code,
        d.name AS dealer_name
        FROM msil_monthly_plannings v
        JOIN mst_vehicles v1 ON v.vehicle_id = v1.id
        JOIN mst_colors c ON v.color_id = c.id
        JOIN mst_variants v2 ON v.variant_id = v2.id
        JOIN dms_dealers d ON v.dealer_id = d.id';
        
        $this->db->from($from);
        
        $this->db->group_by('vehicle_id');
        
        $result = $this->db->get();
        return $result();
        
    }

    public function get_Count($where=array())
    {
        foreach($where as $key => $value){
            $this->db->where($key,$value);
        }
        // $this->from();
        $this->db->select('vehicle_id, variant_id, color_id, count(id) as total_dispatched');
        $this->db->group_by(array('vehicle_id','variant_id','color_id'));
        $data = $this->db->get('msil_dispatch_records')->result();
        return $data;
    }

    public function get_Colors()
    {
        $this->db->select('code');
        $colors = $this->db->get('mst_colors')->result_array();
        
        return $colors;
    }
}