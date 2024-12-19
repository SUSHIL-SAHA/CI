<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Plugins</li>
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
        <!-- <i class="fa fa-table"></i> Banners List -->
        <?php
            if($userPermission['add']){
              ?>
          <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/plugins/create-plugin"><i class="fa fa-plus"></i> Create Plugin</a>
          <?php
          }
          ?>
        
      </div>
        <?php 

          // pre($blogLists);
        ?>
      <div class="card-body">
        <div class="table-responsive">
          <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <?php
          if($userPermission['list']){
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
          <tr>
              <th><input type="checkbox" id="checkAll" name="checkAll"></th>
              <th>SL NO</th>
              <th>Module</th>
              <th>Sub Module</th>
              <th>Status</th>
          </tr>
          </thead>
          <tbody>
              <?php
              //print_r($cat_lists);
              if(!empty($pluginsList)){
                $i=0;
                foreach($pluginsList as $row){
                  $i++;
                  $sub_module = $this->plugins_model->getsubmodule($row['module_id']);
                  
                ?>
              <tr id="blog-<?php echo base64_encode($row['module_id']);?>">
              <td><input type="checkbox" id="check" name="check" value="<?php echo $row['module_id']; ?>"></td>
                <td><?php echo $i;?></td>
                <td><a href="<?php echo base_url();?>admin/plugins/edit-plugin/<?php echo $row['module_id'] ; ?>"><?php echo $row['module_name'];?></a></td>
                <td><a href="<?php echo base_url() ; ?>admin/plugins/sub-plugin-list/<?php echo $row['module_id'] ; ?>"><img src="<?php echo  SITE_URL ; ?>assets/front/image/mainmenu.png" alt="mainmenu"> {<?php echo count($sub_module) ; ?>}</a> </td>
                <td><?php echo ($row['status'] == 1) ? "Active" : "Inactive";?></td>
                
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
              }
            ?>
            </tbody>
          </table>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
            <select name="" id="multiple_type" class="inner_banner_multiple_type multi_select" data-action="plugins/delete-active-inactive-multiple-plugins">
                        <option value="">Select</option>
                        <?php
            if($userPermission['edit']){
              ?>
                        <option value="act">Active</option>
                        <option value="inact">Inactive</option>
                        <?php
            }
            if($userPermission['delete']){
            ?>
                        <option value="delete">Delete</option>
                        <?php
            }
            ?>
            </select> 
          </div>
          <?php } ?>
        </div>
      </div>
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
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this Banner?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>


     