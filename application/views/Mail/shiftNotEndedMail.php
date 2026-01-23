<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cash Shift Not Completed</title>
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
                    Hi,<br><br>
                   The End shift hasn’t completed for <?php echo date('d-m-Y'); ?> for the below tills at location  :<?php echo $locationName; ?>
                </p>

                <!-- Table Format -->
               
                <table style="width: 60%; border: 1px solid #000; border-collapse: collapse;">
                     <thead style="background-color: #172154; color: #fff;">
                        <td style="border: 1px solid #000; padding: 5px;">Till Name</td>
                      
                    </thead>
                    <tbody>
                     <?php foreach($tills as $till) {  ?>
                    <tr>
                <td style="border: 1px solid #000; padding: 5px;"><?php echo $till['till_name']; ?></td>
                    </tr>
                    <?php }  ?>
                    </tbody>
                </table>
                <!-- End of Table Format -->
               <br></br>
                <!-- Closing -->
                <p style="font-size: 16px; margin: 0;">Kind regards,<br>Bizadmin</p>

            </td>
        </tr>
    </table>

</body>
</html>
