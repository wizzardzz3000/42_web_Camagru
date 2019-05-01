<?
require_once('model/UserManager.php');

function sendPasswordResetEmail($email)
{
    $to = $email;
    $subject = 'Reset your Camagru password';
    $message = '
    
    Hi there! Did you forget how to log in to your Camagru account? :(
    
    Please click this link to reset your password:
    http://localhost:8100/index.php?action=resetPassword&email='.$email.'
    
    ';
                        
    $headers = 'From:noreply@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers);
}