<!doctype html>
<html lang="en">
    <head> 
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>assets/front/images/favicon.ico">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/toastr.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/style1.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/css/responsive.css">

        <title>Payment Of Invoice #<?php echo $orderDetails->order_number; ?> - <?php echo site_settings_data('site_title');?></title>
    </head>
    <body>
        <!-- header section html starts from here-->
        <header>
            <section class="payment_header_area" style="margin-bottom:20px; ">
                <div class="container">
                    <div class="row row-bg">
                        <div class="col-lg-2">
                            <div class="left-side">
                                <img class="logo" src="<?php echo base_url(). "uploads/sitesettings_image/".site_settings_data('logo_image');?>" alt="ln-service">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center pb-5">
                                <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
                                    <div class="py-4 d-flex flex-row">
                                        <h5><span class="fa fa-shopping-cart pe-2"></span> Order Number <b>#<?php echo $orderDetails->order_number; ?></b></h5>
                                    </div>
                                    <div class="d-flex pt-2">
                                        <div>
                                            <p>
                                                <b>Collection Address</b>
                                            </p>
                                        </div>
                                    </div>
                                    <p>
                                        <?php echo $orderDetails->name.' '.$orderDetails->surname.'<br/>'.$orderDetails->phone.'<br/>'.$orderDetails->email; ?>
                                    </p>
                                    <p>
                                        <?php echo $orderDetails->pickup_address_number.', '.$orderDetails->pickup_address_street.', '.$orderDetails->pickup_address_city.', '.$orderDetails->pickup_address_postcode.', Floor - '.$orderDetails->pickup_address_floor; ?>
                                    </p>
                                    <hr />
                                    <div class="d-flex pt-2">
                                        <div>
                                            <p>
                                                <b>Delivery Address</b>
                                            </p>
                                        </div>
                                    </div>
                                    <p>
                                        <?php echo $orderDetails->name.' '.$orderDetails->surname.'<br/>'.$orderDetails->phone.'<br/>'.$orderDetails->email; ?>
                                    </p>
                                    <p>
                                        <?php echo $orderDetails->dropoff_address_number.', '.$orderDetails->dropoff_address_street.', '.$orderDetails->dropoff_address_city.', '.$orderDetails->dropoff_address_postcode.', Floor - '.$orderDetails->dropoff_address_floor; ?>
                                    </p>
                                    <div class="pt-2">
                                        <form class="pb-3" method="post" action="<?php echo base_url();?>pay_via">
                                            <label class="d-flex flex-row pb-3" for="pay_via_paypal">
                                                <div class="rounded border d-flex w-100 p-3 align-items-center">
                                                    <input type="radio" class="mr-3" name="payment_type" id="pay_via_paypal" value="paypal" aria-label="..." checked />
                                                    <p class="mb-0"> <i class="fa fa-cc-paypal fa-lg text-primary pe-2"></i> Paypal </p>
                                                </div>
                                            </label>

                                            <label class="d-flex flex-row" for="pay_via_stripe">
                                                <div class="rounded border d-flex w-100 p-3 align-items-center">
                                                    <input class="mr-3" type="radio" name="payment_type" id="pay_via_stripe"
                                                    value="stripe" aria-label="..." />
                                                    <p class="mb-0">
                                                        <i class="fa fa-cc-stripe fa-lg text-dark pe-2"></i> Stripe
                                                    </p>
                                                </div>
                                            </label>
                                            <input type="hidden" name="order_number" value="<?php echo $orderDetails->order_number; ?>" />
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                            <input type="submit" value="Proceed to payment" class="btn btn-primary btn-block btn-lg" />
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-5 col-xl-4 offset-xl-1">
                                    <div class="py-4 d-flex justify-content-end">
                                        <h6><a href="javascript:void(0);">Cancel and return to website</a></h6>
                                    </div>
                                    <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                                        <div class="p-2 me-3">
                                            <h4 style="font-size:20px;">Order Items</h4>
                                        </div>
                                        <?php 
                                            foreach ($getOrderItems as $goKey => $goValue) {
                                                # code...
                                                ?>
                                        <div class="p-2 d-flex">
                                            <div class="col-6"><?php echo $goValue['product_title']; ?></div>
                                            <div class="ms-auto">x <?php echo $goValue['product_qty']; ?></div>
                                        </div>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                                        <div class="p-2 me-3">
                                            <h4 style="font-size:20px;">Delivery Time</h4>
                                        </div>
                                        <div class="p-2 d-flex">
                                            <div class="col-6">Prefered Date</div>
                                            <div class="ms-auto"><?php echo date('jS F, Y', strtotime($orderDetails->service_date)); ?></div>
                                        </div>
                                        <div class="p-2 d-flex">
                                            <div class="col-6">Prefered Time</div>
                                            <div class="ms-auto"><?php echo date('h:i A', strtotime($orderDetails->service_time)); ?></div>
                                        </div>
                                        <div class="border-top px-2 mx-2"></div>
                                        <div class="p-2 d-flex pt-3">
                                            <div class="col-6"><b>Quoted Amount</b></div>
                                            <div class="ms-auto"><b class="text-success">$<?php echo $orderDetails->quoted_price?></b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>
    </body>
    <script> var base_url = '<?php echo base_url(); ?>';</script>
    <script src="<?php echo base_url()?>assets/front/js/jquery-min.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/custom.js"></script>
    <script src="<?php echo base_url()?>assets/front/js/custom-script.js"></script>
</html>