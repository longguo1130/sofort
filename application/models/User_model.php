<?php

defined('BASEPATH') OR exit('No direct script access allowed');
	
/**
* Description of Datatable_Model
*
* @author https://www.roytuts.com
*/

class User_model extends CI_Model {
	
	private $users = 'users';

	function get_users() {		
		//columns
		$columns = array(
            'user_id',
            'name',
            'first_name',
        	'surname',
    		// 'company_name',
			'address',
			'postcode',
			'place',
			'country',
			// 'reg_no',
			'email',
			'telephone_no',
			// 'password',
			'user_level'
			// ,'customer_id'
		);
		
		//index column
		$indexColumn = 'user_id';
		
		//total records
		$sqlCount = 'SELECT COUNT(' . $indexColumn . ') AS row_count FROM ' . $this->users;
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
		
		//final records
		$sql = 'SELECT SQL_CALC_FOUND_ROWS ' . str_replace(' , ', ' ', implode(', ', $columns)) . ' FROM ' . $this->users . $where . $order . $limit;
        
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

            switch ($row[10]) {
            	case '1':
            		$row[10] = '<button type=\'button\' class=\'btn btn-sm btn-danger\'>Admin User</button>';
            		break;
            	case '2':
            		$row[10] = '<button type=\'button\' class=\'btn btn-sm btn-primary\'>Business User</button>';
            		break;
            	case '3':
            		$row[10] = '<button type=\'button\' class=\'btn btn-sm btn-secondary\'>Partner User</button>';
            		break;
            	case '4':
            		$row[10] = '<button type=\'button\' class=\'btn btn-sm btn-success\'>Facility User</button>';
            		break;
            	case '5':
            		$row[10] = '<button type=\'button\' class=\'btn btn-sm btn-warning\'>Driver User</button>';
            		break;
            	case '6':
            		$row[10] = '<button type=\'button\' class=\'btn btn-sm btn-info\'>Normal User</button>';
            		break;
            }
            
			array_push($row, '<button type=\'button\' class=\'edit btn btn-sm btn-outline-danger\'>Edit</button>&nbsp;&nbsp;<button type=\'button\' class=\'delete btn btn-sm btn-outline-danger\' user_id='. $cols[$indexColumn] .'>Delete</button>');
            $output['data'][] = $row;
        }
		// var_dump($output);
		// exit();
		return $output;
	}
	
	function delete_user($id) {
		$sql = 'DELETE FROM ' . $this->users . ' WHERE user_id=' . $id;
		$this->db->query($sql);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}

	function update_user($user_id, $name, $first_name,$surname, $company_name, $address,$postcode, $place, $country,/*$reg_no,*/ $email, $telephone_no,/*$password,*/ $user_level/*, $customer_id*/) {
		$data = array(
					'user_id'=>$user_id,
		            'name'=>$name,
		            'first_name'=>$first_name,
		        	'surname'=>$surname,
		    		'company_name'=>$company_name,
					'address'=>$address,
					'postcode'=>$postcode,
					'place'=>$place,
					'country'=>$country,
					// 'reg_no',
					'email'=>$email,
					'telephone_no'=>$telephone_no,
					// 'password',
					'user_level'=>$user_level
					// ,'customer_id'
				);
		
		$this->db->where('user_id', $user_id);
		$this->db->update($this->users, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function add_user($name, $first_name,$surname, $company_name, $address,$postcode, $place, $country,/*$reg_no,*/ $email, $telephone_no,$password, $user_level/*, $customer_id*/) {
		$data = array(
					'name'=>$name,
		            'first_name'=>$first_name,
		        	'surname'=>$surname,
		    		'company_name'=>$company_name,
					'address'=>$address,
					'postcode'=>$postcode,
					'place'=>$place,
					'country'=>$country,
					// 'reg_no',
					'email'=>$email,
					'telephone_no'=>$telephone_no,
					'password'=>$password,
					'user_level'=>$user_level
					// ,'customer_id'
				);
		// var_dump($data);
		// exit();
		$this->db->insert($this->users, $data);
		
		if ($this->db->affected_rows()) {
			return TRUE;
		}
		
		return FALSE;
	}

	public function getUserByRole($user_role)
	{
	    $this->db->select('users.*');
	    $this->db->from('users');
		$this->db->where('user_level',$user_role);
	    $q = $this->db->get();
		return $q->result_array();
	}
	
}

/* End of file Datatable_Model.php */
/* Location: ./application/models/Datatable_Model.php */