<?php
$isLogged = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
$balance = $_SESSION['saldo'] ?? 0;
?>

<header>
    <div class="logo"><a href="../home.php">BET271</a></div>

    <div class="header-right">
        <?php if(!$isLogged): ?>
            <a href="auth/login.php" class="btn">Login</a>
            <a href="auth/register.php" class="btn accent">Sign Up</a>
        <?php else: ?>
            <div class="saldo-box">
                💰 <?= number_format($balance, 2); ?> Credits
            </div>
            <span class="welcome">
                👋 <?= htmlspecialchars($username); ?>
            </span>
            <a href="auth/logout.php" class="btn">Logout</a>
        <?php endif; ?>
    </div>
</header>
