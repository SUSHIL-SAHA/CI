$('#home_from').validate({  

    rules: {
        name: { required: true },
        email: { required: true,email: true},
        phone: { required: true},
        address: { required: true },
        message: { required: true },
    },
    messages: {
         
        name: { required: "Please enter Name."},
        email: { required: "Please enter Email.",email:"Please enter valid Email."},
        phone: { required: "Please enter Phone no."},
        address: { required: "Please enter address" },
        message: { required: "Please enter Description."},
    },
        highlight: function(element) {
        $(element).removeClass("error");
    },
    submitHandler: function (form) {    
        $.ajax({
            type: "POST",
            url : base_url+'form',
            dataType : 'json',
            data: $(form).serialize(),
            headers: {
            'X-CSRF-Token': $('#csrftoken').val(),
            },
            beforeSend: function() 
            {
                $('#home_from .alert-message').html('<p><i class="fa fa-spinner fa-spin"></i> Loading...</p>');
                $("#home_from #submit").prop("disabled", true);
            },

            success: function (data) { 
                $("#home_from #submit").prop("disabled", false);

                if(data.flag == 1)
                {     
                        $('#home_from')[0].reset();
                        toastr.success(data.msg);
                        // var retHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>'+data.msg+'.</div>';
                        // $('#home_from .alert-message').removeClass('error').addClass('success').html(retHtml);
                        
                        window.setTimeout(function() {
                            window.location.href = data.req;
                        }, 5000);
                }
                else 
                {    
                    $('#csrftoken').val(data.new_token);
                    toastr.error(data.msg);
                    $('#service_from .alert-message').html('');
                    //var retHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong>'+data.msg+'.</div>';
                    // $('#home_from .alert-message').removeClass('success').addClass('error').html(retHtml);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("Error: " + errorThrown);
            },
        
        });
    }
});

$('#service_from').validate({  

    rules: {
        name: { required: true },
        email: { required: true,email: true},
        phone: { required: true ,minlength:10, maxlength:10},
        // pickup_address: { required: true },
        hiddenservice: { required: true },
        // pickup_address_floor: { required: true },
        // dropoff_address_floor: { required: true },
        calculate_product_data: { required: true },
        user_date: { required: true },
        user_time: { required: true },
        hiddenvehicle: { required: true },
        help_loading_unloading: { required: true },
        need_hours: { required: true },
        packing_services: { required: true },
        packing_materials: { required: true },
        pickup_address_number: { required: true },
        pickup_address_street: { required: true },
        pickup_address_city: { required: true },
        pickup_address_postcode: { required: true },
        pickup_address_floor: { required: true },
        pickup_address_lift_available: { required: true },
        pickup_address_parking_space: { required: true },
        dropoff_address_number: { required: true },
        dropoff_address_street: { required: true },
        dropoff_address_city: { required: true },
        dropoff_address_postcode: { required: true },
        dropoff_address_floor: { required: true },
        dropoff_address_lift_available: { required: true },
        dropoff_address_parking_space: { required: true },
        dropoff_address_message: { required: true },
        pickup_address_movers: { required: true },
        dropoff_address_movers: { required: true },
    },
    messages: {
         
        name: { required: "Please enter Name."},
        email: { required: "Please enter Email.",email:"Please enter valid Email."},
        phone: { required: "Please enter Phone no.",minlength:"Please enter at least 10 Number.",maxlength:'Please enter at least 10 Number.' },
        // pickup_address: { required: "Please enter Pickup Address."},
        hiddenservice: { required: "Please select Service."},
        pickup_address_floor: { required: "Please select Floor."},
        // dropoff_address: { required: "Please enter Dropoff Address."},
        dropoff_address_floor: { required: "Please select Floor."},
        calculate_product_data: { required: "Please add Product."},
        user_date: { required: "Please enter Date."},
        user_time: { required: "Please enter Time."},
        hiddenvehicle: { required: "Please select Vehicle."},
    },
    highlight: function(element) {
        $(element).removeClass("error");
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url : base_url+'service-insert',
            dataType : 'json',
            data: $(form).serialize(),
            headers: {
            'X-CSRF-Token': $('#csrftoken').val(),
            },
            beforeSend: function() 
            {
                $('#service_from .alert-message').html('<p><i class="fa fa-spinner fa-spin"></i> Loading...</p>');
                $("#service_from #submit").prop("disabled", true);
            },

            success: function (data) { 
                $("#service_from #submit").prop("disabled", false);

                if(data.flag == 1)
                {     
                        $('#service_from')[0].reset();
                        toastr.success(data.msg);
                        
                        window.setTimeout(function() {
                            window.location.href = data.req;
                        }, 5000);
                }
                else 
                {    
                    $('#csrftoken').val(data.new_token);
                    toastr.error(data.msg);
                    window.setTimeout(function() {
                        window.location.href = 'calculator';
                    }, 5000);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("Error: " + errorThrown);
            },
        
        });
    }
});