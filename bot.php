<?php

$BOT_TOKEN = getenv("8653912920:AAG3AX1_hFUKfk37bB1M5ojcohd4kTIUrV8");

// Telegram data
$input = file_get_contents("php://input");
$update = json_decode($input, true);

// debug (optional)
file_put_contents("log.txt", $input);

// check message
if(isset($update['message'])){

    $msg = $update['message'];
    $chat_id = $msg['chat']['id'];

    $file_id = "";
    $name = "file";

    // 📁 DOCUMENT (APK upload / forward)
    if(isset($msg['document'])){
        $file_id = $msg['document']['file_id'];
        $name = $msg['document']['file_name'] ?? "file.apk";
    }

    // 🖼 PHOTO (optional support)
    elseif(isset($msg['photo'])){
        $file_id = end($msg['photo'])['file_id'];
        $name = "photo.jpg";
    }

    // 🎥 VIDEO (optional support)
    elseif(isset($msg['video'])){
        $file_id = $msg['video']['file_id'];
        $name = "video.mp4";
    }

    // 🎵 AUDIO (optional support)
    elseif(isset($msg['audio'])){
        $file_id = $msg['audio']['file_id'];
        $name = "audio.mp3";
    }

    // अगर कुछ भी नहीं मिला
    if($file_id == ""){
        file_get_contents("https://api.telegram.org/bot".$BOT_TOKEN."/sendMessage?chat_id=".$chat_id."&text=❌ Please send a file (APK)");
        exit;
    }

    // reply message
    $text = "✅ File: ".$name."\n\n📌 File ID:\n".$file_id;

    // send reply
    file_get_contents("https://api.telegram.org/bot".$BOT_TOKEN."/sendMessage?chat_id=".$chat_id."&text=".urlencode($text));
}
