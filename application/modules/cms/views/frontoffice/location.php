<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
  <!-- area part html starts here -->
  <section class="areaSection section">
    <div class="container">
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url(); ?>home">Home</a>
            </li>
            <li class="breadcrumb-item active"><?php foreach ($suburb_data as $key => $value) { if($key== 0) { echo $value['suburb_title']; } }?>
        </ol>
    </div>
        <h1 class="heading"><?php echo $pageExtraFields['location_title'];?></h1>
        <div class="area_bottom">
            <div class="row area_bottom_list">
                <?php if(!empty($suburb_data)){
                 foreach ($suburb_data as $key => $value) {?>
                    <div class="col-xl-4 col-sm-6 col-12">
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

<!-- area part html ends here -->