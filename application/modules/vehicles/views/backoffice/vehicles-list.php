
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url();?>admin/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Vehicles Lists</li>
        </ol>
        <?php
            $error = $this->session->flashdata("error");
            if($error) {
                ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata("error"); ?>
        </div>
                <?php 
            }
            $success = $this->session->flashdata("success");
            if($success) { 
                ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $this->session->flashdata("success"); ?>
        </div>
                <?php 
            }
        ?>
                <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Vehicles Lists
                <?php
                    if($userPermission["add"]){
                        ?>
                <a style="float:right;" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>admin/vehicles/add"><i class="fa fa-plus"></i> Add New Vehicles </a> 
                        <?php
                    }
                ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                        <?php
                            if($userPermission["list"]){
                                ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                                <?php
                                    if($userPermission["edit"] || $userPermission["delete"]){
                                        ?>
                            <div class="bottom-select">
                                <select name="" id="multiple_type" class="service_multiple_type multi_select" data-action="service/delete-active-inactive-multiple-service">
                                    <option value="">Select</option>
                                        <?php
                                            if($userPermission["edit"]){
                                                ?>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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
                                <th>Vehicle Name</th>
                                <th>Added / Modified Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //print_r($page_variable_name);
                                if(!empty($vehicleList)){
                                    $i=0;
                                    foreach($vehicleList as $row){
                                        $i++;
                                        ?>
                            <tr id="blog-<?php echo base64_encode($row["id"]);?>">
                                <td><input type="checkbox" id="check" name="check" value="<?php echo $row["id"]; ?>"></td>
                                <td><?php echo $i ;?></td>
                                <td><?php echo $row["vehicle_name"]; ?></td>
                                <td><?php echo ($row["addedOn"] != "") ? date("d F Y H:i:s", strtotime($row["addedOn"])) : date("d F Y H:i:s", strtotime($row["modifiedOn"]));?></td>
                                <td><?php echo ($row["vehicle_status"] == 1) ? "Active" : "Inactive";?></td>
                                <td>
                                    <?php
                                        if($userPermission["edit"]){
                                            ?>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url()."admin/vehicles/edit/".$row["id"]; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <?php
                                        }
                                        if($userPermission["delete"]){
                                            ?>
                                    <a class="btn btn-sm btn-danger deleteRow deleteVehicle" href="javascript:void(0);" data-delete-href="<?php echo base_url()."admin/vehicles/delete/".$row["id"]; ?>" data-type="blog" title="Delete"><i class="fa fa-trash"></i></a>
                                            <?php
                                        }
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
                                <?php
                                if($userPermission["edit"] || $userPermission["delete"]){
                                    ?>
                    <div class="bottom-select">
                        <select name="" id="multiple_type" class="service_multiple_type multi_select" data-action="service/delete-active-inactive-multiple-service">
                            <option value="">Select</option>
                                    <?php
                                    if($userPermission["edit"]){
                                        ?>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
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
        <!-- /tables-->
    </div>
    <!-- /container-fluid-->
</div>

<div class="modal" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="deleteModalLabel">Are you sure want to delete this Vehicle</h4>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-primary" id="delete">Delete</a>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
        </div>
    </div>
</div>


                         