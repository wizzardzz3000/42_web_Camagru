<?php 
ob_start();
$errorMsg = $errorMessage;
$content = ob_get_clean();
require('view/template.php');