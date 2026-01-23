<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Bank Order</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0;">

    <!-- Email Container -->
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; background-color: #ffffff; margin: 20px auto; padding: 20px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);">
        <tr>
            <td>

                <!-- Header -->
                <!--<p style="font-size: 24px; font-weight: bold; margin: 0 0 20px;">Bank Order</p>-->

                <!-- Email Content -->
                <p style="font-size: 16px; line-height: 1.5; margin: 0 0 20px;">
                    Hi Team,<br><br>
                    Please see below link requesting change to be collected in 1 hour.
                </p>

                <!-- Call to Action -->
         <p><a href="<?php echo $orderUrl; ?>" style="display: inline-block; padding: 10px 20px; background-color: #172150; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">View Order</a>        
               

                <!-- Contact Information -->
                <p style="font-size: 16px; line-height: 1.5; margin: 0 0 20px;">
                    For queries, please call Melissa on <a href="tel:0400100942" style="color: #007bff; text-decoration: none;">0400 100 942</a> or Alex <a href="tel:0474505671" style="color: #007bff; text-decoration: none;">0474 505 671 </a> or email <a href="mailto:bh@cjsgroup.net.au" style="color: #007bff; text-decoration: none;">bh@cjsgroup.net.au</a>
                </p>

                <!-- Closing -->
                <p style="font-size: 16px; margin: 0;">Kind regards,<br>CJs Café Group</p>

            </td>
        </tr>
    </table>

</body>
</html>
