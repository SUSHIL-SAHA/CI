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
                                <div class="col-sm-12">
                                    <h1>Transaction Successfull</h1>
                                    <p>Your transcation has been successfull, please check the below details:-</p>
                                    <ul>
                                        <li>Transaction ID - <?php echo $this->input->get('tx'); ?></li>
                                        <li>Payer ID - <?php echo $this->input->get('PayerID'); ?></li>
                                        <li>Amount - $<?php echo round($this->input->get('amt')); ?></li>
                                    </ul>
                                    <p>Note:- <strong>Keep the transaction id with you for tracking.</strong></p>
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