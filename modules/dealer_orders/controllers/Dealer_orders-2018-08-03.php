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
* Dealer_orders
*
* Extends the Project_Controller class
* 
*/

class Dealer_orders extends Project_Controller
{
    protected $uploadPath = 'uploads';        
    public function __construct()
    {
        parent::__construct();

        //control('Dealer Orders');

        $this->load->model('dealer_orders/dealer_order_model');
        $this->load->model('stock_yards/Stock_yard_model');
        $this->load->model('dealers/Dealer_model');
        $this->load->model('stock_records/Stock_record_model');
        $this->load->model('dispatch_records/Dispatch_record_model');
        $this->load->model('dispatch_dealers/dispatch_dealer_model');
        $this->load->model('vehicles/Vehicle_model');
        $this->load->model('credit_control_decisions/credit_control_decision_model');
        $this->load->model('vehicle_returns/vehicle_return_model');
        $this->load->model('damages/damage_model');
        $this->lang->load('dealer_orders/dealer_order');
    }

    public function index()
    {
        control('Create Dealer Orders');

        if(is_showroom_incharge())
        {
            $dealer_id = $this->session->userdata('employee')['dealer_id'];
            $this->db->where('(id = '.$dealer_id.' AND district_id = 45) OR (id = '.$dealer_id.' AND district_id = 46) OR (id = '.$dealer_id.' AND district_id = 47)');
            $total=$this->dealer_model->find_count();
            $data['ktm_dealer'] = $total;

        }
        else
        {
            $data['ktm_dealer'] = null;
        }
// Display Page
        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }

    public function retail_request_incharge_index()
    {
        control('Order List by Dealer');
        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "retail_request_incharge_index";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }

    public function credit_control()
    {
// Display Page
        $data['cancel_count'] = $this->dealer_order_model->find_count(array('cancel_date <>'=> NULL , 'cancel_order_status'=>0,'credit_control_approval'=>1));

        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "credit_control";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }

    public function get_cancel_orders()
    {
        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "canceled_orders";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }

    public function retail_request_list()
    {
        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "retail_request_list";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }

    public function json()
    {
        $where = '1 = 1';
        $id = (string)$this->_user_id;         
        if(is_dealer_incharge())
        {
            $where = 'incharge_id ='.$id;
        }
        if(is_showroom_incharge())
        {
            $dealer_id = $this->session->userdata('employee')['dealer_id'];
            $where = "(created_by = '".$id."' OR dealer_id = '".$dealer_id."')";
        }

        $this->db->where($where);
        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';
        search_params();

        $total=$this->dealer_order_model->find_count(array('cancel_date_np'=>NULL,'is_ktm_dealer'=>0));

        paging('order_id');

        search_params();

        $this->db->where($where);
        $rows=$this->dealer_order_model->findAll(array('cancel_date_np'=>NULL,'is_ktm_dealer'=>0));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }
    
    public function retail_json()
    {
        $where = '1 = 1';
        $id = (string)$this->_user_id;         
        if(is_dealer_incharge())
        {
            $where = 'incharge_id ='.$id;
        }
        if(is_showroom_incharge())
        {
            $dealer_id = $this->session->userdata('employee')['dealer_id'];
            $where = "(created_by = '".$id."' OR dealer_id = '".$dealer_id."')";
        }

        $this->db->where($where);
        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';
        search_params();

        $total=$this->dealer_order_model->find_count(array('cancel_date_np'=>NULL,'is_ktm_dealer'=>1));

        paging('order_id');

        search_params();

        $this->db->where($where);
        $rows=$this->dealer_order_model->findAll(array('cancel_date_np'=>NULL,'is_ktm_dealer'=>1));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit; 
    }

    public function json_retail_request_list(){
        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';
        $where = '1 = 1';
        /*if(is_logistic_executive())
        {
            $where = '(in_stock_remarks = 1)';
        }*/
        search_params();
        $this->db->where($where);
        $total=$this->dealer_order_model->find_count(array('cancel_date'=>NULL,'(credit_control_approval = 1 OR credit_control_approval = 3)'=>NULL,'is_ktm_dealer'=>1));

        paging('id');

        search_params(); 
        $this->db->where($where);
        $rows=$this->dealer_order_model->findAll(array('cancel_date'=>NULL,'(credit_control_approval = 1 OR credit_control_approval = 3)'=>NULL,'is_ktm_dealer'=>1));

         // echo $this->db->last_query();

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function credit_control_json()
    {

        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';
        search_params();

        $total=$this->dealer_order_model->find_count(array('cancel_date_np'=>NULL));

        paging('order_id');

        search_params();

        $rows=$this->dealer_order_model->findAll(array('cancel_date_np'=>NULL));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_order_cancel_json()
    {
        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';
        search_params();

        $total=$this->dealer_order_model->find_count(array('cancel_date <>'=>NULL, 'cancel_order_status'=>0,'credit_control_approval'=>1));

        paging('order_id');

        search_params();

        $rows=$this->dealer_order_model->findAll(array('cancel_date <>'=>NULL, 'cancel_order_status'=>0,'credit_control_approval'=>1));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }
    
    public function daily_dispatch()
    {
        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "daily_dispatch";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }
    /*public function save()
    {
        $user_id = $this->session->userdata('id');
        $dealer_id = $this->session->userdata('employee')['dealer_id'];

        $this->db->select_max('order_id');
        $max_value = $this->db->get('log_dealer_order')->result_array();
        $data=$this->_get_posted_data();

        $data['order_id'] = $max_value[0]['order_id'] + 1;
        $data['dealer_id'] = $dealer_id;

        if($this->input->post('id'))
        {
            $order_id = $this->input->post('id');
            $this->db->where('order_id',$order_id);
            $this->db->delete('log_dealer_order');
        }

        for($i=1; $i <= $data['quantity'];$i++)
        {                
            $success=$this->dealer_order_model->insert($data);
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
*/
    /*public function save()
    {
        $user_id = $this->session->userdata('id');
        $dealer_id = $this->session->userdata('employee')['dealer_id'];

        $this->db->select_max('order_id');
        $max_value = $this->db->get('log_dealer_order')->result_array();
        $data=$this->_get_posted_data();

        $data['order_id'] = $max_value[0]['order_id'] + 1;
        $data['dealer_id'] = $dealer_id;

        if($this->input->post('id'))
        {
            $order_id = $this->input->post('id');
            $this->db->where('order_id',$order_id);
            $this->db->delete('log_dealer_order');
        }
        $this->db->where("(current_status <> 'Bill' OR current_status <> 'retail' OR current_status <> 'damage')");
        $current_stock_count = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$data['vehicle_id'],'variant_id'=>$data['variant_id'],'color_id'=>$data['color_id'],'year'=>$data['year']));
        $this->db->where('(vehicle_main_id IS NULL AND cancel_date IS NULL)');
        $current_order_count = $this->dealer_order_model->find_count(array('vehicle_id'=>$data['vehicle_id'],'variant_id'=>$data['variant_id'],'color_id'=>$data['color_id']));

        $actual_stock = $current_stock_count - $current_order_count ;

        for($i=1; $i <= $data['quantity'];$i++)
        {                
            if($actual_stock >= $i)
            {
                $data['in_stock_remarks'] = 1;
            }
            else
            {
                $data['in_stock_remarks'] = 0;
            }
            $success=$this->dealer_order_model->insert($data);
        }

        if($success)
        {
            $success = TRUE;
            $msg=lang('general_success');
        } else {
            $success = FALSE;
            $msg=lang('general_failure');
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }*/
    /*private function _get_posted_data()
    {
        $data=array();        
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['variant_id'] = $this->input->post('variant_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['quantity'] = 1;
        $data['year'] = $this->input->post('year');
        $data['date_of_order'] = date('Y-m-d');
        $data['order_month_id'] = $this->input->post('order_month');
        $data['payment_status'] = 1;
        $data['payment_method'] = $this->input->post('payment_method');
        $data['associated_value_payment'] = $this->input->post('associated_value_payment');

        return $data;
    }*/
    /*public function save()
    {
        $user_id = $this->session->userdata('id');
        $dealer_id = $this->session->userdata('employee')['dealer_id'];

        $this->db->select_max('order_id');
        $max_value = $this->db->get('log_dealer_order')->result_array();
        $data=$this->_get_posted_data();

        $data['order_id'] = $max_value[0]['order_id'] + 1;
        $data['dealer_id'] = $dealer_id;

        if($this->input->post('id'))
        {
            $order_id = $this->input->post('id');
            $this->db->where('order_id',$order_id);
            $this->db->delete('log_dealer_order');
        }
        $this->db->where("(current_status <> 'Bill' OR current_status <> 'retail' OR current_status <> 'damage')");
        $current_stock_count = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$data['vehicle_id'],'variant_id'=>$data['variant_id'],'color_id'=>$data['color_id'],'year'=>$data['year']));
        $this->db->where('(vehicle_main_id IS NULL AND cancel_date IS NULL)');
        $current_order_count = $this->dealer_order_model->find_count(array('vehicle_id'=>$data['vehicle_id'],'variant_id'=>$data['variant_id'],'color_id'=>$data['color_id']));

        $actual_stock = $current_stock_count - $current_order_count ;

        for($i=1; $i <= $data['quantity'];$i++)
        {                
            if($actual_stock >= $i)
            {
                $data['in_stock_remarks'] = 1;
            }
            else
            {
                $data['in_stock_remarks'] = 0;
            }
            $success=$this->dealer_order_model->insert($data);
        }

        if($success)
        {
            $success = TRUE;
            $msg=lang('general_success');
        } else {
            $success = FALSE;
            $msg=lang('general_failure');
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }
    
    private function _get_posted_data()
    {
        $data=array();        
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['variant_id'] = $this->input->post('variant_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['quantity'] = 1;
        $data['year'] = $this->input->post('year');
        $data['date_of_order'] = date('Y-m-d');
        $data['order_month_id'] = $this->input->post('order_month');
        $data['payment_status'] = 1;
        $data['payment_method'] = $this->input->post('payment_method');
        $data['associated_value_payment'] = $this->input->post('associated_value_payment');
        if($this->input->post('delivery_day'))
        {
            $data['delivery_day'] = $this->input->post('delivery_day'); 
            $Date = date('Y-m-d');
            $data['delivery_date'] = date('Y-m-d', strtotime($Date. ' + '.$data['delivery_day'].' days'));
            $data['stock_in_ktm'] = $this->input->post('in_stock_ktm');
        }

        return $data;
    }*/
    public function save()//dealer_order/
    {
        $user_id = $this->session->userdata('id');
        $dealer_id = $this->session->userdata('employee')['dealer_id'];

        $this->db->select_max('order_id');
        $max_value = $this->db->get('log_dealer_order')->result_array();
        $data=$this->_get_posted_data();

        $data['order_id'] = $max_value[0]['order_id'] + 1;
        $data['dealer_id'] = $dealer_id;
        $data['in_stock_remarks'] = $this->input->post('in_stock_remarks');

        if($this->input->post('id'))
        {
            $order_id = $this->input->post('id');
            $this->db->where('order_id',$order_id);
            $this->db->delete('log_dealer_order');
        }

        $success=$this->dealer_order_model->insert($data);
        

        if($success)
        {
            $success = TRUE;
            $msg=lang('general_success');
        } else {
            $success = FALSE;
            $msg=lang('general_failure');
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }

    private function _get_posted_data()
    {
        $data=array();        
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['variant_id'] = $this->input->post('variant_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['quantity'] = 1;
        $data['year'] = $this->input->post('year');
        $data['date_of_order'] = date('Y-m-d');
        $data['order_month_id'] = $this->input->post('order_month');
        $data['payment_status'] = 1;
        $data['payment_method'] = $this->input->post('payment_method');
        $data['associated_value_payment'] = $this->input->post('associated_value_payment');
        $data['is_ktm_dealer'] = $this->input->post('is_ktm_dealer');
        return $data;
    }

    public function save_challan()
    {
        $data['id'] = $this->input->post('dispatch_id');
        $data['received_date'] = $this->input->post('reveived_date_challan');
        $data['received_date_nep'] = get_nepali_date($this->input->post('reveived_date_challan'),'nep');
        $data['challan_return_image'] = $this->input->post('challan_image_name');
        $success = $this->dispatch_dealer_model->update($data['id'],$data);

        $vehicle_id = $this->input->post('msil_dispatch_id');
        $location = $this->input->post('dealer_name');
// $vehicle_detail = $this->stock_record_model->find(array('id'=>$data['id']));
        $this->change_current_location($vehicle_id, $location, 'Bill');

        if($success){
            echo json_encode(array('success'=>TRUE));
        }    
    }

    public function save_damage(){
        $data['id'] = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        // $data['vehicle_created_time'] = $this->input->post('vehicle_created_time');
        $data['chass_no'] = $this->input->post('chass_no');
        $data['description'] = $this->input->post('description');
        $data['vehicle_id'] = $this->input->post('vehicle_id');
        $data['repaired_by'] = $this->input->post('repaired_by');
        $data['repaired_at'] = $this->input->post('repaired_at');
        $data['image'] = $this->input->post('image');
        $data['service_center'] = $this->input->post('service_center');
        $data['amount'] = $this->input->post('amount');
        $data['estimated_date_of_repair'] = $this->input->post('estimated_date_of_repair');
        $success=$this->damage_model->update($data['id'],$data);
        if($success){
            echo json_encode(array('success'=>TRUE));
        }
    }

    public function dealer_incharge_index()
    {
        control('Order List by Dealer');
// Display Page
        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "dealer_incharge";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }

    public function json_dealer_incharge(){
        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';

        search_params();
        $total=$this->dealer_order_model->find_count(array('cancel_date'=>NULL,'(credit_control_approval = 1 OR credit_control_approval = 3)'=>NULL,'is_ktm_dealer'=>0));

        paging('id');

        search_params(); 
        $rows=$this->dealer_order_model->findAll(array('cancel_date'=>NULL,'(credit_control_approval = 1 OR credit_control_approval = 3)'=>NULL,'is_ktm_dealer'=>0));

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function detail_json(){
        $this->dealer_order_model->_table = 'view_orders_dispatch';
        if($this->input->post('id')){            
            $id = $this->input->post('id');
            $this->db->where('id',$id);
            $this->db->where('cancel_date',NULL);
        }
        else
        {
            $id = $this->input->post('order_id');
            $this->db->where('order_id',$id);
            $this->db->where('cancel_date',NULL);
        }
        $rows=$this->dealer_order_model->findAll();       
        echo json_encode($rows);
    }


    public function upload_image($type = NULL){
        if($this->input->get('type')){
            $type = $this->input->get('type');
        }
        if (!is_dir('./uploads/driver_docs/'))
        {
            @mkdir('./uploads/driver_docs/');

            $dir_exist = false;
        }

        $config['upload_path'] =  $this->uploadPath .'/driver_docs';
        $config['allowed_types'] = 'png|jpg';
        $config['max_size'] = '30720';
        $config['remove_spaces']  = true;
        $config['encrypt_name']  = true;
//load upload library
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('image_file'))
        {
            $data['error'] = $this->upload->display_errors('','');
            echo json_encode($data);
        }
        else
        {
            $data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];               
            $config['maintain_ratio'] = TRUE;
            $config['height'] =400;
            $config['width'] = 400;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
        }
    }
    public function upload_delete()
    {

        $id = $this->input->post('id');
        $filename = $this->input->post('filename');
        if($id)
        {
            $this->stock_model->update('STOCKS',array('image_name'=>''),array('id'=>$id));
        }
        @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/stock/'. $filename);
        @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/stock/thumb/'. $filename);
    }


    public function challan_upload_image($type = NULL){
        if($this->input->get('type')){
            $type = $this->input->get('type');
        }

        if (!is_dir('./uploads/challan_image/'))
        {
            @mkdir('./uploads/challan_image/');

            $dir_exist = false;
        }

        $config['upload_path'] =  $this->uploadPath .'/challan_image';                   

        $config['allowed_types'] = 'png|jpg';
        $config['max_size'] = '30720';
        $config['remove_spaces']  = true;
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('image_file'))
        {
            $data['error'] = $this->upload->display_errors('','');
            echo json_encode($data);
        }
        else
        {
            $data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];               
            $config['maintain_ratio'] = TRUE;
            $config['height'] =400;
            $config['width'] = 400;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize(); 
            echo json_encode(array('file_name'=>$data['file_name']));

        }
    }

    public function challan_upload_delete(){

        $id = $this->input->post('id');
        $filename = $this->input->post('filename');
        if($id)
        {
            $this->stock_model->update('STOCKS',array('image_name'=>''),array('id'=>$id));
        }
        @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/stock/'. $filename);
        @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/stock/thumb/'. $filename);
    }  

    public function get_nearest_stockyard()
    {
        $this->Stock_record_model->_table = 'view_log_stock_records';
        $order_id = $this->input->post('id');       
        $chassis_no = strtoupper($this->input->post('chassis_no'));
        $dealer_id = $this->input->post('dealer_id');
        $vehicle_id = $this->input->post('vehicle_id');
        $variant_id = $this->input->post('variant_id');
        $color_id = $this->input->post('color_id');
        $year = $this->input->post('year');


        $this->db->where('id',$dealer_id);
        $dealer = $this->Dealer_model->find();

        $this->db->like('chass_no',$chassis_no);
        $this->db->where('is_damage <>',1);
        $this->db->where('stock_yard_id <>',NULL);
        $this->db->where('mst_vehicle_id',$vehicle_id);
        $this->db->where('mst_variant_id',$variant_id);
        $this->db->where('mst_color_id',$color_id);
        $this->db->where('dispatch_to_dealer_date',NULL);
        $this->db->where('year',$year);
        $stockyard = $this->Stock_record_model->find(); 

        if(!empty($stockyard))

        {
            echo json_encode(array('stockyard'=>$stockyard->stock_yard, 'vehicle' => $stockyard, 'dealer'=>$dealer, 'result'=>1));
        }
        else
        {
            echo json_encode(array('result'=>0));
        }
    } 

    public function payment_method()
    {

        $id= $this->input->post('id');
        $data['payment_method'] = $this->input->post('payment_method');
        $data['associated_value_payment'] = $this->input->post('payment_associated_value');
        $data['payment_status'] = 1;

        $this->db->where('order_id',$id);
        $success = $this->db->update('log_dealer_order',$data);

        if($success)
        {
            echo json_encode(array('success'=>TRUE));
        }
    }

    public function save_display()
    {
        $data['id'] = $this->input->post('stock_id');
        $data['remarks'] = $this->input->post('remarks');
        $data['in_display'] = 1;
        $success = $this->Dispatch_record_model->update($data['id'],$data);
        if($success)
        {
            $dealer_name = $this->input->post('dealer_name');
            $vehicle_detail = $this->Stock_record_model->find(array('id'=>$data['id']));
            $this->change_current_location($vehicle_detail->vehicle_id,$dealer_name,'display');
            echo json_encode(array('success'=>TRUE));
        }
    }

    public function challan_damage_upload_image($type = NULL){
        if($this->input->get('type')){
            $type = $this->input->get('type');
        }

        if (!is_dir('./uploads/challan_damage/'))
        {
            @mkdir('./uploads/challan_damage/');

            $dir_exist = false;
        }

        $config['upload_path'] =  $this->uploadPath .'/challan_damage';                   

        $config['allowed_types'] = 'png|jpg';
        $config['max_size'] = '30720';
        $config['remove_spaces']  = true;
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('image_file'))
        {
            $data['error'] = $this->upload->display_errors('','');
            echo json_encode($data);
        }
        else
        {
            $data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];               
            $config['maintain_ratio'] = TRUE;
            $config['height'] =400;
            $config['width'] = 400;

            $this->load->library('image_lib', $config);
            $this->image_lib->resize(); 
            echo json_encode(array('file_name'=>$data['file_name']));
        }
    }

    public function challandamange_upload_delete(){
        $id = $this->input->post('id');
        $filename = $this->input->post('filename');
        if($id)
        {
            $this->stock_model->update('STOCKS',array('image'=>''),array('id'=>$id));
        }
        @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/challan_damage/'. $filename);
        @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/challan_damage/thumb/'. $filename);
    } 

    public function save_cancel_order()
    {
        $order_id = $this->input->post('id');

        $cancel['id'] =  $order_id;
        $cancel['cancel_date'] = date('Y-m-d');
        $cancel['cancel_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
        $success =  $this->dealer_order_model->update($cancel['id'],$cancel);
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

    public function save_credit_approve()
    {
        $order_id = $this->input->post('id');
        if($this->input->post('cc_decision') == 'On Hold')
        {
            $cc_approve = 3;
        }
        else if($this->input->post('cc_decision') == 'Ready For Dispatch')
        {
            $cc_approve = 1;
        }

        $data = array(
            'id'    =>  $order_id,
            'credit_control_approval' => $cc_approve,
            'credit_approve_date'=> date('Y-m-d'),
            'credit_approve_date_np'=> get_nepali_date(date('Y-m-d'),'nep'),
            'remarks' => $this->input->post('remarks_credit'),
            'on_hold_remarks' => $this->input->post('on_hold_remarks'),
            'payment_edit' => 2,
        );
        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $credit['order_id'] = $this->input->post('id');
            $credit['dealer_id'] = $this->input->post('dealer_id');
            $credit['status'] = $cc_approve;
            $credit['remarks'] = 'Credit Approved';
            $credit['date'] = date('Y-m-d');
            $credit['date_np'] = get_nepali_date(date('Y-m-d'),'nep');

            $this->credit_control_decision_model->insert($credit);

            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }

    public function save_credit_cancel()
    {
        $order_id = $this->input->post('cancel_id');
        $data = array(
            'id' => $order_id,
            'credit_control_approval' => 0,
            'credit_approve_date' => NULL,
            'credit_approve_date_np' => NULL,
            'remarks' => NULL
        );
        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $credit['deleted_by'] = $this->session->userdata('id');
            $credit['deleted_at'] = date('Y-m-d H:i:s');
            $this->db->where('order_id',$order_id);
            $this->db->update('sales_credit_control_decision',$credit);

            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));       
    }

    public function save_credit_reject()
    {
        $order_id = $this->input->post('id');
        $data = array(
            'id' => $order_id,
            'credit_control_approval' => 2,
            'credit_approve_date' => NULL,
            'credit_approve_date_np' => NULL
        );
        $success = $this->dealer_order_model->update($data['id'],$data);
        $credit['deleted_by'] = $this->session->userdata('id');
        $credit['deleted_at'] = date('Y-m-d H:i:s');
        $this->db->where('order_id',$order_id);
        $success = $this->db->update('sales_credit_control_decision',$credit);

        if($success)
        {
            $reject['order_id'] = $this->input->post('id');
            $reject['dealer_id'] = $this->input->post('dealer_id');
            $reject['status'] = 2;
            $reject['remarks'] = $this->input->post('remarks_credit');
            $reject['date'] = date('Y-m-d');
            $reject['date_np'] = get_nepali_date(date('Y-m-d'),'nep');

            $success = $this->credit_control_decision_model->insert($reject);
        }

        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }

    public function save_credit_edit()
    {
        $order_id = $this->input->post('id');
        if(is_showroom_incharge() || is_dealer_incharge())
        {
            $data = array(
                'id' => $order_id,
                'associated_value_payment' => $this->input->post('payment_value'),
                'payment_method' => $this->input->post('payment_method'), 
                'payment_edit_date' => date('Y-m-d'), 
                'payment_edit' => 1,
            );
        }
        else
        {
            $data = array(
                'id' => $order_id,
                'associated_value_payment' => $this->input->post('payment_value'),
                'payment_method' => $this->input->post('payment_method'), 
            );
        }
        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }

    /*public function save_grn_add()
    {
        $data['id'] = $this->input->post('order_id');
        $data['grn_received_date'] = date('Y-m-d');
        $data['grn_received_date_np'] = get_nepali_date(date('Y-m-d'),'nep');

        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }*/

    public function save_cancel_dispatch()
    {
       $dispatch_id = $this->input->post('dispatch_id');
       $vehicle = $this->Stock_record_model->find(array('id'=>$this->input->post('stock_id')),'vehicle_id');
       $data['stock_id'] = $this->input->post('stock_id');
       $data['dealer_id'] = $this->input->post('dealer_id');
       $data['return_stockyard_id'] = $this->input->post('stockyard_id');
       $data['remarks'] = $this->input->post('reason');
       $data['vehicle_id'] = $vehicle->vehicle_id;
       $data['date'] = date('Y-m-d');
       $data['date_np'] = get_nepali_date(date('Y-m-d'),'nep');
       $success = $this->vehicle_return_model->insert($data); // Insert in vehicle return table

       if($success)
       {
        $this->db->where('id',$dispatch_id);
            $success = $this->db->delete('log_dispatch_dealer'); // Delete from dispatch_dealer Table
        }

        if($success)
        {
            $stock['id'] = $data['stock_id'];
            $stock['dispatch_id'] = NULL;
            $success = $this->Stock_record_model->update($stock['id'],$stock); // Remove link from stock 
        }

        if($success)
        {
            $this->Stock_record_model->_table = 'mst_stock_yards';
            $location = $this->Stock_record_model->find(array('id'=>$data['return_stockyard_id']),'name');
            $success = $this->change_current_location($vehicle->vehicle_id,$location->name,'Stock');
        }
        
        if($success)
        {
            $order['id'] = $this->input->post('order_id');
            $order['vehicle_main_id'] = NULL;
            $success = $this->dealer_order_model->update($order['id'],$order);
        }

        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }

    public function save_cancel_payment()
    {
        $order_id = $this->input->post('order_id');
        $data = array(
            'id' => $order_id,
            'payment_status' => 0,
            'payment_method' => NULL,
            'associated_value_payment' => NULL
        ); 
        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }
    public function check_stock_availability()//dealer_order/admin
    {
        $vehicle_id = $this->input->post('vehicle_id');
        $variant_id = $this->input->post('variant_id');
        $color_id   = $this->input->post('color_id');
        $mfg_year   = $this->input->post('year');
        $dealer_id = $this->session->userdata('employee')['dealer_id'];
        $is_ktm_dealer   = $this->input->post('is_ktm_dealer');

        $this->db->where('(vehicle_main_id IS NULL AND cancel_date IS NULL AND credit_control_approval = 1 AND (in_stock_remarks = 1 OR in_stock_remarks = 2))');
        $current_order_count = $this->dealer_order_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=> $mfg_year));

        $current_stock_count_out_of_ktm = 0;
        $transit_not = 0;

        if($is_ktm_dealer == 1)
        {
        // Check KTM Stock
            $this->db->where('current_location','KATHMANDU');
            $this->db->where('current_status','Stock');
            $current_stock_count_ktm = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));            
            
            // Check Outside KTM Stock
            if($current_stock_count_ktm - $current_order_count <= 0)
            {
                $this->db->where('current_location <>','KATHMANDU');
                $this->db->where('current_status','Stock');
                $current_stock_count_out_of_ktm = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));
            }
            // Check Transit
            if($current_stock_count_ktm + $current_stock_count_out_of_ktm - $current_order_count <= 0)
            {
                $this->db->where('current_status','Transit');
                $transit_not = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));
            }

            if(($current_stock_count_ktm - $current_order_count) > 0)
            {
                $success = 'instock';
            }
            else if(($current_stock_count_ktm + $current_stock_count_out_of_ktm - $current_order_count) > 0)
            {
                $success = 'outside_ktm';
            }
            else if( $current_stock_count_ktm + $current_stock_count_out_of_ktm + $transit_not - $current_order_count > 0 )
            {
                $success = 'transit';
            }
            else
            {
                $success = 'out_of_stock';
            }
        }
        else
        {
            $this->db->where('current_location <>','KATHMANDU');
            $this->db->where('current_status','Stock');
            $current_stock_count = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));
            
           /* if($current_stock_count - $current_order_count <= 0)
            {
                $this->db->where('current_status','Stock');
                $current_stock_count_out_of_ktm = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));
            }*/

            if($current_stock_count - $current_order_count <= 0)
            {
                $this->db->where('current_status','Transit');
                $transit_not = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));
            }

            if($current_stock_count - $current_order_count > 0)
            {
                $success = 'instock';
            }
            elseif( $current_stock_count + $transit_not - $current_order_count > 0 )
            {
                $success = 'transit';
            }
            else
            {
                $success = 'out_of_stock';
            }
        }

        echo json_encode(array('success'=>$success));
    }

    public function check_ktm_stock_available()
    {
        $vehicle_id = $this->input->post('vehicle_id');
        $variant_id = $this->input->post('variant_id');
        $color_id   = $this->input->post('color_id');
        $mfg_year   = $this->input->post('year');
        if($this->input->post('delivery_week'))
        {
            $delivery_week = $this->input->post('delivery_week');
            $this->db->where('current_location','KATHMANDU');
        }
        $this->db->where("(current_status <> 'Bill' OR current_status <> 'retail' OR current_status <> 'damage')"); $current_stock_count = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));

        $this->db->where('(vehicle_main_id IS NULL AND cancel_date IS NULL AND in_stock_remarks = 1)');
        $current_order_count = $this->dealer_order_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id));

        $actual_stock = $current_stock_count - $current_order_count ;

        if($actual_stock >=1)
        {
            $success = TRUE;
        }
        else
        {
            $success = FALSE;
        }
        echo json_encode(array('success'=>$success));
    }

    /*public function check_stock_availability()
    {
        $vehicle_id = $this->input->post('vehicle_id');
        $variant_id = $this->input->post('variant_id');
        $color_id   = $this->input->post('color_id');
        $mfg_year   = $this->input->post('year');

        $this->db->where("(current_status <> 'Bill' OR current_status <> 'retail' OR current_status <> 'damage')");
        $current_stock_count = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));

        $this->db->where('(vehicle_main_id IS NULL AND cancel_date IS NULL AND in_stock_remarks = 1)');
        $current_order_count = $this->dealer_order_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id));

        $actual_stock = $current_stock_count - $current_order_count ;

        if($actual_stock >=1)
        {
            $success = TRUE;
        }
        else
        {
            $success = FALSE;
        }
        echo json_encode(array('success'=>$success));
    }*/

    public function view_damage_details()
    {
        $dispatch_id = $this->input->post('dispatch_id');

        $rows = $this->damage_model->find(array('dispatch_id'=>$dispatch_id));

        echo json_encode($rows);
    }

    public function generate_daily_dispatch()
    {
        $this->dealer_order_model->_table = "view_dealer_dispatch_request";
        $this->db->where('credit_control_ageing <>', NULL);
        $this->db->where('dispatch_id',NULL);
        $this->db->where('daily_dispatch_ageing >= 1',NULL);
        $this->db->order_by('daily_dispatch_ageing');
        
        //search_params();
        $order = $this->dealer_order_model->findAll();

        $this->Stock_record_model->_table = "view_master_log_stock_record";
        $stock_id_array = NULL;

        foreach ($order as $key => $value) 
        {
            $this->db->where_not_in('id',$stock_id_array);
            $this->db->where('vehicle_id',$value->vehicle_id);
            $this->db->where('variant_id',$value->variant_id);
            $this->db->where('color_id',$value->color_id);
            $this->db->where('current_status <>','Domestic Transit');
            $this->db->where('current_status <>','Bill');
            $this->db->where('current_status <>','damage');

           // search_params();
            $stock[$key] = $this->Stock_record_model->find();
            if($stock[$key])
            {
                $stock[$key]->order_id = $value->order_id;
                $stock[$key]->order_no = $value->id;
                $stock_id_array[] = $stock[$key]->id;
            }
        }
        
        $stock = array_filter($stock);

        /*foreach ($stock as $key => $value) 
        {

            paging('id');

            search_params(); 
            $rows=$this->dealer_order_model->findAll(array('id'=>$value->order_no));
        }
        echo json_encode(array('total'=>$total,'rows'=>$rows));*/
        $sum = 0;
        foreach ($stock as $key => $value) 
        {
            search_params();
            $total=$this->dealer_order_model->find_count(array('id'=>$value->order_no));
            $sum = $sum + $total;

            search_params();
            $available_order[] = $this->dealer_order_model->find(array('id'=>$value->order_no));
        }
        
        $available_order = array_filter($available_order);
        $i = 0;
        foreach ($available_order as $key => $value) {
            $available_order_new[$i] = $value;
            $i++;
        }
        echo json_encode(array('total'=>$sum,'rows'=>$available_order_new));
    }

    public function upload_grn_file($type = NULL){
        if($this->input->get('type')){
            $type = $this->input->get('type');
        }

        if (!is_dir('./uploads/grn_file/'))
        {
            @mkdir('./uploads/grn_file/');

            $dir_exist = false;
        }

        $config['upload_path'] =  $this->uploadPath .'/grn_file';                   

        $config['allowed_types'] = 'pdf|png|jpg';
        $config['max_size'] = '30720';
        $config['remove_spaces']  = true;
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('file_name'))
        {
            $data['error'] = $this->upload->display_errors('','');
            echo json_encode($data);
        }
        else
        {
            $data = $this->upload->data();
            echo json_encode(array('file_name'=>$data['file_name']));
        }
    }

    public function save_grn_add()
    {
        $data['id'] = $this->input->post('order_id');
        $data['grn_file'] = $this->input->post('grn_upload_filename');
        $data['grn_received_date'] = date('Y-m-d');
        $data['grn_received_date_np'] = get_nepali_date(date('Y-m-d'),'nep');

        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }
    
    public function save_color_change()
    {
        $data['id'] = $this->input->post('color_order_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['color_change_date'] = date('Y-m-d');
        $data['color_change_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
        $quantity = 1;
        if($this->input->post('id'))
        {
            $order_id = $this->input->post('id');
            $this->db->where('order_id',$order_id);
            $this->db->delete('log_dealer_order');
        }
        $this->db->where("(current_status <> 'Bill' OR current_status <> 'retail' OR current_status <> 'damage')");
        $current_stock_count = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$this->input->post('vehicle_id'),'variant_id'=>$this->input->post('variant_id'),'color_id'=>$this->input->post('color_id'),'year'=>$this->input->post('year')));
        $this->db->where('(vehicle_main_id IS NULL AND cancel_date IS NULL)');
        $current_order_count = $this->dealer_order_model->find_count(array('vehicle_id'=>$this->input->post('vehicle_id'),'variant_id'=>$this->input->post('variant_id'),'color_id'=>$this->input->post('color_id')));

        $actual_stock = $current_stock_count - $current_order_count ;

        for($i=1; $i <= $quantity;$i++)
        {                
            if($actual_stock >= $i)
            {
                $data['in_stock_remarks'] = 1;
            }
            else
            {
                $data['in_stock_remarks'] = 0;
            }
        }

        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }
    public function save_edit_dispatch_month()
    {
        $data['id'] = $this->input->post('edit_dispatch_id');
        $data['dispatched_date'] = $this->input->post('dispatch_date');
        $data['dispatched_date_np'] = get_nepali_date($data['dispatched_date'],'true');
        $dates_np = explode('-', $data['dispatched_date_np']);
        $data['dispatched_date_np_month'] = ltrim($dates_np[1], '0');
        if($this->input->post('dispatch_month'))
        {
            $data['edit_month_np'] = $this->input->post('dispatch_month');
        }
        else
        {
            $data['edit_month_np'] = ltrim($dates_np[1], '0');
        }

        if($this->input->post('edit_dispatch_year'))
        {
            $data['dispatched_date_np_year'] = $this->input->post('edit_dispatch_year');
        }
        else
        {
            $data['dispatched_date_np_year'] = $dates_np[0];
        }
        
        $success = $this->dispatch_dealer_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }
    
    /*public function save_edit_dispatch_month()
    {
        $data['id'] = $this->input->post('edit_dispatch_id');
        $data['dispatched_date_np_month'] = $this->input->post('dispatch_month');
        $data['dispatched_date_np_year'] = $this->input->post('edit_dispatch_year');
        $success = $this->dispatch_dealer_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }*/

    public function change_grn_upload_status()
    {
        $data['id'] = $this->input->post('id');
        $data['grn_allow_status'] = 1;
        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));   
    }

    public function change_order_cancel_status()
    {
        $data['id'] = $this->input->post('id');
        $data['cancel_order_status'] = 1;
        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));
    }

    public function save_logistic_confirmation()
    {
        $data['id'] = $this->input->post('order_id');
        $data['logistic_confirmation_date'] = $this->input->post('logistic_confirmation_date');
        $data['logistic_confirmation_date_np'] = get_nepali_date($data['logistic_confirmation_date'],'np');
        $success = $this->dealer_order_model->update($data['id'],$data);
        if($success)
        {
            $success = true;
            $msg=lang('general_success');
        }
        else
        {
            $success = false;
            $msg=lang('general_failure');
        }
        echo json_encode(array('msg'=>$msg,'success'=>$success));  
    }
}
