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
* Spareparts_report
*
* Extends the Report_Controller class
* 
*/

class Spareparts_report extends Report_Controller
{
    public function __construct()
    {
        parent::__construct();

        control('Spareparts Reports');

        $this->lang->load('spareparts_report/sparepart_report');
    }

    public function index()
    {
        
// Display Page
        $data['header'] = lang('spareparts_report');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'spareparts_report';
        $this->load->view($this->_container,$data);
    }
    public function dealer_index()
    {
        
// Display Page
        $data['header'] = lang('spareparts_report');
        $data['page'] = $this->config->item('template_admin') . "dealer_index";
        $data['module'] = 'spareparts_report';
        $this->load->view($this->_container,$data);
    }

    public function generate($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }
// Display Page
        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "generate-test";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);
    }

    public function get_report_json()
    {
        $lang_array = array(
            'latest_part_code' => lang('latest_part_code'),
            'part_code' => lang('part_code'),
            'part_name' => lang('part_name'),
            'total_sales_quantity' => lang('total_sales_quantity'),
            'dealer_price' => lang('price'),
            'total_value' => lang('total_value'),
            'dealer_name' => lang('dealer_name'),
            'total_sales_amount' => lang('total_sales_amount'),
            'order_quantity' => lang('order_quantity'),
            'dispatched_quantity' => lang('dispatched_quantity'),
            'backorder' => lang('backorder'),
            'order_no_concat' => lang('order_no_concat'),
            );
        $report_criteria_index = $this->input->post('report_criteria');

        $today_date = (date('Y-m-d')." - ".date('Y-m-d'));

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));          
        }
        else
        {
            $date_range = explode(" - ", $today_date);
        }
 
        if(is_sparepart_dealer())
        {
            $dealer_id = $this->session->userdata('employee')['dealer_id'];
            $user_id = $this->session->userdata('id');

            if ($report_criteria_index == 'partwise_sales')
            {
                $sql = "SELECT   vrss.part_code, vrss.part_name, sum(vrss.dispatched_quantity) as total_sales_quantity, vrss.dealer_price, (sum(vrss.dispatched_quantity)* vrss.dealer_price) as total_value  FROM view_report_spareparts_sales AS vrss WHERE vrss.dispatched_date >= '".$date_range[0]."' AND vrss.dispatched_date <= '".$date_range[1]."' AND vrss.dealer_id = ".$dealer_id." GROUP BY 1,2,4 ";
            }
            else if($report_criteria_index == 'dealer_partwise_sales')
            {
                $sql = "SELECT vrss.dealer_name, vrss.part_code, vrss.part_name, SUM (vrss.dispatched_quantity) AS total_sales_quantity,  vrss.dealer_price, SUM ( vrss.dispatched_quantity * vrss.dealer_price ) AS total_sales_amount FROM view_report_spareparts_sales AS vrss  WHERE vrss.dispatched_date >= '".$date_range[0]."' AND vrss.dispatched_date <= '".$date_range[1]."' AND vrss.dealer_id = ".$dealer_id."  GROUP BY 1,2,3,5";   
            } 
            else if($report_criteria_index == 'dealer_valuewise_sales')
            {
                $sql = "SELECT vrss.dealer_name, sum(vrss.dispatched_quantity * vrss.dealer_price) as total_sales_amount FROM view_report_spareparts_sales AS vrss WHERE vrss.dispatched_date >= '".$date_range[0]."' AND vrss.dispatched_date <= '".$date_range[1]."' AND vrss.dealer_id = ".$dealer_id." GROUP BY 1 ";
            }
            else if($report_criteria_index == 'dealer_back_order')
            {
                $sql = "SELECT vrss.dealer_name,vrss.order_no_concat ,vrss.part_code,vrss.part_name,vrss.order_quantity,vrss.dispatched_quantity,vrss.backorder FROM view_report_spareparts_backorder AS vrss WHERE vrss.created_date >= '".$date_range[0]."' AND vrss.created_date <= '".$date_range[1]."' AND vrss.dealer_id = ".$dealer_id." AND vrss.backorder <> 0 GROUP BY 1,2,3,4,5,6,7,vrss.order_no ORDER BY vrss.order_no";
            }
        }
        else
        {
            if ($report_criteria_index == 'partwise_sales')
            {
                $sql = "SELECT   vrss.part_code, vrss.part_name, sum(vrss.dispatched_quantity) as total_sales_quantity, vrss.dealer_price, (sum(vrss.dispatched_quantity)* vrss.dealer_price) as total_value  FROM view_report_spareparts_sales AS vrss WHERE vrss.dispatched_date >= '".$date_range[0]."' AND vrss.dispatched_date <= '".$date_range[1]."'  GROUP BY 1,2,4 ";
            }
            else if($report_criteria_index == 'dealer_partwise_sales')
            {
                $sql = "SELECT vrss.dealer_name, vrss.part_code, vrss.part_name, SUM (vrss.dispatched_quantity) AS total_sales_quantity,  vrss.dealer_price, SUM ( vrss.dispatched_quantity * vrss.dealer_price ) AS total_sales_amount FROM view_report_spareparts_sales AS vrss  WHERE vrss.dispatched_date >= '".$date_range[0]."' AND vrss.dispatched_date <= '".$date_range[1]."'  GROUP BY 1,2,3,5";   
            } 
            else if($report_criteria_index == 'dealer_valuewise_sales')
            {
                $sql = "SELECT vrss.dealer_name, sum(vrss.dispatched_quantity * vrss.dealer_price) as total_sales_amount FROM view_report_spareparts_sales AS vrss WHERE vrss.dispatched_date >= '".$date_range[0]."' AND vrss.dispatched_date <= '".$date_range[1]."'  GROUP BY 1 ";
            }
            else if($report_criteria_index == 'dealer_back_order')
            {
             $sql = "SELECT vrss.dealer_name,vrss.order_no_concat,vrss.part_code,vrss.part_name,vrss.order_quantity,vrss.dispatched_quantity,vrss.backorder FROM view_report_spareparts_backorder AS vrss WHERE vrss.created_date >= '".$date_range[0]."' AND vrss.created_date <= '".$date_range[1]."' AND vrss.backorder <> 0 GROUP BY 1,2,3,4,5,6,7,vrss.order_no ORDER BY vrss.order_no";
         }
     }

     $result = $this->db->query($sql)->result_array();
     if($report_criteria_index != 'dealer_back_order'){        
        foreach ($result as $key => $value) 
        {
            // $result[$key]['price'] = moneyFormat($value['price']);
         //   $result[$key]['total_value'] = moneyFormat($value['total_value']);
        }
    }
    $total = count($result);

    if (count($result) > 0) {
        $success = true;
    } else {
        $success = false;
    }
    echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total,'lang_array'=>$lang_array));
}

public function generate_msil_shipment($type = null) 
{
    if ($type==null) 
    {
        flashMsg('error', 'Invalid customer ID');
        redirect('admin/spareparts_report');  
    }

// Display Page
    $data['header']                 = lang('spareparts_report');
    $data['page']                   = $this->config->item('template_admin') . "msil_shipment";
    $data['module']                 = 'spareparts_report';
    $data['type']                   = $type;  
    $data['report_type']            = humanize(ucfirst($type));  

    $this->load->view($this->_container,$data);
}

public function generate_dealer_service_level($type = null) 
{
    if ($type==null) 
    {
        flashMsg('error', 'Invalid customer ID');
        redirect('admin/spareparts_report');  
    }

// Display Page
    $data['header']                 = lang('spareparts_report');
    $data['page']                   = $this->config->item('template_admin') . "generate";
    $data['module']                 = 'spareparts_report';
    $data['type']                   = $type;  
    $data['report_type']            = humanize(ucfirst($type));  

    $this->load->view($this->_container,$data);
}
public function get_servicelevel_report_json() 
{
    $fields = array();
    $array_total = array();
    $where = array();
    $report_criteria_index = $this->input->post('report_criteria'); 

    if($this->input->post('date_range')) {
        $date_range = explode(" - ", $this->input->post('date_range'));
        $where['request_date >='] = $date_range[0];
        $where['request_date <='] = $date_range[1];

        $where['dealer_id'] = $this->input->post('dealer_name');
    }

    if ($report_criteria_index == 'service_level') {
        $table = 'view_report_spareparts_requirements_vs_results';
        $fields = 'request_date, 
        request_date_np, 
        dealer_name, 
        pi_num, 
        latest_part_code, 
        part_name, 
        req_quantity, 
        unit_price, 
        req_price, 
        pending_qty, 
        dispatched_date, 
        dispatched_date_nepali, 
        dispatch_qty, 
        dispatch_price,
        service_level';

        $array_total = array(6,8,9,12,13);
    }

    if($report_criteria_index == 'service_level_summary') {
        $table = 'view_report_spareparts_req_vs_result_Summary';
        $fields = '
        name, address_1, req_price, dispatch_price, pending_amount, req_quantity, dispatch_qty, pending_qty, service as Quantity Service Level, count_request, count_dispatched, count_service_level
        ';
    }

    if($report_criteria_index == 'msil_consigment') {
        $table = 'view_report_spareparts_msil_purchase_consignment';
        $fields = '
        invoice_no, part_code, part_name, quantity, unit_rate, base_total, custom_cost,custom_other_cost,lc_comm_cost,unload_cost,freight_cost,insurance_cost, bank_charge_cost, vat_cost, total_addnl,net_amount,cost_rate
        ';
    }

    $where = array_filter($where, function($value){
        return ($value !== null && $value !== false && $value !== ''); 
    });

    $this->db->select($fields)->where($where);
    $result = $this->db->get($table)->result_array();

    if ($report_criteria_index == 'service_level') 
    {
        foreach ($result as $key => $value) 
        {
            $result[$key]['unit_price'] = moneyFormat($value['unit_price']);
            $result[$key]['req_price'] = moneyFormat($value['req_price']);
            $result[$key]['dispatch_price'] = moneyFormat($value['dispatch_price']);
        }
    }

    if ($report_criteria_index == 'service_level_summary') 
    {
        foreach ($result as $key => $value) 
        {
            $result[$key]['req_price'] = moneyFormat($value['req_price']);
            $result[$key]['dispatch_price'] = moneyFormat($value['dispatch_price']);
            $result[$key]['pending_amount'] = moneyFormat($value['pending_amount']);
        }
    }

    $total = count($result);

    if (count($result) > 0) {
        $success = true;
    } else {
        $success = false;
    }
    echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total, 'array_total' =>$array_total ));
}

public function msil_shipment_monitor_json() 
{
    $order_no = $this->input->post('order_no');
    $fields[] = 'final_order_no';
    $fields[] = 'date';
    $fields[] = 'total_quantity';
    $fields[] = 'total_amount';
    $fields[] = 'pi_number';
    $fields[] = 'pi_received_date';
    $fields[] = 'pi_confirmed_date';
    $where = "(final_order_no ='".$order_no."')";
    $this->db->select($fields);
    $this->db->from('view_report_spareparts_grouped_order_generate');
    $this->db->where($where);
    $header_data = $this->db->get()->result_array();

    $new_fields[] = 'invoice_no as Invoice No';
    $new_fields[] = 'msil_invoice_date as Invoice Date';
    $new_fields[] = 'msil_dispatch_date as Dispatch Date';
    $new_fields[] = 'reached_date as Receipt Date';
    $new_fields[] = 'inv_ord as INV-ORD';
    $new_fields[] = 'dis_inv as DIS-INV';
    $new_fields[] = 'rea_dis as REC-DIS';
    $new_fields[] = 'dispatched_quantity as MSIL Dis Qty';
    $new_fields[] = 'msil_dis_ser as MSIL Dis Ser %';
    $new_fields[] = 'dis_val as Dis Value';
    $where = "(order_no ='".$order_no."')";
    $this->db->select($new_fields);
    $this->db->from('view_spareparts_shipment_monitor');
    $this->db->where($where);
    $result = $this->db->get()->result_array();
        // echo $this->db->last_query();
    $total = count($result);

    if (count($result) > 0) {
        $success = true;
    } else {
        $success = false;
    }
    echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total, 'header_data'=>$header_data));
}

public function get_msil_order_list_json()
{
    $this->load->model('order_generates/order_generate_model');

    $this->db->group_by('final_order_no');
    $rows = $this->order_generate_model->findAll(NULL,'final_order_no');
    echo json_encode($rows);
}

public function generate_aging($type = NULL)
{
    if ($type==null) 
    {
        flashMsg('error', 'Invalid customer ID');
        redirect('admin/spareparts_report');  
    }

    $data['header']                 = lang('spareparts_report');
    $data['page']                   = $this->config->item('template_admin') . "msil_sparepart_aging";
    $data['module']                 = 'spareparts_report';
    $data['type']                   = $type;  
    $data['report_type']            = humanize(ucfirst($type));  

    $this->load->view($this->_container,$data);   
}

public function generate_aging_json()
{
    if($this->input->post('part_code'))
    {
        $part_id = $this->input->post('part_code');
    }
    // $segment = 6;
    $segment = $this->input->post('segment');
    // $days_interval = 30;
    $days_interval = $this->input->post('days_interval');
    $final_result = '';
    
/*
    if($this->input->post('part_code'))
    {
        $part_id = $this->input->post('part_code');
        $sql = <<<EOF
        SELECT
        generate_crosstab_sql_plain (
        $$ SELECT b.part_code,b.part_name, b.mst_part_id,b.date_ran,concat(b.remaining_quantity,' | ',b.price) FROM view_spareparts_msil_aging b where b.age <= {$segment} AND b.mst_part_id = {$part_id} GROUP BY 1,2,3,4,b.remaining_quantity,b.price ORDER BY b.date_ran $$,
        $$ SELECT distinct date_ran FROM view_spareparts_msil_aging ORDER BY date_ran $$,
        'TEXT',
        ' "Part Code" TEXT,"Part Name" TEXT, "Sparepart Id" TEXT') AS sqlstring                
EOF;
    }
    else
    {
        $part_id = $this->input->post('part_code');
        $sql = <<<EOF
        SELECT generate_crosstab_sql_plain ( 
        $$ SELECT b.part_code,b.part_name, b.mst_part_id, b.date_ran,concat(b.remaining_quantity,' | ',b.price) FROM view_spareparts_msil_aging b WHERE b.age <= {$segment} GROUP BY 1,2, 3, 4, b.remaining_quantity,b.price ORDER BY b.part_code $$, 
        $$ SELECT DISTINCT date_ran FROM view_spareparts_msil_aging ORDER BY date_ran $$, 
        'TEXT', '"Part Code" TEXT, "Sparepart Id" TEXT,"Part Name" Text' ) 
        AS sqlstring               
EOF;
    }*/
    if(is_sparepart_dealer())
    {
        $this->db->from('view_report_spareparts_dealer_aging');
        $this->db->where('dealer_id',$this->session->userdata('employee')['dealer_id']);
    }
    else
    {
        $this->db->from('view_spareparts_msil_aging');
    }
    $this->db->order_by('age asc');
    $result = $this->db->get()->result_array();

    $data['parts'] = $result;
    foreach ($result as $key => $value) 
    {
        $start_number = 0;
        for ($i=1; $i <= $segment; $i++) 
        {    
           $end_number = $days_interval * $i;
           if($value['age'] > $start_number && $value['age'] <= $end_number)
           {
            $final_result[$start_number."-".$end_number][$value['part_code']] = $value;
            break;           
           }
           $start_number = $end_number;
        }

    }
    
    if(is_sparepart_dealer())
    {
        $this->db->from('view_report_spareparts_dealer_aging');
        $this->db->where('dealer_id',$this->session->userdata('employee')['dealer_id']);
    }
    else
    {
        $this->db->from('view_spareparts_msil_aging');
    }
    $this->db->select('part_code,part_name');
    $this->db->group_by('part_code,part_name');
    $data['parts'] = $this->db->get()->result_array();

    $data['rows'] = $final_result;
    $this->load->view($this->config->item('template_admin') . "aging_table_view",$data);
    

}
    public function generate_msil_service_level($type = NULL)
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }

        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "msil_service_level";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);  
    }

    public function msil_service_level()
    {
        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));          
        }

        $fields[] = 'order_no as Order No';
        $fields[] = 'total_order_count as Order Line Item';
        $fields[] = 'total_dispatch_count as Dispatch Line Item';
        $fields[] = 'line_percentage as Line Percentage';
        $fields[] = 'total_order_quantity as Order Quantity';
        $fields[] = 'total_dispatch_quantity as Dispatch Quantity';
        $fields[] = 'quantity_percentage as Quantity Percentage';

        $this->db->select($fields);
        $this->db->from('view_report_spareparts_msil_service_level');
        if($this->input->post('date_range'))
        {
            $where = "reached_date >='".$date_range[0]."' AND reached_date <= '".$date_range[1]."'";
            $this->db->where($where);
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

    public function generate_msil_service_level_summary($type = NULL)
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }

        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "msil_service_level_summary";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);  
    }

    public function msil_service_level_summary()
    {
       $sql = <<<EOF
                    SELECT
                     generate_crosstab_sql_plain (
                      $$ SELECT order_no, order_quantity, total_dispatched_quantity,round(avg((total_dispatched_quantity::FLOAT * 100 / order_quantity))::numeric,2) as total_percentage, pick_level, round(SUM (msil_dis_ser)::NUMERIC,2) FROM view_spareparts_shipment_monitor GROUP BY 1, 2, 3,5,view_spareparts_shipment_monitor.order_number  ORDER BY view_spareparts_shipment_monitor.order_number  $$, 
                      $$ SELECT pick_level FROM view_spareparts_shipment_monitor GROUP BY 1 order by 1 $$, 
                      'FLOAT', '"Order Number" TEXT, "Order Quantity" INT, "Dispatched Quantity" INT, "Total Dispatched Percentage" Float'
                     ) AS sqlstring               
EOF;
        $res = $this->db->query($sql)->row_array();
        $result = $this->db->query($res['sqlstring'])->result();

        $total = count($result);

        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function generate_dealer_service_level_monitor($type = NULL)
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }

        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "dealer_service_level_summary";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);  
    }

    public function dealer_service_level_monitor()
    {
       $dealer_id = $this->input->post('dealer_id');

       $sql = <<<EOF
                    SELECT generate_crosstab_sql_plain ( $$ SELECT final_order_no, total_service_level_percentage, final_pickcount, service_level_percentage FROM view_report_spareparts_service_level_dealer WHERE dealer_id = {$dealer_id} GROUP BY 1, 2, 3, 4, order_no ORDER BY order_no $$, $$ SELECT final_pickcount FROM view_report_spareparts_service_level_dealer GROUP BY 1 ORDER BY 1 $$, 'FLOAT', '"Order Number" TEXT,"Total Service Level" FLOAT' ) AS sqlstring              
EOF;
        $res = $this->db->query($sql)->row_array();
        $result = $this->db->query($res['sqlstring'])->result();

        $total = count($result);

        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function generate_current_stock($type = NULL)
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }

        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "stock_report";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);  
    }

    public function current_stock_json()
    {     
        $nep_month = sprintf("%02d", $this->input->post('nep_month'));

        $fields[] = 'latest_part_code as Part Code';
        $fields[] = 'part_name as Part Name';
        $fields[] = 'opening_stock as Opening Stock';
        $fields[] = 'opening_stock_value as Opening Stock Value';
        $fields[] = 'total_msil_dispatched as Purchase';
        $fields[] = 'total_purchase_value as Purchase Value';
        $fields[] = 'total_dispatched as Sales';
        $fields[] = 'total_sales_value as Sales Value';
        $fields[] = 'closing_stock as Closing Stock';
        $fields[] = 'closing_stock_value as Closing Stock Value';

        $this->db->select($fields);
        $this->db->from('view_report_spareparts_product_in_out');
        $this->db->where('month_np',$nep_month);
        $result = $this->db->get()->result_array();
        $total = count($result);

        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function generate_categorywise_sales($type = NULL)
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }

        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "categorywise_sales";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);  
    }

    public function categorywise_sales_json()
    {     
        $where = '';
        if($this->input->post('category_part') || $this->input->post('date_range'))
        {
            $where .= "WHERE";
        }
        if($this->input->post('category_part'))
        {
            $category_id = $this->input->post('category_part');
            $where .= " category_id =".$category_id;
        }
        if($this->input->post('category_part') && $this->input->post('date_range'))
        {
            $where .= " AND ";
        }

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));          
            $where .= " (sds.dispatched_date >='".$date_range[0]."' AND sds.dispatched_date <= '".$date_range[1]."')";
        }

        if($where)
        {
            $sql = "SELECT msc.name as Category, ms.latest_part_code as Partcode, ms.name as Partname, Sum(sds.dispatched_quantity) as Totalsales FROM spareparts_dispatch_spareparts AS sds INNER JOIN spareparts_sparepart_order AS sos ON sds.order_id = sos.id INNER JOIN mst_spareparts AS ms ON sos.sparepart_id = ms.id INNER JOIN mst_spareparts_category AS msc ON ms.category_id = msc.id ".$where." GROUP BY 1,2,3";
        }
        else
        {
            $sql = "SELECT msc.name as Category, ms.latest_part_code as Partcode, ms.name as Partname, Sum(sds.dispatched_quantity) as Totalsales FROM spareparts_dispatch_spareparts AS sds INNER JOIN spareparts_sparepart_order AS sos ON sds.order_id = sos.id INNER JOIN mst_spareparts AS ms ON sos.sparepart_id = ms.id INNER JOIN mst_spareparts_category AS msc ON ms.category_id = msc.id GROUP BY 1,2,3";
        }

        $result = $this->db->query($sql)->result_array();

        $total = count($result);

        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }


    public function insert_opening_stock()
    {
        $this->load->model('sparepart_stocks/sparepart_stock_model');
        $this->load->model('opening_stocks/opening_stock_model');

        $date = date('Y-m-d');
        $date_np = get_nepali_date(date('Y-m-d'),'nep');
        $imp_nep_date = explode('-', $date_np);
        $data = $this->sparepart_stock_model->findAll();
        foreach ($data as $key => $value) 
        {
            $opening_stock[$key] = array(
            'sparepart_id' => $value->sparepart_id,
            'opening_stock_date' => $date,
            'opening_stock_date_np' => $date_np,
            'year_np' => $imp_nep_date[0],
            'month_np' => $imp_nep_date[1],
            'quantity' => $value->quantity
            ); 
        }

         $success = $this->opening_stock_model->insert_many($opening_stock);
         if($success)
         {
            echo 'Successfully inserted';
         }
         else
         {
            echo "Insert failed";
         }
       
    }

    public function generate_dealer_sales($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }
// Display Page
        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "dealer_sales_report";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);
    }

    public function dealer_sales_report()
    {
        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));          
        }

        $fields = array();
        $fields[] = 'part_name as Part Name';
        $fields[] = 'latest_part_code as Partcode';
        $fields[] = 'dealer_name as Dealer Name';
        $fields[] = 'quantity as Quantity';
        $fields[] = 'price as Price';
        $fields[] = 'taxable_total as Taxable Total';
        $fields[] = 'discount_amount as Discount';
        $fields[] = 'vat_amount as Vat Amount';
        $fields[] = 'total_amount as Total Amount';
      
        $this->db->select($fields);
        $this->db->from('view_report_spareparts_dealer_sales');
        if($this->input->post('date_range'))
        {
            $where = "date >='".$date_range[0]."' AND date <= '".$date_range[1]."'";
            $this->db->where($where);
        }
        $result = $this->db->get()->result_array();
            // echo $this->db->last_query();
        $total = count($result);

        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function generate_dealer_sales_category($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }
// Display Page
        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "dealer_category_sales";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);
    }

    public function dealer_sales_category_report()
    {
        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));          
        }

        $fields = array();
        $fields[] = 'category_name as category name';
        // $fields[] = 'latest_part_code as Partcode';
        $fields[] = 'dealer_name as dealer name';
        $fields[] = 'Sum(quantity) as quantity';
        // $fields[] = 'price as Price';
        $fields[] = 'Sum(taxable_total) as TaxableTotal';
        $fields[] = 'Sum(discount_amount) as Discount';
        $fields[] = 'Sum(vat_amount) as VatAmount';
        $fields[] = 'Sum(total_amount) as TotalAmount';
      
        $this->db->select($fields);
        $this->db->from('view_report_spareparts_dealer_sales');
        if($this->input->post('category_part'))
        {
            $category_id = $this->input->post('category_part');
            $this->db->where('category_id',$category_id);
        }

        if($this->input->post('date_range'))
        {
            $where = "date >='".$date_range[0]."' AND date <= '".$date_range[1]."'";
            $this->db->where($where);
        }

        $this->db->group_by('1,2');
        $result = $this->db->get()->result_array();
            // echo $this->db->last_query();
        $total = count($result);

        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

        public function generate_dealer_stock($type = null) 
    {
        if ($type==null) 
        {
            flashMsg('error', 'Invalid customer ID');
            redirect('admin/spareparts_report');  
        }
        $data['header']                 = lang('spareparts_report');
        $data['page']                   = $this->config->item('template_admin') . "dealer_stock";
        $data['module']                 = 'spareparts_report';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  

        $this->load->view($this->_container,$data);
    }

    public function get_dealer_stock_json()
    {
        if(is_sparepart_dealer())
        {
            $this->db->where('dealer_id',$this->session->userdata('employee')['dealer_id']);
        }
        else if(is_sparepart_dealer_incharge())
        {
            $this->db->where('incharge_id',$this->session->userdata('id'));
        }

        $fields[] = 'dealer_name as Dealer Name';
        $fields[] = 'part_code as Part Code';
        $fields[] = 'name as Name';
        $fields[] = 'display_quantity as Quantity';
        $fields[] = 'mrp_price as Price';
        $fields[] = '(display_quantity * mrp_price) as Value';
        

        $this->db->select($fields);
        $this->db->from('view_spareparts_all_dealer_stock');
        $this->db->where('deleted_at', NULL);
        $result = $this->db->get()->result_array();
        $total = count($result);

        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    public function get_dealer_stock_excel()
    {

        if(is_sparepart_dealer())
        {
            $this->db->where('dealer_id',$this->session->userdata('employee')['dealer_id']);
        }
        else if(is_sparepart_dealer_incharge())
        {
            $this->db->where('incharge_id',$this->session->userdata('id'));
        }

        $fields[] = 'dealer_name';
        $fields[] = 'part_code';
        $fields[] = 'name';
        $fields[] = 'display_quantity';
        $fields[] = 'mrp_price';
        $fields[] = '(display_quantity * mrp_price) as total';
        $fields[] = 'location';
        

        $this->db->select($fields);
        $this->db->from('view_spareparts_all_dealer_stock');
        $this->db->where('deleted_at', NULL);
        $result = $this->db->get()->result_array();

        // echo '<pre>'; print_r($result); 
        // exit;

        if($result)
        {
            $this->load->library('Excel');

            $objPHPExcel = new PHPExcel(); 
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->SetCellValue('A1','Dealer Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1','Part Code');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1','Part Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1','Location');
            $objPHPExcel->getActiveSheet()->SetCellValue('E1','Quantity');
            $objPHPExcel->getActiveSheet()->SetCellValue('F1','Price');
            $objPHPExcel->getActiveSheet()->SetCellValue('G1','VaLue');
            

            $row = 2;
            $col = 0; 
            foreach($result as $key => $values) 
            {      
                
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values['dealer_name']);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values['part_code']);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values['name']);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values['location']);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values['display_quantity']);
                $col++;
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values['mrp_price']);
                $col++;

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values['total']);
                
                $row++;
                $col = 0;
            }
            header("Pragma: public");
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment;filename=dealer_stock.xls");
            header("Content-Transfer-Encoding: binary ");
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            ob_end_clean();
            $objWriter->save('php://output');

            
        }
        redirect($_SERVER['HTTP_REFERER']);
        // echo '<pre>'; print_r($this->input->post()); exit;
        // $dealer_id = $this->input->post('dealer_id');

    }

    public function sales_register($json = NULL)
    {
        if($json == 'json') {

            $post = $this->input->post('selection');
            $dealerName = $this->input->post('name');
            $dealer = str_replace('-', ',', $dealerName);
            $post = explode(" - ", $post);
            $date_range = array();

            if($this->input->post('selection')) {
                $start_date =$post[0].' 00:00:00';
                    $end_date =$post[1].' 23:59:59';
                    $date_range = array($start_date,$end_date);
            }

            

            if(is_admin()){
                $where = '';
            }else if( is_service_advisor() || is_accountant() ) {
                if( !is_group(SPAREPART_EXECUTIVE) || is_accountant()  ){
                    $where = "jc.dealer_id = {$this->dealer_id}";
                }
            

            } else if(is_floor_supervisor()){
                $where = "jc.dealer_id = {$this->dealer_id}";
            } else if( is_service_head() || is_national_service_manager() || is_admin() ||  is_service_dealer_incharge()  || is_service_finance() ){
                $where = '';
        
            }else{
                $where = "jc.dealer_id = {$this->dealer_id}";
            }

            if( empty($date_range)){
                if(empty($dealer))
                {
                    $query = "SELECT
                        jc.issue_date,
                        jc.invoice_no,
                        jc.dealer_name,
                        jc.jobcard_group,
                        jc.jobcard_serial,
                        jc.vehicle_no,
                        jc.customer_name,
                        jc.vehicle_name || ' ' || jc.variant_name as vehicle,
                        jc.service_type_name,
                        jc.service_count,
                        jc.mechanic_name,
                        jc.partprice,
                        jc.accessprice,
                        jc.labourprice,
                        jc.other,
                        jc.oilprice,
                        jc.cash_discount_amt,
                        jc.vat_total,
                        jc.net_total,
                        jc.job_desc,
                        jc.part_name,
                        jc.localprice,
                        jc.mobile

                    FROM
                    view_job_summary_refined AS jc";
                }
                else
                {
                    $query = "SELECT
                        jc.issue_date,
                        jc.invoice_no,
                        jc.dealer_name,
                        jc.jobcard_group,
                        jc.jobcard_serial,
                        jc.vehicle_no,
                        jc.customer_name,
                        jc.vehicle_name || ' ' || jc.variant_name as vehicle,
                        jc.service_type_name,
                        jc.service_count,
                        jc.mechanic_name,
                        jc.partprice,
                        jc.accessprice,
                        jc.labourprice,
                        jc.other,
                        jc.oilprice,
                        jc.cash_discount_amt,
                        jc.vat_total,
                        jc.net_total,
                        jc.job_desc,
                        jc.part_name,
                        jc.localprice,
                        jc.mobile

                    FROM
                    view_job_summary_refined AS jc 
                    WHERE (jc.dealer_id IN ($dealer))";
                }
                
                
                $rows = $this->db->query($query)->result();
            //  echo $this->db->last_query();
            // exit();

            } else {

                $where = ($where != '')?"AND ".$where:'';
                if(empty($dealer))
                {
                    $query = "SELECT
                        jc.issue_date,
                        jc.invoice_no,
                        jc.dealer_name,
                        jc.jobcard_group,
                        jc.jobcard_serial,
                        jc.vehicle_no,
                        jc.customer_name,
                        jc.vehicle_name || ' ' || jc.variant_name as vehicle,
                        jc.service_type_name,
                        jc.service_count,
                        jc.mechanic_name,
                        jc.partprice,
                        jc.accessprice,
                        jc.labourprice,
                        jc.other,
                        jc.oilprice,
                        jc.cash_discount_amt,
                        jc.vat_total,
                        jc.net_total,
                        jc.job_desc,
                        jc.part_name,
                        jc.localprice,
                        jc.mobile

                    FROM
                    view_job_summary_refined AS jc
                    WHERE (jc.issue_date >= ? AND jc.issue_date <= ?) {$where}";
                }
                else
                {
                    $query = "SELECT
                        jc.issue_date,
                        jc.invoice_no,
                        jc.dealer_name,
                        jc.jobcard_group,
                        jc.jobcard_serial,
                        jc.vehicle_no,
                        jc.customer_name,
                        jc.vehicle_name || ' ' || jc.variant_name as vehicle,
                        jc.service_type_name,
                        jc.service_count,
                        jc.mechanic_name,
                        jc.partprice,
                        jc.accessprice,
                        jc.labourprice,
                        jc.other,
                        jc.oilprice,
                        jc.cash_discount_amt,
                        jc.vat_total,
                        jc.net_total,
                        jc.job_desc,
                        jc.part_name,
                        jc.localprice,
                        jc.mobile

                    FROM
                    view_job_summary_refined AS jc 
                    WHERE ((jc.dealer_id IN($dealer)) AND (jc.issue_date >= ? AND jc.issue_date <= ?)) {$where}";
                }
                
            
                $rows = $this->db->query($query, $date_range)->result();
            }
            
            echo json_encode(array('rows'=>$rows));
            exit;
        }
        
        // Display Page
        $data['header'] = lang('sales_register');
        $data['page'] = $this->config->item('template_admin') . "sales_register";
        $data['module'] = 'sparepart_report';
        $this->load->view($this->_container,$data); 

    }
}