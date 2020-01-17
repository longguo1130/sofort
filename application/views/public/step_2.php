<div class="col-md-10">
    <section>
     <div class="container">
      <div class="row">
      `
      <br><br>
      
      <div class="col-md-4"></div>
      
      
      
      
      <div class="col-md-4">
         <h3 class="text-center text-primary">Upload Product Photo</h3>
        <div class="form-post-ads">
       <div id="feed_back_second_step"></div>
       <div id="option_link" class="show_upload_form">
         <a href="<?php echo base_url();?>Post" class="btn btn-primary btn-block btn-lg"><i class="fa fa-plus"></i> Post Another Ads</a>
         <a href="<?php echo base_url();?>admin/Dashboard/product" class="btn btn-danger btn-block btn-lg"><i class="fa fa-arrow-left"></i> Go back To ProductPage</a>
       </div>
    <form id="form-step-second" action="<?php echo base_url(); ?>post/upload_photo" method="post" enctype="multipart/form-data">
     
      <div id="feedback_upload_foto"></div>
      
      <div id="hidden-upload-form">
          <div class="form-group">
            
            <input type="file" class="form-control" name="file" id="file">
            
          </div>
           <button type="submit" class="btn btn-danger  btn-block" name="mysubmit">Post Your Product</button>
      </div>
     
    </form>
        
        </div>
      </div>
      
      
      
      
      
      <div class="col-md-4"></div>
    </div>
    </div>
    </section>
</div>