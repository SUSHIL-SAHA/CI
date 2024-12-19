
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title><?php echo (isset($sitetitle)) ? $sitetitle : 'CI Skeleton - Admin dashboard';?></title>
	
  <!-- Favicons-->
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/front/images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="#">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="#">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="#">

  <!-- CSS only -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <style>
    .form-gap { padding-top: 70px; }
    .error{
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      font-size: 12px;
      color: white;
      line-height: normal;
      background: red; 
      padding: 0 10px;
      border-radius: 3px;
    }
    .bttg{
      background-color: #FF6F02;
      border-color: #FF6F02;
    }
    .bttg {
      color: #fff;
      background-color: #FF6F02;
      border-color: #FF6F02;
    }
    .bttg:hover {
      color: #fff;
      background-color: #FF6F02;
      border-color: #FF6F02;
    }
    .textbii{
      color: #FF6F02;
      text-align: center;
    }
    .fgotpwd{margin-top: 20px;}
    body{background: #FF6F02;}
    .lfooter, .lfooter a{color:#fff}
  </style>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
<div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><a href="<?php echo base_url()?>"><img class="logo.png" src="<?php echo base_url(). "uploads/sitesettings_image/".site_settings_data('logo_image');?>" alt="ln-service"></a></h3>
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
                  <h2 class="textbii">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="forgot-password-form" action="<?php echo base_url()?>admin/resetpassowrd" role="form" autocomplete="off" class="form" method="post">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block bttg" value="Reset Password" type="submit">
                        <div class="fgotpwd"><a href="<?php echo base_url() ?>admin/login">Back to Login</a></div>
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
<footer class="sticky-footer">
      <div class="container">
        <div class="text-center lfooter">
        <small> © <?php echo date('Y');?> Admin Panel All Rights Reserved. Designed &amp; Developed by <a href="http://www.eclicksoftwares.com/" rel="noopener noreferrer nofollow" target="_blank" title="Eclick Softwares &amp; Solutions Pvt. Ltd.">Eclick Softwares &amp; Solutions Pvt. Ltd.</a></small>
        </div>
      </div>
    </footer>
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/form_validation.js"></script>
</body>
</html>

