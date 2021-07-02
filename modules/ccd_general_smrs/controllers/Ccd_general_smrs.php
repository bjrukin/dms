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
 * Ccd_general_smrs
 *
 * Extends the Project_Controller class
 * 
 */

class Ccd_general_smrs extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();
    	control('Ccd General Smrs');
        $this->load->model('ccd_general_smrs/ccd_general_smr_model');
        $this->lang->load('ccd_general_smrs/ccd_general_smr');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('ccd_general_smrs');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'ccd_general_smrs';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->ccd_general_smr_model->_table = 'view_ccd_general_smr';
		search_params();
		$this->db->where('schedule_date <=',date('Y-m-d'));
		$total=$this->ccd_general_smr_model->find_count();
		paging('id');
		search_params();
		$this->db->where('schedule_date <=',date('Y-m-d'));
		$rows=$this->ccd_general_smr_model->findAll();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data
        if(!$this->input->post('id'))
        {
            $success=$this->ccd_general_smr_model->insert($data);
        }
        else
        {
            $success=$this->ccd_general_smr_model->update($data['id'],$data);
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
			$this->db->select("MAX('call_count') as call_count");
	 		$this->db->where('id',$data['id']);
	 		$this->db->group_by('id');
		 	$max_count = $this->ccd_general_smr_model->find();
	       	$data['call_count'] = (($max_count->call_count)+1);
		}
		// $data['customer_id'] = $this->input->post('customer_id');
		$data['call_status'] = $this->input->post('call_status');
		
		$data['date_of_call'] = date('Y-m-d');
        $data['date_of_call_np'] = get_nepali_date($data['date_of_call'],'nep');
	
		$data['appointment_taken'] = $this->input->post('appointment_taken');
		$data['appointment_date'] = $this->input->post('appointment_date')?$this->input->post('appointment_date'):NULL;
		$data['remark'] = $this->input->post('remark');
		
		$data['call_type'] = $this->input->post('call_type');
		$data['false_reason'] = $this->input->post('false_reason');
		
		
        return $data;
   }

    public function report_export_ccd_general_smr($value='')
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $where = array();
        if($start_date){
            $where['schedule_date >='] = $start_date;
        }
        if($end_date){
            $where['schedule_date <='] = $end_date;
        }

        $this->ccd_general_smr_model->_table = "view_ccd_general_smr";
        $data=$this->ccd_general_smr_model->findAll($where);
      

        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Closed Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Date of Call');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Date of Call Np');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1','Dealer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1','Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1','Registration No');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1','Engine No');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1','Chassis No');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1','Variant');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1','Color');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1','Call Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1','Call Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1','Call Count');
       
        $objPHPExcel->getActiveSheet()->SetCellValue('P1','Appointment Taken');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1','Appointment Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1','Schedule Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1','Remark');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1','False Reason');
     
     

        $row = 2;
        // $col = A;

        foreach ($data as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->closed_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->date_of_call);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->date_of_call_np);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->customer);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value->dealer_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$value->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$value->vehicle_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$value->vehicle_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$value->engine_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$value->chassis_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$value->variant_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$value->color_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$value->call_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row,$value->call_status);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row,$value->call_count);
            
           
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row,$value->appointment_taken);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row,$value->appointment_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row,$value->schedule_date);
            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row,$value->remark);
            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row,$value->false_reason);
           
      
     
            $row++;
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Ccd General Smr.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
        
        // exit;
    }
}