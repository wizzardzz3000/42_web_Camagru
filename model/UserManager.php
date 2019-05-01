<?
require_once('model/Manager.php');

class UserManager extends Manager
{
    public function getUser($login)
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT user_id, user_name, user_email, user_password, hash, account_valid FROM users WHERE user_name = '$login'");

        return $req;
    }

    public function userExists($user_name)
    {
        $db = $this->dbConnect();
        $users_table = $db->query('SELECT user_id, user_name FROM users ORDER BY user_id');

        if ($users_table)
        {
            while ($user = $users_table->fetch())
            {
                if($user['user_name'] === $user_name)
                {
                    return(1);
                }
            }
            return(2);
        } else {
            return (0);
        }
    }

    public function saveUser($user_name, $user_email, $user_password, $hash)
    {
        $db = $this->dbConnect();

        if ($user_name !== '' && $user_email !== '' && $user_password !== '')
        {
            $user_pwd = hash('whirlpool', $user_password);
        
            if ($this->userExists($user_name) == 1)
            {
                return(2);
            } 
            else if ($this->userExists($user_name) == 2)
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
            } else {
                return(0);
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

    public function updateUser($current_user, $new_user_name, $new_user_email, $new_user_password)
    {
        $db = $this->dbConnect();
        $users = $db->query("SELECT user_name, user_email, user_password FROM users WHERE user_name = '$current_user'");

        if($user = $users->fetch())
        {
            if ($new_user_email)
            {
                $query = "UPDATE users SET user_email = ? WHERE user_name = '$current_user'";
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array($new_user_email));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                } 
            }
            if ($new_user_password)
            {
                $query = "UPDATE users SET user_password = ? WHERE user_name = '$current_user'";
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array(hash("whirlpool", $new_user_password)));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                } 
            }
            if ($new_user_name)
            {
                $query = "UPDATE users SET user_name = ? WHERE user_name = '$current_user'";
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array($new_user_name));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                } 
            }
            return(1);
        }
    }
}