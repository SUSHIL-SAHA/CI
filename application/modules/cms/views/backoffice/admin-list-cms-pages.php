<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">CMS Pages</li>
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
        <i class="fa fa-table"></i> 
        <?php
        //if($section == 'QUICKLINK'){
         // echo 'List Quick Link Pages';
        //}else{
        //  echo 'List Support Pages';
        //} 
        echo 'CMS Pages';
        ?>
        
        <?php
            if($userPermission['add']){
              ?>
        <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/cms/add"><i class="fa fa-plus"></i> Add New Page </a>
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
          <table class="table table-bordered dragtablecmspages" id="dataTableother" width="100%" cellspacing="0">
          <thead>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
            <select name="" id="multiple_type" class="cms_multiple_type multi_select" data-action="cms/delete-active-inactive-multiple-page">
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
              <th>PageName</th>
              <th>Slug</th>
              <th>Added / Modified Date</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          </thead>
           
            <tbody>
              <?php
              //print_r($cat_lists);
              if(is_array($cmsList) && count($cmsList)>0){
                $i=0;
              foreach($cmsList as $cList){
                $i++;
                ?>
              <tr id="<?php echo $cList['pageID'];?>">
              <td><input type="checkbox" id="check" name="check" value="<?php echo $cList['pageID']; ?>"></td>
              <td><?php echo $i ; ?></td>
                <td><?php echo $cList['pageName'];?></td>
                <td><?php 
                if($cList['pageSlug'] == 'PARTNERSPREDEFINED' || $cList['pageSlug'] == 'ADVISORYPREDEFINED' || $cList['pageSlug'] == 'ABOUTUSPREDEFINED')
                {
                  echo '';  
                  $editdel = 'off';              
                }else{
                  echo $cList['pageSlug'];
                  $editdel = 'on'; 
                }
                ?></td>
                <td><?php echo ($cList['modifiedOn'] != "") ? date('Y-m-d H:i:s', strtotime($bList['modifiedOn'])) : date('Y-m-d H:i:s', strtotime($cList['addedOn']));?></td>
                      
                <td><?php echo ($cList['pageStatus'] == 1) ? "Active" : "Inactive";?></td>
                <td>
                <?php
            if($userPermission['edit']){
              ?>
                   <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/cms/EditCMSPages/'.$cList['pageID']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                   <?php
            }
            if($userPermission['delete']){
            ?>
                    <a class="btn btn-sm btn-danger deleteRow deleteCMS" href="javascript:void(0);" data-delete-href="<?php echo base_url().'admin/cms/delete/'.$cList['pageID']; ?>" data-type="cms" title="Delete"><i class="fa fa-trash"></i></a>
                    <?php }
            ?>   
                   
                </td>
              </tr>
                <?php
              }
            }else{
              ?>
              <tr>
                <td colspan="5" align="center"> No data found.</td>
              </tr>
              <?php
            }
            ?>
            </tbody>
          </table>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
            <select name="" id="multiple_type" class="cms_multiple_type multi_select" data-action="cms/delete-active-inactive-multiple-page">
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
          <?php echo $this->pagination->create_links(); ?>
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
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this page?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>