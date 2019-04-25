
<?php
require('config/database.php');

class Database {

    private $pdo;

    private function connectdb() {

        global $DB_DSN, $DB_UNAME, $DB_PASSWORD;
        if($this->pdo === null) {
            try {
                $pdo = new PDO($DB_DSN, $DB_UNAME, $DB_PASSWORD);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            } catch(PDOException $ex) {
                print('Error connecting to database ' . $ex);
                exit;
            }
        }
        return $this->pdo;
    }

    public function query($statement) {
        $req = $this->connectdb()->query($statement);
        $datas = $req->fetchAll(PDO::FETCH_OBJ);
        return $datas;
    }

}