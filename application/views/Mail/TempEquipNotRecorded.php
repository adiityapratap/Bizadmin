<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Temperature</title>
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
                    The following equipment values are not recorded at time for location  :<?php echo $locationName; ?>
                </p>

                <!-- Table Format -->
               
                <table style="width: 60%; border: 1px solid #000; border-collapse: collapse;">
                     <thead style="background-color: #172154; color: #fff;">
                        <td style="border: 1px solid #000; padding: 5px;">Equipment Name</td>
                        <td style="border: 1px solid #000; padding: 5px;">Prep Area</td>
                         <td style="border: 1px solid #000; padding: 5px;">Deadline Time</td>
                    </thead>
                    <tbody>
                     <?php foreach($equipLists as $equipList) {  ?>
                <?php // $locationName = fetchLocationNamesFromIds($equipList->location_id,true); ?>
                    <!-- <tr>-->
                    <!--    <td style="border: 1px solid #000; padding: 5px;">Location </td>-->
                    <!--    <td style="border: 1px solid #000; padding: 5px;"><?php // echo $locationName; ?></td>-->
                    <!--</tr>-->
                    <tr>
                      
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $equipList->equip_name; ?></td>

                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $equipList->prep_name; ?></td>
                   
                    <!--<tr>-->
                    <!--    <td style="border: 1px solid #000; padding: 5px;">Site Name</td>-->
                    <!--    <td style="border: 1px solid #000; padding: 5px;"><?php // echo $site_name; ?></td>-->
                    <!--</tr>-->
                    
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $equipList->equip_time; ?></td>
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
