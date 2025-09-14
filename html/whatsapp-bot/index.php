<?php
$allowed_ip = '124.253.128.203';
$user_ip = $_SERVER['REMOTE_ADDR'];
$whatsapp_number = '919437144274'; // Dynamic WhatsApp number (can be changed)
$show_chatbot = ($user_ip === $allowed_ip);
// if($show_chatbot){
?>
    <style>
        .chat-container {
            width: 350px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            position: fixed;
            bottom: 70px;
            right: 10px;
            display: none;
            flex-direction: column;
            box-sizing: border-box;
            z-index: 200;
        }
        .chat-header {
            font-size: 18px;
            font-weight: bold;
            color: #25d366; /* WhatsApp green */
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chat-box {
            height: 100px;
            overflow-y: auto;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .chat-message {
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .user-message {
            background: #25d366; 
            color: white;
            text-align: right;
        }
        .bot-message {
            background: #e1e1e1;
            text-align: left;
        }
        .input-box {
            display: flex;
            margin-top: 10px;
        }
        input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            padding: 10px;
            background: #25d366;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .chat-toggle-btn {
            padding:0;
            position: fixed;
            bottom: 72px;
            right: 17px;
            background: transparent;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.6s ease-in-out;
        }
        .chat-toggle-btn img {
            width: 100%; /* Adjust size of the image */
            height: 100%; /* Adjust size of the image */
            object-fit: contain; /* Ensures the image is fully contained within the button */
            border-radius: 20px;
            transition: all 0.6s ease-in-out;
        }
        .chat-welcome-msg {
            font-size: 16px;
            color: #4a4a4a;
            margin-bottom: 15px;
            text-align: center;
        }
        /* Close button styling */
        .close-btn {
            font-size: 20px;
            color: #ccc;
            cursor: pointer;
        }
        .close-btn:hover {
            color: #ff0000;
        }
    </style>
    <button class="chat-toggle-btn" onclick="toggleChat()">
        <img src="whatsapp-bot/whatsapp.png" alt="WhatsApp" />
    </button>
    <div class="chat-container" id="chat-container">
        <div class="chat-header">
            WhatsApp Chatbot
            <span class="close-btn" onclick="toggleChat()">x</span>
        </div>
        <div class="chat-welcome-msg">Hello! How can I assist you today?</div>
        <div class="chat-box" id="chat-box"></div>
        <div class="input-box">
            <input type="text" id="user-message" placeholder="Type a message..." />
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        let whatsappNumber = "<?php echo $whatsapp_number; ?>";

        function toggleChat() {
            let chatContainer = document.getElementById("chat-container");
            // Toggle chat visibility
            chatContainer.style.display = (chatContainer.style.display === "none" || chatContainer.style.display === "") ? "flex" : "none";
        }
        document.getElementById("user-message").addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent the default action (form submission or new line)
                sendMessage(); // Call the sendMessage function
            }
        });


        function sendMessage() {
            let input = document.getElementById("user-message");
            let message = input.value.trim();
            if (message === "") return;

            let chatBox = document.getElementById("chat-box");
            chatBox.innerHTML += `<div class='chat-message user-message'>${message}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight;

            window.open(`https://api.whatsapp.com/send?phone=${whatsappNumber}&text=${encodeURIComponent(message)}`);
            input.value = "";
        }
    </script>
<?php 
// }
?>
