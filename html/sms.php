<?php

// Send SMS  Test SMS 1
//sendsms(7795002310,"test sms");

function sendsms($phone,$sms){
$xml_data ='<?xml version="1.0"?>
<parent>
<child>
<user>EDUCAB</user>
<key>83fcda3fb6XX</key>
<mobile>'.$phone.'</mobile>
<message>'.$sms.'</message>
<accusage>1</accusage>
<senderid>EDUCAB</senderid>
</child>
</parent>';

$URL = "http://sms.transaction.surewingroup.info/submitsms.jsp?"; 

			$ch = curl_init($URL);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);


}
 
                        
?>    