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

/*
* Rename the file to Sparepart_order.php
* and Define Module Library Function (if any)
*/


/* End of file Sparepart_order.php */
/* Location: ./modules/Sparepart_order/libraries/Sparepart_order.php */

class Sparepart_order{
	public $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('sparepart_orders/sparepart_order_model');
		$this->CI->load->model('sparepart_stocks/sparepart_stock_model');
		$this->CI->load->model('spareparts/sparepart_model');
		$this->CI->load->model('spareparts_dealers/spareparts_dealer_model');
		$this->CI->load->model('dealers/dealer_model');
		$this->CI->load->model('document_counts/document_count_model');
		$this->CI->load->model('picklists/picklist_model');
		$this->CI->load->model('spareparts_dealer_opening_credits/spareparts_dealer_opening_credit_model');
		$this->CI->load->helper(array('project'));
	}

	public function sparepart_list_json()
	{
		$sparepart = $this->CI->sparepart_model->findAll(NULL,array('id','part_code','name'),NULL,NULL,100);
		array_unshift($sparepart, array('id' => '0', 'part_code' => 'Select Porduct'));
		return $sparepart;
	}

	public function dealer_list_json()
	{
		$dealer_list = $this->CI->dealer_model->findAll(NULL,array('id','name'));
		array_unshift($dealer_list, array('id' => '0', 'name' => 'Select Dealer'));
		return $dealer_list;
	}

	public function generate_proforma_invoice($order_no,$pi_id,$export_type,$dealer_details,$dealer_id)
	{
		$this->CI->sparepart_order_model->_table = 'view_spareparts_dealer_order'; 

		$result = $this->CI->sparepart_order_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));	
		$fields = 'dealer_name,created_at,pi_generated_date_time,order_type,district_name,address_1';
		$this->CI->db->group_by($fields);
		$header_info = $this->CI->sparepart_order_model->find(array('order_no'=>$order_no,'dealer_id'=>$dealer_id),$fields);

		if(!empty($result))
		{
			if(!$result[0]->pi_number)
			{
				$this->CI->sparepart_order_model->_table = 'spareparts_sparepart_order';
				foreach ($result as $value) {
					$data['id'] = $value->id;
					$data['pi_generated'] = 1;
					$data['proforma_invoice_id'] = $pi_id->proforma_invoice_id + 1;
					$data['pi_number'] = "SHEPI-".sprintf('%04d',$pi_id->proforma_invoice_id + 1);
					$data['pi_generated_date_time'] = date('Y-m-d');
					$success = $this->CI->sparepart_order_model->update($data['id'],$data); 
				}
			}

			if($export_type == 1)
			{
				$this->CI->load->library('Excel');
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getActiveSheet()->setTitle('Proforma Invoice');
				$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
				$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
				$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
				$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
				$objPHPExcel->getActiveSheet()->getStyle('A5:F10')->getFont()->setBold(true);

				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1','PROFORMA INVOICE')
				->setCellValue('A2','Shree Himalayan Enterprises Pvt. Ltd.')
				->setCellValue('A3','Spare Parts Logistic - Satungal')
				->setCellValue('B5','PI No:')
				->setCellValue('C5', ($data['pi_number'] ? $data['pi_number']:$result[0]->pi_number))
				->setCellValue('E5','Order recv.')
				->setCellValue('F5',date_format(date_create($header_info->created_at),"Y-m-d"))
				->setCellValue('B6', 'Dealer:')
				->setCellValue('C6', $header_info->dealer_name)
				->setCellValue('E6', 'PI issue date')
				->setCellValue('F6', $header_info->pi_generated_date_time)
				->setCellValue('B7', 'Address:')
				->setCellValue('C7', $header_info->address_1.', '.$header_info->district_name)
				->setCellValue('E7', 'Effective Date')
				->setCellValue('F7', date('Y-m-d'))
				->setCellValue('E8', 'Ord. Type')
				->setCellValue('F8', $header_info->order_type)
				->setCellValue('A10', 'S.N.')
				->setCellValue('B10', 'SUP. PART NO.')
				->setCellValue('C10', 'DESCRIPTION')
				->setCellValue('D10', 'QTY')
				->setCellValue('E10', 'RATE')
				->setCellValue('F10', 'TOTAL');

				$row = 11;
				$col = 0;            
				foreach($result as $key => $values) 
				{							
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->part_code);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->name);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->order_quantity);
					$col++;
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->dealer_price);
					$col++; 

					$objPHPExcel->getActiveSheet()
					->setCellValue(
						'F'.$row,
						'=(D'.$row.'*E'.$row.')'
					);		

					$col = 0;
					$row++;
				}

				$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':C'.$row);
				$objPHPExcel->getActiveSheet()

				->setCellValue('A'.$row, 'Total of pi')
				->setCellValue(
					'D'.$row,
					'=SUM(D11:D'.($row-1).')'
				)
				->setCellValue(
					'F'.$row,
					'=SUM(F11:F'.($row-1).')'
				)
				->setCellValue('A'.($row+2), 'Note: Above mentioned rate is excluding the vat amount.');
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
				$objPHPExcel->getActiveSheet()->getStyle(
					'A10:F'.($row)
				)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($row+2).':F'.($row+2))->getFont()->setBold(true);

				$objPHPExcel->getActiveSheet()->getStyle('E11:E'.($row-1))
				->getNumberFormat()
				->setFormatCode('###,###,###.00');
				$objPHPExcel->getActiveSheet()->getStyle('F11:F'.($row))
				->getNumberFormat()
				->setFormatCode('###,###,###.00');

				header("Pragma: public");
				header("Expires: 0");
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment;filename=Proforma.xls");
				header("Content-Transfer-Encoding: binary ");
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				ob_end_clean();
				ob_start();
				$objWriter->save('php://output');
			}
			if($export_type == 2)					
			{
				$this->CI->load->library('html2pdf');
				$data['rows'] = $result;
				$data['header_info'] = $header_info;
				$data['pi_id'] = $pi_id->proforma_invoice_id;
				$content=$this->CI->load->view('admin/proforma_invoice',$data,TRUE);        
				$file_name = "proforma_invoice.pdf";

				ob_clean();
				$this->CI->html2pdf->WriteHTML($content);
				$path='uploads/spareparts_pi/';
				$this->CI->html2pdf->Output($path.$file_name); 
			}

		}
		else
		{
			flashMsg('error', 'PI Already Generated.');     
			redirect($_SERVER['HTTP_REFERER']);
		}

	}


	public function pi_confirm($order_no,$dealer_id)
	{

		$result = $this->CI->sparepart_order_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id,'dealer_confirmed <>'=>0));
		
		if(!empty($result))	
		{
			foreach($result as $value)
			{
				$data['id'] = $value->id;
				$data['pi_confirmed'] = 1;
				$success = $this->CI->sparepart_order_model->update($data['id'],$data);
			}
		}
		else
		{
			$success = FALSE;
		}

		return $success;	
	}
	public function dealer_pi_confirm($order_no,$dealer_id)
	{
		
		$this->CI->sparepart_order_model->_table = 'view_spareparts_dealer_order';
		$result = $this->CI->sparepart_order_model->findAll(array('order_no'=>$order_no,'dealer_id'=>$dealer_id));
		$total_new_amount= 0;
		$total_credit = 0;
		$total_new_credit = 0;

		foreach ($result as $new_value) {
			$total_new_amount += $new_value->dealer_price * $new_value->order_quantity;
			$pi_check = $new_value->pi_generated;			
		}

		$this->CI->picklist_model->_table = "view_sparepart_picklist";
		$picklist_items = $this->CI->picklist_model->findAll(array('dealer_id'=>$dealer_id,'is_billed'=>0));
		$picklist_amount = 0;
		foreach ($picklist_items as $key => $value) 
		{
			$picklist_amount += $value->dealer_price * $value->dispatch_quantity;
		}

		$this->CI->dealer_credit_model->_table = 'view_credit_policy';
		$credit_check = $this->CI->dealer_credit_model->findAll(array('dealer_id'=>$dealer_id));
		$credit_policy = $this->CI->dealer_model->find(array('id'=>$dealer_id),'credit_policy');
		$opening_credit = $this->CI->spareparts_dealer_opening_credit_model->find(array('id'=>$dealer_id),'opening_credit');

		$total_new_credit += $total_new_amount;
		if(!empty($credit_check))
		{
			foreach ($credit_check as  $value) 
			{
				if($value->cr_dr == 'CREDIT') 
				{
					$total_credit += $value->amount;
				}
				if($value->cr_dr == 'DEBIT')
				{
					$total_credit -= $value->amount;
				}
				$total_new_credit += $total_credit;
			}
		}

		/*if($credit_policy->credit_policy > (($opening_credit ? $opening_credit : 0) + $total_new_credit + $picklist_amount))
		{*/
			foreach($result as $value)
			{
				$data['id'] = $value->id;
				$data['dealer_confirmed'] = 1;
				$data['confirmed_type'] = 'MANUAL';
				$this->CI->sparepart_order_model->_table = "spareparts_sparepart_order";
				$success = $this->CI->sparepart_order_model->update($data['id'],$data);
			}
		/*}
		else
		{
			$success = FALSE;
			$msg = 'Credit Limit Exceeds';
		}
*/		return $success;	
	}

	public function jqxupload()
	{        
		$target_dir = $_SERVER['DOCUMENT_ROOT']."uploads/debit_receipt/";     
		@mkdir($target_dir,0755,true);
		$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) 
		{
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} 
			else 
			{
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		if (file_exists($target_file)) 
		{
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		if ($_FILES["fileToUpload"]["size"] > 500000) 
		{
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) 
		{
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
			{
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else 
			{
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}

	public function send_email_notification($email_data)
	{
		$this->CI->load->library('email');

		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->CI->email->initialize($config);

		$this->CI->email->set_mailtype('html');
		$this->CI->email->to($email_data['email']);
		$this->CI->email->subject($email_data['subject']);
		$this->CI->email->from('shyam.shrestha@cg.holdings');
		$this->CI->email->message($email_data['body']);	
		$this->CI->email->send();
	}
}