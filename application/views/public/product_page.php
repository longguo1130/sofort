
   <style>
     
	
 

ul {
    list-style-type: none;
}
 
/*h3 {
  font: bold 20px/1.5 Helvetica, Verdana, sans-serif;
}*/
 
/*li img {
  float: left;
  margin: 0 15px 0 0;
}
 
li p {
  font: 200 12px/1.5 Georgia, Times New Roman, serif;
}
 
li {
  padding: 5px;
  overflow: auto;
}*/
 

	 
   </style>
   
   <!-- section -->

   <section id="main_content">
      <div class="container panel-body popular-products-content">
         <div class="row panel-body">
             <div class="col-md-3">

                 <h4>Marke</h4>

                  <select class="table-group-action-input form-control input-inline input-small input-sm ww-select" id="sel_category">
                    <?php if(count($categories)): ?>
                    <?php foreach($categories as $drop): ?>
                       <?php if($drop['category_id'] == $sel_category_id) { ?>
                          <option value="<?php echo $drop['category_id']; ?>" selected><?php echo ucfirst($drop['category_title']); ?></option>
                       <?php } else { ?>
                          <option value="<?php echo $drop['category_id']; ?>"><?php echo ucfirst($drop['category_title']); ?></option>
                       <?php } ?>
                    <?php endforeach;?>
                    <?php endif;?> 
                 </select>

                 <h4>Modell</h4>
                 <select class="table-group-action-input form-control input-inline input-small input-sm ww-select" id="sel_model">
                          <!-- <option value="-1">select model</option> -->
                    <?php if(count($sub_categories)): ?>
                    <?php foreach($sub_categories as $drop): ?>
                        <?php if($drop['product_id'] == $sel_model_id) { ?>
                          <option value="<?php echo $drop['product_id'];?>" selected>
                              <?php echo ucfirst($drop['product_title']); ?>
                          </option>
                        <?php } else { ?>
                          <option value="<?php echo $drop['product_id'];?>">
                              <?php echo ucfirst($drop['product_title']); ?>
                          </option>
                        <?php } ?>
                    <?php endforeach;?>
                    <?php endif;?>
                 </select>

                 <ul class="ww-product-desc">
                     <li>
                       <i class="fa fa-fw fa-check"></i>Erstattung der Einsendekosten
                     </li>
                     <li>
                        <i class="fa fa-fw fa-check"></i>Sofortreparatur am gleichen Tag
                      </li>
                     <li>
                        <i class="fa fa-fw fa-check"></i>Rückversand per DHL kostenios
                      </li>
                     <li>
                        <i class="fa fa-fw fa-check"></i>Keine Vorauskasse
                      </li>
                 </ul>
             </div>
             <div class="col-md-2">
                 <div class="ww-product-img-wrapper">
                   <img class="ww-product-img" class="image-responsive" src="<?php echo base_url().'/'. $product_details[0]['image_url'] ;?>" id="phone_img"/>
                   <h3 id="pro_title"><?php echo $product_details[0]['product_title']; ?></h3>
                 </div>
             </div>
             <div class="col-md-3">
                <form action="<?php echo base_url().'r/?step=2&product_id='.$product_details[0]['product_id'];?>'&submit=true'" method="post">
                   <div class="repairtoggles">
                       <?php if(count($repair_options) > 0) { ?>
                       <h4>Reparaturen:</h4>
                       <?php foreach($repair_options as $repair_item): ?>

                            <?php 
                                if (isset($repair_item['selected'])) {
                                  # code...
                                  echo '<label for="';
                                  echo 'repair_id_'.$repair_item['repair_id'];
                                  echo '" name="';
                                  echo 'repair_id_'.$repair_item['repair_id']; 
                                  echo '" state="'; 
                                  echo $repair_item['selected'].'">';
                                } else {
                                  # code...
                                  echo '<label for="';
                                  echo 'repair_id_'.$repair_item['repair_id'];
                                  echo '" name="';
                                  echo 'repair_id_'.$repair_item['repair_id'].'">'; 
                                }
                                
                            ?>  
                            
                              <div style="margin-top: 3px;">
                              
                              <?php 
                              if($repair_item['repair_or_service'] == 1 && $repair_item['sub_type'] == 1)
                              { ?>   
                                   <i class="fa fa-fw fa-mobile-phone"></i>
                              <?php
                              } 
                              else if ($repair_item['repair_or_service'] == 1 && $repair_item['sub_type'] == 2)
                              {
                              ?> 
                                   <i class="glyphicon glyphicon-flash"></i>
                              <?php 
                              }
                              ?>
                              <span><?php echo $repair_item['repair_title']; ?></span>
                             </div>
                             <div style="margin-top: 5px; margin-bottom: 5px;">
                               <span><?php echo $repair_item['repair_summary']; ?></span>
                               <span style="float: right;"><?php echo $repair_item['repair_price'].'€'; ?></span>
                             </div>
                            </label>
                            <input class="toggle repair-toggle" type="checkbox" name="<?php echo 'repair_id_'.$repair_item['repair_id']; ?>" id="<?php echo 'repair_id_'.$repair_item['repair_id']; ?>" category_id ="<?php echo $repair_item['category_id'];?>" repair_id="<?php echo $repair_item['repair_id']; ?>" product_id="<?php echo $repair_item['product_id'];?>" repair_price="<?php echo $repair_item['repair_price'];?>" repair_title="<?php echo $repair_item['repair_title']?>">
                       <?php endforeach;?>
                       <?php } ?> 
                   </div>
                   
                   <div class="servicetoggles">
                       <?php if(count($service_options) > 0) { ?>
                       <h4>Dienstleistungen:</h4>
                       <?php foreach($service_options as $service_item): 
                              $service_item = (array)$service_item;?>
                              <?php 
                                  if (isset($service_item['selected'])) {
                                    # code...
                                    echo '<label for="';
                                    echo 'repair_id_'.$service_item['repair_id'];
                                    echo '" name="';
                                    echo 'repair_id_'.$service_item['repair_id']; 
                                    echo '" state="'; 
                                    echo $service_item['selected'].'">';
                                  } else {
                                    # code...
                                    echo '<label for="';
                                    echo 'repair_id_'.$service_item['repair_id'];
                                    echo '" name="';
                                    echo 'repair_id_'.$service_item['repair_id'].'">'; 
                                  }
                              ?>    
                                 <div>
                                    <?php 
                                    if($service_item['repair_or_service'] == 2 && $service_item['sub_type'] == 1){ ?>
                                       <span class="glyphicon glyphicon-saved"></span>
                                      <?php 
                                      } 
                                      else if($service_item['repair_or_service'] == 2 && $service_item['sub_type'] == 2)
                                      { ?>
                                       <span class="glyphicon glyphicon-exclamation-sign"></span>
                                      <?php 
                                      } 
                                      ?>  
                                    <?php echo $service_item['repair_title']; ?>
                                    <span style="float: right;"><?php echo $service_item['repair_price'].'€'; ?></span>
                                 </div>
                               </label>
                               <input class="toggle repair-toggle" type="checkbox" name="<?php echo 'repair_id_'.$service_item['repair_id']; ?>" id="<?php echo 'repair_id_'.$service_item['repair_id']; ?>" repair_id="<?php echo $service_item['repair_id']; ?>" category_id = "<?php echo $service_item['category_id']?>"  product_id="<?php echo $service_item['product_id']?>" repair_price="<?php echo $service_item['repair_price']?>" repair_title="<?php echo $service_item['repair_title']?>">

                       <?php endforeach;?>
                       <?php } ?> 
                   </div>

                   <?php 
                      if (isset($repair_options) || isset($service_options)) {
                   ?>
                       <div class="ww-start-shopping-wrapper" style="display: none;">
                           <button type="submit" name="repair_options_submit" class="btn btn-block btn-default btn-sm ww-shopping-btn" id="showdevinfo"> 
                               Versand jetzt einleiten
                               <span class="glyphicon glyphicon-chevron-right"></span>
                           </button>
                       </div> 
                   <?php   
                      } 
                   ?>
                </form>
                  
             </div>
             <div class="col-md-2">
                <div class="ww-product-detail-wrapper">
                </div>
             </div>
             <div class="col-md-2">
               
             </div>
         </div>
         <h5 style="margin-top: 50px;">Alle Preise inkl. MwSt, keine Rücksendekosten</h5>
      </div>
   </section>
   
   <!-- userinfo page -->
<!--    <section class="ww-auth-section">
     <div class="container container-fluid popular-products-content">
        <div class="authinfo-wrapper panel-body">
            <div class="row authinfo-header">
               <div class="col-md-12">
                 <span><i class="fa fa-fw fa-user"></i>Kundendaten</span>
               </div>
            </div>
            <div class="ww-divider-wrapper">
               <div class="ww-divider"></div>
            </div>

            <div class="row authinfo-main">
                
                <div class="col-md-12">
                  <div class="row ww-auth-option">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Neuer Kunde</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bestehender Kunde</a>
                        </li>
                    </ul> 
                  </div>

                  <div class="row ww-auth-content">
                     <div class="col-md-6">
                         <div class="row">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Anrede</h4>
                             </div>
                             <div class="col-md-8">
                                 <select class="form-control">
                                     <option>Herr</option>
                                     <option>option 2</option>
                                     <option>option 3</option>
                                     <option>option 4</option>
                                     <option>option 5</option>
                                 </select>
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Firmenname</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Vorname*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Nachname*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Adresse*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                     </div>

                     <div class="col-md-6">
                         <div class="row">
                             <div class="col-md-4 ww-right-align">
                                 <h4>PLZ*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Ort*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Land</h4>
                             </div>
                             <div class="col-md-8">
                                 <select class="form-control">
                                     <option>Herr</option>
                                     <option>option 2</option>
                                     <option>option 3</option>
                                     <option>option 4</option>
                                     <option>option 5</option>
                                 </select>
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Email*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Bestatigung<br/>Email*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                         <div class="row ww-mt-10">
                             <div class="col-md-4 ww-right-align">
                                 <h4>Tel*</h4>
                             </div>
                             <div class="col-md-8">
                                 <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                             </div>
                         </div>
                     </div>
                  </div>
                </div>
            </div>
         </div>
     </div>
   </section> -->
      
      
      
      
