<?php 
    // Check if $dots variable is not set
    if (!isset($dots)) {
        $dots = '../'; // Set $dots to '../' if it's not set
    }
?>

<link rel="stylesheet" href="<?php echo $dots ?>modules/help.css">
<script src="<?php echo $dots ?>modules/help.js" defer></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<body>

    <div class="help-widget" onclick="window.location = '<?php echo $prefix ?>reinit.php'">
        <span class="material-symbols-outlined">question_mark</span>
        <span class="help-text">Vous rencontrez un problème ? Cliquez ici.<br><br>⚠️ Ceci réinitialisera le formulaire<div class="pointer"></div> </span>
    </div>

</body>