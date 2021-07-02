<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealers_lib
{
	public $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('dealers/dealer_model');
		$this->CI->load->helper(array('project'));
	}

	public function excel_export_dealers()
	{
		$this->CI->dealer_model->_table = "view_dealers";
		$rows = $this->CI->dealer_model->findAll();

		if($rows)
		{
			$this->CI->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','S.N.');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Dealer');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Incharge');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','District');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','VDC');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','City');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','Address 1');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Address 2');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','Phone 1');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1','Phone 2');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1','Email');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1','Fax');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1','Latitude');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1','Longitude');

			$row = 2;
			$col = 0;        
			foreach($rows as $key => $values) 
			{           
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->incharge_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->district_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->mun_vdc_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->city_name);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->address_1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->address_2);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->phone_1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->phone_2);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->email);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->fax);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->latitude);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->longitude);
				$col++;
				
				$col = 0;
				$row++;        
			}

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=Dealers.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');
		}
	}
}