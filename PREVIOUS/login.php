<?PHP 
    include 'auth.php';
    session_start();

    if($_POST['login'] !== '' && $_POST['passwd'] !== '')
    {
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
    }

    if (auth($login, $passwd) === TRUE)
    {
        $_SESSION['loggued_on_user'] = $login;
        header("Location: index.php");
        echo("OK\n");
    } else {
        $_SESSION['loggued_on_user'] = '';
        header("Location: invalid.html");
    }