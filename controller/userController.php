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
        if($login === $user['user_name'] && /*hash('whirlpool', $passwd)*/ $passwd === $user['user_password'])
        {
            return(TRUE);
        }
        else
        {
            return(FALSE);
        }
    }
}

function login($login, $passwd)
{
    if($login != '' && $passwd != '')
    {
        session_start();

        if (authUser($login, $passwd) === TRUE)
        {
            $_SESSION['loggued_on_user'] = $login;
            require('view/mainView.php');
        } else {
            $_SESSION['loggued_on_user'] = '';
            echo("WRONG LOGIN");
            require('view/userView.php');
        }
    }
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
        else
        {
            echo('FUCK IT');
        }
    }
}

function register($login, $email, $password)
{
    if($login != '' && $email != '' && $passwd != '')
    {

    }
}