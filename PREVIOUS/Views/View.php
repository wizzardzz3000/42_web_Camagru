<?php
    class View
    {
        private $file;
        private $t;

        public function __construct($action)
        {
            $this->file = 'Views/view' .$action.'.php';
        }
        public function generate($data)
        {
            $content = $this->generateFile($this->file, $data);

            $view = $this->generateFile('Views/template.php', array('t' => $this->t,
            'content' => $content));
            
            echo $view;
        }

        private function generateFile($file, $data)
        {
            if(file_exists($file))
            {
                extract($data);
                ob_start();
                require $file;
                return ob_get_clean();
            } else {
                throw new Exception('Fichier '.$file.' introuvable');
            }
        }
    }