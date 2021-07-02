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
  * Msil_orders
  *
  * Extends the Project_Controller class
  * 
  */

  class Msil_orders_spareparts extends Project_Controller
  {
  	public function __construct()
  	{
  		parent::__construct();

  		control('Msil Orders Spareparts');

  		$this->load->model('msil_orders_spareparts/msil_order_model');
  		$this->load->model('spareparts/sparepart_model');		
  		$this->load->model('sparepart_stocks/sparepart_stock_model');
  		$this->load->model('stock_yards/stock_yard_model');
  		$this->load->model('pi_imports/pi_import_model');
  		$this->load->model('order_generates/order_generate_model');

  		$this->lang->load('msil_orders_spareparts/msil_order');
  	}

  	public function index()
  	{
  		$data['header'] = lang('msil_orders');
  		$data['page'] = $this->config->item('template_admin') . "msil_order_tab_index";
  		$data['module'] = 'msil_orders_spareparts';
  		$this->load->view($this->_container,$data);
  	}

  	public function msil_dispatch()
  	{
  		$data['header'] = lang('msil_orders');
  		$data['page'] = $this->config->item('template_admin') . "msil_dispatch";
  		$data['module'] = 'msil_orders_spareparts';
  		$this->load->view($this->_container,$data);
  	}

  	public function msil_order_list($msil_order_no = NULL)
  	{
  		$data['msil_order_no'] = $msil_order_no;
  		$data['header'] = lang('msil_orders');
  		$data['page'] = $this->config->item('template_admin') . "msil_order_list";
  		$data['module'] = 'msil_orders_spareparts';
  		$this->load->view($this->_container,$data);
  	}

  	public function msil_dispatch_list()
  	{
  		$data['binning_status'] = 0;
  		$invoice_no = $this->input->get('invoice_no');
  		$this->msil_order_model->_table = 'view_spareparts_msil_dispatch_list';
  		$binning_status=$this->msil_order_model->find(array('invoice_no'=>$invoice_no),'binning_status');
  		if(!empty($binning_status)){
  			$data['binning_status'] = $binning_status;
  		}
  		$data['invoice_no'] = $invoice_no;
  		$data['header'] = lang('msil_orders');
  		$data['page'] = $this->config->item('template_admin') . "msil_dispatch_list";
  		$data['module'] = 'msil_orders_spareparts';
  		$this->load->view($this->_container,$data);
  	}

  	public function order_received_list($msil_order_no = NULL)
  	{
  		$data['msil_order_no'] = $msil_order_no;
  		$data['header'] = lang('msil_orders');
  		$data['page'] = $this->config->item('template_admin') . "received_list";
  		$data['module'] = 'msil_orders_spareparts';
  		$this->load->view($this->_container,$data);
  	}

  	public function remaining_order_list($msil_order_no = NULL)
  	{
  		$data['msil_order_no'] = $msil_order_no;
  		$data['header'] = lang('msil_orders');
  		$data['page'] = $this->config->item('template_admin') . "remaining_list";
  		$data['module'] = 'msil_orders_spareparts';
  		$this->load->view($this->_container,$data);
  	}

  	public function grouped_order()
  	{
  		search_params();

  		$this->msil_order_model->_table = 'view_sparepart_grouped_msil_order';

  		$total=$this->msil_order_model->find_count();

  		search_params();

  		$this->db->order_by('order_no','asc');
  		$rows=$this->msil_order_model->findAll();

  		echo json_encode(array('total'=>$total,'rows'=>$rows));
  		exit;
  	}
  	public function grouped_dispatch()
  	{
  		search_params();

  		$this->msil_order_model->_table = 'view_spareparts_msil_dispatch_list';

  		$total=$this->msil_order_model->find_count();

  		search_params();
      paging('invoice_no');
  		$this->db->order_by('invoice_no','asc');
  		$rows=$this->msil_order_model->findAll();
      foreach($rows as $key =>$value)
      {
        $where['invoice_no'] = $value->invoice_no;
        $where['binning_status'] = 1;
        $where['in_stock'] = 0;
        $this->msil_order_model->_table = 'view_msil_received_order';
        $items = $this->msil_order_model->findAll($where);
        $rows[$key]->items = $items;
      }

  		echo json_encode(array('total'=>$total,'rows'=>$rows));
  		exit;
  	}

  	public function json($msil_order_no)
  	{
  		search_params();

  		$this->msil_order_model->_table = 'view_spareparts_msil_order';

  		$total=$this->msil_order_model->find_count(array('final_order_no'=>$msil_order_no));

  		paging('id');

  		search_params();

  		$rows=$this->msil_order_model->findAll(array('final_order_no'=>$msil_order_no));

  		echo json_encode(array('total'=>$total,'rows'=>$rows));
  		exit;
  	}

  	public function save()
  	{
  		$data=array();	

  		$data['location'] = $this->input->post('location');
  		$data['sparepart_id'] = $this->input->post('mst_part_id');
  		$data['quantity'] = $this->input->post('quantity');

  		$stock_check = $this->sparepart_stock_model->find(array('sparepart_id'=>$data['sparepart_id']),array('id','quantity'));

  		if($stock_check)
  		{
  			$stock['id'] = $stock_check->id;
  			$stock['quantity'] = $data['quantity'] + $stock_check->quantity;
  			$success = $this->sparepart_stock_model->update($stock['id'],$stock);
  		}
  		else
  		{
  			$success = $this->sparepart_stock_model->insert($data);
  		}

  		$value['id'] = $this->input->post('id');
  		$value['in_stock'] = 1;
  		$success1 = $this->msil_order_model->update($value['id'],$value);

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


  	public function excel_read()
    {
      $config['upload_path'] = './uploads/msil_dispatch_spareparts';
      $config['allowed_types'] = 'xlsx|csv|xls';
      $config['max_size'] = 100000;
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('userfile')) {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
        exit;
      } else {
        $data = array('upload_data' => $this->upload->data());
      }
      $file = FCPATH . 'uploads/msil_dispatch_spareparts/' . $data['upload_data']['file_name']; 
      $this->load->library('Excel');
      $objPHPExcel = PHPExcel_IOFactory::load($file);
      $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
      $objReader->setReadDataOnly(false);
      $index = array('sn','box_no','part_code','description','invoice_no','order_ref_no','quantity','unit_rate','amount','dealer_name');
      $raw_data = array();
      $data = array();
      $view_data = array();        
      foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
        if ($key == 0) {
          $highestRow = $worksheet->getHighestRow();
          $highestColumn = $worksheet->getHighestColumn(); 
          $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

          for ($row = 2; $row <= $highestRow; ++$row) 
          {
            for ($col = 1; $col < $highestColumnIndex; ++$col) 
            {
              $cell = $worksheet->getCellByColumnAndRow($col, $row);
              $val = $cell->getValue();
              $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
              $raw_data[$row][$index[$col]] = $val;
            }
          }      
        }
      }

      $raw_data = array_map('array_filter',  $raw_data);
      $raw_data = array_filter($raw_data);
      $invoice_no = NULL;
      $invalid_part_code = array();
      foreach ($raw_data as $key => $value) {
        $invoice_no = $value['invoice_no'];
        $parts = $this->sparepart_model->find(array('part_code'=>$value['part_code']));   
        if($parts){
          $data[$key]['box_no']         = $value['box_no'];
          $data[$key]['part_code']      = $value['part_code'];
          $data[$key]['invoice_no']     = $value['invoice_no'];
          $data[$key]['msil_invoice_date']   = $this->input->post('invoice_date');
          $data[$key]['msil_invoice_date_np']   = get_nepali_date($this->input->post('invoice_date'),'nep');
          $data[$key]['quantity']       = $value['quantity'];
          $data[$key]['part_name']      = $value['description'];
          $data[$key]['mst_part_id']    = @$parts->id;
          $data[$key]['reached_date_nepali']  = get_nepali_date($this->input->post('received_date'),'nep');
          $data[$key]['reached_date']   = $this->input->post('received_date');
          $data[$key]['order_no']       = $value['order_ref_no'];
          $data[$key]['unit_rate']      = $value['unit_rate'];
          $data[$key]['amount']         = $value['amount'];
          $data[$key]['dealer_name']    = @$value['dealer_name'];
        }else{
          $invalid_part_code[] = $value;
        }
      }
      if($invoice_no){
        $where_incoice = array(
          'invoice_no' => "$invoice_no",
        );
        $previous_invoice = $this->msil_order_model->findAll($where_incoice);
        if(count($previous_invoice) <= 0){
          if(count($invalid_part_code) == 0){
            $this->db->trans_start();
            $this->msil_order_model->insert_many($data);

            if ($this->db->trans_status() === FALSE) {
              $this->db->trans_rollback();          
            } else {
              $this->db->trans_commit();          
            }

            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
            $this->db->trans_complete();
          }else{
            $data['rows'] = $invalid_part_code;

            $data['header'] = lang('msil_orders');
            $data['page'] = $this->config->item('template_admin') . "list";
            $data['module'] = 'msil_orders_spareparts';
            $this->load->view($this->_container,$data);
          }
        }else{
          $data['header'] = lang('msil_orders');
          $data['page'] = $this->config->item('template_admin') . "invalid_invoice";
          $data['module'] = 'msil_orders_spareparts';
          $this->load->view($this->_container,$data);
        }
      }else{
        $data['header'] = lang('msil_orders');
        $data['page'] = $this->config->item('template_admin') . "invalid_invoice";
        $data['module'] = 'msil_orders_spareparts';
        $this->load->view($this->_container,$data);
      }
    }


  	public function remaining_list($order_no = NULL)
  	{	
  		$this->msil_order_model->_table = "view_sp_msil_remaining_quantity";
  		$rows = $this->msil_order_model->findAll(array('final_order_no'=>$order_no,'remaining_quantity >'=>0));
  		$this->msil_order_model->_table = "spareparts_msil_order";  		
  		foreach ($rows as $key => &$value) {
  			$where = array(
  				"(part_code = '".$value->sp_partcode."' OR part_code = '".$value->alternate_part_code."' OR part_code = '".$value->latest_part_code."')" => NULL, 
  				'order_no'=>$order_no
  				);
  			$received = $this->msil_order_model->find($where);
  			if($received){
  				if($received->quantity == $value->quantity){
  					// echo 'here';
  					unset($rows[$key]);
  				}else{
  					$value->quantity = $value->quantity - $received->quantity;
  				}
  			}
  		}
  		echo json_encode($rows);
  	}

  	public function received_list($order_no = NULL)
  	{	
  		$rows = $this->msil_order_model->findAll(array('order_no'=>$order_no));
  		echo json_encode($rows);
  	}

  	public function msil_dispatch_json()
  	{
  		$invoice_no = $this->input->get('invoice_no');
  		$this->msil_order_model->_table = "view_msil_received_order";
  		$rows = $this->msil_order_model->findAll(array('invoice_no'=>$invoice_no));
      foreach ($rows as $key => $value) {
        $where['invoice_no'] = $value->invoice_no;
        $where['part_code'] = $value->part_code;
        $this->msil_order_model->_table = "dms_msil_scanned_order";
        $binning = $this->msil_order_model->findAll($where);
        if($binning)
        {
           foreach ($binning as $k => $v) {
         
            $rows[$key]->binning_location[] = $v->location;
          }

        }else{
           $rows[$key]->binning_location[] = '';
        }
       
        // $rows[$key]->$binnings = $binning;
      }

     // print_r($rows);die();
  		echo json_encode($rows);
  	}


  	public function generate_binning_list()
    {
      $invoice_no = $this->input->get('invoice_no');
      $this->db->set('binning_date_en',date('Y-m-d'));
      $this->db->set('binning_date_np',get_nepali_date(date('Y-m-d'),'nep'));
       
      $this->db->set('binning_status',1)->where('invoice_no',$invoice_no)->update('spareparts_msil_order');
      
      $this->msil_order_model->_table = "view_msil_received_order";
      $rows = $this->msil_order_model->findAll(array('invoice_no'=>$invoice_no),null,'box_no,part_code asc');
      // $checker = TRUE;
      // foreach ($rows as $key => $value) 
      // {
      //   if(empty($value->location))
      //   {
      //     $checker = FALSE;
      //     break;
      //   }

      // }
      // if($checker == FALSE)
      // {

      //   flashMsg('error', 'New Item in the List.');
      //   redirect($_SERVER['HTTP_REFERER']);
      // }
      // else
      // {
        $data['rows'] = $rows ;
        $data['header'] = lang('msil_orders');
        $data['page'] = $this->config->item('template_admin') . "binning_list";
        
        $data['module'] = 'msil_orders_spareparts';
        $this->load->view($this->_container,$data);
       // }           
    }



  // public function generate_binning_list()
  // {
    
  //     $invoice_no = $this->input->post('invoice');
  //     $data = $this->input->post('data');
      
  //     $this->db->trans_begin();
  //     foreach ($data as $key => $value) {

     
  //         $this->db->where('part_code',$value['part_code']);
         
  //         // $this->db->where('location',$value['location']);
        
        
  //         $this->db->set('binning_status',1)->where('invoice_no',$invoice_no)->update('spareparts_msil_order');
        
  //     }

  //     if ($this->db->trans_status() === FALSE)
  //     {
  //       $this->db->trans_rollback();
  //       $success = FALSE;
  //       $msg = 'Error';
  //     }
  //     else
  //     {
  //       $this->db->trans_commit();
  //       $success = TRUE;
  //       $msg = 'Success';
  //     }
  //     echo json_encode(array('msg'=>$msg,'success'=>$success));
    
                
  //   }

    public function print_binning($invoice_no)
    {
        $where['invoice_no'] = $invoice_no;
        $this->msil_order_model->_table = "dms_msil_scanned_order";
        $rows = $this->msil_order_model->findAll($where);
      
        $data['rows'] = $rows ;
        $data['header'] = lang('msil_orders');
        $data['page'] = $this->config->item('template_admin') . "new_binning_list";
        
        $data['module'] = 'msil_orders_spareparts';
      
        $this->load->view($this->_container,$data);
    }


    public function show_binning_list()
    {
        $data['invoice_no'] = $this->input->get('invoice_no');
  
        $data['header'] = lang('msil_orders');
     
        $data['page'] = $this->config->item('template_admin') . "generate_binning_list";
        $data['module'] = 'msil_orders_spareparts';
        $this->load->view($this->_container,$data);
         
   }


    public function print_secondary_binning_list()
  	{
      $invoice_no = $this->input->get('invoice_no');    
      
  		$this->msil_order_model->_table = "view_msil_received_order";
  		$rows = $this->msil_order_model->findAll(array('invoice_no'=>$invoice_no),null,'box_no,part_code asc');
  		/*$checker = TRUE;
  		foreach ($rows as $key => $value) 
  		{
  			if(empty($value->location))
  			{
  				$checker = FALSE;
  				break;
  			}

  		}
  		if($checker == FALSE)
  		{

  			flashMsg('error', 'New Item in the List.');
  			redirect($_SERVER['HTTP_REFERER']);
  		}
  		else
  		{*/
  			$data['rows'] = $rows ;
  			$data['header'] = lang('msil_orders');
  			$data['page'] = $this->config->item('template_admin') . "binning_list";
  			$data['module'] = 'msil_orders_spareparts';
  			$this->load->view($this->_container,$data);
  		// }           
  	}


    public function get_scanned_values()
    {
      
        $location = $this->input->post('location');
        $scanner_name = $this->input->post('scanner_name');
        $part_code = $this->input->post('code');
        $invoice_no = $this->input->post('invoice');
     
      
        $this->msil_order_model->_table = "view_msil_received_order";
        $this->db->where('binning_status IS NULL');
        $rows = $this->msil_order_model->findAll(array('invoice_no'=>$invoice_no,'part_code'=>$part_code),NULL,'box_no,part_code asc');
       
        $data = array();
        $success = false;
        $msg = '';
        if(!empty($rows))
        {

          $this->db->where('part_code',$part_code);
          $this->db->where('invoice_no',$invoice_no);
          if($location)
          {
            $this->db->where('location',$location);
          }
          $this->msil_order_model->_table = 'dms_msil_scanned_order';
          $scanned_orders = $this->msil_order_model->find();

          $data['part_name'] = $rows[0]->part_name;
          $data['scanner_name'] = $scanner_name;
          $data['quantity'] = 1;
          $data['part_code'] = $part_code;
          $data['location'] = $location;
          $data['invoice_no'] = $invoice_no;
          $data['binning_date_en'] = date('Y-m-d');
          $data['binning_date_np'] = get_nepali_date(date('Y-m-d'),'nep');
          if($scanned_orders)
          {
            $this->db->where('part_code',$part_code);
            $this->db->where('invoice_no',$invoice_no);
            
            $this->db->where('location',$location);
           

            $data['quantity'] =  $data['quantity']+$scanned_orders->quantity;
            $scan_id = $this->db->update('dms_msil_scanned_order',$data);
          }else{

            $scan_id = $this->msil_order_model->insert($data);
          }
          if($scan_id)
          {
            $success = true;
            $msg = general_success();
          }
        
        }else{
          $success = false;
          $msg = "Partcode  '".$part_code."' is missing for  Invoice no ".$invoice_no;
        }
        echo json_encode(array('success'=>$success,'invoice_no'=>$invoice_no,'msg'=>$msg));
       
    }

    public function get_scanned_order_list()
    {
      $invoice_no = $this->input->get('invoice_no');

      $this->msil_order_model->_table = "dms_msil_scanned_order";
      $this->db->order_by('id asc');
      
      $rows = $this->msil_order_model->findAll(array('invoice_no'=>$invoice_no));
     // echo $this->db->last_query();die();

      echo json_encode($rows);
    }


    public  function update_scanned_quantity()
    {
      $this->msil_order_model->_table = 'dms_msil_scanned_order';
      // print_r($this->input->post());die();
      $data['id'] = $this->input->post('id');
      $data['quantity'] = $this->input->post('quanity');
      $success = $this->msil_order_model->update($data['id'],$data);

      if($success)
      {
        $msg = 'Success';
        $success = TRUE;
      }
      else
      {
        $msg = 'Fail';           
        $success = FALSE;           
      } 

      echo json_encode(array('success'=>$success,'msg'=>$msg)); 
    }


  	public function confirm_binning()
  	{
  		$user_id = $this->session->userdata('id');
  		$invoice_no = $this->input->post('binning_invoice_no');
  		$data['in_stock'] = 1;
  		$dispatched_rows = $this->msil_order_model->findAll(array('invoice_no'=>$invoice_no));

  		$stock_rows = array();
  		foreach ($dispatched_rows as $key => $value) 
  		{
  			$stock_rows = $this->sparepart_stock_model->find(array('sparepart_id'=>$value->mst_part_id));
  			if($stock_rows)
  			{
  				$stock['id'] = $stock_rows->id;
  				$stock['quantity'] = $stock_rows->quantity + $value->quantity;
  				$this->sparepart_stock_model->update($stock['id'],$stock);

	  			$data['id'] = $value->id;
	  			$success = $this->msil_order_model->update($data['id'],$data);
  			}
  			else{
	  			$stock_data = array(
	  				'sparepart_id' => $value->mst_part_id,
	  				'quantity' => $value->quantity,
				);
				$success = $this->sparepart_stock_model->insert($stock_data);
				$data ['id'] = $value->id;
				$success = $this->msil_order_model->update($data['id'],$data);
	  		}
  		}
  		// exit;
  		if($success)
  		{
  			$msg = 'Success';
  			$success = TRUE;
  		}
  		else
  		{
  			$msg = 'Fail';           
  			$success = FALSE;           
  		} 

  		echo json_encode(array('success'=>$success,'msg'=>$msg)); 

  	}

  	public function save_pi_details()
  	{
  		$order_no = $this->input->post('order_no');
  		$data['pi_number'] = $this->input->post('pi_number');
  		$data['pi_received_date'] = $this->input->post('pi_received_date');
  		$data['pi_received_date_np'] = get_nepali_date($this->input->post('pi_received_date'),'nep');
  		$nep_received_date = explode('-',$data['pi_received_date_np']);
  		$data['pi_received_date_np_year'] = $nep_received_date[0];
  		$data['pi_received_date_np_month'] = $nep_received_date[1];
  		$data['pi_confirmed_date'] = $this->input->post('pi_confirmed_date');
  		$data['pi_confirmed_date_np'] = get_nepali_date($this->input->post('pi_confirmed_date'),'nep');
  		$nep_confirmed_date = explode('-',$data['pi_confirmed_date_np']);
  		$data['pi_confirmed_date_np_year'] = $nep_confirmed_date[0];
  		$data['pi_confirmed_date_np_month'] = $nep_confirmed_date[1];
  		$this->db->where('final_order_no',$order_no);
  		$success = $this->db->update('spareparts_order_generate',$data);

  		if($success)
  		{
  			$msg = 'Success';
  			$success = TRUE;
  		}
  		else
  		{
  			$msg = 'Fail';           
  			$success = FALSE;           
  		} 

  		echo json_encode(array('success'=>$success,'msg'=>$msg)); 
  	}

  	public function pi_import()
  	{
  		$config['upload_path'] = './uploads/msil_pi';
  		$config['allowed_types'] = 'xlsx|csv|xls';
  		$config['max_size'] = 100000;

  		$this->load->library('upload', $config);

  		if (!$this->upload->do_upload('userfile')) {
  			$error = array('error' => $this->upload->display_errors());
  		} else {
  			$data = array('upload_data' => $this->upload->data());
  		}
  		$file = FCPATH . 'uploads/msil_pi/' . $data['upload_data']['file_name']; 

  		$this->load->library('Excel');
  		$objPHPExcel = PHPExcel_IOFactory::load($file);
  		$objReader = PHPExcel_IOFactory::createReader('Excel2007');        
  		$objReader->setReadDataOnly(false);

  		$index = array('sn','part_code','description','pi_no','quantity','unit_rate','amount');
  		$raw_data = array();
  		$data = array();
  		$view_data = array();        
  		foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
  			if ($key == 0) {
  				$highestRow = $worksheet->getHighestRow();
  				$highestColumn = $worksheet->getHighestColumn();
  				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

  				for ($row = 2; $row <= $highestRow; ++$row) 
  				{
  					for ($col = 1; $col < $highestColumnIndex; ++$col) 
  					{
  						$cell = $worksheet->getCellByColumnAndRow($col, $row);
  						$val = $cell->getValue();
  						$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
  						$raw_data[$row][$index[$col]] = $val;
  					}
  				}      
  			}
  		}

  		$invalid_part_code = array();
      foreach ($raw_data as $key => $value) {
        $parts = $this->sparepart_model->find(array('part_code'=>$value['part_code']));   
        if($parts){
          $data[$key]['pi_number']      = $value['pi_no'];
          $data[$key]['part_code']      = $value['part_code'];
          $data[$key]['quantity']       = $value['quantity'];
          $data[$key]['sparepart_id']     = @$parts->id;
          $data[$key]['reached_date_np']    = get_nepali_date(date('Y-m-d'),'nep');
          $data[$key]['reached_date']     = date('Y-m-d');
          $data[$key]['order_no']       = $this->input->post('order_no');
          $data[$key]['price']        = $value['unit_rate'];
        }else{
          $invalid_part_code[] = $value;
        }
      }

      if(count($invalid_part_code) == 0){
        $this->db->trans_start();
        $this->pi_import_model->insert_many($data);

        if ($this->db->trans_status() === FALSE) {
          $this->db->trans_rollback();          
        } else {
          $this->db->trans_commit();          
        }
        $this->db->trans_complete();
        redirect($_SERVER['HTTP_REFERER']);
      }else{
        $data['rows'] = $invalid_part_code;

        $data['header'] = lang('msil_orders');
        $data['page'] = $this->config->item('template_admin') . "list";
        $data['module'] = 'msil_orders_spareparts';
        $this->load->view($this->_container,$data);
      }
  	}

  	public function update_order_quantity()
  	{
  		$data['id'] = $this->input->post('id');
  		$data['quantity'] = $this->input->post('quantity');

  		$success = $this->order_generate_model->update($data['id'],$data);

  		if($success)
  		{
  			$msg = 'Success';
  			$success = TRUE;
  		}
  		else
  		{
  			$msg = 'Fail';           
  			$success = FALSE;           
  		} 
  		echo json_encode(array('success'=>$success,'msg'=>$msg)); 
  	}

  	public function save_order_item()
  	{	
  		$order_no = $this->input->post('order_no');
  		$dealer_order = $this->order_generate_model->find(array('final_order_no'=>$order_no));

  		$data['sparepart_id'] = $this->input->post('sparepart_id');
  		$data['quantity'] = $this->input->post('quantity');
  		$data['order_no'] = $dealer_order->order_no;
  		$data['order_type'] = $dealer_order->order_type;
  		$data['nep_date'] = $dealer_order->nep_date;
  		$data['date'] = $dealer_order->date;
  		$data['final_order_no'] = $dealer_order->final_order_no;
  		$data['nep_date_year'] = $dealer_order->nep_date_year;
  		$data['nep_date_month'] = $dealer_order->nep_date_month;

  		$success = $this->order_generate_model->insert($data);

  		if($success)
  		{
  			$msg = 'Success';
  			$success = TRUE;
  		}
  		else
  		{
  			$msg = 'Fail';           
  			$success = FALSE;           
  		}	
  		echo json_encode(array('success'=>$success,'msg'=>$msg));
  	}

    public function excel_export()
    {

      $today_date = (date('Y-m-d')." - ".date('Y-m-d'));
      if($this->input->get('date_range')) {
          $date_range = explode(" - ", $this->input->post('date_range'));
          if ($date_range[0] != null && $date_range[1] != null) {
              $whereCondition[] = "(binning_date_en >= '".$date_range[0]."' AND binning_date_en <= '".$date_range[1]."')"; 
          }
      }
      else
      {
          $date_range = explode(" - ", $today_date);
          $whereCondition[] = "(binning_date_en >= '".$date_range[0]."' AND binning_date_en <= '".$date_range[1]."')";
      }
       $whereCondition[] = " ( binning_status = 1)";
      $this->msil_order_model->_table = "view_msil_received_order";
      if (count($whereCondition) > 0) {
        $this->db->where(implode(" AND " , $whereCondition));
       }
      $result = $this->msil_order_model->findAll();
// echo "<pre>";
// print_r($this->db->last_query());
// print_r($result);die();
      if($result)
      {
        $this->load->library('Excel');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
     
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Binning Report')->getStyle("A1:L1")->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:L1');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','S.N.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2','Part Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2','Part Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D2','Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('E2','Price');
        $objPHPExcel->getActiveSheet()->SetCellValue('F2','Total Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('G2','Invoice No');
        $objPHPExcel->getActiveSheet()->SetCellValue('H2','Location');
        $objPHPExcel->getActiveSheet()->SetCellValue('I2','reached_date');
        $objPHPExcel->getActiveSheet()->SetCellValue('J2','reached_date_np');
        $objPHPExcel->getActiveSheet()->SetCellValue('K2','binning_date_en');
        $objPHPExcel->getActiveSheet()->SetCellValue('L2','binning_date_np');

        $row = 3;
        $col = 0;        
        foreach($result as $key => $values) 
        {           
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_code);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->quantity);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->unit_rate);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->amount);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->invoice_no);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->location);
            $col++; 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->reached_date);
            $col++; 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->reached_date_nepali);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->binning_date_en);
            $col++; 
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->binning_date_np);
            $col++;
            $col = 0;
            $row++;        
        }

        header("Pragma: public");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=BinningReport.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
      }
       
    }

    public function get_binned_list()
    {
      $invoice_no = $this->input->get('invoice_no');

      $this->msil_order_model->_table = "dms_msil_scanned_order";
      $this->db->order_by('id asc');
      
      $rows = $this->msil_order_model->findAll(array('invoice_no'=>$invoice_no));
     // echo $this->db->last_query();die();
      $total = count($rows);
      echo json_encode(array('total'=>$total,'rows'=>$rows));
      exit;
    }

    public function generate_barcode()
    {


        $code = substr(strtoupper(md5(uniqid(rand(), true))),1,15);

        $dest="uploads/barcodes/".$code.".jpg";

        $location = $this->input->post('location');

        $barcode = new phpCode128($location, 100, __DIR__.'/ARIAL.TTF' , 18);
        $barcode->setAutoAdjustFontSize(true);
        $barcode->setBorderWidth(1);
        $barcode->setShowText(false);
        $barcode->setPixelWidth(1);
        $barcode->setTextSpacing(5);
        $barcode->saveBarcode($dest);
        $barcodes=$code;
        

        $source = @imagecreatefromjpeg($dest);
        if (!$source)
        {
            $source= imagecreatefromstring(file_get_contents($dest));
        }
         $rotate = imagerotate($source, -270, 0);
         $save =  $_SERVER['DOCUMENT_ROOT']."/cgdms/uploads/barcodes/rotate/".$code.".jpg";
         imagejpeg($rotate,$save);
         imagedestroy($rotate);



        echo json_encode(array('barcodes'=>$barcodes));
        exit;
    }

}
