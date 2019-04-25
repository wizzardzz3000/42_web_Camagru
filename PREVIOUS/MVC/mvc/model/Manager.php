<?

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=test;charset=utf8', 'root', '123456');
        return $db;
    }
}