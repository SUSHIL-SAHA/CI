<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CI Skeleton | Admin System Log in</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/admin/frontend/images/new_favicon.png" type="image/x-icon">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      #email-error + .form-control-feedback, #password-error  + .form-control-feedback{top: 0;}
      .form-group label.error, .error {
    font-size: 12px;
    line-height: 18px;
    padding: 0 12px;
    min-height: auto;
    background: #c00;
    color: #fff;
    margin: 0;
    width: auto;
    border: none;
    border-radius: 0;
    display: inline-block;
    vertical-align: top;
    position: relative;
    top: 100%;
    left: 0;
  }
  .error:before {
    content: "";
    position: absolute;
    bottom: 100%;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 7px 7px 7px;
    border-color: transparent transparent #cc0000 transparent;
  }

  </style>

  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">Admin Login</div>
      <div class="login-box-body">
        <p class="login-box-msg">Sign In</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php } ?>
        
        <form id="login-form" action="<?php echo base_url() ?>admin/login/loginprocess" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- <div class="col-sm-12"><div class="checkbox icheck">
                <label>
                  <input style="margin-left: 0; margin-right: 4px;" type="checkbox"> Remember Me
                </label>
              </div> 
            </div> -->
            <div class="col-xs-8">      
              <a href="<?php echo base_url() ?>admin/forgot-password">Forgot Password</a>                   
            </div><!-- /.col -->
            <div class="col-xs-4">  
                 
                <input type="submit" id="loginBtn" class="btn btn-primary btn-block btn-flat" value="Sign In" /> 
            </div><!-- /.col -->
          </div>
        </form>

        
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    
  </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/form_validation.js"></script>


