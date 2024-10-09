<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost; dbname=diary; charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed : " . $e->getMessage();
}

/* var_dump($_POST); */
/* echo $_POST['login']; */
if (isset($_POST['login']) == "login") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT userID FROM users WHERE username = '" . $username . "' AND password =  '" . $password . "' ");
    $id = $result->fetch(PDO::FETCH_ASSOC);
    /* var_dump($id); */
    $sql = $conn->query("SELECT count(*) FROM users WHERE username = '" . $username . "' AND password =  '" . $password . "' ");
    if ($sql->fetchColumn() > 0) {
        $_SESSION['id_user'] = $id['userID'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        echo "<script type='text/javascript'>alert('Login successed');</script>";
        header("Refresh:0; url=mainboard.php");
    } else {
        echo "<script type='text/javascript'>alert('ไม่มีข้อมูล user ในระบบ');</script>";
        header("Refresh:0; url=logout.php");
    }
}
