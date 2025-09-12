<!DOCTYPE html>
<html>
<head>
	<title>Redirecting...</title>
</head>
<body onload="document.getElementById('securepay_form').submit()">
	<?php

		$total = ($orderTotal)*100;;
// 	    $mid=	'2Q40231';
// 		$mpass=	'2qiGjKFXzHrGGrSPIoYQtt6VVkAOROlTc';   
		
	   $mid   =	'ABC0001';
	   $mpass =	'abc123';  
	   
	   $callbackUrl = base_url().'paymentProcess';
	   $cancelUrl = base_url().'pastOrder';

		$timestamp = gmdate("YmdHis");
        $fingerprint  = $mid.'|'.$mpass.'|0|'.$orderId.'|'.$total.'|'.$timestamp;
        $fingerprint  = sha1($fingerprint);
		echo '<form id="securepay_form" action="https://test.payment.securepay.com.au/secureframe/invoice" method="post">';
// 		echo '<form id="securepay_form" action="https://payment.securepay.com.au/secureframe/invoice" method="post">';
		echo '<input type="hidden" name="bill_name" value="transact">';
		echo '<input type="hidden" name="merchant_id" value="' . $mid . '">';
		echo '<input type="hidden" name="primary_ref" value="' . $orderId . '">';
		echo '<input type="hidden" name="fp_timestamp" value="' . $timestamp . '">';
		echo '<input type="hidden" name="fingerprint" value="' . $fingerprint . '">';
		echo '<input type="hidden" name="amount" value="' . $total . '">';
		echo '<input type="hidden" name="txn_type" value="0">';
		echo '<input type="hidden" name="currency" value="AUD">';
		echo '<input type="hidden" name="return_url" value="'.$callbackUrl.'">';
		echo '<input type="hidden" name="return_url_target" value="parent">';
		echo '<input type="hidden" name="cancel_url" value="'.$cancelUrl.'">';
		echo '<input type="hidden" name="callback_url" value="'.$callbackUrl.'">';
		echo '<input type="hidden" name="template" value="default">';
		echo '<input type="hidden" name="card_types" value="VISA|MASTERCARD|AMEX">';
		echo '<input type="hidden" name="display_receipt" value="no">';
		echo '<input type="hidden" name="display_cardholder_name" value="no">';
		echo '</form>';
	?>
</body>
</html>
