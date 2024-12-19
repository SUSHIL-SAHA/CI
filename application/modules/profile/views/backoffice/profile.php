<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">My profile</li>
        </ol>
        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-user"></i>Profile details</h2>
            </div>
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

            <div class="row">
                <div class="col-md-4">
                    <?php 
                        $change_password_error = $this->session->flashdata('change_password_error');
                        if($change_password_error) {
                          ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('change_password_error'); ?>
                    </div>
                    <?php 
                        } 

                        $change_password_success = $this->session->flashdata('change_password_success');
                        if($change_password_success) { 
                          ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('change_password_success'); ?>
                    </div>
                    <?php 
                        } 
                        ?>
                    <div class="box_general padding_bottom adm-box">
                        <div class="header_box version_2">
                            <h4><i class="fa fa-lock"></i>Change password</h4>
                        </div>
                        <form id="change_password_form_id" action="<?php echo base_url(); ?>admin/change-password"
                            method="post">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <div class="form-group">
                                <!-- <label>Old password</label> -->
                                <input class="form-control" name="old_pass" type="password" placeholder="Old password">
                            </div>
                            <div class="form-group">
                                <!-- <label>New password</label> -->
                                <input class="form-control" id="new_pass" name="new_pass" type="password" placeholder="New password">
                            </div>
                            <div class="form-group">
                                <!-- <label>Confirm new password</label> -->
                                <input class="form-control" name="confirm_pass" type="password" placeholder="Confirm new password">
                                <br clear="all">
                                <input style="float:left;" type="submit" name="submit" class="btn btn-primary"
                                    value="Change Password" />
                                <br clear="all">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box_general padding_bottom adm-box">
                        <div class="header_box version_2">
                            <h4><i class="fa fa-user"></i>Update Details</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4">                                
                                <div class="form-group">
                                    <?php if($admin_details->user_profile_pic != '') {  ?>
                                    <div class="coverImage">
                                        <img id="profile_pic_image" style="width:220px; height:220px;"
                                            src="<?php echo SITE_URL ?>uploads/profile_pictures/<?php echo $admin_details->user_profile_pic ;?>"
                                            prev-data-src="<?php echo base_url() ?>uploads/profile_pictures/<?php echo $admin_details->user_profile_pic ;?>"
                                            alt="">
                                        <form style="display:none;" enctype="multipart/form-data" id="dropzone"
                                            action="<?php echo base_url() ?>admin/profile/submitUserPic" class="dropzone">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                                value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        </form>
                                        <button style="margin-top:10px;margin-left:30px;display:none;" class="btn btn-info btn-xs"
                                            onclick="remove_profile_picture()">Remove Image</button>
                                        <button style="margin-top:10px;margin-left:30px;"
                                            class="btn btn-warning btn-xs change-user-pic">Change Image</button>
                                    </div>
                                    <?php  }  else  { ?>
                                    <div class="coverImage">
                                        <form enctype="multipart/form-data"
                                            action="<?php echo base_url() ?>admin/profile/submitUserPic" class="dropzone">
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                                value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                        </form>
                                    </div>
                                    <?php  }  ?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form role="form" id="editAdmin" action="<?php echo base_url(); ?>admin/profile/updateuserdetails"
                                    method="post" role="form">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                        value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name </label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo ($admin_details->first_name!= "") ? $admin_details->first_name : '';?>"
                                                        id="fname" name="fname">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last name</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo ($admin_details->last_name != "") ? $admin_details->last_name : '';?>"
                                                        id="lname" name="lname">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                                        value="<?php echo ($admin_details->phone != "") ? $admin_details->phone : '';?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" name="email" id="email"
                                                        value="<?php echo ($admin_details->email != "") ? $admin_details->email : '';?>"
                                                        disabled="disabled">
                                                    <input type="hidden" name="hidden_email_id"
                                                        value="<?php echo ($admin_details->email != "") ? $admin_details->email : '';?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_general-->

        <div class="row">



            <!--<div class="col-md-6">
        <div class="box_general padding_bottom">
          <div class="header_box version_2">
            <h2><i class="fa fa-envelope"></i>Change email</h2>
          </div>
          <div class="form-group">
            <label>Old email</label>
            <input class="form-control" name="old_email" id="old_email" type="email">
          </div>
          <div class="form-group">
            <label>New email</label>
            <input class="form-control" name="new_email" id="new_email" type="email">
          </div>
          <div class="form-group">
            <label>Confirm new email</label>
            <input class="form-control" name="confirm_new_email" id="confirm_new_email" type="email">
          </div>
        </div>
      </div>-->
        </div>
        <!-- /row-->
        <!--<p><a href="#0" class="btn_1 medium">Save</a></p>-->
    </div>
    <!-- /.container-fluid-->
</div>
<script>
// Add restrictions
function remove_profile_picture() {
    $("#profile_pic_image").hide();
    $("#dropzone").show();
}
</script>
