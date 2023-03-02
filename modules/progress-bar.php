<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress bar test</title>
    <link rel="stylesheet" href="./progress-bar.css">
</head>
<body>
<div class="container">
        <ul class="progressbar">
            <li id="type-step">Choix du Type de don</li>
            <li id="infos-step">Informations sur vous</li>
            <li id="montant-step">Choix du Montant</li>
            <li id="paiement-step">Paiement</li>
            <li id="validation-step">Terminé !</li>
        </ul>
    </div>
    <script type="text/javascript">
        var currentPage = window.location.pathname.split('/').slice(-2, -1)[0]
        const typeStep = document.getElementById('type-step')
        const infoStep = document.getElementById('infos-step')
        const montantStep = document.getElementById('montant-step')
        const paiementStep = document.getElementById('paiement-step')
        const validationStep = document.getElementById('validation-step')
        if (<?php echo $_SESSION['isAnonymous'] ?> == true) {
            infoStep.classList.add('not-to-be-displayed');
        }
        if (currentPage == 'type'){
            typeStep.classList.add('active');
        } else if (currentPage == 'informations'){
            typeStep.classList.add('done');
            infoStep.classList.add('active');
        } else if (currentPage == 'montant'){
            typeStep.classList.add('done');
            infoStep.classList.add('done');
            montantStep.classList.add('active')
        } else if (currentPage == 'paiement'){
            typeStep.classList.add('done');
            infoStep.classList.add('done');
            montantStep.classList.add('done')
            paiementStep.classList.add('active')
        } else if (currentPage == 'validation'){
            typeStep.classList.add('done');
            infoStep.classList.add('done');
            montantStep.classList.add('done')
            paiementStep.classList.add('done')
            validationStep.classList.add('done')
        }
    </script>
</body>
</html>