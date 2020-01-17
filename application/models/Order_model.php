<?php

defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
* Description of Datatable_Model
*
* @author https://www.roytuts.com
*/

class Order_model extends CI_Model {
	
	private $invoice = 'invoice_history';
	private $users = 'users';

	function get_invoice_histories($status) {	

		//columns
		$columns = array(
			'first_name',
            'surname',
            'email',
            'telephone_no',
            'invoice_id',
            'total_price',
            'status',
        	'start_timestamp',
        	'end_timestamp');
		
		//index column
		$indexColumn = 'invoice_id';
		
		//total records
		$sqlCount = 'SELECT COUNT(' . $indexColumn . ') AS row_count FROM ' . $this->users . " RIGHT JOIN invoice_history ON  users.user_id = invoice_history.user_id";
		$totalRecords = $this->db->query($sqlCount)->row()->row_count;

		//pagination
		$limit = '';
		$displayStart = $this->input->get_post('start', true);
		$displayLength = $this->input->get_post('length', true);
		
		if (isset($displayStart) && $displayLength != '-1') {
            $limit = ' LIMIT ' . intval($displayStart) . ', ' . intval($displayLength);
        }
		
		$uri_string = $_SERVER['QUERY_STRING'];
        $uri_string = preg_replace("/%5B/", '[', $uri_string);
        $uri_string = preg_replace("/%5D/", ']', $uri_string);

        $get_param_array = explode('&', $uri_string);
        $arr = array();
        foreach ($get_param_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            $arr[$explode[0]] = $explode[1];
        }
		
		$index_of_columns = strpos($uri_string, 'columns', 1);
        $index_of_start = strpos($uri_string, 'start');
        $uri_columns = substr($uri_string, 7, ($index_of_start - $index_of_columns - 1));
        $columns_array = explode('&', $uri_columns);
        $arr_columns = array();
		
		foreach ($columns_array as $value) {
            $v = $value;
            $explode = explode('=', $v);
            if (count($explode) == 2) {
                $arr_columns[$explode[0]] = $explode[1];
            } else {
                $arr_columns[$explode[0]] = '';
            }
        }
		
		//sort order
		$order = ' ORDER BY ';
        $orderIndex = $arr['order[0][column]'];
        $orderDir = $arr['order[0][dir]'];
        $bSortable_ = $arr_columns['columns[' . $orderIndex . '][orderable]'];
        if ($bSortable_ == 'true') {
            $order .= $columns[$orderIndex] . ($orderDir === 'asc' ? ' asc' : ' desc');
        }
		
		//filter
		$where = '';
        $searchVal = $arr['search[value]'];
        if (isset($searchVal) && $searchVal != '') {
            $where = " WHERE (";
            for ($i = 0; $i < count($columns); $i++) {
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($searchVal) . "%' OR ";
            }
            $where = substr_replace($where, "", -3);
            $where .= ')';
        }
		
		//individual column filtering
        $searchReg = $arr['search[regex]'];
        for ($i = 0; $i < count($columns); $i++) {
            $searchable = $arr['columns[' . $i . '][searchable]'];
            if (isset($searchable) && $searchable == 'true' && $searchReg != 'false') {
                $search_val = $arr['columns[' . $i . '][search][value]'];
                if ($where == '') {
                    $where = ' WHERE ';
                } else {
                    $where .= ' AND ';
                }
                $where .= $columns[$i] . " LIKE '%" . $this->db->escape_like_str($search_val) . "%' ";
            }
        }

        if(empty($where)){
        	if($status != 0){
        		$where .= " where invoice_history.status = '" . $status . "'"; 
        	}
        } else {
        	if($status != 0){
        		$where .= " AND invoice_history.status = '" . $status . "'" ;
        	}
        }
		
		//final records
		$sql = 'SELECT SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM ' . $this->users ." RIGHT JOIN invoice_history ON users.user_id = invoice_history.user_id". $where . $order . $limit;
        
        $result = $this->db->query($sql);
		
		//total rows
		$sql = "SELECT FOUND_ROWS() AS length_count";
        $totalFilteredRows = $this->db->query($sql)->row()->length_count;
		
		//display structure
		$echo = $this->input->get_post('draw', true);
        $output = array(
            "draw" => intval($echo),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFilteredRows,
            "data" => array()
        );
		
		// $detail_orders = array();
		//put into 'data' array
		foreach ($result->result_array() as $cols) {
            $row = array();
            $detail_orders = array();
            foreach ($columns as $col) {
                $row[] = $cols[$col];
            }

            
			switch ($row[6]) {
				case '1':
					$row[6] = '<button type=\'button\' class=\'btn btn-sm btn-success\'>Completed</button>';
					break;
				case '2':
					$row[6] = '<button type=\'button\' class=\'btn btn-sm btn-primary\'>InProgress</button>';
					break;
				case '3':
					$row[6] = '<button type=\'button\' class=\'btn btn-sm btn-danger\'>Cancel</button>';
					break;
			}
			
			$row[7] = date('m/d/Y', $row[7]);
			$row[8] = date('m/d/Y', $row[8]);
            
	        $sql = 'SELECT category_title,product_title,repair_or_service,repair_title,repair_summary,repair_price,extra_error,price_down FROM deviceinfo LEFT JOIN repairs ON deviceinfo.repair_id = repairs.repair_id WHERE deviceinfo.invoice_id = "' .$row[4] .'"';

	        // $detail_orders['$row[4]'] = $this->db->query($sql)->result_array();
	        $detail_orders = $this->db->query($sql)->result_array();
	        
			array_push($row, '<div style=\'display:flex;\'>
				<button type=\'button\' class=\'edit btn btn-sm btn-outline-danger\' invoice_id=\''. $cols[$indexColumn] .'\'>Edit</button>&nbsp;&nbsp;
				<button type=\'button\' class=\'delete btn btn-sm btn-outline-danger\' invoice_id=\''. $cols[$indexColumn] .'\'>Delete</button></div>');
			array_push($row, '<input type=\'hidden\' id=\''. $row[4]. '\' val=\''. json_encode($detail_orders). '\'/>');

			// var_dump(json_encode($detail_orders));
			$y = array(' ');
			$y = array_merge($y, $row);
            $output['data'][] = $y;
        }
        // $output['detail_orders'] = $detail_orders;
		return $output;
	}
	
	function delete_option($id) {
		$sql = 'DELETE FROM ' . $this->invoice . ' WHERE invoice_id=' . $id;
		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function update_option($invoice_id, $status, $end_timestamp) {
		$data = array(
					'invoice_id' => $invoice_id,
					'status' => $status,
					'end_timestamp' => $end_timestamp
				);
		// var_dump($data);
		// exit();
		$this->db->where('invoice_id', $invoice_id);
		$this->db->update($this->invoice, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function add_option($repair_id, $category_id,$category_title,$product_id,$product_title,$repair_or_service, $sub_type, $repair_title, $repair_summary, $repair_price, $price_down) {
		$data = array(
						// 'repair_id' => $repair_id,
						'category_id' => $category_id,
						'category_title' => $category_title,
						'product_id' => $product_id,
						'product_title' => $product_title,
						'repair_or_service' => $repair_or_service,
						'sub_type' => $sub_type,
						'repair_title' => $repair_title,
						'repair_summary' => $repair_summary,
						'repair_price' => $repair_price,
						'price_down' => $price_down,
					 );
		
		$this->db->insert($this->repairs, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	
}

/* End of file Datatable_Model.php */
/* Location: ./application/models/Datatable_Model.php */