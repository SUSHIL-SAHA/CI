<?php 
  $parent_module = '';
  $module_name = '';
  $font_awesome = '';
  $sort = '';
  $headingText = 'Add Plugin';
  $formID = 'AddPlugin';
  $action = 'add';
  $module_id = '';
  $fa_fa_icon = 'fa fa-plus';
  

  if(isset($plugins_details)){
    $parent_module = $plugins_details['parent_module'];
    $module_name = $plugins_details['module_name'];
    $font_awesome = $plugins_details['fontawesome'];
    $sort = $plugins_details['sort'];
    $headingText = 'Edit Plugin';
    $formID = 'EditPlugin';
    $action = 'edit';
    $module_id = $plugins_details['module_id'];
    $fa_fa_icon = 'fa fa pencil';
  }


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/plugins">Plugin</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $main_module_details['module_name'];?></li>
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
            <h2><i class="<?php echo $fa_fa_icon ; ?>"></i><?php echo $headingText;?></h2>
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/plugins/sub-plugin-list/<?php echo $main_module_details['module_id'] ; ?>"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="AddEditPluginformId" action="<?php echo base_url(); ?>admin/plugins/insert-sub-plugin" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">

                <div class="col-md-4">                                
                  <div class="form-group">
                      <label for="blogName"> Parent Module </label>
                      <select name="parent_module" id="parent_module" class="form-control">
                        <option value="">-- None --</option>
                        <?php if($pluginsList) { foreach($pluginsList as $row) { ?>
                        <option value="<?php echo $row['module_id'] ; ?>" <?php if($parent_module == $row['module_id']) { echo "selected" ; }?>><?php echo $row['module_name'] ; ?></option>
                        <?php } } ?>
                      </select>
                  </div>
                </div>

                <div class="col-md-4">                                
                  <div class="form-group">
                      <label for="blogName"> Module Name <span style="color:red"> *</span> </label>
                      <input type="text" class="form-control" value="<?php echo $module_name ; ?>" id="module_name" name="module_name">
                  </div>
                </div>

                <div class="col-md-4">                                
                  <div class="form-group">
                      <label for="blogName"> Font Awesome </label>
                      <input type="text" class="form-control" value="<?php echo $font_awesome ;?>" id="font_awesome" name="font_awesome">
                  </div>
                </div>

                <!-- <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="blogName"> Sort </label>
                      <input type="text" class="form-control" value="<?php echo $sort ;?>" id="sort" name="sort">
                  </div>
                </div> -->

                
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <?php if($module_id != '') { ?>
              <input type="hidden" name="module_id" value="<?php echo $module_id;?>">
              <?php } ?>
              <input type="hidden" name="main_module_id" value="<?php echo $main_module_details['module_id'] ; ?>">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/plugins/sub-plugin-list/<?php echo $main_module_details['module_id'] ; ?>';" class="btn btn-default" value="Cancel" />
              <p><span style="color:red">*</span> fields are mandatory.</p>
            </div>
          </form>
        </div>
      </div>
    </div>    
    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="myModalShowImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="max-width: 100%; height: 264px;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



