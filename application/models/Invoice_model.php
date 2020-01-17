<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model { 

	public function getRepairIdArray($user)
	{
		$current_invoice_id = $this->session->userdata('invoice_id');
		$this->db->select('deviceinfo.*');
	  	$this->db->from('deviceinfo');
	    $this->db->where('telephone_no',$user[0]['telephone_no']);
	    $this->db->where('invoice_id',$current_invoice_id);
	  	$this->db->order_by('deviceinfo.repair_id', 'asc');
	  	$q = $this->db->get();
	  	
	  	$result_array = array();

		foreach ($q->result_array() as $val) {
		 	# code...
	  		array_push($result_array,$val['repair_id']);
		} 
	  	return $result_array;	
	}

	public function getRepairLst($telephone_no,$array)
	{
		$current_invoice_id = $this->session->userdata('invoice_id');
		$this->db->select('repairs.*, deviceinfo.*');
	  	$this->db->from('repairs');
	    $this->db->join('deviceinfo', 'repairs.repair_id = deviceinfo.repair_id');

	    foreach ($array as $val) {
	    	$this->db->or_where('repairs.repair_id',$val)
					 ->where('deviceinfo.telephone_no',$telephone_no)
					 ->where('deviceinfo.invoice_id',$current_invoice_id);
	    }

	  	$this->db->order_by('repairs.repair_id', 'asc');
	  	$q = $this->db->get();
	  	return $q->result_array();
	}

	public function addInvoiceInfo($total_price,$user)
	{
        $invoice_id = $this->session->userdata('invoice_id');
		$date = date("Y-m-d");
		$start_timestamp = strtotime($date);
		$end_timestamp = strtotime($date);
		$user_id = $user[0]['user_id'];
		$customer_id = $user[0]['customer_id'];

		$invoice_his_item = array('invoice_id'=>$invoice_id,
								  'total_price'=>$total_price,
								  'start_timestamp'=>$start_timestamp,
								  'end_timestamp'=>$end_timestamp,
								  'user_id'=>$user_id,
								  'customer_id'=>$customer_id,
								  'status'=>'2');
		$insert = $this->db->insert('invoice_history',$invoice_his_item);
		return $insert;
	}

	public function getUniqueId()
	{
        $this->load->helper('string');
		$invoice_id = random_string('numeric',5);
		return $invoice_id;
	}

	public function updateDeviceInfotbl_with_customer_id($user)
	{
		$curr_invoice_id = $this->session->userdata('invoice_id');
		$this->db->where('deviceinfo.telephone_no',$user[0]['telephone_no']);
		$this->db->where('deviceinfo.invoice_id',$curr_invoice_id);
		$this->db->set('deviceinfo.customer_id',$user[0]['customer_id']);
		$this->db->update('deviceinfo');
		// $this->db->update('deviceinfo',$items);
	}

	public function getInvoiceItem()
	{
		$curr_invoice_id = $this->session->userdata('invoice_id');
		$this->db->select('invoice_history.*');
	  	$this->db->from('invoice_history');
	    $this->db->where('invoice_id', $curr_invoice_id);
	  	$q = $this->db->get();
	  	return $q->result_array();
	}
 
}//end of class