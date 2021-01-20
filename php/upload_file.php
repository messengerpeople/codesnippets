<?php
$token = "yourbearertokenhere";
$url = "https://api.messengerpeople.dev/media";

$path_to_file = "tmp/test.pdf";
$mime_type = mime_content_type($path_to_file);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($path_to_file));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$token, 'Content-Type: '.$mime_type]);

$result = curl_exec($ch);

curl_close($ch);

$apiResult = json_decode($result, true);
$fileUuid = $apiResult['id'];
echo "The UUID of the uploaded file is: ".$fileUuid;
echo $result;
