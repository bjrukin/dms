<?php 
//defined('BASEPATH') OR exit('No direct script access allowed');

/**
* PROJECT
*
* @package         PROJECT
* @author          <AUTHOR_NAME>
* @copyright       Copyright (c) 2016
*/

// ---------------------------------------------------------------------------

/**
* Sparepart_orders
*
* Extends the Project_Controller class
* 
*/

class Auto_confirm extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sparepart_orders/sparepart_order_model');

		control('Sparepart Orders');
	}

	/**
	* auto confirmation 24hr after pi is generated 
	* need cron
	**/
	public function index(){		
		// $fields = "proforma_invoice_id, dealer_id, credit_policy, actual_credit, total_amount";// 1 for confirm 2 for regect

		$this->sparepart_order_model->_table = 'view_auto_confirm_pi';
		$unconfirmed_records = $this->sparepart_order_model->find_all(NULL);
		// print_r($unconfirmed_records);
		// exit;
		$this->sparepart_order_model->_table = 'spareparts_sparepart_order';

		$success = '';
		foreach($unconfirmed_records as $key => $value){
			$where['proforma_invoice_id'] = $value->proforma_invoice_id;
			$items = $this->sparepart_order_model->find_all($where);
			// print_r($items);
			foreach ($items as $inde => $item) {
				$data['id'] = $item->id;
				$data['dealer_confirmed'] = $value->confirm_satatus;
				$data['confirmed_type'] = 'AUTO';
				$success = $this->sparepart_order_model->update($data['id'],$data);
			};
		}
		if($success)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}
}