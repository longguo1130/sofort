<?php

defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
* Description of Datatable_Model
*
* @author https://www.roytuts.com
*/

class Option_model extends CI_Model {
	
	private $repairs = 'repairs';

	function get_options($product_id) {		


		//columns
		$columns = array(
            'repair_id',
            'repair_or_service',
            'sub_type',
            'repair_title',
            'repair_summary',
            'repair_price',
        	'price_down');
		
		//index column
		$indexColumn = 'repair_id';
		
		//total records
		$sqlCount = 'SELECT COUNT(' . $indexColumn . ') AS row_count FROM ' . $this->repairs . " where product_id = '" . $product_id . "'";
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
			$where .= " where product_id = '" . $product_id . "'"; 
		} else {
			$where .= " AND product_id = '" . $product_id . "'" ;
		}
		//final records
		$sql = 'SELECT SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM ' . $this->repairs . $where . $order . $limit;
        
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
		
		//put into 'data' array
		foreach ($result->result_array() as $cols) {
            $row = array();
            foreach ($columns as $col) {
                $row[] = $cols[$col];
            }

            switch ($row[1]) {
            	case '1':
            		$row[1] = '<button type=\'button\' class=\'btn btn-sm btn-success\'>Repair</button>';
            		break;
            	case '2':
            		$row[1] = '<button type=\'button\' class=\'btn btn-sm btn-primary\'>Service</button>';
            		break;
            }
            
			array_push($row, '<button type=\'button\' class=\'edit btn btn-sm btn-outline-danger\'>Edit</button>&nbsp;&nbsp;<button type=\'button\' class=\'delete btn btn-sm btn-outline-danger\' repair_id='. $cols[$indexColumn] .'>Delete</button>');
            $output['data'][] = $row;
        }
		// var_dump($output);
		// exit();
		return $output;
	}
	
	function delete_option($id) {
		$sql = 'DELETE FROM ' . $this->repairs . ' WHERE repair_id=' . $id;
		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function update_option($repair_id, $repair_or_service, $sub_type, $repair_title, $repair_summary, $repair_price, $price_down) {
		$data = array(
					'repair_id' => $repair_id,
					'repair_or_service' => $repair_or_service,
					'sub_type' => $sub_type,
					'repair_title' => $repair_title,
					'repair_summary' => $repair_summary,
					'repair_price' => $repair_price,
					'price_down' => $price_down,
				);
		
		$this->db->where('repair_id', $repair_id);
		$this->db->update($this->repairs, $data);
		
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