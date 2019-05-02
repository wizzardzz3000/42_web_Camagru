<?
require_once('model/Manager.php');

class UserManager extends Manager
{
    public function getUser($login, $email)
    {
        $db = $this->dbConnect();
        if ($login) {
            $req = $db->query("SELECT user_id, user_name, user_email, user_password, hash, account_valid FROM users WHERE user_name = '$login'");
        } else if ($email) {
            $req = $db->query("SELECT user_id, user_name, user_email, user_password, hash, account_valid FROM users WHERE user_email = '$email'");
        }

        return $req;
    }

    public function userExists($user_name, $user_email)
    {
        $db = $this->dbConnect();
        $users_table = $db->query('SELECT user_id, user_name, user_email FROM users ORDER BY user_id');

        if ($users_table)
        {
            while ($user = $users_table->fetch())
            {
                if($user['user_name'] === $user_name)
                {
                    return(1);
                }
                if($user['user_email'] === $user_email)
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
        
            if ($this->userExists($user_name, $user_email) == 1)
            {
                return(2);
            } 
            else if ($this->userExists($user_name, $user_email) == 2)
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
        $users = $db->query("SELECT user_email, account_valid FROM users WHERE user_email = '$email'");

        if($user = $users->fetch())
        {
            if ($user['account_valid'] == 1)
            {
                return (2);
            }
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

    public function updateUser($email, $current_user, $new_user_name, $new_user_email, $new_user_password)
    {
        $db = $this->dbConnect();
        if ($email)
            $users = $db->query("SELECT user_name, user_email, user_password FROM users WHERE user_email = '$email'");
        if ($current_user)
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