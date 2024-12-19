$(function(){
	/*-------------------------------------RESPONSIVE_NAV--------------------------------*/
	var nav = $(".navbar").html();
	$(".responsive_nav").append(nav);
	/* if ($(".responsive_nav").children('ul').length) {
		$(".responsive_nav").addClass('mCustomScrollbar');
		$('.mCustomScrollbar').mCustomScrollbar({ scrollbarPosition: "outside" });
	} */
	$(".responsive_nav .dropdown").append('<i class="fa fa-angle-down"></i>');
	
	$('.responsive_btn').click(function () {
		$('html').addClass('responsive');
	});
	$('.bodyOverlay').click(function () {
		if ($('html.responsive').length)
		$('html').removeClass('responsive');
	});
/*-------------------------------------RESPONSIVE_NAV--------------------------------*/

// responsive sub menu on click
// 	$(document).on('click', '.nav-item .fa-angle-down', function () {
	
// 	if($(this).parent('.dropdown').hasClass("submenu")){
// 		$(this).parent('.dropdown').toggleClass('submenu').slideUp();	
// 	} else{
// 		$('.dropdown').removeClass('submenu');
// 		$(this).parent('.dropdown').toggleClass('submenu');	
// 	}
// });
  $(document).on('click', '.fa-angle-down', function () {
    //   $(this).parent().siblings().find('.dropdown-menu').slideUp();
      $(this).parent().siblings().find('.dropdown-submenu').slideUp();
      $(this).parent().siblings().removeClass('submenu');
      $(this).siblings('.dropdown-menu, .dropdown-submenu').slideToggle();
      $(this).parent().toggleClass('submenu');

  });
// responsive sub menu on click
	$(window).scroll(function() {
		if ($(this).scrollTop() > 180){
			$('body').addClass("stickymenu");
		} else {
			$('body').removeClass("stickymenu");
		}
	});


	$(".nav-item.dropdown").hover(
		function () {
		  $('.navbar .navbar-nav li .dropdown-menu').addClass("hover");
		},
		function () {
		  $('.navbar .navbar-nav li .dropdown-menu').removeClass("hover");
		}
	  );
  
		$('.homeslider').owlCarousel({
			items: 1,
			loop: true,
			autoplay: false,
			autoplayHoverPause: true,
			autoplayTimeout: 5000,
			smartSpeed: 1000,
			margin: 0,
			nav: true,
			dots: false,
			navElement: 'div',
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			lazyLoad: true,
			responsive: {
				0: {items: 1},
				360: {items: 1},
				480: {items: 1},
				600: {items: 1},
				768: {items: 1},
				992: {items: 1},
				1200: {items: 1},
			},
		});
    //   service slider starts
		$('.serviceslider').owlCarousel({
			items: 4,
			loop: true,
			autoplay: true,
			autoplayHoverPause: true,
			autoplayTimeout: 3000,
			smartSpeed: 1000,
			margin: 30,
			nav: false,
			dots: false,
			navElement: 'div',
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			lazyLoad: true,
			responsive: {
				0: {items: 2},
				360: {items: 1},
				480: {items: 2,margin: 10},
				992: {items: 3},
				1400: {items: 4},
				
			},
		});
		$('.location_bottom_list').owlCarousel({
			items: 3,
			loop: true,
			autoplay: true,
			autoplayHoverPause: true,
			autoplayTimeout: 3000,
			smartSpeed: 1000,
			margin: 30,
			nav: false,
			dots: true,
			navElement: 'div',
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			lazyLoad: true,
			responsive: {
				0: {items: 1},
				360: {items: 1},
				992: {items: 3},
				
			},
		});
    //   service slider ends
		$('.reviewslider').owlCarousel({
			items: 1,
			loop: true,
			autoplay: true,
			autoplayHoverPause: true,
			autoplayTimeout: 5000,
			smartSpeed: 1000,
			margin: 50,
			nav: false,
			dots: false,
			navElement: 'div',
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			lazyLoad: true,
			responsive: {
				0: {items: 1},
				360: {items: 2},
				600: {items: 3},
				768: {items: 4, margin: 30},
				992: {items: 4},
				1200: {items: 4}
			},
		});
    

});
// video play code 
$('.video-box').parent().click(function () {
    if($(this).children(".video-box").get(0).paused){        $(this).children(".video-box").get(0).play();   $(this).children(".popup-video").fadeOut();
      }else{       $(this).children(".video-box").get(0).pause();
    $(this).children(".popup-video").fadeIn();
      }
  });

	$(document).on("click", ".catID", function () {
		var categoryId = $(this).attr('data-id');

			if($(".catID").hasClass("active"))
			{
				$(".catID").removeClass("active")
			}
			
			$(this).addClass('active');
			
			
		$.ajax({
			url: base_url + '/product/' + categoryId,
			method: 'GET',
			dataType: 'json',
			success: function (data) {
				if(data.length !== 0){


					var product_data = '';
					$.each(data,function(key,value){
						var showWrapClass = value.selected_qty != 0 ? ' show_wrap' : '';
						product_data += `<li>
						<div class="figure-wrap${showWrapClass}">
							<figure>
								<img src="${base_url}/uploads/product_image/${value.image}">
							</figure>
							<div class="quantity-field">
								<button class="value-button decrease-button" data-action="decr" data-proid="${value.productId}" onclick="decreaseValue(this)">-</button>
									<div class="number product${value.productId}">${value.selected_qty}</div>
								<button class="value-button increase-button" data-action="incr" data-proid="${value.productId}" onclick="increaseValue(this)">+</button>
							</div>
						</div>
						<div>
							<p>${value.product_title}</p>
						</div>
						
					</li>`;
					var mb = $('.number').text();
					
					});
					$("#product_data").html(product_data);
				}
				else{
					$("#product_data").html(`<p class="text-danger h1">Current product not available</p>`);
				}
			}
		});
	
	});

	$('.catID').eq('0').click();
	var itemCount = $( "#singel_product_data .alert ").length;
	if(itemCount > 0) {
		$('.full_cart_data').parent().css({ "display": "block" });
		$('.tab-List').addClass('col-xl-8 col-lg-7').removeClass('col-xl-12 col-lg-12');
	}

	$(document).on("click", ".value-button", function () {
		var proId = $(this).data("proid");

		// alert(mb);
		var qty = 1;
		var action = $(this).attr('data-action');
		var mb = $(this).parents('.quantity-field').children('.number').text();
		if (mb > 0){
			$(this).parents('.figure-wrap').addClass('show_wrap');
			$(".item-box").addClass("show-box");
		} else {
			$(this).parents('.figure-wrap').removeClass('show_wrap');
		    $(".item-box").removeClass("show-box");
			var itemCount = $( "#singel_product_data .alert ").length;
			if(itemCount == 1) {
				$('.full_cart_data').parent().css({ "display": "none" });
				$('.tab-List').removeClass('col-xl-8 col-lg-7').addClass('col-xl-12 col-lg-12');
			}
		};

		// alert(qty);
		$.ajax({
			url: base_url + '/singel_product/' + proId,
			method: 'GET',
			dataType: 'json',
			data:{'action_type':action,'qty':qty},
			success: function (data) {
				var retHtml = '';
				if(data.length !== 0){
					retHtml += `<div class="item-box">
									<div class="item-top">
										<div class="subheading">Items Added</div>
										<div><a class="btn remove-all-cart-data">clear all</a></div>
									</div>
									<div id='singel_product_data'>`;
					var singel_product_data = '';
					$.each(data,function(key,value){
						retHtml += `<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<figure><img src="${base_url}/uploads/product_image/${value.image}"></figure> <span>${value.title}</span>Qty:${value.qty}
						
						<button type="button" data-closeid="${key}" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>`;
					});
					
					retHtml += `</div>
					<div class="button"><a href="${base_url}inquiry-form" class="btn">calculate</a></div>
				  </div>`; 
					//$("#singel_product_data").html(singel_product_data);
					//$("#calculate_product_data").html(singel_product_data);	
				}
				$(".full_cart_data").html(retHtml);
				var itemCount = $( "#singel_product_data .alert ").length;
				if(itemCount > 0) {
					$('.full_cart_data').parent().css({ "display": "block" });
					$('.tab-List').addClass('col-xl-8 col-lg-7').removeClass('col-xl-12 col-lg-12');
				}
				
			}
		});
	});

	// getCartData();
	// alert(qty);
	function getCartData(){
		$.ajax({
			url: base_url + '/get-cart-data/',
			method: 'GET',
			dataType: 'json',
			success: function (data) {
				/*if(data.length !== 0){
					var singel_product_data = '';
					$.each(data,function(key,value){
						singel_product_data += `<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<figure><img src="${base_url}/uploads/product_image/${value.image}"></figure> <span>${value.title}</span>Qty:${value.qty}
						
						<button type="button" data-closeid="${key}" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>`;
					$(`.product${key}`).text(value.qty);
					});
					$("#singel_product_data").html(singel_product_data);
					$("#calculate_product_data").html(singel_product_data);
				}
				else{
					$("#calculate_product_data").html('');
					$("#singel_product_data").html(`<p class="text-danger h1"></p>`);
				}*/
				var retHtml = '';
				if(data != null && data.length !== 0){
					retHtml += `<div class="item-box">
									<div class="item-top">
										<div class="subheading">Items Added</div>
										<div><a class="btn remove-all-cart-data">clear all</a></div>
									</div>
									<div id='singel_product_data'>`;
					var singel_product_data = '';
					$.each(data,function(key,value){
						retHtml += `<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<figure><img src="${base_url}/uploads/product_image/${value.image}"></figure> <span>${value.title}</span>Qty:${value.qty}
						
						<button type="button" data-closeid="${key}" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>`;
					});
					
					retHtml += `</div>
					<div class="button"><a href="${base_url}inquiry-form" class="btn">calculate</a></div>
				  </div>`; 
					//$("#singel_product_data").html(singel_product_data);
					//$("#calculate_product_data").html(singel_product_data);	
				}
				$(".full_cart_data").html(retHtml);
				var itemCount = $( "#singel_product_data .alert ").length;
				if(itemCount < 1) {
					$('.full_cart_data').parent().css({ "display": "none" });
					$('.tab-List').removeClass('col-xl-8 col-lg-7').addClass('col-xl-12 col-lg-12');
				}
			}
		});
	}

	function getCartInquiryData(){
		$.ajax({
			url: base_url + '/get-cart-data/',
			method: 'GET',
			dataType: 'json',
			success: function (data) {
				var retHtml = '';
				if(data != null && data.length !== 0){
					$.each(data,function(key,value){
						retHtml += `<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<figure><img src="${base_url}/uploads/product_image/${value.image}"></figure> <span>${value.title}</span>Qty:${value.qty}
						
						<button type="button" data-closeid="${key}" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>`;
					}); 
					//$("#singel_product_data").html(singel_product_data);
					//$("#calculate_product_data").html(singel_product_data);	
				}
				$(".full_cart_data").html(retHtml);
			}
		});
	}

	$(document).on("click", ".close", function () {
		if(confirm('Do you want to remove this item?')){
			var that = $(this);
			var proId = $(this).data("closeid");
			// alert(proId);
			$.ajax({
				url: base_url + 'remove-cart-data/' + proId,
				method: 'GET',
				dataType: 'json',
				success: function (data) {
					// console.log(data);
					$(`.product${proId}`).html('0').parents('.figure-wrap').removeClass('show_wrap');
					if(that.parents('.full_cart_data').hasClass('calculate_product_data')){
						getCartInquiryData();
					} else {
						getCartData();
					}
					
				}
			});
		}
		// alert(closeid);
	});

	$(document).on("click", ".remove-all-cart-data", function () {
		if(confirm('Do you want to remove all the cart items?')){
			$.ajax({
				url: base_url + 'remove-all-cart-data',
				method: 'GET',
				dataType: 'json',
				success: function (data) {
					/*$('.number').html('0');
					$("#calculate_product_data").html('');
					$("#singel_product_data").html(`<p class="text-danger h1"></p>`);*/
					$('.number').html('0').parents('.figure-wrap').removeClass('show_wrap');
					$('.full_cart_data').html('');
					$('.full_cart_data').parent().css({ "display": "none" });
					$('.tab-List').removeClass('col-xl-8 col-lg-7').addClass('col-xl-12 col-lg-12');
				}
			});
		}
		// alert(closeid);
	});

	
	function increaseValue(button, limit) {
	const numberInput = button.parentElement.querySelector('.number');
	var value = parseInt(numberInput.innerHTML, 10);
	// alert(value);
	if(value>0){
		$(this).parents('.figure-wrap').addClass('show_wrap');
		$(".item-box").addClass('show-box');
	}else {
		$(this).parents('.figure-wrap').removeClass('.show_wrap');
		$(".item-box").removeClass('.show-box');
	}
	if(isNaN(value)) value = 0;
	if(limit && value >= limit) return;
	numberInput.innerHTML = value+1;                
  }
  
  
  function decreaseValue(button) {
	const numberInput = button.parentElement.querySelector('.number');
	var value = parseInt(numberInput.innerHTML, 10);
	if(isNaN(value)) value = 0;  
	if(value < 1){
		return;
	} 
	numberInput.innerHTML = value-1;
  }
$('#btn1').click(function(){
		window.location =  base_url + "#service";
})
