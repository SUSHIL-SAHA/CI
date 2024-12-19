<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <!-- <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">My Dashboard</li>
    </ol> -->
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
      <!-- Icon Cards-->

    <div class="row">
      <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-default o-hidden">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-user"></i>
            </div>
            <div class="mr-5"><h5><?php echo $noOfQuotations['no_of_quotations']; ?> Quotations</h5></div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="<?php base_url();?>service-inquiry">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>


      <div class="col-xl-4 col-sm-6 mb-3">
        <div class="card dashboard text-white bg-success o-hidden">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fa fa-dollar"></i>
            </div>
            <div class="mr-5"><h5><?php echo $noOfPayments['no_of_payments']; ?> Payments</h5></div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="<?php base_url();?>payments">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fa fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid-->
</div>

    