<?PHP
    function auth($login, $passwd) {
        if (file_exists($account = "private/passwd"))
        {
            $data = unserialize(file_get_contents($account));
            foreach ($data as $instance)
            {
                if ($instance['login'] === $login)
                {
                    if (hash('whirlpool', $passwd) === $instance['passwd']) {
                        return TRUE;	
                    }
                } 
            } 
            return FALSE; 
        } else {
            return FALSE;
        }
    }