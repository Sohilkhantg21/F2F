<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);
$message = trim($data["message"] ?? "");
$from = $_SESSION["user"] ?? "User_Anon";
$to = $data["to"] ?? "User_XXXX";

if ($message !== "") {
    $file = "chat.json";
    $chats = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $chats[] = [
        "from" => $from,
        "to" => $to,
        "message" => htmlspecialchars($message),
        "time" => date("Y-m-d H:i:s")
    ];
    file_put_contents($file, json_encode($chats, JSON_PRETTY_PRINT));
}
?>
