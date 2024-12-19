
<div class="content-wrapper">
  <div class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Communication</a>
        </li>
        <li class="breadcrumb-item active">Contact Mail</li>
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
          
            <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url();?>admin/communication/contact-mail"><i class="fa fa-level-up"></i> Back to list</a>
          </div><!-- /.box-header -->
          <!-- form start -->
          <br clear="all">
          <?php $this->load->helper("form"); ?>
          <form role="form" id="AddEditcontentId" action="<?php echo base_url(); ?>admin/communication/contentinsert" method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="box-body">
              <div class="row">
                 <div class="col-md-12">  

                  <div class="form-group">
                      <label for="blogName"><?php echo $mail_details->name ; ?></label>
                      <div class="form-group clearfix">
                                    <div class="iconDiv"><i class="fa fa-envelope"></i><?php echo $mail_details->email ; ?></div>
                                    <div class="iconDiv"><i class="fa fa-phone"></i> <?php echo $mail_details->ph_no ;?></div><div class="iconDiv"><i class="fa fa-book"></i> Contact information</div>                                </div>
                                    <div>Address:  <?php echo $mail_details->address;?></div>
                        <textarea class="form-control">
                        <?php echo $mail_details->message ; ?>
                      </textarea>
                      
                  </div>




                </div> 

                
               
                
                
                
              <input type="button" onclick="location.href='<?php echo base_url();?>admin/communication/contact-mail';" class="btn btn-default" value="Cancel" />
             
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
