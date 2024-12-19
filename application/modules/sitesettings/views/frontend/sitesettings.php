<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>administrator">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Site Settings</li>
      </ol>
      <div class="box_general padding_bottom site-setting-area">
      <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Site Settings info</h2>
          </div><!-- /.box-header -->
          <!-- form start -->
          <?php 
              $error = $this->session->flashdata('error');
              if($error) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php 
              } 

              $success = $this->session->flashdata('success');
              if($success) { 
                ?>
                <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php 
              } 
              ?>
                <br clear="all">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="siteSettings" action="<?php echo base_url(); ?>sitesettings/siteSettingsAction" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="row">
                <div class="col-md-12">                                
                  <div class="form-group">
                      <label for="cat_name">Site Title</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['site_title'] ?>" id="site_title" name="site_title">
                  </div>
                </div>
                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">Currency</label>
                      <!--<input type="text" class="form-control" value="<?php echo $siteSettings['currency'] ?>" id="currency" name="currency">-->
                      <select class="form-control" name="currency" id="currency">
                        <option value="">Select Currency</option>
                        <?php 
                          foreach($getCurrency as $currency){
                            ?>
                            <option value="<?php echo $currency['id'];?>"<?php echo ($currency['id'] == $siteSettings['currency']) ? ' selected="selected"' : '';?>><?php echo $currency['currency'].'('.$currency['code'].')('.$currency['symbol'].')';?></option>
                            <?php
                          }
                        ?>
                      </select>
                  </div>
                </div>

                
                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">PayPal Email</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['paypal_email'] ?>" id="paypal_email" name="paypal_email">
                  </div>
                </div>
                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="cat_name">About Web Site</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['about_site'] ?>" id="about_site" name="about_site">
                  </div>
                </div>

            </div>
              
                 
            <h4>Contact info</h4>
            <br clear="all">
            <div class="row">
                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">Helpline No</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['helpline_no'] ?>" id="helpline_no" name="helpline_no">
                  </div>
                </div>

                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">Helpline Email Address</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['helpline_email_address'] ?>" id="helpline_email_address" name="helpline_email_address">
                  </div>
                </div>

                <div class="col-md-12">                                
                  <div class="form-group">
                      <label for="cat_name">Address</label>
                      <textarea class="form-control" value="" id="address" name="address"><?php echo $siteSettings['address'] ?></textarea>
                  </div>
                </div>
            </div>
            <br clear="all">
            <br clear="all">

            <h4>Social Media info</h4>
            <br clear="all">
            <div class="row">
                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">Facebook Link</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['facebook_link'] ?>" id="facebook_link" name="facebook_link">
                  </div>
                </div>

                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">Twitter Link</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['twitter_link'] ?>" id="twitter_link" name="twitter_link">
                  </div>
                </div>

                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">Instagram Link</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['instagram_link'] ?>" id="instagram_link" name="instagram_link">
                  </div>
                </div>

                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="cat_name">Youtube Link</label>
                      <input type="text" class="form-control" value="<?php echo $siteSettings['youtube_link'] ?>" id="youtube_link" name="youtube_link">
                  </div>
                </div>
            </div>

            <div class="box-footer">
              <input type="hidden" name="action" value="add">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
            </div>
          </form>
        </div>
      </div>
    </div>    
    </div>
  </div>
</div>