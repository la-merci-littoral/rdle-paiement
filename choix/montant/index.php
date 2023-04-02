<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['isAnonymous'])) {
        header('Location: ../../');
    }

    require('../../config/db_connect.php');    
    $currentPage = 'amount';
    $prefix = "../../";
    
    $amount = isset($_SESSION['amount']) ? $_SESSION['amount'] : "";

    $error = '';

    if (isset($_POST['goback'])) {
        header('Location: ../type');
    } elseif (isset($_POST['submit'])) {

        if (empty($_POST['amount'])) {
            $error = 'Une contribution est requise.';
            $amount = '';
        } else {
            $amount = $_POST['amount'];
            $_SESSION['amount'] = $_POST['amount'];
            if (!preg_match('/^[0-9]*$/', $amount) || ($amount < 0)) {
                $error = 'Veuillez rentrez une contribution valide.';
                $_SESSION['amount_error'] = true;
            } else {
                $_SESSION['amount_error'] = false;
            }
        }

        if (empty($error)) {

            // check for dangerous MySQL code
            $_SESSION['amount'] = mysqli_real_escape_string($conn, $amount);

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
                            <li id="tax-deduction"> - <span class="amount-display">#</span>€ sont déductibles de mes impôts!</li>
                            <li id="assoc-display"> - <span class="amount-display" id="assoc-amount">#</span>€ partent aux <a href="#">associations</a> que nous supportons.</li>
                            <li id="stripe-display"> - <span class="amount-display" id="stripe-amount">#</span>€ partent chez <a href="#">Stripe</a>.</li>
                        </ul>
                    </div>
                </div>
                <div class="separation"></div>
                <div class="column">
                    <div class="tax-deduction-infos">
                        <h3>Pouvez-vous bénéficier d'une déduction d'impôts?</h3>
                        <p>
                            Pour être élligible à la déduction d'impôts, vous devez remplir 3 conditions :
                            <ul>
                                <li>
                                    - Vous avez séléctionner "<i>Participer en tant qu'individu.</i>" sur
                                    <a href="../choix/type">cette page</a>.
                                </li>
                                <li>
                                    - Vous avez fait un don de 10€ ou plus.
                                </li>
                                <li>
                                    - Vous avez correctement rempli le formulaire de la page précédente.
                                </li>
                            </ul>
                        </p>
                        <p>
                            Si vous remplissez ces conditions, alors dans les semaines suivant votre donation vous recevrez
                            une attestation de donation. <br> Le montant qui pourra être déduit est disponible sur cette page.
                        </p>
                        <div class="more-details">
                            <p><b>Pour plus de détails, rendez-vous sur notre <a href="#">FAQ</a> ou sur le <a href="https://www.impots.gouv.fr/particulier/questions/jai-fait-des-dons-une-association-que-puis-je-deduire">site officiel du gouvernement.</a></b></p>
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