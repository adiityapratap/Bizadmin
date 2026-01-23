<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Start Shift Variance Exceeds</title>
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
                    Hi ,<br><br>
                 
                   The variance is <?php echo $varience; ?> for the Start shift on the date <?php echo date('d-m-Y') ?> for the register <?php echo $tillName; ?> at location <?php echo $locationName; ?>
                  
                </p>

            

                <!-- Closing -->
                <p style="font-size: 16px; margin: 0;">Kind regards,<br>Bizadmin</p>

            </td>
        </tr>
    </table>

</body>
</html>
