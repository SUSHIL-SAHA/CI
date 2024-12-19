<?php
$testimonial_name = '';
$testimonial_description = '';
$image = '';
$dept = '';
$rating = '';
$headingText = 'Add Testimonial';
$formID = 'Addtestimonial';
$action = 'add';
$testimonialid = '';


if (isset($testimonial)) {
  $testimonial_name = $testimonial['testimonial_name'];
  $dept =$testimonial['dept'];
  $testimonial_description = $testimonial['testimonial_description'];
  $image = $testimonial['image'];
  $rating= $testimonial['rating'];
  $headingText = 'Edit Testimonial';
  $formID = 'Edittestimonial';
  $action = 'edit';
  $testimonialid = $testimonial['testimonialid'];
}


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/testimonial"> Testimonial </a>
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
              <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>admin/testimonial"><i class="fa fa-level-up"></i> Back to list</a>
            </div><!-- /.box-header -->
            <!-- form start -->
            <br clear="all">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="AddEdittestimonialid" action="<?php echo base_url(); ?>admin/testimonial/testimonialInsert" method="post" role="form" enctype="multipart/form-data">
              <input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">name <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $testimonial_name; ?>" id="testimonial_name" name="testimonial_name">
                    </div>
                  </div>
                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Dept.<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $dept; ?>" id="dept" name="dept">
                    </div>
                  </div>

                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName">Description <span style="color:red"> *</span></label>
                      <textarea id="content" name="testimonial_description" class="form-control"><?php echo $testimonial_description; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label>Rating<span style="color:red">*</span>
                        <div class="rating">
                            <label>
                              <input type="radio" name="rating" value="1"<?php echo ($rating == '1') ? ' checked="checked"' : ''; ?>/>
                              <span class="icon">★</span>
                            </label>
                           
                            <label>
                              <input type="radio" name="rating" value="2"<?php echo ($rating == '2') ? ' checked="checked"' : ''; ?> />
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                            </label>
                            <label>
                              <input type="radio" name="rating" value="3"<?php echo ($rating == '3') ? ' checked="checked"' : ''; ?> />
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                              <span class="icon">★</span>   
                            </label>
                            <label>
                              <input type="radio" name="rating" value="4"<?php echo ($rating == '4') ? ' checked="checked"' : ''; ?> />
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                            </label>
                            <label>
                              <input type="radio" name="rating" value="5"<?php echo ($rating == '5') ? ' checked="checked"' : ''; ?> />
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                              <span class="icon">★</span>
                            </label>
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">Profile Pic (500 X 500 )<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="hiddenimage" value="<?php echo $image; ?>">
                      <?php if ($image != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/testimonial_image/' . $image; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>

 
              <div class="box-footer">
                <input type="hidden" name="action" value="<?php echo $action; ?>">
                <?php if ($testimonialid != '') { ?>
                  <input type="hidden" name="testimonialid" value="<?php echo $testimonialid; ?>">
                <?php } ?>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                <input type="button" onclick="location.href='<?php echo base_url(); ?>admin/testimonial';" class="btn btn-default" value="Cancel" />
                <p><span style="color:red">*</span> fields are mandatory.</p>
              </div>
            </form>
          </div>
        </div>
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
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this testimonial image?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>