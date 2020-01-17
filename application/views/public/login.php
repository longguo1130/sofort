 <div class="container">
  <br><br>
  
    <div class="col-md-4"></div>
    <div class="col-md-4" style="margin-top: 50px;">
     <div class="panel panel-danger">
        <div class="panel-heading">
          <h3 class="panel-title text-center">Sign In</h3>
        </div>
        <div class="panel-body">
            
            
      <form id="form_login" class="form-group" action="<?php echo base_url();?>auth/login" method="post">
        
         <?php  
		   
    		    $message = $this->session->flashdata('login');
        	  if(!empty($message)){
        		     echo '<div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                               '.$message.'
                                </div>';
    				}			
    		   
    		   
    		   	$register = $this->session->flashdata('register');
    	      if(!empty($register)){
    		  	     echo '<div class="alert alert-info">
                          <button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-warning (alias)"></i>
                           '.$register.'
                            </div>';
    				}	
		
		    ?>
        <div id="feedback_login"></div>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="email" class="form-control" name="email" placeholder="Email address"  autofocus><br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="Password" >
        <br>
        <button class="btn btn-danger btn-block" name="mysubmit" type="submit">Sign in</button><br>
        
        <span style="color:rgb(169, 68, 66);">&nbsp;Admin User,Customer User can only login!</span>
        
      </form>
            
          </div>
        </div>
     
    </div>

     
     <div class="col-md-4"></div>


    </div> <!-- /container -->


 