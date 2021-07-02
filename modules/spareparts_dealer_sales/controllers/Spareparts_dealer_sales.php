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
* Spareparts_dealer_sales
*
* Extends the Project_Controller class
* 
*/

class Spareparts_dealer_sales extends Project_Controller
{
    public function __construct()
    {
        parent::__construct();

        control('Spareparts Dealer Sales');
        $this->load->model('dealer_stocks/dealer_stock_model');
        $this->load->model('spareparts_dealer_sales/spareparts_dealer_sale_model');
        $this->load->model('spareparts_dealersales_lists/spareparts_dealersales_list_model');
        $this->load->model('dealer_stocks/dealer_stock_model');
        $this->load->model('dealer_credits/dealer_credit_model');
        $this->load->model('dealers/dealer_model');

        $this->lang->load('spareparts_dealer_sales/spareparts_dealer_sale');
    }

    public function index()
    {
// Display Page
        $data['header'] = lang('spareparts_dealer_sales');
        $data['page'] = $this->config->item('template_admin') . "index";
        $data['module'] = 'spareparts_dealer_sales';
        $this->load->view($this->_container,$data);
    }

    public function json()
    {
        search_params();
        $this->spareparts_dealer_sale_model->_table = "view_spareparts_dealer_sales";
         if(is_sparepart_dealer())
        {
            $where = ("dealer_id = {$this->session->userdata('employee')['dealer_id']}");
        }
        else if(is_sparepart_dealer_incharge())
        {
            $where = ("spares_incharge_id = {$this->session->userdata('id')}");
        }else if(is_aro()){
            $where = ("dealer_id = {$this->session->userdata('employee')['dealer_id']}");
            
        }
        $total=$this->spareparts_dealer_sale_model->find_count($where);

        paging('id');

        search_params();

        $rows=$this->spareparts_dealer_sale_model->findAll($where);

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {
        $form_data = $this->input->post('formdata');
        $gird_data = $this->input->post('griddata');
        $bill_no = $this->spareparts_dealer_sale_model->find(array('dealer_id'=>$this->session->userdata('employee')['dealer_id']),'max(bill_no) as bill_no');
        if(empty($bill_no))
        {
            $bill_no = 0;
        }
        $bill_no = $bill_no->bill_no + 1;

        $formdata['discount'] = ($form_data['discount'] ? $form_data['discount'] : 0);
        $formdata['date'] = $form_data['bill_date'];
        $formdata['party_id'] = $form_data['party_id'];
        $formdata['vat_bill_no'] = $form_data['vat_bill_no'];
        $formdata['taxable_total'] = $form_data['taxable_total'];
        $formdata['vat_amount'] = $form_data['vat_amount'];
        $formdata['total_amount'] = $form_data['total_amount'];
        $formdata['nep_date'] = get_nepali_date($form_data['bill_date'],'nep');
        $formdata['bill_no'] = $bill_no;
        $formdata['bill'] = 'CS-'.sprintf('%05d', $bill_no);
        $formdata['dealer_id'] = $this->session->userdata('employee')['dealer_id'];
        // Sales Infromation Insert
        $success = $this->spareparts_dealer_sale_model->insert($formdata);
        if($success)
        {
            foreach ($gird_data as $key => $value) 
            {
                $gird_upload[] = array(
                    'sparepart_id' => $value['sparepart_id'],
                    'quantity' => $value['quantity'],
                    'price' => $value['price'],
                    'discount_percentage' => $value['discount_percentage'],
                    'dealer_sales_id' => $success,
                    'dispatch_date_nep' => get_nepali_date(date('Y-m-d'),'nep')
                    );

                $spareparts = $this->dealer_stock_model->find(array('sparepart_id'=>$value['sparepart_id'],'dealer_id'=>$this->session->userdata('employee')['dealer_id']));
                $stock_update[] =array(
                    'id'=> $spareparts->id,
                    'quantity' => $spareparts->quantity - $value['quantity']
                    ); 
            }
            // Stock Update
            $this->dealer_stock_model->update_batch($stock_update,'id');            
            // Spareparts list insert
            $this->spareparts_dealersales_list_model->insert_many($gird_upload);

            $credit['dealer_id'] = $form_data['party_id'];
            $credit['cr_dr'] = 'CREDIT';
            $credit['amount'] = $form_data['total_amount'];
            $credit['date'] = date('Y-m-d');
            $credit['date_nepali'] = get_nepali_date(date('Y-m-d'),'nep');
            $credit['bill_no'] = $bill_no;
            // Credit Insert
            $this->dealer_credit_model->insert($credit);

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

    public function dealer_sparepart_list()
    {
        $dealer_id = $this->session->userdata('employee')['dealer_id'];
        $this->dealer_stock_model->_table = "view_spareparts_all_dealer_stock";
        $rows = $this->dealer_stock_model->findAll(array('dealer_id'=>$dealer_id),'sparepart_id,part_code,name');
        echo json_encode($rows);
    }
    public function get_item_price()
    {
        // print_r($this->dealer_id); 
        $this->dealer_stock_model->_table = "mst_spareparts";
        $party_id = $this->input->post('user');
        $sparepart_id = $this->input->post('id');
        if(($this->dealer_id == 120 && ($party_id == 12447 || $party_id == 12477)) || ($this->dealer_id == 81 && ($party_id == 12452 || $party_id == 12478))){
            $price = $this->dealer_stock_model->find(array('id'=>$sparepart_id),'dealer_price AS price,name');

        }else{
            $price = $this->dealer_stock_model->find(array('id'=>$sparepart_id),'price,name');
            
        }
        // echo $this->db->last_query();
        echo json_encode($price);
    }

    public function get_dealer_sparepart_list()
    {
        $this->spareparts_dealersales_list_model->_table = "view_spareparts_dealersales_list";
        $rows = $this->spareparts_dealersales_list_model->findAll(array('dealer_sales_id'=>$this->input->post('id')));
        echo json_encode($rows);
    }

    public function check_stock_quantity()
    {
        $sparepart_id = $this->input->post('sparepart_id');
        $quantity = $this->input->post('quantity');
        $spareparts = $this->dealer_stock_model->find(array('sparepart_id'=>$sparepart_id,'dealer_id'=>$this->session->userdata('employee')['dealer_id']));
        if($quantity > $spareparts->quantity)
        {
            $msg = 'Quantity Exceeds';
            $success = FALSE;
        }   
        else
        {
            $msg = 'Success';
            $success = TRUE;
        }
        echo json_encode(array('success'=>$success,'msg'=>$msg));
    }

    public function generate_bill($sales_id = NULL, $dealer_id = NULL)
    {
        $this->spareparts_dealersales_list_model->_table = "view_spareparts_dealersales_list";
        $data['rows'] = $this->spareparts_dealersales_list_model->findAll(array('dealer_sales_id'=>$sales_id));

        $this->spareparts_dealer_sale_model->_table = "view_spareparts_dealer_sales";
        $data['bill_info'] = $this->spareparts_dealer_sale_model->find(array('id'=>$sales_id));

        $data['dealer_info'] = $this->dealer_model->find(array('id'=>$dealer_id));

        $data['header'] = lang('spareparts_dealer_sales');
        $data['page'] = $this->config->item('template_admin') . "bill";
        $data['module'] = 'spareparts_dealer_sales';
        $this->load->view($data['page'],$data);
    }

    // for vehicle detail in sparepart
    public function vehicle_detail()
    {
        // Display Page
       
        $data['header'] = lang('spareparts');
        $data['page'] = $this->config->item('template_admin') . "vehicle";
        $data['module'] = 'spareparts_dealer_sales';
        $this->load->view($this->_container,$data);
    }

    public function vehicle_json()
    {

        $dealer_id = $this->dealer_id;
      
        $this->spareparts_dealer_sale_model->_table = 'view_customers';
        $where = array(
            'chass_no <>' => NULL, 
            'status_name' => 'Retail',
        );
        // var_dump(is_sparepart_dealer_incharge()); exit;
        $dealer_list    = (is_sparepart_dealer_incharge()) ? get_sparepart_dealer_list() : NULL; 
        // print_r($dealer_list); exit;
        // if(is_sparepart_dealer_incharge())
        // {
        //     $where = '(spares_incharge_id ='.$this->session->userdata('id').')';            
        // }
        if($dealer_id){
            $this->db->where('dealer_id',$dealer_id);
        }
        search_params();
        if(!empty($dealer_list)) {
            // $this->db->where_in('dealer_id', $dealer_list);
            $dealer_where_array = array();
            foreach ($dealer_list as $key => $value) {
                $dealer_where_array[] = "(".$value.")";
            }
            $where_dealer = implode(',', $dealer_where_array);
            $this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
        }
        
        $total=$this->spareparts_dealer_sale_model->find_count($where);
        
        paging('id','asc');
        
        search_params();
        if($dealer_id){
            $this->db->where('dealer_id',$dealer_id);
        }
        if(!empty($dealer_list)) {
            // $this->db->where_in('dealer_id', $dealer_list);
            $dealer_where_array = array();
            foreach ($dealer_list as $key => $value) {
                $dealer_where_array[] = "(".$value.")";
            }
            $where_dealer = implode(',', $dealer_where_array);
            $this->db->where('dealer_id = ANY(VALUES'.$where_dealer.')');
        }
        $rows=$this->spareparts_dealer_sale_model->findAll($where);
        // print_r($this->db->last_query());
        // exit;
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }
}