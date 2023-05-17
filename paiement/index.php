<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['isAnonymous'])) {
        if ($_SESSION['isAnonymous'] == true) {
            echo '';
        } elseif ($_SESSION['isCompany']) {
            if (isset($_SESSION['companyName'])
                && isset($_SESSION['companySIREN'])
                && isset($_SESSION['companySIRET'])
                && isset($_SESSION['companyContactAddress'])
                && isset($_SESSION['companyAddress'])
                && isset($_SESSION['companyAddressComplement'])
                && isset($_SESSION['companyPostal'])
                && isset($_SESSION['companyCity'])
                && $_SESSION['amount_error'] == false
                && !array_filter($_SESSION['info_error'])
            ) {
                echo '';
            }
        } else {

            if (isset($_SESSION['lname'])
                && isset($_SESSION['fname'])
                && isset($_SESSION['email'])
                && isset($_SESSION['phone'])
                && isset($_SESSION['city'])
                && isset($_SESSION['postal'])
                && isset($_SESSION['amount_donated'])
                && $_SESSION['amount_error'] == false
                && !array_filter($_SESSION['info_error'])
            ) {
                echo '';
            } elseif (!$_SESSION['isCompany']) {
                header('Location: ../informations/individu');
            } else {
                header('Location: ../');
            }
        }
    } else {
        header('Location: ../');
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <script defer src="https://js.stripe.com/v3/"></script>
    <!-- <script defer src="app.js"></script> -->
    <script>var emailAddress = <?= isset($_SESSION['email']) ? $_SESSION['email'] : $_SESSION['companyContactAddress'] ?></script>
    <script defer src="checkout.js"></script>

    <link rel="shortcut icon" href="./img/LRDE-logo.png" type="image/x-icon"> <!-- To change href when merging -->

    <title>La Ronde de l'Espoir</title>
</head>
<body>

    <?php 
        $prefix = '../';
        include('../modules/nav.php');
    ?>

    <form id="payment-form">

        <?php
            $currentPage = "payment";
            include('../modules/progress.php'); 
        ?>

        <div id="link-authentication-element"></div>
        <div id="payment-element"></div>

        <button id="submit">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">Contribuer maintenant!</span>
        </button>

        <div id="payment-message" class="hidden"></div>


        <div id="powered-by-stripe"><a href="https://stripe.com/en-fr" target="_blank"><i>Powered by <b>Stripe</b></i></a></div>
    </form>

    <div class="blank-space" style="height:50px;width:100%;"></div>

    <?php
        $dots = '../';
        include('../modules/help.php');
    ?>

    
</body>
</html>