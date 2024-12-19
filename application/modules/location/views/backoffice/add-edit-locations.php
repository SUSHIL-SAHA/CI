<?php
$suburb = '';
// $parent_category = '';
$locations_title = '';
$locations_manu = '';
$locations_description = '';
$location_description1='';
$location_description2="";
$location_description3="";
$location_description4="";
$locations_status = '';
$image = '';
$image2 = '';
$ServiceShortDescription = '';
$map_link = '';
$metaTitle   = '';
$metaKeyword =  '';
$metaDescription = '';
$headingText = 'Add location';
$formID = 'Addlocation';
$action = 'add';
$locations_id = '';


if (isset($locations_details)) {
  $suburb = $locations_details['suburb'];
  // $parent_category = $locations_details['parent_category'];
  $locations_title = $locations_details['locations_title'];
  $locations_manu = $locations_details['locations_manu'];
  $ServiceShortDescription =$locations_details['ServiceShortDescription'];
  $map_link = $locations_details['map_link'];
  $locations_description = $locations_details['locations_description'];
  $location_description1 = $locations_details['location_description1'];
  $location_description2 = $locations_details['location_description2'];
  $location_description3 = $locations_details['location_description3'];
  $location_description4 = $locations_details['location_description4'];
  $locations_status = $locations_details['locations_status'];
  $image = $locations_details['image'];
  $logo_image = $locations_details['logo_image'];
  $image2 = $locations_details['image2'];
  $metaTitle   = $locations_details['metaTitle'];
  $metaKeyword = $locations_details['metaKeyword'];
  $metaDescription = $locations_details['metaDescription'];
  $locations_slug = $locations_details['locations_slug'];
  $headingText = 'Edit location';
  $formID = 'Editlocations';
  $action = 'edit';
  $locations_id = $locations_details['locations_id'];
}


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/location/location-list">location</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $headingText; ?></li>
    </ol>
    <div class="box_general padding_bottom">
      <?php
      $error = $this->session->flashdata('error');
      if ($error) {
      ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php
      }

      $success = $this->session->flashdata('success');
      if ($success) {
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
              <h2><i class="fa fa-plus"></i><?php echo $headingText; ?></h2>
              <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>admin/location/locations"><i class="fa fa-level-up"></i> Back to list</a>
            </div><!-- /.box-header -->
            <!-- form start -->
            <br clear="all">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="AddEditlocations_id" action="<?php echo base_url(); ?>admin/location/locationsInsert" method="post" role="form" enctype="multipart/form-data">
              <input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
                <div class="row">

                  <div class="col-md-4 blog-name">
                    <div class="form-group">
                      <label for="blogName">Choose suburb <span style="color:red"> *</span></label>
                      <select class="form-control category" id="suburb" name="suburb">
                        <option value="">Select suburb</option>
                        <?php foreach ($suburb_details as $row) { ?>
                          <option value="<?php echo $row->suburb_id; ?>" <?php if ($row->suburb_id == $suburb) {
                                                                            echo "selected";
                                                                          } ?>><?php echo $row->suburb_title; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <!-- <div class="col-md-4 blog-name">
                    <div class="form-group">
                      <label for="blogName">Choose Parrent Category</label>
                      <select class="form-control" id="parent_category" name="parent_category">
                        <option value="">Select Parrent Category</option>
                        <?php if (count($parent_categoris) > 0) {
                          foreach ($parent_categoris as $row) {
                        ?>
                            <option value="<?php echo $row->categoryId; ?>" <?php if ($row->categoryId == $parent_category) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $row->category_title; ?></option>
                        <?php }
                        } ?>

                      </select>
                    </div>
                  </div> -->

                  <div class="col-md-4 blog-name">
                    <div class="form-group">
                      <label for="blogName">Title <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $locations_title; ?>" id="locations_title" name="locations_title">
                    </div>
                  </div>
                  <?php if($locations_slug){?>
                  <div class="col-md-4 blog-name">
                    <div class="form-group">
                      <label for="blogName">Location Slug</label>
                      <input type="text" class="form-control" value="<?php echo $locations_slug; ?>" id="locations_slug" name="locations_slug">
                    </div>
                  </div>
                  <?php }?>
                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Manu Name<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $locations_manu; ?>" id="locations_manu" name="locations_manu">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">Location Image<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="logo_image" id="logo_image" />
                      <input type="hidden" name="hiddenlogo_image" id="hiddenlogo_image" value="<?php echo $logo_image; ?>">
                      <?php if ($logo_image != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/locations_image/' . $logo_image; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>
                  <!-- <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Service Price<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $map_link; ?>" id="map_link" name="map_link">
                    </div>
                  </div> -->
                  <!-- <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Short Description<span style="color:red"> *</span></label>
                      <textarea class="form-control" value="" id="ServiceShortDescription" name="ServiceShortDescription"><?php echo $ServiceShortDescription; ?></textarea>
                    </div>
                  </div> -->
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName">Description1 <span style="color:red"> *</span></label>
                      <textarea id="other_content" name="locations_description" class="form-control"><?php echo $locations_description; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName"> Description2 <span style="color:red"> *</span></label>
                      <textarea id="content" name="location_description1" class="form-control"><?php echo $location_description1; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">image (500 X 500 )<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="hiddenimage" value="<?php echo $image; ?>">
                      <?php if ($image != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/locations_image/' . $image; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName"> Description3 <span style="color:red"> *</span></label>
                      <textarea id="content1" name="location_description2" class="form-control"><?php echo $location_description2; ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">image2</label>
                      <input type="file" style="opacity: 1;" name="image2" id="image2" />
                      <input type="hidden" name="hiddenimage2" id="hiddenimage2" value="<?php echo $image2; ?>">
                      <?php if ($image2 != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/locations_image/' . $image2; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Map Link<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $map_link; ?>" id="map_link" name="map_link">
                    </div>
                  </div>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName"> Description4 <span style="color:red"> *</span></label>
                      <textarea id="content2" name="location_description3" class="form-control"><?php echo $location_description3; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName"> Description5 <span style="color:red"> *</span></label>
                      <textarea id="content3" name="location_description4" class="form-control"><?php echo $location_description4; ?></textarea>
                    </div>
                  </div>






                  <div class="col-md-6 blog-slug">
                    <div class="form-group">
                      <label for="blogCategory">Status</label>
                      <label for="locations_status"><input type="radio" name="locations_status" value="1" <?php echo ($locations_status == '' || $locations_status == '1') ? ' checked="checked"' : ''; ?>>Active</label>
                      <label for="locations_status"><input type="radio" name="locations_status" value="0" <?php echo ($locations_status == '0') ? ' checked="checked"' : ''; ?>> Inactive</label>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <h4>SEO Fields</h4>
                  </div>
                  <div class="col-md-12">                                
                    <div class="form-group">
                      <label for="page_name">Meta Title</label>
                      <input type="text" class="form-control" id="metaTitle" name="metaTitle" value="<?php echo $metaTitle;?>">
                    </div>
                  </div>
                  <div class="col-md-12">                                
                    <div class="form-group">
                      <label for="page_name">Meta Keyword</label>
                      <input type="text" class="form-control" id="metaKeyword" name="metaKeyword" value="<?php echo $metaKeyword;?>">
                    </div>
                  </div>
                  <div class="col-md-12">                                
                    <div class="form-group">
                      <label for="page_name">Meta Description</label>
                      <textarea class="form-control" id="metaDescription" name="metaDescription" rows="6"><?php echo $metaDescription;?></textarea>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="action" value="<?php echo $action; ?>">
                <?php if ($locations_id != '') { ?>
                  <input type="hidden" name="locations_id" value="<?php echo $locations_id; ?>">
                <?php } ?>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                <input type="button" onclick="location.href='<?php echo base_url(); ?>admin/location/locations';" class="btn btn-default" value="Cancel" />
                <p><span style="color:red">*</span> fields are mandatory.</p>
              </div>
            </form>
          </div>
        </div>
        <?php if($serviceId) { ?> 
        <div class="col-md-12">
          <div class="header_box version_2">
            <h2><i class="fa fa-plus"></i>Service gallery Image</h2>
          </div>
          <?php $this->load->helper("form"); ?>

          <form role="form" id="AddEditserviceId" action="<?php echo base_url();?>admin/service/servicegalleryInsert" method="post" role="form" enctype="multipart/form-data">

            <input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">
              <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Service gallery title<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="" id="ServiceDetailsTitle" name="ServiceDetailsTitle">
                    </div>
                  </div>
              <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Price<span style="color:red"> *</span></label>
                      <input type="text" id="ServiceDetailsDescription" name="ServiceDetailsDescription" class="form-control">
                    </div>
                  </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="bannerImage" style="display:block">Service image (500 X 500 )<span style="color:red">*</span></label>
                    <input type="file" style="opacity: 1;" name="service_gallery_image" id="service_gallery_image" />
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <input type="hidden" name="serviceId" value="<?php echo $serviceId; ?>">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                  </div>
                </div>



              </div>
            </div>
          </form>

        </div>

        <div class="col-md-12">
          <div class="hadding">
            <h1>Service Image Gallery</h1>
          </div>
          <table  class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>SL NO</th>
                <th>Service Image</th>
                <th>Service gallery title</th>
                <th>Price</th>
                <th>Status</th>
                <th>Added / Modified Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($service_gallery_image_details) {
                $i = 0;
                foreach ($service_gallery_image_details as $row) {
                  $i++;
              ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                      <?php
                      if ($row->service_gallery_image != '') {
                      ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/locations_image/' . $row->service_gallery_image; ?>" alt="" class="preview-sml" />
                      <?php
                      }
                      ?>
                    </td>
                    <td><?php echo $row->ServiceDetailsTitle;?></td>
                    <td><?php echo $row->ServiceDetailsDescription;?></td>
                    <td><?php echo ($row->status == 1) ? "Active" : "Inactive"; ?></td>
                    <td><?php echo date('d F Y', strtotime($row->created_on)); ?></td>
                    <td>
                      <a class="btn btn-sm btn-danger deleteRow deleteBlog" href="javascript:void(0);" data-delete-href="<?php echo base_url() . 'admin/service/service-gallery-image-delete/' . $row->service_gallery_image_id.'/'.$row->serviceId; ?>" data-type="blog" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>

                  </tr>
              <?php }
              } ?>
            </tbody>

          </table>


        </div>
        <?php } ?>  

        <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
      </div>

    </div>
  </div>
</div>
</div>


<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this locations image?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>