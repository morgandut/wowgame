<?php

include 'Hero.php';
include 'enemy.php';

session_start();

if (!isset($_SESSION['hero'])) {
    $_SESSION['hero'] = new Hero("Hero");
}

$_SESSION['hero']->reset();
?>
