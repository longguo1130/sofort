<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model { 

   //this method register the user
   public function register()
   {
   
        $name      = $_POST['name'];
		$reg_no    = $_POST['reg_no'];
		$email     = $_POST['email'];
		$password = sha1($_POST['password']);
		
		$data_register = array(
		
		   'name'     => $name,
		   'reg_no'   => $reg_no,
		   'email'    => $email,
		   'password' => $password,
		
		);
				
				
	    $insert = $this->db->insert('users', $data_register);			     
        return $insert;
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
  
  
  
public function logout()
{

	$data = array( 'user_id','email' , 'name', 'password', 'user_level', 'loggedin');
	$logout = $this->session->unset_userdata($data);
	return $logout;

}

public function getUser($name,$tel_no,$email)
{

    $this->db->select('users.*');
    $this->db->from('users');
	$this->db->where('telephone_no',$tel_no);
	$this->db->where('email',$email);
	$this->db->where('name',$name);
	$this->db->limit(1);
    $q = $this->db->get();
	return $q->result_array();
	// return $q;
}

public function getUserById($user_id)
{
    $this->db->select('users.*');
    $this->db->from('users');
	$this->db->where('user_id',$user_id);
    $q = $this->db->get();
	return $q->result_array();
}

public function getUserByRole($user_role)
{
    $this->db->select('users.*');
    $this->db->from('users');
	$this->db->where('user_level',$user_role);
    $q = $this->db->get();
	return $q->result_array();
}

public function searchUser($search)
{

    $this->db->select('users.*');
    $this->db->from('users');
	$this->db->or_where('telephone_no',$search);
	$this->db->or_where('email',$search);
	$this->db->or_like('name',$search);
	$q = $this->db->get();
	return $q->result_array();
	// return $q;

}


public function isExistUser($name,$tel_no,$email)
{
    $this->db->select('users.*');
    $this->db->from('users');
	$this->db->where('telephone_no',$tel_no);
	$this->db->or_where('email',$email);
	$this->db->or_where('name',$name);
    
	$q = $this->db->get();
	if ($q) {
		return true;
	} else {
		return false;
	}
}


}//end class