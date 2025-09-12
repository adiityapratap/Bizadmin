<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Onboarding Form</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <p>Hello <?php echo $employeeName; ?> ,</p>
    <p> Welcome to your new HR Portal for Bizadmin.</p>
    In this portal you will be able to check your rosters and timesheets,<br>
    communicate with the management, update your employee and leave details as<br>
    well as submit any compliance forms required by Cafe admin.
   <br><br>
      <span>To set up your account please complete your onboarding by clicking below button: </span><br><br>
      </br>
      <a href="<?php echo $onboardingUrl; ?>" style="text-decoration:none;cursor:pointer;">
  <button style="cursor:pointer;display: block;width: 250px;height: 45px;background: #4caf50;padding: 4px;text-align: center;border-radius: 5px;color: #fff;font-weight: bold;line-height: 25px;border: 0;font-size: 18px;">Complete Onboarding</button>
    </a><br></br>
       
        <p>Please contact your manager if you have any queries.</p>
        <span>Kind Regards,</span><br></br>
         <span>HR Team</span>
         </body> 
         </html>