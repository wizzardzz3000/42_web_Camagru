<?
require_once $_SERVER['DOCUMENT_ROOT'].'/model/UserManager.php';

// CHECK IF NOTIFICATION NEEDS TO BE SENT
// ---------------------------------------------------------------
function checkForEmailNotification($kind, $picture_id)
{
    $userManager = new UserManager();
    $pictureManager = new PictureManager();

    $users = $userManager->getUsers();
    $pictures = $pictureManager->getPictures("");

    $user = $users->fetchAll();
    $picture = $pictures->fetchAll();

    if ($user && $picture && $kind != '' && $picture_id > 0)
    {
        for ($i = 0; $picture[$i]; $i++)
        {
            if ($picture_id == $picture[$i]['picture_id'])
            {
                $picture_was_taken_by = $picture[$i]['user_id'];
            }
        }
        for ($i = 0; $user[$i]; $i++)
        {
            if ($picture_was_taken_by == $user[$i]['user_id'])
            {
                if ($user[$i]['notifications'] == 1)
                {
                    $name = $user[$i]['user_name'];
                    $email = $user[$i]['user_email'];
                    sendNotificationEmail($kind, $name, $email, $picture_id);   
                }
            }
        }
    }
}

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

// SEND EMAIL FOR NOTIFICATION
// ---------------------------------------------------------------
function sendNotificationEmail($kind, $name, $email, $picture_id)
{
    if ($kind == "like")
    {
        $subject = 'New like on your picture!';
        $sentence_1 = 'Someone liked your picture! ';
    }
    if ($kind == "comment")
    {
        $subject = 'New comment on your picture!';
        $sentence_1 = 'Someone left a comment on your picture! ';
    }

    $to = $email;
    $message = '
    
    Hello '.$name.'!
    '.$sentence_1.'
    
    Click here to check it:
    http://localhost:8100//index.php?view=picture&id='.$picture_id.'
    
    ';
                        
    $headers = 'From:noreply@camagru.com' . "\r\n";
    mail($to, $subject, $message, $headers);
}