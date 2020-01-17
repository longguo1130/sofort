<?php

defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
* Description of Datatable_Model
*
* @author https://www.roytuts.com
*/

class Delivery_model extends CI_Model {
	
	private $delivery = 'delivery';
	private $users = 'users';

	function delete_category($id) {
		$sql = 'DELETE FROM ' . $this->categories . ' WHERE category_id=' . $id;
		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}

	function update_category($category_id, $category_title, $category_desc) {
		$data = array(
					'category_id' => $category_id,
					'category_title' => $category_title,
					'category_desc' => $category_desc
				);
		
		$this->db->where('category_id', $category_id);
		$this->db->update($this->categories, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function add_delivery($invoice_id,$pickup_type,$pickup_address_type, $pickup_address,$pickup_date) {
		
		$data = array(
						// 'repair_id' => $repair_id,
						'invoice_id' => $invoice_id,
						'pickup_type' => $pickup_type,
						'pickup_address_type' => $pickup_address_type,
						'pickup_address' => $pickup_address,
						'pickup_date' => $pickup_date,
					 );
		// var_dump($pickup_date);
		// exit();
		$this->db->insert($this->delivery, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	
}

/* End of file Datatable_Model.php */
/* Location: ./application/models/Datatable_Model.php */