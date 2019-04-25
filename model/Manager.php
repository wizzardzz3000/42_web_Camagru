<?
require('config/database.php');

class Manager
{
    protected function dbConnect()
    {
        global $DB_DSN, $DB_UNAME, $DB_PASSWORD;
        $db = new PDO($DB_DSN, $DB_UNAME, $DB_PASSWORD);
        return $db;
    }
}