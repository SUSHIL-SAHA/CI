<!-- Banner section design starts here  -->
<section class="banner_section inner_banner">


<!-- Banner section design ends here -->
<!--  calculator  page html starts -->
<section class=" section enquery_section">
    <div class="container">
        <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="<?php echo base_url(); ?>home">Home</a>
            </li>
            <li class="breadcrumb-item active">Inquiry Form
        </ol>
        </div>
        <?php echo $this->session->flashdata('warning'); ?>
        <div class="row">
            <div class="col-lg-12">
                <form class="contact_form" id="service_from" action="<?php // echo base_url('service_insert');?>" method="post">
                    <h1 class="heading">
                    Request an Estimate
                    </h1>
                    <div class="form-row form-break">
                         <h3 class="col-12 formsubheading">Your Details</h3>
                         <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="blogName">First Name<span style="color:red"> *</span></label>
                                <input type="text" autoComplete="off" class="form-control" id="name" name="name" placeholder="">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogName">Surname</label>
                            <input type="text" autoComplete="off" class="form-control" name="surname" id="surname"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogName">Phone Number<span style="color:red"> *</span></label>
                            <input type="tel" autoComplete="off"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"
                                name="phone" id="phone" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogName">E-mail<span style="color:red"> *</span></label>
                            <input type="email" autoComplete="off" class="form-control" name="email" id="email"
                                placeholder="ex: myname@example.com">
                        </div>
                    </div>
                    <div class="form-row form-break">
                        <h3 class="col-12 formsubheading">Tell Us a Bit About Your Move</h3>
                        <div class="form-group col-md-6">
                            <label for="blogName">Preferred time<span style="color:red"> *</span></label>
                            <input type="text" class="form-control" placeholder="ex: 11:00 AM" name="user_time" id="user_time" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogName">Preferred date<span style="color:red"> *</span></label>
                            <input type="text" class="form-control" placeholder="ex: yy-mm-dd" name="user_date" id="user_date" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogName">What size of van do you need for?<span style="color:red"> *</span></label>
                            <select name="hiddenvehicle" id="hiddenvehicle" class="form-control">
                                <option value="" disabled selected>Select a vehicle</option>
                                <?php
                                    foreach ($vehicle_details as $vKey => $vVal) {
                                        # code...
                                        ?>
                                <option value="<?php echo $vVal['id']; ?>"><?php echo $vVal['vehicle_name']; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="blogName">Do you need help with loading and unloading?<span style="color:red"> *</span></div>
                            <input type="radio" id="help_loading_unloading" name="help_loading_unloading" value="No help requiered">
                            <label for="No help requiered">No help required</label>
                            <input type="radio" id="help_loading_unloading" name="help_loading_unloading" value="Driver helping">
                            <label for="Driver helping">Driver helping</label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogName">How many hours do you need for?<span style="color:red"> *</span></label>
                            <input type="tel" autoComplete="off"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"
                                name="need_hours" id="need_hours" placeholder="ex: 1/2..hours">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="blogName">What kind of service do you need?<span style="color:red"> *</span></label>
                            <select name="hiddenservice" id="hiddenservice" class="form-control">
                                <option value="" disabled selected>Select service</option>
                                <?php foreach ($service_data as $key => $value) {?>
                                <option
                                    value="<?php echo $value['service_title'];?>"><?php echo $value['service_title'];?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="blogName">Do you require packing services? <span style="color:red"> *</span></div>
                            <input type="radio" id="packing_services" name="packing_services" value="Yes">
                            <label for="Yes">Yes</label>
                            <input type="radio" id="packing_services" name="packing_services" value="No">
                            <label for="No">No</label>
                            <input type="radio" id="packing_services" name="packing_services" value="Maybe">
                            <label for="Maybe">Maybe</label>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="blogName">Do you require packing materials? <span style="color:red"> *</span></div>
                            <input type="radio" id="packing_materials" name="packing_materials" value="Yes">
                            <label for="Yes">Yes</label>
                            <input type="radio" id="packing_materials" name="packing_materials" value="No">
                            <label for="No">No</label>
                            <input type="radio" id="packing_materials" name="packing_materials" value="Maybe">
                            <label for="Maybe">Maybe</label>
                        </div>
                    </div>
                    <div class="form-row form-break">
                        <h3 class="col-12 formsubheading">Details of Collection Address</h3>
                        <div class="col-12 formsubtitle">Collection address</div>

                            <div class="form-group col-md-6">
                                <label for="blogName">Number<span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="pickup_address_number"
                                    id="pickup_address_number" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Street<span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="pickup_address_street"
                                    id="pickup_address_street" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">City<span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="pickup_address_city"
                                    id="pickup_address_city" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Postcode<span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="pickup_address_postcode"
                                    id="pickup_address_postcode" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Which floor?<span style="color:red"> *</span></label>
                                <select name="pickup_address_floor" id="pickup_address_floor" class="form-control">
                                    <option value="" disabled selected>Select Floor</option>
                                    <option value="Ground">Ground Floor</option>
                                    <option value="1st">1st Floor</option>
                                    <option value="2nd">2nd Floor</option>
                                    <option value="3rd">3rd Floor</option>
                                    <option value="4th">4th Floor</option>
                                    <option value="5th">5th Floor</option>
                                    <option value="6th">6th Floor</option>
                                    <option value="7th">7th Floor</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="blogName">Is there lift available? <span style="color:red"> *</span></div>
                                <input type="radio" id="pickup_address_lift_available" name="pickup_address_lift_available" value="Yes">
                                <label for="Yes">Yes</label>
                                <input type="radio" id="pickup_address_lift_available" name="pickup_address_lift_available" value="No">
                                <label for="No">No</label>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="blogName">Is there parking space? <span style="color:red"> *</span></div>
                                <input type="radio" id="pickup_address_parking_space" name="pickup_address_parking_space" value="Yes">
                                <label for="Yes">Yes</label>
                                <input type="radio" id="pickup_address_parking_space" name="pickup_address_parking_space" value="No">
                                <label for="No">No</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Number of movers<span style="color:red"> *</span></label>
                                <select name="pickup_address_movers" id="pickup_address_movers" class="form-control">
                                    <option value="" disabled selected>Select movers</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>

                        <div class="col-12 formsubtitle">Via address</div>

                            <div class="form-group col-md-6">
                                <label for="blogName">Number</label>
                                <input type="text" class="form-control" autoComplete="off" name="via_address_number"
                                    id="via_address_number" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Street</label>
                                <input type="text" class="form-control" autoComplete="off" name="via_address_street"
                                    id="via_address_street" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">City </label>
                                <input type="text" class="form-control" autoComplete="off" name="via_address_city"
                                    id="via_address_city" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Postcode </label>
                                <input type="text" class="form-control" autoComplete="off" name="via_address_postcode"
                                    id="via_address_postcode" placeholder="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="blogName">Which floor? </label>
                                <select name="via_address_floor" id="via_address_floor" class="form-control">
                                    <option value="" disabled selected>Select Floor</option>
                                    <option value="Ground">Ground Floor</option>
                                    <option value="1st">1st Floor</option>
                                    <option value="2nd">2nd Floor</option>
                                    <option value="3rd">3rd Floor</option>
                                    <option value="4th">4th Floor</option>
                                    <option value="5th">5th Floor</option>
                                    <option value="6th">6th Floor</option>
                                    <option value="7th">7th Floor</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="blogName">Is there lift available?</div>
                                <input type="radio" id="via_address_lift_available" name="via_address_lift_available" value="Yes">
                                <label for="Yes">Yes</label>
                                <input type="radio" id="via_address_lift_available" name="via_address_lift_available" value="No">
                                <label for="No">No</label>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="blogName">Is there parking space?</div>
                                <input type="radio" id="via_address_parking_space" name="via_address_parking_space" value="Yes">
                                <label for="Yes">Yes</label>
                                <input type="radio" id="via_address_parking_space" name="via_address_parking_space" value="No">
                                <label for="No">No</label>
                            </div>
                            <!-- <div class="form-group col-12">
                                <label for="blogName">Items to be collected and/or delivered at Via Address </label>
                                <textarea  type="text" autocomplete="off" rows="5" cols="33" class="form-control" name="via_address_message" id="via_address_message" placeholder="Things you wish to move"></textarea>
                            </div> -->

                    </div> 
                    <div class="form-row form-break">
                        <h3 class="col-12 formsubheading">Details of Delivery Address</h3>
                        <div class="col-12 formsubtitle">Delivery address</div>

                            <div class="form-group col-md-6">
                                <label for="blogName">Number<span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="dropoff_address_number"
                                    id="dropoff_address_number" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Street<span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="dropoff_address_street"
                                    id="dropoff_address_street" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">City <span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="dropoff_address_city"
                                    id="dropoff_address_city" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Postcode<span style="color:red"> *</span></label>
                                <input type="text" class="form-control" autoComplete="off" name="dropoff_address_postcode"
                                    id="dropoff_address_postcode" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Which floor?<span style="color:red"> *</span></label>
                                <select name="dropoff_address_floor" id="dropoff_address_floor" class="form-control">
                                    <option value="" disabled selected>Select Floor</option>
                                    <option value="Ground">Ground Floor</option>
                                    <option value="1st">1st Floor</option>
                                    <option value="2nd">2nd Floor</option>
                                    <option value="3rd">3rd Floor</option>
                                    <option value="4th">4th Floor</option>
                                    <option value="5th">5th Floor</option>
                                    <option value="6th">6th Floor</option>
                                    <option value="7th">7th Floor</option>
                                    <option value="other">other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="blogName">Is there lift available?<span style="color:red"> *</span></div>
                                <input type="radio" id="dropoff_address_lift_available" name="dropoff_address_lift_available" value="Yes">
                                <label for="Yes">Yes</label>
                                <input type="radio" id="dropoff_address_lift_available" name="dropoff_address_lift_available" value="No">
                                <label for="No">No</label>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="blogName">Is there parking space?<span style="color:red"> *</span></div>
                                <input type="radio" id="dropoff_address_parking_space" name="dropoff_address_parking_space" value="Yes">
                                <label for="Yes">Yes</label>
                                <input type="radio" id="dropoff_address_parking_space" name="dropoff_address_parking_space" value="No">
                                <label for="No">No</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="blogName">Number of movers<span style="color:red"> *</span></label>
                                <select name="dropoff_address_movers" id="dropoff_address_movers" class="form-control">
                                    <option value="" disabled selected>Select movers</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <!-- <div class="form-group col-12">
                                <label for="blogName">Please provide further details of your move if necessary, such as• Access issues• Parking restrictions• Any special instructions• Etc<span style="color:red"> *</span></label>
                                <textarea  type="text" autocomplete="off" rows="5" cols="33" class="form-control" name="dropoff_address_message" id="dropoff_address_message" placeholder="Things you wish to move"></textarea>
                            </div> -->

                    </div>
                    <div class="form-row form-break">
                    <h3 class="col-12 formsubheading">Selected Items</h3>
                        <!-- <label for="blogName">Item Selected</label> -->
                        <div class="calculate_product_data full_cart_data">
                            <?php
                                if(!empty($cartItemDetails)){
                                    foreach ($cartItemDetails as $ciKey => $ciVal) {
                                    # code...
                                    ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <figure><img src="<?php echo base_url(); ?>uploads/product_image/<?php echo $ciVal['image']; ?>" alt="<?php echo $ciVal['title']; ?>"></figure> <span><?php echo $ciVal['title']; ?></span>Qty:<?php echo $ciVal['qty']; ?>
                                <!-- <button type="button" data-closeid="<?php echo $ciKey; ?>" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span> -->
                                </button>
                            </div>
                                    <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="btn-center">
                    <button type="submit" id='submit' class="btn">Get a Quote</button>
                        <input type="hidden" id="csrftoken" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    </div>
                    <div class="alert-message" role="status"></div>
                </form>
            </div>
        </div>
    </div>
</section>