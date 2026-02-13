<?php
session_start();
$currentPage = "achievements";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Achievements - BET271</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/achievements.css">
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
    <div class="achievements-header">
        <h2>Your Achievements</h2>
        <p>Track your milestones and unlock rewards</p>
    </div>

    <div class="achievements-grid">

        <?php for($i=1; $i<=12; $i++): ?>
        <div class="achievement-card" data-task="Task required for Achievement <?= $i ?>">
            <img src="../resources/achievements/a<?= $i ?>.jpg" alt="Achievement <?= $i ?>">
            <h3>Achievement <?= $i ?></h3>
            <p>Complete this task to unlock</p>
        </div>
        <?php endfor; ?>

    </div>
</section>


<div id="taskBar" class="task-bar">
    <span id="taskText">Click on an achievement to see the task required</span>
</div>
<script src="../script/achievements.js"></script>
</body>
</html>

