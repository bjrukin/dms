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
 * Rename the file to Sparepart.php
 * and Define Module Library Function (if any)
 */


/* End of file Sparepart.php */
/* Location: ./modules/Sparepart/libraries/Sparepart.php */

class Sparepart
{
	public $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('spareparts/sparepart_model');
		$this->CI->load->helper(array('project'));
	}

	public function excel_export_spareparts($start,$end)
	{
    	ini_set('memory_limit', '-1');
    	// ini_set('max_execution_time','500');

		$fields = 'part_code,name,dealer_price';
		$this->CI->db->where("id >={$start} AND id <={$end}");
		$rows = $this->CI->sparepart_model->findAll(NULL,$fields);
		/*echo $this->CI->db->last_query();
		print_r($rows);
		exit;*/
		if($rows)
		{
			$this->CI->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','S.N.');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Part Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Part Name');
			/*$objPHPExcel->getActiveSheet()->SetCellValue('D1','Alternate Part Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Latest Part Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','MOQ');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1','UOM');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1','Category Id');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1','MRP');*/
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Dealer Price');

			$row = 2;
			$col = 0;        
			foreach($rows as $key => $values) 
			{           
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $key+1);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->part_code);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->name);
				$col++;
				/*$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->alternate_part_code);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->latest_part_code);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->moq);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->uom);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->category_id);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->price);
				$col++;*/
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->dealer_price);
				$col++;
				$col = 0;
				$row++;        
			}

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=AllMasterSpareparts.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');
		}
	}
}