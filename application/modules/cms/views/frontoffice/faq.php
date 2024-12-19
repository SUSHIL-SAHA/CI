<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
<!-- FAQ section starts from here -->
<section class="section faqPage">
    <div class="container">
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(); ?>home">Home</a>
                </li>
                <li class="breadcrumb-item active"><?php echo $pageTitle;?></li>
            </ol>
        </div>
        <div class="faq_content_wrap">
            <div class="faq_content text-center">
                <h1 class="heading"><?php echo $pageExtraFields['faq_title'];?></h1>
            </div>
        </div>
        <div class="sk_toggle">
            <?php if(!empty($faq_data)){
             foreach ($faq_data as $key => $value) {?>
                <div class="sk_box">
                <div class="sk_ques">
                    <div class="subheading"><?php echo $value['faq_question'];?></div>
                </div>
                <div class="sk_ans" style="display: none;">
                    <p class="editor_text">
                        <?php echo $value['faq_answer'];?>
                    </p>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>

<!-- FAQ section ends here -->