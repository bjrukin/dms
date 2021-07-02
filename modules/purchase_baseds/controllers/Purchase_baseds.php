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
 * Purchase_baseds
 *
 * Extends the Project_Controller class
 * 
 */

class Purchase_baseds extends Project_Controller
{
	public function __construct()
	{
       parent::__construct();

       control('Purchase Baseds');

       $this->load->model('purchase_baseds/purchase_based_model');
       $this->lang->load('purchase_baseds/purchase_based');
   }

   public function index()
   {
		// Display Page
      $data['header'] = lang('purchase_baseds');
      $data['page'] = $this->config->item('template_admin') . "index";
      $data['module'] = 'purchase_baseds';
      $this->load->view($this->_container,$data);
  }

  public function json()
  {
      search_params();

      $total=$this->purchase_based_model->find_count();

      paging('id');

      search_params();

      $rows=$this->purchase_based_model->findAll();

      echo json_encode(array('total'=>$total,'rows'=>$rows));
      exit;
  }

  public function save()
  {
        $data=$this->_get_posted_data(); //Retrive Posted Data
        
        if(!$this->input->post('id'))
        {
            $success=$this->purchase_based_model->insert($data);
        }
        else
        {
            $success=$this->purchase_based_model->update($data['id'],$data);
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

 public function get_based(){
    $order_id=$this->input->post('id');
    
    $this->db->where('order_id',$order_id);

    $based=$this->db->get('ser_purchase_based')->result_array();

    echo json_encode($based);

}
private function _get_posted_data()
{
   $data=array();
   if($this->input->post('id')) {
     $data['id'] = $this->input->post('id');
 }
		// $data['created_by'] = $this->input->post('created_by');
		// $data['updated_by'] = $this->input->post('updated_by');
		// $data['deleted_by'] = $this->input->post('deleted_by');
		// $data['created_at'] = $this->input->post('created_at');
		// $data['updated_at'] = $this->input->post('updated_at');
		// $data['deleted_at'] = $this->input->post('deleted_at');
 $data['part_no'] = $this->input->post('part_no');
 $data['description'] = $this->input->post('description');
 $data['rol'] = $this->input->post('rol');
 $data['po_qty'] = $this->input->post('po_qty');
 $data['ord_qty'] = $this->input->post('ord_qty');
 $data['sold_qty'] = $this->input->post('sold_qty');
 $data['stck_qty'] = $this->input->post('stck_qty');
 $data['tran_stk'] = $this->input->post('tran_stk');
 $data['sugg_qty'] = $this->input->post('sugg_qty');
 $data['price'] = $this->input->post('price');
 $data['amount'] = $this->input->post('amount');
 $data['order_id'] = $this->input->post('order_id');

 return $data;
}

function read_file() {
    $config['upload_path'] = './uploads/excel_imports/purchase_based/';
    $config['allowed_types'] = 'xlsx|csv|xls';
    $config['max_size'] = 100000;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('userfile')) {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
    } else {
        $data = array('upload_data' => $this->upload->data());
    }
        $file = FCPATH . 'uploads/excel_imports/purchase_based/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];

        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line


        $index = array(

            'part_no',
            'description',
            'rol',
            'po_qty',
            'ord_qty',
            'sold_qty',
            'stck_qty',
            'tran_stk',
            'sugg_qty',
            'price',
            'amount'



            );

        $raw_data = array();
        $data = array();
        $view_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
               // print_r($highestColumnIndex);
                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($cell)) {
                            $val = date($format = "Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($val));
                        }
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }
//   echo"<pre>";
// print_r($raw_data);
// exit;

        echo json_encode($raw_data);
        // foreach ($raw_data as $key => $value) {
        //     $this->db->select('id');
        //     $this->db->from('ser_purchase_based');

        //     $invoice = $this->db->get()->row_array();




        //     $data[$key]['part_no'] = $value['part_no'];
        //     $data[$key]['description'] = $value['description'];

        //     $data[$key]['rol'] = $value['rol'];
        //     $data[$key]['po_qty'] = $value['po_qty'];
        //     $data[$key]['ord_qty'] = $value['ord_qty'];
        //     $data[$key]['sold_qty'] = $value['sold_qty'];
        //     $data[$key]['stck_qty'] = $value['stck_qty'];
        //     $data[$key]['tran_stk'] = $value['tran_stk'];
        //     $data[$key]['sugg_qty'] = $value['sugg_qty'];


        //     $data[$key]['amount'] = $value['amount'];





    }



    function upload_image(){


      $config['upload_path'] = './uploads/excel_imports/purchase_based/';
      $config['allowed_types'] = 'xlsx|csv|xls';
      $config['max_size'] = 100000;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('userfile')) {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
    } else {
        $data = array('upload_data' => $this->upload->data());
    }
        $file = FCPATH . 'uploads/excel_imports/purchase_based/' . $data['upload_data']['file_name']; //$_FILES['fileToUpload']['tmp_name'];

        $this->load->library('Excel');
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');

        $objReader->setReadDataOnly(false);
        $objPHPExcel = $objReader->load($file); // error in this line


        $index = array(

            'part_no',
            'description',
            'rol',
            'po_qty',
            'ord_qty',
            'sold_qty',
            'stck_qty',
            'tran_stk',
            'sugg_qty',
            'price',
            'amount'



            );

        $raw_data = array();
        $data = array();
        $view_data = array();
        foreach ($objPHPExcel->getWorksheetIterator() as $key => $worksheet) {
            if ($key == 0) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
               // print_r($highestColumnIndex);
                for ($row = 2; $row <= $highestRow; ++$row) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        if (PHPExcel_Shared_Date::isDateTime($cell)) {
                            $val = date($format = "Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($val));
                        }
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        $raw_data[$row][$index[$col]] = $val;
                    }
                }
            }
        }
//   echo"<pre>";
// print_r($raw_data);
// exit;

        echo json_encode($raw_data);
    }


    function export(){
        $query = $this->db->get('ser_purchase_based');


        if(!$query)
            return false;

        // Starting the PHPExcel library
        $this->load->library('excel');
       // $this->load->library('IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="purchase_orders.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

    function delete() {
        $id = $this->input->post('id');
        $this->db->delete('ser_purchase_based',$id);
    }

}