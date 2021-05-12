<?php

// This examples sends a simple WhatsApp Message to a recipient.
// Make sure the recipient is inside the 24h window. 
// If not, just send a message TO your channel to open the 24h window again.


// Put your bearer token hier. You can create it via API call: https://api.messengerpeople.dev/docs/authentication
// or open app.messengerpeople.dev and navigate to Settings - OAuth Apps, select the proper App (or create one) and click on "Create Token"
$token = ""; 

$channel_uuid = ""; // Put the UUID of your channel here
$recipient = "491721234567"; // Your phone number, without + or any special chars.
$message = "Hello World"; // Put your example message here.

$curl = curl_init();

$payload = [
  "sender" => $channel_uuid,
  "recipient" => $recipient,
  "payload" => [
    "type" => "text",
    "text" => $message
    ]
  ];

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.messengerpeople.dev/messages',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$token,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
