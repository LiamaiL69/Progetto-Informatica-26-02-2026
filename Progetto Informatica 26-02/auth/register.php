<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione - BET271</title>
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>

<div class="auth-container">
    <h2>Registrazione</h2>

    <div id="message"></div>

    <form id="registerForm">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Registrati</button>
    </form>

    <p>Hai già un account? <a href="login.php">Login</a></p>
    <p><a href="../home.php">← Torna alla Home</a></p>
</div>

<script>
document.getElementById("registerForm").addEventListener("submit", function(e){
    e.preventDefault();

    const message = document.getElementById("message");
    message.innerHTML = "<div class='message success'>Registrazione simulata (layout demo)</div>";
});
</script>

</body>
</html>
