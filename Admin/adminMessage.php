<?php
include 'adminSessionStart.php';
include '../config/connection.php';

if (!isset($_SESSION['adminUsername'])) {
    header("Location: adminLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parish of San Juan - Messages</title>
    <link rel="stylesheet" href="adminHomepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        #userListContainer {
            height: 100%;
            overflow-y: auto;
            border-right: 1px solid #000000;
            background-color: #fff;
            border-radius: .8rem;
        }

        #userListHeader {
            text-align: center;
            font-weight: bold;
            padding: 10px;
            border-bottom: 1px solid #000;
            background-color: #f8f9fa;
        }

        #userList {
            overflow-y: auto;
            height: calc(100% - 40px);
            /* Adjust height to exclude header */
        }

        .user-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #000;
            cursor: pointer;
        }

        .user-item:hover {
            background-color: #f1f1f1;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .user-item h6 {
            margin: 0;
            font-size: 16px;
        }

        .user-item p {
            margin: 5px 0;
            font-size: 14px;
            color: #888;
        }

        .last-message-time {
            font-size: 12px;
            color: #aaa;
            text-align: right;
        }

        .unread-badge {
            background-color: red;
            color: white;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 50%;
        }

        #messageBox {
            height: 30rem;
            border: 1px solid #ccc;
            border-radius: .8rem;
            display: flex;
            flex-direction: column;
            background-color: #f9f9f9;
        }

        #currentUserHeader {
            flex-shrink: 0;
            /* Prevent shrinking when resizing */
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ccc;
        }

        #messagesContainer {
            flex: 1;
            /* Allow the container to fill available space */
            overflow-y: auto;
            /* Enable scrolling for messages */
            padding: 10px;
            /* Add padding for better readability */
        }


        .message {
            margin: 10px 0;
            max-width: 60%;
            padding: 10px;
            border-radius: 10px;
            clear: both;
        }

        .user-message {
            background-color: #747875;
            color: #ffffff;
            text-align: left;
            margin-right: auto;
        }

        .admin-message {
            background-color: #000000d6;
            text-align: right;
            margin-left: auto;
            color: #ffffff;
        }

        #replyForm {
            display: flex;
            align-items: center;
            padding: 10px;
            border-top: 1px solid #ccc;
            background-color: #fff;
        }

        #replyMessage {
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
            padding: 22px 15px;
            cursor: pointer;
            margin-right: 12px;
            margin-left: 12px;
        }

        #btnSend:hover {
            background-color: #800000;
            opacity: 100%;
        }
    </style>
</head>

<body>
    <?php include 'adminHeader.php'; ?>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-2'>
                <?php include 'adminSidebar.php'; ?>
            </div>
            <div class='col-3'>
                <!-- User List -->
                <div id="userListContainer">
                    <div id="userListHeader">Messages</div>
                    <div id="userList">
                        <!-- User list populated here dynamically -->
                    </div>
                </div>
            </div>
            <div class='col-7'>

                <div id="mainPage">
                    <!-- Conversation Area -->
                    <div id="messageBox">
                        <!-- Fixed Header -->
                        <div id="currentUserHeader" style="text-align: center; font-size: 18px; font-weight: bold; padding: 10px; background-color: #f8f9fa; border-bottom: 1px solid #ccc;">
                            Select a user to start a conversation
                        </div>
                        <!-- Scrolling Messages -->
                        <div id="messagesContainer" style="flex: 1; overflow-y: auto; padding: 10px;">
                            <!-- Messages will be dynamically appended here -->
                        </div>
                    </div>

                    <form id="replyForm">
                        <textarea id="replyMessage" name="replyMessage" placeholder="Type your message here..." required></textarea>
                        <button id="btnSend" type="submit">Send</button>
                    </form>
                </div>



            </div>
        </div>
    </div>

    <script>
        let currentUser = null; // Track the selected user
        let lastFetchedMessageTime = {}; // Store the last fetched timestamp for each user

        // Fetch and update the user list dynamically
        function fetchUserList() {
            fetch('fetchUserList.php')
                .then(response => response.json())
                .then(users => {
                    const userList = document.getElementById('userList');
                    userList.innerHTML = ''; // Clear the user list

                    users.forEach(user => {
                        const userDiv = document.createElement('div');
                        userDiv.className = 'user-item';
                        userDiv.onclick = () => loadConversation(user.username);

                        const userInfoDiv = document.createElement('div');
                        userInfoDiv.className = 'user-info';

                        const name = document.createElement('h6');
                        name.textContent = user.username;

                        const recentMessage = document.createElement('p');
                        recentMessage.textContent = user.recent_message;

                        const timeDiv = document.createElement('div');
                        timeDiv.className = 'last-message-time';
                        timeDiv.textContent = user.last_message_time;

                        userInfoDiv.appendChild(name);
                        userInfoDiv.appendChild(recentMessage);

                        userDiv.appendChild(userInfoDiv);
                        userDiv.appendChild(timeDiv);

                        if (user.unread_count > 0 && user.username !== currentUser) {
                            const unreadBadge = document.createElement('span');
                            unreadBadge.className = 'unread-badge';
                            unreadBadge.textContent = user.unread_count;
                            userDiv.appendChild(unreadBadge);
                        }

                        userList.appendChild(userDiv);
                    });
                });
        }

        // Load the conversation of the selected user
        function loadConversation(username) {
            currentUser = username;

            // Update the current user's name in the message box header
            const currentUserHeader = document.getElementById('currentUserHeader');
            currentUserHeader.textContent = `Conversation with: ${username}`;

            // Mark messages as read for this user
            fetch(`markAsRead.php?username=${username}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data.message); // Debug log
                });

            // Clear the messages container and fetch messages
            const messagesContainer = document.getElementById('messagesContainer');
            messagesContainer.innerHTML = ''; // Clear all messages
            lastFetchedMessageTime[username] = ''; // Reset last fetched time
            fetchMessages(); // Fetch messages for the first time
        }



// Fetch messages for the selected user
function fetchMessages() {
    if (!currentUser) return;

    const messagesContainer = document.getElementById("messagesContainer");

    // Fetch messages from the server
    fetch(`fetchAdminMessages.php?username=${currentUser}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            if (data.error) {
                console.error("Error fetching messages:", data.error);
                return;
            }

            // Clear the messages container
            messagesContainer.innerHTML = "";

            // Populate messages
            data.messages.forEach((message) => {
                const messageDiv = document.createElement("div");
                messageDiv.className =
                    "message " +
                    (message.sender === "admin"
                        ? "admin-message"
                        : "user-message");
                messageDiv.textContent = message.body;

                messagesContainer.appendChild(messageDiv);
            });

            // Auto-scroll to the latest message
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        })
        .catch((error) => {
            console.error("Error fetching messages:", error);
        });
}

        // Handle sending replies
        document.getElementById('replyForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            formData.append('sender', 'admin');
            formData.append('username', currentUser); // Add the current user

            fetch('sendMessage.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('replyMessage').value = ''; // Clear reply input
                    fetchMessages(); // Refresh messages for the current user
                });
        });

        // Auto-refresh messages for the currently opened conversation
        setInterval(() => {
            fetchUserList(); // Always refresh the user list
            if (currentUser) fetchMessages(); // Fetch new messages for the opened conversation
        }, 2000);

        // Initial fetch
        fetchUserList();
    </script>
</body>

</html>