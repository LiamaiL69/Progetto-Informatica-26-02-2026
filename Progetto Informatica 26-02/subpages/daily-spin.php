<?php
session_start();
$currentPage = "daily";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Spin - BET271</title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>

<?php include "../partials/header.php"; ?>

<nav>
    <a href="customization.php" class="<?= $currentPage === 'customization' ? 'active' : '' ?>">Customization</a>
    <a href="daily-spin.php" class="<?= $currentPage === 'daily' ? 'active' : '' ?>">Daily Spin</a>
    <a href="achievements.php" class="<?= $currentPage === 'achievements' ? 'active' : '' ?>">Achievements</a>
    <a href="statistics.php" class="<?= $currentPage === 'statistics' ? 'active' : '' ?>">Statistics</a>
    <a href="leaderboard.php" class="<?= $currentPage === 'leaderboard' ? 'active' : '' ?>">Leaderboard</a>
</nav>

<section class="section">
    <h2>Daily Spin</h2>
    <p>Come back every day to spin the wheel and win rewards.</p>
</section>

</body>
</html>
