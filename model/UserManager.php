<?
require_once('model/Manager.php');

class UserManager extends Manager
{
    public function getUsers()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT user_id, user_name, user_email, user_password, account_valid FROM users ORDER BY user_id');

        return $req;
    }

    public function saveUser()
    {
        session_start();
        $db = $this->dbConnect($user_name, $user_email, $user_password);

        if ($user_name !== '' && $user_email !== '' && $user_password !== '') {
            $user_pwd = hash('whirlpool', $user_password);
         
            $query_check = "SELECT user_name FROM users WHERE user_name='$user_name'";
            $run = mysqli_query($db, $query_check);
            $check = mysqli_num_rows($run);
         
            if ($check) {
              //$_SESSION["user"] = $user_login;
              alert('This user already exists, please login or create an account with a different name.');
            } else 
            {
                $query = "INSERT INTO users
                        SET user_name = '$user_name', 
                        user_email = '$user_email',
                        user_password = '$user_pwd'";
                 $run_pro = mysqli_query($db, $query);
                if (!$run_pro) {
                    die("ERROR: ". mysqli_error($db));
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