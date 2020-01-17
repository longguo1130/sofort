<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	
   }
   
   //this method display profile page
    //this method displays the login page
   public function index()
   {   
      
	  $ses_id = (int)$this->session->userdata('user_id');
     if(empty($ses_id)){
     
       $warning = "You Must Be Logedin To Post An Ads";
       $this->session->set_flashdata('login', $warning); 
       redirect('Auth/login_ads');    
      }
      
	  
	  $data['title'] = 'User Dashboard';
	  $data['main']  = 'public/user_dashboard';
	  $data['all_users_product']  = $this->Product_model->get_all_user_prodcuct($ses_id);
	  $this->load->view('templates/template_admin', $data); 	 
      
   }
   
   
   //this method deletes a product 
   public function delete()
   {
	   
      $pro_id = $this->uri->segment(3);
	  
	  $delete = $this->Product_model->delete_product($pro_id);
	  redirect('User');
	  
   
   } 
   
}//end of class