<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <link rel="stylesheet" href="style.css">
    <title>Erreur - La Ronde de l'Espoir</title>
</head>
<body>

    <?php
        $prefix = '../';
        include('../modules/nav.php');
    ?>

    <main>
        <h3>Merci de participer à la Ronde de l'Espoir!</h3>
        <p>
            Cependant, nous rencontrons quelques problèmes techniques avec le formulaire pour les individus. <br> <br>
            Nous vous proposons donc de passer par l'option anonyme si vous souhaitez faire un don maintenant.
            Si vous souhaitez bénéficier de la déduction d'impôts, n'hésitez pas à revenir dans quelques jours.
        </p>
        <br>
        <br>
        <p class="final">Toutes nos excuses pour cet incident,</p>
        <p class="sign">Cordialement, <br> L'équipe de la Ronde de l'Espoir</p>

        <div class="button-wrapper">
            <a class="return-button" href="../choix/type/">Choisir une autre option</a>
        </div>
    </main>
    
</body>
</html>