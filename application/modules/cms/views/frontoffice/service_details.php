<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
 <!-- request-a-quote section starts from here -->
 <section class=" section request-a-quote">
    <?php $service_details_data_row=$service_details_data[0];
    //print_r($service_details_data_row); exit;?>
        <div class="container">
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active"><?php echo $service_details_data_row['service_title'] ;?>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="content_wrap">
                        <h1 class="heading">
                           <?php echo $service_details_data_row['service_title'];?> 
                        </h1>
                        <div class="editor_text">
                        <?php echo $service_details_data_row['service_description'];?>
                        </div>
                        <div class="rates">
                            <div class="rates_wrap">
                                <figure class="image">
                                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_review_image1'];?>" alt="<?php echo $pageExtraFields['service_details_review_image1'];?>">
                                </figure>
                            </div>
                            <div class="rates_wrap">
                                <figure class="image">
                                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_review_image2'];?>" alt="<?php echo $$pageExtraFields['service_details_review_image2'];?>">
                                </figure>
                            </div>
                            <div class="rates_wrap">
                                <figure class="image">
                                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_review_image3'];?>" alt="<?php echo $$pageExtraFields['service_details_review_image3'];?>">
                                </figure>
                            </div>
                        </div>
                        <div class="banner_btn"><a href="<?php echo base_url()?>calculator" class="btn">Request an estimate</a></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <figure class="service_image">
                        <img src="<?php echo base_url(). "uploads/service_image/".$service_details_data_row['image'];?>" alt="<?php echo $service_details_data_row['service_title'];?>">
                    </figure>
                </div>
            </div>
        </div>
    </section>

     <!-- request-a-quote section ends here -->
      <!-- furniture_delivery section starts here -->
    <section class="section furniture_delivery">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-5">
                    <figure>
                        <img src="<?php echo base_url(). "uploads/service_image/".$service_details_data_row['ServiceOtherImage'];?>" alt="<?php echo $pageExtraFields['ServiceOtherTitle'];?>">

                    </figure>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <div class="content_wrap">
                        <div class="heading">
                        <?php echo $service_details_data_row['ServiceOtherTitle'];?>
                        </div>
                        <div class="editor_text">
                            <?php echo $service_details_data_row['ServiceOtherDescription'];?>
                        </div>   
                    </div>
                    <div class="banner_btn"><a href="<?php echo base_url()?>calculator" class="btn">Request an estimate</a></div>
                </div>

            </div>
            
        </div>
    </section>
 <!-- furniture_delivery section ends here -->

<!-- removal section starts from here -->
    <section class=" section removal">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-xxl-6">
                    <div class="content_wrap">
                        <div class="heading">
                        <?php echo $service_details_data_row['ServiceOtherTitle2'];?>
                        <?php //echo $pageExtraFields['service_details_removal_title'];?>
                        </div>
                        <div class="editor_text">
                        <?php echo $service_details_data_row['ServiceOtherDescription2'];?>
                        <?php //echo $pageExtraFields['service_details_removal_description'];?>
                        </div>
                        <div class="list">
                            <ul>
                                <li>
                                    <figure>
                                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_removal_inner_image1'];?>" alt="<?php echo $pageExtraFields['service_details_removal_inner_image1_title'];?>">
                                    </figure>
                                    <p>
                                    <?php echo $pageExtraFields['service_details_removal_inner_image1_title'];?>
                                    </p>
                                </li>
                                <li>
                                    <figure>
                                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_removal_inner_image2'];?>" alt="<?php echo $pageExtraFields['service_details_removal_inner_image2_title'];?>">
                                    </figure>
                                    <p>
                                    <?php echo $pageExtraFields['service_details_removal_inner_image2_title'];?>
                                    </p>
                                </li>
                                <li>
                                    <figure>
                                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_removal_inner_image3'];?>" alt="<?php echo $pageExtraFields['service_details_removal_inner_image3_title'];?>">
                                    </figure>
                                    <p>
                                    <?php echo $pageExtraFields['service_details_removal_inner_image3_title'];?>
                                    </p>
                                </li>
                                <li>
                                    <figure>
                                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_removal_inner_image4'];?>" alt="<?php echo $pageExtraFields['service_details_removal_inner_image4_title'];?>">
                                    </figure>
                                    <p>
                                    <?php echo $pageExtraFields['service_details_removal_inner_image4_title'];?>
                                    </p>
                                </li>
                                <li>
                                    <figure>
                                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_removal_inner_image5'];?>" alt="<?php echo $pageExtraFields['service_details_removal_inner_image5_title'];?>">
                                    </figure>
                                    <p>
                                    <?php echo $pageExtraFields['service_details_removal_inner_image5_title'];?>
                                    </p>
                                </li>
                                <li>
                                    <figure>
                                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_removal_inner_image6'];?>" alt="<?php echo $pageExtraFields['service_details_removal_inner_image6_title'];?>">
                                    </figure>
                                    <p>
                                    <?php echo $pageExtraFields['service_details_removal_inner_image6_title'];?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="button">
                            <a href="<?php echo base_url()?>contact-us" class="btn"><?php echo $pageExtraFields['service_details_removal_button_title'];?></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-xxl-6">
                    <figure>
                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['service_details_removal_image'];?>" alt="<?php echo $pageExtraFields['service_details_removal_image'];?>">
                    </figure>

                </div>
            </div>
           
        </div>
    </section>
    <!-- request-a-quote section starts from here -->
<section class="expoloreservice_section section">
    <?php if(!empty($other_service_data)){?>
    <div class="container">
        <div class="heading"><?php echo $pageExtraFields['service_details_service_title'];?></div>
        <div class="tab_part">
            <div class="tab_bottom_part">
                    <div class="serviceslider owl-carousel">
                        <?php  foreach($other_service_data as $key => $row) { ?>
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
    </div>
    <?php }?>
</section>
<!-- explore our services part html end here -->
<!-- testimonial part html starts here -->
<section class="testimonialSection section">
    <?php if(!empty($testimonial_data)){?>
    <div class="container">
        <div class="testimonialTop">
            <div class="heading"><?php echo $pageExtraFields['service_details_testimonial_title'];?></div>
            <div class="subheading"><?php echo $pageExtraFields['service_details_testimonial_sub_title'];?></div>

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
                                <figure><img src="<?php echo base_url(). "uploads/testimonial_image/".$value['image'];?>" alt="<?php echo $value['image'];?>"></figure>
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
    </div>
    <?php } ?>
</section>
<!-- testimonial part html ends here -->