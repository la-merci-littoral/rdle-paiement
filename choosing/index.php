<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_POST['goback'])) {
        $_SESSION['isAnonymous'] = FALSE;
        header("Location: ./");
    }

    if (isset($_POST['submit'])) {
        $_SESSION['isAnonymous'] = filter_var($_POST['anonymous'], FILTER_VALIDATE_BOOLEAN);
        header("Location: ../");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../img/LRDE-logo.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="choosing.js" defer></script>
    <title>Ronde de l'Espoir</title>
</head>
<body>

    <?php require('../modules/nav.php') ?>

    <main>
        <ul>
            <li id="individual">
                <p> Je participe <span class="highlight" data-value="maintenant">maintenant</span>!</p>
                <div><a class="material-symbols-outlined" href="../registering/">arrow_forward_ios</a></div>
            </li>
            <li id="individual anonymous">
                <p> Je souhaite participer <span class="highlight" data-value="anonymement">anonymement</span>.</p>
                <div><a class="material-symbols-outlined" onclick="openAnonymous()">arrow_forward_ios </a></div>
            </li>
            <li id="company">
                <p> Participer en tant qu'<span class="highlight" data-value="entreprise">entreprise</span>.</p>
                <div><a class="material-symbols-outlined" href="#">arrow_forward_ios </a></div>
            </li>
        </ul>
        <div id="confirm-box" class="hidden">
            <p>Etes-vous sûr de vouloir continuer anonymement ?</p>
            <br>
            <p>En continuant anonymement, vous ne pourrez pas :</p>
            <ul>
                <li>Profiter d'une déduction d'impôts</li>
                <li>Et d'autres désavantages à venir</li>
            </ul>
            <br>
            <form action="./index.php" method="POST">
                <div id="confirmation-input">
                    <input type="checkbox" name="anonymous" value="1" onclick="toggleSubmit(this)">
                    <label for="anonymous">Je confirme vouloir rester anonymes</label>
                </div>
                <div class="submit-field">
                    <input type="submit" name="submit" value="Suivant" class="button submit-button" disabled>
                    <button type="submit" name="goback" value="Précédent" class="button border-button" onclick="closeAnonymous()">Annuler</button>
                </div>
            </form>
        </div>
    </main>


</body>