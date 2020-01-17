
 <!-- deviceinfo page -->
<section id="main_content">
   <div class="container container-fluid popular-products-content">
     <?php echo validation_errors(); ?>
     <form action="<?php echo base_url().'deviceinfo';?>" method="GET">

          <div class="row">
             <div class="col-md-12">
               <div class="ww-deviceinfo-wrapper">
                 <div class="ww-deviceinfo-header">
                   <span>
                     <i class="fa fa-fw fa-mobile"></i>Gerätedaten
                   </span>
                 </div>
                 <div class="ww-divider-wrapper">
                   <div class="ww-divider"></div>
                 </div>

                 <div class="ww-deviceinfo-main">
                   <div class="row">
                     <div class="col-md-5">
                       <div class="row">
                         <div class="col-md-4 ww-right-align">
                           <h4>Greät :</h4>
                         </div>
                         <div class="col-md-8">
                           <h4 id="device_model"><?php echo $device_model; ?></h4>
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-4 ww-right-align">
                           <h4>Fehier :</h4>
                         </div>
                         <div class="col-md-8">
                           <?php
                                if(isset($selected_options)) {
                                  foreach ($selected_options as $val) {
                           echo '<input type="hidden" name="selected_options[]" value="'.$val['repair_id'].'">';
                           ?>
                           <h4 id="device_error">
                                <?php echo $val['repair_title'];?>
                                <span style="float:right"><?php echo $val['repair_price'];?> €</span>
                           </h4>
                           <?php
                                  }
                                }
                           ?>
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-4 ww-right-align">
                           <h4>Preis :</h4>
                         </div>
                         <div class="col-md-8">
                           <h4 id="repair_price"><?php echo $total_price;?> €</h4>
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-4 ww-right-align">
                           <h4>IMEI-Number</h4>
                         </div>
                         <div class="col-md-8">
                           <div class="input-group">
                              <input type="number" class="form-control" name="imei_no" id="imei_no" required>
                              <span class="input-group-addon"><i class="fa fa-info"></i></span>
                           </div>  
                         </div>
                       </div>
                       <div class="row ww-mt-10">
                         <div class="col-md-4 ww-right-align">
                           <h4>Handyanbieter*</h4>
                         </div>
                         <div class="col-md-8">
                           <select class="form-control" id="cell_provider" name="cell_provider">
                               <option value="-1">select cell_provider</option>
                               <option value = "1">struggat</option>
                           </select>
                         </div>
                       </div>
                     </div>
                     <div class="col-md-5">
                       <div class="row">
                         <div class="col-md-4 ww-right-align">
                           <h4>Telefoncode</h4>
                         </div>
                         <div class="col-md-8">
                           <div class="input-group">
                              <input type="text" class="form-control" name="telephone_no" id="tel_id" required>
                              <span class="input-group-addon"><i class="fa fa-info"></i></span>
                           </div>  
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-4 ww-right-align">
                           <h4>Genaure<br/>Fehlerangaben</h4>
                         </div>
                         <div class="col-md-8 ww-mt-10">
                           <div class="form-group">
                             <textarea class="form-control" rows="3" placeholder="Enter ..." style="margin: 0px 26.5px 0px 0px; width: 100%; height: 216px; resize: vertical;" name="extra_error" id="extra_error"></textarea>
                           </div>  
                         </div>
                       </div>
                     </div>
                     <div class="col-md-2"></div>
                   </div>
                 </div>
               </div>
             </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="ww-start-shopping-wrapper">
                 <button type="submit" name="devinfosubmit" class="btn btn-block btn-default btn-sm ww-shopping-btn">Versand jetzt einleiten<span class="glyphicon glyphicon-chevron-right"></span>
                 </button>
              </div>
            </div>
            <div class="col-md-4"></div>
          </div>
     </form>
     
   </div>
</section>