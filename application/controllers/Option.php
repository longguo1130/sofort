<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Option_model', 'dm');
	}
   
   //this method displays the index page
   public function index()
   {   
      $ses_id = (int)$this->session->userdata('user_id');
      if(empty($ses_id)){
      
        $warning = "You Must Be Logedin To Post An Ads";
        $this->session->set_flashdata('login', $warning);   
        redirect('Auth/login_ads');   
       }
       
   	$data['title'] = 'Admin | Option Page';
      // $data['main']  = 'public/option_page';
      $data['main']  = 'public/option';
      $options = array();
      $categories = $this->Product_model->get_categories();
      foreach ($categories as $val) {
         $products = $this->Product_model->get_featured_product($val['category_title']);
         $options[$val['category_id']] = $products;
      }
      $data['categories'] = $categories;
      $data['options'] = $options;
      $this->load->view('templates/template_admin', $data);	
   }

   function get_options() {
      $product_id = $this->uri->segment(3);
      $options = $this->dm->get_options($product_id);
      echo json_encode($options);
   }
   
   function delete_option() {
      $id = isset($_POST['repair_id']) ? $_POST['repair_id'] : NULL;
      if($this->dm->delete_option($id) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function update_option() {
      $repair_id = $_POST['repair_id'];
      $repair_or_service = $_POST['repair_or_service'];
      $sub_type = $_POST['sub_type'];
      $repair_title = $_POST['repair_title'];
      $repair_summary = $_POST['repair_summary'];
      $repair_price = $_POST['repair_price'];
      $price_down = $_POST['price_down'];

      if($this->dm->update_option($repair_id, $repair_or_service, $sub_type, $repair_title, $repair_summary, $repair_price, $price_down) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function add_option() {
      $category_id = $_POST['category_id'];
      $category_title = $_POST['category_title'];
      $product_id = $_POST['product_id'];
      $product_title = $_POST['product_title'];
      $repair_or_service = $_POST['repair_or_service'];
      $sub_type = $_POST['sub_type'];
      $repair_title = $_POST['repair_title'];
      $repair_summary = $_POST['repair_summary'];
      $repair_price = $_POST['repair_price'];
      $price_down = $_POST['price_down'];

      if($this->dm->add_option($repair_id,$category_id,$category_title,$product_id,$product_title,$repair_or_service, $sub_type, $repair_title, $repair_summary, $repair_price, $price_down) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
}//end of class