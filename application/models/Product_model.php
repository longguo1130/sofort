<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model { 


  
  
  //this method get all categories
  public function get_categories()
  {
     
	 $q = $this->db->get('categories');
	 return $q->result_array();
	 
  }
  
  
  //this method gets all locations for add posting
  public function get_locations()
  {
  
     $q = $this->db->get('locations');
	 return $q->result_array();
  }

  //this method inserts the uploaded file into the database
	public function upload_ads($url, $user_id)
	{
		$this->db->where('category_id',$this->session->userdata('category_id'));
		$q = $this->db->get('products');
		$location_id = count($q->result_array()) > 0 ? count($q->result_array()) + 1 : 1;
			
		$data_upload = array(
		'product_title' => $this->session->userdata('product_title'),
		'product_desc'  => $this->session->userdata('product_desc'),
		'product_price' => $this->session->userdata('price'),
		'image_url'     => $url,
		'location_id'   => $location_id,
		'category_id'   => $this->session->userdata('category_id'),
		'user_id'       => $user_id,
		
		);
		
		
		$insert = $this->db->insert('products', $data_upload);
		return true;
	}
	
	
	
	//this method gets featured product
	public function get_featured_product($category_title)
	{
	  $this->db->select('products.*, categories.*');
	  $this->db->from('products');
	  $this->db->join('categories', 'categories.category_id=products.category_id');
	  $this->db->where('category_title',$category_title);
	  $this->db->order_by('products.location_id', 'asc');
	  $q = $this->db->get();
	  return $q->result_array();
	}

	//this method gets a product by its id
	public function get_unique_product($product_id)
	{
        $this->db->select('users.*, products.*');
	    $this->db->from('products');
		$this->db->join('users', 'users.user_id=products.user_id');
	    $this->db->where('product_id',$product_id);
		$this->db->limit(1);
		$q = $this->db->get();
		return $q->result_array();
	
	}

	public function get_repair_options($product_id,$type)
	{

		$this->db->from('repairs');
		$this->db->where('product_id',$product_id);
		
		if(isset($type))
		{
			if($type == 1) {
				$this->db->where('repair_or_service',$type);
			} else if($type == 2) {
				$this->db->where('repair_or_service',$type);			
			}
		}
		$q = $this->db->get();
		// return $q->result_array();
		return $q->result_array();
	}
   
   //this function gets rando products for product page
   public function get_random_product($category_id, $product_id)
   {
      
	  $this->db->where('category_id', $category_id);
	  $this->db->where('product_id !=', $product_id);
	  $this->db->order_by('rand()'); 
	  $this->db->limit(3);
	  
	  $q = $this->db->get('products');
	  return $q->result_array();
   
   }
   
   
 
  
  
   /**
    * product search function 
	*@param string
	*/
  	public function search($term){
		   
		   
		   $this->db->select('products.*');
		   $this->db->like('product_title', $term);
		   $this->db->or_like('product_desc', $term);
		   $this->db->order_by('product_title', 'asc');
		   $this->db->limit(50);
		   
		   $q = $this->db->get('products');
		      
			  if($q->num_rows()>0){
				    
				   
					return $q->result_array();	
					
				  
				 }    
		
		}
  
     
	/**
	 * this method retrive the amount of item found in a search query
	 *
	 */
     public function search_count($term){
	      
	     
		   
		   $this->db->select('products.*');
		   $this->db->like('product_title', $term);
		   $this->db->or_like('product_desc', $term);
		   $this->db->order_by('product_title', 'asc');
		   $this->db->limit(50);
		   
		   $q = $this->db->get('products');
	        
			if($q->num_rows()>0){
				
				  return $q->num_rows();
				  
				}else{
					
					  return false;
					}
	          }
			  
			  



  //this method adds category
  public function add_category()
  {
	  
	  $cat_name = $this->input->post('category_name');
	  $cat_desc = $this->input->post('category_desc');
	  
	  $data_cat = array(
	  
	  
	     'category_title' => $cat_name,
		 'category_desc'  => $cat_desc,
	  
	  
	  );
	  
	  
	  $insert = $this->db->insert('categories', $data_cat);
	  return $insert;
	  
	
  }

  public function addDevInfo($devinfo)
  {
  	  $insert = $this->db->insert('deviceinfo', $devinfo);
  	  return $insert;
  }
  
  
  //this method gets products for admin
  public function admin_get_all_products()
  {
	
	 $this->db->select('products.*, categories.*');
	 $this->db->from('products');
	 $this->db->join('categories', 'categories.category_id=products.category_id');
	 $this->db->order_by('product_id', 'asc');
	 $q = $this->db->get();
	 return $q->result_array();  
	  
  }



   //this method deletes products from the database
   public function delete_product($product_id)
   {
       $this->db->where('product_id', $product_id);
	   $delete = $this->db->delete('products');
	   return $delete;
   
   }



   //this method gets all product  for admin
   public function admin_get_all_users()
   {
   
      $q = $this->db->get('users');
	  return $q->result_array();
   
   }




   //this method deletes a user for admin
   public function delete_user($user_id)
   {
   
      $this->db->where('user_id', $user_id);
	  $delete = $this->db->delete('users');
	  return $delete;
   
   }
   
   
   //this method gets product details
   public function get_product_detail($product_id)
   {
	   $this->db->where('product_id', $product_id);
	   $this->db->limit(1);
	   
	   $q = $this->db->get('products');
	   return $q->row();   
   }
  
 
  
    //this method gets all user product for a user dahboard
	public function get_all_user_prodcuct($user_id)
    {
	 
	   $this->db->where('user_id', $user_id);
	   $q = $this->db->get('products');
	   return $q->result(); 
	 
	}
  
  
  
  
  
  
  
  
  
  
  



}//end of class