<?php $title = 'Error'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>

<?php 
$errorMsg = $errorMessage;
$content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>