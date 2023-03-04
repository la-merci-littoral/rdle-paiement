<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="<?php echo $prefix . "modules/progress-bar.css" ?>" >
<ul class="progressbar">
    <li id="type-step">Choix du Type de don</li>
    <li id="infos-step">Informations sur vous</li>
    <li id="montant-step">Choix du Montant</li>
    <li id="paiement-step">Paiement</li>
    <li id="validation-step">Terminé !</li>
</ul>
<script type="text/javascript">
    var currentPage = window.location.pathname.split('/').slice(-2, -1)[0]
    const typeStep = document.getElementById('type-step')
    const infoStep = document.getElementById('infos-step')
    const montantStep = document.getElementById('montant-step')
    const paiementStep = document.getElementById('paiement-step')
    const validationStep = document.getElementById('validation-step')
    if (<?php echo $_SESSION['isAnonymous'] ? 'true' : 'false' ?> == true) {
        infoStep.classList.add('not-to-be-displayed');
    }
    if (currentPage === 'type') {
        typeStep.classList.add('active');
    } else if (currentPage == 'informations') {
        typeStep.classList.add('done');
        infoStep.classList.add('active');
    } else if (currentPage == 'montant') {
        typeStep.classList.add('done');
        infoStep.classList.add('done');
        montantStep.classList.add('active')
    } else if (currentPage == 'paiement') {
        typeStep.classList.add('done');
        infoStep.classList.add('done');
        montantStep.classList.add('done')
        paiementStep.classList.add('active')
    } else if (currentPage == 'validation') {
        typeStep.classList.add('done');
        infoStep.classList.add('done');
        montantStep.classList.add('done')
        paiementStep.classList.add('done')
        validationStep.classList.add('done')
    }
</script>