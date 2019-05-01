<?
require_once('model/UserManager.php');

function resetPassword()
{
    
}

function sendPasswordResetEmail($name, $email, $hash)
{
    $to = $email;
    $subject = 'Reset your Camagru password';
    $message = '
    
    Hello '.$name.'!
    
    Please click this link to reset your password:
    http://localhost:8100/index.php?action=resetPassword&email='.$email.'
    
    ';
                        
    $headers = 'From:noreply@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers);
}