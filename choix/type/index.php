<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $prefix = "../../";

    if (isset($_POST['submit-normal'])) {
        $_SESSION['isAnonymous'] = false;
        $_SESSION['isCompany'] = false;
        header("Location: ../montant");
    } elseif (isset($_POST['submit-anonymous'])) {
        $_SESSION['isAnonymous'] = true;
        $_SESSION['isCompany'] = false;
        header("Location: ../../");
    } elseif (isset($_POST['submit-company'])) {
        $_SESSION['isCompany'] = true;
        $_SESSION['isAnonymous'] = false;
        header("Location: ../montant");
    }
?>

<!DOCTYPE html>
<html lang="en" not-to-be-blurred>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="../../img/LRDE-logo.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="choosing.js" defer></script>
    <title>Ronde de l'Espoir</title>
</head>
<body not-to-be-blurred>

    <?php
        require('../../modules/nav.php');
        $dots = '../../';
        require('../../modules/help.php');
    ?>

    <main not-to-be-blurred>
        <form action="./" method="POST">
            <ul id="choices">
                <li id="individual">
                    <p> Je participe en tant qu'<span class="highlight" data-value="individu">individu</span>!</p>
                    <input type="submit" name="submit-normal" value="arrow_forward_ios" class="material-symbols-outlined">
                </li>
                <li id="individual anonymous">
                    <p> Je souhaite participer <span class="highlight" data-value="anonymement">anonymement</span>.</p>
                    <div><a class="material-symbols-outlined" onclick="openAnonymous()">arrow_forward_ios </a></div>
                </li>
                <li id="company">
                    <p> Participer en tant qu'<span class="highlight" data-value="entreprise">entreprise</span>.</p>
                    <input type="submit" name="submit-company" value="arrow_forward_ios" class="material-symbols-outlined">
                </li>
            </ul>
        </form>
        <div id="confirm-box" class="hidden" not-to-be-blurred>
            <p not-to-be-blurred style="font-weight: bold;">Etes-vous sûr de vouloir continuer anonymement ?</p>
            <br>
            <p not-to-be-blurred>En continuant anonymement, vous ne pourrez pas :</p>
            <ul not-to-be-blurred>
                <li not-to-be-blurred>Profiter d'une déduction d'impôts</li>
                <li not-to-be-blurred>Et d'autres désavantages à venir</li>
            </ul>
            <br>
            <form action="./index.php" method="POST" not-to-be-blurred>
                <div id="confirmation-input" not-to-be-blurred>
                    <label not-to-be-blurred>
                        <input type="checkbox" name="anonymous" value="1" onclick="toggleSubmit(this)" not-to-be-blurred>
                        <span not-to-be-blurred id="chkbx-text">Je confirme vouloir rester anonyme</span>
                    </label>
                    <!-- <label for="anonymous" not-to-be-blurred>Je confirme vouloir rester anonyme</label> -->
                </div>
                <br>
                <div class="submit-field" not-to-be-blurred>
                    <input type="submit" name="submit-anonymous" value="Suivant" class="button submit-button" disabled not-to-be-blurred>
                    <button type="submit" name="goback" value="Précédent" class="button border-button" not-to-be-blurred>Annuler</button>
                </div>
            </form>
        </div>
    </main>


</body>