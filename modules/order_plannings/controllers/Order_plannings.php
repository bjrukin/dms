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
 * Order_plannings
 *
 * Extends the Project_Controller class
 * 
 */

class Order_plannings extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Order Plannings');

        $this->load->model('order_plannings/order_planning_model');
        $this->lang->load('order_plannings/order_planning');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('order_plannings');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'order_plannings';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
            
            $this->order_planning_model->_table = 'vview_order_plannings';
		search_params();
		
		$total=$this->order_planning_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->order_planning_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->order_planning_model->insert($data);
        }
        else
        {
            $success=$this->order_planning_model->update($data['id'],$data);
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
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['varient'] = $this->input->post('varient');
		$data['color'] = $this->input->post('color');
		$data['code'] = $this->input->post('code');
		$data['dealer'] = $this->input->post('dealer');
		$data['year'] = $this->input->post('year');
		$data['month'] = $this->input->post('month');

        return $data;
   }
   public function read_file(){
//       $this->load->library('Excel');
//       echo 'here';
//       $objPHPExcel = PHPExcel_IOFactory::load("MyExcel.xlsx");
        $file = 'C:\xampp\htdocs\cg\modules\order_plannings\controllers\MyExcel.xlsx';//$_FILES['fileToUpload']['tmp_name'];
     $this->load->library('Excel');
     $objReader= PHPExcel_IOFactory::createReader('Excel2007');

     $objReader->setReadDataOnly(false);
          $objPHPExcel=$objReader->load($file); // error in this line
          echo '<pre>';print_r($objPHPExcel);
   }
}