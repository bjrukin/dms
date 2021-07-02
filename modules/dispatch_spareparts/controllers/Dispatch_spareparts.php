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
 * Dispatch_spareparts
 *
 * Extends the Project_Controller class
 * 
 */

class Dispatch_spareparts extends Project_Controller
{
	public function __construct()
	{
		parent::__construct();

		control('Dispatch Spareparts');

		$this->load->model('dispatch_spareparts/dispatch_sparepart_model');
        $this->load->model('spareparts/sparepart_model');
        $this->load->model('order_generates/order_generate_model');

        $this->lang->load('dispatch_spareparts/dispatch_sparepart');
    }

    public function index()
    {
		// Display Page
      $data['header'] = lang('dispatch_spareparts');
      $data['page'] = $this->config->item('template_admin') . "index";
      $data['module'] = 'dispatch_spareparts';
      $this->load->view($this->_container,$data);
  }

  public function index_generate_order()
  {
        // Display Page
    $data['header'] = lang('dispatch_spareparts');
    $data['page'] = $this->config->item('template_admin') . "order_view";
    $data['module'] = 'dispatch_spareparts';
    $this->load->view($this->_container,$data);
}

public function json()
{
  $this->dispatch_sparepart_model->_table = 'view_report_fmsabc';
  search_params();

  $total=$this->dispatch_sparepart_model->find_count();

  paging('total_dispatched');

  search_params();

  $rows=$this->dispatch_sparepart_model->findAll();

  // 
  echo json_encode(array('total'=>$total,'rows'=>$rows));
  exit;
}

public function save()
{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        if(!$this->input->post('id'))
        {
        	$success=$this->dispatch_sparepart_model->insert($data);
        }
        else
        {
        	$success=$this->dispatch_sparepart_model->update($data['id'],$data);
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
        $data['order_id'] = $this->input->post('order_id');
        $data['dispatched_quantity'] = $this->input->post('dispatched_quantity');
        $data['dispatched_date'] = $this->input->post('dispatched_date');

        return $data;
    }

    public function generate_msil_order()
    {
        $this->load->library('Excel'); 
        $this->dispatch_sparepart_model->_table = 'view_fms';
        $rows=$this->dispatch_sparepart_model->findAll();
        // echo '<pre>';
        // print_r($rows);
        // exit;
        $excel_export = array();
        foreach ($rows as $key => $value) 
        {
            if($value->fms == 'F' && $value->stock_quantity < $required_quantity = $value->total * 3)
            {
                $excel_export[] = $value;
                $value->required_quantity = $required_quantity - $value->stock_quantity;
            }
            if($value->fms == 'M' && $value->stock_quantity < $required_quantity = $value->total * 2)
            {
                $excel_export[] = $value;
                $value->required_quantity = $required_quantity - $value->stock_quantity;

            }
            if($value->fms == 'S' && $value->stock_quantity < $required_quantity = $value->total * 1)
            {
                $excel_export[] = $value;
                $value->required_quantity = $required_quantity - $value->stock_quantity;
            }
            if($value->fms == 'N' && $value->stock_quantity < $required_quantity = $value->total * 1)
            {
                $excel_export[] = $value;
                $value->required_quantity = $required_quantity - $value->stock_quantity;
            }
        }
        echo json_encode(array('success'=>TRUE,'rows'=>$excel_export));  
    }

    public function generate_back_order()
    {
        $this->dispatch_sparepart_model->_table = 'view_back_log_spareparts';

        $this->db->order_by('sparepart_id asc');
        $rows=$this->dispatch_sparepart_model->findAll(array('required_quantity <>'=>0));
        $unwanted_index = array();
        if(!empty($rows))        
        {
            foreach ($rows as $key => $value) 
            {
                foreach ($rows as $key1 => $value1) 
                {
                    if(in_array($key, $unwanted_index,true))
                    {
                        continue;
                    }
                    if($key == $key1)
                    {
                        continue;
                    }
                    if($value->sparepart_id == $value1->sparepart_id)
                    {
                        $rows[$key]->required_quantity += $value1->required_quantity;
                        $unwanted_index[] = $key1;
                    }
                }
            }
            foreach ($unwanted_index as $key => $value) {
                unset($rows[$value]);
            }
            echo json_encode(array('success'=>TRUE,'rows'=>$rows));
        }
        else
        {
            flashMsg('error', 'Nothing to generate.');     
            redirect($_SERVER['HTTP_REFERER']);
        }   
    }

    public function save_order()
    {
        $doc_count = $this->_document_count[0];
        $post_data = $this->input->post('data');
        $order_type = $this->input->post('order_type');

        $order_no = $this->order_generate_model->find(NULL,'max(order_no) as order_no');
        if($order_type == 'air')
        {
            $orderno = date('y').'A'.sprintf("%03d",($order_no->order_no + 1));
        }
        else if($order_type == 'land')
        {
            $orderno = date('y').'L'.sprintf("%03d",($order_no->order_no + 1));
        }

        foreach ($post_data as  $value) 
        {
            $part_code = $this->sparepart_model->find(array('part_code'=>$value['part_code']));
            $exceldata['sparepart_id'] = $part_code->id;
            $moq = $part_code->moq;
            $quantity = $value['required_quantity'];
            $quotient = (int)($quantity / $moq);
            $result = $quantity % $moq;
            if($result != 0)
            {
                $actual_quantity = ($quotient * $moq) + $moq;
            }
            else
            {
                $actual_quantity = $quantity;
            }

            $exceldata['quantity'] = $actual_quantity;
            $exceldata['order_no'] = ($order_no->order_no +1);
            $exceldata['final_order_no'] = $orderno;
            $exceldata['order_type'] = $order_type;
            $exceldata['date'] = date('Y-m-d');            
            $exceldata['nep_date'] = get_nepali_date(date('Y-m-d'),'nep');   
            $nep_date = explode('-', $exceldata['nep_date']);
            $exceldata['nep_date_year'] = $nep_date[0];
            $exceldata['nep_date_month'] = $nep_date[1];

            $success = $this->order_generate_model->insert($exceldata);
        }      
            // exit;
        echo json_encode(array('success'=>TRUE,'order_no'=>$exceldata['order_no'],'order_type'=>$order_type,'final_order'=>$orderno));        
    }

    public function generate_excel()
    {
        $order_no_post = $this->input->get('order_no');
        $order_type = $this->input->get('order_type_export'); 
        $this->order_generate_model->_table = "view_spareparts_order_generate";
        $post_data = $this->order_generate_model->findAll(array('final_order_no'=>$order_no_post));

        $this->load->library('Excel');

        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
        $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
        $objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->mergeCells('A4:F4');
        $objPHPExcel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('E8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->getStyle('F8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1','SHREE HIMAYALAN ENTERPRISES PVT.LTD.');
        $objPHPExcel->getActiveSheet()->SetCellValue('A2','SPARE PARTS - DIVISION');
        $objPHPExcel->getActiveSheet()->SetCellValue('A3','Thapathali, Kathmandu - Nepal');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4',date('Y-m-d'));
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->SetCellValue('A5','Order No:');
        $objPHPExcel->getActiveSheet()->SetCellValue('B5',$order_no_post);
        $objPHPExcel->getActiveSheet()->SetCellValue('A6','Order Type:');
        $objPHPExcel->getActiveSheet()->SetCellValue('B6',$order_type);

        $objPHPExcel->getActiveSheet()->SetCellValue('A8','S.N.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B8','Part Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('C8','Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D8','Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('E8','Price (in Rs.)');
        $objPHPExcel->getActiveSheet()->SetCellValue('F8','Total (in Rs.)');

        $row = 9;
        $col = 0;        
        foreach($post_data as $key => $values) 
        {
            $spareparts = $this->sparepart_model->find(array('id'=>$values->sparepart_id));

            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $spareparts->part_code);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $spareparts->name);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->quantity);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->price);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->quantity * $values->price);
            $col++;

            $col = 0;
            $row++;        
        }
        $objPHPExcel->getActiveSheet()
        ->setCellValue('C'.$row, 'Total Quantity')
        ->setCellValue('D'.$row, '=SUM(D9:D'.($row-1).')');
        $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $objPHPExcel->getActiveSheet()
        ->setCellValue('E'.$row, 'Total Amount(in Rs.)')
        ->setCellValue('F'.$row, '=SUM(F9:F'.($row-1).')');

        header("Pragma: public");
        header("Expires: 0");
        header("Content-Type: application/force-download");
        header("Content-Disposition: attachment;filename=Msilorder.xls");
        header("Content-Transfer-Encoding: binary ");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function order_import()
    {   
        $config['upload_path'] = './uploads/order_import';
        $config['allowed_types'] = 'xlsx|csv|xls';
        $config['max_size'] = 100000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        $file = FCPATH . 'uploads/order_import/' . $data['upload_data']['file_name']; 
        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');        
        $objReader->setReadDataOnly(false);

        $index = array('part_code','quantity','order_no');
        $raw_data = array();
        $view_data = array();
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

        $order_type = $this->input->post('order_type');

       /* $order_no = $this->order_generate_model->find(NULL,'max(order_no) as order_no');
        if($order_type == 'air')
        {
            $orderno = date('y').'A'.sprintf("%03d",(($order_no->order_no ?$order_no->order_no : 0) + 1));
        }
        else if($order_type == 'land')
        {
            $orderno = date('y').'L'.sprintf("%03d",(($order_no->order_no ?$order_no->order_no : 0) + 1));
        }
*/
        foreach ($raw_data as $key => $value) 
        {
            if(strlen($value['order_no']) > 6)
            {
                echo "Invalid order number"."<br/>";

                echo $value['order_no'];
                exit;
            }
            $part_code = $this->sparepart_model->find(array('part_code'=>$value['part_code']));

            if($part_code)
            {
                $imported_data[$key]['sparepart_id']    = $part_code->id;
                $moq = $part_code->moq;
                $quantity = $value['quantity'];
                if($moq != NULL)
                {
                    $quotient = (int)($quantity / $moq);
                    $result = $quantity % $moq;
                    if($result != 0)
                    {
                        $actual_quantity = ($quotient * $moq) + $moq;
                    }

                    else
                    {
                        $actual_quantity = $quantity;
                    }
                }
                else
                {
                    $actual_quantity = $quantity;
                }

                $imported_data[$key]['quantity'] = $actual_quantity;
                $imported_data[$key]['order_no'] = $value['order_no'];
                $imported_data[$key]['final_order_no'] = $value['order_no'];
                $imported_data[$key]['order_type'] = $order_type;
                $imported_data[$key]['date'] = $this->input->post('order_date');            
                $imported_data[$key]['nep_date'] = get_nepali_date($this->input->post('order_date'),'nep');   
                $nep_date = explode('-', $imported_data[$key]['nep_date']);
                $imported_data[$key]['nep_date_year'] = $nep_date[0];
                $imported_data[$key]['nep_date_month'] = $nep_date[1];
            }
            else
            {
                $unavailable_parts[] = $value['part_code'];
            }
        }
        if(!empty($unavailable_parts))
        {
            print_r($unavailable_parts);
            exit;
        }

        $this->db->trans_start();
        $this->order_generate_model->insert_many($imported_data);
        if ($this->db->trans_status() === FALSE) 
        {
            $this->db->trans_rollback();
        } 
        else 
        {
            $this->db->trans_commit();            
        } 
        $this->db->trans_complete();
        redirect($_SERVER['HTTP_REFERER']);
    }
}