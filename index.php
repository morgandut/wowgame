<?php
include 'Hero.php';

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
                // Mettre à jour les éléments HTML avec les données reçues
                $("#hero-level").text(data.level);
                $("#hero-exp").text(data.experience);
                $("#hero-expgained").text(data.expGained);
                // Mettre à jour la barre de progression d'expérience
                var expPercentage = (data.experience / (data.level * 500)) * 100;
                $("#exp-progress").css("width", expPercentage + "%");
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
