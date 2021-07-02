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
 * Dublicate_number_logs
 *
 * Extends the Project_Controller class
 * 
 */

class Dublicate_number_logs extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Dublicate Number Logs');

        $this->load->model('dublicate_number_logs/dublicate_number_log_model');
        $this->lang->load('dublicate_number_logs/dublicate_number_log');
    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('dublicate_number_logs');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'dublicate_number_logs';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$this->dublicate_number_log_model->_table = 'view_log_dublicate_numbers';

		search_params();
		$this->db->where('dublication_status',0);		
		
		$total=$this->dublicate_number_log_model->find_count();
		
		paging('id');
		
		search_params();
		$this->db->where('dublication_status',0);		
		
		$rows=$this->dublicate_number_log_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	public function bookedjson()
	{
		$this->dublicate_number_log_model->_table = 'view_log_dublicate_numbers';

		search_params();
		$this->db->where('dublication_status',1);
		$total=$this->dublicate_number_log_model->find_count();
		
		paging('id');
		
		search_params();
		$this->db->where('dublication_status',1);		
		$rows=$this->dublicate_number_log_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}
	public function documentJson()
	{
		$this->dublicate_number_log_model->_table = 'view_customer_dublicate_file_log';

		search_params();
		
		$total=$this->dublicate_number_log_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->dublicate_number_log_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function detail($id)
	{
		$this->lang->load('customers/customer');
		$this->load->library('customers/customer');
		if ($id==null) 
		{
			flashMsg('error', 'Invalid customer ID');
			redirect('admin/customers');  
		}

		$customer_info = $this->customer->get_customer($id);

		if ($customer_info == null) 
		{
			flashMsg('error', 'Invalid customer ID');
			redirect('admin/customers');            
		}
		$data['id'] = $id;

		$data['customer_info'] = $customer_info;
		$data['dealer_id'] = $this->dealer_id;

		$data['file'] = $this->db->where('customer_id',$id)->get('tbl_inquiry_uploaded_document')->row_array();
	
		/*if($data['customer_info']->dealer_id == 75 && $data['customer_info']->vehicle_id == 1 && $data['customer_info']->variant_id == 10)
		{
			$data['customer_info']->price = '1499000';
		}*/

		// Display Page
		$data['header'] = 'Customer Detail';
		$data['page'] = $this->config->item('template_admin') . "details";
		$data['module'] = 'dublicate_number_logs';

		$this->load->view($this->_container,$data);

	}
	public function print_docs($id){
		$data['file'] = $this->db->where('customer_id',$id)->get('tbl_inquiry_uploaded_document')->row_array();
		$data['header'] = 'Customer Detail';
		$data['page'] = $this->config->item('template_admin') . "print_document";
		$data['module'] = 'dublicate_number_logs';
		$this->load->view($this->_container,$data);
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
            $success=$this->dublicate_number_log_model->insert($data);
        }
        else
        {
            $success=$this->dublicate_number_log_model->update($data['id'],$data);
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
		$data['customer_name'] = $this->input->post('customer_name');
		$data['dealer_id'] = $this->input->post('dealer_id');
		$data['dublication_status'] = $this->input->post('dublication_status');
		$data['created_by'] = $this->input->post('created_by');
		$data['updated_by'] = $this->input->post('updated_by');
		$data['deleted_by'] = $this->input->post('deleted_by');
		$data['created_at'] = $this->input->post('created_at');
		$data['updated_at'] = $this->input->post('updated_at');
		$data['deleted_at'] = $this->input->post('deleted_at');
		$data['vehicle_id'] = $this->input->post('vehicle_id');
		$data['variant_id'] = $this->input->post('variant_id');
		$data['color_id'] = $this->input->post('color_id');

        return $data;
   }

    public function dublicate_number_report()
   	{
   		$where = null;
   		$date_range = $this->input->post('date_range');
   		if($date_range != '' || $date_range != null){
   			$date = explode(' - ', $date_range);
        	$where  = "created_at >= '".$date[0]."' AND created_at <= '".$date[1]."'";
   		}
   		$fields = [];
   		$fields[] = "customer_name AS Customer Name";
   		$fields[] = "mobile AS Contact Number";
   		$fields[] = "dealer_name AS Dealer";
   		$fields[] = "vehicle_name AS Model";
   		$fields[] = "variant_name AS Variant";
   		$fields[] = "color_name AS Color";
   		$fields[] = 'inquiry_date_en AS "Inquiry Date"';
   		$fields[] = "CASE WHEN (dublication_status = 0) THEN 'Inquiry' ELSE 'Booking' END AS \"Dublication Type\"";
		$this->dublicate_number_log_model->_table = 'view_log_dublicate_numbers';

		$result=$this->dublicate_number_log_model->findAll($where,$fields);
        $total = count($result);
        if (count($result) > 0) {
            $success = true;
        } else {
            $success = false;
        }
        echo json_encode(array('success' => $success, 'data' => $result, 'total'=> $total));
   		
   }
}