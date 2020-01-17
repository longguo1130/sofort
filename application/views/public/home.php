 
      <!-- searhc bar -->
      <!-- 
        <section id="intro_area">
           <div class="container">
              <div class="row">
                 
                  <div class="col-md-2"></div> -->
                  <!-- sercch bar ---->
                    
                    <!-- <div class="col-md-8"> -->
                    <!-- <form action="<?php echo base_url();?>home/search" method="post" id="">
                      <div id="search-input">
                         <div class="input-group">
                       
                          <input type="text" required class="form-control input-lg" name="term" id="term"  placeholder="Search for items">
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-default input-lg"><i class="fa fa-search"></i> Search</button>
                            </span> 
                    </form> -->
                          
                          
                        <!-- </div> -->
                        <!-- /input-group -->  
                      <!-- </div> -->
                        
                    <!-- </div> -->
                  
                   <!-- <div class="col-md-2"></div> -->
                  
                  <!-- searhc bar -->
                  
                  
                  
                  
                  
               <!-- </div>  -->
           <!-- </div> -->
        <!-- </section>   -->
      
      <!-- searhc bar -->
      
      <!-- <br> -->
      
      <!-- listing area -->
      
        <section id="main_content">
            <div class="container popular-products-content">
              
              <div class="row">
                 
                 <!-- <h3 class="trend">Trending Products</h3> -->
                <!-- listed products -->
                     <!-- <div class="panel panel-default"> -->
                <div class="panel-body">
                  <?php if($featured_products):?>
                    <?php foreach($featured_products as $product):?>
                         <div class="col-md-3 col-sm-6 col-6">
                            <div class="ww-products-wrapper">
                              
                                <!-- .url_title($product['product_title']) -->
                               <a href="<?php echo base_url();?>r/<?php echo $product['category_title'];?>?product_id=<?php echo $product['product_id'];?>"> 
                                  <img src="<?php echo base_url().'/'.$product['image_url']?>" class="product">
                                  <div class="box_round_symboll">
                                     <h5><?php echo $product['product_price'];?>€</h5>
                                     <h4><?php echo $product['new_product_price'];?>€</h4>
                                  </div>
                               </a>
                               <div class="pro_title">
                                 <h4><?php echo $product['product_title']; ?></h4>
                                 <h5><?php echo $product['product_desc']; ?></h5>
                               </div>     
                            </div>
                            <hr/>
                         </div>

                    <?php endforeach;?>
                  <?php endif;?>
                <!-- listed products -->    
                </div> 
              </div>
            </div>
        </section>
      
      <!-- listing area -->
      
      