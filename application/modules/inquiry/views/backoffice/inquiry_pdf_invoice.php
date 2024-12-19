<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LN Services</title>
    </head>
    <body style="background-color: #d4d4d7;">
        <table style="width: 800px; background: #fff; font-family: Arial, Helvetica, sans-serif; font-weight:600;padding: 40px 30px 0;margin: 0 auto;border: none;outline: none;">
            <tbody>
                <tr>
                    <td style="padding: 0; margin: 0;">
                        <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                            <tr>
                                <td><img src="<?php echo base_url(). "uploads/sitesettings_image/".site_settings_data('logo_image');?>" alt="Infynity" style="max-width: 100%;"></td>
                                
                                <td colspan="2" style="text-align: right; margin-top: 0; font-weight: 700; font-size: 40px;line-height: 44px; position: relative; color: #717171;"><strong>INVOICE</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td style="text-align: right; font-size: 13px;">Invoice No: #<?php echo $invoice_number; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td style="text-align: right; font-size: 13px;">Invoice Date: <?php echo date('jS F, Y', strtotime($invoice_send_on)); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td style="text-align: right;  font-size: 18px;font-weight: 600; color: #343434;"><strong>Order No: <?php $order_number; ?></strong>  </td>
                            </tr>
                        </table>
                    </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <table style="border-spacing: 0; margin: 0; padding: 0; border-collapse: collapse; outline: none; width: 100%;">
                                <tr>
                                    <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 28%;"><strong>Bill To</strong></td>
                                    <td style="width: 45%;"></td>
                                    <td style="background: #717171;color: #fff;padding: 3px 8px 4px; width: 22%;"><strong>Ship To</strong></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;"><?php echo $getInquiryDetails->name; ?><br>
                                    <strong>Pickup Address: </strong> <?php echo $getInquiryDetails->pickup_address_floor; ?> Floor, <?php echo $getInquiryDetails->pickup_address; ?>
                                    <br>
                                    <strong>Drop-off Address: </strong> <?php echo $getInquiryDetails->dropoff_address_floor; ?> Floor, <?php echo $getInquiryDetails->dropoff_address; ?>
                                    <br>
                                    <?php echo $getInquiryDetails->email; ?><br>
                                    <?php echo $getInquiryDetails->phone; ?><br>
                                    Vin</td>
                                    <td style="width: 16%;"></td>
                                    <td style="text-align: left; border: 1px solid #bdbdbd; padding: 12px 40px 12px 7px;font-size: 13px;line-height: 20px;font-weight: 600; color: #717171;"><?php echo $getInquiryDetails->name; ?><br>
                                    <strong>Pickup Address: </strong> <?php echo $getInquiryDetails->pickup_address_floor; ?> Floor, <?php echo $getInquiryDetails->pickup_address; ?>
                                    <br>
                                    <strong>Drop-off Address: </strong> <?php echo $getInquiryDetails->dropoff_address_floor; ?> Floor, <?php echo $getInquiryDetails->dropoff_address; ?>
                                    <br>
                                    <?php echo $getInquiryDetails->email; ?><br>
                                    <?php echo $getInquiryDetails->phone; ?><br>
                                    Vin</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0; margin: 0;">
                            <table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 30px 0px 0; border-spacing: 0; border-collapse: separate;">
                                <tr>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 15%; background: #717171;color: #fff; font-size: 14px; text-align: center;">No.</td>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 60%; background: #717171;color: #fff; font-size: 14px; text-align: center;">Item Description</td>
                                    <td style="padding: 16px 12px; font-weight: 700; width: 25%; background: #bdbdbd; color: #000; font-size: 14px; text-align: center;">Quantity</td>
                                </tr>
                                <?php
                                    foreach ( $getInquiryProductDetails as $giKey => $giValue ) {
                                        ?>
                                <tr>
									<td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> <?php echo sprintf("%02d", ($giKey+1)); ?></strong></td>
									<td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;">
                                        <div class="service_details_card" role="alert">
                                            <figure>
                                                <img src="<?php echo base_url() ; ?>/uploads/product_image/<?php echo $giValue['product_image'] ; ?>">
                                            </figure>
                                            <span><?php echo $giValue['product_title'] ;?></span>
                                        </div>
                                    </td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;"><?php echo $giValue['product_qty'] ;?></td>
								</tr>
                                        <?php
                                    }
                                ?>
                                <tr>
									<td style="border-bottom: 1px solid #bdbdbd;color: #000;font-weight: 600; padding: 24px 18px 6px; font-size: 13px; background: #fff;"><strong> <?php echo sprintf("%02d", (count($getInquiryProductDetails))); ?></strong></td>
									<td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; text-align: left; padding: 24px 18px 6px; font-size: 13px;">Vehicle Choosen: <strong><?php echo $vehicleDetails->vehicle_name; ?></strong><figure><img src="<?php echo base_url() ; ?>/uploads/vehicles_image/<?php echo $vehicleDetails->vehicle_image; ?>"></figure></td>
                                    <td style="border-left: 1px solid #bdbdbd; color: #343434;border-bottom: 1px solid #bdbdbd; padding: 24px 18px 6px; font-size: 13px; background: #fff; text-align:center;">01</td>
								</tr>
                                <tr>
                                    <td style="background: #fff; padding: 0; margin: 0;"></td>
                                    <td style="background: #fff; padding: 0; margin: 0;"></td>
                                    <td style="background: #fff; padding: 0; margin: 0;"></td>
                                    <td style="font-size: 13px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #000;color: #fff;text-align: center;border-right: 3px solid #fff;">Total:</td>
                                    <td style="font-size: 14px;border-bottom: 1px solid #bdbdbd; padding: 10px 18px 10px;background: #717171;color: #fff;text-align: center;border-left: 3px solid #fff;"><strong><?php echo $quotedPrice; ?></strong></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
				<tr>
					<td style="padding: 0; margin: 0; background: #fff;">
						<table style="margin: 0; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0px 0px 20px; border-spacing: 0; border-collapse: separate; width: 100%; ">
							<tr>
								<td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="<?php echo base_url(); ?>/assets/admin/img/mail.png" alt="806-655-5500"><?php echo $row['helpline_email_address'];?></td>
								<td style=" width: 22%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="<?php echo base_url(); ?>/assets/admin/img/web.png" alt="806-655-5500">www.lnservices.Com</td>
								<td style=" width: 18%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="<?php echo base_url(); ?>/assets/admin/img/call.png" alt="806-655-5500"><?php echo $row['helpline_no']; ?></td>
								<td style=" width: 36%; padding: 0; margin: 0; background: #fff;"><img style="max-width: 100%;object-fit: contain; padding-right: 8px; line-height: 26px;vertical-align: top;" src="<?php echo base_url(); ?>/assets/admin/img/location.png" alt="address"><?php echo $row['address']; ?></td>
							</tr>
							<tr>
								<td colspan="4" style="text-align: center;padding-top: 30px;"><strong>THANK YOU FOR YOUR BUSINESS</strong> </td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
        <table style="margin: 0 auto; padding: 0; border-collapse: collapse; outline: none; background: #fff; padding: 0; border-spacing: 0; border-collapse: separate; width: 800x;">
            <tr>
                <td style="padding: 0; margin: 0;">
                    <img src="<?php echo base_url(); ?>/assets/admin/img/bottomStrip.png" alt="" style="max-width: 100%; padding-bottom: 10px">
                </td>
            </tr>
        </table>
		</body>
	</html>