<?php

    if ($page == "registering") {
        $url = "../choosing";
    } else if ($page == "paiement") {
        $url = "";
    } else {
        $url = "https://ronde-de-l-espoir.fr";
    }

?>

<link rel="stylesheet" href="../modules/nav-style.css">
<link rel="stylesheet" href="./modules/nav-style.css">
<header>
    <div class="header-wrapper">
        
        <span class="title">La Ronde de l'Espoir</span>
        <span class="arrow">
            <a href="<?php echo $url ?>">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
        </span>

    </div>
</header>