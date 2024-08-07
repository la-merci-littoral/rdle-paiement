<link rel="stylesheet" href="<?php echo $prefix . "modules/progress-style.css" ?>">
<!-- <script src="../modules/progress.js" defer></script> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<div class="progress-bar">
    <ul id="progress-steps">

        <?php
        
        // Check if session is not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        $successStatus = ["", ""];
        $paymentStatus = ["", ""];
        $amountStatus = ["", ""];
        $infoStatus = ["", ""];


        // Verify which class to add to each step based on the current page
        if ($currentPage == "success") {
            $successStatus = ["current-text", "current"];
            $paymentStatus = ["done-text", "done"];
            $amountStatus = ["done-text", "done"];
            $infoStatus = ["done-text", "done"];
        } elseif ($currentPage == "payment") {
            $paymentStatus = ["current-text", "current"];
            $amountStatus = ["done-text", "done"];
            $infoStatus = ["done-text", "done"];
        } elseif ($currentPage == "amount") {
            $amountStatus = ["current-text", "current"];
        } elseif ($currentPage == "info") {
            $infoStatus = ["current-text", "current"];
            $amountStatus = ["done-text", "done"];
        }
        
        // Check if user is not anonymous
        if ($_SESSION['isAnonymous'] == false) { ?>
            
            <li class="step <?php echo $amountStatus[0] ?>"><span class="<?php echo $amountStatus[1] ?> numeric-indicator">1</span><span class="section-info">Montant</span></li>
            <li class="logic-component"><span class="material-symbols-outlined progress-child">navigate_next</span></li>

            <li class="step <?php echo $infoStatus[0] ?>"><span class="<?php echo $infoStatus[1] ?> numeric-indicator">2</span><span class="section-info">Informations</span></li>
            <li class="logic-component"><span class="material-symbols-outlined progress-child">navigate_next</span></li>
            
            
            <li class="step <?php echo $paymentStatus[0] ?>"><span class="<?php echo $paymentStatus[1] ?> numeric-indicator">3</span><span class="section-info">Paiement</span></li>
            <li class="logic-component"><span class="material-symbols-outlined progress-child">navigate_next</span></li>
            
            <li class="step <?php echo $successStatus[0] ?>"><span class="<?php echo $successStatus[1] ?> numeric-indicator">4</span><span class="section-info">Terminé !</span></li>

        <?php } else { ?>

            <li class="step <?php echo $amountStatus[0] ?>"><span class="<?php echo $amountStatus[1] ?> numeric-indicator">1</span><span class="section-info">Montant</span></li>
            <li class="logic-component"><span class="material-symbols-outlined progress-child">navigate_next</span></li>
            
            <li class="step <?php echo $paymentStatus[0] ?>"><span class="<?php echo $paymentStatus[1] ?> numeric-indicator">2</span><span class="section-info">Paiement</span></li>
            <li class="logic-component"><span class="material-symbols-outlined progress-child">navigate_next</span></li>
            
            <li class="step <?php echo $successStatus[0] ?>"><span class="<?php echo $successStatus[1] ?> numeric-indicator">3</span><span class="section-info">Terminé !</span></li>

        <?php } ?>
    </ul>
</div>