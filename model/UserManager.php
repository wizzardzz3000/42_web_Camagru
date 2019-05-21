<?
require_once $_SERVER['DOCUMENT_ROOT'].'/model/Manager.php';

class UserManager extends Manager
{
    // GET USERS
    // ---------------------------------------------------------------
    public function getUsers()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT user_id, user_name, user_email, user_password, hash, account_valid, notifications FROM users ORDER BY user_id");
        $req->execute();

        return $req;
        $req->closeCursor();
    }
    // GET USER DATA
    // ---------------------------------------------------------------
    public function getUser($login, $email)
    {
        $db = $this->dbConnect();
        if ($login) {
            $req = $db->prepare("SELECT user_id, user_name, user_email, user_password, hash, account_valid, notifications FROM users WHERE user_name = '$login'");
            $req->execute();
        } else if ($email) {
            $req = $db->prepare("SELECT user_id, user_name, user_email, user_password, hash, account_valid, notifications FROM users WHERE user_email = '$email'");
            $req->execute();
        }

        return $req;
        $req->closeCursor();
    }

    // CHECK IF USER EXISTS
    // ---------------------------------------------------------------
    public function userExists($user_name, $user_email)
    {
        $db = $this->dbConnect();
        $users_table = $db->prepare('SELECT user_id, user_name, user_email FROM users ORDER BY user_id');
        $users_table->execute();

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
                    return(2);
                }
            }
            return(3);
        } else {
            return (0);
        }

        $users_table->closeCursor();
    }

    // SAVE USER DATA
    // ---------------------------------------------------------------
    public function saveUser($user_name, $user_email, $user_password, $hash)
    {
        $db = $this->dbConnect();

        if ($user_name !== '' && $user_email !== '' && $user_password !== '')
        {
            $user_pwd = hash('whirlpool', $user_password);
        
            // USERNAME ALREADY TAKEN
            if ($this->userExists($user_name, $user_email) == 1)
            {
                return(1);
            }
            // EMAIL ALREADY TAKEN
            else if ($this->userExists($user_name, $user_email) == 2)
            {
                return(2);
            }
            // IT'S OK TO SAVE THE USER
            else if ($this->userExists($user_name, $user_email) == 3)
            {
                $query = "INSERT INTO users
                        SET user_name = '$user_name', 
                        user_email = '$user_email',
                        user_password = '$user_pwd',
                        hash = '$hash',
                        account_valid = 0,
                        notifications = 1"; // notifications activated by default
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array($user_name, $user_email, $user_pwd, $hash));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                } else {
                    return(3);
                }
            } else {
                return(0);
            }
        }
        $user->closeCursor();
    }

    // ACTIVATE USER ACCOUNT
    // ---------------------------------------------------------------
    public function activateAccount($email)
    {
        $db = $this->dbConnect();
        $users = $db->prepare("SELECT user_email, account_valid FROM users WHERE user_email = '$email'");
        $users->execute();

        if($user = $users->fetch())
        {
            // ACCOUNT ALREADY VERIFIED
            if ($user['account_valid'] == 1)
            {
                return (2);
            }
            // VERIFY ACCOUNT AND CHANGE HASH
            $hash = hash("whirlpool", rand(0,1000));
            $query = "UPDATE users SET account_valid = ?, hash = ? WHERE user_email = ?";
            $user = $db->prepare($query);
            $affectedLines = $user->execute(array(1, $hash, $email));
            if (!$affectedLines)
            {
                die("ERROR: ". mysqli_error($db));

            } 
            return(1);
        }
        $users->closeCursor();
        $user->closeCursor();
    }

    // UPDATE USER DATA
    // ---------------------------------------------------------------
    public function updateUser($email, $current_user, $new_user_name, $new_user_email, $new_user_password)
    {
        $db = $this->dbConnect();
        if ($email)
        {
            $users = $db->prepare("SELECT user_name, user_email, user_password FROM users WHERE user_email = '$email'");
            $users->execute();
        }
        if ($current_user)
        {
            $users = $db->prepare("SELECT user_name, user_email, user_password FROM users WHERE user_name = '$current_user'");
            $users->execute();
        }
    
        if($user = $users->fetch())
        {
            // NEW EMAIL
            if ($new_user_email)
            {
                $query = "UPDATE users SET user_email = ? WHERE user_name = '$current_user'";
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array($new_user_email));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                }
                $user->closeCursor();
            }
            // NEW PASSWORD
            if ($new_user_password)
            {
                if ($email)
                    $query = "UPDATE users SET user_password = ? WHERE user_email = '$email'";
                if ($current_user)
                    $query = "UPDATE users SET user_password = ? WHERE user_name = '$current_user'";
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array(hash("whirlpool", $new_user_password)));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                }
                $user->closeCursor();
            }
            // NEW NAME
            if ($new_user_name)
            {
                $query = "UPDATE users SET user_name = ? WHERE user_name = '$current_user'";
                $user = $db->prepare($query);
                $affectedLines = $user->execute(array($new_user_name));
                if (!$affectedLines)
                {
                    die("ERROR: ". mysqli_error($db));
                }
                $user->closeCursor(); 
            }
            if ($affectedLines)
                return(1);
        }
        $users->closeCursor();
    }
    
    // NOTIFICATIONS
    // ---------------------------------------------------------------
    public function turnNotificationsOnOff($user_id, $bool)
    {
        if ($bool == 1 || $bool == 0)
        {
            $db = $this->dbConnect();
            $query = "UPDATE users SET notifications = ? WHERE user_id = '$user_id'";
            $user = $db->prepare($query);
            $affectedLines = $user->execute(array($bool));
            if (!$affectedLines)
            {
                die("ERROR: ". mysqli_error($db));
            } 
        }
        if ($affectedLines)
            return(1);
        $user->closeCursor();
    }
}