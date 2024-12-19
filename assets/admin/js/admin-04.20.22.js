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

  var favorite = [];

  $(".multiple_type").on('change',function(){
  var multiple_type = $(this).val();
  $.each($("input[name='check']:checked"), function(){
  favorite.push($(this).val());
  });
  var value=favorite;

  if(value=="")
  {
    alert('Please select a user role..!');
  }
  else
  {
    // var multiple_type = $('#multiple_type').val();
    if(multiple_type=='act')
    {
        var confirmation = confirm("Do you want to activatet these admin user roles?");
    }
    else{
        var confirmation = confirm("Do you want block these admin user roles?");
    }

    if(confirmation)
    {
        const csrfkey = $('.txt_csrfname').attr('name');
        var dataarr = {
          [csrfkey] : $('.txt_csrfname').attr('value'),
          check: favorite,
          multiple_type: multiple_type
        };
        $.ajax(
        {
            type: "POST",
            url:$('#sitepath').val()+"admin/adminusers/userrole/actionallrole",
            data: dataarr,
            async: false,
            success: function(data)
            {
              //console.log(data);
                location.reload();
            }
        });

    }
  }
});

  $(".inner_banner_multiple_type").on('change',function(){
  var multiple_type = $(this).val();
  $.each($("input[name='check']:checked"), function(){
  favorite.push($(this).val());
  });
  var value=favorite;

  if(value=="")
  {
    alert('Please select a Inner banner image..!');
  }
  else
    {
    // var multiple_type = $('#multiple_type').val();
            if(multiple_type=='delete')
            {
               var confirmation = confirm("Are you sure you want to delete this Inner banner image?");
            }
            else if(multiple_type=='act')
            {
               var confirmation = confirm("Do you want unblock this Inner banner image?");
            }
            else{
               var confirmation = confirm("Do you want block this Inner banner image?");
            }

            if(confirmation)
            {
                const csrfkey = $('.txt_csrfname').attr('name');
                var dataarr = {
                  [csrfkey] : $('.txt_csrfname').attr('value'),
                  banner_id: favorite,
                  multiple_type: multiple_type
                };
                $.ajax(
                {
                    type: "POST",
                    url:$('#sitepath').val()+"admin/banner/delete-active-inactive-multiple-inner-banner",
                    data: dataarr,
                    async: false,
                    success: function(data)
                    {
                      //console.log(data);
                        location.reload();
                    }
                });

            }
    }
});


  $(".home_banner_multiple_type").on('change',function(){
  var multiple_type = $(this).val();
  $.each($("input[name='check']:checked"), function(){
  favorite.push($(this).val());
  });
  var value=favorite;

  if(value=="")
  {
    alert('Please select a banner image..!');
  }
  else
    {
    // var multiple_type = $('#multiple_type').val();
            if(multiple_type=='delete')
            {
               var confirmation = confirm("Are you sure you want to delete this banner image?");
            }
            else if(multiple_type=='act')
            {
               var confirmation = confirm("Do you want unblock this banner image?");
            }
            else{
               var confirmation = confirm("Do you want block this banner image?");
            }

            if(confirmation)
            {
                const csrfkey = $('.txt_csrfname').attr('name');
                var dataarr = {
                  [csrfkey] : $('.txt_csrfname').attr('value'),
                  banner_id: favorite,
                  multiple_type: multiple_type
                };
                $.ajax(
                {
                    type: "POST",
                    url:$('#sitepath').val()+"admin/banner/delete-active-inactive-multiple-banner",
                    data: dataarr,
                    async: false,
                    success: function(data)
                    {
                      //console.log(data);
                        location.reload();
                    }
                });

            }
    }
});

  $(".cms_multiple_type").on('change',function(){
  var multiple_type = $(this).val();
  $.each($("input[name='check']:checked"), function(){
  favorite.push($(this).val());
  });
  var value=favorite;

  if(value=="")
  {
    alert('Please select a CMS page..!');
  }
  else
    {
    // var multiple_type = $('#multiple_type').val();
            if(multiple_type=='delete')
            {
               var confirmation = confirm("Are you sure you want to delete this CMS page?");
            }
            else if(multiple_type=='act')
            {
               var confirmation = confirm("Do you want unblock this CMS page?");
            }
            else{
               var confirmation = confirm("Do you want block this CMS page?");
            }

            if(confirmation)
            {
                const csrfkey = $('.txt_csrfname').attr('name');
                var dataarr = {
                  [csrfkey] : $('.txt_csrfname').attr('value'),
                  page_id: favorite,
                  multiple_type: multiple_type
                };
                $.ajax(
                {
                    type: "POST",
                    url:$('#sitepath').val()+"admin/cms/delete-active-inactive-multiple-page",
                    data: dataarr,
                    async: false,
                    success: function(data)
                    {
                      //console.log(data);
                        location.reload();
                    }
                });

            }
    }
});


$(".service_category_multiple_type").on('change',function(){
  var multiple_type = $(this).val();
  $.each($("input[name='check']:checked"), function(){
  favorite.push($(this).val());
  });
  var value=favorite;

  if(value=="")
  {
    alert('Please select a category..!');
  }
  else
    {
    // var multiple_type = $('#multiple_type').val();
            if(multiple_type=='delete')
            {
               var confirmation = confirm("Are you sure you want to delete this category?");
            }
            else if(multiple_type=='act')
            {
               var confirmation = confirm("Do you want unblock this category?");
            }
            else{
               var confirmation = confirm("Do you want block this category?");
            }

            if(confirmation)
            {
                const csrfkey = $('.txt_csrfname').attr('name');
                var dataarr = {
                  [csrfkey] : $('.txt_csrfname').attr('value'),
                  categoryid: favorite,
                  multiple_type: multiple_type
                };
                $.ajax(
                {
                    type: "POST",
                    url:$('#sitepath').val()+"admin/service/delete-active-inactive-multiple-category",
                    data: dataarr,
                    async: false,
                    success: function(data)
                    {
                      //console.log(data);
                        location.reload();
                    }
                });

            }
    }
});


$(".service_multiple_type").on('change',function(){
  var multiple_type = $(this).val();
  $.each($("input[name='check']:checked"), function(){
  favorite.push($(this).val());
  });
  var value=favorite;

  if(value=="")
  {
    alert('Please select a service..!');
  }
  else
    {
    // var multiple_type = $('#multiple_type').val();
            if(multiple_type=='delete')
            {
               var confirmation = confirm("Are you sure you want to delete this service?");
            }
            else if(multiple_type=='act')
            {
               var confirmation = confirm("Do you want unblock this service?");
            }
            else{
               var confirmation = confirm("Do you want block this service?");
            }

            if(confirmation)
            {
                const csrfkey = $('.txt_csrfname').attr('name');
                var dataarr = {
                  [csrfkey] : $('.txt_csrfname').attr('value'),
                  serviceId: favorite,
                  multiple_type: multiple_type
                };
                $.ajax(
                {
                    type: "POST",
                    url:$('#sitepath').val()+"admin/service/delete-active-inactive-multiple-service",
                    data: dataarr,
                    async: false,
                    success: function(data)
                    {
                      //console.log(data);
                        location.reload();
                    }
                });

            }
    }
});







});