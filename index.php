<?php

$BOT_TOKEN = "8653912920:AAGk2yd8fAThTL67CouDtj8gmlDTsQEOdyc";

if(!isset($_GET['file_id'])){
    echo "No file";
    exit;
}

$file_id = $_GET['file_id'];

// CURL request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$BOT_TOKEN/getFile?file_id=$file_id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$res = json_decode($response, true);

if(!$res || !isset($res['result']['file_path'])){
    echo "Error";
    exit;
}

$file_path = $res['result']['file_path'];

$link = "https://api.telegram.org/file/bot$BOT_TOKEN/$file_path";

header("Location: $link");
exit;
