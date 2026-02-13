<?php
session_start();
$currentPage = "leaderboard";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard - BET271</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/leaderboard.css">
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
    <div class="leaderboard-header">
        <h2>Leaderboard</h2>
        <p>Check the top players and their scores</p>
    </div>

    <table class="leaderboard-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=1; $i<=10; $i++): ?>
            <tr>
                <td><?= $i ?></td>
                <td>Player<?= $i ?></td>
                <td>0</td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</section>

</body>
</html>
