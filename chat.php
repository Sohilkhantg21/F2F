<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = "User_" . rand(1000, 9999);
}
$user = $_SESSION['user'];
$partner = isset($_GET['partner']) ? $_GET['partner'] : 'User_XXXX';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat with <?= htmlspecialchars($partner) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #000;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .chat-box {
            width: 90%;
            max-width: 500px;
            background: #111;
            border: 1px solid #333;
            border-radius: 8px;
            margin-top: 50px;
            padding: 15px;
        }
        .messages {
            height: 300px;
            overflow-y: scroll;
            background: #222;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .message {
            margin: 5px 0;
        }
        .message strong {
            color: #c4302b;
        }
        form {
            display: flex;
        }
        input[type="text"] {
            flex: 1;
            padding: 8px;
            font-size: 16px;
            border-radius: 5px 0 0 5px;
            border: none;
        }
        button {
            padding: 8px 15px;
            background: #c4302b;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-box">
        <h3>Chat with <?= htmlspecialchars($partner) ?></h3>
        <div class="messages" id="messages"></div>
        <form id="chat-form">
            <input type="text" id="message" placeholder="Type your message..." required autocomplete="off">
            <button type="submit">Send</button>
        </form>
    </div>

    <script>
        const user = "<?= $user ?>";
        const partner = "<?= $partner ?>";
        const messagesBox = document.getElementById("messages");

        function loadMessages() {
            fetch("get_messages.php?partner=" + partner)
                .then(res => res.text())
                .then(data => {
                    messagesBox.innerHTML = data;
                    messagesBox.scrollTop = messagesBox.scrollHeight;
                });
        }

        loadMessages();
        setInterval(loadMessages, 3000);

        document.getElementById("chat-form").addEventListener("submit", function(e) {
            e.preventDefault();
            const msg = document.getElementById("message").value;
            fetch("send_message.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ message: msg, to: partner })
            }).then(() => {
                document.getElementById("message").value = "";
                loadMessages();
            });
        });
    </script>
</body>
</html>
