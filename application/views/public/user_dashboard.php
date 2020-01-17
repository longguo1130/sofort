<div class="col-md-10"> 
  <section id="user_area">
    <div class="container">
        <div class="row">
          <br>
          <div class="col-md-2"></div> 
          
            <div class="col-md-8">
             
              <div class="user_account_area text-center">
               
               <div class="panel panel-default">
                
                <div class="panel-heading">
                  <h3 class="panel-title text-primary">User Profile</h3>
                </div>

                <div class="panel-body">
                   
                    <div id="user_img">
                       <img src="<?php echo base_url(); ?>assets/img/avatar.gif" class="pro_img"/>
                    </div>
                    
                    <div id="name_of_user">
                       <p><?php echo $this->session->userdata('name');?></p>
                       <p><?php echo $this->session->userdata('email'); ?></p>
                    </div>
                    
                    <hr>
                    
                    <div class="users_product">
                       <h3>Your Product</h3>
                       <?php if($all_users_product): ?>
                        <table class="table table-striped table-bordered">
                          <tr>
                            <th>Product name</th>
                            <th>Cost</th>
                            <th>Category</th>
                            
                            <th>Delete</th>
                          </tr>
                           <?php foreach($all_users_product as $p): ?>
                          <tr>
                            <td><?php echo $p->product_title; ?></td>
                            <td><?php echo $p->product_price; ?></td>
                            <td><?php echo get_cat_name($p->category_id); ?></td>
                           
                            <td><a href="<?php echo base_url(); ?>user/delete/<?php echo $p->product_id; ?>" class="btn btn-danger"><i class="fa fa-remove"></i></a></td>
                          <tr>    
                          <?php endforeach;?>
                        </table>
                       <?php else:?>
                         
                        <div class="alert alert-danger" role="alert">You Have not Posted any product yet</div>
                       
                       <?php endif; ?>
                    </div>
                   
                </div>

              </div>
             
            </div>  
          
          </div>
          
          <div class="col-md-2"></div>
          
        </div>
    </div>  
  </section>
</div>
 
 
 
 
 
 
 
        
 
 
 