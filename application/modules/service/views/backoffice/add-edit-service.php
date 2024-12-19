<?php
$service_category = '';
// $parent_category = '';
$ServiceTitle = '';
$ServiceDescription = '';
$ServiceOtherDescription='';
$ServiceOtherTitle='';
$ServiceOtherDescription2='';
$ServiceOtherTitle2='';
$ServiceOtherImage='';
$serviceStatus = '';
$serviceImage = '';
$service_icon = '';
$show_other_Service = '';
$ServiceShortDescription = '';
// $ServicePrice = '';
$metaTitle   = '';
$metaKeyword =  '';
$metaDescription = '';
$headingText = 'Add Service';
$formID = 'AddService';
$action = 'add';
$serviceId = '';


if (isset($service_details)) {
  $service_category = $service_details['category'];
  // $parent_category = $service_details['parent_category'];
  $ServiceTitle = $service_details['service_title'];
  $ServiceShortDescription =$service_details['ServiceShortDescription'];
  // $ServicePrice = $service_details['ServicePrice'];
  $ServiceDescription = $service_details['service_description'];
  $ServiceOtherTitle = $service_details['ServiceOtherTitle'];
  $ServiceOtherImage = $service_details['ServiceOtherImage'];
  $ServiceOtherDescription = $service_details['ServiceOtherDescription'];
  $ServiceOtherTitle2 = $service_details['ServiceOtherTitle2'];
  $ServiceOtherDescription2 = $service_details['ServiceOtherDescription2'];

  $show_other_Service = $service_details['show_other_Service'];
  $serviceStatus = $service_details['service_status'];
  $serviceImage = $service_details['image'];
  $service_icon = $service_details['service_icon'];
  $metaTitle   = $service_details['metaTitle'];
  $metaKeyword = $service_details['metaKeyword'];
  $metaDescription = $service_details['metaDescription'];
  $service_slug = $service_details['service_slug'];
  $headingText = 'Edit Service';
  $formID = 'EditService';
  $action = 'edit';
  $serviceId = $service_details['serviceId'];
}


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/service/service-list">Service</a>
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
              <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>admin/service/allservice"><i class="fa fa-level-up"></i> Back to list</a>
            </div><!-- /.box-header -->
            <!-- form start -->
            <br clear="all">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="AddEditserviceId" action="<?php echo base_url(); ?>admin/service/serviceInsert" method="post" role="form" enctype="multipart/form-data">
              <input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
                <div class="row">

                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Choose Category <span style="color:red"> *</span></label>
                      <select class="form-control category" id="category" name="category">
                        <option value="">Select Category</option>
                        <?php foreach ($category_details as $row) { ?>
                          <option value="<?php echo $row->categoryId; ?>" <?php if ($row->categoryId == $service_category) {
                                                                            echo "selected";
                                                                          } ?>><?php echo $row->category_title; ?></option>
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

                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Title <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $ServiceTitle; ?>" id="ServiceTitle" name="ServiceTitle">
                    </div>
                  </div>
                  <!-- <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Service Price<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $ServicePrice; ?>" id="ServicePrice" name="ServicePrice">
                    </div>
                  </div> -->
                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Short Description<span style="color:red"> *</span></label>
                      <textarea class="form-control" value="" id="ServiceShortDescription" name="ServiceShortDescription"><?php echo $ServiceShortDescription; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-3 blog-slug">
                    <div class="form-group">
                      <label for="blogCategory">Other Service<span style="color:red"> *</span></label>
                      <label for="show_other_Service"><input type="radio" id="show_other_Service" name="show_other_Service" value="yes" <?php echo ($show_other_Service == 'yes') ? ' checked="checked"' : ''; ?>>YES</label>
                      <label for="show_other_Service"><input type="radio" id="show_other_Service" name="show_other_Service" value="no" <?php echo ($show_other_Service == 'no') ? ' checked="checked"' : ''; ?>>NO</label>
                    </div>
                  </div>
                  <?php if($service_slug){?>
                  <div class="col-md-3 blog-name">
                    <div class="form-group">
                      <label for="blogName">Service Slug</label>
                      <input type="text" class="form-control" value="<?php echo $service_slug; ?>" id="service_slug" name="service_slug">
                    </div>
                  </div>
                  <?php }?>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName">Description <span style="color:red"> *</span></label>
                      <textarea id="other_content" name="ServiceDescription" class="form-control"><?php echo $ServiceDescription; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">Service image (500 X 500 )<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="serviceImage" id="serviceImage" />
                      <input type="hidden" name="hiddenserviceImage" id="hiddenserviceImage" value="<?php echo $serviceImage; ?>">
                      <?php if ($serviceImage != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/service_image/' . $serviceImage; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">Service Icon</label>
                      <input type="file" style="opacity: 1;" name="service_icon" id="" />
                      <input type="hidden" name="hiddenservice_icon" id="hiddenservice_icon" value="<?php echo $service_icon; ?>">
                      <?php if ($service_icon != "") { ?>
                        <figure class="icon-img"><img  src="<?php echo SITE_URL . 'uploads/service_image/' . $service_icon; ?>" alt="" class="preview-sml" /></figure>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-4 blog-slug">
                    <div class="form-group">
                      <label for="blogCategory">Status</label>
                      <label for="serviceStatus"><input type="radio" name="serviceStatus" value="1" <?php echo ($serviceStatus == '' || $serviceStatus == '1') ? ' checked="checked"' : ''; ?>>Active</label>
                      <label for="serviceStatus"><input type="radio" name="serviceStatus" value="0" <?php echo ($serviceStatus == '0') ? ' checked="checked"' : ''; ?>> Inactive</label>
                    </div>
                  </div>
                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Other Title <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $ServiceOtherTitle; ?>" id="ServiceOtherTitle" name="ServiceOtherTitle">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">Other image<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="ServiceOtherImage" id="ServiceOtherImage" />
                      <input type="hidden" name="hiddenServiceOtherImage" id="hiddenServiceOtherImage" value="<?php echo $ServiceOtherImage; ?>">
                      <?php if ($ServiceOtherImage != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/service_image/' . $ServiceOtherImage; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName">Other Description <span style="color:red"> *</span></label>
                      <textarea id="content" name="ServiceOtherDescription" class="form-control"><?php echo $ServiceOtherDescription; ?></textarea>
                    </div>
                  </div>

                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName">Other Title 2 <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $ServiceOtherTitle2; ?>" id="ServiceOtherTitle2" name="ServiceOtherTitle2">
                    </div>
                  </div>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName">Other Description 2 <span style="color:red"> *</span></label>
                      <textarea id="content1" name="ServiceOtherDescription2" class="form-control"><?php echo $ServiceOtherDescription2; ?></textarea>
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
                <?php if ($serviceId != '') { ?>
                  <input type="hidden" name="serviceId" value="<?php echo $serviceId; ?>">
                <?php } ?>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                <input type="button" onclick="location.href='<?php echo base_url(); ?>admin/service/allservice';" class="btn btn-default" value="Cancel" />
                <p><span style="color:red">*</span> fields are mandatory.</p>
              </div>
            </form>
          </div>
        </div>
        <!-- <?php if($serviceId) { ?> 
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
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/service_image/' . $row->service_gallery_image; ?>" alt="" class="preview-sml" />
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
        <?php } ?>   -->

        <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
      </div>

    </div>
  </div>
</div>
</div>


<!-- <div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this service image?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div> -->