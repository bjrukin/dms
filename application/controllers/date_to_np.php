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
 * Dashboard
 *
 * Extends the Admin_Controller class
 * 
 */
class Date_to_np extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('dashboard');
		$this->load->dbforge();
	}

	public function index()
	{
		// list of table
		$this->load->dbforge();
		
		$tables = array(
			array(
				'table_name'=>'msil_dispatch_records',
				'fields' => array(
					array('eng_date' => 'dispatch_date', 'nep_date'=>'dispatched_date_np'),
					array('eng_date' => 'indian_stock_yard', 'nep_date'=>'indian_stock_yard_np'),
					array('eng_date' => 'indian_custom', 'nep_date'=>'indian_custom_np'),
					array('eng_date' => 'nepal_custom', 'nep_date'=>'nepal_custom_np'),
					array('eng_date' => 'vehicle_register_date', 'nep_date'=>'vehicle_register_date_np'),
					)
				),
			// array(
			// 	'table_name'=>'log_dealer_order',
			// 	'fields' => array(
			// 		array('eng_date' => 'date_of_retail', 'nep_date'=>'date_of_retail_np'),
			// 		),
			// 	),
			// array(
			// 	'table_name'=>'log_dispatch_dealer',
			// 	'fields' => array(
			// 		array('eng_date' => 'dispatched_date', 'nep_date'=>'dispatched_date_np'),
			// 		),
			// 	)
			);

		// convert date and update
		foreach ($tables as $table) {
			foreach($table['fields'] as $field){
				// remove column if exist
				// $this->dbforge->drop_column($table['table_name'], $field['nep_date']);

				$columns = $this->db->list_fields($table['table_name']);

				// create new date column
				if(!in_array($field['nep_date'], $columns)){
					$this->dbforge->add_column($table['table_name'], $field['nep_date'] . ' varchar(30)');
				}
				//create new month column
				if(!in_array($field['nep_date'] . '_month',$columns)){
					$this->dbforge->add_column($table['table_name'], $field['nep_date'] . '_month' . ' varchar(30)');

				}
				//create new month column
				if(!in_array($field['nep_date'] . '_year',$columns)){
					$this->dbforge->add_column($table['table_name'], $field['nep_date'] . '_year' . ' varchar(30)');

				}

				$this->db->select('id,'.$field['eng_date']);
				$data = $this->db->get($table['table_name'])->result_array();
				foreach($data as $date){
					$np_date = get_nepali_date($date[$field['eng_date']],'true');
					$np_dates = explode('-', $np_date);
					$nepali_date[$field['nep_date']] = $np_date;
					$nepali_date[$field['nep_date'].'_month'] = $np_dates['1'];
					$nepali_date[$field['nep_date'].'_year'] = $np_dates['0'];


					// echo $nepali_date;
					$this->db->where('id',$date['id']);
					$this->db->update($table['table_name'],$nepali_date);
				}
			}
		}
	}
}
