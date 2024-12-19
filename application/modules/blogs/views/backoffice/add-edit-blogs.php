<?php 
  $blogs_title = '';
  $blogs_status = '';
  $blogs_image = '';
  $blogs_description = "";
  // $innerbannerImage = '';
  $metaTitle   = '';
  $metaKeyword =  '';
  $metaDescription = '';
  $headingText = 'Add Blogs';
  $formID = 'AddBlogs';
  $action = 'add';
  $blogs_id = '';
  

  if(isset($blogs_details)){
    $blogs_title = $blogs_details['blogs_title'];
    $blogs_status = $blogs_details['blogs_status'];
    $blogs_description = $blogs_details['blogs_description'];
    $blogs_image = $blogs_details['blogs_image'];
    $metaTitle   = $blogs_details['metaTitle'];
    $metaKeyword = $blogs_details['metaKeyword'];
    $metaDescription = $blogs_details['metaDescription'];
    $blogs_slug = $blogs_details['blogs_slug'];
    // $innerbannerImage = $blogs_details['innerbannerImage'];

    // echo "<pre>"; print_r($blog_Politicians_details);die;

    $headingText = 'Edit Blogs';
    $formID = 'EditBlogs';
    $action = 'edit';
    $blogs_id = $blogs_details['blogs_id'];
  }
?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/blogs">Blogs</a>
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
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/blogs"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="AddEditHomeblogs_id" action="<?php echo base_url(); ?>admin/blogs/blogsInsert" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-6 blog-name">                                
                  <div class="form-group">
                      <label >Title<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $blogs_title;?>" id="blogs_title" name="blogs_title" required />
                  </div>
                </div>
                <?php if($blogs_slug){?>
                  <div class="col-md-6 blog-name">
                    <div class="form-group">
                      <label for="blogName">Blog Slug</label>
                      <input type="text" class="form-control" value="<?php echo $blogs_slug; ?>" id="blogs_slug" name="blogs_slug">
                    </div>
                  </div>
                  <?php }?>
                <div class="col-md-12 blog-name">
                    <div class="form-group">
                      <label for="blogName">Description <span style="color:red"> *</span></label>
                      <textarea id="other_content" name="blogs_description" class="form-control"><?php echo $blogs_description; ?></textarea>
                    </div>
                  </div>
               
                
                
                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="blogs_image" style="display:block">Gallery image<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="blogs_image" id="blogs_image" />
                      <input type="hidden" name="hiddenblogs_image" id="hiddenblogs_image" value="<?php echo $blogs_image; ?>">
                      <?php if($blogs_image!="") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/blogs_images/' . $blogs_image ; ?>" alt="" class="preview-sml"/>
                        <?php } ?>
                  </div>
                </div>

                 

             
                

                <div class="col-md-6 blog-slug">                                
                  <div class="form-group">
                      <label for="blogCategory">Status</label>
                      <label for="blogs_status"><input type="radio" name="blogs_status" value="1"<?php echo ($blogs_status == '' || $blogs_status == '1') ? ' checked="checked"' : '';?>>Active</label>
                        <label for="blogs_status"><input type="radio" name="blogs_status" value="0"<?php echo ($blogs_status == '0') ? ' checked="checked"' : '';?>> Inactive</label>
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
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <?php if($blogs_id != '') { ?>
              <input type="hidden" name="blogs_id" value="<?php echo $blogs_id;?>">
              <?php } ?>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/blogs';" class="btn btn-default" value="Cancel" />
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
 


