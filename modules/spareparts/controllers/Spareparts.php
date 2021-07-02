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
 * Spareparts
 *
 * Extends the Project_Controller class
 * 
 */

class Spareparts extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Spareparts');

		$this->load->model('spareparts/sparepart_model');
        $this->load->library('spareparts/sparepart');
		$this->lang->load('spareparts/sparepart');
	}

	public function index()
	{
		// Display Page
		$data['header'] = lang('spareparts');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'spareparts';
		$this->load->view($this->_container,$data);
	}

	public function json()
    {
        search_params();
        $where['is_local IS NULL'] = NULL;

        $total=$this->sparepart_model->find_count($where);
        
        paging('part_code','asc');
        
        search_params();
        
        $rows=$this->sparepart_model->findAll($where);

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->sparepart_model->insert($data);
        }
        else
        {
        	$success=$this->sparepart_model->update($data['id'],$data);
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
    	$data['name'] = $this->input->post('name');
    	$data['part_code'] = $this->input->post('part_code');
    	$data['latest_part_code'] = $this->input->post('latest_part_code');
    	$data['alternate_part_code'] = $this->input->post('alternate_part_code');
    	$data['dealer_price'] = $this->input->post('dealer_price');
    	$data['price'] = $this->input->post('price');
        $data['category_id'] = $this->input->post('category');
    	if($this->input->post('moq')){
            $data['moq'] = $this->input->post('moq');
        }
    	$data['uom'] = $this->input->post('uom');

    	return $data;
    }

    /****** for combo box ************/
    public function get_spareparts_combo_json(){
    	$search_name = strtolower($this->input->get('name_startsWith'));
    	$where["lower(part_name) LIKE '%{$search_name}%'"] = NULL;

    	$this->sparepart_model->_table = "view_spareparts_all_dealer_stock";
    	if(!is_admin()){
    		$this->db->where('dealer_id', $this->dealer_id);
    	}
    	$data = $this->sparepart_model->findAll($where, NULL, NULL, NULL, 300);

    	echo json_encode($data);
    }
    /******** for detail **********/
    public function getDetail(){
    	$where = (int)$this->input->post('id');
    	$data['success'] = FALSE;

    	if($where != '' && is_int($where)){
    		$data = $this->sparepart_model->findBy('id',$where);
    		$data->success = TRUE;
    	}
    	
    	echo json_encode($data);
    }

    public function master_stock_price() {
		// echo "asdf";
		// Display Page
    	$data['header'] = lang('spareparts');
    	$data['page'] = $this->config->item('template_admin') . "uploads";
    	$data['module'] = 'spareparts';
    	$this->load->view($this->_container,$data);
    }

    public function uploading_file_select() {

    	$config['upload_path'] = './uploads/spareparts_stockprice_import';
    	$config['allowed_types'] = 'xlsx|csv|xls';
    	$config['max_size'] = "10485760";

    	$this->load->library('upload', $config);

    	if ( ! $this->upload->do_upload())
    	{
    		$error = array('error' => $this->upload->display_errors());
			// $this->load->view('upload_form', $error);
			// redirect();
    		print_r($error);
    		exit;

    	}
    	$data = array('upload_data' => $this->upload->data());

    	ini_set('memory_limit', '-1');

    	$this->load->library('Excel');
    	
    	$inputFileName = FCPATH . 'uploads/spareparts_stockprice_import/' . $data['upload_data']['file_name'];
		// $inputFileName = FCPATH . 'uploads/spareparts_stockprice_import/asdf.xlsx'; 
		// $inputFileName = FCPATH . 'uploads/spareparts_stockprice_import/master_magh_stock_price.xlsx'; 

    	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
    	$objReader->setReadDataOnly(true);
    	$objPHPExcel = $objReader->load($inputFileName);
    	
    	$index = array('sn','part_code','part_name','dealer_price','price');
    	$raw_data = array();
    	$where_data = array();
    	foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
    		if($key == '0') {
    			$worksheetTitle = $worksheet->getTitle();
    			$highestRow = $worksheet->getHighestRow();
    			$highestColumn = $worksheet->getHighestColumn();
    			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

    			$i = 0;
    			for ($row = 3; $row <= $highestRow; ++$row) {
    				for ($col = 1; $col < $highestColumnIndex; ++$col) {
    					$cell = $worksheet->getCellByColumnAndRow($col, $row);
    					$val = $cell->getValue();
    					if( $index[$col] != "part_name"){
    						$raw_data[$i][$index[$col]] = $val;
    					}
    					if( $index[$col] == "part_code"){
    						$where_data[] = $val;
    					}
    				}
    				$i++;
    			}

    		}
    	}

    	$this->db->trans_begin();

    	$this->db->update_batch('mst_spareparts', $raw_data, 'part_code');

    	if($this->db->trans_status() === FALSE)
    	{
    		$this->db->trans_rollback();
    		$success = FALSE;
    	}
    	else
    	{
    		$this->db->trans_commit();
    		$success = TRUE;
    		echo "DONE";
    	}
    	exit;
    }
    public function import_new_parts()
    {   
    	$config['upload_path'] = './uploads/spareparts_newparts';
    	$config['allowed_types'] = 'xlsx|csv|xls';
    	$config['max_size'] = 100000;

    	$this->load->library('upload', $config);

    	if (!$this->upload->do_upload('userfile')) {
    		$error = array('error' => $this->upload->display_errors());
    		print_r($error);
    	} else {
    		$data = array('upload_data' => $this->upload->data());
    	}
    	$file = FCPATH . 'uploads/spareparts_newparts/' . $data['upload_data']['file_name']; 
    	$this->load->library('Excel');
    	$objPHPExcel = PHPExcel_IOFactory::load($file);
    	$objReader = PHPExcel_IOFactory::createReader('Excel2007');        
    	$objReader->setReadDataOnly(false);

    	$index = array('part_code','part_name','alternate_part_code','latest_part_code','moq','uom','category_id','mrp','dealer_price');
    	$raw_data = array();
    	foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
    		if ($key == 0) {
    			$worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 2; $row <= $highestRow; ++$row) {
                	for ($col = 0; $col < $highestColumnIndex; ++$col) {
                		$cell = $worksheet->getCellByColumnAndRow($col, $row);
                		$val = $cell->getValue();
                		$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                		$raw_data[$row][$index[$col]] = $val;
                	}
                }
            }
        }

        $imported_data = array();

        foreach ($raw_data as $key => $value) {
        	$sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])));
        	if(!$sparepart_id)
        	{
        		$imported_data[$key]['part_code']        	= strtoupper($value['part_code']);
        		$imported_data[$key]['name']       	= strtoupper($value['part_name']);
        		$imported_data[$key]['latest_part_code']    = $value['latest_part_code'];
        		$imported_data[$key]['alternate_part_code'] = $value['alternate_part_code'];
        		$imported_data[$key]['moq']       			= $value['moq'];
                $imported_data[$key]['uom']                 = $value['uom'];
        		$imported_data[$key]['category_id']       			= $value['category_id'];
        		$imported_data[$key]['price']       			= $value['mrp'];
        		$imported_data[$key]['dealer_price']       	= $value['dealer_price'];
        	}
        	else
        	{
        		$already_exists[] = array('part_code'=>strtoupper($value['part_code']));
        	}    
        }

        if($imported_data)
        {

        	$this->db->trans_start();

        	$this->sparepart_model->insert_many($imported_data);
        	if ($this->db->trans_status() === FALSE) 
        	{
        		$this->db->trans_rollback();
        	} 
        	else 
        	{
        		$this->db->trans_commit();            
        	} 
        	$this->db->trans_complete();
        }

        if($already_exists)
        {
        	foreach ($already_exists as $key => $value) 
        	{
        		echo $value['part_code'].'<br/>';
        	}
        	exit;
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* public function excel_export_all()
    {
        $this->sparepart->excel_export_spareparts();
    }*/
     public function excel_export_all($start,$end)
    {
        $this->sparepart->excel_export_spareparts($start,$end);
    }

    // for vehicle detail in sparepart
    public function vehicle_detail()
    {
        // Display Page
        $data['header'] = lang('spareparts');
        $data['page'] = $this->config->item('template_admin') . "vehicle";
        $data['module'] = 'spareparts';
        $this->load->view($this->_container,$data);
    }

    public function vehicle_json()
    {
        $this->sparepart_model->_table = 'view_customers';
        $where = array(
            'chass_no <>' => NULL, 
            'status_name' => 'Retail',
        );

        search_params();
        
        $total=$this->sparepart_model->find_count($where);
        
        paging('id','asc');
        
        search_params();
        
        $rows=$this->sparepart_model->findAll($where);

        echo json_encode(array('total'=>$total,'rows'=>$rows));
        exit;
    }


    //  function excel_import(){

    //     $config['upload_path'] = './uploads/spareparts_update';
    //     $config['allowed_types'] = 'xlsx|csv|xls';
    //     $config['max_size'] = 100000;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('userfile')) {
    //         $error = array('error' => $this->upload->display_errors());
    //         print_r($error);
    //     } else {
    //         $data = array('upload_data' => $this->upload->data());
    //     }
    //     $file = FCPATH . 'uploads/spareparts_update/' . $data['upload_data']['file_name']; 
    //     $this->load->library('Excel');
    //     $objPHPExcel = PHPExcel_IOFactory::load($file);
    //     $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
    //     $objReader->setReadDataOnly(false);

    //     $index = array('part_code','part_name','dp_vat','mrp_vat');
    //     $raw_data = array();
    //     foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
    //         if ($key == 0) {
    //             $worksheetTitle = $worksheet->getTitle();
    //             $highestRow = $worksheet->getHighestRow(); // e.g. 10
    //             $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
    //             $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    //             $nrColumns = ord($highestColumn) - 64;

    //             for ($row = 2; $row <= $highestRow; ++$row) {
    //                 for ($col = 0; $col < $highestColumnIndex; ++$col) {
    //                     $cell = $worksheet->getCellByColumnAndRow($col, $row);
    //                     $val = $cell->getValue();
    //                     $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
    //                     $raw_data[$row][$index[$col]] = $val;
    //                 }
    //             }
    //         }
    //     }

    //     $imported_data = array();
      
    //     foreach ($raw_data as $key => $value) {
    //         $spareparts = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])));


         
    //      // exit; 
    //         if($spareparts)
    //         {

    //             $imported_data['id']           = $spareparts->id;
    //             $imported_data['part_code']     = strtoupper($value['part_code']);
    //             // $imported_data['name']          = strtoupper($value['part_name']);
    //             $imported_data['dealer_price'] = $value['dp_vat'];
    //             $imported_data['price']       = $value['mrp_vat'];

                
         

    //             $this->db->trans_start();

    //             $this->sparepart_model->update($imported_data['id'],$imported_data);

    //             if ($this->db->trans_status() === FALSE) 
    //             {
    //                 $this->db->trans_rollback();
    //             } 
    //             else 
    //             {
    //                 $this->db->trans_commit();            
    //             } 
    //             $this->db->trans_complete();
                   
    //             }
    //         else
    //         {
    //             //      foreach ($already_exists as $key => $value) 
    //             // {
    //             //     echo $value['part_code'].'<br/>';
    //             // }
    //             // exit;
    //         }    
    //     }
        
    //     // print_r($this->db->last_query());
    //     // print_r($imported_data);
    //     // exit;

      
    //     redirect($_SERVER['HTTP_REFERER']);

    // }


     function excel_import(){

        $config['upload_path'] = './uploads/spareparts_update';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/spareparts_update/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
        $objReader->setReadDataOnly(false);

        $index = array('part_code','mrp','dp');
        $raw_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }

        $imported_data = array();
        $unimported_data = array();
       
        foreach ($raw_data as $key => $value) {
            $spareparts = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])));

            
            if($spareparts)
            {

                $imported_data['id']           = $spareparts->id;
                // $imported_data['part_code']     = strtoupper($value['part_code']);
                // $imported_data['name']          = strtoupper($value['part_name']);
                $imported_data['dealer_price'] = $value['dp'];
                $imported_data['price']       = $value['mrp'];

                $this->db->trans_start();
                $this->sparepart_model->update($imported_data['id'],$imported_data);

                if ($this->db->trans_status() === FALSE) 
                {
                    $this->db->trans_rollback();
                } 
                else 
                {
                    $this->db->trans_commit();            
                } 
                $this->db->trans_complete();
                   
                }
            else
            {
                $unimported_data['part_code'] = $value['part_code'];
            }    
        }
        
        // print_r($this->db->last_query());
        print_r($unimported_data);
        // exit;

      
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function check_duplicate()
    {
        if($this->input->post('id')){
            echo json_encode(array('success' => TRUE));
        }else{
            $data = $this->input->post();
            $where = array($data['field'] => $data['value']);
            $count = $this->sparepart_model->find_count($where);
            if($count){
                echo json_encode(array('success' => FALSE));
            }else{
                echo json_encode(array('success' => TRUE));
            }
        }
    }


    public function check_sparepart_exist()
    {   
        $config['upload_path'] = './uploads/spareparts_newparts';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/spareparts_newparts/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
        $objReader->setReadDataOnly(false);

        $index = array('sn','part_code','su','part_name','dp','mrp');
        $raw_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 1; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }

        $imported_data = array();

        foreach ($raw_data as $key => $value) {
            $sparepart_id = $this->sparepart_model->find(array('part_code'=>strtoupper($value['part_code'])));
            if(!$sparepart_id)
            {
                $imported_data[$key]['part_code']           = strtoupper($value['part_code']);
                $imported_data[$key]['name']        = strtoupper($value['part_name']);
                $imported_data[$key]['su']                 = $value['su'];
                $imported_data[$key]['price']                   = $value['mrp'];
                $imported_data[$key]['dealer_price']        = $value['dp'];
            }
              
        }


        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle('Parts Which Doesnt Exist');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        
      

        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Part Code')
        ->setCellValue('B1', 'Part Name')
        ->setCellValue('C1', 'SU')
        ->setCellValue('D1', 'DP w/o VAT')
        ->setCellValue('E1', 'MRP w/o VAT');

        $row = 1;
        $col = 0; 

       
        foreach ($imported_data as  $values) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['part_code']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['name']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['su']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['dealer_price']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values['price']);
            $col++;
            $row++;
            $col = 0;
        }


        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="partdoesnt_exis_'.time().'.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // if (ob_get_length()) ob_end_clean();
        $objWriter->save('php://output');
        // echo '<pre>'; print_r($imported_data);  exit;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function generate_barcode()
    {
        $location = $this->input->post('location');

        $code = substr(strtoupper(md5(uniqid(rand(), true))),1,15);
       
        $dest="assets/barcodes/".$code.".jpg";
      
      
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
        $save =  $_SERVER['DOCUMENT_ROOT']."/cgdms/assets/barcodes/rotate/".$code.".jpg";
        imagejpeg($rotate,$save);
        imagedestroy($rotate);


      
      
     

      return $barcodes;

    }
}