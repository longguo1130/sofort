<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	    $this->load->model('Delivery_model', 'dm');
   }
   
   //this method display profile page
    //this method displays the login page
   public function index()
   {   
     
	   $data['title'] = 'Delivery';
	   $data['main']  = 'public/delivery_page';
     $data['delivery_options'] = null;
     $this->load->view('templates/template_home', $data); 	 
      
   }

   public function choose_delivery()
   {
     
     if(isset($_POST['deliveryinfosubmit'])){
       if(isset($_POST['delivery_options']) ){
          if($this->add_delivery()){
            redirect('Home','index');
          }
       }
     } else {
      
       $data['title'] = 'Delivery';
       $data['main']  = 'public/delivery_option_page';
       $data['delivery_options'] = null;
       $this->load->view('templates/template_home', $data); 
     }
   }

   function add_delivery() {
      
      $invoice_id = $this->session->userdata('invoice_id');
      $pickup_type = $_POST['delivery_options'];
      $pickup_address_type = '';
      $pickup_address = '';
      $pickup_date = 0;

      if ($pickup_type == "postal") {
          
          if (isset($_POST['same_address_opt'])) {
            $current_user = $this->session->userdata('curr_user');
            $pickup_address = $current_user[0]['address'];
            $pickup_address_type = 1;
          } else {
            $pickup_date = 0;            
            $pickup_address = '';
            $pickup_address_type = 0;
          }
          
      } else if ($pickup_type == "delivery"){
              
          if (isset($_POST['same_address_opt'])) {
            $current_user = $this->session->userdata('curr_user');
            $pickup_address = $current_user[0]['address'];
            $pickup_address_type = 1;
          } else {
            $pickup_address = '';
            $pickup_address_type = 0;
          }

          $d = DateTime::createFromFormat('m/d/Y', $_POST['pickup_date']);
          $pickup_date = $d->getTimeStamp();
      }


      if($this->dm->add_delivery($invoice_id,$pickup_type,$pickup_address_type,$pickup_address,$pickup_date) === TRUE) {
         return TRUE;
      }
      
      return FALSE;

   }

}//end of class