<div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Inquiry Lists</li>
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
            <th>Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Service</th>
            <th>Status</th>
            <th>Acceptance</th>
            <th>Added / Modified Date</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
              <?php
              // echo "<pre>"; print_r($serviceinquirylist);
              if(!empty($serviceinquirylist)){
                $i=0;
                if($_GET['page'] == "")
                {
                  $page = 0;
                }
                else
                {
                  $page = $per_page * ($_GET['page'] - 1);
                }

                foreach($serviceinquirylist as $siList){
                 $i = $i + 1;
                  $pageNo = $page + $i;
                  
                ?>
              <tr id="blog-<?php echo base64_encode($siList['service_inquiry_id']);?>">
              <td><?php echo $pageNo; ?></td>
              <td> <a href="<?php echo base_url() ; ?>admin/inquiry/service-inquiry-details/<?php echo $siList['service_inquiry_id'] ; ?>"><?php echo $siList['name'];?></a></td>
              <td><?php echo $siList['email'];?></td>
              <td><?php echo $siList['phone'];?></td>
              <td><?php echo $siList['service'];?></td>
              <td>
                <figure>
                  <img src="<?php echo base_url();?>assets/admin/img/<?php echo ($siList['quotation_id'] != '' ? 'tick' : 'close'); ?>.png" alt="Quotation <?php echo ($siList['quotation_id'] != '' ? 'Sent' : 'Not Sent'); ?>" title="Quotation <?php echo ($siList['quotation_id'] != '' ? 'Sent' : 'Not Sent'); ?>" />
                </figure>Quotation <?php echo ($siList['quotation_id'] != '' ? 'Sent' : 'Not Sent'); ?>
              </td>
              <?php 
                $eclass = "";
                $acctVal = "";
                  switch ($siList['payment_made']) {
                    default:
                      $eclass = "";
                      $acctVal = 'Quotation Not Sent';
                    break;
                    case 'N':
                      $eclass = "wait";
                      $acctVal = 'Waiting For Acceptance';
                    break;
                    case 'Y':
                      $eclass = "accept";
                      $acctVal = 'Accepted';
                    break;
                    case 'R':
                      $eclass = "reject";
                      $acctVal = 'Rejected';
                    break;
                  }

                ?>
              <td class="<?php echo $eclass; ?>">
                <?php echo $acctVal; ?>
              </td>
              <td><?php echo date('D, d M Y', strtotime($siList['created_on'])) ;?></td>
              <td>
                <a class="btn btn-sm btn-info" href="<?php echo base_url() ; ?>admin/inquiry/service-inquiry-details/<?php echo $siList['service_inquiry_id'] ; ?>" title="View"><i class="fa fa-eye"></i></a>
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
      <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
         
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
        <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete inquiry?</h4>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>


     