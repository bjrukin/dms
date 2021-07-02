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
* Sparepart_orders
*
* Extends the Project_Controller class
* 
*/

class Sparepart_orders extends Project_Controller
{
    public function __construct()
    {
        parent::__construct();

        control('Sparepart Orders');

        $this->load->model('sparepart_orders/sparepart_order_model');
        $this->load->model('dispatch_spareparts/dispatch_sparepart_model');
        $this->load->model('sparepart_stocks/sparepart_stock_model');
        $this->load->model('spareparts/sparepart_model');
        $this->lang->load('sparepart_orders/sparepart_order');
        $this->load->library('sparepart_orders/sparepart_order');    
        $this->load->model('dealer_credits/dealer_credit_model');

    }


    public function index()
    {
        $data['header'] = lang('sparepart_orders');
        $data['page'] = $this->config->item('template_admin') . "tab_index";
        $data['module'] = 'sparepart_orders';

        $this->load->view($this->_container,$data);
    }    

    public function sparepart_incharge()
    {
        $data['header'] = lang('sparepart_orders');
        $data['page'] = $this->config->item('template_admin') . "sparepart_incharge";
        $data['module'] = 'sparepart_orders';
        $this->load->view($this->_container,$data);
    }

    public function foc_billing()
    {
        $data['header'] = lang('foc_billing');
        $data['page'] = $this->config->item('template_admin') . "foc_billing";
        $data['module'] = 'sparepart_orders';
        $this->load->view($this->_container,$data);
    }

    public function json()
    {
        $this->sparepart_order_model->_table = 'view_spareparts_order';
        search_params();

        $total=$this->sparepart_order_model->find_count();

        paging('id');

        search_params();
        $rows=$this->sparepart_order_model->findAll();

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function pi_generated_json()
    {
        $dealer_id = $this->_sparepartdealer->id; 
        $this->sparepart_order_model->_table = 'view_spareparts_order';
        search_params();

        $total=$this->sparepart_order_model->find_count(array('pi_generated'=>1,'pi_confirmed'=>0,'dealer_id'=>$dealer_id));

        paging('id');

        search_params();
        $rows=$this->sparepart_order_model->findAll(array('pi_generated'=>1,'pi_confirmed'=>0,'dealer_id'=>$dealer_id));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function incharge_json()
    {
        $this->sparepart_order_model->_table = 'view_spareparts_order';
        search_params();

        $total=$this->sparepart_order_model->find_count(array('pi_generated'=>0));
        paging('id');

        search_params();

        $rows=$this->sparepart_order_model->findAll(array('pi_generated'=>0));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function pi_indexed_json()
    {
        $fields = 'proforma_invoice_id,dealer_name,dealer_id';
        $this->sparepart_order_model->_table = 'view_spareparts_order';

        search_params();
        $this->db->group_by($fields);
        $total=$this->sparepart_order_model->find_all(array('pi_generated'=>1,'pi_confirmed'=>1),$fields);
        $total = count($total);

        paging('dealer_id');

        search_params();
        $this->db->group_by($fields);
        $rows=$this->sparepart_order_model->find_all(array('pi_generated'=>1, 'pi_confirmed'=>1),$fields);
        // echo $this->db->last_query();

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

    public function save()
    {

        $data=$this->_get_posted_data(); 

        $this->dealer_credit_model->_table = 'view_credit_policy';
        $credit_check = $this->dealer_credit_model->findAll(array('dealer_id'=>$data['dealer_id']));

        $total_credit = 0;
        $credit_policy = 0;
        foreach ($credit_check as  $value) 
        {
            if($value->cr_dr == 'credit') 
            {
                $total_credit += $value->amount;
            }
            if($value->cr_dr == 'debit')
            {
                $total_credit -= $value->amount;
            }
            $credit_policy = $value->credit_policy;
        }

        if(!$total_credit > $credit_policy)
        {
            if(!$this->input->post('id'))
            {
                $success=$this->sparepart_order_model->insert($data);
            }
            else
            {
                $success=$this->sparepart_order_model->update($data['id'],$data);
            }
        }
        else
        {
            $success = FALSE;
            $msg=lang('excess_credit');
            echo json_encode(array('msg'=>$msg,'success'=>$success));
            exit;
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
        $data['sparepart_id']   = $this->input->post('product_id');
        $data['order_quantity'] = $this->input->post('quantity');
        $data['dealer_id']      = $this->_sparepartdealer->id;   
        return $data;
    }

    public function list_item_json()
    {
        $this->sparepart_stock_model->_table = 'view_spareparts_dealer_order';

        $barcode = strtoupper($this->input->post('barcode'));       
        $proforma_invoice_id = $this->input->post('pi');
        $sparepart_stock_id = $this->input->post('sparepart_stock_id');         
        $where = array(
            'name'=>$barcode, 
            'proforma_invoice_id'=>$proforma_invoice_id,
            'pi_generated'          => 1,
            'pi_confirmed'          => 1,
            );
        $stocklist = $this->sparepart_stock_model->find($where);

        if($stocklist == FALSE)
        {
            echo json_encode(array('stocklist'=>$stocklist,'success'=>FALSE));
            exit;
        }

        echo json_encode(array('stocklist'=>$stocklist,'success'=>TRUE));

    }
    public function list_foc_item_json()
    {
        $this->sparepart_stock_model->_table = 'view_sparepart_real_stock';

        $barcode = strtoupper($this->input->post('barcode'));       

        $stocklist = $this->sparepart_stock_model->find(array('name'=>$barcode));

        if($stocklist == FALSE)
        {
            echo json_encode(array('stocklist'=>$stocklist,'success'=>FALSE));
            exit;
        }
        echo json_encode(array('stocklist'=>$stocklist,'success'=>TRUE));

    }


    public function generate_pi()
    {
        $doc_count = $this->_document_count[0];     
        $dealer_id = $this->input->post('dealer_id');        
        $success = $this->sparepart_order->generate_proforma_invoice($dealer_id,$doc_count);
    }

    public function save_pi()
    {
        $pi_id = $this->input->post('pi_id');
        $success = $this->sparepart_order->pi_confirm($pi_id);
        echo json_encode($success);
    }

    public function get_spareparts_list()
    {

        $list = $this->sparepart_order->sparepart_list_json();
        echo json_encode($list);
    }
    public function get_dealer_list()
    {

        $dealerlist = $this->sparepart_order->dealer_list_json();
        echo json_encode($dealerlist);
    }

    public function save_dispatch_order()
    {
        $post = $this->input->post();
        $post['dispatched_date'] = date("Y-m-d");
        $post['dispatched_date_nepali'] = get_nepali_date(date("Y-m-d"),'string');

        $newstock = array(
            'id' => $post['stock_id'],
            'quantity' => $post['quantity'] - $post['dispatch_quantity'],
            );

        if($newstock['quantity'] < 0){
            $msg = 'Error: No stock.';
            $success = false;
            echo json_encode(array('success'=>$success, 'msg'=>$msg));
            exit;
        }

        $success = $this->sparepart_stock_model->update($newstock['id'],$newstock);

        if($success)
        {
            $data = array(
                'stock_id'              =>  $post['stock_id'],
                'order_id'              =>  $post['order_id'],
                'dispatched_quantity'   =>  $post['dispatch_quantity'],
                'dispatched_date'       =>  $post['dispatched_date'],
                'dispatched_date_nepali'=>  $post['dispatched_date_nepali'],
                'proforma_invoice_id'   =>  $post['proforma_invoice_id'],
                'pick_count'            =>  0
                );

            $success = $this->dispatch_sparepart_model->insert($data);
            if($success)
            {
                $msg = "Successfully Inserted new dispatch item.";
            }
            else
            {
                $msg = "Error: updating.";
            }
        }
        else
        {
            $msg = "Error: Unable to update master stock.";

        }

        echo json_encode(array('success'=>$success, 'msg'=>$msg));

    }
    public function save_foc_billing()
    {
        $post = $this->input->post();
        $post['dispatched_date'] = date("Y-m-d");
        $post['dispatched_date_nepali'] = get_nepali_date(date("Y-m-d"),'string');

        $newstock = array(
            'id' => $post['stock_id'],
            'quantity' => $post['quantity'] - 1,
            );

        if($newstock['quantity'] < 0){
            $msg = 'Error: No stock.';
            $success = false;
            echo json_encode(array('success'=>$success, 'msg'=>$msg));
            exit;
        }

        $success = $this->sparepart_stock_model->update($newstock['id'],$newstock);

        if($success)
        {
            $data = array(
                'stock_id'              =>  $post['stock_id'],
                'dispatched_date'       =>  $post['dispatched_date'],
                'dispatched_date_nepali'=>  $post['dispatched_date_nepali'],
                'foc'                   =>  1,
                'billed'                =>  0
                );

            $success = $this->dispatch_sparepart_model->insert($data);
            if($success)
            {
                $msg = "Successfully Inserted new dispatch item.";
            }
            else
            {
                $msg = "Error: updating.";
            }
        }
        else
        {
            $msg = "Error: Unable to update master stock.";

        }

        echo json_encode(array('success'=>$success, 'msg'=>$msg));

    }

    public function dispatch_list($id = NULL)
    {
        $data['id'] = $id;

        $data['header'] = lang('sparepart_orders');
        $data['page'] = $this->config->item('template_admin') . "dispatch_list";
        $data['module'] = 'sparepart_orders';
        $this->load->view($this->_container,$data);
    }

    public function dispatch_list_json($proforma_invoice_id = NULL)
    {
        $this->dispatch_sparepart_model->_table = 'view_sparepart_detail';
        search_params();

        $total=$this->dispatch_sparepart_model->find_count(array('proforma_invoice_id'=>$proforma_invoice_id,'pick_count'=>0));
        paging('id');

        search_params();

        $rows=$this->dispatch_sparepart_model->findAll(array('proforma_invoice_id'=>$proforma_invoice_id,'pick_count'=>0));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
    }

    public function dispatch_list_foc_json()
    {
        $this->dispatch_sparepart_model->_table = 'view_sparepart_detail';
        search_params();

        $total=$this->dispatch_sparepart_model->find_count(array('foc'=>1,'billed'=>0));
        paging('id');

        search_params();

        $rows=$this->dispatch_sparepart_model->findAll(array('foc'=>1,'billed'=>0));
        echo json_encode(array('total'=>$total,'rows'=>$rows));
    }


    public function generate_bill($proforma_invoice_id = NULL)
    {
        $this->dispatch_sparepart_model->_table = 'view_sparepart_detail';
        $rows=$this->dispatch_sparepart_model->findAll(array('proforma_invoice_id'=>$proforma_invoice_id,'pick_count'=> 0));

        //credit part
        $credit = array();
        $credit['amount']= 0;
        foreach ($rows as  $amount) 
        {
            $credit['dealer_id'] = $amount->dealer_id;
            $credit['proforma_invoice_id'] = $amount->proforma_invoice_id;
            $credit['cr_dr'] = 'CREDIT';
            $credit['amount'] += $amount->dispatched_quantity * $amount->price;
            $credit['date'] = date('Y-m-d');
            $credit['date_nepali'] = get_nepali_date(date('Y-m-d'),'nep');
        }

        $success = $this->dealer_credit_model->insert($credit);

        if(empty($rows))
        {

            flashMsg('error', 'Nothing to generate bill.');     
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Update Pick count (Generate Bill Batch)
        $this->dispatch_sparepart_model->_table = 'spareparts_dispatch_spareparts';
        $this->db->select_max('pick_count');
        $pick_count=$this->dispatch_sparepart_model->find(array('proforma_invoice_id'=>$proforma_invoice_id),'');
        $pick_count = $pick_count->pick_count +1;
        $data = array();
        foreach ($rows as $key => $value) {
            $data[] = array(
                'id'    =>  $value->id,
                'pick_count' => $pick_count
                );
        }
        $this->dispatch_sparepart_model->update_batch($data,'id');

        // Generate Excel for Bills
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0); 
        $rowCount = 2; 
        foreach($rows as $value){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->name); 
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->part_code); 
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->order_quantity); 
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->dispatched_quantity); 
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->price); 
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $value->dispatched_date); 
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $value->dispatched_date_nepali); 
            $rowCount++; 
        } 


        header("Pragma: public");
        header("Expires: 0");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Generate BILL.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');


    }
    // public function generate_foc_bill()
    // {
    //     $this->dispatch_sparepart_model->_table = 'view_sparepart_detail';
    //     $rows=$this->dispatch_sparepart_model->findAll(array('foc'=>1,'billed'=>0));

    //     if(empty($rows))
    //     {

    //         flashMsg('error', 'Nothing to generate bill.');     
    //         redirect($_SERVER['HTTP_REFERER']);
    //     }

    //     // Update Pick count (Generate Bill Batch)
    //     $this->dispatch_sparepart_model->_table = 'spareparts_dispatch_spareparts';

    //     $data = array();
    //     foreach ($rows as $key => $value) {
    //         $data[] = array(
    //             'id'    =>  $value->id,
    //             'billed' => 1,
    //             );
    //     }
    //     $this->dispatch_sparepart_model->update_batch($data,'id');

    //     // Generate Excel for Bills
    //     $this->load->library('Excel');
    //     $objPHPExcel = new PHPExcel(); 
    //     $objPHPExcel->setActiveSheetIndex(0); 
    //     $objPHPExcel->getActiveSheet()->SetCellValue('A1','Name'); 
    //     $objPHPExcel->getActiveSheet()->SetCellValue('B1','Part Code'); 
    //     $objPHPExcel->getActiveSheet()->SetCellValue('C1','Dispatched Quantity'); 
    //     $objPHPExcel->getActiveSheet()->SetCellValue('D1','Price');
    //     $objPHPExcel->getActiveSheet()->SetCellValue('E1','Total Cost');

    //     $rowCount = 2; 
    //     foreach($rows as $value){
    //         $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->name); 
    //         $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->part_code); 
    //         $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->dispatched_quantity); 
    //         $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $value->price); 
    //         $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $value->price * $value->dispatched_quantity); 
    //         $rowCount++; 
    //     } 


    //     header("Pragma: public");
    //     header("Expires: 0");
    //     header("Content-Type: application/force-download");
    //     header("Content-Disposition: attachment;filename=Generate FOC BILL.xls");
    //     header("Content-Transfer-Encoding: binary ");
    //     $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    //     ob_end_clean();
    //     $objWriter->save('php://output');


    // }

    public function dispatch_left_log($id = NULL)
    {
        $data['id'] = $id;

        $data['header'] = lang('sparepart_orders');
        $data['page'] = $this->config->item('template_admin') . "leftlogs_spareparts";
        $data['module'] = 'sparepart_orders';
        $this->load->view($this->_container,$data);
    }

    public function dispatch_left_log_json($proforma_invoice_id = NULL)
    {
        $this->dispatch_sparepart_model->_table = 'view_left_spareparts';

        search_params();
        $total=$this->dispatch_sparepart_model->findAll(array('proforma_invoice_id'=>$proforma_invoice_id,'remaining <>'=>0));
        $total = count($total);

        paging('order_id');

        search_params();
        $rows=$this->dispatch_sparepart_model->findAll(array('proforma_invoice_id'=>$proforma_invoice_id,'remaining <>'=>0));

        echo json_encode(array('total'=>$total,'rows'=>$rows));

    }

    public function generate_picking_list($pi_id = NULL)
    {
        $this->load->library('html2pdf');

        $this->sparepart_order_model->_table = 'view_spareparts_dealer_order';
        $data['rows'] = $this->sparepart_order_model->findAll(array('pi_generated'=>1,'pi_confirmed'=>1,'proforma_invoice_id'=>$pi_id));

        if(empty($data['rows']))
        {
            flashMsg('error', 'No items to generate.');     
            redirect($_SERVER['HTTP_REFERER']);
        }

        $content=$this->load->view('admin/picklist',$data,TRUE);        
        $file_name = "picklist.pdf";

        $this->html2pdf->WriteHTML($content);
        $path='uploads/booked_vehicles/';
        $this->html2pdf->Output($path.$file_name); 
    }

    public function file_upload()
    {
        $success =  $this->sparepart_order->jqxupload();
    }

    public function upload_delete(){
        $uploadPath = 'uploads/debit_receipt';
        $filename = $this->input->post('filename');
        @unlink($this->uploadPath . '/' . $filename);
        @unlink($this->uploadthumbpath . '/' . $filename);
    }

    public function save_receipt()
    {
        $data['dealer_id'] = $this->input->post('dealer_id');
        $data['amount'] = $this->input->post('debit_amount');
        $data['receipt_no'] = $this->input->post('receipt_no');
        $data['image_name'] = $this->input->post('image_name');
        $data['cr_dr'] = 'DEBIT';
        $data['date'] = date('Y-m-d');
        $data['date_nepali'] = get_nepali_date(date('Y-m-d'),'nep');

        $success = $this->dealer_credit_model->insert($data);
        if($success)
        {
            echo json_encode(array('success'=>$success));
        }
    }
}
