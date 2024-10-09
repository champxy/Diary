<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost; dbname=diary; charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed : " . $e->getMessage();
}
@$_SESSION['emoji'] = $_POST['emoji'];
$stmt = $conn->prepare("SELECT * FROM diary_write WHERE userID = :id_user AND diaryID = '" . $_GET['id'] . "'");
$stmt->bindValue(":id_user", $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
// Populate the input fields with the data from the database
$date = $result['date_write'];
$number1 = $result['income'];
$number2 = $result['fee'];
$textarea = $result['data_write'];
$datetoshow = explode("-", $date);
$datetoshow2 = "NEW" . $datetoshow[0] . "M" . $datetoshow[1] . "D" . $datetoshow[2];

if (isset($_POST['submit'])) {
    if (!is_dir('download')) {
        mkdir('download', 0777, true);
    }
    $dir = "download/";
    $filename = $dir . basename($_FILES['file']['name']);
    $resutX = $conn->query("SELECT *FROM diary_write WHERE diaryID = '" . $_GET['id'] . "'");
    $datx = $resutX->fetchAll(PDO::FETCH_ASSOC);
    $backimg = $datx[0]["pic"];
    /* var_dump($datx); */
    if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
        $conn->exec("UPDATE `diary_write` SET`pic`='" . basename($_FILES['file']['name']) . "' WHERE diaryID = '" . $_GET['id'] . "'");

        @unlink($dir . $backimg);
        $resutXX = $conn->query("SELECT *FROM diary_write WHERE diaryID = '" . $_GET['id'] . "'");
        $datxx = $resutXX->fetchAll(PDO::FETCH_ASSOC);
        $img = $datxx[0]["pic"];

        $arrimg = explode(".", $img);
        $newname = $datetoshow2 . "." . $arrimg[1];
        rename($dir . $img, $dir . $newname);

        $conn->exec("UPDATE `diary_write` SET `userID`='" . $_SESSION['id_user'] . "',`date_write`='" . $date . "',`income`='" . $_POST['number1'] . "',
        `fee`='" . $_POST['number2'] . "',`data_write`='" . $_POST['textarea'] . "',`pic`='" . $newname . "',`feeling`='" . $_POST['emoji'] . "' WHERE diaryID = '" . $_GET['id'] . "'");


        echo "<script type='text/javascript'>alert('successed');</script>";
        header("Refresh:0; url=yourdiary.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editdiary.css">
    <title>Document</title>
</head>

<body>
    <div class="container">

        <div class="card first-child">
            <h1>Edit Diary</h1>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="date">Date:</label>
                <input type="date" id="date" value="<?php echo $date ?>" readonly name="date">

                <label for="number1">รายรับ:</label>
                <input type="text" id="number1" name="number1" value="<?php echo $number1 ?>">


                <label for="number2">รายจ่าย:</label>
                <input type="text" id="number2" name="number2" value="<?php echo $number2 ?>">

                <textarea id="textarea" name="textarea" rows="6"><?php echo $textarea; ?></textarea>

                <label for="number1">How are you feel?:</label>
                <div class="emoji-select">
                    <input type="radio" name="emoji" id="emoji1" value="100">
                    <label for="emoji1" class="emoji-option">
                        <div class="emoji">😇</div>
                    </label>
                    <input type="radio" name="emoji" id="emoji2" value="75">
                    <label for="emoji2" class="emoji-option">
                        <div class="emoji">😃</div>
                    </label>
                    <input type="radio" name="emoji" id="emoji3" value="50">
                    <label for="emoji3" class="emoji-option">
                        <div class="emoji">🙂</div>
                    </label>
                    <input type="radio" name="emoji" id="emoji4" value="25">
                    <label for="emoji4" class="emoji-option">
                        <div class="emoji">☹️</div>
                    </label>
                    <input type="radio" name="emoji" id="emoji5" value="0">
                    <label for="emoji5" class="emoji-option">
                        <div class="emoji">😭</div>
                    </label>
                </div>
                <br>
                <div class="picture">

                    <label for="file">Choose a picture:</label>
                    <input type="file" id="file" name="file">
                </div>
                <input type="submit" name="submit" value="Submit">

            </form>
        </div>


    </div>
</body>

</html>