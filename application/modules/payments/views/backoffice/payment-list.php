<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Payment Lists</li>
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
        <i class="fa fa-table"></i>Payment Lists
        <?php
            if($userPermission['add']){
              ?>
          <!-- <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/careers/addcareers"><i class="fa fa-plus"></i> Add New Job</a> -->
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
          //if($userPermission['list']){
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>SL NO</th>
                  <th>Order ID</th>
                  <th>Email</th>
                  <th>Paid Via</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Added / Modified Date</th>
                </tr>
              </thead>
              <tbody>
              <?php
              //print_r($cat_lists);
              if(!empty($paymentList)){
                $i=0;
                foreach($paymentList as $pKey => $siList){
                  $i++;
                  ?>
              <tr id="blog-<?php echo base64_encode($pKey);?>">
                <td><?php echo $i;?></td>
                <td><?php echo $siList['order_id'];?></td>
                <td><?php echo $siList['payer_email'];?></td>
                <td><?php echo ucfirst($siList['payment_gateway']);?></td>
                <td><?php echo '$'.$siList['amount_paid'];?></td>
                <td>Paid</td>
                <td><?php echo date('D, d M Y', strtotime($siList['payment_created_on']));?></td>
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
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete Payment?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>


     