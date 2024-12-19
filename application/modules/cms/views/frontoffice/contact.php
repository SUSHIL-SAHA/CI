<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">

</section>
<!-- Banner section design ends here -->
<!-- contact us page sectionstarts from here -->

<section class="section contact-us">
    <div class="container">
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url(); ?>home">Home</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $pageTitle;?></li>
        </ol>
    </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="left_wrap">
                    <div class="content-wrap">
                        <h1 class="heading">
                           <?php echo $pageExtraFields['contact_us_title'];?>
                        </h1>
                        <div class="contact-wrap">
                                <ul>
                                    <li class="address"> <div class="left"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                        <a href="https://maps.google.com/maps?q=<?php echo site_settings_data('address');?>" target="_blank" class="right"><span><?php echo site_settings_data('address');?></span></a>
                                    </li>
                                    <li><div> <a href="tel:<?php echo site_settings_data('helpline_no');?> "><i class="fa fa-phone" aria-hidden="true"></i><span><?php echo site_settings_data('helpline_no');?></span></a> |
                                    <a href="tel:<?php echo site_settings_data('another_helpline_no');?>"><span><?php echo site_settings_data('another_helpline_no');?></span></a></div></li>
                                    <li><a href="mailto:<?php echo site_settings_data('helpline_email_address');?>"><i class="fa fa-envelope" aria-hidden="true"></i>
                                        <span><?php echo site_settings_data('helpline_email_address');?></span></a></li>
                                </ul>
                            </div>
                    </div>
                    <div class="social">
                                <a href="<?php echo site_settings_data('facebook_link');?>" target="_blank" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="<?php echo site_settings_data('twitter_link');?>" target="_blank" class="sk_twitter"><figure><img src="<?php echo base_url();?>assets/front/images/twitter.png" alt="twittericon"></figure></a>
                                <a href="<?php echo site_settings_data('linkedin_link');?>" target="_blank" class="sk_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-wrap">
                    <div class="contact_form_wrap">
                            <div class="contact_form">
                            <div class="heading"><?php echo $pageExtraFields['contact_us_form_title'];?></div>
                            <form id="home_from" action="javascript:void(0);">
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
                            <button type="submit" id='submit' class="btn">submit</button>
                            <input type="hidden" id="csrftoken" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                            <div class="alert-message" role="status"></div>
                        </form>
                            </div> 
                            </div>
                    </div>
            </div>
            <div class="col-lg-12">
            <div class="map_wrapping">
                        <iframe src="<?php echo $pageExtraFields['contact_us_map_link'];?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
            </div>
    </div>
</section>
<!-- contact us page section ends here -->