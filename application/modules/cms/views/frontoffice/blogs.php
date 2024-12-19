<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">
</section>
<!-- Banner section design ends here -->
<!-- blog page html starts from here -->
<section class="blogpage section">
    <div class="container">
    <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="<?php echo base_url(); ?>home">Home</a>
          </li>
          <li class="breadcrumb-item active"><?php echo $pageTitle;?></li>
      </ol>
    </div>
  <?php if (!empty($allblogs_data)){?>
        <h1 class="heading"><?php echo $pageExtraFields['blogs_title'];?></h1>
        <div class="blog-content">
                  <ul>
                    <?php foreach ($allblogs_data as $key => $value) {?>
                      <li>
                        <div class="item-box">
                          <div class="figure-wrap">
                              <figure>
                                  <img src="<?php echo base_url()."uploads/blogs_images/".$value['blogs_image'];?>" alt="image_blog">
                              </figure>
                          </div>
                          <div class="details-wrap">
                              <div class="date"><?php echo ($value['modifiedOn'] != "") ? date('d F Y', strtotime($value['modifiedOn'])) : date('d F Y', strtotime($value['addedOn']));?></div>
                              <?php echo $value['blogs_description'];?>
                              <a class="btn" href="<?php echo base_url().'blogs/'.$value['blogs_slug'];?>">Read More</a>
                          </div>
                        </div>
                      </li>
                    <?php }?>
            </div>
            <?php }?>
    </div>
</section>
<!-- blog page html ends here -->