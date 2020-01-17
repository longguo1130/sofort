<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_delivery extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
      $this->load->model('manage_delivery_model', 'mdm');
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
       
   	$data['title'] = 'Admin | Manage Delivery Page';
      // $data['main']  = 'public/option_page';
      $data['main']  = 'public/manage_delivery_page';
      
      $data['facility_users'] = $this->Auth_model->getUserByRole(4);
      $data['driver_users'] = $this->Auth_model->getUserByRole(5);

      $this->load->view('templates/template_admin', $data);	
   }

   function get_deliveries() {
      
      $deliveries = $this->mdm->get_deliveries();
      echo json_encode($deliveries);
   }
   
   function delete_delivery() {
      $id = isset($_POST['invoice_id']) ? $_POST['invoice_id'] : NULL;
      if($this->mdm->delete_delivery($id) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function update_delivery() {
      

      if($this->mdm->update_delivery() === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function add_delivery() {
      
      $category_title = $_POST['category_title'];
      $category_desc = $_POST['category_desc'];

      if($this->mdm->add_delivery($category_title,$category_desc) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
}//end of class