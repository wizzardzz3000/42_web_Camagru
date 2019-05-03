<?
require_once('model/UserManager.php');

// SEND EMAIL FOR ACCOUNT VERIFICATION
// ---------------------------------------------------------------
function sendAccountVerificationEmail($name, $email, $hash)
{
    $to = $email;
    $subject = 'Activate your Camagru account';
    $message = '
    
    Hello '.$name.'!
    Your Camagru account has been created. 
    
    Please click this link to activate your account:
    http://localhost:8100/index.php?action=verify&email='.$email.'&hash='.$hash.'
    
    ';
                        
    $headers = 'From:noreply@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers);
}

// SEND EMAIL FOR PASSWORD RESET
// ---------------------------------------------------------------
function sendPasswordResetEmail($email)
{
    $userManager = new UserManager();
    $user_req = $userManager->getUser("", $email);
    
    if ($user = $user_req->fetch())
    {
        $hash = $user['hash'];
        $to = $email;
        $subject = 'Reset your Camagru password';
        $message = '
        
        Hi there! Did you forget how to log in to your Camagru account? :(
        
        Please click this link to reset your password:
        http://localhost:8100/index.php?action=verifyAccountForReset&email='.$email.'&hash='.$hash.'
        
        ';
                            
        $headers = 'From:noreply@camagru.com' . "\r\n";
        mail($to, $subject, $message, $headers);
        
        $msg = "A link to reset your password was sent to your email address!";
    } else {
        $msg = "Sorry, there is not account for this email address :/";
    }
    
    require('view/forgotPasswordView.php');
}