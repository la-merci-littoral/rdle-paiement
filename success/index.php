<?php

    if ($_GET['redirect_status'] == "succeeded") {
        $success = true;
    }

    $lname = $_SESSION['lname'];
    $fname = $_SESSION['fname'];
    $postal = $_SESSION['postal'];
    $city = $_SESSION['city'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];

    session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="../img/LRDE-logo.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Thank you!</title>
</head>
<body>

    <?php require('../modules/nav.php') ?>

    <main>
        <h2>Merci pour votre participation!</h2>
        <div class="return"><a href="https://ronde-de-l-espoir.fr" class="button">Retour à l'accueil</a></div>
    </main>
    
</body>
</html>