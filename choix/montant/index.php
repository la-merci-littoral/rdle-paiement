<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['isAnonymous'])) {
    header('Location: ../../');
}

require('../../../db_config.php');    
$currentPage = 'amount';
$prefix = "../../";

$amount = isset($_SESSION['amount_donated']) ? $_SESSION['amount_donated'] : "";

$error = '';

if (isset($_POST['goback'])) {
    $_SESSION['amount_donated'] = $_POST['amount'];
    header('Location: ../type');
} elseif (isset($_POST['submit'])) {

    if (empty($_POST['amount'])) {
        $error = 'Une contribution est requise.';
        $amount = '';
    } else {
        $amount = $_POST['amount'];
        $_SESSION['amount_donated'] = $_POST['amount'];
        if (!preg_match('/^[0-9]*$/', $amount) || ($amount < 0)) {
            $error = 'Veuillez rentrez une contribution valide.';
            $_SESSION['amount_error'] = true;
        } else {
            $_SESSION['amount_error'] = false;
        }
    }

    if (empty($error)) {

        // check for dangerous MySQL code
        // $_SESSION['amount_donated'] = mysqli_real_escape_string($conn, $amount);

        if ($_SESSION['isAnonymous']) {
            header('Location: ../../paiement');
        } elseif ($_SESSION['isCompany']) {
            header('Location: ../../informations/entreprise/');
        } else {
            header('Location: ../../informations/individu');
        }
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
    <link rel="shortcut icon" href="../../img/LRDE-logo.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script>
        const isAnonymous = '<?php 
            if ($_SESSION['isAnonymous'] == true){
                echo 'true';
            } else {
                echo 'false';
            }
        ?>'
        const taxEvasionPercentage = '<?php
            if ($_SESSION['isCompany'] == true){
                $taxEvasionPercentage = 60;
            } elseif ($_SESSION['isCompany'] == false){
                $taxEvasionPercentage = 66;
            }
            echo $taxEvasionPercentage;
        ?>'
    </script>
    <script src="./app.js" defer></script>
    <title>Choix du Montant - Ronde de l'Espoir</title>
</head>

<body>

    <?php
    require('../../modules/nav.php');
    $dots = '../../';
    ?>

    <main>
        <form method="POST" action="./index.php">
            <?php include('../../modules/progress.php'); ?>

            <div class="form-separation"></div>
            <div class="column-wrapper">
                <div class="column" id="input-column">
                    <div class="field">
                        <p>Je donne : <input type="number" name="amount" id="free-choice" placeholder="" min="0" max="100000" value="<?php echo $amount ?>">€</p>
                        <p class="error"><?php echo $error; ?></p>
                        <div class="suggestions">
                            <ul>
                                <li><button type="button" class="suggested-amount" onclick="inputSuggestedAmount(10, input)">10€</button></li>
                                <li><button type="button" class="suggested-amount" onclick="inputSuggestedAmount(15, input)">15€</button></li>
                                <li><button type="button" class="suggested-amount" onclick="inputSuggestedAmount(30, input)">30€</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="transparency">
                        <h4>Sur mes <span class="amount-display">#</span>€ :</h4>
                        <ul>
                            <li id="tax-deduction"> - <span class="amount-display">#</span>€ sont déductibles de vos impôts!</li>
                            <li id="assoc-display"> - <span class="amount-display" id="assoc-amount">#</span>€ partent pour <a href="https://ronde-de-l-espoir.fr/infos/dmf-34" target="_blank">DMF34</a>, l'association que nous supportons.</li>
                            <li id="stripe-display"> - <span class="amount-display" id="stripe-amount">#</span>€ de commission <a href="https://stripe.com/fr" target="_blank">Stripe</a>.</li>
                        </ul>
                    </div>
                </div>
                <div class="separation"></div>
                <div class="column">
                    <div class="tax-deduction-infos">
                        <h3>Pouvez-vous bénéficier d'une déduction d'impôts?</h3>
                        <?php if ($_SESSION['isAnonymous'] == false) { ?>
                            <p>
                                Pour être éligible à la déduction d'impôts, vous devez remplir 3 conditions :
                            <ul>
                                <li>
                                    1. Vous donnez 10€ ou plus.
                                </li>
                                <li>
                                    2. Les informations <?php if ($_SESSION['isCompany'] == true){
                                        echo 'sur l\'entreprise';
                                    } else {
                                        echo 'personnelles';
                                    }
                                    ?> fournies à la page suivante sont correctes.
                                </li>
                            </ul>
                            </p>
                            <p>
                                Si ces conditions sont remplies, 
                                <ul>
                                    <li>- Vous bénéficiez d'une déduction d'impôts à hauteur de <b><?php echo $taxEvasionPercentage ?>% du montant versé</b>.</li>
                                    <li>- Vous recevrez l'attestation de donation dans quelles semaines de la part de DMF34 directement.</li>
                                </ul>
                            </p>
                        <?php } else { ?>
                            <div style="height: 4px;"></div>
                            <p>Vous ne pourrez pas bénéficier d'une déduction d'impôts.</p>
                            <p>Si vous souhaitez en bénéficier d'une, choissisez "<i>Participer en tant qu'individu.</i>" ou "<i>Participer en tant qu'entreprise.</i>" sur <a href="../type">la page précédente</a>.
                            </p>
                        <?php } ?>
                        <div class="more-details">
                            <p><b>Pour plus de détails, rendez-vous sur notre <a href="https://ronde-de-l-espoir.fr/faq">FAQ</a> ou sur le <a href="<?php 
                                if ($_SESSION['isCompany'] == false){
                                    echo 'https://www.impots.gouv.fr/particulier/questions/jai-fait-des-dons-une-association-que-puis-je-deduire';
                                } else {
                                    echo 'https://www.economie.gouv.fr/entreprises/mecenat-dons-entreprise#:~:text=M%C3%A9c%C3%A9nat%20d%27entreprise%20%3A%20avantages%20fiscaux';
                                } ?>">site officiel du gouvernement.</a></b></p>
                        </div>
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
    require('../../modules/help.php');
    ?>

</body>
</html>
