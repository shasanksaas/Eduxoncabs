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
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3); // Reduced to 3 seconds for faster response
curl_setopt($ch, CURLOPT_TIMEOUT, 3); // Reduced to 3 seconds for faster response
curl_setopt($ch, CURLOPT_FAILONERROR, true); // Fail on HTTP errors

try {
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($data === false) {
        // SMS failed, but don't stop the process
        error_log("SMS sending failed for phone: $phone - " . curl_error($ch));
    }
    
} catch (Exception $e) {
    // Log the error but don't stop the process
    error_log("SMS sending exception for phone: $phone - " . $e->getMessage());
}

curl_close($ch);

//echo $httpcode;

return true; // Always return true so payment process continues

}
 
                        
?>    