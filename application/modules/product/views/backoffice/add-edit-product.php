<?php
$category_id = '';
$product_title = '';
$product_status = '';
$image = '';
$headingText = 'Add Product';
$formID = 'AddProduct';
$action = 'add';
$productId = '';


if (isset($product_details)) {
  $category_id = $product_details['category_id'];
  $product_title = $product_details['product_title'];
  $product_status = $product_details['product_status'];
  $image = $product_details['image'];
  $headingText = 'Edit Product';
  $formID = 'EditProduct';
  $action = 'edit';
  $productId = $product_details['productId'];
}


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/product/allproduct">Product</a>
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
              <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>admin/product/allproduct"><i class="fa fa-level-up"></i> Back to list</a>
            </div><!-- /.box-header -->
            <!-- form start -->
            <br clear="all">
            <?php $this->load->helper("form"); ?>
            <form role="form" id="AddEditproductId" action="<?php echo base_url(); ?>admin/product/productInsert" method="post" role="form" enctype="multipart/form-data">
              <input type="hidden" class="<?php echo $this->security->get_csrf_token_name(); ?>" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
              <div class="box-body">
                <div class="row">

                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Choose Category <span style="color:red"> *</span></label>
                      <select class="form-control category" id="category_id" name="category_id">
                        <option value="">Select Category</option>
                        <?php foreach ($category_details as $row) { ?>
                          <option value="<?php echo $row->categoryId; ?>" <?php if ($row->categoryId == $category_id) {
                                                                            echo "selected";
                                                                          } ?>><?php echo $row->category_title; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Title <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $product_title; ?>" id="product_title" name="product_title">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bannerImage" style="display:block">Product image (500 X 500 )<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="hiddenimage" value="<?php echo $image; ?>">
                      <?php if ($image != "") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/product_image/' . $image; ?>" alt="" class="preview-sml" />
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6 blog-slug">
                    <div class="form-group">
                      <label for="blogCategory">Status</label>
                      <label for="product_status"><input type="radio" name="product_status" value="1" <?php echo ($product_status == '' || $product_status == '1') ? ' checked="checked"' : ''; ?>>Active</label>
                      <label for="product_status"><input type="radio" name="product_status" value="0" <?php echo ($product_status == '0') ? ' checked="checked"' : ''; ?>> Inactive</label>
                    </div>
                  </div>

                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="action" value="<?php echo $action; ?>">
                <?php if ($productId != '') { ?>
                  <input type="hidden" name="productId" value="<?php echo $productId; ?>">
                <?php } ?>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
                <input type="button" onclick="location.href='<?php echo base_url(); ?>admin/product/allproduct';" class="btn btn-default" value="Cancel" />
                <p><span style="color:red">*</span> fields are mandatory.</p>
              </div>
            </form>
          </div>
        </div>

        <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
      </div>

    </div>
  </div>
</div>
</div>