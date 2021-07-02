<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends REST_Controller
{
	public function __construct()
    {
    	parent::__construct();
        $this->load->model('customers/customer_model');
        $this->load->library('customers/customer');
        $this->load->model('customers/customer_status_model');
        $this->load->model('dealers/dealer_model');
        // $this->load->model('core/rest_model');
        $this->load->model('customers/quotation_model');

        $this->load->model('booking_cancels/booking_cancel_model');
        $this->load->model('vehicle_processes/Vehicle_process_model');
        $this->load->model('customers/rest_model');
        $this->load->model('discount_limits/discount_limit_model');
        $this->load->model('discount_schemes/discount_scheme_model');
        // $this->lang->load('discount_schemes/discount_scheme');
        $this->load->model('partial_payments/partial_payment_model');
        $this->load->model('foc_documents/foc_document_model');
        $this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');
        $this->load->model('dispatch_records/dispatch_record_model');
        $this->load->model('dispatch_dealers/dispatch_dealer_model');
        $this->load->model('foc_requests/foc_request_model');
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
        // $this->lang->load('dealer_orders/dealer_order');
    } 

    public function customer_get()
    {

    }

    public function customer_post()
    {
        $array = array(
            'INQ-047211/2075-76',
            'INQ-046336/2075-76',
            'INQ-048737/2075-76',
            'INQ-048505/2075-76',
            'INQ-048750/2075-76',
            'INQ-041864/2075-76',
            'INQ-048104/2075-76',
            'INQ-051330/2075-76',
            'INQ-049529/2075-76',
            'INQ-049549/2075-76',
            'INQ-050718/2075-76',
            'INQ-049061/2075-76',
            'INQ-049592/2075-76',
            'INQ-049588/2075-76',
            'INQ-049488/2075-76',
            'INQ-049600/2075-76',
            'INQ-050802/2075-76',
            'INQ-048227/2075-76',
            'INQ-043537/2075-76',
            'INQ-044725/2075-76',
            'INQ-044725/2075-76',
            'INQ-041313/2074-75',
            'INQ-049121/2075-76',
            'INQ-049652/2075-76',
            'INQ-051080/2075-76',
            'INQ-050430/2075-76',
            'INQ-050864/2075-76',
            'INQ-046701/2075-76',
            'INQ-049240/2075-76',
            'INQ-044576/2075-76',
            'INQ-046019/2075-76',
            'INQ-002658/2074-75',
            'INQ-049768/2075-76',
            'INQ-048048/2075-76',
            'INQ-048049/2075-76',
            'INQ-049778/2075-76',
            'INQ-050197/2075-76',
            'INQ-049856/2075-76',
            'INQ-029772/2074-75',
            'INQ-048062/2075-76',
            'INQ-048069/2075-76',
            'INQ-048072/2075-76',
            'INQ-047944/2075-76',
            'INQ-044457/2075-76',
            'INQ-046995/2075-76',
            'INQ-047358/2075-76',
            'INQ-047001/2075-76',
            'INQ-046992/2075-76',
            'INQ-049528/2075-76',
            'INQ-047010/2075-76',
            'INQ-048197/2075-76',
            'INQ-049668/2075-76',
            'INQ-048994/2075-76',
            'INQ-050021/2075-76',
            'INQ-049525/2075-76',
            'INQ-050356/2075-76',
            'INQ-048903/2075-76',
            'INQ-048760/2075-76',
            'INQ-049510/2075-76',
            'INQ-048463/2075-76',
            'INQ-049553/2075-76',
            'INQ-044730/2075-76',
            'INQ-045156/2075-76',
            'INQ-049202/2075-76',
            'INQ-049624/2075-76',
            'INQ-048977/2075-76',
            'INQ-046510/2075-76',
            'INQ-049473/2075-76',
            'INQ-045506/2075-76',
            'INQ-049622/2075-76',
            'INQ-047144/2075-76',
            'INQ-048967/2075-76',
            'INQ-043821/2075-76',
            'INQ-049685/2075-76',
            'INQ-050073/2075-76',
            'INQ-046998/2075-76',
            'INQ-046986/2075-76',
            'INQ-050595/2075-76',
            'INQ-049584/2075-76',
            'INQ-045865/2075-76',
            'INQ-046996/2075-76',
            'INQ-046984/2075-76',
            'INQ-045885/2075-76',
            'INQ-049523/2075-76',
            'INQ-050591/2075-76',
            'INQ-044711/2075-76',
            'INQ-041056/2074-75',
            'INQ-046427/2075-76',
            'INQ-041562/2074-75',
            'INQ-050640/2075-76',
            'INQ-046249/2075-76',
            'INQ-048988/2075-76',
            'INQ-042370/2075-76',
            'INQ-049069/2075-76',
            'INQ-048807/2075-76',
            'INQ-049066/2075-76',
            'INQ-049065/2075-76',
            'INQ-041054/2074-75',
            'INQ-042239/2075-76',
            'INQ-050139/2075-76',
            'INQ-049067/2075-76',
            'INQ-047220/2075-76',
            'INQ-045523/2075-76',
            'INQ-045951/2075-76',
            'INQ-050189/2075-76',
            'INQ-049751/2075-76',
            'INQ-049259/2075-76',
            'INQ-051810/2075-76',
            'INQ-050695/2075-76',
            'INQ-050884/2075-76',
            'INQ-049831/2075-76',
            'INQ-050182/2075-76',
            'INQ-048278/2075-76',
            'INQ-049251/2075-76',
            'INQ-048614/2075-76',
            'INQ-048635/2075-76',
            'INQ-050201/2075-76',
            'INQ-049787/2075-76',
            'INQ-049784/2075-76',
            'INQ-048254/2075-76',
            'INQ-048996/2075-76',
            'INQ-049837/2075-76',
            'INQ-049820/2075-76',
            'INQ-051033/2075-76',
            'INQ-049823/2075-76',
            'INQ-049779/2075-76',
            'INQ-049260/2075-76',
            'INQ-048629/2075-76',
            'INQ-050179/2075-76',
            'INQ-048993/2075-76',
            'INQ-050186/2075-76',
            'INQ-050184/2075-76',
            'INQ-049726/2075-76',
            'INQ-048622/2075-76',
            'INQ-048660/2075-76',
            'INQ-048637/2075-76',
            'INQ-048309/2075-76',
            'INQ-048615/2075-76',
            'INQ-049035/2075-76',
            'INQ-050996/2075-76',
            'INQ-049185/2075-76',
            'INQ-042707/2075-76',
            'INQ-049618/2075-76',
            'INQ-049489/2075-76',
            'INQ-048111/2075-76',
            'INQ-048121/2075-76',
            'INQ-049666/2075-76',
            'INQ-050899/2075-76',
            'INQ-051182/2075-76',
            'INQ-049002/2075-76',
            'INQ-048497/2075-76',
            'INQ-046093/2075-76',
            'INQ-050945/2075-76',
            'INQ-047025/2075-76',
            'INQ-042212/2075-76',
            'INQ-043783/2075-76',            
            'INQ-045000/2075-76',
            'INQ-048090/2075-76',
            'INQ-049585/2075-76',
            'INQ-048094/2075-76',
            'INQ-048119/2075-76',
            'INQ-049313/2075-76',
            'INQ-043010/2075-76',
            'INQ-049143/2075-76',
            'INQ-050161/2075-76',
            'INQ-049695/2075-76',
            'INQ-044657/2075-76',
            'INQ-042833/2075-76',
            'INQ-050009/2075-76',
            'INQ-042891/2075-76',
            'INQ-047407/2075-76',
            'INQ-038385/2074-75',
            'INQ-049512/2075-76',
            'INQ-044719/2075-76',
            
        );
        $name= $this->post('name');
        $chass_no = $this->post('chass_no');
        $engine_no = $this->post('engine_no');
        // echo $chass_no; exit;
        $this->customer_model->_table = "view_customers";
        $this->db->like('chass_no',$chass_no,'both');
        $this->db->like('engine_no',$engine_no,'both');
        $check = $this->customer_model->find();
        // echo '<pre>'; print_r($check); 
        if($check){
            // if(($check->vehicle_delivery_date && $check->vehicle_delivery_date >= '2018-10-02') || in_array($check->inquiry_no, $array) ){
            // if(($check->vehicle_delivery_date && $check->vehicle_delivery_date >= '2019-08-27') ){
            //     $detail = $check;
            //     $status = "200";
            //     echo json_encode(array("detail"=>$detail,"status"=>$status));
            // }else{
                $status = "105";
                echo json_encode(array('status'=>$status,'date'=>$check->vehicle_delivery_date));
            // }
        }else{
            $status = "101";
            echo json_encode(array('status'=>$status));
        }
        

    }
    public function vehicle_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_vehicles';
        $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll();
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Vehicle'));
        echo json_encode(array('rows'=>$rows));


    }

    public function variant_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'view_dms_vehicles';
        
        if($this->input->post('vehicle_id') != 'null'){
            $vehicle_id = (int)$this->input->post('vehicle_id');
            $this->db->where('vehicle_id',$vehicle_id);

        }
        $fields = [];
        $fields[] = 'variant_id';
        $fields[] = 'variant_name';
        $this->db->group_by('variant_id,variant_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields);
        array_unshift($rows, array('variant_id' => 'null', 'variant_name' => 'Select Variant'));

        echo json_encode(array('rows'=>$rows));

    }

    public function color_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        // $this->customer_model->_table = 'mst_colors';
        $this->customer_model->_table = 'view_dms_vehicles';
        if($this->input->post('vehicle_id')  != 'null' && $this->input->post('variant_id')  != 'null'){
            $vehicle_id = (int)$this->input->post('vehicle_id');
            $variant_id = (int)$this->input->post('variant_id');
            $this->db->where('vehicle_id',$vehicle_id);
            $this->db->where('variant_id',$variant_id);

        }
        $fields[] = 'color_id';
        $fields[] = 'color_name';
        $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields);
        array_unshift($rows, array('color_id' => 'null', 'color_name' => 'Select Color'));

        echo json_encode(array('rows'=>$rows));

    }

    public function institution_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_institutions';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields);
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Institution'));
        echo json_encode(array('rows'=>$rows));
    }
    public function education_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_educations';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields);
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Education'));
        echo json_encode(array('rows'=>$rows));
    }

    public function payment_mode_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_payment_modes';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields);
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Payment Mode'));
        echo json_encode(array('rows'=>$rows));
    }

    public function source_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_sources';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields,'rank asc');
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Source'));
        echo json_encode(array('rows'=>$rows));
    }

    public function walkin_source_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_walkin_sources';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields,'rank asc');
        // array_unshift($rows, array('id' => 'null', 'name' => 'Select Walkin Source'));
        echo json_encode(array('rows'=>$rows));
    }

    public function generated_event_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $dealer_id = $this->input->post('dealer_id');

        $this->load->model('events/event_model');

        $this->db->where_in('dealer_id', array(0,$dealer_id));
        if($dealer_id != 75)
        {
            $this->db->or_where('dealer_id',NULL);
        }

        $rows=$this->event_model->findAll(array('active'=>'t'), array('id','name'));

        // echo json_encode($rows);
        echo json_encode(array('rows'=>$rows));
    }

    public function type_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_customer_types';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields,'rank asc');
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Types'));
        echo json_encode(array('rows'=>$rows));
    }
    public function occupation_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_occupations';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields,'rank asc');
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Occupation'));
        echo json_encode(array('rows'=>$rows));
    }
    public function relation_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->customer_model->_table = 'mst_relations';
        $fields[] = 'id';
        $fields[] = 'name';
        // $this->db->group_by('color_id,color_name');
        // $this->db->where('for_sales',1);
        $rows = $this->customer_model->findAll(null,$fields,'rank asc');
        array_unshift($rows, array('id' => 'null', 'name' => 'Select Relation'));
        echo json_encode(array('rows'=>$rows));
    }
    public function district_post(){
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $filename = CACHE_PATH . 'districts.json';

        if (file_exists($filename)) {
            echo file_get_contents($filename);
            exit;
        }
    }
    public function mun_vdc_post() 
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $mun_vdc_id = $this->input->post('parent_id');

        $filename = CACHE_PATH . "mun_vdc_{$mun_vdc_id}.json";

        if (file_exists($filename)) {
            echo file_get_contents($filename);
            exit;
        }
    }
    public function inquiry_data_post()
    {
        $user_id = (int) $this->input->post('id');
        $executive_id = (int) $this->input->post('executive_id');
        $user_token = trim($this->input->post('token'));
        $page = (int)$this->input->post('page');
        // if($this->input->post('inquiry_no')){
        //     $inquiry_no = $this->input->post('inquiry_no');
        // }
        // if($this->input->post('full_name')){
        //     $full_name = $this->input->post('full_name');
        // }
        // if($this->input->post('vehicle_id')){
        //     $vehicle_id = (int)$this->input->post('vehicle_id');
        // }
        // if($this->input->post('variant_id')){
        //     $variant_id = (int)$this->input->post('variant_id');
        // }
        // if($this->input->post('variant_id')){
        //     $color_id = (int)$this->input->post('color_id');
        // }
        // $page = $page*50;

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;
        $where_dealer = "";

        $dealer_list    = (is_dealer_incharge_api($user_id)) ? get_dealer_list_api($user_id) : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge_api($user_id)) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive_api($user_id)) ? TRUE : NULL; 
        }


        if($is_showroom_incharge){
            $this->customer_model->_table = 'dms_employees';
            $incharge_info=$this->customer_model->find(array('id' => $executive_id));
        }
        
        if(!empty($dealer_list)) {
            $dealer_where_array = array();
            foreach ($dealer_list as $key => $value) {
                $dealer_where_array[] = "(".$value.")";
            }
            $where_dealer = implode(',', $dealer_where_array);
            $this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $incharge_info->dealer_id);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $executive_id);
        }

        if($this->input->post('inquiry_no') != 'null'){
            $inquiry_no = $this->input->post('inquiry_no');
            $this->db->like('LOWER(inquiry_no)',strtolower($inquiry_no));
        }
        if($this->input->post('full_name') != 'null'){
            $full_name = $this->input->post('full_name');
            $this->db->like('LOWER(full_name)',strtolower($full_name));
        }
        if($this->input->post('vehicle_id') != 'null'){
            $vehicle_id = (int)$this->input->post('vehicle_id');
            $this->db->where('vehicle_id',$vehicle_id);

        }
        if($this->input->post('variant_id') != 'null'){
            $variant_id = (int)$this->input->post('variant_id');
            $this->db->where('variant_id',$variant_id);
        }
        if($this->input->post('color_id') != 'null'){
            $color_id = (int)$this->input->post('color_id');
            $this->db->where('color_id',$color_id);
        }
        if($this->input->post('status_id') != 'null'){
            $status_id = (int)$this->input->post('status_id');
            $this->db->where('actual_status_id',$status_id);
        }

        $this->customer_model->_table = 'view_app_customer';
        $total=$this->customer_model->find_count();
        // echo $total; exit;
        if(!empty($dealer_list)) {
            $dealer_where_array = array();
            foreach ($dealer_list as $key => $value) {
                $dealer_where_array[] = "(".$value.")";
            }
            $where_dealer = implode(',', $dealer_where_array);
            $this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $incharge_info->dealer_id);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $executive_id);
        }
        if($this->input->post('inquiry_no') != 'null'){
            $inquiry_no = $this->input->post('inquiry_no');
            $this->db->like('LOWER(inquiry_no)',strtolower($inquiry_no));
        }
        if($this->input->post('full_name') != 'null'){
            $full_name = $this->input->post('full_name');
            $this->db->like('LOWER(full_name)',strtolower($full_name));
        }
        if($this->input->post('vehicle_id') != 'null'){
            $vehicle_id = (int)$this->input->post('vehicle_id');
            $this->db->where('vehicle_id',$vehicle_id);

        }
        if($this->input->post('variant_id') != 'null'){
            $variant_id = (int)$this->input->post('variant_id');
            $this->db->where('variant_id',$variant_id);
        }
        if($this->input->post('color_id') != 'null'){
            $color_id = (int)$this->input->post('color_id');
            $this->db->where('color_id',$color_id);
        }
        if($this->input->post('status_id') != 'null'){
            $status_id = (int)$this->input->post('status_id');
            $this->db->where('actual_status_id',$status_id);
        }
        $fields = [];
        $fields[] = 'id';
        $fields[] = 'inquiry_no';
        $fields[] = 'color_name';
        $fields[] = 'vehicle_name';
        $fields[] = 'variant_name';
        $fields[] = 'full_name';
        $fields[] = 'executive_name';
        $fields[] = 'customer_image';
        $fields[] = 'vehicle_id';
        $fields[] = 'variant_id';
        $fields[] = 'actual_status_rank';
        $fields[] = 'actual_status_name';
        $rows = $this->customer_model->findAll(null,$fields,'id desc',$page,10);
        // echo $this->db->last_query();
        foreach ($rows as $key => &$value) {
            $value->customer_image = base_url('uploads/customer_image/'.$value->customer_image);
        }

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function inquiry_post()
    {   
       
        $data = $this->_get_posted_data();

        $row = 0;
        if(array_key_exists('id', $data)){
            if($data['id'] == '' || $data['id'] == null){
                $this->db->where(array('mobile_1'=>$data['mobile_1'], 'status_id' => 3));
                $row = $this->db->count_all_results('view_customers');          
            }
        }
        $success = false;
        $msg = 'Number already exist in booking list';
        if($row == 0){
            list($msg, $success) = $result = $this->save_customer_api($data);
        }
        // echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }


    private function _get_posted_data()
    {
        $data=array();
        if($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
            $customer_name = $this->customer_model->find(array('id'=>$data['id']),array('first_name','middle_name','last_name'));
            if($customer_name->first_name != strtoupper($this->input->post('first_name')) || $customer_name->middle_name != strtoupper($this->input->post('middle_name')) || $customer_name->last_name != strtoupper($this->input->post('last_name')))
            {
                $edit['created_by'] = $this->input->post('user_id');
                $edit['created_at'] = date('Y-m-d H:i:s');
                $edit['customer_id'] = $this->input->post('id');
                $edit['old_name'] = ($customer_name->first_name.' '.$customer_name->middle_name.' '.$customer_name->last_name);
                $edit['new_name'] = (strtoupper($this->input->post('first_name')).' '.strtoupper($this->input->post('middle_name')).' '.strtoupper($this->input->post('last_name')));

                $this->db->insert('inquiry_name_edit',$edit);
            }
            $vehicle_details = $this->customer_model->find(array('id'=>$data['id']),array('vehicle_id','variant_id','color_id'));

            if($this->input->post('vehicle_id') != $vehicle_details->vehicle_id || $this->input->post('variant_id') != $vehicle_details->variant_id || $this->input->post('color_id') != $vehicle_details->color_id)
            {
                $vehicle_edit['customer_id'] = $this->input->post('id');
                $vehicle_edit['prev_vehicle'] = $vehicle_details->vehicle_id;
                $vehicle_edit['prev_variant'] = $vehicle_details->variant_id;
                $vehicle_edit['prev_color'] = $vehicle_details->color_id;
                $vehicle_edit['new_vehicle'] = $this->input->post('vehicle_id');
                $vehicle_edit['new_variant'] = $this->input->post('variant_id');
                $vehicle_edit['new_color'] = $this->input->post('color_id');
                $vehicle_edit['date'] = date('Y-m-d');
                $vehicle_edit['date_np'] = get_nepali_date(date('Y-m-d'),'nep');
                $this->rest_model->insert_API('crm_vehicle_edit',$this->input->post('user_id'),$vehicle_edit);
            }
        }

        $data['inquiry_no']             = ($this->input->post('inquiry_no')) ? $this->input->post('inquiry_no'): NULL;
        $data['fiscal_year_id']         = ($this->input->post('fiscal_year_id')) ? $this->input->post('fiscal_year_id'): NULL;
        // $data['inquiry_date_en']        = ($this->input->post('inquiry_date_en')) ? $this->input->post('inquiry_date_en'): NULL;
        // $data['inquiry_date_np']        = ($this->input->post('inquiry_date_np')) ? $this->input->post('inquiry_date_np'): NULL;
        if($this->input->post('inquiry_date_en'))
        {
            $data['inquiry_date_en']        = $this->input->post('inquiry_date_en');
        }
        else
        {
            $data['inquiry_date_en']        = date('Y-m-d');
        }
        if($this->input->post('inquiry_date_np'))
        {
            $data['inquiry_date_np']        = $this->input->post('inquiry_date_np');
         $data = $this->input->post();
        }
        else
        {
            $data['inquiry_date_np']        = get_nepali_date(date('Y-m-d'),'nepali');
        }
        // unset($data['document']);
        $data['customer_type_id']       = ($this->input->post('customer_type_id')) ? $this->input->post('customer_type_id'): NULL;
        $data['first_name']             = ($this->input->post('first_name')) ? strtoupper($this->input->post('first_name')): NULL;
        $data['middle_name']            = ($this->input->post('middle_name')) ? strtoupper($this->input->post('middle_name')): NULL;
        $data['last_name']              = ($this->input->post('last_name')) ? strtoupper($this->input->post('last_name')): NULL;
        $data['gender']                 = ($this->input->post('gender')) ? $this->input->post('gender'): 'Not Specified';
        $data['marital_status']         = ($this->input->post('marital_status')) ? $this->input->post('marital_status'): 'Not Specified';
        $data['family_size']            = ($this->input->post('family_size')) ? $this->input->post('family_size'): 'Not Specified';
        $data['dob_en']                 = ($this->input->post('dob_en')) ? $this->input->post('dob_en'): NULL;
        $data['dob_np']                 =  get_nepali_date($this->input->post('dob_en'),'nep');
        $data['anniversary_en']         = ($this->input->post('anniversary_en')) ? $this->input->post('anniversary_en'): NULL;
        if($data['anniversary_en']){
            $data['anniversary_np']         = get_nepali_date($this->input->post('anniversary_en'),'nep');
            
        }
        $data['district_id']            = ($this->input->post('district_id')) ? $this->input->post('district_id'): NULL;
        $data['mun_vdc_id']             = ($this->input->post('mun_vdc_id')) ? $this->input->post('mun_vdc_id'): NULL;
        $data['address_1']              = ($this->input->post('address_1')) ? $this->input->post('address_1'): NULL;
        $data['address_2']              = ($this->input->post('address_2')) ? $this->input->post('address_2'): NULL;
        $data['email']                  = ($this->input->post('email')) ? $this->input->post('email'): NULL;
        $data['home_1']                 = ($this->input->post('home_1')) ? $this->input->post('home_1'): NULL;
        $data['home_2']                 = ($this->input->post('home_2')) ? $this->input->post('home_2'): NULL;
        $data['work_1']                 = ($this->input->post('work_1')) ? $this->input->post('work_1'): NULL;
        $data['work_2']                 = ($this->input->post('work_2')) ? $this->input->post('work_2'): NULL;
        $data['mobile_1']               = ($this->input->post('mobile_1')) ? $this->input->post('mobile_1'): NULL;
        $data['mobile_2']               = ($this->input->post('mobile_2')) ? $this->input->post('mobile_2'): NULL;
        $data['pref_communication']     = ($this->input->post('pref_communication')) ? $this->input->post('pref_communication'): NULL;
        $data['occupation_id']          = ($this->input->post('occupation_id')) ? $this->input->post('occupation_id'): NULL;
        $data['education_id']           = ($this->input->post('education_id')) ? $this->input->post('education_id'): NULL;
        if($this->input->post('dealer_id'))
        {
            $data['dealer_id'] = $this->input->post('dealer_id');
        }
        // else if(is_sales_executive())
        // {
        //     $data['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
        // }
        if($this->input->post('executive_id'))
        {
            $data['executive_id'] = $this->input->post('executive_id');
        }
        // else if(is_sales_executive())
        // {
        //     $data['executive_id'] = $this->session->userdata('employee')['employee_id'];
        // }
        // $data['dealer_id']              = ($this->input->post('dealer_id')) ? $this->input->post('dealer_id'): NULL;
        // $data['executive_id']           = ($this->input->post('executive_id')) ? $this->input->post('executive_id'): NULL;
        $data['longitude']              = ($this->input->post('longitude')) ? $this->input->post('longitude'): NULL;
        $data['latitude']               = ($this->input->post('latitude')) ? $this->input->post('latitude'): NULL;
        $data['payment_mode_id']        = ($this->input->post('payment_mode_id')) ? $this->input->post('payment_mode_id'): NULL;
        $data['source_id']              = ($this->input->post('source_id')) ? $this->input->post('source_id'): NULL;
        $data['status_id']              = ($this->input->post('status_id')) ? $this->input->post('status_id'): NULL;
        $data['inquiry_kind']           = ($this->input->post('inquiry_kind')) ? $this->input->post('inquiry_kind'): NULL;
        $data['contact_1_name']         = ($this->input->post('contact_1_name')) ? $this->input->post('contact_1_name'): NULL;
        $data['contact_1_mobile']       = ($this->input->post('contact_1_mobile')) ? $this->input->post('contact_1_mobile'): NULL;
        $data['contact_1_relation_id']  = ($this->input->post('contact_1_relation_id')) ? $this->input->post('contact_1_relation_id'): NULL;
        $data['contact_2_name']         = ($this->input->post('contact_2_name')) ? $this->input->post('contact_2_name'): NULL;
        $data['contact_2_mobile']       = ($this->input->post('contact_2_mobile')) ? $this->input->post('contact_2_mobile'): NULL;
        $data['contact_2_relation_id']  = ($this->input->post('contact_2_relation_id')) ? $this->input->post('contact_2_relation_id'): NULL;
        $data['remarks']                = ($this->input->post('remarks')) ? $this->input->post('remarks'): NULL;
        $data['vehicle_id']             = ($this->input->post('vehicle_id')) ? $this->input->post('vehicle_id'): NULL;
        $data['variant_id']             = ($this->input->post('variant_id')) ? $this->input->post('variant_id'): NULL;
        $data['color_id']               = ($this->input->post('color_id')) ? $this->input->post('color_id'): NULL;
        $data['vehicle_make_year']      = ($this->input->post('vehicle_make_year')) ? $this->input->post('vehicle_make_year'): NULL;
        $data['walkin_source_id']       = ($this->input->post('walkin_source_id')) ? $this->input->post('walkin_source_id'): 0;
        $data['event_id']               = ($this->input->post('event_id')) ? $this->input->post('event_id'): 0;
        $data['institution_id']         = ($this->input->post('institution_id')) ? $this->input->post('institution_id'): NULL;
        $data['exchange_car_make']      = ($this->input->post('exchange_car_make')) ? $this->input->post('exchange_car_make'): NULL;
        $data['exchange_car_variant']   = ($this->input->post('exchange_car_variant')) ? $this->input->post('exchange_car_variant'): NULL;
        $data['exchange_car_model']     = ($this->input->post('exchange_car_model')) ? $this->input->post('exchange_car_model'): NULL;
        $data['exchange_car_year']      = ($this->input->post('exchange_car_year')) ? $this->input->post('exchange_car_year'): NULL;
        $data['exchange_car_kms']       = ($this->input->post('exchange_car_kms')) ? $this->input->post('exchange_car_kms'): NULL;
        $data['exchange_car_value']     = ($this->input->post('exchange_car_value')) ? $this->input->post('exchange_car_value'): 0;
        $data['exchange_car_bonus']     = ($this->input->post('exchange_car_bonus')) ? $this->input->post('exchange_car_bonus'): 0;
        $data['exchange_total_offer']   = $data['exchange_car_value'] + $data['exchange_car_bonus'];
        
        $data['bank_id']                = ($this->input->post('bank_id')) ? $this->input->post('bank_id'): NULL;
        $data['bank_branch']            = ($this->input->post('bank_branch')) ? $this->input->post('bank_branch'): NULL;
        $data['bank_staff']             = ($this->input->post('bank_staff')) ? $this->input->post('bank_staff'): NULL;
        $data['bank_contact']           = ($this->input->post('bank_contact')) ? $this->input->post('bank_contact'): NULL;
        $images                         = ($this->input->post('document')) ? $this->input->post('document'): NULL;
        $cus_images                         = ($this->input->post('customer_image')) ? $this->input->post('customer_image'): NULL;
        $data['document']  = $this->uploading_api($images,'uploads/customer_doc/');
        $data['customer_image']  = $this->uploading_api($cus_images,'uploads/customer_image/');
        return $data;
    }

    function uploading_api($picture,$url)
    {
        $m=microtime(true);
        $random = sprintf("%8x%05x\n",floor($m),($m-floor($m))*1000000);
        $filename = md5($random).'.jpg';
        if (!file_exists($url)) {
            mkdir($url, 0777, true);
        }
        $path = $url.$filename;
        $imageData = base64_decode($picture);
        file_put_contents($path, $imageData);
        return $filename;

    }

    public function detail_post()
    {
        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $id = $this->input->post('id');
        if ($id==null) 
        {
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'invalid inquiry detail'));
            return false;
            exit;
        }

        $customer_info = $this->customer->get_customer($id);
        $customer_info->document_url = null;
        if($customer_info->document){
            $customer_info->document_url = base_url().'/uploads/customer_doc/'.$customer_info->document;
        }

        if ($customer_info == null) 
        {
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'invalid inquiry detail'));
            return false;
            exit;          
        }

        $data['customer_info'] = $customer_info;
        echo json_encode(array('rows'=>$data));

        // $data['dealer_id'] = $this->dealer_id;

        // $data['file'] = $this->db->where('customer_id',$id)->get('tbl_inquiry_uploaded_document')->row_array();
    }

    // public function customer_statuses_post()
    // {
    //     if($this->input->post('id'))
    //     {
    //         $id = $this->input->post('id');
    //     }

    //     list($total, $rows) = $this->customer->get_customer_statuses($id);
    //     echo json_encode(array('total'=>$total,'rows'=> $rows));
    //     exit;
    // }


    public function save_customer_api($data = array()) 
    {
        $this->user = $this->input->post('user_id');
        // echo '<pre>'; print_r($data); exit;
        $this->db->trans_begin();

        $primary_key = null;
        if(!array_key_exists('id', $data))
        {
            $data['status_id'] = 1;
            $success=$this->rest_model->insert_API('dms_customers',$this->user,$data);
            $primary_key = $success;

            $followupData = array();

            $followupData['customer_id'] = $primary_key;
            $followupData['executive_id'] = $data['executive_id'];
            $followupData['followup_date_en']= date('Y-m-d', strtotime($data['inquiry_date_en']. ' + 3 days'));
            $followupData['followup_date_np']=  get_nepali_date($followupData['followup_date_en'], 'value' );
            $followupData['followup_status']= "Open";

            $this->rest_model->insert_API('dms_customer_followups',$this->user,$followupData);
        }
        else
        {
            $success=$this->rest_model->update_API('dms_customers',$this->user,$data['id'],$data);
            $primary_key = $data['id'];
        }

        if ($data['inquiry_no'] == '' || $data['inquiry_no'] == NULL){
            // update inquiry_no: PK-FY
            list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();

            $inquiry_no = sprintf("INQ-%06d/%s", intval($primary_key), $fiscal_year);

            $this->rest_model->update_API('dms_customers',$this->user,$primary_key, array('id' => $primary_key, 'fiscal_year_id' => $fiscal_year_id,'inquiry_no' => $inquiry_no));
        }

        $old_status_id = $this->input->post('old_status_id');

        // if status is changed, then update status
        if ($old_status_id != $data['status_id']) {

            $customerStatusData = array();

            $customerStatusData['customer_id'] = $primary_key; 
            $customerStatusData['status_id'] = $data['status_id']; 
            $customerStatusData['sub_status_id'] = 20; 
            $customerStatusData['duration'] = 0;

            // calculate duration between status change
            $this->db->where('customer_id', $primary_key);
            if ($old_status_id != ''){
                $this->db->where('status_id', $old_status_id);
            }
            $this->db->order_by('created_at','desc');
            $oldStatusResult = $this->customer_status_model->findAll();
            if ($oldStatusResult) {
                $date1 = date_create($oldStatusResult[0]->created_at);
                $date2 = date_create(date('Y-m-d H:i:s'));

                $diff = date_diff($date1, $date2);
                $customerStatusData['duration'] = $diff->format("%a");
            }

            $this->rest_model->insert_API('dms_customer_statuses',$this->user,$customerStatusData);
        }

        if(!array_key_exists('id',$data))
        {
            $ccd['customer_id'] = $primary_key;
            $this->rest_model->insert_API('ccd_inquiry',$this->user,$ccd);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg='Something went Wront';
            $code = '101';
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            $msg= 'Success';
            $code= '200';
            $success = TRUE;
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success,'code' => $code));
        // exit;

        // return array($msg, $success);
    }


    public function customer_followups_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        if($this->input->post('customer_id'))
        {
            $customer_id = $this->input->post('customer_id');
        }

        list($total, $rows) = $this->customer->get_customer_followups($customer_id);
        echo json_encode(array('total'=>$total,'rows'=> $rows));
        exit;
    }

    

     public function get_inquiry_statuses_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->load->model('inquiry_statuses/inquiry_status_model');

        $rows = $this->inquiry_status_model->findAll(array('sub_status_group'=>0),array('id','name'));

        array_unshift($rows, array('id' => 'null', 'name' => 'Select Status'));

        echo json_encode(array('rows' => $rows));
    }



    public function get_customer_inquiry_statuses_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->load->model('inquiry_statuses/inquiry_status_model');

        $rows = $this->inquiry_status_model->findAll(array('sub_status_group'=>0),array('id','name'));

        $id = $this->input->post('customer_id');

        $customer_info = $this->customer->get_customer($id);


        echo json_encode(array('rows' => $rows, 'customer_info'=>$customer_info));
    }

    public function get_customer_inquiry_sub_statuses_post()
    {
        $this->load->model('inquiry_statuses/inquiry_status_model');
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $group_id = $this->input->post('id');
        if($this->input->post('status_name'))
        {
            $status = $this->input->post('status_name');
            if($status == 'Booked')
            {
                $this->db->where('id <>',STATUS_CANCEL);
                $this->db->where('id <>',STATUS_LOST);
            }
            // if($status == )
        }

        $rows = $this->inquiry_status_model->findAll(array('sub_status_group'=>$group_id),array('id','name'));

        echo json_encode(array('rows'=>$rows));
    }

    public function get_reason_post() 
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $status = $this->input->post('status');

        $filename = CACHE_PATH . "mst_reasons_{$status}.json";

        if (file_exists($filename)) {
            echo file_get_contents($filename);
            exit;
        }
    }

    public function get_banks_post() 
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        $filename = CACHE_PATH . "mst_banks.json";

        if (file_exists($filename)) {
            echo file_get_contents($filename);
            exit;
        }
    }

    public function save_customer_status_post() 
    {
        // echo $
        // echo '<pre>'; print_r($this->input->post()); exit;

        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        if($this->input->post('status_id') == STATUS_BOOKED){
            $document = $this->input->post('uploadeddocument');
            $upload = $this->uploading_api($document,'uploads/bookingdocument/');
            $data = array(
                'customer_id' => $this->input->post('customer_id'),
                'uploadeddocument' => $upload,
            );
            $this->db->insert('tbl_inquiry_uploaded_document', $data);
            
        }

        // echo '<pre>'; print_r(json_encode($this->input->post())); exit;
        list($msg, $success) = $result = $this->save_customer_status_api($this->input->post());
        echo json_encode(array('msg'=>$msg,'success'=>$success,'code'=>'200'));
        exit;
    }

    public function save_customer_status_api($data = array())
    {
        $this->user = $this->input->post('user_id');

        $this->db->trans_begin();

        // INSERT INTO STATUS TABLE
        $customerStatusData = array();

        $customerStatusData['customer_id']      = $data['customer_id']; 
        $customerStatusData['status_id']        = $data['status_id']; 
        $customerStatusData['sub_status_id']    = $data['sub_status_id']; 
        $customerStatusData['reason_id']        = ( isset($data['reason_id'])  && $data['reason_id'] !='' ) ? $data['reason_id'] : null; 
        $customerStatusData['duration']         = 0;
        $customerStatusData['notes']            = ( isset($data['notes'])  && $data['notes'] !='' ) ? $data['notes'] : null; 

        // calculate duration between status change
        $this->db->where('customer_id', $data['customer_id']);
        $this->db->order_by('created_at','desc');

        $oldStatusResult = $this->customer_status_model->findAll();

        if ($oldStatusResult) {
            $date1 = date_create($oldStatusResult[0]->created_at);
            $date2 = date_create(date('Y-m-d H:i:s'));

            $diff = date_diff($date1, $date2);
            $customerStatusData['duration'] = $diff->format("%a");
        }

        // $success=$this->rest_model->insert_API('dms_customers',$this->user,$data);

        $this->rest_model->insert_API('dms_customer_statuses',$this->user,$customerStatusData);

        // IF FUNDING BANK THEN UPDATE CUSTOMER TABLE
        if (isset($data['funding_bank']) && $data['funding_bank']== 1) {
            $updateCustomerData = array();
            $updateCustomerData['id']           = $data['customer_id'];
            $updateCustomerData['bank_id']      = $data['bank_id'];
            $updateCustomerData['bank_branch']  = $data['bank_branch'];
            $updateCustomerData['bank_staff']   = $data['bank_staff'];
            $updateCustomerData['bank_contact'] = $data['bank_contact'];
            $updateCustomerData['status_id']    = $data['status_id'];

            $success=$this->rest_model->update_API('dms_customers',$this->user,$updateCustomerData['id'],$updateCustomerData);

            // $success=$this->update_API($updateCustomerData['id'],$updateCustomerData);
        }

        // IF QUOTATION ISSUED THEN SAVE QUOTATION
        if (isset($data['quote_price']) && $data['quote_price'] >0) {
            $quotationData = array();
            $quotationData['customer_id']       = $data['customer_id'];
            $quotationData['quotation_date_en'] = date('Y-m-d');
            $quotationData['quotation_date_np'] = get_nepali_date(date('Y-m-d'), 'value' );
            $quotationData['quote_mrp']         = $data['quote_mrp'];
            $quotationData['quote_discount']    = 0;
            $quotationData['quote_price']       = $data['quote_price'];
            $quotationData['quote_unit']        = $data['quote_unit'];

            $this->rest_model->insert_API('dms_quotations',$this->user,$quotationData);
        }

        if (isset($data['cancel_amount']) && $data['cancel_amount'] >0)
        {
            $bookingCancel = array();
            $bookingCancel['customer_id'] = $data['customer_id'];
            $bookingCancel['cancel_amount'] = ( isset($data['cancel_amount'])  && $data['cancel_amount'] !='' ) ? $data['cancel_amount'] : null; 
            $bookingCancel['notes'] = ( isset($data['reason'])  && $data['reason'] !='' ) ? $data['reason'] : null; 
            $bookingCancel['cancel_reason'] = ( isset($data['booking_cancel_reason'])  && $data['booking_cancel_reason'] !='' ) ? $data['booking_cancel_reason'] : null; 

            $this->rest_model->insert_API('sales_booking_cancel',$this->user,$bookingCancel);
        }

        if($customerStatusData['status_id'] == 3)
        {
            $booking = array();
            $booking['customer_id'] = $data['customer_id'];
            $booking['booked_date'] = date('Y-m-d');
            $np_date = get_nepali_date($booking['booked_date'],'true');
            $np_dates = explode('-', $np_date);
            $booking['booked_date_np'] = $np_date;
            $booking['booked_date_np_month'] = $np_dates['1'];
            $booking['booked_date_np_year'] = $np_dates['0'];
            $check_customer = $this->Vehicle_process_model->findAll(array('customer_id'=>$data['customer_id']));
            if(empty($check_customer) || $check_customer == '')
            {
                $this->rest_model->insert_API('sales_vehicle_process',$this->user,$booking);
            }else if($oldStatusResult[0]->status_id == STATUS_CLOSED && $oldStatusResult[0]->sub_status_id == STATUS_BOOKING_CANCEL){
                $booking['id'] = $check_customer[0]->id;
                $this->rest_model->update_API('sales_vehicle_process',$this->user,$booking['id'],$booking);

            }else{
                
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg='Status Update Failed';
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            // $msg=lang('general_success');
            $msg='Successfullly Updated';

            $success = TRUE;
        }

        // echo json_encode(array('msg'=>$msg,'success'=>$success));
        // exit;

        return array($msg, $success);
    }


    //customer statuses json
    public function customer_statuses_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        if($this->input->post('customer_id'))
        {
            $customer_id = $this->input->post('customer_id');
        }

        list($total, $rows) = $this->customer->get_customer_statuses($customer_id);
        echo json_encode(array('total'=>$total,'rows'=> $rows));
        exit;
    }

    public function get_executives_post() 
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->load->model('employees/employee_model');

        $this->employee_model->order_by('name asc');

        if($this->input->post('dealer_id')){
            $this->db->where('dealer_id', $this->input->post('dealer_id'));
        }

        $fields = array();
        $fields[] = 'id';
        $fields[] = "CASE WHEN middle_name <> '' THEN first_name || ' ' || middle_name || ' ' || last_name ELSE first_name || ' ' || last_name END as name ";
        
        $rows=$this->employee_model->findAll(null, $fields);

        array_unshift($rows, array('id' => '0', 'name' => 'Select Executive'));

        echo json_encode($rows);
    }

    public function save_customer_followup_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $result = $this->save_customer_followup_api($this->input->post());

        if($result)
        {
            $success = TRUE;
            $msg=lang('success_message');
        } 
        else
        {
            $success = FALSE;
            $msg=lang('failure_message');
        }
        
        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }

    public function save_customer_followup_api($data = array())
    {
        $this->user = $this->input->post('user_id');
        // echo $this->user; exit;
        // echo '<pre>'; print_r($data); exit;

        $this->db->trans_begin();
        $data['next_followup_date_np'] = NULL;
        $data['followup_date_np']    = get_nepali_date($data['followup_date_en'],'true' );
        if($data['next_followup_date_en']){
            $data['next_followup_date_np'] = get_nepali_date($data['next_followup_date_en'],'true');
            
        }
        // echo '<pre>'; print_r($data['followup_date_np']); exit;
        // echo '<pre>'; var_dump($data['next_followup_date_en']); exit;

        $reason_id = (isset($data['reason_id']) && $data['reason_id'] != '') ? $data['reason_id'] : NULL;
        unset($data['reason_id']);
        unset($data['old_status_id']);

        $data['next_followup'] = ($this->input->post('next_followup')) ? TRUE : FALSE;
        if ($data['next_followup'] == FALSE) {
            $data['next_followup_date_en']= null;
            $data['next_followup_date_np']= null;
        }
        unset($data['token']);
        unset($data['user_id']);
        if(empty($data['id']))
        {
            unset($data['id']);
            $this->rest_model->insert_API('dms_customer_followups',$this->user,$data);
        }
        else
        {
            $this->rest_model->update_API('dms_customer_followups',$this->user,$data['id'],$data);
        }

        if ($data['followup_status'] == FOLLOWUP_STATUS_COMPLETED) 
        {
            $insertNextFollowup = FALSE;
            $statusArray = array();

            $this->db->where('customer_id', $data['customer_id']);
            $this->db->order_by('created_at','desc');
            $this->db->limit(1);

            $currentStatusResult = $this->customer_status_model->findAll();

            if ($currentStatusResult) {
                $currentStatus = $currentStatusResult[0]->status_id;
                if ($currentStatus < STATUS_RETAIL)
                    $insertNextFollowup = TRUE;
            }  

            $new_followup = array();
            $new_followup['customer_id']            = $data['customer_id'];
            $new_followup['executive_id']           = $data['executive_id'];
            $new_followup['followup_status']        = FOLLOWUP_STATUS_OPEN;

            if ($data['next_followup'] == TRUE) { 
                $insertNextFollowup = TRUE;
                $new_followup['followup_date_en']   = $data['next_followup_date_en'];
                // echo $data['next_followup_date_en']; exit; 
                $new_followup['followup_date_np']   = get_nepali_date($data['next_followup_date_en'],'true');
            } else {
                $new_followup['followup_date_en']   = date('Y-m-d', strtotime($data['followup_date_en']. ' + 3 days'));
                $new_followup['followup_date_np']   = get_nepali_date($new_followup['followup_date_en'],'true' );
            }

            $new_followup['followup_notes']         = null;
            $new_followup['next_followup']          = $data['next_followup'];
            $new_followup['next_followup_date_en']  = $new_followup['followup_date_en'];
            $new_followup['next_followup_date_np']  = $new_followup['followup_date_np'];

            if ($insertNextFollowup) {
                $this->rest_model->insert_API('dms_customer_followups',$this->user,$new_followup);
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            $success = TRUE;
        }

        return $success;
    }

    //customer test drives json
    public function quotation_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        if($this->input->post('customer_id'))
        {
            $customer_id = $this->input->post('customer_id');
        }

        list($total, $rows) = $this->customer->get_quotations($customer_id);
        echo json_encode(array('total'=>$total,'rows'=> $rows));
        exit;
    }


    public function quotation_download_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $quotation_id = $this->input->post('quotation_id');
        if ($quotation_id == null) 
        {
            echo json_encode(array('msg'=>'Failed','success'=>false,'code'=>'101'));
            exit;
        }
        // echo json_encode(array('msg'=>'true','success'=>true,'code'=>'200','url'=> site_url('customers/quotation/'.$quotation_id)));

        $dealer_id = 0;

        $dealer_id = 0;

        $this->load->library('number_to_words');

        $data = $this->customer->get_quotation($quotation_id);
        
        $data['in_words'] = $this->number_to_words->number_to_words_nepali_format($data['quote_price']);
        $data['quote_price'] = $this->number_to_words->nepali_number_format($data['quote_price']);

        if($data['customer_discount_amount'])
        {
            $data['discount'] = $data['customer_discount_amount'];
        }
        else
        {
            $data['discount'] = $data['staff_limit'];
        }
        $data['dis_inword'] = $this->number_to_words->number_to_words_nepali_format($data['discount']);

        $data['user_id'] = $this->input->post('user_id');

        if(is_showroom_incharge_api($data['user_id']) || is_sales_executive_api($data['user_id']))
        {           
            $data['dealer_id'] = $this->input->post('dealer_id');
            $this->dealer_model->_table = "view_dealers";
            $dealer = $this->dealer_model->find(array('id'=>$data['dealer_id']));
        }
        else
        {
            $dealer = NULL;
        }

        if(isset($dealer))
        {
            if($data['dealer_id'] != 1 && $data['dealer_id'] != 2 && $data['dealer_id'] != 62 && $data['dealer_id'] !=75)
            {
                $data['firm_name'] = $dealer->name;
            }
        }
        $content=$this->load->view('customers/admin/quotation_pdf',$data,TRUE);
        echo json_encode(array('msg'=>'true','success'=>true,'code'=>'200','url'=> html_entity_decode ($content)));
        

    }

    //test drive
    public function customer_test_drives_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        if($this->input->post('customer_id'))
        {
            $customer_id = $this->input->post('customer_id');
        }

        list($total, $rows) = $this->customer->get_customer_test_drives($customer_id);
        // echo $this->db->last_query();
        echo json_encode(array('total'=>$total,'rows'=> $rows));
        exit;
    }

    //save customer test drive
    public function save_customer_test_drive_post()
    {
        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $data = $this->input->post();
        $document = $this->input->post('document');
        $data['document'] = $this->uploading_api($document,'uploads/customer_doc/');
        // echo '<pre>'; print_r($data); exit;
        list($msg, $success) = $result = $this->save_customer_test_drive_API($data);
        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;
    }


    public function save_customer_test_drive_API($data = array())
    {
        $this->user = $this->input->post('user_id');
        unset($data['user_id']);
        unset($data['token']);
        $this->db->trans_begin();

        if(empty($data['id']))
        {
            unset($data['id']);
            $data['td_date_en'] = date('Y-m-d');
            $data['td_date_np'] = get_nepali_date($data['td_date_en'],1);
            $success=$this->rest_model->insert_API('dms_customer_test_drives',$this->user,$data);
        }
        else
        {
            $success=$this->rest_model->update_API('dms_customer_test_drives',$this->user,$data['id'],$data);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg='Something Went Wrong';
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            // $msg=lang('general_success');
            $msg='Sucessfully Updated Data';

            $success = TRUE;
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;

        return array($msg, $success);
    }

    function  get_customer_discount_post()
    {
        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $id = $this->input->post('customer_id');
        $customer_info = $this->customer->get_customer($id);
        // echo '<pre>'; print_r($customer_info); exit;
        echo json_encode(array('row'=>$customer_info));

    }

    public function set_discount_post()
    {
        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $post = $this->input->post();
        $success = false;
        $approvedDiscount = 0;

        $limits = $this->discount_limit_model->find(array('vehicle_id'=>$post['vehicle_id'], 'variant_id' => $post['variant_id']));

        $this->db->or_where('approval',1);
        $this->db->or_where('approval',3);
        $this->db->where('customer_id',$post['customer_id']);
        $requestedDiscount = $this->discount_scheme_model->find();
        if($requestedDiscount)
        {
            if($requestedDiscount->approval == 1)
            {
                $approvedDiscount = $requestedDiscount->discount_request;
            }
            else if($requestedDiscount->approval == 3){
                $approvedDiscount = $requestedDiscount->reduced_discount;
            }
        }

        if(is_sales_executive_api($post['user_id']))
        {
            $success = ( $post['discount'] <= $limits->staff_limit )? TRUE: FALSE;
        }
        else if(is_showroom_incharge_api($post['user_id']))
        {
            $success = ( $post['discount'] <= $limits->incharge_limit )? TRUE: FALSE;
        }
        else if(is_sales_head_api($post['user_id'])) {
            $success = ( $post['discount'] <= $limits->sales_head_limit )? TRUE: FALSE;
        }
        else{
            $success = TRUE;
        }

        $this->db->trans_begin();
        //taking id
        // $id = $this->customer_model->find(array('customer_id'=>$post['customer_id']));
        $data = array(
            'id'    =>  $post['customer_id'],
            'discount_amount'   =>  $post['discount']
        );

        if( $success || $post['discount'] <= $approvedDiscount)
        {
            $this->rest_model->update_API('dms_customers',$post['user_id'],$data['id'],$data);
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                $msg='Update Failed';
                $success = FALSE;
            }
            else
            {
                $this->db->trans_commit();
                $msg = 'Successfully Updated Discount';
                $success = TRUE;
            }
        }
        else{
                //failure
            $msg = "Amount Exceeds than approved";
            $success = FALSE;
        }

        echo json_encode(array('success'=>$success, 'msg'=>$msg));
    }

    public function discount_post()
    {
        $customer_id= null;
        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        if($this->input->post('customer_id'))
        {
            $customer_id = $this->input->post('customer_id');
        }

        list($total, $rows) = $this->customer->get_discounts($customer_id);
        echo json_encode(array('total'=>$total,'rows'=> $rows));
        exit;
    }

    function reset_discount_post() 
    {
        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->user_id = $this->input->post('user_id');

        $customer_id = $this->input->post('customer_id');
        $data = array(
            'id'    =>  $customer_id,
            'discount_amount' => NULL
            );
        $this->db->trans_begin();

        $this->rest_model->update_API('dms_customers',$this->user_id,$data['id'],$data);

        $this->db->or_where('approval',1);
        $this->db->or_where('approval',3);
        $discount = $this->discount_scheme_model->findAll(array('customer_id'=>$customer_id));
        

        foreach ($discount as $key => $value) {
            $data = array(
                'id' => $value->id,
                'approval'=> 2
                );
            $this->rest_model->update_API('sales_discount_schemes',$this->user_id, $data['id'],$data);
        }


        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg='Something Went Wrong';
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            $msg='Successfull';
            $success = TRUE;
        }
        echo json_encode(array('msg'=>$msg,'success'=> $success));
        exit;

        // echo "<pre>"; print_r($success);exit;

        // redirect($_SERVER['HTTP_REFERER']);
    }


    public function save_discounts_request_post()
    {
        $data = $this->input->post();
        $this->user_id = $this->input->post('user_id');

        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        unset($data['user_id']);
        unset($data['token']);
        $this->db->trans_begin();

        if(empty($data['id']))
        {
            unset($data['id']);
            $success=$this->rest_model->insert_API('sales_discount_schemes',$this->user_id,$data);
        }
        else
        {
            $data['approved_date'] = date("Y-m-d");
            $success=$this->rest_model->update_API('sales_discount_schemes',$this->user_id,$data['id'],$data);
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg='Failed Please try again';
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            $msg='Discount Request Saved Successfully';
            $success = TRUE;
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success));
        exit;

        // return array($msg, $success);
    }

    public function discount_operation_post($option = NULL, $discount_id = NULL,$customer_id = NULL)
    {
        // $discount_id = ($discount_id == NULL)?$this->input->post('discount_id'):$discount_id;

        $option = $this->input->post("option");
        $discount_id = $this->input->post("discount_id");
        $reduced_discount = $this->input->post('reduced_discount');
        $customer_id = $this->input->post("customer_id");

        $this->user_id = $this->input->post('user_id');

        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        // Reduced amout taken from form

        $this->db->trans_begin();
        $data['id'] = $discount_id;
        $data['approval'] = $option;
        $data['approved_by'] = $this->user_id;
        $data['approved_date'] = date('Y-m-d');

        $discount = $this->discount_scheme_model->find(array('id'=>$discount_id));
        $discount = $discount->discount_request;
        
        $discount_vp = array(
            'id'                =>  $customer_id,
            'discount_amount'   =>  $discount
        );

        // echo '<pre>'; print_r($option); exit;

        switch ($option) {
                //Approved
            case DISCOUNT_APPROVED:
            $success = $this->rest_model->update_API('sales_discount_schemes',$this->user_id,$data['id'],$data);
            $this->rest_model->update_API('dms_customers',$this->user_id,$discount_vp['id'],$discount_vp);
            break;

                //Reject
            case DISCOUNT_REJECTED:
            $success = $this->rest_model->update_API('sales_discount_schemes',$this->user_id,$data['id'],$data);
            // $this->vehicle_process_model->update_API('sales_discount_schemes',$this->user_id,$discount_vp['id'],$discount_vp);
            break;

                //Reduce
            case DISCOUNT_REDUCED:
            $data['reduced_discount'] = $reduced_discount;
            $discount_vp['discount_amount'] = $reduced_discount;
            $success = $this->rest_model->update_API('sales_discount_schemes',$this->user_id,$data['id'],$data);
            $this->rest_model->update_API('dms_customers',$this->user_id,$discount_vp['id'],$discount_vp);
            break;

                //Forward
            case DISCOUNT_FORWARD:
            if(is_dealer_incharge_api($this->user_id))
            {
                $data['dealer_incharge_id'] = 1;
            }
            if(is_showroom_incharge_api($this->user_id))
            {
                $data['showroom_incharge_id'] = 1;
            }
            if(is_sales_head_api($this->user_id))
            {
                $data['management_incharge_id'] = 1;
            }
            if(is_manager_api($this->user_id))
            {
                $data['management_incharge_id'] = 0;
                $data['admin'] = 1;
            }

            // echo 'here'; exit;

            $success = $this->rest_model->update_API('sales_discount_schemes',$this->user_id,$data['id'],$data);
            break;

                //Delete
            // case 5:
            //     $success = $this->discount_scheme_model->delete($discount_id);
            // break;

        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg='Something Went Wrong Please Try Again';
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            $msg='Discount Updated Sucessfully';
            $success = TRUE;
        }

        echo json_encode(array('code'=>200,'msg'=>$msg,'success'=>$success));

    }

    public function print_discount_post($customer_id = NULL)
    {
        $customer_id = $this->input->post('customer_id');
        $user_token = trim($this->input->post('token'));

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->discount_scheme_model->_table = "view_discount_approved";
        $data['rows'] = $this->discount_scheme_model->find(array('customer_id'=>$customer_id));
        // $data['page'] = $this->config->item('template_admin') . "discount_slip";
        // $data['module'] = 'discount_schemes';
        // $this->load->view($data['page'], $data);
        // $content=$$this->load->view($data['page'], $data,TRUE);
        $content=$this->load->view('discount_schemes/admin/discount_slip',$data,TRUE);

        echo json_encode(array('msg'=>'true','success'=>true,'code'=>'200','url'=> html_entity_decode ($content)));
    }


    //END CRM API SECTION



    //START VEHICLE PROCESS API SECTION
    public function vehicle_process_post()
    {
        $id = $this->input->post('customer_id');
        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        if ($id==null) 
        {
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Customer Id Required'));
            return false;
            exit; 
        }

        $process_detail = $this->customer->get_customer_vehicle_process($id);

        if ($process_detail == null) 
        {
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Invalid Customer Id'));
            return false;
            exit;             
        }

        $data['process_detail'] = $process_detail;
        // $data['foc_details'] = $this->customer->get_foc_details($id);
        $data['partial_payment'] = $this->partial_payment_model->findAll(array('customer_id'=>$id));
        
        $this->foc_document_model->_table = "view_foc_details";
        $this->db->where('foc_approved_part <>',NULL);
        $details = $this->foc_document_model->get_by(array('customer_id'=>$id));
        $data['error_msg'] = FALSE;
        $accessories_name = array();
        if(!empty($details->foc_approved_part))
        {
            $accessories = $details->foc_approved_part;
            $accessories_array = explode(',', $accessories);
            foreach ($accessories_array as $value) 
            {
                $accessories_name[] = $this->foc_accessoreis_partcode_model->find(array('id'=>$value),'name');
            }
            $data['foc_details'] = $details;
            $data['accessories'] = $accessories_name;
        }
        else
        {
            $data['error_msg'] = "FOC Document Not Provided.";
        }  


        $total_partial_payment = 0;  
        foreach ($data['partial_payment'] as $key => $value){
            $total_partial_payment += $value->amount;
        } 
        if($data['process_detail']->dealer_id == 75) { 
            $discount_amt = $$data['process_detail']->customer_discount_amount;
        }
        else
        {
            if($data['process_detail']->customer_discount_amount){
                $discount_amt =  $data['process_detail']->customer_discount_amount;
            }
            else
            {
                $discount_amt = $data['process_detail']->normal_discount;
            }
        }

        $data['process_detail']->total_partial_payment = $total_partial_payment;
        $data['process_detail']->discount_amt = $discount_amt;
        $data['process_detail']->remaining_amount =  moneyFormat($data['process_detail']->quote_price - $discount_amt - $data['process_detail']->booking_amount - $total_partial_payment - $data['process_detail']->fullpayment_amount);


        $data['process_detail']->booking_receipt_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->booking_receipt_image;
        $data['process_detail']->quotation_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->quotation_image;
        $data['process_detail']->vehicle_details_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->vehicle_details_image;
        $data['process_detail']->do_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->do_image;
        $data['process_detail']->downpayment_receipt_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->downpayment_receipt_image;
        $data['process_detail']->deliverysheet_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->deliverysheet_image;
        $data['process_detail']->creditnote_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->creditnote_image;
        $data['process_detail']->bluebook_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->bluebook_image;
        $data['process_detail']->vat_bill_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->vat_bill_image;
        $data['process_detail']->fullpayment_receipt_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->fullpayment_receipt_image;
        $data['process_detail']->insurance_image_file = base_url().'uploads/customer/'.$id.'/'.$data['process_detail']->insurance_image;

        // echo '<pre>'; print_r($data); exit;

        echo json_encode(array('code'=>'200','success'=>true,'msg'=>'Success','data'=>$data));

    }    


    public function generate_document_post()
    {
        $id = $this->input->post('customer_id');
        $doc_type = ($this->input->post('doc_type'))?$this->input->post('doc_type'):NULL;
        $loan_amount = ($this->input->post('loan_amount'))?$this->input->post('loan_amount'):NULL;
        $this->user_id = ($this->input->post('user_id'))?$this->input->post('user_id'):NULL;
        $dealer_id = ($this->input->post('dealer_id'))?$this->input->post('dealer_id'):NULL;

        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        $this->load->library('number_to_words');
        $data['info'] = $this->customer->get_customer_vehicle_process($id);

        if(is_showroom_incharge_api($this->user_id) || is_sales_executive_api($this->user_id))
        {           
            // $dealer_id = $this->session->userdata('employee')['dealer_id'];
            $this->dealer_model->_table = "view_dealers";
            $dealer = $this->dealer_model->find(array('id'=>$dealer_id)); 
        }
        else
        {
            $dealer = NULL;
        }

        $number = ($data['info']->customer_discount_amount)?$data['info']->customer_discount_amount:$data['info']->normal_discount;
        if(@$dealer_id == 75)
        {
            if($data['info']->vehicle_id == 1 && $data['info']->variant_id == 8)
            {
                if($data['info']->customer_discount_amount)
                {
                    $data['actual_price'] = $data['info']->price - $data['info']->customer_discount_amount;
                }
                else
                {
                    $data['actual_price'] = $data['info']->price;
                }
            }
            else
            {
                $data['actual_price'] = $data['info']->price;

            }
        }
        else
        {
            $data['actual_price'] = $data['info']->price - $number;
        }
        
        $price = $data['info']->price;
        $data['discount_amount'] = $this->number_to_words->number_to_words_nepali_format($number);
        $data['price_word'] = $this->number_to_words->number_to_words_nepali_format($price);
        $data['booking_word'] = $this->number_to_words->number_to_words_nepali_format($data['info']->booking_amount);
        $data['acutal_price_words'] = $this->number_to_words->number_to_words_nepali_format($data['actual_price']);
        $data['loan_amount']= $loan_amount;

        if(isset($dealer))
        {
            if($dealer->id != 1 && $dealer->id != 2 && $dealer->id != 62 && $dealer_id !=75)
            {               
                $data['info']->firm = $dealer->name;
            }
        }
        if($doc_type == 1)
        {
            $data['page'] = $this->config->item('template_admin') . "vehicle_detail_app";  

        }
        elseif($doc_type == 2)
        {
            $data['page'] = $this->config->item('template_admin') . "credit_note";  

        }
        elseif($doc_type == 3)
        {
            $data['page'] = $this->config->item('template_admin') . "vat_bill";  

        }
        elseif($doc_type == 4)
        {
            if(!$data['info']->booking_amount)
            {
                // flashMsg('error', 'Booking Amount Missing.');     
                // redirect($_SERVER['HTTP_REFERER']);
                echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Booking Amount Does not Exist'));
                return false;
                exit;
            }
            else
            {
                $data['page'] = $this->config->item('template_admin') . "order_confirmation_app";               
            }
        }

        else
        {
            $data['page'] = $this->config->item('template_admin') . "delivery_sheet_app";  

        }
        // $data['module'] = 'customers';
        // $this->load->view($data['page'], $data);

        $content=$this->load->view('customers/'.$data['page'],$data,TRUE);

        echo json_encode(array('msg'=>'true','success'=>true,'code'=>'200','url'=> html_entity_decode ($content)));

    }

    public function save_document_post()
    {
        $document_type = $this->input->post('document_type');
        $data['id'] = $this->input->post('vehicle_process_id');
        $customer_id = $this->input->post('customer_id');
        $this->user_id = $this->input->post('user_id');
        if($document_type == 'do')
        {
            $data['do_image'] = $this->uploading_api($this->input->post('image_name'),"uploads/customer/".$customer_id.'/');
            $data['do_received_date'] = date('Y-m-d');
        }
        if($document_type == 'bluebook')
        {
            $data['bluebook_image'] = $this->uploading_api($this->input->post('image_name'),"uploads/customer/".$customer_id.'/');
            $data['bluebook_received_date'] = date('Y-m-d');
        }
        if($document_type == 'insurance')
        {
            $data['insurance_image'] = $this->uploading_api($this->input->post('image_name'),"uploads/customer/".$customer_id.'/');
            $data['insurance_received_date'] = date('Y-m-d');
        }
        if($document_type == 'creditnote')
        {
            $data['creditnote_image'] = $this->uploading_api($this->input->post('image_name'),"uploads/customer/".$customer_id.'/');
        }
        if($document_type == 'delivery_sheet')
        {
            $data['deliverysheet_image'] = $this->uploading_api($this->input->post('image_name'),"uploads/customer/".$customer_id.'/');
        }
        if($document_type == 'vatbill')
        {
            $data['vat_bill_image'] = $this->uploading_api($this->input->post('image_name'),"uploads/customer/".$customer_id.'/');
        }

        $success = $this->save_document_api($data);
        echo json_encode(array('code'=>'200','success'=>true,'msg'=>'Sucessfully uploaded file'));
        // ;
    }

    public function save_document_api($data)
    {
        $success = $this->rest_model->update_API('sales_vehicle_process',$this->user_id,$data['id'],$data);
        // echo json_encode(array('success'=>$success));
        // exit;
        return $success;
    }



    public function remove_image_post($id = NULL,$image_index = NULL,$customer_id = NULL,$image_name = NULL)
    {   
        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $id = $this->input->post('id');
        $image_index = $this->input->post('image_index');
        $customer_id = $this->input->post('customer_id');
        $image_name = $this->input->post('image_name');
        $user_id = $this->input->post('user_id');
        $data['id'] = $id;
        $data[$image_index] = NULL;
        $this->rest_model->update_API('sales_vehicle_process',$user_id,$data['id'],$data);
        // $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/customer/'.$customer_id.'/'.$image_name;
        // unlink($path);

        echo json_encode(array('code'=>'200','success'=>true,'msg'=>'Sucessfully deleted file'));
        

    }


    public function get_stock_delivery_sheet_post()
    {
        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $vehicle_id = $this->input->post('vehicle_id');
        $variant_id = $this->input->post('variant_id');
        $color_id = $this->input->post('color_id');
        $dealer_id = $this->input->post('dealer_id');

        // $dealer_id = $this->session->userdata('employee')['dealer_id'];

        $stock_records = $this->customer->get_stock_records($dealer_id,$vehicle_id,$variant_id,$color_id);
        echo json_encode($stock_records);
    }



    public function generate_deliverysheet_post()
    {
        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        // echo '<pre>'; print_r($this->input->post()); exit; 
        $user_id = $this->input->post('user_id');
        $dealer_id = $this->input->post('dealer_id');

        $this->load->model('stock_records/stock_record_model');
        $data['id'] = $this->input->post('vehicle_process_id');
        $data['msil_dispatch_id'] = $this->input->post('msil_dispatch_id');
        $data['vehicle_delivery_date'] = date('Y-m-d');
        $data['vehicle_delivery_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
        $customer_id = $this->input->post('customer_id');
        // $success = $this->Vehicle_process_model->update($data['id'],$data);
        $success = $this->rest_model->update_API('sales_vehicle_process',$user_id,$data['id'],$data);

        if($success == true)
        {
            list($fiscal_year_id, $fiscal_year) = get_current_fiscal_year();
            
            $value['id'] = $this->input->post('stock_id');
            $value['dispatched_date'] = date('Y-m-d');
            $value['dispatched_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
            $np_dates = explode('-', $value['dispatched_date_np']);
            //$value['dispatched_date_np_month'] = $np_dates[1];
            $value['retail_fiscal_year'] = $fiscal_year;
            $value['dispatched_date_np_month'] = ltrim($np_dates[1], '0');
            $value['dispatched_date_np_year'] = $np_dates[0];
            $success1 = $this->rest_model->update_API('log_stock_records',$user_id,$value['id'],$value);

            // $success1 = $this->stock_record_model->update($value['id'],$value);

            $vehicle_detail = $this->stock_record_model->find(array('id'=>$value['id']));
            $this->change_current_location_api($vehicle_detail->vehicle_id,'customer','retail',$user_id);
            $dispatch_id = $this->dispatch_dealer_model->find(array('vehicle_id'=>$data['msil_dispatch_id']),'id');

            // $dealer_id = $this->session->userdata('employee')['dealer_id'];
        }

        if($success1== true)
        {
            $customerStatusData['customer_id']      = $customer_id; 
            $customerStatusData['status_id']        = 15; 
            $customerStatusData['sub_status_id']    = 21; 
            $customerStatusData['duration']         = 0;
            $customerStatusData['notes']            = 'Vehicle Retailed'; 

        // calculate duration between status change
            $this->db->where('customer_id', $customer_id);
            $this->db->order_by('created_at','desc');

            $oldStatusResult = $this->customer_status_model->findAll();

            if ($oldStatusResult) {
                $date1 = date_create($oldStatusResult[0]->created_at);
                $date2 = date_create(date('Y-m-d H:i:s'));

                $diff = date_diff($date1, $date2);
                $customerStatusData['duration'] = $diff->format("%a");
            }
            $this->rest_model->insert_API('dms_customer_statuses',$user_id,$customerStatusData);
            
            // $this->customer_status_model->insert($customerStatusData);

            $ccd['customer_id'] = $customer_id;
            // $this->ccd_threeday_model->insert($ccd);
            // $this->ccd_thirtyday_model->insert($ccd);
            // $this->ccd_sixtyday_model->insert($ccd);
            $this->rest_model->insert_API('ccd_threeday',$user_id,$ccd);
            $this->rest_model->insert_API('ccd_thirtyday',$user_id,$ccd);
            $this->rest_model->insert_API('ccd_sixtyday',$user_id,$ccd);

            echo json_encode(array('code'=>200,'msg'=>'Delivery Sheet Generate Successfully', 'success'=>true));

            // $this->generate_document($customer_id,'no use',5);
        }

    }

    public function change_current_location_api($vehicle_id,$location,$status,$user_id){

        // $this->load->model('dispatch_records/dispatch_record_model');

        $data['id'] = $vehicle_id;
        $data['current_location'] = $location;
        $data['current_status'] = $status;

        $success = $this->rest_model->update_API('msil_dispatch_records',$user_id,$data['id'], $data);

        return $success;
    }

    public function save_name_transfer_post()
    {
        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $user_id = $this->input->post('user_id');
        $foc['customer_id'] = $this->input->post('customer_id');
        if($this->input->post('name_transfer') == 'true')
        {
            $foc['name_transfer'] = 1;        
        }
        else
        {
            $foc['name_transfer'] = 0;        
        }
        if($this->input->post('road_tax_amount'))
            $foc['road_tax'] = $this->input->post('road_tax_amount');

        $checker = $this->foc_document_model->find(array('customer_id'=>$foc['customer_id']));
        if(!empty($checker))
        {
            $foc['id'] = $checker->id;
            $success = $this->rest_model->update_API('sales_foc_document',$user_id,$foc['id'],$foc);
        }
        else
        {
            $success = $this->rest_model->insert_API('sales_foc_document',$user_id,$foc);
        }

        if ($success)
        {
            // $this->db->trans_rollback();
            $msg='Successfully updated name transfer';
            $success = TRUE;
        }
        else
        {
            $msg='Something Went Wrong';
            $success = FALSE;
            // $this->db->trans_commit();
        }
        echo json_encode(array('msg'=>$msg, 'success'=>$success));
    }

    // public function save_foc_doc()
    // {
    //     $success = $this->customer->save_foc_details($this->input->post());
    //     echo json_encode($success);
    //     exit;
    // }


    public function save_foc_detail_post()
    {   

        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $user_id = $this->input->post('user_id');

        $data = $this->input->post();

        $approval_type = 0;

        $this->load->model('foc_documents/foc_document_model');
        $this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');
        $this->load->model('foc_requests/foc_request_model');

        if($this->input->post('customer_id'))
            $foc['customer_id'] = $data['customer_id'];

        if($this->input->post('fuel'))
            $foc['fuel'] = $data['fuel'];

        if($this->input->post('free_servicing_coupon'))
            $foc['free_servicing'] = $data['free_servicing_coupon'];

         // $data['accessories_list'] = trim('[',$data['accessories_list']);
         // $data['accessories_list'] = trim(']',$data['accessories_list']);
        $array_explode = explode(',', $data['accessories_list']);

        // echo '<pre>'; print_r($array_explode); exit;
        foreach ($array_explode as $key => $value) 
        {
            $partcode[] = $this->foc_accessoreis_partcode_model->find(array('id'=>$value));
        }

        foreach ($partcode as $key => $approval) 
        {
            if($approval->approval != 0 )
            {
                $app_required[] = $approval->id;
                if($approval_type < $approval->approval){
                    $approval_type = $approval->approval;
                }
            }       
        }

        $checker = $this->foc_document_model->find(array('customer_id'=>$foc['customer_id']));
        $this->db->trans_begin();
        if(!empty($checker))
        {
            $foc['id'] = $checker->id;
            $this->rest_model->update_API('sales_foc_document',$user_id,$foc['id'],$foc);
            $success1 = $checker->id;
        }
        else
        {
            $success1 = $this->rest_model->insert_API('sales_foc_document',$user_id,$foc);
        }
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $msg=lang('general_failure');
            $success = FALSE;
        }
        else
        {
            $this->db->trans_commit();
            $msg=lang('general_success');
            $success = TRUE;
        }

        if(empty($app_required))
        {
            $req['foc_id'] = $success1;
            $req['customer_id'] = $data['customer_id'];
            $req['foc_approved_part'] = $data['accessories_list'];
            $req['approved_date'] = date('Y-m-d'); 
            $req['approved_date_nep'] = get_nepali_date(date('Y-m-d'),'nep'); 
            $this->rest_model->insert_API('sales_foc_request',$user_id,$req); 
        }
        else
        {
            $success = 'approve';       
        }

        if($success == 'approve'){
            $foc_app['foc_request_part'] = $data['accessories_list'];
            $foc_app['customer_id'] = $foc['customer_id'];
            $foc_app['request_date'] = date('Y-m-d');
            $foc_app['request_date_nep'] = get_nepali_date(date('Y-m-d'),'nep'); 
            $foc_app['approval_type'] = $approval_type;
            $success = $this->rest_model->insert_API('sales_foc_request',$user_id,$foc_app);
           
        }

        echo json_encode(array('msg'=>$msg,'success'=>$success,'required'=>$data['accessories_list'],'approval_type' => $approval_type));
    }

    public function get_Accessories_partcode_list_post()
    {

        $this->load->model('foc_accessoreis_partcodes/foc_accessoreis_partcode_model');

        $vehicle_id = $this->input->post('vehicle_id');

        $this->foc_accessoreis_partcode_model->order_by('name asc');
        $rows = $this->foc_accessoreis_partcode_model->findAll(array('vehicle_id'=>$vehicle_id),array('id','name','part_code'));

        echo json_encode($rows);
    }


    public function save_receipt_post()
    {
        // echo '<pre>'; print_r($this->input->post()); exit;
        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $customer_id = $this->input->post('customer_id');
        $user_id = $this->input->post('user_id');
        $receipt_type = $this->input->post('receipt_type');
        $images = $this->uploading_api($this->input->post('image_name'),"uploads/customer/".$customer_id.'/');
        if ($receipt_type == 1)
        {
            $data['id'] = $this->input->post('vehicle_process_id');
            $data['booking_receipt_no'] = $this->input->post('receipt_no');            
            $data['booking_amount'] = $this->input->post('amount');            
            $data['booking_receipt_image'] = $images;


            $cus['special_discount_amount'] = ($this->input->post('customer_discount'))?$this->input->post('customer_discount'):NULL;
            $cus['id'] = $customer_id;
            $this->rest_model->update_API('dms_customers',$user_id,$cus['id'],$cus);

        }
        elseif ($receipt_type == 2)
        {
            $data['vehicle_process_id'] = $this->input->post('vehicle_process_id');            
            $data['customer_id'] = $this->input->post('customer_id');            
            $data['receipt_no'] = $this->input->post('receipt_no');            
            $data['amount'] = $this->input->post('amount');            
            $data['receipt_image'] = $images;            
            $data['payment_date']  = date('Y-m-d');
            $data['payment_date_nep']  = get_nepali_date(date('Y-m-d'),'nepali');
        }
        else
        {
            $data['id'] = $this->input->post('vehicle_process_id');
            $data['fullpayment_receipt_no'] = $this->input->post('receipt_no');            
            $data['fullpayment_amount'] = $this->input->post('amount');            
            $data['fullpayment_receipt_image'] = $images;            
            $data['fullpayment_date']  = date('Y-m-d');     

        }

        if($receipt_type == 2){
            $success = $this->rest_model->insert_API('sales_partial_payment',$user_id,$data);
        }
        else
        {
            $success = $this->rest_model->update_API('sales_vehicle_process',$user_id,$data['id'],$data);
        }
        if($success){
            $msg = 'Receipt Saved Successfully';
            $success = TRUE;
        }else{
            $msg = 'Something Went Wrong! Please try again';
            $success = False;

        }
        echo json_encode(array('success'=>$success,'msg'=>$msg));
    }


    public function save_discount_post()
    {
        $user_token = $this->input->post('token');

        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $data['special_discount_amount'] = ($this->input->post('discountamount'))?$this->input->post('discountamount'):NULL;
        $data['id'] = $this->input->post('customer_id');
        $user_id = $this->input->post('user_id');

        $success = $this->rest_model->update_API('dms_customers',$user_id,$data['id'],$data);

        if($success)
        {
            $success = TRUE;
            $msg = 'Discount Updated Successfully';
        }else{
            $success = FALSE;
            $msg = 'something went wrong please try again';

        }
        echo json_encode(array('success'=> $success,'msg' => $msg));
    }
    
    //END VEHICLE PROCESS API SECTION\




    // DIscount Scheme
    public function discount_scheme_post()
    {

        $user_id = (int) $this->input->post('user_id');
        // $executive_id = (int) $this->input->post('executive_id');
        $dealer_id = (int) $this->input->post('dealer_id');
        $page = (int)$this->input->post('page');


        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $this->discount_scheme_model->_table = 'view_sales_discount_schemes';
        $where = NULL;

        if(is_sales_executive_api($user_id)) {
            $where = array('created_by'=>$user_id);
        }
        else if(is_dealer_incharge_api($user_id)) {
            $where = array('incharge_id' => $user_id, 'approval' => null);
        }
        else if (is_showroom_incharge_api($user_id)) {
             $where = array('dealer_id' => $dealer_id, 'approval' => null);
        }
        else if(is_sales_head_api($user_id)) {
            // $where = array('dealer_incharge_id' => 1, 'approval' => 4);
            //$where = "dealer_incharge_id = 1 OR showroom_incharge_id = 1 AND approval = 4  AND management_incharge_id IS NULL";
            $where = "(dealer_incharge_id = 1 OR showroom_incharge_id = 1 AND approval = 4  AND management_incharge_id IS NULL) AND (dealer_id = 1 OR dealer_id = 2)";

        }       
        else if(is_manager_api($user_id)) {
            // $where = array('management_incharge_id' => 1, 'approval' => 4);
            $where = "(management_incharge_id = 1 AND approval = 4) AND (dealer_id = 1 OR dealer_id = 2)";
        }
        else{
            $where = array('admin' => 1, 'approval' => 4);
        }

        // $where['approval'] = null;

        // search_params();

        $total=$this->discount_scheme_model->find_count($where);

        // paging('id','desc');

        // search_params();

        $rows=$this->discount_scheme_model->findAll($where,null,'id desc',$page,10);

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }
    //End Discount Scheme

    //FOC API
    public function foc_request_post()
    {

        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $dealer_id = $this->input->post('dealer_id');
        $user_id = $this->input->post('user_id');
        $page = (int)$this->input->post('page');

        $where = '1=1';
        if(is_showroom_incharge_api($user_id) || is_dealer_incharge_api($user_id) || is_sales_executive_api($user_id))
        {
            $where = '(dealer_id = '.$dealer_id.')';
            if($dealer_id == 1 || $dealer_id == 2 || $dealer_id == 111){
                $where .= ' AND approval_type <> 2';
            }
        }
        elseif(is_sales_head_api($user_id)) {
            $where = "(dealer_id = 1 OR dealer_id = 2)";
        }
        
        // search_params();

        $this->foc_request_model->_table = "view_foc_request";

        $this->db->where($where);
        $total=$this->foc_request_model->find_count(array('approved_date'=>NULL));

        // paging('id');

        // search_params();
        $this->db->where($where);
        $rows=$this->foc_request_model->findAll(array('approved_date'=>NULL),null,'id desc',$page,10);
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function get_foc_request_post()
    {

        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $req_id = $this->input->post('id');
        $request_part = $this->foc_request_model->find(array('id'=>$req_id));
        $req_array = explode(',',$request_part->foc_request_part);

        $list_req = array();
        foreach ($req_array as $key => $value) 
        {
            $foc_accessories = $this->foc_accessoreis_partcode_model->find(array('id'=>$value));
            $list_req[$key]['id'] = $foc_accessories->id;
            $list_req[$key]['name'] = $foc_accessories->name;
        }
        echo json_encode($list_req);    
    }

    public function save_foc_approve_details_post()
    {
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        $user_id = $this->input->post('user_id');
        // $data=$this->_get_posted_data(); //Retrive Posted Data
        $data=array();
        if($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
        }
        $data['foc_approved_part'] = $this->input->post('foc_approved_part');
        $data['approved_date'] = date('Y-m-d');
        $data['approved_date_nep'] = get_nepali_date(date('Y-m-d'),'nep');

        if(!$this->input->post('id'))
        {
            $success=$this->rest_model->insert_API('sales_foc_request',$user_id,$data);
        }
        else
        {
            $success=$this->rest_model->update_API('sales_foc_request',$user_id,$data['id'],$data);
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


    public function foc_document_post()
    {
        $dealer_id = $this->input->post('dealer_id');
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');

        $this->foc_document_model->_table = "view_foc_details";
        $details = $this->foc_document_model->find(array('customer_id'=>$id));

        $accessories_name = array();
        $accessories = $details->foc_approved_part;
        if(!$accessories){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $accessories_array = explode(',', $accessories);
        foreach ($accessories_array as $value) 
        {
            $accessories_name[] = $this->foc_accessoreis_partcode_model->find(array('id'=>$value),'name');
        }
        if(is_showroom_incharge_api($user_id) || is_sales_executive_api($user_id))
        {           
            // $dealer_id = $this->session->userdata('employee')['dealer_id'];
            $this->dealer_model->_table = "view_dealers";
            $dealer = $this->dealer_model->find(array('id'=>$dealer_id));

        }
        else
        {
            $dealer = NULL;
        }

        if(isset($dealer))
        {
            if($dealer->id != 1 && $dealer->id != 2 && $dealer->id != 62 && $dealer->id != 75)
            {               
                $details->firm_name = $dealer->name;
            }
        }

        $data['rows'] = $details;
        $data['accessories'] = $accessories_name;
        // $data['page'] = $this->config->item('template_admin') . "foc_document";
        // $data['module'] = 'customers';

        $content=$this->load->view('customers/'.$this->config->item('template_admin') . "foc_document_app",$data,TRUE);
        echo json_encode(array('msg'=>'true','success'=>true,'code'=>'200','url'=> html_entity_decode ($content)));
        // $this->load->view($data['page'], $data);
    }
    //FOC API END


    // Home Page Follow Up

    public function all_followup_json_post()
    {
        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $dealer_id = $this->input->post('dealer_id');
        $executive_id = $this->input->post('executive_id');
        $page =$this->input->post('page');
        // $token = $this->input->post('token');
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        $start_date = date("Y-m-d 00:00:00",strtotime("-3 days"));
        $end_date   = date("Y-m-d 23:59:59");

        $this->load->model('customers/customer_followup_model');
        $this->customer_followup_model->_table = 'view_followup_schedule_app';
        
        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;

        $dealer_list    = (is_dealer_incharge_api($user_id)) ? get_dealer_list_api($user_id) : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge_api($user_id)) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive_api($user_id)) ? TRUE : NULL; 
        }

        $total = 0;
        if($user_id != 108 || $status != 'pending'){

            if(!empty($dealer_list)) {
                $this->db->where_in('dealer_id', $dealer_list);
                
            } elseif ($is_showroom_incharge) {
                $this->db->where('dealer_id', $dealer_id);
            } elseif ($is_sales_executive) {
                $this->db->where('executive_id', $executive_id);
            }

            if($status == 'today'){
                $where = "followup_date_en >= '".date('Y-m-d')."'";
                // $this->db->where('followup_date_en >=',date('Y-m-d')); 
            }else{
                // $this->db->where('followup_date_en <=',date('Y-m-d')); 
                $where = "(followup_date_en <= '".date('Y-m-d')."' AND (followup_status <> 'Completed' AND followup_status <> 'Postponed' ))";

            }
            //ENDS 

            // $this->db->where('followup_date_en >=', $start_date);

            $this->db->where("(status_name = 'Pending' OR status_name = 'Booked' OR status_name= 'Confirmed')", NULL, False);
            $this->db->where('followup_date_en <=', $end_date);
            $this->db->where('followup_status', 'Open');
        // search_params();
        // if (d.compareTo(Date.parse('today')) >= 0 ) {
        //     return;
        // } else if ( d.compareTo(Date.parse('yesterday')) == 0) {
        //     if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
        //         return 'cls-yellow';
        //     }
        // } else {
        //     if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
        //         return 'cls-red';
        //     }
        // }

            $total=$this->customer_followup_model->find_count($where);
        }
        $rows = [];
        if($user_id != 108 || $status != 'pending'){
            // ACCESS LEVEL CHECK STARTS
            $is_showroom_incharge = NULL;
            $is_sales_executive = NULL;

            $dealer_list    = (is_dealer_incharge_api($user_id)) ? get_dealer_list_api($user_id) : NULL; 
            
            if (empty($dealer_list)) {
                $is_showroom_incharge = (is_showroom_incharge_api($user_id)) ? TRUE : NULL; 
                $is_sales_executive = (is_sales_executive_api($user_id)) ? TRUE : NULL; 
            }

            if(!empty($dealer_list)) {
                $this->db->where_in('dealer_id', $dealer_list);
                
            } elseif ($is_showroom_incharge) {
                $this->db->where('dealer_id', $dealer_id);
            } elseif ($is_sales_executive) {
                $this->db->where('executive_id', $executive_id); 
            }


            //ENDS 

            // paging('followup_date_en');

            // $this->db->where('followup_date_en >=', $start_date);
            $this->db->where("(status_name = 'Pending' OR status_name = 'Booked' OR status_name= 'Confirmed')", NULL, False);
            $this->db->where('followup_date_en <=', $end_date);
            $this->db->where('followup_status', 'Open');
        // search_params();
        // $this->db->order_by('followup_date_en','desc');
        
            $rows = $this->customer_followup_model->findAll($where,null,'followup_date_en desc',$page,10);
            
        }
        // echo $this->db->last_query(); exit;
        echo json_encode(array('success' => true, 'rows' =>$rows, 'total' => $total));     
    
    }    


    public function get_dealer_orders_post()
    {
        $id = $this->input->post('user_id');
        $dealer_id = $this->input->post('dealer_id');
        $page = $this->input->post('page');
        // $page = $this->input->post('engine_no');
        // $page = $this->input->post('chass_no');
        // $page = $this->input->post('vehicle_id');
        // $page = $this->input->post('variant_id');
        // $page = $this->input->post('color_id');

        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }
        $where = '1 = 1';
        // $id = (string)$this->_user_id;         
        if(is_dealer_incharge_api($id))
        {
            $where = 'incharge_id ='.$id;
        }
        if(is_showroom_incharge_api($id))
        {
            // $dealer_id = $this->session->userdata('employee')['dealer_id'];
            $where = "(created_by = '".$id."' OR dealer_id = '".$dealer_id."')";
        }

        $this->db->where($where);
         if($this->input->post('engine_no')){
            $engine_no = $this->input->post('engine_no');
            $this->db->like('engine_no',$engine_no);
        }
        if($this->input->post('chass_no')){
            $chass_no = $this->input->post('chass_no');
            $this->db->like('chass_no',$chass_no);
        }
        if($this->input->post('vehicle_id') != 'null'){
            $vehicle_id = (int)$this->input->post('vehicle_id');
            $this->db->where('vehicle_id',$vehicle_id);

        }
        if($this->input->post('variant_id') != 'null'){
            $variant_id = (int)$this->input->post('variant_id');
            $this->db->where('variant_id',$variant_id);
        }
        if($this->input->post('color_id') != 'null'){
            $color_id = (int)$this->input->post('color_id');
            $this->db->where('color_id',$color_id);
        }
        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';
        // search_params();

        $total=$this->dealer_order_model->find_count(array('cancel_date_np'=>NULL,'is_ktm_dealer'=>0));

        $this->db->where($where);
         if($this->input->post('engine_no')){
            $engine_no = $this->input->post('engine_no');
            $this->db->like('engine_no',$engine_no);
        }
        if($this->input->post('chass_no')){
            $chass_no = $this->input->post('chass_no');
            $this->db->like('chass_no',$chass_no);
        }
        if($this->input->post('vehicle_id') != 'null'){
            $vehicle_id = (int)$this->input->post('vehicle_id');
            $this->db->where('vehicle_id',$vehicle_id);

        }
        if($this->input->post('variant_id') != 'null'){
            $variant_id = (int)$this->input->post('variant_id');
            $this->db->where('variant_id',$variant_id);
        }
        if($this->input->post('color_id') != 'null'){
            $color_id = (int)$this->input->post('color_id');
            $this->db->where('color_id',$color_id);
        }
        $rows=$this->dealer_order_model->findAll(array('cancel_date_np'=>NULL,'is_ktm_dealer'=>0),null,'order_id desc',$page,10);

        foreach ($rows as $key => $value) {
            // print_r($value);
            if($value->order_status != 'Dispatched'){
                $stock_status = array();
                list ($stock_status, $in_stock_remarks) = $this->order_stock_availability($value->order_id, $value->vehicle_id, $value->variant_id, $value->color_id, $value->year, $value->is_ktm_dealer);
                $rows[$key]->stock_status = $stock_status;
                $rows[$key]->in_stock_remarks = $in_stock_remarks;

                
            }
        }
        
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }


    private function order_stock_availability($order_id='', $vehicle_id='', $variant_id='', $color_id='', $mfg_year='', $is_ktm_dealer='')
    {
        $where = array(
            'vehicle_id' => $vehicle_id,
            'variant_id' => $variant_id,
            'color_id' => $color_id,
            'mfg_year' => $mfg_year,
        );

        $this->db->where('current_location <>','KATHMANDU');
        $this->db->where('current_status','Stock');
        $current_stock_count = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));
        /*// for no stock with cg
        print_r($this->db->last_query());echo '<br><br><br>';
        if($current_stock_count == 0){
            return array(0=>'No Stock',1=>0);
        }*/

//         echo '<pre>';
// print_r($this->db->last_query()); 
// exit;

        $this->dealer_order_model->_table = 'view_dealer_dispatch_request';
        $order_count = $this->dealer_order_model->find_count(array(
            'vehicle_id'=>$vehicle_id,
            'variant_id'=>$variant_id,
            'color_id'=>$color_id,
            'year'=> $mfg_year, 
            'order_id < '=>$order_id, 
            'credit_control_approval' => 1, 
            'order_status <>' => 'Dispatched',
            "is_ktm_dealer" => 0,
            "cancel_date" => NULL));
        // for in stock
        // print_r($current_stock_count);
        // print_r($order_count);
        // exit;
        if($current_stock_count > $order_count){
            return array(0=>'In Stock',1=>1);
        }

        //for in transit
        // $this->db->where('current_status','Transit');
        $this->db->where("(current_status = 'Transit' OR current_status = 'Custom')");
        $transit_not = $this->Dispatch_record_model->find_count(array('vehicle_id'=>$vehicle_id,'variant_id'=>$variant_id,'color_id'=>$color_id,'year'=>$mfg_year));

        if($current_stock_count + $transit_not - $order_count > 0){
            return array(0=>'In Transit',1=>2);
        }

        // for no stotck
        return array(0=>'No Stock',1=>0);

    }



    public function dealer_stock_json_post() {
        $this->load->model('dealers/dealer_model');

        $id = $this->input->post('user_id');
        $dealer_id = $this->input->post('dealer_id');
        $page = $this->input->post('page');

        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        // $where = '1 = 1';

        // $emp_details = $this->session->all_userdata();
        $this->stock_record_model->_table = 'view_dealer_stock';

        // $user_id = $this->_user_id;
        if(is_showroom_incharge_api($id))
        {
            // $dealer_id =  $dealer_id = $emp_details['employee']['dealer_id'];
            $where = "(dealer_id = {$dealer_id} AND (current_status = 'Bill' OR current_status='Domestic Transit'))";
        }
        else if(is_dealer_incharge_api($id))
        {
            $where = "(incharge_id = {$id} AND (current_status = 'Bill' OR current_status='Domestic Transit'))";
        }
        else
        {
            $where = "((current_status = 'Bill' OR current_status='Domestic Transit'))";   
        }

        // search_params();

        $this->db->where($where);
        if($this->input->post('engine_no')){
            $engine_no = $this->input->post('engine_no');
            $this->db->like('engine_no',$engine_no);
        }
        if($this->input->post('chass_no')){
            $chass_no = $this->input->post('chass_no');
            $this->db->like('chass_no',$chass_no);
        }
        // if($this->input->post('vehicle_id')){
        //     $vehicle_id = (int)$this->input->post('vehicle_id');
        //     $this->db->where('vehicle_name',$vehicle_id);

        // }
        // if($this->input->post('variant_id')){
        //     $variant_id = (int)$this->input->post('variant_id');
        //     $this->db->where('variant_name',$variant_id);
        // }
        // if($this->input->post('color_id')){
        //     $color_id = (int)$this->input->post('color_id');
        //     $this->db->where('color_name',$color_id);
        // }
        $total = $this->stock_record_model->find_count();
        // paging('id');

        // search_params();
        $this->db->where($where);
        if($this->input->post('engine_no')){
            $engine_no = $this->input->post('engine_no');
            $this->db->like('engine_no',$engine_no);
        }
        if($this->input->post('chass_no')){
            $chass_no = $this->input->post('chass_no');
            $this->db->like('chass_no',$chass_no);
        }
        // if($this->input->post('vehicle_id')){
        //     $vehicle_id = (int)$this->input->post('vehicle_id');
        //     $this->db->where('vehicle_name',$vehicle_id);

        // }
        // if($this->input->post('variant_id')){
        //     $variant_id = (int)$this->input->post('variant_id');
        //     $this->db->where('variant_name',$variant_id);
        // }
        // if($this->input->post('color_id')){
        //     $color_id = (int)$this->input->post('color_id');
        //     $this->db->where('color_name',$color_id);
        // }
        $rows = $this->stock_record_model->findAll(null,null,'id desc',$page,10);
        // echo $this->db->last_query(); exit;
        echo json_encode(array('total' => $total, 'rows' => $rows));
        exit;
    }


 	public function pending_followup_count_post()
    {
        // $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        $dealer_id = $this->input->post('dealer_id');
        $executive_id = $this->input->post('executive_id');
        // $page =$this->input->post('page');
        // $token = $this->input->post('token');
        $user_token = trim($this->input->post('token'));
        if($user_token == NULL || $user_token == ''){
            echo json_encode(array('code'=>'101','success'=>false,'msg'=>'Token expired'));
            return false;
            exit;
        }

        $start_date = date("Y-m-d 00:00:00",strtotime("-3 days"));
        $end_date   = date("Y-m-d 23:59:59");

        $this->load->model('customers/customer_followup_model');
        $this->customer_followup_model->_table = 'view_followup_schedule_app';
        
        // ACCESS LEVEL CHECK STARTS
        $is_showroom_incharge = NULL;
        $is_sales_executive = NULL;

        $dealer_list    = (is_dealer_incharge_api($user_id)) ? get_dealer_list_api($user_id) : NULL; 
        
        if (empty($dealer_list)) {
            $is_showroom_incharge = (is_showroom_incharge_api($user_id)) ? TRUE : NULL; 
            $is_sales_executive = (is_sales_executive_api($user_id)) ? TRUE : NULL; 
        }

        if(!empty($dealer_list)) {
            $this->db->where_in('dealer_id', $dealer_list);
            
        } elseif ($is_showroom_incharge) {
            $this->db->where('dealer_id', $dealer_id);
        } elseif ($is_sales_executive) {
            $this->db->where('executive_id', $executive_id);
        }

        $where = "(followup_date_en <= '".date('Y-m-d')."' AND (followup_status <> 'Completed' AND followup_status <> 'Postponed' ))";


        // $this->db->where('followup_date_en >=', $start_date);

        $this->db->where("(status_name = 'Pending' OR status_name = 'Booked' OR status_name= 'Confirmed')", NULL, False);
        $this->db->where('followup_date_en <=', $end_date);
        $this->db->where('followup_status', 'Open');
        // search_params();
        // if (d.compareTo(Date.parse('today')) >= 0 ) {
        //     return;
        // } else if ( d.compareTo(Date.parse('yesterday')) == 0) {
        //     if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
        //         return 'cls-yellow';
        //     }
        // } else {
        //     if (data.followup_status != 'Completed' && data.followup_status != 'Postponed') {
        //         return 'cls-red';
        //     }
        // }

        $total=$this->customer_followup_model->find_count($where);

        echo json_encode(array('total'=>$total));
    } 


    // Homw Page Follw Up End
  
}