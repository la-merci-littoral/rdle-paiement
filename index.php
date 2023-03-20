<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    foreach($_SESSION as $element) {
        echo $element, '  |  ';
    }

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
    

    if (!isset($_SESSION['isAnonymous']) or !isset($_SESSION['isCompany'])) {
        header('Location: ./choix/type/');
    } elseif ($_SESSION['isAnonymous'] == false and $_SESSION['isCompany'] == false) {
        header("Location: ./informations?type=particulier");
    } elseif ($_SESSION['isAnonymous'] == true) {
        $_SESSION['submit'] = true;
        header("Location: ./montant/");
    } elseif ($_SESSION['isAnonymous'] == false and $_SESSION['isCompany'] == true) {
        $_SESSION['submit'] = true;
        header("Location: ./informations?type=entreprise");
    } else {
        header('Location: ./choix/type/');
    }
?>  