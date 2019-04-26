<?php $title = 'Error'; ?>

<?php 
ob_start();
$errorMsg = $errorMessage;
$content = ob_get_clean();
?>

<?php require('view/template.php'); ?>