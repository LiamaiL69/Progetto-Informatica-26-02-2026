<?php
session_start();
$currentPage = "customization";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customization - BET271</title>
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
    <h2>Customization</h2>
    <p>Customize your profile, themes and visual preferences.</p>
</section>

</body>
</html>
