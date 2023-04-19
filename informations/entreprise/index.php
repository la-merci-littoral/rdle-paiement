<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['isAnonymous']) || !isset($_SESSION['amount_donated']) || $_SESSION['amount_error']) {
        header('Location: ../../choix/montant/');
    }

    if (!$_SESSION['isCompany']) {
        header('Location: ../../');
    }

    require('./company-id-check.php');

    $currentPage = 'info';
    $prefix = "../../";


    require('../../config/insee_api.php');

    $_SESSION['info_error'] = false;

    $companyName = isset($_SESSION['companyName']) ? $_SESSION['companyName'] : "";
    $companySIREN = isset($_SESSION['companySIREN']) ? $_SESSION['companySIREN'] : "";
    $companySIRET = isset($_SESSION['companySIRET']) ? $_SESSION['companySIRET'] : "";
    $companyContactAddress = isset($_SESSION['companyContactAddress']) ? $_SESSION['companyContactAddress'] : "";
    $companyAddress = isset($_SESSION['companyAddress']) ? $_SESSION['companyAddress'] : "";
    $companyAddressComplement = isset($_SESSION['companyAddressComplement']) ? $_SESSION['companyAddressComplement'] : "";
    $companyPostal = isset($_SESSION['companyPostal']) ? $_SESSION['companyPostal'] : "";
    $companyCity = isset($_SESSION['companyCity']) ? $_SESSION['companyCity'] : "";

    $errors = array(
        'companyName'=>'',
        'companySIREN'=>'',
        'companySIRET'=>'',
        'companyContactAddress'=>'',
        'companyAddress'=>'',
        'companyAddressComplement'=>'',
        'companyPostal'=>'',
        'companyCity'=>''
    );

    if (isset($_POST['goback'])) {
        $_SESSION['companyName'] = isset($_POST['companyName']) ? $_POST['companyName'] : "";
        $_SESSION['companySIREN'] = isset($_POST['companySIREN']) ? $_POST['companySIREN'] : "";
        $_SESSION['companySIRET'] = isset($_POST['companySIRET']) ? $_POST['companySIRET'] : "";
        $_SESSION['companyContactAddress'] = isset($_POST['companyContactAddress']) ? $_POST['companyContactAddress'] : "";
        $_SESSION['companyAddress'] = isset($_POST['companyAddress']) ? $_POST['companyAddress'] : "";
        $_SESSION['companyAddressComplement'] = isset($_POST['companyAddressComplement']) ? $_POST['companyAddressComplement'] : "";
        $_SESSION['companyPostal'] = isset($_POST['companyPostal']) ? $_POST['companyPostal'] : "";
        $_SESSION['companyCity'] = isset($_POST['companyCity']) ? $_POST['companyCity'] : "";
        
        header("Location: ../../choix/montant/");
    }

    if (isset($_POST['submit'])) {

        if (empty($_POST['companyName'])) {
            $errors['companyName'] = "Une dénomination sociale est requise.";
        } else {
            $companyName = $_POST['companyName'];
            $_SESSION['companyName'] = $_POST['companyName'];
            if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 \-_.,']*$/", $companyName)) {
                $errors['companyName'] = "Dénomination sociale invalide.";
                $_SESSION['info_error'] = true;
            }
        }
        
        if (empty($_POST['companySIREN'])) {
            $errors['companySIREN'] = "Un numéro SIREN est nécessaire.";
        } else {
            $companySIREN = $_POST['companySIREN'];
            $_SESSION['companySIREN'] = $_POST['companySIREN'];
            
            $sirenStatus = verifySIREN($inseeAPIKey, $companySIREN);
            if ($sirenStatus == 200) {
                echo '';
            } elseif ($sirenStatus == 404) {
                $errors['companySIREN'] = "Ce numéro SIREN n'existe pas.";
            } elseif ($sirenStatus == 400) {
                $errors['companySIREN'] = "Ce numéro SIREN n'est pas valide.";
            } else {
                $errors['companySIREN'] = "Une erreur inattendue est survenue.";
            }
        }
        
        if (empty($_POST['companySIRET'])) {
            $errors['companySIRET'] = "Un numéro SIRET est requis.";
        } else {
            $companySIRET = $_POST['companySIRET'];
            $_SESSION['companySIRET'] = $_POST['companySIRET'];

            $siretStatus = verifySIRET($inseeAPIKey, $companySIRET);
            if ($siretStatus == 200) {
                echo '';
            } elseif ($siretStatus == 404) {
                $errors['companySIRET'] = "Ce numéro SIRET n'existe pas.";
            } elseif ($siretStatus == 400) {
                $errors['companySIRET'] = "Ce numéro SIRET n'est pas valide.";
            } else {
                $errors['companySIRET'] = "Une erreur inattendue est survenue.";
            }
        }
        
        if (empty($_POST['companyContactAddress'])) {
            $errors['companyContactAddress'] = "Une adresse E-mail est requise.";
        } else {
            $companyContactAddress = $_POST['companyContactAddress'];
            $_SESSION['companyContactAddress'] = $_POST['companyContactAddress'];
            if (!filter_var($companyContactAddress, FILTER_VALIDATE_EMAIL)) {
                $errors['companyContactAddress'] = "E-mail invalide.";
                $_SESSION['info_error'] = true;
            }
        }
        
        if (empty($_POST['companyAddress'])) {
            $errors['companyAddress'] = "Une adresse est requise.";
        } else {
            $companyAddress = $_POST['companyAddress'];
            $_SESSION['companyAddress'] = $_POST['companyAddress'];

            if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 œ_\-,']*$/", $companyAddress)) {

                $errors['companyAddress'] = "Adresse invalide.";
                $_SESSION['info_error'] = true;
            }
        }
        
        if (!empty($_POST['companyAddressComplement'])) {
            $companyAddressComplement = $_POST['companyAddressComplement'];
            $_SESSION['companyAddressComplement'] = $_POST['companyAddressComplement'];



            if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 œ_\-,']*$/", $companyAddressComplement)) {

                $errors['companyAddressComplement'] = "Complément d'adresse invalide.";
                $_SESSION['info_error'] = true;
            }
        }
        
        if (empty($_POST['companyPostal'])) {
            $errors['companyPostal'] = "Un code postal est requis.";
        } else {
            $companyPostal = $_POST['companyPostal'];
            $_SESSION['companyPostal'] = $_POST['companyPostal'];
            if (!preg_match('/^[0-9]{5}/', $companyPostal)) {
                $errors['companyPostal'] = "Code postal invalide.";
                $_SESSION['info_error'] = true;
            }
        }
        
        if (empty($_POST['companyCity'])) {
            $errors['companyCity'] = "Une ville est requise.";
        } else {
            $companyCity = $_POST['companyCity'];
            $_SESSION['companyCity'] = $_POST['companyCity'];

            if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ0-9 œ_\-,']*$/", $companyCity)) {

                $errors['companyCity'] = "Nom de ville invalide.";
                $_SESSION['info_error'] = true;
            }
        }
        
        // saves errors in SESSION for check in payment
        $_SESSION['info_error'] = $errors;
        
        if (!array_filter($errors)) {
            // check for dangerous MySQL code
            $_SESSION['companyName'] = mysqli_real_escape_string($conn, $companyName);
            $_SESSION['companySIREN'] = mysqli_real_escape_string($conn, $companySIREN);
            $_SESSION['companySIRET'] = mysqli_real_escape_string($conn, $companySIRET);
            $_SESSION['companyContactAddress'] = mysqli_real_escape_string($conn, $companyContactAddress);
            $_SESSION['companyAddress'] = mysqli_real_escape_string($conn, $companyAddress);
            $_SESSION['companyAddressComplement'] = mysqli_real_escape_string($conn, $companyAddressComplement);
            $_SESSION['companyPostal'] = mysqli_real_escape_string($conn, $companyPostal);
            $_SESSION['companyCity'] = mysqli_real_escape_string($conn, $companyCity);
            
            $_SESSION['submit'] = true;
            header('Location: ../../paiement');
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
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../../img/LRDE-logo.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="./verify-data.js"></script>

    <title>Renseignement des Informations - Ronde de l'Espoir</title>
</head>
<body>

    <?php require('../../modules/nav.php') ?>

    
    <main>
        
        <form action="./index.php" method="POST">
            
            <?php include('../../modules/progress.php'); ?>
            
            <div class="progress-separation"></div>
            
            <div class="column-wrapper">

                <div class="column">

                    <div class="field">
                        <label for="companyName">Dénomination sociale :</label>
                        <input type="text" name="companyName" placeholder="Entrez votre dénomination sociale ici" value="<?php echo $companyName ?>">
                        <p class="error"><?php echo $errors['companyName']; ?></p>
                    </div>
                    
                    <div class="field">
                        <label for="companySIREN">Numéro SIREN :</label>
                        <input type="text" name="companySIREN" placeholder="Ex : 123 456 789" value="<?php echo $companySIREN ?>">
                        <p class="error"><?php echo $errors['companySIREN']; ?></p>
                    </div>
                    
                    <div class="field">
                        <label for="companySIRET">Numéro SIRET :</label>
                        <input type="text" name="companySIRET" placeholder="Ex : 123 456 789 54321" value="<?php echo $companySIRET ?>">
                        <p class="error"><?php echo $errors['companySIRET']; ?></p>
                    </div>

                    <div class="field">
                        <label for="companyContactAddress">Contact E-mail :</label>
                        <input type="email" name="companyContactAddress" placeholder="Entrez une adresse de contact" value="<?php echo $companyContactAddress ?>">
                        <p class="error"><?php echo $errors['companyContactAddress']; ?></p>
                    </div>

                </div>
                
                <div class="separator"></div>
                
                <div class="column">

                    <div class="field">
                        <label for="companyAddress">Adresse du siège social :</label>
                        <input type="text" name="companyAddress" placeholder="Entrez l'adresse du siège social ici" value="<?php echo $companyAddress ?>">
                        <p class="error"><?php echo $errors['companyAddress']; ?></p>
                    </div>

                    <div class="field">
                        <label for="companyAddressComplement">Complément d'adresse* :</label>
                        <input type="text" name="companyAddressComplement" placeholder="Entrez un complément d'adresse" value="<?php echo $companyAddressComplement ?>">
                        <p class="error <?php if($errors['companyAddressComplement'] == "") { echo 'information-field'; } ?>">
                            <?php echo $errors['companyAddressComplement'];
                            if($errors['companyAddressComplement'] == '') {
                                echo "*Ce champ n'est pas obligatoire.";
                            } ?>
                        </p>
                    </div>
                    
                    <div class="field">
                        <label for="companyPostal">Code Postal :</label>
                        <input type="number" name="companyPostal" placeholder="Ex : 10000" min="10000" max="99999" value="<?php echo $companyPostal ?>">
                        <p class="error"><?php echo $errors['companyPostal']; ?></p>
                    </div>

                    <div class="field">
                        <label for="companyCity">Ville :</label>
                        <input type="text" name="companyCity" placeholder="Entrez la ville du siège social" value="<?php echo $companyCity ?>">
                        <p class="error"><?php echo $errors['companyCity']; ?></p>
                    </div>
                </div>
                
            </div>
            
            <div class="submit-field">
                <input type="submit" name="submit" value="Suivant" class="button submit-button">
                <input type="submit" name="goback" value="Précédent" class="button border-button">
            </div>
            
        </form>

    </main>

    <?php
        $dots = "../../";
        include('../../modules/help.php');
    ?>

    
</body>
</html>
