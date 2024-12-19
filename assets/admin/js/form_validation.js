$(document).ready(function() {

     $('#login-form').validate({

         rules: {
             email: { required: true },
             password: { required: true },
         },
         messages: {
             email: { required: "Please enter email" },
             password: { required: "Please enter password" },

         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });

     $('#change_password_form_id').validate({

         rules: {
             old_pass: { required: true },
             new_pass: { required: true },
             confirm_pass: { required: true, equalTo: '#new_pass' },
         },
         messages: {
             old_pass: { required: "Please enter old password" },
             new_pass: { required: "Please enter new password" },
             confirm_pass: { required: "Please enter confirm password", equalTo: "Password and confirm password are not same." },

         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });

     $('#AddEditHomeBannerId').validate({

         rules: {
             BannerTitle: { required: true },
             bannerImage: {
                 required: function() {
                     //console.log($('#hiddenbannerImage').attr('value'));
                     if ($('#hiddenbannerImage').attr('value') != "")
                         return false;
                     else
                         return true;
                 }
             },
         },
         messages: {
             BannerTitle: { required: "Please enter banner title." },
             bannerImage: { required: "Please choose banner image." },
         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });


     $('#AddEditserviceId').validate({

         rules: {
             category: { required: true },
             ServiceTitle: { required: true },
             show_other_Service: { required: true },
             ServiceDescription: { required: true },
             serviceImage: {
                 required: function() {
                     //console.log($('#hiddenbannerImage').attr('value'));
                     if ($('#hiddenserviceImage').attr('value') != "")
                         return false;
                     else
                         return true;
                 }
             },
         },
         messages: {
             category: { required: "Please choose service category." },
             ServiceTitle: { required: "Please enter service title." },
             ServiceDescription: { required: "Please enter service description." },
             serviceImage: { required: "Please choose service image." },
         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });


     $('#AddEditcategoryId').validate({

         rules: {
             categoryName: { required: true },
             categoryDescription: { required: true },
             categoryImage: {
                 required: function() {
                     //console.log($('#hiddenbannerImage').attr('value'));
                     if ($('#hiddencategoryImage').attr('value') != "")
                         return false;
                     else
                         return true;
                 }
             },
         },
         messages: {
             categoryName: { required: "Please enter category name." },
             categoryDescription: { required: "Please enter category description." },
             categoryImage: { required: "Please choose category image." },
         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });


      $('#reset-password-form').validate({

         rules: {
             new_pass: { required: true },
             confirm_pass: { required: true, equalTo: '#new_pass' },
         },
         messages: {
             new_pass: { required: "Please enter new password" },
             confirm_pass: { required: "Please enter confirm password", equalTo: "Password and confirm password are not same." },

         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });
     
     $('#AddEditAdminUserRole').validate({
         rules: {
            RoleName: { required: true }
         },
         messages: {
            RoleName: { required: "Please enter role name." }
         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });
    $('#AddAdminUser').validate({
         rules: {
            UserName: { required: true },
            UserEmail: { required: true, email: true },
            UserPhone: { required: true },
            UserPassword: { required: true },
            UserConfirmPassword: { required: true,equalTo : "#UserPassword" },
            Role: { required: true },
         },
         messages: {
            UserName: { required: "Please enter name." },
            UserEmail: { required: "Please enter email.", email: "Please enter a valid email." },
            UserPhone: { required: "Please enter phone no." },
            UserPassword: { required: "Please enter password." },
            UserConfirmPassword: { required: "Please enter confirm password.",equalTo: "Password and confirm password are not same." },
         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });
    $('#EditAdminUser').validate({
         rules: {
            UserName: { required: true },
            UserEmail: { required: true, email: true },
            UserPhone: { required: true },
            UserPassword: { required: '#changepass:checked' },
            UserConfirmPassword: { required: '#changepass:checked', equalTo : "#UserPassword" },
            Role: { required: true },
         },
         messages: {
            UserName: { required: "Please enter name." },
            UserEmail: { required: "Please enter email.", email: "Please enter a valid email." },
            UserPhone: { required: "Please enter phone no." },
            UserPassword: { required: "Please enter password." },
            UserConfirmPassword: { required: "Please enter confirm password.",equalTo: "Password and confirm password are not same." },
         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });

    $('#AddEditcontentId').validate({
         rules: {
            for_page: { required: true },
            heading : { required: true }
         },
         messages: {
            for_page: { required: "Please choose page name." },
            heading: { required: "Please heading name." },
         },
         highlight: function(element) {
             $(element).removeClass("error");
         }
     });

    $('#AddEditPluginformId').validate({
            rules: {
                module_name: { required: true },
            },
            messages: {
                module_name: { required: "Please enter module name." },
            },
            highlight: function(element) {
                $(element).removeClass("error");
            }
        });

});
 $('#AddEditHomegalleryId').validate({

    rules: {
        video_link: { required: true },
        galleryImage: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddengalleryImage').attr('value') != "")
                    return false;
                else
                    return true;
            }
        },
    },
    messages: {
        video_link: { required: "Please enter Title." },
        galleryImage: { required: "Please choose gallery image." },
    },
    highlight: function(element) {
        $(element).removeClass("error");
    }
});
$('#AddEdittestimonialid').validate({

    rules: {
        testimonial_name: { required: true },
        testimonial_description: { required: true },
        dept: { required: true},
        rating: { required: true},
        image: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddenimage').attr('value') != "")
                    return false;
                else
                    return true;
            }
        },
    },
    messages: {
         
        testimonial_name: { required: "Please enter name." },
        testimonial_description: { required: "Please enter description." },
        dept: { required: "Please enter your dept." },
        rating: { required: "please rate us." },
        image: { required: "Please choose  image." },
    },
    highlight: function(element) {
        $(element).removeClass("error");
    }
});
$('#AddEditHomefaq_id').validate({

    rules: {
        faq_question: { required: true },
        faq_answer: { required: true },
    },
    messages: {
         
        faq_question: { required: "Please enter question." },
        faq_answer: { required: "Please enter answer." },
    },
    highlight: function(element) {
        $(element).removeClass("error");
    }
});
$('#AddEditHomeinstallation_id').validate({

    rules: {
        installation_title: { required: true },
        installation_text: { required: true },
        installation_description: { required: true },
        video_link: { required: true },
        installation_image: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddeninstallation_image').attr('value') != "")
                    return false;
                else
                    return true;
            }
        },
    },
    messages: {
         
        installation_title: { required: "Please enter title."},
        installation_text: { required: "Please enter text." },
        installation_description: { required: "Please enter description." },
        video_link: { required: "Please enter video link." },
        installation_image: { required: "Please choose  image." },
    },
    highlight: function(element) {
        $(element).removeClass("error");
    }
});
$('#AddEditHomebenefits_id').validate({

    rules: {
        benefits_title: { required: true },
        benefits_description: { required: true },

    },
    messages: {
         
        benefits_title: { required: "Please enter Title."},
        benefits_description: { required: "Please enter Description." },
    },
    highlight: function(element) {
        $(element).removeClass("error");
    }
});
$('#AddEditsuburb_id').validate({

    rules: {
        category_id: { required: true },
        suburb_title: { required: true },
        image: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddenimage').attr('value') != "")
                    return false;
                else
                    return true;
            },  
        },
    },
    messages: {
         
        category_id: { required: "Please enter category."},
        suburb_title: { required: "Please enter suburb name." },
        image: { required: "Please choose  image." },

    },
    highlight: function(element) {
        $(element).removeClass("error");
    }
});
$('#AddEditlocations_id').validate({

    rules: {
        suburb: { required: true },
        locations_title: { required: true },
        // map_link: { required: true },
        image: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddenimage').attr('value') != "")
                    return false;
                else
                    return true;
            },  
        },
        image2: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddenimage2').attr('value') != "")
                    return false;
                else
                    return true;
            },  
        },
    },
    messages: {
         
        suburb: { required: "Please enter suburb."},
        locations_title: { required: "Please enter suburb name." },
        image: { required: "Please choose  image." },
        image2: { required: "Please choose  image." },
        // map_link: { required: "Please enter map link." },

    },
    highlight: function(element) {
        $(element).removeClass("error");
    }
});
$('#AddEditHomeblogs_id').validate({

    rules: {
        blogs_title: { required: true },
        blogs_description: { required: true },
        blogs_image: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddenblogs_image').attr('value') != "")
                    return false;
                else
                    return true;
            },  
        },

    },
    messages: {
         
        blogs_title: { required: "Please enter Title."},
        blogs_description: { required: "Please enter Description." },
        blogs_image: { required: "Please choose  image." },
    },
    highlight: function(element) {
        $(element).removeClass("error");
    }   
});

$('#AddEditproductId').validate({

    rules: {
        category_id: { required: true },
        product_title: { required: true },
        image: {
            required: function() {
                //console.log($('#hiddenbannerImage').attr('value'));
                if ($('#hiddenimage').attr('value') != "")
                    return false;
                else
                    return true;
            },  
        },

    },
    messages: {
        category_id: { required: "Please enter category."}, 
        product_title: { required: "Please enter Title."},
        image: { required: "Please choose  image." },
    },
    highlight: function(element) {
        $(element).removeClass("error");
    }   
});


