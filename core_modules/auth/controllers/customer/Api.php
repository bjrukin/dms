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
 * Auth
 *
 * Extends the Public_Controller class
 * 
 */

class Api extends REST_Controller
{
	public function __construct()
	{
		// parent::__construct();
		parent::__construct();
       $this->load->database();
	}

	public function login_post()
	{
		// $this->input->post();
		$query = "SELECT a.attname as primary_key
				FROM   pg_index i
				JOIN   pg_attribute a ON a.attrelid = i.indrelid
				                     AND a.attnum = ANY(i.indkey)
				WHERE  i.indrelid = 'project_activity_logs'::regclass
				AND    i.indisprimary;";

		$fields = $this->db->query($query)->row_array();

		echo '<pre>';
		print_r($fields['primary_key']);
	}
}