<?php
class db
{
    protected $db;
    public function __construct()
    {
        $this->connectdb();
    }
    private function connectdb()
    {
        try {
            $this->db = new PDO("mysql:host=localhost; dbname=diary; charset=utf8;", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* echo "db connected";  */
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>

<?php
$db = new db();
?>