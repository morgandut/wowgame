<?php
include('combat.php');
ini_set('display_errors', 'off');
session_start();

$expPercentage = ($_SESSION['hero']->experience / ($_SESSION['hero']->level * 500)) * 100;
$_SESSION['exp_percentage'] = $expPercentage;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warcraft Incremental Game</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="hero-info">
        <h2>Héros</h2>
        <p>Nom: <span id="hero-name"><?php echo $_SESSION['hero']->name; ?></span></p>
        <p>Niveau: <span id="hero-level"><?php echo $_SESSION['hero']->level; ?></span></p>
        <p>Expérience: <span id="hero-exp"><?php echo $_SESSION['hero']->experience; ?></span></p>
        <p>Expérience gagné: <span id="hero-expgained"><?php echo $_SESSION['hero']->expGained; ?></span></p>
        <div id="exp-bar" style="border: 1px solid #000; width: 200px;">
            <div id="exp-progress" style="background-color: #4CAF50; width: <?php echo ($_SESSION['hero']->experience / ($_SESSION['hero']->level * 100)) * 100; ?>%;">
                &nbsp;
            </div>
        </div>
    </div>
    <div id="enemy-info">
        <h2>Enemy</h2>
        <p>Nom: <span id="enemy-name"><?php echo $_SESSION['enemy']->name; ?></span></p>
        <p>Niveau: <span id="enemy-level"><?php echo $_SESSION['enemy']->enemylevel; ?></span></p></p>
        <p>HP: <span id="enemy-HP"><?php echo $_SESSION['enemy']->current_hp; ?></span></p></p></p>
    </div>
    <br>
    <button id="reset-btn">Réinitialiser le héros</button>

    <script>
$(document).ready(function() {
    var initialExpPercentage = <?php echo $_SESSION['exp_percentage']; ?>;
    $("#exp-progress").css("width", initialExpPercentage + "%");
    function combatAjax() {
        $.ajax({
            url: "combat.php",
            type: "POST",
            dataType: "json", // Spécifiez le type de données attendu
            success: function(data) {
                var level = data.level;
                var experience = data.experience;
                var expGained = data.expGained;
                var enemyLevel = data.enemyLevel;
                var now_hp = data.now_hp;
                // Mettre à jour les éléments HTML avec les données reçues
                $("#hero-level").text(level);
                $("#hero-exp").text(experience);
                $("#hero-expgained").text(expGained);
                // Mettre à jour la barre de progression d'expérience
                var expPercentage = (experience / (level * 500)) * 100;
                $("#exp-progress").css("width", expPercentage + "%");
                $("#enemy-level").text(enemyLevel);
                $("#enemy-HP").text(now_hp);
            }
        });
    }

    // Exécuter la fonction combatAjax toutes les 3 secondes
    setInterval(combatAjax, 1000);

    $("#reset-btn").click(function() {
        $.ajax({
            url: "reset.php",
            type: "POST",
            success: function() {
                location.reload();
            }
        });
    });
});;
    </script>
</body>
</html>
