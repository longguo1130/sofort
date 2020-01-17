

    <div class="container">
        <br><br>
      <div class="col-md-4"></div>
      
      <div class="col-md-4">
          
      <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title text-center">Register Now</h3>
          </div>
          <div class="panel-body">
            
             <form id="form-register" class="" action="<?php echo base_url();?>auth/register" method="post">
        
        <?php  
		   
		   $msg = $this->session->flashdata('register');
		   if(!empty($msg)){
			      
				  echo '<div class="alert alert-danger" role="alert"><i class="fa fa-warning (alias)"></i> '.$msg.'</div>';
			   
			   }
		
		?>
        <div id="feedback_register"></div>
        <label for="inputPassword" class="sr-only">Full Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required>
        <br>
        
        <label for="inputEmail" class="sr-only">Reg No</label>
        <input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="Enter Reg No" required><br>
        
         <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required><br>
       
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        
        <br>
        <button name="mysubmit" class="btn btn-danger btn-block" type="submit">Register</button><br>
        <!-- <a href="<?php echo base_url();?>auth" class=""><span>Login Now</span></a> -->
      </form>

            
          </div>
        </div>
      
      </div>
      
      <div class="col-md-4"></div>
      
     
    </div> <!-- /container -->


 