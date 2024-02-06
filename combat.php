<?php
include 'Hero.php';

session_start();

// Inclure la classe Hero si ce n'est pas déjà fait


// Vérifier si le héros est initialisé dans la session
if (!isset($_SESSION['hero'])) {
    $_SESSION['hero'] = new Hero("Hero");
}

// Logique de combat et mise à jour de l'expérience du héros
$enemyLevel = $_SESSION['hero']->level + rand(0, 2);
$expGained = $enemyLevel * rand(1, 5);
$heroStats = $_SESSION['hero']->gainExperience($expGained);

$expPercentage = ($heroStats['experience'] / ($heroStats['level'] * 500)) * 100;

// Retourner les données mises à jour au format JSON
echo json_encode(['level' => $heroStats['level'], 'experience' => $heroStats['experience'],'expGained' => $expGained]);
?>
