<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Send Invoice</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0;">

    <!-- Email Container -->
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; background-color: #ffffff; margin: 20px auto; padding: 20px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);">
      <tr>
    <td>
        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 20px;">
            Hi <?php echo $supplierName; ?>,<br><br>
            I hope you're doing well. We recently placed an order from <?php echo $orzName; ?> (<?php echo $locationName; ?>), and to proceed with the payment, 
            We kindly request you to attach the invoice by clicking on the Attach Invoice Button below.<br><br>
            Once you've attached the invoice, we will begin processing the payment promptly.
        </p>

        <p style="font-size: 16px; line-height: 1.5; margin: 0 0 20px;">
            <strong>Café Name/Location:</strong> <?php echo $orzName; ?> / <?php echo $locationName; ?><br>
            <strong>Café Email:</strong> <?php echo $cafeEmail; ?><br>
            <strong>Café Contact Number:</strong> <?php echo $cafeContactNumber; ?>
        </p>

        <p>
            <a href="<?php echo $orderUrl; ?>" style="display: inline-block; padding: 10px 20px; background-color: #172150; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Attach Invoice
            </a>
        </p>

        <p style="font-size: 16px; margin: 0;">Kind regards,<br><?php echo $orzName; ?></p>
    </td>
</tr>

    </table>

</body>
</html>
