<?php 
  $headingText = 'Add Admin User Role';
  $formID = 'AddEditAdminUserRole';
  $action = 'add';
  $bannerId = '';
  

  if($role_id > 0){
    $headingText = 'Edit Admin User Role';
    $formID = 'AddEditAdminUserRole';
    $action = 'edit';
  }


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/adminusers">Admin Users</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/adminusers/userrole">Role</a>
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
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/adminusers/userrole"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="<?php echo $formID;?>" action="<?php echo base_url(); ?>admin/adminusers/addrole" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <?php
          if($role_id > 0)
          {
            ?>
            <input type="hidden" name="roleid" value="<?php echo $role_id;?>">
            <input type="hidden" name="action" value="edit">
            <?php
          }else{
            ?>
            <input type="hidden" name="action" value="add">
            <?php
          }
          ?>
          

            <div class="box-body">
              <div class="row">
                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="RoleName">Role Name <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $role_name;?>" id="RoleName" name="RoleName">
                  </div>
                </div>
                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="RoleName">Status</label>
                      <select name="status" id="" class="form-control">
                        <option value="1" <?php echo ($status == 1)? 'selected': '';?>>Active</option>
                        <option value="0" <?php echo ($status == 0)? 'selected': ''?>>Inactive</option>
                      </select>
                  </div>
                </div>
                <div class="col-md-9">                                
                  <div class="form-group">
                      <table class="table table-bordered">
                        <tr>
                          <th><input type="checkbox" id="checkall"></th>
                          <th>Module</th>
                          <th><input type="checkbox" id="checkadd"> Add</th>
                          <th><input type="checkbox" id="checkedit"> Edit</th>
                          <th><input type="checkbox" id="checkdelete"> Delete</th>
                          <th><input type="checkbox" id="checklist"> List</th>
                        </tr>
                        <?php
                        if(is_array($userpermissions) && count($userpermissions)>0)
                        {
                          foreach($userpermissions as $k=>$v)
                          {
                            $checkboxpermission = true;
                              if(is_array($v['inner']) && count($v['inner'])>0)
                              {
                                $checkboxpermission = false;
                              }
                            ?>
                            <tr>
                            <?php
                              if($checkboxpermission)
                              {
                              ?>
                              <td><input type="checkbox" <?php echo ($v['checked'] == 'on')?'checked="checked"':''; ?> class="mainpermission" name="mainpermission[<?php echo $k?>]"></td>
                              <?php
                              }else{
                                ?>
                                <td></td>
                                <?php
                              }
                              ?>
                              <td><?php echo $v['modulename']?></td>
                              <?php
                              if($checkboxpermission)
                              {
                              ?>
                              <td><input type="checkbox" class="addpermission" <?php echo ($v['add'] == 'on')?'checked="checked"':''; ?> name="add_<?php echo $k?>"></td>
                              <td><input type="checkbox" class="editpermission" <?php echo ($v['edit'] == 'on')?'checked="checked"':''; ?> name="edit_<?php echo $k?>"></td>
                              <td><input type="checkbox" class="deletepermission" <?php echo ($v['delete'] == 'on')?'checked="checked"':''; ?> name="delete_<?php echo $k?>"></td>
                              <td><input type="checkbox" class="listpermission" <?php echo ($v['list'] == 'on')?'checked="checked"':''; ?> name="list_<?php echo $k?>"></td>
                              <?php
                              }else{
                                ?>
                                <td colspan="4"></td>
                                <?php
                              }
                              ?>

                            </tr>
                            <?php
                            if(is_array($v['inner']) && count($v['inner'])>0)
                            {
                              foreach($v['inner'] as $innerk=>$innerv)
                              {
                                ?>
                                <tr>
                                  <td><input type="checkbox" class="mainpermission" <?php echo ($innerv['checked'] == 'on')?'checked="checked"':''; ?> name="mainpermission[<?php echo $k?>][sub][<?php echo $innerk?>]"></td>
                                  <td><?php echo $innerv['modulename']?></td>
                                  <td><input type="checkbox" class="addpermission" <?php echo ($innerv['add'] == 'on')?'checked="checked"':''; ?> name="add_<?php echo $k?>_<?php echo $innerk?>"></td>
                                  <td><input type="checkbox" class="editpermission" <?php echo ($innerv['edit'] == 'on')?'checked="checked"':''; ?> name="edit_<?php echo $k?>_<?php echo $innerk?>"></td>
                                  <td><input type="checkbox" class="deletepermission" <?php echo ($innerv['delete'] == 'on')?'checked="checked"':''; ?> name="delete_<?php echo $k?>_<?php echo $innerk?>"></td>
                                  <td><input type="checkbox" class="listpermission" <?php echo ($innerv['list'] == 'on')?'checked="checked"':''; ?> name="list_<?php echo $k?>_<?php echo $innerk?>"></td>
                              </tr>
                                <?php
                              }
                            }
                          }
                        }
                        ?>
                      </table>
                  </div>
                </div>
                 
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/adminusers/userrole';" class="btn btn-default" value="Cancel" />
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