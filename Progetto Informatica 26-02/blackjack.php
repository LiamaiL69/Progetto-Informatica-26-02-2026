<?php
session_start();

/* ========================= */
/* MAZZO REALE               */
/* ========================= */

function creaMazzo() {
    $valori = [
        '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6,
        '7' => 7, '8' => 8, '9' => 9,
        '10' => 10, 'J' => 10, 'Q' => 10, 'K' => 10,
        'A' => 11
    ];

    $semi = [
        '♠' => 'black',
        '♣' => 'black',
        '♥' => 'red',
        '♦' => 'red'
    ];

    $mazzo = [];

    foreach ($semi as $seme => $colore) {
        foreach ($valori as $nome => $valore) {
            $mazzo[] = [
                'nome' => $nome,
                'valore' => $valore,
                'seme' => $seme,
                'colore' => $colore
            ];
        }
    }

    shuffle($mazzo);
    return $mazzo;
}

function pescaCarta() {
    return array_shift($_SESSION['deck']);
}

function punteggio($mano) {
    $tot = 0;
    $assi = 0;

    foreach ($mano as $c) {
        $tot += $c['valore'];
        if ($c['nome'] === 'A') $assi++;
    }

    while ($tot > 21 && $assi > 0) {
        $tot -= 10;
        $assi--;
    }

    return $tot;
}

/* ========================= */
/* STATO INIZIALE            */
/* ========================= */

if (!isset($_SESSION['state'])) {
    $_SESSION['state'] = 'bet';
}

/* ========================= */
/* PUNTATA                   */
/* ========================= */

if (isset($_POST['place_bet'])) {
    $_SESSION['deck'] = creaMazzo();
    $_SESSION['bet'] = (int)$_POST['bet'];

    $_SESSION['player'] = [pescaCarta(), pescaCarta()];
    $_SESSION['dealer'] = [pescaCarta(), pescaCarta()];

    $_SESSION['state'] = 'play';
    $_SESSION['result'] = '';
}

/* ========================= */
/* GIOCO                     */
/* ========================= */

if (isset($_POST['hit']) && $_SESSION['state'] === 'play') {
    $_SESSION['player'][] = pescaCarta();

    if (punteggio($_SESSION['player']) > 21) {
        $_SESSION['state'] = 'end';
        $_SESSION['result'] = "Sballato! Hai perso.";
    }
}

if (isset($_POST['stand']) && $_SESSION['state'] === 'play') {
    while (punteggio($_SESSION['dealer']) < 17) {
        $_SESSION['dealer'][] = pescaCarta();
    }

    $p = punteggio($_SESSION['player']);
    $d = punteggio($_SESSION['dealer']);

    $_SESSION['state'] = 'end';

    if ($d > 21 || $p > $d) {
        $_SESSION['result'] = "Hai vinto!";
    } elseif ($p < $d) {
        $_SESSION['result'] = "Hai perso!";
    } else {
        $_SESSION['result'] = "Pareggio!";
    }
}

if (isset($_POST['restart'])) {
    session_destroy();
    header("Location: blackjack.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Blackjack - Bet271</title>
    <link rel="stylesheet" href="css/blackjack.css">
</head>
<body>

<div class="table fade-in">
<h1>Blackjack</h1>

<?php if ($_SESSION['state'] === 'bet'): ?>

<form method="post" class="bet-box slide-up">
    <h2>Piazza la puntata</h2>
    <input type="number" name="bet" min="1" max="100" required>
    <button name="place_bet">Gioca</button>
</form>

<?php else: ?>

<div class="dealer">
<h2>Banco</h2>
<div class="cards">
<?php foreach ($_SESSION['dealer'] as $i => $c): ?>
<div class="card <?= ($i === 0 && $_SESSION['state'] === 'play') ? 'flip' : 'flip flipped' ?>">
    <div class="inner">
        <div class="front back"></div>
        <div class="back-face <?= $c['colore'] ?>">
            <span class="top"><?= $c['nome'] ?><?= $c['seme'] ?></span>
            <span class="center"><?= $c['seme'] ?></span>
            <span class="bottom"><?= $c['nome'] ?><?= $c['seme'] ?></span>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>
</div>

<div class="player">
<h2>Giocatore</h2>
<div class="cards">
<?php foreach ($_SESSION['player'] as $c): ?>
<div class="card flipped">
    <div class="inner">
        <div class="back-face <?= $c['colore'] ?>">
            <span class="top"><?= $c['nome'] ?><?= $c['seme'] ?></span>
            <span class="center"><?= $c['seme'] ?></span>
            <span class="bottom"><?= $c['nome'] ?><?= $c['seme'] ?></span>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>
<p>Punteggio: <?= punteggio($_SESSION['player']) ?></p>
</div>

<?php if ($_SESSION['state'] === 'play'): ?>
<form method="post" class="actions">
    <button name="hit">Carta</button>
    <button name="stand">Stai</button>
</form>
<?php else: ?>
<p class="result glow"><?= $_SESSION['result'] ?></p>
<form method="post"><button name="restart">Nuova partita</button></form>
<?php endif; ?>

<?php endif; ?>
</div>

<script src="script/blackjack.js"></script>
</body>
</html>
