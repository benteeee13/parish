<?php
include 'userSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: userLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Parish of San Juan - Messaging</title>
    <link rel="stylesheet" href="userMass.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #messageContainer {
            display: flex;
            flex-direction: column;
            height: 80vh;
            margin: 20px auto;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 5rem;
        }

        #messageHeader {
            flex-shrink: 0;
            text-align: center;
            padding: 10px 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ccc;
        }

        #messageHeader h1 {
            font-size: 20px;
            margin: 0;
            color: #333;
        }

        #messageHeader p {
            font-size: 14px;
            margin: 0;
            color: #777;
        }

        #suggestions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 10px;
            background-color: #f1f1f1;
            border-bottom: 1px solid #ccc;
        }

        .suggestion-btn {
            margin: 5px;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            background-color: #dcdcdc;
            color: #333;
            cursor: pointer;
            font-size: 14px;
        }

        .suggestion-btn:hover {
            background-color: #800000;
            color: #fff;
        }

        #messageBox {
            flex: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .message {
            margin: 10px 0;
            max-width: 60%;
            padding: 10px;
            border-radius: 10px;
            clear: both;
        }

        .user-message {
            background-color: #000000d6;
            color: #ffffff;
            text-align: right;
            margin-left: auto;
        }

        .admin-message {
            background-color: #747875;
            text-align: left;
            margin-right: auto;
            color: #ffffff;
        }

        #messageForm {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ccc;
            background-color: #fff;
        }

        #messageForm textarea {
            flex: 1;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }

        #btnSend {
            background-color: #800000;
            opacity: 90%;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }

        #btnSend:hover {
            background-color: #800000;
            opacity: 100%;
        }
    </style>
</head>

<body>
    <?php include 'userHeader.php'; ?>
    <div id="messageContainer">
        <!-- Header Section -->
        <div id="messageHeader">
            <h1>Messaging Center</h1>
            <p>Feel free to ask your queries, and our admin will assist you!</p>
        </div>

        <!-- Suggestions Section -->
        <div id="suggestions">
            <button class="suggestion-btn" onclick="insertSuggestion('How can I book a mass?')">How can I book a mass?</button>
            <button class="suggestion-btn" onclick="insertSuggestion('What are the available schedules for masses?')">What are the available schedules for masses?</button>
            <button class="suggestion-btn" onclick="insertSuggestion('How do I update my contact information?')">How do I update my contact information?</button>
            <button class="suggestion-btn" onclick="insertSuggestion('What is the process for canceling a reservation?')">What is the process for canceling a reservation?</button>
            <button class="suggestion-btn" onclick="insertSuggestion('Who can I contact for event inquiries?')">Who can I contact for event inquiries?</button>
        </div>

        <!-- Message Display Area -->
        <div id="messageBox"></div>

        <!-- Form for Sending Messages -->
        <form id="messageForm" method="POST" action="">
            <textarea id="reply" class="commentsText" name="message" placeholder="Type your message here..." required></textarea>
            <button id="btnSend" type="submit">Send</button>
        </form>
    </div>

    <script>
        // Function to insert suggestion text into the message input box
        function insertSuggestion(suggestion) {
            const messageInput = document.getElementById('reply');
            messageInput.value = suggestion;
            messageInput.focus(); // Focus on the input for convenience
        }

        // Fetch messages every 2 seconds
        function fetchMessages() {
            fetch('fetchMessages.php')
                .then(response => response.json())
                .then(data => {
                    const messageBox = document.getElementById('messageBox');
                    messageBox.innerHTML = ''; // Clear current messages

                    data.forEach(message => {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = 'message ' + (message.sender === 'user' ? 'user-message' : 'admin-message');
                        messageDiv.textContent = message.body;
                        messageBox.appendChild(messageDiv);
                    });

                    // Auto-scroll to the latest message
                    messageBox.scrollTop = messageBox.scrollHeight;
                });
        }

        // Handle sending messages
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('sendMessage.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('reply').value = ''; // Clear message input
                    fetchMessages(); // Refresh messages
                });
        });

        // Call fetchMessages initially and every 2 seconds
        fetchMessages();
        setInterval(fetchMessages, 2000);
    </script>
</body>

</html>
