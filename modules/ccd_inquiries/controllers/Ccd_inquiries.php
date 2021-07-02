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
 * Ccd_inquiries
 *
 * Extends the Project_Controller class
 * 
 */


/*
	NOTE BEFORE CODE : 
	variables doesnot match with database

	please find the value below:
		sales_experience = immediate response;
		dse_attitude = behavior of salesman;
		dse_knowledge = enough time to explain your queries;
		offered_test_drive = offer you a test drive;
		warrenty_policy = explain you about post sales warranty and service policy;
*/

class Ccd_inquiries extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		//control('Ccd Inquiries');

		$this->load->model('ccd_inquiries/ccd_inquiry_model');
        $this->load->model('employees/employee_model');

		$this->lang->load('ccd_inquiries/ccd_inquiry');
	}

	public function index($source = NULL)
	{
		$data['source'] = NULL;
		// Display Page
		$data['header'] = lang('ccd_inquiries');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'ccd_inquiries';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$emp_id = $this->employee_model->find(array('user_id'=>$this->session->userdata('id')),'designation_id');

		$this->ccd_inquiry_model->_table = "view_ccd_inquiry";
		search_params();
		if($emp_id)
		{
			if($emp_id->designation_id == CCD_INQUIRY_GENERATED)
			{
				$this->db->where('source_id',2);
			}
			elseif($emp_id->designation_id == CCD_INQUIRY_WALK_REFERRAL)
			{
				$this->db->where('source_id <>',2);
			}

		}
		$total=$this->ccd_inquiry_model->find_count();
		
		paging('id');
		
		search_params();
		if($emp_id)
		{
			if($emp_id->designation_id == CCD_INQUIRY_GENERATED)
			{
				$this->db->where('source_id',2);
			}
			elseif($emp_id->designation_id == CCD_INQUIRY_WALK_REFERRAL)
			{
				$this->db->where('source_id <>',2);
			}

		}
		$rows=$this->ccd_inquiry_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        $success=$this->ccd_inquiry_model->update($data['id'],$data);

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
    	$max_count = $this->ccd_inquiry_model->find();

    	$data['date_of_call'] = date('Y-m-d');
    	$data['call_status'] = $this->input->post('call_status');
    	$data['date_of_call_np'] = get_nepali_date($data['date_of_call'],'nep');
    	$data['sales_experience'] = ($this->input->post('sales_experience')!='Select option')?$this->input->post('sales_experience'):'';
    	$data['dse_attitude'] = ($this->input->post('dse_attitude')!='Select option')?$this->input->post('dse_attitude'):'';
    	$data['dse_knowledge'] = ($this->input->post('dse_knowledge')!='Select option')?$this->input->post('dse_knowledge'):'';
    	$data['scheme_information'] = ($this->input->post('scheme_information')!='Select option')?$this->input->post('scheme_information'):'';
    	$data['retail_finanace'] = ($this->input->post('retail_finanace')!='Select option')?$this->input->post('retail_finanace'):'';
    	$data['offered_test_drive'] = ($this->input->post('offered_test_drive')!='Select option')?$this->input->post('offered_test_drive'):'';
    	$data['warrenty_policy'] = ($this->input->post('warrenty_policy')!='Select option')?$this->input->post('warrenty_policy'):'';
    	$data['service_policy'] = ($this->input->post('service_policy')!='Select option')?$this->input->post('service_policy'):'';
    	$data['remarks'] = ($this->input->post('remarks')!='Select option')?$this->input->post('remarks'):'';
    	$data['voc'] = $this->input->post('voc');
    	$data['call_count'] = (($max_count->call_count)+1);

    	return $data;
    }

    public function report_export_generated()
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $where = array();
        if($start_date){
            $where['inquiry_date_en >='] = $start_date;
        }
        if($end_date){
            $where['inquiry_date_en <='] = $end_date;
        }

        $emp_id = $this->employee_model->find(array('user_id'=>$this->session->userdata('id')),'designation_id');

        $this->ccd_inquiry_model->_table = "view_ccd_inquiry";
        
        
        // paging('id');
        
        
        $this->db->where('source_id',2);
            
        $data=$this->ccd_inquiry_model->findAll($where);

        // echo '<pre>';
        // print_r($data);
        // exit;

        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Inquiry_date');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Date of Call');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1','Dealer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1','Executive Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1','Customer Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1','Source');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1','Payment Mode');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1','Call Count');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1','Call Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1','Behavior of salesman');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1','Give enough time to explain your queries');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1','Explain post sales warranty and service policy');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1','Remark');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1','VOC');

        $row = 2;
        // $col = A;

        foreach ($data as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->inquiry_date_en);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->date_of_call);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->full_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->mobile_1);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value->model);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$value->dealer_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$value->executive_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$value->customer_type_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$value->source_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$value->payment_mode_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$value->call_count);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$value->call_status);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$value->dse_attitude);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row,$value->dse_knowledge);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row,$value->warrenty_policy);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row,$value->remarks);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row,$value->voc);
            $row++;
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer Ccd_Inquiries_Generated.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
        
        exit;
    }

    public function report_export_walkin($value='')
    {
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $where = array();
        if($start_date){
            $where['inquiry_date_en >='] = $start_date;
        }
        if($end_date){
            $where['inquiry_date_en <='] = $end_date;
        }

        $emp_id = $this->employee_model->find(array('user_id'=>$this->session->userdata('id')),'designation_id');

        $this->ccd_inquiry_model->_table = "view_ccd_inquiry";
        
        
        // paging('id');
        
        
                $this->db->where('source_id <>',2);
            
        $data=$this->ccd_inquiry_model->findAll($where);

        // echo '<pre>';
        // print_r($data);
        // exit;

        $this->load->library('Excel');


        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Inquiry Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Date of Call');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1','Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1','Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1','Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1','Dealer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1','Executive Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1','Customer Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1','Source');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1','Payment Mode');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1','Call Count');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1','Call Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1','Someone attend immediately');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1','Behavior of salesman');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1','Give enough time to explain your queries');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1','Offered Test Drive');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1','Explain post sales warranty and service policy');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1','Remark');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1','VOC');

        $row = 2;
        // $col = A;

        foreach ($data as $key => $value) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row,$value->inquiry_date_en);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row,$value->date_of_call);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row,$value->full_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row,$value->mobile_1);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row,$value->model);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row,$value->dealer_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row,$value->executive_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row,$value->customer_type_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row,$value->source_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row,$value->payment_mode_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row,$value->call_count);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row,$value->call_status);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row,$value->sales_experience);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row,$value->dse_attitude);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row,$value->dse_knowledge);
            $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row,$value->offered_test_drive);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row,$value->warrenty_policy);
            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row,$value->remarks);
            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row,$value->voc);
            $row++;
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Dealer Ccd_Inquiries_Walkin.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
        
        exit;
    }


    public function reports()
	{
		$data['header'] = 'Customer Care Depaetment Reports';
        $data['page'] = $this->config->item('template_admin') . "report_list";
        $data['module'] = 'ccd_inquiries';
        $this->load->view($this->_container,$data);
	}
}