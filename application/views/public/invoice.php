
<div class="modal-body invoice_wrapper" id="print_view">

    <div class="row invoice_header_wrapper">

      <div class="col-md-7 header_left_item">
        <ul>
          <li><label id ="address">Sevenit GmbH – Hauptstraße 40 – 77653 Offenburg</label></li>
          <li><br/></li>
          <li><label>Mustermann KG</label></li>
          <li><label>Musterstr. 1</label></li>
          <li><label id="city_name">22222 Musterstadt</label></li>
        </ul>
      </div>
    
    
      <div class="col-md-3 header_right_item">
        <ul>
          <li><label>Rechnung Nr.</label></li>
          <li><label>Rechnungsdatum</label></li>
          <li><label>Lieferdatum</label></li>
          <li><label>Ihre Kundennummer</label></li>
          <li><label>Ihr Ansprechpartner  </label></li>
        </ul>
      </div>                
    
      <div class="col-md-2 header_right_item">
        <ul>
          <li><label><?php echo $invoice_item[0]['invoice_id']?></label></li>
          <li><label><?php echo date('m/d/Y', $invoice_item[0]['start_timestamp']);?></label></li>
          <li><label><?php echo date('m/d/Y', $invoice_item[0]['end_timestamp']);?></label></li>
          <li><label><?php echo $invoice_item[0]['customer_id']?></label></li>
          <li><label>Fabian Silberer</label></li>
        </ul>
      </div>                
    
    
      <div class="col-md-12 header_date_item">
          <label class="ww-right-align">25.02.2018</label>
      </div>
    </div>

    <div class="invoice_content_wrapper">
      <div class="row sub_header_wrapper">
          <div class="col-md-12">
              <label class="sub_title">Rechnung Nr. <?php echo $invoice_item[0]['invoice_id']?></label>
              <label class="sub_summary">Vielen Dank für Ihr Vertrauen in die Mustermann KG. Wir stellen Ihnen hiermit folgende Leistungen in Rechnung:</label>
          </div>
      </div>

      <div class="sub_content_wrapper">

          <div class="row sub_content_item">
            <div class="col-md-1"><label class="order_title">Pos.</label></div>
            <div class="col-md-5"><label class="order_title">Bezeichnung</label></div>
            <div class="col-md-4"></div>
            <div class="col-md-2"><label class="order_title">Einzelpreis</label></div>
          </div>

          <?php
            if (isset($repair_infos)) {
              $pos = 1;
              $sub_price = 0;
              $total_price = 0;
              foreach ($repair_infos as $val) {
                $sub_price += $val['repair_price'];
          ?>
              <div class="row sub_content_item">
                  <div class="col-md-1">
                      <label class="order_title"><?php echo $pos;?></label>
                  </div>
                  <div class="col-md-5">
                      <label class="order_title"><?php echo $val['repair_title'];?></label>
                  </div>
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-2">
                      <label class="order_title"><?php echo $val['repair_price'];?> €</label>
                  </div>
              </div>                          
          <?php
                  $pos++;
              }
              $total_price = $sub_price - 5;
            } else {
              
            }
            
          ?>

      </div>

      <div class="sub_content_result_wrapper">
          <div class="row sub_content_result_item">
            <div class="col-md-1"><label class="order_title"></label></div>
            <div class="col-md-5"><label class="order_title_sm">Summe Positionen</label></div>
            <div class="col-md-2"><label class="order_title"></label></div>
            <div class="col-md-2"><label class="order_title"></label></div>
            <div class="col-md-2"><label class="order_title_sm"><?php echo $sub_price;?> €</label></div>
          </div>

          <div class="row sub_content_result_item">
            <div class="col-md-1"><label class="order_title"></label></div>
            <div class="col-md-5"><label class="order_title_md">Erstattung der Einsendekosten:</label></div>
            <div class="col-md-2"><label class="order_title"></label></div>
            <div class="col-md-2"><label class="order_title"></label></div>
            <div class="col-md-2"><label class="order_title_md">€ -5</label></div>
          </div>

          <div class="row sub_content_result_item">
            <div class="col-md-1"><label class="order_title"></label></div>
            <div class="col-md-5"><label class="order_title_lg">Rechnungsbetrag</label></div>
            <div class="col-md-2"><label class="order_title"></label></div>
            <div class="col-md-2"><label class="order_title"></label></div>
            <div class="col-md-2"><label class="order_title_lg"><?php echo $total_price;?> €</label></div>
          </div>
      </div>
    </div>

    <div class="invoice_footer_wrapper">
      
      <label class="footer_title_sm">Zahlungsbedingungen: Zahlung innerhalb von 14 Tagen ab Rechnungseingang ohne Abzüge.</label>
      <label class="footer_title_lg">Mit freundlichen Grüßen</label>
      <label class="footer_title_md">Said Khagani</label> 
    </div>

    <div class="invoice_footer_summary">
      <div class="row">
        <div class="col-md-5">
          <label class="footer_summary_title">Sevenit GmbH</label>
          <label class="footer_summary_title">Hauptstraße 40</label>
          <label class="footer_summary_title">77653 Offenburg</label>
          <label class="footer_summary_title">Deutschland</label>
          <label class="footer_summary_title">Tel.:(+49)7821–549370–0</label>
          <label class="footer_summary_title">E-Mail: info@sevenit.de</label>
        </div>
        <div class="col-md-5">
          <label class="footer_summary_title">Musterbank</label>
          <label class="footer_summary_title">IBAN DE 85 12345678 0123456789</label>
          <label class="footer_summary_title">BIC PBNKDEFF</label>
        </div>
        <div class="col-md-2">
          <label class="footer_summary_title">USt.-ID: 0815</label>
          <label class="footer_summary_title">Geschäftsführer:</label>
          <label class="footer_summary_title">Max Mustermann</label>
        </div>
      </div>
    </div>
</div>
