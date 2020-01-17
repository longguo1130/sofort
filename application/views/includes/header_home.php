<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>UDU Commerce</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">
      
    <!-- Custom template -->  
    <link href="<?php echo base_url();?>assets/css/navbar.css" rel="stylesheet">  
      
    <!-- font-awesome -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    
    <link href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css" rel="stylesheet">
      
    <!-- Custom template -->  
    <link href="<?php echo base_url();?>assets/css/app.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

 
  </head>

  <body style="overflow: scroll;">
    <header>  
      <nav class="navbar ww-navbar-default">
        
        <div class="container container-fluid">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar">
                  <span class="button-label">Menu</span>
                  <div class="button-bars">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </div>
            </button>
  <!--             <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img class="udu-logo-home" src="<?php echo  base_url();?>assets/img/logo.png" />
              </a> --> 
          </div>
          <div id="navbar" class="collapse navbar-collapse">
<!--             <ul class="nav navbar-nav navbar-left">
                <li><a href="#">Home</a></li>
                <li><a href="#">Filialen</a></li>
                <li><a href="#">Online-Reparatur</a></li>
                <li>

                  <div class="dropdown ww-dropdown">

                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Zertifizierte-Reparatur
                        <i class="fa fa-fw fa-caret-down"></i>
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>

                </li>
                <li><a href="#">Handy verkaufen</a></li>
                <li>
                  <div class="dropdown ww-dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Preise
                          <i class="fa fa-fw fa-caret-down"></i>
                      </button>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                </li>
                <li><a href="#">über uns</a></li>
                <li>
                  <div class="dropdown ww-dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Firmen
                          <i class="fa fa-fw fa-caret-down"></i>
                      </button>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                </li>
                <li><a href="#">Franchise</a></li>
            </ul>       -->
            <div class="logo">
              <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.png" alt=""></a>
            </div>
             
            <ul class="nav navbar-nav navbar-right ww-nav">
              <!-- <li><a href="<?php base_url()?>Auth/register">Register</a></li> -->
              
              <?php if($this->session->userdata('user_id')){
             
                  echo '<li><a href="'.base_url().'admin/Dashboard/product">Admin Dashboard</a></li>';
                  // echo '<li><a href="'.base_url().'user">Profile</a></li>';
                  echo '<li><a href="'.base_url().'Auth/logout">Logout</a></li>'; 
            
                  }else{
             
                  echo '<li><a href="'.base_url().'Auth" >Login</a></li>';
             
                  }
              ?>
<!--                <li><a href="<?php echo base_url();?>post" class="btn btn-login"><i class="fa fa-plus"></i> Post Product</a></li> -->
            </ul>
                
          </div><!--/.nav-collapse -->
        </div>
      </nav>
      <div class="ww-header-background">
        <div class="container container-fluid">
          <div class="row">
            <div class="panel-body">
               <h3>Professionelle Handy-Reparatur Online,24 Std-Service</h3>
               <h5>Wahlen Sie eine Marke:</h5>
               <div class="brand-controls">
                    <a class="btn" href="<?php echo base_url().'r/Apple';?>" role="button">
                        <i class="fa fa-fw fa-apple"></i>Apple
                    </a>
                    <a class="btn" href="<?php echo base_url().'r/Samsung';?>" role="button">
                        <i class="fa fa-fw fa-android"></i>Samsung
                    </a>
                    <a class="btn" href="<?php echo base_url().'r/Huawei';?>" role="button">
                        <i class="fa fa-fw fa-android"></i>Huawei
                    </a>
                    <a class="btn" href="<?php echo base_url().'r/Sony';?>" role="button">
                        <i class="fa fa-fw fa-android"></i>Sony</label>
                    </a>
                    <a class="btn" href="<?php echo base_url().'r/Nokia';?>" role="button">
                        <i class="fa fa-fw fa-windows"></i>Nokia
                    </a>
                    <a class="btn" href="<?php echo base_url().'r/LG';?>" role="button">
                        <i class="fa fa-fw fa-android"></i>LG</label>
                    </a>
                    <a class="btn" href="<?php echo base_url().'r/Gigaest';?>" role="button">
                      <i class="fa fa-fw fa-android"></i>Gigaest</label>
                    </a>
                    <label class="cart-label">Warenkorb&nbsp;<span class="badge badge-secondary badge-pill ww-right-align" id="cart_count"></span></label>
               </div>
               
            </div>
          </div>
        </div>
      </div>
    </header>
      
      