<?
require_once('model/UserManager.php');
require_once('controller/mailController.php');

function authUser($login, $passwd)
{
    $userManager = new UserManager();
    $users = $userManager->getUser($login, "");

    if($user = $users->fetch())
    {
        if($login === $user['user_name'] && $user['account_valid'] == 1)
        {
            if(hash('whirlpool', $passwd) === $user['user_password'])
            {
                return(1);
            } else
            {
                return(2);
            }
        } else {
            return (0);
        }
    } else {
        return (0);
    }
}

function login($login, $passwd)
{
    $wrong = 0;
    
    if($login != '' && $passwd != '')
    {
        session_start();

        if (authUser($login, $passwd) === 1)
        {
            $_SESSION['loggued_on_user'] = $login;
            require('view/mainView.php');
        } else if (authUser($login, $passwd) === 2) {
            $_SESSION['loggued_on_user'] = '';
            $wrong_password = "Wrong password :(";
            require('view/userView.php');
        } else if (authUser($login, $passwd) === 0) {
            $_SESSION['loggued_on_user'] = '';
            $wrong_username = "Wrong username :(";
            require('view/userView.php');
        } else {
            echo("AUTH FAIL");
        }
    }
}

function verify($email, $hash)
{
    $userManager = new UserManager();
    $users = $userManager->getUser("", $email);

    if($user = $users->fetch())
    {
        if($email === $user['user_email'])
        {
            if($hash === $user['hash'])
            {
                $verify = $userManager->activateAccount($email);
                if ($verify == 1)
                {
                    $verifyMessage = "Account succesfully activated! You can now login :)";
                } else if ($verify == 2)
                {
                    $verifyMessage = "Account already verified, you may login with your credentials :)";
                }
                else
                {
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

function getAccountData()
{
    session_start();
    $userManager = new UserManager();
    $users = $userManager->getUser($_SESSION['loggued_on_user'], "");
    
    if ($user = $users->fetch())
    {
        if($_SESSION['loggued_on_user'] === $user['user_name'])
        {
            $user_data = array (
                'name' => $user['user_name'], 
                'email' => $user['user_email']
            );
        }
    }
    return($user_data);
}

function register($name, $email, $passwd, $cPassword)
{
    $userManager = new UserManager();
    $hash = hash("whirlpool", rand(0,1000));

    if($name != '' && $email != '' && $passwd != '' && $cPassword != '')
    {
        if ($passwd == $cPassword)
        {
            if ($userManager->saveUser($name, $email, $passwd, $hash) == 3)
            {
                $res = 3;
                sendEmail($name, $email, $hash);
            } 
            else if ($userManager->saveUser($name, $email, $passwd, $hash) == 2)
            {
                $res = 2;
            } else if ($userManager->saveUser($name, $email, $passwd, $hash) == 1)
            {
                $res = 1;
            } else {
                echo("Cannot save user");
            }
        } else {
            $res = 0;
        }
    }
    require('view/userView.php');
}

function modify($old_passwd, $name, $email, $new_passwd)
{
    session_start();
    $userManager = new UserManager();
    $username_message = '';
    $email_message = '';
    $password_message = '';
    $relog_message = '';
    $msg = '';

    if (authUser($_SESSION['loggued_on_user'], $old_passwd) == TRUE)
    {
        if($name || $email || $new_passwd)
        {
            if($name && $userManager->userExists($name) == 1)
            {
                $msg = "Incorrect password :/";
                require('view/userAccountView.php');
            }
            else if ($userManager->updateUser("", $_SESSION['loggued_on_user'], $name, $email, $new_passwd) == 1)
            {
                if ($name)
                    $username_message = "Username modified !";
                if ($email)
                    $email_message = "Email modified !";
                if($new_passwd)
                    $password_message = "Password modified !";
            }
            if ($email && !$name && !$new_passwd)
            {
                require("view/accountModifiedView.php");
            } 
            else 
            {
                if(session_start())
                {   
                    $_SESSION['loggued_on_user'] = '';
                }
                $relog_message = "Please login with your new credentials";
                require("view/accountModifiedView.php");
            }
        } else {
            $msg = "Nothing to modify :/";
            require('view/userAccountView.php');
        }
    } else {
        $msg = "Incorrect password :/";
        require('view/userAccountView.php');
    }
}

function verifyAccountForReset($email, $hash)
{
    $userManager = new UserManager();
    $users = $userManager->getUser("", $email);

    if($user = $users->fetch())
    {
        if($email === $user['user_email'])
        {
            if($hash === $user['hash'])
            {
                $verify = $userManager->activateAccount($email);
                if ($verify == 2)
                {
                    require('view/resetPasswordView.php');
                } 
                else
                {
                    $msg = "Something went wrong with your account verification, please ask for another email";
                    require('view/forgotPasswordView.php');
                }
            } 
        }
    }
}

function resetPassword($email, $hash, $r_password, $c_password)
{
    $userManager = new UserManager();
    $users = $userManager->getUser("", $email);
    $msg = "Could not reset password :/";

    if ($user = $users->fetch())
    {
        if ($user['hash'] == $hash)
        {
            if ($r_password == $c_password)
            {
                if ($userManager->updateUser($email, "", "", "", $r_password) == 1)
                {
                    $msg = "Password successfully modified!";
                }
            }
            else {
                $msg = "Passwords don't match :/";
            }
        }
    }
    require('view/resetPasswordView.php');
}

// function resend($name, $email, $hash)
// {
//     echo('RESEND' . $name);
//     sendEmail($name, $email, $hash);
//     require('view/userView.php');
// }