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

        control('Dealer Orders');

        $this->load->model('dealer_orders/dealer_order_model');
        $this->load->model('stock_yards/Stock_yard_model');
        $this->load->model('dealers/Dealer_model');
        $this->load->model('stock_records/Stock_record_model');
        $this->load->model('dispatch_records/Dispatch_record_model');
        $this->load->model('dispatch_dealers/dispatch_dealer_model');
        $this->load->model('vehicles/Vehicle_model');
        $this->lang->load('dealer_orders/dealer_order');
        $this->load->model('damages/damage_model');
    }

    public function index()
    {
        control('Create Dealer Orders');
// Display Page
        $data['header'] = lang('dealer_orders');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'dealer_orders';
        $this->load->view($this->_container,$data);
    }

    public function json()
    {

        $id = (string)$this->_user_id;         
        $dealer = $this->_dealer;
        $this->db->where("created_by = '".$id."' OR dealer_id = '".$dealer->id."'");
        $this->dealer_order_model->_table = 'view_log_dealer_order';
        search_params();

        $total=$this->dealer_order_model->find_count();

        paging('order_id');

        search_params();

        $this->db->where("created_by = '".$id."' OR dealer_id = '".$dealer->id."'");
        $rows=$this->dealer_order_model->findAll();
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {
        $user_id = $this->session->userdata('id');
        $dealer = $this->Dealer_model->find(array('incharge_id'=>$user_id));

        $this->db->select_max('order_id');
        $max_value = $this->db->get('log_dealer_order')->result_array();
        $data=$this->_get_posted_data();
        $data['order_id'] = $max_value[0]['order_id'] + 1;
        $data['dealer_id'] = $dealer->id;

        if(!$this->input->post('id'))
        {
            for($i=1; $i <= $data['quantity'];$i++)
            {                
                $success=$this->dealer_order_model->insert($data);
            }
        }
        else
        {
            $success=$this->dealer_order_model->update($data['id'],$data);
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
        $data['variant_id'] = $this->input->post('variant_id');
        $data['color_id'] = $this->input->post('color_id');
        $data['quantity'] = $this->input->post('quantity');
        $data['year'] = $this->input->post('year');
        $data['date_of_order'] = $this->input->post('date_of_order');
        $data['date_of_delivery'] = $this->input->post('date_of_delivery');

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
        $this->change_current_location($vehicle_id, $location, 'bill');

        if($success){
            echo json_encode(array('success'=>TRUE));
        }    
    }

    public function save_damage(){
        $data['id'] = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['vehicle_created_time'] = $this->input->post('vehicle_created_time');
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
        $this->dealer_order_model->_table = 'view_orders_dispatch';

        search_params();
        $total=$this->dealer_order_model->find_count();

        paging('id');

        search_params(); 
        $rows=$this->dealer_order_model->findAll();

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function detail_json(){
        $this->dealer_order_model->_table = 'view_orders_dispatch';
        // print_r($this->input->post());
        // exit;
        if($this->input->post('id')){            
            $id = $this->input->post('id');
            $this->db->where('id',$id);
        }
        else
        {
            $id = $this->input->post('order_id');
            $this->db->where('order_id',$id);
//$this->db->where('stock_dispatch_date !=',NULL);
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
            echo '<div id="thumb-image" align="center">';
            echo '<img src="'.  base_url().'uploads/driver_docs/'. $data['file_name'].'" alt="Thumbnail">';
            echo '<a href="#" id="change-image"  class="btn btn-danger btn-xs" title="Delete" onClick="removeImage()"><span class="glyphicon glyphicon-remove"></span></a>';
            echo '<br />';
            echo '<input type="hidden" id="imagename" name="imagename" value="'.$data['file_name'].'" style="display:none">';
            echo $data['file_name'];
            echo '</div>';

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
            echo '<div id="thumb-image" align="center">';
            echo '<img src="'.  base_url().'uploads/challan_image/'. $data['file_name'].'" alt="Thumbnail">';
            echo '<a href="#" id="change-image"  class="btn btn-danger btn-xs" title="Delete" onClick="removeImage()"><span class="glyphicon glyphicon-remove"></span></a>';
            echo '<br />';
            echo '<input type="hidden" id="imagename" name="imagename" value="'.$data['file_name'].'" style="display:none">';
            echo $data['file_name'];
            echo '</div>';

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
        $vehicle_id = $this->input->post('vehicle_id');
        $variant_id = $this->input->post('variant_id');
        $color_id = $this->input->post('color_id');
        $year = $this->input->post('year');
        $dealer_id = $this->input->post('dealer_id');
        $is_repaired = $this->input->post('is_repaired');

        $this->db->where('id',$dealer_id);
        $dealer = $this->Dealer_model->findAll();

        $this->db->where('mst_vehicle_id',$vehicle_id);
        $this->db->where('mst_variant_id',$variant_id);
        $this->db->where('mst_color_id',$color_id);
        $this->db->where('year',$year);
        $this->db->where('is_damage <>',1);
        $this->db->where('stock_yard_id <>',NULL);
        $this->db->where('dispatch_to_dealer_date',NULL);
        if($is_repaired == 'true')
        {
            $this->db->where('repair_date <>',NULL);
        }

        $stockyard = $this->Stock_record_model->findAll();

        if($stockyard)
        {               
            $arr_stockyard = json_decode(json_encode($stockyard),TRUE);
            $aging = max(array_column($arr_stockyard, 'diff_date'));
            foreach ($stockyard as $key => $value) 
            {
                if($value->diff_date == $aging)
                {
                    $new_stockard[] = $value;
                }
            }

            $stockyard = $new_stockard;
            foreach ($stockyard as $value) {                
                foreach ($dealer as $value1) { 
                    if($is_repaired == 'true')
                    {
                        $distance[]= array($this->distanceGeoPoints($value->latitude, $value->longitude, $value1->latitude, $value1->longitude),$value->ret_stockyard_name, $value->return_stockyard_id);
                    }      
                    else
                    {
                        $distance[]= array($this->distanceGeoPoints($value->latitude, $value->longitude, $value1->latitude, $value1->longitude),$value->stock_yard_name, $value->stock_yard_id);
                    }
                }
            }

            $min_distance = min(array_map(function($a) { return $a; }, $distance));

            $min_stockyard = $min_distance[1];
            $this->db->where('mst_vehicle_id',$vehicle_id);
            $this->db->where('mst_variant_id',$variant_id);
            $this->db->where('mst_color_id',$color_id);
            $this->db->where('is_damage <>',1);
            $this->db->where('dealer_reject',0);
            $this->db->where('dispatch_to_dealer_date',NULL);
            if($is_repaired == 'false')
            {
                $this->db->where('stock_yard_id',$min_distance[2]);
                $this->db->where('diff_date',$aging);
            }
            else
            {
                $this->db->where('repair_date <>',NULL);
            }

            $vehicle = $this->Stock_record_model->findAll();

            echo json_encode(array('stockyard'=>$min_stockyard, 'vehicle' => $vehicle, 'dealer'=>$dealer, 'result'=>1));
        }
        else
        {
            echo json_encode(array('result'=>0));
        }
    } 

    function distanceGeoPoints ($lat1, $lng1, $lat2, $lng2) {
        $earthRadius = 3958.75;

        $dLat = deg2rad($lat2-$lat1);
        $dLng = deg2rad($lng2-$lng1);


        $a = sin($dLat/2) * sin($dLat/2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dLng/2) * sin($dLng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $dist = $earthRadius * $c;
        return $dist;
    }

    public function payment_method()
    {

        $id= $this->input->post('id');
        // $this->db->where('id',$id);
        // $value = $this->db->get('log_dealer_order')->result_array();

        $data['payment_method'] = $this->input->post('payment_method');
        $data['associated_value_payment'] = $this->input->post('payment_associated_value');
        $data['payment_status'] = 1;


        // $this->db->where('order_id',$value[0]['order_id']);
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

 public function challan_damage_upload_image()
 {
        //Image Upload Config
    $config['upload_path'] ='uploads/challan_damage';
    $config['allowed_types'] = 'gif|png|jpg';
    $config['max_size'] = '10240';
    $config['remove_spaces']  = true;
        //load upload library
    $this->load->library('upload', $config);
    if(!$this->upload->do_upload())
    {
        $data['error'] = $this->upload->display_errors('','');
        echo json_encode($data);
    }
    else
    {
        $data = $this->upload->data();
        $config['image_library'] = 'gd2';
            // $config['source_image'] = 'uploads/challan_damage/thumb';
            // $config['new_image']    = $this->uploadthumbpath;
          //$config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['height'] =100;
        $config['width'] = 100;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        echo json_encode($data);
    }
    
}
public function challandamange_upload_delete(){
//get filename
    $id = $this->input->post('id');
    $filename = $this->input->post('filename');
    if($id)
    {
        $this->stock_model->update('STOCKS',array('image'=>''),array('id'=>$id));
    }
    @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/challan_damage/'. $filename);
    @unlink($this->uploadPath . '/' .$this->session->userdata('id').'/challan_damage/thumb/'. $filename);
} 
}
