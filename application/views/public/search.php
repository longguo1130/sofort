<!-- search form area -->
    <section id="search">
       <div class="container">
          <div class="row">
            <div class="searh">  
               
                <div class="col-md-3"></div>
                 <div class="col-md-6">
                    <form action="<?php echo base_url();?>home/search" method="post">
                     
                      
                      <div class="input-group">
                          <input type="text" name="term" class="form-control input-lg" placeholder="Search Product E.g Shirt, Bag, Shoe ....">
                          <span class="input-group-btn">
                            <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-search"></i></button>
                          </span>
                       </div><!-- /input-group -->
                 </div>
                 
                 <div class="col-md-3">
                  
                 </div>
              </div>
            </div>
       </div>  
    </section>
      <!--/ search job form -->
      
      
       <br>
      
      <!-- listing area -->
      
        <section class="popular-products">
           <div class="container">
             <div class="row">
                 
                 <h3 class="trend">Search Result</h3>
                 
                <!-- listed products -->
                     
                     
                     <div class="panel panel-default">
                      <div class="panel-body">
                        
                        
                        
                        <?php if($search_result):?>
                        <?php foreach($search_result as $product):?>
                         <div class="col-md-3">
                  
                   
                       
                         <a href="<?php echo base_url();?>home/product/<?php echo $product['product_id'].'/'.url_title($product['product_title']);?>"> <img src="<?php echo base_url().'/'.$product['image_url']?>" class="product"></a>
                        
                         <div class="pro_title">
                           <h4><?php echo $product['product_title']; ?></h4>
                           <h4>₦<?php echo $product['product_price']; ?></h4>
                         </div>     
                        
                       <hr>
                   
                 </div>    
                   <?php endforeach;?>
                  <?php else:?>
                  
                  <h1>No Result Found!!!</h1>
                  
                  <?php endif;?>
              
                 
                 
                 
                     
                     
                     
                

                <!-- listed products -->    
               
                     
                     
                     
                     
             </div> 
           </div>
        </section>
      
      <!-- listing area -->
      
        