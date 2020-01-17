<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Order_model', 'om');
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
      $data['main']  = 'public/order_page';

      $this->load->view('templates/template_admin', $data);	
   }

   function get_options() {

     $url = parse_url($_SERVER['REQUEST_URI']);
       if(isset($url['query'])){
         
         parse_str($url['query'], $params);
         $status = $params['status'];
      }
      $options = $this->om->get_invoice_histories($status);
      // $options = $this->om->get_invoice_histories();
      
      echo json_encode($options);
   }
   
   function delete_option() {
      $id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : NULL;
      if($this->om->delete_option($id) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function update_option() {
      $invoice_id = $_POST['invoice_id'];
      $status = $_POST['status'];
      $end_timestamp = $_POST['end_timestamp'];

      $d = DateTime::createFromFormat('m/d/Y', $end_timestamp);
      
      if($this->om->update_option($invoice_id, $status, $d->getTimestamp()) === TRUE) {
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