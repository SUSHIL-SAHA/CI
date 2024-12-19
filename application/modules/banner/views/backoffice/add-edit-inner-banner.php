<?php 
  
  $bannerStatus = ''; 
  $innerbannerImage = '';
  $page_name='';
  $headingText = 'Add Inner Banner';
  $formID = 'AddinnerBannerId';
  $action = 'add';
  $innerbannerId = '';
  

  if(isset($banner_details)){

    $page_name = $banner_details['page_name'];
    $bannerStatus = $banner_details['bannerStatus'];
    $innerbannerImage = $banner_details['image'];
    $headingText = 'Edit Inner Banner';
    $formID = 'EditinnerBannerId';
    $action = 'edit';
    $innerbannerId = $banner_details['innerbannerId'];
  }


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url();?>admin/banner/inner-banner-list">Inner Banner</a>
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
            <h2><i class="fa fa-plus"></i><?php echo $headingText;?></h2>
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url(); ?>admin/banner/innerbanner"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="<?php echo $formID ; ?>" action="<?php echo base_url(); ?>admin/banner/Innerbannerinsert" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">

                <div class="col-md-6 blog-slug">                                
                  <div class="form-group">
                      <label for="blogCategory">Choose Inner page <span style="color:red">*</span></label>
                      <select class="form-control" name="page_name" id="page_name">
                        <option value="">Select Page</option>
                        <?php if(is_array($cms_page) && count($cms_page)) {
                          foreach($cms_page as $page) { ?>
                        <option value="<?php echo $page->pageSlug ; ?>" <?php if($page_name==$page->pageSlug) { echo "selected" ; } ?>><?php echo $page->pageName ; ?></option>
                       
                      <?php }} ?>
                      </select>
                  </div>
                </div>
                
               <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="bannerImage" style="display:block">Inner banner image (1600 X 513) <span style="color:red">*</span></label>
                      <input class="form-control" type="file" style="opacity: 1;" name="innerbannerImage" id="innerbannerImage" />
                      <input type="hidden" name="innerhiddenbannerImage" id="innerhiddenbannerImage" value="<?php echo $innerbannerImage; ?>">
                      <?php if($innerbannerImage!="") { ?>
                        <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/banner_image/' . $innerbannerImage ; ?>" alt="" class="preview-sml"/>
                        <?php } ?>
                  </div>
                </div>

             
                

                <div class="col-md-6 blog-slug">                                
                  <div class="form-group">
                      <label for="blogCategory">Status <span style="color:red">*</span></label>
                      <label for="bannerStatus"><input type="radio" name="bannerStatus" value="1"<?php echo ($bannerStatus == '' || $bannerStatus == '1') ? ' checked="checked"' : '';?>>Active</label>
                        <label for="bannerStatus"><input type="radio" name="bannerStatus" value="0"<?php echo ($bannerStatus == '0') ? ' checked="checked"' : '';?>> Inactive</label>
                  </div>
                </div>

              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <?php if($innerbannerId != '') { ?>
              <input type="hidden" name="innerbannerId" value="<?php echo $innerbannerId;?>">
              <?php } ?>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/banner/innerbanner'" class="btn btn-default" value="Cancel" />
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

