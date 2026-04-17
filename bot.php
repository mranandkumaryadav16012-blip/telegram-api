<?php

$BOT_TOKEN = getenv("8653912920:AAG3AX1_hFUKfk37bB1M5ojcohd4kTIUrV8");

$update = json_decode(file_get_contents("php://input"), true);

if(isset($update['message']['document'])){

    $file_id = $update['message']['document']['file_id'];
    $name = $update['message']['document']['file_name'];
    $chat_id = $update['message']['chat']['id'];

    $msg = "✅ ".$name."\n\n📌 File ID:\n".$file_id;

    file_get_contents("https://api.telegram.org/bot$BOT_TOKEN/sendMessage?chat_id=".$chat_id."&text=".urlencode($msg));
}
