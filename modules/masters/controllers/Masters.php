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
 * Masters
 *
 * Extends the Project_Controller class
 * 
 */

class Masters extends Project_Controller
{
	public function __construct()
	{
    	parent::__construct();

    	control('Masters');

        $this->load->model('masters/master_model');
        $this->lang->load('masters/master');

    }

	public function index()
	{
		// Display Page
		$data['header'] = lang('masters');
		$data['page'] = $this->config->item('template_admin') . "index";
		$data['module'] = 'masters';
		$this->load->view($this->_container,$data);
	}

	public function json()
	{
		$table = $this->input->get('table_name');

        $this->master_model->_table = $table;

		search_params();
		
		$total=$this->master_model->find_count();
		
		paging('id');
		
		search_params();
		
		$rows=$this->master_model->findAll();
		
		echo json_encode(array('total'=>$total,'rows'=>$rows));
		exit;
	}

	public function save()
	{
        $data=$this->_get_posted_data(); //Retrive Posted Data

        $table = $this->input->post('table_name');

        $this->master_model->_table = $table;

        if(!$this->input->post('id'))
        {
            $success=$this->master_model->insert($data);
        }
        else
        {
            $success=$this->master_model->update($data['id'],$data);
        }

		if($success)
		{
			$success = TRUE;

			$msg=lang('general_success');

			$haystack = array('mst_colors', 'mst_banks');

			$name = (!in_array($table, $haystack)) ? 'name' : " (name || ' ('  || code || ')') as name ";

			$params = array();
            $params['table'] = $table;
            $params['fields'] = array('id',$name);
            $params['order'] = ' rank asc';
            $params['array_unshift'] = array('id' => '0', 'name' => 'Select');
            $params['filename'] = "{$table}";

            $this->load->library('project');
            if ($table != 'mst_reasons') {
	            $this->project->write_cache($params);
	        } else { 
	        	$types = array(REASON_OTHER_BANK, REASON_RETAIL, REASON_LOST, REASON_CANCEL, REASON_CLOSED);
	        	foreach($types as $type) {
	        		$params['where'] = array('type' => $type);
	        		$params['filename'] = str_replace(' ', '_', strtolower("{$table}_{$type}"));
	        		$this->project->write_cache($params);
	        	}
	        }
		}
		else
		{
			$success = FALSE;
			$msg=lang('general_failure');
		}

		 echo json_encode(array('msg'=>$msg,'success'=>$success));
		 exit;
	}

   private function _get_posted_data()
   {
   		$data=array();
   		
   		if($this->input->post('id')) {
			$data['id'] = $this->input->post('id');
		}

		if ($this->input->post('code')) {
			$data['code'] = $this->input->post('code');
		}

		if ($this->input->post('type')) {
			$data['type'] = $this->input->post('type');
		}

		if ($this->input->post('firm_id')) {
			$data['firm_id'] = $this->input->post('firm_id');
		}
		
		$data['name'] = trim($this->input->post('name'));
		$data['rank'] = $this->input->post('rank');

        return $data;
   }

   public function check_duplicate() 
    {
        $field = $this->input->post('field');
        $value = $this->input->post('value');
        
        $table = $this->input->post('table_name');

        $this->master_model->_table = $table;

        $this->db->where("UPPER($field)", strtoupper($value));

        if ($this->input->post('id')) {
            $this->db->where('id <>', $this->input->post('id'));
        }

        $total = $this->master_model->find_count();

        if ($total == 0) 
            echo json_encode(array('success' => true));
         else
            echo json_encode(array('success' => false));
    }

    public function generate_excel($table = NULL)
    {
        if($table == 'mst_colors')
        {
            $this->db->select('id,code');
        }
        else
        {
            $this->db->select('id,name');
        }
        $this->db->from($table);
        $this->db->order_by('id');
        $rows = $this->db->get()->result();

        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel(); 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1','id');
        if($table == 'mst_colors')
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('B1','code');
        }
        else
        {
            $objPHPExcel->getActiveSheet()->SetCellValue('B1','name');
        }

        $row = 2;
        $col = 0;        
        foreach($rows as $key => $values) 
        {           
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->id);
          $col++;
          if($table == 'mst_colors')
          {
              $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->code);
              $col++;
          }
          else
          {
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $values->name);
              $col++; 
          }
              $row++;
              $col = 0;
          }
          header("Pragma: public");
          header("Content-Type: application/force-download");
          header("Content-Disposition: attachment;filename=".$table.".xls");
          header("Content-Transfer-Encoding: binary ");
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
          ob_end_clean();
          $objWriter->save('php://output');
      }
}