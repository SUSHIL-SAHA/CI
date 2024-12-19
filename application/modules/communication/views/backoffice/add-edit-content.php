<?php 
  $for_page = '';
  $heading = '';
  $display_heading = '';
  $sub_heading = '';
  $status = '';
  $display_priority = '';
  $description ='';
  $action = 'add';
  $content_id = '';
  

  if(isset($content_details)){
    $for_page = $content_details->for_page;
    $heading = $content_details->heading;
    $display_heading = $content_details->display_heading;
    $sub_heading = $content_details->sub_heading;
    $status = $content_details->status;
    $display_priority = $content_details->display_priority;
    $description =$content_details->description;
    $action = 'edit';
    $content_id = $content_details->id;
  }


?>

<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Communication</a>
        </li>
        <li class="breadcrumb-item active">Content</li>
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
          
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/communication/content"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="AddEditcontentId" action="<?php echo base_url(); ?>admin/communication/contentinsert" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="blogName">For Page <span style="color:red"> *</span></label>
                      <!-- <input type="text" class="form-control" value="<?php echo $BannerTitle;?>" id="BannerTitle" name="BannerTitle"> -->
                      <select class="form-control" name="for_page" id="for_page">
                        <option value="Content">Content</option>
                        
                      </select>
                  </div>
                </div>
               
                
                
                <div class="col-md-6">                                
                  <div class="form-group">
                      <label for="bannerImage">Heading <span style="color:red">*</span></label>

                      <input type="text" class="form-control" value="<?php echo $heading;?>" id="heading" name="heading">
                  </div>
                </div>

                <div class="col-md-3">                                
                  <div class="form-group">
                      <label for="blogName">Display Heading</label>
                      <select class="form-control" name="display_heading" id="display_heading">
                        <option value="Yes" <?php if($display_heading == 'Yes') { echo "selected" ; } ?>>Yes</option>
                        <option value="No" <?php if($display_heading == 'No') { echo "selected" ; } ?>>No</option>
                      </select>
                  </div>
                </div>



                <div class="col-md-8">                                
                  <div class="form-group">
                      <label for="blogName">Sub Heading</label>
                      <textarea class="form-control" name="sub_heading" id="content"><?php echo $sub_heading ; ?></textarea>
                     
                  </div>
                </div>

                <div class="col-md-4">                                
                  <div class="form-group">
                      <label for="blogName">Status</label>
                      <select class="form-control" name="status" id="status">
                        <option value="1" <?php if($status == '1') { echo "selected" ; }?>>Active</option>
                        <option value="0" <?php if($status == '0') { echo "selected" ; }?>>Inactive</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="blogName">Display Priority</label>
                      <select class="form-control" name="display_priority" id="display_priority">
                        <option value="top" <?php if($display_priority == 'top') { echo "selected" ; }?>>Move to top</option>
                        <option value="bottom" <?php if($display_priority == 'bottom') { echo "selected" ; }?>>Move to bottom</option>
                      </select>
                  </div>
                </div>

                <div class="col-md-8">                                
                  <div class="form-group">
                      <label for="blogName">Description</label>
                      <textarea class="form-control" name="description" id="content_description"><?php echo $description ; ?></textarea>
                     
                  </div>
                </div>

              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="action" value="<?php echo $action;?>">
              <?php if($content_id != '') { ?>
              <input type="hidden" name="content_id" value="<?php echo $content_id;?>">
              <?php } ?>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/communication/content';" class="btn btn-default" value="Cancel" />
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
<script>
var images = [];
<?php
if($blogImage !='')
{
  $blogImgArr = explode(',',$blogImage);
  if(is_array($blogImgArr) && count($blogImgArr)>0)
  {
    foreach($blogImgArr as $val)
    {
      ?>
        images.push('<?php echo $val;?>');
      <?php
    }
  }
  
}
?>
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/form_validation.js"></script>
