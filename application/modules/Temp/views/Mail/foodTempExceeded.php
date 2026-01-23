<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Food Temp Exceeds</title>
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
                    The following food temperature values recorded are outside the accepted range:
                </p>

                <!-- Table Format -->
                <table style="width: 60%; border: 1px solid #000; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Food Name</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $foodName; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Prep Area</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $prep_name; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Site Name</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $site_name; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Recorded Entry</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $recordedEntry; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Entered By</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $entered_by; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Staff Comments</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $staff_comments; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Acceptable Range</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $range; ?></td>
                    </tr>
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
