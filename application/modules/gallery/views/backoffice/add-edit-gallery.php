<?php 
  $video_link = '';
  $galleryStatus = '';
  $galleryImage = '';
  // $innerbannerImage = '';
  $headingText = 'Add Image / Video link';
  $formID = 'AddImage/Video';
  $action = 'add';
  $galleryId = '';
  

  if(isset($gallery_details)){
    $video_link = $gallery_details['video_link'];
    $galleryStatus = $gallery_details['galleryStatus'];
    $galleryImage = $gallery_details['galleryImage'];
    // $innerbannerImage = $gallery_details['innerbannerImage'];

    // echo "<pre>"; print_r($blog_Politicians_details);die;

    $headingText = 'Edit Image / Video link';
    $formID = 'EditImage/Video';
    $action = 'edit';
    $galleryId = $gallery_details['galleryId'];
  }


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/gallery/homegallery">Gallery</a>
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
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/gallery/homegallery"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="AddEditHomegalleryId" action="<?php echo base_url(); ?>admin/gallery/galleryInsert" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-12 blog-name">                                
                  <div class="form-group">
                      <label >Title<span style="color:red"> *</span></label>
                      <input type="text" class="form-control" value="<?php echo $video_link;?>" id="video_link" name="video_link" required />
                  </div>
                </div>
               
                
                
                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="galleryImage" style="display:block">Gallery image<span style="color:red">*</span></label>
                      <input type="file" style="opacity: 1;" name="galleryImage" id="galleryImage" />
                      <input type="hidden" name="hiddengalleryImage" id="hiddengalleryImage" value="<?php echo $galleryImage; ?>">
                      <?php if($galleryImage!="") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/gallery_image/' . $galleryImage ; ?>" alt="" class="preview-sml"/>
                        <?php } ?>
                  </div>
                </div>

                 

             
                

                <div class="col-md-6 blog-slug">                                
                  <div class="form-group">
                      <label for="blogCategory">Status</label>
                      <label for="galleryStatus"><input type="radio" name="galleryStatus" value="1"<?php echo ($galleryStatus == '' || $galleryStatus == '1') ? ' checked="checked"' : '';?>>Active</label>
                        <label for="galleryStatus"><input type="radio" name="galleryStatus" value="0"<?php echo ($galleryStatus == '0') ? ' checked="checked"' : '';?>> Inactive</label>
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <?php if($galleryId != '') { ?>
              <input type="hidden" name="galleryId" value="<?php echo $galleryId;?>">
              <?php } ?>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/gallery/homegallery';" class="btn btn-default" value="Cancel" />
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
 


