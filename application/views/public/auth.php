<section id="main_content">
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
                       <?php
                         if ($user_options === null) {
                            echo '<li class="nav-item active">';  
                         } else {
                            echo '<li class="nav-item">';
                         }
                       ?> 
                          <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Neuer Kunde</a>
                       </li>
                       <?php
                         if ($user_options == "existing_user") {
                            echo '<li class="nav-item active">';  
                         } else {
                            echo '<li class="nav-item">';
                         }
                       ?>
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bestehender Kunde</a>
                       </li>
                   </ul> 
                 </div>

                 <?php
                   if ($user_options === null) {
                      echo '<div class="row ww-auth-content active" id="pills-home">';  
                   } else {
                      echo '<div class="row ww-auth-content" id="pills-home">';
                   }
                 ?>
                 
                    <form action="<?php echo base_url().'u';?>" method="POST">
                      <input type="hidden" name="user_options" value="new_user">
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
                         if(!empty($msg) && ($user_options === null)) {
                           echo '<div class="col-md-12">
                                   <div class="alert alert-success">
                                     <button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-warning (alias)"></i>
                                      '.$msg.'
                                      </div>
                                 </div>';
                         }
                       
                      ?>
                    
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Name</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="name" class="form-control" id="name_id" placeholder="name" required>
                              </div>
                              <!-- <div class="col-md-4 ww-right-align">
                                  <h4>Anrede</h4>
                              </div>
                              <div class="col-md-8">
                                  <select class="form-control" name="salutation">
                                      <option>Herr</option>
                                      <option>Herr</option>
                                      <option>Herr</option>
                                      <option>Herr</option>
                                      <option>Herr</option>
                                  </select>
                              </div> -->
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Vorname*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="firstname" class="form-control" id="firstname_id" placeholder="first name" required>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Nachname*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="surname" class="form-control" id="surname_id" placeholder="surname" required>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Adresse*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="address" class="form-control" id="address_id" placeholder="address" required>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Firmenname</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="companyname" class="form-control" id="companyname_id" placeholder="company name" required>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-4 ww-right-align">
                                  <h4>PLZ*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="number" name="postcode" class="form-control" id="postcode_id" placeholder="postcode" required>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Ort*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="place" class="form-control" id="place_id" placeholder="place" required>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Land</h4>
                              </div>
                              <div class="col-md-8">
                                <select name="country" class="form-control m-input" aria-describedby="country-error" aria-invalid="false">
                                    <option value="">
                                      Select
                                    </option>
                                    <option value="AF">
                                      Afghanistan
                                    </option>
                                    <option value="AX">
                                      Åland Islands
                                    </option>
                                    <option value="AL">
                                      Albania
                                    </option>
                                    <option value="DZ">
                                      Algeria
                                    </option>
                                    <option value="AS">
                                      American Samoa
                                    </option>
                                    <option value="AD">
                                      Andorra
                                    </option>
                                    <option value="AO">
                                      Angola
                                    </option>
                                    <option value="AI">
                                      Anguilla
                                    </option>
                                    <option value="AQ">
                                      Antarctica
                                    </option>
                                    <option value="AG">
                                      Antigua and Barbuda
                                    </option>
                                    <option value="AR">
                                      Argentina
                                    </option>
                                    <option value="AM">
                                      Armenia
                                    </option>
                                    <option value="AW">
                                      Aruba
                                    </option>
                                    <option value="AU">
                                      Australia
                                    </option>
                                    <option value="AT">
                                      Austria
                                    </option>
                                    <option value="AZ">
                                      Azerbaijan
                                    </option>
                                    <option value="BS">
                                      Bahamas
                                    </option>
                                    <option value="BH">
                                      Bahrain
                                    </option>
                                    <option value="BD">
                                      Bangladesh
                                    </option>
                                    <option value="BB">
                                      Barbados
                                    </option>
                                    <option value="BY">
                                      Belarus
                                    </option>
                                    <option value="BE">
                                      Belgium
                                    </option>
                                    <option value="BZ">
                                      Belize
                                    </option>
                                    <option value="BJ">
                                      Benin
                                    </option>
                                    <option value="BM">
                                      Bermuda
                                    </option>
                                    <option value="BT">
                                      Bhutan
                                    </option>
                                    <option value="BO">
                                      Bolivia, Plurinational State of
                                    </option>
                                    <option value="BQ">
                                      Bonaire, Sint Eustatius and Saba
                                    </option>
                                    <option value="BA">
                                      Bosnia and Herzegovina
                                    </option>
                                    <option value="BW">
                                      Botswana
                                    </option>
                                    <option value="BV">
                                      Bouvet Island
                                    </option>
                                    <option value="BR">
                                      Brazil
                                    </option>
                                    <option value="IO">
                                      British Indian Ocean Territory
                                    </option>
                                    <option value="BN">
                                      Brunei Darussalam
                                    </option>
                                    <option value="BG">
                                      Bulgaria
                                    </option>
                                    <option value="BF">
                                      Burkina Faso
                                    </option>
                                    <option value="BI">
                                      Burundi
                                    </option>
                                    <option value="KH">
                                      Cambodia
                                    </option>
                                    <option value="CM">
                                      Cameroon
                                    </option>
                                    <option value="CA">
                                      Canada
                                    </option>
                                    <option value="CV">
                                      Cape Verde
                                    </option>
                                    <option value="KY">
                                      Cayman Islands
                                    </option>
                                    <option value="CF">
                                      Central African Republic
                                    </option>
                                    <option value="TD">
                                      Chad
                                    </option>
                                    <option value="CL">
                                      Chile
                                    </option>
                                    <option value="CN">
                                      China
                                    </option>
                                    <option value="CX">
                                      Christmas Island
                                    </option>
                                    <option value="CC">
                                      Cocos (Keeling) Islands
                                    </option>
                                    <option value="CO">
                                      Colombia
                                    </option>
                                    <option value="KM">
                                      Comoros
                                    </option>
                                    <option value="CG">
                                      Congo
                                    </option>
                                    <option value="CD">
                                      Congo, the Democratic Republic of the
                                    </option>
                                    <option value="CK">
                                      Cook Islands
                                    </option>
                                    <option value="CR">
                                      Costa Rica
                                    </option>
                                    <option value="CI">
                                      Côte d'Ivoire
                                    </option>
                                    <option value="HR">
                                      Croatia
                                    </option>
                                    <option value="CU">
                                      Cuba
                                    </option>
                                    <option value="CW">
                                      Curaçao
                                    </option>
                                    <option value="CY">
                                      Cyprus
                                    </option>
                                    <option value="CZ">
                                      Czech Republic
                                    </option>
                                    <option value="DK">
                                      Denmark
                                    </option>
                                    <option value="DJ">
                                      Djibouti
                                    </option>
                                    <option value="DM">
                                      Dominica
                                    </option>
                                    <option value="DO">
                                      Dominican Republic
                                    </option>
                                    <option value="EC">
                                      Ecuador
                                    </option>
                                    <option value="EG">
                                      Egypt
                                    </option>
                                    <option value="SV">
                                      El Salvador
                                    </option>
                                    <option value="GQ">
                                      Equatorial Guinea
                                    </option>
                                    <option value="ER">
                                      Eritrea
                                    </option>
                                    <option value="EE">
                                      Estonia
                                    </option>
                                    <option value="ET">
                                      Ethiopia
                                    </option>
                                    <option value="FK">
                                      Falkland Islands (Malvinas)
                                    </option>
                                    <option value="FO">
                                      Faroe Islands
                                    </option>
                                    <option value="FJ">
                                      Fiji
                                    </option>
                                    <option value="FI">
                                      Finland
                                    </option>
                                    <option value="FR">
                                      France
                                    </option>
                                    <option value="GF">
                                      French Guiana
                                    </option>
                                    <option value="PF">
                                      French Polynesia
                                    </option>
                                    <option value="TF">
                                      French Southern Territories
                                    </option>
                                    <option value="GA">
                                      Gabon
                                    </option>
                                    <option value="GM">
                                      Gambia
                                    </option>
                                    <option value="GE">
                                      Georgia
                                    </option>
                                    <option value="DE" selected="">
                                      Germany
                                    </option>
                                    <option value="GH">
                                      Ghana
                                    </option>
                                    <option value="GI">
                                      Gibraltar
                                    </option>
                                    <option value="GR">
                                      Greece
                                    </option>
                                    <option value="GL">
                                      Greenland
                                    </option>
                                    <option value="GD">
                                      Grenada
                                    </option>
                                    <option value="GP">
                                      Guadeloupe
                                    </option>
                                    <option value="GU">
                                      Guam
                                    </option>
                                    <option value="GT">
                                      Guatemala
                                    </option>
                                    <option value="GG">
                                      Guernsey
                                    </option>
                                    <option value="GN">
                                      Guinea
                                    </option>
                                    <option value="GW">
                                      Guinea-Bissau
                                    </option>
                                    <option value="GY">
                                      Guyana
                                    </option>
                                    <option value="HT">
                                      Haiti
                                    </option>
                                    <option value="HM">
                                      Heard Island and McDonald Islands
                                    </option>
                                    <option value="VA">
                                      Holy See (Vatican City State)
                                    </option>
                                    <option value="HN">
                                      Honduras
                                    </option>
                                    <option value="HK">
                                      Hong Kong
                                    </option>
                                    <option value="HU">
                                      Hungary
                                    </option>
                                    <option value="IS">
                                      Iceland
                                    </option>
                                    <option value="IN">
                                      India
                                    </option>
                                    <option value="ID">
                                      Indonesia
                                    </option>
                                    <option value="IR">
                                      Iran, Islamic Republic of
                                    </option>
                                    <option value="IQ">
                                      Iraq
                                    </option>
                                    <option value="IE">
                                      Ireland
                                    </option>
                                    <option value="IM">
                                      Isle of Man
                                    </option>
                                    <option value="IL">
                                      Israel
                                    </option>
                                    <option value="IT">
                                      Italy
                                    </option>
                                    <option value="JM">
                                      Jamaica
                                    </option>
                                    <option value="JP">
                                      Japan
                                    </option>
                                    <option value="JE">
                                      Jersey
                                    </option>
                                    <option value="JO">
                                      Jordan
                                    </option>
                                    <option value="KZ">
                                      Kazakhstan
                                    </option>
                                    <option value="KE">
                                      Kenya
                                    </option>
                                    <option value="KI">
                                      Kiribati
                                    </option>
                                    <option value="KP">
                                      Korea, Democratic People's Republic of
                                    </option>
                                    <option value="KR">
                                      Korea, Republic of
                                    </option>
                                    <option value="KW">
                                      Kuwait
                                    </option>
                                    <option value="KG">
                                      Kyrgyzstan
                                    </option>
                                    <option value="LA">
                                      Lao People's Democratic Republic
                                    </option>
                                    <option value="LV">
                                      Latvia
                                    </option>
                                    <option value="LB">
                                      Lebanon
                                    </option>
                                    <option value="LS">
                                      Lesotho
                                    </option>
                                    <option value="LR">
                                      Liberia
                                    </option>
                                    <option value="LY">
                                      Libya
                                    </option>
                                    <option value="LI">
                                      Liechtenstein
                                    </option>
                                    <option value="LT">
                                      Lithuania
                                    </option>
                                    <option value="LU">
                                      Luxembourg
                                    </option>
                                    <option value="MO">
                                      Macao
                                    </option>
                                    <option value="MK">
                                      Macedonia, the former Yugoslav Republic of
                                    </option>
                                    <option value="MG">
                                      Madagascar
                                    </option>
                                    <option value="MW">
                                      Malawi
                                    </option>
                                    <option value="MY">
                                      Malaysia
                                    </option>
                                    <option value="MV">
                                      Maldives
                                    </option>
                                    <option value="ML">
                                      Mali
                                    </option>
                                    <option value="MT">
                                      Malta
                                    </option>
                                    <option value="MH">
                                      Marshall Islands
                                    </option>
                                    <option value="MQ">
                                      Martinique
                                    </option>
                                    <option value="MR">
                                      Mauritania
                                    </option>
                                    <option value="MU">
                                      Mauritius
                                    </option>
                                    <option value="YT">
                                      Mayotte
                                    </option>
                                    <option value="MX">
                                      Mexico
                                    </option>
                                    <option value="FM">
                                      Micronesia, Federated States of
                                    </option>
                                    <option value="MD">
                                      Moldova, Republic of
                                    </option>
                                    <option value="MC">
                                      Monaco
                                    </option>
                                    <option value="MN">
                                      Mongolia
                                    </option>
                                    <option value="ME">
                                      Montenegro
                                    </option>
                                    <option value="MS">
                                      Montserrat
                                    </option>
                                    <option value="MA">
                                      Morocco
                                    </option>
                                    <option value="MZ">
                                      Mozambique
                                    </option>
                                    <option value="MM">
                                      Myanmar
                                    </option>
                                    <option value="NA">
                                      Namibia
                                    </option>
                                    <option value="NR">
                                      Nauru
                                    </option>
                                    <option value="NP">
                                      Nepal
                                    </option>
                                    <option value="NL">
                                      Netherlands
                                    </option>
                                    <option value="NC">
                                      New Caledonia
                                    </option>
                                    <option value="NZ">
                                      New Zealand
                                    </option>
                                    <option value="NI">
                                      Nicaragua
                                    </option>
                                    <option value="NE">
                                      Niger
                                    </option>
                                    <option value="NG">
                                      Nigeria
                                    </option>
                                    <option value="NU">
                                      Niue
                                    </option>
                                    <option value="NF">
                                      Norfolk Island
                                    </option>
                                    <option value="MP">
                                      Northern Mariana Islands
                                    </option>
                                    <option value="NO">
                                      Norway
                                    </option>
                                    <option value="OM">
                                      Oman
                                    </option>
                                    <option value="PK">
                                      Pakistan
                                    </option>
                                    <option value="PW">
                                      Palau
                                    </option>
                                    <option value="PS">
                                      Palestinian Territory, Occupied
                                    </option>
                                    <option value="PA">
                                      Panama
                                    </option>
                                    <option value="PG">
                                      Papua New Guinea
                                    </option>
                                    <option value="PY">
                                      Paraguay
                                    </option>
                                    <option value="PE">
                                      Peru
                                    </option>
                                    <option value="PH">
                                      Philippines
                                    </option>
                                    <option value="PN">
                                      Pitcairn
                                    </option>
                                    <option value="PL">
                                      Poland
                                    </option>
                                    <option value="PT">
                                      Portugal
                                    </option>
                                    <option value="PR">
                                      Puerto Rico
                                    </option>
                                    <option value="QA">
                                      Qatar
                                    </option>
                                    <option value="RE">
                                      Réunion
                                    </option>
                                    <option value="RO">
                                      Romania
                                    </option>
                                    <option value="RU">
                                      Russian Federation
                                    </option>
                                    <option value="RW">
                                      Rwanda
                                    </option>
                                    <option value="BL">
                                      Saint Barthélemy
                                    </option>
                                    <option value="SH">
                                      Saint Helena, Ascension and Tristan da Cunha
                                    </option>
                                    <option value="KN">
                                      Saint Kitts and Nevis
                                    </option>
                                    <option value="LC">
                                      Saint Lucia
                                    </option>
                                    <option value="MF">
                                      Saint Martin (French part)
                                    </option>
                                    <option value="PM">
                                      Saint Pierre and Miquelon
                                    </option>
                                    <option value="VC">
                                      Saint Vincent and the Grenadines
                                    </option>
                                    <option value="WS">
                                      Samoa
                                    </option>
                                    <option value="SM">
                                      San Marino
                                    </option>
                                    <option value="ST">
                                      Sao Tome and Principe
                                    </option>
                                    <option value="SA">
                                      Saudi Arabia
                                    </option>
                                    <option value="SN">
                                      Senegal
                                    </option>
                                    <option value="RS">
                                      Serbia
                                    </option>
                                    <option value="SC">
                                      Seychelles
                                    </option>
                                    <option value="SL">
                                      Sierra Leone
                                    </option>
                                    <option value="SG">
                                      Singapore
                                    </option>
                                    <option value="SX">
                                      Sint Maarten (Dutch part)
                                    </option>
                                    <option value="SK">
                                      Slovakia
                                    </option>
                                    <option value="SI">
                                      Slovenia
                                    </option>
                                    <option value="SB">
                                      Solomon Islands
                                    </option>
                                    <option value="SO">
                                      Somalia
                                    </option>
                                    <option value="ZA">
                                      South Africa
                                    </option>
                                    <option value="GS">
                                      South Georgia and the South Sandwich Islands
                                    </option>
                                    <option value="SS">
                                      South Sudan
                                    </option>
                                    <option value="ES">
                                      Spain
                                    </option>
                                    <option value="LK">
                                      Sri Lanka
                                    </option>
                                    <option value="SD">
                                      Sudan
                                    </option>
                                    <option value="SR">
                                      Suriname
                                    </option>
                                    <option value="SJ">
                                      Svalbard and Jan Mayen
                                    </option>
                                    <option value="SZ">
                                      Swaziland
                                    </option>
                                    <option value="SE">
                                      Sweden
                                    </option>
                                    <option value="CH">
                                      Switzerland
                                    </option>
                                    <option value="SY">
                                      Syrian Arab Republic
                                    </option>
                                    <option value="TW">
                                      Taiwan, Province of China
                                    </option>
                                    <option value="TJ">
                                      Tajikistan
                                    </option>
                                    <option value="TZ">
                                      Tanzania, United Republic of
                                    </option>
                                    <option value="TH">
                                      Thailand
                                    </option>
                                    <option value="TL">
                                      Timor-Leste
                                    </option>
                                    <option value="TG">
                                      Togo
                                    </option>
                                    <option value="TK">
                                      Tokelau
                                    </option>
                                    <option value="TO">
                                      Tonga
                                    </option>
                                    <option value="TT">
                                      Trinidad and Tobago
                                    </option>
                                    <option value="TN">
                                      Tunisia
                                    </option>
                                    <option value="TR">
                                      Turkey
                                    </option>
                                    <option value="TM">
                                      Turkmenistan
                                    </option>
                                    <option value="TC">
                                      Turks and Caicos Islands
                                    </option>
                                    <option value="TV">
                                      Tuvalu
                                    </option>
                                    <option value="UG">
                                      Uganda
                                    </option>
                                    <option value="UA">
                                      Ukraine
                                    </option>
                                    <option value="AE">
                                      United Arab Emirates
                                    </option>
                                    <option value="GB">
                                      United Kingdom
                                    </option>
                                    <option value="US">
                                      United States
                                    </option>
                                    <option value="UM">
                                      United States Minor Outlying Islands
                                    </option>
                                    <option value="UY">
                                      Uruguay
                                    </option>
                                    <option value="UZ">
                                      Uzbekistan
                                    </option>
                                    <option value="VU">
                                      Vanuatu
                                    </option>
                                    <option value="VE">
                                      Venezuela, Bolivarian Republic of
                                    </option>
                                    <option value="VN">
                                      Viet Nam
                                    </option>
                                    <option value="VG">
                                      Virgin Islands, British
                                    </option>
                                    <option value="VI">
                                      Virgin Islands, U.S.
                                    </option>
                                    <option value="WF">
                                      Wallis and Futuna
                                    </option>
                                    <option value="EH">
                                      Western Sahara
                                    </option>
                                    <option value="YE">
                                      Yemen
                                    </option>
                                    <option value="ZM">
                                      Zambia
                                    </option>
                                    <option value="ZW">
                                      Zimbabwe
                                    </option>
                                  </select>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Email*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="email" class="form-control" id="email_id" placeholder="email"  required>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Bestatigung<br/>Email*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="confirmemail" class="form-control" id="confirmemail_id" placeholder="confirm email" required>
                              </div>
                          </div>
                          <div class="row ww-mt-10">
                              <div class="col-md-4 ww-right-align">
                                  <h4>Tel*</h4>
                              </div>
                              <div class="col-md-8">
                                  <input type="text" name="tel" class="form-control" id="tel_id" placeholder="tel" value="<?php if(isset($tel_no)) {echo $tel_no;}?>">
                              </div>
                          </div>
                      </div>

                      <div class="row">
                         <div class="col-md-4"></div>
                         <div class="col-md-4">
                           <?php 
                           if ($invoice_created == 'fail') {
                           ?>
                           <div class="ww-start-shopping-wrapper">
                               <button type="submit" name="user_info_submit" class="btn btn-block btn-default btn-sm ww-shopping-btn"> 
                                   Versand jetzt einleiten
                                   <span class="glyphicon glyphicon-chevron-right"></span>
                               </button>
                           </div>
                           <?php
                           } else if($invoice_created == 'success'){
                           ?>
                           <div class="ww-start-shopping-wrapper">
                               <a href = "<?php echo base_url().'u/invoice';?>" name="invoice_link" class="btn btn-block btn-default btn-sm ww-shopping-btn" id="show_invoice" target="_blank"> 
                                   Show INVOICE
                               </a>
                           </div>
                           <div class="ww-start-shopping-wrapper">
                               <a href = "<?php echo base_url().'delivery';?>" name="delivery_link" class="btn btn-block btn-default btn-sm ww-shopping-btn" id="choose_delivery"> 
                                   Choose Delivery
                               </a>
                           </div>    
                           <?php
                           }
                           ?>
                         </div>
                         <div class="col-md-4"></div>
                      </div>
                    </form>
                 </div>
                 <!-- </div> -->
                 <!-- search bar -->
                 <?php
                 if ($user_options == "existing_user") {
                    echo '<div class="row ww-auth-content active" id="pills-profile">';  
                 } else {
                    echo '<div class="row ww-auth-content" id="pills-profile">';
                 }
                 ?>
                    <div class="container">
                       <div class="row">
                          <div class="col-md-3"></div>
                         <?php
                         $msg = $this->session->flashdata('reguserinfo_success');
                         if(!empty($msg) && ($user_options == "existing_user")){
                               
                            echo '<div class="col-md-6">
                                    <div class="alert alert-success">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-warning (alias)"></i>
                                       '.$msg.'
                                    </div>   
                                  </div>';
                         }
                         ?>
                         <div class="col-md-3"></div>
                       </div>
                       <div class="row">
                           <div class="col-md-4"></div>
                           <div class="col-md-4">
                           <form action="<?php echo base_url();?>u/search" method="post" id="">
                             <div id="search-input">
                                <div class="input-group">
                              
                                   <input type="text" required class="form-control input-md" name="term" id="term"  placeholder="Search for users">
                                   <span class="input-group-btn">
                                     <button type="submit" class="btn btn-default input-md">
                                        <i class="fa fa-search"></i> Search
                                     </button>
                                   </span>
                               </div><!-- /input-group -->  
                             </div>
                           </form>
                           </div>
                           <div class="col-md-4"></div>
                       </div>
                       
                       <form action="<?php echo base_url();?>u/upinfo" method="post" id="">

                         <div class="row" style="margin-top: 20px;">
                            <div class="col-md-3"></div>
                            <div class="col-md-6" style="text-align: center;">
                                <table class="table table-bordered table-striped">
                                  <thead>
                                    <tr class="table-active" style="background-color: lightgray;">
                                      <td>#</td>
                                      <td>Name</td>
                                      <td>Tel</td>
                                      <td>Email</td>
                                    </tr>
                                  </thead>
                                  
                                  <?php
                                  if (isset($search_result)) {
                                    foreach ($search_result as $val) {
                                  ?>

                                  <tbody>
                                    <tr>
                                      <td><input type="checkbox" name="checked_user_id" value="<?php echo $val['user_id'];?>" required></td>
                                      <td><?php echo $val['name']?></td>
                                      <td><?php echo $val['telephone_no']?></td>
                                      <td><?php echo $val['email']?></td>
                                    </tr>
                                  </tbody>
                                  
                                  <?php
                                    }
                                  } 
                                  ?>

                                </table>  
                            </div>
                            <div class="col-md-3"></div>
                         </div> 

                         <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <?php 
                              if ($user_options == "existing_user" && $invoice_created == 'fail') {
                              ?>
                              <div class="ww-start-shopping-wrapper">
                                  <button type="submit" name="sel_userinfo_submit" class="btn btn-block btn-default btn-sm ww-shopping-btn"> 
                                      Versand jetzt einleiten
                                      <span class="glyphicon glyphicon-chevron-right"></span>
                                  </button>
                              </div>
                              <?php
                              } else if($user_options == "existing_user" && $invoice_created == 'success'){
                              ?>
                              <div class="ww-start-shopping-wrapper">
                                  <a href = "<?php echo base_url().'u/invoice';?>" name="invoice_link" class="btn btn-block btn-default btn-sm ww-shopping-btn" id="show_invoice" target="_blank"> 
                                      Show INVOICE
                                  </a>
                              </div>
                              <div class="ww-start-shopping-wrapper">
                                  <a href = "<?php echo base_url().'delivery';?>" name="delivery_link" class="btn btn-block btn-default btn-sm ww-shopping-btn" id="choose_delivery"> 
                                      Choose Delivery
                                  </a>
                              </div>  
                              <?php
                              }
                              ?>
                            </div>
                            <div class="col-md-4"></div>
                         </div>
                         <input type="hidden" name="user_options" value="existing_user">
                       </form>
                    </div>

                 </div>
                 
               </div>
             <!-- </form> -->
         </div>
      
      </div>
  </div>
</section>

