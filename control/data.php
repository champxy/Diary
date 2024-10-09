<?php include_once('db.php') ?>
<?php


class customer extends db
{
    public function addcustomer($opt)
    {
        $sql = "INSERT INTO `users`( `username`, `password`, `fName`, `lName`) 
        VALUES (:username,:password,:fName,:lName)";
        $stmt = $this->db->prepare($sql);
        return ($stmt->execute($opt) ? 1 : 0);
    }
    public function getdatalo($id)
    {
        $sql = "SELECT feeling FROM diary_write WHERE userID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $sum = 0;
        $count = $stmt->rowCount();
        $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($all as $key => $data) {
            $sum += $all[$key]['feeling'];
        }
        if ($count > 0) {
            return $sum / $count;
        } else {
            return 0;
        }
    }
}
/* $cus = new customer();
$cus->addcustomer("champ","thailand","09808080","123"); */
?>