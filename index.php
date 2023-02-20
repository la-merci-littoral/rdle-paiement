<?php

    if (isset($_POST['submit'])) {
        echo "Well hello there";
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
    <script defer src="checkout.js"></script>

    <link rel="shortcut icon" href="./img/LRDE-logo.png" type="image/x-icon"> <!-- To change href when merging -->

    <title>La Ronde de l'Espoir</title>
</head>
<body>

    <form id="payment-form">

        <div id="link-authentication-element"></div>
        <div id="payment-element"></div>

        <button id="submit">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">Pay now</span>
        </button>

        <div id="payment-message" class="hidden"></div>


    </form>

    
</body>
</html>