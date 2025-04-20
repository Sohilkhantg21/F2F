<?php
session_start();

// Default user and random partner
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = "User_" . rand(1000, 9999);
}
$user = $_SESSION['user'];
$partner = isset($_GET['partner']) ? $_GET['partner'] : 'User_XXXX';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub4Sub Chat System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #222;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #ff4444;
        }
        .btn {
            background-color: #c4302b;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #ff5e57;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to Sub4Sub Chat</h1>
        <p>Your ID: <?= htmlspecialchars($user) ?></p>
        <a href="chat.php?partner=User_1234" class="btn">Start Chat with Random User</a>
    </div>

</body>
</html>
