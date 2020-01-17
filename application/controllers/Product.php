<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	
   }
   
   //this method displays All Product
   public function index()
   {
      
	  $data['title'] = 'All Product';
	  $data['main']  = 'public/all_product';
	  $this->load->view('templates/template_home',$data);
   }

   public function product_lookup()
   {
      $category_id = $this->uri->segment(3);
      $product_id = $this->uri->segment(4);
      var_dump($category_id);
      var_dump($product_id);
      // $data['title'] = 'Buk - Market';
      // $data['main']  = 'public/home';
      // $data['featured_products'] = $this->Product_model->get_featured_product($category_id);
      // $html = $this->load->view('public/home',$data);      
   }

   public function get_subcategories()
   {
      $category_title = $this->uri->segment(3);
      $data = $this->Product_model->get_featured_product($category_title);   
      echo json_encode($data);
   }

   public function get_products_by_brand()
   {
      $category_id = $this->uri->segment(3);
      $data['title'] = 'Buk - Market';
      $data['main']  = 'public/home';
      $data['featured_products'] = $this->Product_model->get_featured_product($category_id);
      // $html = $this->load->view('public/home',$data);
      echo json_encode($data);
   }

   //thid method displays a unique product
   public function get_one_product()
   {
      $category_title = $this->uri->segment(3);
      $product_id = $this->uri->segment(4);
      //dump($product_id);
      
      $data['product_details'] = $this->Product_model->get_unique_product($product_id);
      $data['sub_categories'] = $this->Product_model->get_featured_product($category_title);
      $data['repair_options'] = $this->Product_model->get_repair_options($product_id,1);
      $data['service_options'] = $this->Product_model->get_repair_options($product_id,2);
      echo json_encode($data);        
   }
   
   
}//end of class