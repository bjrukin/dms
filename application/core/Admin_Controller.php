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
 * Admin_Controller
 *
 * Extends the MY_Controller class
 * 
 */

class Admin_Controller extends MY_Controller 
{

	var $_container;
	var $_user_id;
	var $_dealer;
	/**
	 * Load and set data for some common used libraries.
	 */
	public function __construct()
	{
		parent::__construct();

		// if ajax request & not user is logged in 
		// then redirect to login page
		if ( $this->input->is_ajax_request() && !is_loggedin()) {
			$this->output->set_status_header('999', 'ERROR');
			exit;
		}
		// Set container variable
		$this->_container = $this->config->item('template_admin') . "container.php";

		control('Control Panel');

		$this->_user_id = $this->session->userdata('id');
		
		$current_user = get_current_user_details();
		
		//if current user is SE or TL then store
		if (is_array($current_user)) {
			$this->session->set_userdata('employee', $current_user);
		}
		//for user dealer detail
		$this->_dealer = $this->getDealer();
	}
	//function user dealer detail
	public function getDealer($id = NULL)
	{
		if($id ==NULL){
			$id = $this->_user_id;
		}

        $this->load->model('dealers/dealer_model');
		$dealer = $this->dealer_model->get_by(array('incharge_id'=>$id));
		return $dealer;
	}
}