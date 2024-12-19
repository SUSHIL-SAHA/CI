<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
<!-- about service part html starts here -->
<section class="aboutService section">
    <div class="container">
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url();?>">Home</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $pageTitle;?>
            </ol>
        </div>
        <div class="aboutus_part">
            <h1 class="heading"><?php echo $pageExtraFields['about_us_title'];?></h1>
            <figure class="left_part"><img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['about_us_image'];?>" alt="car_image"></figure>
            <div class="content">
                <?php echo $pageExtraFields['about_us_description'];?>
            </div>
            <div class="btn_part">
                <a href="<?php echo base_url()?>contact-us" class="btn"><?php echo $pageExtraFields['about_us_button'];?></a>
            </div>
        </div>
    </div>
</section>
<!-- about service part html ends here -->
<!-- about company part html starts here -->
<section class="aboutCompany section">
    <div class="container">
        <div class="about_company_top">
            <div class="heading"><?php echo $pageExtraFields['about_us_chooes_wisely_title'];?></div>
            <div class="subheading"><?php echo $pageExtraFields['about_us_chooes_wisely_sub_title'];?></div>
        </div>
        <div class="about_company_bottom">
            <ul class="company_list">
                <li>
                    <figure><img
                            src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['about_us_chooes_wisely_image1'];?>"
                            alt="moving1"></figure><span><?php echo $pageExtraFields['about_us_chooes_wisely_image1_title'];?></span>
                </li>
                <li>
                    <figure><img
                            src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['about_us_chooes_wisely_image2'];?>"
                            alt="moving2"></figure><span><?php echo $pageExtraFields['about_us_chooes_wisely_image2_title'];?></span>
                </li>
                <li>
                    <figure><img
                            src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['about_us_chooes_wisely_image3'];?>"
                            alt="moving3"></figure><span><?php echo $pageExtraFields['about_us_chooes_wisely_image3_title'];?></span>
                </li>
                <li>
                    <figure><img
                            src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['about_us_chooes_wisely_image4'];?>"
                            alt="moving4"></figure><span><?php echo $pageExtraFields['about_us_chooes_wisely_image4_title'];?></span>
                </li>
                <li>
                    <figure><img
                            src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['about_us_chooes_wisely_image5'];?>"
                            alt="moving5"></figure><span><?php echo $pageExtraFields['about_us_chooes_wisely_image5_title'];?></span>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- about company part html ends here -->
<!-- Explore Our Vehicles part html starts here -->
<section class="exploreSection section">
    <div class="container">
        <?php if(!empty($vehicle_details)){?>
        <div class="exploreTop">
            <div class="heading"><?php echo $pageExtraFields['about_us_vehicles_title'];?></div>
        </div>
        <div class="exploreBottom">
            <?php 
                foreach ($vehicle_details as $vKey => $vVal) {
                    # code...
                    ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="left_part">
                        <div class="vehicles_title"><?php echo $vVal['vehicle_name']; ?></div>
                        <div class="content">
                            <?php echo $vVal['vehicle_content']; ?>
                        </div>
                        <div class="btn_part">
                            <a href="<?php echo base_url()?>calculator" class="btn">Get An Estimate</a>
                            <!-- <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#book_vehicle">Get An Estimate</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right_part">
                        <figure>
                            <img src="<?php echo base_url(). "uploads/vehicle_image/".$vVal['vehicle_image'];?>" alt="car">
                        </figure>
                    </div>
                </div>
            </div>

                    <?php
                }
            ?>
        </div>
        <?php } ?>
    </div>
</section>
<!-- Explore Our Vehicles part html starts here -->
<!-- testimonial part html starts here -->
<section class="testimonialSection section">
    <div class="container">
        <?php if(!empty($testimonial_data)){ ?>
        <div class="testimonialTop">
            <div class="heading"><?php echo $pageExtraFields['about_us_testimonial_title'];?></div>
            <div class="subheading"><?php echo $pageExtraFields['about_us_testimonial_sub_title'];?></div>

        </div>
        <div class="testimonialBottom">
            <div class="testimonialSlider owl-carousel">
                <?php foreach ($testimonial_data as $key => $value) { ?>
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
                            <figure><img src="<?php echo base_url(). "uploads/testimonial_image/".$value['image'];?>" alt="<?php echo $value['testimonial_name'];?>">
                            </figure>
                        </div>
                        <div class="client_desc">
                            <div class="client_name"><?php echo $value['testimonial_name'];?></div>
                            <div class="client_degination"><?php echo $value['dept'];?></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php }?>
    </div>
</section>
<!-- testimonial part html ends here -->
<!-- quick look part html starts here -->
<section class="section quicklookSection">
    <div class="container">
        <div class="left_part">
            <div class="heading"><?php echo $pageExtraFields['about_us_calculator_title'];?></div>
            <div class="right_part">
                <figure><img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['about_us_calculator_image'];?>" alt="quicklook"></figure>
            </div>
            <div class="content">
                <?php echo $pageExtraFields['about_us_calculator_description'];?>
            </div>
            <div class="btn_part">
                <a href="<?php echo base_url();?>calculator" class="btn"><?php echo $pageExtraFields['about_us_calculator_button'];?></a>
            </div>
        </div>
    </div>
</section>
<!-- quick look part html ends here -->
<!-- explore our services part html starts here -->
<section class="expoloreservice_section section">
    <div class="container">
     <?php if(!empty($service_data)){ ?>
        <div class="heading"><?php echo $pageExtraFields['about_us_service_title'];?></div>
        <div class="tab_part">
            <div class="tab_bottom_part">
                    <div class="serviceslider owl-carousel">
                        <?php  foreach($service_data as $key => $row) { ?>
                        <div class="item">
                            <div class="service_box">
                                <div class="service_box_top">
                                    <figure><img
                                            src="<?php echo base_url();?>/uploads/service_image/<?php echo $row['image']; ?>"
                                            alt="<?php echo $row['service_title'] ; ?>"></figure>
                                    <div class="service_title"><?php echo $row['service_title'] ; ?></div>
                                </div>
                                <div class="service_box_bottom">
                                    <div class="service_box_bottom_wrap">
                                        <div class="service_title"><?php echo $row['service_title'] ; ?></div>
                                        <div class="content">
                                            <p><?php echo $row['ServiceShortDescription'];?></p>
                                        </div>
                                        <div class="btn_part"><a
                                                href="<?php echo base_url().'service/'.$row['service_slug'] ;?>"
                                                class="readmore">READ MORE<i class="fa fa-angle-right"
                                                    aria-hidden="true"></i></a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
     <?php }?>
    </div>
</section>