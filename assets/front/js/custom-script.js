$(function(){
  
	$('.testimonialSlider').owlCarousel({
		items: 3,
		loop:true,
		animateIn: 'fadeIn',
		animateOut:'fadeOut',
		margin:30,
		nav:false,
		dots:true,
		autoplay: false,
		autoplaySpeed: 2500,
		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			768:{
				items:2
			},
			1000:{
				items:3
			}
		}
	  });
    // home page product tab part starts
	// $('#tabs-nav li:first-child').addClass('active');
	// $('.tab-content').hide();
	// $('.tab-content:first').show();

	// Click function
	$('#tabs-nav li').click(function(){
	$('#tabs-nav li').removeClass('active');
	$(this).addClass('active');
	$('.tab-content').hide();
	
	var activeTab = $(this).find('a').attr('href');
	$(activeTab).fadeIn();
	return false;
	});

	// home page product tab part ends
	  /* =================Faq Toggle================= */
	  $( ".sk_toggle .sk_box:nth-child(1)").addClass('opened').find('.sk_ans').css("display", "inherit");
	  $(".sk_toggle .sk_box > .sk_ques").bind("click", function () {
		if ($(this).parent().hasClass('opened')) {
		  $(this).parent().siblings().removeClass('opened');
		  $(this).parent().siblings().children(".sk_ans").slideUp(500);
		  $(this).parent().removeClass('opened');
		  $(this).next('.sk_ans').slideUp(500);
		  return false;
		} else {
		  $(this).parent().siblings().removeClass('opened');
		  $(this).parent().siblings().children(".sk_ans").slideUp(500);
		  $(this).parent().addClass('opened');
		  $(this).next('.sk_ans').slideDown(500);
		  return false;
		}
	  });

	$( "#user_date" ).datepicker({
		dateFormat: "yy-mm-dd",
		minDate: 1
	});

	$('#user_time').timepicker({
		timeFormat: 'h:mm p',
		interval: 60,
		minTime: '09',
		maxTime: '10:00pm',
		startTime: '00:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});
});
