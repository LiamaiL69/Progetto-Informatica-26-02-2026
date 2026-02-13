<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - BET271</title>
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>

<div class="auth-container">
    <h2>Login</h2>

    <div id="message"></div>

    <form id="loginForm">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Accedi</button>
    </form>

    <p>Non hai un account? <a href="register.php">Registrati</a></p>
    <p><a href="../home.php">← Torna alla Home</a></p>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e){
    e.preventDefault();

    const message = document.getElementById("message");
    message.innerHTML = "<div class='message success'>Login simulato (layout demo)</div>";
});
</script>

</body>
</html>
