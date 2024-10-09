<?php
include_once('data.php');
?>
<?php
$cus = new customer();

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $data = file_get_contents("php://input");
    $cus_data = json_decode($data, true);
    /*  var_dump($cus_data);   */
    if ($cus->addcustomer($cus_data) == 1) {
        echo json_encode(["Status" => "ok", "message" => "Insert {$cus_data[":username"]} completed"]);
    } else {
        echo json_encode(["Status" => "ok", "message" => "Error something wrong"]);
    }
} else if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if ($_GET['getid']) {
        $setid = $cus->getdatalo($_GET['getid']);
        /* echo $setid[0]['sensor']; */
        echo $setid;
        /* echo $_GET['getid']; */
    }
}

?>