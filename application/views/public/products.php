      <div class="col-md-10">
        
        <div class="panel panel-primary ww-panel-primary">
          
          <div class="panel-heading">
            <h3 class="panel-title">All Items</h3>
          </div>
          
          <div class="panel-body">
            
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                     
                      <th>No</th>
                      <th>Name</th>
                      <th>Cost</th>
                      <th>Category</th>
                      
                      <th>Details</th>
                      <th>Remove</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  
                  <?php if($all_product): ?>
                  <?php 
                        $pos = 0; 
                        foreach($all_product as $product):
                          $pos += 1;
                  ?>
                    <tr>
                      
                      <td><?php echo $pos; ?></td>
                      <td><?php echo $product['product_title']; ?></td>
                      <td><?php echo $product['product_price']; ?></td>
                      <td><?php echo $product['category_title'] ;?></td>
                      
                      <td><img src="<?php echo base_url().'/'. $product['image_url']; ?>" class="product_admin"></td>
                      <td>
                        <a href="<?php echo base_url(); ?>admin/dashboard/delete_product/<?php echo $product['product_id'];?>"  class="btn btn-danger">Delete</a>
                        <a href="<?php echo base_url(); ?>admin/dashboard/edit_product/<?php echo $product['product_id'];?>"  class="btn btn-danger">Edit</a>
                      </td>                      
                      
                    </tr>
                   <?php endforeach; ?> 
                   <?php endif;?> 
                 
                  </tbody>
                </table>
            </div><!-- end table -->
            
          </div>

        </div>
        
        <!-- modal -->
        <!-- Small modal -->
  
        <div class="modal fade" id="display_product" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="row">
                  <br>
                  <div class="col-md-12">
                     
                       
                       <div class="text-center" id="image-modal" ></div>
             
                  </div>
                  <br><br>
                  
                </div>
            </div>
          </div>
        </div>
            
            <!-- modal -->
            
            
        </div>
      </div>
    </div>