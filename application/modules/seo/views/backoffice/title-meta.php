<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url(); ?>admin/seo/default-home">SEO</a>
      </li>
      <li class="breadcrumb-item active">Title & Meta</li>
    </ol>
    <?php
    $error = $this->session->flashdata('error');
    if ($error) {
    ?>
      <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $this->session->flashdata('error'); ?>
      </div>
    <?php
    }

    $success = $this->session->flashdata('success');
    if ($success) {
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
          <input type="text" placeholder="Search by page name">
        <?php if ($userPermission['add']) { ?>
          <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/seo/title-meta-add"><i class="fa fa-plus"></i> Add Title Meta</a>
        <?php } ?>
      </div>
      <?php
      // pre($blogLists);
      ?>
      <div class="card-body">
        <div class="table-responsive">
          <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
          <?php
          if ($userPermission['list']) {
          ?>
            <table class="table table-bordered dragtablecmspages" id="dataTableother" width="100%" cellspacing="0">
              <thead>
                  <!-- <div class="alert alert-success">Records Found: <?php echo count($title_mete_details); ?></div> -->
                <tr>
                  <th width="40"><input type="checkbox" id="checkAll" name="checkAll"></th>
                  <th width="60">Sl.</th>
                  <th>Page Url</th>
                  <th width="250"></th>
                </tr>
              </thead>
              <tbody>

                <?php $i = 0;
                foreach ($title_mete_details as $row) {
                  $i++; ?>
                  <tr id="recordsArray_<?php echo $row->id; ?>">

                    <td width="40"><input type="checkbox" id="check" name="check" value="<?php echo $row->id; ?>"></td>

                    <td width="60" scope="row"><?php echo $i; ?></td>

                    <td>
                      <a href="<?php echo base_url(); ?>admin/seo/title-meta-edit/<?php echo $row->id; ?>"><?php echo base_url(). $row->titleandMetaUrl; ?></a>
                    </td>

                    <td width="250" class="last_li">
                      <div class="action_link">
                        <span class="status statusRobot"><?php echo $row->metaRobotsIndex; ?>, <?php echo $row->metaRobotsFollow; ?></span>
                        <a href="<?php echo base_url(). $row->titleandMetaUrl; ?>" target="_blank" class="btn btn-sm"><i class="fa fa-link"></i> Visit Page</a>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php
            if ($userPermission['edit'] || $userPermission['delete']) {
            ?>
              <div class="bottom-select">
              <select name="" id="multiple_type" data-action="seo/multiple-delete-active-inactive" class="cms_multiple_type multi_select">
                  <option value="">Select</option>
                  <?php
                  if ($userPermission['delete']) {
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
    </div>


  </div>
</div>

<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this meta?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>