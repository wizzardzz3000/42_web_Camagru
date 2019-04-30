<?

require_once('model/UserManager.php');

function user()
{
    require('view/userView.php');
}

function authUser($login, $passwd)
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();

    while ($user = $users->fetch())
    {
        if($login === $user['user_name'] && $user['account_valid'] == 1)
        {
            if(hash('whirlpool', $passwd) === $user['user_password'])
            {
                return(TRUE);
            } else
            {
                return(FALSE);
            }
        }
    }
}

function login($login, $passwd)
{
    $wrong = 0;
    
    if($login != '' && $passwd != '')
    {
        session_start();

        if (authUser($login, $passwd) === TRUE)
        {
            $_SESSION['loggued_on_user'] = $login;
            require('view/mainView.php');
        } else if (authUser($login, $passwd) === FALSE) {
            $_SESSION['loggued_on_user'] = '';
            $wrong = 1;
            $wrong_password = "Wrong password :(";
            require('view/userView.php');
        } else {
            echo("AUTH FAIL");
        }
    }
}

function verify($email, $hash)
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();

    while ($user = $users->fetch())
    {
        if($email === $user['user_email'])
        {
            if($hash === $user['hash'])
            {
                $verify = $userManager->activateAccount($email);
                if ($verify == 1)
                {
                    $verifyMessage = "Account succesfully activated! You can now login :)";
                } else {
                    $verifyMessage = "Something went wrong :(";
                }
            } 
        }
    }
    require('view/userView.php');
}

function logout()
{
    if(session_start())
    {   
        $_SESSION['loggued_on_user'] = '';
        header("Location: index.php");
    }
}

function account()
{
    $userManager = new UserManager();
    $users = $userManager->getUsers();

    session_start();
    
    while ($user = $users->fetch())
    {
        if($_SESSION['loggued_on_user'] === $user['user_name'])
        {
            $user_name = $user['user_name'];
            $user_email = $user['user_email'];
            require('view/userAccountView.php');
        }
    }
}

function register($name, $email, $passwd, $cPassword)
{
    $userManager = new UserManager();
    $hash = hash("whirlpool", rand(0,1000));
    $res = 0;

    if($name != '' && $email != '' && $passwd != '' && $cPassword != '')
    {
        if ($passwd == $cPassword)
        {
            if ($userManager->saveUser($name, $email, $passwd, $hash) == 1)
            {
                $res = 1;
                sendEmail($name, $email, $hash);
            } 
            else if ($userManager->saveUser($name, $email, $passwd, $hash) == 2)
            {
                $res = 2;
            } else {
                echo("Cannot save user");
            }
        } else {
            $res = 3;
        }
    }
    require('view/userView.php');
}

function sendEmail($name, $email, $hash)
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

// function resend($name, $email, $hash)
// {
//     echo('RESEND' . $name);
//     sendEmail($name, $email, $hash);
//     require('view/userView.php');
// }