<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserInfo extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
	
   }
   
   //this method display profile page
    //this method displays the login page
   public function index()
   {   
     if(isset($_POST['user_info_submit']))
     {
        // ------I have to check user who exists in site---------
        $name = $_POST['name'];
        $email = $_POST['email'];
        $confirm_email = $_POST['confirmemail'];
        $tel = $_POST['tel'];
        // ------I have to check invoice document that is created correctly in site---------
        if($email != $confirm_email){
           $error = "Confirm Email is not correct!";
           $this->session->set_flashdata('reguserinfo', $error);
           $data['title'] = 'User Info';
           $data['main']  = 'public/auth';
           $data['invoice_created'] = 'fail';
           $this->load->view('templates/template_home', $data);
           return;
        } 
        
        $query = $this->UserInfo_model->register();

        if($query){
                           
           $user = $this->Auth_model->getUser($name,$tel,$email);
           $this->register_orderinfo($user,'new_user');
           
        } else {

           $error = "This User exists or Sign Up failed!. Please try again!";
           $this->session->set_flashdata('reguserinfo', $error);
           $data['title'] = 'User Info';
           $data['main']  = 'public/auth';
           $data['invoice_created'] = 'fail';
           $data['user_options'] = null;
           $data['tel_no'] = $this->session->userdata('telephone_no');
           $this->load->view('templates/template_home', $data);
        }
     } else {
           $data['title'] = 'User Info';
           $data['main']  = 'public/auth';
           $data['invoice_created'] = 'fail';
           $data['user_options'] = null;
           $data['tel_no'] = $this->session->userdata('telephone_no');
           $this->load->view('templates/template_home', $data);               
     }       

   }

   public function register()
   {

      
   }

   public function update()
   {
      if(isset($_POST['sel_userinfo_submit'])){
         if(isset($_POST['checked_user_id'])){

            $user_id = $_POST['checked_user_id'];
            $checked_user = $this->Auth_model->getUserById($user_id);
            $tel_no = $this->session->userdata('telephone_no');

            if(isset($tel_no) && isset($checked_user)){
               if($tel_no != $checked_user[0]['telephone_no']){
                  $msg = "Selected User is not you! Please choose correctly!";
                  $this->session->set_flashdata('userchecked_error', $msg);
                  $data['title'] = 'User Info';
                  $data['main']  = 'public/auth';
                  $data['invoice_created'] = 'fail';
                  $data['user_options'] = 'existing_user';
                  $this->load->view('templates/template_home', $data);
               } else if($tel_no == $checked_user[0]['telephone_no']){

                  $this->register_orderinfo($checked_user,'existing_user');
               }
            }
         }
      } else {
         $data['title'] = 'User Info';
         $data['main']  = 'public/auth';
         $data['invoice_created'] = 'fail';
         $data['user_options'] = existing_user;
         $this->load->view('templates/template_home', $data);
      }
   }

   public function search(){
        
      if(!empty($_POST['term'])){
        
         //dump($this->input->post('term'));
         $term = trim($this->input->post('term'));
          
         if($term){
                
               $data['search_result'] = $this->Auth_model->searchUser($term);
               // $data['count'] = $this->Product_model->search_count($term);
               
               //dump($data['search_result']);
               
         } else {
                  redirect('Home', 'refresh');
            
         }
          
         $data['title'] = 'Search Query';
         $data['main']  = 'public/auth';
         $data['invoice_created'] = 'fail';
         $data['user_options'] = 'existing_user';
         $data['tel_no'] = $this->session->userdata('telephone_no');
         $this->load->view('templates/template_home', $data);
           
      } else {
         $data['title'] = 'User Info';
         $data['main']  = 'public/auth';
         $data['invoice_created'] = 'fail';
         $data['user_options'] = existing_user;
         $this->load->view('templates/template_home', $data);
      }
             
   }

   public function register_orderinfo($current_user,$user_opt){

      $total_price =  $this->session->userdata('total_price');

      // set customer_id to session for delivery              
      
      $this->session->set_userdata('curr_user',$current_user);
      // var_dump($total_price);
      // var_dump($current_user);
      // exit();
      $this->Invoice_model->addInvoiceInfo($total_price,$current_user);
      
      //send data to client
      // $array = $this->Invoice_model->getRepairIdArray($current_user);
      // $repair_array = $this->Invoice_model->getRepairLst($tel,$array);

      // update deviceinfo table with invoice_id

      $this->Invoice_model->updateDeviceInfotbl_with_customer_id($current_user);

      // insert history to invoice_history table        
      // $invoice_item = $this->Invoice_model->getInvoiceItem();

      $data['title'] = 'Invoice Document';
      $data['main']  = 'public/auth';
      $data['invoice_created'] = 'success';
      if ($user_opt == 'new_user') {
         $data['user_options'] = null;
      } else if($user_opt == 'existing_user'){
         $data['user_options'] = 'existing_user';
      }
      // $data['invoice_item'] = $invoice_item;
      // $data['repair_infos'] = $repair_array;

      $msg = "Sign Up success! Please see your invoice.";
      $this->session->set_flashdata('reguserinfo_success', $msg);

      $this->load->view('templates/template_home', $data);
   }
   
   //this method deletes a product 
   public function delete()
   {
	   
     
   } 

}//end of class