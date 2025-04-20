<?php
$chat_file = "chat.json";
$chats = file_exists($chat_file) ? json_decode(file_get_contents($chat_file), true) : [];

$users = [];
foreach ($chats as $chat) {
    $users[$chat["from"]] = true;
    $users[$chat["to"]] = true;
}
$users = array_keys($users);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Sub4Sub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #111;
            color: #fff;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #c4302b;
        }
        .section {
            background: #222;
            padding: 15px;
            margin: 20px auto;
            border-radius: 10px;
            max-width: 600px;
        }
        h2 {
            color: #ff4444;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 5px;
            border-bottom: 1px solid #333;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px;
            background: #1a1a1a;
            border-radius: 5px;
        }
        .message strong {
            color: #c4302b;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>

    <div class="section">
        <h2>Registered Users</h2>
        <ul>
            <?php foreach ($users as $u): ?>
                <li><?= htmlspecialchars($u) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="section">
        <h2>Recent Messages</h2>
        <?php foreach (array_reverse($chats) as $chat): ?>
            <div class="message">
                <strong><?= htmlspecialchars($chat['from']) ?></strong> to <strong><?= htmlspecialchars($chat['to']) ?></strong>:<br>
                <?= htmlspecialchars($chat['message']) ?><br>
                <small><?= htmlspecialchars($chat['time']) ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
