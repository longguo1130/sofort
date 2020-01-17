        <div class=" col-md-10">
        

          <div class="panel panel-primary ww-panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">All Users</h3>
              </div>
              <div class="panel-body">
                
                
                 <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php if($all_users): ?>
              <?php foreach($all_users as $users):?>
                <tr>
                  <td><?php echo $users['user_id'] ?></td>
                  <td><?php echo $users['name'] ?></td>
                  <td><?php echo $users['email'] ?></td>
                 
                  <td><a href="<?php echo base_url(); ?>admin/dashboard/delete_user/<?php echo $users['user_id'];?>"  class="btn btn-danger">Delete</a></td>
                </tr>
               <?php endforeach; ?> 
               <?php endif;?> 
             
              
        
              </tbody>
            </table>
          </div><!-- end table -->
            
                
              </div>
            </div>       
   
          
         
            
            
         
            
            
        </div>
      </div>
    </div>