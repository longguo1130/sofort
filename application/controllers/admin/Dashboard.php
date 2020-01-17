<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	
   }
   
   
   
   //this is the index page
   public function index()
   {
     $ses_id = (int)$this->session->userdata('user_id');
     if(empty($ses_id)){
     
       $warning = "You Must Be Logedin To Post An Ads";
       $this->session->set_flashdata('login', $warning);	
       redirect('Auth/login_ads');	  
      }

	 $data['title'] = 'Admin Dashboard';
	 $data['main']  = 'public/dashboard_admin';
	 $data['categories'] = $this->Product_model->get_categories();
	 $this->load->view('templates/template_admin', $data);
     
   }
   
   
   //this method adds category
   public function add_category()
   {
   
     if(isset($_POST['category_name']) && isset($_POST['category_desc'])){
		 
		 
		     $query = $this->Product_model->add_category();
			 if($query){
				 
				   echo 'added';
				 }else{
					 
					   echo 'error';
					 }
		 
		 }
   
   }
   
   
   
   
   //this method displays all products
   public function product()
   {
	 $ses_id = (int)$this->session->userdata('user_id');
	 if(empty($ses_id)){
	 
	   $warning = "You Must Be Logedin To Post An Ads";
	   $this->session->set_flashdata('login', $warning);	
	   redirect('Auth/login_ads');	  
	  } 
	 $data['title'] = 'Admin | Product Page';
	 $data['main']  = 'public/products';
	 $data['all_product'] = $this->Product_model->admin_get_all_products();
	 $this->load->view('templates/template_admin', $data);   
	   
   }
   
   //this method deletes product 
   public function delete_product()
   {
	   $product_id = (int)$this->uri->segment(4);
	   //dump($product_id);
	    
	   $query = $this->Product_model->delete_product($product_id);
	   if($query){
		    
		  redirect('admin/Dashboard/product');
		   
	   } else {
			     
		  echo 'error';
			  
	   }	 
	   
   }

   public function edit_product()
   {
   		$product_id = (int)$this->uri->segment(4);
   }
   
   
  
   
   //this method displays users for admin
   public function users()
   {
     
	 $data['title'] = 'Admin | Users Page';
	 $data['main']  = 'public/users';
	 $data['all_users'] = $this->Product_model->admin_get_all_users();
	 $this->load->view('templates/template_admin', $data); 
   
   }
  
    //this method deletes users for admin
   public function delete_user()
   {
   
      $user_id = $this->uri->segment(4);
	  //dump($user_id);
	  
	  $query = $this->Product_model->delete_user($user_id);
	  if($query){
		   
		   redirect('admin/Dashboard/users');  
		  
		}else{
			
			  echo 'error'; 
			}
	
   } 
   
   
   
   //this method gets product details for admin
   public function get_unique_product_admin()
   {
   
       if(isset($_POST['product_id'])){
		   
		   $product_id = $_POST['product_id']; 
		   
		   $query = $this->Product_model->get_product_detail($product_id);
		   if($query){
			   
			      echo json_encode($query);
			   
			   } else{
				   
				     echo 'error';
				   }
		   
		   
		 }
   }
   
   
   
   
   
   
   
   
}//end of class