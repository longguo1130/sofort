<div class="col-md-10">
    <section>
       <div class="container">
          <div class="row">
          
            <!-- <br /><br /> -->
            <div class="col-md-3"></div>
            <div class="col-md-6">
          
              <div class="panel panel-primary ww-panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title text-center">Product Details</h3>
                </div>
                <div class="panel-body">
                  <div class="form-post-ads">
                     <div id="feedback_step_first"></div>
                     <form id="form-step-first" action="<?php echo base_url();?>Post" method="post">
                        <div class="form-group">
                          <div class="form-group">
                              <select class="form-control" id="category" name="category">
                                   <option>Choose Category</option>
                                   
                                     <?php if(count($categories)): ?>
                                     <?php foreach($categories as $drop): ?>
                                      <option value="<?php echo $drop['category_id']; ?>"><?php echo ucfirst($drop['category_title']); ?></option>
                                     <?php endforeach;?>
                                     <?php endif;?> 
                              </select>
                          </div>

                          <input type="text" name="product_title" class="form-control" id="product_title" placeholder="Product Title">
                          </div>
                          <div class="form-group">
                            <textarea name="product_desc" id="product_desc" class="form-control" placeholder="Product Description"></textarea>
                          </div>
          
                          <div class="input-group form-group">
                            <span class="input-group-addon">₦</span>
                            <input type="text" name="price" id="price" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="price">
                            <span class="input-group-addon">.00</span>
                          </div>
                          <button type="submit" name="mysubmit" class="btn btn-primary btn-block">Post Product Details</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
          </div>
    </section>
</div>
