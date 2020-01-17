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

    <title><?php echo base_url();?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">
      
    <!-- Custom template -->  
    <link href="<?php echo base_url();?>assets/css/navbar.css" rel="stylesheet">  
      
    <!-- font-awesome -->
      <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
      
    <!-- Custom template -->  

    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/base/style.bundle.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.modal.min.css"/>
    
    <link href="<?php echo base_url();?>assets/css/app.css" rel="stylesheet">

    <script type= 'text/javascript' src="<?php echo base_url();?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script type= 'text/javascript' src="<?php echo base_url();?>assets/base/scripts.bundle.js" type="text/javascript"></script>
    <!--end::Base Scripts -->   
    <!--begin::Page Resources -->

    <!-- <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.js"></script> -->
    <script src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.inputmask.bundle.js"></script>
    <script src="<?php echo base_url();?>assets/js/input-mask.js"></script>
    <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.modal.min.js"></script>
    <script type= 'text/javascript' src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
     
    <style>
      .modal p { margin: 1em 0; }
      
      .add_form.modal {
        border-radius: 0;
        line-height: 18px;
        padding: 0;
        font-family: "Lucida Grande", Verdana, sans-serif;
      }

      .add_form h3 {
        margin: 0;
        padding: 10px;
        color: #fff;
        font-size: 14px;
        background: -moz-linear-gradient(top, #2e5764, #1e3d47);
        background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #1e3d47),color-stop(1, #2e5764));
      }
      .add_form.modal select{
        color:#000;
        font: normal 12px/18px "Lucida Grande", Verdana;
        padding:2px 5px;
        font-size: 12px;
        width: 200px;
      }
      .add_form.modal p { padding: 20px 30px; border-bottom: 1px solid #ddd; margin: 0;
        background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #eee),color-stop(1, #fff));
        overflow: hidden;
      }
      .add_form.modal p:last-child { border: none; }
      .add_form.modal p label { float: left; font-weight: bold; color: #333; font-size: 13px; width: 110px; line-height: 22px; }
      .add_form.modal p input[type="text"],
      .add_form.modal p input[type="submit"]    {
        color: #000;
        font: normal 12px/18px "Lucida Grande", Verdana;
        padding: 3px;
        border: 1px solid #ddd;
        width: 200px;
      }
      
      #msgAdd {
        margin: 10px;
        padding: 30px;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        background: -moz-linear-gradient(top, #2e5764, #1e3d47);
        background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #1e3d47),color-stop(1, #2e5764));
      }

      td.details-control {
          background: url('<?php echo base_url();?>assets/img/details_open.png') no-repeat center center;
          cursor: pointer;
      }

      tr.shown td.details-control {
          background: url('<?php echo base_url();?>assets/img/details_close.png') no-repeat center center;
      }

      td.show-disabled{
        display: none;
      }
    </style>
  </head>

  <body>
    <header style="margin-bottom: 20px;">
      
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
            </div>
            <div id="navbar" class="collapse navbar-collapse">

              <div class="logo">
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo.png" alt=""></a>
              </div>
               
              <ul class="nav navbar-nav navbar-right ww-nav">
                
                <?php if($this->session->userdata('user_id')){
               
                    echo '<li><a href="'.base_url().'admin/Dashboard/product">Admin Dashboard</a></li>';
                    echo '<li><a href="'.base_url().'Auth/logout">Logout</a></li>'; 
              
                    }else{
               
                    echo '<li><a href="'.base_url().'Auth" >Login</a></li>';
               
                    }
                ?>

              </ul>
                  
            </div>
          </div>
        </nav>
    </header>
      
      
      
