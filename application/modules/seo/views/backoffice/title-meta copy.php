
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url();?>admin/seo/default-home">SEO</a>
        </li>
        <li class="breadcrumb-item active">Title & Meta</li>
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

    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i> Title & Meta        
        <?php if($userPermission['add']){ ?>
            <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url() ; ?>admin/seo/title-meta-add"><i class="fa fa-plus"></i> Add Title Meta</a>
        <?php } ?>
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
            <!-- <div class="alert alert-success">Records Found: <?php echo count($title_mete_details) ; ?></div> -->
          <div class="bottom-select">
            <select name="" id="multiple_type" class="cms_multiple_type">
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
                <th width="40"><input type="checkbox" id="checkAll" name="checkAll"></th>
                <th width="60">Sl.</th>
                <th>Page Url</th>
                <th width="250"></th>
            </tr>
            </thead>
            <tbody>

            <?php $i= 0 ; foreach($title_mete_details as $row) { $i++; ?>           
            <tr id="recordsArray_<?php echo $row->id ; ?>">
            
            <td width="40"><input type="checkbox" id="check" name="check" value="<?php echo $row->id ; ?>"></td>
                        
            <td width="60" scope="row"><?php echo $i ; ?></td>

            <td>
            <a href="<?php echo base_url();?>admin/seo/title-meta-edit/<?php echo $row->id ; ?>"><?php echo $row->titleandMetaUrl ; ?></a>
            </td>

            <td width="250" class="last_li">
                <div class="action_link">
                <span class="status statusRobot"><?php echo $row->metaRobotsIndex ; ?>, <?php echo $row->metaRobotsFollow ; ?></span>
                    <a href="<?php echo $row->titleandMetaUrl ; ?>" target="_blank" class="btn btn-sm"><i class="fa fa-link"></i> Visit Page</a>
                </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
          </table>
          <?php
            if($userPermission['edit'] || $userPermission['delete']){
              ?>
                <div class="bottom-select">
                    <select name="" id="multiple_type" class="cms_multiple_type">
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
    </div>










        <!-- Example DataTables Card-->
        <div class="container-fluid">
            <div class="box_general padding_bottom adm-box">
                <div class="row">
                    <div class="col-sm-9">
                        <form name="searchForm" action="<?php echo base_url();?>admin/seo/search-meta-title" method="post">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <div class="form-inline">
                                <div class="form-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText ; ?>" placeholder="Search by URL" class="form-control">
                                </div>
                                
                                <div class="form-group">
                                    <select name="searchRobots" class="form-control">
                                        <option value="">Robots</option>
                                        <option value="index, follow" <?php if($searchRobots == 'index, follow') { echo 'selected' ; }?>>index, follow</option>
                                        <option value="index, nofollow" <?php if($searchRobots == 'index, nofollow') { echo 'selected' ; }?>>index, nofollow</option>
                                        <option value="noindex, follow" <?php if($searchRobots == 'noindex, follow') { echo 'selected' ; }?>>noindex, follow</option>
                                        <option value="noindex, nofollow" <?php if($searchRobots == 'noindex, nofollow') { echo 'selected' ; }?>>noindex, nofollow</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" name="Search" class="btn btn-info width-auto"><i class="fa fa-search"></i></button>
                                    <button type="submit" name="Reset" class="btn btn-dark width-auto m-l-10"><i class="fa fa-refresh"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php if($userPermission['add']){ ?> 
                    <div class="col-sm-3">
                        <a href="<?php echo base_url() ; ?>admin/seo/title-meta-add" class="btn btn-info">Add Title Meta</a>
                    </div>
                    <?php } ?>
                </div>
            </div>                
            <!-- <form action="" method="post"> -->
            <div class="row">               
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <?php
                            if($userPermission['list']){
                        ?> 
                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="40"><input type="checkbox" id="checkAll" name="checkAll"></th>
                                        <th width="60">Sl.</th>
                                        <th>Page Url</th>
                                        <th width="250"><div class="alert alert-success">Records Found: <?php echo count($title_mete_details) ; ?></div></th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php $i= 0 ; foreach($title_mete_details as $row) { $i++; ?>           
                                <tr id="recordsArray_<?php echo $row->id ; ?>">
                                
                                <td width="40"><input type="checkbox" id="check" name="check" value="<?php echo $row->id ; ?>"></td>
                                            
                                <td width="60" scope="row"><?php echo $i ; ?></td>

                                <td>
                                <a href="<?php echo base_url();?>admin/seo/title-meta-edit/<?php echo $row->id ; ?>"><?php echo $row->titleandMetaUrl ; ?></a>
                                </td>

                                <td width="250" class="last_li">
                                    <div class="action_link">
                                    <span class="status statusRobot"><?php echo $row->metaRobotsIndex ; ?>, <?php echo $row->metaRobotsFollow ; ?></span>
                                        <a href="<?php echo $row->titleandMetaUrl ; ?>" target="_blank" class="btn btn-sm"><i class="fa fa-link"></i> Visit Page</a>
                                    </div>
                                    </td>
                                </tr>
                            <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                    <?php if($userPermission['edit'] || $userPermission['delete']){ ?>
                    <div class="card m-t-20">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 pull-right">
                                    <div class="last_li form-inline">
                                        <select id="multiple_type" class="form-control multi-action">
                                            <option value="">Select</option>
                                            <?php if($userPermission['edit']){ ?>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                            <?php } 
                                            if($userPermission['delete']){
                                            ?>
                                            <option value="3">Delete</option>
                                            <?php } ?>
                                        </select>  
                                        <!-- <input type="hidden" name="SourceForm" value="multiAction">
                                        <button type="submit" name="Save" value="Apply" class="btn btn-info m-l-10">Apply</button> -->
                                    </div>
                                </div>
                                                                </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- </form> -->
        </div> 
    </div>
</div>

<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this Inner Banner?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>

  