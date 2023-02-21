<?php
    session_start();

    if (isset($_POST['submit'])) {
        $lname = "";

        $errors = [];

        if ($_POST['lname'] != "") {
            $lname = $_POST['lname'];
        } else {
            $errors['lname'] = "undefined";
        }

        if ($_POST['fname'] != "") {
            $fname = $_POST['fname'];
        } else {
            $errors['fname'] = "undefined";
        }

        if ($_POST['postal'] != "") {
            $postal = $_POST['postal'];
        } else {
            $errors['postal'] = "undefined";
        }

        if ($_POST['city'] != "") {
            $city = $_POST['city'];
        } else {
            $errors['city'] = "undefined";
        }

        if ($_POST['email'] != "") {
            $email = $_POST['email'];
        } else {
            $errors['email'] = "undefined";
        }

        if ($_POST['phone'] != "") {
            $phone = $_POST['phone'];
        } else {
            $errors['phone'] = "undefined";
        }

        if (empty($errors)) {
            $_SESSION['lname'] = $lname;
            $_SESSION['fname'] = $fname;
            $_SESSION['postal'] = $postal;
            $_SESSION['city'] = $city;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;

            $_SESSION['submit'] = true;
            header('Location: ../');
            die();
        }
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <title>Ronde de l'Espoir</title>
</head>
<body>

    <?php 
        $page = "registering";
        require('../modules/nav.php') 
    ?>
    
    <main>

        <form action="./index.php" method="POST">

            <div class="column-wrapper">

                <div class="column">

                    <div class="field">
                        <label for="fname">Nom :</label>
                        <input type="text" name="lname" placeholder="Entrez votre prénom ici" value="<?php if(isset($_SESSION['lname'])) {echo $_SESSION['lname'];} ?>">
                        <p class="error <?php if(isset($errors['lname'])) {echo "show";} ?>">Nom invalide.</p>
                    </div>
                    
                    <div class="field">
                        <label for="lname">Prénom :</label>
                        <input type="text" name="fname" placeholder="Entrez votre prénom ici" value="<?php if(isset($_SESSION['fname'])) {echo $_SESSION['fname'];} ?>">
                        <p class="error <?php if(isset($errors['fname'])) {echo "show";} ?>">Prénom invalide.</p>
                    </div>
                    
                    <div class="field">
                        <label for="fname">Code Postal :</label>
                        <input type="number" name="postal" placeholder="30000" min="1" max="99999" value="<?php if(isset($_SESSION['postal'])) {echo $_SESSION['postal'];} ?>">
                        <p class="error <?php if(isset($errors['postal'])) {echo "show";} ?>">Code Postal invalide.</p>
                    </div>
                    
                    <div class="field">
                        <label for="city">Ville :</label>
                        <input type="text" name="city" placeholder="Entrez le nom de votre ville ici" value="<?php if(isset($_SESSION['city'])) {echo $_SESSION['city'];} ?>">
                        <p class="error <?php if(isset($errors['city'])) {echo "show";} ?>">Ville invalide.</p>
                    </div>
                    
                    <div class="field">
                        <label for="email">Email :</label>
                        <input type="email" name="email" placeholder="Entrez votre email ici" value="<?php if(isset($_SESSION['email'])) {echo $_SESSION['email'];} ?>">
                        <p class="error <?php if(isset($errors['email'])) {echo "show";} ?>">Email invalide.</p>
                    </div>
                    
                    <div class="field">
                        <label for="phone">Numéro de téléphone :</label>
                        <input type="tel" name="phone" placeholder="01 23 45 67 89" maxlength="14" value="<?php if(isset($_SESSION['phone'])) {echo $_SESSION['phone'];} ?>">
                        <p class="error <?php if(isset($errors['phone'])) {echo "show";} ?>">Numéro invalide.</p>
                    </div>
                    
                </div>
                
                <div class="separator"></div>
                
                <div class="column submit-column">
                    
                    <!-- <button class="border-button">Retour</button> -->
                    <input type="submit" name="submit" value="Continuer" class="submit-button">

                </div>
            </div>

            <!-- <div class="submit-wrapper">
                <input type="submit" name="anonymous" value="Continuer anonymement" class="anonyme-button">
                <input type="submit" name="submit" value="Continuer" class="submit-button">
            </div> -->
            
        </form>

    </main>
    
</body>
</html>