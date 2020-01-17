<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	
   }
   
   
   //this method displays the index page
   public function index()
   {   

       // foreach (array_keys($this->session->userdata) as $key) { $this->session->unset_userdata($key); }

       $this->session->unset_userdata('category_title');
       $this->session->unset_userdata('product_id');
       $this->session->unset_userdata('repair_options');
       $this->session->unset_userdata('service_options');
       $this->session->unset_userdata('invoice_created');

        $url = parse_url($_SERVER['REQUEST_URI']);
	    if(isset($url['query'])){
			
			parse_str($url['query'], $params);
			$step = $params['step'];
			$product_id = $params['product_id'];
		}

	    if (isset($step) && isset($product_id)) {
	    	if($step == '2'){
	    		
	    		$device_model = '';
	    		$total_price = 0;
	    		$sel_opts = array();

			   	if(isset($_POST['repair_options_submit']))
			   	{
			   		
			   		$result = $this->Product_model->get_unique_product($product_id);
			   		if(isset($result)){
			   			$device_model = $result[0]['product_title'];
			   		}
			   		$repair_options = $this->Product_model->get_repair_options($product_id,1);

			   		for ($i=0; $i < count($repair_options); $i++) { 
			   			# code...
			   			$ritem = $repair_options[$i];
			   			$selector = 'repair_id'.'_'.$ritem['repair_id'];
			   			if(isset($_POST[$selector]))
			   			{
			   				$item_new = (array)$ritem;
			   				$item_new['selected'] = '1';
			   				$ritem = $item_new;
			   				$repair_options[$i] = $ritem;
			   				$total_price += $ritem['repair_price'];
			   				array_push($sel_opts, $ritem);
			   			} else {
			   				$item_new = (array)$ritem;
			   				$item_new['selected'] = '0';
			   				$ritem = $item_new;
			   				$repair_options[$i] = $ritem;
			   			}
			   		}
			   			
			   		// var_dump($repair_options);
			   		$this->session->set_userdata('repair_options',$repair_options);

			   		$service_options = $this->Product_model->get_repair_options($product_id,2);
			   		for ( $i = 0; $i < count($service_options); $i++) { 
			   			# code...
			   			$sitem = $service_options[$i];
			   			$selector = 'repair_id'.'_'.$sitem['repair_id'];
			   			# code...
			   			if(isset($_POST[$selector]))
			   			{
			   				$item_new = (array)$sitem;
			   				$item_new['selected'] = '1';
			   				$sitem = $item_new;
			   				$service_options[$i] = $sitem;
			   				$total_price += $sitem['repair_price'];
			   				array_push($sel_opts, $sitem);
			   			} else {
			   				$item_new = (array)$sitem;
			   				$item_new['selected'] = '0';
			   				$sitem = $item_new;
			   				$service_options[$i] = $sitem;
			   			}
			   		}

			   		// $this->session->set_userdata('service_options',$service_options);
				    $this->session->set_userdata('sel_opts',$sel_opts);
				    $this->session->set_userdata('total_price',$total_price - 5);
				    $this->session->set_userdata('device_model',$device_model);
				    
			        // $user_data = $this->session->all_userdata();
			        // $data['title'] = 'Buk - Market';
				    // $data['main']  = 'public/deviceinfo_page';
				    // $data['device_model'] = $device_model;
				    // $data['total_price'] = $total_price - 5;
				    // $data['selected_options'] = $sel_opts;

				    redirect('DeviceInfo','index');

			   		// $this->load->view('templates/template_home', $data);

			   		$_POST['repair_options_submit'] = null;
	    	    }
	    	 }
	    } else {
	    	# code...
	       $data['title'] = 'Buk - Market';
		   $data['main']  = 'public/home';
		   // $data['featured_products'] = $this->Product_model->get_featured_product(1);
		   $data['featured_products'] = $this->Product_model->admin_get_all_products();
		   $this->load->view('templates/template_home', $data);  
	    }

   }
   
   
   
   //thid method displays a unique product
   public function product()
   {
   		$category_title = $this->uri->segment(2);
   		
   		$url = parse_url($_SERVER['REQUEST_URI']);
   		if(isset($url['query'])){

	   		parse_str($url['query'], $params);
	   		$product_id = $params['product_id'];
   		}
   		

   		if (isset($product_id)) {
   			# code...
		   $old_category_title = $this->session->userdata('category_title');
		   $old_product_id = $this->session->userdata('product_id');
		   if(isset($old_category_title) && isset($old_product_id)){
		   		if($category_title != $old_category_title){
		   			$this->session->unset_userdata('category_title');
		   			$this->session->set_userdata('category_title',$category_title);
		   		}
		   		if($product_id != $old_product_id){
			   		$this->session->unset_userdata('product_id');
			   		$this->session->set_userdata('product_id',$product_id);
			   		$this->session->unset_userdata('repair_options');
			   		$this->session->unset_userdata('service_options');

		   		}
		   } else {
		   		$this->session->set_userdata('category_title',$category_title);
		   		$this->session->set_userdata('product_id',$product_id);
		   }

		   $data['sel_model_id'] = $product_id;   
		   $data['categories'] = $this->Product_model->get_categories();   
		   $data['sub_categories'] = $this->Product_model->get_featured_product($category_title);		
		   
		   $data['product_details'] = $this->Product_model->get_unique_product($product_id);
		   $data['sel_category_id'] = $data['product_details'][0]['category_id'];   

		   $sel_repair_options = $this->session->userdata('repair_options');

		   if(isset($sel_repair_options)){
		   	
		   	$data['repair_options'] = $sel_repair_options;
		   } else {
		   	$data['repair_options'] = $this->Product_model->get_repair_options($product_id,1);
		   	// $this->session->set_userdata('repair_options',$data['repair_options']);
		   }

		   $sel_service_options = $this->session->userdata('service_options');

		   if(isset($sel_service_options)){
		   	$data['service_options'] = $sel_service_options;
		   } else {
		   	$data['service_options'] = $this->Product_model->get_repair_options($product_id,2);
		   	// $this->session->set_userdata('service_options',$data['service_options']);
		   }
		   
		   $data['title'] = 'Arewa Mart |'. $data['product_details'][0]['product_title'];
		   $data['main']  = 'public/product_page';
		   $this->load->view('templates/template_home', $data);
   		} else {
   			# code...
   			$data['title'] = 'Buk - Market';
   			$data['main']  = 'public/home';
   			$data['featured_products'] = $this->Product_model->get_featured_product($category_title);
   			$this->load->view('templates/template_home', $data);
   		}
   		
   }

   public function product_lookup()
   {

       $category_title = $this->uri->segment(2);
       $product_id = $this->uri->segment(3);
         
	   $old_category_title = $this->session->userdata('category_title');
	   $old_product_id = $this->session->userdata('product_id');
	   if(isset($old_category_title) && isset($old_product_id)){
	   		if($category_title != $old_category_title){
	   			$this->session->unset_userdata('category_title');
	   			$this->session->set_userdata('category_title',$category_title);
	   		}
	   		if($product_id != $old_product_id){
		   		$this->session->unset_userdata('product_id');
		   		$this->session->set_userdata('product_id',$product_id);
		   		$this->session->unset_userdata('repair_options');
		   		$this->session->unset_userdata('service_options');

	   		}
	   } else {
	   		$this->session->set_userdata('category_title',$category_title);
	   		$this->session->set_userdata('product_id',$product_id);
	   }
       
       if (isset($product_id)) {
  	   		# code...
  	   		

	  	   	$data['sel_model_id'] = $product_id;   
	  	   	$data['categories'] = $this->Product_model->get_categories();   
	  	   	$data['sub_categories'] = $this->Product_model->get_featured_product($category_title);		
	  	   	
	  	   	$data['product_details'] = $this->Product_model->get_unique_product($product_id);
	  	   	$data['sel_category_id'] = $data['product_details'][0]['category_id'];   

	  	   	$sel_repair_options = $this->session->userdata('repair_options');

	  	   	if(isset($sel_repair_options)){
	  	   		
	  	   		$data['repair_options'] = $sel_repair_options;
	  	   	} else {
	  	   		$data['repair_options'] = $this->Product_model->get_repair_options($product_id,1);
	  	   		// $this->session->set_userdata('repair_options',$data['repair_options']);
	  	   	}

	  	   	$sel_service_options = $this->session->userdata('service_options');

	  	   	if(isset($sel_service_options)){
	  	   		$data['service_options'] = $sel_service_options;
	  	   	} else {
	  	   		$data['service_options'] = $this->Product_model->get_repair_options($product_id,2);
	  	   		// $this->session->set_userdata('service_options',$data['service_options']);
	  	   	}
	  	   	
	  	   	$data['title'] = 'Arewa Mart |'. $data['product_details'][0]['product_title'];
	  	   	$data['main']  = 'public/product_page';
	  	   	$this->load->view('templates/template_home', $data);

  	   } else {
  	   	# code...
  	   		$data['title'] = 'Buk - Market';
  	   		$data['main']  = 'public/home';
  	   		$data['featured_products'] = $this->Product_model->get_featured_product($category_title);
  	   		$this->load->view('templates/template_home', $data);
  	   }
   }
   
   //search method
   public function search(){
	  if(!empty($_POST['term'])){
		  
		//dump($this->input->post('term'));
		 $term = trim($this->input->post('term'));
		 
		 if($term){
			    
			   $data['search_result'] = $this->Product_model->search($term);
			   $data['count'] = $this->Product_model->search_count($term);
			   
			   //dump($data['search_result']);
			   
			 }else{
				   redirect('Home', 'refresh');
		   
			 }
			    $data['search_term'] = $term;
			    $data['title'] = 'Search Query';
			    $data['main']  = 'public/search';
				$this->load->view('templates/template_home', $data);
		  
		  
		  }else{
			  
			     redirect("Home");
			  
			  }
			    
   }
   
   
   
}//end of class