<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
<!-- testimonial page html starts here -->
<section class="testimonialpage section">
    <div class="container">
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(); ?>home">Home</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $pageTitle;?>
            </ol>
        </div>
        <div class="testimonialTop">
            <h1 class="subheading"><?php echo $pageExtraFields['testimonials_title'];?></h1>
            <div class="heading"><?php echo $pageExtraFields['testimonials_sub_title'];?></div>
        </div> 
        <div class="row" >
            <?php if(!empty($testimonial_data)){
             foreach ($testimonial_data as $key => $value) { ?>
                <div class="col-lg-4">
                    <div class="testimonial-wrap">
                        <div class="item">
                            <div class="rating">
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($i <= $value['rating']) { ?>
                                        <i class="fa fa-star" style="color: #f9cf01;"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-star empty" aria-hidden="true"></i>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="content">
                            <?php echo $value['testimonial_description'];?>
                            </div>
                            <div class="client">
                                <div class="client_image">
                                    <figure><img src="<?php echo base_url(). "uploads/testimonial_image/".$value['image'];?>" alt="<?php echo $value['testimonial_name'];?>"></figure>
                                </div>
                                <div class="client_desc">
                                    <div class="client_name"><?php echo $value['testimonial_name'];?></div>
                                    <div class="client_degination"><?php echo $value['dept'];?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>
</section>
<!-- testimonial page html ends here -->