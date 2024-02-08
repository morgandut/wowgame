<?php

include 'Hero.php';
include 'enemy.php';

session_start();
// Vérifier si le héros est initialisé dans la session
if (!isset($_SESSION['hero'])) {
    $_SESSION['hero'] = new Hero("hero");
}

if (!isset($_SESSION['enemy'])) {
    $_SESSION['enemy'] = new Enemy("Enemy",100,100,1);
}

$expGained = "";
$heroDamage = $_SESSION['hero']->damage;
$now_hp = $_SESSION['enemy']->attack($heroDamage);
// Logique de combat et mise à jour de l'expérience du héros
$enemyLevel = $_SESSION['enemy']->enemylevel + $_SESSION['hero']->level;

if ($now_hp <= 0) {
    $expGained = $enemyLevel * rand(20, 40);
    $heroStats = $_SESSION['hero']->gainExperience($expGained);
    $_SESSION['enemy'] = new Enemy("Enemy",100,100,1);
} else {
    $heroStats = ['level' => $_SESSION['hero']->level, 'experience' => $_SESSION['hero']->experience];
}

$expPercentage = ($heroStats['experience'] / ($heroStats['level'] * 500)) * 100;

// Retourner les données mises à jour au format JSON
echo json_encode(['level' => $heroStats['level'], 'experience' => $heroStats['experience'],'expGained' => $expGained,'enemyLevel' => $enemyLevel, 'now_hp' => $now_hp]);
?>
