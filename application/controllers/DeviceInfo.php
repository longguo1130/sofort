<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeviceInfo extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
      $this->CI =& get_instance();
      $this->load->library('session');
	}
   
   //this method displays the index page
   public function index()
   {   
   		if(isset($_GET['devinfosubmit'])){
			 if(isset($_GET['imei_no']) && isset($_GET['cell_provider']) && isset($_GET['telephone_no']) && isset($_GET['extra_error'])){
				 
				 	 $this->session->unset_userdata('invoice_id');

				     $imei_no = $_GET['imei_no'];
					 $cell_provider  = $_GET['cell_provider'];
					 $telephone_no  = $_GET['telephone_no'];
					 $extra_error   = $_GET['extra_error'];
					 $sel_opts = $_GET['selected_options'];
					 $invoice_id = $this->getUniqueId();
					 $total_price = 0;

					 foreach ($sel_opts as $key => $value) {
			 	 	    $data_dev = array(
			 	 	      'imei_no' => $imei_no,
			 	 		  'cell_provider'  => $cell_provider,
			 	 		  'telephone_no'  => $telephone_no,
			 	 		  'extra_error'  => $extra_error,
			 	 		  'start_timestamp'  => '',
			 	 		  'end_timestamp'  => '',
			 	 		  'repair_id'  => $value,
			 	 		  'invoice_id'  => $invoice_id,
			 	 	    );
			 	 	    
                        $this->Product_model->addDevInfo($data_dev);
				 	 	
				 	 }
				 	 
				 	 $this->session->set_userdata('invoice_id',$invoice_id);
				 	 $this->session->set_userdata('telephone_no',$telephone_no);
		 	 	    
				 	 redirect('UserInfo','index');
				 }
		} else {

			 $data['title'] = 'DeviceInfo Register';
			 $data['main']  = 'public/deviceinfo_page';
			 $data['device_model'] = $this->session->userdata('device_model');
			 $data['selected_options'] = $this->session->userdata('sel_opts');
			 $data['total_price'] = $this->session->userdata('total_price');
			 $this->load->view('templates/template_home', $data);
		} 
   }
   
   public function getUniqueId()
   {
        $this->load->helper('string');
   		$invoice_id = random_string('numeric',5);
   		return $invoice_id;
   }

   //thid method displays a unique product
   public function product()
   {
       $product_id = $this->uri->segment(3);
	   
	   $data['product_details'] = $this->Product_model->get_unique_product($product_id);
	   $data['categories'] = $this->Product_model->get_categories();   
	   
	   $data['title'] = 'Arewa Mart |'. $data['product_details']->product_title;
	   $data['main']  = 'public/product_page';
	   $this->load->view('templates/template_home', $data);
   }
   
   public function products_group()
   {
   		$category_id = $this->uri->segment(3);
   		$data['title'] = 'Buk - Market';
	    $data['main']  = 'public/home';
	    $data['featured_products'] = $this->Product_model->get_featured_product($category_id);
	    $this->load->view('templates/template_home', $data); 
   }
   
   //search method
   public function search(){
	  if(!empty($_POST['term'])){
		  
		$term = trim($this->input->post('term'));
		 
        if($term){
			    
		   $data['search_result'] = $this->Product_model->search($term);
		   $data['count'] = $this->Product_model->search_count($term);
			   
		} else {
		   redirect('Home', 'refresh');
		}

	    $data['search_term'] = $term;
	    $data['title'] = 'Search Query';
	    $data['main']  = 'public/search';
		$this->load->view('templates/template_home', $data);
		  
	  } else {
		redirect("Home");
	  }
			    
   }
   
   
   
}//end of class