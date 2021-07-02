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


if ( ! function_exists('status_count'))
{
	function status_count($status_name = 'all')
	{
		$CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        if ($status_name != 'all')
        {
        	$whereCondition[] = " status_name = '{$status_name}' ";	
        }

        $fields = array();

        $fields[] = 'COUNT(status_name) AS total';

        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];

    }
}

if ( ! function_exists('vehicle_demand'))
{
	function vehicle_demand($pagenum = 0)
	{
		$CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        //last 6 months
        $last6Months = date('Y-m-d', strtotime("-6 month", time()));
        $whereCondition[] = " inquiry_date_en >= '{$last6Months}' ";

        $fields = array();
        
        $fields[] = 'COUNT(vehicle_name) AS total';
        
        if ($pagenum > -1)
        {
        	$fields[] = 'vehicle_name AS vehicle_name';
        }


        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        if ($pagenum > -1) {
           $CI->db->group_by('2');

           $CI->db->order_by('1 desc');

           $offset = $pagenum * 1;

           $CI->db->limit(1, $offset);
       }

       $result = $CI->db->get()->row_array();
        // print $CI->db->last_query();

       return $result;

   }
}

if ( ! function_exists('inquiry_kind_count'))
{
    function inquiry_kind_count($inquiry_kind = 'all')
    {
        $CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        if ($inquiry_kind != 'all')
        {
            $whereCondition[] = " inquiry_kind = '{$inquiry_kind}' "; 
        }

        $whereCondition[] = "status_id = 1";

        $fields = array();

        $fields[] = 'COUNT(inquiry_kind) AS total';

        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];
        
    }
}

if ( ! function_exists('inquiry_source_count'))
{
    function inquiry_source_count($source_name = 'all')
    {
        $CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        if ($source_name != 'all')
        {
            $whereCondition[] = " source_name = '{$source_name}' "; 
        }

        $fields = array();

        $fields[] = 'COUNT(source_name) AS total';

        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];
        
    }
}

if ( ! function_exists('inquiry_type_count'))
{
    function inquiry_type_count($customer_type_name = 'all')
    {
        $CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        if ($customer_type_name != 'all')
        {
            $whereCondition[] = " customer_type_name = '{$customer_type_name}' "; 
        }

        $fields = array();

        $fields[] = 'COUNT(customer_type_name) AS total';

        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];
        
    }
}


if ( ! function_exists('closed_inquiry_count'))
{
    function closed_inquiry_count($sub_status_name = 'all')
    {
        $CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        if ($sub_status_name != 'all')
        {
            $whereCondition[] = " sub_status_name = '{$sub_status_name}' "; 
        }

        $whereCondition[] = "status_id = 18";

        $fields = array();

        $fields[] = 'COUNT(sub_status_name) AS total';

        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];
        
    }
}

if ( ! function_exists('inquiry_conversion_ratio'))
{
    function inquiry_conversion_ratio($inquiry_conversion_ratio = 'all')
    {
        $CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        $fields = array();

        

        if ($inquiry_conversion_ratio == 'Converted')
        {
            $fields[] = '100.0 * SUM(CASE WHEN status_id = 15 THEN 1 ELSE 0 END)/COUNT(1) AS total';
        } 
        else if ($inquiry_conversion_ratio == 'Not Converted')
        {
            $fields[] = '100.0 * SUM(CASE WHEN status_id <> 15 THEN 1 ELSE 0 END)/COUNT(1) AS total';
        } else {
            return '0.00';
        }

        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return number_format($result['total'], 2);
        
    }
}


if ( ! function_exists('test_drive_conversion_ratio'))
{
    function test_drive_conversion_ratio($test_drive_conversion_ratio = 'all')
    {
        $CI = &get_instance();

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

        // ACCESS LEVEL CHECK ENDS

        $fields = array();

        

        if ($test_drive_conversion_ratio == 'Converted')
        {
            $fields[] = '100.0 * SUM(CASE WHEN status_id = 15 AND test_drive = \'TAKEN\' THEN 1 ELSE 0 END)/COUNT(1) AS total';
        } 
        else if ($test_drive_conversion_ratio == 'Not Converted')
        {
            $fields[] = '100.0 * SUM(CASE WHEN status_id <> 15 AND test_drive = \'TAKEN\' THEN 1 ELSE 0 END)/COUNT(1) AS total';
        } else {
            return '0.00';
        }

        $CI->db->select($fields);

        $CI->db->from('view_customers');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return number_format($result['total'], 2);
        
    }


    if ( ! function_exists('pending_dealer_pi'))
    {
        function pending_dealer_pi()
        {
            $CI = &get_instance();

            $whereCondition = array();

        // ACCESS LEVEL CHECK STARTS
            $is_spareparts_dealer = NULL;
            $is_spareparts_incharge = NULL;

            $dealer_list    = (is_sparepart_dealer_incharge()) ? get_spareparts_dealer_list() : NULL; 

            if (empty($dealer_list)) {
                $is_spareparts_dealer = (is_sparepart_dealer()) ? TRUE : NULL; 
                $is_spareparts_incharge = (is_sparepart_incharge()) ? TRUE : NULL; 
            }

            if(!empty($dealer_list)) {
                $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
            } elseif ($is_spareparts_dealer) {
                $whereCondition[] = " ( dealer_id = " . $CI->session->userdata('employee')['dealer_id'] . ")";
            } elseif ($is_spareparts_incharge) {
                $whereCondition[] = " ( 1 = 1 )";
            }

        // ACCESS LEVEL CHECK ENDS

            $whereCondition[] = "(dealer_confirmed = 0 AND order_cancel = 0) "; 

            $fields = array();

            $fields[] = 'COUNT(order_no) AS total';

            $CI->db->select($fields);

            $CI->db->from('view_spareparts_pending_pi_confirm');

            if (count($whereCondition) > 0) {
                $CI->db->where(implode(" AND " , $whereCondition));
            }

            $result = $CI->db->get()->row_array();

            return $result['total'];

        }
    }
    if ( ! function_exists('pending_cg_pi'))
    {
        function pending_cg_pi()
        {
            $CI = &get_instance();

            $whereCondition = array();

        // ACCESS LEVEL CHECK STARTS
            $is_spareparts_dealer = NULL;
            $is_spareparts_incharge = NULL;

            $dealer_list    = (is_sparepart_dealer_incharge()) ? get_spareparts_dealer_list() : NULL; 

            if (empty($dealer_list)) {
                $is_spareparts_dealer = (is_sparepart_dealer()) ? TRUE : NULL; 
                $is_spareparts_incharge = (is_sparepart_incharge()) ? TRUE : NULL; 
            }

            if(!empty($dealer_list)) {
                $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
            } elseif ($is_spareparts_dealer) {
                $whereCondition[] = " ( dealer_id = " . $CI->session->userdata('employee')['dealer_id'] . ")";
            } elseif ($is_spareparts_incharge) {
                $whereCondition[] = " ( 1 = 1 )";
            }

        // ACCESS LEVEL CHECK ENDS

            $whereCondition[] = "(cg_confirmed = 0  AND order_cancel = 0 ) "; 

            $fields = array();

            $fields[] = 'COUNT(order_no) AS total';

            $CI->db->select($fields);

            $CI->db->from('view_spareparts_pending_pi_confirm');

            if (count($whereCondition) > 0) {
                $CI->db->where(implode(" AND " , $whereCondition));
            }

            $result = $CI->db->get()->row_array();

            return $result['total'];

        }
    }

    if ( ! function_exists('dealer_total_order'))
    {
        function dealer_total_order()
        {
            $CI = &get_instance();

            $whereCondition = array();

        // ACCESS LEVEL CHECK STARTS
            $is_spareparts_dealer = NULL;
            $is_spareparts_incharge = NULL;

            $dealer_list    = (is_sparepart_dealer_incharge()) ? get_spareparts_dealer_list() : NULL; 

            if (empty($dealer_list)) {
                $is_spareparts_dealer = (is_sparepart_dealer()) ? TRUE : NULL; 
                $is_spareparts_incharge = (is_sparepart_incharge()) ? TRUE : NULL; 
            }

            if(!empty($dealer_list)) {
                $whereCondition[] = "( dealer_id  IN (" . implode(", ", $dealer_list) . ") ) ";
            } elseif ($is_spareparts_dealer) {
                $whereCondition[] = " ( dealer_id = " . $CI->session->userdata('employee')['dealer_id'] . ")";
            } elseif ($is_spareparts_incharge) {
                $whereCondition[] = " ( 1 = 1 )";
            }

        // ACCESS LEVEL CHECK ENDS

            $whereCondition[] = "( order_cancel = 0) "; 

            $fields = array();

            $fields[] = 'COUNT(order_no) AS total';

            $CI->db->select($fields);

            $CI->db->from('view_spareparts_pending_pi_confirm');

            if (count($whereCondition) > 0) {
                $CI->db->where(implode(" AND " , $whereCondition));
            }

            $result = $CI->db->get()->row_array();

            return $result['total'];

        }
    }
}

/* End of file dashboard_helper.php */
/* Location: ./application/helpers/dashboard_helper.php */