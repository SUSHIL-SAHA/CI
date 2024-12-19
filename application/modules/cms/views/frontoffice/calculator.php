<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
<!--  calculator  page html starts -->
<section class=" section calculator">
  <div class="container">
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url(); ?>home">Home</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $pageTitle;?>
      </ol>
    </div>
    <h1 class="heading">
      <?php echo $pageExtraFields['calculator_title'];?>
    </h1>
    
    <div class="row item-section">
      <div class="col-xl-12 col-lg-12 tab-List">
      <div class="tab-top">
      <ul>
        <?php foreach ($product_category_data as $key => $value) {?>
        <li>
          <a class="catID" href="javascript:void(0);" data-id="<?php echo $value['categoryId'];?>"
            class="tab-btn"><?php echo $value['category_title'];?></a>
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
              <div class="subheading"><?php echo $getPageExtraFields['calculator_text'];?></div>
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
</section>
<!--  calculator  page html ENDS -->