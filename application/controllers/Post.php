<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	
   }
   
   //this method displays step 2 of post and ads
   public function index()
   { 
   
       
	 $ses_id = (int)$this->session->userdata('user_id');
	 if(empty($ses_id)){
		
	   $warning = "You Must Be Logedin To Post An Ads";
	   $this->session->set_flashdata('login', $warning);	
	   redirect('Auth/login_ads');	  
	  }
       
	    if(isset($_POST['mysubmit'])){
			 if(isset($_POST['product_title']) && isset($_POST['product_desc']) && isset($_POST['price']) && isset($_POST['category'])){
				 
				     $product_title = $_POST['product_title'];
					 $product_desc  = $_POST['product_desc'];
					 $price         = $_POST['price'];
					 $category_id   = $_POST['category'];
					 
					 
					 $data_details = array(
					   
					   'product_title' => $product_title,
					   'product_desc'  => $product_desc,
					   'price'         => $price,
					   'category_id'   => (int)$category_id,
					   'mine' => 'yes',
					 
					 );
					 
					 $this->session->set_userdata($data_details);
					 redirect('Post/upload_photo');
					
				 
				 }
		    
		   
		} else {
			 
			  $data['title'] = 'Post Page';
	          $data['main']  = 'public/post';
			  $data['categories'] = $this->Product_model->get_categories();
			  $this->load->view('templates/template_admin', $data);
			 
		}
   
   }
   	   
	//this method displays step 2 of post and ads
	public function upload_photo()
	{
	   	$step_1_data = $this->session->all_userdata();
	   	//dump($step_1_data);
	   
	     //authentication checks
	  	$ses_id = (int)$this->session->userdata('user_id');
		if(empty($ses_id)){
			
		   $warning = "You Must Be Logedin To Post An Ads";
		   $this->session->set_flashdata('login', $warning);	
		   redirect('Auth');	  
		}
				
		 
		if(isset($_FILES['file']['name']))
		{	
		  
		   $user_email = $this->session->userdata('email');
		  
		  //updating the required config fields for the Ad upload to take place
		  $config['upload_path'] = 'uploads/'.$user_email.'/ads/';
		  $config['allowed_types'] = 'jpeg|jpg|png';
		  $config['max_size']	= '0';
		  $config['max_width']  = '0';
		  $config['max_height']  = '0';
		  $config['overwrite']  = false;
		  $config['remove_spaces']  = true;
		  $config['encrypt_name']  = true;
		  
		  $this->upload->initialize($config);
		  
		   if(!$this->upload->do_upload('file')){
		   
		     echo $this->upload->display_errors();
			
		     
		   }else{
			     $data = $this->upload->data();
				 $url = 'uploads/'.$user_email.'/ads/'.$data['file_name'];
				 $user_id = $this->session->userdata('user_id');
				 
			     if($query = $this->Product_model->upload_ads($url, $user_id)){
			
							 //$msg = 'Post Succesfuly Added';
							 // $this->session->set_flashdata('message', $msg);
							  echo 'Ads Published Successfuly';	
						 
						}else{
							
							   //error occured
							   echo "error";
							
							}
				 
				
			   }
			
		}else{
			
			  $data['title'] = 'Step 2';
	          $data['main']  = 'public/step_2';
			 
	          $this->load->view('templates/template_admin', $data);
			
			}
	}
}//end class