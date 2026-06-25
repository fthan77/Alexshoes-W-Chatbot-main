<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Alex Shoes</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2;}
        #chatbox { width: 400px; margin: 30px auto; background: #fff; padding: 20px;
                   border-radius: 10px; height: 450px; overflow-y: scroll; }
        .user { text-align: right; margin: 10px; }
        .bot { text-align: left; margin: 10px; }
        #inputArea { width: 400px; margin: 10px auto; display: flex; }
        #msg { flex: 1; padding: 10px; }
        button { padding: 10px 15px; }
    </style>
</head>
<body>

<div id="chatbox"></div>

<div id="inputArea">
    <input type="text" id="msg" placeholder="Ketik pesan..." />
    <button onclick="sendMsg()">Kirim</button>
</div>

<script>
function sendMsg() {
    let text = document.getElementById("msg").value;
    if (!text) return;

    document.getElementById("chatbox").innerHTML += `
        <div class='user'><b>Anda:</b> ${text}</div>
    `;

    fetch("/chatbot", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ message: text })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("chatbox").innerHTML += `
            <div class='bot'><b>Alex:</b> ${data.reply}</div>
        `;
    });

    document.getElementById("msg").value = "";
}
</script>

</body>
</html>
