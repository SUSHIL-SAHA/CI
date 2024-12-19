<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Contact mail</li>
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
                <i class="fa fa-table"></i>Contact mail

                <div class="hidden" style="display:none;">
                    <form action="<?php echo base_url();?>admin/communication/mailfilter">
                        <div class="form-group">
                            <input class="form-control" value="<?php echo $name_email ; ?>" name="name_email"
                                type="text" placeholder="Search by Name / Email">
                        </div>
                        <div class="form-group">
                            <select name="status" id="status" class="">
                                <option value="">Status</option>
                                <option value="Read" <?php if($status == 'Read') { echo "selected" ; } ?>>Read</option>
                                <option value="Unread" <?php if($status == 'Unread') { echo "selected" ; } ?>>Unread
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="Search" class="btn btn-info width-auto"><i
                                    class="fa fa-search"></i></button>
                            <button type="submit" name="Reset" class="btn btn-dark width-auto m-l-10"><i
                                    class="fa fa-refresh"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <?php 
          // pre($blogLists);
        ?>
            <div class="card-body">
                <div class="table-responsive">
                    <input type="hidden" class="txt_csrfname"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" name="checkAll"></th>
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Records Found : <?php echo count($mail_details) ; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              //print_r($cat_lists);
              if(!empty($mail_details)){
                $i=0;
                foreach($mail_details as $mail){
                  $i++;
                ?>
                            <tr id="blog-<?php echo base64_encode($mail->id);?>">
                                <td><input type="checkbox" id="check" name="check" value="<?php echo $mail->id; ?>">
                                </td>
                                <td><?php echo $i ;?></td>
                                <td><a
                                        href="<?php echo base_url();?>admin/communication/mailedit/<?php echo $mail->id ; ?>"><?php echo  $mail->name; ?></a>
                                </td>
                                <td><?php echo  $mail->email; ?></td>
                                <th><?php echo $newdateformat = date("D, d M Y", strtotime($mail->created_on)); ?>
                                </th>
                                <td>
                                    <?php if($mail->status == 'Unread') { ?>
                                    <span class="label label-danger">Unread</span>
                                    <?php } ?>
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
                        <select name="" id="multiple_type" class="contact_mail_multiple_type multi_select" data-action="communication/delete-active-inactive-multiple-communication">
                            <option value="">Select</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
        </div>
        <!-- /tables-->
    </div>
    <!-- /container-fluid-->
</div>
<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this Content?</h4>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
    </div>
</div>