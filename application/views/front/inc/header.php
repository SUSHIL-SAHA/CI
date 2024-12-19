<?php
  $uriSegment = $this->uri->segment(1);
  // exit();
?>
<!doctype html>
<html lang="en">
  <head> 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($metaTitle) ? $metaTitle : site_settings_data('site_title');?></title>
    <meta name="Title" content="<?php echo $metaTitle; ?>" />
    <meta name="description" content="<?php echo $metaKeyword; ?>" />
    <meta name="keywords" content="<?php echo $metaDescription; ?>" />
    <link rel="canonical" href="<?php echo current_url(true);?>" />

    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>assets/front/images/favicon.ico">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/jquery.timepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/style1.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/responsive.css">
  </head>
  <body class="<?php echo $uriSegment == '' ? 'homeClass' : ''; ?>">
    <div class="bodyOverlay"></div>
    <div class="responsive_nav"></div> 
      <!-- header section html starts from here-->
    <header>
      <section class="header-section">
          <div class="container">
            <div class="row row-bg">
              <div class="col-4 col-sm-3 col-lg-2 left_part_wrap">
                  <div class="left-side">
                      <a href="<?php echo base_url()?>"><img class="logo.png" src="<?php echo base_url(). "uploads/sitesettings_image/".site_settings_data('logo_image');?>" alt="ln-service"></a>
                  </div>
              </div>
              <div class="col-8 col-sm-9 col-lg-10 divider right_part_wrap">
                  <div class="htop">
                      <div class="left_part">
                          <ul>
                              <li><a href="tel:<?php echo site_settings_data('helpline_no');?>"><i class="fa fa-phone" aria-hidden="true"></i><span><?php echo site_settings_data('helpline_no');?></span></a></li>
                              <li><a href="tel:<?php echo site_settings_data('another_helpline_no');?>"><i class="fa fa-phone desktop" aria-hidden="true"></i><span><?php echo site_settings_data('another_helpline_no');?></span></a></li>
                          </ul>
                      </div>
                      <!-- <div class="right_part">
                          <ul class="btn_wrapper">
                              <li><i class="fa fa-map-marker" aria-hidden="true"></i><span><?php // echo site_settings_data('address');?></span></li>
                               <li class="nav-item">
                              <a class="nav-link button btn" href="#"><i class="fa fa-headset"></i>Customer support</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link button btn" href="#"><i class="fa fa-thumb-tack"></i>Live tracking</a>
                            </li> 
                          </ul>
                      </div> -->
                      <span class="responsive_btn"><span></span></span> 
                  </div>
                  <div class="hbottom">
                    <nav class="navbar navbar-expand-lg navbar-light">
                      <div class="container-fluid">
                        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span> -->
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a aria-current="page" href="<?php echo base_url()?>" class="<?php if($this->uri->uri_string() == '') { echo 'active';} ?>">Home</a>
                            </li>
                            <li class="nav-item">
                              <a href="<?php echo base_url()?>about-us" class="<?php if($this->uri->uri_string() == 'about-us') { echo 'active';} ?>">About</a>
                            </li>
                            <?php foreach (service() as $key => $servicesss) {?>
                            <li class="nav-item">
                              <a class="<?php if($this->uri->uri_string() == 'service/'.$servicesss['service_slug']) { echo 'active';} ?>" href="<?php echo base_url().'service/'.$servicesss['service_slug'];?>"><?php echo $servicesss['service_title'];?></a>
                            </li>
                            <?php }?>
                            <li class="nav-item dropdown">
                                <a class="nav-link <?php foreach (suburb_category_data() as $key => $valuess) { if($this->uri->uri_string() == 'location/'.$valuess['suburb_slug']) { echo 'active';} }?>"  role="button" data-bs-toggle="dropdown" aria-expanded="false">Location
                                </a>
                                <ul class="dropdown-menu">
                                  <?php  
                                    foreach (suburb_category_data() as $key => $value) {
                                    $location_data = suburb_datas($value['suburb_id']);
                                  ?>
                                  <li class="dropdown thirdlevelmenu"><a class="dropdown-item <?php  foreach ($location_data as $key => $locvall) { if($this->uri->uri_string() == 'location/'.$locvall['suburb_slug'].'/'.$locvall['locations_slug']) { echo 'current-menu';} } 
                                   if($this->uri->uri_string() == 'location/'.$value['suburb_slug']) { echo 'current-menu';}?>" href="<?php echo base_url().'location/'.$value['suburb_slug'];?>"><?php echo $value['suburb_title'];?></a>
                                  <ul class="dropdown-submenu">
                                  <?php 
                                    //print_r($location_data); exit;
                                    foreach ($location_data as $key => $locval) {
                                    ?>
                                    <li><a class="<?php if($this->uri->uri_string() == 'location/'.$locval['suburb_slug'].'/'.$locval['locations_slug']) { echo 'current-menu';} ?>" href="<?php echo base_url().'location/'.$locval['suburb_slug'].'/'.$locval['locations_slug'];?>" class="subdropdown-item"><?php echo $locval['locations_manu'];?></a> </li>
                                    <?php }?>
                                  </ul>
                                </li>
                                  <?php } ?>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link <?php foreach (other_service() as $key => $rows) { if($this->uri->uri_string() == 'service/'.$rows['service_slug']) { echo 'active';} }?>"  role="button" data-bs-toggle="dropdown" aria-expanded="false">Other Service
                                </a>
                                <ul class="dropdown-menu">
                                  <?php  
                                    foreach (other_service() as $key => $osvalue) {
                                  ?>
                                  <li><a class="dropdown-item <?php if($this->uri->uri_string() == 'service/'.$osvalue['service_slug']) { echo 'current-menu';}?>" href="<?php echo base_url().'service/'.$osvalue['service_slug'];?>"><?php echo $osvalue['service_title'];?></a></li>
                                  <?php } ?>
                                </ul>
                            </li>
                            <!-- <li class="nav-item">
                              <a class="nav-link" href="#">location</a>
                            </li> -->
                            <li class="nav-item">
                              <a class="nav-link button"  href="<?php echo base_url()?>calculator">Cost calculator</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </nav>
                </div>
              </div>
            </div>
          </div>
      </section>
    </header>
 <!-- header section html ends here-->