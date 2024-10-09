<?php
session_start();
try {
    $conn = new PDO("mysql:host=localhost; dbname=diary; charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed : " . $e->getMessage();
}

$number1 = '';
$number2 = '';
$textarea = '';
$emoji = '';
$button_hidden = '';
// Get the date of the last submitted data
$currentDate = date('Y-m-d');
$resultdate = $conn->query("SELECT date_write FROM `diary_write` WHERE userID = '" . $_SESSION['id_user'] . "' AND date_write = '" . $currentDate . "'");
$datewrite = $resultdate->fetch(PDO::FETCH_ASSOC);
@$lastSubmitDate = $datewrite['date_write'];
// Check if the current date is the same as the date of the last submitted data

$isLocked = ($lastSubmitDate == $currentDate);

// If the input is locked, disable the input fields
$disabled = $isLocked ? "disabled" : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit']) == "Submit") {
        // If the input is locked, prevent the user from submitting new data
        if ($isLocked) {
            echo "<script type='text/javascript'>alert('You have already submitted data for today.');</script>";
        } else {
            // Get the input values and insert them into the database
            $date = $_POST['date'];
            $id = $_SESSION['id_user'];

            $income = explode(" ", $_POST['number1']);
            $income2 = explode(",", $income[0]);
            $result1 = "";
            for ($i = 0; $i < count($income2); $i++) {
                $result1 .= $income2[$i];
            }
            $result2 = "";
            $fee = explode(" ", $_POST['number2']);
            $fee2 = explode(",", $fee[0]);
            for ($i = 0; $i < count($income2); $i++) {
                $result2 .= $fee2[$i];
            }

            $textfeel = $_POST['textarea'];
            $feeling = $_POST['emoji'];
            $datetoshow = explode("-", $date);
            $datetoshow2 = $datetoshow[0] . "M" . $datetoshow[1] . "D" . $datetoshow[2];

            if (!is_dir('download')) {
                mkdir('download', 0777, true);
            }
            $dir = "download/";
            $filename = $dir . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
                $conn->exec("INSERT INTO `diary_write`(`userID`,date_write,`income`,`fee`,`data_write`,`feeling`,`pic`) VALUES ('" . $_SESSION['id_user'] . "' , '" . $date . "','" . $result1 . "',
                 '" . $result2 . "', '" . $textfeel . "', '" . $feeling . "','" . basename($_FILES['file']['name']) . "')");
                $result = $conn->query("SELECT * FROM `diary_write` WHERE userID = '" . $_SESSION['id_user'] . "' AND date_write = '" . $currentDate . "'");
                $img = "";
                $data = $result->fetch(PDO::FETCH_OBJ);
                $img = $data->pic;
                $arrimg = explode(".", $img);
                $newname = $datetoshow2 . "." . $arrimg[1];
                rename($dir . $img, $dir . $newname);
                $conn->exec("UPDATE diary_write SET pic = '" . $newname . "' WHERE userID =  '" . $_SESSION['id_user'] . "' AND date_write = '" . $currentDate . "' ");


                echo "<script type='text/javascript'>alert('successed');</script>";

                $number1 = $_POST['number1'];
                $number2 = $_POST['number1'];
                $textarea = $_POST['textarea'];
                $emoji = $_POST['emoji'];
                $button_hidden = 'hidden';
                $disabled = "disabled";
                /* header("Refresh:0; url=mainboard.php"); */
            } else {
                echo "5";
            }
        }
    }
} else {
    // show values from database
    $result = $conn->query("SELECT * FROM `diary_write` WHERE userID = '" . $_SESSION['id_user'] . "' AND date_write = '" . $currentDate . "'");
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $number1 = $row['income'];
        $number2 = $row['fee'];
        $textarea = $row['data_write'];
        $emoji = $row['feeling'];
        $button_hidden = 'hidden';
        $disabled = "disabled";
    }
    /* echo  $number1 ; */
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/emoji.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/fontawesome.min.css">
    <title>Document</title>
</head>

<body>
    <nav>
        <div class="logo">
            <a href="#"><img src="img/logo.png" width="100" alt="Logo"></a>
        </div>
        <ul class="menu">
            <li><a href="mainboard.php">Home</a></li>
            <li class="dropdown">
                <a href="#"><i class="fa-solid fa-user">⠀</i><?php echo $_SESSION['username'] ?></a>
                <ul class="submenu">
                    <li><a href="yourdiary.php">ไดอารี่ของฉัน</a></li>
                    <li><a href="logout.php">ออกจากระบบ</a></li>

                </ul>
            </li>

        </ul>
    </nav>




    <div class="container">

        <div class="card first-child">
            <h1>Diary</h1>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="date">Date:</label>
                <input type="date" id="date" value="<?php echo date('Y-m-d'); ?>" readonly name="date" <?php echo $disabled; ?>>

                <label for="number1">รายรับ:</label>
                <input type="text" id="number1" name="number1" value="<?php echo $number1 ?>" <?php echo $disabled; ?> class="disabled-input">


                <label for="number2">รายจ่าย:</label>
                <input type="text" id="number2" name="number2" value="<?php echo $number2 ?>" <?php echo $disabled; ?>>

                <textarea id="textarea" name="textarea" rows="6" <?php echo $disabled; ?> class="<?php echo ($disabled ? 'disabled' : '') ?>"><?php echo $textarea; ?></textarea>

                <label for="number1">How are you feel?:</label>
                <?php
                // Assume $emoji variable contains the value of the selected emoji
                if (isset($_POST['emoji'])) {
                    $_SESSION['emoji'] = $_POST['emoji'];
                }
                $emoji = isset($_SESSION['emoji']) ? $_SESSION['emoji'] : '';

                // Define an array of emojis and their corresponding values
                $emojis = array(
                    '😇' => 100,
                    '😃' => 75,
                    '🙂' => 50,
                    '☹️' => 25,
                    '😭' => 0,
                );

                // Output the HTML for the emoji selection form
                echo '<div class="emoji-select">';
                foreach ($emojis as $emojiChar => $emojiValue) {
                    $checked = ($emojiValue == $emoji) ? 'checked' : '';
                    $disabled = ($emoji != '') ? 'disabled' : '';
                    echo '<input type="radio" name="emoji" id="emoji' . $emojiValue . '" value="' . $emojiValue . '" ' . $checked . ' ' . $disabled . '>';
                    echo '<label for="emoji' . $emojiValue . '" class="emoji-option">';
                    echo '<div class="emoji">' . $emojiChar . '</div>';
                    echo '</label>';
                }
                echo '</div>';
                ?>



                <br>
                <div class="picture">

                    <label for="file">Choose a picture:</label>
                    <input type="file" id="file" name="file" <?php echo $disabled; ?>>
                </div>
                <input type="submit" name="submit" value="Submit" <?php echo $button_hidden; ?>>

            </form>
        </div>

        <div class="card last-child">

            <div class="cardbox">
                <div class="chart-box">
                    <canvas id="myChartnut"></canvas>
                </div>
                <div class="boxinput">
                    <div class="adddata">
                        <select name="" id="locationX" hidden>
                            <option selected value="<?php echo $_SESSION['id_user'] ?>"><?php echo $_SESSION['id_user'] ?> </option>
                        </select>
                    </div>
                </div>
            </div>
            <h1>
                <div id="text" style="text-align: center; padding-top: 50px;-webkit-text-stroke: 0.5px black;"></div>
            </h1>

        </div>
    </div>


    </form>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/nut.js"></script>
    <script src="js/das.js"></script>
    <script src="js/script.js"></script>

</body>

</html>