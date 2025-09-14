<?php
//$sms = rawurlencode("Booking confirm, Booking ID-54856, Your Inova Booking from 21-10-18 6.00 am to 28-08-18 11.00 Total Price Rs.7500");
  //$phone_number = "7795002310";
  //sendsms($phone_number,$sms);

function sendsms($phone,$sms){
$sms = rawurlencode($sms);
//"Your Tata Maanza Booking from 21-10-18 6.00 am to 28-08-18 11.00 Total Price Rs.7500";

$URL = "http://198.15.103.106/API/pushsms.aspx?loginID=eduxcab&password=Edu@cab123&mobile=$phone&text=$sms&senderid=EDUCAB&route_id=1&Unicode=0"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$data = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

//echo $httpcode;


}
 
                        
?>    