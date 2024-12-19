<?php
$fieldID                = "";
$extraFieldTitle        = "";
$extraFieldName         = "";
$field_type             = "";
$extraFieldOptionLabel  = "";
$extraFieldOptionValue  = "";
$page_id                = "";
$action                 = "add";
$headingText            = "Add Custom Field";
if(isset($customFieldDetails)){
  $action           = "edit";
  $headingText      = "Edit Custom Field";
  $fieldID          = $customFieldDetails['id'];
  $field_title      = $customFieldDetails['field_title'];
  $field_type       = $customFieldDetails['field_type'];
  $fieldStatus      = $customFieldDetails['status'];
  $pageID           = $customFieldDetails['page_id'];
}
// echo "<pre>"; print_r($page_lists); echo "</pre>";
?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/cms/custom-fields">Custom Fields</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $headingText;?></li>
    </ol>
    <div class="box_general padding_bottom">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="header_box version_2">
              <h2><i class="fa fa-file"></i><?php echo $headingText;?></h2>
              <a class="btn btn-primary btn-md pull-right" href="<?php echo base_url(); ?>admin/cms/custom-fields"><i class="fa fa-level-up"></i> Back to list</a>
            </div><!-- /.box-header -->
            <!-- form start -->
            <br clear="all">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="AddEditCMSPage" action="<?php echo base_url(); ?>admin/cms/alterCustomField" method="post" role="form" enctype="multipart/form-data">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
                <div class="row">
                  <div class="col-md-3">                                
                    <div class="form-group">
                      <label for="pageID">Select Page <span style="color:red;">*</span></label>
                      <select class="form-control" name="pageID" id="pageID">
                        <option value="">Select Page</option>
                        <?php foreach($cmsList as $cmsPage) { ?>
                        <option <?php echo ($cmsPage['pageID'] != '' && $cmsPage['pageID'] == $pageID) ? ' selected="selected"' : '';?> value="<?php echo $cmsPage['pageID']; ?>"><?php echo $cmsPage['pageName']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">                                
                    <div class="form-group">
                      <label for="fieldTitle">Field Title <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" id="fieldTitle" name="fieldTitle"  value="<?php echo $field_title;?>">
                    </div>
                  </div>
                  <div class="col-md-3">                                
                    <div class="form-group">
                      <label for="fieldType">Field Type  <span style="color:red;">*</span></label>
                      <select class="form-control" id="fieldType" name="fieldType">
                        <option value="">Select Field Type</option>
                        <option value="textinput" <?php echo ($field_type == 'textinput') ? 'selected' : '';?>>Text</option>
                        <option value="textarea" <?php echo ($field_type == 'textarea') ? 'selected' : '';?>>Textarea</option>
                        <option value="image" <?php echo ($field_type == 'image') ? 'selected' : '';?>>Image</option>
                        <option value="file" <?php echo ($field_type == 'file') ? 'selected' : '';?>>File</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">                                
                    <div class="form-group">
                      <label for="fieldStatus">Status <span style="color:red;">*</span></label>
                      <select class="form-control" name="fieldStatus" id="fieldStatus">
                        <option <?php echo ($fieldStatus != '' && $fieldStatus == 'active') ? ' selected="selected"' : '';?> value="active">Active</option>
                        <option <?php echo ($fieldStatus != '' && $fieldStatus == 'inactive') ? ' selected="selected"' : '';?> value="inactive">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <input type="hidden" name="action" value="<?php echo $action;?>">
                <?php if($fieldID != '') { ?>
                <input type="hidden" name="fieldID" value="<?php echo $fieldID;?>">
                <?php } ?>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                <input type="button" onclick="location.href='<?php echo base_url();?>admin/cms/custom-fields';" class="btn btn-default" value="Cancel" />
                <p><span style="color:red;">*</span> fields are mandatory.</p>
              </div>
            </form>
          </div>
        </div>
      </div>    
    </div>
  </div>
</div>