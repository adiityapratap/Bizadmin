<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bizadmin</title>
</head>
<body>
    
            <p>Hello <?php echo $empName; ?> ,</p>
            <p> Welcome to your new Bizadmin HR Portal</p>
            In this portal you will be able to check your rosters and timesheets,<br>
            communicate with the management, update your employee and leave details as<br>
            well as submit any compliance forms required by Bizadmin.
            <p>  <span>The login information for your employee portal is as follows:</span></p>
             Link <a href="<?php echo $portalUrl; ?>"><?php echo $portalUrl; ?></a>
                 <p><span><b>Login Details  </b></span></p>
                  <p><span>Username : <?php echo $empEmail; ?></span></p>
                   <p><span>Password: <a href="<?php echo $portalUrl; ?>"> Reset your password here</a> </span></p>
                   <p>Please contact your manager if you have any queries.</p>
                <p><span>Kind Regards,</span><p>
                 <p><span>Bizadmin Team</span><p>
                 </body> 
                 </html>