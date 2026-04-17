<?php

$BOT_TOKEN = getenv("8653912920:AAG3AX1_hFUKfk37bB1M5ojcohd4kTIUrV8");

// Telegram data
$input = file_get_contents("php://input");
$update = json_decode($input, true);

// debug (optional)
file_put_contents("log.txt", $input);

if(isset($update['message'])){

    $msg = $update['message'];
    $chat_id = $msg['chat']['id'];

    $file_id = "";
    $name = "file";

    // 📁 DOCUMENT (upload + forward both)
    if(isset($msg['document'])){
        $file_id = $msg['document']['file_id'];
        $name = $msg['document']['file_name'] ?? "file.apk";
    }

    // अगर file नहीं मिला
    if($file_id == ""){
        $text = "❌ Please send APK file (upload or forward)";
    } else {
        $text = "✅ ".$name."\n\n📌 File ID:\n".$file_id;
    }

    // 🔥 CURL request (important)
    $url = "https://api.telegram.org/bot".$BOT_TOKEN."/sendMessage";

    $data = [
        "chat_id" => $chat_id,
        "text" => $text
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_exec($ch);
    curl_close($ch);
}
