<?php

$BOT_TOKEN = "8653912920:AAGk2yd8fAThTL67CouDtj8gmlDTsQEOdyc";

$file_id = $_GET['file_id'] ?? '';

if(!$file_id){
    die("No file");
}

// Telegram API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/getFile?file_id=$file_id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$res = json_decode($response, true);

$file_path = $res['result']['file_path'];

$link = "https://api.telegram.org/file/bot$BOT_TOKEN/$file_path";

header("Location: $link");
exit;
