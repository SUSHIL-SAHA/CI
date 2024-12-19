<?php
$fieldID                = "";
$extraFieldTitle       = "";
$extraFieldName        = "";
$field_type           = "";
$extraFieldOptionLabel = "";
$extraFieldOptionValue = "";
$page_id                = "";
$action                = "add";
if(isset($extraFieldDetails)){
  $fieldID          = $extraFieldDetails['id'];
  $extraFieldTitle = $extraFieldDetails['field_title'];
  $extraFieldName  = $extraFieldDetails['meta_key'];
  $field_type     = $extraFieldDetails['field_type'];
  $page_id     = $extraFieldDetails['page_id'];
  $action          = "edit";
}
// echo "<pre>"; print_r($page_lists); echo "</pre>";
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <i class="fa fa-book"></i> CMS Extra Fields
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
        <div class="col-xs-12 text-right">
            <div class="form-group">
              <a class="btn btn-primary" href="<?php echo base_url();?>administrator/listExtraFields">Back To List</a>
            </div>
        </div>
    </div>
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
              <h3 class="box-title">Add / Edit Extra Field</h3>
             
          </div><!-- /.box-header -->
          <!-- form start -->
          <?php $this->load->helper("form"); ?>
          <form role="form" id="AddCMSExtraOptions" action="<?php echo base_url(); ?>administrator/savePageExtraField" method="post">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4 package-frontend-label">                                
                  <div class="form-group">
                      <label for="package_option_frontend_label">Select Page</label>
                      <select class="form-control" id="page_id" name="page_id">
                        <option value="">Select Page</option>
                        <?php 
                          if(!empty($pageList)){
                            foreach($pageList as $pList){
                              ?>
                              <option value="<?php echo $pList['page_id'];?>" <?php echo ($page_id == $pList['page_id']) ? 'selected' : '';?>><?php echo $pList['page_name'];?></option>
                              <?php
                            }
                          }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="col-md-4 package-frontend-label">                                
                  <div class="form-group">
                      <label for="package_option_name">Field Title</label>
                      <input type="text" class="form-control" value="<?php echo $extraFieldTitle;?>" id="field_title" name="field_title">
                  </div>
                </div>
                <input type="hidden" class="form-control" value="<?php echo $extraFieldName;?>" id="meta_key" name="meta_key">
                <div class="col-md-4 package-type">                                
                  <div class="form-group">
                      <label for="package_type">Field Type</label>
                      <select class="form-control" id="field_type" name="field_type">
                        <option value="">Select Field Type</option>
                        <option value="textinput" <?php echo ($field_type == 'textinput') ? 'selected' : '';?>>Textinput</option>
                        <option value="textarea" <?php echo ($field_type == 'textarea') ? 'selected' : '';?>>Textarea</option>
                        <option value="image" <?php echo ($field_type == 'image') ? 'selected' : '';?>>Image</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row add-select-box-text-area" style="display:none;">
                <div class="col-sm-12">
                  <h3>Selectbox Fields</h3>
                </div>
                <div class="col-sm-12">
                  <div class="select-box-field-options" id="select-box-field-options">
                    <div class="row area-select-box-options" id="makeInc">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="field_option_label">Field Option Label</label>
                            <input type="text" class="form-control" id="extra_field_option_label1" name="extra_field_option_label[]" />
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="package_option_value">Field Option Values</label>
                            <input type="text" class="form-control" id="extra_field_option_value1" name="extra_field_option_value[]" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="button" class="btn btn-primary btn-add-select-box-options" id="btn-add-select-box-options" value="Add Fields" onclick="addMoreRows();" />
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <input type="hidden" name="field_id" value="<?php echo $fieldID;?>">
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
              <input type="button" class="btn btn-default" value="Cancel" onclick="location.href='<?php echo base_url();?>administrator/listExtraFields'" />
            </div>
          </form>
        </div>
      </div>
    </div>    
  </section>
</div>