
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Communication</a>
      </li>
      <li class="breadcrumb-item active">Content</li>
    </ol>
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
  <!-- Example DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>Content
        
          <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/communication/content-add"><i class="fa fa-plus"></i> Add Content </a> 
          
        
      </div>
        <?php 

          // pre($blogLists);
        ?>
      <div class="card-body">
        <div class="table-responsive">
          <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <div class="bottom-select">
          <select name="" id="multiple_type" class="content_multiple_type">
                      <option value="">Select</option>
                      <option value="act">Active</option>
                      <option value="inact">Inactive</option>
                      <option value="delete">Delete</option>
        </select>
        </div>
          <tr>
              <th><input type="checkbox" id="checkAll" name="checkAll"></th>
              <th>SL NO</th>
              <th>Heading</th>
              <th>For Page</th>
              <th>Records Found : <?php echo count($content_details) ; ?></th>
          </tr>
          </thead>
           
            <tbody>
              <?php
              //print_r($cat_lists);
              if(!empty($content_details)){
                $i=0;
                foreach($content_details as $content){
                  $i++;
                  
                ?>
              <tr id="blog-<?php echo base64_encode($content->id);?>">
              <td><input type="checkbox" id="check" name="check" value="<?php echo $content->id; ?>"></td>
                <td><?php echo $i ;?></td>
                <td><a href="<?php echo base_url();?>admin/communication/contentedit/<?php echo $content->id ; ?>"><?php echo  $content->heading; ?></a></td>
                <td><?php echo  $content->for_page; ?></td>
                <td>
                  <?php if($content->status == 1) { ?>
                    <span  class="label label-success">Active</span >
                  <?php }else{ ?>
                    <span  class="label label-danger">Inactive</span >
                  <?php } ?>
                </td>
                      
          
              </tr>
                <?php
                  }
                } else {
                  ?>
              <tr id="emptyBlog">
                <td colspan="6" class="text-center">No records found</td>
              </tr>
                  <?php
                }
            ?>
            </tbody>
          </table>
          <div class="bottom-select">
            <select name="" id="multiple_type" class="content_multiple_type">
                        <option value="">Select</option>
                        <option value="act">Active</option>
                        <option value="inact">Inactive</option>
                        <option value="delete">Delete</option>
            </select> 
          </div>
        </div>
      </div>
      <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
    </div>
  <!-- /tables-->
  </div>
  <!-- /container-fluid-->
</div>

<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this Content?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>


