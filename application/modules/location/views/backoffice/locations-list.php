
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Location Lists</li>
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
        <i class="fa fa-table"></i>Location Lists
        <?php
            if($userPermission['add']){
              ?>
          <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/location/locations-add"><i class="fa fa-plus"></i> Add New locations </a> 
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
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
          <select name="" id="multiple_type" class="service_multiple_type multi_select" data-action="location/delete-active-inactive-multiple-locations">
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
        <?php
            }
            ?>
          <tr>
              <th><input type="checkbox" id="checkAll" name="checkAll"></th>
              <th>SL NO</th>
              <th>Suburb Name</th>
              <th>locations Name</th>
              <th>Image</th>
              <th>Added / Modified Date</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          </thead>
           
            <tbody>
              <?php
              //print_r($cat_lists);
              if(!empty($locations_details)){
                $i=0;
                foreach($locations_details as $sList){
                  $i++;
                  // $parent_category = $this->service_model->getParentcategory($sList['parent_category']);
                  // echo "<pre>"; print_r($parent_category);
                ?>
              <tr id="blog-<?php echo base64_encode($sList['locations_id']);?>">
              <td><input type="checkbox" id="check" name="check" value="<?php echo $sList['locations_id']; ?>"></td>
                <td><?php echo $i ;?></td>
                <td> 
                  <?php
                    echo $sList['suburb_title'] ;
                    if($parent_category)
                    {
                      echo " >> ".$parent_category['suburb_title'];
                    }
                  ?>
                </td>
                <td><?php echo $sList['locations_title'] ; ?></td>
                
                  <td>
                          <?php
                          if($sList['image'] != ''){
                          ?>
                            <img height="100" width="100" src="<?php echo SITE_URL . 'uploads/locations_image/' . $sList['logo_image']; ?>" alt="" class="preview-sml"/>
                            <?php
                          }
                          ?>
                        </td>
                <td><?php echo ($sList['modifiedOn'] != "") ? date('d F Y H:i:s', strtotime($sList['modifiedOn'])) : date('d F Y H:i:s', strtotime($sList['addedOn']));?></td> 
                <td><?php echo ($sList['locations_status'] == 1) ? "Active" : "Inactive";?></td>
                <td>
                <?php
            if($userPermission['edit']){
              ?>
                    <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/location/locations-edit/'.$sList['locations_id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                    <?php
            }
            if($userPermission['delete']){
            ?>
                    

                    <a class="btn btn-sm btn-danger deleteRow deleteBlog" href="javascript:void(0);" data-delete-href="<?php echo base_url().'admin/location/locations-delete/'.$sList['locations_id']; ?>" data-type="blog" title="Delete"><i class="fa fa-trash"></i></a>
                    <?php }
            ?>    
                    
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
          <?php echo $this->pagination->create_links(); ?>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
            <select name="" id="multiple_type" class="service_multiple_type multi_select" data-action="location/delete-active-inactive-multiple-locations">
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
          <?php
            }
          }
          ?>
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
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this location?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>

  