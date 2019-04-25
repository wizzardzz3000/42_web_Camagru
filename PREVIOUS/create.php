<?PHP
    $account = "private/passwd";
    if ($_POST['login'] !== '' && $_POST['passwd'] !== '' && $_POST['submit'] === 'OK')
    {
        if (strlen($_POST['passwd']) < 5) {
            header("Location: create.html");
            exit;
        } 
        $user = [
            "login" => $_POST['login'],
            "passwd" => hash("whirlpool", $_POST['passwd'])
        ];
        if (file_exists($account))
        {
            $data = unserialize(file_get_contents($account));
            foreach($data as $instance)
            {
                if($user['login'] === $instance['login'])
                {
                    header("Location: create.html");
                    exit; 
                }
            }
            $data[] = $user;
        }  else {
            if (!file_exists('private'))
                mkdir('private', 0755);
            $data[] = $user;
        }
        file_put_contents($account, serialize($data));
        header("Location: login.html");
    }
    else
    {   
        header("Location: create.html");
        return; 
    }