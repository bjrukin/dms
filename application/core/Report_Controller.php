 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PROJECT
 *
 * PACKAGE DESCRIPTION
 *
 * @package         PROJECT
 * @author          <AUTHOR_NAME>
 * @copyright       Copyright (c) 2016
 */

// ---------------------------------------------------------------------------

/**
 * Report_Controller
 *
 * Extends the Project_Controller class
 * 
 */

class Report_Controller extends Project_Controller 
{
	var $group_criteria;
	var $report_criteria;

	public function __construct()
	{
		parent::__construct();

		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_monthly'),
									'value'	=> 'month', 					
									'name' 	=> 'Month Wise (English)'
									);

		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_monthly_np'),
									'value'	=> 'month_np', 					
									'name' 	=> 'Month Wise (Nepali)'
									);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_status', 'inquiry_conversion_ratio','inquiry_lost_case', 'inquiry_reason_purchase', 'inquiry_reason_non_purchase'),
						 			'value'	=> 'status_name', 			
						 			'name' 	=> 'Status Wise'
						 			);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_executive'),
									'value'	=> 'executive_name', 		
									'name' 	=> 'Executive Wise'
									); 
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_dealer'),
									'value'	=> 'dealer_name', 			
									'name' 	=> 'Dealer Wise'
									); 
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_vehicle'),
									'value'	=> 'vehicle_name', 			
									'name' 	=> 'Model Wise'
									);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_source'),
									'value'	=> 'source_name',			
									'name' 	=> 'Source Wise'
									);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_kind'),
									'value'	=> 'inquiry_kind', 			
									'name' 	=> 'Inquiry Kind Wise'
									); 

		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_type'),
									'value'	=> 'inquiry_type', 			
									'name' 	=> 'Inquiry Type Wise'
									); 

		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_payment_mode'),
									'value'	=> 'payment_mode_name',		
									'name' 	=> 'Mode of Payment Wise'
									); 
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_customer_type'),
									'value'	=> 'customer_type_name', 	
									'name' 	=> 'Customer Type Wise'
									);


		$this->report_criteria['inquiry_source'] 	= array(
																'dbview'	=> 'view_customers',
																'col'		=> 'Inquiry Source',
																'label'		=> 'Inquiry Source',
															);
		$this->report_criteria['inquiry_type']  	= array(
																'dbview'	=> 'view_customers',
																'col'		=> 'Inquiry Type',
																'label'		=> 'Inquiry Type',
															);
		$this->report_criteria['inquiry_kind']		= array(
																'dbview'	=> 'view_customers',
																'col'		=> 'Inquiry Kind',
																'label'		=> 'Inquiry Kind',
															);
		$this->report_criteria['inquiry_status']	= array(
																'dbview'	=> 'view_customers',
																'col'		=> 'Inquiry Status',
																'label'		=> 'Inquiry Status',
															);
		$this->report_criteria['inquiry_conversion']	= array(
																'dbview'	=> 'view_customers',
																'col'		=> 'Inquiry Conversion',
																'label'		=> 'Inquiry Conversion',
															);
		$this->report_criteria['inquiry_test_drive_conversion']	= array(
																'dbview'	=> 'view_customers',
																'col'		=> 'Test Drive Conversion',
																'label'		=> 'Test Drive Conversion',
															);
		$this->report_criteria['inquiry_demographic_information']	= array(
																'dbview'	=> 'view_inquiry_retail',
																'col'		=> '',
																'label'		=> 'Demographic Information',
															);
		$this->report_criteria['inquiry_institution'] = array(
																'dbview' 	=> 'view_inquiry_retail',
																'col' 		=> 'Institution',
																'label' 	=> 'Institution',
															);
		$this->report_criteria['inquiry_payment_mode']	= array(
																'dbview'	=> 'view_inquiry_retail',
																'col'		=> 'Payment Mode',
																'label'		=> 'Institution',
															);
		$this->report_criteria['inquiry_customer_type']	= array(
																'dbview'	=> 'view_inquiry_retail',
																'col'		=> 'Customer Type',
																'label'		=> 'Institution',
															);
		$this->report_criteria['inquiry_lost_case']	= array(
																'dbview'	=> 'view_inquiry_lost',
																'col'		=> 'Reason',
																'label'		=> 'Reason',
															);
		$this->report_criteria['inquiry_reason_purchase']	= array(
																'dbview'	=> 'view_inquiry_retail',
																'col'		=> 'Reason',
																'label'		=> 'Reason',
															);
		$this->report_criteria['inquiry_reason_non_purchase']	= array(
																'dbview'	=> 'view_inquiry_non_purchase',
																'col'		=> 'Reason',
																'label'		=> 'Reason',
															);
		$this->report_criteria['inquiry_pending']	= array(
																'dbview'	=> 'view_inquiry_pending',
																'col'		=> '',
																'label'		=> 'Inquiry Pending',
															);


	}

	public function get_grouping_criteria_json() {

		$key = $this->input->get('key');
		$exclude = ($this->input->get('exclude')) ? $this->input->get('exclude'): null;
		
		$jsonArray = array();
		
		foreach($this->group_criteria as $row) {
			if (in_array($exclude, $row['key'])) {
					continue;
			}
			if (!in_array($key, $row['key'])) {
				$jsonArray[] = $row;
			}
		}
		echo json_encode($jsonArray);
		exit;
	}

	/*
	var $group_criteria;
	

	public function __construct()
	{
		parent::__construct();

		$this->group_criteria   = array();
		$this->report_criteria  = array();

		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_monthly'),
									'value'	=> 'month', 					
									'name' 	=> 'Month Wise (English)'
									);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_status', 'inquiry_conversion_ratio','inquiry_lost_case', 'inquiry_reason_purchase', 'inquiry_reason_non_purchase'),
						 			'value'	=> 'status_name', 			
						 			'name' 	=> 'Status Wise'
						 			);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_executive'),
									'value'	=> 'executive_name', 		
									'name' 	=> 'Executive Wise'
									); 
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_dealer'),
									'value'	=> 'dealer_name', 			
									'name' 	=> 'Dealer Wise'
									); 
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_vehicle'),
									'value'	=> 'vehicle_name', 			
									'name' 	=> 'Model Wise'
									);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_source'),
									'value'	=> 'source_name',			
									'name' 	=> 'Source Wise'
									);
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_kind'),
									'value'	=> 'inquiry_kind', 			
									'name' 	=> 'Inquiry Kind Wise'
									); 

		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_type'),
									'value'	=> 'inquiry_type', 			
									'name' 	=> 'Inquiry Type Wise'
									); 

		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_payment_mode'),
									'value'	=> 'payment_mode_name',		
									'name' 	=> 'Mode of Payment Wise'
									); 
		
		$this->group_criteria[] = array(
									'key' 	=> array('inquiry_customer_type'),
									'value'	=> 'customer_type_name', 	
									'name' 	=> 'Customer Type Wise'
									);


		//1. Inquiry source month wise 
		$this->report_criteria['inquiry_source'] = array(
																'dbview' 		=> 'view_customers',
																'column' 		=> 'source_name',
																'label' 		=> 'Inquiry Source',
																'mst_column'	=> 'name',
																'table' 		=> 'mst_sources',
																'order' 		=> 'rank, 1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);

		//2a. Enquiry Type (Walk-In)
		$this->report_criteria['inquiry_type_walkin']	= array(
																'dbview' 		=> 'view_customers',
																'column' 		=> 'walkin_source_name',
																'label' 		=> 'Inquiry Type (Walk-In)',
																'mst_column'	=> 'distinct name',
																'table' 		=> 'mst_walkin_sources',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> ' source_id = 1 ',
																'condition2'	=> null
															);

		//2b. Enquiry Type (Generated)
		$this->report_criteria['inquiry_type_generated']	= array(
																'dbview' 		=> 'view_customers',
																'column' 		=> 'event_name',
																'label' 		=> 'Inquiry Type (Generated)',
																'mst_column'	=> 'distinct name',
																'table' 		=> 'dms_events',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> ' source_id = 2 ',
																'condition2'	=> null
															);
		//2c. Enquiry Type (Referral)
		$this->report_criteria['inquiry_type_referral']	= array(
																'dbview' 		=> 'view_customers',
																'column' 		=> 'inquiry_type',
																'label' 		=> 'Inquiry Type (Referral)',
																'mst_column'	=> 'distinct inquiry_type',
																'table' 		=> 'view_customers',
																'order' 		=> '1',
																'include_only'	=> array('Referral<BR>(%)'),
																'condition1'	=> null,
																'condition2'	=> null
															);
		//3. Inquiry Kind (Hot/Warm/Cold)
		$this->report_criteria['inquiry_kind']	= array(
																'dbview' 		=> 'view_customers',
																'column' 		=> 'inquiry_kind',
																'label' 		=> 'Inquiry Kind',
																'mst_column'	=> 'distinct inquiry_kind',
																'table' 		=> 'view_customers',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//4. Enquiry Status (Pending/Confirmed/Booked/Retailed/Lost/Cancelled/Closed)
		$this->report_criteria['inquiry_status'] = array(
																'dbview' 		=> 'view_customers',
																'column'		=> 'status_name',
																'label'			=> 'Inquiry Status',
																'mst_column'	=> 'name',
																'table'			=> 'mst_inquiry_statuses',
																'order' 		=> 'rank, 1',
																'include_only'	=> null,
																'condition1'	=> null, //' id not in (4,5,6,7,8,9,10,11,12,13,14) ',
																'condition2'	=> ' id not in (4,5,6,7,8,9,10,11,12,13,14) '
															); 
		//5. Enquiry conversion ratio (Model wise| Enquiry Type Wise| Enquiry Source Wise| Executive Wise | Dealer Wise| Month Wise)
		$this->report_criteria['inquiry_conversion_ratio'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'DYNAMIC',
																'label' 		=> 'Inquiry Conversion Ratio',
																'mst_column'	=> 'DYNAMIC',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//6. Test ride conversion report (model Wise |Month Wise| Executive Wise| Dealer Wise)
		$this->report_criteria['inquiry_test_ride_conversion_ratio'] = array(
																'dbview' 		=> 'view_test_drive_conversion_ratio',
																'column' 		=> 'DYNAMIC',
																'label' 		=> 'Test Ride Conversion Ratio',
																'mst_column'	=> 'DYNAMIC',
																'table' 		=> 'view_test_drive_conversion_ratio',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//7a.	Demographic Information  against retail (Model Wise| Executive/Dealer Wise)
		//Gender
		$this->report_criteria['inquiry_age_group'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'age_group',
																'label' 		=> 'Demographic (Age Group)',
																'mst_column'	=> 'DISTINCT age_group',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//Gender
		$this->report_criteria['inquiry_gender'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'gender',
																'label' 		=> 'Demographic (Gender)',
																'mst_column'	=> 'DISTINCT gender',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//Zone
		$this->report_criteria['inquiry_zone'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'zone_name',
																'label' 		=> 'Demographic (Zone)',
																'mst_column'	=> 'DISTINCT zone_name',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//District
		$this->report_criteria['inquiry_district'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'district_name',
																'label' 		=> 'Demographic (District)',
																'mst_column'	=> 'DISTINCT district_name',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//Occupation
		$this->report_criteria['inquiry_occupation'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'occupation_name',
																'label' 		=> 'Demographic (Occupation)',
																'mst_column'	=> 'name',
																'table' 		=> 'mst_occupations',
																'order' 		=> 'rank, 1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//Marital Status
		$this->report_criteria['inquiry_marital_status'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'marital_status',
																'label' 		=> 'Demographic (Marital Status)',
																'mst_column'	=> 'DISTINCT marital_status',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//Family Size
		$this->report_criteria['inquiry_family_size'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'family_size',
																'label' 		=> 'Demographic (Family Size)',
																'mst_column'	=> 'DISTINCT family_size',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//7b. Institution sector information on model wise retail
		$this->report_criteria['inquiry_institution'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'institution_name',
																'label' 		=> 'Institution',
																'mst_column'	=> 'name',
																'table' 		=> 'mst_institutions',
																'order' 		=> 'rank, 1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		// //7c. Customer Profession/Occupation
		// $this->report_criteria['inquiry_occupation'] = array(
		// 														'dbview' 		=> 'view_customers',
		// 														'column' 		=> 'occupation_name',
		// 														'label' 		=> 'Occupation',
		// 														'mst_column'	=> 'name',
		// 														'table' 		=> 'mst_occupations',
		// 														'order' 		=> 'rank, 1',
		// 														'include_only'	=> null,
		// 														'condition1'	=> null,
		// 														'condition2'	=> null
		// 													);
		//7d. Mode of purchase (Cash |Finance | Exchange)
		$this->report_criteria['inquiry_payment_mode'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'payment_mode_name',
																'label' 		=> 'Payment Mode',
																'mst_column'	=> 'name',
																'table' 		=> 'mst_payment_modes',
																'order' 		=> 'rank, 1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//7e. Type of Purchase (First time buyer | Additional Buyer |Replacement (Suzuki to suzuki exchange |Other brand to suzuki))
		$this->report_criteria['inquiry_customer_type'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'customer_type_name',
																'label' 		=> 'Customer Type',
																'mst_column'	=> 'name',
																'table' 		=> 'mst_customer_types',
																'order' 		=> 'rank, 1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//7f. Lost Case Analysis ( Model Wise| Brand Wise| Executive/Dealer Wise| VOC Wise)
		$this->report_criteria['inquiry_lost_case'] = array(
																'dbview' 		=> 'view_inquiry_lost',
																'column' 		=> 'DYNAMIC',
																'label' 		=> 'Lost Case',
																'mst_column'	=> 'DYNAMIC',
																'table' 		=> 'view_inquiry_lost',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//7g. Reason for purchase of suzuki
		$this->report_criteria['inquiry_reason_purchase'] = array(
																'dbview' 		=> 'view_inquiry_retail',
																'column' 		=> 'reason_name',
																'label' 		=> 'Inquiry Purchase Suzuki',
																'mst_column'	=> 'distinct reason_name',
																'table' 		=> 'view_inquiry_retail',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> ' status_id in (15) '
															);
		//7h. Reason for non purchase
		$this->report_criteria['inquiry_reason_non_purchase'] = array(
																'dbview' 		=> 'view_inquiry_non_purchase',
																'column' 		=> 'reason_name',
																'label' 		=> 'Inquiry Non Purchase Suzuki',
																'mst_column'	=> 'distinct reason_name',
																'table' 		=> 'view_inquiry_non_purchase',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> ' status_id in (16,17,18) '
															);
		//8. Inquiry Trend > 
		//9. Pending enquiry sales executive wise and model wise with enquiry kind
		$this->report_criteria['inquiry_pending'] = array(
																'dbview' 		=> 'view_inquiry_pending',
																'column' 		=> 'DYNAMIC',
																'label' 		=> 'Pending Inquiry',
																'mst_column'	=> 'DYNAMIC',
																'table' 		=> 'view_inquiry_pending',
																'order' 		=> '1',
																'include_only'	=> null,
																'condition1'	=> null,
																'condition2'	=> null
															);
		//10. Enquiry Target V/s Achievement sales  > Not Requuired
	}

	public function get_grouping_criteria_json() {

		$key = $this->input->get('key');
		$exclude = ($this->input->get('exclude')) ? $this->input->get('exclude'): null;
		
		$jsonArray = array();
		
		foreach($this->group_criteria as $row) {
			if (in_array($exclude, $row['key'])) {
					continue;
			}
			if (!in_array($key, $row['key'])) {
				$jsonArray[] = $row;
			}
		}
		echo json_encode($jsonArray);
		exit;
	}



	public function export_file($records, $title){
        
        $this->load->library('Excel');

        $headings = array();
        foreach($records[0] as $key=>$column) {
			$headings[] = $key;        	
        }

		$headingStyleArray = array(
							'font' => array(
								'bold' => true,
								'color' => array('argb' => 'FFFFFFFF'),
								'size'  => 16,
							),
							'alignment' => array(
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
								'wrap' => true,
							),
							'borders' => array(
								'allborders' => array(
										'style' => PHPExcel_Style_Border::BORDER_THIN,
										'color' => array('argb' => 'FFC4D79B'),
								)
							),
							'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_SOLID,
								'color' => array('argb' => 'FF136927'),
							),
                        );

		$firstAndLastRowStyleArray = array(
				'font' => array(
						'bold' => true,
						'color' => array('argb' => 'FFFFFFFF'),
						
				),
				'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'wrap' => true,
				),
				'borders' => array(
						'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN,
								'color' => array('argb' => 'FFC4D79B'),
						)
				),
				'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('argb' => 'FF136927'),
		
				),			
		);

		$oddRowStyleArray = array(
							'borders' => array(
									'allborders' => array(
											'style' => PHPExcel_Style_Border::BORDER_THIN,
											'color' => array('argb' => 'FFC4D79B'),
									)
							),
							'alignment' => array(
									'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
									'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
							),
							'fill' => array(
									'type' => PHPExcel_Style_Fill::FILL_SOLID,
									'color' => array('argb' => 'FFD8E4BC'),
					
							),
					);
		
		$evenRowStyleArray = array(
						'borders' => array(
								'allborders' => array(
										'style' => PHPExcel_Style_Border::BORDER_THIN,
										'color' => array('argb' => 'FFC4D79B'),
								)
						),
						'alignment' => array(
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
								'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						),
						'fill' => array(
								'type' => PHPExcel_Style_Fill::FILL_SOLID,
								'color' => array('argb' => 'FFEBF1DE'),
				
						),
				);

        $this->excel->setActiveSheetIndex(0);

        array_unshift($records, $headings);

        $this->excel->getActiveSheet()->fromArray($records, NULL, 'A5');

        $highestColumn =  $this->excel->getActiveSheet()->getHighestColumn();
		$highestRow    =  $this->excel->getActiveSheet()->getHighestRow();

		for ($row = 5; $row <= $highestRow; ++ $row) {
			$dataCellRange = 'A' . $row . ':'. $highestColumn.$row;
			if ($row % 2 == 1) {
				$this->excel->getActiveSheet()->getStyle($dataCellRange)->applyFromArray($oddRowStyleArray);
			} else {
				$this->excel->getActiveSheet()->getStyle($dataCellRange)->applyFromArray($evenRowStyleArray);
			}
		}

		$firsttRowCellRange = "A5:{$highestColumn}5";
		$this->excel->getActiveSheet()->getStyle($firsttRowCellRange)->applyFromArray($firstAndLastRowStyleArray);

		$lastRowCellRange = "A{$highestRow}:{$highestColumn}{$highestRow}";
		$this->excel->getActiveSheet()->getStyle($lastRowCellRange)->applyFromArray($firstAndLastRowStyleArray);

        $this->excel->getActiveSheet()->setTitle('Worksheet');
        $this->excel->getActiveSheet()->setCellValue('A1', $title);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells("A1:{$highestColumn}1");
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00A65A');
        $this->excel->getActiveSheet()->getStyle('A1')->applyFromArray($headingStyleArray);

        foreach(range('A',$highestColumn) as $columnID)
        {
            $this->excel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $dataPoints = (count($records) - 2);

        $secondLastRow = $highestRow - 1;
        $xAxisTickValues = array(
            new PHPExcel_Chart_DataSeriesValues('String', "Worksheet!\$A\$6:\$A\${$secondLastRow}", NULL, $dataPoints), //  Jan to Dec
        );
        
        $seriesArray	= array();
        $dataSeriesLabels = array();
        $dataSeriesValues = array();

        foreach($headings as $key => $row) {
        	
        	if ($key == 0)
        		continue;
        	if ($key == (count($headings) / 2))
        		break;

        	$cell = PHPExcel_Cell::stringFromColumnIndex($key);
        	$dataSeriesLabels[] = new PHPExcel_Chart_DataSeriesValues('String', "Worksheet!\${$cell}\$5", NULL, 1);
    		
	        $dataSeriesValues[] = new PHPExcel_Chart_DataSeriesValues('Number', "Worksheet!\${$cell}\$6:\${$cell}\${$secondLastRow}", NULL, $dataPoints);
        }

        $series = new PHPExcel_Chart_DataSeries(
	                PHPExcel_Chart_DataSeries::TYPE_BARCHART, 		// plotType
	                PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED, 	// plotGrouping
	                range(0, count($dataSeriesValues)-1), // plotOrder
	                $dataSeriesLabels, 						// plotLabel
	                $xAxisTickValues, 								// plotCategory
	                $dataSeriesValues						// plotValues
        		);

        $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

		//	Set the series in the plot area
		$plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series));
		//	Set the chart legend
		$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_BOTTOM, NULL, false);

		$title = new PHPExcel_Chart_Title('');
		
		//	Create the chart
		$chart = new PHPExcel_Chart(
			'chart1',		// name
			$title,			// title
			$legend,		// legend
			$plotArea,		// plotArea
			true,			// plotVisibleOnly
			0,				// displayBlanksAs
			NULL,			// xAxisLabel
			NULL			// yAxisLabel
		);

		//	Set the position where the chart should appear in the worksheet
		$chart->setTopLeftPosition('A'. ($highestRow+2));
		$chart->setBottomRightPosition($highestColumn.($highestRow+15));

		//	Add the chart to the worksheet
		$this->excel->getActiveSheet()->addChart($chart);

		header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=Report.xlsx');
        header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		$objWriter->setIncludeCharts(TRUE);
		$objWriter->save('php://output');
    }
    */

	
}
