<?php
session_start();

// Simboli base
$symbols = ["🍒","🍋","🍊","🍉","⭐","💎"];
$final_symbols = [
    $symbols[array_rand($symbols)],
    $symbols[array_rand($symbols)],
    $symbols[array_rand($symbols)]
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Slot Machine - Bet271</title>
<link rel="stylesheet" href="css/slots.css">
</head>
<body>

<div class="slot-machine">
<h1>Slot Machine</h1>

<div class="reels">
  <div class="reel-container"><div class="reel" data-final="<?= $final_symbols[0] ?>"></div></div>
  <div class="reel-container"><div class="reel" data-final="<?= $final_symbols[1] ?>"></div></div>
  <div class="reel-container"><div class="reel" data-final="<?= $final_symbols[2] ?>"></div></div>
</div>

<p class="result"></p>
<button id="spin">Gira</button>
</div>

<script>
const finalSymbols = <?= json_encode($final_symbols) ?>;
</script>
<script src="script/slots.js"></script>
</body>
</html>
