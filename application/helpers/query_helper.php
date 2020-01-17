<?php


	//this method helps in geting male contestants 
	function get_male_con($id)
	{
	   
	   //geting CI instance
	   $CI =& get_instance();
	   
	   //loading the database 
	   $CI->load->database();
	   
	   //making the query for comment count
	   $CI->db->select('contestants.*');
	   $CI->db->where('contestants.category_id', $id);
	   $CI->db->where('contestants_gender', 'Male');
	   
	   $q = $CI->db->get('contestants');
	   
	   return $q->result_array();
	 
	}
	
   //this method helps in geting female contestants 
	function get_female_con($id)
	{
	   
	   //geting CI instance
	   $CI =& get_instance();
	   
	   //loading the database 
	   $CI->load->database();
	   
	   //making the query for comment count
	   $CI->db->select('contestants.*');
	   $CI->db->where('contestants.category_id', $id);
	   $CI->db->where('contestants_gender', 'Female');
	   
	   $q = $CI->db->get('contestants');
	   
	   
	   return $q->result_array();
	 
	}
	
	//this method helps in geting female contestants 
	function get_con($id)
	{
	   
	   //geting CI instance
	   $CI =& get_instance();
	   
	   //loading the database 
	   $CI->load->database();
	   
	   //making the query for comment count
	   $CI->db->select('contestants.*');
	   $CI->db->where('contestants.category_id', $id);
	   
	   $q = $CI->db->get('contestants');
	   
	   
	   return $q->result_array();
	 
	}
	
	 
	//this helper gets the number of product for a user 
	function number_product($user_id){
		
		//geting CI instance
	   $CI =& get_instance();
	   
	   //loading the database 
	   $CI->load->database();
	   
	   $CI->db->where('products.user_id', $user_id);
	   $q = $CI->db->get('products');
	   return $q->num_rows();
		
    }
	
	
	//this method converts a grade point into alphabets like A,B,C,D
	function convert_to_alpha($grade_point)
	{
       $alpha = '';
	   
	   if($grade_point === 5)
	   {
		  $alpha = 'A';   
	   }elseif($grade_point === 4)
	   {
		 $alpha = 'B';
	   }elseif($grade_point === 3)
	   {
	      $alpha = 'C';
	   }elseif($grade_point === 2)
	   {
		   $alpha = 'D';
	   }else{
		   
		     $alpha = 'F';
		   }
		   
	   return $alpha;	   
	}
	
	

	//this method converts a number to two decimal place
	function to_2d_place($num)
	{
	
	
	 return number_format((float)$num, 2, '.', '');
	
	}
	
	
	//this method checks if a students has a transcript
	function check_trans($student_id, $level_id, $details)
	{  
	   //geting CI instance
	   $CI =& get_instance();
	   
	   //loading the database 
	   $CI->load->database();
	   
	   $CI->db->select('tcredit_and_tpoint.*');
	   $CI->db->where('tcredit_and_tpoint.student_id', $student_id);
	   $CI->db->where('tcredit_and_tpoint.level_id', $level_id);
	   
	   $q = $CI->db->get('tcredit_and_tpoint');
	   if($q->num_rows()>0){
		      
			 // return "transcript available";
			  
			  return '<a href="'. base_url().'lecturer/dashboard/prev_transcipt/'. $details['student_id'].'/'.$level_id.'" class="btn btn-success">Available</a>';
			  
		   }else{
			   
			      //return "No transcript";
				  return '<button  class="btn btn-danger" disabled="disabled">Not Available</button>';
				  
			   }
	 
	}
	
	
	
		//this method checks if a students has a transcript
	function get_cat_name($cat_id)
	{  
	   //geting CI instance
	   $CI =& get_instance();
	   
	   //loading the database 
	   $CI->load->database();
	   
	   $CI->db->where('category_id', $cat_id);
	   $CI->db->limit(1);
	   
	   $q = $CI->db->get('categories');
	   $row = $q->row();
	   return $row->category_title;
	   
	   
	     
	}
	
	
	
	
	/*this function checks if level year a is occupied
	function check_year_vailable($level_id, $student_id)
	{
	 
	 //geting CI instance
	  $CI =& get_instance(); 
	  
     //get remaining free year 
	 $CI->db->select('student_course.*, levels.*, student.student_id');
	 $CI->db-from('student_course');
	 $CI->db->join('level', 'levels.level_id=student_course.level_id');
	 $CI->db->join('student', 'student.student_id=student_course.student_id');
	 $CI->db->where('student.student_id', $student_id);
	 $CI->db->where('levels.level_id', $level_id);
	 
	 $q = $CI->db->get('student_course');
	 if($q->num_rows()>0){
		    
		      //call  the dropdown function
			  //$CI->available_dropdown($q->result_array());
			  
			  $result_level_id = $q->result_array();
			   $option = '';
	     
	  	  foreach($result_level_id as $level_id){
			   
	       	     
			  $option .= '<option value="'.$level_id['level_id'].'">'.$level_id['level_title'].'</option>';
			  
		  }
		  
		  echo $option;
		 
		 }else{
			   
			    // error from 
				echo 'error';
			 
			 }
	 
	}
	
	
	//this function display the available level  dropdown
	function available_dropdown($result_level_id)
	{    
	     $option = '';
	     
	  	foreach($result_level_id as $level_id){
			   
	       	  $option .= '<option value="'.$level_id['level_id'].'">';
			  $option .=  $level_id['level_title'];
			  $option .=  '</option>';	   
			  
		  }
		  
		  return $option;
    } 
	
	
	*/
	
	
	  //this method converts an integer into hundred
  function convert_to_hundred($int)
  {
	    $int_plus_00 = $int .'00';
	    return $int_plus_00;
  }
  
	
  
  
	
	