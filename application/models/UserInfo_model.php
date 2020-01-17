<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserInfo_model extends CI_Model { 

   public function register()
   {
   
        $name = $_POST['name'];
        $companyname = $_POST['companyname'];
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $postcode = $_POST['postcode'];
        $place = $_POST['place'];
        $country = $_POST['country'];
        $email = $_POST['email'];
        $confirmemail = $_POST['confirmemail'];
        $tel = $_POST['tel'];
        $customer_id = $this->getUniqueId();

        $useritem_register = array(
	          'name' => $name,
	          'company_name'  => $companyname,
	          'first_name'  => $firstname,
	          'surname'  => $surname,
	          'address'  => $address,
	          'postcode'  => $postcode,
	          'place'  => $place,
	          'country'  => $country,
	          'reg_no'  => '',
	          'email'  => $email,
	          'telephone_no'  => $tel,
	          'password'  => '',
	          'user_level'  => 6,
	          'customer_id' => $customer_id
        );

        $isExist = $this->getUser($name,$tel,$email);

		if(count($isExist) > 0){
			return false;
		} else {
	    	$insert = $this->db->insert('users', $useritem_register);
	    	// set customer_id to session for delivery			     
	    	// $this->session->set_userdata('customer_id',$customer_id);
        	return $insert;
		}	
   }
  
   public function getUser($name,$tel_no,$email)
   {

       $this->db->select('users.*');
       $this->db->from('users');
	   $this->db->or_where('name',$tel_no);
	   $this->db->or_where('telephone_no',$tel_no);
	   $this->db->or_where('email',$email);
	   // $this->db->where('name',$name);
	   $this->db->limit(1);
	   $q = $this->db->get();
	   return $q->result_array();
   }

   //this method register the user
   public function getUniqueId()
   {
       $this->load->helper('string');
       $unique_id = random_string('numeric',5);
   	   return $unique_id;
   }

   //this method login a user
   public function login($email,$password)
   {  
    //hashing password
		$pass_clean = sha1($password);
	  
	    $this->db->select('users.*');
		$this->db->where('email',$email);
		$this->db->where('password', $pass_clean);
		$this->db->limit(1);
		
		$q = $this->db->get('users');
		if($q->num_rows()>0){
			   
	       $row = $q->row();
		   
		   $user_data = array(
		   
		        'user_id' => (int)$row->user_id,
				'email'   => $row->email,
				'name'   => $row->name,
				'reg_no' => $row->reg_no,
				'password' => $row->password,
				'user_level' => (int)$row->user_level,
				'loggedin'  => true
			
		   );
		   
		   $this->session->set_userdata($user_data);
	        return true;
	   
	    } else {
		      
			  return false;
		   
	    }
   }

}