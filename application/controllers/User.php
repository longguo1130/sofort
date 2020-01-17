<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
   
   public function __construct()
   {
      parent::__construct();
      $this->load->model('User_model', 'um');
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
       
      $data['title'] = 'Admin | User Page';
      // $data['main']  = 'public/option_page';
      $data['main']  = 'public/user_page';
      
      // $data['categories'] = get_users();
      
      $this->load->view('templates/template_admin', $data); 
   }

   function get_users() {
      
      $users = $this->um->get_users();
      echo json_encode($users);
   }
   
   function delete_user() {
      $id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;
      if($this->um->delete_user($id) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function update_user() {

      $user_id = $_POST['user_id'];
      $name = $_POST['name'];
      $first_name = $_POST['first_name'];
      $surname = $_POST['surname'];
      $company_name = $_POST['company_name'];
      $address = $_POST['address'];
      $postcode = $_POST['postcode'];
      $place = $_POST['place'];
      $country = $_POST['country'];
      // $reg_no = $_POST['user_id'];
      $email = $_POST['email'];
      $telephone_no = $_POST['telephone_no'];
      $password = $_POST['password'];
      $user_level = $_POST['user_level'];
      // $customer_id = $_POST['category_desc'];

      if($this->um->update_user($user_id, $name, $first_name,$surname,$company_name,$address,$postcode,$place,$country/*,$reg_no*/,$email,$telephone_no,/*$password,*/$user_level/*,$customer_id*/) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function add_user() {

      $name = $_POST['name'];
      $first_name = $_POST['first_name'];
      $surname = $_POST['surname'];
      $company_name = $_POST['company_name'];
      $address = $_POST['address'];
      $postcode = $_POST['postcode'];
      $place = $_POST['place'];
      $country = $_POST['country'];
      // $reg_no = $_POST['user_id'];
      $email = $_POST['email'];
      $telephone_no = $_POST['telephone_no'];
      $password = $_POST['password'];
      $user_level = $_POST['user_level'];

         //process the input
      if(isset($name) && isset($first_name) && isset($surname) && isset($company_name)
         && isset($address) && isset($postcode) && isset($place) && isset($country)
         && isset($email) && isset($telephone_no) && isset($password) && isset($user_level)){
             
          $query = $this->um->add_user($name, $first_name,$surname, $company_name, $address,$postcode, $place, $country,/*$reg_no,*/ $email, $telephone_no,$password, $user_level/*, $customer_id*/);
          
          if($query){
            
            //creating the users unique uploads directory
            $path1 = 'uploads/'.$email.'/Profile/';
            $path2 = 'uploads/'.$email."/ads/";
             
              //using the php mkdir for creating the the directories
             if(!is_dir($path1) && !is_dir($path2)){
               mkdir($path1,  0777, true);
               mkdir($path2, 0777, true);
            }
             
             return true;
             
           } else {
                 
               return false;
           }
       } else {
          
             echo false;
      }
   }
   
}//end of class