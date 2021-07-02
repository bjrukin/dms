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

        $CI->db->from('view_dashboard_status_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];

    }
}

if ( ! function_exists('status_count_all'))
{
    function status_count_all()
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

        $fields[] = 'status_name,COUNT(status_name) AS total ';

        $CI->db->select($fields);

        $CI->db->from('view_dashboard_status_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        $CI->db->group_by('status_name');
        $result = $CI->db->get()->result_array();
        // echo $CI->db->last_query();
        // echo '<pre>'; print_r($result); exit;
        return $result;

    }
}

if ( ! function_exists('inquiry_kind_count_all'))
{
    function inquiry_kind_count_all()
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

        // if ($inquiry_kind != 'all')
        // {
        //     $whereCondition[] = " inquiry_kind = '{$inquiry_kind}' "; 
        // }

        $whereCondition[] = "status_id = 1";

        $fields = array();

        $fields[] = 'inquiry_kind, COUNT(inquiry_kind) AS total';

        $CI->db->select($fields);
        $CI->db->group_by('inquiry_kind');
        $CI->db->from('view_dashboard_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->result_array();

        return $result;
        
    }
}

if ( ! function_exists('inquiry_source_count_all'))
{
    function inquiry_source_count_all($source_name = 'all',$marketing = NULL)
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

        // Current Month
        if($marketing)
        {
          $current_month = explode('-', get_nepali_date(date('Y-m-d'),'nep'));
          $current_month_np = "{$current_month[0]}-{$current_month[1]}";

            $whereCondition[] = "(inquiry_date_np LIKE '{$current_month_np}-%')";
        }

        // if ($source_name != 'all')
        // {
        //     $whereCondition[] = " source_name = '{$source_name}' "; 
        // }

        $fields = array();

        $fields[] = 'source_name, COUNT(source_name) AS total';

        $CI->db->select($fields);
        $CI->db->group_by('source_name');

        $CI->db->from('view_dashboard_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->result_array();

        return $result;
        
    }
}

if ( ! function_exists('inquiry_type_count_all'))
{
    function inquiry_type_count_all($customer_type_name = 'all')
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

        // if ($customer_type_name != 'all')
        // {
        //     $whereCondition[] = " customer_type_name = '{$customer_type_name}' "; 
        // }

        $fields = array();

        $fields[] = 'customer_type_name, COUNT(customer_type_name) AS total';

        $CI->db->select($fields);
        $CI->db->group_by('customer_type_name');

        $CI->db->from('view_dashboard_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->result_array();

        return $result;
        
    }
}

if ( ! function_exists('closed_inquiry_count_all'))
{
    function closed_inquiry_count_all($sub_status_name = 'all')
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

        // if ($sub_status_name != 'all')
        // {
        //     $whereCondition[] = " sub_status_name = '{$sub_status_name}' "; 
        // }

        $whereCondition[] = "status_id = 18";

        $fields = array();

        $fields[] = 'sub_status_name,COUNT(sub_status_name) AS total';

        $CI->db->select($fields);
        $CI->db->group_by('sub_status_name');

        $CI->db->from('view_dashboard_status_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->result_array();

        return $result;
        
    }
}

if ( ! function_exists('inquiry_conversion_ratio_all'))
{
    function inquiry_conversion_ratio_all($inquiry_conversion_ratio = 'all', $source_name = 'all',$marketing = NULL)
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
        if($marketing)
        {
          $current_month = explode('-', get_nepali_date(date('Y-m-d'),'nep'));
          $current_month_np = "{$current_month[0]}-{$current_month[1]}";

            $whereCondition[] = "(inquiry_date_np LIKE '{$current_month_np}-%')";
        }

        // if ($source_name != 'all')
        // {
        //     $whereCondition[] = " source_name = '{$source_name}' "; 
        // }

        $fields = array();
        $fields[] = '100.0 * SUM(CASE WHEN status_id = 15 THEN 1 ELSE 0 END)/COUNT(1) AS converted_total ';
        $fields[] = '100.0 * SUM(CASE WHEN status_id <> 15 THEN 1 ELSE 0 END)/COUNT(1) AS not_converted_total';
        // $fields[] = 'source_name';

        $CI->db->select($fields);
        // $CI->db->group_by('source_name');

        $CI->db->from('view_dashboard_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();
        // echo $CI->db->last_query();exit;
        return $result;
        
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

        $CI->db->from('view_dashboard_customer');
        
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

        $CI->db->from('view_dashboard_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];
        
    }
}

if ( ! function_exists('inquiry_source_count'))
{
    function inquiry_source_count($source_name = 'all',$marketing = NULL)
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

        // Current Month
        if($marketing)
        {
          $current_month = explode('-', get_nepali_date(date('Y-m-d'),'nep'));
          $current_month_np = "{$current_month[0]}-{$current_month[1]}";

            $whereCondition[] = "(inquiry_date_np LIKE '{$current_month_np}-%')";
        }

        if ($source_name != 'all')
        {
            $whereCondition[] = " source_name = '{$source_name}' "; 
        }

        $fields = array();

        $fields[] = 'COUNT(source_name) AS total';

        $CI->db->select($fields);

        $CI->db->from('view_dashboard_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        // echo $CI->db->last_query();

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

        $CI->db->from('view_dashboard_customer');
        
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

        $CI->db->from('view_dashboard_status_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return $result['total'];
        
    }
}

if ( ! function_exists('inquiry_conversion_ratio'))
{
    function inquiry_conversion_ratio($inquiry_conversion_ratio = 'all', $source_name = 'all',$marketing = NULL)
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
        if($marketing)
        {
          $current_month = explode('-', get_nepali_date(date('Y-m-d'),'nep'));
          $current_month_np = "{$current_month[0]}-{$current_month[1]}";

            $whereCondition[] = "(inquiry_date_np LIKE '{$current_month_np}-%')";
        }

        if ($source_name != 'all')
        {
            $whereCondition[] = " source_name = '{$source_name}' "; 
        }

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

        $CI->db->from('view_dashboard_customer');
        
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

        $CI->db->from('view_dashboard_customer');
        
        if (count($whereCondition) > 0) {
            $CI->db->where(implode(" AND " , $whereCondition));
        }
        
        $result = $CI->db->get()->row_array();

        return number_format($result['total'], 2);
        
    }

    if ( ! function_exists('test_drive_count'))
    {
        function test_drive_count($source_name = 'all',$marketing = NULL)
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

        // Current Month
            if($marketing)
            {
              $current_month = explode('-', get_nepali_date(date('Y-m-d'),'nep'));
              $current_month_np = "{$current_month[0]}-{$current_month[1]}";

            $whereCondition[] = "(inquiry_date_np LIKE '{$current_month_np}-%')";
            }

            $fields = array();

            $fields[] = 'COUNT(id) AS total';

            if ($source_name != 'all')
            {
                $whereCondition[] = " source_name = '{$source_name}' "; 
            }

            $whereCondition[] = "test_drive = 'TAKEN'"; 

            $CI->db->select($fields);

            $CI->db->from('view_dashboard_customer');

            if (count($whereCondition) > 0) {
                $CI->db->where(implode(" AND " , $whereCondition));
            }

            $result = $CI->db->get()->row_array();

            return $result['total'];

        }
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

    if ( ! function_exists('get_walkin_source_data'))
    {
        function get_walkin_source_data($count_only = NULL)
        {
            $CI = &get_instance();

            $fields = array();

            if($count_only)
            {
                $fields[] = 'COUNT(id) AS total_inquiry';
            }
            else
            {
                $fields[] = 'COUNT(id) AS total'; 
                $fields[] = 'walkin_source_name';
                $CI->db->group_by('walkin_source_name');
            }

            $CI->db->select($fields);

            $CI->db->from('view_walkin_source_dashboard');


            $result = $CI->db->get()->result_array();

            return $result;
        }
    }

    if ( ! function_exists('sales_order_status'))
    {
        function sales_order_status($order_status = NULL)
        {
            $CI = &get_instance();

            $whereCondition = array();
            if($order_status == 'pending')
            {
                $whereCondition[] = "(vehicle_main_id IS NULL) ";
                $whereCondition[] = "(credit_control_approval = 0 OR credit_control_approval = 1 ) ";
            }
            if($order_status == 'rejected')
            {
                $whereCondition[] = "(credit_control_approval = 2) ";
            }

            $whereCondition[] = "( cancel_date IS NULL) "; 

            $fields = array();

            $fields[] = 'COUNT(id) AS total';

            $CI->db->select($fields);

            $CI->db->from('view_log_dealer_report');

            if (count($whereCondition) > 0) {
                $CI->db->where(implode(" AND " , $whereCondition));
            }

            $result = $CI->db->get()->row_array();

            return $result['total'];

        }
    }

    if ( ! function_exists('get_regionwise_bill'))
    {
         function get_regionwise_bill($billing_type = 'all')
         {
            $CI = &get_instance();

            $fields = array();
            $fields[] = "region_name";
            $fields[] = "count(region_name) as total_bill";

            $date = get_nepali_date(date('Y-m-d'),'true');
            $dates = explode('-', $date);

            if($date[1] < 4)
            {
                $year_min = $dates[0]-1;
                $year_max = $dates[0]+1;
                $CI->db->where("dispatched_date_np >'{$year_min}-04-00' AND dispatched_date_np < '({$dates[0]})-03-35'");
            }
            else
            {               
                $CI->db->where("dispatched_date_np >'({$dates[0]})-04-00' AND dispatched_date_np < '({$year_max})-03-35'");
            }

            $CI->db->select($fields);
            $CI->db->group_by(array('region_name','region_id'));
            $CI->db->order_by('region_id');
            $CI->db->from('view_dashboard_regionwise_bill');

            $result = $CI->db->get()->result_array();

            return $result;
        }
    }

    if ( ! function_exists('get_all_billing'))
    {
         function get_all_billing()
         {
            $CI = &get_instance();

            $fields = array();
            $fields[] = "count(region_name) as total_bill";

            $date = get_nepali_date(date('Y-m-d'),'true');
            $dates = explode('-', $date);

            if($date[1] < 4)
            {
                $year_min = $dates[0]-1;
                $year_max = $dates[0]+1;
                $CI->db->where("dispatched_date_np >'{$year_min}-04-00' AND dispatched_date_np < '({$dates[0]})-03-35'");
            }
            else
            {               
                $CI->db->where("dispatched_date_np >'({$dates[0]})-04-00' AND dispatched_date_np < '({$year_max})-03-35'");
            }

            $CI->db->select($fields);
            $CI->db->from('view_dashboard_regionwise_bill');

            $result = $CI->db->get()->row();

            return $result;
        }
    }

    if ( ! function_exists('get_regionwise_retail'))
    {
         function get_regionwise_retail()
         {
            $CI = &get_instance();

            $fields = array();
            $fields[] = "region_name";
            $fields[] = "count(region_name) as total_retail";

            $date = get_nepali_date(date('Y-m-d'),'true');
            $dates = explode('-', $date);

            if($date[1] < 4)
            {
                $year_min = $dates[0]-1;
                $year_max = $dates[0]+1;
                $CI->db->where("vehicle_delivery_date_np >'{$year_min}-04-00' AND vehicle_delivery_date_np < '({$dates[0]})-03-35'");
            }
            else
            {               
                $CI->db->where("vehicle_delivery_date_np >'({$dates[0]})-04-00' AND vehicle_delivery_date_np < '({$year_max})-03-35'");
            }

            $CI->db->select($fields);
            $CI->db->group_by(array('region_name','region_id'));
            $CI->db->order_by('region_id');
            $CI->db->from('view_dashboard_regionwise_retail');

            $result = $CI->db->get()->result_array();

            return $result;
        }
    }
    if ( ! function_exists('get_regionwise_all_retail'))
    {
         function get_regionwise_all_retail()
         {
            $CI = &get_instance();

            $fields = array();
            $fields[] = "count(region_name) as total_retail";

            $date = get_nepali_date(date('Y-m-d'),'true');
            $dates = explode('-', $date);

            if($date[1] < 4)
            {
                $year_min = $dates[0]-1;
                $year_max = $dates[0]+1;
                $CI->db->where("vehicle_delivery_date_np >'{$year_min}-04-00' AND vehicle_delivery_date_np < '({$dates[0]})-03-35' AND vehicle_delivery_date_np IS NOT NULL");
            }
            else
            {               
                $CI->db->where("vehicle_delivery_date_np >'({$dates[0]})-04-00' AND vehicle_delivery_date_np < '({$year_max})-03-35' AND vehicle_delivery_date_np IS NOT NULL");
            }

            $CI->db->select($fields);
            $CI->db->from('view_dashboard_regionwise_retail');

            $result = $CI->db->get()->row();

            return $result;
        }
    }
}

/* End of file dashboard_helper.php */
/* Location: ./application/helpers/dashboard_helper.php */