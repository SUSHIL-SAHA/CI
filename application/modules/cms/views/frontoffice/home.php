<section class="common_banner home_banner inner_banner ">
        <div class= "banner-wrap">
            <div class="item">
                <div class="bannerbox">
                    <figure class="banner_img">
                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_banner_image'];?>" alt="banner_img">
                    </figure>
                    <div class="bannertext">
                        <div class="container">
                            <div class="bannertext-in">
                                <div class="heading noline"><?php echo $pageExtraFields['home_banner_title'];?></div>
                                <div><?php echo $pageExtraFields['home_banner_description'];?></div>
                                <div class="banner_btn"><a href="<?php echo base_url()?>calculator" class="btn"><?php echo $pageExtraFields['home_banner_button_title'];?></a></div>
                            </div>
                            <div class="social-media">
                                <a href="<?php echo site_settings_data('facebook_link');?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="<?php echo site_settings_data('instagram_link');?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="<?php echo site_settings_data('twitter_link');?>" target="_blank"><figure><img src="<?php echo base_url();?>assets/front/images/twitter.png" alt="twitter_icon"></figure></a>
                            </div>
                        </div> 
                    </div>    
                </div> 
            </div>
        </div>           
</section>
<!-- about section html starts here-->
<section class="section home_about">
    <div class="container">
            <div class="row rowGap">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="aboutImg">
                        <figure><img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_about_us_image1'];?>" alt="packing_img"></figure>
                        <!-- <figure><img src="<?php //echo base_url(). "uploads/cms_page_images/".$home_about_us_image2;?>" alt=""></figure> -->
                        <video class="video-box" poster="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_about_us_image2'];?>">
                            <source src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_about_us_video'];?>" type="video/mp4">
                        </video>
                        <a class="popup-video" href="javascript:void(0)">
                            <div class="video-wrap">
                                <figure>
                                    <img src="<?php echo base_url()?>/assets/front/images/Clip_path_group.png" alt="play_icon">
                                </figure>
                                <h3><?php echo $pageExtraFields['home_about_us_video_button_title'];?></h3>
                            </div>
                        </a>
                        <div class="experiance_text">
                            <div class="special-title"><?php echo $pageExtraFields['home_about_us_count_number'];?></div>
                            <p><?php echo $pageExtraFields['home_about_us_count_number_text'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="content_wrap">
                        <div class="content ">
                            <h1 class="heading"><?php echo $pageExtraFields['home_aboutus_title'];?></h1>
                            <!-- <div class="subheading"><?php echo $pageExtraFields['home_about_us_sub_title'];?></div> -->
                            <div class="editor_text">
                            <?php echo $pageExtraFields['home_about_us_description'];?>
                            </div>
                            <div class="btn_left"><a href="<?php echo base_url()?>about-us" class="btn book"><?php echo $pageExtraFields['home_about_us_button_title'];?></a></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>

<!-- about section html ends here-->

<!-- service section html starts here-->
<section class="section service-section">
    <div class="container" id="service">
        <div class="title-wrap">
            <div class="heading">
                <?php echo $pageExtraFields['home_service_title'];?>
            </div>
            <div class="subheading">
            <?php echo $pageExtraFields['home_service_sub_title'];?>
            </div>
        </div>
        <?php if (!empty($home_service_data)){?>
        <div class="row rowGap">
            <?php foreach($home_service_data as $key => $row){ ?>
                <div class="col-lg-4 col-md-6">
                    <div class="content-box">
                        <div class="top-wrap">
                            <figure>
                                <img src="<?php echo base_url();?>/uploads/service_image/<?php echo $row ['service_icon']; ?>"
                                    alt="<?php echo $row['service_title']; ?>">
                            </figure>
                            <!-- <span>01</span> -->
                        </div>
                        <h4 class="title"><?php echo $row['service_title'] ;?></h4>
                        <p><?php echo $row['ServiceShortDescription'] ;?></p>
                        <a href="<?php echo base_url().'service/'.$row['service_slug'];?>"
                            class="readmore">Read More <i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</section>

<!-- service section html ends here-->
<!-- process page html starts -->
<section class=" section process">
    <div class="container">
        <div class="content">
            <div class="page-title">
                <div class="heading"><?php echo $pageExtraFields['home_how_it_works_title'];?></div>
                <div class="subheading"><?php echo $pageExtraFields['home_how_it_works_sub_title'];?></div>
            </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="content-box">
                    <div class="top-wrap">
                        <figure>
                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_how_it_works_image1'];?>" alt="<?php echo $pageExtraFields['home_how_it_works_image1_title'];?>"> 
                        </figure>
                        <span>01</span>
                    </div>
                    <h4 class="title"><?php echo $pageExtraFields['home_how_it_works_image1_title']?></h4>
                    <p><?php echo $pageExtraFields['home_how_it_works_image1_sub_title']?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="content-box">
                    <div class="top-wrap">
                        <figure>
                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_how_it_works_image2'];?>" alt="<?php echo $pageExtraFields['home_how_it_works_image2_title'];?>"> 
                        </figure>
                        <span>02</span>
                    </div>
                    <h4 class="title"><?php echo $pageExtraFields['home_how_it_works_image2_title']?></h4>
                    <p><?php echo $pageExtraFields['home_how_it_works_image2_sub_title']?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="content-box">
                    <div class="top-wrap">
                        <figure>
                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_how_it_works_image3'];?>" alt="<?php echo $pageExtraFields['home_how_it_works_image3_title'];?>"> 
                        </figure>
                        <span>03</span>
                    </div>
                    <h4 class="title"><?php echo $pageExtraFields['home_how_it_works_image3_title']?></h4>
                    <p><?php echo $pageExtraFields['home_how_it_works_image3_sub_title']?></p>
                </div>
            </div>
 
            <div class="col-12">
                <?php //echo $home_how_it_works_description;?>
                <div class="banner_btn"><a href="<?php echo base_url()?>calculator" class="btn">Request an estimate</a></div>
            </div>
        </div>
    </div>
</section>
<!-- process page html ends -->
<!--  calculator  page html starts -->
<section class=" section calculator" >
    <div class="container" id="panel2">
    <div class="side-figure-wrap">
                    <!-- <figure>
                        <img src="<?php // echo base_url(). "uploads/cms_page_images/".$home_calculator_image;?>">
                    </figure> -->
                </div>
        <div class="heading">
            <?php echo $pageExtraFields['home_calculator_title'];?>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 tab-List">
                <div class="tab-top">
                    <ul>
                        <?php foreach ($product_category_data as $key => $value) {?>
                            <li>
                                <a class="catID" href="javascript:void(0);" data-id="<?php echo $value['categoryId'];?>" class="tab-btn"><?php echo $value['category_title'];?></a>
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <div class="tab-bottom">
                    <ul id='product_data'>
                        
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="full_cart_data">
                <?php
                    if(!empty($cartItemDetails)){
                    ?>
                <div class="item-box">
                    <div class="item-top">
                        <div class="subheading"><?php echo $pageExtraFields['home_calculator_text'];?></div> 
                        <div><a class="btn remove-all-cart-data">clear all</a></div>
                    </div>
                    <div id='singel_product_data'>
                        <?php
                            foreach ($cartItemDetails as $ciKey => $ciVal) {
                            # code...
                            ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <figure><img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $ciVal['image']; ?>" alt="<?php echo $ciVal['title']; ?>"></figure> <span><?php echo $ciVal['title']; ?></span>Qty:<?php echo $ciVal['qty']; ?>
                            <button type="button" data-closeid="<?php echo $ciKey; ?>" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <?php
                            }
                        ?>
                    </div>
                    <div class="button"><a href="<?php echo base_url()?>inquiry-form" class="btn">Calculator</a></div>
                </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>   
</section>
<!--  calculator  page html ENDS -->
<!--  schedule  page html starts -->
<section class="section  schedule">
    <div class="container">
        <div class="figure_left">
            <figure>
                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_form_image1'];?>" alt="pakers_img">
            </figure>
        </div>
        <!-- <img src="  <?php echo base_url()?>/assets/front/images/about_one.jpg"> -->
       
        <div class="content_middle">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact_form_wrap">
                        <div class="contact_form">
                        <div class="heading"><?php echo $pageExtraFields['home_form_sub_title'];?></div>
                        <form id="home_from" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" autoComplete="off" class="form-control" name="name" id="name" placeholder="Your Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" autoComplete="off" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" autoComplete="off" class="form-control" name="phone" id="phone" placeholder="Phone No.">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" autoComplete="off" class="form-control" name="address" id="address"  placeholder="Address">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea input type="text" autoComplete="off" rows="5" cols="33" class="form-control" name="message" id="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <button type="submit" id='submit' class="btn"><?php echo $pageExtraFields['home_form_submit_button_title'];?></button>
                            <input type="hidden" id="csrftoken" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <div class="alert-message" role="status"></div>
                        </form>
                        </div> 
                        </div> 
                    </div>
                    <div class="col-lg-6">
                        <div class="right_part">
                            <div class="heading"><?php echo $pageExtraFields['home_form_title'];?></span>
                            </div>
                            <div class="editor_text">
                            <p><?php echo $pageExtraFields['home_form_description'];?></p>
                            </div>
                            <div class="contact-wrap">
                                <ul>
                                    <li class="address">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <a href="https://maps.google.com/maps?q=<?php echo site_settings_data('address');?>" target="_blank"><span><?php echo site_settings_data('address');?></span></a> 
                                    </li>
                                    <li>
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <a href="tel:<?php echo site_settings_data('helpline_no');?> "><span><?php echo site_settings_data('helpline_no');?></span></a>  
                                        <a href="tel:<?php echo site_settings_data('another_helpline_no');?>"><span><?php echo site_settings_data('another_helpline_no');?></span></a>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <a href="mailto:<?php echo site_settings_data('helpline_email_address');?>"><span><?php echo site_settings_data('helpline_email_address');?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="figure_right">
            <figure>
                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_form_image2'];?>" alt="<?php echo $pageExtraFields['home_form_image2'];?>">
            </figure>
        </div>
    </div>
</section>
<!--  schedule  page html ends -->
<!-- company page html starts -->
<section class="section company">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left_part">
                    <figure>
                        <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_chooes_wisely_left_image'];?>" alt="<?php echo $pageExtraFields['home_chooes_wisely_title'];?>">
                    </figure>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="company_left">
                    <div class="content">
                        <div class="heading"><?php echo $pageExtraFields['home_chooes_wisely_title'];?></div>
                        <div class="subheading"><?php echo $pageExtraFields['home_chooes_wisely_sub_title'];?></div>
                        <div class="editor_text">
                        <?php echo $pageExtraFields['home_chooes_wisely_description'];?>
                        </div>
                    </div>
                    <div class="choose">
                        <ul>
                            <li>
                                <figure>
                                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_chooes_wisely_image1'];?>" alt="<?php echo $pageExtraFields['home_chooes_wisely_image1_title'];?>">
                                </figure>
                                <p>
                                <?php echo $pageExtraFields['home_chooes_wisely_image1_title'];?>
                                </p>
                            </li>
                            <li>
                                <figure>
                                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_chooes_wisely_image2'];?>" alt="<?php echo $pageExtraFields['home_chooes_wisely_image2_title'];?>">
                                </figure>
                                <p>
                                <?php echo $pageExtraFields['home_chooes_wisely_image2_title'];?>
                                </p>
                            </li>
                            <li>
                                <figure>
                                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_chooes_wisely_image3'];?>" alt="<?php echo $pageExtraFields['home_chooes_wisely_image3_title'];?>">
                                </figure>
                                <p>
                                <?php echo $pageExtraFields['home_chooes_wisely_image3_title'];?>
                                </p>
                            </li>
                            <li>
                                <figure>
                                <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_chooes_wisely_image4'];?>" alt="<?php echo $pageExtraFields['home_chooes_wisely_image4_title'];?>">
                                </figure>
                                <p>
                                <?php echo $pageExtraFields['home_chooes_wisely_image4_title'];?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- company page html ends -->
<!-- testimonial page html starts -->
<section class="section testimonial">
    <div class="container">
        <div class="row row-gap">
            <div class="col-lg-6">
                <div class="page-title">
                    <div class="heading"><?php echo $pageExtraFields['home_testimonials_title'];?></div>
                    <div class="subheading"><?php echo $pageExtraFields['home_testimonials_sub_title'];?></div>
                    <div class="viewmore"><a href="<?php echo base_url()?>testimonials" class="btn"><?php echo $pageExtraFields['home_testimonials_button_title'];?></a></div>
                </div>
            </div>
            <?php
            if (!empty($home_testimonial_data)) {
                foreach ($home_testimonial_data as $key => $value) {

                    if($key <= 2){
                        ?>
                        <div class="col-lg-6">
                            <div class="testimonial-box">
                                <div class="item">
                                    <div class="content">
                                        <?php echo $value['testimonial_description']; ?>
                                    </div>
                                    <div class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <?php if ($i <= $value['rating']) { ?>
                                                <i class="fa fa-star" style="color: #f9cf01;"></i>
                                            <?php } else { ?>
                                                <i class="fa fa-star empty" aria-hidden="true"></i>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <div class="testimonial_bottom">
                                        <div class="client d-flex align-items-center">
                                            <figure class="icon">
                                                <img src="<?php echo base_url() . "uploads/testimonial_image/" . $value['image']; ?>" alt="<?php echo $value['testimonial_name']; ?>">
                                            </figure>
                                            <div class="clientdetails">
                                                <h5 class="name"><?php echo $value['testimonial_name']; ?><span class="designation"><?php echo $value['dept']; ?></span></h5>
                                            </div>
                                        </div>
                                        <figure class="semicolon">
                                            <img src="<?php echo base_url() ?>/assets/front/images/semi-colon.png" alt="semicolon_img">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                    } 
                }
            }
            ?>
        </div>    
    </div>
</section>
<!-- testimonial page html ends -->
<!-- review page html starts -->

<section class="section review-section">
    <div class=" container">
        <div class= "reviewslider owl-carousel">
            <div class="item">
                    <figure>
                        <img src="<?php echo base_url()."uploads/cms_page_images/".$pageExtraFields['home_testimonials_review_image1'];?>" alt="<?php echo $pageExtraFields['home_testimonials_review_image1'];?>">
                    </figure>
            </div>
            <div class="item">
                <figure >
                    <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_testimonials_review_image2'];?>" alt="<?php echo $pageExtraFields['home_testimonials_review_image2'];?>">
                </figure>
            </div>
            <div class="item">
                <figure >
                    <img src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['home_testimonials_review_image3'];?>" alt="<?php echo $pageExtraFields['home_testimonials_review_image3'];?>">
                </figure>
            </div>
        </div>  
    </div>
</section>
  
<!-- review page html ends -->  