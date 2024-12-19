<?php 
  $headingText = 'Add Admin User';
  $formID = 'AddAdminUser';
  $action = 'add';
  $sectionhidden = false;
  if($id>0)
  {
  $headingText = 'Edit Admin User';
  $formID = 'EditAdminUser';
  $action = 'edit';
  $sectionhidden = true;
  }

?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/adminusers">Admin Users</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $headingText;?></li>
      </ol>
      <div class="box_general padding_bottom">
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
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="header_box version_2">
            <h2><i class="fa fa-plus"></i><?php echo $headingText;?></h2>
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/adminusers"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="<?php echo $formID;?>" action="<?php echo base_url(); ?>admin/adminusers/adduseraction" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <input type="hidden" name="action" value="<?php echo $action; ?>" />
            <?php
            if($id>0)
            {
              ?>
              <input type="hidden" name="userId" value="<?php echo $id; ?>" />
              <?php
            }
            ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="UserName">Name <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $users[0]['username'];?>" id="UserName" name="UserName">
                  </div>
                </div>
               <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="UserEmail">Email <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $users[0]['email'];?>" id="UserEmail" name="UserEmail">
                  </div>
                </div>
                <div class="col-md-6">                                
                  <div class="form-group">
                  <label for="Role">Role <span style="color:red"> *</span></label>
                      <select name="Role" id="Role" class="form-control">
                        <option value="">-- Select --</option>
                      <?php
                      if(is_array($Roles) && count($Roles)>0)
                      {
                        foreach($Roles as $rk=>$rv)
                        {
                          if($rv['id'] == $users[0]['role'])
                          {

                          }
                          ?>
                          <option value="<?php echo $rv['id'];?>" <?php echo ($rv['id'] == $users[0]['role'])?'selected':'';?>><?php echo $rv['role_name'];?></option>
                          <?php
                        }
                      }
                      ?>

                      </select>
                  </div>
                </div>
                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="UserPhone">Phone <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $users[0]['phone'];?>"  id="UserPhone" name="UserPhone">
                  </div>
                </div>
                <?php
                if($action == 'edit')
                {
                  ?>
                <div class="col-md-12">
                  <div class="form-group d-flex align-items-center">
                    <input type="checkbox" value="Y" name="checkchangepass" id="changepass">
                    <label style="flex-shrink:0; margin: 0 0 0 10px;" for="changepass">Change Password</label>
                  </div>
                </div>
                  <?php
                }
                ?>
                <div class="col-md-6 passwordsection" <?php echo ($sectionhidden)? 'style="display:none"':'';?>>                                
                  <div class="form-group pass-group">
                      <label for="UserPassword">Password <span style="color:red"> *</span></label> 
                      <!-- <input type="password" class="form-control" value="" id="UserPassword" name="UserPassword">
                      <a href="javascript: void(0);" style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#passwordsuggestion">Generate Password</a>
                      <div class="clearfix"></div> -->
                      <div class="row">
                        <div class="col-md-7"><input type="password" class="form-control" value="" id="UserPassword" name="UserPassword"></div>
                        <div class="col-md-5 text-right"><a href="javascript: void(0);" class="btn btn-primary generatepass">Generate Password</a></div>
                      </div>
                      
                      
                  </div>
                </div>
                <div class="col-md-6 passwordsection" <?php echo ($sectionhidden)? 'style="display:none"':'';?>>                                
                  <div class="form-group">
                      <label for="UserConfirmPassword">Confirm Password <span style="color:red"> *</span></label>
                      <input type="password" class="form-control" value="" id="UserConfirmPassword" name="UserConfirmPassword">
                  </div>
                </div>
                
                 

             
                

                <div class="col-md-6 blog-slug">                                
                  <div class="form-group" style="display:block;">
                      <label for="userStatus">Status</label>
                      <div style="display:flex; padding-top:5px">
                      <label for="activeuser" ><input type="radio" id="activeuser" name="userStatus" value="1"<?php echo ($users[0]['active'] == '' || $users[0]['active'] == 1) ? ' checked="checked"' : '';?>>Active</label>
                        <label for="inactiveuser" style="display:flex; padding-left:15px"><input id="inactiveuser" type="radio" name="userStatus" value="0"<?php echo ($users[0]['active'] == 0) ? ' checked="checked"' : '';?>> Inactive</label>
                      </div>
                      
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/adminusers';" class="btn btn-default" value="Cancel" />
              <p><span style="color:red">*</span> fields are mandatory.</p>
            </div>
          </form>
        </div>
      </div>
    </div>    
    </div>
  </div>
</div>

<!-- password suggestion modal -->
    <div class="modal fade" id="passwordsuggestion" tabindex="-1" role="dialog" aria-labelledby="passwordsuggestionLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Password Suggestion</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body passwordbody"><?php echo $generatedpassword;?></div>
          <div class="modal-footer">
            <a class="btn btn-primary regeneratepassword" href="javascript: void(0)">Regenerate</a>
            <a class="btn btn-primary selectpassword" href="javascript: void(0)">Select</a>
          </div>
        </div>
      </div>
    </div>
<script>
var images = [];
<?php
if($blogImage !='')
{
  $blogImgArr = explode(',',$blogImage);
  if(is_array($blogImgArr) && count($blogImgArr)>0)
  {
    foreach($blogImgArr as $val)
    {
      ?>
        images.push('<?php echo $val;?>');
      <?php
    }
  }
  
}
?>
</script>
