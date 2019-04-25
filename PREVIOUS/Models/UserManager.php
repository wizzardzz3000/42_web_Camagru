<?php
    class UserManager extends Model
    {
        public function getUser()
        {
            return $this->getAllFromTable('user','User');
        }
    }