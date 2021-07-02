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
 * Ccd_smr_twentyone_days
 *
 * Extends the Project_Controller class
 * 
 */

class Ccd_smr_twentyone_days extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Ccd Smr Twentyone Days');

        $this->load->model('ccd_smr_twentyone_days/ccd_smr_twentyone_day_model');
        $this->lang->load('ccd_smr_twentyone_days/ccd_smr_twentyone_day');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('ccd_smr_twentyone_days');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'ccd_smr_twentyone_days';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->ccd_smr_twentyone_day_model->_table = 'view_ccd_smr_twentyone_days';
		search_params();
		$this->db->where('schedule_date <=',date('Y-m-d'));
		$total=$this->ccd_smr_twentyone_day_model->find_count();
		
		paging('vehicle_delivery_date','desc');
		
		search_params();
		$this->db->where('schedule_date <=',date('Y-m-d'));
		$rows=$this->ccd_smr_twentyone_day_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
		// echo '<pre>'; print_r($this->input->post()); exit;
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->ccd_smr_twentyone_day_model->insert($data);
        }
        else
        {
            $success=$this->ccd_smr_twentyone_day_model->update($data['id'],$data);
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
	 	$max_count = $this->ccd_smr_twentyone_day_model->find();
        $data['call_count'] = (($max_count->call_count)+1);
        $data['date_of_call'] = date('Y-m-d');
        $data['date_of_call_np'] = get_nepali_date($data['date_of_call'],'nep');
		// $data['customer_id'] = $this->input->post('customer_id');
		$data['call_status'] = $this->input->post('call_status');
		$data['appointment_taken'] = $this->input->post('appointment_taken');
		$data['appointment_date'] = NULL;
		if($data['appointment_taken'] && $data['appointment_taken'] == 'Yes'){
			$data['appointment_date'] = $this->input->post('appointment_date');
		}
		$data['call_type'] = $this->input->post('call_type');
		$data['false_reason'] = $this->input->post('false_reason');
		$data['remark'] = $this->input->post('remark');

        return $data;
   }


   public function report_export_smr_twentyone_days($value='')
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $where = array();
        if($start_date){
            $where['vehicle_delivery_date >='] = $start_date.' 00:00:00';
        }
        if($end_date){
            $where['vehicle_delivery_date <='] = $end_date.' 23:59:59';
        }

        $this->ccd_smr_twentyone_day_model->_table = "view_ccd_smr_twentyone_days";
        $data=$this->ccd_smr_twentyone_day_model->findAll($where);

        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Retail Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1','Color');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1','Engine No');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1','Chassis No');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1','Executive');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1','Dealer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1','Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1','Payment Mode');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1','Call Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1','Call Count');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1','False Reason');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1','Call Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1','Date of Call');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1','Appointment Taken');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1','Appointment Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1','Remark');

        $row = 2;
        // // $col = A;

        foreach ($data as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->vehicle_delivery_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->full_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->mobile_1);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->vehicle_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value->variant_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$value->color_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$value->engine_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$value->chass_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$value->executive_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$value->dealer_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$value->customer_type_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$value->payment_mode_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$value->call_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row,$value->call_count);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row,$value->false_reason);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row,$value->call_status);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row,$value->date_of_call);
            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row,$value->appointment_taken);
            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row,$value->appointment_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row,$value->remark);
            $row++;
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer smr_21days.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
        
        // exit;
    }
}