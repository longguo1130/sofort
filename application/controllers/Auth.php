<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	
   }
   
   
   //this method displays the login page
   public function index()
   {   
      
      
	  $data['title'] = 'Login Page';
	  // $data['main']  = 'public/auth';
	  $data['main']  = 'public/login';
	  
	  $this->load->view('templates/template_auth', $data); 	 
      
   }
   
   //this method login the user
   public function login()
   {
       
       if(isset($_POST['mysubmit'])){
		   
		     if(isset($_POST['email']) && isset($_POST['password'])){
				   
				   //make the login query
				   $email = $_POST['email'];
				   $password = $_POST['password'];
				   
				   $query = $this->Auth_model->login($email, $password);
				   if($query){
					   
					     // $post_page = base_url()."post";
					    
					   
					   
					     //redirect user
						 $success = "You are now Loged In";
						 $this->session->set_flashdata('login', $success);
						 
                          redirect('Home');
					   
					   }else{
						   
						     $error = "Invalid Email and Password";
						     $this->session->set_flashdata('login', $error);
						     $data['title'] = 'Login Page';
	                         $data['main']  = 'public/login';
	                         $this->load->view('templates/template_auth', $data); 
							  
						   }
				 
				 }
		   
		 }else{
			 
			   $data['title'] = 'Login Page';
	           $data['main']  = 'public/login';
	  
	           $this->load->view('templates/template_auth', $data); 
			 
			 }
   }
   
   
   
    //this method displays the register page
   public function register()
   {

      if(isset($_POST['mysubmit'])){
		  
		   //process the input
		   if(isset($_POST['name']) && isset($_POST['reg_no'])&& isset($_POST['email']) && isset($_POST['password'])){
			   	 
				 $query = $this->Auth_model->register();
				 if($query){
					  
				   // collecting the user  email input
					$user_email    = $this->input->post('email');
					
					//creating the users unique uploads directory
					$path1 = 'uploads/'.$user_email.'/Profile/';
					$path2 = 'uploads/'.$user_email."/ads/";
					
					  
					  //using the php mkdir for creating the the directories
				    if(!is_dir($path1) && !is_dir($path2)){
						mkdir($path1,  0777, true);
						mkdir($path2, 0777, true);
					}
					 
					 $success = "You can now login";
					 $this->session->set_flashdata('register', $success);
					 redirect('admin/Dashboard/users');
					 
				  }else{
					     
						$error = "Error occured, Pls try again later";
					    $this->session->set_flashdata('register', $error); 
						$data['title'] = 'Register Page';
						$data['main']  = 'public/register';
						$this->load->view('templates/template_admin', $data); 
					  
					  }
			 } else {
				 
				    echo "error";
			}
		  
      } else {
			  $data['title'] = 'Register Page';
			  $data['main']  = 'public/register';
			  $this->load->view('templates/template_admin', $data); 
	  }	 
      
   }
   
   
   
    //this method login the user
   public function login_ads()
   {
       
	    
	   
       if(isset($_POST['mysubmit'])){
		   
		     if(isset($_POST['email']) && isset($_POST['password'])){
				   
				   //make the login query
				   $email = $_POST['email'];
				   $password = $_POST['password'];
				   
				   $query = $this->Auth_model->login($email, $password);
				   if($query){
					   
					     
					    
					   
					   
					     //redirect user
						 $success = "You are now Loged In";
						 $this->session->set_flashdata('login', $success);
						 
                         redirect('Post');
					   
					   }else{
						   
						     $error = "Invalid Email and Password";
						     $this->session->set_flashdata('login', $error);
						     $data['title'] = 'Login Page';
	                         $data['main']  = 'public/login_ads';
	                         $this->load->view('templates/template_auth', $data); 
							  
						   }
				 
				 }
		   
		 }else{
			 
			   $data['title'] = 'Login Page';
	           $data['main']  = 'public/login_ads';
	  
	           $this->load->view('templates/template_auth', $data); 
			 
			 }
   }
   
   
   
   //this method logsout a user
   public function logout()
   {
      
	  $this->Auth_model->logout();
	  redirect('Home');
	  
   }
   
   
   
   
   
     //this method displays the home page fro admkn
   public function admin_login()
   {
     
	   $data['title'] = 'Admin Login';
	   $data['main']  = 'public/admin_login';
	   $this->load->view('templates/template_home', $data);
   
   }
   
   
   
   
   
   
   
   
   
   
   
   
}//end class