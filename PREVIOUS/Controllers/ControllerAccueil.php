<?php
    require_once('Views/View.php');
    
    class ControllerAccueil
    {
        private $_userManager;
        private $_view;

        public function __construct($url)
        {
            if (isset($url) && count($url) > 1)
                throw new Exception('Page introuvable');
            else
                $this->users();
        }

        private function users()
        {
            $this->_userManager = new UserManager;
            $users = $this->_userManager->getUser();

            $this->_view = new View('Accueil');
            $this->_view->generate(array('users' => $users));
        }
    }