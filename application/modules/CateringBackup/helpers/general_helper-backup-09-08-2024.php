<?php
use PHPMailer\PHPMailer\PHPMailer;

function get_order_status_name($statusId) {
  return isset(ORDER_STATUS_LABELS[$statusId]) ? ORDER_STATUS_LABELS[$statusId] : '';
}

 function MailSendData($mailData,$recipients,$mailSubject='ZealCafe Catering',$from='noreply@zoukieastonline.com.au',$attachment=''){
    try {	   
     $phpmailer = new PHPMailer(true); 
	$phpmailer->isSMTP();
    $phpmailer->Host       = 'node4537.myfcloud.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = 'noreply@zoukieastonline.com.au';
    // $phpmailer->Password   = 'JNu}o%,V4nXw';
    $phpmailer->Password   = 'JNu}o%,V4nXw';
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $phpmailer->Port       = 587;
    $phpmailer->setFrom('noreply@zoukieastonline.com.au', 'Zealcafe');
    if(is_array($recipients)){
     foreach ($recipients as $recipient) {
        $phpmailer->addAddress($recipient);
        }   
    }else{
        $phpmailer->addAddress($recipients);
    }
    
    if($attachment !=''){
     $phpmailer->addAttachment($attachment);
    }
    
    $phpmailer->isHTML(true);
    $phpmailer->Subject = $mailSubject;
    $phpmailer->Body    = $mailData;
    $phpmailer->send();
    return true;
	} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
}
    
	}


?>