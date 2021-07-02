<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends MY_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function delete_user($user_id) 
	{

	 	$this->load->library('auth/Aauth');

        echo "Result: Delete User<BR>";
    
        var_dump($this->aauth->delete_user($user_id));
	}

	public function convert_date()
	{
		$nepali_dates = array(
					'2073-04-02',
					'2073-04-03',
					'2073-04-04',
					'2073-04-05',
					'2073-04-06',
					'2073-04-07',
					'2073-04-09',
					'2073-04-10',
					'2073-04-11',
					'2073-04-12',
					'2073-04-13',
					'2073-04-14',
					'2073-04-16',
					'2073-04-17',
					'2073-04-18',
					'2073-04-19',
					'2073-04-20',
					'2073-04-21',
					'2073-04-23',
					'2073-04-24',
					'2073-04-25',
					'2073-04-26',
					'2073-04-27',
					'2073-04-28',
					'2073-04-30',
					'2073-04-31',
					'2073-04-32',
					'2073-05-01',
					'2073-05-03',
					'2073-05-04',
					'2073-05-05',
					'2073-05-06',
					'2073-05-07',
					'2073-05-08',
					'2073-05-09',
					'2073-05-10',
					'2073-05-12',
					'2073-05-14',
					'2073-05-15',
					'2073-05-16',
					'2073-05-17',
					'2073-05-18',
					'2073-05-19',
					'2073-05-23',
					'2073-05-24',
					'2073-05-26',
					'2073-05-27',
					'2073-05-28',
					'2073-05-20',
					'2073-05-22',
					'2073-05-29',
					'2073-05-21',
					'2073-05-30',
					'2073-05-31',
					'2073-06-01',
					'2073-06-02',
					'2073-06-03',
					'2073-06-04',
					'2073-06-05',
					'2073-06-06',
					'2073-06-07',
					'2073-06-08',
					'2073-06-09',
					'2073-06-10',
					'2073-06-11',
					'2073-06-12',
					'2073-06-13',
					'2073-06-14',
					'2073-06-17',
					'2073-06-18',
					'2073-06-19',
					'2073-06-20',
					'2073-06-21',
					'2073-06-28',
					'2073-06-30',
					'2073-06-23',
					'2073-06-16'
				);
			$this->load->library('nepali_calendar');
			foreach ($nepali_dates as $date) {
				echo "<BR>" . get_english_date($date, 'text'). "\r\n";
			}
	}

	public function check_nepali_cal_lib() 
	{
		$this->load->library('nepali_calendar');
		$results = $this->db->query('select inquiry_date_en from dms_customers');
		$results = $results->result_array();
		foreach ($results as $row) {
			// $time = strtotime($row['inquiry_date_en']);
			// $nepali = $this->nepali_calendar->AD_to_BS(date('Y', $time) ,date('m', $time),date('d',$time),'array');
			print $row['inquiry_date_en'] ."\t". get_nepali_date($row['inquiry_date_en'], 'text'). "\r\n";
		}
		// print_r($this->nepali_calendar->AD_to_BS(1985,7,20,'array'));
		// print "<BR>";
		// print_r($this->nepali_calendar->BS_to_AD(2042,4,5));
		// print "<BR>";
	}

	public function check_num_two_words_lib() 
	{
		$this->load->library('number_to_words');
		print_r($this->number_to_words->convert_number('2133234.99'));
	}

	public function generate_json() {

		$this->load->library('project');

		$masterTables = array(	
			'mst_banks',
	    	'mst_colors',
			'mst_customer_types',
			'mst_designations',
			'mst_educations',
			'mst_inquiry_statuses',
			'mst_institutions',
			'mst_occupations',
			'mst_payment_modes',
			'mst_relations',
			'mst_sources',
			'mst_titles',
			'mst_variants',
			'mst_vehicles',
			'mst_walkin_sources'
		);

		foreach ($masterTables as $table) {

	    	$haystack = array('mst_colors', 'mst_banks');

			$name = (!in_array($table, $haystack)) ? 'name' : " (name || ' ('  || code || ')') as name ";

	    	$params['table'] = $table;
            $params['fields'] = array('id',$name);
            $params['order'] = ' rank asc';
            $params['array_unshift'] = array('id' => '0', 'name' => 'Select');
            $params['filename'] = "{$table}";

            $this->load->library('project');

            $this->project->write_cache($params);

            echo "{$table}.json Generated\r\n";
	    }


	    $params = array();
        $params['table'] = 'mst_reasons';
        $params['fields'] = array('id',$name);
        $params['order'] = ' rank asc';
        $params['array_unshift'] = array('id' => '0', 'name' => 'Select');

    	$types = array(REASON_OTHER_BANK, REASON_RETAIL, REASON_LOST, REASON_CANCEL, REASON_CLOSED, REASON_REJECT_1, REASON_REJECT_2, REASON_DELIVERY);
    	foreach($types as $type) {
    		$params['where'] = array('type' => $type);
    		$params['filename'] = str_replace(' ', '_', strtolower("mst_reasons_{$type}"));
    		$this->project->write_cache($params);
    		echo "{$params['filename']}.json Generated\r\n";
    	}


		$this->load->model('district_mvs/district_mv_model');

        $params['table'] = 'view_district_mvs';
        $params['fields'] = array('id','name');
        $params['where'] = array('type' => 'DISTRICT');
        $params['order'] = ' name asc';
        $params['array_unshift'] = array('id' => '0', 'name' => 'Select District');
        $params['filename'] = "districts";

        $this->project->write_cache($params);

        echo "district.json Generated\r\n";

        $this->db->where('type', 'DISTRICT');
        $results = $this->district_mv_model->findAll();

        foreach($results as $row) {

        	$parent_id = $row->id;

	        $params['table'] = 'view_district_mvs';
	        $params['fields'] = array('id','name');
	        $params['where'] = array('parent_id' => $parent_id);
	        $params['order'] = ' name asc';
	        $params['array_unshift'] = array('id' => '0', 'name' => 'Select MUN/VDC');
	        $params['filename'] = "mun_vdc_{$parent_id}";

	        $this->project->write_cache($params);

	        echo "mun_vdc_{$parent_id}.json Generated\r\n";
	    }
	}
}
