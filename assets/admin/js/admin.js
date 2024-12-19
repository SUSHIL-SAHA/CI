 (function($) {
     "use strict"; // Start of use strict
     // Configure tooltips for collapsed side navigation
     var sitepath = $('#sitepath').val();
     // Toggle the side navigation
  
     $("#sidenavToggler").click(function(e) {
         e.preventDefault();
         $("body").toggleClass("sidenav-toggled");
         $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
         $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
     });;
     $(".dragtablecmspages").tableDnD({
         onDragClass: "myDragClass",
         onDrop: function(table, row) {
             var rows = table.tBodies[0].rows;
             //console.log(rows);
             var debugStr = "";
             for (var i = 0; i < rows.length; i++) {
                 debugStr += rows[i].id + ",";
             }
             //console.log(debugStr);
             $.ajax({
                 url: sitepath + 'administrator/cms-pages/swap?pageId=' + debugStr,
                 method: "get",
                 data: "pageId:" + debugStr,
                 dataType: "json",
                 success: function(data) {
                     console.log(data);
                 }
             });
             //console.log(debugStr);
             //$('#debugArea').html(debugStr);
             //https://isocra.com/2008/02/table-drag-and-drop-jquery-plugin/
         }
     });


     $(".change-user-pic").click(function() {
         $("#profile_pic_image").hide();
         $("#dropzone").show();
         $("#dropzone").trigger('click');
     });

     $('.regeneratepassword').click(function() {
         //alert('here');
         var csrfName = $('.txt_csrfname').attr('name');
         var csrfHash = $('.txt_csrfname').val();
         $('.passwordbody').html('Loading...');
         $.ajax({
             type: "POST",
             url: $('#sitepath').val() + "admin/adminusers/generatepassword",
             data: {
                 [csrfName]: csrfHash
             },
             async: false,
             success: function(data) {
                 var dataJson = JSON.parse(data);
                 $('.passwordbody').html(dataJson.autopass);
                 $('.txt_csrfname').val(dataJson.csrf);
             }
         });
     });

     $('.selectpassword').click(function() {
         var password = $('.passwordbody').html();
         $('#UserPassword').val(password);
         $('#UserConfirmPassword').val(password);
         navigator.clipboard.writeText(password);
         $('#passwordsuggestion').modal('hide');
    //$('.close').trigger('click');
  });
  $('.generatepass').click(function(){
    $('#passwordsuggestion').modal('show');
     });
     $("#checkall").click(function() {
         $('.mainpermission').not(this).prop('checked', this.checked);
  });
  $("#checkadd").click(function(){
    
    $('.addpermission').not(this).prop('checked', this.checked);
  });
  $("#checkedit").click(function(){
    
    $('.editpermission').not(this).prop('checked', this.checked);
  });
  $("#checkdelete").click(function(){
    
    $('.deletepermission').not(this).prop('checked', this.checked);
  });
  $("#checklist").click(function(){
    
    $('.listpermission').not(this).prop('checked', this.checked);
  });




  $(document).on('change', '.multi_select', function() {
    var dataAction = $(this).data('action');
    var actionType = $(this).val();
    var dataIds = [];
    $.each($("input[name='check']:checked"), function(){
      dataIds.push($(this).val());
    });
    if(!dataIds.length){
      alert('Please select any row');
    }else{
         console.log(dataIds);
      var alertText = (dataIds.length > 1) ? 'these rows' : 'this row'; 
      var confirmation = '';
      switch(actionType){
        case 'delete':
          confirmation = confirm("Are you sure to delete "+alertText+"?");
          break;
        case 'act':
          confirmation = confirm("Are you sure to activate "+alertText+"?");
          break; 
        case 'inact':
          confirmation = confirm("Are you sure to deactivate "+alertText+"?");
          break;  
      }
      if(confirmation){
        const csrfkey = $('.txt_csrfname').attr('name');
        var dataArr = {
          [csrfkey] : $('.txt_csrfname').attr('value'),
          dataIds: dataIds,
          actionType: actionType
        };
        $.ajax({
            type: "POST",
            url: baseURL+"admin/"+dataAction,
            data: dataArr,
            dataType : "json",
            async: false,
            beforeSend: function() {
              $('body').prepend('<div id="overlay"><div class="spinner"></div>Please wait...</div>');
            },
            success: function(data)
            {
              console.log(data);
              $('#overlay').remove();
              if(data.status == 1){
                location.reload();
              }else if(data.status == 2){
                window.location.href = baseURL + 'admin/dashboard';
              }
            }
        });
      }
    }
  });


  $(document).on('change', "input[name='check'], input[name='checkAll']", function() {
    $('.multi_select').val('');
  });

  if($('.fancybox').length){
    $(".fancybox").fancybox();
  }

  $(document).on('click', '.is_home_category', function() {

    var categoryId = $(this).attr("data-id");
    var is_home_value = $(this).attr("data-value");
    const csrfkey = $('.txt_csrfname').attr('name');
        var dataArr = {
          [csrfkey] : $('.txt_csrfname').attr('value'),
          categoryId: categoryId,
          is_home_value : is_home_value
        };

        $.ajax({
          type: "POST",
          url: baseURL+"admin/service/is-home-service",
          data: dataArr,
          dataType : "json",
          async: false,
          beforeSend: function() {
            //  $('body').prepend('<div id="overlay"><div class="spinner"></div>Please wait...</div>');
          },
          success: function(data)
          {
            console.log(data);
            // $('#overlay').remove();
            if(data.status == 1){
              location.reload();
            }
            else{
              $('.txt_csrfname').val(data.csrf_token)
            }
          }
      });

  });

  $(document).on('click', '.is_home_service', function() {

    var serviceId = $(this).attr("data-id");
    var is_home_value = $(this).attr("data-value");
    const csrfkey = $('.txt_csrfname').attr('name');
        var dataArr = {
          [csrfkey] : $('.txt_csrfname').attr('value'),
          serviceId: serviceId,
          is_home_value : is_home_value
        };

        $.ajax({
          type: "POST",    
          url: baseURL+"admin/service/is-home-featured-service",
          data: dataArr,
          dataType : "json",
          async: false,
          beforeSend: function() {
            //  $('body').prepend('<div id="overlay"><div class="spinner"></div>Please wait...</div>');
          },
          success: function(data)
          {
            console.log(data);
            // $('#overlay').remove();
            if(data.status == 1){
              location.reload();
            }
            else{
              $('.txt_csrfname').val(data.csrf_token)
            }
          }
      });

  });
  $(document).on('click', '.is_home_testimonial', function() {

    var testimonialid = $(this).attr("data-id");
    var is_home_value = $(this).attr("data-value");
    const csrfkey = $('.txt_csrfname').attr('name');
        var dataArr = {
          [csrfkey] : $('.txt_csrfname').attr('value'),
          testimonialid: testimonialid,
          is_home_value : is_home_value
        };

        $.ajax({
          type: "POST",    
          url: baseURL+"admin/testimonial/is-home-featured-testimonial",
          data: dataArr,
          dataType : "json",
          async: false,
          beforeSend: function() {
            //  $('body').prepend('<div id="overlay"><div class="spinner"></div>Please wait...</div>');
          },
          success: function(data)
          {
            console.log(data);
            // $('#overlay').remove();
            if(data.status == 1){
              location.reload();
            }
            else{
              $('.txt_csrfname').val(data.csrf_token)
            }
          }
      });

  });
  $(document).on('click', '.status_subscriber', function() {
    
    var result = confirm("Want to change status?");
    if (result) {

    var id = $(this).attr("data-id");
    var status_subscriber = $(this).attr("data-value");
    const csrfkey = $('.txt_csrfname').attr('name');
        var dataArr = {
          [csrfkey] : $('.txt_csrfname').attr('value'),
          id : id,
          status_subscriber : status_subscriber
        };

        $.ajax({
          type: "POST",    
          url: baseURL+"admin/subscriber/featured-subscriber",
          data: dataArr,
          dataType : "json",
          async: false,
          beforeSend: function() {
            //  $('body').prepend('<div id="overlay"><div class="spinner"></div>Please wait...</div>');
          },
          success: function(data)
          {
            console.log(data);
            // $('#overlay').remove();
            if(data.status == 1){
              location.reload();
            }
            else{
              $('.txt_csrfname').val(data.csrf_token)
            }
          }
      });

    }

  });

 })(jQuery); // End of use strict
 // show image modal
 $(document).on('click', '.prevImageLink', function() {
     var imageHref = $(this).data('href');
     $('#myModalShowImage').find('#imagepreview').attr('src', imageHref);
     $('#myModalShowImage').modal('show');
 });
 $(document).on('click', '.deleteRow', function() {
     var dataHref = $(this).data('delete-href');
     //alert(dataHref);
     var dataType = $(this).data('type');

     $('#deleteModal').find('a#delete').attr('href', dataHref);
     $('#deleteModal').modal('show');
 });
 $(document).on('click', '.deleteRecord', function() {
     var dataHref = $(this).attr('data-delete-href');
     var dataType = $(this).data('type');

     $('#deleteModal').find('#delform').attr('action', dataHref);
     $('#deleteModal').modal('show');
 });


// $(function () {
//   $('.ui.dropdown')
//   .dropdown();

//   $('.no.ui.dropdown')
//   .dropdown({
//   useLabels: false
//   });
  
//   $('.ui.button').on('click', function () {
//   $('.ui.dropdown')
//     .dropdown('restore defaults')
//   })
  
// })

$("#checkAll").change(function () {
  $("input:checkbox").prop('checked', $(this).prop("checked"));
});

$(document).ready(function(){
  
$(".remove_image").on("click", function(){
  // alert('okk');
  $('.alert-messages').html('');
  var pageId = $(this).data("page_id"),
    fieldKey = $(this).data("field_key"),
    pageImage = $(this).data("page_image"),
    hitURL = $('#sitepath').val()+"admin/cms/deleteCmsImage";
  
  var confirmation = confirm("Are you sure you want to delete this image?");
  
  
  if(confirmation) {
    
    $.ajax({
      type : "POST",
      dataType : "json",
      url : hitURL,
      data : { pageId : pageId, fieldKey : fieldKey, pageImage : pageImage } 
    }).done(function(data){
      $('.alert-messages').html(data.msg);
      if(data.status){
        setTimeout(function(){
          location.reload();
        }, 3000);
      }
    });
  }
});






$('#changepass').change(function(){
  
  if ($(this).prop('checked')==true){ 
    //$('.passwordsection').attr('style','display: block');
    $('.passwordsection').slideDown();
  }else{
    //$('.passwordsection').attr('style','display: none');
    $('.passwordsection').slideUp();
  }

});

$('#sameCheck').change(function(){
  
  if ($(this).prop('checked')==true){ 
    $('.slideBox').attr('style','display: none');
   
  }else{
    $('.slideBox').attr('style','display: block');
    // $('.passwordsection').slideUp();
  }

});

if($('#quotation_form').length){
  $('#quotation_form').submit(function(){
    // alert('working');
    if($('#vehicleId').val() == ''){
      alert('please select a vehicle');
    } else if($('#quoted_price').val() == '') {
      alert('please put the price');
    } else {
      $.ajax({
        type: "POST",    
        url: baseURL+"admin/inquiry/send_quotation",
        data: $('#quotation_form').serialize(),
        dataType : "JSON",
        beforeSend: function() {
          $('#send_quotation_btn').append('<i class="fa fa-spinner fa-spin fa-quotation-area"></i>').attr('disabled', 'disabled');
        },
        success: function(retData, textStatus, jqXHR) {
          console.log(jqXHR.status);
          $('.fa-quotation-area').remove();
          if(retData.resp == 1)
            window.location = baseURL + 'admin/service-inquiry';
          else
            $('.quotation_message').html('Quotation cannot be send');
        },
        error: function (jqXHR, textStatus, errorthrown) {
          console.log(textStatus);
          console.log(errorthrown);
        }
      });
    }

    return false;
  });
}






});
