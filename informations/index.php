<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['isAnonymous']) || !isset($_SESSION['amount']) || $_SESSION['amount_error']) {
        header('Location: ../choix/montant/');
    }

    $currentPage = 'info';

    $prefix = "../";

    require('../config/db_connect.php');

    $_SESSION['info_error'] = false;

    $lname = isset($_SESSION['lname']) ? $_SESSION['lname'] : "";
    $fname = isset($_SESSION['fname']) ? $_SESSION['fname'] : "";
    $postal = isset($_SESSION['postal']) ? $_SESSION['postal'] : "";
    $city = isset($_SESSION['city']) ? $_SESSION['city'] : "";
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
    $phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : "";
    $address = isset($_SESSION['address']) ? $_SESSION['address'] : "";
    $addressComplement = isset($_SESSION['addressComplement']) ? $_SESSION['addressComplement'] : "";
    
    $errors = array(
        'lname'=>'',
        'fname'=>'',
        'postal'=>'',
        'city'=>'',
        'email'=>'',
        'phone'=>'',
        'address'=>'',
        'addressComplement'=>''
    );

    if (isset($_POST['goback'])) {
        $_SESSION['lname'] = isset($_POST['lname']) ? $_POST['lname'] : "";
        $_SESSION['fname'] = isset($_POST['fname']) ? $_POST['fname'] : "";
        $_SESSION['postal'] = isset($_POST['postal']) ? $_POST['postal'] : "";
        $_SESSION['city'] = isset($_POST['city']) ? $_POST['city'] : "";
        $_SESSION['email'] = isset($_POST['email']) ? $_POST['email'] : "";
        $_SESSION['phone'] = isset($_POST['phone']) ? $_POST['phone'] : "";
        $_SESSION['address'] = isset($_POST['address']) ? $_POST['address'] : "";
        $_SESSION['addressComplement'] = isset($_POST['addressComplement']) ? $_POST['addressComplement'] : "";

        header("Location: ../choix/montant/");
    }

    if (isset($_POST['submit'])) {

        if (empty($_POST['lname'])) {
            $errors['lname'] = "Un nom est requis.";
        } else {
            $lname = $_POST['lname'];
            $_SESSION['lname'] = $_POST['lname'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $lname)) {
                $errors['lname'] = "Nom invalide.";
                $_SESSION['info_error'] = true;
            }
        }

        if (empty($_POST['fname'])) {
            $errors['fname'] = "Un prénom est requis.";
        } else {
            $fname = $_POST['fname'];
            $_SESSION['fname'] = $_POST['fname'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $fname)) {
                $errors['fname'] = "Prénom invalide.";
                $_SESSION['info_error'] = true;
            }
        }

        if (empty($_POST['postal'])) {
            $errors['postal'] = "Un code postal est requis.";
        } else {
            $postal = $_POST['postal'];
            $_SESSION['postal'] = $_POST['postal'];
        }

        if (empty($_POST['city'])) {
            $errors['city'] = "Une ville est requise.";
        } else {
            $city = $_POST['city'];
            $_SESSION['city'] = $_POST['city'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $city)) {
                $errors['city'] = "Nom de ville invalide.";
                $_SESSION['info_error'] = true;
            }
        }

        if (empty($_POST['email'])) {
            $errors['email'] = "Une e-mail est requise.";
        } else {
            $email = $_POST['email'];
            $_SESSION['email'] = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "E-mail invalide.";
                $_SESSION['info_error'] = true;
            }
        }

        if (empty($_POST['phone'])) {
            $errors['phone'] = "Un numéro de téléphone est requis.";
        } else {
            $phone = $_POST['phone'];
            $_SESSION['phone'] = $_POST['phone'];
            if (!preg_match('/^(0|(\+33[\s]?([0]?|[(0)]{3}?)))[1-9]([-. ]?[0-9]{2}){4}$/', $phone)) {    //@Skyman-2 better regex, all by myself 😎. Explanations here : regexr.com/79hsg
                $errors['phone'] = "Numéro de téléphone invalide.";
                $_SESSION['info_error'] = true;
            }
        }

        if (empty($_POST['address'])) {
            $errors['address'] = "Une adresse est nécessaire.";
            $address = "";
        } else {
            $address = $_POST['address'];
            $_SESSION['address'] = $_POST['address'];
            if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 _]*$/', $address)) {
                $errors['address'] = "Adresse invalide.";
                $_SESSION['info_error'] = true;
            }
        }

        if (empty($_POST['addressComplement'])) {
            $addressComplement = "";
        } else {
            $addressComplement = $_POST['addressComplement'];
            $_SESSION['addressComplement'] = $_POST['addressComplement'];
            if (!preg_match('/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 _]*$/', $addressComplement)) {
                $errors['addressComplement'] = "Complément d'adresse invalide.";
                $_SESSION['info_error'] = true;
            }
        }
    
        // saves errors in SESSION for check in payment
        $_SESSION['info_error'] = $errors;
        
        if (!array_filter($errors)) {
            // check for dangerous MySQL code
            $_SESSION['lname'] = mysqli_real_escape_string($conn, $lname);
            $_SESSION['fname'] = mysqli_real_escape_string($conn, $fname);
            $_SESSION['postal'] = mysqli_real_escape_string($conn, $postal);
            $_SESSION['city'] = mysqli_real_escape_string($conn, $city);
            $_SESSION['email'] = mysqli_real_escape_string($conn, $email);
            $_SESSION['phone'] = mysqli_real_escape_string($conn, $phone);
            $_SESSION['address'] = mysqli_real_escape_string($conn, $address);
            $_SESSION['addressComplement'] = mysqli_real_escape_string($conn, $addressComplement);
            
            $_SESSION['submit'] = true;
            header('Location: ../paiement');
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
    
    <title>Renseignement des Informations - Ronde de l'Espoir</title>
</head>
<body>

    <?php require('../modules/nav.php') ?>
    
    <main>

        <form action="./index.php" method="POST">

        <?php include('../modules/progress.php'); ?>

            <div class="column-wrapper">

                <div class="column">

                    <div class="field">
                        <label for="lname">Nom :</label>
                        <input type="text" name="lname" placeholder="Entrez votre nom ici" value="<?php echo $lname ?>">
                        <p class="error"><?php echo $errors['lname']; ?></p>
                    </div>
                    
                    <div class="field">
                        <label for="fname">Prénom :</label>
                        <input type="text" name="fname" placeholder="Entrez votre prénom ici" value="<?php echo $fname ?>">
                        <p class="error"><?php echo $errors['fname']; ?></p>
                    </div>

                    <div class="field">
                        <label for="email">E-mail :</label>
                        <input type="email" name="email" placeholder="Entrez votre adresse e-mail ici" value="<?php echo $email ?>">
                        <p class="error"><?php echo $errors['email']; ?></p>
                    </div>
                    
                    <div class="field">
                        <label for="phone">Numéro de téléphone :</label>
                        <input type="tel" name="phone" placeholder="01 23 45 67 89" maxlength="20" value="<?php echo $phone ?>">
                        <p class="error"><?php echo $errors['phone']; ?></p>
                    </div>

                </div>
                
                <div class="separator"></div>
                
                <div class="column">
                    <div class="field">
                        <label for="address">Adresse :</label>
                        <input type="text" name="address" placeholder="Entrez votre adresse ici" value="<?php echo $address ?>">
                        <p class="error"><?php echo $errors['address']; ?></p>
                    </div>

                    <div class="field">
                        <label for="addressComplement">Complément d'adresse* :</label>
                        <input type="text" name="addressComplement" placeholder="Exemple : Bâtiment J" value="<?php echo $addressComplement ?>">
                        <p class="error <?php if($errors['addressComplement'] == "") { echo 'information-field'; } ?>">
                            <?php echo $errors['addressComplement'];
                            if($errors['addressComplement'] == '') {
                                echo "*Ce champ n'est pas obligatoire.";
                            } ?>
                        </p>
                    </div>

                    <div class="field">
                        <label for="fname">Code Postal :</label>
                        <input type="number" name="postal" placeholder="30000" min="10000" max="99999" value="<?php echo $postal ?>">
                        <p class="error"><?php echo $errors['postal']; ?></p>
                    </div>
                    
                    <div class="field">
                        <label for="city">Ville :</label>
                        <input type="text" name="city" placeholder="Entrez le nom de votre ville ici" value="<?php echo $city ?>">
                        <p class="error"><?php echo $errors['city']; ?></p>
                    </div>
                </div>
                
            </div>
            
            <div class="submit-field">
                <input type="submit" name="submit" value="Suivant" class="button submit-button">
                <input type="submit" name="goback" value="Précédent" class="button border-button">
            </div>
            
        </form>

    </main>
    
</body>
</html>