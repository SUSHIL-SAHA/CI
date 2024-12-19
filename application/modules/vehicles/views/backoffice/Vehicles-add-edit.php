<?php
$vehicleName = "";
$vehicleImage = "";
$vehicleStatus = "";
$vehicleShowInFrontend = "";
$vehicleImage = "";
$vehicleDescription = "";
$headingText = "Add Vehicle";
$action = "add";
$vehicleId = "";
if (isset($vehicles_details)) {
  $vehicleName = $vehicles_details["vehicle_name"];
  $vehicleStatus = $vehicles_details["vehicle_status"];
  $vehicleShowInFrontend = $vehicles_details["show_in_front"];
  $vehicleImage = $vehicles_details["vehicle_image"];
  $vehicleDescription = $vehicles_details["vehicle_content"];
  $headingText = "Edit Vehicle";
  $action = "edit";
  $vehicleId = $vehicles_details["id"];
}
?>
<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/vehicles/vehicles-list">Vehicles</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $headingText; ?></li>
    </ol>
    <div class="box_general padding_bottom">
      <?php
        $error = $this->session->flashdata("error");
        if ($error) {
          ?>
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata("error"); ?>
      </div>
          <?php
        }
        $success = $this->session->flashdata("success");
        if ($success) {
          ?>
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata("success"); ?>
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
              <h2><i class="fa fa-plus"></i><?php echo $headingText; ?></h2>
              <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>admin/vehicles/vehicles-list"><i class="fa fa-level-up"></i> Back to list</a>
            </div><!-- /.box-header -->
            <!-- form start -->
            <br clear="all">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="AddEditvehiclesId" action="<?php echo base_url(); ?>admin/vehicles/alterVehicle" method="post" role="form" enctype="multipart/form-data">
              <input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4 vehicle-name">
                    <div class="form-group">
                      <label for="vehicleName">Vehicle Name <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $vehicleName; ?>" id="vehicleName" name="vehicle_name" />
                    </div>
                  </div>
                  <div class="col-md-4 vehicle-status">
                    <div class="form-group">
                      <label for="blogCategory">Vehicle Status</label>
                      <label for="vehicle_status"><input type="radio" name="vehicle_status" value="1" <?php if($vehicleStatus == "" || $vehicleStatus == "1"){ echo "checked"; } ?>>Active</label>
                      <label for="vehicle_status"><input type="radio" name="vehicle_status" value="0" <?php if($vehicleStatus == "0"){ echo "checked"; } ?>> Inactive</label>
                    </div>
                  </div>
                  <div class="col-md-4 vehicle-show-in-front">
                    <div class="form-group">
                      <label for="blogName">Show in Frontend <span style="color:red"> *</span></label>
                      <label for="vehicle_status"><input type="radio" name="show_in_front" value="1" <?php if($vehicleShowInFrontend == "" || $vehicleShowInFrontend == "1"){ echo "checked"; } ?>> Yes</label>
                      <label for="vehicle_status"><input type="radio" name="show_in_front" value="0" <?php if($vehicleShowInFrontend == "0"){ echo "checked"; } ?>> No</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 vehicle-image">
                    <div class="form-group">
                      <label for="vehicle_image" style="display:block">Vehicle image (500 X 500 )<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="vehicle_image" id="vehicle_image" />
                      <input type="hidden" name="hiddenvehicle_image" id="hiddenvehicle_image" value="<?php echo $vehicleImage; ?>">
                      <?php if ($vehicleImage != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/vehicle_image/' . $vehicleImage; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-8 vehicle-content">
                    <div class="form-group">
                      <label for="blogName">Description <span style="color:red"> *</span></label>
                      <textarea id="other_content" name="vehicle_content" class="form-control"><?php echo $vehicleDescription; ?></textarea>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="action" value="<?php echo $action; ?>">
                <?php if ($vehicleId != "") { ?>
                  <input type="hidden" name="vehicleId" value="<?php echo $vehicleId; ?>">
                <?php } ?>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/vehicles/vehicles-list">Cancel</a>
                <p><span style="color:red">*</span> fields are mandatory.</p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                  