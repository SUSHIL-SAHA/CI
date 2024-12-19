<style type="text/css">
.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Communication Settings</li>
        </ol>
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
        <div class="box_general padding_bottom site-setting-area">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="communication-setting-id"
                action="<?php echo base_url(); ?>admin/communication/settinginsert" method="post" role="form"
                enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>" />

                <div class="row">
                    <div class="col-md-6">
                        <div class="sectionwarp">
                            <div class="sectionform">
                                <div class="card-title">
                                    <h2>Contact Form</h2>
                                    <label class="switch">
                                        <input name="contact_form" id="contact_form"
                                            <?php if($setting_details->contact_form=='on') { echo "checked" ; } ?>
                                            type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="sectionform">
                                <div class="form-group">
                                    <label for="cat_name">Form Heading</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $setting_details->form_heading ; ?>" id="form_heading"
                                        name="form_heading">
                                </div>
                            </div>

                            <div class="sectionform">
                                <div class="form-group">
                                    <label for="cat_name">Success Message</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $setting_details->success_msg ; ?>" id="success_msg"
                                        name="success_msg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sectionwarp">
                            <div class="sectionform">
                                <div class="card-title">
                                    <h2>Google reCaptcha V3</h2>
                                    <label class="switch">
                                        <input name="google_recaptcha_on"
                                            <?php if($setting_details->google_recaptcha_on=='on') { echo "checked" ; } ?>
                                            id="google_recaptcha_on" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="sectionform">
                                <div class="form-group">
                                    <label for="cat_name">Site Key</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $setting_details->site_key ; ?>" id="site_key" name="site_key">
                                </div>
                            </div>
                            <div class="sectionform">
                                <div class="form-group">
                                    <label for="cat_name">Secret Key</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $setting_details->secret_key ; ?>" id="secret_key"
                                        name="secret_key">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="sectionwarp">
                            <div class="sectionform">
                                <div class="card-title">
                                    <h2>Email Configuration & Template</h2>
                                </div>
                            </div>
                            <div class="sectionform">
                                <div class="form-group">
                                    <label for="cat_name">Email Subject <span>*</span> </label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $setting_details->email_subject ; ?>" id="email_subject"
                                        name="email_subject">
                                </div>
                                <div class="form-group">
                                    <label for="cat_name">Email Template <span>*</span> </label>
                                    <textarea class="form-control" name="email_template"
                                        id="content"><?php echo $setting_details->email_template ; ?></textarea>
                                    <br />
                                    <div class="alert alert-info">Do not change these variables: {name}, {email},
                                        {phone}, {comments}.</div>
                                    <input type="hidden" name="contact_setting_id" value="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sectionwarp">
                            <div class="sectionform">
                                <div class="card-title">
                                    <h2>Google Map</h2>
                                    <label class="switch">
                                        <input name="google_map_on"
                                            <?php if($setting_details->google_map_on=='on') { echo "checked" ; } ?>
                                            id="google_map_on" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="sectionform">
                                <div class="form-group">
                                    <label for="cat_name">Address</label>
                                    <textarea name="contact_address" id="contact_address" rows="10"
                                        style="width: 100%;"><?php echo $setting_details->contact_address ; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sectionwarp">
                            <div class="sectionform">
                                <div class="form-group">
                                    <label for="cat_name">To <span>*</span></label>
                                    <input type="email" class="form-control"
                                        value="<?php echo $setting_details->to_mail ; ?>" id="to_mail" name="to_mail">
                                </div>
                                <div class="form-group">
                                    <label for="cat_name">Cc <span>*</span></label>
                                    <input type="email" class="form-control"
                                        value="<?php echo $setting_details->cc_mail ; ?>" id="cc_mail" name="cc_mail">
                                </div>
                                <div class="form-group">
                                    <label for="cat_name">Bcc</label>
                                    <input type="email" class="form-control"
                                        value="<?php echo $setting_details->bcc_mail ; ?>" id="bcc_mail" name="bcc_mail">
                                </div>
                                <div class="form-group">
                                    <label for="cat_name">No-reply Email <span>*</span></label>
                                    <input type="email" class="form-control"
                                        value="<?php echo $setting_details->no_reply_email ; ?>" id="no_reply_email"
                                        name="no_reply_email">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                      <?php
                      if($userPermission['edit'])
                      {
                        ?>
                      <input type="hidden" name="action" value="add">
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                      <?php
                    }
                    ?>
                  </div>
                </div>
            </form>
        </div>
    </div>
</div>