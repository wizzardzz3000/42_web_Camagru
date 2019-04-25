<?php

    require('config/database.php');

    abstract class Model 
    {
        private static $db;

        private static function setDb()
        {
            $DB_NAME = "db_mascagli";
            $DB_HOST = "127.0.0.1";
            $DB_PORT = "3306";
            $DB_DSN = "mysql:dbname=" . $DB_NAME . ";host=" . $DB_HOST . ";port=" . $DB_PORT;
            $DB_UNAME = "root";
            $DB_PASSWORD = "123456";
            //global $DB_DSN, $DB_UNAME, $DB_PASSWORD;
            self::$db = new PDO($DB_DSN, $DB_UNAME, $DB_PASSWORD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        protected function getDb()
        {
            if(self::$db === null)
                self::setDb();
            return self::$db;
        }
        protected function getAllFromTable($table, $obj)
        {
            $data = [];
            $query = $this->getDb()->prepare('SELECT * FROM ' . $table);
            $query->execute();
            while($var = $query->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = new $obj($var);
            }
            return $data;
            $query->closeCursor();
        }
    }