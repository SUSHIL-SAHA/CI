<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">
</section>
<!-- Banner section design ends here -->

<!-- inner blogs section html starts  -->
 <section class=" section inner_blogs_section">
    <div class="container">
     <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="<?php echo base_url(); ?>">Home</a>
          </li>
          <li class="breadcrumb-item">
              <a href="<?php echo base_url(); ?>blogs">Blogs</a>
          </li>
          <li class="breadcrumb-item active"> <?php $inner_blogs = $inner_blogs_data[0]; echo $inner_blogs['blogs_title'];?>
      </ol>
    </div>
         <div class="row rowGap">
             <div class="col-lg-8">
                <div class="left_part_blogs">					
                        <div class="content_wrap">
                                <div class="content ">
                                    <figure class="blog-img"> <img src="<?php echo base_url()."uploads/blogs_images/".$inner_blogs['blogs_image'];?>" alt="<?php echo $inner_blogs['blogs_title'];?>"></figure>
                                    <h1 class="heading"><?php echo $inner_blogs['blogs_title'];?></h1>
                                    <div class="publish-info">
                                        <i class="fa fa-calendar" aria-hidden="true"></i><?php echo ($inner_blogs['modifiedOn'] != "") ? date('d F Y', strtotime($inner_blogs['modifiedOn'])) : date('d F Y', strtotime($inner_blogs['addedOn']));?></div>
                                    <div class="editor_text"><?php echo $inner_blogs['blogs_description']?>
                                </div>
                            </div>
                        </div>
                    </div>
             </div>
             <div class="col-lg-4">
                <div class="theiaStickySidebar">
                        <div class="sk_sideblock sk_sideblockShadow">
                            <h3 class="subheading">Recent Posts</h3>
                            <div class="listStyle recent-posts">
                                
                                <ul class="recent-news">
                                    <?php foreach ($other_blogs_data as $key => $value) { ?>
                                        <li>
                                            <a href="<?php echo base_url().'blogs/'.$value['blogs_slug'];?>" class="sk_box">
                                                <figure class="sk_img"><img src="<?php echo base_url()."uploads/blogs_images/".$value['blogs_image'];?>" alt="<?php echo $value['blogs_title'];?>"></figure>
                                                <div class="sk_text">
                                                    <h5><?php echo $value['blogs_title'];?></h5>
                                                </div>
                                            </a>
                                        </li>
                                    <?php }?>  
                                </ul>
                            
                            </div>
                        </div>
                    </div> 
            </div>
         </div>
     </div>
</section>
<!-- inner blogs section html ends -->