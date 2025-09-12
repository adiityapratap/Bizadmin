<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Leave Request</title>
    <style>
    .action-button {
    cursor: pointer;
    display: block;
    width: 250px;
    height: 45px;
    background: #4caf50;
    padding: 4px;
    text-align: center;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
    line-height: 25px;
    border: 0;
    font-size: 18px;
    margin-left:20px;
}

    </style>    
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <p>Dear Manager ,</p>
    <p>A new leave request has been submitted.</p>
    Below are the details for leave : <br>
    
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; background-color: #ffffff; margin: 20px auto; padding: 20px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);">
        <tr>
            <td>

                <!-- Table Format -->
                <table style="width: 60%; border: 1px solid #000; border-collapse: collapse;">
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Employee Name/Email</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $nameEmail; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Start Date</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $start_date; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">End Date</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $end_date; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Leave Type</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $leave_type; ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #000; padding: 5px;">Comments</td>
                        <td style="border: 1px solid #000; padding: 5px;"><?php echo $leaveComments; ?></td>
                    </tr>
                  
                </table>
                <!-- End of Table Format -->
               <br></br>
                <!-- Closing -->
                <p style="font-size: 16px; margin: 0;">Kind regards,<br>Bizadmin</p>

            </td>
        </tr>
    </table>

    
      <p><span>Please click on the button below to approve/reject the leave: </span>
      </p>
     <div style="display: flex; gap: 20px;">
    <a href="<?php echo $approveLeaveUrl; ?>" style="text-decoration: none;">
        <button class="action-button">Approve</button>
    </a>
    <a href="<?php echo $rejectLeaveUrl; ?>" style="text-decoration: none;">
        <button class="action-button">Reject</button>
    </a>
</div>

       
        <p>Please contact your manager if you have any queries.</p>
        <span>Kind Regards,</span><br></br>
         <span>HR Team</span>
         </body> 
         </html>