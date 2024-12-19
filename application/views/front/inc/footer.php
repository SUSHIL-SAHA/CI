<!-- footer  starts here-->
<footer class="mainfooter">
    <div class="container">
        <div class="foot-top">
            <div class="site_links first">
                <h3 class="subheading">Useful Links</h3>
                    <div class="fnav">
                        <ul class="menu">
                            <li class="menu-item "><a href="<?php echo base_url()?>about-us" aria-current="page">Who We Are</a></li>
                            <li class="menu-item "><a href="javascript:void(0)" id="btn1" aria-current="page">What We Do</a></li>
                            <li class="menu-item "><a href="<?php echo base_url()?>calculator" aria-current="page">Cost Calculator </a></li>
                            <li class="menu-item "><a href="<?php echo base_url()?>faq" aria-current="page">FAQ</a></li>
                        </ul>						
                    </div>					
            </div>
            <div class="site_links second">
                <h3 class="subheading">Services</h3>
                    <div class="fnav">
                        <ul class="menu">
                            <?php foreach (service() as $key => $value) {?>
                                 <li class="menu-item"><a href="<?php echo base_url().'service/'.$value['service_slug'];?>" aria-current="page"><?php echo $value['service_title'];?></a></li>
                            <?php }?>
                        </ul>						
                    </div>					
            </div>
            <div class="site_links third">
                <h3 class="subheading">Other Links</h3>
                    <div class="fnav">
                        <ul class="menu">
                            <li class="menu-item "><a href="<?php echo base_url()?>" aria-current="page">Home</a></li>
                            <li class="menu-item "><a href="<?php echo base_url()?>testimonials" aria-current="page">Testimonials</a></li>
                            <li class="menu-item "><a href="<?php echo base_url()?>blogs" aria-current="page">Blogs</a></li>
                            <li class="menu-item "><a href="<?php echo base_url()?>contact-us" aria-current="page">Contact</a></li>
                        </ul>						
                    </div>					
            </div>
            <div class="site_links fourth">
                <h3 class="subheading">Address</h3>
                    <div class="fnav">
                        <ul class="menu">
                            <li class="menu-item "><a href="https://maps.google.com/maps?q=<?php echo site_settings_data('address');?>" target="_blank"><span><?php echo site_settings_data('address');?></span></a></li>
                            <li class="menu-item">
                                <a href="<?php echo site_settings_data('facebook_link');?>" target="_blank" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>

                                </a>
                                <a href="<?php echo site_settings_data('twitter_link');?>" target="_blank" class="sk_twitter"><figure><img src="<?php echo base_url();?>assets/front/images/twitter.png" alt="twitter_icon"></figure></a>
                                <a href="<?php echo site_settings_data('linkedin_link');?>" target="_blank" class="sk_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </li>
                        </ul>						
                    </div>					
            </div>
            <div class="site_links fifth">
                <h3 class="subheading">Say Hello</h3>
                    <div class="fnav">
                        <ul class="menu">
                            <li class="menu-item "><a href="mailto:<?php echo site_settings_data('helpline_email_address');?>" aria-current="page"><?php echo site_settings_data('helpline_email_address');?></a></li>
                            <li class="menu-item "><a href="tel:<?php echo site_settings_data('helpline_no');?>" aria-current="page"><?php echo site_settings_data('helpline_no');?></a></li>
                            <li class="menu-item "><a href="tel:<?php echo site_settings_data('another_helpline_no');?>" aria-current="page"><?php echo site_settings_data('another_helpline_no');?></a></li>
                        </ul>						
                    </div>					
            </div>
        </div>
    </div>
    <div class="copyright">
		<div class="container">
			<div class="copyright_wrapper d-flex align-items-center justify-content-center">
				<p>Copyright © <?php echo date('Y');?> <a href="<?php echo base_url();?>">L and N Services </a><span>|</span></p>
				
				<p>Designed &amp; Developed by <a href="https://www.eclicksoftwares.com/" target="_blank">Eclick Softwares &amp; Solutions Pvt. Ltd.</a></p>
			</div>
		</div>
	</div>
</footer>
<!-- footer ends here-->

  </body>
  <script> var base_url = '<?php echo base_url(); ?>';</script>
  <script src="<?php echo base_url()?>assets/front/js/jquery-min.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/jquery-ui.min.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/jquery.timepicker.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/toastr.min.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url();?>assets/front/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/form_val.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/custom.js"></script>
  <script src="<?php echo base_url()?>assets/front/js/custom-script.js"></script>

</html>