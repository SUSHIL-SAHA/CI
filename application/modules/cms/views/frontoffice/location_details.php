<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
<!-- Carlow Removals section starts from here -->
<?php
if (!empty($location_details_data)) {
$location_data = $location_details_data[0];
?>
<section class=" section request-a-quote">
    <div class="container">
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(); ?>home">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a
                        href="<?php echo base_url().'location/'.$location_data['suburb_slug'];?>"><?php echo $location_data['suburb_title'];?></a>
                </li>
                <li class="breadcrumb-item active"><?php echo $location_data['locations_title'];?></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="content_wrap">
                    <!-- <h1 class="heading">
                        <?php //echo $location_data['locations_title'];?>
                    </h1> --> 
                    <div class="editor_text">
                        <?php  echo $location_data['locations_description'];?>
                    </div>
                    <div class="rates">
                        <div class="rates_wrap">
                            <figure class="image">
                                <img
                                    src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['location_details_review_image1'];?>" alt="<?php echo $pageExtraFields['location_details_review_image1'];?>">
                            </figure>
                        </div>
                        <div class="rates_wrap">
                            <figure class="image">
                                <img
                                    src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['location_details_review_image2'];?>" alt="<?php echo $pageExtraFields['location_details_review_image2'];?>">
                            </figure>
                        </div>
                        <div class="rates_wrap">
                            <figure class="image">
                                <img
                                    src="<?php echo base_url(). "uploads/cms_page_images/".$pageExtraFields['location_details_review_image3'];?>" alt="<?php echo $pageExtraFields['location_details_review_image3'];?>">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carlow Removals section ends here -->
<!--Thinking of Furniture Deliveries section starts here -->
<section class="section furniture_delivery">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content_wrap">
                    <div class="editor_text">
                        <figure class="furnitureImg">
                            <img src="<?php echo base_url()."uploads/locations_image/".$location_data['image'];?>" alt="<?php echo $location_data['locations_title'];?>">
                        </figure>
                        <?php  echo $location_data['location_description1'];?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-5">
                
            </div>
        </div>

    </div>
</section>
<!--Thinking of Furniture Deliveries section ends here -->
  <!-- area part html starts here -->
  <section class="areaSection section">
    <div class="container">
        <div class="heading"><span>Explore </span>Our Other Location</div>
        <div class="area_bottom">
        <div class="owl-carousel location_bottom_list">
                <?php if(!empty($other_location_data)){
                 foreach ($other_location_data as $key => $value) {?>
                    <div class="location-item">
                        <a href="<?php echo base_url().'location/'.$value['suburb_slug'].'/'.$value['locations_slug'];?>">
                            <div class="area_box_wrap">
                                <div class="area_box">
                                    <figure><img src="<?php echo base_url().'uploads/locations_image/'.$value['logo_image'];?>" alt="<?php echo $value['locations_title'];?>"></figure>
                                </div>
                                <div class="area_bottom">
                                    <div class="area_title"><?php echo $value['locations_title'];?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } } ?>  
            </div>
        </div>
    </div>
  </section>
<!-- explore our services part html starts here --> 
<section class="expoloreservice_section section">
    <div class="container">
        <div class="heading"><?php echo $pageExtraFields['location_details_service_title'];?></div>
        <div class="tab_part">
            <div class="tab_bottom_part">
                    <div class="serviceslider owl-carousel">
                        <?php if(!empty($service_data)){
                          foreach($service_data as $key => $row) { ?>
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
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- why choose us section part html starts here -->
<section class="why_choose_us section">
    <div class="container">
        <div class="row row-gap">
            <div class="col-12">
                <div class="content_wrap">
                    <?php if($location_data['map_link']) {?>
                        <div class="map_wrapping">
                            <iframe src="<?php echo $location_data['map_link'];?>" width="100%" height="100%" style="border:0;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <figure>
                                <img src="<?php echo base_url()."uploads/locations_image/".$location_data['image2'];?>" alt="<?php echo $location_data['image2'];?>">
                            </figure>
                        </div>
                    <?php } else{ ?>
                        <div class="map_wrapping">
                            <figure class="sm_image">
                                <img src="<?php echo base_url()."uploads/locations_image/".$location_data['image2'];?>" alt="<?php echo $location_data['image2'];?>">
                            </figure>
                        </div>
                    <?php } ?>
                    <div class="editor_text">
                        <?php echo $location_data['location_description2']?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content_wrap">
                    <!-- <div class="heading">
                            About <span>Carlow</span>
                        </div> -->
                    <div class="editor_text">
                        <?php echo $location_data['location_description3'];?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content_wrap">
                    <!-- <div class="heading">
                            Some Cool Facts About <span>Carlow</span> 
                        </div> -->
                    <div class="editor_text">
                        <?php echo $location_data['location_description4'];?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }?>
<!-- why choose us section part html ends here -->