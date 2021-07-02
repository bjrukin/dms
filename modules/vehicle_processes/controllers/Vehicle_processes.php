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
* Vehicle_processes
*
* Extends the Project_Controller class
* 
*/

class Vehicle_processes extends Project_Controller
{
    public function __construct()
    {
        parent::__construct();

        // control('Vehicle Processes');

        $this->load->model('vehicle_processes/vehicle_process_model');
        $this->load->model('city_places/city_place_model');
        $this->load->model('nepali_months/nepali_month_model');
        $this->load->model('target_records/target_record_model');

        $this->lang->load('vehicle_processes/vehicle_process');
    }

    public function index()
    {
// Display Page
        $data['header'] = lang('vehicle_processes');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'vehicle_processes';
        $this->load->view($this->_container,$data);
    }

    public function generate_report($type = null)
    {
// Display Page
        $data['header'] = lang('vehicle_processes');
        $data['page'] = $this->config->item('template_admin') . "secondary_sales";
        $data['module'] = 'vehicle_processes';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = '';
        $data['default_row']            = null;
        $this->load->view($this->_container,$data);
    }

    public function retail_generate_report($type = null)
    {
// Display Page
        $data['header'] = lang('vehicle_processes');
        $data['page'] = $this->config->item('template_admin') . "retail_billing";
        $data['module'] = 'vehicle_processes';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = '';
        $data['default_row']            = null;
        $this->load->view($this->_container,$data);
    }

    public function growth_rate_generate_report($type = null)
    {
        // Display Page
      $data['header'] = lang('vehicle_processes');
      $data['page'] = $this->config->item('template_admin') . "growth_rate";
      $data['module'] = 'vehicle_processes';
      $data['type']                   = $type;  
      $data['report_type']            = humanize(ucfirst($type));  
      $data['default_col']            = '';
      $data['default_row']            = null;
      $this->load->view($this->_container,$data);
  }
  
  public function target_achievement($type = null)
  {
// Display Page
    $data['header'] = lang('vehicle_processes');
    $data['page'] = $this->config->item('template_admin') . "target_achievement";
    $data['module'] = 'vehicle_processes';
    $data['type']                   = $type;  
    $data['report_type']            = humanize(ucfirst($type));  
    $data['default_col']            = '';
    $data['default_row']            = null;
    $this->load->view($this->_container,$data);
}

public function json()
{
    search_params();

    $total=$this->vehicle_process_model->find_count();

    paging('id');

    search_params();

    $rows=$this->vehicle_process_model->findAll();

    echo json_encode(array('total'=>$total,'rows'=>$rows));
    exit;
}

public function save()
{
$data=$this->_get_posted_data(); //Retrive Posted Data

if(!$this->input->post('id'))
{
    $success=$this->vehicle_process_model->insert($data);
}
else
{
    $success=$this->vehicle_process_model->update($data['id'],$data);
}

if($success)
{
    $success = TRUE;
    $msg=lang('general_success');
}
else
{
    $success = FALSE;
    $msg=lang('general_failure');
}

echo json_encode(array('msg'=>$msg,'success'=>$success));
exit;
}

private function _get_posted_data()
{
    $data=array();
    if($this->input->post('id')) {
        $data['id'] = $this->input->post('id');
    }
    $data['created_by'] = $this->input->post('created_by');
    $data['updated_by'] = $this->input->post('updated_by');
    $data['deleted_by'] = $this->input->post('deleted_by');
    $data['created_at'] = $this->input->post('created_at');
    $data['updated_at'] = $this->input->post('updated_at');
    $data['deleted_at'] = $this->input->post('deleted_at');
    $data['customer_id'] = $this->input->post('customer_id');
    $data['booked_date'] = $this->input->post('booked_date');
    $data['payment_mode'] = $this->input->post('payment_mode');
    $data['receipt_type'] = $this->input->post('receipt_type');
    $data['receipt_no'] = $this->input->post('receipt_no');
    $data['amount'] = $this->input->post('amount');
    $data['receipt_date'] = $this->input->post('receipt_date');
    $data['quotation_issue_flag'] = $this->input->post('quotation_issue_flag');
    $data['quotation_issue_date'] = $this->input->post('quotation_issue_date');
    $data['do_flag'] = $this->input->post('do_flag');
    $data['do_received_date'] = $this->input->post('do_received_date');
    $data['downpayment_flag'] = $this->input->post('downpayment_flag');
    $data['downpayment_date'] = $this->input->post('downpayment_date');
    $data['vehicle_delivered_flag'] = $this->input->post('vehicle_delivered_flag');
    $data['vehicle_delivery_date'] = $this->input->post('vehicle_delivery_date');
    $data['bluebook_received_flag'] = $this->input->post('bluebook_received_flag');
    $data['bluebook_received_date'] = $this->input->post('bluebook_received_date');
    $data['insurance_no'] = $this->input->post('insurance_no');
    $data['insurance_date'] = $this->input->post('insurance_date');
    $data['vat_bill_no'] = $this->input->post('vat_bill_no');
    $data['vat_bill_created_date'] = $this->input->post('vat_bill_created_date');

    return $data;
}

public function get_report_json() 
{
    $report_criteria_index = $this->input->post('report_criteria');

    $whereCondition = array();

    if ($report_criteria_index == 'primary_sales') 
    {

        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(dispatch_date >= '".$date_range[0]."' AND dispatch_date <= '".$date_range[1]."')";
            }
        }

        $report_criteria = array(
            'dbview'    => 'view_report_billing_stock_ec_list',
            'col'       => '',
            'label'     => 'Dealer',
            );

        $fields = array();
        $fields[] = 'vehicle_name AS "Model"';
        $fields[] = 'variant_name AS "Variant"';
        $fields[] = 'color_name AS "Color"';
        $fields[] = 'dealer_name AS "Dealer Name"';
        $fields[] = 'billing_date AS "Date(A.D.)"';
            // $fields[] = 'parent_name AS "Zone"';
            // $fields[] = 'month AS "Month"';
            // $fields[] = 'region_name AS "Region"';
         $whereCondition[] = "(current_status = 'bill' AND retail_date IS NULL)";   
    }

    if ($report_criteria_index == 'secondary_sales') 
    {
        if($this->input->post('date_range')) {
            $date_range = explode(" - ", $this->input->post('date_range'));
            if ($date_range[0] != null && $date_range[1] != null) {
                $whereCondition[] = "(created_date >= '".$date_range[0]."' AND created_date <= '".$date_range[1]."')";
            }
        }
        $report_criteria = array(
            'dbview'    => 'view_sales_report',
            'col'       => '',
            'label'     => 'Dealer',
            );

        $fields = array();
        $fields[] = 'vehicle_name AS "Model"';
        $fields[] = 'variant_name AS "Variant"';
        $fields[] = 'color_name AS "Color"';
        $fields[] = 'dealer_name AS "Dealer Name"';
        $fields[] = 'created_date AS "Date(A.D.)"';
        $fields[] = 'zone_name AS "Zone"';
        $fields[] = 'year AS "Year"';
        $fields[] = 'month AS "Month"';
        $fields[] = 'parent_name AS "Region"';

        $whereCondition[] = "(actual_status_rank = 15)";
    }

    extract($report_criteria);

    $this->db->select($fields);

    $this->db->from($report_criteria['dbview']);

    if (count($whereCondition) > 0) {
        $this->db->where(implode(" AND " , $whereCondition));
    }

    // if(isset($where))
    // {
    //     $this->db->where($where);
    // }
    $result = $this->db->get()->result_array();

    foreach ($result as $key => $value) 
    {
        $result[$key]['Date(B.S.)'] = get_nepali_date($value['Date(A.D.)'],'nepali');
    }

    $total = count($result);
    if (count($result) > 0) {
        $success = true;
    } else {
        $success = false;
    }
    echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
}

public function get_retail_billing_report_json() 
{
    $report_criteria_index = $this->input->post('report_criteria');

    $whereCondition = array();

    if($this->input->post('date_range')) {
        $date_range = explode(" - ", $this->input->post('date_range'));
        if ($date_range[0] != null && $date_range[1] != null) {
            $whereCondition[] = "(created_date >= '".$date_range[0]."' AND created_date <= '".$date_range[1]."')";
        }
    }
    $report_criteria = array(
        'dbview'    => 'view_sales_report',
        'col'       => '',
        'label'     => 'Dealer',
        );

    $fields = array();
    $fields[] = 'vehicle_name AS "Model"';
    $fields[] = 'variant_name AS "Variant"';
    $fields[] = 'color_name AS "Color"';
    $fields[] = 'dealer_name AS "Dealer Name"';
    $fields[] = 'created_date AS "Date(A.D.)"';
    $fields[] = 'month AS "Month"';
    $fields[] = 'district_name AS "District"';
    $fields[] = 'zone_name AS "Zone"';
    $fields[] = 'parent_name AS "Region"';

    $whereCondition[] = "(actual_status_rank = 15)";


    extract($report_criteria);

    $this->db->select($fields);

    $this->db->from($report_criteria['dbview']);

    if (count($whereCondition) > 0) {
        $this->db->where(implode(" AND " , $whereCondition));
    }

    $secondary_sales = $this->db->get()->result_array();



    if($this->input->post('date_range')) {
        $date_range = explode(" - ", $this->input->post('date_range'));
        if ($date_range[0] != null && $date_range[1] != null) {
            $whereCondition[] = "(dealer_dispatch_date >= '".$date_range[0]."' AND dealer_dispatch_date <= '".$date_range[1]."')";
        }
    }

    $report_criteria = array(
        'dbview'    => 'view_primary_sales_report',
        'col'       => '',
        'label'     => 'Dealer',
        );

    $fields = array();
    $fields[] = 'vehicle_name AS "Model"';
    $fields[] = 'name AS "Variant"';
    $fields[] = 'color_name AS "Color"';
    $fields[] = 'dealer_name AS "Dealer Name"';
    $fields[] = 'dealer_dispatch_date AS "Date(A.D.)"';
    $fields[] = 'month AS "Month"';
    $fields[] = 'district_name AS "District"';
    $fields[] = 'parent_name AS "Zone"';
    $fields[] = 'region_name AS "Region"';


    extract($report_criteria);

    $this->db->select($fields);

    $this->db->from($report_criteria['dbview']);

    $primary_sales = $this->db->get()->result_array();

    $result = array_merge_recursive($primary_sales,$secondary_sales);
    foreach ($result as $key => $value) 
    {
        $result[$key]['Date(B.S.)'] = get_nepali_date($value['Date(A.D.)'],'nepali');
    }

    $total = count($result);
    if (count($result) > 0) {
        $success = true;
    } else {
        $success = false;
    }
    echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
}

public function get_growth_report_json() 
{
    $report_criteria_index = $this->input->post('report_criteria');

    $whereCondition = array();

    list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();

    $report_criteria = array(
        'dbview'    => 'view_primary_sales_report',
        'col'       => '',
        'label'     => 'Dealer',
        );

    $fields = array();
    $fields[] = 'vehicle_name AS "Model"';
    $fields[] = 'name AS "Variant"';
    $fields[] = 'color_name AS "Color"';
    $fields[] = 'dealer_name AS "Dealer Name"';
    $fields[] = 'dealer_dispatch_date AS "Date(A.D.)"';
    $fields[] = 'month AS "Month"';
    $fields[] = 'year AS "Year"';
    $fields[] = 'district_name AS "District"';
    $fields[] = 'parent_name AS "Zone"';
    $fields[] = 'region_name AS "Region"';


    extract($report_criteria);

    $this->db->select($fields);

    $this->db->from($report_criteria['dbview']);

    if (count($whereCondition) > 0) {
        $this->db->where(implode(" AND " , $whereCondition));
    }

    $primary_sales = $this->db->get()->result_array();

    $report_criteria = array(
        'dbview'    => 'view_sales_report',
        'col'       => '',
        'label'     => 'Dealer',
        );

    $fields = array();
    $fields[] = 'vehicle_name AS "Model"';
    $fields[] = 'variant_name AS "Variant"';
    $fields[] = 'color_name AS "Color"';
    $fields[] = 'dealer_name AS "Dealer Name"';
    $fields[] = 'created_date AS "Date(A.D.)"';
    $fields[] = 'month AS "Month"';
    $fields[] = 'year AS "Year"';
    $fields[] = 'district_name AS "District"';
    $fields[] = 'zone_name AS "Zone"';
    $fields[] = 'parent_name AS "Region"';

    $whereCondition[] = "(actual_status_rank = 15)";
    $whereCondition[] = "(year =".($fiscal_year - 1).")";

    extract($report_criteria);

    $this->db->select($fields);

    $this->db->from($report_criteria['dbview']);

    if (count($whereCondition) > 0) {
        $this->db->where(implode(" AND " , $whereCondition));
    }

    $secondary_sales = $this->db->get()->result_array();

    $result = array_merge_recursive($primary_sales,$secondary_sales);

    foreach ($result as $key => $value) 
    {
        $result[$key]['Date(B.S.)'] = get_nepali_date($value['Date(A.D.)'],'nepali');
    }

    $total = count($result);
    if (count($result) > 0) {
        $success = true;
    } else {
        $success = false;
    }
    echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
}

// public function target_achievement()
// {
//     $result_sql = $this->db->query('SELECT * from crosstab(
//        $$ SELECT city_rank, city_name,month_name,total_target from view_report_dealer_target GROUP BY 1,2,3,4 ORDER BY 1$$,
//        $$ SELECT name as month_name FROM mst_nepali_month ORDER BY rank  $$
//        ) AS ("RANK" TEXT, "City" TEXT , "SHRAWAN" INT , "BHARDRA" INT , "ASHWIN" INT , "KARTHIK" INT , "MANGSHIR" INT , "POUSH" INT , "MAGH" INT , "FALGUN" INT , "CHAITRA" INT , "BAISHAK" INT , "JESTHA" INT , "ASHAD" INT)')->result_array();

//     $this->db->order_by('rank');
//     $month = $this->nepali_month_model->findAll(NULL,array('name','rank'));
//     $this->load->library('Excel');

//     $objPHPExcel = new PHPExcel(); 
//     $objPHPExcel->setActiveSheetIndex(0);

//     $row = 1;
//     $col = 1;
//     foreach ($month as $key => $value) 
//     {
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->name);
//         $col++;
//     }

//     $row = 2;
//     $col = 0;
//     foreach($result_sql as $key => $values) 
//     {           
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['City']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['SHRAWAN']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['BHARDRA']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['ASHWIN']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['KARTHIK']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['MANGSHIR']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['POUSH']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['MAGH']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['FALGUN']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['CHAITRA']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['BAISHAK']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['JESTHA']);
//         $col++;
//         $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['ASHAD']);
//         $col++;
//         $col = 0;
//         $row++;        
//     }
//     header("Pragma: public");
//     header("Content-Type: application/force-download");
//     header("Content-Disposition: attachment;filename=Bill.xls");
//     header("Content-Transfer-Encoding: binary ");
//     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//     ob_end_clean();
//     $objWriter->save('php://output');
// }

public function target_achievement_report()
{
    $year = $this->input->post('year');
    $month = $this->input->post('month');
    $this->target_record_model->_table = "view_final_target_vs_achievement";
    $this->db->order_by('city_rank','rank');
    $rows = $this->target_record_model->findAll(array('target_year'=>$year , 'month'=>$month));

    $this->load->library('Excel');

    $objPHPExcel = new PHPExcel(); 
    $objPHPExcel->setActiveSheetIndex(0);

    $style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );

    $objPHPExcel->getDefaultStyle()->applyFromArray($style);
    $objPHPExcel->getActiveSheet()->getStyle("A1:N3")->getFont()->setBold(true);

    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

    $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
    $objPHPExcel->getActiveSheet()->SetCellValue('A1','TARGET ACHIEVEMENT REPORT');

    $objPHPExcel->getActiveSheet()->mergeCells('C2:F2');
    $objPHPExcel->getActiveSheet()->mergeCells('G2:J2');
    $objPHPExcel->getActiveSheet()->mergeCells('K2:N2');
    $objPHPExcel->getActiveSheet()->SetCellValue('C2','Target');
    $objPHPExcel->getActiveSheet()->SetCellValue('G2','Retail');
    $objPHPExcel->getActiveSheet()->SetCellValue('K2','Variance');
    
    
    $objPHPExcel->getActiveSheet()->SetCellValue('A3','Dealer Location');
    $objPHPExcel->getActiveSheet()->SetCellValue('B3','Month');
    $objPHPExcel->getActiveSheet()->SetCellValue('C3','Target');
    $objPHPExcel->getActiveSheet()->SetCellValue('D3','Cumm Monthly Target');
    $objPHPExcel->getActiveSheet()->SetCellValue('E3','Quaterly Target');
    $objPHPExcel->getActiveSheet()->SetCellValue('F3','Cumm Year Target');
    $objPHPExcel->getActiveSheet()->SetCellValue('G3','Retail');
    $objPHPExcel->getActiveSheet()->SetCellValue('H3','Cumm Monthly Retail');
    $objPHPExcel->getActiveSheet()->SetCellValue('I3','Quaterly Retail');
    $objPHPExcel->getActiveSheet()->SetCellValue('J3','Cumm Yearly Retail');
    $objPHPExcel->getActiveSheet()->SetCellValue('K3','Month Var');
    $objPHPExcel->getActiveSheet()->SetCellValue('L3','Cumm Month Var');
    $objPHPExcel->getActiveSheet()->SetCellValue('M3','Quaterly Var');
    $objPHPExcel->getActiveSheet()->SetCellValue('N3','Cumm Yearly Var');

    $row = 4;
    $col = 0;

    foreach($rows as $key => $values) 
    {   
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->city_name);
        $col++;        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->month_name);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->total_target);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->cum_total);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->quaterly_target);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->yearly_target);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->total_retail);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->cum_total_retail);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->quaterly_dealer_retail);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->yearly_retail);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->total_target - $values->total_retail);
        $col++;     
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->cum_total - $values->cum_total_retail);
        $col++;       
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->quaterly_target - $values->quaterly_dealer_retail);
        $col++;
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->yearly_target - $values->yearly_retail);
        $col++;       
        $col = 0;
        $row++;        
    }

    header("Pragma: public");
    header("Content-Type: application/force-download");
    header("Content-Disposition: attachment;filename=Target_Achievement.xls");
    header("Content-Transfer-Encoding: binary ");
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    ob_end_clean();
    $objWriter->save('php://output');
}
}
