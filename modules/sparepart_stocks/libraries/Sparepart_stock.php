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
 * Rename the file to Sparepart_stock.php
 * and Define Module Library Function (if any)
 */


/* End of file Sparepart_stock.php */
/* Location: ./modules/Sparepart_stock/libraries/Sparepart_stock.php */

Class Sparepart_stock 
{

	public $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('sparepart_stocks/sparepart_stock_model');
		$this->CI->load->helper(array('project'));
	}

	public function excel_export_sparepart_stock()
	{
		$fields = 'part_code,name,stock_quantity,location';
		$this->CI->sparepart_stock_model->_table = "view_sparepart_real_stock";
		$rows = $this->CI->sparepart_stock_model->findAll(NULL,$fields);

		if($rows)
		{
			$this->CI->load->library('Excel');

			$objPHPExcel = new PHPExcel(); 
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1','S.N.');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1','Part Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1','Part Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1','Quantity');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1','Location');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1','Location');

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
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->stock_quantity);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->location);
				$col++;
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, @$values->price);
				$col++;
				$col = 0;
				$row++;        
			}

			header("Pragma: public");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment;filename=AllSparepartsStock.xls");
			header("Content-Transfer-Encoding: binary ");
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');
		}
	} 

	public function get_stock($stockyard_id, $sparepart_id)
	{
		$this->CI->sparepart_stock_model->_table = "view_sparepart_real_stock";
		$where = array(
			'stockyard_id' => $stockyard_id,
			'sparepart_id' => $sparepart_id
		);

		$data = $this->CI->sparepart_stock_model->find($where);
		if(!$data){
			return FALSE;
		}

		return $data;
	}
}