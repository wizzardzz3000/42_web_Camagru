<?
require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

class Manager
{
    protected function dbConnect()
    {
        global $DB_DSN, $DB_UNAME, $DB_PASSWORD;

        try {
            $db = new PDO($DB_DSN, $DB_UNAME, $DB_PASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo 'Échec lors de la connexion : ' . $e->getMessage();
        }
    }
}