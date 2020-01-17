<section id="main_content">
  <div class="container container-fluid popular-products-content">
      <div class="delivery-wrapper panel-body">
         <div class="row delivery-header">
            <div class="col-md-12">
              <h3><i class="fa fa-fw fa-envelope-o" style="margin-right: 10px;"></i>Round-trip shipping</h3>
            </div>
         </div>
         <div class="ww-divider-wrapper">
            <div class="ww-divider"></div>
         </div>

         <div class="row delivery-main">
             
               <div class="col-md-12">
                 <div class="row delivery-option">
                   <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                       <?php
                         if ($delivery_options === null) {
                            echo '<li class="nav-item active">';  
                         } else {
                            echo '<li class="nav-item">';
                         }
                       ?> 
                          <a class="nav-link active show" id="pills-postal-tab" data-toggle="pill" href="#pills-postal" role="tab" aria-controls="pills-postal" aria-selected="true">Postal delivery</a>
                       </li>
                       <?php
                         if ($delivery_options == "existing_user") {
                            echo '<li class="nav-item active">';  
                         } else {
                            echo '<li class="nav-item">';
                         }
                       ?>
                          <a class="nav-link" id="pills-pickup-tab" data-toggle="pill" href="#pills-pickup" role="tab" aria-controls="pills-pickup" aria-selected="false">Pick-up & delivery service</a>
                       </li>
                   </ul> 
                 </div>

                 <?php
                   if ($delivery_options === null) {
                      echo '<div class="row delivery-option-content active" id="pills-postal">';  
                   } else {
                      echo '<div class="row delivery-option-content" id="pills-pickup">';
                   }
                 ?>
                 
                    <form action="<?php echo base_url().'Delivery/choose_delivery';?>" class="form-group" method="POST">
                      <input type="hidden" name="delivery_options" value="postal">
                      <?php  
                          
                         $msg = $this->session->flashdata('reguserinfo');
                         if(!empty($msg)){
                               
                            echo '<div class="col-md-12">
                                    <div class="alert alert-danger">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-warning (alias)"></i>
                                       '.$msg.'
                                    </div>   
                                  </div>';
                         } 
                         
                         $msg = $this->session->flashdata('reguserinfo_success');
                         if(!empty($msg) && ($delivery_options === null)) {
                           echo '<div class="col-md-12">
                                   <div class="alert alert-success">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-warning (alias)"></i>
                                      '.$msg.'
                                      </div>
                                 </div>';
                         }
                       
                      ?>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="col-md-8">
                              <p class="postal-paragrah">
                                Send us your device with a parcel service of your choice. You will receive instructions by email after completion. The return shipment takes place depending on the selected payment method after receipt of payment or immediately after the repair with payment by cash on delivery.
                              </p>
                              <ul>
                                <li>
                                  <i class="fa fa-fw fa-genderless"></i>
                                    Returns throughout Austria, insured: Free
                                </li>
                                <li>
                                  <i class="fa fa-fw fa-genderless"></i>
                                    Return shipping to Germany, insured: € 13.50
                                </li>
                              </ul>
                          </div>
                          <div class="col-md-2"></div>
                          
                        </div>

                        <div class="row address-opt">
                          <div class="col-md-2"></div>
                          <div class="col-md-8 form-group form-check">
                            <input type="checkbox" class="form-check-input" name="same_address_opt">
                            </input>
                            <label class="form-check-label" for="exampleCheck1">Same address as above.</label>
                          </div>
                          <div class="col-md-2"></div>
                        </div>

                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="col-md-4">
                            <div class="ww-start-shopping-wrapper">
                               <button type="submit" name="deliveryinfosubmit" class="btn btn-block btn-default btn-sm ww-shopping-btn">Complete<span class="glyphicon glyphicon-chevron-right"></span>
                               </button>
                            </div>
                          </div>
                          <div class="col-md-4"></div>
                        </div>

                      </div>

                    </form>
                 </div>
                 <!-- </div> -->
                 <!-- search bar -->
                 <?php
                 if ($delivery_options == "existing_user") {
                    echo '<div class="row delivery-option-content active" id="pills-pickup">';  
                 } else {
                    echo '<div class="row delivery-option-content" id="pills-pickup">';
                 }
                 ?>
                    <form action="<?php echo base_url().'Delivery/choose_delivery';?>" class="form-group" method="POST">
                      <input type="hidden" name="delivery_options" value="delivery">
                      <?php  
                          
                         $msg = $this->session->flashdata('reguserinfo');
                         if(!empty($msg)){
                               
                            echo '<div class="col-md-12">
                                    <div class="alert alert-danger">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-warning (alias)"></i>
                                       '.$msg.'
                                    </div>   
                                  </div>';
                         } 
                         
                         $msg = $this->session->flashdata('reguserinfo_success');
                         if(!empty($msg) && ($delivery_options === null)) {
                           echo '<div class="col-md-12">
                                   <div class="alert alert-success">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-warning (alias)"></i>
                                      '.$msg.'
                                      </div>
                                 </div>';
                         }
                       
                      ?>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-2"></div>
                          <div class="col-md-8">
                              <p class="postal-paragrah">
                                One of our employees will personally collect your device from the desired location on your desired date and return it to our workshop for repair immediately. On the delivery date, it will be delivered to the specified address.
                              </p>
                              <ul>
                                <li>
                                  <i class="fa fa-fw fa-genderless"></i>
                                    Free pickup & delivery *
                                </li>
                                <li>
                                  <i class="fa fa-fw fa-genderless"></i>
                                    This service is only possible within Vienna
                                </li>
                              </ul>
                              <p class="postal-paragrah">Free, from an order value of at least € 49, -. Otherwise € 10, - incl. VAT will be charged for this service.</p>
                          </div>
                          <div class="col-md-2"></div>
                          
                        </div>

                        <div class="row address-opt">
                          <div class="col-md-2"></div>
                          <div class="col-md-8">
                            <div class="row">
                              <div class="col-md-5 form-inline">
                                <!-- <div class="form-group">
                                    <label class="delivery-label" for="inputPassword6">Pickup date *</label>
                                    <input type="password" id="inputPassword6" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                                </div> -->
                                <div class="form-group">
                                  <label class="delivery-label">&nbsp;Pickup date*&nbsp;&nbsp;</label>

                                  <div class="input-group date">
                                    <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="pickup_date" required>
                                  </div>
                                  <!-- /.input group -->
                                </div>
                              </div>
                              <div class="col-md-4 form-group form-check">
                                  <input type="checkbox" class="form-check-input" name="same_address_opt" value="same_address">
                                  </input>
                                  <label class="form-check-label" for="exampleCheck1">Same address as above.</label>
                              </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-5 form-inline">
                                  
                                    <label class="delivery-label" for="validationCustom04">&nbsp;&nbsp;Pickup time&nbsp;&nbsp;</label>
                                    <select class="form-control m-input" id="validationCustom04">
                                      <option selected disabled value="">09:00-13:00</option>
                                    </select>
                                  
                                </div>
                            </div>
                          </div>
                          <div class="col-md-2"></div>
                        </div>

                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="col-md-4">
                            <div class="ww-start-shopping-wrapper">
                               <button type="submit" name="deliveryinfosubmit" class="btn btn-block btn-default btn-sm ww-shopping-btn">Complete<span class="glyphicon glyphicon-chevron-right"></span>
                               </button>
                            </div>
                          </div>
                          <div class="col-md-4"></div>
                        </div>

                      </div>

                    </form>

                 </div>
                 
               </div>
             <!-- </form> -->
         </div>
      
      </div>
  </div>
</section>

