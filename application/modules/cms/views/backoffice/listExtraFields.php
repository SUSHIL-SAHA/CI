<?php
/**
 * The Page extra fields list page 
 */
?>
<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">CMS Page Extra Fields</li>
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

    <!-- DataTables Card-->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> 
        <?php echo 'CMS Page Extra Fields here'; ?>
        <?php if($userPermission['add']){ ?>
        <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/cms/add-custom-field"><i class="fa fa-plus"></i> Add Custom Field </a>
        <?php } ?>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <?php
          if($userPermission['list']){
            ?>
            <!-- dragtablecmspages -->
          <table class="table table-bordered " id="dataTableother" width="100%" cellspacing="0">
          <thead>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
          <div class="bottom-select">
            <select name="" id="multiple_type" class="custom_multiple_type multi_select" data-action="cms/delete-active-inactive-multiple-custom-field">
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
              <th>Field Name</th>
              <th>Meta Key</th>
              <th>Field Type</th>
              <th>Page Name</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          </thead>
           
          <tbody>
              <?php
              //print_r($cat_lists);
              if(is_array($customFields) && count($customFields)>0){
                $i=0;
              foreach($customFields as $cKey => $customField){
                $i++;
                ?>
                <tr id="<?php echo $customField['id'];?>">
                  <td><input type="checkbox" id="check" name="check" value="<?php echo $customField['id']; ?>"></td>
                <td><?php echo $customField['field_title'];?></td>
                <td><?php echo $customField['meta_key'];?></td>
                <td><?php echo $customField['field_type'];?></td>
                <td><?php echo $customField['pageName'];?></td>
                <td><?php echo ucwords($customField['status']);?></td>
                
                <td>
                <?php
            if($userPermission['edit']){
              ?>
                   <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/cms/EditCustomField/'.$customField['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                   <?php
            }
            if($userPermission['delete']){
            ?>
                    <a class="btn btn-sm btn-danger deleteRow deleteCMS" href="javascript:void(0);" data-delete-href="<?php echo base_url().'admin/cms/deleteCustomField/'.$customField['id']; ?>" data-type="cms" title="Delete"><i class="fa fa-trash"></i></a>
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
            <select name="" id="multiple_type" class="custom_multiple_type multi_select" data-action="cms/delete-active-inactive-multiple-custom-field">
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

<?php /*
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> 
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>administrator/addExtraField"><i class="fa fa-plus"></i> Add New Field</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="resulting_div alert-messages">
                <?php echo $this->session->flashdata('page_cms_msg'); ?>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Page Field List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="packageLists" class="table table-bordered table-striped datatable" data-sortcol="2" data-sortorder="asc">
                    <thead>
                      <tr>
                        <th>Field Name</th>
                        <th>Meta Key</th>
                        <th>Page Name</th>
                        <th>Added Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        if(count($listPageExtraFields) > 0){
                          foreach($listPageExtraFields as $lpField){
                            ?>
                            <tr id="page-<?php echo base64_encode($lpField['id']);?>">
                              <td><?php echo $lpField['field_title'];?></td>
                              <td><?php echo $lpField['meta_key'];?></td>
                              <td><?php echo $lpField['page_name'];?></td>
                              <td><?php echo $lpField['added_on'];?></td>
                              <td>
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'administrator/editExtraField/'.$lpField['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-sm btn-danger deletePageField" href="javascript:void(0);" data-fieldid="<?php echo $lpField['id']; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                              </td>
                            </tr>
                            <?php
                          }
                        }
                      ?>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Field Name</th>
                        <th>Meta Key</th>
                        <th>Page Name</th>
                        <th>Added Date</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php //echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

*/ ?>