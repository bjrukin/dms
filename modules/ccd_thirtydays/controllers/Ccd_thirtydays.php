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
 * Ccd_thirtydays
 *
 * Extends the Project_Controller class
 * 
 */

class Ccd_thirtydays extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Ccd Thirtydays');

		$this->load->model('ccd_thirtydays/ccd_thirtyday_model');
		$this->lang->load('ccd_thirtydays/ccd_thirtyday');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('ccd_thirtydays');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'ccd_thirtydays';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->ccd_thirtyday_model->_table = "view_ccd_thirtydays";

		search_params();
		
		$total=$this->ccd_thirtyday_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->ccd_thirtyday_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->ccd_thirtyday_model->insert($data);
        }
        else
        {
        	$success=$this->ccd_thirtyday_model->update($data['id'],$data);
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
    	$max_count = $this->ccd_thirtyday_model->find();
        $data['call_count'] = (($max_count->call_count)+1);
    	$data['call_status'] = $this->input->post('call_status');
    	$data['date_of_call'] = date('Y-m-d');
        $data['date_of_call_np'] = get_nepali_date($data['date_of_call'],'nep');
    	$data['product_feedback'] = ($this->input->post('product_feedback') != 'Select option')?$this->input->post('product_feedback'):'';
    	$data['bluebook_copy'] = ($this->input->post('bluebook_copy') != 'Select option')?$this->input->post('bluebook_copy'):'';
    	$data['green_sticker'] = ($this->input->post('green_sticker') != 'Select option')?$this->input->post('green_sticker'):'';
    	$data['payment_receipts'] = $this->input->post('payment_receipts');
    	$data['recommend_name1'] = $this->input->post('recommend_name1');
    	$data['recommend_contact1'] = $this->input->post('recommend_contact1');
    	$data['recommend_name2'] = $this->input->post('recommend_name2');
    	$data['recommend_contact2'] = $this->input->post('recommend_contact2');
    	$data['recommend_name3'] = $this->input->post('recommend_name3');
    	$data['recommend_contact3'] = $this->input->post('recommend_contact3');
    	$data['remarks'] = $this->input->post('remarks');
        $data['voc'] = $this->input->post('voc');
        $data['registration_number'] = ($this->input->post('registration_number') != 'Select option')?$this->input->post('registration_number'):'';
        $data['call_for_service'] = ($this->input->post('call_for_service') != 'Select option')?$this->input->post('call_for_service'):'';
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
        
        $this->ccd_thirtyday_model->_table = "view_ccd_thirtydays";
        $data = $this->ccd_thirtyday_model->findAll($where);
        
        // echo '<pre>';
        // print_r($data);
        // exit;

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
        $objPHPExcel->getActiveSheet()->SetCellValue('O1','Call Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1','Bluebook Copy');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1','Green Sticker');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1','Registration Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1','Call For Service');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1','Total Score');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1','Remarks');
        $objPHPExcel->getActiveSheet()->SetCellValue('V1','VOC');

        $row = 2;
        // $col = A;

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
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row,$value->bluebook_copy);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row,$value->green_sticker);
            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row,$value->registration_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row,$value->call_for_service);
            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row,$value->total_score);
            $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row,$value->remarks);
            $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row,$value->voc);
            $row++;
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer CCD_Thirtydays.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }
}