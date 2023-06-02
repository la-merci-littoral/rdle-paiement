<?php
    // if (session_status() == PHP_SESSION_NONE) {
    //     session_start();
    // }

    // foreach($_SESSION as $element) {
    //     echo $element, '  |  ';
    // }

    // ------------ Please do not initialize session variables above this line ------------- //

    // ⬇️ This some code for debugging : uncomment this and it will reset the system.
    // Then recomment this and refresh the page. Good luck !

    // session_destroy();
    // print_r($_SESSION);
    // die("Session successfully reset ! Please comment the code and refresh the page. 😊");

    // ⬇️ This has the same purpose but it more precise : it only affects the choosing part of the system.
    // Please follow the same procedure as above.

    // unset($_SESSION['isAnonymous']);
    // unset($_SESSION['isCompany']);
    // die("Choosing variables successfully reset ! Please comment the code and refresh the page. 😊");

    // ------------- End of debugging code -------------- //
    

    // if (!isset($_SESSION['isAnonymous']) or !isset($_SESSION['isCompany'])) {
    //     header('Location: ./choix/type/');
    // } elseif ($_SESSION['isAnonymous'] == false and $_SESSION['isCompany'] == false) {
    //     header("Location: ./choix/montant");
    // } elseif ($_SESSION['isAnonymous'] == true) {
    //     $_SESSION['submit'] = true;
    //     header("Location: ./choix/montant/");
    // } elseif ($_SESSION['isAnonymous'] == false and $_SESSION['isCompany'] == true) {
    //     $_SESSION['submit'] = true;
    //     header("Location: ./choix/montant");
    // } else {
    //     header('Location: ./choix/type/');
    // }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="end-style.css">
    <title>Paiement - Ronde de l'Espoir</title>
</head>
<body>
    <main>
        <p>Les dons se sont arrêtés à 20:00 !</p>
    </main>
</body>
</html>