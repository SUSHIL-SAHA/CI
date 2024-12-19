<?php 
    // pre($serviceinquirydetails);
?>
<div class="content-wrapper inquearydetail_section">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url()?>/admin/service-inquiry">Inquiry list</a>
            </li>
            <li class="breadcrumb-item active">Inquiry Details</li>
        </ol>
        <div class="box_general padding_bottom">
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

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="header_box version_2">

                            <a class="btn btn-primary btn-sm pull-right"
                                href="<?php echo base_url(); ?>admin/service-inquiry"><i
                                    class="fa fa-level-up"></i> Back to list</a>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <br clear="all">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="AddEditcontentId"
                            action="<?php echo base_url(); ?>admin/communication/contentinsert" method="post"
                            role="form" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <h3>Your Details</h3>
                                                <label for="blogName"><span>Email :</span>  <?php echo $serviceinquirydetails->email; ?></label>
                                                <label for="blogName"><span>Name :</span> <?php echo $serviceinquirydetails->name;?> <?php echo $serviceinquirydetails->surname;?></label>
                                                <label for="blogName"><span>Phone Number :</span>   <?php echo $serviceinquirydetails->phone;?></label>
                                            </div>
                                            <div class="form-group col-12">
                                                <h3>Tell Us a Bit About Your Move</h3>
                                                <label for="blogName"><span>Preferred time :</span>   <?php echo $serviceinquirydetails->service_time;?></label>
                                                <label for="blogName"><span>Preferred date :</span>   <?php echo $serviceinquirydetails->service_date;?></label>
                                                <?php foreach ($vehicleDetails as $vKey => $vVal) { if($serviceinquirydetails->vehicleId == $vVal['id']){?><label for="blogName"><span>What size of van do you need for? :</span>   <?php echo $vVal['vehicle_name'];?></label><?php } }?>
                                                <label for="blogName"><span>Do you need help with loading and unloading? :</span>   <?php echo $serviceinquirydetails->help_loading_unloading;?></label>
                                                <label for="blogName"><span>How many hours do you need for? :</span>   <?php echo $serviceinquirydetails->need_hours;?> Hours</label>
                                                <label for="blogName"><span>What kind of service do you need? :</span>   <?php echo $serviceinquirydetails->service;?></label>
                                                <label for="blogName"><span>Do you require packing services? :</span>   <?php echo $serviceinquirydetails->packing_services;?></label>
                                                <label for="blogName"><span>Do you require packing materials? :</span>   <?php echo $serviceinquirydetails->packing_materials;?></label>
                                            </div>
                                            <div class="form-group col-12">
                                                <h3>Details of Collection Address</h3>
                                                <div class="subtitle">Collection address</div>
                                                <label for="blogName"><span>Number :</span>  <?php echo $serviceinquirydetails->pickup_address_number;?></label>
                                                <label for="blogName"><span>Street :</span>  <?php echo $serviceinquirydetails->pickup_address_street;?></label>
                                                <label for="blogName"><span>City :</span>  <?php echo $serviceinquirydetails->pickup_address_city;?></label>
                                                <label for="blogName"><span>Postcode:</span>  <?php echo $serviceinquirydetails->pickup_address_postcode;?></label>
                                                <label for="blogName"><span>Which floor? :</span>  <?php echo $serviceinquirydetails->pickup_address_floor;?></label>
                                                <label for="blogName"><span>Is there lift available? :</span> <?php echo $serviceinquirydetails->pickup_address_lift_available;?></label>
                                                <label for="blogName"><span>Is there parking space? :</span> <?php echo $serviceinquirydetails->pickup_address_parking_space;?></label>
                                                <label for="blogName"><span>Number of movers :</span> <?php echo $serviceinquirydetails->pickup_address_movers;?></label>
                                                <div class="subtitle">Via address</div>
                                                <label for="blogName"><span>Number :</span>  <?php echo $serviceinquirydetails->via_address_number;?></label>
                                                <label for="blogName"><span>Street :</span>  <?php echo $serviceinquirydetails->via_address_street;?></label>
                                                <label for="blogName"><span>City :</span>  <?php echo $serviceinquirydetails->via_address_city;?></label>
                                                <label for="blogName"><span>Postcode :</span>  <?php echo $serviceinquirydetails->via_address_postcode;?></label>
                                                <label for="blogName"><span>Which floor? :</span>  <?php echo $serviceinquirydetails->via_address_floor;?></label>
                                                <label for="blogName"><span>Is there lift available? :</span> <?php echo $serviceinquirydetails->via_address_lift_available;?></label>
                                                <label for="blogName"><span>Is there parking space? :</span> <?php echo $serviceinquirydetails->via_address_parking_space;?></label>
                                            </div>
                                            <div class="form-group col-12">
                                                <h3>Details of Delivery Address</h3>
                                                <div class="subtitle">Delivery address</div>
                                                <label for="blogName"><span>Number :</span>  <?php echo $serviceinquirydetails->dropoff_address_number;?></label>
                                                <label for="blogName"><span>Street :</span>  <?php echo $serviceinquirydetails->dropoff_address_street;?></label>
                                                <label for="blogName"><span>City :</span>  <?php echo $serviceinquirydetails->dropoff_address_city;?></label>
                                                <label for="blogName"><span>Postcode:</span>  <?php echo $serviceinquirydetails->dropoff_address_postcode;?></label>
                                                <label for="blogName"><span>Which floor? :</span>  <?php echo $serviceinquirydetails->dropoff_address_floor;?></label>
                                                <label for="blogName"><span>Is there lift available? :</span> <?php echo $serviceinquirydetails->dropoff_address_lift_available;?></label>
                                                <label for="blogName"><span>Is there parking space? :</span> <?php echo $serviceinquirydetails->dropoff_address_parking_space;?></label>
                                                <label for="blogName"><span>Number of movers :</span> <?php echo $serviceinquirydetails->dropoff_address_movers;?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="product_details">
                                            <?php if($service_inquire_product_details) { foreach($service_inquire_product_details as $row) { ?>
                                            <div class="service_details_card" role="alert">
                                                <figure><img
                                                        src="<?php echo base_url() ; ?>/uploads/product_image/<?php echo $row['product_image'] ; ?>">
                                                </figure>
                                                <span><?php echo $row['product_title'] ;?></span>Qty:<?php echo $row['product_qty'] ;?>
                                            </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                    <div>
                                    <!-- <input type="button"
                                        onclick="location.href='<?php echo base_url().'admin/service/sand-email/'.$serviceinquirydetails->service_inquiry_id;?>'"
                                        class="btn btn-default" value="Send email" />
                                    </div> -->
                                    <?php 
                                        if(empty($quotationdetails)){
                                    ?>
                                    <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#create_quotation">Create Quotation</a>
                                    <input type="button" onclick="location.href='<?php echo base_url(); ?>admin/service-inquiry';" class="btn btn-default" value="Cancel"/>
                                    <?php } else { ?>
                                    <a href="<?php echo base_url(); ?>uploads/quotation_pdfs/<?php echo $quotationdetails->invoice_number; ?>_quotation.pdf" target="_blank" class="btn btn-info">View Quotation PDF</a>
                                    <?php } ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="myModalShowImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Image preview</h4>
            </div>
            <div class="modal-body">
                <img src="" id="imagepreview" style="max-width: 100%; height: 264px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create_quotation" tabindex="-1" aria-labelledby="create_quotation" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <form class="contact_form" id="quotation_form" method="post">
                        <div class="heading">
                            Quotation Summary
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <p>Client Name: <strong><?php echo $serviceinquirydetails->name; ?></strong></p>
                            </div>
                            <div class="form-group col-md-6">
                                <p>Service Chosen: <strong><?php echo $serviceinquirydetails->service; ?></strong></p>
                            </div>
                            <div class="form-group col-md-12">
                                <h5>Products</h5>
                                <div class="product_details">
                                    <?php
                                        if($service_inquire_product_details) {
                                            foreach($service_inquire_product_details as $row) {
                                            ?>
                                    <div class="service_details_card" role="alert">
                                        <figure>
                                            <img src="<?php echo base_url() ; ?>/uploads/product_image/<?php echo $row['product_image'] ; ?>">
                                        </figure>
                                        <span><?php echo $row['product_title'] ;?></span>Qty:<?php echo $row['product_qty'] ;?>
                                    </div>
                                            <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <p>Pickup Address: <strong><?php echo $serviceinquirydetails->pickup_address;?> (<?php echo $serviceinquirydetails->pickup_address_floor;?> Floor)</strong></p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <p>Dropoff Address: <strong><?php echo $serviceinquirydetails->dropoff_address;?> (<?php echo $serviceinquirydetails->dropoff_address_floor;?> Floor)</strong></p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <p>Client Email: <strong><?php echo $serviceinquirydetails->email; ?></strong></p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <p>Client Phone Number: <strong><?php echo $serviceinquirydetails->phone; ?></strong></p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <p>Preferred date:
                                        <strong class="iconDiv">
                                            <i class="fa fa-calendar-o"></i><?php echo $serviceinquirydetails->service_date; ?>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <p>Preferred time:
                                        <strong class="iconDiv">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $serviceinquirydetails->service_time; ?>
                                        </strong>
                                    </p>
                                </div>   
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <h5>Choose Vehicle To Send</h5>
                                    <select name="vehicleId" id="vehicleId" class="form-control">
                                        <option value="" selected>Select vehicle</option>
                                        <?php 
                                            foreach ($vehicleDetails as $vKey => $vVal) {
                                                # code...
                                                ?>
                                        <option <?php echo ($serviceinquirydetails->vehicleId == $vVal['id']) ? 'selected="selected" ' : ''; ?>value="<?php echo $vVal['id']; ?>"><?php echo $vVal['vehicle_name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="product_details">
                                    <h5>Quoted Price (Number Only)</h5>
                                    <input type="text" autoComplete="off" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="quoted_price" id="quoted_price" placeholder="Enter Price e.g 2000">
                                </div>
                            </div>
                        </div>
                        <div class="btn-wrap">
                            <button type="submit" class="btn" id="send_quotation_btn">Send Quotation</button>
                            <input type="hidden" name="hidden_inquiry_id" value="<?php echo $serviceinquirydetails->service_inquiry_id; ?>" />
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <p class="quotation_message"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<script>
var images = [];
<?php
    if ($blogImage != '') {
        $blogImgArr = explode(',', $blogImage);
        if (is_array($blogImgArr) && count($blogImgArr) > 0) {
            foreach ($blogImgArr as $val) {
    ?>
images.push('<?php echo $val; ?>');
<?php
            }
        }
    }
    ?>
</script>