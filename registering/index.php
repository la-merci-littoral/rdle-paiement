<?php

    require('./tempo_db.php')

?>

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

    <script src="./form.js" defer></script>
    <title>Ronde de l'Espoir</title>
</head>
<body>

    <header>
        <div class="header-wrapper">
            
            <span class="title">La Ronde de l'Espoir</span>
            <span class="arrow">
                <a href="https://ronde-de-l-espoir.fr">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
            </span>

        </div>
    </header>
    
    <main>

        <form action="../index.php" method="POST">

            <div class="column-wrapper">

                <div class="column">

                    <div class="field">
                        <label for="fname" id="firstLabel">Nom :</label>
                        <input type="text" name="lname" placeholder="Entrez votre prénom ici">
                    </div>
                    
                    <div class="field">
                        <label for="lname">Prénom :</label>
                        <input type="text" name="fname" placeholder="Entrez votre prénom ici">
                    </div>
                    
                    <div class="field">
                        <label for="fname">Code Postal :</label>
                        <input type="number" name="code_postal" placeholder="30000" min="1" max="99999">
                    </div>
                    
                    <div class="field">
                        <label for="city">Ville :</label>
                        <input type="text" name="city" placeholder="Entrez le nom de votre ville ici">
                    </div>
                    
                    <div class="field">
                        <label for="email">Email :</label>
                        <input type="email" name="email" placeholder="Rentrez votre email ici">
                    </div>

                </div>

                <div class="separator"></div>
                <div class="column">

                    <input type="submit" name="anonymous" value="Continuer anonymement" class="anonyme-button">
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