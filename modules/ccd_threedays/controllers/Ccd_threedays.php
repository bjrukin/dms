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
 * Ccd_threedays
 *
 * Extends the Project_Controller class
 * 
 */

class Ccd_threedays extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Ccd Threedays');

		$this->load->model('ccd_threedays/ccd_threeday_model');
		$this->lang->load('ccd_threedays/ccd_threeday');
	}

	public function index()
    {
        // Display Page
        $data['header'] = lang('ccd_threedays');
        $data['page'] = $this->config->item('template_admin') . "tab_index";
        $data['module'] = 'ccd_threedays';
        $this->load->view($this->_container,$data);
    }

    public function dashboard_index($days = NULL)
    {
        // Display Page
        $data['header'] = lang('ccd_threedays');
        $data['page'] = $this->config->item('template_admin') . "dashboard_index";
        $data['days'] = $days;
        $data['module'] = 'ccd_threedays';
        $this->load->view($this->_container,$data);
    }

    public function json($days = NULL, $type = NULL)
    {
      $this->ccd_threeday_model->_table = "view_ccd_threedays";

      search_params();

      if($type)
      {
        if($type == 'dashboard')
        {
            $this->db->where('call_status <>','Connected');
        }
    }
    if($days)
    {
        if($days == '3above')
        {
            $this->db->where('age >',intval($days));
        }
        else
        {
            $this->db->where('age',$days);
        }
    }
    $total=$this->ccd_threeday_model->find_count();

    paging('id');

    search_params();

    if($type)
    {
        if($type == 'dashboard')
        {
            $this->db->where('call_status <>','Connected');
        }
    }
    if($days)
    {
        if($days == '3above')
        {
            $this->db->where('age >',intval($days));
        }
        else
        {
            $this->db->where('age',$days);
        }
    }
    $rows=$this->ccd_threeday_model->findAll();
    // echo $this->db->last_query();
    echo json_encode(array('total'=>$total,'rows'=>$rows));
    exit;
}
public function save()
{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->ccd_threeday_model->insert($data);
        }
        else
        {
        	$success=$this->ccd_threeday_model->update($data['id'],$data);
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
    	$data['id'] = $this->input->post('id');
    	$this->db->select("MAX('call_count') as call_count");
    	$this->db->where('id',$data['id']);
    	$this->db->group_by('id');
    	$max_count = $this->ccd_threeday_model->find();
    	$data['call_count'] = (($max_count->call_count)+1);
    	$data['call_status'] = $this->input->post('call_status');
    	$data['date_of_call'] = date('Y-m-d');
    	$data['date_of_call_np'] = get_nepali_date($data['date_of_call'],'nep');
    	$data['delivered_on_time'] = ($this->input->post('delivered_on_time') != "Select option")?$this->input->post('delivered_on_time'):'';
    	$data['cleanliness_of_car'] = ($this->input->post('cleanliness_of_car') != "Select option")?$this->input->post('cleanliness_of_car'):'';
    	$data['basic_features'] = ($this->input->post('basic_features') != "Select option")?$this->input->post('basic_features'):'';
    	$data['owner_manual'] = ($this->input->post('owner_manual') != "Select option")?$this->input->post('owner_manual'):'';
    	$data['service_coupon'] = ($this->input->post('service_coupon') != "Select option")?$this->input->post('service_coupon'):'';
    	$data['warrenty_card'] = ($this->input->post('warrenty_card') != "Select option")?$this->input->post('warrenty_card'):'';
    	$data['delivery_sheet'] = ($this->input->post('delivery_sheet') != "Select option")?$this->input->post('delivery_sheet'):'';
    	$data['ccd_details'] = ($this->input->post('ccd_details') != "Select option")?$this->input->post('ccd_details'):'';
    	$data['remarks'] = ($this->input->post('remarks') != "Select option")?$this->input->post('remarks'):'';
        $data['voc'] = ($this->input->post('voc') != "Select option")?$this->input->post('voc'):'';
        $data['fit_and_finish'] = ($this->input->post('fit_and_finish') != "Select option")?$this->input->post('fit_and_finish'):'';
        $data['payment_receipt'] = ($this->input->post('payment_receipt') != "Select option")?$this->input->post('payment_receipt'):'';
        $data['tool_set'] = ($this->input->post('tool_set') != "Select option")?$this->input->post('tool_set'):'';
        $data['recommend_name1'] = $this->input->post('recommend_name1');
        $data['recommend_contact1'] = $this->input->post('recommend_contact1');
        $data['recommend_name2'] = $this->input->post('recommend_name2');
        $data['recommend_name2'] = $this->input->post('recommend_name2');
        $data['recommend_contact2'] = $this->input->post('recommend_contact2');
        $data['pss_score'] = $this->input->post('pss_score');
        $data['sss_score'] = $this->input->post('sss_score');
    	$data['total_score'] = $this->input->post('total_score');

    	return $data;
    }

    public function report_export($start_date = NULL, $end_date = NULL)
    {
        /*$result = $this->ccd_threeday_model->findAll();
        $success = TRUE;
        $total = count($result);
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));*/
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

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
        $where['retail_date >='] = $start_date;
        $where['retail_date <='] = $end_date;

        $this->ccd_threeday_model->_table = "view_ccd_threedays";
        $data = $this->ccd_threeday_model->findAll($where);
        
        // echo '<pre>';
        // print_r($data);

        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Retail Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1','Color');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1','Engine Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1','Chasis Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1','Dealer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1','Executive Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1','Date of Call');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1','Customer Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1','Payment Mode');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1','Exchange Make');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1','Call Count');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1','Call status');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1','Delivered On Time');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1','Cleanliness Of Car');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1','Fit And Finish');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1','Service Coupon');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1','Warrenty Card');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1','Owner Manual');
        $objPHPExcel->getActiveSheet()->SetCellValue('V1','Delivery Sheet');
        $objPHPExcel->getActiveSheet()->SetCellValue('W1','Tool Set');
        $objPHPExcel->getActiveSheet()->SetCellValue('X1','SSS');
        $objPHPExcel->getActiveSheet()->SetCellValue('Y1','PSS');
        $objPHPExcel->getActiveSheet()->SetCellValue('Z1','Total Score');
        $objPHPExcel->getActiveSheet()->SetCellValue('AA1','Remark');
        $objPHPExcel->getActiveSheet()->SetCellValue('AB1','VOC');

        $row = 2;
        // $col = A;
        // exit;

        foreach ($data as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->retail_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->full_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->mobile_1);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->model);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value->color_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$value->engine_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$value->chass_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$value->dealer_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$value->executive_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$value->date_of_call);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$value->customer_type_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$value->payment_mode_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$value->exchange_car_make);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row,$value->call_count);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row,$value->call_status);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row,$value->delivered_on_time);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row,$value->cleanliness_of_car);
            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row,$value->fit_and_finish);
            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row,$value->service_coupon);
            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row,$value->warrenty_card);
            $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row,$value->owner_manual);
            $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row,$value->delivery_sheet);
            $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row,$value->tool_set);
            $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row,$value->sss_score);
            $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row,$value->pss_score);
            $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row,$value->total_score);
            $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row,$value->remarks);
            $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row,$value->voc);
            $row++;
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer CCD_Thredays.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    
}