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


if ( ! function_exists('paging'))
{
	function paging($default, $order = 'desc')
	{
		$CI = &get_instance();

		$input = $CI->input->get();
		
		$pagenum  = (isset($input['pagenum'])) ? $input['pagenum'] : 0;
		
		$pagesize  = (isset($input['pagesize'])) ? $input['pagesize'] : 100;
		
		$offset = $pagenum * $pagesize;

		$CI->db->limit($pagesize, $offset);

		//sorting
		if (isset($input['sortdatafield'])) {
			$sortdatafield = $input['sortdatafield'];
			$sortorder = (isset($input['sortorder'])) ? $input['sortorder'] :'asc';
			$CI->db->order_by($sortdatafield, $sortorder); 
		} else {
			$CI->db->order_by($default, $order);
		}
		
	}
}

if ( ! function_exists('search_params'))
{
	function search_params()
	{
		$CI = &get_instance();

		$input = ($CI->input->get())?$CI->input->get():$CI->input->post();

		// echo '<pre>'; print_r($input); exit;

		if (isset($input['filterscount'])) {
			$filtersCount = $input['filterscount'];
			if ($filtersCount > 0) {
				for ($i=0; $i < $filtersCount; $i++) {
					// get the filter's column.
					$filterDatafield 	= $input['filterdatafield' . $i];

					// get the filter's value.
					$filterValue 		=  $input['filtervalue' 	. $i];

					// get the filter's condition.
					$filterCondition 	= $input['filtercondition' . $i];

					// get the filter's operator.
					$filterOperator 	= $input['filteroperator' 	. $i];

					$operatorLike = 'LIKE';

					switch($filterCondition) {
						case "CONTAINS":
						if (strtoupper($filterValue) == 'BLANK') {
                                // $CI->db->where("{$filterDatafield} IS EMPTY", null, false);
						} else if(strtoupper($filterValue) == 'NULL') {
							$CI->db->where("{$filterDatafield} IS NULL", null, false);
						} else {
							$CI->db->ilike($filterDatafield, $filterValue);
						}
						break;
						case "DOES_NOT_CONTAIN":
						$CI->db->inot_like($filterDatafield, $filterValue);
						break;
						case "EQUAL":
						$CI->db->where($filterDatafield, $filterValue);
						break;
						case "GREATER_THAN":
						$CI->db->where($filterDatafield . ' >', $filterValue);
						break;
						case "LESS_THAN":
						$CI->db->where($filterDatafield . ' <', $filterValue);
						break;
						case "GREATER_THAN_OR_EQUAL":
						$CI->db->where($filterDatafield . ' >=', $filterValue);
						break;
						case "LESS_THAN_OR_EQUAL":
						$CI->db->where($filterDatafield . ' <=', $filterValue);
						break;
						case "STARTS_WITH":
						$CI->db->ilike($filterDatafield, $filterValue, 'after'); 
						break;
						case "ENDS_WITH":
						$CI->db->ilike($filterDatafield, $filterValue, 'before'); 
						break;
					}
				}
			}
		}
	}
}

if ( ! function_exists('get_english_date'))
{
	function get_english_date($nepali_date = null, $retType = 'json')
	{
		$CI = &get_instance();

		$date = null;
		$success = false;

		if ($nepali_date == null) {
			echo json_encode(array('success' => $success, 'date' => $date));
			exit;
		}

		$CI->load->library('nepali_calendar');

		list($y,$m,$d) = explode('-', $nepali_date);

		$converted_date = $CI->nepali_calendar->BS_to_AD($y,$m,$d);

		$date = date('Y-m-d',mktime(0,0,0, $converted_date['month'], $converted_date['date'], $converted_date['year']));

		if ($retType == 'json') {
			$success = true;
			echo json_encode(array('success' => $success, 'date' => $date));
		} else {
			return $date;
		}
	}

}

if ( ! function_exists('get_nepali_date'))
{
	function get_nepali_date($english_date = null, $retType = 'json')
	{
		$CI = &get_instance();

		$date = null;
		$success = false;

		if ($english_date == null) {
			echo json_encode(array('success' => $success, 'date' => $date));
			exit;
		}

		$CI->load->library('nepali_calendar');

		list($y,$m,$d) = explode('-', $english_date);

		$converted_date = $CI->nepali_calendar->AD_to_BS($y,$m,$d,'array');

		$date = $converted_date['year'] . '-' . sprintf("%02d", $converted_date['month'] ) . '-' . sprintf("%02d", $converted_date['date'] );

		if ($retType == 'json') {
			$success = true;
			echo json_encode(array('success' => $success, 'date' => $date));
		} else {
			return $date;
		}

	}

}

if ( ! function_exists('get_current_calendar_year'))
{
	function get_current_calendar_year()
	{
		$CI = &get_instance();

		$CI->load->model('calendar_years/calendar_year_model');
		$id= 0;
		$row=$CI->calendar_year_model->get_by('active', TRUE);

		if($row){
			$id = $row->id;
		}

		return $id;
	}
}

if ( ! function_exists('internet_connection'))
{
	function internet_connection()
	{
		$connected = @fsockopen("www.google.com", 80); 
	                                        //website, port  (try 80 or 443)
		if ($connected){
	        $is_conn = true; //action when connected
	        fclose($connected);
	    }else{
	        $is_conn = false; //action in connection failure
	    }
	    return $is_conn;

	}
}

if ( ! function_exists('get_current_fiscal_year'))
{
	function get_current_fiscal_year()
	{
		$id 		 = null;
		$fiscal_year = null;

		$CI = &get_instance();
		$CI->load->model('fiscal_years/fiscal_year_model');
		$CI->db->where('NOW()::date >= english_start_date');
		$CI->db->where('NOW()::date <= english_end_date');

		$fields = array();
		$fields[] = 'id';
		$fields[] = "(substr(nepali_start_date, 0, 5) || '-' || substr(nepali_end_date, 3, 2)) as fiscal_year";
		$fields[] = 'english_start_date';
		$fields[] = 'english_end_date';

		$record = $CI->fiscal_year_model->findAll(null, $fields);

		if ($record){
			$id	= $record[0]->id;
			$fiscal_year = $record[0]->fiscal_year;	
			$english_start_date = $record[0]->english_start_date;	
			$english_end_date = $record[0]->english_end_date;	
		}
		return array($id, $fiscal_year,$english_start_date,$english_end_date);
	}
}

if ( ! function_exists('get_current_user_details'))
{
	function get_current_user_details()
	{
		$CI = &get_instance();
		$CI->load->model('employees/employee_model');

		$CI->db->where('user_id', $CI->session->userdata('id'));

		$CI->employee_model->as_array();
		$record = $CI->employee_model->findAll(null, array('id as employee_id', 'dealer_id'));

		if ($record)
		{
			return $record[0];
		}
		return false;
	}
}

if ( ! function_exists('is_yatayat'))
{
	function is_yatayat()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', YATAYAT_GROUP);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_sales_head'))
{
	function is_sales_head()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SALES_HEAD_GROUP);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_sales_head_api'))
{
	function is_sales_head_api($user_id)
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $user_id);
		$CI->db->where('group_id', SALES_HEAD_GROUP);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_manager'))
{
	function is_manager()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', MANAGER_GROUP);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_manager_api'))
{
	function is_manager_api($user_id)
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $user_id);
		$CI->db->where('group_id', MANAGER_GROUP);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_service_dealer_incharge'))
{
	function is_service_dealer_incharge()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SERVICE_DEALER_INCHARGE);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_national_service_manager'))
{
	function is_national_service_manager()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', NATIONAL_SERVICE_MANAGER);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}
if ( ! function_exists('is_ccd_incharge'))
{
	function is_ccd_incharge()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', CCD_INCHARGE);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_material_issuer'))
{
	function is_material_issuer()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', MATERIAL_ISSUE_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_service_head'))
{
	function is_service_head()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SERVICE_HEAD_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_admin'))
{
	function is_admin()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', ADMIN_GROUP);
		
		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_dealer_incharge'))
{
	function is_dealer_incharge()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', DEALER_INCHARGE_GROUP);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_warranty_user'))
{
	function is_warranty_user()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', WARRANTY_USER);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_dealer_incharge_api'))
{
	function is_dealer_incharge_api($user_id)
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $user_id);
		$CI->db->where('group_id', DEALER_INCHARGE_GROUP);

		return ($CI->user_group_model->find_count() == 1) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_showroom_incharge'))
{
	function is_showroom_incharge()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SHOWROOM_INCHARGE_GROUP);

		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_showroom_incharge_api'))
{
	function is_showroom_incharge_api($user_id)
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $user_id);
		$CI->db->where('group_id', SHOWROOM_INCHARGE_GROUP);

		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}


if ( ! function_exists('is_sales_executive'))
{
	function is_sales_executive()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SALES_EXECUTIVE_GROUP);

		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_sales_executive_api'))
{
	function is_sales_executive_api($user_id)
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $user_id);
		$CI->db->where('group_id', SALES_EXECUTIVE_GROUP);

		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}


if ( ! function_exists('is_floor_supervisor'))
{
	function is_floor_supervisor()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');
		
		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', FLOOR_SUPERVISOR_GROUP);
		
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_service_advisor'))
{
	function is_service_advisor()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');
		
		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SERVICE_ADVISOR_GROUP);
		
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_service_finance'))
{
	function is_service_finance()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');
		
		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SERVICE_FINANCE);
		
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_service_management'))
{
	function is_service_management()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');
		
		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SERVICE_MANAGEMENT);
		
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}



if ( ! function_exists('is_accountant'))
{
	function is_accountant()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SERVICE_ACCOUNTANT_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_logistic_user'))
{
	function is_logistic_user()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', LOGISTIC_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}
if ( ! function_exists('is_logistic_group_user'))
{
	function is_logistic_group_user()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', LOGISTIC_USER);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_logistic_executive'))
{
	function is_logistic_executive()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', LOGISTIC_EXECUTIVE_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_sparepart_incharge'))
{
	function is_sparepart_incharge()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SPAREPART_INCHARGE_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_sparepart_dealer_incharge'))
{
	function is_sparepart_dealer_incharge()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SPAREPART_DEALER_INCHARGE_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}
if ( ! function_exists('is_sparepart_dealer'))
{
	function is_sparepart_dealer()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SPAREPART_DEALER_GROUP);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_workshop_manager'))
{
	function is_workshop_manager()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', WORKSHOP_MANAGER);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_aro'))
{
	function is_aro()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', ARO);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_sparepart_dealer_incharge'))
{
	function is_sparepart_dealer_incharge()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', SPAREPART_DEALER_INCHARGE);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('is_credit_control'))
{
	function is_credit_control()
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');
		
		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', CREDIT_CONTROL_GROUP);
		
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if ( ! function_exists('get_dealer_list'))
{
	function get_dealer_list()
	{
		$CI = &get_instance();
		$CI->load->model('dealers/dealer_model');

		$CI->db->where('incharge_id',  $CI->session->userdata('id'));

		$records = $CI->dealer_model->findAll(null, array('id'));

		$data = null;

		if ($records) {
			foreach ($records as $record) {
				$data[] = $record->id;
			}
		}
		return $data;
	}
}

if ( ! function_exists('get_sparepart_dealer_list'))
{
	function get_sparepart_dealer_list()
	{
		$CI = &get_instance();
		$CI->load->model('dealers/dealer_model');

		$CI->db->where('spares_incharge_id',  $CI->session->userdata('id'));

		$records = $CI->dealer_model->findAll(null, array('id'));

		$data = null;

		if ($records) {
			foreach ($records as $record) {
				$data[] = $record->id;
			}
		}
		// echo '<pre>'; print_r($data); exit;
		return $data;
	}
}


if ( ! function_exists('get_dealer_list_api'))
{
	function get_dealer_list_api($user_id)
	{
		$CI = &get_instance();
		$CI->load->model('dealers/dealer_model');

		$CI->db->where('incharge_id',  $user_id);

		$records = $CI->dealer_model->findAll(null, array('id'));

		$data = null;

		if ($records) {
			foreach ($records as $record) {
				$data[] = $record->id;
			}
		}
		return $data;
	}
}

if ( ! function_exists('get_spareparts_dealer_list'))
{
	function get_spareparts_dealer_list()
	{
		$CI = &get_instance();
        $CI->load->model('dealers/dealer_model');

		$CI->db->where('spares_incharge_id',  $CI->session->userdata('id'));

		$records = $CI->dealer_model->findAll(null, array('id'));

		$data = null;

		if ($records) {
			foreach ($records as $record) {
				$data[] = $record->id;
			}
		}
		return $data;
	}
}

if ( ! function_exists('get_service_dealer_list'))
{
	function get_service_dealer_list()
	{
		$CI = &get_instance();
		$CI->load->model('dealers/dealer_model');

		$CI->db->where('service_incharge_id',  $CI->session->userdata('id'));
		// $CI->db->order_by('name','asc');
		$records = $CI->dealer_model->findAll(null, array('id'));

		$data = null;

		if ($records) {
			foreach ($records as $record) {
				$data[] = $record->id;
			}
		}
		return $data;
	}
}

if ( ! function_exists('is_group'))
{
	function is_group($group)
	{
		$CI = &get_instance();
		$CI->load->model('users/user_group_model');

		$CI->db->where('user_id',  $CI->session->userdata('id'));
		$CI->db->where('group_id', $group);
		return ($CI->user_group_model->find_count() > 0) ? TRUE : FALSE;
	}
}

if (! function_exists('moneyFormat'))
{
	function moneyFormat($num){

		$explrestunits = "" ;
		$num=preg_replace('/,+/', '', $num);
		$words = explode(".", $num);
		$des="00";
		if(count($words)<=2){
			$num=$words[0];
			if(count($words)>=2){$des=$words[1];}
			if(strlen($des)<2){$des="$des0";}else{$des=substr($des,0,2);}
		}
		if(strlen($num)>3){
			$lastthree = substr($num, strlen($num)-3, strlen($num));
	    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
	    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
	    $expunit = str_split($restunits, 2);
	    for($i=0; $i<sizeof($expunit); $i++){
	        // creates each of the 2's group and adds a comma to the end
	    	if($i==0)
	    	{
	            $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
	        }else{
	        	$explrestunits .= $expunit[$i].",";
	        }
	    }
	    $thecash = $explrestunits.$lastthree;
	} else {
		$thecash = $num;
	}

	if($des == '00')
	{
		return "$thecash";
	}
	return "$thecash.$des"; // writes the final format where $currency is the currency symbol.

}

if ( ! function_exists('get_nepali_month_detail_from_nepali_date'))
{
	function get_nepali_month_detail_from_nepali_date($nepali_date = null, $retType = 'json')
	{
		$CI = &get_instance();

		$date = null;
		$success = false;

		if ($nepali_date == null) {
			echo json_encode(array('success' => $success, 'date' => $date));
			exit;
		}

		$CI->load->library('nepali_calendar');

		list($y,$m) = explode('-', $nepali_date);
		$date['days'] = $CI->nepali_calendar->get_days_in_month($y,$m);
		// echo '<pre>'; echo 'here'; print_r($date); exit;
		return $date['days'];
		                 
	}

}
// get project setting data
if ( ! function_exists('get_setting'))
{
	function get_setting($key, $code=NULL, $value=NULL)
	{
		$CI = &get_instance();
        $CI->load->model('settings/setting_model');

		$CI->db->where('key',  $key);
		($code)?$CI->db->where('code',  $code):'';
		($value)?$CI->db->where('value',  $value):'';

		$records = $CI->setting_model->findAll();

		$data = null;

		if ($records) {
			foreach ($records as $record) {
				$data[] = $record;
			}
		}
		return $data;
	}
}
}

/* End of file Installation_helper.php */
/* Location: ./application/helpers/paging_helper.php */