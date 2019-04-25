<?php
    class User
    {
        private $user_id;
        private $user_pseudo;
        private $user_password;
        private $user_email;

        public function __construct(array $data)
        {
             $this->hydrate($data);
        }

        public function hydrate(array $data)
        {
            foreach($data as $key => $value)
            {
                $method = 'set_'.$key;
                if (method_exists($this, $method))
                    $this->$method($value);
            }
        }
        
        // SETTERS
        public function set_user_id($id)
        {
            $id = (int) $id;
            if($id > 0)
            $this->user_id = $id;
        }
        public function set_user_pseudo($pseudo)
        {
            if (is_string($pseudo))
                $this->user_pseudo = $pseudo;
        }
        public function set_user_password($password)
        {
            //to fix and decode
            if (is_string($password))
                $this->user_password = $password;
        }
        public function set_user_email($email)
        {
            if (is_string($email))
                $this->user_email = $email;
        }
        // GETTERS
        public function id()
        {
            return $this->user_id;
        }
        public function pseudo()
        {
            return $this->user_pseudo;
        }        
        public function password()
        {
            return $this->user_password;
        }
        public function email()
        {
            return $this->user_email;
        }
    }