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
 * Rename the file to Job_card.php
 * and Define Module Library Function (if any)
 */


/* End of file Job_card.php */
/* Location: ./modules/Job_card/libraries/Job_card.php */

class Job_card {

    public $CI;

    public function __construct() {
        $this->CI = & get_instance();

        $this->CI->load->model('job_cards/job_card_model');

        $this->CI->load->helper(array('project'));
    }

    /**
     * 
     * @param type $data(array of id and status of required field), $table
     * @return type mixed
     */
    public function update_status($data, $table = NULL) {
    	if($table != NULL){
    		$this->CI->job_card_model->_table = $table;
    	}

    	$success = $this->CI->job_card_model->update($data['id'],$data);
    	return $success;
    }
}