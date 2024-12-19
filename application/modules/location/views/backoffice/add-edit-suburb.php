<?php 
  $suburb_title = '';
  $parent_category = '';
  $categoryDescription = '';
  // $category_id='';
  $suburb_status = '';
  $image = '';
  $headingText = 'Add Suburb';
  $formID = 'AddSuburb';
  $action = 'add';
  $suburb_id = '';
  $sort = '';
  $bannerImage = '';
  

  if(isset($suburb_details)){
    $suburb_title = $suburb_details['suburb_title'];
    // $category_id = $suburb_details['category_id'];
    // $parent_category = $category_details['parent_category'];
    $categoryDescription = $suburb_details['category_description'];
    $suburb_status = $suburb_details['suburb_status'];
    $image = $suburb_details['image'];
    $headingText = 'Edit Suburb';
    $formID = 'EditSuburb';
    $action = 'edit';
    $suburb_id = $suburb_details['suburb_id'];
    // $sort = $suburb_details['sort'];
    // $bannerImage = $suburb_details['bannerImage'];
  }


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/location/suburb">Suburb</a>
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
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/location/suburb"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="AddEditsuburb_id" action="<?php echo base_url(); ?>admin/location/suburbInsert" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">
              <!-- <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Choose category <span style="color:red"> *</span></label>
                      <select class="form-control category" id="category_id" name="category_id">
                        <option value="">Select category</option>
                        <?php foreach ($get_category_details as $row) { ?>
                          <option value="<?php echo $row->categoryId; ?>" <?php if ($row->categoryId == $category_id) {
                                                                            echo "selected";
                                                                          } ?>><?php echo $row->category_title; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div> -->

                <div class="col-md-6 blog-name">                                
                  <div class="form-group">
                      <label for="blogName">Suburb Name <span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $suburb_title;?>" id="suburb_title" name="suburb_title">
                  </div>
                </div>

                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="Image" style="display:block">image (300 X 300)</label>
                      <input type="file" style="opacity: 1;" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="hiddenimage" value="<?php echo $image; ?>">
                      <?php if($image!="") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/suburb_image/' . $image ; ?>" alt="" class="preview-sml"/>
                        <?php } ?>
                  </div>
                </div>

                <!-- <div class="col-md-6 blog-name">                                
                  <div class="form-group">
                      <label for="blogName">Parent Category</label>
                     <select class="form-control" name="parent_category" id="parent_category">
                      <option value="">None</option>
                      <?php foreach($main_suburb_details as $row) { ?>
                        <option value="<?php echo $row['suburb_id'] ;?>" <?php if($parent_category == $row['suburb_id']) { echo "selected"; } ?>><?php echo $row['category_title']?></option>
                        <?php } ?>
                     </select>
                  </div>
                </div> -->

                <!-- <div class="col-md-12 blog-name">                                
                  <div class="form-group">
                  <label for="blogName">Description <span style="color:red"> *</span></label>
                  <textarea id="content" name="categoryDescription" class="form-control"><?php //echo $categoryDescription ;?></textarea>
                  </div>
                </div> -->

                <!-- <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="blogCategory">Sort</label>
                      <input type="number" class="form-control" value="<?php echo $sort ; ?>" id="sort" name="sort">
                  </div>
                </div> -->

                <!-- <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="bannerImage" style="display:block">Banner Image (1920 X 360)</label>
                      <input type="file" style="opacity: 1;" name="bannerImage" id="bannerImage" />
                      <input type="hidden" name="hiddenbannerImage" id="hiddenbannerImage" value="<?php echo $bannerImage; ?>">
                      <?php if($bannerImage!="") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/category_image/' . $bannerImage ; ?>" alt="" class="preview-sml"/>
                        <?php } ?>
                  </div>
                </div> -->

                <div class="col-md-6 blog-slug">                                
                  <div class="form-group">
                      <label for="blogCategory">Status</label>
                      <label for="suburb_status"><input type="radio" name="suburb_status" value="1"<?php echo ($suburb_status == '' || $suburb_status == '1') ? ' checked="checked"' : '';?>>Active</label>
                        <label for="suburb_status"><input type="radio" name="suburb_status" value="0"<?php echo ($suburb_status == '0') ? ' checked="checked"' : '';?>> Inactive</label>
                  </div>
                </div>

              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <?php if($suburb_id != '') { ?>
              <input type="hidden" name="suburb_id" value="<?php echo $suburb_id;?>">
              <?php } ?>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/location/suburb';" class="btn btn-default" value="Cancel" />
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
