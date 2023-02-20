<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../../main/img/LRDE-logo.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Ronde de l'Espoir</title>
</head>
<body>

    <?php
        $page = "choosing";
        require('../modules/nav.php');
    ?>

    <main>
        <ul>
            <li id="individual">
                <p> Je participe <span class="highlight">maintenant</span>!</p>
                <div><a class="material-symbols-outlined" href="../registering/">arrow_forward_ios </a></div>
            </li>
            <li id="individual anonymous">
                <p> Je souhaite participer <span class="highlight">anonymement</span>.</p>
                <div><a class="material-symbols-outlined" href="#">arrow_forward_ios </a></div>
            </li>
            <li id="company">
                <p> Participer en tant qu'<span class="highlight">entreprise</span>.</p>
                <div><a class="material-symbols-outlined" href="#">arrow_forward_ios </a></div>
            </li>
        </ul>
    </main>


</body>