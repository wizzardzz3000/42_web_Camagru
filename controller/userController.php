<?
require_once $_SERVER['DOCUMENT_ROOT'].'/model/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/mailController.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/pictureController.php';

// LOG USER IN
// ---------------------------------------------------------------
function login($login, $passwd)
{
    $wrong = 0;
    
    if($login != '' && $passwd != '')
    {
        session_start();

        if (authUser($login, $passwd) === 1)
        {
            $_SESSION['loggued_on_user'] = $login;
            showMainView();
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

// LOG USER OUT
// ---------------------------------------------------------------
function logout()
{
    if(session_start())
    {   
        $_SESSION['loggued_on_user'] = '';
        header("Location: index.php");
    }
}

// VERIFY USER ACCOUNT
// ---------------------------------------------------------------
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
                // VERIFY ACCOUNT
                $verify = $userManager->activateAccount($email);
                if ($verify == 1)
                {
                    $verifyMessage = "Account succesfully activated! You can now login :)";
                } 
                // ACCOUNT ALREADY VERIFIED
                else if ($verify == 2)
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

// GET ACCOUNT DATA FOR THE ACCOUNT VIEW TO DISPLAY
// ---------------------------------------------------------------
function getAccountData()
{
    session_start();
    $userManager = new UserManager();
    $galleryManager = new PictureManager();
    $users = $userManager->getUser($_SESSION['loggued_on_user'], "");
    $gallery = $galleryManager->getPictures("");
    $pictures_taken = 0;
    
    if ($user = $users->fetch())
    {
        if($_SESSION['loggued_on_user'] === $user['user_name'])
        {
            while ($data = $gallery->fetch())
            {
                if($data['user_id'] == $user['user_id'])
                {
                    $pictures_taken++;
                }
            } 
            $user_data = array (
                'name' => $user['user_name'], 
                'email' => $user['user_email'],
                'user_id' => $user['user_id'],
                'pictures_taken' => $pictures_taken,
                'account_valid' => $user['account_valid'],
                'notifications' => $user['notifications']
                // etc....
            );
        }
    }
    return($user_data);
}

// REGISTER USER
// ---------------------------------------------------------------
function register($name, $email, $passwd, $cPassword)
{
    $userManager = new UserManager();
    $hash = hash("whirlpool", rand(0,1000));

    if($name != '' && $email != '' && $passwd != '' && $cPassword != '')
    {
        if ($passwd == $cPassword)
        {
            // SUCCESS
            if ($userManager->saveUser($name, $email, $passwd, $hash) == 3)
            {
                $res = 3;
                sendAccountVerificationEmail($name, $email, $hash);
            } 
            // EMAIL ALREADY TAKEN
            else if ($userManager->saveUser($name, $email, $passwd, $hash) == 2)
            {
                $res = 2;
            }
            // USERNAME ALREADY TAKEN
            else if ($userManager->saveUser($name, $email, $passwd, $hash) == 1)
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

// AUTHORIZE USER LOGIN
// ---------------------------------------------------------------
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

// MODIFY USER DATA
// ---------------------------------------------------------------
function modify($old_passwd, $name, $email, $new_passwd, $new_passwd_confirmation)
{
    session_start();
    $userManager = new UserManager();
    $username_message = '';
    $username_error_message = '';
    $email_message = '';
    $email_error_message = '';
    $password_message = '';
    $password_error_message = '';
    $relog_message = '';

    // Check password
    if (authUser($_SESSION['loggued_on_user'], $old_passwd) == 1)
    {
        // Check that fields are not empty
        if ($name || $email || ($new_passwd && $new_passwd_confirmation))
        {
            // Check name
            if ($name && $userManager->userExists($name, "") == 1)
            {
                $username_error_message = "Sorry, this user name is already taken :/";
                $problem = 1;
            }
            // Check email
            if ($email && $userManager->userExists("", $email) == 2)
            {
                $email_error_message = "Sorry, this email address is already linked to an existing account :/";
                $problem = 1;
            }
            // Check new password
            if ($new_passwd && $new_passwd_confirmation)
            {
                if ($new_passwd != $new_passwd_confirmation)
                {
                    $password_error_message = "Sorry, passwords don't match :/";
                    $problem = 1;
                }
            }
            // Everything's fine
            if ($problem != 1)
            {
                // Save the new data and prepare messages
                if ($userManager->updateUser("", $_SESSION['loggued_on_user'], $name, $email, $new_passwd) == 1)
                {
                    if ($name)
                        $username_message = "Username modified !";
                    if ($email)
                        $email_message = "Email modified !";
                    if ($new_passwd)
                        $password_message = "Password modified !";

                    $data_saved = 1;
                }
                // Do not log user out if only the email was changed
                if ($email && !$name && !$new_passwd && $data_saved == 1)
                {
                    require("view/accountModifiedView.php");
                } 
                // Log user out if name or password were changed
                else if ($data_saved == 1)
                {
                    if(session_start())
                    {   
                        $_SESSION['loggued_on_user'] = '';
                    }
                    $relog_message = "Please login with your new credentials :)";
                    require("view/accountModifiedView.php");
                }
            // Display failure messages if something's wrong
            } else if ($problem == 1)
            {
                require('view/userAccountView.php');
            }
        // Nothing to update
        } else {
            $msg = "Nothing to modify :/";
            require('view/userAccountView.php');
        }
    // Incorrect password
    } else {
        $msg = "Incorrect password :/";
        require('view/userAccountView.php');
    }
}

// VERIFY ACCOUNT FOR PASSWORD RESET
// ---------------------------------------------------------------
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
                // IF ACCOUNT IS ALREADY ACTIVATED
                $verify = $userManager->activateAccount($email);
                if ($verify == 2)
                {
                    require('view/resetPasswordView.php');
                }
                // ACCOUNT NOT ACTIVATED
                else
                {
                    $msg = "There is no verified account with this email address :/";
                    require('view/forgotPasswordView.php');
                }
            } 
        }
    }
}

// RESET PASSWORD
// ---------------------------------------------------------------
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

// NOTIFICATIONS
// ---------------------------------------------------------------
if(isset($_POST['user_id']) && isset($_POST['bool']))
{
    $user_id = $_POST['user_id'];
    $bool = $_POST['bool'];
    changeNotificationsPreferences($user_id, $bool);
}

function changeNotificationsPreferences($user_id, $bool)
{
    $userManager = new UserManager();
    if ($user_id && ($bool == 1 || $bool == 0))
    {
        if ($userManager->turnNotificationsOnOff($user_id, $bool) == 1)
        {
            return(1);
        }
    }
    return(0);
}

// function resend($name, $email, $hash)
// {
//     echo('RESEND' . $name);
//     sendEmail($name, $email, $hash);
//     require('view/userView.php');
// }