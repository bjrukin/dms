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
 * Monthly_plannings
 *
 * Extends the Project_Controller class
 * 
 */
class Monthly_plannings extends Project_Controller {
    public function __construct() {
        parent::__construct();

        control('Monthly Plannings');

        $this->load->model('monthly_plannings/monthly_planning_model');
        $this->load->model('dispatch_records/dispatch_record_model');
        $this->lang->load('monthly_plannings/monthly_planning');
        $this->load->library('monthly_plannings/monthly_planning');
    }

    public function index() {
        // Display Page
        $data['header'] = lang('monthly_plannings');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'monthly_plannings';
        $this->load->view($this->_container, $data);
    }

    public function json() {
        $this->monthly_planning_model->_table = 'view_msil_monthly_plannings';
        search_params();

        $total = $this->monthly_planning_model->find_count();

        paging('id');

        search_params();

        $rows = $this->monthly_planning_model->findAll();

        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }

    public function save() {
        $data = $this->_get_posted_data(); //Retrive Posted Data

        if (!$this->input->post('id')) {
            $success = $this->monthly_planning_model->insert($data);
        } else {
            $success = $this->monthly_planning_model->update($data['id'], $data);
        }

        if ($success) {
            $success = TRUE;
            $msg = lang('general_success');
        } else {
            $success = FALSE;
            $msg = lang('general_failure');
        }

        echo json_encode(array('msg' => $msg, 'success' => $success));
        exit;
    }

    private function _get_posted_data() {
        $data = array();
        if ($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
        }
        // $data['created_by'] = $this->input->post('created_by');
        // $data['updated_by'] = $this->input->post('updated_by');
        // $data['deleted_by'] = $this->input->post('deleted_by');
        // $data['created_at'] = $this->input->post('created_at');
        // $data['updated_at'] = $this->input->post('updated_at');
        // $data['deleted_at'] = $this->input->post('deleted_at');
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['variant_id'] = $this->input->post('variant_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['dealer_id'] = $this->input->post('dealer_id');
        $data['quantity'] = $this->input->post('quantity');
        $data['year'] = $this->input->post('year');
        $data['month'] = $this->input->post('month');

        return $data;
    }
    function read_file() {
        $config['upload_path'] = './uploads/monthly_plannings';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/monthly_plannings/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];
//        $file = FCPATH . 'uploads/monthly_plannings/testvalidrecord34.xlsx'; //$_FILES['fileToUpload']['tmp_name'];
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line
        $index = array('vehicle_name', 'variant', 'color', 'dealer', 'month', 'year','quantity');
        $raw_data = array();
        $data = array();
        $view_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }

        echo $highestRow;
        foreach ($raw_data as $key => $value) {
            $this->db->select('id');
            $this->db->from('mst_vehicles');
            $this->db->where('name', $value['vehicle_name']);
            $vehicle = $this->db->get()->row_array();
            $data[$key]['vehicle_id'] = $vehicle['id'];
            $color = $this->db->from('mst_colors')->where('name', $value['color'])->get()->row_array();
            $data[$key]['color_id'] = $color['id'];
            $variant = $this->db->from('mst_variants')->where('name', $value['variant'])->get()->row_array();
            $data[$key]['variant_id'] = $variant['id'];
            $dealer = $this->db->from('dms_dealers')->where('name', $value['dealer'])->get()->row_array();
            $data[$key]['dealer_id'] = $dealer['id'];
            $data[$key]['month'] = $value['month'];
            $data[$key]['year'] = $value['year'];
            $data[$key]['created_by'] = $this->session->userdata('id');
            $data[$key]['created_at'] = date("Y-m-d H:i:s");
            $data[$key]['quantity'] = $value['quantity'];
        }

        $this->db->trans_start();
        $this->db->insert_batch('msil_monthly_plannings', $data); 

        echo $this->db->last_query();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'here error';
        } else {
            $this->db->trans_commit();
            echo 'success';
        }
        $referred_from = $this->session->userdata('referred_from');
        redirect($referred_from, 'refresh');
        $this->db->trans_complete();
    }


    public function generate_order(){
        $data['search'] = $this->input->post();
        $data['header'] = lang('msil_order_planning');
        $data['page'] = $this->config->item('template_admin') . "order";
        $data['module'] = 'monthly_plannings';
//        $data['rows'] = $this->order_json();
        $data['rows'] = $this->monthly_planning->get_order();
        
              // print_r($data['rows']);
        $data['records'] = array();
        $data['records'] = $this->get_stock_records();
//        print_r($data['records']);exit;
        $this->load->view($this->_container, $data);
        
    }
    public function order_json() {

        if($this->input->get('year')){
            $search['year'] = $this->input->get('year');
        }else{
            $search['year'] = date('Y');
        }
        if($this->input->get('month')){
            $search['month'] = $this->input->get('month');
        }else{
            $search['month'] = date('m');
        }
        
        $this->monthly_planning_model->_table = 'view_msil_monthly_orders';
        search_params();
        $this->db->where($search);
        $total = $this->monthly_planning_model->find_count();

//        paging('id');

        search_params();
        $this->db->where($search);
        $rows = $this->monthly_planning_model->findAll();


        /*monthly planning of 3months back*/
        if($this->input->get('year')){
            $search1['year'] = $this->input->get('year');
        }else{
            $search1['year'] = date('Y');
        }
        if($this->input->get('month')){
            $search1['month'] = ($this->input->get('month')-3);

        }else{
            $month = date('m');
            $search1['month'] = date('m', strtotime("-3 months"));
            if(date('m') < $search1['month']){
                $search1['year']--;
            }
//            $search1['month'] = strtotime($month . ' - 3 month');
        }
//var_dump($search1);exit;

        $this->db->where($search1);
        $data_before_threemonths = $this->monthly_planning_model->findAll();

        if($this->input->get('year')){
            $search2['year'] = $this->input->get('year');
        }else{
            $search2['year'] = date('Y');
        }
        if($this->input->get('month')){
            $search2['month'] = ($this->input->get('month')-1);
        }else{
            $search2['month'] = date('month');
        }

        $total_dispatched = $this->monthly_planning_model->get_Count($search2);

        //subracting total plan with dispatched vehicles
        foreach ($data_before_threemonths as  $key => &$value) {
            foreach ($total_dispatched as  $values) {
                if($value->vehicle_id == $values->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total - $values->total_dispatched;                    
                }
            }
        }

        foreach ($rows as  $key => &$value) {
            foreach ($data_before_threemonths as  $values) {
                if($value->vehicle_id == $values->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total + $values->total;                    
                }
            }
        }
//        return($rows);
        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }

    public function excel_export_msil_order()
    {

        $search['year'] = $this->input->post('export_year');
        $search['month'] = $this->input->post('export_month');

        $this->monthly_planning_model->_table = 'view_msil_orders';
        search_params();
        $this->db->where($search);
        $total = $this->monthly_planning_model->find_count();

        search_params();
        $this->db->where($search);
        $rows = $this->monthly_planning_model->findAll();

        /*monthly planning of 3months back*/

        $search1['year'] = $this->input->post('export_year');       
        $search1['month'] = ($this->input->post('export_month')-3);



        $this->db->where($search1);
        $data_before_threemonths = $this->monthly_planning_model->findAll();

        $search2['year'] = $this->input->post('export_year');      
        $search2['month'] = ($this->input->post('export_month')-1);        

        $total_dispatched = $this->monthly_planning_model->get_Count($search2);

        //subracting total plan with dispatched vehicles
        foreach ($data_before_threemonths as  $key => &$value) {
            foreach ($total_dispatched as  $values) {
                if($value->vehicle_id == $values->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total - $values->total_dispatched;                    
                }
            }
        }

        foreach ($rows as  $key => &$value) {
            foreach ($data_before_threemonths as  $values) {
                if($value->vehicle_id == $values->vehicle_id && $value->variant_id == $values->variant_id && $value->color_id == $values->color_id)
                {
                    $value->total = $value->total + $values->total;                    
                }
            }
        }  


        $color_code = $this->monthly_planning_model->get_Colors(); 

        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('MSIL Order Planning');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AQ1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1:AQ1')->getFill()->getStartColor()->setRGB('000000');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AQ1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
        $objPHPExcel->getActiveSheet()->getStyle('A1:AQ1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Country / PAN NO.')
        ->setCellValue('B1', 'Distributor Name/Code')
        ->setCellValue('C1', 'Model Code')
        ->setCellValue('D1', 'Description');

        $col = 4;
        $row = 1;
        $x = 'D';
        foreach ($color_code as $code) 
        {                      
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $code['code']);
            $col++;
            $x++;
        }   

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('AR1', 'TTL');

        $row = 1;
        $col = 0;            
        $vehicle_id = '';
        $variant_id ='';
        foreach($rows as $values) 
        {
            if(($values->vehicle_id == $vehicle_id && $values->variant_id == $variant_id))
            {
            }
            else
            {

                $row++;
            }
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'DF09087DA998');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 'GH5554-56HFF');
            $col++;           
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->vehicle_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->variant_name);
            $col++; 
            foreach ($color_code as $code) {
                if($values->color_code == $code['code'])
                {             
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->total);
                }
                $col++;                
                    // else{
                    //     $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 0);
                    //     $col++;
                    // }
            }
            $objPHPExcel->getActiveSheet()
            ->setCellValue(
                'AR'.$row,
                '=SUM(D'.$row.':'.$x.$row.')'
                ); 


            $col = 0;
            $vehicle_id = $values->vehicle_id;
            $variant_id = $values->variant_id;

        }

// Save Excel 2007 file
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=monthly_.xlsx");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        $objWriter->save('php://output');
    }
//    for stock record
    public function get_stock_records($date = NULL){
        if($date == NUll){
            $date = date('Y-m-d');
        }
//        for stock according to stockyard according to month
        $data['stock'] = $this->monthly_planning->get_monthly_stocks();
        $data['transit'] = $this->monthly_planning->get_monthly_transit_stocks();
        return $data;
    }
    public function generate_msil_report(){
        $data['search'] = $this->input->post();
        $data['header'] = lang('msil_order');
        $data['page'] = $this->config->item('template_admin') . "msil_order";
        $data['module'] = 'monthly_plannings';
        $data['type'] = 'msil_report';
        $data['default_col']            = '';
        $data['default_row']            = null;
        $data['report_type'] = 'MSIL Report';
        $data['rows'] = $this->monthly_planning->get_order();
        $data['records'] = array();
        $data['records'] = $this->get_stock_records();
        $this->load->view($this->_container, $data);
        
    }
    public function get_report($year = NULL)
    {
        $type = 'MSIL_report';
        $data['header']                 = 'MSIL Report';
        $data['page']                   = $this->config->item('template_admin') . "report";
        $data['module']                 = 'monthly_plannings';
        $data['type']                   = $type;  
        $data['report_type']            = humanize(ucfirst($type));  
        $data['default_col']            = '';
        $data['default_row']            = null;
        $this->load->view($this->_container,$data);
    }
    public function get_report_json($year = NULL)
    {
        if($year == NULL){
            $year = date('Y');
        }
        $where['year'] = $year;
        // for msil order
        $this->monthly_planning_model->_table = 'view_msil_monthly_plannings';
        $fields = 'vehicle_name AS Model, variant_name AS Variant, color_id AS Color_id, year AS Year, month AS Month, SUM(quantity) AS "ordered_quantity"';
        $this->db->group_by(array('vehicle_name','variant_name','color_id','year','month'));
        $msil_order = $this->monthly_planning_model->findAll($where,$fields);

        // for msil dispatch
        $this->monthly_planning_model->_table = 'view_msil_dispatch_records';
        $fields = 'vehicle_name AS Model, variant_name AS Variant, color_id AS Color_id, year AS Year, month AS Month, count(id) AS "dispatcched_quantity"';
        $this->db->group_by(array('vehicle_name','variant_name','color_id','year','month'));
        $msil_dispatch = $this->monthly_planning_model->findAll($where,$fields);

        $order_item = array();
        $dispatch_item = array();
        foreach($msil_order as $order){
            $order_item[$order->Month][$order->Model][$order->Variant][$order->Color_id] = $order->ordered_quantity;
        }
        foreach($msil_dispatch as $dispatch){
            $dispatch_item[$dispatch->Month][$dispatch->Model][$dispatch->Variant][$dispatch->Color_id] = $dispatch->dispatcched_quantity;
        }
        $this->monthly_planning_model->_table = 'view_dms_vehicles';
        $this->db->order_by('vehicle_name');
        $vehicles = $this->monthly_planning_model->get_all();
        $data['vehicle_records'] = array();
        foreach ($vehicles as $index => $row){
            // print_r($row);
            for($i = 1; $i <= 12; $i++){
                $total = 0;
                // echo $row->$i;
                if (key_exists($i, $order_item) && key_exists($row->vehicle_name, $order_item[$i]) && key_exists($row->variant_name, $order_item[$i][$row->vehicle_name]) && key_exists($row->color_id, $order_item[$i][$row->vehicle_name][$row->variant_name])) {
                    // echo $order_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                    $total = $order_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                };
                if (key_exists($i, $dispatch_item) && key_exists($row->vehicle_name, $dispatch_item[$i]) && key_exists($row->variant_name, $dispatch_item[$i][$row->vehicle_name]) && key_exists($row->color_id, $dispatch_item[$i][$row->vehicle_name][$row->variant_name])) {
                    // echo $order_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                    $total -= $dispatch_item[$i][$row->vehicle_name][$row->variant_name][$row->color_id];
                }
                // echo $total.'<br>';
                for($j = 0; $j < abs($total); $j++){
                    $vehicle_records[] = array('Model'=>$row->vehicle_name, 'Variant' => $row->variant_name, 'Color' => 'color_name','Month' => $i);
                }
            }
        }
        $result = $vehicle_records;
        $success = true;
        $total = 2;
        // echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
        $data['header'] = lang('msil_order');
        $data['page'] = $this->config->item('template_admin') . "msil_report";
        $data['module'] = 'monthly_plannings';
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
    }

    // upload msil order
    public function upload_order(){
        $index = array('vehicle_name','variant_name','color','month','year','quantity');
        $excel_data = $this->monthly_planning->read_file('uploads/monthly_order',$index,'msil_orders');

        foreach ($excel_data as $key => $value) {
            $this->db->select('id');
            $this->db->from('mst_vehicles');
            $this->db->where('name', $value['vehicle_name']);
            $vehicle = $this->db->get()->row_array();
            $data[$key]['vehicle_id'] = $vehicle['id'];

            $color = $this->db->from('mst_colors')->where('name', $value['color'])->get()->row_array();
            $data[$key]['color_id'] = $color['id'];
            
            $variant = $this->db->from('mst_variants')->where('name', $value['variant_name'])->get()->row_array();
            $data[$key]['variant_id'] = $variant['id'];
            
            $data[$key]['month'] = $value['month'];
            $data[$key]['year'] = $value['year'];
            $data[$key]['quantity'] = $value['quantity'];
        }
        if(count($data)){
            $this->db->trans_start();
            $this->monthly_planning_model->_table = 'msil_orders';
            $this->monthly_planning_model->insert_many($data); 

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            $this->db->trans_complete();
        }

        redirect('monthly_plannings/generate_order', 'refresh');
    }
}
