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
* Logistic Report
*
* Extends the Report_Controller class
* 
*/

class Logistic_reports extends Report_Controller
{
    public function __construct()
    {
        parent::__construct();

//control('CRM Reports');

        $this->lang->load('logistic_reports/logistic_report');
        $this->load->model('nepali_months/nepali_month_model');
        $this->load->model('city_places/city_place_model');
        $this->load->model('msil_orders/msil_order_model');
        $this->load->model('target_records/target_record_model');
        $this->load->model('sparepart_stocks/sparepart_stock_model');
        


    }

    public function index()
    {
        $data['header'] = lang('logistic_reports');
        $data['page'] = $this->config->item('template_admin') . "report_list";
        $data['module'] = 'logistic_reports';
        $data['type']   = 'LOGISTIC REPORT';  
        $this->load->view($this->_container,$data);
    }

    public function excel_sequence()
    {
        $data['header'] = lang('logistic_reports');
        $data['page'] = $this->config->item('template_admin') . "excel_formatter";
        $data['module'] = 'logistic_reports';
        $data['type']   = 'LOGISTIC REPORT';  
        $sql = <<<EOF
        SELECT
        generate_crosstab_sql_plain (
        $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, b.dealer_name, count(b.dealer_name) FROM view_dms_vehicles v LEFT JOIN view_report_monthwise_dispatch b on ((v.vehicle_id = b.vehicle_id AND v.variant_id = b.variant_id AND v.color_id = b.color_id) ) where v.deleted_at IS NULL GROUP BY 1,2,3,4,5,v.sequence ORDER BY v.sequence $$,
        $$ SELECT name as dealer_name from dms_dealers  $$,
        'INT',
        '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 
EOF;
        $res = $this->db->query($sql)->row_array();
        $data['result_sql'] = $this->db->query($res['sqlstring'])->result_array();
        // dd($data);
        $this->load->view($this->_container,$data);
    }

    public function organize_excel_report()
    {
        $excel_data = $this->input->post('excel');
        foreach ($excel_data as $key => $value) {
            $this->db->where('id',$value)->update('dms_vehicles', array('rank'=>$key + 1));
            
        }
        echo json_encode(array('success' => true ));
    }

    public function generate_dealer_billing($start_date = NULL, $end_date = NULL)
    {
       // print_r($start_date);
       // print_r($end_date);
       // exit;
        if($start_date == NULL)
        {
            $start_date = date('Y-m-d');
        }
        else
        {
            $start_date = str_replace("_","-",$start_date);            
        }
        if($end_date == NULL)
        {
            $end_date = date('Y-m-d');
        }
        else
        {
            $end_date = str_replace("_","-",$end_date);            
        }
        $sql = <<<EOF
        SELECT
        generate_crosstab_sql_plain (
        $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, b.dealer_name, count(b.dealer_name) FROM view_dms_vehicles v LEFT JOIN view_report_dealer_dispatch b on ((v.vehicle_id = b.vehicle_id AND v.variant_id = b.variant_id AND v.color_id = b.color_id) ) where b.dispatched_date >= '$start_date' AND b.dispatched_date <= '$end_date' AND v.deleted_at IS NULL GROUP BY 1,2,3,4,5,v.sequence ORDER BY v.sequence $$,
        $$ SELECT name as dealer_name from dms_dealers  $$,
        'INT',
        '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 
EOF;
        $res = $this->db->query($sql)->row_array();
        $result_sql = $this->db->query($res['sqlstring'])->result_array();

        $this->db->order_by('rank');
        $month = $this->nepali_month_model->findAll(NULL,array('name','rank'));

        $this->load->model('dealers/dealer_model');
        $this->db->order_by('name');
        $cities = $this->dealer_model->findAll(null,'name');


        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Dealer Billed');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Color');

        $row = 2;
        $col = 3;
        foreach ($cities as $key => $value) 
        {
            $currentColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
            $objPHPExcel->getActiveSheet()->getColumnDimension($currentColn)->setWidth(4);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->name);
            $col++;
        }

        $row = 3;
        $col = 0;
        foreach($result_sql as $key => $values) 
        {           
            $i = 0;
            foreach ($values as $k => $value) {
                if($i != 0){
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                    $col++;
                }
                $i = 1;

            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row, '=SUM(D'.$row.':BQ'.($row).')');
            $col = 0;
            $row++;      

        }
        $highestColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
        $objPHPExcel->getActiveSheet()->getStyle('D2:'.$highestColn.'2')->getAlignment()->setTextRotation(90);

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer Billing.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }


   public function generate_dealer_retail($start_date = NULL, $end_date = NULL)
    {
        if($start_date == NULL)
        {
            $start_date = date('Y-m-d');
        }
        else
        {
            $start_date = str_replace("_","-",$start_date);            
        }
        if($end_date == NULL)
        {
            $end_date = date('Y-m-d');
        }
        else
        {
            $end_date = str_replace("_","-",$end_date);            
        }
        $sql = <<<EOF
           SELECT generate_crosstab_sql_plain (
                $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, v.dealer_name, count(v.dealer_name) FROM  view_retail_report v  where v.vehicle_delivery_date >= '{$start_date}' and v.vehicle_delivery_date <= '{$end_date}' AND v.deleted_at IS NULL  GROUP BY 1,2,3,4,5 ORDER BY v.dealer_name $$,
                $$ SELECT name as dealer_name from dms_dealers ORDER BY 1 $$,
                'INT',
                '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 

EOF;
            $res = $this->db->query($sql)->row_array();
            $result_sql = $this->db->query($res['sqlstring'])->result_array();
// echo '<pre>'; print_r($result_sql); exit;

        $this->db->order_by('rank');
        $month = $this->nepali_month_model->findAll(NULL,array('name','rank'));

        $this->load->model('dealers/dealer_model');
        $this->db->order_by('name');
        $cities = $this->dealer_model->findAll(null,'name');


        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Dealer Retail');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Color');
  
        $row = 2;
        $col = 3;
        foreach ($cities as $key => $value) 
        {
            $currentColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
            $objPHPExcel->getActiveSheet()->getColumnDimension($currentColn)->setWidth(4);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->name);
            $col++;
        }

        $row = 3;
        $col = 0;
        foreach($result_sql as $key => $values) 
        {           
            $i = 0;
            foreach ($values as $k => $value) {
                if($i != 0){
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                    $col++;
                }
                $i = 1;

            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row, '=SUM(D'.$row.':BQ'.($row).')');
            $col = 0;
            $row++;      
           
        }
        $highestColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
        $objPHPExcel->getActiveSheet()->getStyle('D2:'.$highestColn.'2')->getAlignment()->setTextRotation(90);

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer Retail.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

     public function generate_dealer_stock($start_date = NULL, $end_date = NULL)
    {
        if($start_date == NULL)
        {
            $start_date = date('Y-m-d');
        }
        else
        {
            $start_date = str_replace("_","-",$start_date);            
        }
        if($end_date == NULL)
        {
            $end_date = date('Y-m-d');
        }
        else
        {
            $end_date = str_replace("_","-",$end_date);            
        }
//          $sql = <<<EOF
//             SELECT
//         generate_crosstab_sql_plain (
//         $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, b.dealer_name, count(b.dealer_name) FROM view_dms_vehicles v LEFT JOIN view_report_billing_stock_ec_list b on (v.vehicle_id = b.vehicle_id AND v.variant_id = b.variant_id AND v.color_id = b.color_id and current_status = 'Bill' and b.dealer_received_date >= '{$start_date}' and b.dealer_received_date <= '{$end_date}') where v.deleted_at IS NULL  GROUP BY 1,2,3,4,5,v.rank ORDER BY v.rank $$,
//         $$ SELECT name as dealer_name from dms_dealers ORDER BY 1 $$,
//         'INT',
//         '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 

// EOF;
        $sql = <<<EOF
            SELECT
        generate_crosstab_sql_plain (
        $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, v.dealer_name, count(v.dealer_name) FROM view_dealer_stock v  where v.dispatched_date >= '{$start_date}' and v.dispatched_date <= '{$end_date}' and (current_status = 'Bill' OR current_status='Domestic Transit') and v.deleted_at IS NULL  GROUP BY 1,2,3,4,5 ORDER BY v.dealer_name $$,
        $$ SELECT name as dealer_name from dms_dealers ORDER BY 1 $$,
        'INT',
        '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 

EOF;
            $res = $this->db->query($sql)->row_array();
            $result_sql = $this->db->query($res['sqlstring'])->result_array();

        $this->db->order_by('rank');
        $month = $this->nepali_month_model->findAll(NULL,array('name','rank'));

        $this->load->model('dealers/dealer_model');
        $this->db->order_by('name');
        $cities = $this->dealer_model->findAll(null,'name');


        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Dealer Stock');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Color');
  
        $row = 2;
        $col = 3;
        foreach ($cities as $key => $value) 
        {
            $currentColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
            $objPHPExcel->getActiveSheet()->getColumnDimension($currentColn)->setWidth(4);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->name);
            $col++;
        }

        $row = 3;
        $col = 0;
        foreach($result_sql as $key => $values) 
        {           
            $i = 0;
            foreach ($values as $k => $value) {
                if($i != 0){
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                    $col++;
                }
                $i = 1;

            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row, '=SUM(D'.$row.':BQ'.($row).')');
            $col = 0;
            $row++;      
           
        }
        $highestColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
        $objPHPExcel->getActiveSheet()->getStyle('D2:'.$highestColn.'2')->getAlignment()->setTextRotation(90);

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer Stock.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function generate_unplanned_order($start_date = NULL,$end_date = NULL)
    {
        $this->msil_order_model->_table = "view_report_msil_order";
        $rows = $this->msil_order_model->findAll(array('order_type'=>'Unplanned'));

        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);

        $style = array(
        'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
        );

        $objPHPExcel->getDefaultStyle()->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle("A1:N2")->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1','UNPLANNED REPORT');

        $objPHPExcel->getActiveSheet()->SetCellValue('A2','Vehicle Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Variant Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Color Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D2','Unplanned Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('E2','Year');
        $objPHPExcel->getActiveSheet()->SetCellValue('F2','Month');

        $row = 3;
        $col = 0;

        foreach($rows as $key => $values) 
        {   
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->vehicle_name);
            $col++;        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->variant_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->color_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->total_order_quantity);
            $col++;      
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->year);
            $col++;      
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->month);
            $col++;      
            $col = 0;
            $row++;        
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Unplanned Orde.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function generate_stock_summary($start_date = NULL,$end_date = NULL)
    {
        if($start_date == NULL)
        {
            $start_date = date('Y-m-d');
        }
        else
        {
            $start_date = str_replace("_","-",$start_date);            
        }
        if($end_date == NULL)
        {
            $end_date = date('Y-m-d');
        }
        else
        {
            $end_date = str_replace("_","-",$end_date);            
        }

        $ts1 = strtotime($start_date);
        $ts2 = strtotime($end_date);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $month = (($year2 - $year1) * 12) + ($month2 - $month1);

        $query0 =    "
                    SELECT
                    dms.vehicle_name,
                    dms.variant_name,
                    dms.color_name,
                    dms.color_code,
                    dms.vehicle_id,
                    dms.variant_id,
                    dms.color_id
                    FROM
                        view_dms_vehicles dms
                    WHERE
                    dms.deleted_at IS NULL
                    GROUP BY 
                    1,2,3,4,5,6,7
                    ORDER BY 
                    dms.vehicle_name
                    ";

        $query1 =    "
                    SELECT
                    dms.vehicle_id,
                    dms.variant_id,
                    dms.color_id,
                    count(mdr.id) as retail_quantity
                    FROM
                        view_dms_vehicles dms
                    LEFT JOIN msil_dispatch_records mdr ON mdr.variant_id = dms.variant_id AND mdr.color_id = dms.color_id AND mdr.vehicle_id = dms.vehicle_id AND mdr.current_status = 'retail' 
                    WHERE
                    mdr.dispatch_date >= '$start_date' AND mdr.dispatch_date <= '$end_date' AND dms.deleted_at IS NULL AND mdr.deleted_at IS NULL
                    GROUP BY 
                    dms.vehicle_id,
                    dms.color_id,
                    dms.variant_id
                    ";
        $query2 = "
                SELECT 
                count(mdr.id) as available_stock,
                dms.vehicle_id,
                dms.variant_id,
                dms.color_id
                FROM
                    view_dms_vehicles dms
                LEFT JOIN view_msil_cg_stock mdr ON mdr.variant_id = dms.variant_id AND mdr.color_id = dms.color_id AND mdr.vehicle_id = dms.vehicle_id AND  (mdr.current_status ='Stock' OR mdr.current_status = 'repaired stock' OR mdr.current_status='Custom' OR mdr.current_status = 'Transit' OR mdr.current_status='Display' OR mdr.current_status='damage')
                WHERE
                dms.deleted_at IS NULL AND mdr.deleted_at IS NULL
                GROUP BY 
                dms.vehicle_id,
                dms.color_id,
                dms.variant_id
              ";
       $query3 = "
                SELECT 
                sum(mdr.sum) as pending_quantity,
                dms.vehicle_id,
                dms.variant_id,
                dms.color_id
                FROM
                    view_dms_vehicles dms
                LEFT JOIN view_msil_grouped_pending_report mdr ON mdr.variant_id = dms.variant_id AND mdr.color_id = dms.color_id AND mdr.vehicle_id = dms.vehicle_id 
                WHERE dms.deleted_at IS NULL AND mdr.deleted_at IS NULL
                GROUP BY 
                dms.vehicle_id,
                dms.color_id,
                dms.variant_id
              ";
        $rows0 = $this->db->query($query0)->result();
        $rows0_array = json_decode(json_encode($rows0), true);
        $rows1 = $this->db->query($query1)->result();
        $rows1_array = json_decode(json_encode($rows1), true);
        $rows2 = $this->db->query($query2)->result();
        $rows2_array = json_decode(json_encode($rows2), true);
        $rows3 = $this->db->query($query3)->result();
        $rows3_array = json_decode(json_encode($rows3), true);

        foreach($rows0_array as $hi=>$value)
        {
            foreach($rows1_array as $key=>$value1)
            {
                foreach($value1 as $it=>$mouse)
                {
                    if(($rows0_array[$hi]['vehicle_id'] == $rows1_array[$key]['vehicle_id']) && ($rows0_array[$hi]['variant_id'] == $rows1_array[$key]['variant_id']) && ($rows0_array[$hi]['color_id'] == $rows1_array[$key]['color_id']))
                    {
                        $rows0_array[$hi][$it] = $mouse;
                    }
                }
            }
        }
        foreach($rows0_array as $hi=>$value)
        {
            foreach($rows2_array as $key=>$value2)
            {
                foreach($value2 as $it=>$mouse)
                {
                    if(($rows0_array[$hi]['vehicle_id'] == $rows2_array[$key]['vehicle_id']) && ($rows0_array[$hi]['variant_id'] == $rows2_array[$key]['variant_id']) && ($rows0_array[$hi]['color_id'] == $rows2_array[$key]['color_id']))
                    {
                        $rows0_array[$hi][$it] = $mouse;
                    }
                }
            }
        }
        foreach($rows0_array as $hi=>$value)
        {
            foreach($rows3_array as $key=>$value3)
            {
                foreach($value3 as $it=>$mouse)
                {
                    if(($rows0_array[$hi]['vehicle_id'] == $rows3_array[$key]['vehicle_id']) && ($rows0_array[$hi]['variant_id'] == $rows3_array[$key]['variant_id']) && ($rows0_array[$hi]['color_id'] == $rows3_array[$key]['color_id']))
                    {
                        $rows0_array[$hi][$it] = $mouse;
                    }
                }
                
            }
        }
        $rows0_array = json_decode(json_encode($rows0_array));
        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);

        $style = array(
        'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
        );

        $objPHPExcel->getDefaultStyle()->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle("A1:N2")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A1','STOCK SUMMARY');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Color');
        $objPHPExcel->getActiveSheet()->SetCellValue('D2','Color Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('E2','Pending Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('F2','Available Stock');
        $objPHPExcel->getActiveSheet()->SetCellValue('G2','Dealer Retail Average Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('H2','Month Stock (=Available Stock / Dealer retail average quantity)');

        $row = 3;
        $col = 0;
        foreach($rows0_array as $key => $values) 
        {   
            if($month != 0)
            {
                $month_average_retail = @$values->retail_quantity / $month;
            }
            else
            {
                 $month_average_retail = @$values->retail_quantity;
            }
            if($month_average_retail != 0)
            {
                $month_stock = @$values->available_stock / $month_average_retail;
            }
            else
            {
                $month_stock = @$values->available_stock;
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->vehicle_name);
            $col++;        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->variant_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->color_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->color_code);
            $col++;      
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->pending_quantity);
            $col++;    
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->available_stock);
            $col++;     
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $month_average_retail);
            $col++;     
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $month_stock);
            $col++;     
            $col = 0;
            $row++;        
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Stock Summary.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }


    public function generate_cg_stock($start_date = NULL, $end_date = NULL)
    {
        if($start_date == NULL)
        {
            $start_date = date('Y-m-d');
        }
        else
        {
            $start_date = str_replace("_","-",$start_date);            
        }
        if($end_date == NULL)
        {
            $end_date = date('Y-m-d');
        }
        else
        {
            $end_date = str_replace("_","-",$end_date);            
        }
//               $sql = <<<EOF
//            SELECT generate_crosstab_sql_plain (
//                 $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, b.current_location, count(b.current_location) FROM view_dms_vehicles v LEFT JOIN view_log_stock_record_working b on (v.vehicle_id = b.vehicle_id AND v.variant_id = b.variant_id AND v.color_id = b.color_id and (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit')) GROUP BY 1,2,3,4,5,v.rank ORDER BY v.rank $$,
//                 $$ SELECT current_location from view_log_stock_record_working where (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit') AND current_location IS NOT NULL group by 1 ORDER BY 1 $$,
//                 'INT',
//                 '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 
// EOF;

                $sql = <<<EOF
           SELECT generate_crosstab_sql_plain (
                $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, b.current_location, count(b.current_location) FROM view_log_stock_record_working b LEFT JOIN view_dms_vehicles v on (v.vehicle_id = b.vehicle_id AND v.variant_id = b.variant_id AND v.color_id = b.color_id and (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit')) GROUP BY 1,2,3,4,5,v.rank ORDER BY v.rank $$,
                $$ SELECT current_location from view_log_stock_record_working where (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit') AND current_location IS NOT NULL group by 1 ORDER BY 1 $$,
                'INT',
                '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 
EOF;

                
            $res = $this->db->query($sql)->row_array();
            $result_sql = $this->db->query($res['sqlstring'])->result_array();
      // exit;

        $this->db->order_by('rank');
        $month = $this->nepali_month_model->findAll(NULL,array('name','rank'));

        $this->load->model('dealers/dealer_model');
        // $this->db->order_by('name');
        // $cities = $this->dealer_model->findAll(null,'name');

        $this->dealer_model->_table  = "view_log_stock_record_working";
        $this->db->where("current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'Transit'");
        $this->db->group_by('current_location');
        $this->db->order_by('current_location');
        $stockyards = $this->dealer_model->findAll(null,'current_location');

        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Dealer Retail');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Color');
  
        $row = 2;
        $col = 3; 
        foreach ($stockyards as $key => $value) 
        {
            $currentColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
            $objPHPExcel->getActiveSheet()->getColumnDimension($currentColn)->setWidth(4);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->current_location);
            $col++;
        }

        $row = 3;
        $col = 0;
        foreach($result_sql as $key => $values) 
        {           
            $i = 0;
            foreach ($values as $k => $value) {
                if($i != 0){
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                    $col++;
                }
                $i = 1;

            }
            //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row, '=SUM(D'.$row.':L'.($row).')');
            $col = 0;
            $row++;      
           
        }
        $highestColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
        $objPHPExcel->getActiveSheet()->getStyle('D2:'.$highestColn.'2')->getAlignment()->setTextRotation(90);

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=CG Stock.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function generate_cg_vintage_stock($start_date = NULL, $end_date = NULL)
    {
        if($start_date == NULL)
        {
            $start_date = date('Y-m-d');
        }
        else
        {
            $start_date = str_replace("_","-",$start_date);            
        }
        if($end_date == NULL)
        {
            $end_date = date('Y-m-d');
        }
        else
        {
            $end_date = str_replace("_","-",$end_date);            
        }
         $sql = <<<EOF
           SELECT generate_crosstab_sql_plain (
                $$ SELECT v.id, v.vehicle_name, v.variant_name, v.color_name, b.year, count(b.year) FROM view_dms_vehicles v LEFT JOIN view_log_stock_record_working b on (v.vehicle_id = b.vehicle_id AND v.variant_id = b.variant_id AND v.color_id = b.color_id and (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_status = 'transit')) GROUP BY 1,2,3,4,5,v.rank ORDER BY v.rank $$,
                $$ SELECT year from view_log_stock_record_working where (current_status ='Stock' OR current_status = 'repaired stock' OR current_status='Custom' OR current_location = 'transit') group by 1 ORDER BY 1 $$,
                'INT',
                '"RANK" TEXT, "Model" TEXT, "Variant" TEXT,"Color" TEXT') AS sqlstring 
EOF;
            $res = $this->db->query($sql)->row_array();
            $result_sql = $this->db->query($res['sqlstring'])->result_array();


        $this->load->model('dealers/dealer_model');
        $this->dealer_model->_table = 'view_log_stock_record_working';
        $this->db->order_by('year');
        $this->db->group_by('year');
        $cities = $this->dealer_model->findAll(null,'year');


        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(16);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(32);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','CG Vintage Stock');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Color');
  
        $row = 2;
        $col = 3;
        foreach ($cities as $key => $value) 
        {
            $currentColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
            $objPHPExcel->getActiveSheet()->getColumnDimension($currentColn)->setWidth(4);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->year);
            $col++;
        }

        $row = 3;
        $col = 0;
        foreach($result_sql as $key => $values) 
        {           
            $i = 0;
            foreach ($values as $k => $value) {
                if($i != 0){
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                    $col++;
                }
                $i = 1;

            }
            // $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row, '=SUM(D'.$row.':AO'.($row).')');
            $col = 0;
            $row++;      
           
        }
        $highestColn = $objPHPExcel->getActiveSheet()->getHighestDataColumn();
        $objPHPExcel->getActiveSheet()->getStyle('D2:'.$highestColn.'2')->getAlignment()->setTextRotation(90);

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=CG Vintage Stock.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    //new report

    public function view_stock_spareparts()
    {
        // control('View Sparepart Stock');
        $data['header'] = lang('logistic_reports');
        $data['page'] = $this->config->item('template_admin') . "sparepart_stocks";
        $data['module'] = 'logistic_reports';
        $this->load->view($this->_container,$data);
    }

    public function view_stock_spareparts_json()
    {
        $partcode = $this->input->get('partcode');
        // $this->db->where()
        $field = [];
        $field[] =  "part_code";
        $field[] =  "name as part_name";
        $field[] =  "dealer_name";
        $field[] =  "quantity";
        $this->sparepart_stock_model->_table = 'view_spareparts_all_dealer_stock';
        $data = $this->sparepart_stock_model->findAll(array('part_code'=>$partcode),$field);
        $field = [];
        $field[] =  "part_code";
        $field[] =  "part_name";
        $field[] =  "quantity";
        $this->sparepart_stock_model->_table = 'view_sparepart_stock';
        $cg_stock = $this->sparepart_stock_model->findAll(array('part_code'=>$partcode),$field);
        if(!empty($cg_stock)){
            foreach ($cg_stock as $key => $value) {
                $cg_stock[$key]->dealer_name = 'Satungal Warehouse';
            }
            $data = array_merge($data,$cg_stock);
        }
        echo json_encode($data);
    }
}
