<?php
session_start();
$from = $_SESSION["user"] ?? "User_Anon";
$to = $_GET["partner"] ?? "User_XXXX";

$file = "chat.json";
$chats = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
foreach ($chats as $chat) {
    if (
        ($chat["from"] === $from && $chat["to"] === $to) ||
        ($chat["from"] === $to && $chat["to"] === $from)
    ) {
        echo "<div class='message'><strong>{$chat["from"]}:</strong> {$chat["message"]}</div>";
    }
}
?>
