<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

   
   public function __construct()
   {
      parent::__construct();
      $this->load->model('Category_model', 'cm');
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
       
   	$data['title'] = 'Admin | Category Page';
      // $data['main']  = 'public/option_page';
      $data['main']  = 'public/category_page';
      
      // $data['categories'] = get_categories();
      
      $this->load->view('templates/template_admin', $data);	
   }

   function get_categories() {
      
      $categories = $this->cm->get_categories();
      echo json_encode($categories);
   }
   
   function delete_category() {
      $id = isset($_POST['category_id']) ? $_POST['category_id'] : NULL;
      if($this->cm->delete_category($id) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function update_category() {
      $category_id = $_POST['category_id'];
      $category_title = $_POST['category_title'];
      $category_desc = $_POST['category_desc'];

      if($this->cm->update_category($category_id, $category_title, $category_desc) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
   function add_category() {
      
      $category_title = $_POST['category_title'];
      $category_desc = $_POST['category_desc'];

      if($this->cm->add_category($category_title,$category_desc) === TRUE) {
         return TRUE;
      }
      
      return FALSE;
   }
   
}//end of class