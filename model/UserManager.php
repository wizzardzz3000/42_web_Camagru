<?
require_once('model/Manager.php');

class UserManager extends Manager
{
    public function getUsers()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT user_id, user_name, user_email, user_password, hash, account_valid FROM users ORDER BY user_id');

        return $req;
    }

    public function saveUser($user_name, $user_email, $user_password, $hash)
    {
        session_start();
        $db = $this->dbConnect();

        if ($user_name !== '' && $user_email !== '' && $user_password !== '') {
            $user_pwd = hash('whirlpool', $user_password);
         
            $query_check = "SELECT user_name FROM users WHERE user_name = '$user_name'";
            $users = $db->query('SELECT user_id, user_name FROM users ORDER BY user_id');
            $exists = 0;

            if($users)
            {
                while ($user = $users->fetch())
                {
                    if($user['user_name'] === $user_name)
                    {
                        $exists = 1;
                    }
                }
            }

            if ($exists === 1) 
            {
              return(2);
            } else 
            {
                $query = "INSERT INTO users
                        SET user_name = '$user_name', 
                        user_email = '$user_email',
                        user_password = '$user_pwd',
                        hash = '$hash',
                        account_valid = 0";
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array($user_name, $user_email, $user_pwd, $hash));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                } else {
                    return(1);
                }
            }
        }
    }

    public function activateAccount($email)
    {
        $db = $this->dbConnect();
        $users = $db->query('SELECT user_id, user_email FROM users ORDER BY user_id');

        if($users)
        {
            while ($user = $users->fetch())
            {
                if($user['user_email'] === $email)
                {
                    $query = "UPDATE users SET account_valid = ? WHERE user_email = ?";
                    $user = $db->prepare($query);
                    $affectedLines = $user->execute(array(1, $email));
                    if (!$affectedLines)
                    {
                        die("ERROR: ". mysqli_error($db));

                    } 
                    return(1);
                }
            }
        }
    }

    public function updateUser()
    {
        $account = "../private/passwd";
        if ($_POST['login'] !== '' && $_POST['oldpw'] !== '' && $_POST['newpw'] !== '' && $_POST['submit'] === 'OK')
        {
            if (file_exists($account))
            {
                $data = unserialize(file_get_contents($account));
                $user = [
                    "login" => $_POST['login'],
                    "oldpw" => $_POST['oldpw'],
                    "newpw" => $_POST['newpw']
                ];
                foreach ($data as $key => $instance)
                {
                    if ($user['login'] === $instance['login'])
                    {
                        if (hash("whirlpool", $user['oldpw']) === $instance['passwd'])
                        {
                            $instance['passwd'] = hash("whirlpool", $user['newpw']);
                            $data[$key] = $instance;
                            file_put_contents($account, serialize($data));
                            // header("Location: index.html");
                            // echo ("OK\n");
                            return ;
                        }
                    }
                }
                echo("ERROR\n");
                return;
            } else {
                echo("ERROR\n");
                return;
            }
        } else {
            echo("ERROR\n");
            return;
        }
    }
}