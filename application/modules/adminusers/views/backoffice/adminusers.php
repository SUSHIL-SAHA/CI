<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Admin Users Lists</li>
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
        <i class="fa fa-table"></i> Admin Users List
        
          <a style="float:right; margin-left: 10px;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/adminusers/adduser"><i class="fa fa-plus"></i> Add New User </a>
          <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/adminusers/userrole"><i class="fa fa-user-plus"></i> Role Management</a>
          
        
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
          
        </div>
          <tr>
              <th><input type="checkbox" id="checkAll" name="checkAll"></th>
              <th>SL NO</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          </thead>
          <tbody>
              <?php
              //print_r($cat_lists);
              if(!empty($users)){
                $i=0;
                foreach($users as $bList){
                  $i++;
                  
                ?>
              <tr id="user-<?php echo base64_encode($bList['id']);?>">
              <td><input type="checkbox" id="check" name="check" value="<?php echo $bList['id']; ?>"></td>
                <td><?php echo $i;?></td>
                <td><?php echo $bList['username'];?></td>
                
                  <td><?php echo $bList['email'];?>
                          
                        </td>
                <td><?php echo $bList['role_name'];?></td>
                      
                <td><?php echo ($bList['active'] == 1) ? "Active" : "Inactive";?></td>
                <td>
                    
                    <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/adminusers/edituser/'.$bList['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                    

                    <a class="btn btn-sm btn-danger deleteRow deleteBlog" href="javascript:void(0);" data-delete-href="<?php echo base_url().'admin/adminusers/deleteuser/'.$bList['id']; ?>" data-type="blog" title="Delete"><i class="fa fa-trash"></i></a>
                    
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
            <select name="" id="multiple_type" class="multiple_type multi_select" data-action="adminusers/delete-active-inactive-multiple-user">
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
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this User?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>
